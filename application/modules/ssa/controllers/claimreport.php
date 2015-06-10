<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Claimreport extends MX_Controller {
  public function __construct() {
	$this->load->model("supper_admin");
	$this->load->helper('my_helper');
  }
  public function login_check(){
		 	$data = checklogin();
		 	if($data['a_SysAdminId'] != 33){
		 		$baseURl = base_url();
		 		redirect($baseURl.'ssa/admin');
		 		exit();
 	}
 }
 public function index(){
 	$this->login_check();
 	$this->load->view('layout/header');
 	$parameterReportSide=array('p_mode' => 'select',
                                  'p_BusinessId' => 1,
                                  'p_DeptId' => 1
                                );

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
	$parameterSide=array( 'act_mode' => 'getallbusiness',
					      'admintype' => '',
					      'adminid' => ''
								  );
								$pathSide  = base_url()."api/createbusinessadmin/ssagetallbusiness/format/json/";
								$responseSide  = curlcall($parameterSide, $pathSide);
                              $data['businessname']= $responseSide;

 	$this->load->view('report/leftside',$data);
 	$this->load->view('layout/footer');
  }
  public function detailReports(){
								$this->login_check();
								$userId= checklogin();
								$userFirstName=$userId['businessFirstName'] ="fname";
								$userLastName=$userId['businessLastName']="fname";
								$data['firstBusName']=$userFirstName;
								$data['lastBusName']=$userLastName;
								$data['lastBusName']=$userLastName;
								//$data['businessId']=$userId['n_BusinessId']=1;

//$reportId=6;
//$Businessid=43;
//$DeptId=33;
//$createby=69;
//$policyid=117;
								$reportId=$this->uri->segment('4');
				               $Businessid=$this->uri->segment('5');
				                $DeptId=$this->uri->segment('6');
				                $createby=$this->uri->segment('7');
				                 $policyid=$this->uri->segment('8');
								$this->load->view('layout/header');
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
								'p_Type' => 'Admin',
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
		
     	$this->load->view('report/employee_detail_view_report',$data);
}
// ajax load Rahul 
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
$reportId=$_POST['report'];
$Businessid=$_POST['business'];
$DeptId=$_POST['department'];
$createby=$_POST['createdby'];
$policyid=$_POST['policy'];

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
					$this->load->view('report/ajaxvuewreport',$data);
}

// ajax load end rahul



public function notessave(){
$this->login_check();
	$userId= checklogin();
	$adminid=$userId['a_SysAdminId'];
$parameter = array( 'act_mode'     => 'insert' ,
                    'n_ReportId'   => $this->input->post('reportid') ,
	                't_NoteDesc'   => $this->input->post('noteval') ,
	                't_Type'       => 'SystemAdmin',
	                'n_CreatedBy'  => $adminid ,
	                'n_businessId' => $adminid );
 $pathReportSide  = base_url()."api/business_admin/ssanotadd/format/json/";
        $data['response']  = curlcall($parameter, $pathReportSide);

}
public function savemynote(){
    $this->login_check();
	$userId= checklogin();

	$adminid=$userId['a_SysAdminId'];
    $parameter = array( 'act_mode'     => 'insert' ,
	                    's_reportid'   => $this->input->post('reportid') ,
		                's_note'       => $this->input->post('noteval') ,
		                's_type'       => 'SystemAdmin',
		                's_cretaedby'  => $adminid ,
		                's_busid'      => $adminid );

   
        $pathReportSide  = base_url()."api/business_admin/savemynotessa/format/json/";
        $response  = curlcall($parameter, $pathReportSide);
       
        echo json_encode($response);
        exit();


}




