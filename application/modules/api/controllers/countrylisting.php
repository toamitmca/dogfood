<?php defined('BASEPATH') OR exit('No direct script access allowed');


// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH.'/libraries/REST_Controller.php';

class Countrylisting extends REST_Controller{


function send_json($array){

  $this->output->set_content_type('application/json');
  $this->output->set_header('Cache-Control: no-cache, must-revalidate');
  $this->output->set_header('Expires: '.date('r', time()+(86400*365)));
  echo json_encode($array);
  exit();
}
    

    
     function country_get(){
       
        
        if($this->get('id')){
            $a_CountryId=$this->get('id');
         }else{
             $a_CountryId="";
         }

         if($this->get('t_CountryName')){
            $t_CountryName=$this->get('t_CountryName');
         }else{
             $t_CountryName="";
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

        // $t_CountryName=$this->get('t_CountryName');
        // $act_mode=$this->get('act_mode');
        // $n_AdminType=$this->get('n_AdminType');

       
       
        $arrayParameter=array("t_CountryName" =>$t_CountryName,
                                "n_AdminType" =>$n_AdminType,
                                "id" =>$a_CountryId,
                                "act_mode" =>$act_mode);
        //$arrayParameter  = $this->get('a_CountryId');

        $responsedata=$this->supper_admin->call_procedure('proc_countryManage',$arrayParameter);

        if($responsedata)
        {
            $responsedata = $this->send_json($responsedata);   
            $this->response($responsedata, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'Country List not found'), 404);
        }
    }

    function country_post()
    {
       
        $data = json_decode(file_get_contents("php://input"), true);
        $parameter=array('countryName' => trim($this->post('countryName1')),
                            //'d_CreatedOn' => $this->post('d_CreatedOn'),
                            'id' => trim($this->post('id')),
                            'act_mode' => trim($this->post('act_mode')),
                            'createdBy' => $this->post('n_CreatedBy'),
                            //'d_ModifiedOn' => $this->post('d_ModifiedOn'),
                            //'n_ModifiedBy' => $this->post('n_ModifiedBy'),
                            'active' => trim($this->post('b_IsActive')),
                            'businessId' => trim($this->post('n_BusinessId')),
                            'adminUser' => $this->post('n_AdminType')
                            );
        if(($this->post('act_mode')=="insertinto") || ($this->post('act_mode')=="update") || ($this->post('act_mode')=="delete")){
            $this->supper_admin->call_procedure('proc_countryManage', $parameter);
            $data = array('success'=>'success');
        }else{
            $data = $this->supper_admin->call_procedure('proc_countryManage', $parameter);
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
    function country_delete()
    {
        //$this->some_model->deletesomething( $this->get('id') );
        $message = array('id' => $this->get('id'), 'message' => 'DELETED!');
        
        $this->response($message, 200); // 200 being the HTTP response code
    }



}