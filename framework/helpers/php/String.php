<?php 
namespace framework\helpers\php; 

class String {
    
    public static function getFileExt($file){
        $explode_url = explode(".", $file);
        $exploded_count = count($explode_url); 
        
        if($exploded_count > 1 && !empty($explode_url[$exploded_count-1])){
            return $explode_url[$exploded_count-1]; 
        }else{
            return false; 
        }
    }
}
?>