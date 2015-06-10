<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Super_state_admin extends REST_Controller{

public function __construct()
       {
            parent::__construct();
            $this->load->library('email');
            // Your own constructor code
       }

    function send_json($array){

        $this->output->set_content_type('application/json');
        $this->output->set_header('Cache-Control: no-cache, must-revalidate');
        $this->output->set_header('Expires: '.date('r', time()+(86400*365)));
        echo json_encode($array);
        exit();
   	 }

    function user_post(){
        //$this->some_model->updateUser( $this->get('id') );
        $data = json_decode(file_get_contents("php://input"), true);

		$parameter = array(
							'firstName'		=> '',
							'lastName'		=> '',
							'email'         => $this->input->post('email'),
							'password'		=> $this->post('password'),
							'createdby'     => '',
							'act_mode'      => 'SuperAdmin',
							'n_CountryId_1' => '',
							'n_StateId_1'   => '',
							't_Address1'    => '',
							'userId'        => ''
		);
					
        $data = $this->supper_admin->call_procedureRow('proc_adminLogin', $parameter);
      	
        if(!empty($data)){
            $data   = $this->send_json($data);  
            $this->response($data, 202); 
        }
        else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }

    }

  function userlogin_post(){
     $data = json_decode(file_get_contents("php://input"), true);

     $parameter = array(       'status'       =>'',
                              'firstName'     => '',
                              'lastName'      => '',
                               'dob'          =>'',
                              'email'         => '',
                              'password'      => '',
                              'createdby'     => '',
                              'act_mode'      => 'lastlogin',
                              'n_CountryId_1' => '',
                              'n_StateId_1'   => '',
                              'n_CityId'      => '',
                              't_Address1'    => '',
                              'userId'        => $this->post('userId')
                              );
     $data = $this->supper_admin->call_procedureRow('proc_adminLogin', $parameter);
        
        if(!empty($data)){
            $data   = $this->send_json($data);  
            $this->response($data, 202); 
        }
        else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }
  }


    function deptName_post(){

       $data = json_decode(file_get_contents("php://input"), true);
          $parameter = array(
                            'p_mode'      =>$this->post('p_mode'),
                            'p_DeptId'    => $this->post('p_DeptId'),
                            'p_DeptName'  =>$this->post('p_DeptName'),
                            'p_XmlData'   => $this->post('p_XmlData'),
                            'p_AdminType' =>$this->post('p_AdminType'),
                            'p_BusinessId'=> $this->post('p_BusinessId'),
                            'p_CreatedBy'=> $this->post('p_CreatedBy')
                            );
           $data = $this->supper_admin->call_procedure('proc_EditOrViewDeptName',$parameter);
     if(!empty($data)){
       $data   = $this->send_json($data);
       $this->response($data, 202);
     }else{
        $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
     }
    }

    function businessname_post(){

       $data = json_decode(file_get_contents("php://input"), true);
          $parameter = array(
                            'p_mode'  =>$this->post('p_mode'),
                            'p_id'    => $this->post('p_id'),
                           );
           $data = $this->supper_admin->call_procedure('proc_EditViewBusinessName',$parameter);
       if(!empty($data)){
         $data   = $this->send_json($data);
         $this->response($data, 202);
       }else{
          $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
       }
    }


  function depdetails_post(){

       $data = json_decode(file_get_contents("php://input"), true);
         $parameterBus=array('act_mode'  => $this->post('act_mode'),
                             'dep_id'    => $this->post('dep_id'),
                             'bus_id'    => 'null',
                             'dep_name'  => 'null',
                     
                      );
           $data = $this->supper_admin->call_procedureRow('proc_EditViewDep',$parameterBus);
       if(!empty($data)){
         $data   = $this->send_json($data);
         $this->response($data, 202);
       }else{
          $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
       }
    }
      
      function depedit_post(){

       $data = json_decode(file_get_contents("php://input"), true);
         $parameterBus=array('act_mode'  => $this->post('act_mode'),
                             'dep_id'    => $this->post('dep_id'),
                             'bus_id'    => $this->post('bus_id'),
                             'dep_name'  => $this->post('dep_name')

                     
                      );
       $this->supper_admin->call_procedureRow('proc_EditViewDep',$parameterBus);
       $data  = array('success' => 'success' );
       if(!empty($data)){
         $data   = $this->send_json($data);
         $this->response($data, 202);
       }else{
          $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
       }
    }
     function depdelete_post(){

       $data = json_decode(file_get_contents("php://input"), true);
         $parameterBus=array('act_mode'  => $this->post('act_mode'),
                             'dep_id'    => $this->post('dep_id'),
                             'bus_id'    => $this->post('bus_id'),
                             'dep_name'  => $this->post('dep_name')

                     
                      );
       $this->supper_admin->call_procedureRow('proc_EditViewDep',$parameterBus);
       $data  = array('success' => 'success' );
       if(!empty($data)){
         $data   = $this->send_json($data);
         $this->response($data, 202);
       }else{
          $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
       }
    }


         function businessdepartmentadd_post() {
      $data = json_decode(file_get_contents("php://input"), true);
                    $parameter = array(
                               'p_mode'           => $this->post('p_mode'),
                               'p_DeptId'         =>$this->post('p_DeptId'),
                               'p_DeptName'       => $this->post('p_XmlData_dname'),
                               'p_AdminType'      => $this->post('p_AdminType'),
                               'p_BusinessId'     => $this->post('p_BusinessId'),
                               'p_CreatedBy'      => $this->post('p_CreatedBy')
                                );
        $this->supper_admin->call_procedureRow('proc_AddDepartmentmulty',$parameter);
        $data=array('Success'=>'Success');
         if(!empty($data)){
          $data   = $this->send_json($data);
          $this->response($data, 202); 
        }
        else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }

     }

    function admin_post(){

        //$this->some_model->updateUser( $this->get('id') );
        $data = json_decode(file_get_contents("php://input"), true);

        $parameter = array(
                              'status'        => $this->post('status'),
                              'firstName'     => $this->post('firstName'),
                              'lastName'      => $this->post('lastName'),
                              'dob'           => $this->post('dob'),
                              'email'         => $this->post('t_username'),
							                'password'  	  => md5($this->post('t_password')),
							                'createdby'     => $this->post('n_createdby'),
							                'act_mode'      => 'insertSelect',
                              'n_CountryId_1' => $this->post('n_CountryId_1'),
                              'n_StateId_1'   => $this->post('n_StateId_1'),
                              'n_CityId_1'    => $this->post('n_CityId_1'),
							                't_Address1'    => $this->post('t_Address1').'___'.$this->post('t_Address2'),
							                'userId'        => ''

                          );

		$data = $this->supper_admin->call_procedure('proc_adminLogin', $parameter);
        if(!empty($data)){

          // MAIL FUNCTION STARTs FROM HERE
          ############################### USer mail send ###########################################################
          $firtsname=ucfirst($this->post('firstName')).' '. ucfirst($this->post('lastName'));
          $pass=$this->post('t_password');
          $email=$this->post('t_username');
          //$last_insert_id=$data('insertid');
               $message_u='<html>
                         <body bgcolor="#DCEEFC">
                 <b> Password</b><br><div>
                                 <table>
                                <tr><td>Dear.</td> <td> '.$firtsname.'</td></tr>
                                <tr><td>EMAIL.</td> <td> '.$email.'</td></tr>
                                <tr><td>Your password </td><td>'.$pass.' </td></tr>
                                <tr><td>Login ID </td><td></td></tr>
                                
                                <tr><td> Thanks Regard  </br>
                                 True Expense  Team
                                </td><td></td>  </tr>
                             </table>
                               </div>
                              </body>
                    </html>';
                    $this->load->library('email');
                    $this->email->set_newline("\r\n");
                    $this->email->from('barun@mindztechnology.com', 'Tru Expense');
                    $this->email->to($email);
                    $this->email->subject('Password');
                    $this->email->message($message_u);
                    $this->email->send();

 // MAIL FUNCTION END HERE

            $data   = $this->send_json($data);  
            $this->response($data, 202); 
        }
        else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }
       
    }

    function admins_get(){
    	$parameter = array(       'status'     =>'',
                              'firstName'     => '',
                              'lastName'      => '',
                               'dob'           =>'',
                              'email'         => '',
							                'password'  	  => '',
							                'createdby'     => '',
							                'act_mode'      => 'selectall',
                              'n_CountryId_1' => '',
                              'n_CityId'      => '',
                              'userId'        => '',
							                'userlist'      => '',
							                't_Address1'    => ''

                          );

    	$data = $this->supper_admin->call_procedure('proc_adminLogin', $parameter);

    	if($data){
            $data = $this->send_json($data);
            $this->response($user, 200); // 200 being the HTTP response code
        }
		else{
            $this->response(array('error' => 'User could not be found'), 404);
        }
    }

     function states_post(){

		$data = json_decode(file_get_contents("php://input"), true);
        $parameter = array('countryId' => $this->post('id'));
        $data = $this->supper_admin->call_procedure('proc_displaystate', $parameter);
		if(!empty($data)){
        	$data   = $this->send_json($data);
            $this->response($data, 202);
        }
        else{
             $this->response("No Result Found", 400); // 200 being the HTTP response code
        }

    }

    function city_post(){
		
		$data = json_decode(file_get_contents("php://input"), true);
        $parameter = array('n_StateId' => $this->post('n_StateId'));
        $data = $this->supper_admin->call_procedure('proc_displayCity', $parameter);
		if(!empty($data)){
        	$data   = $this->send_json($data);  
            $this->response($data, 202); 
        }
        else{
             $this->response("No Result Found", 400); // 200 being the HTTP response code
        }
       
    }


    function systemadminedit_post(){
    	  $parameter = array(
                         'status'        =>'',
                         'firstName'     => '',
                         'lastName'      => '',
                         'dob'      => '',
                         'email'         => '',
                         'password'  	   => '',
                         'n_createdby'   => '',
                         'act_mode'  	   => 'displaysingle',
                         'userlist'      => '', 
                         'userlisdfdst'  => '',  
						             'userasrfdsd'   => '',
						             'userlisasdt'   => '',
						             'userId'    	   => $this->post('userId')
                         );

    	$data = $this->supper_admin->call_procedureRow('proc_adminLogin', $parameter);

    	if($data){
            $data = $this->send_json($data);   
            $this->response($data, 200); // 200 being the HTTP response code
        }
		else{
            $this->response(array('error' => 'User could not be found'), 404);
        }

    }

    function systemadminupdate_post(){
    	  
		$parameter = array(
                              'status'     => $this->post('status'),
							                'firstName'     => $this->post('firstName'),
                              'lastName'      => $this->post('lastName'),
                              'dob'      => $this->post('dob'),
                              'id'  	        => $this->post('t_password'),
							                'n_CountryId_1' => $this->post('n_CountryId_1'),
                              'n_StateId_1'   => $this->post('n_StateId_1'),
                              'n_CityId_1'    => $this->post('n_CityId_1'),
							                't_Address1'    => $this->post('t_Address1').'___'.$this->post('t_Address2'),
							                'modifiedBy'    => $this->post('n_modifiedby')
							  
                           );
		$data = $this->supper_admin->call_procedureRow('proc_updatesysteradmin', $parameter);
		$data = 1;
    	if($data){
            $data = $this->send_json($data);   
            $this->response($data, 200); // 200 being the HTTP response code
        }
		else{
            $this->response(array('error' => 'User could not be found'), 404);
        }

    }
    function systemadmindelete_post()
    {
      $parameter = array(
                          'row_id' => $this->post('row_id') , 
                          'sys_status' => '',
                          'act_mode' => 'admindelete'
                          );
      $data = $this->supper_admin->call_procedureRow('proc_sysadmindelete' , $parameter);
      $data=1;
      if($data)
      {
        $data = $this->send_json($data);
        $this->response($data , 200);
      }
    }
    function systemadminactive_post()
    {
      $parameter = array(

                          'row_id' => $this->post('row_id') ,
                          'sys_status' => $this->post('sys_status'),
                          'act_mode' => 'adminactive' 
                          );
      $data = $this->supper_admin->call_procedureRow('proc_sysadmindelete' , $parameter);
      $data=1;
      if($data)
      {
        $data= $this->send_json($data);
        $this->response($data , 200);
      }
    }

  function systemadmindeactive_post()
    {
      $parameter = array(

                          'row_id' => $this->post('row_id') ,
                          'sys_status' => $this->post('sys_status'),
                          'act_mode' => 'adminactive' 
                          );
      $data = $this->supper_admin->call_procedureRow('proc_sysadmindelete' , $parameter);
      $data=1;
      if($data)
      {
        $data= $this->send_json($data);
        $this->response($data , 200);
      }
    }
	function superAdminemail_post(){
    	  
		$parameter = array('email' => $this->post('email'));
		$data = $this->supper_admin->call_procedureRow('pro_checkadminemail', $parameter);
		if($data){
            $data = $this->send_json($data);   
            $this->response($data, 200); // 200 being the HTTP response code
        }
		else{
            $this->response(array('error' => 'User could not be found'), 404);
        }

    }



