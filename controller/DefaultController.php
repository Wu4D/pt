<?php
namespace controller; 
use framework\base\Controller;
use framework\db\ActiveRecord;
use framework\helpers\php\ArrayManipulation;
ini_set("max_execution_time", 0);
ini_set('memory_limit', '-1');
class DefaultController extends Controller
{ 
    
    public function actionIndex(){
        
        
        $ar = new ActiveRecord();
//        $user = $ar->users->join->with(["post","modified"])->on(); 
        
//        $this->restrict([$_SESSION['id'],$ar->post->findOne($user->id), $ar->post->titlu => "Ceva"]);
        
        $aici = "CEVA TEXT DYNAMIC";
        

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


    
    
    
   




  
  //Insert winning numbers into the
// 
//   $loto = new \models\Loto(); 
//   
//   //Fetch loto 6/49 loteria romana, numerele castigatoare
//   $start_year = 1998; 
//   $end_year = 2014; 
//   $ar->loto->year = $start_year;
//   $totals = array();
//   for($i=$start_year;$i <= $end_year;$i++){
//       echo "$i<BR><BR>"; 
//       
//       for($i2 = 1;$i2 <= 12;$i2++){
//           $loto->an = $i; 
//           $loto->luna = $i2; 
//           $array = array_reverse($loto->fetchRO()); //Get the lottery numbers from loto.ro and reverse the order from oldest to newest
//          
//           foreach($array as $nr){
//                $serailize_nr = serialize($nr); //Serailize the wining number, if it already exists
//                
//                $loto_number = $ar->loto->find()->where(['year'=>$i,'month'=>$i2,'number'=>$serailize_nr])->one(); 
//               
//               $total = 0; 
//               $total_multiplied = 1;
//               foreach($nr as $n){
//                   $total += $n;
//                   $total_multiplied *= $n;
//               }
//               
//                if(!$loto_number){
//                    
//                    $ar->loto->number = $serailize_nr; 
//                    $ar->loto->year = $i; 
//                    $ar->loto->month = $i2;
//                    $ar->loto->sum = $total;
//                    $ar->loto->date = date('Y-m-d H:i:s');
//                    $ar->loto->type =  $loto->type;
//                    $ar->loto->multiplicated = $total_multiplied;
//                    $ar->loto->save();
//                  
//                  
//                }
//
//               $totals[] = $total;
//               //echo "NR castigatoare ".  serialize($nr)." - TOTAL: $total ---- luna $i2 <BR>";
//           }
//           echo "<BR><BR>";
//       }
//   }
  
  $gen_total = array();
  for($loop = 0;$loop < 10000;$loop++){
        unset($nr_gen);
                $nr_gen = array();

  for($i=1;$i <= 6;$i++){
      $rand_nr = mt_rand(1,49);
      while(in_array($rand_nr, $nr_gen)){
          $rand_nr = mt_rand(1, 49);
      }
      
      $nr_gen[] = $rand_nr;
  }
  $total = 0;
  $total_multiplicated = 1;
  foreach($nr_gen as $nr){
      $total += $nr; 
      $total_multiplicated *= $nr;
  }
  $gen_total[] = $total;
    print_r($nr_gen);

  }
  
  
  //Save the sum of all numbers 
  foreach($gen_total as $total){
      $ar->loto649_sum->total = $total; 
      $ar->loto649_sum->multiplicated = $total_multiplicated;
      $ar->loto649_sum->save();
  }
//  echo "<BR><BR><BR> UNIQUE: ".count(array_unique($gen_total))." <BR> ALL: ".count($gen_total);

 


  
 
 



  

        
    }
    
    public function actionVeziProduse(){
        $this->render("vezi-produse");
    }
    
    public function actionInfo(){
        $ar = new ActiveRecord(); 
        $numbers = $ar->loto->find()->where(['type'=>'1','year'=>'2010'])->limit("20")->orderBy(["id"=>"desc"])->all(); 
        
        $sum_info = array();
        $combination = array();
        foreach($numbers as $n){
            
           // echo "YEAR {$n['year']} {$n['sum']} <BR>";
            //Set sum for the current year 
                                           $combination['year'][$n['year']][] = unserialize($n['number']);

           
                           if(!isset($sum_info['year'][$n['year']][$n['sum']])){
                               $sum_info['year'][$n['year']][$n['sum']] = 1; 
                           }else{
                               $sum_info['year'][$n['year']][$n['sum']]++;
                           }

            
            
            if(isset($sum_info['all_year'][$n['sum']])){
                $sum_info['all_year'][$n['sum']] += 1;
            }else{
                $sum_info['all_year'][$n['sum']] = 1;

            }
 
        }
        
       // $years = ArrayManipulation::combinedAddition([$sum_info['year']['2012'], $sum_info['year']['2013'],$sum_info['year']['2011']]);
        $years = $sum_info['all_year']; 
                
        arsort($years);
       
        
        $i = 1;
//        foreach ($years as $year => $sum){
//                    arsort($sum);
//
//            echo "<h1>$year</h1>"; 
//            foreach($sum as $key => $value){
//            echo "<BR>$key : $value ::::: $i<BR>";
//            $i++;
//            }
//        }
        
              foreach($years as $key => $value){
            echo "<BR>$key : $value ::::: $i<BR>";
            $i++;
            }
        
        
        
        
         
        
      
        
       
    }
    
