<?php
/* @var $this UploadDocsController */
/* @var $model UploadDocs */

$this->breadcrumbs=array(
	'Upload Docs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'管理缴费数据', 'url'=>array('admin')),
);
?>

<h1>缴费文档</h1>

<?php $this->renderPartial('paydoc_form', array('model'=>$model)); ?>