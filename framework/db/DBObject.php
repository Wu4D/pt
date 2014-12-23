<?php 
namespace framework\db;

use framework\base\Exception;

class DBObject extends DBConnection { 
    
    private $table; 
    public $fields = array();
    private $fields_key = array();
    
    private $rows = 0;
    
    
    private $activeQueryObj = null;
    
    public function __construct($array) {
        
        $this->table = $array['table'];
       
        $fields_info = $this->getColumns($this->table);
        $this->fields['name'] = $fields_info['name']; 
        $this->fields['key'] = $fields_info['key']; //Primry key,unique
        
     
    }


    public function __call($name,$args){
     
        //Create a new active query  object if method_name is inaccesibile (this will create and execute a query when calling one() where() all() etc..)
        if($this->activeQueryObj == null){
          
            $this->activeQueryObj =  new ActiveQuery(['table' => $this->table]);
            
        }
       $this->activeQueryObj->setFields($this->fields); //Update fields propety in ActiveQuery
       $this->activeQueryObj->$name($args); //Object or string if is_string the query has been build \
       
       //Check to see if query is ready 
   
       if($this->activeQueryObj->ready){
          
          
            $query = $this->activeQueryObj->getQuery(); //Get the builded query
            if(!empty($query)){
               $result = $this->exec_query(['query' => $query, 'binding'=>  $this->activeQueryObj->getBinding()]); //Execute the query
               
               //Rest the ActiveQuery Ojbt propieties
               $this->activeQueryObj->resetProperties();
               
               $this->rows = count($result);  //Set number of rows 
               
               if($this->rows > 0){ 
                   
                   if($this->rows > 1){
                       $this->fields['name'] = array(); //Remove the pervious empty fields
                   }
                   for($i=0;$i < $this->rows; $i++){
                           foreach($result[$i] as $key => $value){ 
                           
                               if($this->rows == 1){
                                   $this->fields['name'][$key] = $value;
                               }elseif ($this->rows > 1){
                                   //Remove the empty propieties
                                   
                                   $this->fields['name'][$i][$key] = $value;
                               }
                      
                             }
                   }
                   
                
                 return $this->fields['name'];  
               }else{ 
                   return FALSE; //No rows matched
               }
               
               
              
               
            }
       }else{
           return $this;
           
       }
   
    }
    
    public function __get($name){
        if(isset($this->fields['name'][$name])){
           
            return $this->fields['name'][$name];
        }
    }
    
    public function __set($name,$var){
        if(isset($this->fields['name'][$name])){
            $this->fields['name'][$name] = $var; 
        }else{
            Exception::add(['message' => "No field named '$name' in ".$this->table]);
        }
    }
    
    public function getRows(){
        return $this->rows;
    }
    

    
  
    
   
  
  
    
   
}

?>