<?php
class PermissionController extends AdminController
{
   public $message;
   public $error_message;

   public function init(){
      
	
   }

    function actionLogin()
	{	
		
		$model=new LoginForm;
		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		
		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$connection=Yii::app()->db;
			$model->attributes=$_POST['LoginForm'];
			$sql="SELECT * FROM `site_secret_key` where `id`=1";
			$keys=$connection->createCommand($sql)->queryAll();
			foreach($keys as $value)
			{
			 $key = $value[secret_key];
			 $admin_key = $value[admin_key];
			}
			$pass = $model->attributes['password'];
			$newPass = md5($key.$pass);
			if($newPass == $admin_key)
			{
			$_SESSION['admin_validate'] = true;
			$this->redirect('http://eclipse-finance.com/admin/');
			}else{
			 $this->message = 'Incorrect password.';
			}
			
		}
		
		// display the login form
		$this->pageTitle = 'Login'; 
		$this->render('login',array('model'=>$model));		
	}
	 function actionChangepassword()
	{	
		 $adminUserID = $_SESSION['admin_validate'];
	    	if($adminUserID ==true){
		    	$model=new changepasswordForm;
			$model->attributes=$_POST['changepasswordForm'];
			
			$connection=Yii::app()->db;
			$sql="SELECT * FROM `site_secret_key` where id=1";
			$sites=$connection->createCommand($sql)->queryAll();
			foreach($sites as $value)
			{
			 $key = $value[secret_key];
			 $admin_key = $value[admin_key];
			}
			$admin = md5($key.$model->attributes[oldpassword]);
			$newpassword = md5($key.$model->attributes[newpassword]);
			$cpassword = md5($key.$model->attributes[cpassword]);
			if($newpassword == $cpassword){
				if($admin_key ==$admin)
				{
				  $sql_new = "UPDATE `site_secret_key` SET admin_key='".$newpassword."' WHERE id=1";
				  $flag = $connection->createCommand($sql_new)->execute();
				  $this->redirect("http://eclipse-finance.com/admin/");
				}else{
					$this->error_message = "Old Password is wrong,Please type correct password.";
				}
			}else{
				$this->error_message = "Confirm password is not correct.";
			}
		}else{
		$this->redirect("http://eclipse-finance.com/");
		}
		$this->render('changepassword',array('model'=>$model));		
		/*$connection=Yii::app()->db;
		$sql="SELECT * FROM `site_secret_key` where id=1";
		$sites=$connection->createCommand($sql)->queryAll();
		foreach($sites as $value)
		{
		 $key = $value[secret_key];
		}
		$this->render('login',array('model'=>$model));
		//echo $key."</br>";
		/*$admin = md5($key."hestabit@4u");
		$sql_new = "UPDATE `site_secret_key` SET admin_key='".$admin."' WHERE id=1";
		$flag = $connection->createCommand($sql_new)->queryAll();*/
		
	}
	
  
}
