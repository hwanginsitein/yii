<?php

class AdminModule extends CWebModule
{
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'admin.models.*',
			'admin.components.*',
		));
	}

	public function beforeControllerAction($controller, $action)
	{
		Yii::app()->clientScript->registerCoreScript('jquery');
		if(Yii::app()->user->isGuest){
			header("location:/user/login");
			exit;
		}
		return true;
		$conName = $controller->id;
		$actName = $action->id;
		$role = array('1','2','3','5');//律师 电信工作人员 律师助手 催缴人员
		$roleControllerAction = array(
			1=>array(
				'contactUsers'=>'repaystatistics,index',
				'repay'=>'','activity'=>'',
			),
			2=>array(
				'contactUsers'=>'repaystatistics,index',
				'task'=>'index',
			),
			3=>array(
				'contactUsers'=>'repaystatistics,index,objectionview',
				'task'=>'index',
			),
			5=>array(
				'contactUsers'=>'repaystatistics,index,objectionview',
				'task'=>'index',
			),
		);
		$allPower = array(
			'contactUsers'=>'repaystatistics,index,objectionview','repay'=>'','activity'=>'',
		);
		$allPower = array(
			'contactUsers,repaystatistics',
			'contactUsers,index',
			'contactUsers,objectionview',
			'repay,index',
			'activity,index',
			'activity,create',
			'activity,update',
			'activity,view',
			'activity,delete',
			'task,index',
		);
		if(!in_array("{$conName},{$actName}",$allPower)){
			return true;
		}
		$myRole = Yii::app()->session['role'];
		$roleArr = $roleControllerAction[$myRole];
		$actionAccess = $roleArr[$controller->id];
		if(!isset($roleArr[$controller->id])){
			return true;
		}
		if(!strstr($action->id,$actionAccess)){
			return false;
		}
		//role 1235
		//Yii::app()->session['role'];
		//Yii::app()->session['approvement'];
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
}
