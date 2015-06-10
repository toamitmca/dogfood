<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard2 extends MX_Controller {

  public function __construct() {
	$this->load->model("supper_admin");
	$this->load->helper('my_helper');
  }

  public function index(){
    
  	$this->load->view('layout/header');

  	$this->load->view('index');
      $this->load->view('layout/footer');
  }


 public function general() {
         $userId= checklogin();
 	       $data = businesschecklogin();
         $Id = $data['n_BusinessId'];
         $parameter = array( 'id' => $Id,
                          'b_IsActive' => '1',
                          'n_AdminType' => '0'
                           );
   	      $pathState  = base_url()."api/createbusinessadmin/businesseview/format/json/";
          $responseState  = curlcall($parameter, $pathState);
          $data['state']=$responseState;

             $parameter_dpt = array( 'act_mode' => 'department',
                                      'n_BusinessId' => $Id

                           );
   	      $path  = base_url()."api/business_manage/getdtpcattagbusiness/format/json/";    // Get spending category
          $responseState1  = curlcall($parameter_dpt, $path);
          
          $data['dpt_mt']=$responseState1;

          $parameter_sp_cat = array( 'act_mode' => 'sp_cat',
                          'n_BusinessId' => $Id

                           );
   	      $path  = base_url()."api/business_manage/getdtpcattagbusiness/format/json/";
          $responseState  = curlcall($parameter_sp_cat, $path);

          $data['sp_cat']=$responseState;

          $parameter_tag = array( 'act_mode' => 'custon_tag',
                          'n_BusinessId' => $Id

                           );
   	      $path  = base_url()."api/business_manage/getdtpcattagbusiness/format/json/";   // Get custom tag
          $responseState  = curlcall($parameter_tag, $path);
          $data['custon_tag']=$responseState;


          $this->load->view('layout/header');

/*p($data);
exit;
*/


          $this->load->view('business_pannel',$data);
          //	$this->load->view('layout/footer');
     }



public function department_add(){
                        	$data = businesschecklogin();
                          $Id = $data['n_BusinessId'];
                          $xml =htmlentities("<NewDataSet>");
                          foreach ($_POST['t_PolicyName'] as $key => $value1) {
                          if(!empty($value1['t_DepartmantName'])){
                          $xml .=htmlentities('<tbldepartment><t_DeptName>'.$value1['t_DepartmantName'].'</t_DeptName></tbldepartment>');
                          }
                          }
                          $xml .=htmlentities("</NewDataSet>");
                          $parameter = array(    'p_mode' => 'Insert',
                                             'p_DeptId' => '1',
                          'p_XmlData_dname' => (html_entity_decode($xml, ENT_QUOTES, 'UTF-8')),
                          'p_AdminType' => '1',
                          'p_BusinessId' => $Id,
                          'p_CreatedBy' => '1'
                          );
                          $path  = base_url()."api/business_manage/businessdepartmentadd/format/json/";
                          $response  = curlcall($parameter, $path);
}
public function sending_cat_add(){
                	$data = businesschecklogin();
                   $Id = $data['n_BusinessId'];

function unique_multidim_array($array, $key){
                                    $temp_array = array();
                                    $i = 0;
                                   $key_array = array();

                                  foreach($array as $val){
                                  if(!in_array($val[$key],$key_array)){
                                  $key_array[$i] = $val[$key];
                                  $temp_array[$i] = $val;
                                  }
                                  $i++;
                                   }
                               return $temp_array;
                               }


                             $details = unique_multidim_array($_POST['t_PolicyName'],'t_category_name');





                      $xml =htmlentities("<NewDataSet>");
                     // foreach ($_POST as $key => $value1) {
                      foreach ($details as $key => $value) {
                      if(!empty($value['t_category_name']) && !empty($value['t_glcode'])){
                      $xml .=htmlentities('<tblspndngcat><t_SpndName>'.$value['t_category_name'].'</t_SpndName>
                                             <t_GLCode>'.$value['t_glcode'].'</t_GLCode>
                                               </tblspndngcat>');
                      }

                      }
                    //  }
                      $xml .=htmlentities("</NewDataSet>");
                      $parameter = array(    'p_mode' => 'Insert',
                                 'p_DeptId' => '1',
                      'p_XmlData_sp_gl' => (html_entity_decode($xml, ENT_QUOTES, 'UTF-8')),
                      'p_AdminType' => '1',
                      'p_BusinessId' => $Id,
                      'p_CreatedBy' => '1'
                      );
                      $path  = base_url()."api/business_manage/businesscategory/format/json/";
                      $response  = curlcall($parameter, $path);

}


public function customtag_add(){
                        $data = businesschecklogin();
                        $Id = $data['n_BusinessId'];

                        $xml =htmlentities("<NewDataSet>");
                        foreach ($_POST as $key => $value1) {
                        foreach ($value1 as $key => $value) {
                        if(!empty($value['t_customtag'])&&!empty($value['t_glcode'])){
                        $xml .=htmlentities('<tblcustomtag><t_CustText>'.$value['t_customtag'].'</t_CustText>
                                             <t_CustValue>'.$value['t_glcode'].'</t_CustValue>
                                               </tblcustomtag>');
                        }
                        }
                        }
                   $xml .=htmlentities("</NewDataSet>");
           $parameter = array(    'p_mode' => 'Insert',
                               'p_DeptId' => '1',
                               'p_XmlData_cat' => (html_entity_decode($xml, ENT_QUOTES, 'UTF-8')),
                               'p_AdminType' => '1',
                               'p_BusinessId' => $Id,
                               'p_CreatedBy' => '1'
                             );
          $path  = base_url()."api/business_manage/businesscustomtag/format/json/";
          $response  = curlcall($parameter, $path);
}
public function addRemember(){
        $data = businesschecklogin();
        $Id = $data['n_BusinessId'];
        $parameter = array('n_BusinessId' => $Id,
        'remenber' =>$_POST['remenbmt']);
        $path  = base_url()."api/business_manage/addremembermt/format/json/";
        $response  = curlcall($parameter, $path);
}

public function profile(){

     $userId= checklogin();
     $data = businesschecklogin();
     $busId = $data['n_BusinessId'];
			$parameter=array(
                            'countryName' => '',
                            'id'          => '',
                            'act_mode'    => 'select',
                            'createdBy'   => '',
                            'active'      => 1,
                            'businessId'  => $busId,
                            'adminUser'   => '',
                            );

	$path=base_url()."api/business_manage/country/format/json/";
	$data['country']= curlcall($parameter , $path);
	$Id = $data['businessUserId'];
    $this->load->view('layout/header');
    $parameter =  array('bid'      => $Id ,
                        'bdob'     =>'',
                        'bphone'   => '',
                        'bmobile'  => '',
                        'baddress' => '',
                        'bcountry' => '',
                        'bstate'   =>'',
                        'bcity'    => '',
                        'bpin'     => '',
                        'bseq'     => '',
                        'act_mode' => 'view' );
   
                      $path  = base_url()."api/business_manage_2/profile/format/json/";
                            $data['bprofile']  = curlcall($parameter, $path);

                    if(isset($_POST['submit']))
                    {  


                      $address= $this->input->post('address_line1').'%'.$this->input->post('address_line2').'%'.$this->input->post('address_line3');
                      $parameter =  array(
                      	             		'bid'      => $Id ,
					                        'bdob'     => $this->input->post('date_of_birth'),
					                        'bphone'   => $this->input->post('office_phone'),
					                        'bmobile'  => $this->input->post('mobile_phone'),
					                        'baddress' => $address,
					                        'bcountry' => $this->input->post('n_CountryId_1'),
					                        'bstate'   => $this->input->post('n_StateId'),
					                        'bcity'    => $this->input->post('n_City'),
					                        'bpin'     => $this->input->post('pin_code'),
					                        'bseq'     => $this->input->post('seq_code'),
					                        'act_mode' => 'pupdate' 
                        );
						$path  = base_url()."api/business_manage_2/profileupdate/format/json/";
                        $response= curlcall($parameter, $path);
                        //exit();
                        
                        if($response !=1){
                         
                          $this->session->set_flashdata('message','Something went Wrong');
			              $base_url  = base_url();
			              redirect($base_url.'business/dashboard2/profile/');
			              exit(); 

						}
                        else{
                          $this->session->set_flashdata('message','Updated Successfully');
			              $base_url  = base_url();
			              redirect($base_url.'business/dashboard2/profile/');
			              exit(); 
                        }
                      }
              $this->load->view('profile',$data);

   }

    public function editspcatglcod(){
     // print_r($_POST);
     // exit;

      $parameter=  array('act_mode'    =>$_POST['act_mode'] ,
                           'cat_glcod' =>$_POST['newglcode'],
                           'testname'  =>$_POST['newglcode'],
                            'id'       =>$_POST['id']);
      $path  = base_url()."api/business_manage/updatglcodetext/format/json/";
                          $response= curlcall($parameter, $path);

    }


  public function editsptext(){

      $parameter=  array('act_mode'    =>$_POST['act_mode'] ,
                           'cat_glcod' =>$_POST['newglcode'],
                           'testname'  =>$_POST['newglcode'],
                            'id'       =>$_POST['id']);
      $path  = base_url()."api/business_manage/updatglcodetext/format/json/";
                          $response= curlcall($parameter, $path);

    }
    public function getStateDropDown(){
                      $userId= checklogin();
                      $data = businesschecklogin();
                      $busId = $data['n_BusinessId'];
                      $countryId=$_POST['id'];
                      $parameterState = array( 'id'     => $countryId,
                      'b_IsActive'   => '1',
                      'n_BusinessId' => $busId,
                      'p_mode'       => 'Stateselect',
                      'n_AdminType'  => 33,
                      );
                      $pathState  = base_url()."api/business_manage/state/format/json/";
                      $responseState  = curlcall($parameterState, $pathState);

                      if($responseState =='Something Went Wrong'){
                      $this->session->set_flashdata('message','Please check state Name');
                      $base_url  = base_url();
                      redirect($base_url.'business/dashboard/stateadd/');
                      exit();
                      }else{
                      echo json_encode($responseState);
                      exit();
                      }
  }


  public function getCityDropDown(){
   // $this->login_check();
  // echo "Deepesh";
  // die();
  $userId= checklogin();
  $data = businesschecklogin();
  $busId = $data['n_BusinessId'];
  $parameter =array(   'p_mode'       => 'CitySelect',
                       'p_id'         => 'null',
                       'n_StateId'    => $_POST['id'],
                       'p_BusinessId' => null ,
                       'p_admin'      => 33
                        );
 
     $path  = base_url()."api/business_manage_2/city/format/json/";
     $response  = curlcall($parameter, $path);
     if($response =='Something Went Wrong'){
               $this->session->set_flashdata('message','Please check city Name');
               $base_url  = base_url();
               redirect($base_url.'business/dashboard2/cityadd/');
               exit();
    }else{
               echo json_encode($response);
               exit();
          }
  } 

public function add_employee(){

   $this->login_check();
   $userId= checklogin();
   $sttr="abcdefghijkalmnopqrstuvwxyz012345678ABCDEFGHIJKLMNOPQRSTWXYZ";
   $password= substr(str_shuffle($sttr), 0,8);
   if($this->input->post('submit')=='Save'){
   $userId= checklogin();

      $this->load->library('form_validation');
      $this->form_validation->set_rules('policy', 'Policy', 'trim|required|xss_clean');
      $this->form_validation->set_rules('status', 'Status', 'trim|required|xss_clean');
      $this->form_validation->set_rules('first_name', 'First Name', 'required|trim|xss_clean');
      $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|xss_clean');
      $this->form_validation->set_rules('department', 'Department', 'trim|required|xss_clean');
      $this->form_validation->set_rules('email', 'Email Id', 'trim|required|valid_email|xss_clean');
      $this->form_validation->set_rules('employee_id', 'Employee Id', 'trim|required|is_unique[tblemployeemaster.t_EmpCode]|xss_clean');
      $this->form_validation->set_rules('date_of_birth', 'Date Of Birth', 'trim|required|xss_clean');
      $this->form_validation->set_rules('office_phone', 'Office Phone', 'trim|required|xss_clean');
      $this->form_validation->set_rules('mobile_phone', 'Mobile Phone', 'trim|required|xss_clean');
      $this->form_validation->set_rules('address_line1', 'Address Line1', 'trim|required|xss_clean');
      $this->form_validation->set_rules('address_line2', 'Address Line2', 'trim|required|xss_clean');
      $this->form_validation->set_rules('address_line3', 'Address Line3', 'trim|required|xss_clean');
      $this->form_validation->set_rules('n_CountryId_1', 'Country', 'trim|required|xss_clean');
      $this->form_validation->set_rules('state_id', 'State', 'trim|required|xss_clean');
      $this->form_validation->set_rules('city_id', 'City', 'trim|required|xss_clean');
      $this->form_validation->set_rules('pin_code', 'Pincode', 'trim|required|xss_clean');
      if($this->form_validation->run()!= false){
        
         $policy       = $this->input->post('policy');
         $email        = $this->input->post('email');
         $status       = $this->input->post('status');
         $firstName    = $this->input->post('first_name');
         $lastName     = $this->input->post('last_name');
         $department   = $this->input->post('department');
         $dateOfBirth  = $this->input->post('date_of_birth');
         $employeeCode = $this->input->post('employee_id');
         $officePhone  = $this->input->post('office_phone');
         $mobilePhone  = $this->input->post('mobile_phone');
         $addressLine1 = $this->input->post('address_line1');
         $addressLine2 = $this->input->post('address_line2');
         $addressLine3 = $this->input->post('address_line3');
         $countryId    = $this->input->post('n_CountryId_1');
         $stateId      = $this->input->post('state_id');
         $cityId       = $this->input->post('city_id');
         $pinCode      = $this->input->post('pin_code');
        
        $parameter = array(    'p_mode'        => 'Insert',
                               'p_EmpId'       => 'null',
                               'p_IsAdmin'     => false,
                               'p_EmpCode'     => $employeeCode,
                               'p_Empfname'    => $firstName,
                               'p_EmpLastName' => $lastName,
                               'p_Email'       => $email,
                               'p_Pass'        => $password,
                               'p_DeptId'      => $department,
                               'p_PolicyId'    => $policy,
                               'p_EmpDob'      => $dateOfBirth,
                               'p_OfficePhno'  => $officePhone,
                               'p_MobileNo'    => $mobilePhone,
                               'p_AddFLine'    => $addressLine1,
                               'p_AddSecLine'  => $addressLine2,
                               'p_AddThrdLine' => $addressLine3,
                               'p_Country'     => $countryId,
                               'p_State'       => $stateId,
                               'p_City'        => $cityId,
                               'p_PinCode'     => $pinCode,
                               'p_Status'      => $status,
                               'p_CreatedBy'   => 'null',
                               'p_BusinessId'  => $userId['n_BusinessId']
                              );
        

          $path  = base_url()."api/business_admin_2/addemp/format/json/";
          $response  = curlcall($parameter, $path);
          
          if($response =='Something Went Wrong'){
                  $this->session->set_flashdata('message','Please All the Fields Name');
                  $base_url  = base_url();
                  redirect($base_url.'business/dashboard2/add_employee/');
                  exit();

            }else{
             
                $this->session->set_flashdata('message','Inserted Successfully');
                redirect($base_url.'business/dashboard/employee/');
                exit();
            }
      }
   }else{

        $parameterSide=array('p_mode'        => 'SelectList',
                              'p_BusinessId' => $userId['n_BusinessId'],
                              'p_EmpId'      => 'null',
                              'p_FirstName'  => 'null',
                              'p_LastName'   => 'null'
                              );
        $pathSide  = base_url()."api/business_admin/addemp/format/json/";
        $responseSide  = curlcall($parameterSide, $pathSide);

       if($responseSide =='Something Went Wrong'){
               $this->session->set_flashdata('message','Please check Role Name');
               $base_url  = base_url();
               redirect($base_url.'business/dashboard2/Roleadd/');
               exit();
         }else{
            $data['side']=$responseSide;
         }

         
         $parameterCountry = array( 'countryName1'  => 'null',
                                    //'d_CreatedOn' => 'null',
                                    'id'            => 'null',
                                    'act_mode'      => 'select',
                                    'n_CreatedBy'   => 'null',
                                    //'d_ModifiedOn' => 'null',
                                    //'n_ModifiedBy' => 'null',
                                    'b_IsActive'    => 1,
                                    'n_BusinessId'  => 'null',
                                    'n_AdminType'   => 33
                              );
                 $pathCountry  = base_url()."api/business_admin/country/format/json/";
                 $responseCountry  = curlcall($parameterCountry, $pathCountry);
                 if($responseCountry =='Something Went Wrong'){
                             $this->session->set_flashdata('message','Please check country Name');
                             $base_url  = base_url();
                             redirect($base_url.'business/dashboard2/countryadd/');
                             exit();
                       }else{
                         // $data['country']=$responseCountry;
                       }
                    }
                    $this->load->view('layout/header');
                   // $data['country']=$responseCountry;
                  $this->load->view('add_employee');

  }




public function edit_employee(){
      $this->login_check();
      $userId= checklogin();
  if(isset($_POST['submit'])){
     //$userId= checklogin();
      $this->form_validation->set_rules('status', 'Status', 'trim|required|xss_clean');
      $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|xss_clean');
      $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|xss_clean');
      $this->form_validation->set_rules('department', 'Department', 'trim|required|xss_clean');
      $this->form_validation->set_rules('employee_id', 'Employee Id', 'trim|required|xss_clean');
      $this->form_validation->set_rules('date_of_birth', 'Date Of Birth', 'trim|required|xss_clean');
      $this->form_validation->set_rules('office_phone', 'Office Phone', 'trim|required|xss_clean');
      $this->form_validation->set_rules('mobile_phone', 'Mobile Phone', 'trim|required|xss_clean');
      $this->form_validation->set_rules('address_line1', 'Address Line1', 'trim|required|xss_clean');
      $this->form_validation->set_rules('address_line2', 'Address Line2', 'trim|required|xss_clean');
      $this->form_validation->set_rules('address_line3', 'Address Line3', 'trim|required|xss_clean');
      $this->form_validation->set_rules('country_id', 'Country', 'trim|required|xss_clean');
      $this->form_validation->set_rules('state_id', 'State', 'trim|required|xss_clean');
      $this->form_validation->set_rules('city_id', 'City', 'trim|required|xss_clean');
      $this->form_validation->set_rules('pin_code', 'Pincode', 'trim|required|xss_clean');
       $this->form_validation->set_rules('policy', 'Policy', 'trim|required|xss_clean');
    
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
        

        $parameterUpdate = array( 'p_mode'     => 'Update',
                               'p_EmpId'       => $empUpdate,
                               'p_EmpCode'     => $employeeCode,
                               'p_Empfname'    => $firstName,
                               'p_EmpLastName' => $lastName,
                               'p_DeptId'      => $department,
                               'p_PolicyId'    => $policy,
                               'p_EmpDob'      => $dateOfBirth,
                               'p_OfficePhno'  => $officePhone,
                               'p_MobileNo'    => $mobilePhone,
                               'p_AddFLine'    => $addressLine1,
                               'p_AddSecLine'  => $addressLine2,
                               'p_AddThrdLine' => $addressLine3,
                               'p_Country'     => $countryId,
                               'p_State'       => $stateId,
                               'p_City'        => $cityId,
                               'p_PinCode'     => $pinCode,
                               'p_Status'      => $status,
                               'p_CreatedBy'   => 'null',
                               'p_BusinessId'  => $userId['n_BusinessId']
                               );

          $pathUpdate  = base_url()."api/business_admin_2/addemp/format/json/";
          $response  = curlcall($parameterUpdate, $pathUpdate);
         // p($response);
          //exit();
          if($response =='Something Went Wrong'){
                  $this->session->set_flashdata('message','Please All Fields Name');
                  $base_url  = base_url();
                  redirect($base_url.'business/dashboard2/edit_employee/'.$empUpdate);
                  exit();

            }else{
             
                $this->session->set_flashdata('message','Updated Successfully');
                redirect($base_url.'business/dashboard2/employee');
                exit();
            }
      }
   }else{
        

        $parameterSide=array('p_mode' => 'SelectList',
                              'p_BusinessId' => $userId['n_BusinessId'],
                              'p_IsAdmin'=>false,
                              'p_EmpId' => 'null',
                              'p_FirstName' => 'null',
                              'p_LastName' => 'null'
                              );
        $pathSide  = base_url()."api/business_admin/addemp/format/json/";
        $responseSide  = curlcall($parameterSide, $pathSide);
       if($responseSide =='Something Went Wrong'){
               $this->session->set_flashdata('message','Please check Role Name');
               $base_url  = base_url();
               redirect($base_url.'business/dashboard/Roleadd/');
               exit();
         }else{
            $data['side']=$responseSide;
         }


        $empId=$this->uri->segment('4');
        $parameterEmpData=array('p_mode' => 'SelectEmpEdit',
                                'p_BusinessId' => $userId['n_BusinessId'],
                                'p_EmpId' => $empId,
                                'p_FirstName' => '',
                                'p_LastName' => '');
        $pathEmpData  = base_url()."api/business_admin/addemp/format/json/";
        $responseEmpData  = curlcall($parameterEmpData, $pathEmpData);
        if($responseEmpData =='Something Went Wrong'){
               $this->session->set_flashdata('message','Please check Role Name');
               $base_url  = base_url();
               redirect($base_url.'business/dashboard/Roleadd/');
               exit();
         }else{
          foreach ($responseEmpData as $key => $value) {
                     $countryId=$value->n_CountryId;
                     $stateId=$value->n_StateId;
                  }
            $parameterState = array( 'id' => $countryId,
                                'b_IsActive' => '1',
                                'n_BusinessId' => $userId['n_BusinessId'],
                                'p_mode' => 'Stateselect',
                                'n_AdminType' => 33,
                              );
           $pathState  = base_url()."api/business_admin/state/format/json/";
           $responseState  = curlcall($parameterState, $pathState);
           //p($responseState);
           //exit();
            if($responseState =='Something Went Wrong'){
                       $this->session->set_flashdata('message','Please check state Name');
                       $base_url  = base_url();
                       redirect($base_url.'business/dashboard/stateadd/');
                       exit();
                 }else{
                  $data['stateList']=$responseState;
                  }
          $parameterCity =array(  'p_mode' => 'CitySelect',
                                 'p_id' => 'null',
                                 'n_StateId' => $stateId,
                                 'p_BusinessId' => null/*$userId['n_BusinessId']*/,
                                 'p_admin' => 33
                                  );
          //p($parameterCity);

           $pathCity  = base_url()."api/business_admin_2/city/format/json/";
           $responseCity  = curlcall($parameterCity, $pathCity);
           //p($responseCity);
           //exit();
           if($responseCity =='Something Went Wrong'){
                       $this->session->set_flashdata('message','Please check state Name');
                       $base_url  = base_url();
                       redirect($base_url.'business/dashboard/stateadd/');
                       exit();
                 }else{
                  $data['cityList']=$responseCity;
                  }
            $data['empData']=$responseEmpData;

           // p($data['empData']);
            //exit();
         }


         $this->load->view('layout/header');
         $parameter = array( 'countryName1' => 'null',
                               //'d_CreatedOn' => 'null',
                               'id' => 'null',
                               'act_mode' => 'select',
                               'n_CreatedBy' => 'null',
                               //'d_ModifiedOn' => 'null',
                              // 'n_ModifiedBy' => 'null',
                               'b_IsActive' => '1',
                               'n_BusinessId' => 'null',
                               'n_AdminType' => 33,
                              );

   $path  = base_url()."api/business_admin_2/country/format/json/";
   $response  = curlcall($parameter, $path);
  // p($response);
  // exit();
         if($response =='Something Went Wrong'){
               $this->session->set_flashdata('message','Please check country Name');
               $base_url  = base_url();
               redirect($base_url.'business/dashboard/countryadd/');
               exit();
         }else{
            $data['country']=$response;
          
         }
      }
    $this->load->view('edit_employee' , $data);

}




public function employee(){
 
    $this->login_check();
    $userId= checklogin();
     $this->load->view('layout/header');
        $parameterSide=array( 'p_mode' => 'SelectList',
                              'p_BusinessId' => $userId['n_BusinessId'],
                              'p_EmpId' => 'null',
                              'p_FirstName' => 'null',
                              'p_LastName' => 'null'
                              );
        $pathSide  = base_url()."api/business_admin_2/addemp/format/json/";
        $responseSide  = curlcall($parameterSide, $pathSide);
       if($responseSide =='Something Went Wrong'){
               $this->session->set_flashdata('message','Please check Role Name');
               $base_url  = base_url();
               redirect($base_url.'business/dashboard/Roleadd/');
               exit();
         }else{
            $data['side']=$responseSide;

           
            $this->load->view('employeelisting',$data);
            $this->load->view('layout/footer');
        }
 }


  public function login_check(){
    $data = businesschecklogin();
    if($data['businessLoginId'] != 22){
      $baseURl = base_url();
      redirect($baseURl.'business');
      exit();
    }
   }

   



   public function empidcheck()
   {
     $parameter = array('e_EmpCode' => $this->input->post('empid') );
     
     $path  = base_url()."api/business_admin_2/empcodecheck/format/json/";
     $response  = curlcall($parameter, $path);
     echo json_encode($response);
     exit();
   }

public function test(){

  p($this->session->all_userdata());
  exit;

}

 function view_business_admin()
  {
       $this->login_check();
       $userId= checklogin();
       $data = businesschecklogin();
       $id=$data['n_BusinessId'];

       $parameter = array(
                          'busid' => $id ,
                           );
      
       $path  = base_url()."api/business_admin_2/view_business_create_admin/format/json/";
       $response  = curlcall($parameter, $path);
       $data['busdetail']=$response;
       $this->load->view('businessLeft');

}

public function searchBusinessName(){
  $this->login_check();
  $userId= checklogin();
  $data = businesschecklogin();
  $id=$data['n_BusinessId'];
  $firstname=$_POST['name'];
  
  if(!empty($_POST['name'])){
    $parameter=array( 'bid'      => $id,
                      'bname'    => $firstname,
                      'act_mode' => 'searchbusname',
                      
                      );
  }else{
    $parameter=array( 'bid'      => $id,
                      'bname'    => '',
                      'act_mode' => 'searchbusname',  
                    );
   }
  $path  = base_url()."api/business_admin_2/viewbusname/format/json/";
  $response  = curlcall($parameter, $path);
  if($response =='Something Went Wrong'){
        //echo json_encode(array('t_EmpFirstName'));

    }else{
        echo json_encode($response);
    }
}

function notification()
{
  $this->load->view('layout/header');
  $this->load->view('notification');
  $this->load->view('layout/footer');

}

function help()
{
  $this->load->view('layout/header');
  $this->load->view('help');
  $this->load->view('layout/footer');

}


function terms()
{
  $this->load->view('layout/header');
  $this->load->view('terms');
  $this->load->view('layout/footer');

}
function claim()
{
  $this->load->view('layout/header');
  $this->load->view('claim');
  $this->load->view('layout/footer');

}
function spend()
{$this->load->helper('my2_helper');
  $this->load->view('layout/header2');
  $this->load->view('spend');

  $this->load->view('layout/footer');

}



   } // end class