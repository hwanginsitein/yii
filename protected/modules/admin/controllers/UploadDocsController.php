<?php

class UploadDocsController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = 'column2';

	public function beforeAction($action){
		//权限
		return parent::beforeAction($action);
		exit;
	}
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
            $p = $_POST['UploadDocs'];
            $model = new UploadDocs;
            $pay = CUploadedFile::getInstance($model, 'pay');
            if ($pay) {
                $fileNameArr = pathinfo($pay->getName());
                $fileName = $fileNameArr['filename'];
                $model->upload_name = $fileName;
                $model->uploader = Yii::app()->user->name;
                $model->time = date("Y-m-d");
                $model->type = 0;
                $model->starttime = 0;
                $model->endtime = 0;
                $model->area = $p['area'];
                $model->clientele = $p['clientele'];
                $model->comments = 0;
                $model->debt_repay = 1;
                $model->save();
                $docsId1 = Yii::app()->db->getLastInsertID();
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
                $paid_date_key = array_search("缴费日期", $pay[1]);
                $rows = array();
                $pay_nums_money = array();
                for($i=2;$i<=$total_line;$i++){
                    $payNO = $pay[$i][$payNOKey];
                    $ID = $pay[$i][$IDKey];
                    $paid_money = $pay[$i][$paid_money_id];
                    if($paid_date_key == "-1"){
                        $paid_date = date("Y-m-d");
                    }else{
                        $paid_date = $pay[$i][$paid_date_key];
                    }

                    $repay = new Repay;
                    //搜索上传欠费文档
                    $debt = Debts::model()->find("debt_number=?",array($payNO));
                    $docsId = $debt->docsId;
                    $repay->paid_ID = $ID;
                    $repay->payId = $payNO;
                    $repay->pay_date = $paid_date;
                    $repay->paid_money = $paid_money;
                    $repay->docsId = $docsId;
                    $repay->docsId1 = $docsId1;
                    if($repay->save()){
                    }else{
                        var_dump($repay->errors);
                    }
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
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/js/jquery-ui.js");
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/js/datepicker_cn.js");
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/js/layer/layer.js");
        Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . "/css/jquery-ui.css");
        $model = new UploadDocs;
        if (isset($_POST['UploadDocs'])) {
            $p = $_POST['UploadDocs'];
            $model->time = $p['time'];
            $model->clientele = $p['clientele'];
            $model->type = $p['type'];
            $model->starttime = $p['starttime'];
            $model->endtime = $p['endtime'];
            $model->area = $p['area'];
            $model->comments = $p['comments'];
            $model->debt_repay = 0;
            if(count($_POST['UploadDocs']['label'])){
                $model->label = implode(',',$_POST['UploadDocs']['label']);
            }
            $uploader = Yii::app()->user->name;
            $model->uploader = $uploader ? $uploader : "admin";
            $detail = CUploadedFile::getInstance($model, 'detail');
            if($detail){
                $fileNameArr = pathinfo($detail->getName());
                $fileName = $fileNameArr['filename'];
                $model->upload_name = $fileName;
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
                //$model->detail = json_encode($detail);
            }
            if ($model->save()) {
                $docsId = Yii::app()->db->getLastInsertID();
                foreach($detail as $k=>$row){
                    $debts = new Debts;
                    if($k==1){
                        $key_debt_number = array_search("缴费编号", $row);
                        //$key_clientele = array_search("委托人", $row);
                        $key_debtor = array_search("客户名称", $row);
                        $key_ID_number = array_search("证件号码", $row);
                        $key_telephone = array_search("电话号码", $row);
                        $key_account_number = array_search("缴费编号", $row);
                        $key_debt_money = array_search("欠费本金", $row);
                        $key_overdue_time = array_search("停机日期", $row);
                        $key_address = array_search("安装地址", $row);
                        $key_phone1 = array_search("联系号码", $row);
                        $key_office = array_search("YYB_NAME", $row);
                        $key_manager = array_search("MANAGER_NAME", $row);
                        $key_letterNumber = array_search("律师函编号", $row);
                        continue;
                    }
                    $debts->debt_number = $row[$key_debt_number];
                    $debts->clientele = $_POST['UploadDocs']['clientele'];
                    $debts->debtor = $row[$key_debtor];
                    $debts->ID_number = $row[$key_ID_number];
                    $debts->telephone = $row[$key_telephone];//用户的欠费号码
                    $debts->account_number = $row[$key_account_number];
                    $debts->debt_money = $row[$key_debt_money];
                    $debts->overdue_time = $row[$key_overdue_time];
                    $debts->address = $row[$key_address];
                    $debts->docsId = $docsId;
                    $debts->region = $_POST['UploadDocs']['area'];
                    $debts->status = 0;
                    $debts->ifpay = 0;
                    $debts->office = $row[$key_office];
                    $debts->manager = $row[$key_manager];

                    $contact_users = new ContactUsers;
                    $contact_users->name = $row[$key_debtor];
                    $contact_users->debt_money = $row[$key_debt_money];
                    $contact_users->ID_number = $row[$key_ID_number];
                    $contact_users->phone1 = $row[$key_phone1];//用户的联系号码
                    $contact_users->region = $_POST['UploadDocs']['area']?$_POST['UploadDocs']['area']:0;
                    $contact_users->account_number = $row[$key_account_number];
                    $contact_users->overdue_time = $row[$key_overdue_time];
                    $contact_users->address = $row[$key_address];
                    $contact_users->status = 0;
                    $contact_users->office = $row[$key_office];
                    $contact_users->manager = $row[$key_manager];
                    $contact_users->letterNumber = $row[$key_letterNumber];
                    $contact_users->docsId = $docsId;
                    $contact_users->save();
                    if(trim($row[$key_debtor])==""){
                        continue;
                    }
                    if(trim($row[$key_debt_money])==""){
                        continue;
                    }
                    if(!$contact_users->save()){
                        echo "第".$k."行数据有问题";exit;
                        var_dump($contact_users->errors);
                        echo __LINE__;
                        exit;
                    }
                    
                    if(!$debts->save()){
                        echo "第".$k."行数据有问题";exit;
                        var_dump($debts->errors);
                        echo __LINE__;
                        exit;
                    }
                }
                $this->redirect(array('view', 'id' => $model->id));
            }else{
                echo 1;exit;
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
    public function actionExport(){
        if($_POST){
            $p = $_POST;
            //docsId=? or docsId=?
            $docStr = "";
            $params = array($p['ifrepay'],$p['ifsend'],$p['ifcontact'],$p['ifcontact']);
            foreach($p['docsId'] as $docId){
                $docStr.= "docsId=? or ";
                $params[] = $docId;
            }
            $docStr = substr($docStr,0,-3);
            $conditions = "ifrepay=? and sendLetter=? and (phone1_status=? or phone2_status=?) and (".$docStr.") order by docsId";
            $contacts = ContactUsers::model()->findAll($conditions,$params);
            $content = "";
            /*
name debt_money ID_number phone1
phone1_status phone2 phone2_status phone3 region address account_number overdue_time status sendLetter sent_date receiveLetter
ifrepay repay_date repay_money attitude objection_reason ifvalid otherObjection objection_date otherComments proceed docsId
             */
            $contactModel = new ContactUsers;
            $labels = $contactModel->attributeLabels();
            unset($labels['id']);
            $titles = implode("\t",$labels);
            $preDocId = NULL;
            foreach($contacts as $i => $contact){
                $docsId = $contact->docsId;
                if($docsId != $preDocId){
                    $uploadDoc = UploadDocs::model()->findByPk($docsId);
                    $docName = $uploadDoc->upload_name;
                    $content.= (string)$docName."\n";
                    $content.= $titles."\n";
                }
                foreach($labels as $k=>$label){
                    if($k == "phone1_status"){
                        $arr = array("1"=>"能联系上欠费用户","2"=>"机主不是欠费用户","3"=>"无法联系");
                        $content.= $arr[$contact->$k]."\t";
                    }elseif($k == "phone2_status"){
                        $arr = array("1"=>"能联系上欠费用户","2"=>"机主不是欠费用户","3"=>"无法联系");
                        $content.= $arr[$contact->$k]."\t";
                    }elseif($k == "sendLetter"){
                        $arr = array("0"=>"否","1"=>"是");
                        $content.= $arr[$contact->$k]."\t";
                    }elseif($k == "receiveLetter"){
                        $arr = array("0"=>"否","1"=>"是");
                        $content.= $arr[$contact->$k]."\t";
                    }elseif($k == "status"){
                        $arr = array("0"=>"待审核","1"=>"通过");
                        $content.= $arr[$contact->$k]."\t";
                    }elseif($k == "ifrepay"){
                        $arr = array("0"=>"否","1"=>"是");
                        $content.= $arr[$contact->$k]."\t";
                    }elseif($k == "attitude"){
                        $arr = array("0"=>"不愿意缴费","1"=>"愿意缴费");
                        $content.= $arr[$contact->$k]."\t";
                    }elseif($k == "ifvalid"){
                        $arr = array("0"=>"不成立","1"=>"成立","2"=>"待核实");
                        $content.= $arr[$contact->$k]."\t";
                    }else{
                        $content.= (string)$contact->$k."\t";
                    }
                }
                $content.= "\n";
                $preDocId = $docsId;;
            }
            Yii::app()->request->sendFile("1.xls",$content);exit;
        }
        Yii::import('application.components.functions',1);
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/../DataTables/media/js/jquery.dataTables.js");
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/../DataTables/media/js/dataTables.bootstrap.js");
        Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . "/../DataTables/media/css/jquery.dataTables.css");
        $uploadDocs = UploadDocs::model()->findAll();
        $this->render('export',array('uploadDocs'=>$uploadDocs));
    }
    function actionExample(){
        
    }
}
