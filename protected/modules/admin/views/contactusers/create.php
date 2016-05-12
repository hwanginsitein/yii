<?php
/* @var $this联系用户Controller */
/* @var $model联系用户 */

$this->breadcrumbs=array(
	'Contact Users'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'管理联系用户', 'url'=>array('admin')),
);
?>

<h1>添加联系用户</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>