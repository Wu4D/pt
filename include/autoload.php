<?php

function autoload($class){
   
    
   $namespace_to_path = str_replace("\\","/",$class); 
   
   if($namespace_to_path == $class){
       //If the class has no folders 
         $construct_path =  dirname(__DIR__)."/".$namespace_to_path."/".$namespace_to_path.".php";
   }else{
          $construct_path =  dirname(__DIR__)."/".$namespace_to_path.".php";

   }
   require_once($construct_path);
 
}

spl_autoload_register('autoload');
