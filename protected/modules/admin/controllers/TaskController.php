<?php

class TaskController extends Controller
{
	public $layout='column2';
	public function actionIndex(){
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/../DataTables/media/js/jquery.dataTables.js");
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/../DataTables/media/js/dataTables.bootstrap.js");
        Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . "/../DataTables/media/css/jquery.dataTables.css");
		$username = Yii::app()->user->name;
		$user = User::model()->find('username=?',array($username));
		$uid = $user->id;
		$duns = Dun::model()->findAll('uid=?',array($uid));
		$condition = "";
		foreach($duns as $dun){
			$docId = $dun->docId;
			$condition.= "id=$docId or ";
		}
		if($condition){
			$condition = substr($condition,0,-4);
			$uploadDocs = uploadDocs::model()->findAll($condition);
		}
		$this->render("index",array('duns'=>$duns,'uploadDocs'=>$uploadDocs));
		
	}
}
?>