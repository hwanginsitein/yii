<?php
/* @var $this DebtsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Debts',
);

$this->menu=array(
	array('label'=>'Create Debts', 'url'=>array('create')),
	array('label'=>'Manage Debts', 'url'=>array('admin')),
);
?>

<h1>Debts</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
