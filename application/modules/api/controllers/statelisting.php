<?php defined('BASEPATH') OR exit('No direct script access allowed');
	// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH.'/libraries/REST_Controller.php';

class Statelisting extends REST_Controller{


function send_json($array){

  $this->output->set_content_type('application/json');
  $this->output->set_header('Cache-Control: no-cache, must-revalidate');
  $this->output->set_header('Expires: '.date('r', time()+(86400*365)));
  echo json_encode($array);
  exit();
}
     function state_get(){
       
        
        if($this->get('id')){
            $a_stateId=$this->get('id');
         }else{
             $a_stateId="";
         }

         if($this->get('t_stateName')){
            $t_stateName=$this->get('t_stateName');
         }else{
             $t_stateName="";
         }
        
        if($this->get('act_mode')){
            $act_mode=$this->get('act_mode');
         }else{
             $act_mode=$this->response("Act mode is not giving", 400);
         }

         if($this->get('n_AdminType')){
            $n_AdminType=$this->get('n_AdminType');
         }else{
             $this->response("Admin Type Not given", 400);
         }

       
       
        $arrayParameter=array("t_stateName" =>$t_stateName,
                                "n_AdminType" =>$n_AdminType,
                                "id" =>$a_stateId,
                                "act_mode" =>$act_mode);
        //$arrayParameter  = $this->get('a_stateId');

        $responsedata=$this->supper_admin->call_procedure('proc_stateManage',$arrayParameter);

        if($responsedata)
        {
            $responsedata = $this->send_json($responsedata);   
            $this->response($responsedata, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'state List not found'), 404);
        }
    }

    function state_post()
    {
       $data = json_decode(file_get_contents("php://input"), true);
       $pMode=$this->post('p_mode');
       if(($pMode=='Select') || ($pMode=='Editselect') || ($pMode=='Stateselect')){
        $parameter=array('id' => $this->post('id'),
                         'b_IsActive' => $this->post('b_IsActive'),
                         'n_BusinessId' => $this->post('n_BusinessId'),
                         'p_mode' => $this->post('p_mode'),
                         'n_AdminType' => $this->post('n_AdminType')
                        );
        $data = $this->supper_admin->call_procedure('proc_EditViewState', $parameter);
       }else{
            $parameter=array('p_mode' => $this->post('p_mode'),
                            'n_CountryId' => $this->post('n_CountryId'),
                            'id' => $this->post('id'),
                            't_StateName' => $this->post('t_StateName'),
                            'n_AdminType' => $this->post('n_AdminType'),
                            'n_BusinessId' => $this->post('n_BusinessId'),
                            'n_CreatedBy' => $this->post('n_CreatedBy'),
                            //'n_ModifiedBy' => $this->post('n_ModifiedBy'),
                            'b_IsActive' => $this->post('b_IsActive'),
                           );
             $this->supper_admin->call_procedure('proc_AddState', $parameter);
             $data = array('success'=>'success');
       }
      
        if(!empty($data)){
            $data   = $this->send_json($data);  
            $this->response($data, 202); 
        }
        else{
             $this->response("Something Went Wrong", 400); // 200 being the HTTP response code
        }
       
    }
    public function send_post(){
        var_dump($this->request->body);
    }


    public function send_put(){
        var_dump($this->put('foo'));
    }

    function state_delete(){
        //$this->some_model->deletesomething( $this->get('id') );
        $message = array('id' => $this->get('id'), 'message' => 'DELETED!');
        $this->response($message, 200); // 200 being the HTTP response code
    }



}