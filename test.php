<?php 

class A {
   protected static $var; 
   
   public function __construct() {
       self::$var = "2";
   }
   
}

class B extends A {
    public function do_some(){
        var_dump(parent::$var);
    }
}

$b = new B();
$b->do_some();
?>