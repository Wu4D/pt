<?php 
namespace framework\base; 

class Base {
    
    public static $config;
    private static $instace = null; 
    
       public function __construct() {
            require_once 'config.php';
            self::$config = $config;
    }
    
}

?>