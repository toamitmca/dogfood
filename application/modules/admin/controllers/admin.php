<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    function index()
    {

        $this->load->view('index');
    }
    function logout()
    {
        session_unset();
        $redirect_url = base_url();
        $this->session->sess_destroy();
        redirect($redirect_url);
        exit();
    }
    function native_curl()
    {
        //$data = file_get_contents("http://192.168.1.22/ci/index.php/api/example/user/id/22/format/json");
        $data = file_get_contents("http://localhost/app/dogfood/api/example/user/id/22/format/json");
        echo '<pre>';
        print_r($data);
        $this->load->view('index');
    }

    function ci_curl()
    {
        // http://192.168.1.22/ci/index.php/api/example/user/id/22/format/json
        // $url = 'http://twitter.com/statuses/update.json';
        // Set up and execute the curl process

        $curl_handle = curl_init();
        //curl_setopt($curl_handle, CURLOPT_URL, 'http://192.168.1.22/ci/index.php/api/example/user/id/22/format/json');
        curl_setopt($curl_handle, CURLOPT_URL, 'http://localhost/app/dogfood/api/example/user/id/22/format/json');
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl_handle, CURLOPT_POST, true);
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS, array(
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'message' => $this->input->post('message'),
        ));
        $response = curl_exec($curl_handle);
        curl_close($curl_handle);
        print_r($response);
        $result = json_decode($response);

        if (!empty($result)) {

            print_r($result);
        }
    }

    function p($data)
    {
        echo "<pre>";
        print_r($data);
        die();
    }
}