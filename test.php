<?php 
define('LOOP',1000000);
 
class ClassA {
  public function normal() {
  }
}
 
// 
//}
//
// 
//	 
//	  $memcache = new Memcache;
//	  $memcache->connect("localhost",11211); # You might need to set "localhost" to "127.0.0.1"
//	  echo "Server's version: " . $memcache->getVersion() . "<br />\n";
//	  $tmp_object = new stdClass;
//	  $tmp_object->str_attr = "test";
//	  $tmp_object->int_attr = 123;
//	  $memcache->set("key",$tmp_object,false,10);
//	  echo "Store data in the cache (data will expire in 10 seconds)<br />\n";
//	  echo "Data from the cache:<br />\n";
//	  var_dump($memcache->get("key"));
//	 
//	
//
//echo phpinfo();
//
  
 $starting_year = "1998"; 
 $end_year = "2014";  
 $type =  "6/49"; 
  

$array[] = explode("\n", "12
	
34
	
17
	
16
	
20
	
15");

$array[] = explode("\n","23
	
22
	
36
	
6
	
20
	
33");


$nr_start = array();


function predict($array_predict){
   asort($array_predict); 
   
   $reset = false;
   $exclude = array();
   for($i =0;$i < count($array_predict);$i++){
       
       $nr_start = array();
       
       for($nr_loop=0;$nr_loop < count($array_predict[$i]) - 1;$nr_loop++){
           $exclude[] = $array_predict[$i][$nr_loop];
       }
       
   }
   
  for($i=1;$i < 49;$i++){
      if(!in_array($i, $exclude)){
          echo "$i, ";
      }
  }
   
}


    
    
    
   



  $file = file_get_contents("http://loto.ro/php/arh_649.php?an=2014&luna=12&joaca=1");
  echo $file;
  $matches = array();
  $number_len = 6;
  preg_match_all("/id=\"numbers-castig\">[0-9]{1,2}/", $file,$matches);
  
  $winning_numbers = array();
  $rest = 0;
  $numbers = "";



 
 



  
?>