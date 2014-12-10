<?php
namespace controller;
use framework\base\Controller;

class AdminController extends Controller{
 public function actionDelete(){
     echo "delete";
 }
 
 public function actionIndex(){
     echo "ADMIN INDEX";
 }
 
 public function actionLogare(){
     $this->render("logare");
 }
}
