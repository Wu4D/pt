<?php 
namespace framework\db; 

use framework\base\Base;
use framework\base\Exception;

class DBConnection {
   private $config;
   
   protected static $PDO;
    
     public function  connect() {
         if(static::$PDO == null){
             $this->config = Base::$config; 
             try {
                static::$PDO = new \PDO($this->config['app']['db']['type'].":host=".$this->config['app']['db']['host'].";dbname=".$this->config['app']['db']['name'],$this->config['app']['db']['user'],$this->config['app']['db']['pass']); 
             }  catch (PDOException $e){
                 echo $e->getMessage();
             }
            
        }
         
    }
    
    public function getColumns($table){
      
        $this->connect();
        try {
        $command = static::$PDO->prepare("SHOW COLUMNS FROM :table");
        $command->bindParam(':table',$table);
        $command->execute();
        $result = $command->fetchAll();
        
        if(empty($result)){
           Exception::add(['message'=>"Table $table does not exists, you can link tables in the config.php file"]);
        }
        
        var_dump($result);
        
        
         foreach($result as $row)
        {
             var_dump($row);
        }

        
        }catch (PDOException $e){
            echo $e->getMessage();
        }
        
        
        
    }
}

?>