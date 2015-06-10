<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Business extends MX_Controller
{

    public function __construct()
    {
        $this->load->model("supper_admin");
        $this->load->helper('my_helper');
    }

    public function index()
    {
        $this->login_check();

        $this->load->view('layout/header');
        $this->load->view('business/index');
        $this->load->view('layout/footer');
    }


    public function dashboard()
    {
        $this->login_check();
        $this->load->view('layout/header');
        $this->load->view('layout/footer');
    }


    public function login_check()
    {
        $data = checklogin();
        if ($data['a_SysAdminId'] != 33) {
            $baseURl = base_url();
            //redirect($baseURl);
            redirect($baseURl . 'ssa/admin/');
            exit();
        }
    }

    public function state()
    {
        $countryId = $this->input->post('countryId');
        // api call
        $parameter = array('id' => $countryId);
        $path = base_url() . 'api/super_state_admin/states/format/json/';
        $response = curlcall($parameter, $path);
        if ($response == "No Result Found") {
            echo "0";
        } else {
            echo json_encode($response);
        }
    }

    public function city()
    {
        $stateId = $this->input->post('stateId');
        // api call
        $parameter = array('n_StateId' => $stateId);
        $path = base_url() . 'api/super_state_admin/city/format/json/';
        $response = curlcall($parameter, $path);
        if ($response == "No Result Found") {
            echo "0";
        } else {
            echo json_encode($response);
        }
    }

    function logout()
    {
        session_unset();
        $redirect_url = base_url();
        $this->session->sess_destroy();
        redirect($redirect_url);
        exit();
    }

    public function business_add()
    {
        /*2nd fase by rahul yadav  13/12/2014   First Login check*/
        $userid = $this->session->userdata['sessionData']['a_SId'];
        $parameter = array('act_mode' => 'systeadmin', 'userid' => $userid);
        $path = base_url() . 'api/createbusinessadmin/firstloginpasschange/format/json/';
        $firstlogin = curlcall($parameter, $path);
        if ($firstlogin->fpasschange == 0) {
            redirect($base_url . 'ssa/superadmin/resetpass');
            exit();
        }
        if ($firstlogin->fpasschange == 2) {
            redirect($base_url . 'ssa/superadmin/resetpass');
            exit();
        }
        if ($firstlogin->fpasschange == 3) {
            redirect($base_url . 'ssa/superadmin/profile');
            exit();
        }

        $this->login_check();

        if (isset($_POST['submit']) && $_POST['submit'] == 'Create Business') {

            $this->form_validation->set_rules('t_BusinessName', 'Business Name ', 'trim|required|min_length[1]|max_length[255]|xss_clean');
            $this->form_validation->set_rules('n_Status', 'Status Open', 'trim|required|min_length[1]|max_length[255]|xss_clean');
            $this->form_validation->set_rules('businessAddress', 'Business Address', 'trim|required|min_length[1]|max_length[255]|xss_clean');
            //$this->form_validation->set_rules('businessAddress2', 'Business Address2', 'trim|required|min_length[5]|max_length[255]|xss_clean');
            $this->form_validation->set_rules('n_CountryId_1', 'Business Country', 'trim|required|max_length[10]|xss_clean');
            $this->form_validation->set_rules('n_StateId_1', 'Business State', 'trim|required|max_length[10]|xss_clean');
            $this->form_validation->set_rules('n_City_1', 'Business City', 'trim|required|max_length[10]|xss_clean');
            //$this->form_validation->set_rules('n_UserCount', 'Business Employee', 'trim|required|min_length[1]|max_length[255]|is_natural|xss_clean');
            //$this->form_validation->set_rules('d_StartDate', 'business Start Date', 'trim|required|min_length[5]|max_length[255]|xss_clean');
            //$this->form_validation->set_rules('d_EndDate', 'business End Date', 'trim|required|min_length[5]|max_length[255]|xss_clean');
            $this->form_validation->set_rules('n_CurrencyId', 'Business Currency', 'trim|required|min_length[1]|max_length[50]|xss_clean');
            $this->form_validation->set_rules('b_ExpOtherCtry', 'Expenses in other currency', 'trim|required|min_length[1]|max_length[255]|xss_clean');
            $this->form_validation->set_rules('n_Distance', 'Distance Measure', 'trim|required|min_length[1]|max_length[15]|xss_clean');
            $this->form_validation->set_rules('t_DateFormat', 'Business Date Format', 'trim|required|max_length[50]|xss_clean');
            /*Applicant Information*/
            $this->form_validation->set_rules('appFirstName', 'Applicant First Name', 'trim|required|min_length[2]|max_length[255]|xss_clean|alpha');
            //$this->form_validation->set_rules('appLastName', 'Applicant Last Name', 'trim|required|min_length[5]|max_length[255]|xss_clean');
            $this->form_validation->set_rules('appAddress1', 'Applicant Address', 'trim|required|min_length[5]|max_length[255]|xss_clean');
            //$this->form_validation->set_rules('appAddress2', 'Applicant Address 2', 'trim|required|min_length[5]|max_length[255]|xss_clean');
            $this->form_validation->set_rules('n_CountryId_2', 'Applicant Country', 'trim|required|max_length[10]|xss_clean');
            $this->form_validation->set_rules('n_StateId_2', 'Applicant State', 'trim|required|max_length[10]|xss_clean');
            $this->form_validation->set_rules('n_City_2', 'Applicant City', 'trim|required|max_length[10]|xss_clean');
            //$this->form_validation->set_rules('appPhone', 'Applicant Phone', 'trim|required|min_length[10]|max_length[15]|xss_clean|numeric');
            $this->form_validation->set_rules('uniquermail', 'Applicant Email Unique', 'trim|required|min_length[1]|max_length[255]|xss_clean');
            $this->form_validation->set_rules('appEmail', 'Applicant Email', 'trim|required|min_length[5]|max_length[255]|xss_clean');
            $this->form_validation->set_rules('appDob', 'Applicant Dob', 'trim|required|min_length[5]|max_length[255]|xss_clean');
            //$this->form_validation->set_rules('appCompanyPosition', 'Applicant Company Position', 'trim|required|min_length[1]|max_length[255]|xss_clean');
            /* End   Applicant Information*/
            /*Billing Information*/
            $this->form_validation->set_rules('n_BillingType', 'Billing Type', 'trim|required|min_length[1]|max_length[255]|xss_clean');
            $this->form_validation->set_rules('t_BillingContact', 'Billing Contact', 'trim|required|xss_clean');
            $this->form_validation->set_rules('BillingEmail', 'Email Address', 'trim|required|min_length[5]|max_length[255]|xss_clean');
            $this->form_validation->set_rules('BillingPackage', 'Package', 'trim|required|min_length[1]|max_length[255]|xss_clean');
            $this->form_validation->set_rules('BullingAddress', 'Bulling Address Line1', 'trim|required|min_length[5]|max_length[255]|xss_clean');
            //$this->form_validation->set_rules('BillingAddress2', 'Bulling Address Line1', 'trim|required|min_length[5]|max_length[255]|xss_clean');
            $this->form_validation->set_rules('n_CountryId_3', 'Billing Country', 'trim|required|min_length[1]|max_length[255]|xss_clean');
            $this->form_validation->set_rules('n_StateId_3', 'Billing state', 'trim|required|min_length[1]|max_length[255]|xss_clean');
            $this->form_validation->set_rules('n_City_3', 'Billing City', 'trim|required|min_length[1]|max_length[255]|xss_clean');
            /*End Information*/

            if ($this->form_validation->run() != FALSE) {
                $adminfname = $this->session->userdata['sessionData']['firstName'];    // rahul yadav 9 nov 2014
                $adminlname = $this->session->userdata['sessionData']['lastName'];
                $admin_mail = $this->session->userdata['sessionData']['t_username'];
                $adminid = $this->session->userdata['sessionData']['a_SId'];
                //  $AdminType= $this->session->userdata['sessionData']['a_SysAdminId'];

                // echo $stdate;
                $parameter = array(
                    'businessName' => $this->input->post('t_BusinessName'),
                    'Status' => $this->input->post('n_Status'),
                    'businessAddress' => $this->input->post('businessAddress'),
                    'businessAddress2' => $this->input->post('businessAddress2'),
                    'businessCountry' => $this->input->post('n_CountryId_1'),
                    'businessState' => $this->input->post('n_StateId_1'),
                    'businessCity' => $this->input->post('n_City_1'),
                    'businessEmployee' => $this->input->post('n_UserCount'),
                    'businessStartDate' => date('Y-m-d', strtotime($this->input->post('d_StartDate'))),
                    'businessEndDate' => date('Y-m-d', strtotime($this->input->post('d_EndDate'))),/*,$this->input->post('d_EndDate'),*/
                    'businessCurrency' => $this->input->post('n_CurrencyId'),
                    'expensesothercurrency' => $this->input->post('b_ExpOtherCtry'),
                    'distancemeasure' => $this->input->post('n_Distance'),
                    'businessDateFormat' => $this->input->post('t_DateFormat'),
                    'appFirstName' => $this->input->post('appFirstName'),
                    'appLastName' => $this->input->post('appLastName'),
                    'appAddress1' => $this->input->post('appAddress1'),
                    'appAddress2' => $this->input->post('appAddress2'),
                    'appCountry' => $this->input->post('n_CountryId_2'),
                    'appState' => $this->input->post('n_StateId_2'),
                    'appCity' => $this->input->post('n_City_2'),
                    'appPhone' => $this->input->post('appPhone'),
                    'appEmail' => $this->input->post('appEmail'),
                    'appDob' => date('Y-m-d', strtotime($this->input->post('appDob'))),/*$this->input->post('appDob'),*/
                    'appCompanyPosition' => $this->input->post('appCompanyPosition'),
                    'businessBillingType' => $this->input->post('n_BillingType'),
                    'businessBillingContact' => $this->input->post('t_BillingContact'),
                    'businessBillingEmail' => $this->input->post('BillingEmail'),
                    'businessBillingPackage' => $this->input->post('BillingPackage'),
                    'businessBillingAddress' => $this->input->post('BullingAddress'),
                    'businessBillingAddress2' => $this->input->post('BillingAddress2'),
                    'businessBillingCountryId' => $this->input->post('n_CountryId_3'),
                    'businessBillingStateId' => $this->input->post('n_StateId_3'),
                    'businessBillingCityId' => $this->input->post('n_City_3'),
                    'adminemail' => $admin_mail,
                    'createdby' => $adminid,
                    'adminfname' => $adminfname,      // send main admin name     ecit by rahul yadav 9  dec 2014
                    'adminlname' => $adminlname

                );
                //P($parameter);
                //exit();

                $path = base_url() . 'api/createbusinessadmin/businessregister/format/json/';
                $response = curlcall($parameter, $path);
                //P($response);
                //exit();
                if ($response == 'Something Went Wrong') {
                    $this->session->set_flashdata('message', 'Record Not updated Successfully');
                    $base_url = base_url();
                    redirect($base_url . 'ssa/business/business_list' . $stateId);
                    exit();

                } else {
                    $this->session->set_flashdata('message', 'Business Created Successfully');
                    $base_url = base_url();
                    redirect($base_url . 'ssa/business/business_list');
                    exit();
                }
            }
        }
        $this->load->view('layout/header');
        $parameter = array('act_mode' => 'all', 'business_name' => '', 'p_ststus' => '', 'p_bullingtype' => '');
        $path = base_url() . 'api/createbusinessadmin/searchbusinessall/format/json/';
        $response['bname'] = curlcall($parameter, $path);
        $this->load->view('business/business', $response);
    }

    public function business_edit()
    {
        $this->login_check();
        $userId = checklogin();
        $this->load->view('layout/header');
        if (isset($_POST['submit'])) {

            $this->form_validation->set_rules('t_BusinessName', 'Business Name', 'trim|required|min_length[5]|max_length[255]|xss_clean');
            $this->form_validation->set_rules('n_Status', 'Status Open', 'trim|required|min_length[1]|max_length[255]|xss_clean');
            $this->form_validation->set_rules('businessAddress', 'Business Address', 'trim|required|min_length[5]|max_length[255]|xss_clean');
            //$this->form_validation->set_rules('businessAddress2', 'Business Address2', 'trim|required|min_length[5]|max_length[255]|xss_clean');
            $this->form_validation->set_rules('n_CountryId_1', 'Business Country', 'trim|required|max_length[10]|xss_clean');
            $this->form_validation->set_rules('n_StateId_1', 'Business State', 'trim|required|max_length[10]|xss_clean');
            $this->form_validation->set_rules('n_City_1', 'Business City', 'trim|required|max_length[10]|xss_clean');
            $this->form_validation->set_rules('n_UserCount', 'Business Employee', 'trim|required|min_length[1]|max_length[255]|is_natural|xss_clean');
            //	$this->form_validation->set_rules('d_StartDate', 'business Start Date', 'trim|required|max_length[255]|xss_clean');
            //	$this->form_validation->set_rules('d_EndDate', 'business End Date', 'trim|required|max_length[255]|xss_clean');
            $this->form_validation->set_rules('n_CurrencyId', 'Business Currency', 'trim|required|min_length[1]|max_length[50]|xss_clean');
            $this->form_validation->set_rules('b_ExpOtherCtry', 'Expenses in other currency', 'trim|required|min_length[1]|max_length[255]|xss_clean');
            $this->form_validation->set_rules('n_Distance', 'Distance Measure', 'trim|required|min_length[1]|max_length[15]|xss_clean');
            $this->form_validation->set_rules('t_DateFormat', 'Business Date Format', 'trim|required|max_length[50]|xss_clean');
            /*Applicant Information*/
            $this->form_validation->set_rules('appFirstName', 'Applicant First Name', 'trim|required|min_length[2]|max_length[255]|xss_clean');
            $this->form_validation->set_rules('appLastName', 'Applicant Last Name', 'trim|required|min_length[2]|max_length[255]|xss_clean');
            $this->form_validation->set_rules('appAddress1', 'Applicant Address', 'trim|required|min_length[5]|max_length[255]|xss_clean');
            //$this->form_validation->set_rules('appAddress2', 'Applicant Address 2', 'trim|required|min_length[5]|max_length[255]|xss_clean');
            $this->form_validation->set_rules('n_CountryId_2', 'Applicant Country', 'trim|required|max_length[10]|xss_clean');
            $this->form_validation->set_rules('n_StateId_2', 'Applicant State', 'trim|required|max_length[10]|xss_clean');
            $this->form_validation->set_rules('n_City_2', 'Applicant City', 'trim|required|max_length[10]|xss_clean');
            //$this->form_validation->set_rules('appPhone', 'Applicant Phone', 'trim|required|min_length[10]|max_length[11]|xss_clean|numeric');
            $this->form_validation->set_rules('appEmail', 'Applicant Email', 'trim|required|min_length[5]|max_length[255]|xss_clean');
            //$this->form_validation->set_rules('appDob', 'Applicant Dob', 'trim|required|min_length[5]|max_length[255]|xss_clean');
            //$this->form_validation->set_rules('appCompanyPosition', 'Applicant Company Position', 'trim|required|min_length[1]|max_length[255]|xss_clean');
            /* End   Applicant Information*/
            /*Billing Information*/
            $this->form_validation->set_rules('n_BillingType', 'Billing Type', 'trim|required|min_length[1]|max_length[255]|xss_clean');
            $this->form_validation->set_rules('t_BillingContact', 'Billing Contact', 'trim|required||xss_clean');
            $this->form_validation->set_rules('BillingEmail', 'Email Address', 'trim|required|min_length[5]|max_length[255]|xss_clean');
            $this->form_validation->set_rules('BillingPackage', 'Package', 'trim|required|min_length[1]|max_length[255]|xss_clean');
            $this->form_validation->set_rules('BullingAddress', 'Bulling Address Line1', 'trim|required|min_length[5]|max_length[255]|xss_clean');
            //$this->form_validation->set_rules('BillingAddress2', 'Bulling Address Line1', 'trim|required|min_length[5]|max_length[255]|xss_clean');
            $this->form_validation->set_rules('n_CountryId_3', 'Bulling Country', 'trim|required|min_length[1]|max_length[255]|xss_clean');
            $this->form_validation->set_rules('n_StateId_3', 'Bulling state', 'trim|required|min_length[1]|max_length[255]|xss_clean');
            $this->form_validation->set_rules('n_City_3', 'Bulling City', 'trim|required|min_length[1]|max_length[255]|xss_clean');

            if ($this->form_validation->run() != FALSE) {
                $parameter = array(
                    'businessId' => $this->input->post('a_BusinessId'),
                    'businessName' => $this->input->post('t_BusinessName'),
                    'Status' => $this->input->post('n_Status'),
                    'businessAddress' => $this->input->post('businessAddress'),
                    'businessAddress2' => $this->input->post('businessAddress2'),
                    'businessCountry' => $this->input->post('n_CountryId_1'),
                    'businessState' => $this->input->post('n_StateId_1'),
                    'businessCity' => $this->input->post('n_City_1'),
                    'businessEmployee' => $this->input->post('n_UserCount'),
                    'businessStartDate' => date('Y-m-d', strtotime($this->input->post('d_StartDate'))), /*$this->input->post('d_StartDate'),*/
                    'businessEndDate' => date('Y-m-d', strtotime($this->input->post('d_EndDate'))), /*$this->input->post('d_EndDate'),*/
                    'businessCurrency' => $this->input->post('n_CurrencyId'),
                    'expensesothercurrency' => $this->input->post('b_ExpOtherCtry'),
                    'distancemeasure' => $this->input->post('n_Distance'),
                    'businessDateFormat' => $this->input->post('t_DateFormat'),

                    'appFirstName' => $this->input->post('appFirstName'),
                    'appLastName' => $this->input->post('appLastName'),
                    'appAddress1' => $this->input->post('appAddress1'),
                    'appAddress2' => $this->input->post('appAddress2'),
                    'appCountry' => $this->input->post('n_CountryId_2'),
                    'appState' => $this->input->post('n_StateId_2'),
                    'appCity' => $this->input->post('n_City_2'),
                    'appPhone' => $this->input->post('appPhone'),
                    'appEmail' => $this->input->post('appEmail'),
                    'appDob' => date('Y-m-d', strtotime($this->input->post('appDob'))),
                    'appCompanyPosition' => $this->input->post('appCompanyPosition'),

                    'businessBillingType' => $this->input->post('n_BillingType'),
                    'businessBillingContact' => $this->input->post('t_BillingContact'),
                    'businessBillingEmail' => $this->input->post('BillingEmail'),
                    'businessBillingPackage' => $this->input->post('BillingPackage'),
                    'businessBillingAddress' => $this->input->post('BullingAddress'),
                    'businessBillingAddress2' => $this->input->post('BillingAddress2'),
                    'businessBillingCountryId' => $this->input->post('n_CountryId_3'),
                    'businessBillingStateId' => $this->input->post('n_StateId_3'),
                    'businessBillingCityId' => $this->input->post('n_City_3'),
                    'p_Distance' => '1'
                );

//p($parameter);
                //exit();
                $path = base_url() . 'api/createbusinessadmin/businessedit/format/json/';
                $response = curlcall($parameter, $path);
                //p($response);
                // exit();

                if ($response == 'Something Went Wrong') {
                    $this->session->set_flashdata('message', 'No Update Performed ');
                    $base_url = base_url();
                    redirect($base_url . 'ssa/business/business_list/');
                    exit();

                } else {
                    $this->session->set_flashdata('message', 'Business Information updated Successfully');
                    $base_url = base_url();
                    redirect($base_url . 'ssa/business/business_list/');
                    exit();
                }
            } // end validation

        }


        //else{
        $stateId = $this->uri->segment('4');
        $parameter = array('id' => $stateId,
            'b_IsActive' => '1',
            'n_AdminType' => $userId['a_SysAdminId'],
        );
        $pathState = base_url() . "api/createbusinessadmin/businesseview/format/json/";
        $responseState = curlcall($parameter, $pathState);

        if ($responseState == 'Something Went Wrong') {
            $this->session->set_flashdata('message', 'Please check country Name');
            $base_url = base_url();
            redirect($base_url . 'ssa/business/business_list/');
            exit();
        } else {
            $data['state'] = $responseState;
            $parameter = array('act_mode' => 'all', 'business_name' => '', 'p_ststus' => '', 'p_bullingtype' => '');
            $path = base_url() . 'api/createbusinessadmin/searchbusinessall/format/json/';
            $data['bname'] = curlcall($parameter, $path);
            $this->load->view('business/businessedit', $data);
            //$this->load->view('layout/footer');
        }
        // }
    }

    public function business_list()
    {
        $this->login_check();
        $userId = checklogin();
        $path = base_url() . 'api/createbusinessadmin/businesslist/format/json/';
        $response['data'] = curlget($path);
        $this->load->view('layout/header');
        $parameter = array('act_mode' => 'all', 'business_name' => '', 'b_status' => '', 'p_bullingtype' => '');
        $path = base_url() . 'api/createbusinessadmin/searchbusinessall/format/json/';
        $response['bname'] = curlcall($parameter, $path);
        $this->load->view('business/businesslist', $response);
    }

    // ############################################ SHEETESH 25 NOV START #####################
    public function businessadminlist()
    {
        $this->login_check();
        $userId = checklogin();
        $stateId = $this->uri->segment('4');
        //echo $stateId;
        if (empty($stateId)) {
            $parameter = array('act_mode' => 'viewall', 'busineaaid' => '');
        } else {
            $parameter = array('act_mode' => 'view', 'busineaaid' => $stateId);
        }


        $path = base_url() . 'api/createbusinessadmin/shebusdtl/format/json/';
        $response['data'] = curlcall($parameter, $path);
        //p($response);
//exit;
        $this->load->view('layout/header');
        $parameter = array('act_mode' => 'all', 'business_name' => '', 'p_ststus' => '', 'p_bullingtype' => '');
        $path = base_url() . 'api/createbusinessadmin/searchbusinessall/format/json/';
        $response['bname'] = curlcall($parameter, $path);
        // p($response);
        // exit();
        $this->load->view('business/businessadminlist', $response);

    }

    // ############################################ SHEETESH 25 NOV END #####################
    public function business_Emplist()
    {
        $this->login_check();
        $userId = checklogin();
        $path = base_url() . 'api/createbusinessadmin/businesslist/format/json/';
        $response['data'] = curlget($path);

        $this->load->view('business/businesslist', $response);

    }

    public function business_status()
    {
        $this->login_check();
        $userId = checklogin();
        $stateId = $this->uri->segment('4');
        $b_deleted = $this->uri->segment('5');

        $parameter = array('id' => $stateId, 'status' => $b_deleted);
        //p($parameter);
        // call api
        $path = base_url() . 'api/createbusinessadmin/businessstts/format/json/';
        $response = curlcall($parameter, $path);
        // p($response);
        // exit();
        if (!empty($response)) {
            $this->session->set_flashdata('message', 'Record updated Successfully');
            $base_url = base_url();
            redirect($base_url . 'ssa/business/business_list/');
            exit;
        } else {
            $this->session->set_flashdata('message', 'Record Not  updated Successfully');
            $base_url = base_url();
            redirect($base_url . 'ssa/business/business_list/');
            exit;
        }
        $base_url = base_url();
        redirect($base_url . 'ssa/business/business_list/');
        exit;
    }

    public function business_delete()
    {
        $this->login_check();
        $userId = checklogin();
        $stateId = $this->uri->segment('4');
        $parameter = array('id' => $stateId, 'b_deleted' => '1');
        // call api
        $path = base_url() . 'api/createbusinessadmin/businessdelete/format/json/';
        $response = curlcall($parameter, $path);
        if (!empty($response)) {
            $this->session->set_flashdata('message', 'Record deleted Successfully');
            $base_url = base_url();
            redirect($base_url . 'ssa/business/business_list/');
            exit;
        } else {
            $this->session->set_flashdata('message', 'Record Not  deleted Successfully');
            $base_url = base_url();
            redirect($base_url . 'ssa/business/business_list/');
            exit;
        }
        $base_url = base_url();
        redirect($base_url . 'ssa/business/business_list/');
        exit;
    }

    function ssa_admin_mail_check()
    {

        $admin_mail = $this->session->userdata['sessionData']['t_username'];

        $parameter = array('adminemail' => $admin_mail);
        // call api
        $path = base_url() . 'api/createbusinessadmin/mailsend/format/json/';
        $response = curlcall($parameter, $path);
    }


    function bus_admin_email_check()
    {
        $parameter = array('adminemail' => $admin_mail);
        // call api
        $path = base_url() . 'api/createbusinessadmin/mailsend/format/json/';
        $response = curlcall($parameter, $path);
    }


    function business_search()
    {
        $parameter = array(
            'act_mode' => $_POST['act_mode'],
            'business_name' => $_POST['business_name'],
            'p_ststus' => $_POST['p_ststus'],
            'p_bullingtype' => $_POST['p_bullingtype']);
        // call api
        $path = base_url() . 'api/createbusinessadmin/business_search/format/json/';
        $response = curlcall($parameter, $path);
        // $myresult = array();
        $sdata = json_encode($response);
        echo $sdata;
        die();
    }

    function badminans()
    {

        $this->load->library('email');
        $letters = 'abcefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $chars = 8;
        $randomString = substr(str_shuffle($letters), 0, $chars);
        // $password= generateRandomString(6);
        $password = $randomString;
        $pass = $password;
        $parameterAssign = array('act_mode' => 'ssa_bus_seqans', 'emp_emial' => $_POST['id'], 'seqasn' => $pass, 'epasswoed' => '');
        $pathAssign = base_url() . 'api/business_manage/enployeepasswordreset/format/json/';
        $responseAssign = curlcall($parameterAssign, $pathAssign);
        $email_user = $responseAssign->t_Email;
        $first_name = $responseAssign->t_FirstName;
        $last_name = $responseAssign->t_LastName;

        $message_u = '<html><body bgcolor="#DCEEFC">
                 <br><div><table><p>Dear &nbsp;' . ucfirst($first_name) . ' &nbsp;' . $last_name . ' ,
                 </br> You recently made a request to reset your Security Answer. 
                 				</br> To complete the process, click the link below. </br>
                                 <tr><td>Login Page: </td><td><a href="' . base_url() . '/business/">Login</a>  </td></tr>
                                <tr><td>User Id: </td><td>Your Email Address :' . $email_user . ' </td></tr>
                                <tr><td>Default Security Answer: </td><td>' . $password . ' </td></tr>
                                <tr><td> Thanks</br>
                                 Support Team
                                </td><td>12345644</td>
                                <td>9 Am To 5 PM IST</td> </tr>
                             </table>
                               </div>
                              </body>
                              </html>';

//$message_u='this is password'.$email_user.' message';
        $this->email->set_newline("\r\n");
        $this->email->from('barun@mindztechnology.com', 'Tru Expense');
        $this->email->to("$email_user");
        $this->email->subject('Security Answer change');
        $this->email->message($message_u);
        $this->email->send();

    }


    function badminpassword()
    {
        $this->load->library('email');
        $letters = 'abcefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $chars = 8;
        $randomString = substr(str_shuffle($letters), 0, $chars);
        // $password= generateRandomString(6);
        $password = $randomString;
        $pass = $password;
        $parameterAssign = array('act_mode' => 'ssa_bus_passchange', 'emp_emial' => $_POST['id'], 'seqasn' => '', 'epasswoed' => md5($pass));
        $pathAssign = base_url() . 'api/business_manage/enployeepasswordreset/format/json/';
        $responseAssign = curlcall($parameterAssign, $pathAssign);
        $email_user = $responseAssign->t_Email;
        $first_name = $responseAssign->t_FirstName;
        $last_name = $responseAssign->t_LastName;

        $message_u = '<html><body bgcolor="#DCEEFC">
                 <br><div><table><p>Dear &nbsp;' . ucfirst($first_name) . ' &nbsp;' . $last_name . ' ,  </br>
                </br>You recently made a request to reset your password. To complete the process, click the link below. </br>
                                 <tr><td>Login Page: </td><td><a href="' . base_url() . 'business/">Login</a>  </td></tr>
                                <tr><td>Eemail Id: </td><td>' . $email_user . ' </td></tr>
                                <tr><td>Default Password: </td><td>' . $password . ' </td></tr>
                                <tr><td> Thanks</br>
                                 Support Team
                                </td><td>12345644</td>
                                <td>9 Am To 5 PM IST</td> </tr>
                             </table>
                               </div>
                              </body>
                              </html>';

//$message_u='this is password'.$email_user.' message';
        $this->email->set_newline("\r\n");
        $this->email->from('barun@mindztechnology.com', 'Tru Expense');
        $this->email->to("$email_user");
        $this->email->subject('Password change');
        $this->email->message($message_u);
        $this->email->send();

    }

    function datetest()
    {
        $t = date("d M, Y");
        echo $t;

        //$formatted = date('jS M', strtotime($t));
        echo $database = date('Y-m-d', strtotime($t));

        echo $data = date('d M, Y', strtotime($database));

        //echo $formatted;
    }

    function mailtets()
    {

        $message_a = '<html>
                         <body bgcolor="#DCEEFC">
                 <b> Booking Invoice</b><br><div>
                                 <table>
                                <tr><td> User  Name.</td> <td> dfhg dfhgdgfhjghj</td></tr>
                              <tr><td>Password send successfully.</td> <td></td></tr>
                                </table>
                               </div>
                              </body>
                </html>';
        $this->load->library('email');
        $this->email->set_newline("\r\n");
        $this->email->from('barun@mindztechnology.com', 'Tru Expense');
        $this->email->to("rahul@mindztechnology.com");
        $this->email->subject('New business create');
        $this->email->message($message_a);
        $this->email->send();

    }


// ############################################# SHEETESH 25 NOV START HERE #################

    public function buseditbysys()
    {
        $this->login_check();
        $userId = checklogin();
        $adminid = $userId['a_SysAdminId'];
        $busid = $this->uri->segment('4');

        if (isset($_POST['submit'])) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|min_length[1]|max_length[255]|xss_clean');
            $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|min_length[1]|max_length[255]|xss_clean');
            $this->form_validation->set_rules('employee_id', 'Employee Id', 'trim|required|xss_clean');
            $this->form_validation->set_rules('date_of_birth', 'DOB', 'trim|required|xss_clean');
            $this->form_validation->set_rules('office_phone', 'Office Phone', 'trim|required|xss_clean|numeric');
            $this->form_validation->set_rules('mobile_phone', 'Mobile Phone', 'trim|required|xss_clean|numeric');
            //$this->form_validation->set_rules('address_line1','Address Line 1', 'trim|required|xss_clean');
            //$this->form_validation->set_rules('address_line2','Address Line 2', 'trim|required|xss_clean');
            //$this->form_validation->set_rules('address_line3','Address Line 3', 'trim|required|xss_clean');
            $this->form_validation->set_rules('n_CountryId_1', 'Country', 'trim|required|xss_clean');
            $this->form_validation->set_rules('department', 'Department', 'trim|required|xss_clean');
            $this->form_validation->set_rules('state_id', 'State', 'trim|required|xss_clean');
            $this->form_validation->set_rules('city_id', 'City', 'trim|required|xss_clean');
            //$this->form_validation->set_rules('pin_code','Pincode', 'trim|required|xss_clean');
            $this->form_validation->set_rules('status', 'Status', 'trim|required|xss_clean');
            if ($this->form_validation->run() != FALSE) {

                $address = $this->input->post('address_line1') . '___' . $this->input->post('address_line2');
                $parameter = array('act_mode' => 'update',
                    'b_fname' => $this->input->post('first_name'),
                    'b_lname' => $this->input->post('last_name'),
                    'b_depid' => $this->input->post('department'),
                    'b_empid' => $this->input->post('employee_id'),
                    'b_dob' => date('Y-m-d', strtotime($this->input->post('date_of_birth'))), //       $this->input->post('date_of_birth'),
                    'b_ophone' => $this->input->post('office_phone'),
                    'b_mphone' => $this->input->post('mobile_phone'),
                    'b_address' => $address,
                    'b_country' => $this->input->post('n_CountryId_1'),
                    'b_state' => $this->input->post('state_id'),
                    'b_city' => $this->input->post('city_id'),
                    'b_pincode' => $this->input->post('pin_code'),
                    'b_secans' => '',
                    'b_status' => $this->input->post('status'),
                    'b_mid' => $adminid,
                    'b_busid' => $busid);
                //p($parameter);
                //exit();
                $path = base_url() . 'api/super_state_admin/busupdatebysysAp/format/json/';
                $response = curlcall($parameter, $path);

                //p($response);
                //exit();

                if ($response == 'Something Went Wrong') {
                    $this->session->set_flashdata('message', 'No Update Performed ');
                    $base_url = base_url();
                    redirect($base_url . 'ssa/business/businessadminlist/');
                    exit();

                } else {
                    $this->session->set_flashdata('message', 'Business Information updated Successfully');
                    $base_url = base_url();
                    redirect($base_url . 'ssa/business/businessadminlist');
                    exit();
                }

            } // END OF FORM VALIDATION

        }// END OF SUBMIT


        $parameter = array('act_mode' => 'view',
            'b_fname' => '',
            'b_lname' => '',
            'b_country' => '',
            'b_state' => '',
            'b_city' => '',
            'b_address' => '',
            'b_ophone' => '',
            'b_mphone' => '',
            'b_depid' => '',
            'b_empid' => '',
            'b_dob' => '',
            'b_pincode' => '',
            'b_secans' => '',
            'b_status' => '',
            'b_mid' => '',
            'b_busid' => $busid);
        $path = base_url() . 'api/super_state_admin/buseditbysysAp/format/json/';
        $response['bprofile'] = curlcall($parameter, $path);
        $this->load->view('layout/header');


        $parameter = array('act_mode' => 'getallrool', 'adminid' => '');
        $path = base_url() . 'api/business_manage/ssabusroolaccess/format/json/';
        $response['access'] = curlcall($parameter, $path);

        $parameter = array('act_mode' => 'byadminid', 'adminid' => $busid);
        $path = base_url() . 'api/business_manage/ssabusroolaccess/format/json/';
        $response['rool'] = curlcall($parameter, $path);
        // api call end here

        $this->load->view('business/businessadminedit', $response);

    }


    function roolupdate()
    {
        //print_r($_POST);

        $xml = htmlentities("<NewDataSet>");
        foreach ($_POST['roolaccs'] as $key => $value1) {
            if (!empty($value1['cat_id'])) {
                $xml .= htmlentities('<tblempaccessmap><n_RoleAccessId>' . $value1['cat_id'] . '</n_RoleAccessId></tblempaccessmap>');
            }
        }
        $xml .= htmlentities("</NewDataSet>");
        $parameter = array('p_mode' => $_POST['a_mode'],
            'p_XmlData_dname' => (html_entity_decode($xml, ENT_QUOTES, 'UTF-8')),
            'adminid' => $_POST['admin'],
            'amount' => $_POST['amount'],
            'createdby' => $_POST['createdby'],
            'businessid' => $_POST['businessid']
        );

        /*p($parameter);
        exit;*/
        $path = base_url() . 'api/business_manage/ssabusrooleupdate/format/json/';
        $response = curlcall($parameter, $path);

        p($response);
    }


    public function deletebusadmin($id)
    {
        $this->login_check();
        $this->load->view('layout/header');
        $parameter = array('busid' => $id);
        // api call start from here
        $path = base_url() . 'api/super_state_admin/busadmindelete/format/json/';
        $response = curlcall($parameter, $path);
        // api call end here
        if ($response == 1) {

            $this->session->set_flashdata('message', 'Deleted Successfully');
            redirect('ssa/business/businessadminlist');
            exit();
        } else {
            $this->session->set_flashdata('message', 'Something went wrong');
            redirect('ssa/business/businessadminlist');
            exit();
        }
        $this->load->view('layout/footer');

    }

    public function activebusadmin($id)
    {
        $this->login_check();
        $this->load->view('layout/header');
        $parameter = array('busid' => $id);

        // api call start from here
        $path = base_url() . 'api/super_state_admin/busadminactive/format/json';
        $response = curlcall($parameter, $path);
        //api call  end here
        if ($response == 1) {
            $this->session->set_flashdata('message', "<font color='#FF0000'> Admin is Active </font>");
            redirect('ssa/business/businessadminlist');
            exit();
        } else {
            $this->session->set_flashdata('message', "<font color='#FF0000'> Something went wrong</font>");
            redirect('ssa/business/businessadminlist');
            exit();
        }
        $this->load->view('layout/footer');

    }

    public function inactivbusadmin($id)
    {
        $this->login_check();
        $this->load->view('layout/header');
        $parameter = array('busid' => $id);

        // api call start from here
        $path = base_url() . 'api/super_state_admin/busadmindeactive/format/json';
        $response = curlcall($parameter, $path);
        //api call  end here
        if ($response == 1) {
            $this->session->set_flashdata('message', "<font color='#FF0000'> Admin is Inactive </font>");
            redirect('ssa/business/businessadminlist');
            exit();
        } else {
            $this->session->set_flashdata('message', "<font color='#FF0000'> Something went wrong</font>");
            redirect('ssa/business/businessadminlist');
            exit();
        }
        $this->load->view('layout/footer');

    }

    public function checkbusinessemail()
    {
        $parameter = array('bemail' => $this->input->post('email'),
            'bseq' => '',
            'act_mode' => 'emailcheck'
        );

        // api call start from here
        $path = base_url() . 'api/createbusinessadmin/checkEmailExist/format/json';
        $response = curlcall($parameter, $path);
        //api call  end here
        if ($response != 'Something  Went Wrong') {
            echo json_encode($response);
            exit();

        }
    }


