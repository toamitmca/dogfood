<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Business_manage extends REST_Controller{


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
                                       'n_BusinessId'   => $this->post('n_BusinessId')
				                                                                          	);
            $data = $this->supper_admin->call_procedure('proc_getpolicycat',$parameter);
           if(!empty($data)){
             $data   = $this->send_json($data);
             $this->response($data, 202);
           }
        else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }


}



function getdtpcattagbusiness_post(){

 $data = json_decode(file_get_contents("php://input"), true);
                    $parameter = array(
                                   'act_mode'=>$this->post('act_mode'),

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
                        'bcountry' => $this->post('bcountry'),
                        'bstate'   => $this->post('bstate'),
                        'bcity'    => $this->post('bcity'),
                        'bpin'     => $this->post('bpin'),
                        'act_mode' => 'pupdate' );
           $data = $this->supper_admin->call_procedureRow('proc_busadminpro',$parameter);
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
                                  'id'        => $this->post('id'),
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
function ssapolicybisins_post() {
        $data = json_decode(file_get_contents("php://input"), true);
                    $parameter = array(
                                  'act_mpde'  => $this->post('act_mpde'),
                                  'admintype' => $this->post('id')
                              );
         $data = $this->supper_admin->call_procedureRow('proc_ssagetbusiness',$parameter);
           if(!empty($data)){
            $data   = $this->send_json($data);
            $this->response($data, 202);
           }
          else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
         }

       }