    public function actionGenerate(){
        $ar = new ActiveRecord();
       // $numbers = $ar->loto->find()->where(["type"=>'1'])->limit("70")->orderBy(["id"=>"desc"])->all();
//        print_r($numbers); 
        
        $total_numbers = 49;
        $pick = 6;
        $numbers = range(1, $total_numbers);
        $test =   array();
        $test[0] = ['0','2']; 
        $test[1] = ['1','2'];
        $test[2] = ['2','0'];
        
        $test3 = ['0']; 
        
        $test = array_unique($test, SORT_REGULAR);
        foreach($test as $key => $value){
            print_r($value);
            echo "<BR>";
        }
        
        $posible_combination = 1;
        $posible_combination_divider = 1;
        
        $loop = 1;
        //Calculate all posible combination 
        for($i = $total_numbers;$i > $total_numbers - $pick;$i--){
            $posible_combination *= $i; 

            $posible_combination_divider *= $loop;
            $loop++;

        }
        
        $posible_combinations = ($posible_combination / $posible_combination_divider);
        $all_combination = array(); 
        $skip_numbers = array();
    
            
        $loto = new \models\Loto();
        echo "GENERATION STOPED";die();
        $loto->generateCombinations(['numbers'=>$numbers,'pick'=>$pick,'posible_combinations'=> $posible_combinations]);
            
           
        
      
        
    }
    
    public function actionPagina(){
        
    }
    
