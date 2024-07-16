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

    public function insert_users($data)
    {
        $this->db->trans_start();
        $this->db->insert($this->users, $data);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }

    public function get_all_users()
    {
        $this->db->where('isDeleted', 0);
        return $this->db->get($this->users)->result();
    }

    public function update_users($user_id, $data)
    {
        $this->db->where('user_id', $user_id);
        return $this->db->update($this->users, $data);
    }

    public function get_admin_data($email)
    {
        $this->db->where('email', $email);
        $this->db->where('isDeleted', 0);
        return $this->db->get($this->users)->result();
    }

    public function verify_email($email)
    {
        $this->db->where('email', $email);
        $this->db->where('isDeleted', 0);
        return $this->db->get($this->users)->num_rows() > 0;
    }

    public function check_by_head_office($store_id)
    {
        $this->db->where('store_id', $store_id);
        $this->db->where('head_office', 1);
        $this->db->where('isDeleted', 0);
        return $this->db->get($this->tbl_store)->num_rows() > 0;
    }

    public function get_user_details_by_id($user_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->where('isDeleted', 0);
        $query = $this->db->get($this->users);
        return $query->num_rows() > 0 ? $query->result() : false;
    }

    public function update_user_by_email($email, $data)
    {
        $this->db->where('email', $email);
        return $this->db->update($this->users, $data);
    }

    public function get_all_store_details()
    {
        $userid = $this->session->userdata('adminId');
        if (isSuperAdmin()) {
            return $this->db->where('isDeleted', 0)->get($this->tbl_store)->result();
        } else {
            $site_assigned = $this->get_user_details_by_id($userid)[0]->site_assigned;
            return $this->db->where("store_id REGEXP CONCAT('(^|,)(', REPLACE('$site_assigned', ',', '|'), ')(,|$)') AND isDeleted=0")->get($this->tbl_store)->result();
        }
    }

    public function insert_store($data)
    {
        $this->db->trans_start();
        $this->db->insert($this->tbl_store, $data);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }

    public function update_store($store_id, $data)
    {
        $this->db->where('store_id', $store_id);
        return $this->db->update($this->tbl_store, $data);
    }

    public function update_head_office()
    {
        return $this->db->update('store', ['head_office' => 0], ['1' => 1]);
    }

    public function get_all_form_data()
    {
        $userid = $this->session->userdata('adminId');
        $query = $this->db->select("store_id, month_year, id as fromid, 'hr_kpi', 'HR_KPI'")->from('hr_kpi')->where('isDeleted', 0)->where('is_budget', 0);

        if (!isSuperAdmin()) {
            $query->where('addedBy', $userid);
        }

        $result = $query->get()->result();
        return $result;
    }

    public function load_data_by_table_name($table_id, $table_name)
    {
        return $this->db->where('isDeleted', 0)->where('is_budget', 0)->where('id', $table_id)->get($table_name)->result();
    }

    public function get_head_office()
    {
        return $this->db->where('isDeleted', 0)->where('head_office', 1)->get($this->tbl_store)->result();
    }

    public function insert_form_by_table($table, $data)
    {
        $this->db->trans_start();
        $this->db->insert($table, $data);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }

    public function update_form_data($record_id, $table_name, $data)
    {
        $this->db->where('id', $record_id);
        return $this->db->update($table_name, $data);
    }

    public function check_record_exists($store_id, $table_name, $month_year)
    {
        $query = $this->db->where('isDeleted', 0)->where('is_budget', 0)->where('store_id', $store_id)->where('month_year', $month_year)->get($table_name);
        return $query->num_rows() > 0 ? $query->result() : false;
    }

    public function check_budget_record_exists($store_id, $table_name, $month_year)
    {
        $query = $this->db->where('isDeleted', 0)->where('is_budget', 1)->where('store_id', $store_id)->where('month_year', $month_year)->get($table_name);
        return $query->num_rows() > 0 ? $query->result() : false;
    }

    public function get_data_chart_by($table_name, $store_id, $month_year, $is_budget, $head_office_id = '')
    {
        $user_id = $this->session->userdata('adminId');
        $fields = array_diff($this->db->list_fields($table_name), ['id', 'store_id', 'month_year', 'addedBy', 'isDeleted', 'createdOn', 'is_budget']);
        $fields_sum = array_map(fn($field) => "SUM($field) as $field", $fields);
        $fields_string = implode(',', $fields_sum);

        $store_sql = $store_id != 'all' ? "store_id = $store_id AND" : ($head_office_id ? "store_id != $head_office_id AND" : "");
        $admin_sql = isSuperAdmin() ? "" : "AND addedBy = $user_id";

        $query = $this->db->query("SELECT $fields_string FROM $table_name WHERE isDeleted = 0 AND $store_sql is_budget = $is_budget AND month_year REGEXP CONCAT('(^|,)(', REPLACE('$month_year', ',', '|'), ')(,|$)') $admin_sql");

        return $query->num_rows() > 0 ? $query->result() : false;
    }

    public function get_last_month_by($table_name, $store_id, $start_date, $end_date, $is_budget, $head_office_id = '')
    {
        $fields = array_diff($this->db->list_fields($table_name), ['id', 'store_id', 'month_year', 'addedBy', 'isDeleted', 'createdOn', 'is_budget']);
        $fields_string = implode(',', $fields);

        $store_sql = $store_id != 'all' ? "store_id = $store_id AND" : ($head_office_id ? "store_id != $head_office_id AND" : "");
        $admin_sql = isSuperAdmin() ? "" : "AND addedBy = $this->session->userdata('adminId')";

        $query = $this->db->query("SELECT $fields_string FROM $table_name WHERE isDeleted = 0 AND $store_sql is_budget = $is_budget AND month_year BETWEEN '$start_date' AND '$end_date' ORDER BY id DESC LIMIT 1");

        return $query->num_rows() > 0 ? $query->result() : false;
    }

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

    public function get_target_chart_by($table_name, $store_id, $month_year, $head_office_id = '')
    {
        $user_id = $this->session->userdata('adminId');
        $fields = array_diff($this->db->list_fields($table_name), ['id', 'store_id', 'month_year', 'addedBy', 'isDeleted', 'createdOn', 'is_budget']);
        $fields_string = implode(',', $fields);

        $store_sql = $store_id != 'all' ? "store_id = $store_id AND" : ($head_office_id ? "store_id != $head_office_id AND" : "");
        $admin_sql = isSuperAdmin() ? "" : "AND addedBy = $user_id";

        $query = $this->db->query("SELECT $fields_string FROM $table_name WHERE isDeleted = 0 AND $store_sql is_budget = 1 AND month_year REGEXP CONCAT('(^|,)(', REPLACE('$month_year', ',', '|'), ')(,|$)') $admin_sql");

        return $query->num_rows() > 0 ? $query->result() : false;
    }

    public function check_budget_record_exists_prev($store_id, $table_name, $month_year)
    {
        $query = $this->db->where('isDeleted', 0)->where('is_budget', 1)->where('store_id', $store_id)->where('month_year', $month_year)->get($table_name);
        return $query->num_rows() > 0 ? $query->result() : false;
    }

    public function get_target_chart_by_prev($table_name, $store_id, $month_year, $head_office_id = '')
    {
        $user_id = $this->session->userdata('adminId');
        $fields = array_diff($this->db->list_fields($table_name), ['id', 'store_id', 'month_year', 'addedBy', 'isDeleted', 'createdOn', 'is_budget']);
        $fields_string = implode(',', $fields);

        $store_sql = $store_id != 'all' ? "store_id = $store_id AND" : ($head_office_id ? "store_id != $head_office_id AND" : "");
        $admin_sql = isSuperAdmin() ? "" : "AND addedBy = $user_id";

        $query = $this->db->query("SELECT $fields_string FROM $table_name WHERE isDeleted = 0 AND $store_sql is_budget = 1 AND month_year = '$month_year' $admin_sql");

        return $query->num_rows() > 0 ? $query->result() : false;
    }

    public function get_all_outreach_details()
    {
        return $this->db->where('isDeleted', 0)->get($this->tbl_outreach)->result();
    }

    public function get_outreach_by_id($outreach_id)
    {
        return $this->db->where('isDeleted', 0)->where('outreach_id', $outreach_id)->get($this->tbl_outreach)->result();
    }

    public function insert_outreach($data)
    {
        $this->db->trans_start();
        $this->db->insert($this->tbl_outreach, $data);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }

    public function update_outreach($outreach_id, $data)
    {
        $this->db->where('outreach_id', $outreach_id);
        return $this->db->update($this->tbl_outreach, $data);
    }
}
?>
