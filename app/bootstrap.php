<?php
//load the config file
require_once 'config/config.php';

//Setup Autoloader
spl_autoload_register(function($className){
    require_once 'libraries/'. $className .'.php';
});
