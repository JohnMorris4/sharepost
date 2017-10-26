<?php
/*
 *App Core Class
 * Creates URL & loads core Controller
 * URL FORMAT - /controller/method/params
 */

 class Core {
     protected $currentController = 'Pages';
     protected $currentMethod = 'index';
     protected $params = [];


     public function __construct(){
        $url = $this->getUrl();
        //Look in controller for first value
        if(file_exists('../app/controllers/' . ucwords($url[0]). '.php')){
            //If exist set as current controller
            $this->currentController = ucwords($url[0]);
            unset($url[0]);
        }
         //Require the controller
         require_once '../app/controllers/'. $this->currentController . '.php';

         //Instantiate controller
         $this->currentController = new $this->currentController;

         //Check for the second part of the URL
         if(isset($url[1])){
             //Check to see if method exist
             if(method_exists($this->currentController, $url[1])){
                $this->currentMethod = $url[1];
                //Unset method
                 unset($url[1]);

             }
         }
         //Get Params
         $this->params = $url ? array_values($url) : [];
         // Call a callback of array of params
         call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
     }

     public function getUrl(){
         if(isset($_GET['url'])){
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
         }
     }
 }