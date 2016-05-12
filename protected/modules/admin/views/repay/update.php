<?php
/* @var $this RepayController */
/* @var $model Repay */

$this->breadcrumbs=array(
	'Repays'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'缴费列表', 'url'=>array('index')),
	array('label'=>'添加', 'url'=>array('create')),
	array('label'=>'查看', 'url'=>array('view', 'id'=>$model->id))
);
?>

<h1>Update Repay <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>