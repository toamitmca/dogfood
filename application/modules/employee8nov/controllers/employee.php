<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Employee extends MX_Controller {
 
  public function __construct() {
	$this->load->model("supper_admin");	
	$this->load->helper('my_helper');
  }




public function getStateDropDown(){

    //$this->login_check();
    $userId= checklogin();
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
    $userId= checklogin();
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
}
public function add_employee(){
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
        
        $date=date('Y:m:d');
        // header('Content-type: text/xml');
         $xml =htmlentities("<NewDataSet>");
             
              foreach ($editPolicy as $key => $value) {
                $xml .=htmlentities('<tblempaccessmap><n_RoleAccessId>'.$value.'</n_RoleAccessId></tblempaccessmap>');
              }
              $xml .=htmlentities("</NewDataSet>");
            
          $parameter = array( 'p_mode' => 'Insert',
                               'p_EmpId' => 'null',
                               'p_IsAdmin' => 1,
                               'p_EmpCode' => $employeeCode,
                               'p_Empfname' => $firstName,
                               'p_EmpLastName' => $lastName,
                               'p_DeptId' => $department,
                               'p_PolicyId' => 'null',
                               'p_EmpDob' => $dateOfBirth,
                               'p_OfficePhno' => $officePhone,
                               'p_MobileNo' => $mobilePhone,
                               'p_AddFLine' => $addressLine1,
                               'p_AddSecLine' => $addressLine2,
                               'p_AddThrdLine' => $addressLine3,
                               'p_Country' => $countryId,
                               'p_State' => $stateId,
                               'p_City' => $cityId,
                               'p_PinCode' => $pinCode,
                               'p_Status' => $status,
                               'p_CreatedBy' => 'null',
                               'p_BusinessId' => 22,
                               'p_XmlDatatest' => (html_entity_decode($xml, ENT_QUOTES, 'UTF-8')),
                               'p_AmountRange' => $amount,
                               'p_CompareValue' => 'null'
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

        $parameterSide=array('p_mode' => 'SelectList',
                              'p_BusinessId' => 22,
                              'p_EmpId' => 'null',
                              'p_FirstName' => 'null',
                              'p_LastName' => 'null'
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
        

         $date=date('Y:m:d');
        $xml =htmlentities("<NewDataSet>");
             
              foreach ($editPolicy as $key => $value) {
                $xml .=htmlentities('<tblempaccessmap><n_RoleAccessId>'.$value.'</n_RoleAccessId></tblempaccessmap>');
              }
              $xml .=htmlentities("</NewDataSet>");
            
          $parameterUpdate = array( 'p_mode' => 'Update',
                               'p_EmpId' => $empUpdate,
                               'p_IsAdmin' => 1,
                               'p_EmpCode' => $employeeCode,
                               'p_Empfname' => $firstName,
                               'p_EmpLastName' => $lastName,
                               'p_DeptId' => $department,
                               'p_PolicyId' => 'null',
                               'p_EmpDob' => $dateOfBirth,
                               'p_OfficePhno' => $officePhone,
                               'p_MobileNo' => $mobilePhone,
                               'p_AddFLine' => $addressLine1,
                               'p_AddSecLine' => $addressLine2,
                               'p_AddThrdLine' => $addressLine3,
                               'p_Country' => $countryId,
                               'p_State' => $stateId,
                               'p_City' => $cityId,
                               'p_PinCode' => $pinCode,
                               'p_Status' => $status,
                               'p_CreatedBy' => 'null',
                               'p_BusinessId' => 22,
                               'p_XmlDatatest' => (html_entity_decode($xml, ENT_QUOTES, 'UTF-8')),
                               'p_AmountRange' => $amount,
                               'p_CompareValue' => 'null'
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
        

        $parameterSide=array('p_mode' => 'SelectList',
                              'p_BusinessId' => 22,
                              'p_EmpId' => 'null',
                              'p_FirstName' => 'null',
                              'p_LastName' => 'null'
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
        $parameterEmpData=array('p_mode' => 'SelectEdit',
                                'p_BusinessId' => 22,
                                'p_EmpId' => $empId,
                                'p_FirstName' => '',
                                'p_LastName' => '');
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
	redirect($data);
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