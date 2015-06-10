<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Policy extends MX_Controller {
  // public $privat_data  = Array('');

  
  public function __construct() {
                // $privat_data  = Array('');

                $this->load->model("supper_admin");
                $this->load->helper('my_helper');
  }
 public function index(){
                $this->load->view('layout/header');
                $this->load->view('superadmin/index');
                $this->load->view('layout/footer');
  }

 public function login_check(){
              $data = checklogin();
              if($data['a_SysAdminId'] != 33){
              $baseURl = base_url();
              redirect($baseURl);
              exit();
              }
 }


public function policylist(){
                    $this->login_check();
                    $userId= checklogin();
                    $Id=$this->uri->segment(4);
                    if($Id=='')
                    {  //allview
                    $parameter_policy = array( 'act_mpde'  => 'getallpolicy',
                                               'id'        => '',
                                               'b_deleted' =>'');

                    }
                    else                    {
                        $parameter_policy = array( 'act_mpde'  => 'allv',
                                                   'id'        => $Id,
                                                   'b_deleted' => '');

                    }


                    $path_policy  = base_url().'api/business_manage/ssapolicylist/format/json/';
                    // $response['data']  = curlget($path);
                    $response['data'] = curlcall($parameter_policy, $path_policy);

                    $parameter = array('business_name' =>'' ,'act_mode'=>'all' );
                    $path       = base_url().'api/createbusinessadmin/searchbusinessall/format/json/';
                    $response['policy']  = curlcall($parameter, $path);

                    $this->load->view('layout/header');
                    $this->load->view('policy/policylist',$response);
                    $this->load->view('layout/footer');
}



  public function policyadd(){
      $this->login_check();
      $userId= checklogin();

      $parameter_policy = array( 'act_mode'   => 'getallbusiness' , 
                                  'AdminType' => $userId['a_SysAdminId'] ,
                                  'adminId'   => $userId['a_SId']
                                  );
      $path_policy  = base_url().'api/super_state_admin/ssapolicybusiness/format/json/';
      $response=curlcall($parameter_policy, $path_policy);
      // p($response);
      // exit();
      if($path_policy=='Something Went Wrong'){
        $response['business']='';
      }else{
        $response['business']  = $response;
      }
      
      $this->load->view('layout/header');
      $this->load->view('policy/policyAddCreateGeneral ',$response);
  }

  public function spendigcat(){
    $businessid=$_POST['businessId'];
    $parameter=array('p_mode'        => 'selectSpanCat',
                      'p_BusinessId' =>  $businessid
                    );

    $path = base_url().'api/super_state_admin/addcat/format/json/';
    $response  = curlcall($parameter, $path);
    echo json_encode($response);
    exit();
    if($response==''){

    }else{
      echo json_encode($response);
      exit();
    }
  }
  public function SpendcategoryAdd(){
    $this->login_check();
    $userId     = checklogin();
    $lastId     = $_POST['lastId'];
    $catValue   = json_decode($_POST['catValue']);
    $catCode    = json_decode($_POST['catCode']);
    $businessId = $_POST['businessId'];

    $xml =htmlentities("<NewDataSet>");
    
      for($i=0;$i<count($catValue);$i++){
       
            $xml .=htmlentities("<tblspndngcat>");
            $xml .=htmlentities('<t_SpndName>'.$catValue[$i].'</t_SpndName>');
            if(!empty($catCode[$i])){
              $xml .=htmlentities('<t_GLCode>'.$catCode[$i].'</t_GLCode>');
            }else{
              $xml .=htmlentities('<t_GLCode>null</t_GLCode>');
            }
            $xml .=htmlentities("</tblspndngcat>");
        }
    
    $xml .=htmlentities("</NewDataSet>");
    if($_POST['action']=='insert'){
      $parameter=array('p_mode'       => 'insert',
                       'p_Xml'        =>  (html_entity_decode($xml, ENT_QUOTES, 'UTF-8')),
                       'p_CreatedBy'  => $userId['a_SId'],
                       'p_BusinessId' => $businessId,
                       'p_nAdmitType' => $userId['a_SysAdminId']
                      );
    }else{
      $parameter=array('p_mode'       => 'update',
                       'p_XmlDatatest'=>  (html_entity_decode($xml, ENT_QUOTES, 'UTF-8')),
                       'p_CreatedBy'  => $userId['a_SId'],
                       'p_BusinessId' => $businessId,
                       'p_nAdmitType' => $userId['a_SysAdminId']
                      );
    }
    $path = base_url().'api/super_state_admin/addcat/format/json/';
    $response  = curlcall($parameters, $path);
    if($response==''){

    }else{
      echo json_encode($response);
      exit();
    }
    
    
}
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
  $path      = base_url().'api/business_admin/policyGeneral/format/json/';
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
   //  $b_RecpReq    = $_POST['b_RecpReq'];
   //  $n_AboveAmt     = $_POST['n_AboveAmt'];
  }


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


  public function policyedit(){
                   	//echo 'sdhfd';
                      //	exit;
                      //$modyby = $this->session->userdata['sessionData']['a_SId'];   ssapolictspcat_post

                       $policyid=$this->uri->segment('4');   //ssapolicycategoryedit
                     /*  p($policyid);
                       exit;*/
                      $parameter_policy = array( 'act_mpde' => 'view',
                                       'id'=>$policyid
                                        );
                      $path_policy  = base_url().'api/business_manage/ssapolicylist1/format/json/';
                      $response['policyname']  = curlcall($parameter_policy, $path_policy);

  //         p($response['policyname']);

                    $parameter_policy = array( 'act_mode' => 'allview',
                                          'busid'   => $response['policyname']->n_BusinessId );
                    $path_policy  = base_url().'api/business_manage/myssapolicylist/format/json/';
                    $response['get_allcat']  = curlcall($parameter_policy, $path_policy);

                                          $parameter_policy = array(
                                          'businessid'   => $response['policyname']->n_BusinessId );
                    $path_policy  = base_url().'api/business_manage/ssaspcatget/format/json/';
                    $response['get_spcatglcode']  = curlcall($parameter_policy, $path_policy);

           // exit;
                      $adminid= $this->session->userdata['sessionData']['a_SId'];
                      $AdminType= $this->session->userdata['sessionData']['a_SysAdminId'];

                      $parameter_policy = array( 'act_mode' => 'getallbusiness' , 'AdminType' => $AdminType ,'adminId' => $adminid);
                      $path_policy  = base_url().'api/business_manage/ssapolicybusiness/format/json/';
                      $response['business']  = curlcall($parameter_policy, $path_policy);

//p($response['business']); //exit;
                      $parameter_policy = array( 'policyid' => $policyid );
                      $path_policy  = base_url().'api/business_manage/ssapolicycategoryedit/format/json/';
                      $response['policy']  = curlcall($parameter_policy, $path_policy);

//p($response['policy']);

//exit;
                      $this->load->view('layout/header');
                      $this->load->view('policy/policyEditCreateGeneral',$response);
                     
}


  function ssapolicygeneral(){
          $adminid= $this->session->userdata['sessionData']['a_SId'];
          $AdminType= $this->session->userdata['sessionData']['a_SysAdminId'];

                       $parameter = array('act_mode' =>'genetal' ,
                       'act_mode1'       =>$this->input->post('act_mode1'),
                       'id'              =>$this->input->post('id'),
                       'polcy_name'      =>$this->input->post('polcy_name'),
                       'n_MaxRptAmt'     =>$this->input->post('n_MaxRptAmt'),
                       'd_RptDueDt'      =>$this->input->post('d_RptDueDt'),
                       'd_RptDueDt1'     =>$this->input->post('d_RptDueDt1'),
                       'n_MaxExpAmt'     =>$this->input->post('n_MaxExpAmt'),
                       'b_CashAdAllowed' =>$this->input->post('b_CashAdAllowed'),
                       'b_RecpReq'       =>$this->input->post('b_RecpReq'),
                       'n_AboveAmt'      =>$this->input->post('n_AboveAmt'),
                       'expense_submitted'=>$this->input->post('expense_submitted'),
                       'businessId'       =>$this->input->post('businessid'),
                       'admintype'        =>$AdminType,
                       'createdby'        =>$adminid
                      );
//echo'sdfs';
     //  p($parameter);
      // exit;

                $path_policy  = base_url().'api/business_manage/ssapolicygeneral/format/json/';
                $response = curlcall($parameter, $path_policy);
                $result =  json_encode($response);
                echo $result;
  }


  function ssapolicylmilige(){
$parameter = array('act_mode' =>'genetal' ,
                   'act_mode1' =>'update',
                   'id'        =>$this->input->post('id'),
                   'n_MaxRptMilage'=>$this->input->post('n_MaxRptMilage'),
                   'n_MilageRate'=>$this->input->post('n_MilageRate'),
                   'n_PerMeasuremnt'=>$this->input->post('n_PerMeasuremnt'),
                   'n_MaxExpMil'=>$this->input->post('n_MaxExpMil'),
                   'b_IsGPSReq'=>$this->input->post('b_IsGPSReq')

                  );

 $path_policy  = base_url().'api/business_manage/ssapolicymilige/format/json/';
		           $response = curlcall($parameter, $path_policy);
p($response);
  }
   function ssapolicyspndlmt(){
   
$parameter = array('act_mode' =>'genetal' ,
                   'act_mode1' =>'update',
                   'id'        =>$this->input->post('id'),
                   'n_DailyExpLmt'=>$this->input->post('n_DailyExpLmt'),
                   'n_MonthlyExpLmt'=>$this->input->post('n_MonthlyExpLmt')

                  );

 $path_policy  = base_url().'api/business_manage/ssapolicyspndlmt/format/json/';
		           $response = curlcall($parameter, $path_policy);
p($response);
  }



