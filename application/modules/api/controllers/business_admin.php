<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Business_admin extends REST_Controller{

    function send_json($array){

        $this->output->set_content_type('application/json');
        $this->output->set_header('Cache-Control: no-cache, must-revalidate');
        $this->output->set_header('Expires: '.date('r', time()+(86400*365)));
        echo json_encode($array);
        exit();
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

     function businesscustomtag_post() {
      $data = json_decode(file_get_contents("php://input"), true);
                    $parameter = array(
                               'p_mode'           => $this->post('p_mode'),
                               'p_DeptId'         =>$this->post('p_DeptId'),
                               'p_XmlData_tag_gl' => $this->post('p_XmlData_cat'),
                               'p_AdminType'      => $this->post('p_AdminType'),
                               'p_BusinessId'     => $this->post('p_BusinessId'),
                               'p_CreatedBy'      => $this->post('p_CreatedBy'),
                               'tag_type'         => $this->post('tag_type')
                                                             );
      $data = $this->supper_admin->call_procedureRow('proc_Addcustomtagtulti',$parameter);
           if(!empty($parameter)){
            $data   = $this->send_json($data);
            $this->response($data, 202);
        }
        else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }

     }

     function addremembermt_post(){

 $data = json_decode(file_get_contents("php://input"), true);
                    $parameter = array(
                        'n_BusinessId'   => $this->post('n_BusinessId'),
                        'remenber'        =>$this->post('remenber')
                                         );
            $this->supper_admin->call_procedureRow('proc_rememberment',$parameter);
            $data = array("Success" => 'Success');
           if(!empty($data)){
            $data   = $this->send_json($data);
            $this->response($data, 202);
        }
        else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }


        }
     function updatglcodetext_post(){
      $parameter =  array (
                        'act_mode'      => $this->post('act_mode'),
                        'glcodetext'     => $this->post('cat_glcod'),
                        'testname'   => $this->post('id'),
                        'id' => $this->post('id') );
           $data = $this->supper_admin->call_procedureRow('proc_updateglcodtxt',$parameter);
            if(!empty($data)){
            $data   = $this->send_json($data);
            $this->response($data, 202);
            }
            else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
            }



 }

