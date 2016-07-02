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
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/../DataTables/media/js/jquery.dataTables.js");
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/../DataTables/media/js/dataTables.bootstrap.js");
        Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . "/../DataTables/media/css/jquery.dataTables.css");
        if($_POST){
            //print_r($_POST);exit;
            $p = $_POST;
            $condition = "";
            foreach($p as $k=>$v){
                if(is_string($v)){
                    if(trim($v)){
                        if($k != 'objection'){
                            $condition.= $k."='".$v."' and ";
                        }else{
                            $condition.= "(objection_reason is not null or otherObjection is not null) and ";
                        }
                    }
                }elseif(is_array($v)){
                    $condition = "(";
                    foreach($v as $k1=>$v1){
                        $condition.= "{$k}='$v1' or ";
                    }
                    $condition = substr($condition,0,-4);
                    $condition.= ") and ";
                }
            }
            $condition = substr($condition,0,-5);
            //echo $condition;exit;
            $contactUsers = ContactUsers::model()->findAll($condition);
            $this->renderPartial('search1',array('contactUsers'=>$contactUsers));
            exit;
        }
        $this->render('search',array());
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
        if (isset($_POST['ContactUsers'])) {
            $p = $_POST['ContactUsers'];
            if($model->proceed){
                $proceed = str_replace("</table>","",$model->proceed);
            }else{
                $proceed = "<table border=1><tr><th>日期</th><th>内容</th></tr>";
            }
            $postArr = array(
                    '联系电话'=>'phone1','新的联系方式'=>'phone2','联系电话状态'=>'phone1_status',
                    '新的联系方式的状态'=>'phone2_status','是否发送律师函'=>'sendLetter','是否收到律师函'=>'receiveLetter',
                    '缴费金额'=>'repay_money','用户态度'=>'attitude','异议理由'=>'objection_reason','其他理由'=>'otherObjection','缴费金额'=>'repay_money','缴费日期'=>'repay_date','其他信息'=>'otherComments'
                );
            $postArr1 = array(
                    'phone1','phone2','phone1_status','phone2_status','sendLetter',
                    'receiveLetter','repay_money','attitude','objection_reason'
                );
            $array = array('联系电话状态','是否发送律师函','是否收到律师函','用户态度');
            $array1 = array(
                    2=>array(0=>'无法接通',1=>'可以接通'),
                    3=>array(0=>'无法接通',1=>'可以接通'),
                    4=>array('否','是'),5=>array(1=>'是',2=>'地址不详，没有寄送律师函',3=>'用户拒收律师函',4=>'律师函被退回'),
                    7=>array('不愿意缴费','愿意缴费',"-1"=>"拒不缴费态度恶劣")
                );
            $content = '更新内容：<br>';
            $i=-1;
            foreach($postArr as $k=>$v){
                $i++;
                if($v == 'sendLetter'){continue;}
                if($model->$v != $p[$v]){
                    if(!in_array($k,$array)){
                        $content.= $k." ".$p[$v]."<br>";
                    }else{
                        $content.= $k." ".$array1[$i][$p[$v]]."<br>";
                    }
                }
            }
            $model->attributes = $p;
            $model->editor = Yii::app()->user->name;
            if($p['objection_reason'] || $p['otherObjection']){
                $model->objection_date = date("Y-m-d");
            }
            $proceed.= "<tr><td>".date("Y-m-d H:i:s")."</td><td>".$content."</td><td></td></tr><table>";
            $proceed.="</table>";
            if($content != '更新内容：<br>'){
                $model->proceed = $proceed;
            }
            if ($model->save()){
                if(isset($_GET['next'])){
                    if($_GET['next']){
                        $this->redirect(array('admin'));
                    }
                    $this->redirect(array('update', 'id' => $_GET['next']));
                }else{
                    $criteria = new CDbCriteria;
                    $criteria->condition = "id>{$model->id}";
                    $next = ContactUsers::model()->find($criteria);
                    $this->redirect(array('update', 'id' => $next->id));
                }
            }
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
        $user = User::model()->find('username=?',array(Yii::app()->user->name));
        $region = $user->region;//
        if($user->role != 5 || $region == '全市'){
            $sql = "select * from gz_repay as r left join gz_debts as d on payId=debt_number";
            $repays = Repay::model()->findAllBySql($sql);
            $repayCount = count($repays);
            $debtsCount = Debts::model()->count();
        }else{
            $sql = "select * from gz_repay as r left join gz_debts as d on payId=debt_number where region=?";
            $repays = Repay::model()->findAllBySql($sql,array($region));
            $repayCount = count($repays);
            $debtsCount = Debts::model()->count("region=?",array($region));
        }
        $this->render('repaystatistics',array('repayCount'=>$repayCount,'debtsCount'=>$debtsCount));
    }
    function actionGetAllRepays(){
        if($_POST){
            $startdate = $_POST['startdate'];
            $enddate = $_POST['enddate'];
            if($_POST["region"]){
                $region = $_POST['region'];
            }else{
                $region = "峡江县";//
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
    function actionObjectionview(){
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/../DataTables/media/js/jquery.dataTables.js");
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/../DataTables/media/js/dataTables.bootstrap.js");
        Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . "/../DataTables/media/css/jquery.dataTables.css");
        $condition = "objection_reason is not null or otherObjection is not null and region=?";
		$user = User::model()->find('username=?',array(Yii::app()->user->name));
		$region = $user->region;
        if($region == '全市' || Yii::app()->session['role'] == 1 || Yii::app()->session['role'] == 3){
            $condition = "objection_reason is not null or otherObjection is not null";
        }
        $contactUsers = ContactUsers::model()->findAll($condition,array($region));
        $this->render('objectionview',array('contactUsers'=>$contactUsers));
    }
}
