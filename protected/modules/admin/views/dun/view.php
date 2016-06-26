<?php
/* @var $this DunController */
/* @var $model Dun */

$this->breadcrumbs=array(
	'Duns'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'创建分配任务', 'url'=>array('create')),
	array('label'=>'更新任务', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'刪除任務', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'分配任务列表', 'url'=>array('admin')),
);
?>

<h1>View Dun #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'uid',
		'docId',
		'cdate',
	),
)); ?>
