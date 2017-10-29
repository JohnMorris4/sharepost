<?php
    class Posts extends Controller {
        public function __construct(){
            if(!isLoggedIn()){
                redirect('users/login');
            }
            
            $this->postModel = $this->model('Post');
            $this->userModel = $this->model('User');
        }


        public function index(){
            //Get Post
            $posts = $this->postModel->getPosts();


            $data = [
                'posts' => $posts

            ];
            
            
            $this->view('posts/index', $data);
            
        }

        public function add(){
            if($_SERVER['REQUEST_METHOD']=='POST'){
                //Sanitize the post
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data = [
                    'title' => trim($_POST['title']),
                    'body' => trim($_POST['body']),
                    'user_id' => $_SESSION['user_id'],
                    'title_err' => '',
                    'body_err' => ''
                ];

                //Validate information
                if(empty($data['title'])){
                    $data['title_err'] = 'Please enter a title';
                } 
                if(empty($data['body'])){
                    $data['body_err'] = 'Please enter a body';
                }
                if(empty($data['title_err']) && empty($data['body_err'])){
                    //validate post
                    if($this->postModel->addPost($data)){
                        flash('post_message', 'Post Added');
                        redirect('posts');
                    } else {
                        die('Something went wrong');
                    }
                } else {
                    //load the view
                    $this->view('posts/add', $data);
                }

            } else {
            $data = [
                'title' => '',
                'body' => ''
            ];
            $this->view('posts/add', $data);
            }
        }

        public function edit($id){
            if($_SERVER['REQUEST_METHOD']=='POST'){
                //Sanitize the post
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data = [
                    'id' => $id,
                    'title' => trim($_POST['title']),
                    'body' => trim($_POST['body']),
                    'user_id' => $_SESSION['user_id'],
                    'title_err' => '',
                    'body_err' => ''
                ];

                //Validate information
                if(empty($data['title'])){
                    $data['title_err'] = 'Please enter a title';
                } 
                if(empty($data['body'])){
                    $data['body_err'] = 'Please enter a body';
                }
                if(empty($data['title_err']) && empty($data['body_err'])){
                    //validate post
                    if($this->postModel->updatePost($data)){
                        flash('post_message', 'Post Edited');
                        redirect('posts');
                    } else {
                        die('Something went wrong');
                    }
                } else {
                    //load the view
                    $this->view('posts/edit', $data);
                }

            } else {
                //Fetch Post
                $post = $this->postModel->getPostById($id);
                //Check for ownership
                if($post->user_id != $_SESSION['user_id']){
                    redirect('posts');
                }
            $data = [
                'id'=> $id,
                'title' => $post->title,
                'body' => $post->body
            ];
            $this->view('posts/edit', $data);
            }
        }

        public function show($id){
            $post = $this->postModel->getPostById($id);
            $user = $this->userModel->getUserById($post->user_id);
            $data= [
                'post' => $post,
                'user' => $user
            ];  
            $this->view('posts/show', $data);
        }
        public function delete($id){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                if($this->postModel->deletePost($id)){
                    flash('post_message', 'Post Deleted', 'alert alert-danger');
                    redirect('posts');
                } else {
                    die('Something went wrong');
                }
            } else {
                redirect('posts');
            }
        }
    }