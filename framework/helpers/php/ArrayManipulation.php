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
}