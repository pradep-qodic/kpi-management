<?php
class Admin_model extends CI_Model
{
    private $users = "users";
    private $tbl_store = "store";
    private $tbl_outreach = "outreach";

    public function __construct()
    {
        parent::__construct();
    }

    // Insert a new user into the users table
    public function insert_users($data)
    {
        $this->db->trans_start();
        $this->db->insert($this->users, $data);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }

    // Retrieve all users that are not deleted
    public function get_all_users()
    {
        $this->db->where('isDeleted', 0);
        return $this->db->get($this->users)->result();
    }

    // Update user data by user ID
    public function update_users($user_id, $data)
    {
        $this->db->where('user_id', $user_id);
        return $this->db->update($this->users, $data);
    }

    // Get admin data by email
    public function get_admin_data($email)
    {
        $this->db->where('email', $email);
        $this->db->where('isDeleted', 0);
        return $this->db->get($this->users)->result();
    }

    // Verify if an email exists and is not deleted
    public function verify_email($email)
    {
        $this->db->where('email', $email);
        $this->db->where('isDeleted', 0);
        return $this->db->get($this->users)->num_rows() > 0;
    }

    // Check if a store is the head office and not deleted
    public function check_by_head_office($store_id)
    {
        $this->db->where('store_id', $store_id);
        $this->db->where('head_office', 1);
        $this->db->where('isDeleted', 0);
        return $this->db->get($this->tbl_store)->num_rows() > 0;
    }

    // Get user details by user ID
    public function get_user_details_by_id($user_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->where('isDeleted', 0);
        $query = $this->db->get($this->users);
        return $query->num_rows() > 0 ? $query->result() : false;
    }

    // Update user data by email
    public function update_user_by_email($email, $data)
    {
        $this->db->where('email', $email);
        return $this->db->update($this->users, $data);
    }

    // Retrieve all store details, with access control based on admin type
    public function get_all_store_details()
    {
        $userid = $this->session->userdata('adminId');
        if ($this->isSuperAdmin()) {
            return $this->db->where('isDeleted', 0)->get($this->tbl_store)->result();
        } else {
            $site_assigned = $this->get_user_details_by_id($userid)[0]->site_assigned;
            return $this->db->where("store_id REGEXP CONCAT('(^|,)(', REPLACE('$site_assigned', ',', '|'), ')(,|$)') AND isDeleted=0")->get($this->tbl_store)->result();
        }
    }

    // Insert a new store into the store table
    public function insert_store($data)
    {
        $this->db->trans_start();
        $this->db->insert($this->tbl_store, $data);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }

    // Update store data by store ID
    public function update_store($store_id, $data)
    {
        $this->db->where('store_id', $store_id);
        return $this->db->update($this->tbl_store, $data);
    }

    // Update all stores to no longer be the head office
    public function update_head_office()
    {
        return $this->db->update('store', ['head_office' => 0], ['1' => 1]);
    }

    // Retrieve all form data with access control based on admin type
    public function get_all_form_data()
    {
        $userid = $this->session->userdata('adminId');
        $query = $this->db->select("store_id, month_year, id as fromid, 'hr_kpi', 'HR_KPI'")->from('hr_kpi')->where('isDeleted', 0)->where('is_budget', 0);

        if (!$this->isSuperAdmin()) {
            $query->where('addedBy', $userid);
        }

        $result = $query->get()->result();
        return $result;
    }

    // Load data by table name and record ID
    public function load_data_by_table_name($table_id, $table_name)
    {
        return $this->db->where('isDeleted', 0)->where('is_budget', 0)->where('id', $table_id)->get($table_name)->result();
    }

    // Retrieve the head office store details
    public function get_head_office()
    {
        return $this->db->where('isDeleted', 0)->where('head_office', 1)->get($this->tbl_store)->result();
    }

    // Insert a form into a specified table
    public function insert_form_by_table($table, $data)
    {
        $this->db->trans_start();
        $this->db->insert($table, $data);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }

    // Update form data by record ID and table name
    public function update_form_data($record_id, $table_name, $data)
    {
        $this->db->where('id', $record_id);
        return $this->db->update($table_name, $data);
    }

    // Check if a non-budget record exists for a given store, table, and month-year
    public function check_record_exists($store_id, $table_name, $month_year)
    {
        $query = $this->db->where('isDeleted', 0)->where('is_budget', 0)->where('store_id', $store_id)->where('month_year', $month_year)->get($table_name);
        return $query->num_rows() > 0 ? $query->result() : false;
    }

    // Check if a budget record exists for a given store, table, and month-year
    public function check_budget_record_exists($store_id, $table_name, $month_year)
    {
        $query = $this->db->where('isDeleted', 0)->where('is_budget', 1)->where('store_id', $store_id)->where('month_year', $month_year)->get($table_name);
        return $query->num_rows() > 0 ? $query->result() : false;
    }

    // Get data for chart generation by table name, store ID, and month-year
    public function get_data_chart_by($table_name, $store_id, $month_year, $is_budget, $head_office_id = '')
    {
        $user_id = $this->session->userdata('adminId');
        $fields = array_diff($this->db->list_fields($table_name), ['id', 'store_id', 'month_year', 'addedBy', 'isDeleted', 'createdOn', 'is_budget']);
        $fields_sum = array_map(fn($field) => "SUM($field) as $field", $fields);
        $fields_string = implode(',', $fields_sum);

        $store_sql = $store_id != 'all' ? "store_id = $store_id AND" : ($head_office_id ? "store_id != $head_office_id AND" : "");
        $admin_sql = $this->isSuperAdmin() ? "" : "AND addedBy = $user_id";

        $query = $this->db->query("SELECT $fields_string FROM $table_name WHERE isDeleted = 0 AND $store_sql is_budget = $is_budget AND month_year REGEXP CONCAT('(^|,)(', REPLACE('$month_year', ',', '|'), ')(,|$)') $admin_sql");

        return $query->num_rows() > 0 ? $query->result() : false;
    }

