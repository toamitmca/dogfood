<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Dashboard2 extends MX_Controller {
 
  public function __construct() {
	$this->load->model("supper_admin");	
	$this->load->helper('my_helper');
  }

  public function index(){
   $this->login_check();
   $this->load->view('layout/header');
   $this->load->view('layout/footer');
  }

 public function expensesave(){
 	   $this->load->view('layout/header');
 	   $userId= checklogin();
	   $policyid=$userId['n_PolicyId'];
	   $parameter_policy = array( 
	                                  'act_mpde' => 'view',
	                                  'id'=>$policyid
	                               );

	    $path_policy  = base_url().'api/business_manage/ssapolicylist1/format/json/';
	    $response['policyname']  = curlcall($parameter_policy, $path_policy);
      // REPORT DETAILS BY USER ID
      $myu_id=$userId['a_SId'];
      $parameter_report = array( 'e_Id' => null,'act_mode' => 'viewbyid','e_UserId' => $myu_id );
      $path_report  = base_url().'api/employeereport/myexpreport/format/json/';
      $response['report']  = curlcall($parameter_report, $path_report);
      // REPORT DETAILS BY USER ID END

       // REPORT DETAILS BY USER ID
      $myu_id=$userId['a_SId'];
      $parameter_report = array( 'e_Id' => null,'act_mode' => 'viewexpbyid','e_UserId' => $myu_id );
      $path_report  = base_url().'api/employeereport/myexpreport/format/json/';
      $response['expence']  = curlcall($parameter_report, $path_report);
      // REPORT DETAILS BY USER ID END
      $parameterAssign = array( 'policyid' => $policyid );
	    $pathAssign =base_url().'api/business_manage/ssapolicycategoryedit/format/json/';
	    $responseAssign  = curlcall($parameterAssign, $pathAssign);
	    if($responseAssign=='Something Went Wrong'){
	      $response['policyAssign']='';
	    }else{
	      $response['policyAssign']  = $responseAssign;
	    }
	  // api call from the expense list
	    $param = array(
	    	             'userId'     => $userId['a_SId'],
	    	             'businessId' => $userId['business_id']
	    	           );
	    $expensepath     = base_url().'api/employee/displayexpensereport/format/json/';
	    $responseAssign  = curlcall($param , $expensepath);

	  // api call ends for expense list
 	 $path_policy  = base_url().'api/business_manage/ssapolicylist1/format/json/';
     $response['policyname']  = curlcall($parameter_policy, $path_policy);
 	 $this->load->view('expensesreport',$response);
 }

  public function expensesave2(){
   $this->load->view('layout/header');
   $userId= checklogin();
   // p($userId);
   // exit();
   $policyid=$userId['n_PolicyId'];
   $parameter_policy = array(
                              'act_mpde' => 'view',
                                  'id'=>$policyid
                               );
    $path_policy  = base_url().'api/business_manage/ssapolicylist1/format/json/';
    $response['policyname']  = curlcall($parameter_policy, $path_policy);

    $parameterAssign = array( 'policyid' => $policyid );
    $pathAssign =base_url().'api/business_manage/ssapolicycategoryedit/format/json/';
    $responseAssign  = curlcall($parameterAssign, $pathAssign);
    if($responseAssign=='Something Went Wrong'){
      $response['policyAssign']='';
    }else{
      $response['policyAssign']  = $responseAssign;
    }
   $this->load->view('expensesreport3',$response);
 }


  public function reportfirst(){
     $this->load->view('layout/header');
     $this->load->view('firstreport');
     $this->load->view('layout/footer');
  }

   public function reportfirst2(){
 	   $data = checklogin();
     $loginId = $data['a_SId'];
     $busid   = $data['business_id'];
	   $this->load->view('layout/header');
	   $id      = $loginId; // this is the business id
	   // now policy id here
     $policyid = $data['n_PolicyId'];
	   // now policy id ends here

	    $data['mycategory'] = $this->getcategory($id);
	    $data['getspcat']   = $this->getspcat($id); 

      //policy Name
		  $parameter_policy = array('act_mpde' => 'view', 'id'=>$policyid);
      $path_policy  = base_url().'api/business_manage/ssapolicylist1/format/json/';
      $data['policyname']  = curlcall($parameter_policy, $path_policy);
      //p($data['policyname'] );
     // exit();
      //end policy Name

      //policy assign
       $parameterAssign = array( 'pol_id' => $policyid, 'bus_id' => $busid,'act_mode' => 'view');
      $pathAssign      = base_url().'api/employeereport/spandcatbybusid/format/json/';
      $responseAssign  = curlcall($parameterAssign, $pathAssign);
      //end policy assign
   //p($parameterAssign);
     // exit();
      $parametercity = array('c_id' => '', 'act_mode' => 'view' );
      $pathcity      = base_url().'api/employeereport/cityemp/format/json/';
      $data['list']  = curlcall($parametercity, $pathcity);

      // policyspndcatmy

      $parameterspndcat = array('s_id' => $policyid, 'act_mode' => 'viewjoin' );
      $pathspndcat      = base_url().'api/employeereport/myspndcat/format/json/';
      $data['spnd']  = curlcall($parameterspndcat, $pathspndcat);

      // End policyspndcatmy

      // customtag1
      $parametercustomtag1 = array('c_id' => null, 'bus_id' => $busid ,'act_mode' => 'viewc1' );
      //p($parametercustomtag1);
      $pathcustomtag1       = base_url().'api/employeereport/mycustomcat/format/json/';
      $data['customtag1']  = curlcall($parametercustomtag1, $pathcustomtag1);
      // End customtag1

      //print_r($data['customtag1']);

      // customtag2
      $parametercustomtag2 = array('c_id' => null, 'bus_id' => $busid ,'act_mode' => 'viewc2' );
      //p($parametercustomtag1);
      $pathcustomtag2       = base_url().'api/employeereport/mycustomcat/format/json/';
      $data['customtag2']  = curlcall($parametercustomtag2, $pathcustomtag2);
      //p($customtag2);
      //exit()
      // End customtag2
      //print_r($data['customtag2']);
      $parametercurrency = array('busid' => $busid ,'act_mode' => 'view' );
      //p($parametercurrency);
      $pathcurreny         = base_url().'api/employeereport/mycurrency/format/json/';
      $data['curreny']     = curlcall($parametercurrency, $pathcurreny);
      //p($data['curreny']);
      //exit();
      if($responseAssign=='Something Went Wrong'){
     		 $data['policyAssign']='';
      }else{
      	$data['policyAssign']  = $responseAssign;
   	  }
   //p($data['policyAssign']);
  // exit();
	    $this->load->view('firstreport2', $data);
	    $this->load->view('layout/footer');

  }


  public function editclaim(){
                $data = checklogin();
            $loginId = $data['a_SId'];
            $id = $loginId; // this is the business id
            $policyid=$data['n_PolicyId'];
            $data['mycategory'] = $this->getcategory($id);
            $data['getspcat']   = $this->getspcat($id);
	$parameter_policy = array( 'act_mpde' => 'view',  'id'=>$policyid );
    $path_policy  = base_url().'api/business_manage/ssapolicylist1/format/json/';
    $data['policyname']  = curlcall($parameter_policy, $path_policy);
    $parameterAssign = array( 'policyid' => $policyid );
    $pathAssign 	   = base_url().'api/business_manage/ssapolicycategoryedit/format/json/';
      $responseAssign  = curlcall($parameterAssign, $pathAssign);
      if($responseAssign=='Something Went Wrong'){
     		 $data['policyAssign']='';
      }else{
      	$data['policyAssign']  = $responseAssign;
   	  }
   	// claim starts here
       $reportId =$_POST['reportid'];
   	   // $reportId = $this->uri->segment(4);
   	 	// api call from the expense list
	    $param = array(
	    	             'userId'     => $data['a_SId'],
	    	             'businessId' => $data['business_id'],
	    	             'reprotId'   => $reportId,
	    	             'actMode'    => 'claimreport'
	    	           );
	    $expensepath= base_url().'api/employee/displaysinglereport/format/json/';
	    $data['claimreport']    = curlcall($param , $expensepath);
		if($data['claimreport'] =="Something Went Wrong"){
			redirect('employee/claim');
			exit();
	    }

      $parameterexpvoilation = array('row_id' => $reportId,'act_mode' => 'view');
      //print_r($parameterexpvoilation);
      $expensepath1= base_url().'api/employeereport/expvoilations/format/json/';
      $data['expvoil']    = curlcall($parameterexpvoilation , $expensepath1);
       //print_r($data['expvoil']);
      if($data['expvoil'] =="Something Went Wrong"){
      redirect('employee/claim');
      exit();
      }

	   //	$this->load->view('layout/header');
	   	// now getting if there are any notes
	   	$param = array(
	    	             'userId'     => $data['a_SId'],
	    	             'businessId' => $data['business_id'],
	    	             'reprotId'   => $reportId,
	    	             'actMode'    => 'claimreportnotes'
	    	           );
	    $expensepath      = base_url().'api/employee/displaysinglereport/format/json/';
	    $data['notes']    = curlcall($param , $expensepath);
	   	// now getting if there are any notes
	   	// Now getting the the expense list bottom
		$param = array(
	    	             'userId'     => $data['a_SId'],
	    	             'businessId' => $data['business_id'],
	    	             'reprotId'   => $reportId,
	    	             'actMode'    => 'claimreportexpense'
	    	           );
		$expensepath      = base_url().'api/employee/displaysinglereport/format/json/';
	    $data['expenselist']    = curlcall($param , $expensepath);
$status=$_POST['sdata'];
if($status=="1"){
$this->load->view('firstreportedit',$data);  // edit mode
}
else{
$this->load->view('reportviewemp', $data); // Read only mode
}


      // Now getting the expense list bottom ends here
	    /*if($data['claimreport'] =='submit'){
			$this->load->view('firstreportedit', $data);
		}else{
			$this->load->view('firstreportedit', $data);
		}*/
	    //$this->load->view('layout/footer');

   	// claim ends here 

}

public function editclaimhello(){

$this->load->view('layout/header');
                $data = checklogin();
            $loginId = $data['a_SId'];
            $id = $loginId; // this is the business id
            $policyid=$data['n_PolicyId'];
            $busid=$data['business_id'];
            $data['mycategory'] = $this->getcategory($id);
            $data['getspcat']   = $this->getspcat($id);
            $parameter_policy = array( 'act_mpde' => 'view',  'id'=>$policyid );
            $path_policy  = base_url().'api/business_manage/ssapolicylist1/format/json/';
            $data['policyname']  = curlcall($parameter_policy, $path_policy);
    


      $parameterAssign = array( 'pol_id' => $policyid, 'bus_id' => $busid,'act_mode' => 'view');
      $pathAssign      = base_url().'api/employeereport/spandcatbybusid/format/json/';
      $responseAssign  = curlcall($parameterAssign, $pathAssign);
     
      if($responseAssign=='Something Went Wrong'){
         $data['policyAssign']='';
      }else{
        $data['policyAssign']  = $responseAssign;
      }
    // claim starts here
       $reportId =$this->uri->segment(4);

       // $reportId = $this->uri->segment(4);
      // api call from the expense list
      $param = array(
                     'userId'     => $data['a_SId'],
                     'businessId' => $data['business_id'],
                     'reprotId'   => $reportId,
                     'actMode'    => 'claimreport'
                   );
      $expensepath= base_url().'api/employee/displaysinglereport/format/json/';
      $data['claimreport']    = curlcall($param , $expensepath);
    if($data['claimreport'] =="Something Went Wrong"){
      redirect('employee/claim');
      exit();
      }

      $parameterexpvoilation = array('row_id' => $reportId,'act_mode' => 'view');
      //print_r($parameterexpvoilation);
      $expensepath1= base_url().'api/employeereport/expvoilations/format/json/';
      $data['expvoil']    = curlcall($parameterexpvoilation , $expensepath1);
       //print_r($data['expvoil']);
     
      if($data['expvoil'] =="Something Went Wrong"){
      redirect('employee/claim');
      exit();
      }


   $parametercurrency = array('busid' => $busid ,'act_mode' => 'view' );
      //p($parametercurrency);
      $pathcurreny         = base_url().'api/employeereport/mycurrency/format/json/';
      $data['curreny']     = curlcall($parametercurrency, $pathcurreny);
     // $this->load->view('layout/header');
      // now getting if there are any notes
      $param = array(
                     'userId'     => $data['a_SId'],
                     'businessId' => $data['business_id'],
                     'reprotId'   => $reportId,
                     'actMode'    => 'claimreportnotes'
                   );
      $expensepath      = base_url().'api/employee/displaysinglereport/format/json/';
      $data['notes']    = curlcall($param , $expensepath);
      // now getting if there are any notes
      // Now getting the the expense list bottom
    $param = array(
                     'userId'     => $data['a_SId'],
                     'businessId' => $data['business_id'],
                     'reprotId'   => $reportId,
                     'actMode'    => 'claimreportexpense'
                   );
    $expensepath      = base_url().'api/employee/displaysinglereport/format/json/';
      $data['expenselist']    = curlcall($param , $expensepath);
      
$status=$this->uri->segment(5);
if($status=="1"){
$this->load->view('firstreportedit',$data);  // edit mode
}
else{
$this->load->view('reportviewemp', $data); // Read only mode
}
$this->load->view('layout/footer');
}

function submittedexpense(){

$data = checklogin();
 	$loginId = $data['a_SId']; 
 	$id = $loginId; // this is the business id 
 	$policyid=$data['n_PolicyId'];
 	$data['mycategory'] = $this->getcategory($id);
	$data['getspcat']   = $this->getspcat($id);
	$parameter_policy = array( 
                                  'act_mpde' => 'view',
                                  'id'=>$policyid
                                 );
    $path_policy  = base_url().'api/business_manage/ssapolicylist1/format/json/';
    $data['policyname']  = curlcall($parameter_policy, $path_policy);
    $parameterAssign = array( 'policyid' => $policyid );
    $pathAssign 	   = base_url().'api/business_manage/ssapolicycategoryedit/format/json/';
      $responseAssign  = curlcall($parameterAssign, $pathAssign);
      //p($responseAssign);
      //exit();
      if($responseAssign=='Something Went Wrong'){
     		 $data['policyAssign']='';
      }else{
      	$data['policyAssign']  = $responseAssign;
   	  }
   	// claim starts here
   	    $reportId = $this->uri->segment(4);
   	 	// api call from the expense list
	    $param = array(     
	    	             'userId'     => $data['a_SId'],
	    	             'businessId' => $data['business_id'],
	    	             'reprotId'   => $reportId,
	    	             'actMode'    => 'claimreport'
	    	           );

	    $expensepath            = base_url().'api/employee/displaysinglereport/format/json/';
	    $data['claimreport']    = curlcall($param , $expensepath);
		if($data['claimreport'] =="Something Went Wrong"){
			redirect('employee/claim');
			exit();
	    }

	   	$this->load->view('layout/header');
	   	// now getting if there are any notes
	   	$param = array(     
	    	             'userId'     => $data['a_SId'],
	    	             'businessId' => $data['business_id'],
	    	             'reprotId'   => $reportId,
	    	             'actMode'    => 'claimreportnotes'
	    	           );
	    $expensepath      = base_url().'api/employee/displaysinglereport/format/json/';
	    $data['notes']    = curlcall($param , $expensepath);

	   	// now getting if there are any notes
	   	// Now getting the the expense list bottom
		$param = array(     
	    	             'userId'     => $data['a_SId'],
	    	             'businessId' => $data['business_id'],
	    	             'reprotId'   => $reportId,
	    	             'actMode'    => 'claimreportexpense'
	    	           );
		$expensepath      = base_url().'api/employee/displaysinglereport/format/json/';
	    $data['expenselist']    = curlcall($param , $expensepath);

	   
	    // Now getting the expense list bottom ends here

	    if($data['claimreport'] =='submit'){
			$this->load->view('viewexpense', $data);
		}else{
			$this->load->view('viewexpense', $data);
		}
	    $this->load->view('layout/footer');
	    
}

function getcategory(){

 $businessid = $this->session->userdata['sessionData']['business_id'];

		  	 $parameter_sp_cat = array(

                             'n_BusinessId' => $businessid
							 );
         //p($parameter_sp_cat);

          $path  = base_url()."api/business_manage/getdtpcattag/format/json/";
          $responseState  = curlcall($parameter_sp_cat, $path);
          if(!empty($responseState)){
            return $responseState;
          }else{
            return false;
          }
}

public function getspcat($id){
	 $arrayName = array('id' =>$id);
	 $path  = base_url()."api/employee/empspandcat/format/json/";
	 $response  = curlcall($arrayName, $path);
	 return $response;
}

  public function reportsubmit(){
           $data = checklogin();
           $businessId = $data['business_id'];
           $userId     = $data['a_SId']; 
           $n_DeptId   = $data['n_DeptId']; 
           $n_policyId = $data['n_PolicyId'];

           $parameter = array( 'report_name'         => $this->input->post('report_name'),
                               'report_type'         => $this->input->post('report_type'),
                               'status'              => $this->input->post('status'),
                               'chaim_period_form'   => date('Y-m-d', strtotime($this->input->post('chaim_period_form'))),
                               'cash_advance'        => $this->input->post('cash_advance'),
                               'chaim_period_to'     => date('Y-m-d', strtotime($this->input->post('chaim_period_to'))),
                               'description'         => $this->input->post('description'),
                               'n_BusinessId'        => $businessId,
                               'n_AdminType'         => '',
                               'row_id'              => '',
                               'act_mode'            => 'addempreport',
                               'userid'              => $userId,
                               'b_IsVoilated'        => $this->input->post('b_IsVoilated'),
                               'buttonType'          => $this->input->post('buttonType'),
                               'grandtotal'          => $this->input->post('grandtotal'),
                               'n_DeptId'            => $n_DeptId,
                               'n_policyId'          => $n_policyId ,
                               'attchment1'           =>$this->input->post('attchment1'),
                               'attchment2'           =>$this->input->post('attchment2'),
                               'attchment3'           =>$this->input->post('attchment3')
                               );
		 
           $path      = base_url()."api/employeereport/empreport/format/json/";
           $response  = curlcall($parameter, $path);
           // sending the last inserted id
           
           $ddt=$response->MYDT;

          
           $did=$response->ID;
        
           $ddt1=date('d M,Y', strtotime($ddt));
           $mydata = array('MID' => $did, 'MYDATE' => $ddt1);
         
           echo json_encode($mydata);

           $myarray = $this->input->post('kancha');
           if(!empty($myarray)){
           	  $xml =htmlentities("<NewDataSet>");
              foreach ($myarray as $key => $value) {
        
                $xml .=htmlentities('<tblrptnote><t_NoteDesc>'.$value.'</t_NoteDesc></tblrptnote>');
              }
              $xml .=htmlentities("</NewDataSet>");
	           // api calls ends here
	           $parameter1 = array(
                              'lstId'      => $response->ID,
                              'notesArray' => (html_entity_decode($xml, ENT_QUOTES, 'UTF-8')),
                              'businessId' => $data['business_id'],
                   					  'userId'    => $data['a_SId'],
                   					  't_Type'    => 'Employee'
                              );
           
    	       $path1  = base_url()."api/employeereport/empreportNote/format/json/";
    	       $response  = curlcall($parameter1, $path1);
             // echo  $data1 = json_encode($response); 
			   
			}
              
         
}

public function mynotesubmit()
{
  $data = checklogin();
           $businessId = $data['business_id'];
           $userId     = $data['a_SId']; 
           $n_DeptId   = $data['n_DeptId']; 
           $n_policyId = $data['n_PolicyId'];
           $myarray = $this->input->post('note');
           $myid = $this->input->post('id');
           if(!empty($myarray)){
           $xml =htmlentities("<NewDataSet>");
           foreach ($myarray as $key => $value) {
           $xml .=htmlentities('<tblrptnote><t_NoteDesc>'.$value.'</t_NoteDesc></tblrptnote>');
           }
           $xml .=htmlentities("</NewDataSet>");
             // api calls ends here
           $parameter1 = array(
                              'lstId'      => $myid,
                              'notesArray' => (html_entity_decode($xml, ENT_QUOTES, 'UTF-8')),
                              'businessId' => $data['business_id'],
                              'userId'     => $data['a_SId'],
                              't_Type'     => 'Employee'
                              );
          //p($parameter1);
           
             $path1  = base_url()."api/employeereport/empreportmyNote/format/json/";
             $response  = curlcall($parameter1, $path1);
           // p($parameter1);
            // exit();
           }

}


public function singleexpupdate()
{
 $catt=$_POST['catval1'];
 $caitt=explode('-', $catt);
 $ctt2=$caitt[0];

    $parameter = array('ex_id'           => $this->input->post('rowid'), 
                       'ex_catval1'      => $ctt2,
                       'ex_dateval1'     => date('Y-m-d', strtotime($this->input->post('dateval1'))),
                       'ex_amountval1'   => $this->input->post('amountval1'),
                       'ex_merchantval1' => $this->input->post('merchantval1'),
                       'ex_purposeval1'  => $this->input->post('purposeval1'),
                       'ex_reimbval1'    => $this->input->post('reimbval1'),
                       'ex_tagval1'      => $this->input->post('tagval1'),
                       'ex_voilaval1'    => $this->input->post('voilaval1')
                      );

    // p($parameter);

             $path1  = base_url()."api/employeereport/empexpupdate/format/json/";
             $response  = curlcall($parameter, $path1);

            // p($response);
            // exit(); 
             echo json_encode($response);
             exit();
 }
public function deleteexpsingle()
{

 $parameter = array('ex_id' => $this->input->post('row_id'), 'act_mode' => 'deleteexp');
 //p($parameter);
   $path1  = base_url()."api/employeereport/deltexp/format/json/";
   $response  = curlcall($parameter, $path1);
   // p($response);
     exit();
   echo json_encode($response);
             exit();
}
public function deletereport(){
	$id = trim($_POST['reportId']);
	$data = checklogin();
    $businessId = $data['business_id'];
    $userId     = $data['a_SId']; 
    $n_DeptId   = $data['n_DeptId']; 

	$param = array(
			         'reportId'   => $id,
			         'userId'     => $userId,
			         'businessId' => $businessId
			         );
	$path1  = base_url()."api/employeereport/deletereport/format/json/";
    $response  = curlcall($param, $path1);
    $this->session->set_flashdata('message', 'Reported Deleted Successfully');
    echo json_encode($response);
}

public function deletenote(){
	$id = trim($_POST['reportId']);
	$data = checklogin();
	$businessId = $data['business_id'];
    $userId     = $data['a_SId']; 
    $n_DeptId   = $data['n_DeptId']; 
	$param = array(
			         'reportId'   => $id,
			         'userId'     => $userId,
			         'businessId' => $businessId
		         );
	$path1  = base_url()."api/employee/deletenote/format/json/";
    $response  = curlcall($param, $path1);
    $this->session->set_flashdata('message', 'Reported Deleted Successfully');
    echo json_encode($param);

}



public function expencepolicymapsubmit(){
	$data = checklogin();
    $businessId = $data['business_id'];
    $userId     = $data['a_SId']; 

    $categoryval		  =	json_decode($_POST['categoryval']);
    $datevalval			  =	json_decode($_POST['datevalval']);
    $amountval			  =	json_decode($_POST['amountval']);
    $merchantval		  =	json_decode($_POST['merchantval']);
    $purpose          = json_decode($_POST['purpose']); 
    $reimbval			    =	json_decode($_POST['reimbval']);
    $tagval				    =	json_decode($_POST['tagval']);
    $violationstatus  = json_decode($_POST['violationstatus']);


  //p($amountval); 
  //echo count($amountval);
        $xml =htmlentities("<NewDataSet>");
    	for($i=0;$i<count($amountval);$i++){
($categoryval[$i]); 
           if(!empty($amountval[$i])){
            $catid= explode("-",$categoryval[$i]);
           //print_r($$catid);
             //print_r($catid[1]);




             $catname= explode("*",$catid[1]);
   //($catname);
            
           $mycatid = $catid[0];
           // p($mycatid);
           $mycatname = $catname[0];
      //exit();
            if(($mycatname!='Lodging') OR ($mycatname!='Air Travel' ) OR ($mycatname!='Ground Travel' ))
            { //echo  $mycatid; echo "helo";
              //echo $mycatname; 
              $xml .=htmlentities("<tblpolicycategorymap>");
        	    $xml .=htmlentities('<n_ExpType>'.$mycatid.'</n_ExpType>');
        	    $xml .=htmlentities('<d_Date>'.date('Y-m-d', strtotime($datevalval[$i])).'</d_Date>');
        	    $xml .=htmlentities('<t_Amount>'.$amountval[$i].'</t_Amount>');
        	    $xml .=htmlentities('<t_Merchant>'.$merchantval[$i].'</t_Merchant>');
        	    $xml .=htmlentities('<t_Purpose>'.$purpose[$i].'</t_Purpose>');
        	    $xml .=htmlentities('<b_IsReimburs>'.$reimbval[$i].'</b_IsReimburs>');
        	    $xml .=htmlentities('<b_IsVoilated>'.$violationstatus[$i].'</b_IsVoilated>');
        	    $xml .=htmlentities("</tblpolicycategorymap>");
        	}
        }
      }
    
        $xml .=htmlentities("</NewDataSet>");

			$parameter = array(
					             'xmlval'     => html_entity_decode($xml, ENT_QUOTES, 'UTF-8'),
					             'businessId' => $businessId,
					             'userId'     => $userId,
					             'n_ReportId' => $_POST['Report_Id']
					          );
     
	
         $path      = base_url()."api/employeereport/expencepolicymapsave11/format/json/";
         $response  = curlcall($parameter, $path);

     // p($response);
      //exit();
         //echo json_encode($parameter);
         
}



public function test(){
p($_POST);
exit;

}


public function expenceaddupdate(){
  $data = checklogin();
    $businessId = $data['business_id'];
    $userId     = $data['a_SId']; 

    $categoryval      = json_decode($_POST['categoryval']);
    $datevalval       = json_decode($_POST['datevalval']);
    $amountval        = json_decode($_POST['amountval']);
    $merchantval      = json_decode($_POST['merchantval']);
    $purpose          = json_decode($_POST['purpose']); 
    $reimbval         = json_decode($_POST['reimbval']);
    $tagval           = json_decode($_POST['tagval']);
    $violationstatus  = json_decode($_POST['violationstatus']);
    $report_file1  = json_decode($_POST['report_file1']);
    $report_file2  = json_decode($_POST['report_file2']);
    $report_file3  = json_decode($_POST['report_file3']);


  //p($amountval); 
  //echo count($amountval);
        $xml =htmlentities("<NewDataSet>");
      for($i=0;$i<count($amountval);$i++){
//p($categoryval[$i]); 
           if(!empty($amountval[$i])){
            $catid= explode("-",$categoryval[$i]);
             //print_r($catid);
           //  print_r($catid[1]);

             $catname= explode("@",$catid[1]);
  // print_r($catname);

           $mycatid = $catid[0];
          // p($mycatid);
           $mycatname = $catname[0];
    // exit();
            if(($mycatname!='Lodging') OR ($mycatname!='Air Travel' ) OR ($mycatname!='Ground Travel' ))
            { //echo  $mycatid; echo "helo";
              //echo $mycatname; 
              $xml .=htmlentities("<tblpolicycategorymap>");
              $xml .=htmlentities('<n_ExpType>'.$mycatid.'</n_ExpType>');
              $xml .=htmlentities('<d_Date>'.date('Y-m-d', strtotime($datevalval[$i])).'</d_Date>');
              $xml .=htmlentities('<t_Amount>'.$amountval[$i].'</t_Amount>');
              $xml .=htmlentities('<t_Merchant>'.$merchantval[$i].'</t_Merchant>');
              $xml .=htmlentities('<t_Purpose>'.$purpose[$i].'</t_Purpose>');
              $xml .=htmlentities('<b_IsReimburs>'.$reimbval[$i].'</b_IsReimburs>');
              $xml .=htmlentities('<b_IsVoilated>'.$violationstatus[$i].'</b_IsVoilated>');
              $xml .=htmlentities('<report_file1>'.$report_file1[$i].'</report_file1>');
              $xml .=htmlentities('<report_file2>'.$report_file2[$i].'</report_file2>');
              $xml .=htmlentities('<report_file3>'.$report_file3[$i].'</report_file3>');
              $xml .=htmlentities("</tblpolicycategorymap>");
          }
        }
      }
    
        $xml .=htmlentities("</NewDataSet>");

      $parameter = array(
                       'xmlval'     => html_entity_decode($xml, ENT_QUOTES, 'UTF-8'),
                       'businessId' => $businessId,
                       'userId'     => $userId,
                       'n_ReportId' => $_POST['Report_Id']
                    );

         $path      = base_url()."api/employeereport/expenseAddEdit/format/json/";
         $response  = curlcall($parameter, $path);

     // p($response);
      //exit();
         echo json_encode($response);
         
}

public function expencetravel(){
    $data = checklogin();
    $businessId       = $data['business_id'];
    $userId           = $data['a_SId']; 
    $categoryval      = $_POST['categoryval'];
    $typeval          = $_POST['typeval'];
    $datevalval       =  date('Y-m-d', strtotime($_POST['datevalval']));
    $amountval        = $_POST['amountval'];
    $distanceval      = $_POST['distanceval'];
    $purposeval       = $_POST['purposeval'];
    $cityval          = $_POST['cityval'];
    $gpsval           = $_POST['gpsval'];
    $reimbval         = $_POST['reimbval'];
    $glcodeval        = $_POST['glcodeval'];
    $tagval1          = $_POST['tagval1'];
    $tagval2          = $_POST['tagval2']; 
    $Report_Id        = $_POST['Report_Id'];
    $violationstatus  = $_POST['violationstatus'];
    $othercityval     = $_POST['othercityval'];

   

        $parameter = array( 'e_id'              => '',
                            'act_mode'          => 'insert',
                            'e_categoryval'     => $categoryval,
                            'e_typeval'         => $typeval,
                            'e_datevalval'      => $datevalval,
                            'e_amountval'       => $amountval, 
                            'e_distanceval'     => $distanceval,
                            'e_purposeval'      => $purposeval,
                            'e_cityval'         => $cityval,
                            'e_gpsval'          => $gpsval,
                            'e_reimbval'        => $reimbval,
                            'e_glcodeval'       => $glcodeval,
                            'e_tagval1'         => $tagval1,
                            'e_tagval2'         => $tagval2,
                            'e_Report_Id'       => $Report_Id,
                            'e_violationstatus' => $violationstatus,
                            'e_othercityval'    => $othercityval,
                            'e_busid'           => $businessId,
                            'e_userid'          => $userId
                           );

          // $myarray = $this->input->post('kancha');
           // api calls start
//p($parameter);
//exit();
    
         $path      = base_url()."api/employeereport/myexpencetravel/format/json/";
         $response  = curlcall($parameter, $path);
      //  p($response);
//exit();


            $myarray = sizeof($_POST['notesval']);
           if($myarray>0){
              $xml =htmlentities("<NewDataSet>");
              for($i=0;$i<$myarray;$i++)
               {   $mynt=$_POST['notesval'][$i];
                $xml .=htmlentities('<tblrptnote><t_NoteDesc>'.$mynt.'</t_NoteDesc></tblrptnote>');
              }
              $xml .=htmlentities("</NewDataSet>");
             // api calls ends here
             $parameter1 = array(
                              'lstId'      => $Report_Id,
                              'notesArray' => (html_entity_decode($xml, ENT_QUOTES, 'UTF-8')),
                              'businessId' => $businessId,
                              'userId'    =>  $userId,
                              't_Type'    => 'Employee'
                              );
           
             $path1  = base_url()."api/employeereport/empreportNote/format/json/";
             $response  = curlcall($parameter1, $path1);
}
         echo json_encode($response);
         
}



public function expencelodging(){
    $data = checklogin();
    $businessId       = $data['business_id'];
    $userId           = $data['a_SId']; 
    $categoryval      = $_POST['categoryval'];
    $typeval          = $_POST['typeval'];
    $datevalval       = date('Y-m-d', strtotime($_POST['datevalval']));
    $amountval        = $_POST['amountval'];
    $hotelval         = $_POST['hotelval'];
    $purposeval       = $_POST['purposeval'];
    $bookingval       = $_POST['bookingval'];
    $cityval          = $_POST['cityval'];
    $gpsval           = $_POST['gpsval'];
    $reimbval         = $_POST['reimbval'];
    $glcodeval        = $_POST['glcodeval'];
    $tagval1          = $_POST['tagval1'];
    $tagval2          = $_POST['tagval2']; 
    $Report_Id        = $_POST['Report_Id'];
    $violationstatus  = $_POST['violationstatus'];
    $othercityval     = $_POST['othercityval'];
    $checkinval       = date('Y-m-d', strtotime($_POST['checkinval']));
    $checkoutval      = date('Y-m-d', strtotime($_POST['checkoutval']));
   

        $parameter = array( 'e_id'              => '',
                            'act_mode'          => 'insert',
                            'e_categoryval'     => $categoryval,
                            'e_typeval'         => $typeval,
                            'e_datevalval'      => $datevalval,
                            'e_amountval'       => $amountval, 
                            'e_hotelval'        => $hotelval,
                            'e_purposeval'      => $purposeval,
                            'e_bookingval'      => $bookingval,
                            'e_cityval'         => $cityval,
                            'e_checkinval'      => $checkinval,
                            'e_checkoutval'     => $checkoutval,
                            'e_gpsval'          => $gpsval,
                            'e_reimbval'        => $reimbval,
                            'e_glcodeval'       => $glcodeval,
                            'e_tagval1'         => $tagval1,
                            'e_tagval2'         => $tagval2,
                            'e_Report_Id'       => $Report_Id,
                            'e_violationstatus' => $violationstatus,
                            'e_othercityval'    => $othercityval,
                            'e_busid'           => $businessId,
                            'e_userid'          => $userId
                           );
//p($parameter);
//          // $myarray = $this->input->post('kancha');
           // api calls start
//p($parameter);
//exit();
    
         $path      = base_url()."api/employeereport/myexpencelodging/format/json/";
         $response  = curlcall($parameter, $path);
     //p($response);
//exit();
         echo json_encode($response);


            $myarray = sizeof($_POST['notesval']);
           if($myarray>0){
              $xml =htmlentities("<NewDataSet>");
              for($i=0;$i<$myarray;$i++)
               {   $mynt=$_POST['notesval'][$i];
                $xml .=htmlentities('<tblrptnote><t_NoteDesc>'.$mynt.'</t_NoteDesc></tblrptnote>');
              }
              $xml .=htmlentities("</NewDataSet>");
             // api calls ends here
             $parameter1 = array(
                              'lstId'      => $Report_Id,
                              'notesArray' => (html_entity_decode($xml, ENT_QUOTES, 'UTF-8')),
                              'businessId' => $businessId,
                              'userId'    =>  $userId,
                              't_Type'    => 'Employee'
                              );
           
             $path1  = base_url()."api/employeereport/empreportNote/format/json/";
             $response  = curlcall($parameter1, $path1);
}
         //echo json_encode($response);
         
}


public function expenceAirtaveling(){
    $data = checklogin();
    $businessId       = $data['business_id'];
    $userId           = $data['a_SId']; 
    $categoryval      = $_POST['categoryval'];
    $typeval          = $_POST['typeval'];
    $datevalval       = date('Y-m-d', strtotime($_POST['datevalval']));
    $amountval        = $_POST['amountval'];
    $carrierval       = $_POST['carrierval'];
    $purposeval       = $_POST['purposeval'];
    $bookingval       = $_POST['bookingval'];
    $cityval          = $_POST['cityval'];
    $gpsval           = $_POST['gpsval'];
    $reimbval         = $_POST['reimbval'];
    $glcodeval        = $_POST['glcodeval'];
    $tagval1          = $_POST['tagval1'];
    $tagval2          = $_POST['tagval2']; 
    $Report_Id        = $_POST['Report_Id'];
    $violationstatus  = $_POST['violationstatus'];
     $othercityval     = $_POST['othercityval'];
    $startval         = date('Y-m-d', strtotime($_POST['startval']));
    $returnval        = date('Y-m-d', strtotime($_POST['returnval']));
    $fromval          = $_POST['fromval'];
    $toval            = $_POST['toval']; 

   

        $parameter = array( 'e_id'              => '',
                            'act_mode'          => 'insert',
                            'e_categoryval'     => $categoryval,
                            'e_typeval'         => $typeval,
                            'e_datevalval'      => $datevalval,
                            'e_amountval'       => $amountval, 
                            'e_carrierval'      => $carrierval,
                            'e_purposeval'      => $purposeval,
                            'e_bookingval'      => $bookingval,
                            'e_cityval'         => $cityval,
                            'e_startval'        => $startval,
                            'e_endval'          => $returnval,
                            'e_gpsval'          => $gpsval,
                            'e_reimbval'        => $reimbval,
                            'e_glcodeval'       => $glcodeval,
                            'e_tagval1'         => $tagval1,
                            'e_tagval2'         => $tagval2,
                            'e_Report_Id'       => $Report_Id,
                            'e_violationstatus' => $violationstatus,
                            'e_othercityval'    => $othercityval,
                            'e_fromval'         => $fromval,
                            'e_toval'           => $toval,
                            'e_busid'           => $businessId,
                            'e_userid'          => $userId
                           );
//p($parameter);
//          // $myarray = $this->input->post('kancha');
           // api calls start
//p($parameter);

    
         $path      = base_url()."api/employeereport/mytAirTravelExpences/format/json/";
         $response  = curlcall($parameter, $path);
       //p($response);

//exit();

         echo   $myarray = sizeof($_POST['notesval']);
           if($myarray>0){
              $xml =htmlentities("<NewDataSet>");
              for($i=0;$i<$myarray;$i++)
               {  echo $mynt=$_POST['notesval'][$i];
                $xml .=htmlentities('<tblrptnote><t_NoteDesc>'.$mynt.'</t_NoteDesc></tblrptnote>');
              }
              $xml .=htmlentities("</NewDataSet>");
             // api calls ends here
             $parameter1 = array(
                              'lstId'      => $Report_Id,
                              'notesArray' => (html_entity_decode($xml, ENT_QUOTES, 'UTF-8')),
                              'businessId' => $businessId,
                              'userId'    =>  $userId,
                              't_Type'    => 'Employee'
                              );
           
             $path1  = base_url()."api/employeereport/empreportNote/format/json/";
             $response  = curlcall($parameter1, $path1);
}
         //echo json_encode($response);
         
}



public function expencepolicymap(){
     
           $parameter = array( 'report_name'         => $this->input->post('report_name'),
                               'report_type'         => $this->input->post('report_type'),
                               'status'              => $this->input->post('status'),
                               'chaim_period_form'   => $this->input->post('chaim_period_form'),
                               'cash_advance'        => $this->input->post('cash_advance'),
                               'chaim_period_to'     => $this->input->post('chaim_period_to'),
                               'description'         => $this->input->post('description'),
                               'n_BusinessId'        => '',
                               'n_AdminType'         => '',
                               'row_id'              => '',
                               'act_mode'            => 'addempreport'
                               );

           $myarray = $this->input->post('kancha');
           // api calls start
           $path      = base_url()."api/employeereport/empreport/format/json/";
           $response  = curlcall($parameter, $path);
          //p($response);exit();
            $xml =htmlentities("<NewDataSet>");
              foreach ($myarray as $key => $value) {
                $xml .=htmlentities('<tblrptnote><t_NoteDesc>'.$value.'</t_NoteDesc></tblrptnote>');
              }
              $xml .=htmlentities("</NewDataSet>");

           $path  = base_url()."api/employeereport/empreportNote/format/json/";
           $response  = curlcall($parameter, $path);
           $data1 = json_encode($parameter); 

           p($data1);
           die();

}


public function updatereprote(){
		   $data = checklogin();
           $businessId = $data['business_id'];
           $userId     = $data['a_SId']; 
           $n_DeptId   = $data['n_DeptId']; 
           $n_policyId = $data['n_PolicyId'];
			  $parameter = array(
                               
                               'report_name'         => $this->input->post('report_name'),
                               'report_type'         => $this->input->post('report_type'),
                               'status'              => $this->input->post('status'),
                               'chaim_period_form'   => date('Y-m-d', strtotime($this->input->post('chaim_period_form'))),
                               'cash_advance'        => $this->input->post('cash_advance'),
                               'chaim_period_to'     => date('Y-m-d', strtotime($this->input->post('chaim_period_to'))),
                               'description'         => $this->input->post('description'),
                               'n_BusinessId'        => $businessId,
                               'n_AdminType'         => '',
                               'row_id'              => $this->input->post('myreportId'),
                               'act_mode'            => 'updateempreport',
                               'userid'              => $userId,
                               'b_IsVoilated'        => $this->input->post('b_IsVoilated'),
                               'buttonType'          => $this->input->post('buttonType'),
                               'grandtotal'          => $this->input->post('grandtotal'),
                               'n_DeptId'            => $n_DeptId,
                               'n_policyId'          => $n_policyId
                               );
		    //$param = json_encode($parameter); echo $param; die();
           
           // api calls start
           $path      = base_url()."api/employeereport/update_empreport/format/json/";
           $response  = curlcall($parameter, $path);
           // sending the last inserted id
           echo json_encode($this->input->post('myreportId'));

           $myarray = $this->input->post('kancha');
           if(!empty($myarray)){
           	  $xml =htmlentities("<NewDataSet>");
              foreach ($myarray as $key => $value) {
                $xml .=htmlentities('<tblrptnote><t_NoteDesc>'.$value.'</t_NoteDesc></tblrptnote>');
              }
              $xml .=htmlentities("</NewDataSet>");
	           // api calls ends here
	           $parameter1 = array(
                              'lstId'      => $this->input->post('myreportId'),
                              'notesArray' => (html_entity_decode($xml, ENT_QUOTES, 'UTF-8')),
                              'businessId' => $data['business_id'],
           					   'userId'    => $data['a_SId'],
           					   't_Type'    => 'Employee'
                              );
           
    	       $path1  = base_url()."api/employeereport/empreportNote/format/json/";
    	       $response  = curlcall($parameter1, $path1);
             // echo  $data1 = json_encode($response); 
			   
			}
              
}





public function expensesreport(){

    //$this->login_check();
 	$this->load->view('layout/header');
 	$this->load->view('expensesreport');
 	$this->load->view('layout/footer');

}

 public function dashboard(){
 	$this->login_check();
 	//$this->load->view('layout/header');
 	$this->load->view('layout/footer');
 } 


 public function login_check(){
 	$data = checklogin();
 	if($data['a_SId'] != $this->session->userdata['sessionData']['a_SId']){
 		$baseURl = base_url();
 		redirect($baseURl.'employee');
 		exit();
 	}
 }


public function business_add(){
	$this->login_check();
 	$this->load->view('layout/header');
 	$this->load->view('business');
 	$this->load->view('layout/footer');
}

public function setting(){
	$this->login_check();
 	$this->load->view('layout/header');
 	$this->load->view('setting/index');
 	$this->load->view('layout/footer');
}

public function countrylisting(){
	 $this->login_check();
   $this->load->view('layout/header');
   $userId= checklogin();
           $parameter = array( 'countryName1'  => 'null',
                               'd_CreatedOn'   => 'null',
                               'id'            => 'null',
                               'act_mode'      => 'select',
                               'n_CreatedBy'   => 'null',
                               'd_ModifiedOn'  => 'null',
                               'n_ModifiedBy'  => 'null',
                               'b_IsActive'    => '1',
                               'n_BusinessId'  => 'null',
                               'n_AdminType'   => $userId['a_SysAdminId'],
                              );
  
   $path  = base_url()."api/countrylisting/country/format/json/";
   $response  = curlcall($parameter, $path);
         if($response =='Something Went Wrong'){
               $this->session->set_flashdata('message','Please check country Name');
               $base_url  = base_url();
               redirect($base_url.'ssa/admin/countryadd/');
               exit();
         }else{
            $data['listing']=$response;
            $this->load->view('setting/countryListing', $data);
            $this->load->view('layout/footer');                          
         }
}


public function countryadd(){
   $this->login_check();
   if(isset($_POST['submit'])){
      $userId= checklogin();
      $this->form_validation->set_rules('country_name', 'Country Name', 'trim|required|xss_clean|');
      if($this->form_validation->run() != false){
         $countryName1=$this->input->post('country_name');
         $date=date('Y:m:d');
         $parameter = array( 'countryName1' => $countryName1,
                               'd_CreatedOn' => $date,
                               'id' => 'null',
                               'act_mode' => 'insertinto',
                               'n_CreatedBy' => 'null',
                               'd_ModifiedOn' => 'null',
                               'n_ModifiedBy' => 'null',
                               'b_IsActive' => '1',
                               'n_BusinessId' => 'null',
                               'n_AdminType' => $userId['a_SysAdminId'],
                              );
          $path  = base_url()."api/countrylisting/country/format/json/";
          $response  = curlcall($parameter, $path);
          if($response =='Something Went Wrong'){
                  $this->session->set_flashdata('message','Please check country Name');
                  $base_url  = base_url();
                  redirect($base_url.'ssa/admin/countryadd/');
                  exit();

            }else{
               
               $base_url  = base_url();
               redirect($base_url.'ssa/admin/countrylisting/');
               exit();                                   
            }
      }
   }else{
      $this->load->view('layout/header');
      $this->load->view('setting/countryAdd');
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
         $parameter = array( 'countryName1' => $countryName1,
                               'd_CreatedOn' => $date,
                               'id' => $countryId,
                               'act_mode' => 'update',
                               'n_CreatedBy' => 'null',
                               'd_ModifiedOn' => 'null',
                               'n_ModifiedBy' => 'null',
                               'b_IsActive' => '1',
                               'n_BusinessId' => 'null',
                               'n_AdminType' => $userId['a_SysAdminId'],
                              );
          $path  = base_url()."api/countrylisting/country/format/json/";
          $response  = curlcall($parameter, $path);
          if($response =='Something Went Wrong'){
                  $this->session->set_flashdata('message','Please check country Name');
                  $base_url  = base_url();
                  redirect($base_url.'ssa/admin/editcountry/'.$countryId);
                  exit();

            }else{
               
               $base_url  = base_url();
               redirect($base_url.'ssa/admin/countrylisting/');
               exit();                                   
            }
      }
   }else{
      $countryId=$this->uri->segment('4');
      $this->load->view('layout/header');
      $parameter = array( 'countryName1' => 'null',
                                  'd_CreatedOn' => 'null',
                                  'id' => $countryId,
                                  'act_mode' => 'editselect',
                                  'n_CreatedBy' => 'null',
                                  'd_ModifiedOn' => 'null',
                                  'n_ModifiedBy' => 'null',
                                  'b_IsActive' => '1',
                                  'n_BusinessId' => 'null',
                                  'n_AdminType' => $userId['a_SysAdminId'],
                                 );
      $path  = base_url()."api/countrylisting/country/format/json/";
      $response  = curlcall($parameter, $path);
            if($response =='Something Went Wrong'){
                  $this->session->set_flashdata('message','Please check country Name');
                  $base_url  = base_url();
                  redirect($base_url.'ssa/admin/countryadd/');
                  exit();
            }else{
               $data['listing']=$response;
               $this->load->view('setting/editCountry', $data);
               $this->load->view('layout/footer');                      
            }
   }
   
}

