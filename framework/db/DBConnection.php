<?php 
namespace framework\db; 

use framework\base\Base;
use framework\base\Exception;
use framework\helpers\php\ArrayManipulation;

class DBConnection {
   private $config;
   
   protected  $PDO;
    
     public function  connect() {
         if($this->PDO == null){
             $this->config = Base::$config; 
             try {
                 $memcache = Base::$memcache; 
                $this->PDO = new \PDO($this->config['app']['db']['type'].":host=".$this->config['app']['db']['host'].";dbname=".$this->config['app']['db']['name'],$this->config['app']['db']['user'],$this->config['app']['db']['pass']); 
                $this->PDO->setAttribute(\PDO::ATTR_EMULATE_PREPARES, 0);
                $this->PDO->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

             }  catch (PDOException $e){
                 echo $e->getMessage();
             }
            
        }
         
    }
    
    public function getColumns($table){
        $this->connect();
        try {
        $query = "show tables";
        $command = $this->PDO->prepare($query);
        
        
        //If cache schema is eanbled use memcache
        $result = $this->cacheQuery(['command'=>$command,'query'=>$query]);
        
        
       
      
        if(empty($result)){
           Exception::add(['message'=>"There are no tables in the databse"]);
        }
        
        if(!ArrayManipulation::in_array_r($table,$result)){
            Exception::add(['message'=>"There is no table $table"]);
        }else{
            
            //Get the fields value 
            $query = "show columns from $table";
            $command = $this->PDO->prepare($query);
            
            $result = $this->cacheQuery(['command'=>$command,'query'=>$query]);
            
            if(empty($result) ){
                Exception::add(['message'=>"The table $table has no fields name"]);
            }else{
                //Create an DBObject
                $name = array(); //FIeld name
                $key = array(); //Field key: ex (Primary,unique)
                foreach($result as $row){
                   $name[$row['Field']] = "";
                   $key[$row['Field']] = $row['Key'];
                   
                }
                
               
                
                return compact('name','key');
            }
            
        }

        
        }catch (PDOException $e){
            echo $e->getMessage();
        }
    }
    
    public function exec_query($input){ //Accespts $input['query'], $input['binding']
        $this->connect();
        
        try {
            if(!empty($input['query'])){ 
                
                $command = $this->PDO->prepare($input['query']); 
             
                //Bind paramas
                                     
                
                if(isset($input['binding']) && !empty($input['binding'])){
                    
                    foreach($input['binding'] as $key => $value){
                      $command->bindValue($key,$value);

                    }
                 }
                 

                
                $command->execute(); 
                  var_dump($this->PDO->errorInfo());
                $result = $command->fetchAll(\PDO::FETCH_ASSOC);
              
                return $result;
           
                
            }else{
                Exception::add(["message" => "Trying to execute empty query"]);
            }
            
        } catch (\PDOException $e) {
          
           echo $e->getMessage();
        }
    }
    
    public function cacheQuery($input = array()){
        
        $command = $input['command']; 
        $query = $input['query']; 
        
        //If cache schema is eanbled use memcache
        $memcache = Base::$memcache; 
        
        $exec_query = false;
        if($memcache != null){ 
            if($memcache->get(md5("query-$query")) && Base::$config['app']['db']['cache']['schema']){
            $result = $memcache->get(md5("query-$query"));
            }else{
                $exec_query = true;
            }
        }else{
            $exec_query = true; 
        }
        
        if($exec_query){
             $command->execute();
             $result = $command->fetchAll();
             
             //If memchace enabled
             if(Base::$config['app']['cache']['memcache']['status'] && Base::$config['app']['db']['cache']['schema']){
                 $memcache->set(md5("query-$query"),$result,0,60*60*24);
             }
        } 
        
        return $result;
    }
    
    
}

?>