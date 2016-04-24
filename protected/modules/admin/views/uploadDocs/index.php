<?php
/* @var $this UploadDocsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Upload Docs',
);

$this->menu=array(
	array('label'=>'Create UploadDocs', 'url'=>array('create')),
	array('label'=>'Manage UploadDocs', 'url'=>array('admin')),
);
?>

<h1>Upload Docs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
