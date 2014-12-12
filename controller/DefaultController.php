<?php
namespace controller; 
use framework\base\Controller;
use framework\db\ActiveRecord;

class DefaultController extends Controller
{ 
    
    public function actionIndex(){
   
        
        $ar = new ActiveRecord();
  
        $ar->users->get()->where(['id'=>'id'])->all();
        
  
               
         
    
         
        $this->render("index", compact('fructe'));
    }
    
    public function actionVeziProduse(){
        $this->render("vezi-produse");
    }
    
    public function actionTest(){
       
    }
    
}

?>