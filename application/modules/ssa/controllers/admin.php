<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MX_Controller
{

    public function __construct()
    {
        $this->load->model("supper_admin");
        $this->load->helper('my_helper');
    }

    public function index()
    {
        if (isset($_POST['submit']) and $_POST['submit'] == 'Login') {
            $this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[5]|xss_clean|valid_email');
            $this->form_validation->set_rules('Password', 'Password', 'trim|required|min_length[5]|max_length[255]|xss_clean');
            if ($this->form_validation->run() != false) {
                $parameter = array(
                    'firstName' => '',
                    'lastName' => '',
                    'email' => $this->input->post('email'),
                    'password' => md5($this->input->post('Password')),
                    'createdby' => '',
                    'act_mode' => 'SuperAdmin',
                    'n_CountryId_1' => '',
                    'n_StateId_1' => '',
                    't_Address1' => '',
                    'userId' => ''
                );


                // api call comes here
                $path = base_url() . 'api/super_state_admin/user/id/2/format/json/';
                $response = curlcall($parameter, $path);


                if ($response == 'Something Went Wrong') {
                    $this->session->set_flashdata('message', 'Please check email and password');
                    $base_url = base_url();
                    redirect($base_url . 'ssa/admin/index/');
                    exit();
                } else {

                    if ($response->lastlogin == "0000-00-00 00:00:00") {
                        $last_loginset = date("Y-m-d H:i:s");
                    } else {
                        $last_loginset = $response->lastlogin;
                    }

                    $myarray = array(
                        'firstName' => $response->firstName,
                        'lastName' => $response->lastName,
                        'a_SId' => $response->a_SysloginId,
                        'a_SysAdminId' => $response->a_SysAdminId,
                        't_username' => $response->t_username,
                        //'d_modifiedon' => $response->lastlogin,
                        'lastlogin' => $last_loginset
                    );
//var_dump($myarray);exit;
                    $this->session->set_userdata('sessionData', $myarray);
                    //api cal starts here
                    $parameter = array(
                        'firstName' => '',
                        'lastName' => '',
                        'email' => '',
                        'password' => '',
                        'createdby' => '',
                        'act_mode' => 'laslogin',
                        'n_CountryId_1' => '',
                        'n_StateId_1' => '',
                        't_Address1' => '',
                        'userId' => $response->a_SysloginId
                    );


                    $path1 = base_url() . 'api/super_state_admin/userlogin/';
                    $response = curlcall($parameter, $path1);
                    //api call ends here
                    $base_url = base_url();
                    redirect($base_url . 'ssa/business/business_add/');
                    exit();
                }

                // api call ends here

            }
        }
        $this->load->view('login');
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
            redirect($baseURl . 'ssa/admin');
            exit();
        }
    }


    public function setting()
    {
        $this->login_check();
        $this->load->view('layout/header');
        $this->load->view('setting/index');
        $this->load->view('layout/footer');
    }

    public function departmentlisting()
    {
        $this->login_check();
        $userId = checklogin();
        $this->load->view('layout/header');
        $parameter = array('p_mode' => 'select',
            'p_DeptId' => 'null',
            'p_XmlData_dname' => "null",
            'p_AdminType' => "null",
            'p_BusinessId' => "null",
            'p_CreatedBy' => "null"
        );
        $path = base_url() . "api/super_state_admin/deptName/format/json/";
        $response = curlcall($parameter, $path);
        if ($response == 'Something Went Wrong') {
            $data['deptlist'] = '';
        } else {
            $data['deptlist'] = $response;
        }
        $this->load->view('setting/departmentListing', $data);
        $this->load->view('layout/footer');
    }

    public function department_add()
    {
        $this->login_check();
        $userId = checklogin();
        // p($userId);
        // exit();
        $this->load->view('layout/header');
        if (isset($_POST['submit'])) {
            //p($_POST);
            // exit();
            $this->form_validation->set_rules('business_id', 'Business Name', 'trim|required|xss_clean|required');
            $this->form_validation->set_rules('dept_name[]', 'Department Name', 'trim|required|xss_clean|required');
            if ($this->form_validation->run() != false) {
                $businessName = $_POST['dept_name'];
                $businessId = $_POST['business_id'];
                $xml = htmlentities("<NewDataSet>");
                foreach ($businessName as $key => $value1) {
                    $xml .= htmlentities('<tbldepartment><t_DeptName>' . $value1 . '</t_DeptName></tbldepartment>');
                }
                $xml .= htmlentities("</NewDataSet>");
                $parameter = array('p_mode' => 'Insert',
                    'p_DeptId' => '',
                    'p_XmlData_dname' => (html_entity_decode($xml, ENT_QUOTES, 'UTF-8')),
                    'p_AdminType' => $userId['a_SysAdminId'],
                    'p_BusinessId' => $businessId,
                    'p_CreatedBy' => $userId['a_SId']
                );
                //p($parameter);
                //exit();
                $path = base_url() . "api/super_state_admin/businessdepartmentadd/format/json/";
                $response = curlcall($parameter, $path);
                // echo json_encode($response);
                // exit();
                if ($response == 'Something Went Wrong') {
                    echo json_encode(array('Not Inserted' => 'Not Inserted'));
                } else {
                    echo json_encode($response);
                    exit();
                }
            }

        }
        $parameterBus = array('p_mode' => 'SelectDrop',
            'p_id' => 'null'
        );
        $path = base_url() . "api/super_state_admin/businessname/format/json/";
        $response = curlcall($parameterBus, $path);
        if ($response == 'Something Went Wrong') {
            $data['buslist'] = '';
        } else {
            $data['buslist'] = $response;
        }
        $this->load->view('setting/adddepartment', $data);
    }

    public function editdepartment()
    {
        $this->login_check();
        $userId = checklogin();
        // p($userId);
        // exit();
        $id = $this->uri->segment(4);
        $this->load->view('layout/header');
        if (isset($_POST['submit'])) {
            //p($_POST);
            // exit();
            $this->form_validation->set_rules('business_id', 'Business Name', 'trim|required|xss_clean|required');
            $this->form_validation->set_rules('dept_name', 'Department Name', 'trim|required|xss_clean|required');
            if ($this->form_validation->run() != false) {
                $depname = $this->input->post('dept_name');
                $businessId = $this->input->post('business_id');

                $parameterBus = array('act_mode' => 'update',
                    'dep_id' => $id,
                    'bus_id' => $businessId,
                    'dep_name' => $depname,
                );

                $path = base_url() . "api/super_state_admin/depedit/format/json/";
                $response = curlcall($parameterBus, $path);
                if ($response == 'Something Went Wrong') {
                    $this->session->set_flashdata('message', 'Record Not Update');
                    $base_url = base_url();
                    redirect($base_url . 'ssa/admin/departmentlisting/');
                    exit();
                } else {
                    $this->session->set_flashdata('message', 'Record Updated Successfully');
                    $base_url = base_url();
                    redirect($base_url . 'ssa/admin/departmentlisting/');
                    exit();
                }
            }

        }

        $parameterBus = array('act_mode' => 'select',
            'dep_id' => $id,
            'bus_id' => 'null',
            'dep_name' => 'null',
        );
        $path = base_url() . "api/super_state_admin/depdetails/format/json/";
        $response = curlcall($parameterBus, $path);
        if ($response == 'Something Went Wrong') {
            $data['deplist'] = '';
        } else {
            $data['deplist'] = $response;
        }

        $parameterBus = array('p_mode' => 'SelectDrop',
            'p_id' => 'null'
        );
        $path = base_url() . "api/super_state_admin/businessname/format/json/";
        $response = curlcall($parameterBus, $path);
        if ($response == 'Something Went Wrong') {
            $data['buslist'] = '';
        } else {
            $data['buslist'] = $response;
        }
        $this->load->view('setting/editdepartment', $data);

    }


    public function deletedepartment()
    {
        $this->uri->segment(4);
        $parameterBus = array('act_mode' => 'delete',
            'dep_id' => $id,
            'bus_id' => 'null',
            'dep_name' => 'null',
        );

        $path = base_url() . "api/super_state_admin/depdelete/format/json/";
        $response = curlcall($parameterBus, $path);
        if ($response == 'Something Went Wrong') {
            $this->session->set_flashdata('message', 'Record Not Delete');
            $base_url = base_url();
            redirect($base_url . 'ssa/admin/departmentlisting/');
            exit();
        } else {
            $this->session->set_flashdata('message', 'Record Deleted Successfully');
            $base_url = base_url();
            redirect($base_url . 'ssa/admin/departmentlisting/');
            exit();
        }

    }

    public function countrylisting()
    {
        $this->login_check();
        $this->load->view('layout/header');
        $userId = checklogin();
        $parameter = array('countryName1' => 'null',
            'id' => 'null',
            'act_mode' => 'select',
            'n_CreatedBy' => 'null',
            'b_IsActive' => '1',
            'n_BusinessId' => 'null',
            'n_AdminType' => $userId['a_SysAdminId'],
        );

        $path = base_url() . "api/countrylisting/country/format/json/";
        $response = curlcall($parameter, $path);
        if ($response == 'Something Went Wrong') {
            $this->session->set_flashdata('message', 'Please check country Name');
            $base_url = base_url();
            redirect($base_url . 'ssa/admin/countryadd/');
            exit();
        } else {
            $data['listing'] = $response;
            $this->load->view('setting/countryListing', $data);
            $this->load->view('layout/footer');
        }
    }


    public function countryadd()
    {
        $this->login_check();
        if (isset($_POST['submit'])) {
            $userId = checklogin();
            $this->form_validation->set_rules('country_name', 'Country Name', 'trim|required|xss_clean|is_unique[tblcountry.t_CountryName]');
            if ($this->form_validation->run() != false) {
                $countryName1 = $this->input->post('country_name');
                $date = date('Y:m:d');
                $parameter = array('countryName1' => $countryName1,
                    //'d_CreatedOn' => $date,
                    'id' => 'null',
                    'act_mode' => 'insertinto',
                    'n_CreatedBy' => 'null',
                    //d_ModifiedOn' => 'null',
                    //'n_ModifiedBy' => 'null',
                    'b_IsActive' => '1',
                    'n_BusinessId' => 'null',
                    'n_AdminType' => $userId['a_SysAdminId'],
                );
                $path = base_url() . "api/countrylisting/country/format/json/";
                $response = curlcall($parameter, $path);
                if ($response == 'Something Went Wrong') {
                    $this->session->set_flashdata('message', 'Please check country Name');
                    $base_url = base_url();
                    redirect($base_url . 'ssa/admin/countryadd/');
                    exit();

                } else {
                    $this->session->set_flashdata('message', 'Country name added Successfully');
                    $base_url = base_url();
                    redirect($base_url . 'ssa/admin/countrylisting/');
                    exit();
                }
            }
        }
        $this->load->view('layout/header');
        $this->load->view('setting/countryAdd');
        $this->load->view('layout/footer');

    }

    public function editcountry()
    {
        $this->login_check();
        $userId = checklogin();
        if (isset($_POST['submit'])) {
            $this->form_validation->set_rules('country_name', 'Country Name', 'trim|required|xss_clean|');
            if ($this->form_validation->run() != false) {
                $countryName1 = $this->input->post('country_name');
                $countryId = $this->input->post('countryId');
                $date = date('Y:m:d');
                $parameter = array('countryName1' => $countryName1,
                    //'d_CreatedOn' => $date,
                    'id' => $countryId,
                    'act_mode' => 'update',
                    'n_CreatedBy' => 'null',
                    //'d_ModifiedOn' => 'null',
                    //'n_ModifiedBy' => 'null',
                    'b_IsActive' => '1',
                    'n_BusinessId' => 'null',
                    'n_AdminType' => $userId['a_SysAdminId'],
                );
                $path = base_url() . "api/countrylisting/country/format/json/";
                $response = curlcall($parameter, $path);
                //p($response);
                //die();
                if ($response == 'Something Went Wrong') {
                    $this->session->set_flashdata('message', 'Please check country Name');
                    $base_url = base_url();
                    redirect($base_url . 'ssa/admin/editcountry/' . $countryId);
                    exit();

                } else {
                    $this->session->set_flashdata('message', 'Country name updated Successfully');
                    $base_url = base_url();
                    redirect($base_url . 'ssa/admin/countrylisting/');
                    exit();
                }
            }
        } else {
            $countryId = $this->uri->segment('4');
            $this->load->view('layout/header');
            $parameter = array('countryName1' => '',
                //   'd_CreatedOn' => 'null',
                'id' => $countryId,
                'act_mode' => 'editselect',
                'n_CreatedBy' => '',
                // 'd_ModifiedOn' => 'null',
                // 'n_ModifiedBy' => 'null',
                'b_IsActive' => '1',
                'n_BusinessId' => '',
                'n_AdminType' => $userId['a_SysAdminId']
            );
            $path = base_url() . "api/countrylisting/country/format/json/";
            $response = curlcall($parameter, $path);

            if ($response == 'Something Went Wrong') {
                $this->session->set_flashdata('message', 'Please check country Name');
                $base_url = base_url();
                redirect($base_url . 'ssa/admin/countryadd/');
                exit();
            } else {
                $data['listing'] = $response;
                $this->load->view('setting/editCountry', $data);
                $this->load->view('layout/footer');
            }
        }

    }

    public function deletecountry()
    {
        $this->login_check();
        $userId = checklogin();
        $countryId = $this->uri->segment('4');
        $parameter = array('countryName1' => 'null',
            'd_CreatedOn' => 'null',
            'id' => $countryId,
            'act_mode' => 'delete',
            'n_CreatedBy' => 'null',
            'd_ModifiedOn' => 'null',
            'n_ModifiedBy' => 'null',
            'b_IsActive' => '1',
            'n_BusinessId' => 'null',
            'n_AdminType' => $userId['a_SysAdminId'],
        );
        $path = base_url() . "api/countrylisting/country/format/json/";
        $response = curlcall($parameter, $path);
        if ($response == 'Something Went Wrong') {
            $this->session->set_flashdata('message', 'Country Name Already Deleted');
            $base_url = base_url();
            redirect($base_url . 'ssa/admin/countrylisting/');
            exit();
        } else {
            $this->session->set_flashdata('message', 'Country name deleted Successfully');
            $base_url = base_url();
            redirect($base_url . 'ssa/admin/countrylisting/');
            exit();
        }
    }


    public function statelisting()
    {
        $this->login_check();
        $this->load->view('layout/header');
        $userId = checklogin();

        $parameter = array('id' => 'null',
            'b_IsActive' => '1',
            'n_BusinessId' => '0',
            'p_mode' => 'Select',
            'n_AdminType' => $userId['a_SysAdminId'],

        );
        $path = base_url() . "api/statelisting/state/format/json/";
        $response = curlcall($parameter, $path);

        if ($response == 'Something Went Wrong') {
            $this->session->set_flashdata('message', 'Please check state Name');
            $base_url = base_url();
            redirect($base_url . 'ssa/admin/stateadd/');
            exit();
        } else {
            $data['listing'] = $response;
            $this->load->view('setting/stateListing', $data);
            $this->load->view('layout/footer');
        }
    }


    public function stateadd()
    {
        $this->login_check();
        $userId = checklogin();
        $this->load->library('form_validation');
        if (isset($_POST['submit'])) {


            $this->form_validation->set_rules('country_id', 'Country Id', 'trim|required|xss_clean|');
            $this->form_validation->set_rules('state_name', 'State Name', 'trim|required|xss_clean|is_unique[tblstate.t_StateName]');

            if ($this->form_validation->run() != false) {

                $stateName = $this->input->post('state_name');
                $countryId = $this->input->post('country_id');
                $date = date('Y:m:d');
                $parameter = array('p_mode' => 'Insert',
                    'n_CountryId' => $countryId,
                    'id' => 'null',
                    't_StateName' => $stateName,
                    'n_AdminType' => $userId['a_SysAdminId'],
                    'n_BusinessId' => 'null',
                    'n_CreatedBy' => 'null',
                    //'n_ModifiedBy' => 'null',
                    'b_IsActive' => '1',
                );


                $path = base_url() . "api/statelisting/state/format/json/";
                $response = curlcall($parameter, $path);
                if ($response == 'Something Went Wrong') {
                    $this->session->set_flashdata('message', 'Please check State/Country Name');
                    $base_url = base_url();
                    redirect($base_url . 'ssa/admin/stateadd/');


                } else {
                    $this->session->set_flashdata('message', 'State name added Successfully');
                    $base_url = base_url();
                    redirect($base_url . 'ssa/admin/statelisting/');
                    exit();
                }
            }
        }
        $parameter = array('countryName1' => 'null',
            //'d_CreatedOn' => 'null',
            'id' => 'null',
            'act_mode' => 'select',
            'n_CreatedBy' => 'null',
            // 'd_ModifiedOn' => 'null',
            //'n_ModifiedBy' => 'null',
            'b_IsActive' => '1',
            'n_BusinessId' => 'null',
            'n_AdminType' => $userId['a_SysAdminId'],
        );
        $path = base_url() . "api/countrylisting/country/format/json/";
        $response = curlcall($parameter, $path);

        $data['listing'] = $response;
        $this->load->view('layout/header');
        $this->load->view('setting/stateAdd', $data);
        $this->load->view('layout/footer');


    }


    public function editstate()
    {
        $this->login_check();
        $userId = checklogin();
        if (isset($_POST['submit'])) {
            $this->form_validation->set_rules('state_name', 'State Name', 'trim|required|xss_clean|');
            $this->form_validation->set_rules('country_id', 'Country Id', 'trim|required|xss_clean|');

            if ($this->form_validation->run() != false) {
                $stateId = $this->input->post('stateId');
                $stateName = $this->input->post('state_name');
                $countryId = $this->input->post('country_id');
                $date = date('Y:m:d');
                $parameter = array('p_mode' => 'Update',
                    'n_CountryId' => $countryId,
                    'id' => $stateId,
                    't_StateName' => $stateName,
                    'n_AdminType' => $userId['a_SysAdminId'],
                    'n_BusinessId' => '0',
                    'n_CreatedBy' => 'null',
                    'n_ModifiedBy' => 'null',
                    'b_IsActive' => '1',
                );
                $path = base_url() . "api/statelisting/state/format/json/";
                $response = curlcall($parameter, $path);
                if ($response == 'Something Went Wrong') {
                    $this->session->set_flashdata('message', 'Please check country/state Name');
                    $base_url = base_url();
                    redirect($base_url . 'ssa/admin/editstate/' . $stateId);
                    exit();

                } else {
                    $this->session->set_flashdata('message', 'State name updated Successfully');
                    $base_url = base_url();
                    redirect($base_url . 'ssa/admin/statelisting/');
                    exit();
                }
            }
        } else {
            $stateId = $this->uri->segment('4');

            $this->load->view('layout/header');
            $parameter = array('id' => $stateId,
                'b_IsActive' => '1',
                'n_BusinessId' => '0',
                'p_mode' => 'Editselect',
                'n_AdminType' => $userId['a_SysAdminId'],
            );
            $pathState = base_url() . "api/statelisting/state/format/json/";
            $responseState = curlcall($parameter, $pathState);
            $parameterCountry = array('countryName1' => 'null',
                //'d_CreatedOn' => 'null',
                'id' => 'null',
                'act_mode' => 'select',
                'n_CreatedBy' => 'null',
                //'d_ModifiedOn' => 'null',
                //'n_ModifiedBy' => 'null',
                'b_IsActive' => '1',
                'n_BusinessId' => 'null',
                'n_AdminType' => $userId['a_SysAdminId'],
            );
            $pathCountry = base_url() . "api/countrylisting/country/format/json/";
            $responseCountry = curlcall($parameterCountry, $pathCountry);
            if (($responseState == 'Something Went Wrong') || ($responseCountry == 'Something Went Wrong')) {
                $this->session->set_flashdata('message', 'Please check country Name');
                $base_url = base_url();
                redirect($base_url . 'ssa/admin/countryadd/');
                exit();
            } else {
                $data['state'] = $responseState;
                $data['country'] = $responseCountry;
                $this->load->view('setting/editstate', $data);
                $this->load->view('layout/footer');
            }
        }

    }

    public function deletestate()
    {
        $this->login_check();
        $userId = checklogin();
        $stateId = $this->uri->segment('4');
        $parameter = array('p_mode' => 'Delete',
            'n_CountryId' => 'null',
            'id' => $stateId,
            't_StateName' => 'null',
            'n_AdminType' => $userId['a_SysAdminId'],
            'n_BusinessId' => '0',
            'n_CreatedBy' => 'null',
            'n_ModifiedBy' => 'null',
            'b_IsActive' => '1',
        );
        $path = base_url() . "api/statelisting/state/format/json/";
        $response = curlcall($parameter, $path);
        if ($response == 'Something Went Wrong') {
            $this->session->set_flashdata('message', 'Country Name Already Deleted');
            $base_url = base_url();
            redirect($base_url . 'ssa/admin/statelisting/');
            exit();
        } else {
            $this->session->set_flashdata('message', 'State name deleted Successfully');
            $base_url = base_url();
            redirect($base_url . 'ssa/admin/statelisting/');
            exit();
        }
    }

    public function citylisting()
    {
        $this->login_check();
        $this->load->view('layout/header');
        $userId = checklogin();
        $parameter = array('p_mode' => 'select',
            'a_CityId' => 'null',
            'n_StateId' => 'null',
            'p_BusinessId' => 'null',
            'n_AdminType' => $userId['a_SysAdminId']
        );
        $path = base_url() . "api/citylisting/city/format/json/";
        $response = curlcall($parameter, $path);
        if ($response == 'Something Went Wrong') {
            $this->session->set_flashdata('message', 'Please check state Name');
            $base_url = base_url();
            redirect($base_url . 'ssa/admin/cityadd/');
            exit();
        } else {
            $data['listing'] = $response;
            $this->load->view('setting/cityListing', $data);
            $this->load->view('layout/footer');
        }
    }

    public function getStateDropDown()
    {

        $this->login_check();
        $userId = checklogin();
        $countryId = $_POST['id'];

        $parameter = array('id' => $countryId,
            'b_IsActive' => '1',
            'n_BusinessId' => '0',
            'p_mode' => 'Stateselect',
            'n_AdminType' => $userId['a_SysAdminId'],
        );
        $path = base_url() . "api/statelisting/state/format/json/";
        $response = curlcall($parameter, $path);

        if ($response == 'Something Went Wrong') {
            $this->session->set_flashdata('message', 'Please check state Name');
            $base_url = base_url();
            redirect($base_url . 'ssa/admin/stateadd/');
            exit();
        } else {
            echo json_encode($response);

            exit();
        }
    }

    public function cityadd()
    {
        $this->login_check();
        $userId = checklogin();
        if (isset($_POST['submit'])) {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('state_id', 'State Id', 'trim|required|xss_clean|');
            $this->form_validation->set_rules('country_id', 'Country Id', 'trim|required|xss_clean');
            $this->form_validation->set_rules('city_name', 'City Name', 'trim|required|xss_clean|is_unique[tblcity.t_CityName]');

            if ($this->form_validation->run() != false) {
                $cityName = $this->input->post('city_name');
                $stateId = $this->input->post('state_id');
                //   exit();
                $countryId = $this->input->post('country_id');
                $date = date('Y:m:d');
                $parameter = array('p_mode' => 'insert',
                    'a_CityId' => 'null',
                    'n_StateId' => $stateId,
                    't_CityName' => $cityName,
                    'n_CreatedBy' => 'null',
                    'n_ModifiedBy' => 'null',
                    'n_Delete' => 'null',
                    'n_AdminType' => $userId['a_SysAdminId'],
                );
                $path = base_url() . "api/citylisting/city/format/json/";
                $response = curlcall($parameter, $path);

                if ($response == 'Something Went Wrong') {
                    $this->session->set_flashdata('message', 'Please check city/State/Country Name');
                    $base_url = base_url();
                    redirect($base_url . 'ssa/admin/');
                    exit();

                } else {
                    $this->session->set_flashdata('message', 'City name added Successfully');
                    $base_url = base_url();
                    redirect($base_url . 'ssa/admin/citylisting/');
                    exit();
                }
            }
        }
        $parameter = array('countryName1' => 'null',
            //'d_CreatedOn' => 'null',
            'id' => 'null',
            'act_mode' => 'select',
            'n_CreatedBy' => 'null',
            //'d_ModifiedOn' => 'null',
            //'n_ModifiedBy' => 'null',
            'b_IsActive' => '1',
            'n_BusinessId' => 'null',
            'n_AdminType' => $userId['a_SysAdminId'],
        );
        $path = base_url() . "api/countrylisting/country/format/json/";
        $response = curlcall($parameter, $path);

        $data['listing'] = $response;
        $this->load->view('layout/header');
        $this->load->view('setting/cityAdd', $data);


    }

    public function editcity()
    {
        $this->login_check();
        $userId = checklogin();
        if (isset($_POST['submit'])) {

            $this->form_validation->set_rules('city_name', 'City Name', 'trim|required|xss_clean|');
            $this->form_validation->set_rules('state_id', 'State Id', 'trim|required|xss_clean|');
            $this->form_validation->set_rules('country_id', 'Country Id', 'trim|required|xss_clean|');

            if ($this->form_validation->run() != false) {
                $cityName = $this->input->post('city_name');
                $stateId = $this->input->post('state_id');
                $cityId = $this->input->post('city_id');
                $date = date('Y:m:d');
                $parameter = array('p_mode' => 'Update',
                    'a_CityId' => $cityId,
                    'n_StateId' => $stateId,
                    'n_ModifiedBy' => 'null',
                    't_CityName' => $cityName,
                    'n_CreatedBy' => 'null',
                    'n_Delete' => 'null',
                    'n_AdminType' => $userId['a_SysAdminId'],
                );

                $path = base_url() . "api/citylisting/city/format/json/";
                $response = curlcall($parameter, $path);

                if ($response == 'Something Went Wrong') {
                    $this->session->set_flashdata('message', 'Please check city/State/Country Name');
                    $base_url = base_url();
                    redirect($base_url . 'ssa/admin/editcity/' . $cityId);
                    exit();

                } else {
                    $this->session->set_flashdata('message', 'City name updated Successfully');
                    $base_url = base_url();
                    redirect($base_url . 'ssa/admin/citylisting/');
                    exit();
                }
            }
        } else {
            $cityId = $this->uri->segment('4');

            $this->load->view('layout/header');
            $parameterCity = array('p_mode' => 'Editselect',
                'a_CityId' => $cityId,
                'n_StateId' => 'null',
                'n_AdminType' => $userId['a_SysAdminId']
            );

            $pathCity = base_url() . "api/citylisting/city/format/json/";
            $responseCity = curlcall($parameterCity, $pathCity);
            foreach ($responseCity as $key => $value) {
                $countryId = $value->n_CountryId;
            }

            $parameterState = array('id' => $countryId,
                'b_IsActive' => '1',
                'n_BusinessId' => '0',
                'p_mode' => 'Stateselect',
                'n_AdminType' => $userId['a_SysAdminId'],
            );
            $pathstate = base_url() . "api/statelisting/state/format/json/";
            $responseState = curlcall($parameterState, $pathstate);
            $parameterCountry = array('countryName1' => 'null',
                //'d_CreatedOn' => 'null',
                'id' => 'null',
                'act_mode' => 'select',
                'n_CreatedBy' => 'null',
                //'d_ModifiedOn' => 'null',
                //'n_ModifiedBy' => 'null',
                'b_IsActive' => '1',
                'n_BusinessId' => 'null',
                'n_AdminType' => $userId['a_SysAdminId'],
            );
            $pathCountry = base_url() . "api/countrylisting/country/format/json/";
            $responseCountry = curlcall($parameterCountry, $pathCountry);
            if (($responseCity == 'Something Went Wrong') || ($responseCountry == 'Something Went Wrong') || ($responseState == 'Something Went Wrong')) {
                $this->session->set_flashdata('message', 'Please check country Name');
                $base_url = base_url();
                redirect($base_url . 'ssa/admin/countryadd/');
                exit();
            } else {
                $data['city'] = $responseCity;
                $data['state'] = $responseState;
                $data['country'] = $responseCountry;
                $this->load->view('setting/editCity', $data);
                //$this->load->view('layout/footer');
            }
        }

    }


    public function deletecity()
    {
        $this->login_check();
        $userId = checklogin();
        $cityId = $this->uri->segment('4');

        $parameter = array('p_mode' => 'delete',
            'a_CityId' => $cityId,
            'n_StateId' => 'null',
            'n_ModifiedBy' => 'null',
            't_CityName' => 'null',
            'n_CreatedBy' => 'null',
            'n_Delete' => 'null',
            'n_AdminType' => $userId['a_SysAdminId'],
        );
        // p($parameter);
        // exit();
        $path = base_url() . "api/citylisting/city/format/json/";
        $response = curlcall($parameter, $path);

        if ($response == 'Something Went Wrong') {
            $this->session->set_flashdata('message', 'City Name Already Deleted');
            $base_url = base_url();
            redirect($base_url . 'ssa/admin/citylisting/');
            exit();
        } else {
            $this->session->set_flashdata('message', 'City name deleted Successfully');
            $base_url = base_url();
            redirect($base_url . 'ssa/admin/Citylisting/');
            exit();
        }
    }

    public function currencylisting()
    {
        $this->login_check();
        $this->load->view('layout/header');
        $userId = checklogin();

        $parameter = array('id' => 'null',
            'b_IsActive' => '1',
            'n_BusinessId' => '0',
            'p_mode' => 'Select',
            'n_AdminType' => $userId['a_SysAdminId'],
        );
        $path = base_url() . "api/currencylisting/currency/format/json/";
        $response = curlcall($parameter, $path);

        if ($response == 'Something Went Wrong') {
            $this->session->set_flashdata('message', 'Please Check Currency Name');
            $base_url = base_url();
            redirect($base_url . 'ssa/admin/currencyadd/');
            exit();
        } else {
            $data['listing'] = $response;
            $this->load->view('setting/currencyListing', $data);
            $this->load->view('layout/footer');
        }
    }

    public function currencyadd()
    {
        $this->login_check();
        $userId = checklogin();
        if (isset($_POST['submit'])) {
            $this->form_validation->set_rules('currency_name', 'State Name', 'trim|required|xss_clean|');
            $this->form_validation->set_rules('country_id', 'Country Id', 'trim|required|xss_clean|');

            if ($this->form_validation->run() != false) {

                $currency_name = $this->input->post('currency_name');
                $countryId = $this->input->post('country_id');
                $date = date('Y:m:d');
                $parameter = array('p_mode' => 'Insert',
                    'a_CurrencyId' => 'null',
                    'n_CountryId' => $countryId,
                    't_CurrencyName' => addslashes($currency_name),
                    'n_CreatedBy' => 'null',
                    'n_ModifiedBy' => 'null',
                    'b_IsActive' => '1',
                    'n_BusinessId' => 'null',
                    'n_AdminType' => $userId['a_SysAdminId'],
                );
                $path = base_url() . "api/currencylisting/currency/format/json/";
                $response = curlcall($parameter, $path);
                if ($response == 'Something Went Wrong') {
                    $this->session->set_flashdata('message', 'Please check Currency/Country Name');
                    $base_url = base_url();
                    redirect($base_url . 'ssa/admin/currencyadd/');
                    exit();

                } else {
                    $this->session->set_flashdata('message', 'Currency name added Successfully');
                    $base_url = base_url();
                    redirect($base_url . 'ssa/admin/currencylisting/');
                    exit();
                }
            }
        } else {
            $parameter = array('countryName1' => 'null',
                //'d_CreatedOn' => 'null',
                'id' => 'null',
                'act_mode' => 'select',
                'n_CreatedBy' => 'null',
                //'d_ModifiedOn' => 'null',
                //'n_ModifiedBy' => 'null',
                'b_IsActive' => '1',
                'n_BusinessId' => 'null',
                'n_AdminType' => $userId['a_SysAdminId'],
            );
            $path = base_url() . "api/countrylisting/country/format/json/";
            $response = curlcall($parameter, $path);
            if ($response == 'Something Went Wrong') {
                $this->session->set_flashdata('message', 'Please check country Name');
                $base_url = base_url();
                redirect($base_url . 'ssa/admin/currecnyadd/');
                exit();
            } else {
                $data['listing'] = $response;
                $this->load->view('layout/header');
                $this->load->view('setting/currencyAdd', $data);
                $this->load->view('layout/footer');
            }

        }

    }


    public function editcurrency()
    {
        $this->login_check();
        $userId = checklogin();
        if (isset($_POST['submit'])) {
            $this->form_validation->set_rules('currency_name', 'Currency Name', 'trim|required|xss_clean|');
            $this->form_validation->set_rules('country_id', 'Country Id', 'trim|required|xss_clean|');

            if ($this->form_validation->run() != false) {
                $currencyId = $this->input->post('currency_id');
                $currencyName = $this->input->post('currency_name');
                $countryId = $this->input->post('country_id');
                $date = date('Y:m:d');
                $parameter = array('p_mode' => 'Update',
                    'a_CurrencyId' => $currencyId,
                    'n_CountryId' => $countryId,
                    't_CurrencyName' => addslashes($currencyName),
                    'n_CreatedBy' => 'null',
                    'n_ModifiedBy' => 'null',
                    'b_IsActive' => '1',
                    'n_BusinessId' => 'null',
                    'n_AdminType' => $userId['a_SysAdminId'],
                );
                $path = base_url() . "api/currencylisting/currency/format/json/";
                $response = curlcall($parameter, $path);
                if ($response == 'Something Went Wrong') {
                    $this->session->set_flashdata('message', 'Please check country/Currency Name');
                    $base_url = base_url();
                    redirect($base_url . 'ssa/admin/editcurrency/' . $currencyId);
                    exit();

                } else {
                    $this->session->set_flashdata('message', 'Currency name updated Successfully');
                    $base_url = base_url();
                    redirect($base_url . 'ssa/admin/currencylisting/');
                    exit();
                }
            }
        } else {
            $currencyId = $this->uri->segment('4');

            $this->load->view('layout/header');
            $parameterCurrency = array('p_mode' => 'Editselect',
                'a_CurrencyId' => $currencyId,
                'b_IsActive' => '1',
                'n_BusinessId' => '0',
                'n_AdminType' => $userId['a_SysAdminId'],
            );
            $pathCurrency = base_url() . "api/currencylisting/currency/format/json/";
            $responseCurrency = curlcall($parameterCurrency, $pathCurrency);
            $parameterCountry = array('countryName1' => 'null',
                //'d_CreatedOn' => 'null',
                'id' => 'null',
                'act_mode' => 'select',
                'n_CreatedBy' => 'null',
                //'d_ModifiedOn' => 'null',
                //'n_ModifiedBy' => 'null',
                'b_IsActive' => '1',
                'n_BusinessId' => 'null',
                'n_AdminType' => $userId['a_SysAdminId'],
            );
            $pathCountry = base_url() . "api/countrylisting/country/format/json/";
            $responseCountry = curlcall($parameterCountry, $pathCountry);
            if (($responseCurrency == 'Something Went Wrong') || ($responseCountry == 'Something Went Wrong')) {
                $this->session->set_flashdata('message', 'Please check country Name');
                $base_url = base_url();
                redirect($base_url . 'ssa/admin/currencyadd/');
                exit();
            } else {
                $data['currency'] = $responseCurrency;
                $data['country'] = $responseCountry;
                $this->load->view('setting/editCurrency', $data);
                $this->load->view('layout/footer');
            }
        }

    }

    public function deletecurrency()
    {
        $this->login_check();
        $userId = checklogin();
        $currencyId = $this->uri->segment('4');
        $parameter = array('p_mode' => 'Delete',
            'a_CurrencyId' => $currencyId,
            'n_CountryId' => 'null',
            't_CurrencyName' => 'null',
            'n_CreatedBy' => 'null',
            'n_ModifiedBy' => 'null',
            'b_IsActive' => '1',
            'n_BusinessId' => 'null',
            'n_AdminType' => $userId['a_SysAdminId'],
        );
        $path = base_url() . "api/currencylisting/currency/format/json/";
        $response = curlcall($parameter, $path);
        if ($response == 'Something Went Wrong') {
            $this->session->set_flashdata('message', 'Currency Name Already Deleted');
            $base_url = base_url();
            redirect($base_url . 'ssa/admin/currencylisting/');
            exit();
        } else {
            $this->session->set_flashdata('message', 'Currency name deleted Successfully');
            $base_url = base_url();
            redirect($base_url . 'ssa/admin/currencylisting/');
            exit();
        }
    }


    public function dmlisting()
    {
        $this->login_check();
        $this->load->view('layout/header');
        $userId = checklogin();
        $parameter = array('p_mode' => 'Select',
            'a_SettingId' => 'null',
            'n_BusinessId' => 'null',
            'n_EnumId' => '4',
            'n_AdminType' => $userId['a_SysAdminId'],
        );
        // api call starts
        $path = base_url() . "api/dmlisting/dm/format/json/";
        $response = curlcall($parameter, $path);
        // api call ends
        if ($response == 'Something Went Wrong') {
            $this->session->set_flashdata('message', 'Please check Measurement Name');
            $base_url = base_url();
            redirect($base_url . 'ssa/admin/dmadd/');
            exit();
        } else {
            $data['listing'] = $response;
            $this->load->view('setting/dmListing', $data);
            $this->load->view('layout/footer');
        }
    }


    public function dmadd()
    {
        $this->login_check();
        if (isset($_POST['submit'])) {
            $userId = checklogin();
            $enumTypeId = $this->input->post('enum_type_id');

            $this->form_validation->set_rules('dm_name', 'Distance Measurement Name', 'trim|required|xss_clean|');
            if ($this->form_validation->run() != false) {

                $typeId = $this->input->post('type_id');
                $dmName = $this->input->post('dm_name');
                $parameter = array('p_mode' => 'Insert',
                    'a_SettingId' => 'null',
                    'n_EnumId' => $enumTypeId,
                    't_SettingValue' => $dmName,
                    'n_CreatedBy' => 'null',
                    'b_IsActive' => '1',
                    'n_BusinessId' => 'null',
                    'n_AdminType' => $userId['a_SysAdminId'],
                );
                $path = base_url() . "api/dmlisting/dm/format/json/";
                $response = curlcall($parameter, $path);
                if ($response == 'Something Went Wrong') {
                    $this->session->set_flashdata('message', 'Please check Measurement Name');
                    $base_url = base_url();
                    redirect($base_url . 'ssa/admin/dmAdd/');
                    exit();

                } else {
                    $this->session->set_flashdata('message', 'Distance Measurement name added Successfully');
                    $base_url = base_url();
                    redirect($base_url . 'ssa/admin/dmlisting/');
                    exit();
                }
            }
        } else {

            $this->load->view('layout/header');
            $this->load->view('setting/dmAdd');
        }

    }

    public function editdm()
    {
        $this->login_check();
        $userId = checklogin();
        if (isset($_POST['submit'])) {
            $enumTypeId = $this->input->post('enum_type_id');
            $settingId = $this->input->post('dm_id');
            $this->form_validation->set_rules('dm_name', 'Distance Measurement Name', 'trim|required|xss_clean|');
            if ($this->form_validation->run() != false) {
                $dmName = $this->input->post('dm_name');
                $parameter = array('p_mode' => 'Update',
                    'a_SettingId' => $settingId,
                    'n_EnumId' => $enumTypeId,
                    't_SettingValue' => $dmName,
                    'n_CreatedBy' => 'null',
                    'b_IsActive' => '1',
                    'n_BusinessId' => "null",
                    'n_AdminType' => $userId['a_SysAdminId'],
                );

                $path = base_url() . "api/dmlisting/dm/format/json/";
                $response = curlcall($parameter, $path);
                if ($response == 'Something Went Wrong') {
                    $this->session->set_flashdata('message', 'Please check Measurement Name');
                    $base_url = base_url();
                    redirect($base_url . 'ssa/admin/editdm/' . $dmId);
                    exit();

                } else {
                    $this->session->set_flashdata('message', 'Distance Measurement name updated Successfully');
                    $base_url = base_url();
                    redirect($base_url . 'ssa/admin/dmlisting/');
                    exit();
                }
            }
        } else {
            $dmSettingId = $this->uri->segment('4');
            $this->load->view('layout/header');
            $parameter = array('p_mode' => 'Editselect',
                'a_SettingId' => $dmSettingId,
                'n_BusinessId' => 'null',
                'n_EnumId' => '4',
                'n_AdminType' => $userId['a_SysAdminId'],
            );
            $path = base_url() . "api/dmlisting/dm/format/json/";
            $response = curlcall($parameter, $path);
            if ($response == 'Something Went Wrong') {
                $this->session->set_flashdata('message', 'Please check Measurement Name');
                $base_url = base_url();
                redirect($base_url . 'ssa/admin/dmadd/');
                exit();
            } else {
                $data['listing'] = $response;
                $this->load->view('setting/editDm', $data);
                $this->load->view('layout/footer');
            }
        }

    }

    public function deletedm()
    {
        $this->login_check();
        $userId = checklogin();
        $dmSettingId = $this->uri->segment('4');
        $parameter = array('p_mode' => 'Delete',
            'a_SettingId' => $dmSettingId,
            'n_EnumId' => "null",
            't_SettingValue' => 'null',
            'n_CreatedBy' => 'null',
            'b_IsActive' => '1',
            'n_BusinessId' => "null",
            'n_AdminType' => $userId['a_SysAdminId'],
        );
        $path = base_url() . "api/dmlisting/dm/format/json/";
        $response = curlcall($parameter, $path);
        if ($response == 'Something Went Wrong') {
            $this->session->set_flashdata('message', 'Measurement Name Already Deleted');
            $base_url = base_url();
            redirect($base_url . 'ssa/admin/dmlisting/');
            exit();
        } else {
            $this->session->set_flashdata('message', 'Distance Measurement name deleted Successfully');
            $base_url = base_url();
            redirect($base_url . 'ssa/admin/dmlisting/');
            exit();
        }
    }


    public function billinglisting()
    {
        $this->login_check();
        $this->load->view('layout/header');
        $userId = checklogin();
        $parameter = array('p_mode' => 'Select',
            'a_SettingId' => 'null',
            'n_BusinessId' => 'null',
            'n_EnumId' => 5,
            'n_AdminType' => $userId['a_SysAdminId'],
        );
        $path = base_url() . "api/dmlisting/billing/format/json/";
        $response = curlcall($parameter, $path);
        if ($response == 'Something Went Wrong') {
            $this->session->set_flashdata('message', 'Please check Billing Name');
            $base_url = base_url();
            redirect($base_url . 'ssa/admin/billingadd/');
            exit();
        } else {
            $data['listing'] = $response;
            $this->load->view('setting/billingListing', $data);
            $this->load->view('layout/footer');
        }
    }


    public function billingadd()
    {
        $this->login_check();
        if (isset($_POST['submit'])) {
            $userId = checklogin();
            $enumTypeId = $this->input->post('enum_type_id');

            $this->form_validation->set_rules('billing_name', 'Billing Name', 'trim|required|xss_clean|');
            if ($this->form_validation->run() != false) {

                $typeId = $this->input->post('type_id');
                $billingName = $this->input->post('billing_name');
                $parameter = array('p_mode' => 'Insert',
                    'a_SettingId' => 'null',
                    'n_EnumId' => $enumTypeId,
                    't_SettingValue' => $billingName,
                    'n_CreatedBy' => 'null',
                    'b_IsActive' => '1',
                    'n_BusinessId' => 'null',
                    'n_AdminType' => $userId['a_SysAdminId'],
                );
                $path = base_url() . "api/dmlisting/billing/format/json/";
                $response = curlcall($parameter, $path);
                if ($response == 'Something Went Wrong') {
                    $this->session->set_flashdata('message', 'Please check Billing Name');
                    $base_url = base_url();
                    redirect($base_url . 'ssa/admin/billingAdd/');
                    exit();

                } else {
                    $this->session->set_flashdata('message', 'Billing name added Successfully');
                    $base_url = base_url();
                    redirect($base_url . 'ssa/admin/billinglisting/');
                    exit();
                }
            }
        } else {

            $this->load->view('layout/header');
            $this->load->view('setting/billingAdd');
        }

    }

    public function editbilling()
    {
        $this->login_check();
        $userId = checklogin();
        if (isset($_POST['submit'])) {
            $enumTypeId = $this->input->post('enum_type_id');
            $settingId = $this->input->post('dm_id');
            $this->form_validation->set_rules('billing_name', 'Billing Name', 'trim|required|xss_clean|');
            if ($this->form_validation->run() != false) {
                $billingName = $this->input->post('billing_name');
                $parameter = array('p_mode' => 'Update',
                    'a_SettingId' => $settingId,
                    'n_EnumId' => $enumTypeId,
                    't_SettingValue' => $billingName,
                    'n_CreatedBy' => 'null',
                    'b_IsActive' => '1',
                    'n_BusinessId' => "null",
                    'n_AdminType' => $userId['a_SysAdminId'],
                );
                $path = base_url() . "api/dmlisting/billing/format/json/";
                $response = curlcall($parameter, $path);
                if ($response == 'Something Went Wrong') {
                    $this->session->set_flashdata('message', 'Please check Billing Name');
                    $base_url = base_url();
                    redirect($base_url . 'ssa/admin/editbilling/' . $dmId);
                    exit();

                } else {
                    $this->session->set_flashdata('message', 'Billing name updated Successfully');
                    $base_url = base_url();
                    redirect($base_url . 'ssa/admin/billinglisting/');
                    exit();
                }
            }
        } else {
            $dmSettingId = $this->uri->segment('4');
            $this->load->view('layout/header');
            $parameter = array('p_mode' => 'Editselect',
                'a_SettingId' => $dmSettingId,
                'n_BusinessId' => 'null',
                'n_EnumId' => 'null',
                'n_AdminType' => $userId['a_SysAdminId'],
            );
            $path = base_url() . "api/dmlisting/billing/format/json/";
            $response = curlcall($parameter, $path);
            if ($response == 'Something Went Wrong') {
                $this->session->set_flashdata('message', 'Please check Billing Name');
                $base_url = base_url();
                redirect($base_url . 'ssa/admin/billingadd/');
                exit();
            } else {
                $data['listing'] = $response;
                $this->load->view('setting/editBilling', $data);
                $this->load->view('layout/footer');
            }
        }

    }

    public function deletebilling()
    {
        $this->login_check();
        $userId = checklogin();
        $dmSettingId = $this->uri->segment('4');
        $parameter = array('p_mode' => 'Delete',
            'a_SettingId' => $dmSettingId,
            'n_EnumId' => "null",
            't_SettingValue' => 'null',
            'n_CreatedBy' => 'null',
            'b_IsActive' => '1',
            'n_BusinessId' => "null",
            'n_AdminType' => $userId['a_SysAdminId'],
        );
        $path = base_url() . "api/dmlisting/billing/format/json/";
        $response = curlcall($parameter, $path);
        if ($response == 'Something Went Wrong') {
            $this->session->set_flashdata('message', 'Billing Name Already Deleted');
            $base_url = base_url();
            redirect($base_url . 'ssa/admin/billinglisting/');
            exit();
        } else {
            $this->session->set_flashdata('message', 'Billing name deleted Successfully');
            $base_url = base_url();
            redirect($base_url . 'ssa/admin/billinglisting/');
            exit();
        }
    }

    public function packagelisting()
    {
        $this->login_check();
        $this->load->view('layout/header');
        $userId = checklogin();
        $parameter = array('p_mode' => 'Select',
            'a_SettingId' => 'null',
            'n_BusinessId' => 'null',
            'n_EnumId' => 6,
            'n_AdminType' => $userId['a_SysAdminId'],
        );
        $path = base_url() . "api/dmlisting/billing/format/json/";
        $response = curlcall($parameter, $path);
        if ($response == 'Something Went Wrong') {
            $this->session->set_flashdata('message', 'Please check Package Name');
            $base_url = base_url();
            redirect($base_url . 'ssa/admin/packageadd/');
            exit();
        } else {
            $data['listing'] = $response;
            $this->load->view('setting/packageListing', $data);
            $this->load->view('layout/footer');
        }
    }


    public function packageadd()
    {
        $this->login_check();
        if (isset($_POST['submit'])) {
            $userId = checklogin();
            $enumTypeId = $this->input->post('enum_type_id');

            $this->form_validation->set_rules('package_name', 'Package Name', 'trim|required|xss_clean|');
            if ($this->form_validation->run() != false) {

                $typeId = $this->input->post('type_id');
                $packageName = $this->input->post('package_name');
                $parameter = array('p_mode' => 'Insert',
                    'a_SettingId' => 'null',
                    'n_EnumId' => $enumTypeId,
                    't_SettingValue' => $packageName,
                    'n_CreatedBy' => 'null',
                    'b_IsActive' => '1',
                    'n_BusinessId' => 'null',
                    'n_AdminType' => $userId['a_SysAdminId'],
                );
                $path = base_url() . "api/dmlisting/billing/format/json/";
                $response = curlcall($parameter, $path);
                if ($response == 'Something Went Wrong') {
                    $this->session->set_flashdata('message', 'Please check Package Name');
                    $base_url = base_url();
                    redirect($base_url . 'ssa/admin/packageAdd/');
                    exit();

                } else {
                    $this->session->set_flashdata('message', 'Package name added Successfully');
                    $base_url = base_url();
                    redirect($base_url . 'ssa/admin/packagelisting/');
                    exit();
                }
            }
        } else {

            $this->load->view('layout/header');
            $this->load->view('setting/packageAdd');
        }

    }

    public function editpackage()
    {
        $this->login_check();
        $userId = checklogin();
        if (isset($_POST['submit'])) {
            $enumTypeId = $this->input->post('enum_type_id');
            $settingId = $this->input->post('dm_id');
            $this->form_validation->set_rules('package_name', 'Package Name', 'trim|required|xss_clean|');
            if ($this->form_validation->run() != false) {
                $packageName = $this->input->post('package_name');
                $parameter = array('p_mode' => 'Update',
                    'a_SettingId' => $settingId,
                    'n_EnumId' => $enumTypeId,
                    't_SettingValue' => $packageName,
                    'n_CreatedBy' => 'null',
                    'b_IsActive' => '1',
                    'n_BusinessId' => "null",
                    'n_AdminType' => $userId['a_SysAdminId'],
                );
                $path = base_url() . "api/dmlisting/billing/format/json/";
                $response = curlcall($parameter, $path);
                if ($response == 'Something Went Wrong') {
                    $this->session->set_flashdata('message', 'Please check Package Name');
                    $base_url = base_url();
                    redirect($base_url . 'ssa/admin/editpackage/' . $dmId);
                    exit();

                } else {
                    $this->session->set_flashdata('message', 'Package name updated Successfully');
                    $base_url = base_url();
                    redirect($base_url . 'ssa/admin/packagelisting/');
                    exit();
                }
            }
        } else {
            $dmSettingId = $this->uri->segment('4');
            $this->load->view('layout/header');
            $parameter = array('p_mode' => 'Editselect',
                'a_SettingId' => $dmSettingId,
                'n_BusinessId' => 'null',
                'n_EnumId' => 'null',
                'n_AdminType' => $userId['a_SysAdminId'],
            );
            $path = base_url() . "api/dmlisting/billing/format/json/";
            $response = curlcall($parameter, $path);
            if ($response == 'Something Went Wrong') {
                $this->session->set_flashdata('message', 'Please check Package Name');
                $base_url = base_url();
                redirect($base_url . 'ssa/admin/packageadd/');
                exit();
            } else {
                $data['listing'] = $response;
                $this->load->view('setting/editpackage', $data);
                $this->load->view('layout/footer');
            }
        }

    }

    public function deletepackage()
    {
        $this->login_check();
        $userId = checklogin();
        $dmSettingId = $this->uri->segment('4');
        $parameter = array('p_mode' => 'Delete',
            'a_SettingId' => $dmSettingId,
            'n_EnumId' => "null",
            't_SettingValue' => 'null',
            'n_CreatedBy' => 'null',
            'b_IsActive' => '1',
            'n_BusinessId' => "null",
            'n_AdminType' => $userId['a_SysAdminId'],
        );
        $path = base_url() . "api/dmlisting/billing/format/json/";
        $response = curlcall($parameter, $path);
        if ($response == 'Something Went Wrong') {
            $this->session->set_flashdata('message', 'Package Name Already Deleted');
            $base_url = base_url();
            redirect($base_url . 'ssa/admin/packagelisting/');
            exit();
        } else {
            $this->session->set_flashdata('message', 'Package name deleted Successfully');
            $base_url = base_url();
            redirect($base_url . 'ssa/admin/packagelisting/');
            exit();
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

    // forgate password   ans
    function ssa_admin_mail_check()
    {
        $parameter = array('email' => $_POST['email'], 'ans' => 'aa');
        $path = base_url() . "api/super_state_admin/ssamailcheck/format/json/";
        $response = curlcall($parameter, $path);
        $value = json_encode($response);
        echo $value;

        exit;
    }

// forgate password End 
    function ssa_admin_ansmail_check()
    {
        $parameter = array('email' => $_POST['email'], 'ans' => $_POST['ans']);
        //p($parameter);  exit;
        $path = base_url() . "api/super_state_admin/mailquestion/format/json/";
        $response = curlcall($parameter, $path);
        $value = json_encode($response);
        echo $value;

        exit;
    }

    function ssa_admin_password_send()
    {
        $parameter = array('email' => $_POST['email'], 'ans' => $_POST['ans']);
        //p($parameter);  exit;
        $path = base_url() . "api/super_state_admin/mailpasswordsend/format/json/";
        $response = curlcall($parameter, $path);
        // p($response);
        if ($response == "Something Went Wrong") {
            echo '0';
            exit;
        } else {
            echo '1';
            exit;
        }


    }


// end of the class
}




// ==================================================
//
//  List of all the tables and procedures used will come here
//  Supper Admin Table  = tbl_systemlogin;
//  Supper Admin Login Procedure  =  proc_adminLogin
//  country TableName = "tblcountry";
//  procedure for this is    = "countryManage"; 
//
// ================================================== 