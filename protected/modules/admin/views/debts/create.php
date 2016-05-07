<?php
/* @var $this DebtsController */
/* @var $model Debts */

$this->breadcrumbs=array(
	'Debts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Debts', 'url'=>array('index')),
	array('label'=>'Manage Debts', 'url'=>array('admin')),
);
?>

<h1>Create Debts</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>