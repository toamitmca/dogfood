<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Superadmin extends MX_Controller {
 
  public function __construct() {
	$this->load->model("supper_admin");	
	$this->load->helper('my_helper');
  }

  public function index(){
	$this->load->view('layout/header');
 	$this->load->view('superadmin/index');
 	$this->load->view('layout/footer');
  }


public function superadminAdd(){
	$this->login_check();
	$sessionData = checklogin();
	$this->load->view('layout/header');
	if(isset($_POST['submit']) && $_POST['submit']=='Create System Admin'){ 

       $this->form_validation->set_rules('status', 'Status ', 'trim|required|max_length[255]|xss_clean');
		$this->form_validation->set_rules('firstName', 'First Name', 'trim|required|min_length[2]|max_length[255]|xss_clean');
		$this->form_validation->set_rules('lastName', 'Last Name', 'trim|required|min_length[2]|max_length[255]|xss_clean');
		$this->form_validation->set_rules('dob', 'dob', 'trim|required|min_length[2]|max_length[255]|xss_clean');
		$this->form_validation->set_rules('n_CountryId_1', 'Country', 'trim|required|xss_clean');
		$this->form_validation->set_rules('n_StateId_1', 'State', 'trim|required|xss_clean');
		$this->form_validation->set_rules('n_CityId_1', 'City', 'trim|required|xss_clean');
		$this->form_validation->set_rules('t_Address1', 'Address', 'trim|required|xss_clean');
		//$this->form_validation->set_rules('t_Address2', 'Address', 'trim|required|xss_clean');
		$this->form_validation->set_rules('t_username', 'Email Id', 'trim|required|min_length[3]|max_length[255]|xss_clean|valid_email|is_unique[tbl_systemlogin.t_username]');
		//$this->form_validation->set_rules('t_password', 'Password', 'trim|required|min_length[3]|max_length[255]|xss_clean');

		if($this->form_validation->run() !=false){
		 $parameter = array(     'status'       => $this->input->post('status'),
							     'firstName'       => $this->input->post('firstName'),
							     'lastName'        => $this->input->post('lastName'),
							     'dob'             =>date('Y-m-d', strtotime($this->input->post('dob'))),  // ,
								 'n_CountryId_1'   => $this->input->post('n_CountryId_1'),
								 'n_StateId_1'     => $this->input->post('n_StateId_1'),
								 'n_CityId_1'      => $this->input->post('n_CityId_1'),
							     't_Address1'      => $this->input->post('t_Address1'),
							     't_Address2'      => $this->input->post('t_Address2'),
							     't_username'      => $this->input->post('t_username'),
							     't_password'      => $this->input->post('t_password'),
							     'n_createdby'     => $sessionData['a_SId']

							   );
			// api call comes here
			$path  = base_url().'api/super_state_admin/admin/format/json/';
			$response  = curlcall($parameter, $path);
			if(!empty($response)){
				$this->session->set_flashdata('message','New System Admin Created Successfully');
				$base_url  = base_url();
   				redirect($base_url.'ssa/superadmin/listing/');
   				exit();
			}

			// api call ends here
		}
	}
	$this->load->view('superadmin/superAdmin');
	
}

 public function checkEmail(){
	// api calls starts
	$parameter = array('email' => $this->input->post('email'));
	$path  = base_url().'api/super_state_admin/superAdminemail/format/json/';
	$response  = curlcall($parameter, $path);
	echo json_encode($response);
}

public function varification($pass , $id)
{ 
	$parameter = array(
		                  'row_id'     => $id,
		                  'sys_status' => $pass
	 );
 //print_r($parameter);
   
	$path =base_url().'api/super_state_admin/systemAdminverification/format/json/';
	$response  = curlcall($parameter , $path);
    
	if(!empty($response))
	{
		$this->session->set_flashdata('message' , "<font color='#FF0000' YOUR EMAIL IS VARIFY..!! NOW YOU CAN LOG IN YOUR ACCOUNT</font>");
		redirect($base_url.'ssa/admin');
	}
	else 
	{
		$this->session->set_flashdata('message' , "<font color='#FF0000' SOMTHING WENT WORNG..!!  YOU CAN'T LOG IN YOUR ACCOUNT</font>");
		redirect($base_url.'ssa/admin');
	}
	
}

public function listing(){

 $current_admin_id = $this->session->userdata['sessionData']['a_SId'];
//exit;
	$this->login_check();
	$this->load->view('layout/header');

	// api call comes here
	$path  = base_url().'api/super_state_admin/admins/format/json/';
	$data['response']  = curlget($path);
	// api call ends here
    $data['current_admin_id']=$current_admin_id;
	$this->load->view('superadmin/superAdminAdd', $data);
 	$this->load->view('layout/footer');
}

public function editsystemadmin($id){
	$this->login_check();
	$this->load->view('layout/header');
	$parameter = array(
						 'firstName'     => '',
                         'lastName'      => '',
                         'email'         => '',
                         'password'  	 => '',
                         'n_createdby'   => '',
                         'act_mode'  	 => 'displaysingle',
                         'usesdrid' 	 => $id,
                         'userasrfdsd'   => '',
						 'userlisasdt'   => '',
						 'userId'    	 => $id
					   );
	// api call starts here
	$path  = base_url().'api/super_state_admin/systemadminedit/format/json/';
	$data['response']  = curlcall($parameter, $path);
		// api cal ends here

	// update query will come here
	if(isset($_POST['submit']) && $_POST['submit']=='Update System Admin'){
		$this->form_validation->set_rules('status', 'Status', 'trim|required|max_length[255]|xss_clean');
		$this->form_validation->set_rules('firstName', 'FirstName', 'trim|required|min_length[1]|max_length[255]|xss_clean');
		$this->form_validation->set_rules('dob', 'DOB', 'trim|required|min_length[1]|max_length[255]|xss_clean');
		$this->form_validation->set_rules('n_CountryId_1', 'Country', 'trim|required|xss_clean');
		$this->form_validation->set_rules('n_StateId_1', 'State', 'trim|required|xss_clean');
		$this->form_validation->set_rules('n_CityId_1', 'City', 'trim|required|xss_clean');
		//$this->form_validation->set_rules('t_Address1', 'Address Line1', 'trim|required|min_length[5]|max_length[255]|xss_clean');
		//$this->form_validation->set_rules('t_Address2', 'Address Line2', 'trim|required|min_length[5]|max_length[255]|xss_clean');
        $this->form_validation->set_rules('t_username', 'Email Id', 'trim|required|min_length[5]|max_length[255]|xss_clean|valid_email');
		if($this->form_validation->run() !=false){
			$sessionData = checklogin();
			$parameter = array(   
				                 'status'       => $this->input->post('status'),
							     'firstName'       => $this->input->post('firstName'),
							     'lastName'        => $this->input->post('lastName'),
							     'dob'            => date('Y-m-d', strtotime($this->input->post('dob'))),
								 'n_CountryId_1'   => $this->input->post('n_CountryId_1'),
							     'n_StateId_1'     => $this->input->post('n_StateId_1'),
							     'n_CityId_1'      => $this->input->post('n_CityId_1'),
							     't_Address1'      => $this->input->post('t_Address1'),
							     't_Address2'      => $this->input->post('t_Address2'),
							     't_username'      => $this->input->post('t_username'),
							     't_password'      => $id,
							     'n_createdby'     => '',
								 'n_modifiedby'    => $sessionData['a_SId'],
								 'a_SysloginId'    => $id
						);
			// api call starts here
		   	$path  = base_url().'api/super_state_admin/systemadminupdate/format/json/';
			$response  = curlcall($parameter, $path);
			// api call ends here
			$this->session->set_flashdata('message', 'Updated Successfully');
			redirect('ssa/superadmin/listing/');
			exit();

		}
	}
	// update query will end over here

	$this->load->view('superadmin/supperAdminEdit', $data);
	
}

public function deletesystemadmin($id){
	$this->login_check();
	$this->load->view('layout/header');
	$parameter = array(

					   'row_id' => $id , 
                       'sys_status' => ''
                       );
	// api call start from here 
	$path = base_url().'api/super_state_admin/systemadmindelete/format/json/';
	$response = curlcall($parameter , $path);
    // api call end here 
    if($response==1){

    $this->session->set_flashdata('message' , 'Deleted Successfully');
    redirect('ssa/superadmin/listing');
    exit();	
	}else{
		$this->session->set_flashdata('message' , 'Something went wrong');
    	redirect('ssa/superadmin/listing');
    	exit();	
	}
	$this->load->view('layout/footer');
	
}
public function activesystemadmin($id)
{
	$this->login_check();
	$this->load->view('layout/header');
	$parameter = array(

		                 'row_id'     => $id ,
		                 'sys_status' => 'Active',

		                  );

	// api call start from here 
	$path = base_url().'api/super_state_admin/systemadminactive/format/json';
	$response=curlcall( $parameter , $path);
	//api call  end here
	if($response==1)
	{
		$this->session->set_flashdata('message' , "<font color='#FF0000'> Admin is Active </font>");
		redirect('ssa/superadmin/listing');
    	exit();	
	}
	else
	{
		$this->session->set_flashdata('message' , "<font color='#FF0000'> Something went wrong</font>");
		redirect('ssa/superadmin/listing');
    	exit();	
	}
	$this->load->view('layout/footer');

}

public function inactivesystemadmin($id)
{
	$this->login_check();
	$this->load->view('layout/header');
	$parameter = array(

		                 'row_id'     => $id ,
		                 'sys_status' => 'Blocked',

		                  );

	// api call start from here 
	$path = base_url().'api/super_state_admin/systemadminactive/format/json';
	$response=curlcall( $parameter , $path);
	//api call  end here
	if($response==1)
	{
		$this->session->set_flashdata('message' , "<font color='#FF0000'> Admin is Inactive </font>");
		redirect('ssa/superadmin/listing');
    	exit();	
	}
	else
	{
		$this->session->set_flashdata('message' , "<font color='#FF0000'> Something went wrong</font>");
		redirect('ssa/superadmin/listing');
    	exit();	
	}
	$this->load->view('layout/footer');

}




function logout(){
  session_unset();
  echo $data = base_url();
  $this->session->sess_destroy();
  redirect($data.'ssa/admin/');
  exit();
}




 public function login_check(){
 	$data = checklogin();
 	if($data['a_SysAdminId'] != 33){
 		$baseURl = base_url();
 		redirect($baseURl.'ssa/admin/');
 		exit();
 	}
 }

public function resetpass()
{
  $data = checklogin();
  $Id=$data['a_SId'] ;

  $this->load->view('layout/header');
  if(isset($_POST['submit']) && $_POST['submit']=='Reset Password')
  {
    $parameter = array(

                      'bid'      => $Id ,
                      'bpass'    => $this->input->post('new_password'),
                      'act_mode' => 'resetadmin'
                      );

         $path = base_url().'api/super_state_admin/resetpasss/format/json/';
         $response    = curlcall($parameter, $path);

         if(!empty($response))
         {
                  $this->session->set_flashdata('message','Password  Not change');
                  $base_url  = base_url();
                  redirect($base_url.'ssa/changepassword/');
                  exit();
                  }
                  else
                  {
                      $this->session->set_flashdata('message','Password  change Successfully');
                  $base_url  = base_url();
                  redirect($base_url.'ssa/superadmin/resetpass/');
                  exit();
                  }
}

$userid= $this->session->userdata['sessionData']['a_SId'];
 $parameter = array('act_mode'=>'systeadmin' , 'userid'=>$userid);
    	     $path  	   = base_url().'api/createbusinessadmin/firstloginpasschange/format/json/';
			 $firstlogin['firstlogin']= curlcall($parameter, $path);


       $this->load->view('ssa/changepassword' ,$firstlogin);
       $this->load->view('layout/footer');
}


public function reset()
{
  $data = checklogin();
  $Id=$data['a_SId'] ;

   $parameter = array(
                     'bid'      => $Id ,
                     'bpass'    => $this->input->post('opass'),
                     'act_mode' => 'checkpassadmin'

                       );


   $path  = base_url().'api/super_state_admin/checkpass/format/json/';
   $response  = curlcall($parameter, $path);
   $data =  json_encode($response);
   echo $data;
   exit;
}


public function profile(){
	$this->load->library('form_validation');
   $this->login_check();
	$data = checklogin();
    $Id=$data['a_SId'] ;
	$this->load->view('layout/header');

     $parameter = array( 
                         'bus_id' => '3'

                        );
                        $path  = base_url()."api/employee/country/format/json/";
                        $data['country']= curlcall($parameter, $path);
                        //p($response);
                        //exit();

	$parameter = array(
						 'firstName'     => '',
                         'lastName'      => '',
                         'email'         => '',
                         'password'  	 => '',
                         'n_createdby'   => '',
                         'act_mode'  	 => 'displaysingle',
                         'usesdrid' 	 => '',
                         'userasrfdsd'   => '',
						 'userlisasdt'   => '',
						 'userId'    	 => $Id
					   );
	// api call starts here
	$path  = base_url().'api/super_state_admin/systemproedit/format/json/';
	$data['response']  = curlcall($parameter, $path);
	
	// api cal ends here

	// update query will come here
	if(isset($_POST['submit']) && $_POST['submit']=='Update Profile'){
		$this->form_validation->set_rules('n_CountryId_1', 'Country', 'trim|required|xss_clean');
		$this->form_validation->set_rules('n_StateId_1', 'State', 'trim|required|xss_clean');
		$this->form_validation->set_rules('n_CityId_1', 'City', 'trim|required|xss_clean');
		//$this->form_validation->set_rules('t_Address1', 'Address 1', 'trim|required|xss_clean');
		//$this->form_validation->set_rules('t_Address2', 'Address 2', 'trim|required|xss_clean');
		$this->form_validation->set_rules('seq_ans', 'Security Answer', 'trim|required|xss_clean|');
		if($this->form_validation->run() !=false){
			$sessionData = checklogin();
			  $address=$this->input->post('t_Address1').'___'. $this->input->post('t_Address2');

			$parameter = array(
							     
							     's_Id'        => $Id,
								 's_Country'   => $this->input->post('n_CountryId_1'),
							     's_State'     => $this->input->post('n_StateId_1'),
							     's_City'      => $this->input->post('n_CityId_1'),
							     's_Address'   => $address,
							     's_Seq'       => $this->input->post('seq_ans'),
						);
			
	
			// api call starts here
		   	$path  = base_url().'api/super_state_admin/systemproupdate/format/json/';
			$response  = curlcall($parameter, $path);
			//p($response);
			//exit();
			// api call ends here
			$this->session->set_flashdata('message', 'Updated Successfully');
			redirect('ssa/superadmin/profile/');
			exit();

		}
	}
	$userid= $this->session->userdata['sessionData']['a_SId'];
 $parameter = array('act_mode'=>'systeadmin' , 'userid'=>$userid);
    	     $path  	   = base_url().'api/createbusinessadmin/firstloginpasschange/format/json/';
			 $data['firstlogin']= curlcall($parameter, $path);
	// update query will end over here
	$this->load->view('profile', $data);
	
}
function notification()
{
	$this->load->view('layout/header');
	$this->load->view('notification');
	$this->load->view('layout/footer');

}


function spend()
{
	$this->load->view('layout/header');
	$this->load->view('spend');
	$this->load->view('layout/footer');

}
function transactions()
{
	$this->load->view('layout/header');
	$this->load->view('transactions');
	$this->load->view('layout/footer');

}

function claim()
{
  $this->load->view('layout/header');
  $this->load->view('claim');
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





public function add_employee(){
  $stateId=$this->uri->segment('4');
  //echo   $stateId; exit;



   $this->login_check();
	$data = checklogin();
    $Id=$data['a_SId'] ;
   $sttr="abcdefghijkalmnopqrstuvwxyz012345678ABCDEFGHIJKLMNOPQRSTWXYZ";
   $password= substr(str_shuffle($sttr), 0,8);

if($this->input->post('submit')=='Save'){
   $data = checklogin();
   $Id=$data['a_SId'] ;

      $this->load->library('form_validation');
      $this->form_validation->set_rules('policy', 'Policy', 'trim|required|xss_clean');
      $this->form_validation->set_rules('status', 'Status', 'trim|required|xss_clean');
      $this->form_validation->set_rules('first_name', 'First Name', 'required|trim|xss_clean');
      $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|xss_clean');
      $this->form_validation->set_rules('department', 'Department', 'trim|required|xss_clean');
      $this->form_validation->set_rules('business', 'Business Name', 'trim|required|xss_clean');
      $this->form_validation->set_rules('email', 'Email Id', 'trim|required|valid_email|xss_clean');
      $this->form_validation->set_rules('employee_id', 'Employee Id', 'trim|required|is_unique[tblemployeemaster.t_EmpCode]|xss_clean');
      $this->form_validation->set_rules('date_of_birth', 'Date Of Birth', 'trim|required|xss_clean');
      //$this->form_validation->set_rules('office_phone', 'Office Phone', 'trim|required|xss_clean|numeric');
      $this->form_validation->set_rules('mobile_phone', 'Mobile Phone', 'trim|required|xss_clean|numeric');
      //$this->form_validation->set_rules('address_line1', 'Address Line1', 'trim|required|xss_clean');
      //$this->form_validation->set_rules('address_line2', 'Address Line2', 'trim|required|xss_clean');
     // $this->form_validation->set_rules('address_line3', 'Address Line3', 'trim|required|xss_clean');
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
         $business     = $this->input->post('business');
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
                               'p_IsAdmin'     => $Id,
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
                               'p_AddThrdLine' => addslashes($addressLine3),
                               'p_Country'     => $countryId,
                               'p_State'       => $stateId,
                               'p_City'        => $cityId,
                               'p_PinCode'     => $pinCode,
                               'p_Status'      => $status,
                               'p_CreatedBy'   => 'null',
                               'p_BusinessId'  => $business
                              );
        
//p($parameter);
          $path  = base_url()."api/super_state_admin/addemp/format/json/";
          $response  = curlcall($parameter, $path);
           // p($response );
          // exit();
          
          if($response =='Something Went Wrong'){
                  $this->session->set_flashdata('message','Please All the Fields Name');
                  $base_url  = base_url();
                  redirect($base_url.'ssa/superadmin/add_employee/');
                  exit();

            }else{
             
                $this->session->set_flashdata('message','Inserted Successfully');
                redirect($base_url.'ssa/employee/employeelock/');
                exit();
            }
      }
   }/*else{

        $parameterSide=array('p_mode'        => 'SelectList',
                              'p_BusinessId' => 'null',
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
*/
         
        /* $parameterCountry = array( 'countryName1'  => 'null',
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
                       }*/
                   if($stateId !=''){
$data['businessid_select']=$stateId;
}
else{
$data['businessid_select']=0;
}

                    $this->load->view('layout/header');
                     $parameter = array('busid' => 'null');

			       $path  = base_url()."api/business_admin_2/mybus/format/json/";
			       $response  = curlcall($parameter, $path);
			       $data['busdetail']=$response;
                   // $data['country']=$responseCountry;
                   $this->load->view('add_employee' , $data);

  }




