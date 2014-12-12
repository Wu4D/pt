<?php 
define('LOOP',1000000);
 
class ClassA {
  public function normal() {
  }
 
  public function __get($name) {
  }
}
function f1() {
  $a = new ClassA();
  for($i=0; $i<LOOP; ++$i) {
    $a->normal();
  }
}
 
function f2() {
  $a = new ClassA();
  for($i=0; $i<LOOP; ++$i) {
    $a->magic;  
  }
}
 
$start = microtime(true);
f1();
$stop = microtime(true);
$time1 = $stop - $start;
 
$start = microtime(true);
f2();
$stop = microtime(true);
$time2 = $stop - $start;
 
echo $time1 . "\t";
echo $time2 . "\n";
?>