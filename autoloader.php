<?php

spl_autoload_register(function($type){
    if(file_exists("core/$type.php")){
        require_once("core/$type.php");
    }
});