public function edit_employee($empid){
	$this->load->view('layout/header');
$this->login_check();
      $data = checklogin();
   $Id=$data['a_SId'] ;
  if(isset($_POST['submit'])){
     //$userId= checklogin();
      $this->form_validation->set_rules('status', 'Status', 'trim|required|xss_clean');
      $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|xss_clean');
      $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|xss_clean');
      $this->form_validation->set_rules('department', 'Department', 'trim|required|xss_clean');
      $this->form_validation->set_rules('employee_id', 'Employee Id', 'trim|required|xss_clean');
      $this->form_validation->set_rules('date_of_birth', 'Date Of Birth', 'trim|required|xss_clean');
      // $this->form_validation->set_rules('office_phone', 'Office Phone', 'trim|required|xss_clean|numeric');
      $this->form_validation->set_rules('mobile_phone', 'Mobile Phone', 'trim|required|xss_clean|numeric');
      //$this->form_validation->set_rules('address_line1', 'Address Line1', 'trim|required|xss_clean');
     // $this->form_validation->set_rules('address_line2', 'Address Line2', 'trim|required|xss_clean');
     // $this->form_validation->set_rules('address_line3', 'Address Line3', 'trim|required|xss_clean');
      $this->form_validation->set_rules('n_CountryId_1', 'Country', 'trim|required|xss_clean');
      $this->form_validation->set_rules('state_id', 'State', 'trim|required|xss_clean');
      $this->form_validation->set_rules('city_id', 'City', 'trim|required|xss_clean');
      $this->form_validation->set_rules('pin_code', 'Pincode', 'trim|required|xss_clean');
      $this->form_validation->set_rules('policy', 'Policy', 'trim|required|xss_clean');
    if($this->form_validation->run() != false){

         $policy=$this->input->post('policy');
         $empUpdate= $empid;
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
         $countryId=$this->input->post('n_CountryId_1');
         $stateId=$this->input->post('state_id');
         $cityId=$this->input->post('city_id');
         $pinCode=$this->input->post('pin_code');
         $amount=$this->input->post('amount');
         $editPolicy=$this->input->post('edit_policy');
         $business_id=$this->input->post('business_id');


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
                               'p_BusinessId'  => $business_id
                               );


          $pathUpdate  = base_url()."api/super_state_admin/addemp/format/json/";
          $response  = curlcall($parameterUpdate, $pathUpdate);
         // p($response);
          //exit();
          if($response =='Something Went Wrong'){
                  $this->session->set_flashdata('message','Please All Fields Name');
                  $base_url  = base_url();
                  redirect($base_url.'ssa/superadmin/edit_employee/'.$empUpdate);
                  exit();

            }else{
             
                $this->session->set_flashdata('message','Updated Successfully');
                redirect($base_url.'ssa/employee/employeelock/');
                exit();
            }
      }
  }

