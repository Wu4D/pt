<?php 
namespace framework\db; 


class ActiveRecord {
    
   private  $dbORM = array();
 

   

   public  function __get($table){
        //If database object dosen't exist create a new one   
        if(!isset($this->dbORM[$table])){
          $this->dbORM[$table] = new DBObject(compact('table'));  //Create a new object using the table name     
        }
        
        return $this->dbORM[$table];
   }
   
 
 
 
}



?>