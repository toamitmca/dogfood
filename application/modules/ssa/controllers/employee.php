<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Employee extends MX_Controller {
 
  public function __construct() {
	$this->load->model("supper_admin");
	$this->load->helper('my_helper');
  }

  public function index(){
  	$this->login_check();
	$this->load->view('layout/header');
 	$this->load->view('superadmin/index');
 	$this->load->view('layout/footer');
  }


public function superadminAdd(){
	$this->login_check();
	$sessionData = checklogin();
	$this->load->view('layout/header');
	if(isset($_POST['submit']) && $_POST['submit']=='Create Super Admin'){
		$this->form_validation->set_rules('firstName', 'FirstName', 'trim|required|min_length[5]|max_length[255]|xss_clean');
		$this->form_validation->set_rules('lastName', 'Password', 'trim|required|min_length[5]|max_length[255]|xss_clean');
		$this->form_validation->set_rules('t_username', 'Email Id', 'trim|required|min_length[5]|max_length[255]|xss_clean|valid_email|is_unique[tbl_systemlogin.t_username]');
		$this->form_validation->set_rules('t_password', 'Password', 'trim|required|min_length[5]|max_length[255]|xss_clean');
		if($this->form_validation->run() !=false){

			$parameter = array(
							     'firstName'   => $this->input->post('firstName'),
							     'lastName'    => $this->input->post('lastName'),
							     't_username'  => $this->input->post('t_username'),
							     't_password'  => $this->input->post('t_password'),
							     'n_createdby' => $sessionData['a_SId']
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
	$this->load->view('superadmin/superAdmin');$this->load->view('superadmin/superAdmin');
 	$this->load->view('layout/footer');
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
						 'firstName'    => '',
                         'lastName'     => '',
                         'email'        => '',
                         'password'  	=> '',
                         'n_createdby'  => '',
                         'act_mode'  	=> 'displaysingle',
                         'userlist'     => $id
					   );
	// api call starts here
	$path  = base_url().'api/super_state_admin/systemadminedit/format/json/';
	$data['response']  = curlcall($parameter, $path);
	// api cal ends here

	// update query will come here
	if(isset($_POST['submit']) && $_POST['submit']=='Update Admin'){
		$this->form_validation->set_rules('firstName', 'FirstName', 'trim|required|min_length[5]|max_length[255]|xss_clean');
		$this->form_validation->set_rules('lastName', 'Password', 'trim|required|min_length[5]|max_length[255]|xss_clean');
		$this->form_validation->set_rules('t_username', 'Email Id', 'trim|required|min_length[5]|max_length[255]|xss_clean|valid_email|');
		if($this->form_validation->run() !=false){
			$sessionData = checklogin();
			$parameter = array(
			                    'firstName'     => $this->input->post('firstName'),
			                    'lastName'      => $this->input->post('lastName'),
			                    't_username' 	=> $this->input->post('t_username'),
			                    'n_modifiedby'  => $sessionData['a_SId'],
			                    'a_SysloginId'  => $id
				             );
			// api call starts here
			$path  = base_url().'api/super_state_admin/systemadminupdate/format/json/';
			$data['response']  = curlcall($parameter, $path);
			p($data['response']);
			die();
			// api call ends here

		}
	}
	// update query will end over here
	$this->load->view('superadmin/supperAdminEdit', $data);
	$this->load->view('layout/footer');
}

public function deletesystemadmin($id){
	$this->login_check();
	$this->load->view('layout/header');
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
 		//redirect($baseURl);
 		redirect($baseURl.'ssa/admin/');
 		exit();
 	}
 }

public function  employeelock(){

                 $this->login_check();

                 $this->login_check();
                 $userId= checklogin();
                 $Id=$this->uri->segment('4');
                 if($Id!='')
                 {
                 $parameter = array( 'act_mpde'   => 'allviewbyid',
                 	                 'id'         => $Id,
                 	                 'b_deleted'  => ''
                 	                 );
                             }
             else {
             	 $parameter = array( 'act_mpde'   => 'allview',
                 	                 'id'         => $Id,
                 	                 'b_deleted'  => ''
                 	                 );
             	              }

			       $path  = base_url().'api/business_manage/employeeview/format/json/';
		          // $response['data']  = curlget($path);
				   $response['data']  = curlcall($parameter, $path);
				  if($Id !=''){
				  $response['businessid']=$Id;
				  }
				  else{
				 $response['businessid']=0;
				  }


                    $parameter = array('business_name' =>'' ,'act_mode'=>'all' );
/*Get left side*/   $path       = base_url().'api/createbusinessadmin/searchbusinessall/format/json/';
                    $response['policy']  = curlcall($parameter, $path);


				   $this->load->view('layout/header');
		       	   $this->load->view('employee/employeelist',$response);
		           $this->load->view('layout/footer');


}
public function getEmployee()
{
	 $this->login_check();

                 $this->login_check();
                 $userId= checklogin();
                 $Id=$_POST['busid'];
                 $parameter = array( 'act_mpde'   => 'allviewbyid',
                 	                 'id'         =>  $Id,
                 	                 'b_deleted'  => ''
                 	                 );
                // p($parameter);
           $path  = base_url().'api/business_manage/employeeview/format/json/';
           $response = curlcall($parameter, $path);
           if($response!='Something Went Wrong')
           {
           echo json_encode($response);
       }
 }
 public function employee_delete(){
          $this->login_check();
          $userId= checklogin();
          $stateId=$this->uri->segment('4');
          $parameter = array( 
            'act_mpde'=>'delete',
          	'id' => $stateId ,
          	'b_deleted'=>'1' );
          // call api
          $path = base_url().'api/business_manage/employeedelete/format/json/';
	      $response  = curlcall($parameter, $path);
     	  if(!empty($response)){
	 	  $this->session->set_flashdata('message','Record deleted Successfully');
	 	  $base_url  = base_url();
          redirect($base_url.'ssa/employee/employeelock/');
          exit;
	      }
	      else{
	 	  $this->session->set_flashdata('message','Record Not  deleted Successfully');
	      $base_url  = base_url();
          redirect($base_url.'ssa/employee/employeelock/');
	      exit;
	      }
	      $base_url  = base_url();
          redirect($base_url.'ssa/employee/employeelock/');
          exit;
         }
 public function employee_status(){
          $this->login_check();
          $userId= checklogin();
          $stateId=$this->uri->segment('4');
          $b_deleted=$this->uri->segment('5');
           if($b_deleted==0){
           $status=2;
           }
           	else{
           		$status=0;
           	}
          $parameter = array(
          	'act_mpde'=>'delete',
          	'id' => $stateId,
          	'b_deleted'=>$status );
          // call api
          //p($parameter);
          //exit;
          $path = base_url().'api/business_manage/employeedelete/format/json/';
	      $response  = curlcall($parameter, $path);
     	  if(!empty($response)){
	 	  $this->session->set_flashdata('message','Record updated Successfully');
	 	  $base_url  = base_url();
          redirect($base_url.'ssa/employee/employeelock/');
          exit;
	      }
	      else{
	 	  $this->session->set_flashdata('message','Record Not  updated Successfully');
	      $base_url  = base_url();
          redirect($base_url.'ssa/employee/employeelock/');
	      exit;
	      }
	      $base_url  = base_url();
          redirect($base_url.'ssa/employee/employeelock/');
          exit;
         }


 
public function getEmpdetail()
{
	             $this->login_check();
                 
                 $parameter = array( 'E_busiid'    => $this->input->post('busid'),
                 	                 'n_PolicyId'  => $this->input->post('policy'),
                 	                 'E_depid'     => $this->input->post('department'),
                 	                 'E_email'     => $this->input->post('email1')
                 	                 );
                 p($parameter);
              
	           $path  = base_url().'api/business_manage/employeeCheckEmp/format/json/';
	           $response = curlcall($parameter, $path);
	           if($response!='Something Went Wrong')
	           {

	          
	           echo json_encode($response);
	       }
}




         /*public function arraytest(){
     $a =  array('a1' => 'v1','a2' => 'v2', 'a3' => 'v3','a4' => 'v4','a5' => 'v5','a6' => 'v6' , 'z2' =>'z2');
       $b = array('a1' =>'v1' , 'b1'=>'v1' , 'b2'=>'v6'  ,'v4'=>'c4' ,'c2'=>'c1' ,'test'=> array('z1' =>'z3' , 'z2' =>'z2'  )  );

       $result = array_diff($b, $a);
      p($result);
      exit;


         }*/
// end of the class
}


// ==================================================
//
//	List of all the tables and procedures used will come here
//  Supper Admin Table  = tbl_systemlogin;
//  Supper Admin Login Procedure  =  proc_adminLogin
//  country TableName = "tblcountry";
//  procedure for this is    = "countryManage
//
// ================================================== 