function systemAdminverification_post()
{
  $parameter = array(
                     'row_id'     => $this->post('row_id') ,
                     'sys_status' => $this->post('sys_status') ,
                     'act_mode'   => 'varifyemail'
                     );
  $data = $this->supper_admin->call_procedureRow('proc_sysadmindelete' , $parameter);
  if($data){
            $parameter = $this->send_json($data);
            $this->response($data, 200); // 200 being the HTTP response code
        }
    else{
            $this->response(array('error' => 'User could not be found'), 404);
        }

}
//  mail check pasword send //



function ssamailcheck_post()
{
  $parameter = array(
                     'email' => $this->post('email'),
                     'asn' => '',
                     'act_mode'=>'mailcheck'
                     );
  $data = $this->supper_admin->call_procedureRow('proc_ssapassreset' , $parameter);
  if($data){
            $parameter = $this->send_json($data);
            $this->response($data, 200); // 200 being the HTTP response code
        }
    else{
            $this->response(array('error' => 'User could not be found'), 404);
        }

}


// end mail send passwor d
// check  mail question  mailquestion

function mailquestion_post()
{
  $parameter = array(
                     'email' => $this->post('email'),
                     'asn' => $this->post('ans'),
                     'act_mode'=>'ansmailcheck'
                     );
  $data = $this->supper_admin->call_procedureRow('proc_ssapassreset' , $parameter);
  if(!empty($data)){
            $data = $this->send_json($data);
            $this->response($data, 200); // 200 being the HTTP response code
        }
    else{
            $this->response(array('error' => 'User could not be found'), 404);
        }

}


