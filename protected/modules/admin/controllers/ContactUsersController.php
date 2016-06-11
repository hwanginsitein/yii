<?php

class ContactUsersController extends Controller {

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
            )
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/js/layer/layer.js");
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }
    public function actionObjection(){
        Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . "/bootstrap/css/bootstrap.min.css");
        Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . "/bootstrap/css/bootstrap-theme.min.css");
        $this->render("objection");
    }
    public function actionGetObjections(){
        if(count($_POST)){
            $ifvalid = $_POST['ifvalid'];
            $contactusers = ContactUsers::model()->findAll("ifvalid=?",array($ifvalid));
            foreach($contactusers as $contactuser){
                $contacts[$contactuser->objection_date][] = $contactuser;
            }
            $this->renderPartial("get_objections",array('contacts'=>$contacts));exit;
        }
        $contactusers = ContactUsers::model()->findAll("objection_reason is not null order by objection_date desc");
        $contacts = array();
        foreach($contactusers as $contactuser){
            $contacts[$contactuser->objection_date][] = $contactuser;
        }
        $this->renderPartial("get_objections",array('contacts'=>$contacts));
    }

    public function actionSearch() {
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/js/jquery-ui.js");
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/js/datepicker_cn.js");
        Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . "/css/jquery-ui.css");
        Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . "/css/my.css");
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/baiduEditor/ueditor.config.js");
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/baiduEditor/ueditor.all.min.js");
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/js/layer/layer.js");
        $model = new ContactUsers;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['ContactUsers'])) {
            $model->attributes = $_POST['ContactUsers'];
            if ($model->save()){
                $this->redirect(array('view', 'id' => $model->id));
            }else{
                var_dump($model->errors);
                exit;
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
        Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . "/css/my.css");
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/js/jquery-ui.js");
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/js/datepicker_cn.js");
        Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . "/css/jquery-ui.css");
        Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . "/css/my.css");
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/baiduEditor/ueditor.config.js");
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/baiduEditor/ueditor.all.min.js");
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/js/layer/layer.js");
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        
        if (isset($_POST['ContactUsers'])) {
            $p = $_POST['ContactUsers'];
            if($model->proceed){
                $proceed = str_replace("</table>","",$model->proceed);
            }else{
                $proceed = "<table border=1><tr><th>日期</th><th>内容</th></tr>";
            }
            $postArr = array(
                    '第一联系电话'=>'phone1','第二联系电话'=>'phone2','第一联系电话状态'=>'phone1_status',
                    '第二联系电话状态'=>'phone2_status','是否发送律师函'=>'sendLetter','是否收到律师函'=>'receiveLetter',
                    '缴费金额'=>'repay_money','用户态度'=>'attitude','异议理由'=>'objection_reason','新的联系方式'=>'phone3',
                );
            $postArr1 = array(
                    'phone1','phone2','phone1_status','phone2_status','sendLetter',
                    'receiveLetter','repay_money','attitude','objection_reason'
                );
            $array = array('第一联系电话状态','第二联系电话状态','是否发送律师函','是否收到律师函','用户态度');
            $array1 = array(
                    2=>array(1=>'能连上欠费用户',2=>'机主不是欠费用户',3=>'无法联系'),
                    3=>array(1=>'能连上欠费用户',2=>'机主不是欠费用户',3=>'无法联系'),
                    4=>array('否','是'),5=>array('否','是'),
                    7=>array('不愿意缴费','愿意缴费')
                );
            $content = '更新内容：<br>';
            $i=0;
            foreach($postArr as $k=>$v){
                if($v == 'phone2_status'){continue;}
                if($model->$v != $p[$v]){
                    if(!in_array($k,$array)){
                        $content.= $k." ".$p[$v]."<br>";
                    }else{
                        $content.= $k." ".$array1[$i][$p[$v]]."<br>";
                    }
                }
                $i++;
            }
            $model->attributes = $_POST['ContactUsers'];
            $proceed.= "<tr><td>".date("Y-m-d H:i:s")."</td><td>".$content."</td><td></td></tr><table>";
            $proceed.="</table>";
            if($content != '更新内容：<br>'){
                $model->proceed = $proceed;
            }
            if ($model->save())
                $this->redirect(array('update', 'id' => $model->id));
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
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/js/layer/layer.js");
        $model = new ContactUsers('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['ContactUsers']))
            $model->attributes = $_GET['ContactUsers'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new ContactUsers('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['ContactUsers']))
            $model->attributes = $_GET['ContactUsers'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return ContactUsers the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = ContactUsers::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param ContactUsers $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'contact-users-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    function actionGetdebtor(){
        //if($_POST){
            $p = $_POST;
            $search = $p['search'];
            //$search = "刘伏田";
            //$search = "谢芳清";
            $ContactUsers = ContactUsers::model()->findAll('name=? or ID_number=? or phone1=?',array($search,$search,$search));
            if(count($ContactUsers)>1){
                $this->renderPartial("debts",array("ContactUsers"=>$ContactUsers));exit;
            }elseif(count($ContactUsers)==0){
                echo 0;exit;
            }
            $model = $ContactUsers[0];
            $this->renderPartial("_form_create",array('model'=>$model));
        //}
    }
    function actionGetContactUser(){
        //if($_POST){
            $p = $_POST;
            $search = $p['search'];
            //$search = "谢芳清";
            $ContactUsers = ContactUsers::model()->findAll('name=? or ID_number=? or phone1=?',array($search,$search,$search));
            if(count($ContactUsers)>1){
                $this->renderPartial("debts",array("ContactUsers"=>$ContactUsers));exit;
            }elseif(count($ContactUsers)==0){
                echo 0;exit;
            }
            $model = $ContactUsers[0];
            $this->renderPartial("objection_user",array('model'=>$model));
        //}
    }
    function actionRepaystatistics(){
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/js/jquery-ui.js");
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/js/datepicker_cn.js");
        Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . "/css/jquery-ui.css");
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/../DataTables/media/js/jquery.dataTables.js");
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/../DataTables/media/js/dataTables.bootstrap.js");
        Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . "/../DataTables/media/css/jquery.dataTables.css");
        Yii::import('application.components.functions',1);
        $region = "新干县";//
        $sql = "select * from gz_repay as r left join gz_debts as d on payId=debt_number where region=?";
        $repays = Repay::model()->findAllBySql($sql,array($region));
        $repayCount = count($repays);
        $debtsCount = Debts::model()->count("region=?",array($region));
        $this->render('repaystatistics',array('repayCount'=>$repayCount,'debtsCount'=>$debtsCount));
    }
    function actionGetAllRepays(){
        if($_POST){
            $startdate = $_POST['startdate'];
            $enddate = $_POST['enddate'];
            if($_POST["region"]){
                $region = $_POST['region'];
            }else{
                $region = "新干县";//
            }
            $sql = "select * from gz_repay as r left join gz_debts as d on payId=debt_number where region=?";
            if($startdate){
                $where = " AND pay_date>'{$startdate}'";
                $sql.= $where;
            }
            if($enddate){
                $where = " AND pay_date<'{$enddate}'";
                $sql.= $where;
            }
            $result = yii::app()->db->createCommand($sql);
            $repays = $result->queryAll(true,array($region));
            $this->renderPartial('getallrepays',array('repays'=>$repays));
        }
    }
    function actionProgress(){
        Yii::import('application.components.functions',1);
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/js/jquery-ui.js");
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/js/datepicker_cn.js");
        Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . "/css/jquery-ui.css");
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/../DataTables/media/js/jquery.dataTables.js");
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/../DataTables/media/js/dataTables.bootstrap.js");
        Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . "/../DataTables/media/css/jquery.dataTables.css");
        $uploadDocs = UploadDocs::model()->findAll();
        $this->render("progress",array("uploadDocs"=>$uploadDocs));
    }
    function actionGetAllRepayCount(){
        $region = $_POST['region'];//
        $sql = "select * from gz_repay as r left join gz_debts as d on payId=debt_number where region=?";
        $repays = Repay::model()->findAllBySql($sql,array($region));
        $repayCount = count($repays);
        $debtsCount = Debts::model()->count("region=?",array($region));
        echo json_encode(array($repayCount,$debtsCount));exit;
    }
}
