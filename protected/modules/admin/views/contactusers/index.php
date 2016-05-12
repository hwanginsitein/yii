<?php
/* @var $this联系用户Controller */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Contact Users',
);

$this->menu=array(
	array('label'=>'添加联系用户', 'url'=>array('create')),
	array('label'=>'管理联系用户', 'url'=>array('admin')),
);
?>

<h1>Contact Users</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