function mailpasswordsend_post()
{
   $letters = 'abcefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
                             $chars = 8;
                             $randomString=  substr(str_shuffle($letters), 0, $chars);
                          // $password= generateRandomString(6);
                           $password= $randomString;
                           $user_password= md5($password);
     $parameter = array(
                     'email' => $this->post('email'),
                     'asn' => $this->post('ans'),
                     'pass'=>$user_password
                     );
  $data = $this->supper_admin->call_procedureRow('proc_ssapassupdate' , $parameter);
  if(!empty($data)){

$message_u='<html>  <body bgcolor="#DCEEFC">
                 <b> Booking Invoice</b><br><div>
                                <table>
                                <tr><td>Dear.</td> <td> '.ucfirst($data['firstName']).' '. ucfirst($this->post('lastName')).'</td></tr>
                               <tr> Your <TruExpense> password has been reset.
                                 <a href="<?php base_url(); ?>"/ssa/admin/>Login</a>
                                 Please click on the link )
                                 below to set new password within 24 hours.
                                 If you have not requested to reset your password
                                 please reply to this email or call the number given below. </tr>
                                 <tr><td>Default Password: </td><td>'.$password.' </td></tr>
                                <tr><td> Thanks</br>
                                 Support Team
                                </td><td></td>  </tr>
                             </table>
                               </div>
                              </body>
                </html>';
                $this->load->library('email');
                    $this->email->set_newline("\r\n");
          $this->email->from('barun@mindztechnology.com', 'Tru Expense');
          $this->email->to($this->post('email'));
          $this->email->subject('Password Reset');
          $this->email->message($message_u);
          $this->email->send();


            $data = $this->send_json($data);
            $this->response($data, 200); // 200 being the HTTP response code
        }
    else{
             $this->response("Something Went Wrong", 400); 
        }

}
 function checkpass_post()
    {
         $parameter = array(
                     'bid'      => $this->post('bid') ,
                     'bpass'    => md5($this->post('bpass')),
                     'act_mode' => 'checkpassadmin'

                       );
         $data = $this->supper_admin->call_procedureRow('proc_resetpass', $parameter);
         if(!empty($data)){
            $data = $this->send_json($data);   
            $this->response($data, 200); // 200 being the HTTP response code
         }
         else{
            $this->response(array('error' => 'User could not be found'), 404);
         }

    }



