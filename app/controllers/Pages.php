<?php
    class Pages extends Controller {
        public function __construct(){
            $this->postModel = $this->model('Post');
          }
        public function index(){
            if(isLoggedIn()){
                redirect('/posts/index');
            }



            $data = [
                'title' => 'Home',
                'title_2' => 'SharePost',
                'description' => 'Project built off of AxiomPHP'
                
            ];
            
            $this->view('pages/index', $data);
        }

        public function about(){
            $data = [
                'title' => 'About Us',
                'description' => 'App to share post with other users'
            ];
            $this->view('pages/about', $data);
        }
        public function posts(){
            $data = [
                'title' => 'Posts',
                'description' => 'Current Posts'
            ];
            $this->view('posts/index', $data);
        }

    }

