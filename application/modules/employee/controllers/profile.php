<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Profile extends MX_Controller {
  public function __construct() {
	$this->load->model("supper_admin");
	$this->load->helper('my_helper');
  }
   public function index(){
   	$data = checklogin();
     $data['a_SId'];
                      $parameter = array(
                         'bus_id' => '1'
                        );
                        $path  = base_url()."api/employee/country/format/json/";
                        $response['country']= curlcall($parameter, $path);
    if(isset($data['a_SId']))
    {
       $user_id= $data['a_SId'];
    }
    else
    {
      $user_id= '46';
    }

  	$this->load->view('layout/header');
  	$parameter = array(
  	 	                 'e_Id'       => $user_id,
  	 	                 'e_Dob'      => '',
  	 	                 'e_Mobile'   => '',
  	 	                 'e_Phone'    => '',
  	 	                 'e_Address1' => '',
  	 	                 'e_Address2' => '',
  	 	                 'e_Address3' => '',
  	 	                 'e_Country'  => '',
  	 	                 'e_State'    => '',
  	 	                 'e_City'	    => '',
  	 	                 'e_Pin'      => '',
  	 	                 'e_Seq'      => '',
  	 	                 'act_mode'   => 'view'
  	 	                  );
       $path=base_url()."api/employee/profileview/format/json/";
    $response['profile'] = curlcall($parameter, $path);


    $userid= $this->session->userdata['sessionData']['a_SId'];
    $parameter = array('act_mode'=>'employee' , 'userid'=>$userid);
    $path       = base_url().'api/createbusinessadmin/firstloginpasschange/format/json/';
       $response['firstlogin']= curlcall($parameter, $path);
  	$this->load->view('profile' , $response);
  }
public function profileedit(){
    $data= checklogin();
 if(isset($data['a_SId']))
    {
       $user_id= $data['a_SId'];
    }
    else
    {
      $user_id= '46';
    }
           if(isset($_POST['submit']))
                {
                     	$parameter = array(
  	 	                 'e_Id'       => $user_id,
  	 	                 'e_Dob'      => $this->input->post('date_of_birth'),
  	 	                 'e_Mobile'   => $this->input->post('mobile_phone'),
  	 	                 'e_Phone'    => $this->input->post('office_phone'),
  	 	                 'e_Address1' => $this->input->post('address_line1'),
  	 	                 'e_Address2' => $this->input->post('address_line2'),
  	 	                 'e_Address3' => $this->input->post('address_line3'),
  	 	                 'e_Country'  => $this->input->post('n_CountryId_1'),
  	 	                 'e_State'    => $this->input->post('state_id'),
  	 	                 'e_City'	    => $this->input->post('city_id'),
  	 	                 'e_Pin'      => $this->input->post('pin_code'),
  	 	                 'e_Seq'      => $this->input->post('seq_code'),
  	 	                 'act_mode'   => 'update'
  	 	                  );
                     	    $path  = base_url()."api/employee/profileupdate/format/json/";
                          $response= curlcall($parameter, $path);
                           if($response='Something Went Wrong')
                          {
                            redirect('employee/profile/profile');

                          }
                          else 
                          {
                            echo "1";
                            redirect('employee/profile/profile');

                          }
                       }
                        $this->load->view('profile');
   }
public function getStateDropDown(){
    $userId= checklogin();
     $data = businesschecklogin();
    // $busId = $data['n_BusinessId'];
    $countryId=$_POST['id'];
    $parameterState = array( 'id' => $countryId,
                        'b_IsActive' => '1',
                        'n_BusinessId' => 0,
                        'p_mode' => 'Stateselect',
                        'n_AdminType' => 33,
                      );
    //p($parameterState);
   // exit();
   $pathState  = base_url()."api/business_manage/state/format/json/";
   $responseState  = curlcall($parameterState, $pathState);
    
         if($responseState =='Something Went Wrong'){
               $this->session->set_flashdata('message','Please check state Name');
               $base_url  = base_url();
               redirect($base_url.'business/dashboard/stateadd/');
               exit();
         }else{
          echo json_encode($responseState);
           
            exit();
          }
  }


  public function getCityDropDown(){
   
  $userId= checklogin();
 $data = businesschecklogin();
 //    $busId = $data['n_BusinessId'];
  $parameter =array(   'p_mode' => 'CitySelect',
                       'p_id' => 'null',
                       'n_StateId' => $_POST['id'],
                       'p_BusinessId' => 1,
                       'p_admin' => 33
                        );
  //p($parameter);
 
     $path  = base_url()."api/business_manage/city/format/json/";
     $response  = curlcall($parameter, $path);
    
         if($response =='Something Went Wrong'){
               $this->session->set_flashdata('message','Please check city Name');
               $base_url  = base_url();
               redirect($base_url.'business/dashboard2/cityadd/');
               exit();
         }else{
          echo json_encode($response);
           
            exit();
          }
  } 

public function changepassword(){



$data = checklogin();
     $data['a_SId'];
                      $parameter = array(
                         'bus_id' => '1'
                        );
                        $path  = base_url()."api/employee/country/format/json/";
                        $response['country']= curlcall($parameter, $path);
    if(isset($data['a_SId']))
    {
       $user_id= $data['a_SId'];
    }
    else
    {
      $user_id= '46';
    }
// Rahul Yadav 15/ 12 2014 firest login employee passwoord change
$userid= $this->session->userdata['sessionData']['a_SId'];
 $parameter = array('act_mode'=>'employee' , 'userid'=>$userid);
           $path       = base_url().'api/createbusinessadmin/firstloginpasschange/format/json/';
       $data['firstlogin']= curlcall($parameter, $path);


    $this->load->view('layout/header');
    $this->load->view('changepassword',$data);
    $this->load->view('layout/footer');



}
public function passcheck(){


$data = checklogin();
 $userid  =$data['a_SId'];
 $pass=$_POST['opass'];
$parameter = array('act_mode' =>'oldpasscheck' , 'userid'=>$userid, 'password'=> md5($pass));
 $pathState  = base_url()."api/business_manage/emppassreset/format/json/";
   $responseState  = curlcall($parameter, $pathState);
echo json_encode($responseState);

}
public function passupdate(){
$data = checklogin();
 $userid       =$data['a_SId'];
 $pass=$_POST['opass'];
$parameter = array('act_mode' =>'passwordchange' , 'userid' =>$userid, 'password'=> md5($pass));
 $pathState  = base_url()."api/business_manage/emppassreset/format/json/";
   $responseState  = curlcall($parameter, $pathState);
echo json_encode($parameter);

}




} //end class