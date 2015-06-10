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
               $adminid= $this->session->userdata['sessionData']['a_SId'];
                $AdminType= $this->session->userdata['sessionData']['a_SysAdminId'];
                $parameter_policy = array( 'act_mpde' => 'view',
                             'id'=>'138');
                $path_policy  = base_url().'api/business_manage/ssapolicylist/format/json/';
                $response['policyname']  = curlcall($parameter_policy, $path_policy);
                /* get Business */
                $parameter_policy = array( 'act_mode' => 'getallbusiness' , 'AdminType' => $AdminType ,'adminId' => $adminid);
                $path_policy  = base_url().'api/business_manage/ssapolicybusiness/format/json/';
                $response['business']  = curlcall($parameter_policy, $path_policy);



                $parameter_policy = array( 'act_mpde' => 'allview' );
                $path_policy  = base_url().'api/business_manage/ssapolictspcat/format/json/';
                $response['policy']  = curlcall($parameter_policy, $path_policy);

                $this->load->view('layout/header');
                $this->load->view('policy/policyAddCreateGeneral ',$response);
            
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
