<?php 
namespace framework\db; 

use framework\base\Base;

class DBConnection {
   private $config;
   protected static $PDO;
    
     public function  __construct() {
         if(self::$PDO == null){
             $this->config = Base::$config; 
             var_dump(__CLASS__);
             self::$PDO = new \PDO($this->config['app']['db']['type'].":host=".$this->config['app']['db']['host'].";dbname=".$this->config['app']['db']['name'],$this->config['app']['db']['user'],$this->config['app']['db']['pass']); 
        }
         
    }
}

?>