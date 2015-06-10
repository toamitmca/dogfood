<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Dashboard extends MX_Controller {
 
  public function __construct() {
	$this->load->model("supper_admin");	
	$this->load->helper('my_helper');
  }

  public function index(){
  	$this->load->view('layout/header');
  	$this->load->view('index');
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

  public function policyadd(){
  	$this->login_check();
  	$this->load->view('layout/header');
   $parameterCat = array('p_SpndngCatId' => 'null',
                          'p_mode'            => 'Select',
                          'p_SpndName'        => 'null',
                          'p_GLCode'        => 'null',
                          'p_AdminType'       => 1,
                          'p_BusinessId'      => 1,
                         );
    $pathCat      = base_url().'api/spending_categories/spendcat/format/json/';
    $responseCat  = curlcall($parameterCat, $pathCat);
   if($responseCat){
     $data['cat']=$responseCat; 
    }
  	$this->load->view('policyEditCreateGeneral',$data);	
  }
// policy add comes here
  public function policyajaxgenral(){
  	$this->login_check();
  	$data = businesschecklogin();
  	$parameters = array(
      'p_mode'            => 'Insert',
      'p_formName'        => 'First',
      'p_PolicyName'      => $_POST['t_PolicyName'],
  		'p_PolicyId'        => 'null',
  		'p_MaxRptAmt'       => $_POST['n_MaxRptAmt'],
  		'd_RptDueDt'   	    => $_POST['d_RptDueDt'],
  		'd_RptDueDt1'   	  => $_POST['d_RptDueDt1'],
  		'p_MaxExpAmt'   	  => $_POST['n_MaxExpAmt'],
  		'p_CashAdvAllowed'  => $_POST['b_CashAdAllowed'],
  		'p_RecpReq'         => $_POST['b_RecpReq'],
  		'p_AboveAmt'        => $_POST['n_AboveAmt'],
  		'p_BusinessId'      => 0

     );
    //api calls will come here
	$path  	   = base_url().'api/policybusiness/policyGeneral/format/json/';
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
         $data = businesschecklogin();
          $parameters = array(
            'p_mode'           => 'Update',
            'p_formName'       => 'Second',
            'p_PolicyId'       => $_POST['lastId'],
            'p_MaxRptMilage'   => $_POST['n_MaxRptMilage'],
            'p_MilageRate'     => $_POST['n_MilageRate'],
            'p_PerMeasuremnt'  => $_POST['n_PerMeasuremnt'],
            'p_MaxExpMil'      => $_POST['n_MaxExpMil'],
            'p_IsGPSReq'       => $_POST['b_IsGPSReq'],
            'p_CreatedBy'      => 22,
           );

        //api calls will come here
        $path      = base_url().'api/policybusiness/policyMileage/format/json/';
        $response  = curlcall($parameters, $path);
        echo json_encode($response);; 
        //api cals ends here
  }


  public function policyajaxspendinglimits(){
          $this->login_check();
          $data = businesschecklogin();
          $parameters = array(
            'p_mode'           => 'Update',
            'p_formName'       => 'Third',
            'p_PolicyId'       => $_POST['lastId'],
            'p_DailyExpLmt'    => $_POST['n_DailyExpLmt'],
            'p_MonthlyExpLmt'  => $_POST['n_MonthlyExpLmt'],
            'p_CreatedBy'      => 22,
           );
      //api calls will come here
        $path      = base_url().'api/policybusiness/policyMileage/format/json/';
        $response  = curlcall($parameters, $path);
        p($response);
        exit();
        echo json_encode($response);; 
        //api cals ends here
  }


  public function policyajaxperiodcategories(){
    $this->login_check();
    $data = businesschecklogin();
    $lastId=$_POST['lastId'];
    $catId=json_decode($_POST['catId']);
    $disableCatId=json_decode($_POST['disableValue']);
    $singleExpValue=json_decode($_POST['singleExp']);
    $dailyLimits=json_decode($_POST['daily']);
    $monthlyLimit=json_decode($_POST['month']);
    $xml =htmlentities("<NewDataSet>");
    
      for($i=0;$i<count($catId);$i++){
      if(in_array($catId[$i], $disableCatId)){

      }else{
        
          if(!empty($singleExpValue[$i])){
            $singleExpValue=$singleExpValue[$i];
          }else{
            $singleExpValue='';
          }
          if(!empty($dailyLimits[$i])){
            $dailyLimits=$dailyLimits[$i];
          }else{
            $dailyLimits='';
          }
          if(!empty($monthlyLimit[$i])){
            $monthlyLimit=$monthlyLimit[$i];
          }else{
            $monthlyLimit='';
          }
          $xml .=htmlentities("<tblpolicycategorymap>");
          $xml .=htmlentities('<n_SpndngCatId>'.$catId[$i].'</n_SpndngCatId>');
          $xml .=htmlentities('<n_SingleExpLmt>'.$singleExpValue.'</n_SingleExpLmt>');
          $xml .=htmlentities('<n_DailyExpLmt>'.$dailyLimits.'</n_DailyExpLmt>');
          $xml .=htmlentities('<n_MonthlyExpLmt>'.$monthlyLimit.'</n_MonthlyExpLmt>');
          $xml .=htmlentities("</tblpolicycategorymap>");
        }
        
      }
    
    $xml .=htmlentities("</NewDataSet>");
    $parameters = array(
                              'p_mode'           => 'Insert',
                              'p_PlcyCatMapId'   => 'null',
                              'p_XmlDatatest'    => (html_entity_decode($xml, ENT_QUOTES, 'UTF-8')),
                              'p_PolicyId'       => $lastId,
                              'p_CreatedBy'      => 1,
                              'p_BusinessId'     => 22,
           );
      //api calls will come here
        $path      = base_url().'api/policybusiness/policyspencat/format/json/';
        $response  = curlcall($parameters, $path);
        echo json_encode($response);; 
        //api cals ends here
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

// end of the class    
}
 