function resetpasss_post()
    {

           $parameter = array(
                             'bid'      => $this->post('bid') ,
                             'bpass'    => md5($this->post('bpass')),
                             'act_mode' => 'resetadmin'

          );


        $data = $this->supper_admin->call_procedureRow('proc_resetpass', $parameter);
        
         if(!empty($data)){
            $data = $this->send_json($data);   
            $this->response($data, 200); // 200 being the HTTP response code
          }


    }

 function systemproedit_post(){
        $parameter = array(
                         'status'         =>'',
                         'firstName'      => '',
                         'lastName'       => '',
                         'dob'            => '',
                         'email'         => '',
                         'password'      => '',
                         'n_createdby'   => '',
                         'act_mode'      => 'displaysingle',
                         'userlist'      => '',  
                         'userliscft'      => '', 
                         'userasrfdsd'   => '',
                         'userlisasdt'   => '',
                         'userId'        => $this->post('userId')
                         );

      $data = $this->supper_admin->call_procedureRow('proc_adminLogin', $parameter);

      if($data){
            $data = $this->send_json($data);   
            $this->response($data, 200); // 200 being the HTTP response code
        }
    else{
            $this->response(array('error' => 'User could not be found'), 404);
        }

    }

    function systemproupdate_post(){
        
    $parameter = array(
                              
                              's_Id'      => $this->post('s_Id'),
                              's_Country' => $this->post('s_Country'),
                              's_State'   => $this->post('s_State'),
                              's_City'   => $this->post('s_City'),
                              's_Address' => $this->post('s_Address'),
                              's_Seq'     => $this->post('s_Seq')
                            
                             );
    $data = $this->supper_admin->call_procedureRow('proc_sysprofileupdate', $parameter);
    $data = 1;
      if($data){
            $data = $this->send_json($data);   
            $this->response($data, 200); // 200 being the HTTP response code
        }
    else{
            $this->response(array('error' => 'User could not be found'), 404);
        }

    }


    function addemp_post(){

             $data = json_decode(file_get_contents("php://input"), true);
            $pMode=$this->post('p_mode');
       
       if(($pMode=='SearchSelect') || ($pMode=='Select') || ($pMode=='SelectEmpEdit') ||($pMode=='Editselect') || ($pMode=='SelectEdit') || ($pMode=='SelectList')){
             $parameter=array(  'p_mode' => $this->post('p_mode'),
                                'p_BusinessId' => $this->post('p_BusinessId'),
                                'p_IsAdmin' => $this->post('p_IsAdmin'),
                                'p_EmpId' => $this->post('p_EmpId'),
                                'p_FirstName' => $this->post('p_FirstName'),
                                'p_LastName' => $this->post('p_LastName'),
                            );
         $data = $this->supper_admin->call_procedure('proc_EmpEditOrView', $parameter);
       }else{
        $parameter = array('p_mode'         => $this->post('p_mode'),
                           'p_EmpId'        => $this->post('p_EmpId'),
                           'p_IsAdmin'      => $this->post('p_IsAdmin'),
                           'p_EmpCode'      => $this->post('p_EmpCode'),
                           'p_Empfname'     => $this->post('p_Empfname'),
                           'p_EmpLastName'  => $this->post('p_EmpLastName'),
                           'p_Email'        => $this->post('p_Email'),
                           'p_Pass'         => md5($this->post('p_Pass')),
                           'p_DeptId'       => $this->post('p_DeptId'),
                           'p_PolicyId'     => $this->post('p_PolicyId'),
                           'p_EmpDob'       => $this->post('p_EmpDob'),
                           'p_OfficePhno'   => $this->post('p_OfficePhno'),
                           'p_MobileNo'     => $this->post('p_MobileNo'),
                           'p_AddFLine'     => $this->post('p_AddFLine'),
                           'p_AddSecLine'   => $this->post('p_AddSecLine'),
                           'p_AddThrdLine'  => $this->post('p_AddThrdLine'),
                           'p_Country'      => $this->post('p_Country'),
                           'p_State'        => $this->post('p_State'),
                           'p_City'         => $this->post('p_City'),
                           'p_PinCode'      => $this->post('p_PinCode'),
                           'p_Status'       => $this->post('p_Status'),
                           'p_CreatedBy'    => $this->post('p_CreatedBy'),
                           'p_BusinessId'   => $this->post('p_BusinessId'),
                           'p_AdminType'    => 33,
                          /* 'p_XmlDatatest'  => $this->post('p_XmlDatatest'),
                           'p_AmountRange'  => $this->post('p_AmountRange'),
                           'p_CompareValue' => $this->post('p_CompareValue'),*/
                          );
            $this->supper_admin->call_procedure('proc_AddEmployeeData', $parameter);
              $data = array('success'=>'success');
        }
        if(!empty($data)){
            $data   = $this->send_json($data);
            $this->response($data, 202);
        }
        else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }

    }


    function viewempdetail_post()
    {
         $parameter = array('e_Mode'  => $this->post('e_Mode'),
                            'e_Empid' => $this->post('e_Empid')); 
        $data=  $this->supper_admin->call_procedureRow('proc_ViewEmpData', $parameter);
          if(!empty($data)){
            $data   = $this->send_json($data);  
            $this->response($data, 202); 
        }
        else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }

    }




    function getpolicy_post()
    {
         $parameter = array('act_mode'  => $this->post('act_mode'),
                            'busid' => $this->post('busid')); 
        $data=  $this->supper_admin->call_procedure('proc_ViewPolicy', $parameter);
          if(!empty($data)){
            $data   = $this->send_json($data);  
            $this->response($data, 202); 
        }
        else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }

    }

