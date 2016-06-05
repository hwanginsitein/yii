<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="language" content="en">

        <!-- blueprint CSS framework -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection">
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print">
        <!--[if lt IE 8]>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection">
        <![endif]-->

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css">
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css">
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/layouts.css">
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <style>
            <?php //if(Yii::app()->controller->id == "uploadDocs"){ ?>
                .span-19{width:1000px;margin-top:60px;}
                .container{width:99%}
                .last{margin-left:100px}
                #ui-datepicker-div {z-index:2500 !important;}
            <?php //} ?>
        </style>
    </head>

    <body>
        
        <div class="container" id="page">

            <div id="header">
                <div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
            </div><!-- header -->

            <div id="mainmenu">
                <?php
                $this->widget('zii.widgets.CMenu', array(
                    'items' => array(
                        array('label' => '起始页', 'url' => array('/admin')),
                        array('label' => '用户', 'url' => array('/admin/user')),
                        array('label' => '律师函', 'url' => array('/admin/LawyerLetter')),
                        array('label' => '文档管理', 'url' => array('/admin/UploadDocs')),
                        array('label' => '欠款数据', 'url' => array('/admin/debts')),
                        array('label' => '缴费管理', 'url' => array('/admin/repay')),
                        array('label' => '电话录入信息', 'url' => array('/admin/contactusers')),
                        array('label' => '登录', 'url' => array('/admin/user/login'), 'visible' => Yii::app()->user->isGuest),
                        array('label' => '退出 (' . Yii::app()->user->name . ')', 'url' => array('/admin/user/logout'), 'visible' => !Yii::app()->user->isGuest)
                    ),
                ));
                ?>
            </div><!-- mainmenu -->
            <?php if (isset($this->breadcrumbs)): ?>
                <?php
                $this->widget('zii.widgets.CBreadcrumbs', array(
                    'links' => $this->breadcrumbs,
                ));
                ?><!-- breadcrumbs -->
<?php endif ?>
<?php
    $controller = Yii::app()->getController()->id;
    if($controller == "contactusers"){
?>
    <div>
        <ul class="menu1">
            <li><a href="/admin/contactusers/objection">异议处理</a></li>
            <li><a href="/admin/contactusers/repaystatistics">缴费统计</a></li>
            <li><a href="/admin/contactusers/progress">查看进展</a></li>
        </ul>
    </div>
<?php        
    }
?>             
<div style="clear:both"></div>
<?php echo $content; ?>

            <div class="clear"></div>

            <div id="footer">
                Copyright &copy; <?php echo date('Y'); ?> by <?php echo Yii::app()->name; ?>.<br/>
                All Rights Reserved.<br/>
            </div><!-- footer -->

        </div><!-- page -->

    </body>
</html>
