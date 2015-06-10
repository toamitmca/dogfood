<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Billing_package extends REST_Controller{
   
    function send_json($array){

        $this->output->set_content_type('application/json');
        $this->output->set_header('Cache-Control: no-cache, must-revalidate');
        $this->output->set_header('Expires: '.date('r', time()+(86400*365)));
        echo json_encode($array);
        exit();
   	 }

    function businessadmin_post(){

        $data = json_decode(file_get_contents("php://input"), true);
       
        $parameter = array(
                            't_Email'      => $this->post('t_Email'),
                            't_password'   => $this->post('t_password'),
                            'act_mode'     => $this->post('act_mode')
                          );
        //$data = $this->supper_admin->call_procedureRow('proc_business_login', $parameter);
        if(!empty($parameter)){
            $parameter   = $this->send_json($parameter);  
            $this->response($mymessage, 202); 
        }
        else{
             $this->response("Something Went Wrong", 400); 
        }
       
    }
 


// end of class
}