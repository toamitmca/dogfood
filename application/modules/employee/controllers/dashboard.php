<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MX_Controller {

  public function __construct() {
	$this->load->model("supper_admin");
	$this->load->helper('my_helper');
  }

  public function index(){
  $this->login_check();
  $this->load->view('layout/header');
  $this->load->view('layout/footer');
  }

  public function reportfirst(){
     $this->load->view('layout/header');
     $this->load->view('firstreport');
     //$this->load->view('layout/footer');
  }

 public function expense(){
    $this->load->view('layout/header');

    if(isset($_POST['submit'])){

    }


    $this->load->view('expensesreport');

  }

public function uploadImg(){
		$config['upload_path']   = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']		 = '100';
		$config['max_width']     = '1024';
		$config['max_height']    = '768';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());

			$this->load->view('upload_form', $error);
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());

			$this->load->view('upload_success', $data);
		}
}	

function do_upload()
	{
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());

			$this->load->view('upload_form', $error);
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());

			$this->load->view('upload_success', $data);
		}
	}
function getExtension($str){
	$i = strrpos($str,".");
    if (!$i) { return ""; }
    $l = strlen($str) - $i;
    $ext = substr($str,$i+1,$l);
    return $ext;
}

  
 public function reportfirst2(){
     $this->load->view('layout/header');
     $this->load->view('firstreport2');
     $this->load->view('layout/footer');
 }
 
 public function reportsubmit(){

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
           p($parameter);
           die();
   $path  = base_url()."api/employeereport/empreport/format/json/";
   $response  = curlcall($parameter, $path);
         if($response =='Something Went Wrong'){
               $this->session->set_flashdata('message','Please check country Name');
               $base_url  = base_url();
               redirect($base_url.'ssa/admin/countryadd/');
               exit();
         }
}

 public function dashboard(){
 	$this->login_check();
 	$this->load->view('layout/header');
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
   $parameter = array(  'p_mode'         => 'Delete',
                        'a_SettingId'    => $dmSettingId,
                        'n_EnumId'       => "null",
                        't_SettingValue' => 'null',
                        'n_CreatedBy'    => 'null',
                        'b_IsActive'     => '1',
                        'n_BusinessId'   => "null",
                        'n_AdminType'    => $userId['a_SysAdminId'],
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

    function logout()
    {
        session_unset();
        $redirect_url = base_url();
        $this->session->sess_destroy();
        redirect($redirect_url);
        exit();
    }


function me(){
	$this->load->view('layout/header');
	$this->load->view('fileupload');
	
}

function ajaxImageUpload(){
	$valid_formats = array("jpg", "png", "gif", "bmp","jpeg");
	$imgArray = array();
	if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
		//p($_POST); 
		//p($_FILES);
		$getPostId = $_POST['hidden'];
		$getPostId = explode('_', $getPostId);
		$getPostId = $getPostId['1']; 
    	$uploaddir = "uploads/"; //a directory inside
    	foreach ($_FILES['photos']['name'] as $name => $value) {
	
        $filename = stripslashes($_FILES['photos']['name'][$name]);
        $size=filesize($_FILES['photos']['tmp_name'][$name]);
        //get the extension of the file in a lower case format
          $ext = $this->getExtension($filename);
          $ext = strtolower($ext);
     	
         if(in_array($ext,$valid_formats))
         {
	       
		   $image_name=time().$filename;
		   $baseUrl  = base_url();
		   echo "<img src='".$baseUrl.$uploaddir.$image_name."' class='displynone'>";
		   echo "<input type='text' id='file_".$getPostId."' name='hiddenImgname[]' value='".$image_name."'>";
		   $newname = $uploaddir.$image_name;
           
           if (move_uploaded_file($_FILES['photos']['tmp_name'][$name], $newname)) 
           {
	       $time=time();
	       //mysql_query("INSERT INTO user_uploads(image_name,user_id_fk,created) VALUES('$image_name','$session_id','$time')");
	       }
	       else
	       {
	        echo '<span class="imgList">You have exceeded the size limit! so moving unsuccessful! </span>';
            }

	       
		   
       
          }
          else
         { 
	     	echo '<span class="imgList">Unknown extension!</span>';
           
	     }
           
     }
}
}

function expenseSave(){

	if(isset($_POST['submit']) && $_POST['submit']=='Save Expensess'){

		p($_POST); 
	}
}

public function deleted()
{

  $deleteparameter = array('row_id' => $this->input->post('delete') , 'act_mode' => 'remove' );
  //p($deleteparameter);

  $pathdelete  = base_url()."api/employeereport/deltexpedit/format/json/";
  $response  = curlcall($deleteparameter, $pathdelete);
   // p($response);
  if($response!='Somthing Went Wrong')
  {

    echo json_encode($response);

  }
}





public function singleupdatedetails()
{
 $catt=$_POST['catval1'];
 $caitt=explode('-', $catt);
 $category11 = $caitt[0];

    $parameter = array('ex_id'           => $this->input->post('rowid'), 
                       'ex_catval1'      => $category11,
                       'ex_dateval1'     => date('Y-m-d', strtotime($this->input->post('dateval1'))),
                       'ex_amountval1'   => $this->input->post('amountval1'),
                       'ex_merchantval1' => $this->input->post('merchantval1'),
                       'ex_purposeval1'  => $this->input->post('purposeval1'),
                       'ex_reimbval1'    => $this->input->post('reimbval1'),
                       'ex_tagval1'      => $this->input->post('ctagval1'),
                       'ex_tagval2'      => $this->input->post('ctagval2'),
                       'ex_voilaval1'    => $this->input->post('voilaval1'),
                       'ex_city'         => $this->input->post('cityval1'),
                       'ex_glcode'       => $this->input->post('glcode1'),
                      );

    // p($parameter);

             $path1  = base_url()."api/employeereport/empexpupdatedetils/format/json/";
             $response  = curlcall($parameter, $path1);

            // p($response);
            // exit(); 
             echo json_encode($response);
             exit();
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