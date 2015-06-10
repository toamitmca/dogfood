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
  //echo $empName;
  if(!empty($_POST['name'])){
    $parameter=array('p_mode' => 'SearchSelect',
                              'p_BusinessId' => 22,
                              'p_IsAdmin'=>false,
                              'p_EmpId' => 'null',
                              'p_FirstName' => $empName,
                              'p_LastName' => $empName
                              );
  }else{
    $parameter=array('p_mode' => 'SelectList',
                              'p_BusinessId' => 22,
                              'p_IsAdmin'=>false,
                              'p_EmpId' => 'null',
                              'p_FirstName' => 'null',
                              'p_LastName' => 'null'
                              );
   }
  
  $path  = base_url()."api/employee/addemp/format/json/";
  $response  = curlcall($parameter, $path);
   if($response =='Something Went Wrong'){
        //echo json_encode(array('t_EmpFirstName'));

    }else{
        echo json_encode($response);
    }
}
public function add_employee(){
   if(isset($_POST['submit'])){

      //$userId= checklogin();
      $this->form_validation->set_rules('policy', 'Policy', 'trim|required|xss_clean|required');
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


      if($this->form_validation->run() != false){
        $policy=$this->input->post('policy');
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

        $parameter = array( 'p_mode' => 'Insert',
                               'p_EmpId' => 'null',
                               'p_IsAdmin' => false,
                               'p_EmpCode' => $employeeCode,
                               'p_Empfname' => $firstName,
                               'p_EmpLastName' => $lastName,
                               'p_DeptId' => $department,
                               'p_PolicyId' => $policy,
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
                              );
          $path  = base_url()."api/employee/addemp/format/json/";
          $response  = curlcall($parameter, $path);
          if($response =='Something Went Wrong'){
                  $this->session->set_flashdata('message','Please All the Fields Name');
                  $base_url  = base_url();
                  redirect($base_url.'employee/employee/add_employee/');
                  exit();

            }else{
             
                $this->session->set_flashdata('message','Inserted Successfully');
                redirect($base_url.'employee/employee/add_employee/');
                exit();
            }
      }
   }else{

        $parameterSide=array('p_mode' => 'SelectList',
                              'p_BusinessId' => 22,
                              'p_IsAdmin'=>false,
                              'p_EmpId' => 'null',
                              'p_FirstName' => 'null',
                              'p_LastName' => 'null'
                              );
        $pathSide  = base_url()."api/employee/addemp/format/json/";
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
                $pathCountry  = base_url()."api/countrylisting/country/format/json/";
                 $responseCountry  = curlcall($parameterCountry, $pathCountry);
                if($responseCountry =='Something Went Wrong'){
                             $this->session->set_flashdata('message','Please check country Name');
                             $base_url  = base_url();
                             redirect($base_url.'ssa/admin/countryadd/');
                             exit();
                       }else{
                          $data['country']=$responseCountry;
                          $this->load->view('employee/add_employee',$data);

                       }
                    }
  }

