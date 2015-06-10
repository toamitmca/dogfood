<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Admin2 extends MX_Controller {
 
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
			   	$path  = base_url().'api/super_state_admin/user/id/2/format/json/';
			   	$response  = curlcall($parameter, $path);
			    if($response =='Something Went Wrong'){
   					
   					$this->session->set_flashdata('message','Please check email and password');
   					$base_url  = base_url();
   					redirect($base_url.'ssa/admin/index/');
   					exit();

				}else{

					$myarray = array(
   									   'a_SId' 	      => $response->a_SysloginId,
   									   'a_SysAdminId' => $response->a_SysAdminId,
   									   't_username'   => $response->t_username,
   									   'd_modifiedon' => $response->d_modifiedon,
   									);	
					$this->session->set_userdata('sessionData', $myarray);	
					$base_url  = base_url();
   					redirect($base_url.'ssa/admin/dashboard/');
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
 		redirect($baseURl.'ssa/admin/');

 		exit();
 	}
 }


public function business_add(){
	$this->login_check();
 	$this->load->view('layout/header');
 	$this->load->view('business');
 	$this->load->view('layout/footer');
}

public function setting(){
	$this->login_check();
 	$this->load->view('layout/header');
 	$this->load->view('setting/index');
 	$this->load->view('layout/footer');
}

public function countrylisting(){
	$this->login_check();
 	$this->load->view('layout/header');
   // $parameter = array(
   //                            'a_CountryId'     => '',
   //                            't_CountryName'  => '',
   //                            'act_mode'  => 'select',
   //                            'n_AdminType'    => '33'
   //                          );
   $countryIdValue=''; 
   $countryNameValue='';
   $path  = base_url()."api/countrylisting/country/id/$countryIdValue/t_CountryName/$countryNameValue/act_mode/select/n_AdminType/33/format/json/";
   $response  = curlget($path);
   $data['listing']=json_decode($response);
   $this->load->view('setting/countryListing', $data);
 	$this->load->view('layout/footer');
}


public function countryadd(){
   $this->login_check();
   $this->load->view('layout/header');
   $this->load->view('super_state_admin/setting/countryAdd');
   $this->load->view('layout/footer');
}

public function editcountry(){
   $this->login_check();
   $countryId=$this->uri->segment('4');
   $this->load->view('layout/header');
   $countryIdValue=$countryId; 
   $countryNameValue='';
   echo $path  = base_url()."api/countrylisting/country/id/$countryIdValue/t_CountryName/$countryNameValue/act_mode/editselect/n_AdminType/33/format/json/";
   $response  = curlget($path);
   p($response);
   die();
   $data['listing']=json_decode($response);
   echo "<pre>";
   print_r($data);
   exit();
   $this->load->view('setting/editCountry', $data);
   $this->load->view('layout/footer');
}

public function deletecountry(){
   $countryId=$this->uri->segment('4');
   $this->login_check();
   $this->load->view('layout/header');
   $countryIdValue=$countryId; 
   $countryNameValue='';
   $path  = base_url()."api/countrylisting/country/a_CountryId/$countryIdValue/t_CountryName/$countryNameValue/act_mode/editselect/n_AdminType/33/format/json/";
   $response  = curlget($path);
   $data['listing']=json_decode($response);

}


public function statelisting(){
	$this->login_check();
 	$this->load->view('layout/header');
 	$this->load->view('setting/index');
 	$this->load->view('layout/footer');
}

function logout(){
	session_unset();
	echo $data = base_url();
	$this->session->sess_destroy();	
	//redirect($data);
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