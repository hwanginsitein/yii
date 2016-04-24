<?php
/* @var $this UploadDocsController */
/* @var $model UploadDocs */

$this->breadcrumbs=array(
	'Upload Docs'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Create UploadDocs', 'url'=>array('create')),
	array('label'=>'View UploadDocs', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage UploadDocs', 'url'=>array('admin')),
);
?>

<h1>Update UploadDocs <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>