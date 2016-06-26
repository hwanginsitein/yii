<?php
/* @var $this DunController */
/* @var $model Dun */

$this->breadcrumbs=array(
	'Duns'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'创建分配任务', 'url'=>array('create')),
	array('label'=>'查看任务', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'分配任务列表', 'url'=>array('admin')),
);
?>

<h1>更新任务 <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>