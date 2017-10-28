<?php
    //Simple function to redirect
    function redirect($page){
        header('location: ' . URLROOT . '/'. $page);
    }