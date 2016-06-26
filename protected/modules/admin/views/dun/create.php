<?php
/* @var $this DunController */
/* @var $model Dun */

$this->breadcrumbs=array(
	'Duns'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'分配任务列表', 'url'=>array('admin')),
);
?>

<h1>创建分配任务</h1>

<?php $this->renderPartial('_form', array('model'=>$model,'errorMsg'=>$errorMsg)); ?>