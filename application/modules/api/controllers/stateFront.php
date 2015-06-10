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


}