<?php
/* @var $this DunController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Duns',
);

$this->menu=array(
	array('label'=>'创建分配任务', 'url'=>array('create')),
	array('label'=>'分配任务列表', 'url'=>array('admin')),
);
?>

<h1>Duns</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