//##   Report approve  start
public function reportrembursed(){
	$userId= checklogin();
 $adminid= $this->session->userdata['sessionData']['a_SId'];
$parameter = array('action' =>$_POST['act_mode'],
                   'reportid'=>$_POST['reportid'] ,
                   'modified_type'=>'33' ,
                   'n_modifiedby'=>$adminid);
$pathReport  = base_url()."api/business_admin/systemadminreport/format/json/";
        $responseReport  = curlcall($parameter, $pathReport);
/*p($parameter);
exit;*/

echo json_encode($responseReport);
exit;
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

public function deletemynote()
{   
    $parameter = array( 
	                    'row_id'       => $this->input->post('deleteid') ,
	                    'act_mode'     => 'remove' 
		               );

       // p($parameter);
        $pathReportSide  = base_url()."api/business_admin/deletenotessa/format/json/";
        $response  = curlcall($parameter, $pathReportSide);
        //p($response);
       // exit();
        echo json_encode($response);
        exit();
}

//# End 

// download report

public function downloadReport(){
  $this->login_check();
  $userId= checklogin();
  $userFirstName=$userId['businessFirstName'];
  $userLastName=$userId['businessLastName'];
  //$data['firstBusName']=$userFirstName;
  //$data['lastBusName']=$userLastName;
  //$data['lastBusName']=$userLastName;
  $data['businessId']=$userId['n_BusinessId'];
  $userId['n_BusinessId']=59;
  $data['businessId']=59;
  $reportId=26;



  $reportId=28;
$Businessid=78;
$DeptId=84;
$createby=92;
$policyid=143;
  //$reportId=$this->uri->segment('4');

      $parameterReport=array( 'p_mode' => 'editselect',
                                'p_reportId'=>$reportId,
                                'p_BusinessId'=> $Businessid ,   //$userId['n_BusinessId'],
                                'p_DeptId' =>$DeptId ,    //$userId['businessUserDeptId'],
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
                                'p_CreatedBy' => $createby ,     //$userId['businessUserId'],
                                'p_Type' => 'Admin',
                                'n_ReportId' =>  $reportId,    //$responseReport[0]->a_ReportId,
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
                            'p_ReportId' =>  $reportId     //$responseReport[0]->a_ReportId,
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
                            'p_PolicyId' =>  $policyid  , //$responseReport[0]->n_PolicyId,
                            'p_BusinessId' => $Businessid // $userId['n_BusinessId'],
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
        $this->load->view('report/reportPdf',$data);
}


public function searchreport(){

					$parameterReportSide=array( 'p_mode' => 'select',
					  'p_BusinessId' => $_POST['businessid'],
					  'p_DeptId' => 1
					);
					$pathReportSide  = base_url()."api/business_admin/claimReport/format/json/";
					$responseReportSide  = curlcall($parameterReportSide, $pathReportSide);

					//p($responseReportSide);

					$sdata = json_encode($responseReportSide);
					echo $sdata;
					die();
           }


 // ######################################### SHEETESH  DUBEY START  30 NOV ####################


public function myClaimReports()
{   $this->login_check();
	$this->load->view('layout/header');
	    $parameter = array('act_mode' => 'busview' ,
                           'busid'    => '' );
	    $pathReportSide  = base_url()."api/business_admin/myclaimbusiness/format/json/";
        $responseReportSide['business']  = curlcall($parameter, $pathReportSide);
        $parameter = array('act_mode' => 'viewall' ,
                           'busid'    => '' );

	    $pathReportSide  = base_url()."api/business_admin/myclaimreports/format/json/";
        $responseReportSide['response']  = curlcall($parameter, $pathReportSide);
        $this->load->view('claim',$responseReportSide);
        $this->load->view('layout/footer');
}


public function myClaimEmp()
{      $this->login_check();
	   $busid=$_POST['busid'];
	    $parameter = array('act_mode' => 'busemp' ,
                           'busid'    =>  $busid
                          );
	    $pathReportSide  = base_url()."api/business_admin/myclaimemp/format/json/";
        $myresponse = curlcall($parameter, $pathReportSide);
        echo json_encode($myresponse);

}
public function myClaimreportByEmp()
{      $this->login_check();
	   $emp=$_POST['busid'];
       $parameter = array('act_mode' => 'viewallemp' ,
                             'busid' => $emp );
	   $pathReportSide  = base_url()."api/business_admin/myclaimreports/format/json/";
       $myresponse  = curlcall($parameter, $pathReportSide);
       echo json_encode($myresponse);

}

public function claimreport_search(){

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
                           $parameter = array(
                        	'act_mode' =>$_POST['act_mode'],
                         	'businessid' =>$_POST['businessid'],
                         	'empname' =>$_POST['empname'],
                           'status' =>$_POST['status'],
       	                   'b_submited' =>$p_sdate ,
       	                   'to_claim' =>$p_claimto ,
       	                   'from_claim' =>$p_claomfrom 
                             );
//p($parameter);
//exit;

	   $pathReportSide  = base_url()."api/business_admin/ssarepotsearch/format/json/";
       $rep_response  = curlcall($parameter, $pathReportSide);
      // echo json_encode($rep_response);



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
           $arr[$i]['n_BusinessId']=$value->n_BusinessId;
            $arr[$i]['n_DeptId']=$value->n_DeptId;
            $arr[$i]['n_CreatedBy']=$value->n_CreatedBy;
            $arr[$i]['n_PolicyId']=$value->n_PolicyId;
            $i++;
        }
        echo json_encode($arr);
    }
}

 // ############################################# END SHEETESH DUBEY######

} // End class claim repot  Rahul 