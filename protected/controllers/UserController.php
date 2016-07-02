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
    				echo json_encode(array('status'=>0,'error'=>array('登录失败')));
    			}
		      exit;
        }
        // display the login form
        $this->renderPartial('login', array('model' => $model));
    }

    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect("/");
    }

    private function _innerLogin($username, $password) {
         
        $user = User::model()->find('username=?', array($username));
        if (($user == null) || ($user->approvement == 0)) {
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
      Yii::app()->session['role'] = $user->role;
      Yii::app()->session['region'] = $user->region;
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
      $user->realname = $p['realname'];
      $user->role = $p['role'];
      if($p['role']==4){
        $count = ContactUsers::model()->count('ID_number=?',array($p['ID_number']));
        if($count){
          $user->approvement = 1;
        }
      }
			if($user->save()){
				echo json_encode(array('status'=>1));
			}else{
				echo json_encode(array('status'=>0,'error'=>$user->errors));
			}
			exit;
		}
		$this->renderPartial('register',array('errors'=>$errors));
	}
  public function actionParse(){
      $content = file('1.txt');
      $newContent = "";
      foreach($content as $k=>$row){
          $row = trim($row);
          if($k==0){continue;}
          $phones = explode(",",$row);
          $phones = array_unique($phones);
          $newrow = implode(',',$phones);
          $newContent.= $newrow."\n";
      }
      file_put_contents('2.txt',$newContent);
  }
  public function actionTest(){
    Yii::import('application.extensions.PHPExcel.Classes.PHPExcel',1);
    $filePath = "./1.xls";
    $ExcelReader = $this->getExcelReader($filePath);
    $ExcelReader1 = $this->getExcelReader($filePath);
    $ExcelReaderA = new PHPExcel();
    $ExcelReaderB = new PHPExcel();
    $sheet = $ExcelReader->load($filePath)->getSheet(0);
    $total_line = $sheet->getHighestRow(); //12
    $total_column = $sheet->getHighestColumn(); //AA
    $detail1 = array();
    $detail2 = array();
    $i = 0;
    for ($row = 2; $row <= $total_line; $row++) {
      $contactPhone = $sheet->getCell("K" . $row)->getValue();
      $debtPhones = $sheet->getCell("L" . $row)->getValue();
      if(strstr($debtPhones,$contactPhone)){
        $i++;
        for ($column = 'A'; $column <= $total_column; $column++) {
          $value = (string)trim($sheet->getCell($column . $row)->getValue());
          $ExcelReaderA->setActiveSheetIndex(0)->setCellValueExplicit($column.$i,$value,PHPExcel_Cell_DataType::TYPE_STRING);
        }
      }else{
        //$i++;
        for ($column = 'A'; $column <= $total_column; $column++) {
          $value = (string)trim($sheet->getCell($column . $row)->getValue());
          $ExcelReaderB->setActiveSheetIndex(0)->setCellValueExplicit($column.$i,$value,PHPExcel_Cell_DataType::TYPE_STRING);
        }
      }
    }
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="a.xls"');
    header('Cache-Control: max-age=0');
    $objWriter = PHPExcel_IOFactory::createWriter($ExcelReaderA, 'Excel5');
    $objWriter->save('php://output');
    $ExcelReaderB->save("a.xls");
  }
  private function getExcelReader($filePath){
      $ExcelReader = PHPExcel_IOFactory::createReader('Excel5');
      if(!$ExcelReader->canRead($filePath)){
          $ExcelReader = PHPExcel_IOFactory::createReader('Excel2007');
          if(!$ExcelReader->canRead($filePath)){ 
              echo '文档格式有误'; 
              exit;
          } 
      }
      return $ExcelReader;
  }
}
