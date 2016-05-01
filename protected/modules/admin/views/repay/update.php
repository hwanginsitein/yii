<?php
/* @var $this RepayController */
/* @var $model Repay */

$this->breadcrumbs=array(
	'Repays'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Repay', 'url'=>array('index')),
	array('label'=>'Create Repay', 'url'=>array('create')),
	array('label'=>'View Repay', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Repay', 'url'=>array('admin')),
);
?>

<h1>Update Repay <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>