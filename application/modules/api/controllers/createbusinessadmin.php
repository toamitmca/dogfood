<?php defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH.'/libraries/REST_Controller.php';
class Createbusinessadmin extends REST_Controller{
 public function __construct()
       {
            parent::__construct();
            $this->load->library('email');
            // Your own constructor code
       }
    function send_json($array){
        $this->output->set_content_type('application/json');
        $this->output->set_header('Cache-Control: no-cache, must-revalidate');
        $this->output->set_header('Expires: '.date('r', time()+(86400*365)));
        echo json_encode($array);
        exit();
   	 }
     ############### Created by Rahul yadav#################
   function businessregister_post(){
                            $data = json_decode(file_get_contents("php://input"), true);
                            $letters = 'abcefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
                             $chars = 8;
                             $randomString=  substr(str_shuffle($letters), 0, $chars);
                          // $password= generateRandomString(6);
                           $password= $randomString;
                           $user_password= md5($password);
                          $parameter = array(
                                            'p_mode'             =>'Insert',
                                            'p_BusinessId'       =>1,
                                            'p_Busineescode'     =>'business0001',
                                            'p_BussinessName'    => $this->post('businessName'),
                                            'p_Countryid'        => $this->post('businessCountry'),
                                            'p_StateId'          => $this->post('businessState'),
                                            'p_CityId'           => $this->post('businessCity'),
                                            'p_Address'          => $this->post('businessAddress').'___'.$this->post('businessAddress2'),
                                            'p_Status'           => $this->post('Status'),
                                            'p_Startdate'        => $this->post('businessStartDate'),
                                            'p_EndDate'          => $this->post('businessEndDate'),
                                            'p_UserCount'        => $this->post('businessEmployee'),
                                            'p_CurrencyId'       => $this->post('businessCurrency'), // SHEETESH 24 NOV
                                            'p_ExpInOtrCurrency' => $this->post('expensesothercurrency'),
                                            'p_Dateformat'       => $this->post('businessDateFormat'),
                                            'p_AdminId'          => 1,

   /*BILLING DETAILS START FROM HERE*/      'p_BillingType'      => $this->post('businessBillingType'),
                                            'p_BillingName'      => $this->post('businessBillingType'),
                                            'p_BillingEmail'     => $this->post('businessBillingEmail'),
                                            'p_BillingAddrline1' => $this->post('businessBillingAddress'),
                                            'p_BillingAddrline2' => $this->post('businessBillingAddress2'),
                                            'p_BillingContry'    => $this->post('businessBillingCountryId'),
                                            'p_Billingstate'     => $this->post('businessBillingStateId'),
                                            'p_Billingcity'      => $this->post('businessBillingCityId'),
                                            'p_Package'          => $this->post('businessBillingPackage'),
                                            'p_Distance'         => $this->post('distancemeasure'),
      /*Applicant details start from here*/ 'p_Fname'            => $this->post('appFirstName'),
                                            'p_Lname'            => $this->post('appLastName'),
                                            'p_ConidfAppInf'     => $this->post('appCountry'),
                                            'p_StateIdfAppInf'   => $this->post('appState'),
                                            'p_CityIdfAppInf'    => $this->post('appCity'),
                                            'p_AddrfAppInf'      => $this->post('appAddress1').'___'. $this->post('appAddress2'),
                                            'p_ContactfAppIn'    => $this->post('appPhone'),
                                            'p_EmailfAppIn'      => $this->post('appEmail'),
                                            'p_PassAppIn'        => $user_password,
                                            'p_DobfAppIn'        => $this->post('appDob'),
                                            'p_PositionfAppIn'   => $this->post('appCompanyPosition'),
                                            'p_AdminTypefAppIn'  => 22,
                                            'p_CreatedOn'        => 'NULL',
                                            'p_CreatedBy'        => $this->post('createdby'),
                                            'p_Deleted'          => 0  
                                             );


                          // p($parameter);
                        $data = $this->supper_admin->call_procedureRow('proc_Businessdtl', $parameter);
################################ USer mail send ###########################################################

                                                   $message_u='<html>
                         <body bgcolor="#DCEEFC">
                 <br><div>
                               <p>  Dear  &nbps; '.ucfirst($this->post('appFirstName')).' '. ucfirst($this->post('appLastName')).',</p></br>
                                <p>A TruExpense  user  (Business Admin ) has been created for you. </p></br>
                                <p> Please use following credentials to register you and begin using the expense management solution. </br></br>
                                 Login Page: </td><td><a href="'. base_url().'/business/">'. base_url().'/business/</a> </br>
                                User Id: '.$this->post('appEmail').' </td></br>
                                Default Password: '.$password.'</br>
                                <p> Thanks,</br>
                                 Support Team</br>
                                12345644 </br>
                                9:00 Am To 5:00 PM IST
                               </div>
                              </body>
                </html>';

                    $this->load->library('email');
                    $this->email->set_newline("\r\n");
          $this->email->from('barun@mindztechnology.com', 'Tru Expense');
          $this->email->to($this->post('appEmail'));
          $this->email->subject('TruExpense || New Business Admin');
          $this->email->message($message_u);
          $this->email->send();
##########################################End  USer send mail ###############################################
          ######################### Admin mail send start ###################################################

            $message_a='<html>
                         <body bgcolor="#DCEEFC">
                         <br><div>
                                 <table>
                                  <tr> Dear &nbps; '.ucfirst($this->post('adminfname')).' '. ucfirst($this->post('adminlname')).' ,</tr>
                                 <tr> <td>A new Business Admin has been created.</td></tr>
                                <tr><td> User  Name: '.ucfirst($this->post('appFirstName')).'</td></tr>
                                <tr><td>  Thanks,</br>
                                Support Team</br>
                                9999999999 </br>
                                9:00 Am to 5:00 Pm IST</td></tr>
 
                                </table>
                               </div>
                              </body>
                </html>';
                    $this->load->library('email');
                    $this->email->set_newline("\r\n");
          $this->email->from('barun@mindztechnology.com', 'Tru Expense');
          $this->email->to($this->post('adminemail'));
          $this->email->subject('TruExpense || New Business Admin Created');
          $this->email->message($message_a);
          $this->email->send();

################################# #End admin mail send  #########################################################

                        if(!empty($data)){
                        $data   = $this->send_json($data);
                        $this->response($data, 202);                         }
                         else{
                        $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
                         }

      }

