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
<?php $this->renderPartial('_form_create', array('model'=>$model)); ?>