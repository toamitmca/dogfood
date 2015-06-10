<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Business_admin_2 extends REST_Controller{
   
    function send_json($array){

        $this->output->set_content_type('application/json');
        $this->output->set_header('Cache-Control: no-cache, must-revalidate');
        $this->output->set_header('Expires: '.date('r', time()+(86400*365)));
        echo json_encode($array);
        exit();
   	 }

    function businessadmin_post(){

        $data = json_decode(file_get_contents("php://input"), true);
        $parameter = array(
                            't_Email'      => $this->post('t_Email'),
                            't_password'   => $this->post('t_password'),
                            'act_mode'     => $this->post('act_mode')
                          );
        $data = $this->supper_admin->call_procedureRow('proc_business_login', $parameter);
        if(!empty($data)){
            $data   = $this->send_json($data);  
            $this->response($parameter, 202); 
        }
        else{
             $this->response("Please try again", 400); 
        }
       
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

        function addemp_post(){

        //$this->some_model->updateUser( $this->get('id') );
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
                           'p_Pass'         => $this->post('p_Pass'),
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
                           'p_XmlDatatest'  => $this->post('p_XmlDatatest'),
                           'p_AmountRange'  => $this->post('p_AmountRange'),
                           'p_CompareValue' => $this->post('p_CompareValue'),
                          );
             $this->supper_admin->call_procedure('proc_AddEmployeeData', $parameter);
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
 
    function country_post()
    {
       
        $data = json_decode(file_get_contents("php://input"), true);
        $parameter=array('countryName' => $this->post('countryName1'),
                            //'d_CreatedOn' => $this->post('d_CreatedOn'),
                            'id' => $this->post('id'),
                            'act_mode' => $this->post('act_mode'),
                            'n_CreatedBy' => $this->post('n_CreatedBy'),
                            //'d_ModifiedOn' => $this->post('d_ModifiedOn'),
                            //'n_ModifiedBy' => $this->post('n_ModifiedBy'),
                            'b_IsActive' => $this->post('b_IsActive'),
                            'n_BusinessId' => $this->post('n_BusinessId'),
                            'n_AdminType' => $this->post('n_AdminType'),
                            );
        if(($this->post('act_mode')=="insertinto") || ($this->post('act_mode')=="update") || ($this->post('act_mode')=="delete")){
            $this->supper_admin->call_procedure('proc_countryManage', $parameter);
            $data = array('success'=>'success');
        }else{
            $data = $this->supper_admin->call_procedure('proc_countryManage', $parameter);
        }
        if(!empty($data)){
            $data   = $this->send_json($data);  
            $this->response($data, 202); 
        }
        else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }
       
    }


        function state_post()
    {
       $data = json_decode(file_get_contents("php://input"), true);
       $pMode=$this->post('p_mode');
       if(($pMode=='Select') || ($pMode=='Editselect') || ($pMode=='Stateselect')){
        $parameter=array('id' => $this->post('id'),
                         'active' => $this->post('b_IsActive'),
                         'n_BusinessId' => $this->post('n_BusinessId'),
                         'p_mode' => $this->post('p_mode'),
                         'n_AdminType' => $this->post('n_AdminType')
                        );
        $data = $this->supper_admin->call_procedure('proc_EditViewState', $parameter);
       }else{
            $parameter=array('p_mode' => $this->post('p_mode'),
                            'n_CountryId' => $this->post('n_CountryId'),
                            'id' => $this->post('id'),
                            't_StateName' => $this->post('t_StateName'),
                            'n_AdminType' => $this->post('n_AdminType'),
                            'n_BusinessId' => $this->post('n_BusinessId'),
                            'n_CreatedBy' => $this->post('n_CreatedBy'),
                            'n_ModifiedBy' => $this->post('n_ModifiedBy'),
                            'b_IsActive' => $this->post('b_IsActive'),
                           );
             $this->supper_admin->call_procedure('proc_AddState', $parameter);
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
    function city_post()
    {
       $data = json_decode(file_get_contents("php://input"), true);
       $pMode=$this->post('p_mode');
       
       if(($pMode=='select') || ($pMode=='Editselect') || ($pMode=='CitySelect')){
         $parameter=array( 'p_mode' => $this->post('p_mode'),
                            'p_id' => $this->post('p_id'),
                            'p_stateId' => $this->post('n_StateId'),
                            'p_BusinessId' => $this->post('p_BusinessId'),
                            'p_admin' => $this->post('p_admin')
                        );
        $data = $this->supper_admin->call_procedure('Pro_EditViewCity', $parameter);
       }
       else{
            $parameter1 = array( 'p_mode' => $this->post('p_mode'),
                                'a_CityId' => $this->post('a_CityId'),
                                'n_StateId' => $this->post('n_StateId'),
                                't_CityName' => $this->post('t_CityName'),
                                'n_CreatedBy' => $this->post('n_CreatedBy'),
                                'n_ModifiedBy' => $this->post('n_ModifiedBy'),
                                'n_Delete' => $this->post('n_Delete'),
                                'n_AdminType' => $this->post('n_AdminType'),
                           );
             $this->supper_admin->call_procedure('proc_AddCity', $parameter1);
             //$data = array('success'=>'success');
       }
      
        if(!empty($data)){
            $data   = $this->send_json($data);  
            $this->response($data, 202); 
        }
        else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }
       
}
       function currency_post()
    {
       $data = json_decode(file_get_contents("php://input"), true);
       $pMode=$this->post('p_mode');

       if(($pMode=='Select') || ($pMode=='Editselect')){
         $parameter=array( 'p_mode' => $this->post('p_mode'),
                            'a_CurrencyId' => $this->post('a_CurrencyId'),
                            'b_IsActive' => $this->post('b_IsActive'),
                            'n_BusinessId' => $this->post('n_BusinessId'),
                            'n_AdminType' => $this->post('n_AdminType')
                        );
        $data = $this->supper_admin->call_procedure('proc_EditViewCurrency', $parameter);
       }
       else{
                $parameter1 = array( 'p_mode' => $this->post('p_mode'),
                                    'a_CurrencyId' => $this->post('a_CurrencyId'),
                                    'n_CountryId' => $this->post('n_CountryId'),
                                    't_CurrencyName' => $this->post('t_CurrencyName'),
                                    'n_CreatedBy' => $this->post('n_CreatedBy'),
                                    'n_ModifiedBy' => $this->post('n_ModifiedBy'),
                                    'b_IsActive' => $this->post('b_IsActive'),
                                    'n_BusinessId' => $this->post('n_BusinessId'),
                                    'n_AdminType' => $this->post('n_AdminType'),
                               );
             $this->supper_admin->call_procedure('proc_AddCurrency', $parameter1);
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


    function dm_post()
    {
       $data = json_decode(file_get_contents("php://input"), true);
       $pMode=$this->post('p_mode');
       
       if(($pMode=='Select') || ($pMode=='Editselect')){
             $parameter=array(  'p_mode' => $this->post('p_mode'),
                                'a_SettingId' => $this->post('a_SettingId'),
                                'n_BusinessId' => $this->post('n_BusinessId'),
                                'n_EnumId' => $this->post('n_EnumId'),
                                'n_AdminType' => $this->post('n_AdminType'),
                            );
         $data = $this->supper_admin->call_procedure('proc_EditViewDM', $parameter);
       }else{
            $parameter1 = array( 'p_mode' => $this->post('p_mode'),
                                'a_SettingId' => $this->post('a_SettingId'),
                                'n_EnumId' => $this->post('n_EnumId'),
                                't_SettingValue' => $this->post('t_SettingValue'),
                                'n_CreatedBy' => $this->post('n_CreatedBy'),
                                'b_IsActive' => $this->post('b_IsActive'),
                                'n_BusinessId' => $this->post('n_BusinessId'),
                                'n_AdminType' => $this->post('n_AdminType'),
                           );
             $this->supper_admin->call_procedure('proc_saveSettingVal', $parameter1);
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


     function billing_post()
    {
       $data = json_decode(file_get_contents("php://input"), true);
       $pMode=$this->post('p_mode');
       
       if(($pMode=='Select') || ($pMode=='Editselect')){
             $parameter=array(  'p_mode' => $this->post('p_mode'),
                                'a_SettingId' => $this->post('a_SettingId'),
                                'n_BusinessId' => $this->post('n_BusinessId'),
                                'n_EnumId' => $this->post('n_EnumId'),
                                'n_AdminType' => $this->post('n_AdminType'),
                            );
           
         $data = $this->supper_admin->call_procedure('proc_EditViewDM', $parameter);
       }else{
            $parameter1 = array( 'p_mode' => $this->post('p_mode'),
                                'a_SettingId' => $this->post('a_SettingId'),
                                'n_EnumId' => $this->post('n_EnumId'),
                                't_SettingValue' => $this->post('t_SettingValue'),
                                'n_CreatedBy' => $this->post('n_CreatedBy'),
                                'b_IsActive' => $this->post('b_IsActive'),
                                'n_BusinessId' => $this->post('n_BusinessId'),
                                'n_AdminType' => $this->post('n_AdminType'),
                           );



             $this->supper_admin->call_procedure('proc_saveSettingVal', $parameter1);
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


    function policyGeneral_post(){
        
        $data = json_decode(file_get_contents("php://input"), true);
        $parameter = array(
                              'p_mode'            => $this->post('p_mode'),
                              'p_formName'        => $this->post('p_formName'),
                              'p_PolicyId'        => $this->post('p_PolicyId'),
                              'p_PolicyName'      => $this->post('p_PolicyName'),
                              'p_MaxRptAmt'       => $this->post('p_MaxRptAmt'),
                              'd_RptDueDt'        => $this->post('d_RptDueDt'),
                              'd_RptDueDt1'       => $this->post('d_RptDueDt1'),
                              'p_MaxExpAmt'       => $this->post('p_MaxExpAmt'),
                              'p_RptDueDate'      => $this->post('p_RptDueDate'),
                              'p_CashAdvAllowed'  => $this->post('p_CashAdvAllowed'),
                              'p_RecpReq'         => $this->post('p_RecpReq'),
                              'p_AboveAmt'        => $this->post('p_AboveAmt'),
                              'p_MaxRptMilage'    => $this->post('p_MaxRptMilage'),
                              'p_MilageRate'      => $this->post('p_MilageRate'),
                              'p_PerMeasuremnt'   => $this->post('p_PerMeasuremnt'),                             
                              'p_MilRateUnitValue'=> $this->post('p_MilRateUnitValue'),
                              'p_MaxExpMil'       => $this->post('p_MaxExpMil'),
                              'p_IsGPSReq'        => $this->post('p_IsGPSReq'),
                              'p_CreatedBy'       => $this->post('p_CreatedBy'),
                              'p_MonthlyExpLmt'   => $this->post('p_MonthlyExpLmt'),
                              'p_DailyExpLmt'     => $this->post('p_DailyExpLmt'),
                              'p_ReportDueBy'     => $this->post('p_ReportDueBy'),
                              'p_flagExpSubmitted'=> $this->post('p_flagExpSubmitted'),
                              'p_BusinessId'      => $this->post('p_BusinessId'),
                              'p_AdminType'       => $this->post('p_AdminType'),
                              'p_RptDueByValue'   => $this->post('p_RptDueByValue'),
                            );
         
        $data = $this->supper_admin->call_procedureRow('proc_PolicyMaster', $parameter);
        
        if(!empty($data)){
            $data   = $this->send_json($data);  
            $this->response($data, 202); 
        }
        else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }
       
    }

  function policyMileage_post(){

     $data = json_decode(file_get_contents("php://input"), true);
        $parameter = array(
                              'p_mode'            => $this->post('p_mode'),
                              'p_formName'        => $this->post('p_formName'),
                              'p_PolicyId'        => $this->post('p_PolicyId'),
                              'p_PolicyName'      => $this->post('p_PolicyName'),
                              'p_MaxRptAmt'       => $this->post('p_MaxRptAmt'),
                              'd_RptDueDt'        => $this->post('d_RptDueDt'),
                              'd_RptDueDt1'       => $this->post('d_RptDueDt1'),
                              'p_MaxExpAmt'       => $this->post('p_MaxExpAmt'),
                              'p_RptDueDate'      => $this->post('p_RptDueDate'),
                              'p_CashAdvAllowed'  => $this->post('p_CashAdvAllowed'),
                              'p_RecpReq'         => $this->post('p_RecpReq'),
                              'p_AboveAmt'        => $this->post('p_AboveAmt'),
                              'p_MaxRptMilage'    => $this->post('p_MaxRptMilage'),
                              'p_MilageRate'      => $this->post('p_MilageRate'),
                              'p_PerMeasuremnt'   => $this->post('p_PerMeasuremnt'),                             
                              'p_MilRateUnitValue'=> $this->post('p_MilRateUnitValue'),
                              'p_MaxExpMil'       => $this->post('p_MaxExpMil'),
                              'p_IsGPSReq'        => $this->post('p_IsGPSReq'),
                              'p_CreatedBy'       => $this->post('p_CreatedBy'),
                              'p_MonthlyExpLmt'   => $this->post('p_MonthlyExpLmt'),
                              'p_DailyExpLmt'     => $this->post('p_DailyExpLmt'),
                              'p_ReportDueBy'     => $this->post('p_ReportDueBy'),
                              'p_flagExpSubmitted'=> $this->post('p_flagExpSubmitted'),
                              'p_BusinessId'      => $this->post('p_BusinessId'),
                              'p_AdminType'       => $this->post('p_AdminType'),
                              'p_RptDueByValue'   => $this->post('p_RptDueByValue')
                          );
         
        $data = $this->supper_admin->call_procedureRow('proc_PolicyMaster', $parameter);
        
        if(!empty($data)){
            $data   = $this->send_json($data);  
            $this->response($data, 202); 
        }
        else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }
  }  


  function policyspencat_post(){

     $data = json_decode(file_get_contents("php://input"), true);
          $parameter = array(
                              'p_mode'            => $this->post('p_mode'),
                              'p_PlcyCatMapId'    => $this->post('p_PlcyCatMapId'),
                              'p_XmlDatatest'     => $this->post('p_XmlDatatest'),
                              'p_PolicyId'        => $this->post('p_PolicyId'),
                              'p_CreatedBy'       => $this->post('p_CreatedBy'),
                              'p_BusinessId'      => $this->post('p_BusinessId')
                            );
         
        $this->supper_admin->call_procedureRow('proc_PolicyCatMap', $parameter);
        $data=array('Success'=>'Success');
        if(!empty($data)){
            $data   = $this->send_json($data);  
            $this->response($data, 202); 
        }
        else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }
  }  

  // SHEETESH WORK START FROM HERE


  function checkbemail_post(){
        
    $parameter = array('bemail' => $this->post('bemail') , 'bseq' => '', 'act_mode' => 'emailcheck');
    $data = $this->supper_admin->call_procedureRow('proc_checkbemail', $parameter);
    if(!empty($data)){
            $data = $this->send_json($data);   
            $this->response($data, 200); // 200 being the HTTP response code
        }
    else{
            $this->response(array('error' => 'User could not be found'), 404);
        }

    }


    function checkseq_post(){
        
    $parameter = array('bemail' => $this->post('bemail') , 'bseq' => $this->post('bseq') ,  'act_mode' => 'seqcheck');
    $data = $this->supper_admin->call_procedureRow('proc_checkbemail', $parameter);
    if(!empty($data)){
            $data = $this->send_json($data);   
            $this->response($data, 200); // 200 being the HTTP response code
        }
    else{
            $this->response(array('error' => 'User could not be found'), 404);
        }

    }
    function forgotpass_post()
    {

           $parameter = array(
                             'bemail' => $this->post('bemail') ,
                             'bseq'   => $this->post('bseq'),
                             'bpass'  => md5($this->post('bpass')),

          );


            $data = $this->supper_admin->call_procedureRow('proc_getpass', $parameter);
        
        if(!empty($data)){

            $bname=$data['t_FirstName'].' '.$data['t_LastName'];
            $pass=$this->post('bpass');
            $email=$this->post('bemail');
            $from ='barun@mindztechnology.com';
            $to = $email;
            $subject ="Testing";
            $message = "Testing123";
            sendmail($from, $to, $subject, $message);
            $data   = $this->send_json($data);  

            $this->response($data, 202); 
        }
        else 
        {

           $this->response('User could not be found', 404);
        }


    }


    function checkpass_post()
    {
         $parameter = array(
                     'bid'      => $this->post('bid') ,
                     'bpass'    => md5($this->post('bpass')),
                     'act_mode' => 'checkpass'

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
                             'act_mode' => 'reset'

          );


        $data = $this->supper_admin->call_procedureRow('proc_resetpass', $parameter);
        
         if(!empty($data)){
            $data = $this->send_json($data);   
            $this->response($data, 200); // 200 being the HTTP response code
          }


    }
    function view_business_create_admin_post()
    {
        $parameter = array(
                             'busid'      => $this->post('busid') ,
                             

          );
         $data = $this->supper_admin->call_procedure('proc_viewbusadmin', $parameter);
          if(!empty($data)){
          $data = $this->send_json($data);   
          $this->response($data, 200); // 200 being the HTTP response code
          }


    }
      function mybus_post()
    {
        $parameter = array(
                             'busid'      => $this->post('busid') ,
                             

          );
         $data = $this->supper_admin->call_procedure('view_busdetail', $parameter);
          if(!empty($data)){
          $data = $this->send_json($data);   
          $this->response($data, 200); // 200 being the HTTP response code
          }


    }

    function viewbusname_post()
    {
      $parameter = array(
                           'bid'      => $this->post('bid'),
                           'bname'    => $this->post('bname'),
                           'act_mode' => 'searchbusname',
                      
                      );

     $data = $this->supper_admin->call_procedure('proc_viewbusname', $parameter);
     if(!empty($data)){
     $data = $this->send_json($data);   
     $this->response($data, 200); // 200 being the HTTP response code
     }
     else{
     $this->response(array('error' => 'User could not be found'), 404);
         }

    }

 

 function empcodecheck_post()
 {
   $parameter = array('e_EmpCode' => $this->post('e_EmpCode') );
   $data = $this->supper_admin->call_procedureRow('proc_empcodecheck', $parameter);
    if(!empty($data)){
     $data = $this->send_json($data);   
     $this->response($data, 200); // 200 being the HTTP response code
     }
     else{
     $this->response(array('error' => 'User could not be found'), 404);
         }

 }



// end of class
}