    // Get the last month data for given table name
    public function get_last_month_by($table_name, $store_id, $start_date, $end_date, $is_budget, $head_office_id = '')
    {
        $fields = array_diff($this->db->list_fields($table_name), ['id', 'store_id', 'month_year', 'addedBy', 'isDeleted', 'createdOn', 'is_budget']);
        $fields_string = implode(',', $fields);

        $store_sql = $store_id != 'all' ? "store_id = $store_id AND" : ($head_office_id ? "store_id != $head_office_id AND" : "");
        $admin_sql = $this->isSuperAdmin() ? "" : "AND addedBy = $this->session->userdata('adminId')";

        $query = $this->db->query("SELECT $fields_string FROM $table_name WHERE isDeleted = 0 AND $store_sql is_budget = $is_budget AND month_year BETWEEN '$start_date' AND '$end_date' ORDER BY id DESC LIMIT 1");

        return $query->num_rows() > 0 ? $query->result() : false;
    }

    // Get the last month data for all sites 
    public function get_last_month_by_all_site($table_name, $store_id, $start_date, $end_date, $is_budget, $head_office_id = '')
    {
        $fields = array_diff($this->db->list_fields($table_name), ['id', 'store_id', 'month_year', 'addedBy', 'isDeleted', 'createdOn', 'is_budget']);
        $fields_sum = array_fill_keys($fields, 0);

        if ($store_id == 'all') {
            $store_details = $this->get_all_store_details();
            foreach ($store_details as $store) {
                $record = $this->get_last_month_by($table_name, $store->store_id, $start_date, $end_date, $is_budget, $head_office_id)[0];
                if ($record) {
                    foreach ($fields as $field) {
                        $fields_sum[$field] += $record->$field;
                    }
                }
            }
        } else {
            $record = $this->get_last_month_by($table_name, $store_id, $start_date, $end_date, $is_budget, $head_office_id)[0];
            if ($record) {
                foreach ($fields as $field) {
                    $fields_sum[$field] = $record->$field;
                }
            }
        }

        return $fields_sum;
    }

    // Get target data for chart generation
    public function get_target_chart_by($table_name, $store_id, $month_year, $head_office_id = '')
    {
        $user_id = $this->session->userdata('adminId');
        $fields = array_diff($this->db->list_fields($table_name), ['id', 'store_id', 'month_year', 'addedBy', 'isDeleted', 'createdOn', 'is_budget']);
        $fields_string = implode(',', $fields);

        $store_sql = $store_id != 'all' ? "store_id = $store_id AND" : ($head_office_id ? "store_id != $head_office_id AND" : "");
        $admin_sql = $this->isSuperAdmin() ? "" : "AND addedBy = $user_id";

        $query = $this->db->query("SELECT $fields_string FROM $table_name WHERE isDeleted = 0 AND $store_sql is_budget = 1 AND month_year REGEXP CONCAT('(^|,)(', REPLACE('$month_year', ',', '|'), ')(,|$)') $admin_sql");

        return $query->num_rows() > 0 ? $query->result() : false;
    }

    public function check_budget_record_exists_prev($store_id, $table_name, $month_year)
    {
        $query = $this->db->where('isDeleted', 0)->where('is_budget', 1)->where('store_id', $store_id)->where('month_year', $month_year)->get($table_name);
        return $query->num_rows() > 0 ? $query->result() : false;
    }

    // Get target data for chart generation by table name, store ID, and month-year
    public function get_target_chart_by_prev($table_name, $store_id, $month_year, $head_office_id = '')
    {
        $user_id = $this->session->userdata('adminId');
        $fields = array_diff($this->db->list_fields($table_name), ['id', 'store_id', 'month_year', 'addedBy', 'isDeleted', 'createdOn', 'is_budget']);
        $fields_string = implode(',', $fields);

        $store_sql = $store_id != 'all' ? "store_id = $store_id AND" : ($head_office_id ? "store_id != $head_office_id AND" : "");
        $admin_sql = $this->isSuperAdmin() ? "" : "AND addedBy = $user_id";

        $query = $this->db->query("SELECT $fields_string FROM $table_name WHERE isDeleted = 0 AND $store_sql is_budget = 1 AND month_year = '$month_year' $admin_sql");

        return $query->num_rows() > 0 ? $query->result() : false;
    }

    // Retrieve all outreach details that are not deleted
    public function get_all_outreach_details()
    {
        return $this->db->where('isDeleted', 0)->get($this->tbl_outreach)->result();
    }

    // Retrieve outreach details by outreach ID
    public function get_outreach_by_id($outreach_id)
    {
        return $this->db->where('isDeleted', 0)->where('outreach_id', $outreach_id)->get($this->tbl_outreach)->result();
    }

    // Insert a new outreach into the outreach table
    public function insert_outreach($data)
    {
        $this->db->trans_start();
        $this->db->insert($this->tbl_outreach, $data);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }

    // Update outreach data
    public function update_outreach($outreach_id, $data)
    {
        $this->db->where('outreach_id', $outreach_id);
        return $this->db->update($this->tbl_outreach, $data);
    }
}
?>