public function ssapolicycategory(){
	//print_r($_POST);
	//exit;
                $xml =htmlentities("<NewDataSet>");
                foreach ($_POST as $key => $value1) {
                	foreach ($value1 as $key => $value) {
   if(!empty($value['sp_cat_single_exp_limit']) && !empty($value['sp_cat_single_daily_limit']) && !empty($value['sp_cat_single_month_limit'])){
             $xml .=htmlentities('<tblpolicycategorymap> <n_PolicyId>'.$_POST['policyId'].'</n_PolicyId>
                       	                                   <n_SpndngCatId>'.$value['cat_id'].'</n_SpndngCatId>
                                                           <n_SingleExpLmt>'.$value['sp_cat_single_exp_limit'].'</n_SingleExpLmt>
                                                           <n_DailyExpLmt>'.$value['sp_cat_single_daily_limit'].'</n_DailyExpLmt>
                                                           <n_MonthlyExpLmt>'.$value['sp_cat_single_month_limit'].'</n_MonthlyExpLmt>
                       	                                   </tblpolicycategorymap>');
                          }
                	}
                	}
                 $xml .=htmlentities("</NewDataSet>");
                        $parameter = array(    'p_mode' => $_POST['a_mode'],
                        	                   'dpolicyid'=>$_POST['policyId'],
                                                'p_XmlData_sp_gl' => (html_entity_decode($xml, ENT_QUOTES, 'UTF-8')),
                                                'p_CreatedBy' => '1',
                                               'p_AdminType' => '1',
                                              'p_BusinessId' => $_POST['a_BusinessId']

                             );
                $path_policy  = base_url().'api/business_manage/ssapolicycategory/format/json/';
		           $response = curlcall($parameter, $path_policy);
   p($response);
}
public function test(){
	p($this->session->all_userdata());
	//exit;
echo   $adminid= $this->session->userdata['sessionData']['a_SId'];
echo  $AdminType= $this->session->userdata['sessionData']['a_SysAdminId'];



}


public function sending_cat_add(){
                   $adminid= $this->session->userdata['sessionData']['a_SId'];
                   $AdminType= $this->session->userdata['sessionData']['a_SysAdminId'];

                      $xml =htmlentities("<NewDataSet>");
                      foreach ($_POST as $key => $value1) {
                      foreach ($value1 as $key => $value) {
                      if(!empty($value['t_category_name']) && !empty($value['t_glcode'])){
                      $xml .=htmlentities('<tblspndngcat><t_SpndName>'.$value['t_category_name'].'</t_SpndName>
                                             <t_GLCode>'.$value['t_glcode'].'</t_GLCode>
                                               </tblspndngcat>');
                      }

                      }
                      }
                      $xml .=htmlentities("</NewDataSet>");
                      $parameter = array(    'p_mode' => 'Insert',
                                 'p_DeptId' => '1',
                      'p_XmlData_sp_gl' => (html_entity_decode($xml, ENT_QUOTES, 'UTF-8')),
                      'p_AdminType' => $AdminType,
                      'p_BusinessId' => $_POST['bus_myid'],
                      'p_CreatedBy' => $adminid
                      );
                      $path  = base_url()."api/business_manage/businesscategory/format/json/";
                      $response  = curlcall($parameter, $path);

}



public function get_policy()
{
                  $parameter_policy = array( 'act_mode' => 'allview',
                                              'busid'   => $_POST['bus_myid'] );
                  $path_policy  = base_url().'api/business_manage/myssapolicylist/format/json/';
                  $response1  = curlcall($parameter_policy, $path_policy);
                  echo json_encode($response1);
   }

public function  sp_catcheckbyid(){

                $parameter  = array('businessid' =>$_POST['businessid'] , 'cat_name'=>$_POST['cat_name'] );
                $path_policy  = base_url().'api/business_manage/validatespcat/format/json/';
                $response  = curlcall($parameter, $path_policy);
                echo $response;
                  //echo json_encode($response);

}

public function addnewspcatinpolocy(){

    $parameter  = array('businessid' =>$_POST['businessid'] , 'policyid'=>$_POST['policyid'],'spcatid'=>$_POST['spcatid'],'singlelimit'=>$_POST['singlelimt'],'dalylimit'=>$_POST['dalylimit'],'monthely'=>$_POST['monthely'] );
                $path_policy  = base_url().'api/business_manage/addnewcatpolicy/format/json/';
                $response  = curlcall($parameter, $path_policy);
                echo $response;


}


} //END CLASS
