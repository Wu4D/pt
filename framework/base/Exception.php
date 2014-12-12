<?php 
namespace framework\base; 

class Exception {
    
    private $message;
    
    public static function add($array){
        throw new \Exception($array['message']);
    }
    
    
}

?>