function empemailcheck_post()
 {
   $parameter = array('act_mode'=>$this->post('act_mode'), 'businessId'=>$this->post('businessid'), 'e_Email' => $this->post('e_Email') );
   $data = $this->supper_admin->call_procedureRow('proc_empemailcheck', $parameter);
    if(!empty($data)){
     $data = $this->send_json($data);   
     $this->response($data, 200); // 200 being the HTTP response code
     }
     else{
     $this->response(array('error' => 'User could not be found'), 404);
         }

 }


     function empcodecheck_post(){
       $parameter = array(   'act_mode'=> $this->post('act_mode'),
                            'e_EmpCode' => $this->post('e_EmpCode'),
                            'p_BusinessId' => $this->post('p_BusinessId')
                          );
       $data = $this->supper_admin->call_procedureRow('proc_empcodecheck', $parameter);
        if(!empty($data)){
         $data = $this->send_json($data);   
         $this->response($data, 200); // 200 being the HTTP response code
        }else{
          $this->response(array('error' => 'User could not be found'), 404);
          }
}
    function businessadmin_post(){

        $data = json_decode(file_get_contents("php://input"), true);
        $parameter = array(
                            'p_myemail'         => $this->post('p_myemail'),
                            'p_mypassword'    => $this->post('p_mypassword'),
                            'p_actmode'       => $this->post('p_actmode'),
                            'p_userId'        => $this->post('p_userId'),
                            'p_BusinessId'    => $this->post('p_BusinessId')
                          );
        $data = $this->supper_admin->call_procedure('proc_business_login', $parameter);
        if(!empty($data)){
            $data   = $this->send_json($data);
            $this->response($data, 202);
        }
        else{
             $this->response("Please try again", 400);
        }

    }

    function claimReport_post(){

        $data = json_decode(file_get_contents("php://input"), true);
        $parameter=array(     'p_mode'      => $this->post('p_mode'),
                              'p_reportId'  => $this->post('p_reportId'),
                              'b_Active'    => $this->post('b_Active'),
                              'p_EmpId'     => $this->post('p_EmpId'),
                              'p_CreatedBy' => $this->post('p_CreatedBy'),
                              'p_BusinessId'=> $this->post('p_BusinessId'),
                              'p_Status'    => $this->post('p_Status'),
                              'p_ApprovedBy'=> $this->post('p_ApprovedBy'),
                              'p_DeptId'    => $this->post('p_DeptId'),
                              'p_Approved'  => $this->post('p_Approved'),
                              'p_AdminType' => $this->post('p_AdminType')
                        );

        $data = $this->supper_admin->call_procedure('proc_reportEditOrView', $parameter);
        if(!empty($data)){
            $data   = $this->send_json($data);
            $this->response($data, 202);
        }
        else{
             $this->response("Something Went Wrong", 400);
        }

    }

    function statusChanged_post(){

        $parameter=array( 'p_mode' => $this->post('p_mode'),
                          'p_reportId' => $this->post('p_reportId'),
                          'b_Active' => $this->post('b_Active'),
                          'p_EmpId' => $this->post('p_EmpId'),
                          'p_CreatedBy' => $this->post('p_CreatedBy'),
                          'p_BusinessId' => $this->post('p_BusinessId'),
                          'p_Status' => $this->post('p_Status'),
                          'p_ApprovedBy' => $this->post('p_ApprovedBy'),
                          'p_DeptId' => $this->post('p_DeptId'),
                          'p_Approved' => $this->post('p_Approved'),
                          'p_AdminType' => $this->post('p_AdminType')
                    );

        $this->supper_admin->call_procedure('proc_reportEditOrView', $parameter);
        $data=array('Success'=>'Success');
        if(!empty($data)){
            $data   = $this->send_json($data);
            $this->response($data, 202);
        }
        else{
             $this->response("Something Went Wrong", 400); 
        }
    } 

    function policy_post(){
        $data = json_decode(file_get_contents("php://input"), true);

        $parameter=array( 'p_mode' => $this->post('p_mode'),
                          'p_formName' => $this->post('p_formName'),
                          'p_BusinessId' => $this->post('p_BusinessId'),
                          'p_PolicyId' => $this->post('p_PolicyId'),
                          'p_AdminType' => $this->post('p_AdminType'),

                         );
        $data = $this->supper_admin->call_procedure('proc_PolicyEditOrView', $parameter);
        if(!empty($data)){
            $data   = $this->send_json($data);
            $this->response($data, 202);
        }
        else{
             $this->response("Something Went Wrong", 400);
        }

    }

     function myaccess_post(){
        $data = json_decode(file_get_contents("php://input"), true);

        $parameter=array( 'e_Id'     =>  $this->post('e_Id'),
                          'act_mode' =>  $this->post('act_mode'),
                          'e_UserId' => $this->post('e_UserId')
                        );
        $data = $this->supper_admin->call_procedure('proc_viewexprptbyuser', $parameter);
        if(!empty($data)){
            $data   = $this->send_json($data);
            $this->response($data, 202);
        }
        else{
             $this->response("Something Went Wrong", 400);
        }

    }
         function updaterim_post(){
        $data = json_decode(file_get_contents("php://input"), true);

        $parameter=array( 'e_Id'     =>  $this->post('e_Id'),
                          'act_mode' =>  $this->post('act_mode'),
                          'e_UserId' => $this->post('e_UserId')
                        );
        $data = $this->supper_admin->call_procedure('proc_viewexprptbyuser', $parameter);
        if(!empty($data)){
            $data   = $this->send_json($data);
            $this->response($data, 202);
        }
        else{
             $this->response("Something Went Wrong", 400);
        }

    }



 function deletenotessa_post(){
        $data = json_decode(file_get_contents("php://input"), true);

        $parameter=array( 
                          'row_id'   =>  $this->post('row_id'), 
                          'act_mode' =>  $this->post('act_mode'));

        $data = $this->supper_admin->call_procedure('proc_deleteexpadmin', $parameter);
        if(!empty($data)){
            $data   = $this->send_json($data);
            $this->response($data, 202);
        }
        else{
             $this->response("Something Went Wrong", 400);
        }

    }


