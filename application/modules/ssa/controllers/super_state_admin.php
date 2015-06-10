<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Super_state_admin extends MX_Controller {
 
  public function __construct() {
	$this->load->model("supper_admin");	
	$this->load->helper('my_helper');
  }

  public function index(){

   	
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
   				// api call comes here
			   	$apiUrl = base_url().'api/super_state_admin/user/id/2/format/json/'; 
			   	$curl_handle = curl_init();
			   	curl_setopt($curl_handle, CURLOPT_URL, $apiUrl);
			   	curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER,true);
			   	curl_setopt($curl_handle, CURLOPT_POST, true);
			   	curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $parameter);
			   	$response = curl_exec($curl_handle);
			   	curl_close($curl_handle);
   				$response = json_decode($response);
   				if($response=='Something Went Wrong'){

   					$this->session->set_flashdata('message','Please check email and password');
   					$base_url  = base_url();
   					redirect($base_url.'super_state_admin/super_state_admin/index/');
   					exit();
				}else{

					$myarray = array(
   									   'a_SId' => $response->a_SysloginId,
   									   'a_SysAdminId' => $response->a_SysAdminId,
   									   't_username'   => $response->t_username,
   									   'd_modifiedon' => $response->d_modifiedon,
   									);	
				
					$this->session->set_userdata('sessionData', $myarray);		
					$base_url  = base_url();
   					redirect($base_url.'super_state_admin/super_state_admin/dashboard/');
   					exit();												
   				}
   				

   				// api call ends here
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
 	if($data['a_SysAdminId'] != 33){
 		$baseURl = base_url();
 		//redirect($baseURl);
      redirect($data.'ssa/admin/');
 		exit();
 	}
 }


 public function business_add(){
	$this->login_check();
 	$this->load->view('layout/header');
 	$this->load->view('super_state_admin/businessAdd');
 	$this->load->view('layout/footer');

}

function logout(){
  session_unset();
  echo $data = base_url();
  $this->session->sess_destroy();
  redirect($data.'ssa/admin/');
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