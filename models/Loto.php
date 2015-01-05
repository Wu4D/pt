<?php 

namespace models; 

use framework\db\ActiveRecord;

class Loto {
    
      public $an = 2014;
      public $luna = 12;
      public  $type = "1";
      private $number_pair = array();


      public function fetchRO(){
          $file = file_get_contents("http://loto.ro/php/arh_649.php?an=".$this->an."&luna=".$this->luna."&joaca=".$this->type."");
          
  $an = 2014; 
  $luna = 12; 
  
  $matches = array();
  $number_len = 6;
  preg_match_all("/id=\"numbers-castig\">[0-9]{1,2}/", $file,$matches);
  
  $numbers = "";
  
  $reset = 1;
  $tickets = 1;
  $winning_tickets = array();
  $matches =  $matches[0];
  for($i =0;$i < count($matches);$i++){
      
      $winning_tickets[$tickets][] = str_replace('id="numbers-castig">',"",$matches[$i]); 
      if($reset == 6){
          echo "REACHED<BR>";
          $reset = 0;
          $tickets++;
      }
      
      $reset++; 
  }
    
    return $winning_tickets;
    
    }
    
    
    public function generateCombinations($input){
        
         $pick = $input['pick'];
        $numbers = $input['numbers']; 
        $posible_combinations = $input['posible_combinations'];
        $combinations = array();
        $track_numbers = array();
        $batch = 10000;
        $com_nr = 0;
        $com_nr_pair_active = 0;
        
        //Db stuff for inserting all combinations 
        $con = mysqli_connect("localhost", "root", "", "ptframework")or die(mysqli_error());
         $query = "";
 
        //Config for generate only paris of 3 2 maximum 
         //Ex 1 2 3 11 12 22 not 1 2 3 11 12 13 
         $generate_3_2_pair = true;
         
        for($i= count($numbers) - 1;$i >= 0;$i--){ 
            $number[1] = $numbers[$i];
          
            for($i2 = $i - 1;$i2 >= 0;$i2--){
                $number[2] = $numbers[$i2];

             
                
                 for($i3 = $i2 - 1;$i3 >= 0 ;$i3--){
                   $number[3] = $numbers[$i3];
                                 //$number = $number1. " - $number2 ".$numbers[$i3]." ";
                                             //echo $number;                echo "<BR><BR>";
                        
                     for($i4 = $i3 - 1;$i4 >= 0;$i4--){
                         
                         $number[4] = $numbers[$i4]; 
                        for($i5 = $i4 - 1;$i5 >= 0;$i5--){
                            $number[5] = $numbers[$i5]; 
                            for($i6 = $i5 - 1;$i6 >= 0;$i6--){
                                $number[6] = $numbers[$i6];
                                $com_nr++;
                                  
                                $insert = true ;
                                if($generate_3_2_pair){

                                 if($this->isConsecutive([$number[1],$number[2],$number[3],$number[4],$number[5],$number[6]])){
                                     $insert = false;
                                 }
                                 if($this->isPair([$number[1],$number[2],$number[3],$number[4],$number[5],$number[6]])){
                                     $insert = false;
                                 }
                                 
                                }
                                
                                if($insert){
                                                                         $com_nr_pair_active++;

                                      $picked_numbers =  " '$number[1]','$number[2]','$number[3]','$number[4]','$number[5]','{$number[6]}'";
                                      $total_multiplied = $number[1] * $number[2] * $number[3] * $number[4] * $number[5] * $number[6];
                                      $total = $number[1] + $number[2] + $number[3] + $number[4] + $number[5] + $number[6];
                                      
                                      $query .= "( ".$picked_numbers; 
                                      $query .= ", '$total', '$total_multiplied' ),";
                                      
                                      $combinations[] = "";
                                      
                                }
                                    

                                
                                
                                 if(count($combinations) == $batch || $com_nr == $posible_combinations){
                                    $query = "insert into combinations649 (nr1,nr2,nr3,nr4,nr5,nr6,sum,multiplied) VALUES ".substr($query,0,-1); 
                                    $con->query($query) or die(mysqli_error($con));
                                    $query = "";
                                    
                                    unset($combinations);
                                    $combinations = array();
                                }
                                

                            }
                            
                        }
                     }
                 }
            }
            
        }
        echo "GENERATED COMBINATIONS NR: $com_nr <BR> GENERATED ACTIVE PAIR COMBINATIONS NR : $com_nr_pair_active <BR>";
        
    }
    
    
    public function isConsecutive($numbers){
            arsort($numbers);
            $numbers = array_values($numbers);
            for($i =0;$i < count($numbers);$i++){
                if(isset($numbers[$i+1])){
                    if($numbers[$i] - $numbers[$i+1] == 1){
                        return true;
                    }
                }
            }
            return false;
            
    }
    
