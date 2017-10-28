<?php
    class Pages extends Controller {
        public function __construct(){
          }
        public function index(){
            $data = [
                'title' => 'Home',
                'title_2' => 'Full Stack Web Development',
                'description' => 'Let me create your next step to success'
                
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
    }

