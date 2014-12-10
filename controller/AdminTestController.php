<?php
namespace controller;
use framework\base\Controller;

class AdminTestController extends Controller{
 public function actionSada(){
     echo "FUCKSA";
 }
 
 public function actionIndex(){
     echo "WASADAS";
 }
 
 public function actionLogare(){
     $this->render("logare");
 }
}
