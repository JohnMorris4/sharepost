<?php
/*
 * Base Controller
 * Loads Models and Views
 */
class Controller {
    //Load Model
    public function model($model){
        //Require model file
        require_once '../app/models/' . $model . '.php';

        //Instantiate model
        return new $model();
    }
    //Load view
    public function view($view, $data= []){
        //Require View file
       if(file_exists('../app/views/' . $view . '.php')){
           require_once '../app/views/' . $view . '.php';
       } else {
           die('View does not exist');
       }
    }
} 