public function edit_employee(){

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
       $this->form_validation->set_rules('policy', 'Policy', 'trim|required|xss_clean|required');

    if($this->form_validation->run() != false){

         $policy=$this->input->post('policy');
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
        

        $parameterUpdate = array( 'p_mode' => 'Update',
                               'p_EmpId' => $empUpdate,
                               'p_IsAdmin' => false,
                               'p_EmpCode' => $employeeCode,
                               'p_Empfname' => $firstName,
                               'p_EmpLastName' => $lastName,
                               'p_DeptId' => $department,
                               'p_PolicyId' => $policy,
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
                              );
          $pathUpdate  = base_url()."api/employee/addemp/format/json/";
          $response  = curlcall($parameterUpdate, $pathUpdate);
          if($response =='Something Went Wrong'){
                  $this->session->set_flashdata('message','Please All Fields Name');
                  $base_url  = base_url();
                  redirect($base_url.'employee/employee/edit_employee/'.$empUpdate);
                  exit();

            }else{
             
                $this->session->set_flashdata('message','Updated Successfully');
                redirect($base_url.'employee/employee/add_employee');
                exit();
            }
      }
   }else{
        

        $parameterSide=array('p_mode' => 'SelectList',
                              'p_BusinessId' => 22,
                              'p_IsAdmin'=>false,
                              'p_EmpId' => 'null',
                              'p_FirstName' => 'null',
                              'p_LastName' => 'null'
                              );
        $pathSide  = base_url()."api/employee/addemp/format/json/";
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
        $parameterEmpData=array('p_mode' => 'SelectEmpEdit',
                                'p_BusinessId' => 22,
                                'p_EmpId' => $empId,
                                'p_FirstName' => '',
                                'p_LastName' => '');
        $pathEmpData  = base_url()."api/employee/addemp/format/json/";
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

   $path  = base_url()."api/countrylisting/country/format/json/";
   $response  = curlcall($parameter, $path);
         if($response =='Something Went Wrong'){
               $this->session->set_flashdata('message','Please check country Name');
               $base_url  = base_url();
               redirect($base_url.'ssa/admin/countryadd/');
               exit();
         }else{
            $data['country']=$response;
            $this->load->view('employee/edit_employee',$data);

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
  redirect($data.'employee/');
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



  function notification()
{
  $this->load->view('layout/header');
  $this->load->view('notification');
  $this->load->view('layout/footer');

}

function terms()
{
  $this->load->view('layout/header');
  $this->load->view('terms');
  $this->load->view('layout/footer');

}

function help()
{
  $this->load->view('layout/header');
  $this->load->view('firstreportedit');
  $this->load->view('layout/footer');

}
// Rahul Yadav 15/12/2014 

public function firstloginemployee(){

$userid= $this->session->userdata['sessionData']['a_SId'];
               $parameter = array('act_mode'=>$_POST['act_mode'] , 'userid'=>$userid );
             $path= base_url().'api/createbusinessadmin/firstloginpasschange/format/json/';
         $firstlogin= curlcall($parameter, $path);

}
function claim(){
 $userid= $this->session->userdata['sessionData']['a_SId'];
 $parameter = array('act_mode'=>'employee' , 'userid'=>$userid);
           $path       = base_url().'api/createbusinessadmin/firstloginpasschange/format/json/';
       $firstlogin= curlcall($parameter, $path);
               if($firstlogin->fpasschange==0){
                 redirect($base_url.'employee/profile/changepassword');
                   exit();
                   }
                    if($firstlogin->fpasschange==2){
                 redirect($base_url.'employee/profile/changepassword');
                   exit();
                   }
                    if($firstlogin->fpasschange==3){
                 redirect($base_url.'employee/profile/profile');
                   exit();
                   }

  $this->load->view('layout/header');

  // now getting the list of the claim reports
  		   $data = checklogin();
           $businessId = $data['business_id'];
           $userId     = $data['a_SId']; 
           $n_DeptId   = $data['n_DeptId']; 

		   $parameter = array(
		   	                     'businessId' => $businessId,
		   	                     'userId'     => $userId
		   	                  );
		  $path  = base_url()."api/employee/displayclaim/format/json/";
	      $data['response']  = curlcall($parameter, $path);
	      if($data['response']){

			$this->load->view('claim', $data);
          	$this->load->view('layout/footer');	
	      }
	      else{
	      	 redirect('employee/claim');
	      	 exit();
	      }

}


function policy11()
{
   $data= checklogin();
  $this->load->view('layout/header');
 
p($data);

  $this->load->view('layout/footer');

}



 public function policy(){
    
    $userId= checklogin();
    $policyId=$userId['n_PolicyId'];
   
    $businessid= $userId['business_id'];

                      $parameter_policy = array('policyid'=>$policyId);
                      $path_policy  = base_url().'api/business_admin/policyasign/format/json/';
                      $responseasign1 = curlcall($parameter_policy, $path_policy);

              if($responseasign1=='Something Went Wrong'){
              $data['asignp']= 0;
              }

              else{
              $data['asignp']=1; 
              }
                    $parameter_policy = array('act_mode'=>'check', 'policyId'=>$policyId);
                      $path_policy  = base_url().'api/business_manage/ssapolicyeditdelcheck/format/json/';
                      $responseasign = curlcall($parameter_policy, $path_policy);


if($responseasign=='Something Went Wrong'){
     $data['assign']= 0;
    }
  if($responseasign !=='Something Went Wrong'){
      if($responseasign->n_Status =="Reimbursed"){
      $data['assign']= 0;
     }
    else{
      $data['assign']=1; 
    }
}
              $this->load->view('layout/header');
                  $parameterCat = array('p_SpndngCatId' => 'null',
                                  'p_mode'            => 'Select',
                                  'p_SpndName'        => 'null',
                                  'p_GLCode'        => 'null',
                                  'p_AdminType'       =>22,
                                  'p_BusinessId'      => $userId['business_id'],
                                 );
                  $pathCat      = base_url().'api/business_admin/spendcat/format/json/';
                  $responseCat  = curlcall($parameterCat, $pathCat);
  
    $data['buspolicy']=  $userId['business_id'];
    if($responseCat=='Something Went Wrong'){
     $data['cat']=''; 
    }else{
      $data['cat']=$responseCat; 
    }
    $parameterAssign=array( 'p_mode' => 'SelectEdit',
                      'p_formName' => 'null',
                      'p_BusinessId' => $userId['business_id'],
                      'p_PolicyId' => $policyId,
                      'p_AdminType' => 22,
                      );

    $pathAssignCat      = base_url().'api/business_admin/policy/format/json/';
    $responseCatAssign  = curlcall($parameterAssign, $pathAssignCat);
    //p( $responseCatAssign);exit;
    if($responseCatAssign !=='Something Went Wrong'){
     $data['policy']=$responseCatAssign; 
    }else{
   $this->session->set_flashdata('message','Please check country Name');
               $base_url  = base_url();
               redirect($base_url.'business/dashboard/countryadd/');
               exit();
      $data['policy']='';
    }
  
  
    $this->load->view('policyEditCreateGeneral',$data);
 }







public function policy_old(){



  
                       //$policyid=$this->uri->segment('4');   //ssapolicycategoryedit
                     /*  p($policyid);
                       exit;*/
                        $data= checklogin();
                       $policyid=$data['n_PolicyId'];
                      // $policyid=117;
                      $parameter_policy = array( 'act_mpde' => 'view',
                                       'id'=>$policyid
                                        );
                      $path_policy  = base_url().'api/business_manage/ssapolicylist1/format/json/';
                      $response['policyname']  = curlcall($parameter_policy, $path_policy);

  //         p($response['policyname']);

                    $parameter_policy = array( 'act_mode' => 'allview',
                                          'busid'   => $response['policyname']->n_BusinessId );
                    $path_policy  = base_url().'api/business_manage/myssapolicylist/format/json/';
                    $response['get_allcat']  = curlcall($parameter_policy, $path_policy);

                                          $parameter_policy = array(
                                          'businessid'   => $response['policyname']->n_BusinessId );
                    $path_policy  = base_url().'api/business_manage/ssaspcatget/format/json/';
                    $response['get_spcatglcode']  = curlcall($parameter_policy, $path_policy);
               // p($response['get_spcatglcode']);
           // exit;
                      $adminid= $this->session->userdata['sessionData']['a_SId'];
                      $AdminType= $this->session->userdata['sessionData']['a_SysAdminId'];

                      $parameter_policy = array( 'act_mode' => 'getallbusiness' , 'AdminType' => $AdminType ,'adminId' => $adminid);
                      $path_policy  = base_url().'api/business_manage/ssapolicybusiness/format/json/';
                      $response['business']  = curlcall($parameter_policy, $path_policy);

//p($response['business']); //exit;
                      $parameterAssign = array( 'policyid' => $policyid );
                      $pathAssign =base_url().'api/business_manage/ssapolicycategoryedit/format/json/';
                      $responseAssign  = curlcall($parameterAssign, $pathAssign);
                      // p($responseAssign);
                      // exit();
                      if($responseAssign=='Something Went Wrong'){
                        $response['policy']='';
                        redirect($base_url.'employee/policy/');
                       }else{
                        $response['policy']  = $responseAssign;
                      }
                      $this->load->view('layout/header');
                      $this->load->view('policyEditCreateGeneral',$response);

}

function employeepasswordreset(){
                      $parameterAssign = array('act_mode'=>'emailcheck' , 'emp_emial'=>$_POST['empmail'] ,'seqasn'=>'fgh' ,'epasswoed'=>"fgh" );
                      $pathAssign =base_url().'api/business_manage/enployeepasswordreset/format/json/';
                      $responseAssign  = curlcall($parameterAssign, $pathAssign);

              echo json_encode($responseAssign);
               exit;

}

public function empepasswordreset(){
   $this->load->library('email');
  $letters = 'abcefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
                             $chars = 8;
                             $randomString=  substr(str_shuffle($letters), 0, $chars);
                          // $password= generateRandomString(6);
                      $password = $randomString;
  $pass=$password;
                      $parameterAssign = array('act_mode'=>'passwordreset' , 'emp_emial'=>$_POST['empmail'] ,'seqasn'=>$_POST['seqquestion'],'epasswoed'=>md5($pass) );
                      $pathAssign =base_url().'api/business_manage/enployeepasswordreset/format/json/';
                      $responseAssign  = curlcall($parameterAssign, $pathAssign);
                     $email_user=  $responseAssign->w;

      $message_u='<html><body bgcolor="#DCEEFC">
                 <br><div><table><p>A <TruExpense> user has been created for you. Please use following credentials to register you and begin using the expense management solution. </br>
                                 using the expense management solution.</p>
                                 <tr><td>Login Page: </td><td><a href="'. base_url().'/employee/">Login</a>  </td></tr>
                                <tr><td>User Id: </td><td>Your Email Address :'.$email_user.' </td></tr>
                                <tr><td>Default Password: </td><td>'.$password.' </td></tr>
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
          $this->email->subject('Password');
          $this->email->message($message_u);
          $this->email->send();

echo json_encode($responseAssign);  


                 exit;

}
 public function  emprptsearch(){

       if($this->input->post('b_submit') !==''){
        $sum = str_replace(","," ",$this->input->post('b_submit'));
        $p_sdate= date('Y-m-d',strtotime($sum));
          }
          else{
           $p_sdate=''; 
          }
 if($this->input->post('claimto') !=='' && $this->input->post('claimfrom') !==''){
     $to = str_replace(","," ",$this->input->post('claimto'));
       $p_claimto=date('Y-m-d', strtotime($to));
       $from = str_replace(","," ",$this->input->post('claimfrom'));
       $p_claomfrom=date('Y-m-d', strtotime($from));
}
  else{
$p_claimto='';
$p_claomfrom='';
  }
           $data = checklogin();
           $businessId = $data['business_id'];
           $userId     = $data['a_SId'];
          // $n_DeptId   = $data['n_DeptId'];


    $parameter = array(
    'act_mode' =>$_POST['act_mode'] ,
  'businessId' =>$businessId ,
  'userid' =>$userId ,
   'name' =>$_POST['name'] ,
   'status' =>$_POST['status'] ,
   'submit' =>$p_sdate ,
   'claimfrom' =>$p_claomfrom ,
   'claimto' =>$p_claimto );


$pathReportSide  = base_url()."api/employee/emprptsearch/format/json/";
       $rep_response  = curlcall($parameter, $pathReportSide);

     
        
echo json_encode($rep_response);
exit;


}



// end of the class
}


// act_mode: "bystatus", businessId: "82", userid: "96", svalue: "submit"

// ==================================================
//
//	List of all the tables and procedures used will come here
//  Supper Admin Table  = tbl_systemlogin;
//  Supper Admin Login Procedure  =  proc_adminLogin
//  country TableName = "tblcountry";
//  procedure for this is    = "countryManage"; 
//
// ================================================== 


