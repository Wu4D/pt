<?php 
namespace framework\db; 

use framework\base\Application;

class DBConnection {
   // private $config = array();
    public function __construct() {
        
        
//        var_dump(Application::app());
        $pdo = new \PDO($this->config['db']['type'].":host=".$this->config['db']['host'].";dbname=".$this->config['db']['name'],$this->config['db']['user'],$this->config['db']['pass']); 
         
         
    }
}

?>