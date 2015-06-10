<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class AddSupperAdmin extends REST_Controller{
   

    function send_json($array){

        $this->output->set_content_type('application/json');
        $this->output->set_header('Cache-Control: no-cache, must-revalidate');
        $this->output->set_header('Expires: '.date('r', time()+(86400*365)));
        echo json_encode($array);
        exit();
   	 }

    function admin_post(){

        //$this->some_model->updateUser( $this->get('id') );
        $data = json_decode(file_get_contents("php://input"), true);
       
        // $parameter = array(
        //                       'email'     => $this->post('email'),
        //                       'password'  => $this->post('password'),
        //                       'act_mode'  => 'SuperAdmin',
        //                       'userlist'  => ''
        //                   );

        //$data = $this->supper_admin->call_procedureRow('proc_adminLogin', $parameter);
      	
        if(!empty($data)){
            $data   = $this->send_json($data);  
            $this->response($mymessage, 202); 
        }
        else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }
       
    }
    function user_post(){

        //$this->some_model->updateUser( $this->get('id') );
        $data = json_decode(file_get_contents("php://input"), true);
       
        // $parameter = array(
        //                       'email'     => $this->post('email'),
        //                       'password'  => $this->post('password'),
        //                       'act_mode'  => 'SuperAdmin',
        //                       'userlist'  => ''
        //                   );

        //$data = $this->supper_admin->call_procedureRow('proc_adminLogin', $parameter);
      	
        if(!empty($data)){
            $data   = $this->send_json($data);  
            $this->response($mymessage, 202); 
        }
        else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }
       
    }


   function businessregister_post(){
		
        //$this->some_model->updateUser( $this->get('id') );
        $data = json_decode(file_get_contents("php://input"), true);

                            /*'p_mode'=>'insert',
                            'p_BusinessId bigint'=>''
                            'businessName'              => $this->post('businessName'),
                            'Status'                    => $this->post('Status'),
                            'businessAddress'           => $this->post('businessAddress'),
                            'businessAddress2'          => $this->post('businessAddress'),
                            'businessCountry'           => $this->post('businessCountry'),
                            'businessState'             => $this->post('businessState'),
                            'businessCity'              => $this->post('businessCity'),
                            'businessEmployee'          => $this->post('businessEmployee'),
                            'businessStartDate'         => $this->post('businessStartDate'),
                            'businessEndDate'           => $this->post('businessEndDate'),
                            'businessCurrency'          => $this->post('businessCurrency'), 
                            'expensesothercurrency'     => $this->post('expensesothercurrency'),
                            'distancemeasure'           => $this->post('distancemeasure'),
                            'businessDateFormat'        => $this->post('businessDateFormat'),

                            'appFirstName'              => $this->post('appFirstName'),
                            'appLastName'               => $this->post('appLastName'),
                            'appAddress1'               => $this->post('appAddress1'),
                            'appAddress2'               => $this->post('appAddress2'),
                            'appCountry'                => $this->post('n_CountryId_2'),
                            'appState'                  => $this->post('n_StateId_2'),
                            'appCity'                   => $this->post('n_City_2'),
                            'appPhone'                  => $this->post('appPhone'),
                            'appEmail'                  => $this->post('appEmail'),
                            'appDob'                    => $this->post('appDob'),
                            'appCompanyPosition'        => $this->post('appCompanyPosition'),
                            
                            'businessBillingType'       => $this->post('businessBillingType'),
                            'businessBillingContact'    => $this->post('businessBillingContact'),
                            'businessBillingEmail'      => $this->post('businessBillingEmail'),
                            'businessBillingPackage'    => $this->post('businessBillingPackage'),
                            'businessBillingAddress'    => $this->post('businessBillingAddress'),
                            'businessBillingAddress2'   => $this->post('businessBillingAddress2'),
                            'businessBillingCountryId'  => $this->post('businessBillingCountryId'),
                            'businessBillingStateId'    => $this->post('businessBillingStateId'),
                            'businessBillingCityId'     => $this->post('businessBillingCityId') */

                               $parameter = array(

                                            'p_mode'=>"Insert",
                                            'p_BusinessId'=>'',
                                            'p_Busineescode'="",
                                            'p_BussinessName'=> $this->post('businessName'),
                                            'p_Countryid' => $this->post('businessCountry'),
                                            'p_StateId' => $this->post('businessState'),
                                            'p_CityId' => $this->post('businessCity'),
                                            'p_Address'=> $this->post('businessBillingAddress').'%'.$this->post('n_CountryId_2'),
                                            'p_Status'  => $this->post('Status'),
                                            'p_Startdate' => $this->post('businessStartDate'),
                                            'p_EndDate' => $this->post('businessEndDate'),
                                            'p_UserCount' => $this->post('businessEmployee'),
                                            'p_CurrencyId' => $this->post('businessCurrency'),
                                            'p_ExpInOtrCurrency' => $this->post('expensesothercurrency'),
                                            'p_Dateformat'  => $this->post('businessDateFormat')  ,
                                            'p_AdminId'=>"" ,
                                            'p_BillingType' => $this->post('businessBillingType'),
                                            'p_BillingName' => $this->post('businessBillingContact'),
                                            'p_BillingAddr' => $this->post('businessBillingAddress').'%'.$this->post('businessBillingAddress2'),
                                            'p_Package'  => $this->post('businessBillingPackage'),
                                            'p_Distance'=>"",
                                            'p_Fname'   $this->post('appFirstName'),
                                            'p_Lname' $this->post('appLastName'),
                                            'p_ConidfAppInf'=>'',
                                            'p_StateIdfAppInf' $this->post('n_CountryId_2'),
                                            'p_CityIdfAppInf' => $this->post('n_CountryId_2'),
                                            'p_AddrfAppInf'  => $this->post('appAddress1').'%'.$this->post('appAddress2'),
                                            'p_ContactfAppIn' => $this->post('appPhone'),
                                            'p_EmailfAppIn'=> $this->post('appEmail'),
                                            'p_DobfAppIn'=>  $this->post('appDob'),
                                            'p_PositionfAppIn'  => $this->post('appCompanyPosition'),
                                            'p_AdminTypefAppIn'=>"",
                                            'p_CreatedOn'=>"",
                                            'p_CreatedBy'=>"",
                                            'p_Deleted'=>""

                                   );
       
                           // $data = $this->supper_admin->call_procedureRow('proc_Businessdtl', $parameter);
      	
        if(!empty($parameter)){
            $parameter   = $this->send_json($parameter);  
            $this->response($parameter, 202); 
        }
        else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }
       
   }

}