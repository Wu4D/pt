<?php 
namespace framework\db; 

class dbORM extends ActiveRecord {
    protected static $table;
    
    public function __construct($input) {
        self::$table = $input["table"];
        
        }
        
         public function __call($name,$arg) {
        var_dump(__METHOD__);
        echo "SSADASA";
        die();
      
    }
        
     
}

?>