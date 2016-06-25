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

        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css">
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css">
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/layouts.css">
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery-ui.css">
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-ui.js"></script>
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <style>
            <?php //if(Yii::app()->controller->id == "uploadDocs"){ ?>
                .span-19{width:1000px;margin-top:60px;}
                .container{width:99%}
                #ui-datepicker-div {z-index:2500 !important;}
            <?php //} ?>
        </style>
        <script type="text/javascript">
            $(function(){
                $( "#hfcj" ).selectmenu();
                $(".menu").click(function(){
                    $(this).css({"visible":"none"});
                });
            })
        </script>
    </head>

    <body>
        <div class="container" id="page">
            <div id="header">
                <div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
            </div><!-- header -->
            <div id="mainmenu">
                <?php
                    //$this->widget('application.modules.admin.components.JQuerySlideTopMenu.JQuerySlideTopMenu');
                ?>
                <ul>
                    <li><a href="/admin">起始页</a></li>
                    <li><a href="/admin/user">用户</a></li>
                    <li><a href="/admin/LawyerLetter">律师函</a></li>
                    <li>
                        <div tabindex="1" class="selectDark" id="" style="position: relative; width: 203px;">
                            <ul style="position: absolute; z-index: 100; top: 26px; left: 0px; display: block;">
                                <li id="" class="first"><span style="display: block;" class="selected">Animals</span></li>
                                <li id="hippopotamus"><span style="display: block;">Hippopotamus</span></li>
                            </ul>
                            <span id="" class="passiveSelect">Animals</span>
                        </div>
                    </li>
                    <li><a href="/admin/UploadDocs">文档管理</a></li>
                    <li><a href="/admin/repay">缴费管理</a></li>
                    <li><a href="/admin/ContactUsers">电话录入信息</a></li>
                    <li><a href="/admin/activity">活动管理</a></li>
                    <li><a href="/admin/dun">分配任务</a></li>
                    <li><a href="/admin/task">我的任务</a></li>
                    <li><a href="/user/logout">退出 (hwanginsitein)</a></li>
                </ul>
            </div>
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
                <div style="clear:both"></div>
            <?php } ?>
            <?php echo $content; ?>
            <div class="clear"></div>
            <div id="footer">
                Copyright &copy; <?php echo date('Y'); ?> by <?php echo Yii::app()->name; ?>.<br/>
                All Rights Reserved.<br/>
            </div><!-- footer -->
        </div><!-- page -->
    </body>
</html>
