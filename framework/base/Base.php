<?php 
namespace framework\base; 

class Base {
    
    public static $config;
    private static $instace = null; 
    public  static $memcache;
    
       public function __construct() {
            require_once 'config.php';
            self::$config = $config;
              if (class_exists("Memcache") && self::$config['app']['cache']['memcache']['status']) {

                    if (self::$memcache == null) {
                         self::$memcache = new \Memcache();
                         self::$memcache->connect("127.0.0.1",11211); # You might need to set "localhost" to "127.0.0.1"

                    }
                }
                
    }
    
}

?>