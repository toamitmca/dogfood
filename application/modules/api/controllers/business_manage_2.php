<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Business_manage_2 extends REST_Controller{


    function send_json($array){

        $this->output->set_content_type('application/json');
        $this->output->set_header('Cache-Control: no-cache, must-revalidate');
        $this->output->set_header('Expires: '.date('r', time()+(86400*365)));
        echo json_encode($array);
        exit();
   	 }

    function general_post(){
    $data = json_decode(file_get_contents("php://input"), true);
     $parameter = $arrayName = array('id'    => $this->post('business_user_id'));

      $data = $this->supper_admin->call_procedureRow('proc_business_bdtl', $parameter);
        if(!empty($data)){
            $parameter   = $this->send_json($data);
            $this->response($parameter, 202);
        }
        else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }

    }



     //  start  business department add
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
      $data = $this->supper_admin->call_procedureRow('proc_AddDepartmentmulty',$parameter);
           if(!empty($parameter)){
            $data   = $this->send_json($data);
            $this->response($data, 202); 
        }
        else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }

     }
//  End  business department add

// start Category add
 function businesscategory_post() {
      $data = json_decode(file_get_contents("php://input"), true);
                    $parameter = array(
                               'p_mode'           => $this->post('p_mode'),
                               'p_DeptId'         =>$this->post('p_DeptId'),
                               'p_XmlData_sp_gl'  => $this->post('p_XmlData_sp_gl'),
                               'p_AdminType'      => $this->post('p_AdminType'),
                               'p_BusinessId'     => $this->post('p_BusinessId'),
                               'p_CreatedBy'      => $this->post('p_CreatedBy')
                                                             );
      $data = $this->supper_admin->call_procedureRow('proc_Addspndngcatmulti',$parameter);
           if(!empty($data)){
            $parameter   = $this->send_json($parameter);
            $this->response($parameter, 202);
        }
        else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }

     }

// End Category add

// start Custom Tag add
 function businesscustomtag_post() {
      $data = json_decode(file_get_contents("php://input"), true);
                    $parameter = array(
                               'p_mode'           => $this->post('p_mode'),
                               'p_DeptId'         =>$this->post('p_DeptId'),
                               'p_XmlData_tag_gl'       => $this->post('p_XmlData_cat'),
                               'p_AdminType'      => $this->post('p_AdminType'),
                               'p_BusinessId'     => $this->post('p_BusinessId'),
                               'p_CreatedBy'      => $this->post('p_CreatedBy')
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

// End Custom Tag add


// Start rememberment Tag add   

function addremembermt_post(){

 $data = json_decode(file_get_contents("php://input"), true);
                    $parameter = array(
                        'n_BusinessId'   => $this->post('n_BusinessId'),
                        'remenber'        =>$this->post('remenber')
                                         );
            $data = $this->supper_admin->call_procedureRow('proc_rememberment',$parameter);
           if(!empty($parameter)){
            $data   = $this->send_json($data);
            $this->response($data, 202);
        }
        else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }


        }

function getdtpcattag_post(){

 $data = json_decode(file_get_contents("php://input"), true);
                    $parameter = array(
                      'act_mode'        =>$this->post('act_mode'),
                      'n_BusinessId'   => $this->post('n_BusinessId')

                                         );
            $data = $this->supper_admin->call_procedure('proc_getdptmt',$parameter);
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
                         'b_IsActive' => $this->post('b_IsActive'),
                         'n_BusinessId' => $this->post('n_BusinessId'),
                         'p_mode' => $this->post('p_mode'),
                         'n_AdminType' => $this->post('n_AdminType')
                        );
        $data = $this->supper_admin->call_procedure('proc_EditViewState', $parameter);
       }else{
            $parameter=array('p_mode'      => $this->post('p_mode'),
                            'n_CountryId'  => $this->post('n_CountryId'),
                            'id'           => $this->post('id'),
                            't_StateName'  => $this->post('t_StateName'),
                            'n_AdminType'  => $this->post('n_AdminType'),
                            'n_BusinessId' => $this->post('n_BusinessId'),
                            'n_CreatedBy'  => $this->post('n_CreatedBy'),
                            'n_ModifiedBy' => $this->post('n_ModifiedBy'),
                            'b_IsActive'   => $this->post('b_IsActive'),
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
       
       //if(($pMode=='select') || ($pMode=='Editselect') || ($pMode=='CitySelect')){
         $parameter=array( 'p_mode'        => $this->post('p_mode'),
                            'p_id'         => $this->post('p_id'),
                            'n_StateId'    => $this->post('n_StateId'),
                            'p_BusinessId' => $this->post('p_BusinessId'),
                            'p_admin'      => $this->post('p_admin')
                        );
       $data = $this->supper_admin->call_procedure('Pro_EditViewCity', $parameter);
      // }
       /*else{
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
       }*/

        if(!empty($data)){
            $data   = $this->send_json($data);
            $this->response($data, 202);
        }
        else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }

}



//  Employee section start //

function employeeview_post() {
      $data = json_decode(file_get_contents("php://input"), true);
                    $parameter = array(
                                    'act_mpde'  => $this->post('act_mpde'),
                                    'id'        =>$this->post('id'),
                                    'b_deleted' =>$this->post('b_deleted')
                                       );
      $data = $this->supper_admin->call_procedure('proc_ssaemploylock',$parameter);
           if(!empty($data)){
            $data   = $this->send_json($data);
            $this->response($mymessage, 202);
        }
        else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }

     }

  function employeedelete_post() {
        $data = json_decode(file_get_contents("php://input"), true);
                    $parameter = array(
                                  'act_mpde'  => $this->post('act_mpde'),
                                  'id'         => $this->post('id'),
                                 'deleted'    => $this->post('b_deleted')

                              );
      $data = $this->supper_admin->call_procedureRow('proc_ssaemploylock',$parameter);
           if(!empty($data)){
            $data   = $this->send_json($data);
            $this->response($data, 202);
        }
        else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }

       }

///   ssa admin  policy section start


function ssapolicylist_post() {
        $data = json_decode(file_get_contents("php://input"), true);
                    $parameter = array(
                                  'act_mpde'  => $this->post('act_mpde'),
                                  'id'         => $this->post('id')
                              );
      $data = $this->supper_admin->call_procedureRow('proc_ssapolicy',$parameter);
           if(!empty($data)){
            $data   = $this->send_json($data);
            $this->response($data, 202);
        }
        else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }

       }

    function ssapolictspcat_post(){
    $data = json_decode(file_get_contents("php://input"), true);
                    $parameter = array(
                                  'act_mpde'  => $this->post('act_mpde')
                              );
      $data = $this->supper_admin->call_procedure('proc_ssaspndcatlist',$parameter);
           if(!empty($data)){
            $data   = $this->send_json($data);
            $this->response($data, 202);
        }
        else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }
    }
       // end ssa admin policy
 





} /*end class*/