<?php
    class Pages extends Controller {
        public function __construct(){
          }
        public function index(){
            $data = [
                'title' => 'Home',
                'title_2' => 'SharePosts',
                'description' => 'Simple example of social network built on AxiomPHP framework'
                
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