function getdeparts_post()
    {
         $parameter = array('act_mode'  => $this->post('act_mode'),
                            'busid' => $this->post('busid')); 
        $data=  $this->supper_admin->call_procedure('proc_ViewPolicy', $parameter);
          if(!empty($data)){
            $data   = $this->send_json($data);  
            $this->response($data, 202); 
        }
        else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }

    }



function badminanspassword_post(){
                $data = json_decode(file_get_contents("php://input"), true);
                $parameter= array( 'act_mode' => $this->post('a_mode') , 'id'=>$this->post('id'),'passans'=>$this->post('passans'));
                $data =$this->supper_admin->call_procedure('proc_ssabachangepassans',$parameter);

     
                if (!empty($data)) {
                $data = $this->send_json($data);
                $this->response($data,200);
                }
                else{
                     $this->response("Something Went Wrong", 400);
                    }
             }

// ############################################### SHEETEEHS 25 NOV STARTS HERE ################
 
 function buseditbysysAp_post()
 {

    $parameter = array( 'act_mode'  => $this->post('act_mode'),
                        'b_fname'   => '' ,
                        'b_lname'   => '' ,
                        'b_country' => '' ,
                        'b_state'   => '' ,
                        'b_city'    => '' ,
                        'b_address' => '' ,
                        'b_ophone'  => '' ,
                        'b_mphone'  => '' ,
                        'b_depid'   => '' ,
                        'b_empid'   => '' ,
                        'b_dob'     => '' ,
                        'b_pincode' => '' ,
                        'b_secans'  => '' ,
                        'b_status'  => '' ,
                        'b_mid'     => '' ,
                        'b_busid'   => $this->post('b_busid') );
     $data =$this->supper_admin->call_procedureRow('proc_buseditbysys',$parameter);

     
    if (!empty($data)) {
      $data = $this->send_json($data);
      $this->response($data,200);
    }
    else
    {
      $this->response("Something Went Wrong", 400);
    }
 }

