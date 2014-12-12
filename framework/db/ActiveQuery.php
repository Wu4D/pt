<?php 
namespace framework\db; 

class ActiveQuery   {
    
   protected $where,$join,$order,$limit,$group;
   
   protected $type; //Insert,update,delete,select
   
   protected  $method_in_between = array(); //If not empty this thorw a new exception 
   
   protected  $method_end = array(); // If method_in_between not empty and method_end empty thorw exception missing method_end


   protected static $table; //Table name
   
   private $query;
  

   

    public function __construct($array) {
        self::$table = $array['table'];
    }
   
   
    public function get(){
        $this->type = "select";
        return $this; //Return current object for chaning methods 

    }
    
   
    
    public function all(){
         $this->method_end[__METHOD__] = __METHOD__;
         
         return $this->exec(); //Execute the query;

    }
    
     public function one() {
       $this->exec(); //Execute the query;

       $this->method_end[__METHOD__] = __METHOD__; 
    }
    
 
    
    
    public function where(){
        $this->query .= "WHERE - ";
        
        $this->method_in_between[__METHOD__] = __METHOD__;
        
        return $this; //Return current object for chaning methods 
    }
    
    public function join(){
      $this->method_in_between[__METHOD__] = __METHOD__;
      
      return $this; //Return current object for chaning methods 


    }
    
    public function limit(){
       $this->method_in_between[__METHOD__] = __METHOD__;
       
       return $this; //Return current object for chaning methods 

    }
    
    public function order(){
       $this->method_in_between[__METHOD__] = __METHOD__;
       
       return $this; //Return current object for chaning methods 

    }
    
    public function delete(){
      $this->query .= "DELETE - ";

    }
    
    public function save(){
        
        
    }
    
  
        
   public function __destruct() {
   
       if(!empty($this->method_in_between) && empty($this->method_end)){
           
           throw new \Exception("Missing one(),all(),save(),update() at the end of line");
       }
   }
   
    public function exec(){
         return "ASASA"; //Create a ORM object
    }
   
        
     
}

?>