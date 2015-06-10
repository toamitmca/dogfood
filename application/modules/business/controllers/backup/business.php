<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class business extends MX_Controller {
 
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
   					              't_Email' 	  	=> $this->input->post('email'),
   							      't_password' 		=> md5($this->input->post('password')),
   							      'act_mode'        => 'BusinessAdmin',
   							    ); 
   				// api call comes here
   				$path  		 = base_url().'api/business_admin/businessadmin/format/json/';
			   	$response  	 = curlcall($parameter, $path);
			   
			   	if($response =='Please try again'){
   					$this->session->set_flashdata('message','Please check email and password');
   					$base_url  = base_url();
   					redirect($base_url.'business/business/index/');
   					exit();
				}else{

					
					$sessionData = array(
									'businessLoginId'   => 22,
									'businessUserId'    => $response->a_BusnAdminId,
									'businessFirstName' => $response->t_FirstName,
									'businessLastName'  => $response->t_LastName,
									'businessEmail'     => $response->t_Email,
									'n_BusinessId'      => $response->n_BusinessId,
								);
					$this->session->set_userdata('sessionData', $sessionData);	
					$base_url  = base_url();
   					redirect($base_url.'business/dashboard/');
   					exit();												
   				}

   				// api call ends here

   			}	
   		}	
		$this->load->view('login');
   }


 public function login_check(){
 	$data = businesschecklogin();
 	if($data['businessLoginId'] != 22){
 		$baseURl = base_url();
 		redirect($baseURl);
 		exit();
 	}
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
 
