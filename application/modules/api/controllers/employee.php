<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Employee extends REST_Controller{
   
    function send_json($array){

        $this->output->set_content_type('application/json');
        $this->output->set_header('Cache-Control: no-cache, must-revalidate');
        $this->output->set_header('Expires: '.date('r', time()+(86400*365)));
        echo json_encode($array);
        exit();
   	 }

    function emp_post(){

        $data = json_decode(file_get_contents("php://input"), true);
       
       $parameter = array(  'p_mode'     => $this->post('p_mode'),
                            'a_EmpId'  => $this->post('a_EmpId'),
                            't_EmailId'  => $this->post('t_EmailId'),
                            't_Password' => $this->post('t_Password'),
                          );
        $loginDeatils = $this->supper_admin->call_procedureRow('proc_EmployeeData', $parameter);
        $id=$loginDeatils->a_EmpId;
        if(!empty($loginDeatils)){
                $parameter1 = array( 'p_mode'     => 'UpdateLogin',
                                     'a_EmpId'   => $id,
                                     't_EmailId'  => '',
                                     't_Password' => '',
                                  );
            $this->supper_admin->call_procedure('proc_EmployeeData', $parameter1);
            $update=array('success'=>'success');
            if(!empty($update)){
               $parameter3 = array(  'p_mode'     => 'select',
                                      'a_EmpId'   => $id,
                                      't_EmailId'  => '',
                                      't_Password' => '',
                                                        );
              $data=$this->supper_admin->call_procedureRow('proc_EmployeeData', $parameter3);
            }

         }
        if(!empty($data)){
            $data   = $this->send_json($data);  
            $this->response($data, 202); 
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
        $parameter = array('p_mode' => $this->post('p_mode'),
                           'p_EmpId' => $this->post('p_EmpId'),
                           'p_IsAdmin' => $this->post('p_IsAdmin'),
                           'p_EmpCode' => $this->post('p_EmpCode'),
                           'p_Empfname' => $this->post('p_Empfname'),
                           'p_EmpLastName' => $this->post('p_EmpLastName'),
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
                           'p_XmlDatatest' => $this->post('p_XmlDatatest'),
                           'p_AmountRange' => $this->post('p_AmountRange'),
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
    function profileview_post()
    {
        $parameter = array(
                       'e_Id'      => $this->post('e_Id'),
                       'e_Dob'     => '',
                       'e_Mobile'  => '',
                       'e_Phone'   => '',
                       'e_Address1' => '',
                       'e_Address2' => '',
                       'e_Address3' => '',
                       'e_Country' => '',
                       'e_State'   => '',
                       'e_City'    => '',
                       'e_Pin'     => '',
                       'e_Seq'     => '',
                       'act_mode'  => $this->post('act_mode')
                        );
          $data=$this->supper_admin->call_procedureRow('proc_EmpProfileEditOrView', $parameter);


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

  $parameter = array( 
                       'e_Id'       =>$this->post('e_Id'),
                       'e_Dob'      => $this->post('e_Dob'),
                       'e_Mobile'   => $this->post('e_Mobile'),
                       'e_Phone'    => $this->post('e_Phone'),
                       'e_Address1' => $this->post('e_Address1'),
                       'e_Address2' => $this->post('e_Address2'),
                       'e_Address3' => $this->post('e_Address3'),
                       'e_Country'  => $this->post('e_Country'),
                       'e_State'    => $this->post('e_State'),
                       'e_City'     => $this->post('e_City'),
                       'e_Pin'      => $this->post('e_Pin'),
                       'e_Seq'      => $this->post('e_Seq'),
                       'act_mode'   => 'update'
                        );
        $data=$this->supper_admin->call_procedureRow('proc_EmpProfileEditOrView', $parameter);
        if(!empty($data)){
            $data   = $this->send_json($data);
            $this->response($data, 202);
        }
        else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }
}
function country_post()
{
  $parameter = array(
                      'bus_id' => $this->post('bus_id')
                        );

     $data=$this->supper_admin->call_procedure('proc_viewcountry', $parameter);
        if(!empty($data)){
            $data   = $this->send_json($data);
            $this->response($data, 202);
        }
        else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }
}


function empspandcat_post()
{
  $parameter = array(
                      'bus_id' => $this->post('id')
                        );

     $data=$this->supper_admin->call_procedure('proc_empgetcat', $parameter);
        if(!empty($data)){
            $data   = $this->send_json($data);
            $this->response($data, 202);
        }
        else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }
}


function displayclaim_post(){
	   $parameter = array(
                    	'businessId' => $this->post('businessId'),
                    	'userId' => $this->post('userId')
                    );

        $data=$this->supper_admin->call_procedure('proc_claimemp', $parameter);
        if(!empty($data)){
            $data   = $this->send_json($data);
            $this->response($data, 202);
        }
        else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }
}


function displayexpensereport_post(){
	  $parameter = array(
                    	'businessId' => $this->post('businessId'),
                    	'userId' => $this->post('userId')
                    );

        $data=$this->supper_admin->call_procedure('proc_claimemp', $parameter);
        if(!empty($data)){
            $data   = $this->send_json($data);
            $this->response($data, 202);
        }
        else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }
}

function displaysinglereport_post(){
	   $parameter = array(
                    	'userId'     => $this->post('userId'),
                    	'businessId' => $this->post('businessId'),
                    	'reprotId'   => $this->post('reprotId'),
                    	'actMode'    => $this->post('actMode')
                    );
	    if($this->post('actMode') =='claimreport'){
			$data = $this->supper_admin->call_procedureRow('proc_displayclaimreprot', $parameter);
		}else{
			$data = $this->supper_admin->call_procedure('proc_displayclaimreprot', $parameter);
	    }
		
        if(!empty($data)){
            $data   = $this->send_json($data);
            $this->response($data, 202);
        }
        else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }
}


function displayexpense_post(){
	$parameter = array(
                    	'userId'     => $this->post('userId'),
                    	'businessId' => $this->post('businessId'),
                    	'reprotId'   => $this->post('reprotId'),
                    	'actMode'    => $this->post('actMode')
                    );
    $data = $this->supper_admin->call_procedureRow('proc_displayclaimreprot', $parameter);
    if(!empty($data)){
            $data   = $this->send_json($data);
            $this->response($data, 202);
    }
     else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
    }

}



function deletenote_post(){
	   $parameter = array(
		                  'reportId' => $this->post('reportId'),
		                  'userId' => $this->post('userId'),
		                  'businessId' => $this->post('businessId')
		              );

		$data = $this->supper_admin->call_procedure('proc_deletenote', $parameter);
		if($data){
			$data = 1;
		}else{
			$data = 0;
		}
		if(!empty($data)){
            $data   = $this->send_json($data);
            $this->response($data, 202);
        }
        else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }

}



function emprptsearch_post(){
            $data = json_decode(file_get_contents("php://input"), true);
  $parameter = array('act_mode' =>$this->post('act_mode'),
                      'businessId' =>$this->post('businessId'),
                      'userId' => $this->post('userid'),
                      'name' =>$this->post('name') ,
                      'status' =>$this->post('status'),
                      'submit' =>$this->post('submit') ,
                      'claimfrom' =>$this->post('claimfrom'),
                      'claimto' =>$this->post('claimto')
                  );
    $data = $this->supper_admin->call_procedure('proc_emprpt',$parameter);

if(!empty($data)){
            $parameter   = $this->send_json($data);
            $this->response($parameter, 202);
        }
        else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }



}



// end of class
}