//#################################### SHEETESH 25 NOV END #####################################

// ################# add business admin and roal access ###########  Rahul Yadav 8 December #####3 


    public function businessadmin()
    {
        $this->login_check();
        if (isset($_POST['submit'])) {
            /*  p($_POST);
              exit();*/
            //$userId= checklogin();businessid
            $this->form_validation->set_rules('businessid', 'Business name', 'trim|required|xss_clean|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|required');
            //$this->form_validation->set_rules('status', 'Status', 'trim|required|xss_clean|required');
            $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|xss_clean|required');
            $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|xss_clean|required');
            $this->form_validation->set_rules('departmenr', 'Department', 'trim|required|xss_clean|required');
            $this->form_validation->set_rules('employee_id', 'Employee Id', 'trim|required|xss_clean|required');
            $this->form_validation->set_rules('date_of_birth', 'Date Of Birth', 'trim|required|xss_clean|required');
            $this->form_validation->set_rules('office_phone', 'Office Phone', 'trim|required|xss_clean|required|');
            //$this->form_validation->set_rules('mobile_phone', 'Mobile Phone', 'trim|required|xss_clean|required');
            //$this->form_validation->set_rules('address_line1', 'Address Line1', 'trim|required|xss_clean|required');
            //$this->form_validation->set_rules('address_line2', 'Address Line2', 'trim|required|xss_clean|required');
            //$this->form_validation->set_rules('address_line3', 'Address Line3', 'trim|required|xss_clean|required');
            $this->form_validation->set_rules('country_id', 'Country', 'trim|required|xss_clean|required');
            // $this->form_validation->set_rules('state_id', 'State', 'trim|required|xss_clean|required');
            // $this->form_validation->set_rules('city_id', 'City', 'trim|required|xss_clean|required');
            //$this->form_validation->set_rules('pin_code', 'Pincode', 'trim|required|xss_clean|required');
            $this->form_validation->set_rules('amount', 'Amount', 'trim|required|xss_clean|required');

            if ($this->form_validation->run() != false) {
                $businessid = $this->input->post('businessid');
                $email = $this->input->post('email');
                $status = $this->input->post('status');
                $firstName = $this->input->post('first_name');
                $lastName = $this->input->post('last_name');
                $department = $this->input->post('departmenr');
                $dateOfBirth = $this->input->post('date_of_birth');
                $employeeCode = $this->input->post('employee_id');
                $officePhone = $this->input->post('office_phone');
                $mobilePhone = $this->input->post('mobile_phone');
                $addressLine1 = $this->input->post('address_line1');
                $addressLine2 = $this->input->post('address_line2');
                $addressLine3 = $this->input->post('address_line3');
                $countryId = $this->input->post('country_id');
                $stateId = $this->input->post('state_id');
                $cityId = $this->input->post('city_id');
                $pinCode = $this->input->post('pin_code');
                $amount = $this->input->post('amount');
                $editPolicy = $this->input->post('edit_policy');
                $address = $addressLine1 . '___' . $addressLine2 . '___' . $addressLine3;
                $randPassword = rand();
                $password = md5($password);
                $DOB = date('Y-m-d', strtotime($dateOfBirth));
                // header('Content-type: text/xml');
                $xml = htmlentities("<NewDataSet>");

                foreach ($editPolicy as $key => $value) {
                    $xml .= htmlentities('<tblempaccessmap><n_RoleAccessId>' . $value . '</n_RoleAccessId></tblempaccessmap>');
                }

                $xml .= htmlentities("</NewDataSet>");
                $parameter = array('p_mode' => 'Insert',
                    'p_BusnAdminId' => 'null',
                    'p_AdminCode' => $employeeCode,
                    'p_Email' => $email,
                    'p_pass' => $password,
                    'p_FirstName' => $firstName,
                    'p_LastName' => $lastName,
                    'p_DeptId' => $department,
                    'p_Contact' => $officePhone,
                    'p_Mobile' => $mobilePhone,
                    'p_DOB' => $DOB,
                    'p_Address' => addslashes($address),
                    'p_Country' => $countryId,
                    'p_State' => $stateId,
                    'p_City' => $cityId,
                    'p_Pincode' => $pinCode,
                    'p_Positon' => 'null',
                    'p_Status' => $status,
                    'p_XmlDatatest' => (html_entity_decode($xml, ENT_QUOTES, 'UTF-8')),
                    'p_AmountRange' => $amount,
                    'p_CompareValue' => 'null',
                    'p_CreatedBy' => 33,
                    'p_BusinessId' => $businessid,
                    'p_AdminType' => 22
                );
                $path = base_url() . "api/business_admin/emp/format/json/";
                $response = curlcall($parameter, $path);
                if ($response == 'Something Went Wrong') {
                    $this->session->set_flashdata('message', 'Please Check All the Fields Name');
                    $base_url = base_url();
                    redirect($base_url . 'ssa/business/businessadminlist');
                    exit();

                } else {
                    $subject = "True Expense Business Login Details";
                    $msg = "Dear" . $firstName;
                    $msg .= "A <TruExpense> user has been created for you. Please use following credentials to register you and begin using the expense management solution.";
                    $msg .= "Login Page:" . base_url() . "business/";
                    $msg .= "<h3>User Id:-</h3>" . $email . "</br>";
                    $msg .= "<h3>Default Password:-</h3>" . $randPassword;
                    $msg .= "Thanks </br>Support Team </br>9999999999";
                    $msg .= date("l jS \of F Y h:i:s A");
                    sendmail($email, $subject, $msg);
                    $this->session->set_flashdata('message', 'Business Admin Created Successfully');
                    redirect($base_url . 'ssa/business/businessadminlist/');
                    exit();
                }
            }
        }

        /* $parameterSide=array(
                           'p_mode' => 'SelectList',
                           'p_BusnAdminId'=>'null',
                           'p_FirstName' => 'null',
                           'p_LastName' => 'null',
                           'p_BusinessId' => $userId['n_BusinessId'],
                         );
           $pathSide  = base_url()."api/business_admin/emp/format/json/";
           $responseSide  = curlcall($parameterSide, $pathSide);
       if($responseSide =='Something Went Wrong'){
                 $data['side']="";
            }else{
               $data['side']=$responseSide;
            }*/

        $this->load->view('layout/header');
        $parameterRole = array('p_mode' => 'Select',
            'p_id' => 'null',
            'p_businessId' => 0,
            'p_AdminType' => 33,
        );
        $pathRole = base_url() . "api/business_admin/role/format/json/";
        $responseRole = curlcall($parameterRole, $pathRole);
        if ($responseRole == 'Something Went Wrong') {
            $data['role'] = '';
        } else {
            $data['role'] = $responseRole;
        }
        $parameterCountry = array('countryName' => 'null',
            'id' => 'null',
            'act_mode' => 'select',
            'createdBy' => 'null',
            'active' => '1',
            'businessId' => "null",
            'adminUser' => '33',
        );
        $pathCountry = base_url() . "api/business_admin/country/format/json/";
        $responseCountry = curlcall($parameterCountry, $pathCountry);
        // p($responseCountry);
        // exit();
        if ($responseCountry == 'Something Went Wrong') {
            $data['country'] = "";
        } else {
            $data['country'] = $responseCountry;
        }

        $parameter_policy = array('act_mode' => 'getallbusiness', 'AdminType' => '', 'adminId' => '');
        $path_policy = base_url() . 'api/business_manage/ssapolicybusiness/format/json/';
        $data['business'] = curlcall($parameter_policy, $path_policy);

        $this->load->view('business/business_admin_add', $data);
    }


