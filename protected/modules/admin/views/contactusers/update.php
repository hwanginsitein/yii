<?php
/* @var $this联系用户Controller */
/* @var $model联系用户 */

$this->breadcrumbs=array(
	'Contact Users'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
        array('label'=>'搜索联系用户', 'url'=>array('search')),
	array('label'=>'查看联系用户', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'管理联系用户', 'url'=>array('admin')),
);
?>

<h1>修改联系用户 <?php echo $model->name; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>