<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Super_state_admin extends REST_Controller{
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
            $user22 = $this->send_json($user);
            $this->response($user22, 200); // 200 being the HTTP response code
        }

        else
        {
            $this->response(array('error' => 'User could not be found'), 404);
        }
    }

    function send_json($array){

        $this->output->set_content_type('application/json');
        $this->output->set_header('Cache-Control: no-cache, must-revalidate');
        $this->output->set_header('Expires: '.date('r', time()+(86400*365)));
        echo json_encode($array);
        exit();
    }




}