public function deletecountry(){
   $this->login_check();
    $userId= checklogin();
   $countryId=$this->uri->segment('4');
   $parameter = array( 'countryName1' => 'null',
                                  'd_CreatedOn' => 'null',
                                  'id' => $countryId,
                                  'act_mode' => 'delete',
                                  'n_CreatedBy' => 'null',
                                  'd_ModifiedOn' => 'null',
                                  'n_ModifiedBy' => 'null',
                                  'b_IsActive' => '1',
                                  'n_BusinessId' => 'null',
                                  'n_AdminType' => $userId['a_SysAdminId'],
                                 );
      $path  = base_url()."api/countrylisting/country/format/json/";
      $response  = curlcall($parameter, $path);
            if($response =='Something Went Wrong'){
                  $this->session->set_flashdata('message','Country Name Already Deleted');
                  $base_url  = base_url();
                  redirect($base_url.'ssa/admin/countrylisting/');
                  exit();
            }else{
               $base_url  = base_url();
               redirect($base_url.'ssa/admin/countrylisting/');
               exit();                                   
            }
}


public function statelisting(){
	$this->login_check();
   $this->load->view('layout/header');
   $userId= checklogin();

   $parameter = array( 'id' => 'null',
                        'b_IsActive' => '1',
                        'n_BusinessId' => '0',
                        'p_mode' => 'Select',
                        'n_AdminType' => $userId['a_SysAdminId'],
                             
                      );
   $path  = base_url()."api/statelisting/state/format/json/";
   $response  = curlcall($parameter, $path);
   
         if($response =='Something Went Wrong'){
               $this->session->set_flashdata('message','Please check state Name');
               $base_url  = base_url();
               redirect($base_url.'ssa/admin/stateadd/');
               exit();
         }else{
            $data['listing']=$response;
            $this->load->view('setting/stateListing', $data);
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
                               'n_AdminType' => $userId['a_SysAdminId'],
                               'n_BusinessId' => 'null',
                               'n_CreatedBy' => 'null',
                               'n_ModifiedBy' => 'null',
                               'b_IsActive' => '1',
                              );
       
          $path  = base_url()."api/statelisting/state/format/json/";
          $response  = curlcall($parameter, $path);
          if($response =='Something Went Wrong'){
                  $this->session->set_flashdata('message','Please check State/Country Name');
                  $base_url  = base_url();
                  redirect($base_url.'ssa/admin/stateadd/');
                  exit();

            }else{
               $base_url  = base_url();
               redirect($base_url.'ssa/admin/statelisting/');
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
         $path  = base_url()."api/countrylisting/country/format/json/";
         $response  = curlcall($parameter, $path);
         if($response =='Something Went Wrong'){
               $this->session->set_flashdata('message','Please check country Name');
               $base_url  = base_url();
               redirect($base_url.'ssa/admin/stateadd/');
               exit();
         }else{
            $data['listing']=$response;
            $this->load->view('layout/header');
            $this->load->view('setting/stateAdd', $data);
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
                               'n_AdminType' => $userId['a_SysAdminId'],
                               'n_BusinessId' => '0',
                               'n_CreatedBy' => 'null',
                               'n_ModifiedBy' => 'null',
                               'b_IsActive' => '1',
                              );
          $path  = base_url()."api/statelisting/state/format/json/";
          $response  = curlcall($parameter, $path);
          if($response =='Something Went Wrong'){
                  $this->session->set_flashdata('message','Please check country/state Name');
                  $base_url  = base_url();
                  redirect($base_url.'ssa/admin/editstate/'.$stateId);
                  exit();

            }else{
               
               $base_url  = base_url();
               redirect($base_url.'ssa/admin/statelisting/');
               exit();                                   
            }
      }
   }else{
      $stateId=$this->uri->segment('4');

      $this->load->view('layout/header');
      $parameter = array( 'id' => $stateId,
                          'b_IsActive' => '1',
                          'n_BusinessId' => '0',
                          'p_mode' => 'Editselect',
                          'n_AdminType' => $userId['a_SysAdminId'],
                       );
      $pathState  = base_url()."api/statelisting/state/format/json/";
      $responseState  = curlcall($parameter, $pathState);
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
      $pathCountry  = base_url()."api/countrylisting/country/format/json/";
      $responseCountry  = curlcall($parameterCountry, $pathCountry);
      if(($responseState =='Something Went Wrong') || ($responseCountry =='Something Went Wrong') ){
                  $this->session->set_flashdata('message','Please check country Name');
                  $base_url  = base_url();
                  redirect($base_url.'ssa/admin/countryadd/');
                  exit();
            }else{
               $data['state']=$responseState;
               $data['country']=$responseCountry;
               $this->load->view('setting/editstate', $data);
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
                               'n_AdminType' => $userId['a_SysAdminId'],
                               'n_BusinessId' => '0',
                               'n_CreatedBy' => 'null',
                               'n_ModifiedBy' => 'null',
                               'b_IsActive' => '1',
                              );
      $path  = base_url()."api/statelisting/state/format/json/";
      $response  = curlcall($parameter, $path);
            if($response =='Something Went Wrong'){
                  $this->session->set_flashdata('message','Country Name Already Deleted');
                  $base_url  = base_url();
                  redirect($base_url.'ssa/admin/statelisting/');
                  exit();
            }else{
               $base_url  = base_url();
               redirect($base_url.'ssa/admin/statelisting/');
               exit();                                   
            }
  }

  public function citylisting(){
    $this->login_check();
    $this->load->view('layout/header');
    $userId= checklogin();
    $parameter=array(  'p_mode' => 'select',
                       'a_CityId' => 'null',
                       'n_AdminType' => $userId['a_SysAdminId']
                        );
    $path  = base_url()."api/citylisting/city/format/json/";
    $response  = curlcall($parameter, $path);
      if($response =='Something Went Wrong'){
               $this->session->set_flashdata('message','Please check state Name');
               $base_url  = base_url();
               redirect($base_url.'ssa/admin/cityadd/');
               exit();
         }else{
            $data['listing']=$response;
            $this->load->view('setting/cityListing', $data);
            $this->load->view('layout/footer');                          
         }
  }
  public function getStateDropDown(){

    $this->login_check();
    $userId= checklogin();
    $countryId=$_POST['id'];

    $parameter = array( 'id' => $countryId,
                        'b_IsActive' => '1',
                        'n_BusinessId' => '0',
                        'p_mode' => 'Stateselect',
                        'n_AdminType' => $userId['a_SysAdminId'],
                      );
   $path  = base_url()."api/statelisting/state/format/json/";
   $response  = curlcall($parameter, $path);
    
         if($response =='Something Went Wrong'){
               $this->session->set_flashdata('message','Please check state Name');
               $base_url  = base_url();
               redirect($base_url.'ssa/admin/stateadd/');
               exit();
         }else{
          echo json_encode($response);
           
            exit();
          }
  }
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
                               'n_AdminType' => $userId['a_SysAdminId'],
                              );
          $path  = base_url()."api/citylisting/city/format/json/";
          $response  = curlcall($parameter, $path);
         
          if($response =='Something Went Wrong'){
                  $this->session->set_flashdata('message','Please check city/State/Country Name');
                  $base_url  = base_url();
                  redirect($base_url.'ssa/admin/ /');
                  exit();

            }else{
               $base_url  = base_url();
               redirect($base_url.'ssa/admin/citylisting/');
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
         $path  = base_url()."api/countrylisting/country/format/json/";
         $response  = curlcall($parameter, $path);
         if($response =='Something Went Wrong'){
               $this->session->set_flashdata('message','Please check country Name');
               $base_url  = base_url();
               redirect($base_url.'ssa/admin/stateadd/');
               exit();
         }else{
            $data['listing']=$response;
            $this->load->view('layout/header');
            $this->load->view('setting/cityAdd', $data);
                                    
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
         
          $path  = base_url()."api/citylisting/city/format/json/";
          $response  = curlcall($parameter, $path);
         
          if($response =='Something Went Wrong'){
                  $this->session->set_flashdata('message','Please check city/State/Country Name');
                  $base_url  = base_url();
                  redirect($base_url.'ssa/admin/editcity/'.$cityId);
                  exit();

            }else{
               $base_url  = base_url();
               redirect($base_url.'ssa/admin/citylisting/');
               exit();                                   
            }
      }
   }else{
      $cityId=$this->uri->segment('4');

      $this->load->view('layout/header');
      $parameterCity=array( 'p_mode' => 'Editselect',
                       'a_CityId' => $cityId,
                       'n_AdminType' => $userId['a_SysAdminId']
                        );

      $pathCity  = base_url()."api/citylisting/city/format/json/";
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
       $pathstate  = base_url()."api/statelisting/state/format/json/";
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
      $pathCountry  = base_url()."api/countrylisting/country/format/json/";
      $responseCountry  = curlcall($parameterCountry, $pathCountry);
      if(($responseCity =='Something Went Wrong') || ($responseCountry =='Something Went Wrong') || ($responseState =='Something Went Wrong')){
                  $this->session->set_flashdata('message','Please check country Name');
                  $base_url  = base_url();
                  redirect($base_url.'ssa/admin/countryadd/');
                  exit();
            }else{
               $data['city']=$responseCity;
               $data['state']=$responseState;
               $data['country']=$responseCountry;
               $this->load->view('setting/editCity', $data);
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
      $path  = base_url()."api/citylisting/city/format/json/";
      $response  = curlcall($parameter, $path);
    
            if($response =='Something Went Wrong'){
                  $this->session->set_flashdata('message','City Name Already Deleted');
                  $base_url  = base_url();
                  redirect($base_url.'ssa/admin/citylisting/');
                  exit();
            }else{
               $base_url  = base_url();
               redirect($base_url.'ssa/admin/Citylisting/');
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
   $path  = base_url()."api/currencylisting/currency/format/json/";
   $response  = curlcall($parameter, $path);
   
         if($response =='Something Went Wrong'){
               $this->session->set_flashdata('message','Please Check Currency Name');
               $base_url  = base_url();
               redirect($base_url.'ssa/admin/currencyadd/');
               exit();
         }else{
            $data['listing']=$response;
            $this->load->view('setting/currencyListing', $data);
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
          $path  = base_url()."api/currencylisting/currency/format/json/";
          $response  = curlcall($parameter, $path);
          if($response =='Something Went Wrong'){
                  $this->session->set_flashdata('message','Please check Currency/Country Name');
                  $base_url  = base_url();
                  redirect($base_url.'ssa/admin/currencyadd/');
                  exit();

            }else{
               $base_url  = base_url();
               redirect($base_url.'ssa/admin/currencylisting/');
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
         $path  = base_url()."api/countrylisting/country/format/json/";
         $response  = curlcall($parameter, $path);
         if($response =='Something Went Wrong'){
               $this->session->set_flashdata('message','Please check country Name');
               $base_url  = base_url();
               redirect($base_url.'ssa/admin/currecnyadd/');
               exit();
         }else{
            $data['listing']=$response;
            $this->load->view('layout/header');
            $this->load->view('setting/currencyAdd', $data);
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
          $path  = base_url()."api/currencylisting/currency/format/json/";
          $response  = curlcall($parameter, $path);
          if($response =='Something Went Wrong'){
                  $this->session->set_flashdata('message','Please check country/Currency Name');
                  $base_url  = base_url();
                  redirect($base_url.'ssa/admin/editcurrency/'.$currencyId);
                  exit();

            }else{
               
               $base_url  = base_url();
               redirect($base_url.'ssa/admin/currencylisting/');
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
      $pathCurrency  = base_url()."api/currencylisting/currency/format/json/";
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
      $pathCountry  = base_url()."api/countrylisting/country/format/json/";
      $responseCountry  = curlcall($parameterCountry, $pathCountry);
      if(($responseCurrency =='Something Went Wrong') || ($responseCountry =='Something Went Wrong') ){
                  $this->session->set_flashdata('message','Please check country Name');
                  $base_url  = base_url();
                  redirect($base_url.'ssa/admin/currencyadd/');
                  exit();
            }else{
               $data['currency']=$responseCurrency;
               $data['country']=$responseCountry;
               $this->load->view('setting/editCurrency', $data);
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
      $path  = base_url()."api/currencylisting/currency/format/json/";
      $response  = curlcall($parameter, $path);
      if($response =='Something Went Wrong'){
                  $this->session->set_flashdata('message','Currency Name Already Deleted');
                  $base_url  = base_url();
                  redirect($base_url.'ssa/admin/currencylisting/');
                  exit();
            }else{
               $base_url  = base_url();
               redirect($base_url.'ssa/admin/currencylisting/');
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
                        'n_AdminType' => $userId['a_SysAdminId'],
                        );
  
   $path  = base_url()."api/dmlisting/dm/format/json/";
   $response  = curlcall($parameter, $path);
        if($response =='Something Went Wrong'){
               $this->session->set_flashdata('message','Please check Measurement Name');
               $base_url  = base_url();
               redirect($base_url.'ssa/admin/dmadd/');
               exit();
         }else{
            $data['listing']=$response;
            $this->load->view('setting/dmListing', $data);
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
                              'n_BusinessId' => $businessName,
                              'n_AdminType' => $userId['a_SysAdminId'],
                              );
          $path  = base_url()."api/dmlisting/dm/format/json/";
          $response  = curlcall($parameter, $path);
          if($response =='Something Went Wrong'){
                  $this->session->set_flashdata('message','Please check Measurement Name');
                  $base_url  = base_url();
                  redirect($base_url.'ssa/admin/dmAdd/');
                  exit();

            }else{

               $base_url  = base_url();
               redirect($base_url.'ssa/admin/dmlisting/');
               exit();
            }
      }
   }else{
              $this->load->view('layout/header');
              $this->load->view('setting/dmAdd');
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
          $path  = base_url()."api/dmlisting/dm/format/json/";
          $response  = curlcall($parameter, $path);
          if($response =='Something Went Wrong'){
                  $this->session->set_flashdata('message','Please check Measurement Name');
                  $base_url  = base_url();
                  redirect($base_url.'ssa/admin/editdm/'.$dmId);
                  exit();

            }else{

               $base_url  = base_url();
               redirect($base_url.'ssa/admin/dmlisting/');
               exit();
            }
      }
   }else{
      $dmSettingId=$this->uri->segment('4');
      $this->load->view('layout/header');
      $parameter = array( 'p_mode' => 'Editselect',
                        'a_SettingId' => $dmSettingId,
                        'n_BusinessId' => 'null',
                        'n_AdminType' => $userId['a_SysAdminId'],
                        );
      $path  = base_url()."api/dmlisting/dm/format/json/";
      $response  = curlcall($parameter, $path);
      if($response =='Something Went Wrong'){
                  $this->session->set_flashdata('message','Please check Measurement Name');
                  $base_url  = base_url();
                  redirect($base_url.'ssa/admin/dmadd/');
                  exit();
            }else{
               $data['listing']=$response;
               $this->load->view('setting/editDm', $data);
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
      $path  = base_url()."api/dmlisting/dm/format/json/";
      $response  = curlcall($parameter, $path);
            if($response =='Something Went Wrong'){
                  $this->session->set_flashdata('message','Measurement Name Already Deleted');
                  $base_url  = base_url();
                  redirect($base_url.'ssa/admin/dmlisting/');
                  exit();
            }else{
               $base_url  = base_url();
               redirect($base_url.'ssa/admin/dmlisting/');
               exit();                                   
            }
}





/*function logout(){
	session_unset();
	echo $data = base_url();
	$this->session->sess_destroy();	
	redirect($data);
	exit();
}


*/
function logout(){
  session_unset();
  echo $data = base_url();
  $this->session->sess_destroy();
  redirect($data.'employee/');
  exit();
}



public function tet(){
  $this->load->view('layout/header');
  $this->load->view('testfile');


}



public function test2(){
$name2="";
foreach ($_FILES as $key ) {
      $name =time().$key['name'];
      $name2.=$name;
      $path='uploadnew/'.$name;
        @move_uploaded_file($key['tmp_name'],$path);

}
echo $name2;
//echo json_encode($name2);
   exit;
 $rahul =  count($_FILES);
 echo $rahul.'count array';
 $num=count($_FILES['file']['name']);

for($i=0;$i<$num;$i++)
{
     $name =time().$_FILES["file"]["name"][$i];
     $path='uploadnew/'.$name;
        @move_uploaded_file($_FILES["file"]['tmp_name'][$i],$path);


}

exit;



/*
$label=11;
$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/pjpeg")
|| ($_FILES["file"]["type"] == "image/x-png")
|| ($_FILES["file"]["type"] == "image/png"))
&& ($_FILES["file"]["size"] < 200000)
&& in_array($extension, $allowedExts)) {
    if ($_FILES["file"]["error"] > 0) {
        echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
    } else {
        $filename = $label.$_FILES["file"]["name"];
        echo "Upload: " . $_FILES["file"]["name"] . "<br>";
        echo "Type: " . $_FILES["file"]["type"] . "<br>";
        echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
        echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

        if (file_exists("uploadnew/" . $filename)) {
            echo $filename . " already exists. ";
        } else {
            move_uploaded_file($_FILES["file"]["tmp_name"],
            "uploadnew/" . $filename);
            echo "Stored in: " . "uploads/" . $filename;
        }
    }
}*/

}























// end of the class    
}




// ==================================================
//
//	List of all the tables and procedures used will come here
//  Supper Admin Table  = tbl_systemlogin;
//  Supper Admin Login Procedure  =  proc_adminLogin
//  country TableName = "tblcountry";
//  procedure for this is    = "countryManage"; 
//
// ================================================== 