    public function actionPredict(){
        $ar = new ActiveRecord(); 
        $type = 1;
        $winnings = $ar->loto->find()->where(['type'=>$type])->orderBy(['id'=>'desc'])->all();
        $last_winning_nr = unserialize($winnings[0]['number']);
        
        foreach($winnings as $win){
            print_r(unserialize($win['number']));
            echo " - ".count(str_split($win['multiplicated']));
            echo "<BR>";
            
        }
        
        foreach($winnings as $win){
            $split_sum = str_split($win['sum']); 
            $total = 0;
            for($i=0;$i < count($split_sum);$i++){
                $total += $split_sum[$i];
            }
//            $total *= $split_sum[count($split_sum)-1]  ;
//                        $total *= $split_sum[count($split_sum)-1] * $split_sum[1]  ;
//            $total *= $split_sum[count($split_sum)-1] * 10; 
//            $total /= 3;
              $odd_evan= ['2','3']; 
            
              
                if(@$split_sum[2] & 1){
                  $total = $split_sum[1] + @$split_sum[2] * $odd_evan[0];
              }else{
                  $total *= $split_sum[1] + @$split_sum[2] * $odd_evan[1]; 
              }
            
            //echo $win['sum'] ." : ".round($total) ."<BR>";
        }
        $combinations649 = range(1,49);
        
        $use_numbers = array_diff($combinations649,$last_winning_nr); 
        
//        for($i = count($winnings) - 1;$i > 0;$i--){
//            
//        $reduce_numbers = array();
//        $use_numbers = array_diff($combinations649,  unserialize($winnings[$i-1]['number'])); 
////        $use_numbers = $combinations649;
//        
//        foreach (unserialize($winnings[$i-1]['number']) as $number){
//            if($number > 10){
//                $reduce_numbers[] = $number - 10;
//            }else{
//                $reduce_numbers[] = $number + 11;
//            }
//            
//           // $reduce_numbers[] = $number + 1;
//           // $reduce_numbers[] = $number - 1;
//
//
//             
//        }
//        $use_numbers = array_diff($use_numbers,$reduce_numbers);
//        //Check to see if use number has the winning combinations 
//        
//        }
        
        
        
        $dont_use_numbers = array_diff($combinations649,$use_numbers); 
        $dont_use_numbers[] = '25'; 
        $dont_use_numbers[] = '10'; 
        $dont_use_numbers[] = '44';
        $dont_use_numbers[] = '27';
        $dont_use_numbers[] = '31';
        $dont_use_numbers[] = '11';
        $dont_use_numbers[] = '6' ;
        $dont_use_numbers[] = '19';  
        $dont_use_numbers[] = '47'; 
        $dont_use_numbers[] = '9'; 
        $dont_use_numbers[] = '31'; 
        $dont_use_numbers[] = '36'; 
        $dont_use_numbers[] = '26'; 
        $dont_use_numbers[] = '48'; 
        $dont_use_numbers[] = '8';
        $dont_use_numbers[] = '2';
        $dont_use_numbers[] = '39';
        $dont_use_numbers[] = '25';
        
        $query_nr = "";
        foreach($use_numbers as $n){
            $query_nr .= " (nr1 = '$n' or nr2 = '$n' or nr3 = '$n' or nr4 = '$n' or nr5 = '$n' or nr6 = '$n') or";
        }
        $query_nr = "".substr($query_nr, 0,-2)."";
        
        $query_not_nr = "";
        foreach($dont_use_numbers as $n){
            $query_not_nr .= "'$n',";
        }
        
        $query_not_nr = "".substr($query_not_nr, 0,-1)."";
        $query_not_nr = " nr1 NOT IN ($query_not_nr) and nr2 NOT IN ($query_not_nr) and nr3 NOT IN ($query_not_nr) and nr3 NOT IN($query_not_nr) and nr4 NOT IN($query_not_nr) and nr5 NOT IN($query_not_nr) and nr6 NOT IN($query_not_nr)";
   
        
        //Remove sum total 
        $sum_not_in = [($winnings[0]['sum'] - 1),($winnings[0]['sum'] + 1)];
        
        $freq = 9; //The frequency of numbers in ever $frequ
        $frequ_counter = 0;
        $track = 0;
        $frequ_array = array();
        $field = 'sum';
        
        foreach($winnings as $win){
            if(isset($frequ_array[$frequ_counter][$win[$field]]) ){
                $frequ_array[$frequ_counter][$win[$field]]++;
            }else{
                $frequ_array[$frequ_counter][$win[$field]] = 1;
            }                        $track++; 

            if($track == $freq){
                $frequ_counter++; 
                $track = 0;
            }

            
        
        }
        foreach($frequ_array as $key => $all_freq){
            echo "<h1>$key</h1>";
            foreach($all_freq as $s_key => $single_freq){
                
                echo "$s_key : $single_freq <BR>";
            }
            
        }
            
        //Remove combinations based on nmbers
        for($i =1;$i < 9;$i++){
            $sum_not_in[]  = $winnings[$i]['sum'];
        }
        
        
        $query_sum = " sum NOT IN(";
        foreach ($sum_not_in as $s){
            $query_sum .= "'$s',";
        }
        $query_sum = substr($query_sum, 0,-1).")";
        
       //Remove combinations based on multipled
        $multiplied_not_in = array();
        for($i =1;$i < 99;$i++){
            $multiplied_not_in[]  = $winnings[$i]['multiplicated'];
        }
        
        
        $query_multiplied = " multiplied NOT IN(";
        foreach ($multiplied_not_in as $s){
            $query_multiplied .= "'$s',";
        }
        $query_multiplied = substr($query_multiplied, 0,-1).")";
        

        echo         $total_combinations = "select count(*) from combinations649 where ($query_not_nr) and (sum = '148') and ($query_multiplied ";

//      $combinations = $ar->combinations649->sql("select id,nr1,nr2,nr3,nr4,nr5,nr6,sum,multiplied from combinations649 where $query ");
        $total_combinations = ($combinations = $ar->combinations649->sql("select count(*) from combinations649 where ($query_not_nr) and (sum = '148') and ($query_multiplied) "));
        var_dump($total_combinations);die();
        $combinations_per_page = 10000; 
        $pages = ceil($total_combinations['count(*)'] / $combinations_per_page);
        echo "PAGES: $pages <BR>";
        $combinations_counter = 0;
        for($i=0;$pages;$i++){
            $combinations = $ar->combinations649->sql("select id,nr1,nr2,nr3,nr4,nr5,nr6,sum,multiplied from combinations649 where ($query_nr) and (sum >= 100 and sum < 200) and ($query_sum) limit ".($i*$combinations_per_page).", $combinations_per_page");
            foreach($combinations as $combination){
                $combinations_counter++;
            }

        }
        
        echo "<BR>COMBINATIONS: $combinations_counter<BR>";
        
        
        
        
      
                
    }
    
}

?>