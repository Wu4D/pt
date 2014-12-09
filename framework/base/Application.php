<?php
namespace framework\base;

class Application {
    
    public function __construct() {
        
    }
    
    public function run(){
        //R is the get parrameter
        $this->route("r"); //Route the request to the proper controler 
        
           
    }
    
    public function route($_get_param){
        $route = (isset($_GET[$_get_param]) ? $_GET[$_get_param]: "");
        
        //If route is empty route to default controler 
        if(empty($route)){
           $controller = new \controller\DefaultController();
           echo "HERERE";
        }
    }
    
    public function get(){
        
    }
    
    public function post(){
        
    }
    
   
    
}

?>