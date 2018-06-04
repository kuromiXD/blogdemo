<?php
namespace console\controllers;
use yii\console\Controller;


class HelloController extends Controller
{
    public $rev;

    public function options($rev){
        return ['rev'];
    }


    public function optionAliases(){
        return ['r'=>'rev'];
    }
    public function actionIndex(){
        if($this->rev==1)
            echo "Hello \n";
        else
            echo "World \n";
    }

    public function actionWho($name){
        echo "Hello ".$name."\n";
    }

    
    
    
}