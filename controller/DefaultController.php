<?php
namespace controller; 
use framework\base\Controller;
use framework\db\ActiveRecord;
ini_set("max_execution_time", 0);
class DefaultController extends Controller
{ 
    
    public function actionIndex(){
        
        
        $ar = new ActiveRecord();
//        $user = $ar->users->join->with(["post","modified"])->on(); 
        
//        $this->restrict([$_SESSION['id'],$ar->post->findOne($user->id), $ar->post->titlu => "Ceva"]);
        
        $aici = "CEVA TEXT DYNAMIC";
        $this->render("index",  compact("aici"));
        
    }
    
    public function actionVeziProduse(){
        $this->render("vezi-produse");
    }
    
    public function actionTest(){
       
    }
    
    public function actionPagina(){
        
    }
    
}

?>