<?php
/* @var $this RepayController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Repays',
);

$this->menu=array(
	array('label'=>'Create Repay', 'url'=>array('create')),
	array('label'=>'Manage Repay', 'url'=>array('admin')),
);
?>

<h1>Repays</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
