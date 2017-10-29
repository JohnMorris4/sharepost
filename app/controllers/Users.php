<?php
class Users extends Controller{
    public function __construct(){
        $this->userModel = $this->model('User');
    }
    public function register(){
        //Check for POST
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //process the form
            //Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data =[
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
            } else {
                //Check Email field
                if($this->userModel->findUserByEmail($data['email'])){
                    $data['email_err'] = 'Email is already Taken';
                }
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
               
                //Hash password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                //Register user
                if($this->userModel->register($data)){
                    flash('register_success', 'You are now registered');
                    redirect('users/login');
                } else {
                    die('Something Went Wrong');
                }
                
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
        if($_SERVER['REQUEST_METHOD']=='POST'){
            //process the form
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
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
            
            //Check for user/email
            if($this->userModel->findUserByEmail($data['email'])){
               // die('success');
                //user found
            } else {
                $data['email_err'] = 'User Not Found';
            }
            
            if(empty($data['email_err']) && empty($data['password_err'])){
                //Validated all
                //Check and set registered user
                $loggedInUser = $this->userModel->login($data['email'], $data['password']);

                if($loggedInUser){
                    //Create Session variable
                    $this->createUserSession($loggedInUser);
                } else {
                    $data['password_err'] = 'Incorrect Password ';
                    //reload view
                    $this->view('users/login', $data);
                }
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

    public function createUserSession($user){
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name'] = $user->name;
        redirect('posts');
    }
    public function logout(){
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        session_destroy();
        redirect('users/login');
    }
   
}