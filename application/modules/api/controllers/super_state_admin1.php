<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Super_state_admin1 extends REST_Controller{
   


    function send_json($array){

        $this->output->set_content_type('application/json');
        $this->output->set_header('Cache-Control: no-cache, must-revalidate');
        $this->output->set_header('Expires: '.date('r', time()+(86400*365)));
        echo json_encode($array);
        exit();
   	 }



      function role_post(){

        //$this->some_model->updateUser( $this->get('id') );
        $data = json_decode(file_get_contents("php://input"), true);
       $parameter = array(
                              'p_mode'      => $this->post('p_mode'),
                              'p_id'   => $this->post('p_id'),
                              'p_businessId'   => $this->post('p_businessId'),
                              'p_AdminType'   => $this->post('p_AdminType'),
                          );

        $data = $this->supper_admin->call_procedure('proc_EditOrViewRoleAccess', $parameter);
        
        if(!empty($data)){
            $data   = $this->send_json($data);  
            $this->response($mymessage, 202); 
        }
        else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }
       
    }
       function emp_post(){

        //$this->some_model->updateUser( $this->get('id') );
        $data = json_decode(file_get_contents("php://input"), true);
            $pMode=$this->post('p_mode');

       if(($pMode=='SearchSelect') || ($pMode=='Select') || ($pMode=='SelectEmpEdit') ||($pMode=='Editselect') || ($pMode=='SelectEdit') || ($pMode=='SelectList')){
             $parameter=array(  'p_mode' => $this->post('p_mode'),
                                'p_BusnAdminId' => $this->post('p_BusnAdminId'),
                                'p_FirstName' => $this->post('p_FirstName'),
                                'p_LastName' => $this->post('p_LastName'),
                                'p_BusinessId' => $this->post('p_BusinessId'),
                            );
         $data = $this->supper_admin->call_procedure('proc_BusinessAdminEditOrView', $parameter);
       }else{
        $parameter = array('p_mode'         => $this->post('p_mode'),
                           'p_BusnAdminId'  => $this->post('p_BusnAdminId'),
                           'p_AdminCode'    => $this->post('p_AdminCode'),
                           'p_FirstName'    => $this->post('p_FirstName'),
                           'p_LastName'     => $this->post('p_LastName'),
                           'p_DeptId'       => $this->post('p_DeptId'),
                           'p_Contact'      => $this->post('p_Contact'),
                           'p_Mobile'       => $this->post('p_Mobile'),
                           'p_DOB'          => $this->post('p_DOB'),
                           'p_Address'      => $this->post('p_Address'),
                           'p_Country'      => $this->post('p_Country'),
                           'p_State'        => $this->post('p_State'),
                           'p_City'         => $this->post('p_City'),
                           'p_Pincode'      => $this->post('p_Pincode'),
                           'p_Positon'      => $this->post('p_Positon'),
                           'p_Status'      => $this->post('p_Status'),
                           'p_XmlDatatest'  => $this->post('p_XmlDatatest'),
                           'p_AmountRange'  => $this->post('p_AmountRange'),
                           'p_CompareValue' => $this->post('p_CompareValue'),
                           'p_CreatedBy'    => $this->post('p_CreatedBy'),
                           'p_BusinessId'   => $this->post('p_BusinessId'),
                           'p_AdminType'    => $this->post('p_AdminType'),
                          );
              $this->supper_admin->call_procedure('proc_AddbusinessData', $parameter);
              $data = array('success'=>'success');
        }
        if(!empty($data)){
            $data   = $this->send_json($data);  
            $this->response($mymessage, 202); 
        }
        else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }
       
    }

      function access_post(){

        //$this->some_model->updateUser( $this->get('id') );
        $data = json_decode(file_get_contents("php://input"), true);
          $parameter = array(  'p_mode'      => $this->post('p_mode'),
                              'p_EmpAccessMapId'   => $this->post('p_EmpAccessMapId'),
                              'p_RoleAccess'   => $this->post('p_RoleAccess'),
                              'p_EmpId'   => $this->post('p_EmpId'),
                              'p_AmountRange'   => $this->post('p_AmountRange'),
                              'p_CompareValue'   => $this->post('p_CompareValue'),
                              'p_CreatedBy'   => $this->post('p_CreatedBy'),
                              'p_BusinessId'   => $this->post('p_BusinessId'),
                          );

        $data = $this->supper_admin->call_procedure('proc_AddEmployeeMapData', $parameter);
        $data = array('Success' => 'Success' );
        if(!empty($data)){
            $data   = $this->send_json($data);  
            $this->response($mymessage, 202); 
        }
        else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }
       
    }


    function user_post(){

        //$this->some_model->updateUser( $this->get('id') );
        $data = json_decode(file_get_contents("php://input"), true);
       
        $parameter = array(
                              'email'      => $this->post('email'),
                              'password'   => $this->post('password'),
                              'n_createdby'=> '',
                              'act_mode'   => 'SuperAdmin',
                              'userlist'   => ''
                          );

        $data = $this->supper_admin->call_procedureRow('proc_adminLogin', $parameter);
      	
        if(!empty($data)){
            $data   = $this->send_json($data);  
            $this->response($mymessage, 202); 
        }
        else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }
       
    }


    function admin_post(){

        //$this->some_model->updateUser( $this->get('id') );
        $data = json_decode(file_get_contents("php://input"), true);
       
        $parameter = array(
                              'email'        => $this->post('t_username'),
                              'password'  	 => md5($this->post('t_password')),
                              'n_createdby'  => $this->post('n_createdby'),
                              'act_mode'  	 => 'insertSelect',
                              'userlist'     => ''
                          );
		
		$data = $this->supper_admin->call_procedureRow('proc_adminLogin', $parameter);
        if(!empty($data)){
            $data   = $this->send_json($data);  
            $this->response($mymessage, 202); 
        }
        else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }
       
    }

    function admins_get(){
    	$parameter = array(
                              'email'        => '',
                              'password'  	 => '',
                              'n_createdby'  => '',
                              'act_mode'  	 => 'selectall',
                              'userlist'     => ''
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
        $parameter = array('countryId' => $this->post('n_CountryId'));
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
    function businessregister_post(){
    
        //$this->some_model->updateUser( $this->get('id') );
        $data = json_decode(file_get_contents("php://input"), true);

                          $parameter = array(
                                   
                                            'p_mode'             =>"Insert",
                                            'p_BusinessId'       =>'',
                                            'p_Busineescode'     =>'',
                                            'p_BussinessName'    => $this->post('businessName'),
                                            'p_Countryid'        => $this->post('businessCountry'),
                                            'p_StateId'          => $this->post('businessState'),
                                            'p_CityId'           => $this->post('businessCity'),
                                            'p_Address'          => $this->post('businessBillingAddress').'%'.$this->post('n_CountryId_2'),
                                            'p_Status'           => $this->post('Status'),
                                            'p_Startdate'        => $this->post('businessStartDate'),
                                            'p_EndDate'          => $this->post('businessEndDate'),
                                            'p_UserCount'        => $this->post('businessEmployee'),
                                            'p_CurrencyId'       => $this->post('businessCurrency'),
                                            'p_ExpInOtrCurrency' => $this->post('expensesothercurrency'),
                                            'p_Dateformat'       => $this->post('businessDateFormat'),
                                            'p_AdminId'          =>'',
                                            'p_BillingType'      => $this->post('businessBillingType'),
                                            'p_BillingName'      => $this->post('businessBillingContact'),
                                            'p_BillingAddr'      => $this->post('businessBillingAddress').'%'.$this->post('businessBillingAddress2'),
                                            'p_Package'          => $this->post('businessBillingPackage'),
                                            'p_Distance'         =>'',
                                            'p_Fname'            => $this->post('appFirstName'),
                                            'p_Lname'            => $this->post('appLastName'),
                                            'p_ConidfAppInf'     => '',
                                            'p_StateIdfAppInf'   => $this->post('n_CountryId_2'),
                                            'p_CityIdfAppInf'    => $this->post('n_CountryId_2'),
                                            'p_AddrfAppInf'      => $this->post('appAddress1').'%'.$this->post('appAddress2'),
                                            'p_ContactfAppIn'    => $this->post('appPhone'),
                                            'p_EmailfAppIn'      => $this->post('appEmail'),
                                            'p_DobfAppIn'        => $this->post('appDob'),
                                            'p_PositionfAppIn'   => $this->post('appCompanyPosition'),
                                            'p_AdminTypefAppIn'  =>'',
                                            'p_CreatedOn'        =>'',
                                            'p_CreatedBy'        =>'',
                                            'p_Deleted'          =>''

                                   );
                           
                          // p($parameter);   
                          $data = $this->supper_admin->call_procedureRow('proc_Businessdtl', $parameter);
        
                       if(!empty($data)){
            $parameter   = $this->send_json($parameter);  
            $this->response($parameter, 202); 
        }
        else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }
       
   }


// end of class
}
