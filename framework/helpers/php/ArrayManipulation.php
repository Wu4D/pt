<?php

namespace framework\helpers\php;

class ArrayManipulation {
    
    public static function in_array_r($needle,array $haystack){
        foreach ($haystack as $value){
            
            if(is_array($value)){
             if(self::in_array_r($needle, $value)){
                 return true;
                 
             }
            }else{
                if($value == $needle){
                    return true;
                }
            }
        }
        
        return FALSE;
    }
    
    
    //This function will return an array with a new set of keys starting from a specific number
    public static function reindexFrom($from,$array){
        $array = array_combine(range($from,count($array)), array_values($array));
        return $array;
    }
    
    
    //This function will combine the arra keys and their values 
    public static function combinedAddition($arrays){
        $new_array = array(); 
        
        foreach($arrays as $array){
            
            foreach($array as $key => $value){ 
                if(isset($new_array[$key])){
                    $new_array[$key] += $value; 
                    
                }else{
                    $new_array[$key] = $value;
                }
            }
        }
        
        return $new_array;
    }
}