$parameter = array('busid' => 'null');
      
			       $path  = base_url()."api/business_admin_2/view_business_create_admin/format/json/";
			       $response  = curlcall($parameter, $path);
			       $data['busdetail']=$response;

   $parameterview = array('e_Mode'  => 'select',
                          'e_Empid' => $empid, );   
   $pathView  = base_url()."api/super_state_admin/viewempdetail/format/json/";
   $data['viewEmp']  = curlcall($parameterview, $pathView);

    $this->load->view('edit_employee' , $data);
    

}

public function getStateDropDown(){

     $userId= checklogin();
     
     $countryId=$_POST['id'];
     $parameterState = array( 'id'     => $countryId,);
     $pathState  = base_url()."api/super_state_admin/states/format/json/";
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
  $userId= checklogin();
  $n_StateId1=$_POST['id'];
  $parameter =array( 'n_StateId'       => $n_StateId1 );
 
     $path  = base_url()."api/super_state_admin/city/format/json/";
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


function empadminans(){
   $this->load->library('email');
   $letters = 'abcefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
                             $chars = 8;
                             $randomString=  substr(str_shuffle($letters), 0, $chars);
                          // $password= generateRandomString(6);
                      $password = $randomString;
                      $pass=$password;
                      $parameterAssign = array('act_mode'=>'ssa_emp_sqans' ,'emp_emial'=>$_POST['id'] , 'seqasn'=>$pass,'epasswoed'=>'');
                      $pathAssign =base_url().'api/business_manage/enployeepasswordreset/format/json/';
                      $responseAssign  = curlcall($parameterAssign, $pathAssign);
                     $email_user=  $responseAssign->t_EmaiId;
                     $first_name=  $responseAssign->t_EmpFirstName;
                     $last_name=  $responseAssign->t_EmpLastName;

      $message_u='<html><body bgcolor="#DCEEFC">
                 <br><div><table><p>Dear &nbsp;'.ucfirst($first_name).' &nbsp;'.$last_name.' ,</br>
                                     </br>You recently made a request to reset your password. To complete the process, click the link below. </br>
                                 <tr><td>Login Page: </td><td><a href="'. base_url().'employee/">Login</a>  </td></tr>
                                <tr><td>User Id: </td><td>Your Email Address :'.$email_user.' </td></tr>
                                <tr><td>Default Security Answer: </td><td>'.$password.' </td></tr>
                                <tr><td> Thanks</br>
                                 Support Team
                                </td><td>12345644</td>
                                <td>9 Am To 5 PM IST</td> </tr>
                             </table>
                               </div>
                              </body>
                              </html>';

           $this->email->set_newline("\r\n");
          $this->email->from('barun@mindztechnology.com', 'Tru Expense');
          $this->email->to("$email_user");
          $this->email->subject('Security ans change');
          $this->email->message($message_u);
          $this->email->send();

echo ($email_user); 

 }


 function empnpassword(){
   $this->load->library('email');
   $letters = 'abcefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
                             $chars = 8;
                             $randomString=  substr(str_shuffle($letters), 0, $chars);
                             $password = $randomString;
                             $pass=$password;
                      $parameterAssign = array('act_mode'=>'ssa_emp_passchange' , 'emp_emial'=>$_POST['id'] ,'seqasn'=>'','epasswoed'=>md5($pass) );
                      $pathAssign =base_url().'api/business_manage/enployeepasswordreset/format/json/';
                      $responseAssign  = curlcall($parameterAssign, $pathAssign);
                     $email_user=  $responseAssign->t_EmaiId;
                     $first_name=  $responseAssign->t_EmpFirstName;
                     $last_name=  $responseAssign->t_EmpLastName;

      $message_u='<html><body bgcolor="#DCEEFC">
                 <br><div><table><p>Dear &nbsp;'.ucfirst($first_name).' &nbsp;'.$last_name.' , </br>
                 </br>You recently made a request to reset your password. To complete the process, click the link below. </br>               </p>
                                 <tr><td>Login Page: </td><td><a href="'. base_url().'employee/">Login</a>  </td></tr>
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
          $this->email->set_newline("\r\n");
          $this->email->from('barun@mindztechnology.com', 'Tru Expense');
          $this->email->to("$email_user");
          $this->email->subject('Password change');
          $this->email->message($message_u);
          $this->email->send();

echo ($email_user); 
 }

function systemadminpassword(){
   $this->load->library('email');
   $letters = 'abcefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
                             $chars = 8;
                             $randomString=  substr(str_shuffle($letters), 0, $chars);
                          // $password= generateRandomString(6);
                      $password = $randomString;
    $pass=$password;
                      $parameterAssign = array('act_mode'=>'ssa_system_passchange' , 'emp_emial'=>$_POST['id'] ,'seqasn'=>'','epasswoed'=>md5($pass) );
                      $pathAssign =base_url().'api/business_manage/enployeepasswordreset/format/json/';
                      $responseAssign  = curlcall($parameterAssign, $pathAssign);
                     $email_user=  $responseAssign->t_username;
                     $first_name=  $responseAssign->firstName;
                     $last_name=  $responseAssign->lastName;

      $message_u='<html><body bgcolor="#DCEEFC">
                 <br><div><table><p>Dear &nbsp;'.ucfirst($first_name).' &nbsp;'.$last_name.', 
                 </br>You recently made a request to reset your password. To complete the process, click the link below. </br>
                                 <tr><td>Login Page: </td><td><a href="'. base_url().'ssa/admin">Login</a>  </td></tr>
                                 <tr>
</tr>                            <tr><td>Email Id: </td><td>'.$email_user.' </td></tr>
                                <tr><td>Default Password: </td><td>'.$password.' </td></tr>
                                <tr><td> Thanks</br>
                                 Support Team
                                </td><td>12345644</td>
                                <td>9 Am To 5 PM IST</td> </tr>
                             </table>
                               </div>
                              </body>
                              </html>';
                    $this->email->set_newline("\r\n");
          $this->email->from('barun@mindztechnology.com', 'Tru Expense');
          $this->email->to("$email_user");
          $this->email->subject('Password change');
          $this->email->message($message_u);
          $this->email->send();

       echo ($email_user); 
 }

function systemadminans(){
   $this->load->library('email');
   $letters = 'abcefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
                             $chars = 8;
                             $randomString=  substr(str_shuffle($letters), 0, $chars);
                          // $password= generateRandomString(6);
                      $password = $randomString;
    $pass=$password;
                      $parameterAssign = array('act_mode'=>'ssa_system_seqans' ,'emp_emial'=>$_POST['id'] , 'seqasn'=>$pass,'epasswoed'=>'');
                      $pathAssign =base_url().'api/business_manage/enployeepasswordreset/format/json/';
                      $responseAssign  = curlcall($parameterAssign, $pathAssign);
                     $email_user =  $responseAssign->t_username;
                     $first_name =  $responseAssign->firstName;
                     $last_name =  $responseAssign->lastName;

      $message_u='<html><body bgcolor="#DCEEFC">
                 <br><div><table><p>Dear &nbsp;'.ucfirst($first_name).' &nbsp;'.$last_name.', </br>
                                </br> You recently made a request to reset your Security Answer. 
                 				</br> To complete the process, click the link below. </br>
                                </p>
                                 <tr><td>Login Page: </td><td><a href="'. base_url().'ssa/admin">Login</a>  </td></tr>
     
                                <tr><td>Email Id: </td><td>'.$email_user.' </td></tr>
                                <tr><td>Default Security Answer: </td><td>'.$password.' </td></tr>
                                <tr><td></td><td></td></tr>
                                <tr><td> Thanks</br>
                                 Support Team
                                </td><td>12345644</td>
                                <td>9 Am To 5 PM IST</td> </tr>
                             </table>
                               </div>
                              </body>
                              </html>';
                    $this->email->set_newline("\r\n");
          $this->email->from('barun@mindztechnology.com', 'Tru Expense');
          $this->email->to("$email_user");
          $this->email->subject('Security ans change');
          $this->email->message($message_u);
          $this->email->send();
          echo ($email_user); 

 }

public function category()
{
	$this->load->view('layout/header');
	$this->load->view('category');
	$this->load->view('layout/footer');
}
public function emppolicy()
{


                 $parameter=      array('act_mode'  => 'allview',
                                        'busid'     => $_POST['busid']); 
     $path  = base_url()."api/super_state_admin/getpolicy/format/json/";
     $response  = curlcall($parameter, $path);
     echo json_encode($response);
  	  exit();
}
public function empdepartment()
{


                 $parameter=      array('act_mode'  => 'viewdep',
                                        'busid'     => $_POST['busid']); 
                // p($parameter);

     $path  = base_url()."api/super_state_admin/getdeparts/format/json/";
     $response  = curlcall($parameter, $path);
     //p($response);

     echo json_encode($response);
  	  exit();
}
/*Rahul yadav 13/12/2014 */

public function firstloginupdate(){
							 $userid= $this->session->userdata['sessionData']['a_SId'];
							 $parameter = array('act_mode'=>$_POST['act_mode'] , 'userid'=>$userid );
    	       $path= base_url().'api/createbusinessadmin/firstloginpasschange/format/json/';
			   $firstlogin= curlcall($parameter, $path);


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
