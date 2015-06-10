<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Super_state_admin extends MX_Controller {
 
  public function __construct() {
	$this->load->model("supper_admin");	
	$this->load->helper('my_helper');
  }

   public function index()
   {
   	  	//$this->login_check();
   	  	if(isset($_POST['submit']) and $_POST['submit']=='Login'){
   			$this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[5]|xss_clean|valid_email');
   			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[255]|xss_clean');
   			if($this->form_validation->run() != false){
   				$parameter = array(
   					              'email' 	  => $this->input->post('email'),
   							      'password'  => md5($this->input->post('password')),
   							      'act_mode'  => 'SuperAdmin',
   							      'userId'    => ''
   							    );
   				$data = $this->supper_admin->call_procedureRow('proc_adminLogin', $parameter);

   				if(empty($data)){
   					$this->session->set_flashdata('message', 'Please check the username and password');
   					redirect('super_state_admin/');
   					exit();
   				}else{
   					
   				    $sessionArray = array(
				   		'Name'         => $data->t_username,
				   		'userId'       => $data->a_SysloginId,
				   		'lastLogin'    => $data->d_modifiedon,
				   		'actMode'      => 'Supper Admin',
				   		'LoginStatus'  => 'True'
				   	);

				    // Now Updating the last login
				    $parameter = array(
   					              'email' 	  => '',
   							      'password'  => '',
   							      'act_mode'  => 'lastLogin',
   							      'userId'    => $data->a_SysloginId
   								  );
				    $this->supper_admin->call_procedureRow('proc_adminLogin', $parameter);
				    $this->session->set_userdata('sessionData',$sessionArray);
				    redirect("super_state_admin/dashboard/");
				    exit();
   				}
            }

   		}
   		$this->load->view('login');
   		
   }


 public function dashboard(){
 	$this->login_check();
 	$this->load->view('layout/header');
 	$this->load->view('layout/footer');
 } 




 public function login_check(){
 	$data = checklogin();
 	if($data['actMode'] != 'Supper Admin' && $data['LoginStatus']!= 'True'){
 		$baseURl = base_url();
 		redirect($baseURl);
 		exit();
 	}
 }


public function business_add(){
	$this->login_check();
 	$this->load->view('layout/header');
 	$this->load->view('super_state_admin/businessAdd');
 	$this->load->view('layout/footer');

}

 public function business(){

     

   //$data = $this->supper_admin->call_procedureRow('proc_adminLogin', $parameter);



 	$this->login_check();
 	$this->load->view('layout/header');
 	$this->load->view('super_state_admin/business');
 	$this->load->view('layout/footer');
 }


public function setting(){
	$this->login_check();
 	$this->load->view('layout/header');
 	$this->load->view('super_state_admin/settings');
 	$this->load->view('layout/footer');
}

public function countrylisting(){
	$this->login_check();
 	$this->load->view('layout/header');
 	$parameter = array(
 						'countryName' => '',
 						'd_CreatedOn' => '',
 						'id' => '',
 						'act_mode' => 'select',
 					  );
	$data = $this->supper_admin->call_procedureRow('countryManage', $parameter);

 	$this->load->view('super_state_admin/setting/countryListing');
 	$this->load->view('layout/footer');
}

public function countryadd(){
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

   $this->load->view('super_state_admin/setting/countryAdd');
   $this->load->view('layout/footer');
}

public function statelisting(){
   $this->login_check();
   $this->load->view('layout/header');
   $parameter = array(
                  'countryName' => '',
                  'd_CreatedOn' => '',
                  'id' => '',
                  'act_mode' => 'select',
                 );
   $data = $this->supper_admin->call_procedureRow('countryManage', $parameter);

   $this->load->view('super_state_admin/setting/stateListing');
   $this->load->view('layout/footer');
}



public function stateadd(){
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

   $this->load->view('super_state_admin/setting/stateAdd');
   $this->load->view('layout/footer');
}



public function business_admin_employee_panel(){
   $this->login_check();
   $this->load->view('layout/header');
 
    if ($this->input->post('save') == 'Save') { 

/*
      $dtat = array('' => , );


Array ( [status] => 1 [fname] => First Name [lname] => Last Name [policy] => 1 [department] => 1 [eid] => Employee Id [office_phone] => Office Phone 
   [mobile_phone] => Mobile Phone [aline1] => Address Line1 [aline2] => Address Line2 [aline3] => Address Line3 [city] => 14 [state] => 12 
   [pincode] => PIN Code [country] => 8 [save] => Save ) I am reach*/

$paramete_custm = array( 
   'p_mode'=>'Insert',
   'eid'=>$this->input->post('eid'),
   'fname'=>$this->input->post('fname'),
    'lname'=>$this->input->post('lname'),
   
    'department'=>$this->input->post('department'),
    'p_EmpCode'=>$this->input->post('eid'),
     'policy'=>$this->input->post('policy'),
      'p_EmpDob'=>$this->input->post('dob'),

     
   'office_phone'=>$this->input->post('office_phone'),
   'mobile_phone'=>$this->input->post('mobile_phone'),
   'aline1'=>$this->input->post('aline1'),
   'aline2'=>$this->input->post('aline2'),
   'aline3'=>$this->input->post('aline3'),
      'country'=>$this->input->post('country'),
         'state'=>$this->input->post('state'),
   'city'=>$this->input->post('city'),

   'pincode'=>$this->input->post('pincode'),

    'p_Status'=>'',
    'p_CreatedBy'=>'',
      'p_BusinessId'=>''
   );
   $data_custm = $this->supper_admin->call_procedureRow('proc_EmployeeMaster', $paramete_custm);

   



    }




   //if(isset($_POST['submit']))
   //$parameter = array(
   //             'countryName' => '',
   //             'd_CreatedOn' => '',  if ($this->input->post('submit') == 'Save') {
   //             'id' => '',
   //             'act_mode' => 'insertinto',
   //            );
   //$data = $this->supper_admin->call_procedureRow('countryManage', $parameter);

   $this->load->view('super_state_admin/business_admin_employee_panel');
   $this->load->view('layout/footer');
}

public function business_admin_business_admin_panel(){
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

   $this->load->view('super_state_admin/business_admin_business_admin_panel');
   $this->load->view('layout/footer');
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