   function businesslist_get() {
	    //$this->some_model->updateUser( $this->get('id') );
        $data = json_decode(file_get_contents("php://input"), true);
               $parameter = array(
		                          'id'           =>'0',
                              'b_Deleted'    =>'0',
							                'act_mpde'     =>'allview'
                              );
		$data = $this->supper_admin->call_procedure('proc_businesslist',$parameter);
      	if(!empty($data)){
            $data   = $this->send_json($data);
            $this->response($mymessage, 202);
        }
        else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }

	   }

     function businessdelete_post() {
        $data = json_decode(file_get_contents("php://input"), true);
                    $parameter = array(
                                 'p_mode'       =>'delete',
                                 'p_BusinessId' => $this->post('id'),
                                 'deleted'      => $this->post('b_deleted')

                              );
      $data = $this->supper_admin->call_procedureRow('proc_Businessdeleted',$parameter);
           if(!empty($data)){
            $data   = $this->send_json($data);
            $this->response($data, 202);
        }
        else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }

       }
        function businessstts_post() {
        $data = json_decode(file_get_contents("php://input"), true);
                    $parameter = array(
                                 'p_mode'       =>'status',
                                 'p_BusinessId' => $this->post('id'),
                                 'deleted'      => $this->post('status')

                              );
      $data = $this->supper_admin->call_procedureRow('proc_Businessdeleted',$parameter);
           if(!empty($data)){
            $data   = $this->send_json($data);
            $this->response($data, 202);
        }
        else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }

       }
	   function businesseview_post() {
	    $data = json_decode(file_get_contents("php://input"), true);
                    $parameter = array(
                  					           'id'  => $this->post('id'),
                                        'bdeleted'  =>'0',
          							                'act_mode' =>'view'
                                      );
      $data = $this->supper_admin->call_procedureRow('proc_businesslist',$parameter);
           if(!empty($data)){
            $data   = $this->send_json($data);
            $this->response($mymessage, 202);
        }
        else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }

	   }
   function businessedit_post() {
        $data = json_decode(file_get_contents("php://input"), true);
                    $parameter = array(
                                            'p_mode'             =>'Update',
                                            'p_BusinessId'       =>$this->post('businessId'),
                                            'p_Busineescode'     =>'p_Busineescode',
                                            'p_BussinessName'    => $this->post('businessName'),
                                            'p_Countryid'        => $this->post('businessCountry'),
                                            'p_StateId'          => $this->post('businessState'),
                                            'p_CityId'           => $this->post('businessCity'),
                                            'p_Address'          => $this->post('businessAddress').'___'.$this->post('businessAddress2'),
                                            'p_Status'           => $this->post('Status'),
                                            'p_Startdate'        => $this->post('businessStartDate'),

                                            'p_EndDate'          => $this->post('businessEndDate'),
                                            'p_UserCount'        => $this->post('businessEmployee'),
                                            'p_CurrencyId'       => $this->post('businessCurrency'), // SHEETESH 24 NOV
                                            'p_ExpInOtrCurrency' => $this->post('expensesothercurrency'),
                                            'p_Dateformat'       => $this->post('businessDateFormat'),
                                            'p_AdminId'          => 1,
                                            'p_Billingname'      => $this->post('businessBillingType'),
                                            'p_BillingType'      => $this->post('businessBillingType'),
                                            'p_BillingAddr'      => $this->post('businessBillingEmail'),
                                            'p_BillingAddrline1' => $this->post('businessBillingAddress'),

                                            'p_BillingAddrline2' => $this->post('businessBillingAddress2'),
                                            'p_BillContact'      => $this->post('businessBillingContact'),
                                            'bill_contry'        => $this->post('businessBillingCountryId'),
                                            'bill_state'         => $this->post('businessBillingStateId'),
                                            'bill_city'          => $this->post('businessBillingCityId'),

                                            //'p_BillingAddrline211'  => 1,
                                            'p_Package'          => $this->post('businessBillingPackage'),
                                            'p_Distance'         => $this->post('distancemeasure'),
                                            'p_Fname'            => $this->post('appFirstName'),
                                            'p_Lname'            => $this->post('appLastName'),
                                            'p_ConidfAppInf'     => $this->post('appCountry'),
                                            'p_StateIdfAppInf'   => $this->post('appState'),
                                            'p_CityIdfAppInf'    => $this->post('appCity'),
                                            'p_AddrfAppInf'      => $this->post('appAddress1').'___'. $this->post('appAddress2'),
                                            'p_ContactfAppIn'    => $this->post('appPhone'),
                                            'p_EmailfAppIn'      => $this->post('appEmail'),
                                         //   'p_EmailfAppIn'      => 'hdgfh' ,
                                            'p_DobfAppIn'        =>  $this->post('appDob'),
                                            'p_PositionfAppIn'   => $this->post('appCompanyPosition'),
                                            'p_AdminTypefAppIn'  => 22,
                                            'p_CreatedOn'        => '',
                                            'p_CreatedBy'        => 1,
                                            'p_Deleted'          => 0


                              );

                      $this->supper_admin->call_procedure('proc_bus_upd',$parameter);
                      $data=array('success'=>'success');
                    if(!empty($data)){
                        $data   = $this->send_json($data);
                       $this->response($data, 202);
                      }
        else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }

     }
