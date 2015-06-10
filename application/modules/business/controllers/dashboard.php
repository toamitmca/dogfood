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

public function searchReport_advanse(){
       if($this->input->post('b_submited') !==''){
        $sum = str_replace(","," ",$this->input->post('b_submited'));
        $p_sdate= date('Y-m-d',strtotime($sum));
          }
          else{
           $p_sdate=''; 
          }
 if($this->input->post('to_claim') !=='' && $this->input->post('from_claim') !==''){
     $to = str_replace(","," ",$this->input->post('to_claim'));
       $p_claimto=date('Y-m-d', strtotime($to));
       $from = str_replace(","," ",$this->input->post('from_claim'));
       $p_claomfrom=date('Y-m-d', strtotime($from));
}
  else{
$p_claimto='';
$p_claomfrom='';
  }
   $userId= checklogin();
  if($userId['businessUserDeptId']=null){
$p_DeptId='';
  }
  else{
    $p_DeptId=$userId['businessUserDeptId'];
  }



                           $parameter = array(
                          'act_mode' =>$_POST['act_mode'],
                          'businessid' =>$userId['n_BusinessId'],
                          'empname' =>$_POST['empname'],
                           'status' =>$_POST['status'],
                           'b_submited' =>$p_sdate ,
                           'to_claim' =>$p_claimto ,
                           'from_claim' =>$p_claomfrom,
                           'p_n_DeptId'=>$p_DeptId
                             );
//p($parameter);
//exit;

     $pathReportSide  = base_url()."api/business_admin/ssarepotsearch/format/json/";
       $rep_response  = curlcall($parameter, $pathReportSide);
       $i=0;
       if($rep_response =='Something Went Wrong'){
        //echo json_encode(array('t_EmpFirstName'));
    }
    else{
        foreach ($rep_response as $key => $value) {
          $arr[$i]['a_ReportId']=$value->a_ReportId;
          $arr[$i]['t_ReportName']=$value->t_ReportName;
          $arr[$i]['n_ReportTypeId']=$value->n_ReportTypeId;
          $arr[$i]['d_ClaimFrom']=date('d M, Y', strtotime($value->d_ClaimFrom));
          $arr[$i]['d_ClaimTo']=date('d M, Y', strtotime($value->d_ClaimTo));
          $arr[$i]['n_CashAdvance']=$value->n_CashAdvance;
          $arr[$i]['n_PreExpAmt']=$value->n_PreExpAmt;
          $arr[$i]['d_CreatedOn']=date('d M, Y', strtotime($value->d_CreatedOn));
          $arr[$i]['b_IsVoilated']=$value->b_IsVoilated;
          $arr[$i]['t_EmpFirstName']=$value->t_EmpFirstName;
          $arr[$i]['t_EmpLastName']=$value->t_EmpLastName;
           $arr[$i]['n_AmountReq']=$value->n_AmountReq;
           $arr[$i]['d_submitedon']=$value->d_submitedon;
            $i++;
        }
        echo json_encode($arr);
    }



}


public function test(){
/*$userId= checklogin();
echo $userId['businessUserDeptId'];
 if( empty($userId['businessUserDeptId'])){
              $p_DeptId='';
              }
              else{
              $p_DeptId=$userId['businessUserDeptId'];
              }

echo $p_DeptId;

$parameter = array(
                          'act_mode' =>'by_business',
                          'businessid' =>$userId['n_BusinessId'],
                          'empname' =>'',
                           'status' =>'',
                           'b_submited' =>'',
                           'to_claim' =>'' ,
                           'from_claim'=>'',
                           'p_n_DeptId'=>''
                             );
p($parameter);
     $pathReportSide  = base_url()."api/business_admin/ssarepotsearch/format/json/";
       $responseReport  = curlcall($parameter, $pathReportSide);
p($responseReport);



p($this->session->all_userdata());
exit;
*/
}









public function searchReport(){
  $this->login_check();
  $userId= checklogin();
  if(!empty($_POST['id'])){
    $parameter=array(   'p_mode' => 'EmpIdBasedReport',
                        'p_BusinessId' => $userId['n_BusinessId'],
                        'p_EmpId' => $_POST['id'],
                        'p_DeptId' => $userId['businessUserDeptId'],
                        );
  $path = base_url()."api/business_admin/claimReport/format/json/";
  }else{
    $parameter=array( 'p_mode'        => 'select',
                      'p_BusinessId'  => $userId['n_BusinessId'],
                      'p_DeptId'      => $userId['businessUserDeptId'],
                    );
    $path  = base_url()."api/business_admin/claimReport/format/json/";
   }

   //p($parameter); exit();
  $response  = curlcall($parameter, $path);
  $i=0;
  if($response =='Something Went Wrong'){
        //echo json_encode(array('t_EmpFirstName'));

    }else{
        foreach ($response as $key => $value) {
          $arr[$i]['a_ReportId']=$value->a_ReportId;
          $arr[$i]['t_ReportName']=$value->t_ReportName;
          $arr[$i]['n_ReportTypeId']=$value->n_ReportTypeId;
          $arr[$i]['d_ClaimFrom']=date('d M, Y', strtotime($value->d_ClaimFrom));
          $arr[$i]['d_ClaimTo']=date('d M, Y', strtotime($value->d_ClaimTo));
          $arr[$i]['n_CashAdvance']=$value->n_CashAdvance;
          $arr[$i]['n_PreExpAmt']=$value->n_PreExpAmt;
          $arr[$i]['d_CreatedOn']=date('d M, Y', strtotime($value->d_CreatedOn));
          $arr[$i]['b_IsVoilated']=$value->b_IsVoilated;
          $arr[$i]['t_EmpFirstName']=$value->t_EmpFirstName;
          $arr[$i]['t_EmpLastName']=$value->t_EmpLastName;
           $arr[$i]['n_AmountReq']=$value->n_AmountReq;
           $arr[$i]['d_submitedon']=$value->d_submitedon;
            $i++;
        }
        echo json_encode($arr);
    }
}


