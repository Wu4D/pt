<?php
namespace controller; 
use framework\base\Controller;
use framework\db\ActiveRecord;

class DefaultController extends Controller
{ 
    
    public function actionIndex(){
        $fructe = ['portocala','banana','lamaie'];
        $ar = new ActiveRecord();
        $ar->user->some_method();
        $this->render("index", compact('fructe'));
    }
    
    public function actionVeziProduse(){
        $this->render("vezi-produse");
    }
    
    public function actionTest(){
        echo "TEST FILE";
    }
    
}

?>