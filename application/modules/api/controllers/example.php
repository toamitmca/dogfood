<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Example
 *=
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array.
 *
 * @package     CodeIgniter
 * @subpackage  Rest Server
 * @category    Controller
 * @author      Phil Sturgeon
 * @link        http://philsturgeon.co.uk/code/
*/

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH.'/libraries/REST_Controller.php';

class Example extends REST_Controller
{
    

    function user_get()
    {
        if(!$this->get('id'))
        {
            $this->response(NULL, 400);
        }

        // $user = $this->some_model->getSomething( $this->get('id') );
        $users = array(
            1 => array('id' => 1, 'name' => 'Some Guy', 'email' => 'example1@example.com', 'fact' => 'Loves swimming'),
            2 => array('id' => 2, 'name' => 'Person Face', 'email' => 'example2@example.com', 'fact' => 'Has a huge face'),
            3 => array('id' => 3, 'name' => 'Scotty', 'email' => 'example3@example.com', 'fact' => 'Is a Scott!', array('hobbies' => array('fartings', 'bikes'))),
        );
        
        $user = @$users[$this->get('id')];
        
        if($user)
        {
            $user = $this->send_json($users);   
            $this->response($user, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'User could not be found'), 404);
        }
    }
    
    function user_post()
    {
        //$this->some_model->updateUser( $this->get('id') );
        $data = json_decode(file_get_contents("php://input"), true);
        $message['name'] = $this->post('name');
        $message['email'] = $this->post('email');
        $message['message'] = $this->post('message');

        
        if(!empty($message)){
            $mymessage   = $this->send_json($message);  
            $this->response($mymessage, 202 ); // 200 being the HTTP response code
        }
        else{
             $this->response("somethig went wrong", 400); // 200 being the HTTP response code
        }
       
    }


function send_json($array){

  $this->output->set_content_type('application/json');
  $this->output->set_header('Cache-Control: no-cache, must-revalidate');
  $this->output->set_header('Expires: '.date('r', time()+(86400*365)));
  echo json_encode($array);
  exit();
}
    
    function user_delete()
    {
        //$this->some_model->deletesomething( $this->get('id') );
        $message = array('id' => $this->get('id'), 'message' => 'DELETED!');
        
        $this->response($message, 200); // 200 being the HTTP response code
    }
    
    function users_get()
    {
        //$users = $this->some_model->getSomething( $this->get('limit') );
        $users = array(
            array('id' => 1, 'name' => 'Some Guy', 'email' => 'example1@example.com'),
            array('id' => 2, 'name' => 'Person Face', 'email' => 'example2@example.com'),
            3 => array('id' => 3, 'name' => 'Scotty', 'email' => 'example3@example.com', 'fact' => array('hobbies' => array('fartings', 'bikes'))),
        );
        
        if($users)
        {     
            $this->output->set_content_type('application/json');
            $this->output->set_header('Cache-Control: no-cache, must-revalidate');
            $this->output->set_header('Expires: '.date('r', time()+(86400*365)));
            $users = $this->send_json($users);
            $this->response($users, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }


    public function send_post()
    {
        var_dump($this->request->body);
    }


    public function send_put()
    {
        var_dump($this->put('foo'));
    }


}