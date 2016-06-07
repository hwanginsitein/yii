<?php
/* @var $this ActivityController */
/* @var $model Activity */

$this->breadcrumbs=array(
	'Activities'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'活动管理', 'url'=>array('admin')),
);
?>

<h1>创建活动</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>