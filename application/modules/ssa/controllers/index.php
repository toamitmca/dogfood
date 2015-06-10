<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Index extends MX_Controller {
 
  public function __construct() {
		  $this->load->model("supper_admin");
			$this->load->helper('my_helper');
	}

   public function index()
   {

   	  $get  = $this->login_check();
   	  if($get==true){
   	  	redirect();
   	  }
      //$this->load->view("layout/header");
      //echo checklogin();
   		if(isset($_POST['submit']) and $_POST['submit']=='Login'){
   			$this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[5]|xss_clean|valid_email');
   			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[255]|xss_clean');
   			if($this->form_validation->run() != false){
   				$parameter = array(
   					              'email' 	  => $this->input->post('email'),
   							      'password'  => md5($this->input->post('password')),
                      	   	      'act_mode'  => 'SuperAdmin' 
   							    );
   				$data = $this->supper_admin->call_procedureRow('proc_adminLogin', $parameter);
   				if(empty($data)){
   					$this->session->set_flashdata('message', 'Please check the username and password');
   					redirect('super_state_admin/index/');
   					exit();
   				}else{
   				    //p($data);
   					$sessionArray = array(
				   		'userId' => $data->a_SysloginId,
				   		'type'   => 'superAdmin'
				    );
				    $this->session->set_userdata('sessionData',$sessionArray);
				    redirect("super_state_admin/index/login_check");
   				}
            }

   		}
   		$this->load->view('login');
   		//$this->load->view("layout/footer");
   }


 public function business(){
 	echo 'Business';
 } 
 public function login_check(){
 	$data  = checklogin();
 	if(empty($data)){
 		$baseURl = base_url();
 		redirect($baseURl.'ssa/admin/');
 	}elseif($data['type'] !='superAdmin'){
 		$baseURl = base_url();
 		redirect($baseURl.'ssa/admin/');
 	}else{
 		return true;
 	}
 }



// end of the class    
}




// ==================================================
//
//	List of all the tables and procedures used will come here
//  Supper Admin Table  = tbl_systemlogin;
//  Supper Admin Login Procedure  =  proc_adminLogin
//
// ================================================== 