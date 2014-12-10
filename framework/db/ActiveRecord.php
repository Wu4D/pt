<?php 
namespace framework\db; 

class ActiveRecord extends DBConnection {
    
    private static $db_objs = array();
    
  
    
    public  function __get($name){
        //If database object dosen't exist create a new one 
        var_dump(self::$db_objs);
        if(empty(self::$db_objs[$name])){
            self::$db_objs[$name] = new ActiveRecordModel();

        }
        
        return $this->models[$name];
       
    }
    
    public function some_method(){
    }
    
    
}



?>