<?php
namespace framework\base;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use framework\helpers\php\String;
class Controller {
    
    public function render($file,$pass_array = array()){
       //Check if file exitsts 
       $reflection_class = new \ReflectionClass(get_called_class());
       
       $file .= String::getFileExt($file) == false ? ".php" : "";
       
        $get_called_class_name = str_replace("Controller","",$reflection_class->getShortName());
        if(!preg_match("/default/i", $get_called_class_name)){
            $search_in_dir_explode = array_filter(preg_split("/(?=[A-Z])/", $get_called_class_name));
            $search_in_dir = implode("/", $search_in_dir_explode);
            $file = $search_in_dir."/".$file;
           
        }
   
        $file_path = getcwd()."/views/".$file;
        if(file_exists($file_path)){
            require_once $file_path;
        }else{
            throw new \Exception("View file $file_path does not exists");
        }
    }
    
    
    
}
