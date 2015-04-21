<?php
class DefaultController extends AdminController
{

    public function actionIndex()
    { 
    	 $adminUserID = $_SESSION['admin_validate'];

    	if($adminUserID ==true){
   	$this->adminMenu = array(
            array('label' => 'Admin Operations'),
            array('label' => 'Dashboard Home', 'icon' => 'home', 'url' => array('default/index'), 'active' => true),
        );
        $this->render('index');
	}else{
	$this->redirect('http://eclipse-finance.com/admin/permission/Login');
	}
    }
}