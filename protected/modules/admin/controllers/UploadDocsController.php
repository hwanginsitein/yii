<?php

class UploadDocsController extends Controller {

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
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        //Yii::app()->clientScript->registerScriptFile("//code.jquery.com/jquery-1.12.0.min.js");
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/../DataTables/media/js/jquery.dataTables.js");
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/../DataTables/media/js/dataTables.bootstrap.js");
        Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . "/../DataTables/media/css/jquery.dataTables.css"); 
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }
    public function actionPreview($id) {
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/../DataTables/media/js/jquery.dataTables.js");
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/../DataTables/media/js/dataTables.bootstrap.js");
        Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . "/../DataTables/media/css/jquery.dataTables.css"); 
        if($_POST){
            $p = $_POST;
            $model = $this->loadModel($id);
            $detail = json_decode($model->detail,1);
            $error = array();
            foreach($p as $k=>$v){
                if(!in_array($v,$detail[1])){
                    $error[$k] = $v;
                }
            }
            var_dump($error);
        }
        $this->render('preview', array(
            'model' => $this->loadModel($id),
            'error' => $error
        ));
    }
    
    public function actionConfirm($id){
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        //CUploadedFile::getInstance($model, 'icon'); saveAs
        Yii::app()->clientScript->registerCoreScript('jquery');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/js/jquery-ui.js");
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/js/datepicker_cn.js");
        Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . "/css/jquery-ui.css"); 
        $model = new UploadDocs;
        if (isset($_POST['UploadDocs'])) {
            //var_dump($_POST['UploadDocs']);exit;
            $model->attributes = $_POST['UploadDocs'];
            $uploader = Yii::app()->user->name;
            $model->uploader = $uploader?$uploader:"admin";
            $model->time = time();
            $model->type = "fare";
            $model->upload_name = $_POST['UploadDocs']['upload_name'];
            $detail = CUploadedFile::getInstance($model, 'detail');
            //$filePath = Yii::app()->basePath."/../uploads/files/".time().rand(0,999).".xls";
            //$detail->saveAs($filePath);getTempName()
            if($detail){
                $filePath = $detail->getTempName();
                Yii::import('application.extensions.PHPExcel.Classes.PHPExcel', 1);
                $PHPExcel = new PHPExcel;  
                $ExcelReader = PHPExcel_IOFactory::createReader('Excel5');
                $sheet = $ExcelReader->load($filePath)->getSheet(0);
                $total_line = $sheet->getHighestRow();//12
                $total_column = $sheet->getHighestColumn();//AA
                $detail = array();
                for ($row = 1; $row <= $total_line; $row++) {
                    for ($column = 'A'; $column <= $total_column; $column++){
                        $detail[$row][$column] = trim($sheet->getCell($column.$row)->getValue());
                    }
                }
                $model->detail = json_encode($detail);
            }
            if ($model->save()){
                $this->redirect(array('preview', 'id' => $model->id));
            }
        }
        
        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        Yii::app()->clientScript->registerCoreScript('jquery');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/js/jquery-ui.js");
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/js/datepicker_cn.js");
        Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . "/css/jquery-ui.css"); 
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['UploadDocs'])) {
            $model->attributes = $_POST['UploadDocs'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('UploadDocs');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new UploadDocs('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['UploadDocs']))
            $model->attributes = $_GET['UploadDocs'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return UploadDocs the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = UploadDocs::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param UploadDocs $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'upload-docs-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
