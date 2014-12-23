<?php 
namespace framework\db; 

use framework\base\Exception;

class ActiveQuery   {
    
   protected     $prepare_fileds,$query,$type,$where,$join,$order,$limit,$group;
   
   
   protected  $method_in_between = array(); //If not empty this thorw a new exception 
   
   protected  $method_end = array(); // If method_in_between not empty and method_end empty thorw exception missing method_end


   protected static  $table; //Table name
   

   
   public $ready = false;
   
  
   private $fields = array(); 
   
   private $binding = array();
   

    public function __construct($array) {
        self::$table = $array['table'];
     
   
    
        
       
       
      
    }
    
    public function setFields($fields){
        $this->fields = $fields;
         $this->prepare_fields();
    }
   
   
    public function find(){
       
        $this->type = "select SQL_CACHE";
        return $this; //Return current object for chaning methods 

    }
    
   
    
    public function all(){
         $this->method_end[__METHOD__] = __METHOD__;
         
         $this->query = "{$this->type} ".$this->getSelectFields()." from ".self::$table." {$this->where} {$this->limit} {$this->order} ";
         
         
         $this->ready = true;

    }
    
     public function one() {
       $this->method_end[__METHOD__] = __METHOD__; 
       
       $this->query = "{$this->type} ".$this->getSelectFields()." from ".self::$table." {$this->where} LIMIT 0,1";
       $this->ready = true;

    }
    
 
    
    
    public function where($input = array()){
       
        $where = "";
        $this->method_in_between[__METHOD__] = __METHOD__;
       
        for ($i=0;$i < count($input);$i++){
            foreach($input[$i] as $key => $value){
               $where .= "$key = :where_$key AND "; 
               $this->binding["where_$key"] = $value;
            }
        }
        
        $this->where =  (!empty($where) ?  " where " .substr($where,0,-4) : "");
        
        
        
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
    
    public function save(){ //Save the record/ on duplicate key update the record
      
        
        $this->type = "insert";
        
        $pk = ""; //Primary key
        foreach($this->fields['name'] as $key => $value){           
            //Check to see if primary key value is set, if not then insert a new row else update
           
            if($this->fields['key'][$key] == "PRI" && !empty($value)){
                
                $this->type = "update"; //Change type 
                $pk = $value; //Set primary key
                break;
            }
            
        }
       
        if($this->type == "insert"){
            $this->insert();
           
        }elseif($this->type == "update"){
            
            $this->update($pk);
        }
 
        
    }
    
    public function insert(){
        $fields_name = $fields_values = "";
        
         foreach($this->fields['name'] as $key => $value){ 
            $fields_name .= " $key ,";
            $fields_values .= " :save_$key ,";
            $this->binding["save_$key"] = $value;
         }
         
         $fields_name = "(".substr($fields_name, 0,-2).")";
         $fields_values = "(".substr($fields_values, 0,-2).")";
         
           
        $this->query = "{$this->type} into ".self::$table." $fields_name VALUES $fields_values";
        $this->ready = true;
    }
    
    public function update($input){
         $prepare_query = "";
         if(!is_numeric($input)){
             Exception::add("The update() method argument must be a string");
         }
         
        
         foreach($this->fields['name'] as $key => $value){ 
         
             if($this->fields['key'][$key] == "PRI" && !empty($value)){
                 
                 $this->where = " where $key = :where_$key";
                 $this->binding["where_$key"] = $value;
             }else{
                    $prepare_query .= "$key = :save_$key  ,";
                    $this->binding["save_$key"] = $value;
             }
         }
         
         $prepare_query = substr($prepare_query, 0,-1);
         
         $this->query = "{$this->type} ".self::$table." set $prepare_query {$this->where}";
       
         $this->ready = true;
         
         
         
    }
    
    
    public function joinWith(){
        
    }
    
    
    
    public function prepare_fields(){
        foreach($this->fields['name'] as $key => $value){ 
            $this->prepare_fileds[] = "$key = : $key ";
        }
    }
    
    private function getSelectFields(){
        return implode(",", array_keys($this->fields['name']));
    }
    
  
        
   public function __destruct() {
       if(!empty($this->method_in_between) && empty($this->method_end)){
           
           throw new \Exception("Missing one(),all(),save(),update() at the end of line");
       }
   }
   
   public function getQuery(){
       
       return $this->query;
   }
   
   public function getBinding(){
       return $this->binding;
   }
   
   public function resetProperties(){
      $this->prepare_fileds = $this->query = $this->type = $this->where = $this->join = $this->order = $this->limit = $this->group = null;
      $this->ready = false;
      $this->binding = array();
   }
   
   
   
  
        
     
}

?>