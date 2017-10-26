<?php
class Users extends Controller{
    public function __construct(){

    }
    public function register(){
        //Check for POST
        if($_SERVER['REQUEST_METHOD']=='POST'){
            //process the form
            //Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];

            //vaildate name
            if(empty($data['name'])){
                $data['name_err'] = 'Please enter name';
            }
            //Validate email
            if(empty($data['email'])){
                $data['email_err'] = 'Please enter email';
            }
            //Validate password
            if(empty($data['password'])){
                $data['password_err'] = 'Please enter your password';
            } elseif (strlen($data['password']) < 6){
                $data['password_err'] = 'Please enter a password of at least 6 characters';
            }
            //Validate confirm password
            if(empty($data['confirm_password'])){
                $data['confirm_password_err'] = 'Please confirm your password';
            } else {
                if($data['password'] != $data['confirm_password']){
                    $data['confirm_password_err'] = 'Your passwords do not match';
                }
            }
            //Make sure that errors are empty
            if(empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])){
                //Validated all
                die('SUCCESS');
            } else {
                //Load View with Errors
                $this->view('users/register', $data);
            }

        } else {
            //load the form
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];
            //Load view
            $this->view('users/register', $data);
        }
    }
    public function login(){
        //Check for POST
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if($_SERVER['REQUEST_METHOD']=='POST'){
            //process the form
            $data = [
                'email' => '',
                'password' => '',
                'email_err' => '',
                'password_err' => ''
            ];
            if(empty($data['email'])){
                $data['email_err'] = 'Please enter email';
            }
            //Validate password
            if(empty($data['password'])){
                $data['password_err'] = 'Please enter your password';
            } 
            if(empty($data['email_err']) && empty($data['password_err'])){
                //Validated all
                die('SUCCESS');
            } else {
                //Load View with Errors
                $this->view('users/login', $data);
            }
        } else {
            //load the form
            $data = [
                'email' => '',
                'password' => '',
                'email_err' => '',
                'password_err' => ''
            ];

            
            //Load view
            $this->view('users/login', $data);
        }
    }
}