//  Business search  by_status
function business_search_post(){
        $data = json_decode(file_get_contents("php://input"), true);
          $parameter= array( 
            'act_mpde'=>$this->post('act_mode') ,
            'b_name' => $this->post('business_name') ,
           'p_ststus'=>$this->post('p_ststus') ,
           'p_bullingtype'=>$this->post('p_bullingtype') ); // 'proc_businesssearch' Deprecated procedure
          $data =$this->supper_admin->call_procedure('proc_businesssearch_advanse',$parameter);
          if (!empty($data)) {
          $parameter = $this->send_json($data);
          $this->response($parameter,200);
                      }
                      else{
                        $this->response("Something Went Wrong", 400);
                      }

}
// End business search

function searchbusinessall_post(){
        $data = json_decode(file_get_contents("php://input"), true);
          $parameter= array( 
           'act_mpde'=>$this->post('act_mode') ,
            'b_name' => $this->post('business_name') ,
           'p_ststus'=>$this->post('p_ststus') ,
           'p_bullingtype'=>$this->post('p_bullingtype') );
          $data =$this->supper_admin->call_procedure('proc_businesssearch',$parameter);
          if (!empty($data)) {
          $parameter = $this->send_json($data);
          $this->response($parameter,200);
                      }
                      else{
                        $this->response("Something Went Wrong", 400);
                      }

}

