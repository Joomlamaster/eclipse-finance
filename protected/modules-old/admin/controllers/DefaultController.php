<?php

class DefaultController extends AdminController
{

    public function actionIndex()
    { 
        $this->adminMenu = array(
            array('label' => 'Admin Operations'),
            array('label' => 'Dashboard Home', 'icon' => 'home', 'url' => array('default/index#'), 'active' => true),
        );
//     if(Yii::app()->user->checkAccess('admin')){
//     	echo "hello, I'm administrator";
// 	}
        $this->render('index');
    }

  

}