    public function isPair($numbers,$pair_numbers = 3){
        //Return true if pair of tree numbers belong in the same range ex 1-9 10-19 20-29 
        $track_repeat = array(); 
        foreach($numbers as $number){ 
            
            if($this->numberBetween($number, 1, 9)){
                $track_repeat[1] = (isset($track_repeat[1]) ? ($track_repeat[1]+1) : 1);
            }
            
             if($this->numberBetween($number, 10, 19)){
                $track_repeat[2] = (isset($track_repeat[2]) ? ($track_repeat[2]+1) : 1);
            }
            
             if($this->numberBetween($number, 20, 29)){
                $track_repeat[3] = (isset($track_repeat[3]) ? ($track_repeat[3]+1) : 1);
            }
            
             if($this->numberBetween($number, 30, 39)){
                $track_repeat[4] = (isset($track_repeat[4]) ? ($track_repeat[4]+1) : 1);
            }
            
             if($this->numberBetween($number, 40, 49)){
                $track_repeat[5] = (isset($track_repeat[5]) ? ($track_repeat[5]+1) : 1);
            }
            
        }
        

        
        $track_times = 0;
        foreach($track_repeat as $value){
            if($value == $pair_numbers){
                $track_times++; 
            }elseif($value > $pair_numbers ){
                unset($track_repeat);
                return true;
            }
            
        }
        
        if($track_times >= 2 || $track_times == 1 && count($track_repeat) == 1 ){
            //Unset the array 
            unset($track_repeat);
            return true; //If is pair of $pair_numbers return true
        }
        return false;
        
    }
    
    public function numberBetween($number,$first_nr,$last_nr){
        if($number >= $first_nr && $number <= $last_nr){
            return true;
        }
        return false;
        
    }
    
    public function generateCombinations2($input){
                $ar = new ActiveRecord(); 

        $posible_combinations = $input['posible_combinations'];
        $pick = $input['pick'];
        $numbers = $input['numbers']; 
        $combinations = array();
        $combinations_sql = array();
        $con = mysqli_connect("localhost", "root", "", "ptframework")or die(mysqli_error());
        
        $total_combinations = 0;
        $insert_every = 10000;
        $query = "";
        while($total_combinations < $posible_combinations){
            shuffle($numbers);
            array_values($numbers);
            
            $picked_numbers = "";
            $number = array(); 
            $total = 0;
            $once = 0;
            $total_multiplied = 1;
            for($i =0;$i < $pick;$i++){
                $picked_numbers .= "'".$numbers[$i]."'".",";
                //echo $numbers[$i]." * ";
                $number[] = $numbers[$i];
                $total_multiplied *= $numbers[$i];
                $total += $numbers[$i];
            }
            //echo $picked_numbers. " - $total <BR>";
            
            //Check if the same combination exists but in different order
            $add = true;
            
            //Check to see if the same combination has alredy been generated
            if(isset($combinations[$total_multiplied])){
            
             //Check to see if there are multiple combinations for the same (nr1*nr2*..)
//            if(is_array($combinations[$total_multiplied][0])){
//                //Loop trough 2 or more combinations
//            foreach($combinations[$total_multiplied] as $combinations_array){
//
//               if(count(array_diff($combinations_array, $number)) ==  0 ){ //Check for duplicated combination
//                   $add = false;
//
//
//               }
//            }
//            }else{
//              
//                if(count(array_diff($combinations[$total_multiplied], $number)) ==  0 ){ //Check for duplicated combination
//                   $add = false;
//                   
//               }
//            }
//            }
            
            if($add){
                
                if($pick == 6){ //If 6 out of 49 
                    
//                $ar->combinations649->multiplied = $total_multiplied; 
//                $ar->combinations649->sum = $total; 
//                $ar->combinations649->nr1 = $number[0]; 
//                $ar->combinations649->nr2 = $number[1]; 
//                $ar->combinations649->nr3 = $number[2]; 
//                $ar->combinations649->nr4 = $number[3]; 
//                $ar->combinations649->nr5 = $number[4]; 
//                $ar->combinations649->nr6 = $number[5]; 
//                $ar->combinations649->save();


                }
                
                $combinations_sql[] = '';
                $combinations[$total_multiplied][] = $number;
                
                $query .= "( ".substr($picked_numbers,0,-1).""; 
                $query .= ", '$total', '$total_multiplied' ),";
                
                if(count($combinations_sql) >= $insert_every){
                    $query = substr($query,0,-1);
                    $query = "insert into combinations649 (nr1,nr2,nr3,nr4,nr5,nr6,sum,multiplied) VALUES ".$query; 
                    //$con->query($query) or die(mysqli_error($con));
                    //echo $query;
                    echo "AICI <BR><BR>";
                    if($once == 10){
                        die();
                    }
                    $once++;
                    
                   
                $query = "";
                $combinations_sql = array();

                }
               $total_combinations++;         //   echo $total_combinations ."<BR>";
               
               



            }
            
        } 
        
        echo "TOTAL Combinations: $total_combinations - Possible Combinations: $posible_combinations";
        
        
        

    
                
    }
    
   
}

}




?>




