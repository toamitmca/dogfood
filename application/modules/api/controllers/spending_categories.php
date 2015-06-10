<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Spending_categories extends REST_Controller{
   

    function send_json($array){

        $this->output->set_content_type('application/json');
        $this->output->set_header('Cache-Control: no-cache, must-revalidate');
        $this->output->set_header('Expires: '.date('r', time()+(86400*365)));
        echo json_encode($array);
        exit();
   	 }

    function spendcat_post(){
		
        $data = json_decode(file_get_contents("php://input"), true);
        $parameter = array('p_SpndngCatId'        => $this->post('p_SpndngCatId'),
                              'p_mode'            => $this->post('p_mode'),
                              'p_SpndName'        => $this->post('p_SpndName'),
                              'p_GLCode'        => $this->post('p_GLCode'),
                              'p_CreatedBy'      => $this->post('p_CreatedBy'),
                              'p_AdminType'       => $this->post('p_AdminType'),
                              'p_BusinessId'      => $this->post('p_BusinessId'),
                             );
         
        $data = $this->supper_admin->call_procedure('proc_SpendingCategory', $parameter);
      	
        if(!empty($data)){
            $data   = $this->send_json($data);  
            $this->response($data, 202); 
        }
        else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }
       
    }
// end of class
}