function busupdatebysysAp_post()
{

  $parameter = array(   'act_mode'  => $this->post('act_mode'),
                        'b_fname'   => $this->post('b_fname'),
                        'b_lname'   => $this->post('b_lname'),
                        'b_depid'   => $this->post('b_depid'),
                        'b_empid'   => $this->post('b_empid'),
                        'b_dob'     => $this->post('b_dob'),
                        'b_ophone'  => $this->post('b_ophone'),
                        'b_mphone'  => $this->post('b_mphone'),
                        'b_address' => $this->post('b_address'),  
                        'b_country' => $this->post('b_country'),
                        'b_state'   => $this->post('b_state'),
                        'b_city'    => $this->post('b_city'),
                        'b_pincode' => $this->post('b_pincode'),
                        'b_secans'  => $this->post('b_secans'),
                        'b_status'  => $this->post('b_status'),
                        'b_mid'     => $this->post('b_mid'),
                        'b_busid'   => $this->post('b_busid')  );
    $this->supper_admin->call_procedureRow('proc_buseditbysys',$parameter);
    $data = array('success' => 'success' ,);
     
    if (!empty($data)) {
      $data = $this->send_json($data);
      $this->response($data,200);
    }
    else
    {
      $this->response("Something Went Wrong", 400);
    }
 
}

