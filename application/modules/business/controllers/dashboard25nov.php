<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Dashboard extends MX_Controller {
 
  public function __construct() {
	$this->load->model("supper_admin");	
	$this->load->helper('my_helper');
  }

  public function index(){

 	$this->load->view('layout/header');
  
 $data = businesschecklogin();
 $id=$data['n_BusinessId'];

       $parameter = array(
                          'busid' => $id ,
                           );
      
       $path  = base_url()."api/business_admin_2/view_business_create_admin/format/json/";
       $response  = curlcall($parameter, $path);

     $data['busdetail']=$response;

  	$this->load->view('index',$data);
  }	


  
  public function getStateDropDown(){

    $this->login_check();
    $userId= checklogin();
    $countryId=$_POST['id'];
    $parameterState = array('id' => $countryId,
                            'b_IsActive' => '1',
                            'n_BusinessId' => $userId['n_BusinessId'],
                            'p_mode' => 'Stateselect',
                            'n_AdminType' => 33,
                          );
   $pathState  = base_url()."api/business_admin/state/format/json/";
   $responseState  = curlcall($parameterState, $pathState);
    
         if($responseState =='Something Went Wrong'){
              $responseState="";
         }else{
          echo json_encode($responseState);
           
            exit();
          }
  }


  public function getCityDropDown(){
  $this->login_check();
  $userId= checklogin();
  $parameter =array(  'p_mode' => 'CitySelect',
                       'p_id' => 'null',
                       'p_stateId' => $_POST['id'],
                       'p_BusinessId' => $userId['n_BusinessId'],
                       'p_admin' => 33
                        );
  $path  = base_url()."api/business_admin/city/format/json/";
  $response  = curlcall($parameter, $path);
  if($response =='Something Went Wrong'){
              $data='';
   }else{
    echo json_encode($response);
    exit();
    }
  }

public function searchBusName(){
  $this->login_check();
  $userId= checklogin();
 if(!empty($_POST['name'])){
     $parameterSide=array(
                        'p_mode' => 'SearchSelect',
                        'p_BusnAdminId'=>'null',
                        'p_FirstName' => $_POST['name'],
                        'p_LastName' => '',
                        'p_BusinessId' => $userId['n_BusinessId'],
                      );
    }else{
      $parameterSide=array(
                        'p_mode' => 'SearchSelect',
                        'p_BusnAdminId'=>'null',
                        'p_FirstName' => '',
                        'p_LastName' => '',
                        'p_BusinessId' => $userId['n_BusinessId'],
                      );
    }
    $pathSide  = base_url()."api/business_admin/emp/format/json/";
    $responseSide  = curlcall($parameterSide, $pathSide);
  if($responseSide =='Something Went Wrong'){
           $data['side']="";
     }else{
        echo json_encode($responseSide);
        exit();
     }
}
public function searchReport(){
  $this->login_check();
  $userId= checklogin();
  if(!empty($_POST['id'])){
    $parameter=array(   'p_mode' => 'EmpIdBasedReport',
                        'p_BusinessId' => $userId['n_BusinessId'],
                        'p_EmpId' => $_POST['id'],
                        'p_DeptId' => 1,
                        );
  $path  = base_url()."api/business_admin/claimReport/format/json/";
  }else{
    $parameter=array( 'p_mode' => 'SelectList',
                      'p_BusinessId' => $userId['n_BusinessId'],
                      'p_EmpId' => '',
                      'p_FirstName' => '',
                      'p_LastName' => ''
                      );
    $path  = base_url()."api/business_admin/addemp/format/json/";
   }
  $response  = curlcall($parameter, $path);
  if($response =='Something Went Wrong'){
        //echo json_encode(array('t_EmpFirstName'));

    }else{
        echo json_encode($response);
    }
}

public function searchName(){
  $this->login_check();
  $userId= checklogin();
  $empName=$_POST['name'];
 if(!empty($_POST['name'])){
    $parameter=array('p_mode' => 'SearchSelect',
                              'p_BusinessId' => $userId['n_BusinessId'],
                              'p_IsAdmin'=>false,
                              'p_EmpId' => 'null',
                              'p_FirstName' => $empName,
                              'p_LastName' => $empName
                              );
  }else{
    $parameter=array('p_mode' => 'SelectList',
                                'p_BusinessId' => $userId['n_BusinessId'],
                                'p_IsAdmin'=>false,
                                'p_EmpId' => 'null',
                                'p_FirstName' => 'null',
                                'p_LastName' => 'null'
                              );
   }
  $path  = base_url()."api/employee/addemp/format/json/";
  $response  = curlcall($parameter, $path);
   if($response =='Something Went Wrong'){
        //echo json_encode(array('t_EmpFirstName'));

    }else{
        echo json_encode($response);
    }
}
public function claimReportList(){

  $this->login_check();
  $userId= checklogin();

  $this->load->view('layout/header');
  $parameterSide=array( 'p_mode' => 'SelectList',
                        'p_BusinessId' => $userId['n_BusinessId'],
                        'p_EmpId' => 'null',
                        'p_FirstName' => 'null',
                        'p_LastName' => 'null'
                        );

      $pathSide  = base_url()."api/business_admin/addemp/format/json/";
      $responseSide  = curlcall($parameterSide, $pathSide);

     if($responseSide =='Something Went Wrong'){
            $data['sideEmpName']="";   
         }else{
            $data['sideEmpName']=$responseSide;
        }


      $parameterReport=array( 'p_mode' => 'select',
                            'p_BusinessId' => $userId['n_BusinessId'],
                            'p_DeptId' => $userId['businessUserDeptId'],
                          );
        $pathReport  = base_url()."api/business_admin/claimReport/format/json/";
        $responseReport  = curlcall($parameterReport, $pathReport);

       if($responseReport =='Something Went Wrong'){
             $data['sideReport']='';
         }else{
            $data['sideReport']=$responseReport;
        }
      $this->load->view('employee_view_report',$data);
}

public function detailReports(){
  $this->login_check();
  $userId= checklogin();
  $userFirstName=$userId['businessFirstName'];
  $userLastName=$userId['businessLastName'];
  $data['firstBusName']=$userFirstName;
  $data['lastBusName']=$userLastName;
  $data['lastBusName']=$userLastName;
  $data['businessId']=$userId['n_BusinessId'];
  $reportId=$this->uri->segment('4');
  $this->load->view('layout/header');
    $parameterSide=array( 'p_mode' => 'SelectList',
                          'p_BusinessId' => $userId['n_BusinessId'],
                          'p_EmpId' => 'null',
                          'p_FirstName' => 'null',
                          'p_LastName' => 'null'
                          );
      $pathSide  = base_url()."api/business_admin/addemp/format/json/";
      $responseSide  = curlcall($parameterSide, $pathSide);
      if($responseSide =='Something Went Wrong'){
               $this->session->set_flashdata('message','Please check Role Name');
               //$base_url  = base_url();
               //redirect($base_url.'business/dashboard/Roleadd/');
               echo "No report exit";
               exit();
         }else{
            $data['sideEmpName']=$responseSide;
        }


      $parameterReportSide=array( 'p_mode' => 'select',
                                  'p_BusinessId' => $userId['n_BusinessId'],
                                  'p_DeptId' => $userId['businessUserDeptId'],
                                );
     // p($parameterReport);
        $pathReportSide  = base_url()."api/business_admin/claimReport/format/json/";
        $responseReportSide  = curlcall($parameterReportSide, $pathReportSide);
        if($responseReportSide =='Something Went Wrong'){
               $this->session->set_flashdata('message','Please check Role Name');
               $base_url  = base_url();
               redirect($base_url.'business/dashboard/Roleadd/');
               exit();
         }else{
            $data['sideReport']=$responseReportSide;
        }

        $parameterReport=array( 'p_mode' => 'editselect',
                                'p_reportId' => $reportId,
                                'p_BusinessId' => $userId['n_BusinessId'],
                                'p_DeptId' => $userId['businessUserDeptId'],
                                );
        $pathReport  = base_url()."api/business_admin/claimReport/format/json/";
        $responseReport  = curlcall($parameterReport, $pathReport);
        if($responseSide =='Something Went Wrong'){
                   $this->session->set_flashdata('message','Please check Role Name');
                   $base_url  = base_url();
                   redirect($base_url.'business/dashboard/Roleadd/');
                   exit();
             }else{
                $data['report']=$responseReport;
            }
        $parameterNotes=array( 'p_mode' => 'EditSelect',
                                'p_noteId' => 'null',
                                'p_CreatedBy' => $userId['businessUserId'],
                                'p_Type' => 'Admin',
                                'n_ReportId' => $responseReport[0]->a_ReportId,
                               );
        $pathNotes  = base_url()."api/business_admin/notes/format/json/";
        $policyNotes  = curlcall($parameterNotes, $pathNotes);

      if($policyNotes =='Something Went Wrong'){
              $data['notes']='';
         }else{
            $data['notes']=$policyNotes;
        }

    $parameterExpense=array( 'p_mode' => 'SelectList',
                            'p_CustCatId' => 'null',
                            'p_ReportId' => $responseReport[0]->a_ReportId,
                           );
    $pathExpense  = base_url()."api/business_admin/expense/format/json/";
    $policyExpense  = curlcall($parameterExpense, $pathExpense);
    if($policyExpense =='Something Went Wrong'){
              $data['expense']='';
         }else{
            $data['expense']=$policyExpense;
        }
        $parameterPolicy=array( 'p_mode' => 'EditOrViewPolicy',
                            'p_formName' => 'First',
                            'p_PolicyId' => $responseReport[0]->n_PolicyId,
                            'p_BusinessId' => $userId['n_BusinessId'],
                           );
        $pathPolicy  = base_url()."api/business_admin/policy/format/json/";
        $policyName  = curlcall($parameterPolicy, $pathPolicy);
       if($policyName =='Something Went Wrong'){
               $this->session->set_flashdata('message','Please check Role Name');
               $base_url  = base_url();
               echo "Policy Name does not exit";
               //redirect($base_url.'business/dashboard/Roleadd/');
               exit();
         }else{
            $data['policyName']=$policyName;
        }

      $this->load->view('employee_detail_view_report',$data);
}

public function addNotes(){
  $this->login_check();
  $userId= checklogin();
  // $notes=$this->uri->segment('4');
  // $reportId=$this->uri->segment('5');
  //echo $notes.' '.$reportId;
  $parameter=array( 'p_mode'      => 'insert',
                    'p_noteId'    => 'null',
                    'p_reportId'  => $_POST['reportId'],
                    'p_noteDesc'  => $_POST['texValue'],
                    'p_createdBy' => $userId['n_BusinessId'],
                    'p_type'      => 'Admin',
                   );
  $path  = base_url()."api/business_admin/notes/format/json/";
  $response  = curlcall($parameter, $path);
  if($response=='Something Went Wrong'){
    echo json_encode(array('Not Inserted'));
  }else{
    echo json_encode($response);
  }
}

public function deleteNote(){
  $this->login_check();
  $userId= checklogin();
  $parameter=array( 'p_mode'      => 'delete',
                    'p_noteId'    => $_POST['noteId'],
                    'p_createdBy' => $userId['n_BusinessId'],
                    'p_type'      => 'Admin',
                   );
  $path  = base_url()."api/business_admin/deleteNote/format/json/";
  $response  = curlcall($parameter, $path);
  if($response=='Something Went Wrong'){
    echo json_encode(array('Not Deleted'=>'Not Deleted'));
  }else{
     echo json_encode($response);
    exit();
  }
}

public function approveReport(){
  $this->login_check();
  $userId= checklogin();

   $parameterReport=array( 'p_mode' => 'approved',
                            'p_reportId' => $_POST['reportId'],
                            'p_CreatedBy' => $userId['n_BusinessId'],
                          );
    $pathReport  = base_url()."api/business_admin/statusChanged/format/json/";
        $responseReport  = curlcall($parameterReport, $pathReport);
       if($responseReport =='Something Went Wrong'){
               $this->session->set_flashdata('message','Please check Role Name');
               // $base_url  = base_url();
               // redirect($base_url.'business/dashboard/Roleadd/');
               echo "No Records Found";
               exit();
         }else{
             echo json_encode($responseReport);
              exit();
        }
}


public function rejectReport(){
  $this->login_check();
  $userId= checklogin();

   $parameterReport=array( 'p_mode' => 'reject',
                            'p_reportId' => $_POST['reportId'],
                            'p_CreatedBy' => $userId['n_BusinessId'],
                          );
    $pathReport  = base_url()."api/business_admin/statusChanged/format/json/";
        $responseReport  = curlcall($parameterReport, $pathReport);
       if($responseReport =='Something Went Wrong'){
               $this->session->set_flashdata('message','Please check Role Name');
               // $base_url  = base_url();
               // redirect($base_url.'business/dashboard/Roleadd/');
               echo "No Records Found";
               exit();
         }else{
             echo json_encode($responseReport);
              exit();
        }
}


public function downloadReport(){
  $this->login_check();
  $userId= checklogin();
  $userFirstName=$userId['businessFirstName'];
  $userLastName=$userId['businessLastName'];
  $data['firstBusName']=$userFirstName;
  $data['lastBusName']=$userLastName;
  $data['lastBusName']=$userLastName;
  $data['businessId']=$userId['n_BusinessId'];
  $reportId=$this->uri->segment('4');

      $parameterReport=array( 'p_mode' => 'editselect',
                                'p_reportId' => $reportId,
                                'p_BusinessId' => $userId['n_BusinessId'],
                                'p_DeptId' => $userId['businessUserDeptId'],
                                );
        $pathReport  = base_url()."api/business_admin/claimReport/format/json/";
        $responseReport  = curlcall($parameterReport, $pathReport);
        if($responseReport =='Something Went Wrong'){
                   $this->session->set_flashdata('message','Please check Role Name');
                   // $base_url  = base_url();
                   // redirect($base_url.'business/dashboard/Roleadd/');
                   exit();
             }else{
                $data['report']=$responseReport;
            }
        $parameterNotes=array( 'p_mode' => 'EditSelect',
                                'p_noteId' => 'null',
                                'p_CreatedBy' => $userId['businessUserId'],
                                'p_Type' => 'Admin',
                                'n_ReportId' => $responseReport[0]->a_ReportId,
                               );
        $pathNotes  = base_url()."api/business_admin/notes/format/json/";
        $policyNotes  = curlcall($parameterNotes, $pathNotes);
        if($policyNotes =='Something Went Wrong'){
              $data['notes']='';
         }else{
            $data['notes']=$policyNotes;
        }

    $parameterExpense=array( 'p_mode' => 'SelectList',
                            'p_CustCatId' => 'null',
                            'p_ReportId' => $responseReport[0]->a_ReportId,
                           );
    $pathExpense  = base_url()."api/business_admin/expense/format/json/";
    $policyExpense  = curlcall($parameterExpense, $pathExpense);
   if($policyExpense =='Something Went Wrong'){
              $data['expense']='';
         }else{
            $data['expense']=$policyExpense;
        }
        $parameterPolicy=array( 'p_mode' => 'EditOrViewPolicy',
                            'p_formName' => 'First',
                            'p_PolicyId' => $responseReport[0]->n_PolicyId,
                            'p_BusinessId' => $userId['n_BusinessId'],
                           );
        $pathPolicy  = base_url()."api/business_admin/policy/format/json/";
        $policyName  = curlcall($parameterPolicy, $pathPolicy);
       if($policyName =='Something Went Wrong'){
               $this->session->set_flashdata('message','Please check Role Name');
              
               echo "Policy Name does not exit";
               //redirect($base_url.'business/dashboard/Roleadd/');
               exit();
         }else{
            $data['policyName']=$policyName;
        }
        $this->load->view('reportPdf',$data);
}

//================================== 
// Azhar starts here  Nov 24,2014
//=============================
public function getCountryName($countryId){
    $parameterCountry = array( 'countryName'   => 'null',
                              'id'            => $countryId,
                              'act_mode'      => 'selectCountryName',
                              'createdBy'     => 'null',
                              'active'        => '1',
                              'businessId'    => "null",
                              'adminUser'     => 'null',
                              );
   $pathCountry  = base_url()."api/business_admin/country/format/json/";
   $responseCountry  = curlcall($parameterCountry, $pathCountry);
  
   if($responseCountry =='Something Went Wrong'){
              $countryName="";
         }else{
          foreach ($responseCountry as $key => $value) {
            $countryName=$value->t_CountryName;
          }
      }
    return $countryName;
  }

  public function getStateName($stateId){
    $parameterState = array('id' => $stateId,
                            'b_IsActive' => '1',
                            'n_BusinessId' => 'null',
                            'p_mode' => 'stateName',
                            'n_AdminType' => 'null',
                          );
   $pathState  = base_url()."api/business_admin/state/format/json/";
   $responseState  = curlcall($parameterState, $pathState);
    if($responseState =='Something Went Wrong'){
              $stateName="";
         }else{
          foreach ($responseState as $key => $value) {
            $stateName=$value->t_StateName;
          }
      }
    return $stateName;
    }
  public function getCityName($cityId){
      $parameter =array(   'p_mode' => 'cityName',
                           'p_id' => $cityId,
                           'p_stateId' => 'null',
                           'p_BusinessId' => 'null',
                           'p_admin' => 'null'
                        );
      $path  = base_url()."api/business_admin/city/format/json/";
      $response  = curlcall($parameter, $path);
     
      if($response =='Something Went Wrong'){
                  $cityName="";
             }else{
              foreach ($response as $key => $value) {
                $cityName=$value->t_CityName;
              }
          }

    return $cityName;
  }

 public function general() {
         $userId= checklogin();
         $data = businesschecklogin();
         $Id = $data['n_BusinessId'];
         $parameter = array( 'id' => $Id,
                          'b_IsActive' => '1',
                          'n_AdminType' => '0'
                           );
          $pathState  = base_url()."api/business_admin/businesseview/format/json/";
          $responseState  = curlcall($parameter, $pathState);
         
          if(!empty($responseState)){
            $countryName=$this->getCountryName($responseState->n_CountryId);
          }else{
            $countryName='';
          }
          $data['countryName']=$countryName;
          if(!empty($responseState)){
            $stateName=$this->getStateName($responseState->n_StateId);
          }else{
            $stateName='';
          }
           $data['stateName']=$stateName;
          if(!empty($responseState)){
            $cityName=$this->getCityName($responseState->n_City);
          }else{
            $cityName='';
          }
         $data['cityName']=$cityName;
          if($responseState=='Something Went Wrong'){
            $data['state']='';
          }else{
             $data['state']=$responseState;
          }
          $parameter_dpt = array( 'act_mode' => 'department',
                                      'n_BusinessId' => $Id

                           );
          $path1  = base_url()."api/business_admin/getdtpcattagbusiness/format/json/";    // Get spending category
          $responseState1  = curlcall($parameter_dpt, $path1);
          if($responseState=='Something Went Wrong'){
            $data['dpt_mt']='';
          }else{
             $data['dpt_mt']=$responseState1;
          }
          

          $parameter_sp_cat = array( 'act_mode' => 'sp_cat',
                                     'n_BusinessId' => $Id

                                    );
          $path2  = base_url()."api/business_admin/getdtpcattagbusiness/format/json/";
          $responseState2  = curlcall($parameter_sp_cat, $path2);
          if($responseState=='Something Went Wrong'){
            $data['sp_cat']='';
          }else{
             $data['sp_cat']=$responseState2;
          }
          

          $parameter_tag = array( 'act_mode' => 'custon_tag',
                                  'n_BusinessId' => $Id

                                );
          $path3  = base_url()."api/business_admin/getdtpcattagbusiness/format/json/";   // Get custom tag
          $responseState3  = curlcall($parameter_tag, $path3);
          if($responseState=='Something Went Wrong'){
            $data['custon_tag']='';
          }else{
             $data['custon_tag']=$responseState3;
          }
          


          $this->load->view('layout/header');
          $this->load->view('business_pannel',$data);
          //  $this->load->view('layout/footer');
     }


public function businessAdminListing(){
  $this->login_check();
  $userId= checklogin();
  $this->load->view('layout/header');
  $parameterSide=array(
                        'p_mode'        => 'SelectList',
                        'p_BusnAdminId' =>'null',
                        'p_FirstName'   => 'null',
                        'p_LastName'    => 'null',
                        'p_BusinessId'  => $userId['n_BusinessId'],
                      );
        $pathSide  = base_url()."api/business_admin/emp/format/json/";
        $responseSide  = curlcall($parameterSide, $pathSide);

      if($responseSide =='Something Went Wrong'){
               $data['side']="";
         }else{
            $data['side']=$responseSide;
         }

    $parameter=array(
                        'p_mode'        => 'SelectAllList',
                        'p_BusnAdminId' =>'null',
                        'p_FirstName'   => 'null',
                        'p_LastName'    => 'null',
                        'p_BusinessId'  => $userId['n_BusinessId'],
                      );
        $path  = base_url()."api/business_admin/emp/format/json/";
        $response  = curlcall($parameter, $path);

      if($response =='Something Went Wrong'){
               $data['list']="";
         }else{
            $data['list']=$response;
         }

      $this->load->view('business_list',$data);
}

public function activateBusinessAdmin(){
    $this->login_check();
    $userId= checklogin();
    $id=$this->uri->segment('4');
     if(!empty($id)){
            $parameterUpdate = array( 'p_mode'        => 'activate',
                                      'p_BusnAdminId' => $id,
                                      'p_FirstName'   => 'null',
                                      'p_LastName'    => 'null',
                                      'p_BusinessId'  => $userId['n_BusinessId'],
                                    );

          $pathUpdate  = base_url()."api/business_admin/emp/format/json/";
          $response  = curlcall($parameterUpdate, $pathUpdate);

          if($response =='Something Went Wrong'){
                  $this->session->set_flashdata('message','Not Activated');
                  $base_url  = base_url();
                  redirect($base_url.'business/dashboard/businessAdminListing');
                  exit();

            }else{
             
                $this->session->set_flashdata('message','Activated Successfully');
                redirect($base_url.'business/dashboard/businessAdminListing');
                exit();
            }
     }
   }

   public function inactivateBusinessAdmin(){
    $this->login_check();
    $userId= checklogin();

     $id=$this->uri->segment('4');

     if(!empty($id)){
            $parameterUpdate = array( 'p_mode' => 'deactivate',
                                      'p_BusnAdminId' => $id,
                                      'p_FirstName' => 'null',
                                      'p_LastName' => 'null',
                                      'p_BusinessId' => $userId['n_BusinessId'],
                                    );

          $pathUpdate  = base_url()."api/business_admin/emp/format/json/";
          $response  = curlcall($parameterUpdate, $pathUpdate);
          // p($response);
          // exit();
          if($response =='Something Went Wrong'){
                  $this->session->set_flashdata('message','Not De-Activated');
                 
                  redirect($base_url.'business/dashboard/businessAdminListing');
                  exit();

            }else{
             
                $this->session->set_flashdata('message','De-Activated Successfully');
                redirect($base_url.'business/dashboard/businessAdminListing');
                exit();
            }
     }
   }

//================================== 
// End Azhar starts here  Nov 24,2014
//=============================
public function babapanel(){
  $this->login_check();
  $userId= checklogin();
  
  if(isset($_POST['submit'])){
     // p($_POST);
     // exit();
      //$userId= checklogin();
      $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('status', 'Status', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('department', 'Department', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('employee_id', 'Employee Id', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('date_of_birth', 'Date Of Birth', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('office_phone', 'Office Phone', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('mobile_phone', 'Mobile Phone', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('address_line1', 'Address Line1', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('address_line2', 'Address Line2', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('address_line3', 'Address Line3', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('country_id', 'Country', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('state_id', 'State', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('city_id', 'City', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('pin_code', 'Pincode', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('amount', 'Amount', 'trim|required|xss_clean|required');

      if($this->form_validation->run() != false){
         $email=$this->input->post('email');
         $status=$this->input->post('status');
         $firstName=$this->input->post('first_name');
         $lastName=$this->input->post('last_name');
         $department=$this->input->post('department');
         $dateOfBirth=$this->input->post('date_of_birth');
         $employeeCode=$this->input->post('employee_id');
         $officePhone=$this->input->post('office_phone');
         $mobilePhone=$this->input->post('mobile_phone');
         $addressLine1=$this->input->post('address_line1');
         $addressLine2=$this->input->post('address_line2');
         $addressLine3=$this->input->post('address_line3');
         $countryId=$this->input->post('country_id');
         $stateId=$this->input->post('state_id');
         $cityId=$this->input->post('city_id');
         $pinCode=$this->input->post('pin_code');
         $amount=$this->input->post('amount');
         $editPolicy=$this->input->post('edit_policy');
         $address=$addressLine1.'___'.$addressLine2.'___'.$addressLine3;
         $randPassword=rand();
         $password=md5($password);
         $DOB= date('Y-m-d', strtotime($dateOfBirth));
        // header('Content-type: text/xml');
         $xml =htmlentities("<NewDataSet>");
             
              foreach ($editPolicy as $key => $value) {
                $xml .=htmlentities('<tblempaccessmap><n_RoleAccessId>'.$value.'</n_RoleAccessId></tblempaccessmap>');
              }

             $xml .=htmlentities("</NewDataSet>");
           $parameter = array( 'p_mode'         =>  'Insert',
                               'p_BusnAdminId'  =>  'null',
                               'p_AdminCode'    =>  $employeeCode,
                               'p_Email'        =>  $email,
                               'p_pass'         =>  $password,
                               'p_FirstName'    =>  $firstName,
                               'p_LastName'     =>  $lastName,
                               'p_DeptId'       =>  $department,
                               'p_Contact'      =>  $officePhone,
                               'p_Mobile'       =>  $mobilePhone,
                               'p_DOB'          =>  $DOB,
                               'p_Address'      =>  addslashes($address),
                               'p_Country'      =>  $countryId,
                               'p_State'        =>  $stateId,
                               'p_City'         =>  $cityId,
                               'p_Pincode'      =>  $pinCode,
                               'p_Positon'      =>  'null',
                               'p_Status'       =>  $status,
                               'p_XmlDatatest'  =>  (html_entity_decode($xml, ENT_QUOTES, 'UTF-8')),
                               'p_AmountRange'  =>  $amount,
                               'p_CompareValue' =>  'null',
                               'p_CreatedBy'    =>  $userId['businessUserId'],
                               'p_BusinessId'   =>  $userId['n_BusinessId'],
                               'p_AdminType'    =>  $userId['n_AdminType'],
                               );
           
          $path  = base_url()."api/business_admin/emp/format/json/";
          $response  = curlcall($parameter, $path);
         if($response =='Something Went Wrong'){
                  $this->session->set_flashdata('message','Please Check All the Fields Name');
                  $base_url  = base_url();
                  redirect($base_url.'business/dashboard/babapanel/');
                  exit();

            }else{
                $subject="True Expense Business Login Details";
                $msg="Dear".$firstName;
                $msg.="A <TruExpense> user has been created for you. Please use following credentials to register you and begin using the expense management solution.";
                $msg.="Login Page:".base_url()."business/";
                $msg.="<h3>User Id:-</h3>".$email."</br>";
                $msg.="<h3>Default Password:-</h3>".$randPassword;
                $msg.="Thanks </br>Support Team </br>9999999999";
                $msg.=date("l jS \of F Y h:i:s A");
                sendmail($email,$subject,$msg);
                $this->session->set_flashdata('message','Business Admin Created Successfully');
                redirect($base_url.'business/dashboard/businessAdminListing/');
                exit();
            }
      }
   }

      $parameterSide=array(
                        'p_mode' => 'SelectList',
                        'p_BusnAdminId'=>'null',
                        'p_FirstName' => 'null',
                        'p_LastName' => 'null',
                        'p_BusinessId' => $userId['n_BusinessId'],
                      );
        $pathSide  = base_url()."api/business_admin/emp/format/json/";
        $responseSide  = curlcall($parameterSide, $pathSide);
    if($responseSide =='Something Went Wrong'){
              $data['side']="";
         }else{
            $data['side']=$responseSide;
         }

         $this->load->view('layout/header');
    $parameterRole= array( 'p_mode' => 'Select',
                           'p_id' => 'null',
                           'p_businessId' =>0 ,
                           'p_AdminType' => 33,
                        );
   $pathRole  = base_url()."api/business_admin/role/format/json/";
   $responseRole  = curlcall($parameterRole, $pathRole);
   if($responseRole =='Something Went Wrong'){
              $data['role']='';
         }else{
            $data['role']=$responseRole;
            
                               
         }
    $parameterCountry = array( 'countryName'   => 'null',
                              'id'            => 'null',
                              'act_mode'      => 'select',
                              'createdBy'     => 'null',
                              'active'        => '1',
                              'businessId'    => "null",
                              'adminUser'     => $userId['n_AdminType'],
                              );
   $pathCountry  = base_url()."api/business_admin/country/format/json/";
   $responseCountry  = curlcall($parameterCountry, $pathCountry);
   // p($responseCountry);
   // exit();
   if($responseCountry =='Something Went Wrong'){
              $data['country']="";
         }else{
            $data['country']=$responseCountry;
        }

 $this->load->view('business_admin_business_admin_panel',$data);
}

public function editbabapanel(){

  $this->login_check();
  $userId= checklogin();
  //p($userId);
  if(isset($_POST['submit'])){
     
      //$userId= checklogin();
      $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('status', 'Status', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('department', 'Department', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('employee_id', 'Employee Id', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('date_of_birth', 'Date Of Birth', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('office_phone', 'Office Phone', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('mobile_phone', 'Mobile Phone', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('address_line1', 'Address Line1', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('address_line2', 'Address Line2', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('address_line3', 'Address Line3', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('country_id', 'Country', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('state_id', 'State', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('city_id', 'City', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('pin_code', 'Pincode', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('amount', 'Amount', 'trim|required|xss_clean|required');

      if($this->form_validation->run() != false){
         $email=$this->input->post('email');
         $empUpdate=$this->input->post('emp_id');
         $status=$this->input->post('status');
         $firstName=$this->input->post('first_name');
         $lastName=$this->input->post('last_name');
         $department=$this->input->post('department');
         $dateOfBirth=$this->input->post('date_of_birth');
         $employeeCode=$this->input->post('employee_id');
         $officePhone=$this->input->post('office_phone');
         $mobilePhone=$this->input->post('mobile_phone');
         $addressLine1=$this->input->post('address_line1');
         $addressLine2=$this->input->post('address_line2');
         $addressLine3=$this->input->post('address_line3');
         $countryId=$this->input->post('country_id');
         $stateId=$this->input->post('state_id');
         $cityId=$this->input->post('city_id');
         $pinCode=$this->input->post('pin_code');
         $amount=$this->input->post('amount');
         $editPolicy=$this->input->post('edit_policy');
         $address=$addressLine1.'___'.$addressLine2.'___'.$addressLine3;
         $DOB= date('Y-m-d', strtotime($dateOfBirth));
         
        $xml =htmlentities("<NewDataSet>");
             
              foreach ($editPolicy as $key => $value) {
                $xml .=htmlentities('<tblempaccessmap><n_RoleAccessId>'.$value.'</n_RoleAccessId></tblempaccessmap>');
              }
              $xml .=htmlentities("</NewDataSet>");



     $parameterUpdate = array( 'p_mode'         =>  'Update',
                               'p_BusnAdminId'  =>  $empUpdate,
                               'p_AdminCode'    =>  $employeeCode,
                               'p_Email'        =>  $email,
                               'p_pass'         =>  'null',
                               'p_FirstName'    =>  $firstName,
                               'p_LastName'     =>  $lastName,
                               'p_DeptId'       =>  $department,
                               'p_Contact'      =>  $officePhone,
                               'p_Mobile'       =>  $mobilePhone,
                               'p_DOB'          =>  $DOB,
                               'p_Address'      =>  addslashes($address),
                               'p_Country'      =>  $countryId,
                               'p_State'        =>  $stateId,
                               'p_City'         =>  $cityId,
                               'p_Pincode'      =>  $pinCode,
                               'p_Positon'      =>  'null',
                               'p_Status'       =>  $status,
                               'p_XmlDatatest'  =>  (html_entity_decode($xml, ENT_QUOTES, 'UTF-8')),
                               'p_AmountRange'  =>  $amount,
                               'p_CompareValue' =>  'null',
                               'p_CreatedBy'    =>  $userId['businessUserId'],
                               'p_BusinessId'   =>  $userId['n_BusinessId'],
                               'p_AdminType'    =>  $userId['n_AdminType'],
                               );
          
          $pathUpdate  = base_url()."api/business_admin/emp/format/json/";
          $response  = curlcall($parameterUpdate, $pathUpdate);
          // p($response);
          // exit();
          if($response =='Something Went Wrong'){
                  $this->session->set_flashdata('message','Please All Fields Name');
                  $base_url  = base_url();
                  redirect($base_url.'business/dashboard/editbabapanel/'.$empUpdate);
                  exit();

            }else{
             
                $this->session->set_flashdata('message','Updated Successfully');
                redirect($base_url.'business/dashboard/businessAdminListing/');
                exit();
            }
      }
   }
        

        $parameterSide=array(
                        'p_mode' => 'SelectList',
                        'p_BusnAdminId'=>'null',
                        'p_FirstName' => 'null',
                        'p_LastName' => 'null',
                        'p_BusinessId' => $userId['n_BusinessId'],
                      );
        $pathSide  = base_url()."api/business_admin/emp/format/json/";
        $responseSide  = curlcall($parameterSide, $pathSide);
      if($responseSide =='Something Went Wrong'){
               $data['side']="";
         }else{
            $data['side']=$responseSide;
         }
      $empId=$this->uri->segment('4');

      $parameterEmpData=array(
                        'p_mode' => 'SelectEdit',
                        'p_BusnAdminId'=>$empId,
                        'p_FirstName' => 'null',
                        'p_LastName' => 'null',
                        'p_BusinessId' => $userId['n_BusinessId'],
                      );
      // p($parameterEmpData);
      // exit();
      $pathEmpData  = base_url()."api/business_admin/emp/format/json/";
      $responseEmpData  = curlcall($parameterEmpData, $pathEmpData);
      // p($responseEmpData);
      // exit();
     if($responseEmpData =='Something Went Wrong'){
           $data['empData']="";
         }else{
          foreach ($responseEmpData as $key => $value) {
                    $countryId=$value->n_CountryId;
                    $stateId=$value->n_StateId;
                  }
            $parameterState = array( 'id' => $countryId,
                                'b_IsActive' => '1',
                                'n_BusinessId' => '0',
                                'p_mode' => 'Stateselect',
                                'n_AdminType' => 33,
                              );
           $pathState  = base_url()."api/business_admin/state/format/json/";
           $responseState  = curlcall($parameterState, $pathState);
           if($responseState =='Something Went Wrong'){
                $data['stateList']='';
           }else{
          $data['stateList']=$responseState;
        }

        $parameterCity = array( 'p_mode' => 'CitySelect',
                                'p_id' => 'null',
                                'p_stateId' => $stateId,
                                'p_BusinessId' => 'null',
                                'p_admin' => 33,
                          );
        
       $pathCity  = base_url()."api/business_admin/city/format/json/";
       $responseCity  = curlcall($parameterCity, $pathCity);
       
       if($responseCity =='Something Went Wrong'){
              $data['cityList']="";
        }else{
              $data['cityList']=$responseCity;
              }
        $data['empData']=$responseEmpData;
     }

      $this->load->view('layout/header');
     
     $parameterRole= array( 'p_mode' => 'Select',
                             'p_id' => 'null',
                             'p_businessId' =>"null" ,
                             'p_AdminType' => "null",
                          );
     $pathRole  = base_url()."api/business_admin/role/format/json/";
     $responseRole  = curlcall($parameterRole, $pathRole);
     if($responseRole =='Something Went Wrong'){
            $data['role']='';
      }else{
          $data['role']=$responseRole;
       }
    $parameterCountry = array( 'countryName'   => 'null',
                                'id'            => 'null',
                                'act_mode'      => 'select',
                                'createdBy'     => 'null',
                                'active'        => '1',
                                'businessId'    => "null",
                                'adminUser'     => $userId['n_AdminType'],
                                );

    $pathCountry  = base_url()."api/business_admin/country/format/json/";
    $responseCountry  = curlcall($parameterCountry, $pathCountry);
     if($responseCountry =='Something Went Wrong'){
                 $data['country']='';
           }else{
              $data['country']=$responseCountry;
           }

    $this->load->view('edit_business_admin_business_admin_panel',$data);

  
}
   
public function employee(){
 
    $this->login_check();
    $userId= checklogin();
     $this->load->view('layout/header');
        $parameterSide=array( 'p_mode' => 'SelectList',
                              'p_BusinessId' => $userId['n_BusinessId'],
                              'p_EmpId' => 'null',
                              'p_FirstName' => 'null',
                              'p_LastName' => 'null'
                              );
        $pathSide  = base_url()."api/business_admin/addemp/format/json/";
        $responseSide  = curlcall($parameterSide, $pathSide);
      
       if($responseSide =='Something Went Wrong'){
               // $this->session->set_flashdata('message','Please check Role Name');
               // $base_url  = base_url();
               // redirect($base_url.'business/dashboard/Roleadd/');
               // exit();
        $data['side']='';
         }else{
            $data['side']=$responseSide;
        }
        $this->load->view('employeelisting',$data);
        $this->load->view('layout/footer');
 }

   public function activate_employee(){
    $this->login_check();
    $userId= checklogin();
     $empId=$this->uri->segment('4');
     if(!empty($empId)){
            $parameterUpdate = array(  'p_mode' => 'activate',
                                       'p_EmpId' => $empId,
                                       'p_BusinessId' => $userId['n_BusinessId'],
                                      );
          $pathUpdate  = base_url()."api/business_admin/addemp/format/json/";
          $response  = curlcall($parameterUpdate, $pathUpdate);
          if($response =='Something Went Wrong'){
                  $this->session->set_flashdata('message','Please All Fields Name');
                  $base_url  = base_url();
                  redirect($base_url.'business/dashboard/edit_employee/'.$empUpdate);
                  exit();

            }else{
             
                $this->session->set_flashdata('message','Updated Successfully');
                redirect($base_url.'business/dashboard/employee');
                exit();
            }
     }
   }

   public function inactivate_employee(){
    $this->login_check();
    $userId= checklogin();

     $empId=$this->uri->segment('4');
     if(!empty($empId)){
            $parameterUpdate = array(  'p_mode' => 'deactivate',
                                       'p_EmpId' => $empId,
                                       'p_BusinessId' => $userId['n_BusinessId'],
                                      );
          $pathUpdate  = base_url()."api/business_admin/addemp/format/json/";
          $response  = curlcall($parameterUpdate, $pathUpdate);
          if($response =='Something Went Wrong'){
                  $this->session->set_flashdata('message','Please All Fields Name');
                  $base_url  = base_url();
                  redirect($base_url.'business/dashboard/edit_employee/'.$empUpdate);
                  exit();

            }else{
             
                $this->session->set_flashdata('message','Updated Successfully');
                redirect($base_url.'business/dashboard/employee');
                exit();
            }
     }
   }
  public function add_employee(){

    $this->login_check();
    $userId= checklogin();

   if(isset($_POST['submit'])){
      $this->form_validation->set_rules('policy', 'Policy', 'trim|required|xss_clean');
      $this->form_validation->set_rules('status', 'Status', 'trim|required|xss_clean');
      $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|xss_clean');
      $this->form_validation->set_rules('last_name', 'Last Name', 'trim|xss_clean|required');
      $this->form_validation->set_rules('department', 'Department', 'trim|required|xss_clean');
      $this->form_validation->set_rules('employee_id', 'Employee Id', 'trim|required|xss_clean');
      $this->form_validation->set_rules('date_of_birth', 'Date Of Birth', 'trim|required|xss_clean');
      $this->form_validation->set_rules('office_phone', 'Office Phone', 'trim|required|xss_clean');
      $this->form_validation->set_rules('mobile_phone', 'Mobile Phone', 'trim|required|xss_clean');
      $this->form_validation->set_rules('address_line1', 'Address Line1', 'trim|required|xss_clean');
      $this->form_validation->set_rules('address_line2', 'Address Line2', 'trim|required|xss_clean');
      $this->form_validation->set_rules('address_line3', 'Address Line3', 'trim|required|xss_clean');
      $this->form_validation->set_rules('country_id', 'Country', 'trim|required|xss_clean');
      $this->form_validation->set_rules('state_id', 'State', 'trim|required|xss_clean');
      $this->form_validation->set_rules('city_id', 'City', 'trim|required|xss_clean');
      $this->form_validation->set_rules('pin_code', 'Pincode', 'trim|required|xss_clean');
      

      if($this->form_validation->run() != false){
         
         $status=$this->input->post('status');
         $firstName=$this->input->post('first_name');
         $lastName=$this->input->post('last_name');
         $policy=$this->input->post('policy');
         $department=$this->input->post('department');
         $email=$this->input->post('email');
         $employeeCode=$this->input->post('employee_id');
         $dateOfBirth=$this->input->post('date_of_birth');
         $officePhone=$this->input->post('office_phone');
         $mobilePhone=$this->input->post('mobile_phone');
         $addressLine1=$this->input->post('address_line1');
         $addressLine2=$this->input->post('address_line2');
         $addressLine3=$this->input->post('address_line3');
         $countryId=$this->input->post('country_id');
         $stateId=$this->input->post('state_id');
         $cityId=$this->input->post('city_id');
         $pinCode=$this->input->post('pin_code');
         $randPassword=rand();
         $password=md5($randPassword);
         $DOB= date('Y-m-d', strtotime($dateOfBirth));
          $parameter = array(  'p_mode'         => 'Insert',
                               'p_EmpId'        => 'null',
                               'p_IsAdmin'      => false,
                               'p_EmpCode'      => $employeeCode,
                               'p_Empfname'     => $firstName,
                               'p_EmpLastName'  => $lastName,
                               'p_Email'        => $email,
                               'p_Pass'         => $password,
                               'p_DeptId'       => $department,
                               'p_PolicyId'     => $policy,
                               'p_EmpDob'       => $DOB,
                               'p_OfficePhno'   => $officePhone,
                               'p_MobileNo'     => $mobilePhone,
                               'p_AddFLine'     => $addressLine1,
                               'p_AddSecLine'   => $addressLine2,
                               'p_AddThrdLine'  => $addressLine3,
                               'p_Country'      => $countryId,
                               'p_State'        => $stateId,
                               'p_City'         => $cityId,
                               'p_PinCode'      => $pinCode,
                               'p_Status'       => $status,
                               'p_CreatedBy'    => $userId['businessUserId'],
                               'p_BusinessId'   => $userId['n_BusinessId'],
                               'p_AdminType'    => $userId['n_AdminType'],
                              );
          $path  = base_url()."api/business_admin/addemp/format/json/";
          $response  = curlcall($parameter, $path);
          if($response =='Something Went Wrong'){
                  $this->session->set_flashdata('message','Please All the Fields Name');
                  $base_url  = base_url();
                  redirect($base_url.'business/dashboard/add_employee/');
                  exit();

            }else{
                $subject="True Expense Business Login Details";
                $msg="Dear".$firstName;
                $msg.="A <TruExpense> user has been created for you. Please use following credentials to register you and begin using the expense management solution.";
                $msg.="Login Page:".base_url()."employee/";
                $msg.="<h3>User Id:-</h3>".$email."</br>";
                $msg.="<h3>Default Password:-</h3>".$randPassword;
                $msg.="Thanks </br>Support Team </br>9999999999";
                $msg.=date("l jS \of F Y h:i:s A");
                sendmail($email,$subject,$msg);
                $this->session->set_flashdata('message','Business Admin Created Successfully');
                redirect($base_url.'business/dashboard/businessAdminListing/');
            }
      }
   }

        $parameterSide=array('p_mode' => 'SelectList',
                              'p_BusinessId' => $userId['n_BusinessId'],
                              'p_EmpId' => 'null',
                              'p_FirstName' => 'null',
                              'p_LastName' => 'null'
                              );
        $pathSide  = base_url()."api/business_admin/addemp/format/json/";
        $responseSide  = curlcall($parameterSide, $pathSide);
       if($responseSide =='Something Went Wrong'){
              $data['side']="";
         }else{
            $data['side']=$responseSide;
         }

         $this->load->view('layout/header');
         $parameterCountry = array( 'countryName'   => 'null',
                                'id'            => 'null',
                                'act_mode'      => 'select',
                                'createdBy'     => 'null',
                                'active'        => '1',
                                'businessId'    => "null",
                                'adminUser'     => $userId['n_AdminType'],
                                );

          $pathCountry  = base_url()."api/business_admin/country/format/json/";
          $responseCountry  = curlcall($parameterCountry, $pathCountry);
          if($responseCountry =='Something Went Wrong'){
                       $data['country']='';
                 }else{
                    $data['country']=$responseCountry;
                 }
        $this->load->view('add_employee',$data);
  
  }

public function edit_employee(){
      $this->login_check();
      $userId= checklogin();

  if(isset($_POST['submit'])){
    //$userId= checklogin();
      $this->form_validation->set_rules('status', 'Status', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('department', 'Department', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('employee_id', 'Employee Id', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('date_of_birth', 'Date Of Birth', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('office_phone', 'Office Phone', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('mobile_phone', 'Mobile Phone', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('address_line1', 'Address Line1', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('address_line2', 'Address Line2', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('address_line3', 'Address Line3', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('country_id', 'Country', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('state_id', 'State', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('city_id', 'City', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('pin_code', 'Pincode', 'trim|required|xss_clean|required');
       $this->form_validation->set_rules('policy', 'Policy', 'trim|required|xss_clean|required');
    
    if($this->form_validation->run() != false){
         $empUpdate=$this->input->post('emp_id');
         $status=$this->input->post('status');
         $firstName=$this->input->post('first_name');
         $lastName=$this->input->post('last_name');
         $policy=$this->input->post('policy');
         $department=$this->input->post('department');
         $email=$this->input->post('email');
         $employeeCode=$this->input->post('employee_id');
         $dateOfBirth=$this->input->post('date_of_birth');
         $officePhone=$this->input->post('office_phone');
         $mobilePhone=$this->input->post('mobile_phone');
         $addressLine1=$this->input->post('address_line1');
         $addressLine2=$this->input->post('address_line2');
         $addressLine3=$this->input->post('address_line3');
         $countryId=$this->input->post('country_id');
         $stateId=$this->input->post('state_id');
         $cityId=$this->input->post('city_id');
         $pinCode=$this->input->post('pin_code');
        $DOB= date('Y-m-d', strtotime($dateOfBirth));
        $parameterUpdate = array( 'p_mode' => 'Update',
                                 'p_EmpId' => $empUpdate,
                                 'p_EmpCode' => $employeeCode,
                                 'p_Empfname' => $firstName,
                                 'p_EmpLastName' => $lastName,
                                 'p_DeptId' => $department,
                                 'p_PolicyId' => $policy,
                                 'p_EmpDob' => $DOB,
                                 'p_OfficePhno' => $officePhone,
                                 'p_MobileNo' => $mobilePhone,
                                 'p_AddFLine' => $addressLine1,
                                 'p_AddSecLine' => $addressLine2,
                                 'p_AddThrdLine' => $addressLine3,
                                 'p_Country' => $countryId,
                                 'p_State' => $stateId,
                                 'p_City' => $cityId,
                                 'p_PinCode' => $pinCode,
                                 'p_Status' => $status,
                                 'p_CreatedBy' => $userId['businessUserId'],
                                 'p_BusinessId' => $userId['n_BusinessId'],
                                 'p_AdminType'    => $userId['n_AdminType'],
                                );
          $pathUpdate  = base_url()."api/business_admin/addemp/format/json/";
          $response  = curlcall($parameterUpdate, $pathUpdate);
          if($response =='Something Went Wrong'){
                  $this->session->set_flashdata('message','Please All Fields Name');
                  $base_url  = base_url();
                  redirect($base_url.'business/dashboard/edit_employee/'.$empUpdate);
                  exit();

            }else{
             
                $this->session->set_flashdata('message','Updated Successfully');
                redirect($base_url.'business/dashboard/employee');
                exit();
            }
      }
   }
        

        $parameterSide=array('p_mode' => 'SelectList',
                              'p_BusinessId' => $userId['n_BusinessId'],
                              'p_IsAdmin'=>false,
                              'p_EmpId' => 'null',
                              'p_FirstName' => 'null',
                              'p_LastName' => 'null'
                              );
        $pathSide  = base_url()."api/business_admin/addemp/format/json/";
        $responseSide  = curlcall($parameterSide, $pathSide);
       if($responseSide =='Something Went Wrong'){
               $data['side']='';
         }else{
            $data['side']=$responseSide;
         }


        $empId=$this->uri->segment('4');
        $parameterEmpData=array('p_mode' => 'SelectEmpEdit',
                                'p_BusinessId' => $userId['n_BusinessId'],
                                'p_EmpId' => $empId,
                                'p_FirstName' => '',
                                'p_LastName' => '');
        $pathEmpData  = base_url()."api/business_admin/addemp/format/json/";
        $responseEmpData  = curlcall($parameterEmpData, $pathEmpData);
        if($responseEmpData =='Something Went Wrong'){
               $this->session->set_flashdata('message','Please check Role Name');
               $base_url  = base_url();
               redirect($base_url.'business/dashboard/add_employee/');
               exit();
         }else{
          foreach ($responseEmpData as $key => $value) {
                    $countryId=$value->n_CountryId;
                    $stateId=$value->n_StateId;
                  }
            $parameterState = array( 'id' => $countryId,
                                    'b_IsActive' => '1',
                                    'n_BusinessId' => $userId['n_BusinessId'],
                                    'p_mode' => 'Stateselect',
                                    'n_AdminType' => 33,
                                  );
           $pathState  = base_url()."api/business_admin/state/format/json/";
           $responseState  = curlcall($parameterState, $pathState);
          
            if($responseState =='Something Went Wrong'){
              $data['stateList']='';
           }else{
            $data['stateList']=$responseState;
            }
        $parameterCity =array(  'p_mode' => 'CitySelect',
                                 'p_id' => 'null',
                                 'p_stateId' => $stateId,
                                 'p_BusinessId' => $userId['n_BusinessId'],
                                 'p_admin' => 33
                                  );

           $pathCity  = base_url()."api/business_admin/city/format/json/";
           $responseCity  = curlcall($parameterCity, $pathCity);
           if($responseCity =='Something Went Wrong'){
              $data['cityList']='';
           }else{
            $data['cityList']=$responseCity;
            }
            $data['empData']=$responseEmpData;
         }
        $this->load->view('layout/header');
         $parameterCountry = array( 'countryName'   => 'null',
                                    'id'            => 'null',
                                    'act_mode'      => 'select',
                                    'createdBy'     => 'null',
                                    'active'        => '1',
                                    'businessId'    => "null",
                                    'adminUser'     => $userId['n_AdminType'],
                                  );

          $pathCountry  = base_url()."api/business_admin/country/format/json/";
          $responseCountry  = curlcall($parameterCountry, $pathCountry);
          if($responseCountry =='Something Went Wrong'){
                       $data['country']='';
                 }else{
                    $data['country']=$responseCountry;
                 }
         $this->load->view('edit_employee',$data);
      
  
}


public function delete_employee(){
      $this->login_check();
      $userId= checklogin();

     $empId=$this->uri->segment('4');
     if(!empty($empId)){
            $parameterUpdate = array(  'p_mode' => 'Delete',
                                       'p_EmpId' => $empId,
                                       'p_BusinessId' => $userId['n_BusinessId'],
                                      );
          $pathUpdate  = base_url()."api/business_admin/addemp/format/json/";
          $response  = curlcall($parameterUpdate, $pathUpdate);
          if($response =='Something Went Wrong'){
                  $this->session->set_flashdata('message','Please All Fields Name');
                  $base_url  = base_url();
                  redirect($base_url.'business/dashboard/edit_employee/'.$empUpdate);
                  exit();

            }else{

                $this->session->set_flashdata('message','Updated Successfully');
                redirect($base_url.'business/dashboard/employee');
                exit();
            }
     }
}
  public function policy(){
  	$this->load->view('layout/header');
  	$this->load->view('policyList');
  	$this->load->view('layout/footer');
  }

  public function policyList(){
  	$this->load->view('layout/header');
  	$this->load->view('policyList');	
  	$this->load->view('layout/footer');
  }

  public function policyListing(){
    $this->login_check();
    $userId= checklogin();

    $this->load->view('layout/header');
    $parameter=array( 'p_mode' => 'select',
                      'p_formName' => 'null',
                      'p_BusinessId' => $userId['n_BusinessId'],
                      'p_PolicyId' => '',
                      'p_AdminType' => $userId['n_AdminType'],
                      );
    $pathCat      = base_url().'api/business_admin/policy/format/json/';
    $responseCat  = curlcall($parameter, $pathCat);
  if($responseCat){
     $data['policyList']=$responseCat; 
    }else{
      $data['policyList']="";
    }
    $this->load->view('policyList',$data);
  }
  public function policyadd(){
  	$this->login_check();
    $userId= checklogin();
    $this->load->view('layout/header');
    $parameterCat = array('p_SpndngCatId' => 'null',
                          'p_mode'            => 'Select',
                          'p_SpndName'        => 'null',
                          'p_GLCode'        => 'null',
                          'p_AdminType'       => $userId['n_AdminType'],
                          'p_BusinessId'      => $userId['n_BusinessId'],
                         );
    $pathCat      = base_url().'api/business_admin/spendcat/format/json/';
    $responseCat  = curlcall($parameterCat, $pathCat);

    p($responseCat);
    exit();
    if($responseCat){
     $data['cat']=$responseCat; 
    }else{
      $data['cat']=""; 
    }
  	$this->load->view('policyEditCreateGeneral',$data);	
  }
// policy add comes here
  public function policyajaxgenral(){
  	$this->login_check();
  	$userId= checklogin();
    $action=$_POST['action'];
    if($action=="insert"){
      $parameters = array(
      'p_mode'            => 'Insert',
      'p_formName'        => 'First',
      'p_PolicyName'      => $_POST['t_PolicyName'],
      'p_PolicyId'        => 'null',
      'p_MaxRptAmt'       => $_POST['n_MaxRptAmt'],
      'd_RptDueDt'        => $_POST['d_RptDueDt'],
      'd_RptDueDt1'       => $_POST['d_RptDueDt1'],
      'p_MaxExpAmt'       => $_POST['n_MaxExpAmt'],
      'p_CashAdvAllowed'  => $_POST['b_CashAdAllowed'],
      'p_RecpReq'         => $_POST['b_RecpReq'],
      'p_AboveAmt'        => $_POST['n_AboveAmt'],
      'p_BusinessId'      => $userId['n_BusinessId'],
      'p_CreatedBy'       => $userId['businessUserId'],
      'p_AdminType'       => $userId['n_AdminType']

     );
    }else{
      $parameters = array(
      'p_mode'            => 'UpdateGen',
      'p_formName'        => 'First',
      'p_PolicyName'      => $_POST['t_PolicyName'],
      'p_PolicyId'        => $_POST['policyId'],
      'p_MaxRptAmt'       => $_POST['n_MaxRptAmt'],
      'd_RptDueDt'        => $_POST['d_RptDueDt'],
      'd_RptDueDt1'       => $_POST['d_RptDueDt1'],
      'p_MaxExpAmt'       => $_POST['n_MaxExpAmt'],
      'p_CashAdvAllowed'  => $_POST['b_CashAdAllowed'],
      'p_RecpReq'         => $_POST['b_RecpReq'],
      'p_AboveAmt'        => $_POST['n_AboveAmt'],
      'p_BusinessId'      => $userId['n_BusinessId'],
      'p_CreatedBy'       => $userId['businessUserId'],
      'p_AdminType'       => $userId['n_AdminType']

     );
    }
   //api calls will come here
	$path  	   = base_url().'api/business_admin/policyGeneral/format/json/';
	$response  = curlcall($parameters, $path);
  $response = json_encode($response);
  echo $response; 
 // exit();
	//api cals ends here
  	

  	// $t_PolicyName    = $_POST['t_PolicyName'];
   //  $n_MaxRptAmt     = $_POST['n_MaxRptAmt'];
   //  $d_RptDueDt      = $_POST['d_RptDueDt'];
   //  $d_RptDueDt1     = $_POST['d_RptDueDt1'];
   //  $n_MaxExpAmt     = $_POST['n_MaxExpAmt'];
   //  $b_CashAdAllowed = $_POST['b_CashAdAllowed'];
   //  $b_RecpReq		 = $_POST['b_RecpReq'];
   //  $n_AboveAmt		 = $_POST['n_AboveAmt'];
  }
// policy add ends here  
public function policyajaxmileage(){
          $this->login_check();
          $userId= checklogin();
          $parameters = array(
            'p_mode'           => 'Update',
            'p_formName'       => 'Second',
            'p_PolicyId'       => $_POST['lastId'],
            'p_MaxRptMilage'   => $_POST['n_MaxRptMilage'],
            'p_MilageRate'     => $_POST['n_MilageRate'],
            'p_PerMeasuremnt'  => $_POST['n_PerMeasuremnt'],
            'p_MaxExpMil'      => $_POST['n_MaxExpMil'],
            'p_IsGPSReq'       => $_POST['b_IsGPSReq'],
            'p_CreatedBy'      => $userId['businessUserId'],
           );
         
         // echo json_encode($parameters);
         // exit();
        //api calls will come here
        $path      = base_url().'api/business_admin/policyMileage/format/json/';
        $response  = curlcall($parameters, $path);
        echo json_encode($response);; 
        //api cals ends here
  }


  public function policyajaxspendinglimits(){
          $this->login_check();
          $userId= checklogin();
          $parameters = array(
            'p_mode'           => 'Update',
            'p_formName'       => 'Third',
            'p_PolicyId'       => $_POST['lastId'],
            'p_DailyExpLmt'    => $_POST['n_DailyExpLmt'],
            'p_MonthlyExpLmt'  => $_POST['n_MonthlyExpLmt'],
            'p_CreatedBy'      => $userId['businessUserId'],
           );
      //api calls will come here
        $path      = base_url().'api/business_admin/policyMileage/format/json/';
        $response  = curlcall($parameters, $path);
        p($response);
        exit();
        echo json_encode($response);; 
        //api cals ends here
  }


  public function policyajaxperiodcategories(){
    $this->login_check();
    $userId= checklogin();
    $action=$_POST['action'];

    $lastId=$_POST['lastId'];
    $catId=json_decode($_POST['catId']);
    $disableCatId=json_decode($_POST['disableValue']);
    $singleExpValue=json_decode($_POST['singleExp']);


    $dailyLimits=json_decode($_POST['daily']);
    $monthlyLimit=json_decode($_POST['month']);
    //  echo "<pre>";
    // print_r($singleExpValue);
    // echo "<pre>";
    // print_r($dailyLimits);
    //  echo "<pre>";
    // print_r($monthlyLimit);
    //  echo "<pre>";
    // print_r($catId);
    // echo "<pre>";
    // print_r($disableCatId);
    // exit();
    $xml =htmlentities("<NewDataSet>");
    
      for($i=0;$i<count($catId);$i++){
        if(in_array($catId[$i], $disableCatId)){

        }else{
          
            // if($singleExpValue[$i]){
            //   $singleExpValue=$singleExpValue[$i];
            // }else{
            //   $singleExpValue='';
            // }
            // if(!empty($dailyLimits[$i])){
            //   $dailyLimits=$dailyLimits[$i];
            // }else{
            //   $dailyLimits='';
            // }
            // if(!empty($monthlyLimit[$i])){
            //   $monthlyLimit=$monthlyLimit[$i];
            // }else{
            //   $monthlyLimit='';
            // }
            $xml .=htmlentities("<tblpolicycategorymap>");
            $xml .=htmlentities('<n_SpndngCatId>'.$catId[$i].'</n_SpndngCatId>');
            $xml .=htmlentities('<n_SingleExpLmt>'.$singleExpValue[$i].'</n_SingleExpLmt>');
            $xml .=htmlentities('<n_DailyExpLmt>'.$dailyLimits[$i].'</n_DailyExpLmt>');
            $xml .=htmlentities('<n_MonthlyExpLmt>'.$monthlyLimit[$i].'</n_MonthlyExpLmt>');
            $xml .=htmlentities("</tblpolicycategorymap>");
          }
      }
    
    $xml .=htmlentities("</NewDataSet>");



   if($action=="insert"){
      $parameters = array(
                          'p_mode'           => 'Insert',
                          'p_PlcyCatMapId'   => 'null',
                          'p_XmlDatatest'    => (html_entity_decode($xml, ENT_QUOTES, 'UTF-8')),
                          'p_PolicyId'       => $lastId,
                          'p_CreatedBy'      => $userId['businessUserId'],
                          'p_BusinessId'     => $userId['n_BusinessId'],
                        );
    }else{
      $parameters = array(
                          'p_mode'           => 'Update',
                          'p_PlcyCatMapId'   => 'null',
                          'p_XmlDatatest'    => (html_entity_decode($xml, ENT_QUOTES, 'UTF-8')),
                          'p_PolicyId'       => $lastId,
                          'p_CreatedBy'      => $userId['businessUserId'],
                          'p_BusinessId'     => $userId['n_BusinessId'],
                        );
    }
    // echo json_encode($parameters);
    // exit();
      //api calls will come here


    // echo json_encode($parameters);
    // exit();
        $path      = base_url().'api/business_admin/policyspencat/format/json/';
        $response  = curlcall($parameters, $path);
        echo json_encode($response);; 
        //api cals ends here
  }


  public function editPolicy(){
    $this->login_check();
    $userId= checklogin();
    // p($userId);
    // exit();
    $policyId=$this->uri->segment('4');
    $this->load->view('layout/header');

    $parameterCat = array('p_SpndngCatId' => 'null',
                          'p_mode'            => 'Select',
                          'p_SpndName'        => 'null',
                          'p_GLCode'        => 'null',
                          'p_AdminType'       => $userId['n_AdminType'],
                          'p_BusinessId'      => $userId['n_BusinessId'],
                         );
    $pathCat      = base_url().'api/business_admin/spendcat/format/json/';
    $responseCat  = curlcall($parameterCat, $pathCat);
   
    if($responseCat=='Something Went Wrong'){
     $data['cat']=''; 
    }else{
      $data['cat']=$responseCat; 
    }
    $parameterAssign=array( 'p_mode' => 'SelectEdit',
                      'p_formName' => 'null',
                      'p_BusinessId' => $userId['n_BusinessId'],
                      'p_PolicyId' => $policyId,
                      'p_AdminType' => $userId['n_AdminType'],
                      );

    $pathAssignCat      = base_url().'api/business_admin/policy/format/json/';
    $responseCatAssign  = curlcall($parameterAssign, $pathAssignCat);
    if($responseCatAssign){
     $data['policy']=$responseCatAssign; 
    }else{
      $data['policy']='';
    }
   
    $this->load->view('editpolicy',$data);
  }
  public function countrylisting(){
  $this->login_check();
   $this->load->view('layout/header');
   $userId= checklogin();
    $parameter = array(        'countryName'   => 'null',
                              'id'            => 'null',
                              'act_mode'      => 'select',
                              'createdBy'     => 'null',
                              'active'        => '1',
                              'businessId'    => $userId['n_BusinessId'],
                              'adminUser'     => $userId['n_AdminType'],
                              );
   $path  = base_url()."api/business_admin/country/format/json/";
   $response  = curlcall($parameter, $path);
   if($response =='Something Went Wrong'){
               $this->session->set_flashdata('message','Please check country Name');
               $base_url  = base_url();
               redirect($base_url.'business/dashboard/countryadd/');
               exit();
         }else{
            $data['listing']=$response;
            $this->load->view('countryListing', $data);
            $this->load->view('layout/footer');                          
         }
}


public function countryadd(){
   $this->login_check();
   $userId= checklogin();
  if(isset($_POST['submit'])){
    $userId= checklogin();
      $this->form_validation->set_rules('country_name', 'Country Name', 'trim|required|xss_clean|');
      if($this->form_validation->run() != false){
         $countryName1=$this->input->post('country_name');
         $date=date('Y:m:d');
         $parameter = array(  'countryName'   => $countryName1,
                              'id'            => 'null',
                              'act_mode'      => 'insertinto',
                              'createdBy'     => 'null',
                              'active'        => '1',
                              'businessId'    => $userId['n_BusinessId'],
                              'adminUser'     => $userId['n_AdminType'],
                              );
          $path  = base_url()."api/business_admin/country/format/json/";
          $response  = curlcall($parameter, $path);
          if($response =='Something Went Wrong'){
                  $this->session->set_flashdata('message','Please check country Name');
                  $base_url  = base_url();
                  redirect($base_url.'business/dashboard/countryadd/');
                  exit();

            }else{
               $this->session->set_flashdata('message','Country name added Successfully');
               $base_url  = base_url();
               redirect($base_url.'business/dashboard/countrylisting/');
               exit();                                   
            }
      }
   }else{
      $this->load->view('layout/header');
      $this->load->view('countryAdd');
      $this->load->view('layout/footer');
   }
   
}

public function editcountry(){
   $this->login_check();
   $userId= checklogin();
  if(isset($_POST['submit'])){
      $this->form_validation->set_rules('country_name', 'Country Name', 'trim|required|xss_clean|');
      if($this->form_validation->run() != false){
         $countryName1=$this->input->post('country_name');
         $countryId=$this->input->post('countryId');
         $date=date('Y:m:d');
        $parameter = array(  'countryName'   => $countryName1,
                              'id'            => $countryId,
                              'act_mode'      => 'update',
                              'createdBy'     => 'null',
                              'active'        => '1',
                              'businessId'    => $userId['n_BusinessId'],
                              'adminUser'     => $userId['n_AdminType'],
                              );
          $path  = base_url()."api/business_admin/country/format/json/";
          $response  = curlcall($parameter, $path);
          if($response =='Something Went Wrong'){
                  $this->session->set_flashdata('message','Please check country Name');
                  $base_url  = base_url();
                  redirect($base_url.'business/dashboard/editcountry/'.$countryId);
                  exit();

            }else{
               $this->session->set_flashdata('message','Country name updated Successfully');
               $base_url  = base_url();
               redirect($base_url.'business/dashboard/countrylisting/');
               exit();                                   
            }
      }
   }else{
      $countryId=$this->uri->segment('4');
      $this->load->view('layout/header');
      $parameter = array(  'countryName'   => 'null',
                              'id'            => $countryId,
                              'act_mode'      => 'editselect',
                              'createdBy'     => 'null',
                              'active'        => '1',
                              'businessId'    => $userId['n_BusinessId'],
                              'adminUser'     => $userId['n_AdminType'],
                              );
      $path  = base_url()."api/business_admin/country/format/json/";
      $response  = curlcall($parameter, $path);
            if($response =='Something Went Wrong'){
                  $this->session->set_flashdata('message','Please check country Name');
                  $base_url  = base_url();
                  redirect($base_url.'business/dashboard/countryadd/');
                  exit();
            }else{
               $data['listing']=$response;
               $this->load->view('editCountry', $data);
               $this->load->view('layout/footer');                      
            }
   }
   
}

public function deletecountry(){
    $this->login_check();
    $userId= checklogin();
    $countryId=$this->uri->segment('4');
    $parameter = array( 'countryName'   => 'null',
                  'id'            => $countryId,
                  'act_mode'      => 'delete',
                  'createdBy'     => 'null',
                  'active'        => '1',
                  'businessId'    => $userId['n_BusinessId'],
                  'adminUser'     => $userId['n_AdminType'],
                  );
      $path  = base_url()."api/business_admin/country/format/json/";
      $response  = curlcall($parameter, $path);
      if($response =='Something Went Wrong'){
                  $this->session->set_flashdata('message','Country Name Already Deleted');
                  $base_url  = base_url();
                  redirect($base_url.'business/dashboard/countrylisting/');
                  exit();
            }else{
              $this->session->set_flashdata('message','Country name deleted Successfully');
               $base_url  = base_url();
               redirect($base_url.'business/dashboard/countrylisting/');
               exit();                                   
            }
}


public function statelisting(){
  $this->login_check();
   $this->load->view('layout/header');
   $userId= checklogin();

   $parameter = array( 'id' => 'null',
                        'b_IsActive' => '1',
                        'n_BusinessId' => $userId['n_BusinessId'],
                        'p_mode' => 'Select',
                        'n_AdminType' => 'null',
                             
                      );
   $path  = base_url()."api/business_admin/state/format/json/";
   $response  = curlcall($parameter, $path);
   
         if($response =='Something Went Wrong'){
               $this->session->set_flashdata('message','Please check state Name');
               $base_url  = base_url();
               redirect($base_url.'business/dashboard/stateadd/');
               exit();
         }else{
            $data['listing']=$response;
            $this->load->view('stateListing', $data);
            $this->load->view('layout/footer');                          
         }
}


public function stateadd(){
   $this->login_check();
   $userId= checklogin();
   if(isset($_POST['submit'])){
      $this->form_validation->set_rules('state_name', 'State Name', 'trim|required|xss_clean|');
      $this->form_validation->set_rules('country_id', 'Country Id', 'trim|required|xss_clean|');

      if($this->form_validation->run() != false){
        
         $stateName=$this->input->post('state_name');
         $countryId=$this->input->post('country_id');
         $date=date('Y:m:d');
         $parameter = array(  'p_mode' => 'Insert',
                               'n_CountryId' => $countryId,
                               'id' => 'null',
                               't_StateName' => $stateName,
                               'n_AdminType' => 'null',
                               'n_BusinessId' => $userId['n_BusinessId'],
                               'n_CreatedBy' => 'null',
                               'n_ModifiedBy' => 'null',
                               'b_IsActive' => '1',
                              );
       
          $path  = base_url()."api/business_admin/state/format/json/";
          $response  = curlcall($parameter, $path);
          if($response =='Something Went Wrong'){
                  $this->session->set_flashdata('message','Please check State/Country Name');
                  $base_url  = base_url();
                  redirect($base_url.'business/dashboard/stateadd/');
                  exit();

            }else{
              $this->session->set_flashdata('message','State name added Successfully');
               $base_url  = base_url();
               redirect($base_url.'business/dashboard/statelisting/');
               exit();                                   
            }
      }
   }else{
         $parameter = array( 'countryName1' => 'null',
                               'd_CreatedOn' => 'null',
                               'id' => 'null',
                               'act_mode' => 'select',
                               'n_CreatedBy' => 'null',
                               'd_ModifiedOn' => 'null',
                               'n_ModifiedBy' => 'null',
                               'b_IsActive' => '1',
                               'n_BusinessId' => $userId['n_BusinessId'],
                               'n_AdminType' => 'null',
                              );
         $path  = base_url()."api/business_admin/country/format/json/";
         $response  = curlcall($parameter, $path);
         if($response =='Something Went Wrong'){
               $this->session->set_flashdata('message','Please check country Name');
               $base_url  = base_url();
               redirect($base_url.'business/dashboard/stateadd/');
               exit();
         }else{
            $data['listing']=$response;
            $this->load->view('layout/header');
            $this->load->view('stateAdd', $data);
            $this->load->view('layout/footer');                        
         }
      
   }
   
}


public function editstate(){
   $this->login_check();
   $userId= checklogin();
  if(isset($_POST['submit'])){
      $this->form_validation->set_rules('state_name', 'State Name', 'trim|required|xss_clean|');
      $this->form_validation->set_rules('country_id', 'Country Id', 'trim|required|xss_clean|');

      if($this->form_validation->run() != false){
         $stateId=$this->input->post('stateId');
         $stateName=$this->input->post('state_name');
         $countryId=$this->input->post('country_id');
         $date=date('Y:m:d');
         $parameter = array(  'p_mode' => 'Update',
                               'n_CountryId' => $countryId,
                               'id' => $stateId,
                               't_StateName' => $stateName,
                               'n_AdminType' => 'null',
                               'n_BusinessId' => $userId['n_BusinessId'],
                               'n_CreatedBy' => 'null',
                               'n_ModifiedBy' => 'null',
                               'b_IsActive' => '1',
                              );
          $path  = base_url()."api/business_admin/state/format/json/";
          $response  = curlcall($parameter, $path);
          if($response =='Something Went Wrong'){
                  $this->session->set_flashdata('message','Please check country/state Name');
                  $base_url  = base_url();
                  redirect($base_url.'business/dashboard/editstate/'.$stateId);
                  exit();

            }else{
               $this->session->set_flashdata('message','State name updated Successfully');
               $base_url  = base_url();
               redirect($base_url.'business/dashboard/statelisting/');
               exit();                                   
            }
      }
   }else{
      $stateId=$this->uri->segment('4');

      $this->load->view('layout/header');
      $parameter = array( 'id' => $stateId,
                          'b_IsActive' => '1',
                          'n_BusinessId' => $userId['n_BusinessId'],
                          'p_mode' => 'Editselect',
                          'n_AdminType' => 'null',
                       );
      $pathState  = base_url()."api/business_admin/state/format/json/";
      $responseState  = curlcall($parameter, $pathState);
      $parameterCountry = array( 'countryName1' => 'null',
                               'd_CreatedOn' => 'null',
                               'id' => 'null',
                               'act_mode' => 'select',
                               'n_CreatedBy' => 'null',
                               'd_ModifiedOn' => 'null',
                               'n_ModifiedBy' => 'null',
                               'b_IsActive' => '1',
                               'n_BusinessId' => $userId['n_BusinessId'],
                               'n_AdminType' => 'null',
                              );
      $pathCountry  = base_url()."api/business_admin/country/format/json/";
      $responseCountry  = curlcall($parameterCountry, $pathCountry);
      if(($responseState =='Something Went Wrong') || ($responseCountry =='Something Went Wrong') ){
                  $this->session->set_flashdata('message','Please check country Name');
                  $base_url  = base_url();
                  redirect($base_url.'business/dashboard/countryadd/');
                  exit();
            }else{
               $data['state']=$responseState;
               $data['country']=$responseCountry;
               $this->load->view('editstate', $data);
               $this->load->view('layout/footer');                      
            }
   }
   
}

public function deletestate(){
   $this->login_check();
   $userId= checklogin();
   $stateId=$this->uri->segment('4');
   $parameter = array(  'p_mode' => 'Delete',
                               'n_CountryId' => 'null',
                               'id' => $stateId,
                               't_StateName' => 'null',
                               'n_AdminType' => 'null',
                               'n_BusinessId' => $userId['n_BusinessId'],
                               'n_CreatedBy' => 'null',
                               'n_ModifiedBy' => 'null',
                               'b_IsActive' => '1',
                              );
      $path  = base_url()."api/business_admin/state/format/json/";
      $response  = curlcall($parameter, $path);
            if($response =='Something Went Wrong'){
                  $this->session->set_flashdata('message','Country Name Already Deleted');
                  $base_url  = base_url();
                  redirect($base_url.'business/dashboard/statelisting/');
                  exit();
            }else{
              $this->session->set_flashdata('message','State name deleted Successfully');
               $base_url  = base_url();
               redirect($base_url.'business/dashboard/statelisting/');
               exit();                                   
            }
  }

  public function citylisting(){
    $this->login_check();
    $this->load->view('layout/header');
    $userId= checklogin();
    $parameter=array(  'p_mode' => 'select',
                       'a_CityId' => 'null',
                       'n_StateId' => 'null',
                       'n_AdminType' => $userId['a_SysAdminId']
                        );
    $path  = base_url()."api/business_admin/city/format/json/";
    $response  = curlcall($parameter, $path);
    if($response =='Something Went Wrong'){
               $this->session->set_flashdata('message','Please check state Name');
               $base_url  = base_url();
               redirect($base_url.'business/dashboard/cityadd/');
               exit();
         }else{
            $data['listing']=$response;
            $this->load->view('cityListing', $data);
            $this->load->view('layout/footer');                          
         }
  }
  // public function getStateDropDown(){

  //   $this->login_check();
  //   $userId= checklogin();
  //   $countryId=$_POST['id'];

  //   $parameter = array( 'id' => $countryId,
  //                       'b_IsActive' => '1',
  //                       'n_BusinessId' => '0',
  //                       'p_mode' => 'Stateselect',
  //                       'n_AdminType' => $userId['a_SysAdminId'],
  //                     );
  //  $path  = base_url()."api/statelisting/state/format/json/";
  //  $response  = curlcall($parameter, $path);
    
  //        if($response =='Something Went Wrong'){
  //              $this->session->set_flashdata('message','Please check state Name');
  //              $base_url  = base_url();
  //              redirect($base_url.'business/dashboard/stateadd/');
  //              exit();
  //        }else{
  //         echo json_encode($response);
           
  //           exit();
  //         }
  // }
  public function cityadd(){
   $this->login_check();
   $userId= checklogin();
   if(isset($_POST['submit'])){
      $this->form_validation->set_rules('city_name', 'City Name', 'trim|required|xss_clean|');
      $this->form_validation->set_rules('state_id', 'State Id', 'trim|required|xss_clean|');
      $this->form_validation->set_rules('country_id', 'Country Id', 'trim|required|xss_clean|');

      if($this->form_validation->run() != false){
         $cityName=$this->input->post('city_name');
         $stateId=$this->input->post('state_id');
         //$countryId=$this->input->post('country_id');
         $date=date('Y:m:d');
         $parameter = array(  'p_mode' => 'insert', 
                               'a_CityId'=>'null',
                               'n_StateId' => $stateId,
                               't_CityName' => $cityName,
                               'n_CreatedBy' => 'null',
                               'n_ModifiedBy' => 'null',
                               'n_Delete'=>'null',
                               'n_AdminType' => "null",
                              );
          $path  = base_url()."api/business_admin/city/format/json/";
          $response  = curlcall($parameter, $path);
         
          if($response =='Something Went Wrong'){
                  $this->session->set_flashdata('message','Please check city/State/Country Name');
                  $base_url  = base_url();
                  redirect($base_url.'business/dashboard/cityadd');
                  exit();

            }else{
              $this->session->set_flashdata('message','City name added Successfully');
               $base_url  = base_url();
               redirect($base_url.'business/dashboard/citylisting/');
               exit();                                   
            }
      }
   }else{
         $parameter = array( 'countryName1' => 'null',
                               'd_CreatedOn' => 'null',
                               'id' => 'null',
                               'act_mode' => 'select',
                               'n_CreatedBy' => 'null',
                               'd_ModifiedOn' => 'null',
                               'n_ModifiedBy' => 'null',
                               'b_IsActive' => '1',
                               'n_BusinessId' => 'null',
                               'n_AdminType' => $userId['a_SysAdminId'],
                              );
         $path  = base_url()."api/business_admin/country/format/json/";
         $response  = curlcall($parameter, $path);
         if($response =='Something Went Wrong'){
               $this->session->set_flashdata('message','Please check country Name');
               $base_url  = base_url();
               redirect($base_url.'business/dashboard/stateadd/');
               exit();
         }else{
            $data['listing']=$response;
            $this->load->view('layout/header');
            $this->load->view('cityAdd', $data);
                                    
         }
      
   }
   
}

public function editcity(){
   $this->login_check();
   $userId= checklogin();
  if(isset($_POST['submit'])){

      $this->form_validation->set_rules('city_name', 'City Name', 'trim|required|xss_clean|');
      $this->form_validation->set_rules('state_id', 'State Id', 'trim|required|xss_clean|');
      $this->form_validation->set_rules('country_id', 'Country Id', 'trim|required|xss_clean|');

      if($this->form_validation->run() != false){
         $cityName=$this->input->post('city_name');
         $stateId=$this->input->post('state_id');
         $cityId=$this->input->post('city_id');
         $date=date('Y:m:d');
         $parameter = array(  'p_mode' => 'Update', 
                               'a_CityId'=>$cityId,
                               'n_StateId' => $stateId,
                               'n_ModifiedBy' => 'null',
                               't_CityName' => $cityName,
                               'n_CreatedBy' => 'null',
                               'n_Delete'=>'null',
                               'n_AdminType' => $userId['a_SysAdminId'],
                              );
         
          $path  = base_url()."api/business_admin/city/format/json/";
          $response  = curlcall($parameter, $path);
         
          if($response =='Something Went Wrong'){
                  $this->session->set_flashdata('message','Please check city/State/Country Name');
                  $base_url  = base_url();
                  redirect($base_url.'business/dashboard/editcity/'.$cityId);
                  exit();

            }else{
              $this->session->set_flashdata('message','City name updated Successfully');
               $base_url  = base_url();
               redirect($base_url.'business/dashboard/citylisting/');
               exit();                                   
            }
      }
   }else{
      $cityId=$this->uri->segment('4');

      $this->load->view('layout/header');
      $parameterCity=array( 'p_mode' => 'Editselect',
                       'a_CityId' => $cityId,
                       'n_StateId' => 'null',
                       'n_AdminType' => $userId['a_SysAdminId']
                        );

      $pathCity  = base_url()."api/business_admin/city/format/json/";
      $responseCity  = curlcall($parameterCity, $pathCity);
      foreach ($responseCity as $key => $value) {
        $countryId=$value->n_CountryId;
      }

      $parameterState = array( 'id' => $countryId,
                        'b_IsActive' => '1',
                        'n_BusinessId' => '0',
                        'p_mode' => 'Stateselect',
                        'n_AdminType' => $userId['a_SysAdminId'],
                      );
       $pathstate  = base_url()."api/business_admin/state/format/json/";
       $responseState  = curlcall($parameterState, $pathstate);
       $parameterCountry = array( 'countryName1' => 'null',
                               'd_CreatedOn' => 'null',
                               'id' => 'null',
                               'act_mode' => 'select',
                               'n_CreatedBy' => 'null',
                               'd_ModifiedOn' => 'null',
                               'n_ModifiedBy' => 'null',
                               'b_IsActive' => '1',
                               'n_BusinessId' => 'null',
                               'n_AdminType' => $userId['a_SysAdminId'],
                              );
      $pathCountry  = base_url()."api/business_admin/country/format/json/";
      $responseCountry  = curlcall($parameterCountry, $pathCountry);
      if(($responseCity =='Something Went Wrong') || ($responseCountry =='Something Went Wrong') || ($responseState =='Something Went Wrong')){
                  $this->session->set_flashdata('message','Please check country Name');
                  $base_url  = base_url();
                  redirect($base_url.'business/dashboard/countryadd/');
                  exit();
            }else{
               $data['city']=$responseCity;
               $data['state']=$responseState;
               $data['country']=$responseCountry;
               $this->load->view('editCity', $data);
               //$this->load->view('layout/footer');                      
            }
   }
   
}


public function deletecity(){
   $this->login_check();
   $userId= checklogin();
   $cityId=$this->uri->segment('4');

$parameter = array( 'p_mode' => 'delete', 
                   'a_CityId'=>$cityId,
                   'n_StateId' => 'null',
                   'n_ModifiedBy' => 'null',
                   't_CityName' => 'null',
                   'n_CreatedBy' => 'null',
                   'n_Delete'=>'null',
                   'n_AdminType' => $userId['a_SysAdminId'],
                  );
    // p($parameter);
    // exit();
      $path  = base_url()."api/business_admin/city/format/json/";
      $response  = curlcall($parameter, $path);
    
            if($response =='Something Went Wrong'){
                  $this->session->set_flashdata('message','City Name Already Deleted');
                  $base_url  = base_url();
                  redirect($base_url.'business/dashboard/citylisting/');
                  exit();
            }else{
              $this->session->set_flashdata('message','City name deleted Successfully');
               $base_url  = base_url();
               redirect($base_url.'business/dashboard/Citylisting/');
               exit();                                   
            }
  }

  public function currencylisting(){
   $this->login_check();
   $this->load->view('layout/header');
   $userId= checklogin();

   $parameter = array( 'id' => 'null',
                        'b_IsActive' => '1',
                        'n_BusinessId' => '0',
                        'p_mode' => 'Select',
                        'n_AdminType' => $userId['a_SysAdminId'],
                     );
   $path  = base_url()."api/business_admin/currency/format/json/";
   $response  = curlcall($parameter, $path);
   
         if($response =='Something Went Wrong'){
               $this->session->set_flashdata('message','Please Check Currency Name');
               $base_url  = base_url();
               redirect($base_url.'business/dashboard/currencyadd/');
               exit();
         }else{
            $data['listing']=$response;
            $this->load->view('currencyListing', $data);
            $this->load->view('layout/footer');                          
         }
}

public function currencyadd(){
   $this->login_check();
   $userId= checklogin();
   if(isset($_POST['submit'])){
      $this->form_validation->set_rules('currency_name', 'State Name', 'trim|required|xss_clean|');
      $this->form_validation->set_rules('country_id', 'Country Id', 'trim|required|xss_clean|');

      if($this->form_validation->run() != false){
        
         $currency_name=$this->input->post('currency_name');
         $countryId=$this->input->post('country_id');
         $date=date('Y:m:d');
         $parameter = array(  'p_mode' => 'Insert',
                              'a_CurrencyId' => 'null',
                               'n_CountryId' => $countryId,
                               't_CurrencyName' => addslashes($currency_name),
                               'n_CreatedBy' => 'null',
                               'n_ModifiedBy' => 'null',
                               'b_IsActive' => '1',
                               'n_BusinessId' => 'null',
                               'n_AdminType' => $userId['a_SysAdminId'],
                              );
          $path  = base_url()."api/business_admin/currency/format/json/";
          $response  = curlcall($parameter, $path);
          if($response =='Something Went Wrong'){
                  $this->session->set_flashdata('message','Please check Currency/Country Name');
                  $base_url  = base_url();
                  redirect($base_url.'business/dashboard/currencyadd/');
                  exit();

            }else{
              $this->session->set_flashdata('message','Currency name added Successfully');
               $base_url  = base_url();
               redirect($base_url.'business/dashboard/currencylisting/');
               exit();                                   
            }
      }
   }else{
         $parameter = array( 'countryName1' => 'null',
                               'd_CreatedOn' => 'null',
                               'id' => 'null',
                               'act_mode' => 'select',
                               'n_CreatedBy' => 'null',
                               'd_ModifiedOn' => 'null',
                               'n_ModifiedBy' => 'null',
                               'b_IsActive' => '1',
                               'n_BusinessId' => 'null',
                               'n_AdminType' => $userId['a_SysAdminId'],
                              );
         $path  = base_url()."api/business_admin/country/format/json/";
         $response  = curlcall($parameter, $path);
         if($response =='Something Went Wrong'){
               $this->session->set_flashdata('message','Please check country Name');
               $base_url  = base_url();
               redirect($base_url.'business/dashboard/currecnyadd/');
               exit();
         }else{
            $data['listing']=$response;
            $this->load->view('layout/header');
            $this->load->view('currencyAdd', $data);
            $this->load->view('layout/footer');                        
         }
      
   }
   
}


public function editcurrency(){
   $this->login_check();
   $userId= checklogin();
  if(isset($_POST['submit'])){
      $this->form_validation->set_rules('currency_name', 'Currency Name', 'trim|required|xss_clean|');
      $this->form_validation->set_rules('country_id', 'Country Id', 'trim|required|xss_clean|');

      if($this->form_validation->run() != false){
         $currencyId=$this->input->post('currency_id');
         $currencyName=$this->input->post('currency_name');
         $countryId=$this->input->post('country_id');
         $date=date('Y:m:d');
          $parameter = array(  'p_mode' => 'Update',
                               'a_CurrencyId' => $currencyId,
                               'n_CountryId' => $countryId,
                               't_CurrencyName' => addslashes($currencyName),
                               'n_CreatedBy' => 'null',
                               'n_ModifiedBy' => 'null',
                               'b_IsActive' => '1',
                               'n_BusinessId' => 'null',
                               'n_AdminType' => $userId['a_SysAdminId'],
                              );
          $path  = base_url()."api/business_admin/currency/format/json/";
          $response  = curlcall($parameter, $path);
          if($response =='Something Went Wrong'){
                  $this->session->set_flashdata('message','Please check country/Currency Name');
                  $base_url  = base_url();
                  redirect($base_url.'business/dashboard/editcurrency/'.$currencyId);
                  exit();

            }else{
               $this->session->set_flashdata('message','Currency name updated Successfully');
               $base_url  = base_url();
               redirect($base_url.'business/dashboard/currencylisting/');
               exit();                                   
            }
      }
   }else{
      $currencyId=$this->uri->segment('4');

      $this->load->view('layout/header');
      $parameterCurrency = array( 'p_mode' => 'Editselect',
                                  'a_CurrencyId' => $currencyId,
                                  'b_IsActive' => '1',
                                  'n_BusinessId' => '0',
                                  'n_AdminType' => $userId['a_SysAdminId'],
                                );
      $pathCurrency  = base_url()."api/business_admin/currency/format/json/";
      $responseCurrency  = curlcall($parameterCurrency, $pathCurrency);
      $parameterCountry = array( 'countryName1' => 'null',
                               'd_CreatedOn' => 'null',
                               'id' => 'null',
                               'act_mode' => 'select',
                               'n_CreatedBy' => 'null',
                               'd_ModifiedOn' => 'null',
                               'n_ModifiedBy' => 'null',
                               'b_IsActive' => '1',
                               'n_BusinessId' => 'null',
                               'n_AdminType' => $userId['a_SysAdminId'],
                              );
      $pathCountry  = base_url()."api/business_admin/country/format/json/";
      $responseCountry  = curlcall($parameterCountry, $pathCountry);
      if(($responseCurrency =='Something Went Wrong') || ($responseCountry =='Something Went Wrong') ){
                  $this->session->set_flashdata('message','Please check country Name');
                  $base_url  = base_url();
                  redirect($base_url.'business/dashboard/currencyadd/');
                  exit();
            }else{
               $data['currency']=$responseCurrency;
               $data['country']=$responseCountry;
               $this->load->view('editCurrency', $data);
               $this->load->view('layout/footer');                      
            }
   }
   
}

public function deletecurrency(){
   $this->login_check();
   $userId= checklogin();
   $currencyId=$this->uri->segment('4');
        $parameter = array(  'p_mode' => 'Delete',
                               'a_CurrencyId' => $currencyId,
                               'n_CountryId' => 'null',
                               't_CurrencyName' => 'null',
                               'n_CreatedBy' => 'null',
                               'n_ModifiedBy' => 'null',
                               'b_IsActive' => '1',
                               'n_BusinessId' => 'null',
                               'n_AdminType' => $userId['a_SysAdminId'],
                              );
      $path  = base_url()."api/business_admin/currency/format/json/";
      $response  = curlcall($parameter, $path);
      if($response =='Something Went Wrong'){
                  $this->session->set_flashdata('message','Currency Name Already Deleted');
                  $base_url  = base_url();
                  redirect($base_url.'business/dashboard/currencylisting/');
                  exit();
            }else{
              $this->session->set_flashdata('message','Currency name deleted Successfully');
               $base_url  = base_url();
               redirect($base_url.'business/dashboard/currencylisting/');
               exit();                                   
            }
  }


  public function dmlisting(){
   $this->login_check();
   $this->load->view('layout/header');
   $userId= checklogin();
   $parameter = array( 'p_mode' => 'Select',
                        'a_SettingId' => 'null',
                        'n_BusinessId' => 'null',
                        'n_EnumId' => '4',
                        'n_AdminType' => $userId['a_SysAdminId'],
                        );
   // api call starts
   $path  = base_url()."api/business_admin/dm/format/json/";
   $response  = curlcall($parameter, $path);
   // api call ends
        if($response =='Something Went Wrong'){
               $this->session->set_flashdata('message','Please check Measurement Name');
               $base_url  = base_url();
               redirect($base_url.'business/dashboard/dmadd/');
               exit();
         }else{
            $data['listing']=$response;
            $this->load->view('dmListing', $data);
            $this->load->view('layout/footer');                          
         }
}


public function dmadd(){
   $this->login_check();
   if(isset($_POST['submit'])){
      $userId= checklogin();
      $enumTypeId=$this->input->post('enum_type_id');
     
      $this->form_validation->set_rules('dm_name', 'Distance Measurement Name', 'trim|required|xss_clean|');
      if($this->form_validation->run() != false){
         
         $typeId=$this->input->post('type_id');
         $dmName=$this->input->post('dm_name');
         $parameter = array( 'p_mode' => 'Insert',
                              'a_SettingId' => 'null',
                              'n_EnumId' => $enumTypeId,
                              't_SettingValue' => $dmName,
                              'n_CreatedBy' => 'null',
                              'b_IsActive' => '1',
                              'n_BusinessId' => 'null',
                              'n_AdminType' => $userId['a_SysAdminId'],
                              );
          $path  = base_url()."api/business_admin/dm/format/json/";
          $response  = curlcall($parameter, $path);
          if($response =='Something Went Wrong'){
                  $this->session->set_flashdata('message','Please check Measurement Name');
                  $base_url  = base_url();
                  redirect($base_url.'business/dashboard/dmAdd/');
                  exit();

            }else{
               $this->session->set_flashdata('message','Distance Measurement name added Successfully');
               $base_url  = base_url();
               redirect($base_url.'business/dashboard/dmlisting/');
               exit();                                   
            }
      }
   }else{
              
              $this->load->view('layout/header');
              $this->load->view('dmAdd');
   }
   
}

public function editdm(){
   $this->login_check();
   $userId= checklogin();
  if(isset($_POST['submit'])){
      $enumTypeId=$this->input->post('enum_type_id');
      $settingId=$this->input->post('dm_id');
     $this->form_validation->set_rules('dm_name', 'Distance Measurement Name', 'trim|required|xss_clean|');
      if($this->form_validation->run() != false){
         $dmName=$this->input->post('dm_name');
         $parameter = array( 'p_mode' => 'Update',
                              'a_SettingId' => $settingId,
                              'n_EnumId' => $enumTypeId,
                              't_SettingValue' => $dmName,
                              'n_CreatedBy' => 'null',
                              'b_IsActive' => '1',
                              'n_BusinessId' => "null",
                              'n_AdminType' => $userId['a_SysAdminId'],
                              );
        
          $path  = base_url()."api/business_admin/dm/format/json/";
          $response  = curlcall($parameter, $path);
          if($response =='Something Went Wrong'){
                  $this->session->set_flashdata('message','Please check Measurement Name');
                  $base_url  = base_url();
                  redirect($base_url.'business/dashboard/editdm/'.$dmId);
                  exit();

            }else{
               $this->session->set_flashdata('message','Distance Measurement name updated Successfully');
               $base_url  = base_url();
               redirect($base_url.'business/dashboard/dmlisting/');
               exit();                                   
            }
      }
   }else{
      $dmSettingId=$this->uri->segment('4');
      $this->load->view('layout/header');
      $parameter = array( 'p_mode' => 'Editselect',
                        'a_SettingId' => $dmSettingId,
                        'n_BusinessId' => 'null',
                        'n_EnumId' => '4',
                        'n_AdminType' => $userId['a_SysAdminId'],
                        );
      $path  = base_url()."api/business_admin/dm/format/json/";
      $response  = curlcall($parameter, $path);
      if($response =='Something Went Wrong'){
                  $this->session->set_flashdata('message','Please check Measurement Name');
                  $base_url  = base_url();
                  redirect($base_url.'business/dashboard/dmadd/');
                  exit();
            }else{
               $data['listing']=$response;
               $this->load->view('editDm', $data);
               $this->load->view('layout/footer');                      
            }
   }
   
}

public function deletedm(){
   $this->login_check();
   $userId= checklogin();
   $dmSettingId=$this->uri->segment('4');
   $parameter = array( 'p_mode' => 'Delete',
                              'a_SettingId' => $dmSettingId,
                              'n_EnumId' => "null",
                              't_SettingValue' => 'null',
                              'n_CreatedBy' => 'null',
                              'b_IsActive' => '1',
                              'n_BusinessId' => "null",
                              'n_AdminType' => $userId['a_SysAdminId'],
                              );
      $path  = base_url()."api/business_admin/dm/format/json/";
      $response  = curlcall($parameter, $path);
            if($response =='Something Went Wrong'){
                  $this->session->set_flashdata('message','Measurement Name Already Deleted');
                  $base_url  = base_url();
                  redirect($base_url.'business/dashboard/dmlisting/');
                  exit();
            }else{
              $this->session->set_flashdata('message','Distance Measurement name deleted Successfully');
               $base_url  = base_url();
               redirect($base_url.'business/dashboardd/dmlisting/');
               exit();                                   
            }
}

public function getDepartmentName($id){
  $this->login_check();
  $userId= checklogin();
  $parameter=array( 'p_mode'            => 'SelectdeptName',
                    'p_deptId'          => $id,
                    'p_BusinessId'      => $userId['n_BusinessId']
                    );

  $path=base_url()."api/business_admin/dept/format/json/";
  $response = curlcall($parameter , $path);
  
  if($response=='Something Went Wrong'){
      $data['deptName']='';
  }else{
    $deptName=$response->t_DeptName;
  }

  return $deptName;
}


 public function getStateDropDown(){

    $this->login_check();
    $userId= checklogin();
    $countryId=$_POST['id'];
    $parameterState = array('id' => $countryId,
                            'b_IsActive' => '1',
                            'n_BusinessId' => $userId['n_BusinessId'],
                            'p_mode' => 'Stateselect',
                            'n_AdminType' => 33,
                          );
   $pathState  = base_url()."api/business_admin/state/format/json/";
   $responseState  = curlcall($parameterState, $pathState);
    
         if($responseState =='Something Went Wrong'){
              $responseState="";
         }else{
          echo json_encode($responseState);
           
            exit();
          }
  }


  public function getCityDropDown(){
  $this->login_check();
  $userId= checklogin();
  $parameter =array(  'p_mode' => 'CitySelect',
                       'p_id' => 'null',
                       'p_stateId' => $_POST['id'],
                       'p_BusinessId' => $userId['n_BusinessId'],
                       'p_admin' => 33
                        );
  $path  = base_url()."api/business_admin/city/format/json/";
  $response  = curlcall($parameter, $path);
  if($response =='Something Went Wrong'){
              $data='';
   }else{
    echo json_encode($response);
    exit();
    }
  }
public function profile(){

     $userId= checklogin();
     $data = businesschecklogin();
     $busId = $data['n_BusinessId'];
      $parameter=array(
                            'countryName' => '',
                            'id'          => '',
                            'act_mode'    => 'select',
                            'createdBy'   => '',
                            'active'      => 1,
                            'businessId'  => $busId,
                            'adminUser'   => '',
                            );

          $path=base_url()."api/business_admin/country/format/json/";
          $responseCountry = curlcall($parameter , $path);
          if($responseCountry=='Something Went Wrong'){
              $data['country']='';
          }else{
            $data['country']=$responseCountry;
          }
          $Id = $data['businessUserId'];
            $this->load->view('layout/header');
            $parameter =  array('bid'      => $Id ,
                                'bdob'     =>'',
                                'bphone'   => '',
                                'bmobile'  => '',
                                'baddress' => '',
                                'bcountry' => '',
                                'bstate'   =>'',
                                'bcity'    => '',
                                'bpin'     => '',
                                'bseq'     => '',
                                'act_mode' => 'view' );
            $path  = base_url()."api/business_admin/profile/format/json/";
            $profileDataResponse= curlcall($parameter, $path);
            // p($profileDataResponse);
            // exit();
            if($profileDataResponse=='Something Went Wrong'){
              $data['bprofile']='';
            }else{
              $data['deptName']=$this->getDepartmentName($profileDataResponse->n_DeptId);
              $data['state']=$this->getDepartmentName($profileDataResponse->n_DeptId);
              $data['bprofile']=$profileDataResponse;
            }

            if(isset($_POST['submit'])){  
                $address= $this->input->post('address_line1').'___'.$this->input->post('address_line2').'___'.$this->input->post('address_line3');
                $parameter =  array(
                                  'bid'      => $Id ,
                                  'bdob'     => $this->input->post('date_of_birth'),
                                  'bphone'   => $this->input->post('office_phone'),
                                  'bmobile'  => $this->input->post('mobile_phone'),
                                  'baddress' => $address,
                                  'bcountry' => $this->input->post('n_CountryId_1'),
                                  'bstate'   => $this->input->post('n_StateId'),
                                  'bcity'    => $this->input->post('n_City'),
                                  'bpin'     => $this->input->post('pin_code'),
                                  'bseq'     => $this->input->post('seq_code'),
                                  'act_mode' => 'pupdate' 
                                  );
                  $path  = base_url()."api/business_admin/profileupdate/format/json/";
                  $response= curlcall($parameter, $path);
                  if($response !=1){
                    $this->session->set_flashdata('message','Something went Wrong');
                    $base_url  = base_url();
                    redirect($base_url.'business/dashboard/profile/');
                    exit(); 
                  }else{
                    $this->session->set_flashdata('message','Updated Successfully');
                    $base_url  = base_url();
                    redirect($base_url.'business/dashboard/profile/');
                    exit(); 
                  }
              }
      $this->load->view('profile',$data);
  }

  public function mileage(){
  	$this->load->view('layout/header');
  	$this->load->view('policyEditCreatemileage');	
  	$this->load->view('layout/footer');
  }

  public function spendinglimit(){
  	$this->load->view('layout/header');
  	$this->load->view('spendinglimit');	
  	$this->load->view('layout/footer');
  }

  public function restriction(){
  	$this->load->view('layout/header');
  	$this->load->view('policyspendingrestrictions');	
  	$this->load->view('layout/footer');
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
		redirect($data);
		exit();
	}


  function view_business_admin()
  {
       $this->login_check();
       $userId= checklogin();
       $data = businesschecklogin();
       $id=$data['n_BusinessId'];

       $parameter = array(
                          'busid' => $id ,
                           );
      
       $path  = base_url()."api/business_admin_2/view_business_create_admin/format/json/";
       $response  = curlcall($parameter, $path);
       $data['busdetail']=$response;
       $this->load->view('businessLeft');

}

// public function searchBusinessName(){
//   $this->login_check();
//   $userId= checklogin();
//   $data = businesschecklogin();
//   $id=$data['n_BusinessId'];
//   $firstname=$_POST['name'];
  
//   if(!empty($_POST['name'])){
//     $parameter=array( 'bid'      => $id,
//                       'bname'    => $firstname,
//                       'act_mode' => 'searchbusname',
                      
//                       );
//   }else{
//     $parameter=array( 'bid'      => $id,
//                       'bname'    => '',
//                       'act_mode' => 'searchbusname',  
//                     );
//    }
//   $path  = base_url()."api/business_admin_2/viewbusname/format/json/";
//   $response  = curlcall($parameter, $path);
//   if($response =='Something Went Wrong'){
//         //echo json_encode(array('t_EmpFirstName'));

//     }else{
//         echo json_encode($response);
//     }
// }

// end of the class    
}
 