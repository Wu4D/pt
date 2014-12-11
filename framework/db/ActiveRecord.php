<?php 
namespace framework\db; 


class ActiveRecord extends DBConnection{
    
   private  $dbORM = array();
   
   protected $where; 
   protected $type; //Insert,update,delete,select
   protected static $table; //Table name
   private $query;

   //Table columns 
   

   public  function __get($table){
        //If database object dosen't exist create a new one    
       
        return $this->dbORM[$table] = new dbORM(compact('table'));  //Create a new object using the table name     
    }
    
    
    public function __call($name,$arg) {
        var_dump(__METHOD__);
        echo "SSADASA";
        die();
      
    }
    
    public function one(){
        $this->query .= "ONE - ";

        return $build_query = new ActiveQuery();
        
        $select = "SELECT * from ".static::$table." where username = 'sadas'";
    
//      foreach(parent::$PDO->query($select) as $key){
//          
//      }
      
      return $this;
        
     
    }
    
    public function all(){
        $this->query .= "ALL - ";
      var_dump(debug_backtrace());
        return $this;
    }
    
    public function where(){
                $this->query .= "WHERE - ";

    }
    
    public function delete(){
                $this->query .= "DELETE - ";

    }
    
    public function save(){
        
    }
    
    public function __destruct() {
       
    }
    

    
}



?>