// ###############  end business  admin rool access ######################################

    public function getdeparementbus()
    {
        /*echo 'sjhsk';
        exit;*/
        $parameter_policy = array('act_mode' => 'getdpmtbybusiness', 'businessid' => $_POST['businessid']);
        $path = base_url() . 'api/business_manage/businessdepartment/format/json/';
        $data = curlcall($parameter_policy, $path);
//p($data);
        echo json_encode($data);

    }


// edit rool access /


    /*public function editbabapanel(){

      $this->login_check();
      $userId= checklogin();
      //p($userId);
      if(isset($_POST['submit'])){

          //$userId= checklogin();
          $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|required');
         // $this->form_validation->set_rules('status', 'Status', 'trim|required|xss_clean|required');
          $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|xss_clean|required');
          $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|xss_clean|required');
          $this->form_validation->set_rules('department', 'Department', 'trim|required|xss_clean|required');
          $this->form_validation->set_rules('employee_id', 'Employee Id', 'trim|required|xss_clean|required');
          $this->form_validation->set_rules('date_of_birth', 'Date Of Birth', 'trim|required|xss_clean|required');
          $this->form_validation->set_rules('office_phone', 'Office Phone', 'trim|required|xss_clean|required|numeric');
          //$this->form_validation->set_rules('mobile_phone', 'Mobile Phone', 'trim|required|xss_clean|required|numeric');
          //$this->form_validation->set_rules('address_line1', 'Address Line1', 'trim|required|xss_clean|required');
          //$this->form_validation->set_rules('address_line2', 'Address Line2', 'trim|required|xss_clean|required');
          //$this->form_validation->set_rules('address_line3', 'Address Line3', 'trim|required|xss_clean|required');
          $this->form_validation->set_rules('country_id', 'Country', 'trim|required|xss_clean|required');
          $this->form_validation->set_rules('state_id', 'State', 'trim|required|xss_clean|required');
          $this->form_validation->set_rules('city_id', 'City', 'trim|required|xss_clean|required');
          //$this->form_validation->set_rules('pin_code', 'Pincode', 'trim|required|xss_clean|required');
          $this->form_validation->set_rules('amount', 'Amount', 'trim|required|xss_clean|required');

          if($this->form_validation->run() != false){
             $email=$this->input->post('email');
             $empUpdate=$this->input->post('emp_id');
             $status=$this->input->post('status');
             $firstName=$this->input->post('first_name');
             $lastName=$this->input->post('last_name');
             $department=$this->input->post('department');
             $dateOfBirth=$this->input->post('date_of_birth');
             $employeeCode=$this->input->post('employee_id');
             $officePhone=$this->input->post('office_phone');
             $mobilePhone=$this->input->post('mobile_phone');
             $addressLine1=$this->input->post('address_line1');
             $addressLine2=$this->input->post('address_line2');
             $addressLine3=$this->input->post('address_line3');
             $countryId=$this->input->post('country_id');
             $stateId=$this->input->post('state_id');
             $cityId=$this->input->post('city_id');
             $pinCode=$this->input->post('pin_code');
             $amount=$this->input->post('amount');
             $editPolicy=$this->input->post('edit_policy');
             $address=$addressLine1.'___'.$addressLine2.'___'.$addressLine3;
             $DOB= date('Y-m-d', strtotime($dateOfBirth));
            $xml =htmlentities("<NewDataSet>");

                  foreach ($editPolicy as $key => $value) {
                    $xml .=htmlentities('<tblempaccessmap><n_RoleAccessId>'.$value.'</n_RoleAccessId></tblempaccessmap>');
                  }
                  $xml .=htmlentities("</NewDataSet>");



         $parameterUpdate = array( 'p_mode'         =>  'Update',
                                   'p_BusnAdminId'  =>  $empUpdate,
                                   'p_AdminCode'    =>  $employeeCode,
                                   'p_Email'        =>  $email,
                                   'p_pass'         =>  'null',
                                   'p_FirstName'    =>  $firstName,
                                   'p_LastName'     =>  $lastName,
                                   'p_DeptId'       =>  $department,
                                   'p_Contact'      =>  $officePhone,
                                   'p_Mobile'       =>  $mobilePhone,
                                   'p_DOB'          =>  $DOB,
                                   'p_Address'      =>  addslashes($address),
                                   'p_Country'      =>  $countryId,
                                   'p_State'        =>  $stateId,
                                   'p_City'         =>  $cityId,
                                   'p_Pincode'      =>  $pinCode,
                                   'p_Positon'      =>  'null',
                                   'p_Status'       =>  $status,
                                   'p_XmlDatatest'  =>  (html_entity_decode($xml, ENT_QUOTES, 'UTF-8')),
                                   'p_AmountRange'  =>  $amount,
                                   'p_CompareValue' =>  'null',
                                   'p_CreatedBy'    =>  $userId['businessUserId'],
                                   'p_BusinessId'   =>  $userId['n_BusinessId'],
                                   'p_AdminType'    =>  $userId['n_AdminType'],
                                  );

              $pathUpdate  = base_url()."api/business_admin/emp/format/json/";
              $response  = curlcall($parameterUpdate, $pathUpdate);
              // p($response);
              // exit();
              if($response =='Something Went Wrong'){
                      $this->session->set_flashdata('message','Please All Fields Name');
                      $base_url  = base_url();
                      redirect($base_url.'business/dashboard/editbabapanel/'.$empUpdate);
                      exit();

                }else{

                    $this->session->set_flashdata('message','Updated Successfully');
                    redirect($base_url.'business/dashboard/businessAdminListing/');
                    exit();
                }
          }
       }


            $parameterSide=array(
                            'p_mode' => 'SelectList',
                            'p_BusnAdminId'=>'null',
                            'p_FirstName' => 'null',
                            'p_LastName' => 'null',
                            'p_BusinessId' => $userId['n_BusinessId'],
                          );
            $pathSide  = base_url()."api/business_admin/emp/format/json/";
            $responseSide  = curlcall($parameterSide, $pathSide);
          if($responseSide =='Something Went Wrong'){
                   $data['side']="";
             }else{
                $data['side']=$responseSide;
             }
          $empId=$this->uri->segment('4');

          $parameterEmpData=array(
                            'p_mode' => 'SelectEdit',
                            'p_BusnAdminId'=>$empId,
                            'p_FirstName' => 'null',
                            'p_LastName' => 'null',
                            'p_BusinessId' => 77  //$userId['n_BusinessId'],
                          );
          // p($parameterEmpData);
          // exit();
          $pathEmpData  = base_url()."api/business_admin/emp/format/json/";
          $responseEmpData  = curlcall($parameterEmpData, $pathEmpData);
          // p($responseEmpData);
          // exit();
         if($responseEmpData =='Something Went Wrong'){
               $data['empData']="";
             }else{
              foreach ($responseEmpData as $key => $value) {
                        $countryId=$value->n_CountryId;
                        $stateId=$value->n_StateId;
                      }
                $parameterState = array( 'id' => $countryId,
                                    'b_IsActive' => '1',
                                    'n_BusinessId' => '0',
                                    'p_mode' => 'Stateselect',
                                    'n_AdminType' => 33,
                                  );
               $pathState  = base_url()."api/business_admin/state/format/json/";
               $responseState  = curlcall($parameterState, $pathState);
               if($responseState =='Something Went Wrong'){
                    $data['stateList']='';
               }else{
              $data['stateList']=$responseState;
            }

            $parameterCity = array( 'p_mode' => 'CitySelect',
                                    'p_id' => 'null',
                                    'p_stateId' => $stateId,
                                    'p_BusinessId' => 'null',
                                    'p_admin' => 33,
                              );

           $pathCity  = base_url()."api/business_admin/city/format/json/";
           $responseCity  = curlcall($parameterCity, $pathCity);

           if($responseCity =='Something Went Wrong'){
                  $data['cityList']="";
            }else{
                  $data['cityList']=$responseCity;
                  }
            $data['empData']=$responseEmpData;
         }

          $this->load->view('layout/header');

         $parameterRole= array( 'p_mode' => 'Select',
                                 'p_id' => 'null',
                                 'p_businessId' =>"null" ,
                                 'p_AdminType' => "null",
                              );
         $pathRole  = base_url()."api/business_admin/role/format/json/";
         $responseRole  = curlcall($parameterRole, $pathRole);
         if($responseRole =='Something Went Wrong'){
                $data['role']='';
          }else{
              $data['role']=$responseRole;
           }
        $parameterCountry = array( 'countryName'   => 'null',
                                    'id'            => 'null',
                                    'act_mode'      => 'select',
                                    'createdBy'     => 'null',
                                    'active'        => '1',
                                    'businessId'    => "null",
                                    'adminUser'     => $userId['n_AdminType'],
                                    );

        $pathCountry  = base_url()."api/business_admin/country/format/json/";
        $responseCountry  = curlcall($parameterCountry, $pathCountry);
         if($responseCountry =='Something Went Wrong'){
                     $data['country']='';
               }else{
                  $data['country']=$responseCountry;
               }

        $this->load->view('business/edit_business_admin_business_admin_panel',$data);


    }*/


// End rool acces


} // end class


// ==================================================
//
//	List of all the tables and procedures used will come here
//  Supper Admin Table  = tbl_systemlogin;
//  Supper Admin Login Procedure  =  proc_adminLogin
//  country TableName = "tblcountry";
//  procedure for this is    = "countryManage"; 
//
// ================================================== 