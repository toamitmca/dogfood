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
         $parameter = array('p_myemail' 	  	=> $this->input->post('email'),
                            'p_mypassword' 		=> md5($this->input->post('password')),
                            'p_actmode'        => 'BusinessAdmin',
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
           $i=0;
            $parameterRole= array( 'p_mode' => 'Select',
                                   'p_id' => 'null',
                                   'p_businessId' =>0 ,
                                   'p_AdminType' => 33,
                        );
            $pathRole  = base_url()."api/business_admin/role/format/json/";
            $responseRole  = curlcall($parameterRole, $pathRole);
           
          foreach ($response as $key => $value) {
              $sessionData = array(
                                 'businessLoginId'   => 22,
                                 'businessUserId'    => $response[0]->a_BusnAdminId,
                                 'businessFirstName' => $response[0]->t_FirstName,
                                 'businessLastName'  => $response[0]->t_LastName,
                                 'businessEmail'     => $response[0]->t_Email,
                                 'businessUserDeptId'=> $response[0]->n_DeptId,
                                 'n_BusinessId'      => $response[0]->n_BusinessId,
                                 'n_AdminType'       => $response[0]->n_AdminType,
                               );
              }

             
        $parameterAccess = array('p_userId'      => $sessionData['businessUserId'],
                                'p_BusinessId'    => $sessionData['n_BusinessId'],
                                'p_actmode'        => 'role',
                                ); 
          // api call comes here

          $pathAccess      = base_url().'api/business_admin/businessadmin/format/json/';
          $responseAccess    = curlcall($parameterAccess, $pathAccess);

        $arr[]=array();
         if($responseAccess =='Please try again'){
           
        }else{
           foreach ($responseAccess as $key3 => $value3) {
              $arr[]['n_RoleAccessId']=$value3->n_RoleAccessId;
              
            }
        }
        foreach ($responseRole as $key1 => $value1) {
            if(in_array($value1->a_RoleAccessId, $arr)){
              $roleAccess[$value1->t_AccessName]='yes';
            }else{
              $roleAccess[$value1->t_AccessName]='No';
            }
          }
          $this->session->set_userdata('sessionData', $sessionData);
          $this->session->set_userdata('roleAccess', $roleAccess);	
					$base_url  = base_url();
   					redirect($base_url.'business/dashboard/'); //dashboard/employee/
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
	redirect($data.'business/');
	exit();
}




public function checkEmail(){
   // api calls starts
   $parameter = array('bemail' => $this->input->post('email') ,
                      'bseq' => '', 
                      'act_mode' => 'emailcheck');

   $path  = base_url().'api/business_admin_2/checkbemail/format/json/';
   $response  = curlcall($parameter, $path);
    
   $data =  json_encode($response);
   echo $data;
   exit;
}

public function checkSeq(){
   // api calls starts
   $parameter = array('bemail' => $this->input->post('semail') , 'bseq' => $this->input->post('seq') , 'act_mode' => 'seqcheck');
 
   $path  = base_url().'api/business_admin_2/checkseq/format/json/';
   $response  = curlcall($parameter, $path);
   
   $data =  json_encode($response);
   echo $data;
   exit;
}
public function  forgot()
{
      if(isset($_POST['submit']) && $_POST['submit']=='Send')
      {


          $letters = 'abcefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
          $chars = 8;
          $randomString=  substr(str_shuffle($letters), 0, $chars);
          // $password= generateRandomString(6);
          $password= $randomString;

         $parameter = array(
                             'bemail' => $this->input->post('ffemail') ,
                             'bseq'   => $this->input->post('ff_seq'),
                             'bpass'  => $password

          );


               $path        = base_url().'api/business_admin_2/forgotpass/format/json/';
               $response    = curlcall($parameter, $path);

               if($response=='User could not be found')
               {
                  $this->session->set_flashdata('message','EMAIL ID AND SECURITY CODE DID NOT MATCH');
                  $base_url  = base_url();
                  redirect($base_url.'business/business/index/');
                  exit();
                }
                  else
                  {
                      $this->session->set_flashdata('message','YOUR PASSWORD SENT ON YOUR EMAIL ID');
                  $base_url  = base_url();
                  redirect($base_url.'business/business/index/');
                  exit();
                  }


      }

}

public function resetpass()
{
  $this->login_check();
  $userId= checklogin();
  $data = businesschecklogin();
  $Id = $data['n_BusinessId'];
  $this->load->view('layout/header');
  if(isset($_POST['submit']) && $_POST['submit']=='Reset Password')
  {
    $parameter = array(

                      'bid'      => $Id ,
                      'bpass'    => $this->input->post('new_password'),
                      'act_mode' => 'reset'
                      );
    


         $path = base_url().'api/business_admin_2/resetpasss/format/json/';
         $response    = curlcall($parameter, $path);
  
         if(!empty($response))
         {
                  $this->session->set_flashdata('message','SUCCESFULLY CHANGE PASSWORD');
                  $base_url  = base_url();
                  redirect($base_url.'business/changepassword/');
                  exit();
                  }
                  else
                  {
                      $this->session->set_flashdata('message','SOMTHING WENT WORNG');
                  $base_url  = base_url();
                  redirect($base_url.'business/resetpass/');
                  exit();
                  }
  }
       $this->load->view('business/changepassword');
       $this->load->view('layout/footer');
}


public function reset()
{
   $data = businesschecklogin();
   $Id = $data['n_BusinessId'];

   $parameter = array(
                     'bid'      => $Id ,
                     'bpass'    => $this->input->post('opass'),
                     'act_mode' => 'checkpass'

                       );


   $path  = base_url().'api/business_admin_2/checkpass/format/json/';
   $response  = curlcall($parameter, $path);
   $data =  json_encode($response);
   echo $data;
   exit;
}








// end of the class    
}
 