function busadmindelete_post()
    {
      $parameter = array(
                          'busid' => $this->post('busid') , 
                          'act_mode' => 'delete'
                          );
      $data = $this->supper_admin->call_procedureRow('proc_busadminaid' , $parameter);
      $data=1;
      if($data)
      {
        $data = $this->send_json($data);
        $this->response($data , 200);
      }
    }
    function busadminactive_post()
    {
      $parameter = array(

                         'busid' => $this->post('busid') , 
                         'act_mode' => 'active'
                          );
      $data = $this->supper_admin->call_procedureRow('proc_busadminaid' , $parameter);
      $data=1;
      if($data)
      {
        $data= $this->send_json($data);
        $this->response($data , 200);
      }
    }

  function busadmindeactive_post()
    {
      $parameter = array(

                          'busid' => $this->post('busid') , 
                          'act_mode' => 'inactive'
                          );
      $data = $this->supper_admin->call_procedureRow('proc_busadminaid' , $parameter);
      $data=1;
      if($data)
      {
        $data= $this->send_json($data);
        $this->response($data , 200);
      }
    }
  
  function addcat_post(){

        $data = json_decode(file_get_contents("php://input"), true);
        $parameter=array(     'p_mode'      => $this->post('p_mode'),
                              'p_SpndngCatId'  => $this->post('p_SpndngCatId'),
                              'p_SpndName'    => $this->post('p_SpndName'),
                              'p_GLCode'     => $this->post('p_GLCode'),
                              'p_XmlDatatest' => $this->post('p_XmlDatatest'),
                              'p_CreatedBy'=> $this->post('p_CreatedBy'),
                              'p_AdminType'    => $this->post('p_AdminType'),
                              'p_BusinessId'=> $this->post('p_BusinessId')
                        );

        $data = $this->supper_admin->call_procedure('proc_SpendCatAdd', $parameter);
        if(!empty($data)){
            $data   = $this->send_json($data);  
            $this->response($data, 202); 
        }
        else{
             $this->response("Something Went Wrong", 400); 
        }
       
    }

    function ssapolicybusiness_post(){
           $data = json_decode(file_get_contents("php://input"), true);
            $parameter = array(
                   'act_mode' =>$this->post('act_mode'),
                   'p_AdminType' =>$this->post('AdminType'),
                   'adminId'        =>$this->post('adminId')
                                                );
            $data = $this->supper_admin->call_procedure('proc_ssagetbusiness',$parameter);
           if(!empty($data)){
            $data   = $this->send_json($data);
            $this->response($data, 202);
          }
          else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
         }
    }
// ######################################### SHEETTESH 25 NOV END  HERE ########################

    
// end of class
}
