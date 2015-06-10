<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Menu extends MX_Controller {
 
  public function __construct() {
	$this->load->model("supper_admin");	
	$this->load->helper('my_helper');
  }

  public function index(){
	$this->load->view('layout/header');
	if(isset($_POST['submit'])){
 		$this->form_validation->set_rules('t_menunane', 't_menunane', 'trim|required|max_length[255]|xss_clean');
 		$this->form_validation->set_rules('type', 'type', 'trim|required|max_length[255]|xss_clean');
 		$this->form_validation->set_rules('t_url', 't_url', 'trim|required|max_length[255]');
		if($this->form_validation->run()==true){
			$param = array(
				           't_menunane' => $this->input->post('t_menunane'),
				           'type'       => $this->input->post('type'),
			               't_url'      => $this->input->post('t_url'),
			               'p_mode'     => 'pinsert'
			              );
			// api calls stars here
			$path      = base_url().'api/menu/menu22/format/json/';
			$response  = curlcall($param, $path);
    		// api calls ends here

 		}
 	}
	$this->load->view('menu');
 	$this->load->view('layout/footer');
  }


public function superadminAdd(){
	$this->login_check();
	$sessionData = checklogin();
	$this->load->view('layout/header');
	if(isset($_POST['submit']) && $_POST['submit']=='Create System Admin'){
		
		$this->form_validation->set_rules('firstName', 'FirstName', 'trim|required|min_length[5]|max_length[255]|xss_clean');
		$this->form_validation->set_rules('lastName', 'Password', 'trim|required|min_length[5]|max_length[255]|xss_clean');
		$this->form_validation->set_rules('n_CountryId_1', 'Country', 'trim|required|xss_clean');
		$this->form_validation->set_rules('n_StateId_1', 'State', 'trim|required|xss_clean');
		$this->form_validation->set_rules('t_Address1', 'Address', 'trim|required|xss_clean');
		$this->form_validation->set_rules('t_Address2', 'Address', 'trim|required|xss_clean');
		$this->form_validation->set_rules('t_username', 'Email Id', 'trim|required|min_length[3]|max_length[255]|xss_clean|valid_email|is_unique[tbl_systemlogin.t_username]');
		$this->form_validation->set_rules('t_password', 'Password', 'trim|required|min_length[3]|max_length[255]|xss_clean');
		
		if($this->form_validation->run() !=false){
		 $parameter = array(
							     'firstName'       => $this->input->post('firstName'),
							     'lastName'        => $this->input->post('lastName'),
								 'n_CountryId_1'   => $this->input->post('n_CountryId_1'),
							     'n_StateId_1'     => $this->input->post('n_StateId_1'),
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
	$this->load->view('layout/footer');
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
	$this->login_check();
	$this->load->view('layout/header');

	// api call comes here
	$path  = base_url().'api/super_state_admin/admins/format/json/';
	$data['response']  = curlget($path);
	// api call ends here

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
	if(isset($_POST['submit']) && $_POST['submit']=='Create System Admin'){
		$this->form_validation->set_rules('firstName', 'FirstName', 'trim|required|min_length[5]|max_length[255]|xss_clean');
		$this->form_validation->set_rules('lastName', 'Password', 'trim|required|min_length[5]|max_length[255]|xss_clean');
		$this->form_validation->set_rules('t_username', 'Email Id', 'trim|required|min_length[5]|max_length[255]|xss_clean|valid_email|');
		if($this->form_validation->run() !=false){
			$sessionData = checklogin();
			$parameter = array(
							     'firstName'       => $this->input->post('firstName'),
							     'lastName'        => $this->input->post('lastName'),
								 'n_CountryId_1'   => $this->input->post('n_CountryId_1'),
							     'n_StateId_1'     => $this->input->post('n_StateId_1'),
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
		                 'sys_status' => 'Deactive',

		                  );

	// api call start from here 
	$path = base_url().'api/super_state_admin/systemadmindeactiv/format/json';
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