// ################################## SHEETESH 25 NOV #################################
function shebusdtl_post(){
        $data = json_decode(file_get_contents("php://input"), true);
          $parameter= array('act_mpde'=>$this->post('act_mode') , 'businesssid'=>$this->post('busineaaid') );
          $data =$this->supper_admin->call_procedure('proc_sheebusdtl',$parameter);
          if (!empty($data)) {
          $parameter = $this->send_json($data);
          $this->response($parameter,200);
                      }
                      else{
                        $this->response("Something Went Wrong", 400);
                      }


}
// ############################## SHEETESH 25 NOV #################################

     function badminanspassword_post(){
                $data = json_decode(file_get_contents("php://input"), true);
                $parameter= array( 'act_mode' => $this->post('a_mode') , 'id'=>$this->post('id'),'passans'=>$this->post('passans'));
                $data =$this->supper_admin->call_procedure('proc_ssabachangepassans',$parameter);

     
           if (!empty($parameter)) {
           $parameter = $this->send_json($parameter);
           $this->response($parameter,200);
                      }
                      else{
                        $this->response("Something Went Wrong", 400);
                      }
             }



// Clame report statr hear 

function ssagetallbusiness_post(){
                  $data = json_decode(file_get_contents("php://input"), true);
                  $parameter= array( 'act_mode' => $this->post('act_mode') , 'admintype'=>$this->post('admintype'),'adminid'=>$this->post('adminid'));
                  $data =$this->supper_admin->call_procedure('proc_ssagetbusiness',$parameter);
                  if (!empty($data)) {
                  $parameter = $this->send_json($data);
                  $this->response($parameter,200);
                  }
                  else{
                    $this->response("Something Went Wrong", 400);
                  }
             }


// end claim report //

//SHEETESH CHECK EMAIL FOR BUSINESS DONT TOUCH 
function checkEmailExist_post()
{ $data = json_decode(file_get_contents("php://input"), true);
                  $parameter= array( 'bemail'   => $this->post('bemail'),
                                     'bseq'     => '',
                                     'act_mode' => 'emailcheck'
                                   ); 
                  $data =$this->supper_admin->call_procedureRow('proc_checkbemail',$parameter);
                  if (!empty($data)) {
                  $parameter = $this->send_json($data);
                  $this->response($parameter,200);
                  }
                  else{
                    $this->response("Something Went Wrong", 400);
                  }
             }

    function firstloginpasschange_post()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        $parameter = array('act_mode' => $this->post('act_mode'), 'userid' => $this->post('userid'));
        $data = $this->supper_admin->call_procedureRow('proc_flogin_passchange', $parameter);
        if (!empty($data)) {
            $parameter = $this->send_json($data);
            $this->response($parameter, 200);
        } else {
            $this->response("Something Went Wrong", 400);
        }
    }

// end of class
}