function ssapolicylist1_post() {
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
       function ssapolicylist_post() {
                          $data = json_decode(file_get_contents("php://input"), true);
                          $parameter = array(
                          'act_mpde'  => $this->post('act_mpde'),
                          'id'         => $this->post('id')
                          );
                          $data = $this->supper_admin->call_procedure('proc_ssapolicy',$parameter);
                          if(!empty($data)){
                          $data   = $this->send_json($data);
                          $this->response($data, 202);
                          }
                          else{
                          $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
                          }
       }





       function myssapolicylist_post() {
                        $data = json_decode(file_get_contents("php://input"), true);
                        $parameter = array(
                        'act_mode'      => $this->post('act_mode'),
                        'busid'         => $this->post('busid')
                        );
                        $data = $this->supper_admin->call_procedure('proc_allspendcat',$parameter);
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
function ssapolicygeneral_post(){

            $data = json_decode(file_get_contents("php://input"), true);
            $parameter = array(
             'act_mode' =>$this->post('act_mode'),
                   'act_mode1' =>$this->post('act_mode1'),
                   'id'        =>$this->post('id'),
                   'polcy_name'=>$this->post('polcy_name'),
                   'n_MaxRptAmt'=>$this->post('n_MaxRptAmt'),
                   'd_RptDueDt'=>$this->post('d_RptDueDt'),
                   'd_RptDueDt1'=>$this->post('d_RptDueDt1'),
                   'n_MaxExpAmt'=>$this->post('n_MaxExpAmt'),
                   'b_CashAdAllowed'=>$this->post('b_CashAdAllowed'),
                  'b_RecpReq'=>$this->post('b_RecpReq'),
                  'n_AboveAmt'=>$this->post('n_AboveAmt'),
                  'expense_submitted'=>$this->post('expense_submitted'),
                   'businessId'=>$this->post('businessId'),
                   'admintype'=>$this->post('admintype'),
                   'createdby'=>$this->post('createdby')

                                               );
      $data = $this->supper_admin->call_procedureRow('proc_ssapolicyeidt',$parameter);
           if(!empty($data)){
            $data   = $this->send_json($data);
            $this->response($data, 202);
        }
        else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }
    }

function ssapolicymilige_post(){
           $data = json_decode(file_get_contents("php://input"), true);

            $parameter = array(
                   'act_mode' =>$this->post('act_mode'),
                   'act_mode1' =>$this->post('act_mode1'),
                   'id'        =>$this->post('id'),
                   'n_MaxRptMilage'=>$this->post('n_MaxRptMilage'),
                   'n_MilageRate'=>$this->post('n_MilageRate'),
                   'n_PerMeasuremnt'=>$this->post('n_PerMeasuremnt'),
                   'n_MaxExpMil'=>$this->post('n_MaxExpMil'),
                   'b_IsGPSReq'=>$this->post('b_IsGPSReq')

                                               );
                  $data = $this->supper_admin->call_procedureRow('proc_ssapolicymilig',$parameter);
                  if(!empty($parameter)){
                  $data   = $this->send_json($parameter);
                  $this->response($data, 202);
                  }
                  else{
                  $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
                  }


    }


function ssapolicyspndlmt_post(){
           $data = json_decode(file_get_contents("php://input"), true);
            $parameter = array(
                   'act_mode' =>$this->post('act_mode'),
                   'act_mode1' =>$this->post('act_mode1'),
                   'id'        =>$this->post('id'),
                   'n_DailyExpLmt'=>$this->input->post('n_DailyExpLmt'),
                  'n_MonthlyExpLmt'=>$this->input->post('n_MonthlyExpLmt')
                                               );
                  $data = $this->supper_admin->call_procedureRow('proc_ssapolicyspndlmt',$parameter);
                  if(!empty($parameter)){
                  $data   = $this->send_json($parameter);
                  $this->response($data, 202);
                  }
                  else{
                  $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
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
    function ssapolicycategory_post(){
                $data = json_decode(file_get_contents("php://input"), true);
                $parameter = array(
                'p_mode' =>$this->post('p_mode'),
                'dpolicyid' =>$this->post('dpolicyid'),
                'p_XmlData_sp_gl' =>$this->post('p_XmlData_sp_gl'),
                'p_CreatedBy' =>$this->post('p_CreatedBy'),
                'p_AdminType' =>$this->post('p_AdminType'),
                'p_BusinessId'        =>$this->post('p_BusinessId')
                                         );
                $data = $this->supper_admin->call_procedure('proc_ssapolicycatmulty',$parameter);
                if(!empty($parameter)){
                $data   = $this->send_json($parameter);
                $this->response($data, 202);
                }
                else{
                $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
                }
    }

// get spending category  edit time
    function ssapolicycategoryedit_post(){
                $data = json_decode(file_get_contents("php://input"), true);
                $parameter = array(
                       'policytid' =>$this->post('policyid')
                                                   );
               $data = $this->supper_admin->call_procedure('proc_ssacatmapedit',$parameter);
               if(!empty($data)){
                $data   = $this->send_json($data);
                $this->response($data, 202);
             }
              else{
                 $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
            }
    }






       // end ssa admin policy 



// System admin check sspendcategory Rahul  
function validatespcat_post(){
                  $data = json_decode(file_get_contents("php://input"), true);
                  $parameter = array('businessid' =>$this->post('businessid') , 'catname'=>$this->post('cat_name') );
                  $data = $this->supper_admin->call_procedure('proc_ssacatavlidat',$parameter);

                  if(!empty($data)){
                  // $data   = $this->send_json($data);
                  $this->response("category_already_exit", 202);
                  }
                  else{
                  $this->response("category_not_exit", 400); // 200 being the HTTP response code
                  }
}





    // End check  spend category 

function addnewcatpolicy_post(){
 $data = json_decode(file_get_contents("php://input"), true);
$parameter = array('businessid' =>$this->post('businessid') ,
                    'policyid'=>$this->post('policyid'),
                    'spcatid' =>$this->post('spcatid') ,
                    'singlelimit'=>$this->post('singlelimit'),
                    'dalylimit'=>$this->post('dalylimit'),
                    'monthely'=>$this->post('monthely'));
$data = $this->supper_admin->call_procedure('proc_ssaaddcatpolicy',$parameter);

if(!empty($data)){
               // $data   = $this->send_json($data);
                $this->response("category_already_exit", 202);
             }
              else{
                 $this->response("category_not_exit", 400); // 200 being the HTTP response code
                }
}

function ssaspcatget_post(){
                  $data = json_decode(file_get_contents("php://input"), true);
                  $parameter = array('businessid' =>$this->post('businessid')
                  );
                  $data = $this->supper_admin->call_procedure('proc_ssagetallspcat',$parameter);

                  if(!empty($data)){
                  $data   = $this->send_json($data);
                  $this->response($data, 202);
                  }
                  else{
                  $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
                  }

}

function getaddspcat_post(){
$data = json_decode(file_get_contents("php://input"), true);
                  $parameter = array('businessid' =>$this->post('businessid') , 'policyid' =>$this->post('policyid')
                  );
                  $data = $this->supper_admin->call_procedure('proc_ssagetcatofteradd',$parameter);

                  if(!empty($data)){
                  $data   = $this->send_json($data);
                  $this->response($data, 202);
                  }
                  else{
                  $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
                  }

}

function deletecatssa_post(){
$data = json_decode(file_get_contents("php://input"), true);
                  $parameter = array('businessid' =>$this->post('businessid') , 'catid' =>$this->post('catid')
                  );
                  $data = $this->supper_admin->call_procedure('proc_ssadeletecat',$parameter);

                  if(!empty($data)){
                  $data   = $this->send_json($data);
                  $this->response($data, 202);
                  }
                  else{
                  $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
                  }




}
function policycheck_post(){
$data = json_decode(file_get_contents("php://input"), true);
                  $parameter = array('businessid' =>$this->post('businessid') , 'policyname' =>$this->post('policyname') );
                  $data = $this->supper_admin->call_procedureRow('proc_ssapolicycheck',$parameter);

                  if(!empty($data)){
                  $data   = $this->send_json($data);
                  $this->response($data, 202);
                  }
                  else{
                  $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
                  }




}


function ssapolicyeditdelcheck_post(){


$data = json_decode(file_get_contents("php://input"), true);
                  $parameter = array( 'act_mode'=>$this->post('act_mode') ,'policyId' =>$this->post('policyId') );
                  $data = $this->supper_admin->call_procedureRow('proc_ssacheckpolicyeditdelit',$parameter);

                  if(!empty($data)){
                  $data   = $this->send_json($data);
                  $this->response($data, 202);
                  }
                  else{
                  $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
                  }



}
// ######### SHEETEESH DUBEY SATRTS ######

function employeeCheckEmp_post(){
                  $data = json_decode(file_get_contents("php://input"), true);
                  $parameter = array( 'E_busiid'    => $this->post('busid'),
                                      'n_PolicyId'  => $this->post('policy'),
                                      'E_depid'     => $this->post('department'),
                                      'E_email'     => $this->post('email1')
                                    );
                  //$data = $this->supper_admin->call_procedure('proc_checkemp',$parameter);

                  if(!empty($parameter)){
                  $parameter   = $parameter->send_json($parameter);
                  $this->response($parameter, 202);
                  }
                  else{
                  $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
                  }

}
// ######### SHEETEESH DUBEY END ######

// ########## Rahul yadav ###################
function enployeepasswordreset_post(){
$data = json_decode(file_get_contents("php://input"), true);
$parameter = array('act_mode'=>$this->post('act_mode'),'email'=>$this->post('emp_emial'), 'sequrityasn'=>$this->post('seqasn') ,'password'=>$this->post('epasswoed') );
$data = $this->supper_admin->call_procedureRow('proc_empresetpass',$parameter);
 if (!empty($data)) {
          $data = $this->send_json($data);
          $this->response($data,200);
                      }
                      else{
                        $this->response("Something Went Wrong", 400);
                      }

}

 // Get department  by business id

function businessdepartment_post(){
$data = json_decode(file_get_contents("php://input"), true);
$parameter = array('act_mode'=>$this->post('act_mode'),'id'=>$this->post('businessid'));
$data = $this->supper_admin->call_procedure('proc_ssapolicy',$parameter);
 if (!empty($data)) {
          $data = $this->send_json($data);
          $this->response($data,200);
                      }
                      else{
                        $this->response("Something Went Wrong", 400);
                      }

}



function ssabusroolaccess_post(){
$data = json_decode(file_get_contents("php://input"), true);
$parameter = array( 'act_mode'=>$this->post('act_mode'), 'id'=>$this->post('adminid'));
$data = $this->supper_admin->call_procedure('proc_ssaroolbus',$parameter);
 if (!empty($data)) {
          $data = $this->send_json($data);
          $this->response($data,200);
                      }
                      else{
                        $this->response("Something Went Wrong", 400);
                      }

}



function ssabusrooleupdate_post(){
$data = json_decode(file_get_contents("php://input"), true);
$parameter = array( 'p_XmlData_dname'=>$this->post('p_XmlData_dname'), 
                    'adminid'=>$this->post('adminid') ,
                    'amount'=>$this->post('amount'),
                    'CreatedBy'=>$this->post('createdby'),
                    'businessid'=>$this->post('businessid')
                    );
$data = $this->supper_admin->call_procedure('proc_ssarooledit',$parameter);
 if (!empty($parameter)) {
          $data = $this->send_json($parameter);
          $this->response($data,200);
                      }
                      else{
                        $this->response("Something Went Wrong", 400);
                      }

}

function emppassreset_post(){
$data = json_decode(file_get_contents("php://input"), true);
$parameter = array( 'act_mode'=>$this->post('act_mode'),
                    'userid'=>$this->post('userid') ,
                    'password'=>$this->post('password')
                    );
$data = $this->supper_admin->call_procedureRow('proc_emppassreset',$parameter);
 if (!empty($data)) {
          $data = $this->send_json($data);
          $this->response($data,200);
                      }
                      else{
                        $this->response("Something Went Wrong", 400);
                      }

}

// Rahul Yadav 15/12/2014 currency  formate

function currencyformate_post(){
$data = json_decode(file_get_contents("php://input"), true);
$parameter = array( 'act_mode'=>$this->post('act_mode'),
                    'businesid'=>$this->post('businesid') 
                                        );
$data = $this->supper_admin->call_procedureRow('proc_ssacurrency',$parameter);
 if (!empty($data)) {
          $data = $this->send_json($data);
          $this->response($data,200);
                      }
                      else{
                        $this->response("Something Went Wrong", 400);
                      }

}



//Add policy  system admin and business admin
function  addpolicyonkeyupbusinessadmin_post(){
$data = json_decode(file_get_contents("php://input"), true);
$parameter= array(
   'act_mode' =>$this->post('act_mode') ,
   'n_PolicyId'=>$this->post('n_PolicyId') ,
  't_PolicyName'=>$this->post('t_PolicyName') ,
  'n_MaxRptAmt'=>$this->post('n_MaxRptAmt') ,
  'd_RptDueDt'=>$this->post('d_RptDueDt') ,
  'd_RptDueDt1'=>$this->post('d_RptDueDt1'),
  'n_MaxExpAmt'=>$this->post('n_MaxExpAmt') ,
  'b_CashAdAllowed'=>$this->post('b_CashAdAllowed') ,
  'b_RecpReq'=>$this->post('b_RecpReq') ,
  'n_AboveAmt'=>$this->post('n_AboveAmt') ,
  'expense_submitted'=>$this->post('expense_submitted') ,
  'n_MaxRptMilage'=>$this->post('n_MaxRptMilage') ,
  'n_MilageRate'=>$this->post('n_MilageRate') ,
  'n_PerMeasuremnt'=>$this->post('n_PerMeasuremnt') ,
  'n_MaxExpMil'=>$this->post('n_MaxExpMil') ,
  'b_IsGPSReq'=>$this->post('b_IsGPSReq'),
  'n_DailyExpLmt'=>$this->post('n_DailyExpLmt') ,
  'n_MonthlyExpLmt'=>$this->post('n_MonthlyExpLmt'),
  'p_BusinessId' =>$this->post('p_BusinessId'),
  'p_CreatedBy' =>$this->post('p_CreatedBy'),
  'n_AdminType' =>$this->post('n_AdminType')
  );
  $data = $this->supper_admin->call_procedureRow('proc_policyaddonblur',$parameter);
 if (!empty($data)) {
          $data = $this->send_json($data);
          $this->response($data,200);
                      }
                      else{
                        $this->response("Something Went Wrong", 400);
                      }







}




} /*end class*/