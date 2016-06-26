<?php

class DunController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/js/jquery-ui.js");
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/js/datepicker_cn.js");
        Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . "/css/jquery-ui.css");
		$model=new Dun;
		if(isset($_POST['Dun']))
		{
			$p = $_POST['Dun'];
			$model->cdate = $p['cdate'];
			$model->docId = $p['docId'];
			$username = $p['username'];
			$user = User::model()->find('username=? and role=5',array($username));
			if($user){
				$model->uid = $user->id;
				if($model->save()){
					$this->redirect(array('view','id'=>$model->id));
				}
			}else{
				$errorMsg['username'] = "用户名为{$username}的催缴人员不存在";
			}
		}
		$this->render('create',
			array('model'=>$model,'errorMsg'=>$errorMsg)
		);
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Dun']))
		{
			$model->attributes=$_POST['Dun'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new Dun('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Dun'])){
			$model->attributes=$_GET['Dun'];
		}
		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Dun('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Dun'])){
			$model->attributes=$_GET['Dun'];
		}
		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Dun the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Dun::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Dun $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='dun-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
