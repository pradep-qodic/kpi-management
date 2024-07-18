<?php
ini_set('memory_limit', '1024M');
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . "/third_party/PHPExcel/Classes/PHPExcel.php"; // Load third_party library

class Admins extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
        $this->load->helper('admin_vehicle_helper');
        $this->load->library(['admin_vts_auth', 'form_validation', 'session']);
    }

    /**
     * Display the sign-in page.
     */
    public function index()
    {
        $this->loadView('Signin', 'admins/signin');
    }

    /**
     * Handle sign-in requests.
     */
    public function signin()
    {
        if ($this->input->is_ajax_request()) {
            $this->processSignIn();
        } else {
            $this->loadView('Signin', 'admins/signin');
        }
    }

    /**
     * Process the sign-in form submission.
     */
    private function processSignIn()
    {
        $config = [
            ['field' => 'email', 'label' => 'E-mail', 'rules' => 'trim|required|valid_email'],
            ['field' => 'password', 'label' => 'Password', 'rules' => 'trim|required']
        ];
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() === false) {
            $this->sendErrorResponse(validation_errors());
        } else {
            $this->attemptLogin();
        }
    }

    /**
     * Attempt to log in the user with the provided email and password.
     */
    private function attemptLogin()
    {
        $admin_email = $this->input->post('email', true);
        $password = $this->input->post('password', true);
        $res = $this->admin_vts_auth->process_login([$admin_email, $password]);
        $this->load->view('json_view', $res);
    }

    /**
     * @param string $errors The validation errors.
     */
    private function sendErrorResponse($errors)
    {
        $this->form_validation->set_error_delimiters(' ', ' ');
        $data['json'] = json_encode(["status" => "error", "message" => [$errors]]);
        $this->load->view('json_view', $data);
    }

    /**
     * Display the admin dashboard.
     */
    public function dashboard()
    {
        $this->admin_vts_auth->_member_area_redirect();
        $data['getStore'] = $this->admin_model->Get_all_store_details();
        $this->loadView('Home', 'admins/dashboard', $data);
    }

    /**
     * Display the data management page.
     */
    public function datamanagement()
    {
        $this->admin_vts_auth->_member_area_redirect();
        $data['getStore'] = $this->admin_model->Get_all_store_details();
        $data['getallfrom'] = $this->admin_model->getallFromdata();
        $this->loadView('Data Management', 'admins/datamanagement', $data);
    }

    /**
     * Display the KPI management page for super admins.
     * Redirect to the 404 page if the user is not a super admin.
     */
    public function kpi()
    {
        if ($this->isSuperAdmin()) {
            $this->admin_vts_auth->_member_area_redirect();
            $data['getStore'] = $this->admin_model->Get_all_store_details();
            $this->loadView('KPI', 'admins/kpimanagement', $data);
        } else {
            redirect('admins/page_not_found');
        }
    }

    /**
     * Generate and return chart data based on the provided parameters.
     */
    public function getChartsPage()
    {
        if ($this->input->is_ajax_request()) {
            $chartParams = $this->getChartParams();
            $monthYear = $this->getMonthYear($chartParams);
            $chartMonth = $this->getChartMonth($chartParams, $monthYear);

            $data = $this->prepareChartData($chartParams, $monthYear, $chartMonth);
            $this->load->view('json_view', $data);
        }
    }

    /**
     * Retrieve chart parameters from the POST request.
     * 
     * @return array The chart parameters.
     */
    private function getChartParams()
    {
        return [
            'chartname' => $this->input->post('chartname', true),
            'site_id' => $this->input->post('site_id', true),
            'select_type' => $this->input->post('select_type', true),
            'select_year' => $this->input->post('select_year', true),
            'select_month' => $this->input->post('select_month', true),
            'display' => $this->input->post('display', true)
        ];
    }

    /**
     * Calculate the month-year combinations based on the provided parameters.
     * 
     * @param array $params The chart parameters.
     * @return array The month-year combinations.
     */
    private function getMonthYear($params)
    {
        $monthYear = [];
        $financialStart = '07';
        $financialEnd = '06';
        $selectedMonth = $params['select_month'];
        $selectedYears = $params['select_year'];

        if (count($selectedMonth) == 2) {
            $selectedYtd = $selectedMonth[1];
            $selectedMonth = $selectedMonth[0];
        } else {
            $selectedYtd = '';
            $selectedMonth = $selectedMonth[0];
        }

        if ($selectedYtd == 'ytd' && $selectedMonth) {
            $monthYear = $this->getFinancialYearMonths($selectedYears, $selectedMonth);
        } elseif ($selectedMonth == 'ytd') {
            $monthYear = $this->getFullFinancialYears($selectedYears, $financialStart, $financialEnd);
        } else {
            foreach ($selectedYears as $year) {
                $monthYear[] = ($selectedMonth <= 6) ? ($year + 1) . '-' . $selectedMonth : $year . '-' . $selectedMonth;
            }
        }

        return array_unique($monthYear);
    }

    /**
     * Calculate the months for the specified financial year range.
     * 
     * @param array $years The years.
     * @param string $month The month.
     * @return array The months in the financial year range.
     */
    private function getFinancialYearMonths($years, $month)
    {
        $months = [];
        $financialStart = '07';
        $financialEnd = $month;
        $dates = new DateTime('now');
        $currentYear = $dates->format('Y');

        if ($financialEnd <= 06) {
            for ($i = $financialStart; $i <= 12; $i++) {
                $months[] = $i;
            }
            for ($i = 1; $i <= $financialEnd; $i++) {
                $months[] = $i;
            }
        } else {
            for ($i = $financialStart; $i <= $financialEnd; $i++) {
                $months[] = $i;
            }
        }

        $monthYear = [];
        foreach ($years as $year) {
            foreach ($months as $month) {
                $yearMonth = ($month <= 6) ? ($year + 1) . '-' . $month : $year . '-' . $month;
                $monthYear[] = date('Y-m', strtotime($yearMonth));
            }
        }

        return array_unique($monthYear);
    }

    /**
     * Get the full financial years for the specified year range.
     * 
     * @param array $years The years.
     * @param string $financialStart The start month of the financial year.
     * @param string $financialEnd The end month of the financial year.
     * @return array The full financial years.
     */
    private function getFullFinancialYears($years, $financialStart, $financialEnd)
    {
        $monthYear = [];
        foreach ($years as $year) {
            $startMonth = date('Y-m', strtotime($year . '-' . $financialStart . '-01'));
            $startDate = date('Y-m-d', strtotime($year . '-' . $financialStart . '-01'));
            $endDate = date('Y-m-d', strtotime(($year + 1) . '-' . $financialEnd . '-30'));

            $monthYear[] = $startMonth;
            while (strtotime($startDate) <= strtotime($endDate)) {
                $startDate = date('Y-m', strtotime("+1 month", strtotime($startDate)));
                $monthYear[] = $startDate;
            }
        }
        return array_unique($monthYear);
    }

    /**
     * Calculate the chart months based on the provided parameters.
     * 
     * @param array $params The chart parameters.
     * @param array $monthYear The month-year combinations.
     * @return array The chart months.
     */
    private function getChartMonth($params, $monthYear)
    {
        $chartMonth = [];
        if ($params['select_year']) {
            if ($params['select_month'] != 'ytd') {
                $chartMonth = $this->getSpecificChartMonths($params['select_year'], $params['select_month']);
            } else {
                foreach ($params['select_year'] as $year) {
                    $chartMonth = array_merge($chartMonth, $this->getFullFinancialYears([$year], '07', '06'));
                }
            }
            $chartMonth = array_unique($chartMonth);
        }
        return $chartMonth;
    }

    /**
     * Get the specific chart months for the specified year and month.
     * 
     * @param array $years The years.
     * @param string $month The month.
     * @return array The specific chart months.
     */
    private function getSpecificChartMonths($years, $month)
    {
        $chartMonth = [];
        foreach ($years as $year) {
            if ($month <= 6) {
                $incDate = ($year + 1) . '-' . $month;
            } else {
                $incDate = $year . '-' . $month;
            }
            $chartMonth[] = date("Y-m", strtotime($incDate));

            for ($i = 1; $i <= 3; $i++) {
                $chartMonth[] = date("Y-m", strtotime("-$i month", strtotime($incDate)));
                $chartMonth[] = date("Y-m", strtotime("+$i month", strtotime($incDate)));
            }
        }
        return $chartMonth;
    }

    /**
     * Prepare the chart data based on the provided parameters, month-year combinations, and chart months.
     * 
     * @param array $params The chart parameters.
     * @param array $monthYear The month-year combinations.
     * @param array $chartMonth The chart months.
     * @return array The prepared chart data.
     */
    private function prepareChartData($params, $monthYear, $chartMonth)
    {
        $data = [];
        if ($params['display']) {
            $data['chartdata'] = $this->getChartData($params['chartname'], $params['site_id'], $chartMonth);
        }

        $data['headoffice'] = $params['site_id'] == 'all' ? true : $this->admin_model->Check_By_HeadeOffice($params['site_id']);
        $data['mange_data'] = $this->admin_model->get_data_chartBy($params['chartname'], $params['site_id'], implode(',', $monthYear), 2, 3);

        $data['manage_vehicle'] = [
            'query_kpi' => $data['mange_data'][0]->query_kpi,
            'amount' => $data['mange_data'][0]->amount,
            'finalAmount' => $data['mange_data'][0]->finalAmount
        ];

        return $data;
    }

    /**
     * Retrieve the chart data for the specified chart name, site ID, and chart months.
     * 
     * @param string $chartName The chart name.
     * @param string $siteId The site ID.
     * @param array $chartMonth The chart months.
     * @return array The chart data.
     */
    private function getChartData($chartName, $siteId, $chartMonth)
    {
        $chartData = [];
        $chartMonth = array_unique($chartMonth);
        $months = implode(",", $chartMonth);

        foreach ($chartMonth as $month) {
            $chartData[$month] = $this->admin_model->get_chart_data_by_name($chartName, $siteId, $month);
        }

        return $chartData;
    }

    /**
     * Log out the user and destroy the session.
     */
    public function logout()
    {
        $this->session->unset_userdata(['user_id', 'username', 'is_admin']);
        $this->session->sess_destroy();
        redirect('admins');
    }

    /**
     * Load a view with the specified title and data.
     * @param string $title The title of the view.
     * @param string $view The view file.
     * @param array $data The data to pass to the view.
     */
    private function loadView($title, $view, $data = [])
    {
        $data['title'] = $title;
        $this->load->view('templates/admin_header', $data);
        $this->load->view($view, $data);
        $this->load->view('templates/admin_footer');
    }

    /**
     * Check if the current user is a super admin.
     * @return bool True if the user is a super admin, false otherwise.
     */
    private function isSuperAdmin()
    {
        return $this->session->userdata('admin_group') === 'super_admin';
    }
}
