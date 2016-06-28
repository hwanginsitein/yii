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
            .span-19{width:1200px;margin-top:60px;}
            .container{width:99%;}
            #ui-datepicker-div {z-index:2500 !important;}
            #hfcjdiv{z-index:2500 !important;display: none;float: left;left: 180px;margin-top:5px;position: absolute;background-color: blue}
            #hfcjdiv div{margin-top: 5px;}
            <?php
                if(Yii::app()->getController()->id=='contactUsers' && $this->getAction()->getId()=='repaystatistics'){
            ?>
            #content{
                margin-top: 0px;
            }
            <?php }?>
        </style>
        <script type="text/javascript">
            $(function(){
                $(".menu").click(function(){
                    $(this).css({"visible":"none"});
                });
                $("#hfcja").mouseover(function(){
                    if($("#hfcjdiv").is(":hidden")){
                        $("#hfcjdiv").show();
                    }
                })
                $("#hfcjdiv").mouseout(function(){
                    $(this).hide();
                })
                $("#hfcja").mouseout(function(){
                    $("#hfcjdiv").hide();
                })
                $("#hfcjdiv a").mouseover(function(){
                    $(this).css({"color":"#6399cd"})
                    $(this).css({"background-color":"blue"})
                })
                $("#hfcjdiv a").mouseout(function(){
                    $(this).css({"color":""})
                    $(this).css({"background-color":"blue"})
                })
            })
        </script>
    </head>

    <body>
        <div class="container" id="page">
            <div id="header">
                <div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
            </div><!-- header -->
            <div id="mainmenu">
                <ul>
                    <li><a href="/admin">起始页</a></li>
                    <li><a href="/admin/user">用户</a></li>
                    <li><a href="/admin/LawyerLetter">律师函</a></li>
                    <li id="hfcja">
                        <a>话费催缴</a>
                        <div id="hfcjdiv" style="overflow:hidden">
                            <div><a href="/admin/UploadDocs">上传欠费文档</a></div>
                            <div><a href="/admin/repay/admin">缴费管理</a></div>
                            <div><a href="/admin/ContactUsers">电话录入信息</a></div>
                            <div><a href="/admin/contactUsers/objectionview">异议处理</a></div>
                            <div><a href="/admin/activity">活动管理</a></div>
                            <div><a href="/admin/dun">分配任务</a></div>
                            <div><a href="/admin/contactUsers/repaystatistics">统计数据</a></div>
                            <div><a href="/admin/task">我的任务</a></div>
                        </div>
                    </li>
                    <li><a href="/user/logout">退出 (<?=Yii::app()->user->name?>)</a></li>
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
