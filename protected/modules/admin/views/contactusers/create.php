<?php
/* @var $this联系用户Controller */
/* @var $model联系用户 */

$this->breadcrumbs=array(
	'Contact Users'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'管理联系用户', 'url'=>array('admin')),
);
?>

<h1>添加联系用户</h1>
<input type="text" id="debtor" placeholder="请输入自己的姓名或者手机号，身份证号码进行搜索" size="40">
<button>搜索</button>
<?php //$this->renderPartial('_form_create', array('model'=>$model)); ?>
<div id="new"></div>
<script>
    $(document).ready(function(){
        $("button").click(function(){
            var search = $("#debtor").val();
            if(!search){layer.msg('请输入');return false;}
            $.ajax({
                type: "POST",
                url: "/admin/contactusers/getdebtor",
                data: {search:search},
                success:function(d){
                    if(d==0){
                        layer.msg('无数据');return;
                    }else if(d>=1){
                        var id = d;
                        window.location.href="/admin/contactusers/update/id/"+id;
                        return false;
                    }
                    $("#new").html("");
                    $("#new").html(d);
                }
            })
        });
    })
</script>