<?php
/* @var $this RepayController */
/* @var $model Repay */

$this->breadcrumbs=array(
	'Repays'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Repay', 'url'=>array('index')),
	array('label'=>'Manage Repay', 'url'=>array('admin')),
);
?>

<h1>Create Repay</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>