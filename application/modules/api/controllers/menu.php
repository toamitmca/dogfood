<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Menu extends REST_Controller{
   
    function send_json($array){

        $this->output->set_content_type('application/json');
        $this->output->set_header('Cache-Control: no-cache, must-revalidate');
        $this->output->set_header('Expires: '.date('r', time()+(86400*365)));
        echo json_encode($array);
        exit();
   	 }

    function menu22_post(){

        $data = json_decode(file_get_contents("php://input"), true);
       
        $parameter = array(
        					't_menunane'   => $this->post('t_menunane'),
        					't_url'        => $this->post('t_url'),
                            'type'   	   => $this->post('type'),
                            'p_mode'       => $this->post('p_mode')
                          );

        $data = $this->supper_admin->call_procedureRow('proc_menu', $parameter);
        if(!empty($data)){
            $data   = $this->send_json($data);  
            $this->response($data, 202); 
        }
        else{
             $this->response("Something Went Wrong", 400); 
        }
       
    }
 


// end of class
}