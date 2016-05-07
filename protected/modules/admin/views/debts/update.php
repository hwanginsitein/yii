<?php
/* @var $this DebtsController */
/* @var $model Debts */

$this->breadcrumbs=array(
	'Debts'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Debts', 'url'=>array('index')),
	array('label'=>'Create Debts', 'url'=>array('create')),
	array('label'=>'View Debts', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Debts', 'url'=>array('admin')),
);
?>

<h1>Update Debts <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>