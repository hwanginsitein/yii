<?php

class UserController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = 'column2';

    /**
     * @return array action filters
     */
    public function filters() {
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
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view', 'create', 'update', 'delete'),
                'users' => array('*'),
            ),
                /*
                  array('allow', // allow authenticated user to perform 'create' and 'update' actions
                  'actions'=>array('create','update'),
                  'users'=>array('@'),
                  ),
                  array('allow', // allow admin user to perform 'admin' and 'delete' actions
                  'actions'=>array('admin','delete'),
                  'users'=>array('admin'),
                  ),
                  array('deny',  // deny all users
                  'users'=>array('*'),
                  ),
                 */
        );
    }


    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $model = new User('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['User']))
            $model->attributes = $_GET['User'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return User the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = User::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param User $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionLogin() {
        if (isset($_POST['username'])){
            if($this->_innerLogin($_POST['username'], $_POST['password'])){
                echo json_encode(array('status'=>1));
            }else{
				echo json_encode(array('status'=>0,'error'=>array('账号密码错误')));
			}
			exit;
        }
        // display the login form
        $this->renderPartial('login', array('model' => $model));
    }

    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    private function _innerLogin($username, $password) {
         
        $user = User::model()->find('username=?', array($username));
        if ($user == null) {
            return false;
        }
        if (md5($password) != $user->password) {
            return false;
        }
        $this->_login($user);
        return true;
    }
    
    private function _login($user) {
        $identity = new UserIdentity($user->username,$user->password);
        $duration = 86400*30;
        if (1) {
            Yii::app()->user->login($identity, $duration);
        } else {
            Yii::app()->user->login($identity);
        }
    }
	public function actionRegister(){
		if($_POST){
			$p = $_POST;
			$user = new User;
			$user->attributes = $_POST;
			$user->password = md5($_POST['password']);
      $user->region = $p['region'];
			if($user->save()){
				echo json_encode(array('status'=>1));
			}else{
				echo json_encode(array('status'=>0,'error'=>$user->errors));
			}
			exit;
		}
		$this->renderPartial('register',array('errors'=>$errors));
	}
}
