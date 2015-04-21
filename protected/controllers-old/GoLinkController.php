<?php

class GoLinkController extends SiteController
{
	public function actionIndex($pid)
	{
		if($partner = Users::model()->getPartnerById($pid))
		{
			Yii::app()->user->setState('partner_id', $pid); 
			if(!Yii::app()->user->getState('url_refferer'))
				Yii::app()->user->setState('url_refferer', Yii::app()->request->urlReferrer); 		
		}
		$this->redirect('/');
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}