public function delete_dpt(){
                        $data = businesschecklogin();
                        $busid = $data['n_BusinessId'];
                        $userId= checklogin();
                        $userid=$userId['businessUserId'];

                  $parameter = array(
                    'act_mode'      => $_POST['act_mode'] ,
                    'businessid'    => $busid,
                    'id'           => $_POST['id'],
                    'userid'      => $userid );

                // p($parameter);
                  //exit;

$path  = base_url()."api/business_admin/dptmtctagspcatdelte/format/json/";
          $response  = curlcall($parameter, $path);
          //p($response);
          echo json_encode($response);



}


  public function customtag_add(){
                        $data = businesschecklogin();
                        $Id = $data['n_BusinessId'];
                        $userId= checklogin();
                        $userid=$userId['businessUserId'];

              function unique_multidim_array($array, $key){
                                    $temp_array = array();
                                    $i = 0;
                                   $key_array = array();

                                  foreach($array as $val){
                                  if(!in_array($val[$key],$key_array)){
                                  $key_array[$i] = $val[$key];
                                  $temp_array[$i] = $val;
                                  }
                                  $i++;
                                   }
                               return $temp_array;
                               }


                             $details = unique_multidim_array($_POST['t_PolicyName'],'t_customtag');


                        $xml =htmlentities("<NewDataSet>");
                      //  foreach ($_POST as $key => $value1) {
                        foreach ($details as $key => $value) {
                       // foreach ($value1 as $key => $value_unia) {


                       //if($value['t_customtag'] !==$value_unia['t_customtag']) {

                        if(!empty($value['t_customtag'])&&!empty($value['t_glcode'])&&($value['flag']==1)){
                        $xml .=htmlentities('<tblcustomtag><t_CustText>'.$value['t_customtag'].'</t_CustText>
                                             <t_CustValue>'.$value['t_glcode'].'</t_CustValue>
                                               </tblcustomtag>');
                        }

                      //   }

                      // }
                       // }
                        }
                   $xml .=htmlentities("</NewDataSet>");
           $parameter = array(  'p_mode' => 'Insert',
                               'p_DeptId' => '1',
                               'p_XmlData_cat' => (html_entity_decode($xml, ENT_QUOTES, 'UTF-8')),
                               'p_AdminType' => '22',
                               'p_BusinessId' => $Id,
                               'p_CreatedBy' => $userid,
                               'tag_type' => $_POST['c_tag']
                             );


          $path  = base_url()."api/business_admin/businesscustomtag/format/json/";
          $response  = curlcall($parameter, $path);
  }

  public function editsptext(){
     // print_r($_POST);
     // exit;

      $parameter=  array('act_mode'    =>$_POST['act_mode'] ,
                           'cat_glcod' =>$_POST['newglcode'],
                           'testname'  =>$_POST['newglcode'],
                            'id'       =>$_POST['id']);
      $path  = base_url()."api/business_admin/updatglcodetext/format/json/";
                          $response= curlcall($parameter, $path);

    }

public function addRemember(){
        $data = businesschecklogin();
        $Id = $data['n_BusinessId'];
        $parameter = array('n_BusinessId' => $Id,
        'remenber' =>$_POST['remenbmt']);
        $path  = base_url()."api/business_admin/addremembermt/format/json/";
        $response  = curlcall($parameter, $path);
        if($response=='Something Went Wrong'){
         
        }else{
          echo json_encode($response);
          exit();
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
/*2nd phase by rahul yadav  13/12/2014*/
 $userid= $this->session->userdata['sessionData']['businessUserId'];
 $parameter = array('act_mode'=>'businessadmin' , 'userid'=>$userid);
           $path       = base_url().'api/createbusinessadmin/firstloginpasschange/format/json/';
           $firstlogin= curlcall($parameter, $path);

           if($firstlogin->fpasschange==0)
          {
            redirect($base_url.'business/resetpass');
            exit();
          }
          if($firstlogin->fpasschange==2){
          redirect($base_url.'business/resetpass');
          exit();
                 }
          if($firstlogin->fpasschange==3){
          redirect($base_url.'business/dashboard/profile');
          exit();
                 }

 $userId= checklogin();

  $parameteraccess = array('e_Id' =>'' , 'act_mode' =>'viewaccessbyid' , 'e_UserId' => $userid );
  $pathaccess = base_url()."api/business_admin/myaccess/format/json/";
  $data['myaccess'] = curlcall($parameteraccess, $pathaccess);

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

               if(empty($userId['businessUserDeptId'])){
              $p_DeptId='';
              }
              else{
              $p_DeptId=$userId['businessUserDeptId'];
              }

                         $parameter = array(
                          'act_mode' =>'by_business',
                          'businessid' =>$userId['n_BusinessId'],
                          'empname' =>'',
                           'status' =>'',
                           'b_submited' =>'',
                           'to_claim' =>'' ,
                           'from_claim'=>'',
                           'p_n_DeptId'=>$p_DeptId
                             );

							 
							 
							 
						
							 
     $pathReportSide  = base_url()."api/business_admin/ssarepotsearch/format/json/";
       $responseReport  = curlcall($parameter, $pathReportSide);

        if($responseReport =='Something Went Wrong'){
             $data['sideReport']='';
         }else{
            $data['sideReport']=$responseReport;
        }
      $this->load->view('employee_view_report',$data);
}

public function get_vilation(){
$parameter = array('row_id'=>$this->input->post('n_ReportId') , 'act_mode' =>'view');

$pathReportSide  = base_url()."api/employeereport/expvoilations/format/json/";
       $report_vilation  = curlcall($parameter, $pathReportSide);
echo json_encode($report_vilation);
}



public function detailReports(){
  $this->login_check();
  $userId= checklogin();


  $userFirstName=$userId['businessFirstName'];
  $userLastName=$userId['businessLastName'];
  $data['firstBusName']=$userFirstName;
  $data['lastBusName']=$userLastName;
  $data['businessId']=$userId['businessUserId'];

  $reportId=$this->uri->segment('4');
   $deptid=$this->uri->segment('5');
  $this->load->view('layout/header');
    $parameterSide=array( 'p_mode' => 'SelectList',
                          'p_BusinessId' => $userId['n_BusinessId'],
                          'p_EmpId' => 'null',
                          'p_FirstName' => 'null',
                          'p_LastName' => 'null'
                          );
    // p($parameterSide); exit();
      $pathSide  = base_url()."api/business_admin/addemp/format/json/";
      $responseSide  = curlcall($parameterSide, $pathSide);
      if($responseSide =='Something Went Wrong'){
               $this->session->set_flashdata('message','Please check Role Name');
              $data['sideEmpName']='';
         }else{
            $data['sideEmpName']=$responseSide;
        }


      $parameterReportSide=array( 'p_mode' => 'select',
                                  'p_BusinessId' => $userId['n_BusinessId'],
                                  'p_DeptId' => $deptid,
                                );
     // p($parameterReport);
        $pathReportSide  = base_url()."api/business_admin/claimReport/format/json/";
        $responseReportSide  = curlcall($parameterReportSide, $pathReportSide);
        if($responseReportSide =='Something Went Wrong'){
              $data['sideReport']='';
         }else{
            $data['sideReport']=$responseReportSide;
           // p($responseReportSide); exit();
        }

        $parameterReport=array( 'p_mode' => 'editselect',
                                'p_reportId' => $reportId,
                                'p_BusinessId' => $userId['n_BusinessId'],
                                'p_DeptId' => $deptid,
                                );
        $pathReport  = base_url()."api/business_admin/claimReport/format/json/";
        $responseReport  = curlcall($parameterReport, $pathReport);
//p($parameterReport);
//p($responseReport);
//exit;
        if($responseSide =='Something Went Wrong'){
                  $data['report']="";
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
    
//p($policyExpense);
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
              redirect($base_url.'business/dashboard/claimReportList/');
               exit();
         }else{
            $data['policyName']=$policyName;
        }

      $this->load->view('employee_detail_view_report',$data);
}


public function addNotes(){

 $this->login_check();
  $userId= checklogin();

  $adminid=$userId['businessUserId'];
    $parameter = array( 'act_mode'     => 'insert' ,
                      's_reportid'   => $this->input->post('reportid') ,
                    's_note'       => $this->input->post('noteval') ,
                    's_type'       => 'Admin',
                    's_cretaedby'  => $adminid ,
                    's_busid'      => $adminid );

// p($parameter);
// exit;
        $pathReportSide  = base_url()."api/business_admin/savemynotessa/format/json/";
        $response  = curlcall($parameter, $pathReportSide);
       
        echo json_encode($response);
        exit();

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


 public function rimburseReport()
 {
    $this->login_check();
    $userId1= checklogin();
    $reportid=$this->uri->segment(4);
    $userid= $this->session->userdata['sessionData']['businessUserId'];

    $parameteraccess = array('e_Id' =>'' , 'act_mode' =>'viewaccessbyid' , 'e_UserId' => $userid );
    $pathaccess = base_url()."api/business_admin/myaccess/format/json/";
    $data['myaccess'] = curlcall($parameteraccess, $pathaccess);
   

    $parameterrim = array('e_id' => $reportid , 'act_mode' =>'update' , 'e_UserId' => $userid );
    $pathrim = base_url()."api/business_admin/updaterim/format/json/";
    $data = curlcall($parameterrim, $pathrim);
     if($data =='Something Went Wrong'){
               $this->session->set_flashdata('message','Updated Successfully');
                $base_url  = base_url();
                redirect($base_url.'business/dashboard/claimReportList/');
               
               exit();
         }
   
    /*echo "<pre>";
    print_r($data);
*/



    
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
  $userFirstName   = $userId['businessFirstName'];
  $userLastName    = $userId['businessLastName'];
  $data['firstBusName'] = $userFirstName;
  $data['lastBusName']  = $userLastName;
  $data['lastBusName']  = $userLastName;
  $data['businessId']   = $userId['n_BusinessId'];
  $reportId = $this->uri->segment('4');

      $parameterReport=array( 'p_mode' => 'editselect',
                                'p_reportId' => $reportId,
                                'p_BusinessId' => $userId['n_BusinessId'],
                                'p_DeptId' => $userId['businessUserDeptId'],
                                );
        $pathReport  = base_url()."api/business_admin/claimReport/format/json/";
        $responseReport  = curlcall($parameterReport, $pathReport);
        //P($responseReport);
        //exit();
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
       // p($parameterNotes);
        $pathNotes  = base_url()."api/business_admin/notes/format/json/";
        $policyNotes  = curlcall($parameterNotes, $pathNotes);
        if($policyNotes =='Something Went Wrong'){
              $data['notes']='';
         }else{
            $data['notes']=$policyNotes;
        }
       // p($policyNotes);

    $parameterExpense=array('p_mode' => 'SelectList',
                            'p_CustCatId' => 'null',
                            'p_ReportId' => $responseReport[0]->a_ReportId,
                           );
    $pathExpense  = base_url()."api/business_admin/expense/format/json/";
    $policyExpense  = curlcall($parameterExpense, $pathExpense);
//p($policyExpense);
//exit();
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

public function currencyName($id=''){
  $parameter=array(
                    'p_mode'        => 'CurrencyName' ,
                    'p_id'          => $id,
                    'p_active'      => 'null',
                    'p_businessId'  => 'null',
                    'p_admin'       => 'null'
                  );

    $path  = base_url()."api/business_admin/currName/format/json/";
    $response  = curlcall($parameter, $path);
    if($response =='Something Went Wrong'){
      $currency='';
     }else{
        $currency=$response->t_CurrencyName;
     }
    return $currency;
}

public function distanceName($id=''){
  $parameter=array(
                    'p_mode'        => 'DisName',
                    'p_id'          => $id,
                    'p_BusinessId'  => 'null',
                    'p_enumId1'     => 'null',
                    'p_AdminType'   => 'null'
                  );
    //p($parameter);
    $path  = base_url()."api/business_admin/distanceName/format/json/";
    $response  = curlcall($parameter, $path);
    /* p($response);
     exit();*/
    if($response =='Something Went Wrong'){
      $distance='';
     }else{
        $distance=$response->t_SettingValue;
     }
    return $distance;
}

public function deptNameCheck(){
  $this->login_check();
  $userId= checklogin();
  
  $parameter_dpt = array( 'p_mode' => 'selectDeptName',
                          'p_DeptName' => $_POST['deptName'],
                          'p_BusinessId' => $userId['n_BusinessId']
                        );
  $path1  = base_url()."api/business_admin/deptName/format/json/";    // Get spending category
  $responseState1  = curlcall($parameter_dpt, $path1);
    if($responseState1=='Something Went Wrong'){
      
      }else{
        p($responseState1);
      }
}
public function department_add(){
                        $this->login_check();
                        $userId= checklogin();
                        $Id = $userId['n_BusinessId'];
                        function unique_multidim_array($array, $key){
                                    $temp_array = array();
                                    $i = 0;
                                   $key_array = array();

                                  foreach($array as $val){
                                  if(!in_array($val[$key],$key_array)){
                                  $key_array[$i] = $val[$key];
                                  $temp_array[$i] = $val;
                                  }
                                  $i++;
                                   }
                               return $temp_array;
                               }


                             $details = unique_multidim_array($_POST['t_PolicyName'],'t_DepartmantName');

      $xml =htmlentities("<NewDataSet>");
      foreach ($details as $key => $value1) {
      if(!empty($value1['t_DepartmantName'])){
        if($value1['t_DepartmantName']!='' && $value1['flag']==1) {
        $xml .=htmlentities('<tbldepartment><t_DeptName>'.$value1['t_DepartmantName'].'</t_DeptName></tbldepartment>');

}
        }
      }
      $xml .=htmlentities("</NewDataSet>");
      $parameter = array(    'p_mode' => 'Insert',
                             'p_DeptId' => $userId['businessUserDeptId'],
                              'p_XmlData_dname' => (html_entity_decode($xml, ENT_QUOTES, 'UTF-8')),
                              'p_AdminType' => $userId['n_AdminType'],
                              'p_BusinessId' => $Id,
                              'p_CreatedBy' => $userId['businessUserId']
                          );
      // echo json_encode($parameter);
      // exit();
      $path  = base_url()."api/business_admin/businessdepartmentadd/format/json/";
      $response  = curlcall($parameter, $path);
      echo json_encode($response);
      exit();
      if($response=='Something Went Wrong'){
        echo json_encode(array('Not Inserted'=>'Not Inserted'));
      }else{
          echo json_encode($response);
          exit();
      }
     
}

public function get_dpt_ctag_spcat(){
          $this->login_check();
          $data = businesschecklogin();
          $Id = $data['n_BusinessId'];
          $parameter_sp_cat = array( 'act_mode' => $_POST['act_mode'] ,
                                     'n_BusinessId' => $Id);
          $path2  = base_url()."api/business_admin/getdtpcattagbusiness/format/json/";
          $responseState2  = curlcall($parameter_sp_cat, $path2);
          echo json_encode($responseState2);
}


public function getdepartment(){
  $data = businesschecklogin();
         $Id = $data['n_BusinessId'];

 $parameter_dpt = array( 'act_mode' => 'department',
                                  'n_BusinessId' =>$Id);
          $path1  = base_url()."api/business_admin/getdtpcattagbusiness/format/json/";    // Get spending category
          $responseState1  = curlcall($parameter_dpt, $path1);
          echo json_encode($responseState1);

}


public function getspendcat(){
  $data = businesschecklogin();
         $Id = $data['n_BusinessId'];
 $parameter_dpt = array( 'act_mode' => 'sp_cat',
                         'n_BusinessId' =>$Id);
          $path1  = base_url()."api/business_admin/getdtpcattagbusiness/format/json/";    // Get spending category
          $responseState1  = curlcall($parameter_dpt, $path1);
echo json_encode($responseState1);
}


public function getcustomtag(){
          $data = businesschecklogin();
         $Id = $data['n_BusinessId'];
         $parameter_dpt = array( 'act_mode' => 'custon_tag',
                                  'n_BusinessId' =>$Id);
          $path1  = base_url()."api/business_admin/getdtpcattagbusiness/format/json/";    // Get spending category
          $responseState1  = curlcall($parameter_dpt, $path1);
          echo json_encode($responseState1);

}

 public function general(){
          $this->login_check();
          $userId = checklogin();
          $data = businesschecklogin();
          $Id = $data['n_BusinessId'];
          $parameter = array( 'id' => $Id,
                          'b_IsActive' => '1',
                          'n_AdminType' => $userId['n_AdminType']
                           );
          $pathState  = base_url()."api/business_admin/businesseview/format/json/";
          $responseState  = curlcall($parameter, $pathState);

         if(!empty($responseState)){
            $disName=$this->distanceName($responseState->n_Distance);
          }else{
            $disName='';
          }
          $data['disName']=$disName;
          if(!empty($responseState)){
            $currencyName=$this->currencyName($responseState->n_CurrencyId);
          }else{
            $currencyName='';
          }

          $data['currencyName']=$currencyName;
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
                                  'n_BusinessId' =>$Id);
          $path1  = base_url()."api/business_admin/getdtpcattagbusiness/format/json/";    // Get spending category
          $responseState1  = curlcall($parameter_dpt, $path1);
          // p($responseState1);
          // exit();
          if($responseState1=='Something Went Wrong'){
            $data['dpt_mt']='';
          }else{
             $data['dpt_mt']=$responseState1;
          }


          $parameter_sp_cat = array( 'act_mode' => 'sp_cat',
                                     'n_BusinessId' => $Id

                                    );
          $path2  = base_url()."api/business_admin/getdtpcattagbusiness/format/json/";
          $responseState2  = curlcall($parameter_sp_cat, $path2);

          if($responseState2=='Something Went Wrong'){
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

public function editspcatglcod(){
     // print_r($_POST);
     // exit;

      $parameter=  array('act_mode'    =>$_POST['act_mode'] ,
                           'cat_glcod' =>$_POST['newglcode'],
                           'testname'  =>$_POST['newglcode'],
                            'id'       =>$_POST['id']);
      $path  = base_url()."api/business_admin/updatglcodetext/format/json/";
      $response= curlcall($parameter, $path);

    }

public function businessAdminListing(){

  $this->login_check();
  $userId= checklogin();

   $current_user_id=$userId['businessUserId'];
 
  // p($userId);
  // exit();
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
        // p($responseSide);
        // exit();
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
     $data['current_user_id']=$current_user_id;
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
public function admin(){
  $this->login_check();
  $userId= checklogin();
  
  if(isset($_POST['submit'])){
     // p($_POST);
     // exit();
      //$userId= checklogin();

      $this->form_validation->set_rules('unikemail', 'Email', 'trim|required|xss_clean');
      //$this->form_validation->set_rules('unikeempcode', 'Admin Code', 'trim|required|xss_clean');
      $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|required');
      //$this->form_validation->set_rules('status', 'Status', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('department', 'Department', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('employee_id', 'Employee Id', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('date_of_birth', 'Date Of Birth', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('office_phone', 'Office Phone', 'trim|required|xss_clean|required|');
      //$this->form_validation->set_rules('mobile_phone', 'Mobile Phone', 'trim|required|xss_clean|required');
      //$this->form_validation->set_rules('address_line1', 'Address Line1', 'trim|required|xss_clean|required');
      //$this->form_validation->set_rules('address_line2', 'Address Line2', 'trim|required|xss_clean|required');
      //$this->form_validation->set_rules('address_line3', 'Address Line3', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('country_id', 'Country', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('state_id', 'State', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('city_id', 'City', 'trim|required|xss_clean|required');
      //$this->form_validation->set_rules('pin_code', 'Pincode', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('amount', 'Amount', 'trim|required|xss_clean|required');

      if($this->form_validation->run() != false){
         $email        = $this->input->post('email');
         $status       = $this->input->post('status');
         $firstName    = $this->input->post('first_name');
         $lastName     = $this->input->post('last_name');
         $department   = $this->input->post('department');
         $dateOfBirth  = $this->input->post('date_of_birth');
         $employeeCode = $this->input->post('employee_id');
         $officePhone  = $this->input->post('office_phone');
         $mobilePhone  = $this->input->post('mobile_phone');
         $addressLine1 = $this->input->post('address_line1');
         $addressLine2 = $this->input->post('address_line2');
         $addressLine3 = $this->input->post('address_line3');
         $countryId    = $this->input->post('country_id');
         $stateId      = $this->input->post('state_id');
         $cityId       = $this->input->post('city_id');
         $pinCode      = $this->input->post('pin_code');
         $amount       = $this->input->post('amount');
         $editPolicy   = $this->input->post('edit_policy');
         $address      = $addressLine1.'___'.$addressLine2.'___'.$addressLine3;
         $randPassword = rand();
         $password     = md5($password);
         $DOB          = date('Y-m-d', strtotime($dateOfBirth));
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
     // $this->form_validation->set_rules('status', 'Status', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('department', 'Department', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('employee_id', 'Employee Id', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('date_of_birth', 'Date Of Birth', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('office_phone', 'Office Phone', 'trim|required|xss_clean|required|numeric');
      //$this->form_validation->set_rules('mobile_phone', 'Mobile Phone', 'trim|required|xss_clean|required|numeric');
      //$this->form_validation->set_rules('address_line1', 'Address Line1', 'trim|required|xss_clean|required');
      //$this->form_validation->set_rules('address_line2', 'Address Line2', 'trim|required|xss_clean|required');
      //$this->form_validation->set_rules('address_line3', 'Address Line3', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('country_id', 'Country', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('state_id', 'State', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('city_id', 'City', 'trim|required|xss_clean|required');
      //$this->form_validation->set_rules('pin_code', 'Pincode', 'trim|required|xss_clean|required');
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
	

	  // $userId= checklogin();
	 $session_user=$userId['businessUserId']; 
	  /* echo $empId;
	   echo $session_user;
	   exit;*/
 //p($this->session->all_userdata());

	   
	   

	  
	  if($empId==$session_user){
	  	  redirect($base_url.'business/dashboard/businessAdminListing/');
	  
}
else{
	  
	  
	  
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

public function checkemail()
   {
     $parameter = array('act_mode'=>$this->input->post('act_mode') , 'businessid'=>$this->input->post('businessid'),  'e_Email' => $this->input->post('email') );
     $path  = base_url()."api/business_admin/empemailcheck/format/json/";
     $response  = curlcall($parameter, $path);
     echo json_encode($response);
     exit();
   }



   public function empidcheck(){
    $parameter = array(  'act_mode' => $_POST['act_mode'],
                        'e_EmpCode' => $_POST['empid'],
                        'p_BusinessId' => $_POST['businessId']
                        );
     $path  = base_url()."api/business_admin/empcodecheck/format/json/";
     $response  = curlcall($parameter, $path);

     echo json_encode($response);
     exit();
   }

  public function add_employee(){

    $this->login_check();
    $userId= checklogin();

   if(isset($_POST['submit'])){
      $this->form_validation->set_rules('unikemail', 'Email', 'trim|required|xss_clean');
      $this->form_validation->set_rules('unikeempcode', 'EmpCode', 'trim|required|xss_clean');
      $this->form_validation->set_rules('policy', 'Policy', 'trim|required|xss_clean');
      $this->form_validation->set_rules('status', 'Status', 'trim|required|xss_clean');
      $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|xss_clean');
      $this->form_validation->set_rules('last_name', 'Last Name', 'trim|xss_clean|required');
      $this->form_validation->set_rules('department', 'Department', 'trim|required|xss_clean');
      $this->form_validation->set_rules('employee_id', 'Employee Id', 'trim|required|xss_clean');
      $this->form_validation->set_rules('date_of_birth', 'Date Of Birth', 'trim|required|xss_clean');
      $this->form_validation->set_rules('office_phone', 'Office Phone', 'trim|required|xss_clean|min_length[10]|max_length[15]');
      $this->form_validation->set_rules('mobile_phone', 'Mobile Phone', 'trim|required|xss_clean|min_length[10]|max_length[15]');
      $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|min_length[10]|max_length[255]|valid_email');

      $this->form_validation->set_rules('address_line1', 'Address Line1', 'trim|required|xss_clean');
      //$this->form_validation->set_rules('address_line2', 'Address Line2', 'trim|required|xss_clean');
      //$this->form_validation->set_rules('address_line3', 'Address Line3', 'trim|required|xss_clean');
      $this->form_validation->set_rules('country_id', 'Country', 'trim|required|xss_clean');
      $this->form_validation->set_rules('state_id', 'State', 'trim|required|xss_clean');
      $this->form_validation->set_rules('city_id', 'City', 'trim|required|xss_clean');
      //$this->form_validation->set_rules('pin_code', 'Pincode', 'trim|required|xss_clean');
      

         if($this->form_validation->run() != false){
         
         $status        = $this->input->post('status');
         $firstName     = $this->input->post('first_name');
         $lastName      = $this->input->post('last_name');
         $policy        = $this->input->post('policy');
         $department    = $this->input->post('department');
         $email         = $this->input->post('email');
         $employeeCode  = $this->input->post('employee_id');
         $dateOfBirth   = $this->input->post('date_of_birth');
         $officePhone   = $this->input->post('office_phone');
         $mobilePhone   = $this->input->post('mobile_phone');
         $addressLine1  = $this->input->post('address_line1');
         $addressLine2  = $this->input->post('address_line2');
         $addressLine3  = $this->input->post('address_line3');
         $countryId     = $this->input->post('country_id');
         $stateId       = $this->input->post('state_id');
         $cityId        = $this->input->post('city_id');
         $pinCode       = $this->input->post('pin_code');
         $randPassword  = rand();
         $password      = md5($randPassword);
         $DOB           = date('Y-m-d', strtotime($dateOfBirth));
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
                $this->session->set_flashdata('message','Employee Created Successfully');
                redirect($base_url.'business/dashboard/employee/');
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

// Rahul Yadav 11/12/1014 


  function  emppolicychang(){
            $parameter = array( 'act_mode'=>'emppolicychng' , 'policyid' =>$_POST['policyid'] );
            $path  = base_url()."api/business_admin/emppolicychang/format/json/";
            $response  = curlcall($parameter, $path);
         //

            echo json_encode($response);
///exit;

  }




public function edit_employee(){
      $this->login_check();
      $userId= checklogin();

  if(isset($_POST['submit'])){
    //$userId= checklogin();
      //$this->form_validation->set_rules('status', 'Status', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('department', 'Department', 'trim|required|xss_clean|required');
      //$this->form_validation->set_rules('employee_id', 'Employee Id', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('date_of_birth', 'Date Of Birth', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('office_phone', 'Office Phone', 'trim|required|xss_clean|required|numeric|min_length[10]|max_length[15]');
      $this->form_validation->set_rules('mobile_phone', 'Mobile Phone', 'trim|required|xss_clean|required|numeric|min_length[10]|max_length[15]');
      //$this->form_validation->set_rules('address_line1', 'Address Line1', 'trim|required|xss_clean|required');
      //$this->form_validation->set_rules('address_line2', 'Address Line2', 'trim|required|xss_clean|required');
      // $this->form_validation->set_rules('address_line3', 'Address Line3', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('country_id', 'Country', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('state_id', 'State', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('city_id', 'City', 'trim|required|xss_clean|required');
      //$this->form_validation->set_rules('pin_code', 'Pincode', 'trim|required|xss_clean|required');
      $this->form_validation->set_rules('policy', 'Policy', 'trim|required|xss_clean|required');
    
    if($this->form_validation->run() != false){
         $empUpdate     = $this->input->post('emp_id');
         $status        = $this->input->post('status');
         $firstName     = $this->input->post('first_name');
         $lastName      = $this->input->post('last_name');
         $policy        = $this->input->post('policy');
         $department    = $this->input->post('department');
         $email         = $this->input->post('email');
         $employeeCode  = $this->input->post('employee_id');
         $dateOfBirth   = $this->input->post('date_of_birth');
         $officePhone   = $this->input->post('office_phone');
         $mobilePhone   = $this->input->post('mobile_phone');
         $addressLine1  = $this->input->post('address_line1');
         $addressLine2  = $this->input->post('address_line2');
         $addressLine3  = $this->input->post('address_line3');
         $countryId     = $this->input->post('country_id');
         $stateId       = $this->input->post('state_id');
         $cityId        = $this->input->post('city_id');
         $pinCode       = $this->input->post('pin_code');
         $DOB           = date('Y-m-d', strtotime($dateOfBirth));
        $parameterUpdate = array(  'p_mode'        => 'Update',
                                   'p_EmpId'       => $empUpdate,
                                   'p_EmpCode'     => $employeeCode,
                                   'p_Empfname'    => $firstName,
                                   'p_EmpLastName' => $lastName,
                                   'p_DeptId'      => $department,
                                   'p_PolicyId'    => $policy,
                                   'p_EmpDob'      => $DOB,
                                   'p_OfficePhno'  => $officePhone,
                                   'p_MobileNo'    => $mobilePhone,
                                   'p_AddFLine'    => $addressLine1,
                                   'p_AddSecLine'  => $addressLine2,
                                   'p_AddThrdLine' => $addressLine3,
                                   'p_Country'     => $countryId,
                                   'p_State'       => $stateId,
                                   'p_City'        => $cityId,
                                   'p_PinCode'     => $pinCode,
                                   'p_Status'      => $status,
                                   'p_CreatedBy'   => $userId['businessUserId'],
                                   'p_BusinessId'  => $userId['n_BusinessId'],
                                   'p_AdminType'   => $userId['n_AdminType'],
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
  public function editPolicy(){
    $this->login_check();
    $userId= checklogin();
    $policyId=$this->uri->segment('4');
                      $parameter_policy = array('policyid'=>$policyId);
                      $path_policy  = base_url().'api/business_admin/policyasign/format/json/';
                      $responseasign1 = curlcall($parameter_policy, $path_policy);

              if($responseasign1=='Something Went Wrong'){
              $data['asignp']= 0;
              }

              else{
              $data['asignp']=1; 
              }
                    $parameter_policy = array('act_mode'=>'check', 'policyId'=>$policyId);
                      $path_policy  = base_url().'api/business_manage/ssapolicyeditdelcheck/format/json/';
                      $responseasign = curlcall($parameter_policy, $path_policy);


if($responseasign=='Something Went Wrong'){
     $data['assign']= 0;
    }
  if($responseasign !=='Something Went Wrong'){
      if($responseasign->n_Status =="Reimbursed"){
      $data['assign']= 0;
     }
    else{
      $data['assign']=1; 
    }
}
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
  
    $data['buspolicy']=  $userId['n_BusinessId'];
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
    //p( $responseCatAssign);exit;
    if($responseCatAssign !=='Something Went Wrong'){
     $data['policy']=$responseCatAssign; 
    }else{
   $this->session->set_flashdata('message','Please check country Name');
               $base_url  = base_url();
               redirect($base_url.'business/dashboard/countryadd/');
               exit();
      $data['policy']='';
    }
	
	
    $this->load->view('editpolicy',$data);
 }


public function policydelete(){

 $parameter_policy = array('act_mode'=>'check', 'policyId'=>$policyid);
                      $path_policy  = base_url().'api/business_manage/ssapolicyeditdelcheck/format/json/';
                      $rptststus = curlcall($parameter_policy, $path_policy);

                if($rptststus=="Something Went Wrong"){
                $rptststus1="Reimbursed";
                }
                else{
                $rptststus1= $rptststus->n_Status;

                }
                if($rptststus1==="Reimbursed"){
  //delete
                }
                else{

// not delete
           }

}

  public function policylisting(){
    $this->login_check();
    $userId= checklogin();
    $this->load->view('layout/header');
    $parameter=array( 'p_mode' => 'select',
                      'p_formName' => 'null',
                      'p_BusinessId' => $userId['n_BusinessId'],
                      'p_PolicyId' => '',
                      'p_AdminType' => $userId['n_AdminType'],
                      );
    $pathCat = base_url().'api/business_admin/policy/format/json/';
    $responseCat  = curlcall($parameter, $pathCat);


    $data['policyList']=$responseCat;
    $parameter_policy1 = array('policyid'=>'');

    $pathCat1 = base_url().'api/business_admin/policyasign/format/json/';
    $responsepasign  = curlcall($parameter_policy1, $pathCat1);


if($responsepasign =="Something Went Wrong"){
  $data['policyasign']="";
} else{
   $data['policyasign']=$responsepasign;

}
   //call  proc_policyasign

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
     $data['businessid']=$userId['n_BusinessId'];
   // p($responseCat);
   // exit();
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
  	$userId = checklogin();
    $action =$_POST['action'];
    if($action=="insert"){
if($_POST['d_RptDueDt']=="firstday"){
  $d_RptDueDt1=1;
}
if($_POST['d_RptDueDt']=="lastday"){
  $d_RptDueDt1='lastdayofmonth';
}
if($_POST['weekely'] !==""){
$d_RptDueDt1=$_POST['weekely'];

}

if($_POST['specific_dt'] !==""){
$d_RptDueDt1=$_POST['specific_dt'];

}




      $parameters = array(
      'p_mode'            => 'Insert',
      'p_formName'        => 'First',
      'p_PolicyName'      => $_POST['t_PolicyName'],
      'p_PolicyId'        => 'null',
      'p_MaxRptAmt'       => $_POST['n_MaxRptAmt'],
      'd_RptDueDt'        => $_POST['d_RptDueDt'],
      'd_RptDueDt1'       => $d_RptDueDt1 ,  //$_POST['d_RptDueDt1'],
      'p_MaxExpAmt'       => $_POST['n_MaxExpAmt'],
      'p_CashAdvAllowed'  => $_POST['b_CashAdAllowed'],
      'p_RecpReq'         => $_POST['b_RecpReq'],
      'p_AboveAmt'        => $_POST['n_AboveAmt'],
        'p_flagExpSubmitted'        => $_POST['expense_submitted'],
      'p_BusinessId'      => $userId['n_BusinessId'],
      'p_CreatedBy'       => $userId['businessUserId'],
      'p_AdminType'       => $userId['n_AdminType']

     );
    }else{


if($_POST['d_RptDueDt']=="firstday"){
  $d_RptDueDt1=1;
}
if($_POST['d_RptDueDt']=="lastday"){
  $d_RptDueDt1='lastdayofmonth';
}
if($_POST['weekely'] !==""){
$d_RptDueDt1=$_POST['weekely'];

}

if($_POST['specific_dt'] !==""){
$d_RptDueDt1=$_POST['specific_dt'];

}

     $parameters = array(
      'p_mode'            => 'UpdateGen',
      'p_formName'        => 'First',
      'p_PolicyName'      => $_POST['t_PolicyName'],
      'p_PolicyId'        => $_POST['policyId'],
      'p_MaxRptAmt'       => $_POST['n_MaxRptAmt'],
      'd_RptDueDt'        => $_POST['d_RptDueDt'],
      'd_RptDueDt1'       =>  $d_RptDueDt1 ,      //$_POST['d_RptDueDt1'],
      'p_MaxExpAmt'       => $_POST['n_MaxExpAmt'],
      'p_CashAdvAllowed'  => $_POST['b_CashAdAllowed'],
      'p_RecpReq'         => $_POST['b_RecpReq'],
      'p_AboveAmt'        => $_POST['n_AboveAmt'],
      'p_flagExpSubmitted'        => $_POST['expense_submitted'],
      'p_BusinessId'      => $userId['n_BusinessId'],
      'p_CreatedBy'       => $userId['businessUserId'],
      'p_AdminType'       => $userId['n_AdminType']

     );
    }


   /* p($parameters);
    exit;*/
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
         //p($parameters);
         // echo json_encode($parameters);
         // exit();
        //api calls will come here
        $path      = base_url().'api/business_admin/policyMileage/format/json/';
        $response  = curlcall($parameters, $path);
        echo json_encode($response);
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
       // exit();
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
if(!empty($singleExpValue[$i]) and !empty($dailyLimits[$i]) and !empty($monthlyLimit[$i])){

            $xml .=htmlentities("<tblpolicycategorymap>");
            $xml .=htmlentities('<n_SpndngCatId>'.$catId[$i].'</n_SpndngCatId>');
            $xml .=htmlentities('<n_SingleExpLmt>'.$singleExpValue[$i].'</n_SingleExpLmt>');
            $xml .=htmlentities('<n_DailyExpLmt>'.$dailyLimits[$i].'</n_DailyExpLmt>');
            $xml .=htmlentities('<n_MonthlyExpLmt>'.$monthlyLimit[$i].'</n_MonthlyExpLmt>');
            $xml .=htmlentities("</tblpolicycategorymap>");
            }
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
        echo json_encode($response); 
        //api cals ends here
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
/*
p($response);
exit;*/

  if($response=='Something Went Wrong'){
      $deptName='';
  }else{
    $deptName=$response->t_DeptName;
  }

  return $deptName;
}

public function profile(){
  $this->login_check();

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
             
            if($profileDataResponse=='Something Went Wrong'){
              $data['bprofile']='';
            }else{
              $data['deptName']=$this->getDepartmentName($profileDataResponse->n_DeptId);
              $data['state']=$this->getStateDropDown($profileDataResponse->n_CountryId);
              $data['city']=$this->getCityDropDown($profileDataResponse->n_StateId);
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
                                  'bcountry' => $this->input->post('country_id'),
                                  'bstate'   => $this->input->post('state_id'),
                                  'bcity'    => $this->input->post('city_id'),
                                  'bpin'     => $this->input->post('pin_code'),
                                  'bseq'     => $this->input->post('seq_code'),
                                  'act_mode' => 'pupdate'
                                  );
                // p($parameter);
                // exit();
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



              $userid= $this->session->userdata['sessionData']['businessUserId'];
       $parameter = array('act_mode'=>'businessadmin' , 'userid'=>$userid);
       $path       = base_url().'api/createbusinessadmin/firstloginpasschange/format/json/';
       $data['firstlogin']= curlcall($parameter, $path);

      $this->load->view('profile',$data);
  }
 public function getStateDropDown($id=""){

    $this->login_check();
    $userId= checklogin();
    if(!empty($id)){
        $parameterState = array('id' => $id,
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
          return $responseState;
          }
    }elseif(isset($_POST['id'])){

        $parameterState = array('id' => $_POST['id'],
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
  }


  public function getCityDropDown($id=""){
  $this->login_check();
  $userId= checklogin();

   if(!empty($id)){
      $parameter =array(   'p_mode'       => 'CitySelect',
                           'p_id'         => 'null',
                           'p_stateId'    => $id,
                           'p_BusinessId' => $userId['n_BusinessId'],
                           'p_admin'      => 33
                        );
        $path  = base_url()."api/business_admin/city/format/json/";
        $response  = curlcall($parameter, $path);
        if($response =='Something Went Wrong'){
          $response='';
         }else{
         return $response;
          }
    }elseif(isset($_POST['id'])){
      $parameter =array(  'p_mode'    => 'CitySelect',
                       'p_id'         => 'null',
                       'p_stateId'    => $_POST['id'],
                       'p_BusinessId' => $userId['n_BusinessId'],
                       'p_admin'      => 33
                        );
      $path  = base_url()."api/business_admin/city/format/json/";
      $response  = curlcall($parameter, $path);
      if($response =='Something Went Wrong'){
          $response='';
       }else{
        echo json_encode($response);
        exit();
        }
    }
  
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
  redirect($data.'business/');
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



function policycheck(){
$parameter = array('businessid' =>$_POST['businessid'] , 'policyname'=>$_POST['policyname']);
$path_policy  = base_url().'api/business_manage/policycheck/format/json/';
 $response  = curlcall($parameter, $path_policy);
              //echo  $response->nom;
            echo  json_encode($response);

}

function new_policy_add_onblur(){
 $userId= checklogin();
  $d_RptDueDt1="";
if($_POST['d_RptDueDt']=="firstday"){
  $d_RptDueDt1=1;
}
if($_POST['d_RptDueDt']=="lastday"){
  $d_RptDueDt1='lastdayofmonth';
}
if($_POST['weekely'] !==""){
$d_RptDueDt1=$_POST['weekely'];

}
if($_POST['specific_dt'] !==""){
$d_RptDueDt1=$_POST['specific_dt'];
}
$parameter = array(
  'act_mode'    =>$_POST['act_mode'],
  'n_PolicyId'  =>$_POST['n_PolicyId'] ,
  't_PolicyName'=>$_POST['t_PolicyName'] ,
  'n_MaxRptAmt' =>$_POST['n_MaxRptAmt'] ,
  'd_RptDueDt'  =>$_POST['d_RptDueDt'] ,
  'd_RptDueDt1' =>$d_RptDueDt1, //  $_POST['d_RptDueDt1'] ,
  'n_MaxExpAmt' =>$_POST['n_MaxExpAmt'] ,
  'b_CashAdAllowed'=>$_POST['b_CashAdAllowed'] ,
  'b_RecpReq'   =>$_POST['b_RecpReq'] ,
  'n_AboveAmt'  =>$_POST['n_AboveAmt'] ,
  'expense_submitted'=>$_POST['expense_submitted'] ,
  'n_MaxRptMilage'=>$_POST['n_MaxRptMilage'] ,
  'n_MilageRate'=>$_POST['n_MilageRate'] ,
  'n_PerMeasuremnt'=>$_POST['n_PerMeasuremnt'] ,
  'n_MaxExpMil' =>$_POST['n_MaxExpMil'] ,
  'b_IsGPSReq' =>$_POST['b_IsGPSReq'] ,
  'n_DailyExpLmt'=>$_POST['n_DailyExpLmt'] ,
  'n_MonthlyExpLmt'=>$_POST['n_MonthlyExpLmt'],
  'p_BusinessId' => $userId['n_BusinessId'],
  'p_CreatedBy'  => $userId['businessUserId'],
  'n_AdminType'  => '22'
  );

$path_policy  = base_url().'api/business_manage/addpolicyonkeyupbusinessadmin/format/json/';
$response1  = curlcall($parameter, $path_policy);
echo   json_encode($response1);
exit;
}



public function ssareport(){
                $this->login_check();
                $userId= checklogin();
                $userFirstName=$userId['businessFirstName'] ="fname";
                $userLastName=$userId['businessLastName']="fname";
                $data['firstBusName']=$userFirstName;
                $data['lastBusName']=$userLastName;
                $data['lastBusName']=$userLastName;
                //$data['businessId']=$userId['n_BusinessId']=1;
              //$reportId=$this->uri->segment('4');



                        $reportId=$this->uri->segment('4');
                        $Businessid=$this->uri->segment('5');
                        $DeptId=$this->uri->segment('6');
                        $createby=$this->uri->segment('7');
                         $policyid=$this->uri->segment('8');
/*$reportId=$_POST['report'];
$Businessid=$_POST['business'];
$DeptId=$_POST['department'];
$createby=$_POST['createdby'];
$policyid=$_POST['policy'];*/

                $parameterSide=array( 'p_mode' => 'SelectList',
                'p_BusinessId' =>  $Businessid, // $userId['n_BusinessId'],
                'p_EmpId' => 'null',
                'p_FirstName' => 'null',
                'p_LastName' => 'null'
                );
                $pathSide  = base_url()."api/business_admin/addemp/format/json/";
                $responseSide  = curlcall($parameterSide, $pathSide);
  //p($responseSide);
  //$policy_id=$responseSide[0]['n_PolicyId'];

                if($responseSide =='Something Went Wrong'){
                $this->session->set_flashdata('message','Please check Role Name');
                //$base_url  = base_url();
                //redirect($base_url.'business/dashboard/Roleadd/');
                echo "No report exit";
                exit();
                }else{
                $data['sideEmpName']=$responseSide;
                }
         // Get all business  proc_ssagetbusiness

                $parameterSide=array( 'act_mode' => 'getallbusiness',
                                     'admintype' => '',
                                     'adminid' => ''
                  );
                $pathSide  = base_url()."api/createbusinessadmin/ssagetallbusiness/format/json/";
                $responseSide  = curlcall($parameterSide, $pathSide);
     // p($responseSide );
                            $data['businessname']= $responseSide;
//exit;

                               $parameterReportSide=array( 'p_mode' => 'select',
                                  'p_BusinessId' => $Businessid,  //$userId['n_BusinessId'],
                                  'p_DeptId' => $DeptId,
                                );

                             $pathReportSide  = base_url()."api/business_admin/claimReport/format/json/";
                             $responseReportSide  = curlcall($parameterReportSide, $pathReportSide);
      // p($responseReportSide);

//exit;

                            if($responseReportSide =='Something Went Wrong'){
                    $this->session->set_flashdata('message','Please check Role Name');
                    $base_url  = base_url();
                    //redirect($base_url.'business/dashboard/Roleadd/');
                    exit();
                }
                else{
                $data['sideReport']=$responseReportSide;
                }

                $parameterReport=array( 'p_mode' => 'editselect',
                'p_reportId' =>   $reportId  ,  // 1,// $reportId,
                'p_BusinessId' =>  $Businessid, //  1,//$userId['n_BusinessId'],
                'p_DeptId' => $DeptId
                );
                $pathReport  = base_url()."api/business_admin/claimReport/format/json/";
                $responseReport  = curlcall($parameterReport, $pathReport);
  //p($responseReport);
                // exit;
                if($responseSide =='Something Went Wrong'){
                 $data['report']="";
                         }else{
                       $data['report']=$responseReport;
                         }
                $parameterNotes=array( 'p_mode' => 'EditSelect',
                'p_noteId' => 'null',
                'p_CreatedBy' => $createby, //$userId['businessUserId'],
                'p_Type' => 'ADMIN',
                'n_ReportId' => $reportId,   //$responseReport[0]->a_ReportId,
                );
                $pathNotes  = base_url()."api/business_admin/notes/format/json/";
                $policyNotes  = curlcall($parameterNotes, $pathNotes);

//p($policyNotes);

            if($policyNotes =='Something Went Wrong'){
            $data['notes']='';
            }else{
            $data['notes']=$policyNotes;
            }

            $parameterExpense=array( 'p_mode' => 'SelectList',
            'p_CustCatId' => 'null',
            'p_ReportId' => $reportId //$responseReport[0]->a_ReportId,
            );
            $pathExpense  = base_url()."api/business_admin/expense/format/json/";
  
            $policyExpense  = curlcall($parameterExpense, $pathExpense);
//p($policyExpense);
            if($policyExpense =='Something Went Wrong'){
            $data['expense']='';
          }else{
          $data['expense']=$policyExpense;
          }
          $parameterPolicy=array( 'p_mode' => 'EditOrViewPolicy',
          'p_formName' => 'First',
          'p_PolicyId' => $policyid, //$responseReport[0]->n_PolicyId,
          'p_BusinessId' => $Businessid   // $userId['n_BusinessId'],
          );
          $pathPolicy  = base_url()."api/business_admin/policy/format/json/";
          $policyName  = curlcall($parameterPolicy, $pathPolicy);
//p($policyName);
//exit; 
        if($policyName =='Something Went Wrong'){
          $this->session->set_flashdata('message','Please check Role Name');
          $base_url  = base_url();
          echo "Policy Name does not exit";
          //redirect($base_url.'business/dashboard/Roleadd/');
          exit();
          }        else {
          $data['policyName']=$policyName;
          }


      $parameter = array('act_mode' => 'busview' ,
                           'busid'    => '' );
      $pathReportSide  = base_url()."api/business_admin/myclaimbusiness/format/json/";
        $data['business']  = curlcall($parameter, $pathReportSide);
        $parameter = array('act_mode' => 'viewall' ,
                           'busid'    => '' );

      $pathReportSide  = base_url()."api/business_admin/myclaimreports/format/json/";
        $data['response']  = curlcall($parameter, $pathReportSide);

 //system admin rembursed
         $parameter = array('buainessid' =>$Businessid , );
         $pathReportSide  = base_url()."api/business_admin/ssareportrembursed/format/json/";
         $data['ssa_rembursed']  = curlcall($parameter, $pathReportSide);
     //$this->load->view('layout/header');
          $this->load->view('employee_detail_view_report',$data);
}

} // End class
 