// rahul  yadav 10/22/2014


function policyasign_post(){
        $data = json_decode(file_get_contents("php://input"), true);
        $parameter=array( 'policyid' => $this->post('policyid') );
        $data = $this->supper_admin->call_procedure('proc_policyasign',$parameter);
        if(!empty($data)){
            $data   = $this->send_json($data);  
            $this->response($data, 202); 
        }
        else{
             $this->response("Something Went Wrong", 400); 
        }

    }


 function ssanotadd_post(){
$data = json_decode(file_get_contents("php://input"), true);
         $parameter=array('act_mode'     => $this->post('act_mode'),
                          'n_ReportId'   => $this->post('n_ReportId'),
                          't_NoteDesc'   => $this->post('t_NoteDesc'),
                          't_Type'       => $this->post('t_Type'),
                          's_cretaedby'  => $this->post('n_CreatedBy'),
                          's_busid'      => $this->post('n_businessId') );
        $data = $this->supper_admin->call_procedure('proc_ssareport_notes', $parameter);

  if(!empty($data)){
            $data   = $this->send_json($data);  
            $this->response($data, 202); 
        }
        else{
             $this->response("Something Went Wrong", 400); 
        }
}

 function savemynotessa_post(){
$data = json_decode(file_get_contents("php://input"), true);
         $parameter=array('act_mode'     => $this->post('act_mode'),
                          's_reportid'   => $this->post('s_reportid'),
                          's_note'       => $this->post('s_note'),
                          's_type'       => $this->post('s_type'),
                          's_cretaedby'  => $this->post('s_cretaedby'),
                          's_busid'      => $this->post('s_busid') );
        $data = $this->supper_admin->call_procedureRow('proc_ssaadminnote', $parameter);

  if(!empty($data)){
            $data   = $this->send_json($data);  
            $this->response($data, 202); 
        }
        else{
             $this->response("Something Went Wrong", 400); 
        }
}







    function notes_post(){
        $data = json_decode(file_get_contents("php://input"), true);
          $pMode=$this->post('p_mode');
        if(($pMode=='SearchSelect') || ($pMode=='Select') || ($pMode=='SelectEmpEdit') ||($pMode=='EditSelect') || ($pMode=='SelectEdit') || ($pMode=='SelectList')){
        $parameter=array( 'p_mode'      => $this->post('p_mode'),
                          'p_noteId'    => $this->post('p_noteId'),
                          'p_CreatedBy' => $this->post('p_CreatedBy'),
                          'p_Type'      => $this->post('p_Type'),
                          'n_ReportId'  => $this->post('n_ReportId')
                        );
        $data = $this->supper_admin->call_procedure('proc_EmployeeNotesEditOrView', $parameter);
      }else{
         $parameter=array( 'p_mode'      => $this->post('p_mode'),
                           'p_noteId'    => $this->post('p_noteId'),
                           'p_reportId'  => $this->post('p_reportId'),
                           'p_noteDesc'  => $this->post('p_noteDesc'),
                           'p_createdBy' => $this->post('p_createdBy'),
                           'p_type'      => $this->post('p_type')
                        );
         $data=$this->supper_admin->call_procedure('proc_AddbusinessNotes', $parameter);
         //$data = array('Success' =>'Success');
      }
        if(!empty($data)){
            $data   = $this->send_json($data);  
            $this->response($data, 202); 
        }
        else{
             $this->response("Something Went Wrong", 400); 
        }

    }

    function deleteNote_post(){
      $parameter=array( 'p_mode'     => $this->post('p_mode'),
                          'p_noteId'    => $this->post('p_noteId'),
                          'p_reportId'  => $this->post('p_reportId'),
                          'p_noteDesc'  => $this->post('p_noteDesc'),
                          'p_createdBy' => $this->post('p_createdBy'),
                          'p_type'      => $this->post('p_type')
                        );
      $this->supper_admin->call_procedure('proc_AddbusinessNotes', $parameter);
      $data = array('Success' =>'Success');
       if(!empty($data)){
            $data   = $this->send_json($data);
            $this->response($data, 202);
        }
        else{
             $this->response("Something Went Wrong", 400);
        }
    }


      function expense_post(){

        $data = json_decode(file_get_contents("php://input"), true);
        $parameter=array( 'p_mode' => $this->post('p_mode'),
                          'p_CustCatId' => $this->post('p_CustCatId'),
                          'p_ReportId' => $this->post('p_ReportId')
                        );
        $data = $this->supper_admin->call_procedure('proc_ExpenseViewAdmin', $parameter);
        if(!empty($data)){
            $data   = $this->send_json($data);
            $this->response($data, 202);
        }
        else{
             $this->response("Something Went Wrong", 400);
        }

      }

      function role_post(){

        //$this->some_model->updateUser( $this->get('id') );
        $data = json_decode(file_get_contents("php://input"), true);
       $parameter = array(
                              'p_mode'      => $this->post('p_mode'),
                              'p_id'        => $this->post('p_id'),
                              'p_businessId'=> $this->post('p_businessId'),
                              'p_AdminType' => $this->post('p_AdminType'),
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

       if(($pMode=='SelectAllList') || ($pMode=='SearchSelect') || ($pMode=='Select') || ($pMode=='SelectEmpEdit') ||($pMode=='Editselect') || ($pMode=='SelectEdit') || ($pMode=='SelectList')){
             $parameter=array(  'p_mode' => $this->post('p_mode'),
                                'p_BusnAdminId' => $this->post('p_BusnAdminId'),
                                'p_Username' => $this->post('p_Username'),
                                'p_Password' => $this->post('p_Password'),
                                'p_FirstName' => $this->post('p_FirstName'),
                               'p_BusinessId' => $this->post('p_BusinessId'),
                            );
         $data = $this->supper_admin->call_procedure('proc_BusinessAdminEditOrView', $parameter);
       }else{
        $parameter = array('p_mode'         => $this->post('p_mode'),
                           'p_BusnAdminId'  => $this->post('p_BusnAdminId'),
                           'p_AdminCode'    => $this->post('p_AdminCode'),
                           'p_Email'        => $this->post('p_Email'),
                           'p_pass'         => $this->post('p_pass'),
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
                           'p_Status'       => $this->post('p_Status'),
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
            $this->response($data, 202); 
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

        $parameter = array('p_mode' => $this->post('p_mode'),
                           'p_EmpId' => $this->post('p_EmpId'),
                           'p_IsAdmin' => $this->post('p_IsAdmin'),
                           'p_EmpCode' => $this->post('p_EmpCode'),
                           'p_Empfname' => $this->post('p_Empfname'),
                           'p_EmpLastName' => $this->post('p_EmpLastName'),
                           'p_Email' => $this->post('p_Email'),
                           'p_Pass' => $this->post('p_Pass'),
                           'p_DeptId' => $this->post('p_DeptId'),
                           'p_PolicyId' => $this->post('p_PolicyId'),
                           'p_EmpDob' => $this->post('p_EmpDob'),
                           'p_OfficePhno' => $this->post('p_OfficePhno'),
                           'p_MobileNo' => $this->post('p_MobileNo'),
                           'p_AddFLine' => $this->post('p_AddFLine'),
                           'p_AddSecLine' => $this->post('p_AddSecLine'),
                           'p_AddThrdLine' => $this->post('p_AddThrdLine'),
                           'p_Country' => $this->post('p_Country'),
                           'p_State' => $this->post('p_State'),
                           'p_City' => $this->post('p_City'),
                           'p_PinCode' => $this->post('p_PinCode'),
                           'p_Status' => $this->post('p_Status'),
                           'p_CreatedBy' => $this->post('p_CreatedBy'), 
                           'p_BusinessId' => $this->post('p_BusinessId'),
                           'p_AdminType' => $this->post('p_AdminType')
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
        $parameter=array(
                            'countryName' => $this->post('countryName'),
                            'id'          => $this->post('id'),
                            'act_mode'    => $this->post('act_mode'),
                            'createdBy'   => $this->post('createdBy'),
                            'active'      => $this->post('active'),
                            'businessId'  => $this->post('businessId'),
                            'adminUser'   => $this->post('adminUser'),
                            );
        if(($this->post('act_mode')=="insertinto") || ($this->post('act_mode')=="update") || ($this->post('act_mode')=="update") || ($this->post('act_mode')=="delete") || ($this->post('act_mode')=="select")){
          $data=  $this->supper_admin->call_procedure('proc_countryManage', $parameter);
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
       if(($pMode=='Select') || ($pMode=='Editselect') || ($pMode=='Stateselect') || ($pMode=='stateName')){
        $parameter=array('id' => $this->post('id'),
                         'b_IsActive' => $this->post('b_IsActive'),
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
       
       if(($pMode=='select') || ($pMode=='Editselect') || ($pMode=='CitySelect') || ($pMode=='cityName')){
         $parameter=array( 'p_mode' => $this->post('p_mode'),
                            'p_id' => $this->post('p_id'),
                            'p_stateId' => $this->post('p_stateId'),
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







  function businesseview_post() {
      $data = json_decode(file_get_contents("php://input"), true);
                    $parameter = array(
                     'id'  => $this->post('id'),
                              'b_Deleted'  =>'0',
                              'act_mpde' =>'view'
                              );
      $data = $this->supper_admin->call_procedureRow('proc_businesslist',$parameter);
           if(!empty($data)){
            $data   = $this->send_json($data);
            $this->response($mymessage, 202);
        }
        else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }

     }

  function getdtpcattagbusiness_post(){
    $data = json_decode(file_get_contents("php://input"), true);
                    $parameter = array(
                                   'act_mode'=>$this->post('act_mode'),
                                   'n_BusinessId'=> $this->post('n_BusinessId'));
            $data = $this->supper_admin->call_procedure('proc_getdptmt',$parameter);
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


  function spendcat_post(){
    
        $data = json_decode(file_get_contents("php://input"), true);
        $parameter = array('p_SpndngCatId'        => $this->post('p_SpndngCatId'),
                              'p_mode'            => $this->post('p_mode'),
                              'p_SpndName'        => $this->post('p_SpndName'),
                              'p_GLCode'        => $this->post('p_GLCode'),
                              'p_CreatedBy'      => $this->post('p_CreatedBy'),
                              'p_AdminType'       => $this->post('p_AdminType'),
                              'p_BusinessId'      => $this->post('p_BusinessId'),
                             );
         
        $data = $this->supper_admin->call_procedure('proc_SpendingCategory', $parameter);
        
        if(!empty($data)){
            $data   = $this->send_json($data);  
            $this->response($data, 202); 
        }
        else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }
       
    }

     function profileupdate_post()
 {
        $data = json_decode(file_get_contents("php://input"), true);
          $parameter =  array (
                        'bid'      => $this->post('bid'),
                        'bdob'     => $this->post('bdob'),
                        'bphone'   => $this->post('bphone'),
                        'bmobile'  => $this->post('bmobile'),
                        'baddress' => $this->post('baddress'),
                        'bcity'    => $this->post('bcity'),
                        'bstate'   => $this->post('bstate'),
                        'bcountry' => $this->post('bcountry'),
                        'bpin'     => $this->post('bpin'),
                        'bseq'     => $this->post('bseq'),
                        'act_mode' => 'pupdate' );
            $data = $this->supper_admin->call_procedureRow('proc_busadminpro',$parameter);
            $data = 1; 
            if(!empty($data)){
            $data   = $this->send_json($data);
            $this->response($data, 202);
            }
            else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
            }

 }

 function profile_post(){

$data = json_decode(file_get_contents("php://input"), true);
            
              $parameter =  array(
                        'bid'      => $this->post('bid') ,
                        'bdob'     =>'',
                        'bphone'   => '',
                        'bmobile'  => '',
                        'baddress' => '',
                        'bcountry' => '',
                        'bstate'   => '',
                        'bcity'    => '',
                        'bpin'     => '',
                        'bseq'     => '',
                        'act_mode' => 'view' );
   
            $data = $this->supper_admin->call_procedureRow('proc_busadminpro',$parameter);
            if(!empty($data)){
            $data   = $this->send_json($data);
            $this->response($data, 202);
            }
            else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
            }
}

function dept_post(){
  $data = json_decode(file_get_contents("php://input"), true);
  $parameter =  array(
                        'p_mode'            => $this->post('p_mode') ,
                        'p_deptId'          => $this->post('p_deptId'),
                        'p_BusinessId'      => $this->post('p_BusinessId'),
                        );
   
            $data = $this->supper_admin->call_procedureRow('Proc_EditViewDept',$parameter);
            if(!empty($data)){
            $data   = $this->send_json($data);
            $this->response($data, 202);
            }
            else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
            }
}

function currName_post(){
  $data = json_decode(file_get_contents("php://input"), true);
  $parameter =  array(
                        'p_mode'        => $this->post('p_mode') ,
                        'p_id'          => $this->post('p_id'),
                        'p_active'      => $this->post('p_active'),
                        'p_businessId'  => $this->post('p_businessId'),
                        'p_admin'       => $this->post('p_admin')
                        );
   
            $data = $this->supper_admin->call_procedureRow('proc_EditViewCurrency',$parameter);
            if(!empty($data)){
            $data   = $this->send_json($data);
            $this->response($data, 202);
            }
            else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
            }
}

        function distanceName_post(){
          $data = json_decode(file_get_contents("php://input"), true);
              $parameter =  array(
                                'p_mode'        => $this->post('p_mode'),
                                'p_id'          => $this->post('p_id'),
                                'p_BusinessId'  => $this->post('p_BusinessId'),
                                'p_enumId1'     => $this->post('p_enumId1'),
                                'p_AdminType'   => $this->post('p_AdminType')
                                );

                    $data = $this->supper_admin->call_procedureRow('proc_EditViewDM',$parameter);
                    if(!empty($data)){
                      $data   = $this->send_json($data);
                      $this->response($data, 202);
                    }
                    else{
                     $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
                    }
        }


//######## SHETESH HERE#####################
function myclaimreports_post()
{
              $data = json_decode(file_get_contents("php://input"), true);

              $parameter = array('act_mode' => $this->post('act_mode') ,
                                 'busid'    => $this->post('busid') );

              $data = $this->supper_admin->call_procedure('proc_viewclamreportshe',$parameter);
              if(!empty($data)){
              $data   = $this->send_json($data);
              $this->response($data, 202);
              }
              else{
              $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
              }
        }



 function myclaimbusiness_post()
 {
   $data = json_decode(file_get_contents("php://input"), true);

                $parameter = array('act_mode' => $this->post('act_mode') ,
                                   'busid'    => '' );

              $data = $this->supper_admin->call_procedure('proc_viewclamreportshe',$parameter);
              if(!empty($data)){
              $data   = $this->send_json($data);
              $this->response($data, 202);
              }
              else{
              $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
              }
}



function myclaimemp_post()
 {
   $data = json_decode(file_get_contents("php://input"), true);

                $parameter = array('act_mode' => $this->post('act_mode') ,
                                   'busid'    => $this->post('busid') 
                                  );

              $data = $this->supper_admin->call_procedure('proc_viewclamreportshe',$parameter);
              if(!empty($data)){
              $data   = $this->send_json($data);
              $this->response($data, 202);
              }
              else{
              $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
              }
}

// Rahul yadav  11/12/2014

function emppolicychang_post(){
                $data = json_decode(file_get_contents("php://input"), true);
                $parameter = array('act_mode'    => $this->post('act_mode') ,
                                   'policyid'    => $this->post('policyid') 
                                  );

              $response = $this->supper_admin->call_procedureRow('proc_ssapolicy',$parameter);
              if(!empty($response)){
              $data   = $this->send_json($response);
              $this->response($data, 202);
              }
              else{
              $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
              }

}

function dptmtctagspcatdelte_post(){
$data = json_decode(file_get_contents("php://input"), true);
                $parameter = array('act_mode'      => $this->post('act_mode') ,
                                   'businessid'    => $this->post('businessid'),
                                   'id'           => $this->post('id'),
                                   'userid'    => $this->post('userid')
                                  );

              $response = $this->supper_admin->call_procedureRow('proc_busin_dpt_spcat',$parameter);
              if(!empty($response)){
              $data   = $this->send_json($response);
              $this->response($data, 202);
              }
              else{
              $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
              }



}

/*
ssa admin and system admin report filter*/
public  function ssarepotsearch_post(){
                          $data = json_decode(file_get_contents("php://input"), true);
                          $parameter = array( 
                          'act_mode' => $this->post('act_mode'),
                          'businessid' => $this->post('businessid'),
                          'empname'  => $this->post('empname'),
                          'status'  => $this->post('status'),
                          'b_submited'  => $this->post('b_submited'),
                          'to_claim' => $this->post('to_claim'),
                          'from_claim'=> $this->post('from_claim') ,
                          'p_n_DeptId'=> $this->post('p_n_DeptId') );

               $response = $this->supper_admin->call_procedure('proc_ssareport_search',$parameter);
              if(!empty($response)){
              $data   = $this->send_json($response);
              $this->response($data, 202);
              }
              else{
              $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
              }
           }

   /*SYSTEM ADMIN REPORT REMBURESD*/
   function ssareportrembursed_post(){
    $data = json_decode(file_get_contents("php://input"), true);
                    $parameter = array(
                                 'businessId'  => $this->post('businessId')
                              );
      $data = $this->supper_admin->call_procedure('proc_ssareportrembus',$parameter);
           if(!empty($data)){
            $data   = $this->send_json($data);
            $this->response($data, 202);
        }
        else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }
    }


// report  approve by system admin
   function systemadminreport_post(){
    $data = json_decode(file_get_contents("php://input"), true);
                    $parameter = array(
                        'action' =>$this->post('action'),
                        'reportid'=>$this->post('reportid'),
                        'modified_type'=>$this->post('modified_type'),
                        'n_modifiedby'=>$this->post('n_modifiedby')
                              );
      $data = $this->supper_admin->call_procedure('proc_ssarepoerapprove',$parameter);
           if(!empty($data)){
            $data   = $this->send_json($data);
            $this->response($data, 202);
        }
        else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }
    }




        // function updatglcodetext_post(){
        //   $parameter =  array (
        //                     'act_mode'      => $this->post('act_mode'),
        //                     'glcodetext'     => $this->post('cat_glcod'),
        //                     'testname'   => $this->post('id'),
        //                     'id' => $this->post('id')
        //                   );
        //    $data = $this->supper_admin->call_procedureRow('proc_updateglcodtxt',$parameter);
        //     if(!empty($data)){
        //     $data   = $this->send_json($data);
        //     $this->response($data, 202);
        //     }
        //     else{
        //      $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        //     }



 //}
// end of class
}