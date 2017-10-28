<?php
//load the config file
require_once 'config/config.php';
//load helper functions
require_once 'helpers/url_helper.php';
require_once 'helpers/session_helper.php';

//Setup Autoloader
spl_autoload_register(function($className){
    require_once 'libraries/'. $className .'.php';
});
