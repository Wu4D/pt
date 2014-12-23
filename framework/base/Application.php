<?php
namespace framework\base;
use controller\DefaultController;


class Application extends Base {

  
    
    public function run(){
        //R is the get parrameter
        $this->route("r"); //Route the request to the proper controler 
      
        
           
    }
    
    public function route($_get_param){
        
        $route = (isset($_GET[$_get_param]) ? $_GET[$_get_param]: "");
       
        $method_hook = Base::$config['app']['controller']['method_hook'];
        
        //If route is empty route to default controler 
        if(empty($route)){
           $controller = new DefaultController();
           $method_index = $method_hook."Index"; 
           $controller->$method_index();
        }else{
            //Check to see if the action hook exists 
           //Check to see if the user called a folder 
                
                //Get Folders 
                $parse_folders = explode("/", $route); 
                $parse_folders_count = count($parse_folders);
                
                 
                
                //Set method name  
                $method_name = (!empty($parse_folders[$parse_folders_count-1]) && $parse_folders_count > 1 ? $parse_folders[$parse_folders_count-1] : "Index");
                $method_name = parent::$config['app']['controller']['method_hook'].$method_name; 
                
                unset($parse_folders[$parse_folders_count-1]); 
                $parse_folders = array_map('ucfirst',$parse_folders);
                
                //Set Controller Class along with the controler Name 
                $controler_name = ($parse_folders_count > 1 ? implode("", $parse_folders) : ucfirst($route))."Controller"; //Determine if it should call method or controler->methodIndex
                
               
                $controler_file = getcwd()."/".parent::$config['app']['controller']['path'].$controler_name.".php";
                
                if(file_exists($controler_file)){
                     
                $controller_namespace = str_replace("/","\\",parent::$config['app']['controller']['path']);
                $controller_class = $controller_namespace.$controler_name;
                $controller = new $controller_class(); 
               
                }else{
                   //Check if the DefaultControler has a method name route
                   $controller = new DefaultController();
                   $method_name = $method_hook.str_replace("-","",$route);
                   if(!method_exists($controller, $method_name)){
                        throw new \Exception("No method name $method_name");
                   }else{
                       $controller->$method_name();
                       return; //End the execution
                   }
                }
               
            
                
                if(!method_exists($controller, $method_name)){
                     throw new \Exception("No method name $method_name in $controler_file");
                }else{
              
                
                     $controller->$method_name();
                 }
        }
        
        
    }
    
    public function get(){
        
    }
    
    public function post(){
        
    }
    
    public static function app(){
        return parent::$config;
    }
    
   
    
}

?>