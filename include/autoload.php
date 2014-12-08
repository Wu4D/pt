<?php

function autoload($class){
   $namespace_to_path = str_replace("\\","/",$class);
   $construct_path =  dirname(__DIR__)."/".$namespace_to_path.".php";
   require_once($construct_path);
}

spl_autoload_register('autoload');
