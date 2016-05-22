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
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/../DataTables/media/js/jquery.dataTables.js");
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/../DataTables/media/js/dataTables.bootstrap.js");
        Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . "/../DataTables/media/css/jquery.dataTables.css");
        $detail = json_decode($this->loadModel($id)->showDetail,1);
        
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }
    
    public function actionCreatePayDoc(){
        if ($_FILES) {
            $model = new UploadDocs;
            $pay = CUploadedFile::getInstance($model, 'pay');
            if ($pay) {
                $filePath = $pay->getTempName();
                Yii::import('application.extensions.PHPExcel.Classes.PHPExcel', 1);
                $ExcelReader = $this->getExcelReader($filePath);
                $sheet = $ExcelReader->load($filePath)->getSheet(0);
                $total_line = $sheet->getHighestRow(); //12
                $total_column = $sheet->getHighestColumn(); //AA
                $pay = array();
                for ($row = 1; $row <= $total_line; $row++) {
                    for ($column = 'A'; $column <= $total_column; $column++) {
                        $pay[$row][$column] = trim($sheet->getCell($column . $row)->getValue());
                    }
                }
                //var_dump($pay);exit;
                $payNOKey = array_search("缴费编号", $pay[1]);
                $IDKey = array_search("身份证", $pay[1]);
                $paid_money_id = array_search("追缴金额", $pay[1]);
                $rows = array();
                $pay_nums_money = array();
                for($i=2;$i<=$total_line;$i++){
                    $payNO = $pay[$i][$payNOKey];
                    $ID = $pay[$i][$IDKey];
                    $paid_money = $pay[$i][$paid_money_id];
                    //$sql = "select * from gz_upload_docs where showDetail like '%\"$payNO\"%' and showDetail like '%\"$ID\"%'";
                    //$detail = $model->findBySql($sql);
                    //搜索原欠费文档里面的人的缴费的记录
                    $repay = new Repay;
                    $pay_totalmoney = "";
                    //if($detail){
                    $pay_nums_money['id'][] = $detail->id;
                    $pay_nums_money['paid_money'][] = $paid_money;
                    $rows[] = $detail;//搜索出来之后
                    $repay->paid_ID = $ID;
                    $repay->payId = $payNO;
                    $repay->paid_money = $paid_money;
                    $repay->docsId = $detail->id;
                    $pay_totalmoney += $paid_money;
                    if($repay->save()){
                    }else{
                        var_dump($repay->errors);exit;
                    }
                    //}
                }
            }
            $doc_id_money = array();
            foreach($pay_nums_money['id'] as $k=>$upload_doc_id){
                $doc_id_money[$upload_doc_id]["money"] += $pay_nums_money['paid_money'][$k];
                $doc_id_money[$upload_doc_id]["nums"] += 1;
            }
            foreach($doc_id_money as $id=>$totalmoney){
                $upload_doc = $this->loadModel($id);
                $upload_doc->pay_nums = $doc_id_money[$id]['nums'];
                $upload_doc->pay_totalmoney = $doc_id_money[$id]['money'];
                $showDetail = $upload_doc->showDetail;
                $total_debt_nums = count(json_decode($showDetail,1))-1;
                $upload_doc->progress = $this->topercent(round(($upload_doc->pay_nums/$total_debt_nums),2));
                if(!$upload_doc->save()){
                    var_dump($upload_doc->errors);
                }
            }
            $this->redirect("/admin/repay/admin");
            exit;
        }
        $this->render('createPayDoc', array(
            'model' => $model,
        ));
    }
    private function topercent($n){
        return ($n*100).'%';
    }
    public function actionPreview($id) {
        $error = array();
        if ($_POST) {
            $p = $_POST;
            $p['others'] = explode('_', $p['others']);
            $model = $this->loadModel($id);
            $detail = json_decode($model->detail, 1);
            $error = array();
            $columns = array();
            foreach ($p as $k => $v) {
                if ($k == 'others') {
                    continue;
                }
                if (!in_array($v, $detail[1])) {
                    $error[$k] = $v;
                } else {
                    $columns[] = $v;
                }
            }
            foreach ($p['others'] as $v1) {
                if (!in_array($v1, $detail[1])) {
                    $error['others'] = true;
                } else {
                    $columns[] = $v1;
                }
            }
            $results = array();
            if ($error == array()) {
                $row1 = array_intersect($detail[1], $columns);
                $results[1] = $row1;
                $rowCounts = count($detail);
                for ($i = 2; $i <= $rowCounts; $i++) {
                    $results[$i] = array_intersect_key($detail[$i], $row1);
                }
                $model->showDetail = json_encode($results);
                if ($model->save()) {
                    $this->redirect(array('view', 'id' => $model->id));
                } else {
                    var_dump($model->errors);
                }
                exit;
            }
        }
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/../DataTables/media/js/jquery.dataTables.js");
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/../DataTables/media/js/dataTables.bootstrap.js");
        Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . "/../DataTables/media/css/jquery.dataTables.css");
        $this->render('preview', array(
            'model' => $this->loadModel($id),
            'error' => $error
        ));
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

    public function actionCheckUploadName(){
        if($_POST){
            //'gameid=? and displayInLocal=1', array($_GET['id'])
            if(UploadDocs::model()->find("upload_name=?",array($_POST['upload_name']))){
                echo 1;
            }else{
                echo 0;
            }
        }
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
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/js/layer/layer.js");
        Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . "/css/jquery-ui.css");
        $model = new UploadDocs;
        if (isset($_POST['UploadDocs'])) {
            //var_dump($_POST['UploadDocs']);exit;
            $model->attributes = $_POST['UploadDocs'];
            $uploader = Yii::app()->user->name;
            $model->uploader = $uploader ? $uploader : "admin";
            $model->time = time();
            $model->type = "fare";
            $detail = CUploadedFile::getInstance($model, 'detail');
            $fileNameArr = pathinfo($detail->getName());
            $fileName = $fileNameArr['filename'];
            $model->upload_name = $fileName;
            //$filePath = Yii::app()->basePath."/../uploads/files/".time().rand(0,999).".xls";
            //$detail->saveAs($filePath);getTempName()
            if ($detail) {
                $filePath = $detail->getTempName();
                Yii::import('application.extensions.PHPExcel.Classes.PHPExcel', 1);
                $ExcelReader = $this->getExcelReader($filePath);
                $sheet = $ExcelReader->load($filePath)->getSheet(0);
                $total_line = $sheet->getHighestRow(); //12
                $total_column = $sheet->getHighestColumn(); //AA
                $detail = array();
                for ($row = 1; $row <= $total_line; $row++) {
                    for ($column = 'A'; $column <= $total_column; $column++) {
                        $detail[$row][$column] = trim($sheet->getCell($column . $row)->getValue());
                    }
                }
                $model->detail = json_encode($detail);
            }
            if ($model->save()) {
                $docsId = Yii::app()->db->getLastInsertID();
                foreach($detail as $k=>$row){
                    /*
                        'debt_number' => '催缴序号',
                        'docsId' => '文档id',
                        'clientele' => '委托人',
                        'debtor' => '欠债人',
                        'ID_number' => '身份证号码',
                        'telephone' => '电话号码',
                        'account_number' => '账号编号',
                        'debt_money' => '欠费金额',
                        'overdue_time' => '停机时间',
                        'ifpay' => '是否缴费完整',
                        'status' => '状态',
                    */
                    $debts = new Debts;
                    if($k==1){
                        $key_debt_number = array_search("缴费编号", $row);
                        $key_clientele = array_search("委托人", $row);
                        $key_debtor = array_search("欠债人", $row);
                        $key_ID_number = array_search("身份证号码", $row);
                        $key_telephone = array_search("电话号码", $row);
                        $key_account_number = array_search("账号编号", $row);
                        $key_debt_money = array_search("欠费金额", $row);
                        $key_overdue_time = array_search("停机时间", $row);
                        $key_address = array_search("地址", $row);
                        continue;
                    }
                    $debts->debt_number = $row[$key_debt_number];
                    $debts->clientele = $row[$key_clientele];
                    $debts->debtor = $row[$key_debtor];
                    $debts->ID_number = $row[$key_ID_number];
                    $debts->telephone = $row[$key_telephone];
                    $debts->account_number = $row[$key_account_number];
                    $debts->debt_money = $row[$key_debt_money];
                    $debts->overdue_time = $row[$key_overdue_time];
                    $debts->address = $row[$key_address];
                    $debts->docsId = $docsId;
                    $debts->region = $_POST['UploadDocs']['area'];
                    $debts->status = 0;
                    $debts->ifpay = 0;
                    $contact_users = new ContactUsers;
                    
                    $contact_users->name = $row[$key_debtor];
                    $contact_users->debt_money = $row[$key_debt_money];
                    $contact_users->ID_number = $row[$key_ID_number];
                    $contact_users->phone1 = $row[$key_telephone];
                    $contact_users->region = $_POST['UploadDocs']['area'];
                    $contact_users->account_number = $row[$key_account_number];
                    $contact_users->overdue_time = $row[$key_overdue_time];
                    $contact_users->address = $row[$key_address];
                    $contact_users->status = 0;
                    
                    if(!$contact_users->save()){
                        var_dump($contact_users->errors);
                    }
                    
                    if(!$debts->save()){
                        var_dump($debts->errors);
                    }
                }
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
        Debts::model()->deleteAll('docsId=?',array($id));
        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $model = new UploadDocs('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['UploadDocs']))
            $model->attributes = $_GET['UploadDocs'];

        $this->render('admin', array(
            'model' => $model,
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
