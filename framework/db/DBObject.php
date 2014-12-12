<?php 
namespace framework\db;

class DBObject extends DBConnection { 
    
    private $table; 
    protected static $PDO;
    
    public function __construct($array) {
        $this->table = $array['table'];
       
        $this->getColumns($this->table);
     
    }


    public function __call($name,$arg){
        //Create a new active query  object if method_name is inaccesibile (this will create and execute a query when calling one() where() all() etc..)
       
        return new ActiveQuery(['table' => $this->table]);
        
    }
    
   
  
  
    
   
}

?>