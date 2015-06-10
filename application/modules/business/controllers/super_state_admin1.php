<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Super_state_admin1 extends MX_Controller {
 
  public function __construct() {
	$this->load->model("supper_admin");	
	$this->load->helper('my_helper');
  }


//Login Function
public function index(){

      if(isset($_POST['submit']) and $_POST['submit']=='Login'){
        $this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[5]|xss_clean|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[255]|xss_clean');
        if($this->form_validation->run() != false){
          $parameter = array(
                            'p_mode'         => 'login',
                            'p_Username'     => $this->input->post('email'),
                            'p_Password'     => md5($this->input->post('password')),
                          );
      // api call comes here
          $path  = base_url().'api/super_state_admin1/emp/format/json/';
          $response  = curlcall($parameter, $path);
      p($response);
      exit();
      if($response =='Something Went Wrong'){
            
            $this->session->set_flashdata('message','Please check email and password');
            $base_url  = base_url();
            redirect($base_url.'super_state_admin/super_state_admin1/index');
            exit();

        }else{

          $myarray = array(
                       'firstName'    => $response->firstName,
                       'lastName'     => $response->lastName,
                       'a_SId'        => $response->a_SysloginId,
                       'a_SysAdminId' => $response->a_SysAdminId,
                       't_username'   => $response->t_username,
                       'd_modifiedon' => $response->d_modifiedon,
                    );  
          $this->session->set_userdata('sessionData', $myarray);  
          $base_url  = base_url();
          redirect($base_url.'super_state_admin/super_state_admin1/dashboard/');
            exit();                       
          }

          // api call ends here

        } 
      } 
    $this->load->view('login');
   }
   //End of Login Function
// After login of the Admin
   public function dashboard(){
      $this->login_check();
      $this->load->view('layout/header');
      $this->load->view('layout/footer');
   }
public function getStateDropDown(){

    //$this->login_check();
    //$userId= checklogin();
    $countryId=$_POST['id'];
    $parameterState = array( 'id' => $countryId,
                        'b_IsActive' => '1',
                        'n_BusinessId' => '0',
                        'p_mode' => 'Stateselect',
                        'n_AdminType' => 33,
                      );
    
   $pathState  = base_url()."api/statelisting/state/format/json/";
   $responseState  = curlcall($parameterState, $pathState);
    
         if($responseState =='Something Went Wrong'){
               $this->session->set_flashdata('message','Please check state Name');
               $base_url  = base_url();
               redirect($base_url.'ssa/admin/stateadd/');
               exit();
         }else{
          echo json_encode($responseState);
           
            exit();
          }
  }


  public function getCityDropDown(){
    //$this->login_check();
    //$userId= checklogin();
    $stateId=$_POST['id'];

    $parameter=array(  'p_mode' => 'CitySelect',
                       'a_CityId' => 'null',
                       'n_StateId' => $stateId,
                       'n_AdminType' => 33
                        );
   $path  = base_url()."api/citylisting/city/format/json/";
   $response  = curlcall($parameter, $path);
    
         if($response =='Something Went Wrong'){
               $this->session->set_flashdata('message','Please check city Name');
               $base_url  = base_url();
               redirect($base_url.'ssa/admin/cityadd/');
               exit();
         }else{
          echo json_encode($response);
           
            exit();
          }
  }
public function searchName(){
  $empName=$_POST['name'];
  //echo $empName;
  // p($_POST);
  // exit();
  if(!empty($_POST['name'])){
    $parameter=array(
                      'p_mode' => 'SearchSelect',
                      'p_BusnAdminId'=>'null',
                      'p_FirstName' => $empName,
                      'p_LastName' => $empName,
                      'p_BusinessId' => 23,
                    );
  }else{
    $parameter=array(
                      'p_mode' => 'SearchSelect',
                      'p_BusnAdminId'=>'null',
                      'p_FirstName' => 'null',
                      'p_LastName' => 'null',
                      'p_BusinessId' => 22,
                    );
   }
  
  $path  = base_url()."api/super_state_admin1/emp/format/json/";
  $response  = curlcall($parameter, $path);
  if($response =='Something Went Wrong'){
        //echo json_encode(array('t_EmpFirstName'));

    }else{
        echo json_encode($response);
    }
}

// Add Function to add the new admin
public function business_admin_business_admin_panel(){
   if(isset($_POST['submit'])){
     //p($_POST);
      $userId= checklogin();
      $this->form_validation->set_rules('status', 'Status', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('department', 'Department', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('employee_id', 'Employee Id', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('date_of_birth', 'Date Of Birth', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('office_phone', 'Office Phone', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('mobile_phone', 'Mobile Phone', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('address_line1', 'Address Line1', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('address_line2', 'Address Line2', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('address_line3', 'Address Line3', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('country_id', 'Country', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('state_id', 'State', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('city_id', 'City', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('pin_code', 'Pincode', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('amount', 'Amount', 'trim|required|xss_clean|required');

      if($this->form_validation->run() != false){
        //$empCode=$this->input->post('employee_id');
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
        $date=date('Y:m:d');
        // header('Content-type: text/xml');
         $xml =htmlentities("<NewDataSet>");
             
              foreach ($editPolicy as $key => $value) {
                $xml .=htmlentities('<tblempaccessmap><n_RoleAccessId>'.$value.'</n_RoleAccessId></tblempaccessmap>');
              }
              $xml .=htmlentities("</NewDataSet>");
           $parameter = array( 'p_mode'         =>  'Insert',
                               'p_BusnAdminId'  =>  'null',
                               'p_AdminCode'    =>  $employeeCode,
                               'p_FirstName'    =>  $firstName,
                               'p_LastName'     =>  $lastName,
                               'p_DeptId'       =>  $department,
                               'p_Contact'      =>  $officePhone,
                               'p_Mobile'       =>  $mobilePhone,
                               'p_DOB'          =>  $dateOfBirth,
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
                               'p_CreatedBy'    =>  'null',
                               'p_BusinessId'   =>  23,
                               'p_AdminType'    =>  'null',
                               );
          $path  = base_url()."api/super_state_admin1/emp/format/json/";
          $response  = curlcall($parameter, $path);
          if($response =='Something Went Wrong'){
                  $this->session->set_flashdata('message','Please All the Fields Name');
                  $base_url  = base_url();
                  redirect($base_url.'super_state_admin/super_state_admin1/business_admin_business_admin_panel/');
                  exit();

            }else{
             
                $this->session->set_flashdata('message','Inserted Successfully');
                redirect($base_url.'super_state_admin/super_state_admin1/business_admin_business_admin_panel/');
                exit();
            }
      }
   }else{


        $parameterSide=array(
                        'p_mode' => 'SelectList',
                        'p_BusnAdminId'=>'null',
                        'p_FirstName' => 'null',
                        'p_LastName' => 'null',
                        'p_BusinessId' => 23,
                      );
        $pathSide  = base_url()."api/super_state_admin1/emp/format/json/";
        $responseSide  = curlcall($parameterSide, $pathSide);
       if($responseSide =='Something Went Wrong'){
               $this->session->set_flashdata('message','Please check Role Name');
               $base_url  = base_url();
               redirect($base_url.'ssa/admin/Roleadd/');
               exit();
         }else{
            $data['side']=$responseSide;
         }

         $this->load->view('layout/header');
         $parameterCountry = array( 'countryName1' => 'null',
                               'd_CreatedOn' => 'null',
                               'id' => 'null',
                               'act_mode' => 'select',
                               'n_CreatedBy' => 'null',
                               'd_ModifiedOn' => 'null',
                               'n_ModifiedBy' => 'null',
                               'b_IsActive' => '1',
                               'n_BusinessId' => 'null',
                               'n_AdminType' => 33,
                              );

   $parameterRole= array( 'p_mode' => 'Select',
                           'p_id' => 'null',
                           'p_businessId' =>0 ,
                           'p_AdminType' => 33,
                        );
   $pathRole  = base_url()."api/super_state_admin1/role/format/json/";
   $responseRole  = curlcall($parameterRole, $pathRole);
   if($responseRole =='Something Went Wrong'){
               $this->session->set_flashdata('message','Please check Role Name');
               $base_url  = base_url();
               redirect($base_url.'ssa/admin/Roleadd/');
               exit();
         }else{
            $data['role']=$responseRole;
            
                               
         }

   $pathCountry  = base_url()."api/countrylisting/country/format/json/";
   $responseCountry  = curlcall($parameterCountry, $pathCountry);
  if($responseCountry =='Something Went Wrong'){
               $this->session->set_flashdata('message','Please check country Name');
               $base_url  = base_url();
               redirect($base_url.'ssa/admin/countryadd/');
               exit();
         }else{
            $data['country']=$responseCountry;
            $this->load->view('super_state_admin/business_admin_business_admin_panel',$data);
                               
         }
      }
}

public function edit_business_admin_business_admin_panel(){

  if(isset($_POST['submit'])){
     


      //$userId= checklogin();
      $this->form_validation->set_rules('status', 'Status', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('department', 'Department', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('employee_id', 'Employee Id', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('date_of_birth', 'Date Of Birth', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('office_phone', 'Office Phone', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('mobile_phone', 'Mobile Phone', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('address_line1', 'Address Line1', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('address_line2', 'Address Line2', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('address_line3', 'Address Line3', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('country_id', 'Country', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('state_id', 'State', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('city_id', 'City', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('pin_code', 'Pincode', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('amount', 'Amount', 'trim|required|xss_clean|required');

      if($this->form_validation->run() != false){



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

         $date=date('Y:m:d');
        $xml =htmlentities("<NewDataSet>");
             
              foreach ($editPolicy as $key => $value) {
                $xml .=htmlentities('<tblempaccessmap><n_RoleAccessId>'.$value.'</n_RoleAccessId></tblempaccessmap>');
              }
              $xml .=htmlentities("</NewDataSet>");



     $parameterUpdate = array( 'p_mode'         =>  'Update',
                               'p_BusnAdminId'  =>  $empUpdate,
                               'p_AdminCode'    =>  $employeeCode,
                               'p_FirstName'    =>  $firstName,
                               'p_LastName'     =>  $lastName,
                               'p_DeptId'       =>  $department,
                               'p_Contact'      =>  $officePhone,
                               'p_Mobile'       =>  $mobilePhone,
                               'p_DOB'          =>  $dateOfBirth,
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
                               'p_CreatedBy'    =>  'null',
                               'p_BusinessId'   =>  23,
                               'p_AdminType'    =>  'null',
                               );

          $pathUpdate  = base_url()."api/super_state_admin1/emp/format/json/";
          $response  = curlcall($parameterUpdate, $pathUpdate);

          if($response =='Something Went Wrong'){
                  $this->session->set_flashdata('message','Please All Fields Name');
                  $base_url  = base_url();
                  redirect($base_url.'super_state_admin/super_state_admin1/edit_business_admin_business_admin_panel/'.$empUpdate);
                  exit();

            }else{
             
                $this->session->set_flashdata('message','Updated Successfully');
                redirect($base_url.'super_state_admin/super_state_admin1/business_admin_business_admin_panel/');
                exit();
            }
      }
   }else{


        $parameterSide=array(
                        'p_mode' => 'SelectList',
                        'p_BusnAdminId'=>'null',
                        'p_FirstName' => 'null',
                        'p_LastName' => 'null',
                        'p_BusinessId' => 23,
                      );
        $pathSide  = base_url()."api/super_state_admin1/emp/format/json/";
        $responseSide  = curlcall($parameterSide, $pathSide);
       if($responseSide =='Something Went Wrong'){
               $this->session->set_flashdata('message','Please check Role Name');
               $base_url  = base_url();
               redirect($base_url.'ssa/admin/Roleadd/');
               exit();
         }else{
            $data['side']=$responseSide;
         }


      $empId=$this->uri->segment('4');
      $parameterEmpData=array(
                        'p_mode' => 'SelectEdit',
                        'p_BusnAdminId'=>$empId,
                        'p_FirstName' => 'null',
                        'p_LastName' => 'null',
                        'p_BusinessId' => 23,
                      );
        $pathEmpData  = base_url()."api/super_state_admin1/emp/format/json/";
        $responseEmpData  = curlcall($parameterEmpData, $pathEmpData);
       if($responseEmpData =='Something Went Wrong'){
               $this->session->set_flashdata('message','Please check Role Name');
               $base_url  = base_url();
               redirect($base_url.'ssa/admin/Roleadd/');
               exit();
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
           $pathState  = base_url()."api/statelisting/state/format/json/";
           $responseState  = curlcall($parameterState, $pathState);
           if($responseState =='Something Went Wrong'){
                       $this->session->set_flashdata('message','Please check state Name');
                       $base_url  = base_url();
                       redirect($base_url.'ssa/admin/stateadd/');
                       exit();
                 }else{
                  $data['stateList']=$responseState;
                  }

            $parameterCity = array( 'p_mode' => 'CitySelect',
                                'a_CityId' => 'null',
                                'n_StateId' => $stateId,
                                'n_AdminType' => 33,
                              );
           $pathCity  = base_url()."api/citylisting/city/format/json/";
           $responseCity  = curlcall($parameterCity, $pathCity);
           if($responseCity =='Something Went Wrong'){
                       $this->session->set_flashdata('message','Please check state Name');
                       $base_url  = base_url();
                       redirect($base_url.'ssa/admin/stateadd/');
                       exit();
                 }else{
                  $data['cityList']=$responseCity;
                  }
            $data['empData']=$responseEmpData;
         }

         
         $this->load->view('layout/header');
         $parameter = array( 'countryName1' => 'null',
                               'd_CreatedOn' => 'null',
                               'id' => 'null',
                               'act_mode' => 'select',
                               'n_CreatedBy' => 'null',
                               'd_ModifiedOn' => 'null',
                               'n_ModifiedBy' => 'null',
                               'b_IsActive' => '1',
                               'n_BusinessId' => 'null',
                               'n_AdminType' => 33,
                              );

   $parameterRole= array( 'p_mode' => 'Select',
                           'p_id' => 'null',
                           'p_businessId' =>0 ,
                           'p_AdminType' => 33,
                        );
   $pathRole  = base_url()."api/super_state_admin1/role/format/json/";
   $responseRole  = curlcall($parameterRole, $pathRole);
   if($responseRole =='Something Went Wrong'){
               $this->session->set_flashdata('message','Please check Role Name');
               $base_url  = base_url();
               redirect($base_url.'ssa/admin/Roleadd/');
               exit();
         }else{
            $data['role']=$responseRole;
            
                               
         }

         if($responseRole =='Something Went Wrong'){
               $this->session->set_flashdata('message','Please check Role Name');
               $base_url  = base_url();
               redirect($base_url.'ssa/admin/Roleadd/');
               exit();
         }else{
            $data['role']=$responseRole;
            
                               
         }

   $path  = base_url()."api/countrylisting/country/format/json/";
   $response  = curlcall($parameter, $path);
         if($response =='Something Went Wrong'){
               $this->session->set_flashdata('message','Please check country Name');
               $base_url  = base_url();
               redirect($base_url.'ssa/admin/countryadd/');
               exit();
         }else{
            $data['country']=$response;
            $this->load->view('super_state_admin/edit_business_admin_business_admin_panel',$data);
                               
         }
      }
  
}




public function login_check(){
  $data = checklogin();
  if($data['a_SysAdminId'] != 23){
    $baseURl = base_url();
    redirect($baseURl.'business');
    exit();
  }
 }





public function policyEditCreateMileage(){
   $this->login_check();
   $this->load->view('layout/header');
   //if(isset($_POST['submit']))
   //$parameter = array(
   //             'countryName' => '',
   //             'd_CreatedOn' => '',
   //             'id' => '',
   //             'act_mode' => 'insertinto',
   //            );
   //$data = $this->supper_admin->call_procedureRow('countryManage', $parameter);

   $this->load->view('super_state_admin/policyEditCreateMileage');
   $this->load->view('layout/footer');
}

public function policyEditCreatePeriod(){
   $this->login_check();
   $this->load->view('layout/header');
   //if(isset($_POST['submit']))
   //$parameter = array(
   //             'countryName' => '',
   //             'd_CreatedOn' => '',
   //             'id' => '',
   //             'act_mode' => 'insertinto',
   //            );
   //$data = $this->supper_admin->call_procedureRow('countryManage', $parameter);

   $this->load->view('super_state_admin/policyEditCreatePeriod');
   $this->load->view('layout/footer');
}
public function policyEditCreateGeneral(){
   $this->login_check();
   $this->load->view('layout/header');
   //if(isset($_POST['submit']))
   //$parameter = array(
   //             'countryName' => '',
   //             'd_CreatedOn' => '',
   //             'id' => '',
   //             'act_mode' => 'insertinto',
   //            );
   //$data = $this->supper_admin->call_procedureRow('countryManage', $parameter);

   $this->load->view('super_state_admin/policyEditCreateGeneral');
   $this->load->view('layout/footer');
}
public function reimbursementOption(){
   $this->login_check();
   $this->load->view('layout/header');
   //if(isset($_POST['submit']))
   //$parameter = array(
   //             'countryName' => '',
   //             'd_CreatedOn' => '',
   //             'id' => '',
   //             'act_mode' => 'insertinto',
   //            );
   //$data = $this->supper_admin->call_procedureRow('countryManage', $parameter);

   $this->load->view('super_state_admin/reimbursementOption');
   $this->load->view('layout/footer');
}
public function policyList(){
   $this->login_check();
   $this->load->view('layout/header');
   //if(isset($_POST['submit']))
   //$parameter = array(
   //             'countryName' => '',
   //             'd_CreatedOn' => '',
   //             'id' => '',
   //             'act_mode' => 'insertinto',
   //            );
   //$data = $this->supper_admin->call_procedureRow('countryManage', $parameter);

   $this->load->view('super_state_admin/policyList');
   $this->load->view('layout/footer');
}
public function customTags(){
   $this->login_check();
   $this->load->view('layout/header');
   //if(isset($_POST['submit']))
   //$parameter = array(
   //             'countryName' => '',
   //             'd_CreatedOn' => '',
   //             'id' => '',
   //             'act_mode' => 'insertinto',
   //            );
   //$data = $this->supper_admin->call_procedureRow('countryManage', $parameter);

   $this->load->view('super_state_admin/customTags');
   $this->load->view('layout/footer');
}
public function businessPanelCategories(){
   $this->login_check();
   $this->load->view('layout/header');
   //if(isset($_POST['submit']))
   //$parameter = array(
   //             'countryName' => '',
   //             'd_CreatedOn' => '',
   //             'id' => '',
   //             'act_mode' => 'insertinto',
   //            );
   //$data = $this->supper_admin->call_procedureRow('countryManage', $parameter);

   $this->load->view('super_state_admin/businessPanelCategories');
   $this->load->view('layout/footer');
   }
   public function businessPanelDepartment(){
   $this->login_check();
   $this->load->view('layout/header');
   //if(isset($_POST['submit']))
   //$parameter = array(
   //             'countryName' => '',
   //             'd_CreatedOn' => '',
   //             'id' => '',
   //             'act_mode' => 'insertinto',
   //            );
   //$data = $this->supper_admin->call_procedureRow('countryManage', $parameter);

   $this->load->view('super_state_admin/businessPanelDepartment');
   $this->load->view('layout/footer');
   }
   public function businessPanelGeneral(){
   $this->login_check();
   $this->load->view('layout/header');
   //if(isset($_POST['submit']))
   //$parameter = array(
   //             'countryName' => '',
   //             'd_CreatedOn' => '',
   //             'id' => '',
   //             'act_mode' => 'insertinto',
   //            );
   //$data = $this->supper_admin->call_procedureRow('countryManage', $parameter);

   $this->load->view('super_state_admin/businessPanelGeneral');
   $this->load->view('layout/footer');
   }
function logout(){
	session_unset();
	echo $data = base_url();
	$this->session->sess_destroy();	
	redirect($data.'business');
	exit();
}
  public function downloadReport(){
   $this->login_check();
   $this->load->view('layout/header');
   //if(isset($_POST['submit']))
   //$parameter = array(
   //             'countryName' => '',
   //             'd_CreatedOn' => '',
   //             'id' => '',
   //             'act_mode' => 'insertinto',
   //            );
   //$data = $this->supper_admin->call_procedureRow('countryManage', $parameter);

   $this->load->view('super_state_admin/downloadReport');
   $this->load->view('layout/footer');
   }


// end of the class    
}




// ==================================================
//
//	List of all the tables and procedures used will come here
//  Supper Admin Table  = tbl_systemlogin;
//  Supper Admin Login Procedure  =  proc_adminLogin
//  country TableName = "tblcountry";
//  procedure for this is    = "countryManage"; 
//
// ================================================== 