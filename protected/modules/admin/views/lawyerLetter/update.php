<?php
/* @var $this LawyerLetterController */
/* @var $model LawyerLetter */

$this->breadcrumbs=array(
	'Lawyer Letters'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Create LawyerLetter', 'url'=>array('create')),
	array('label'=>'View LawyerLetter', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage LawyerLetter', 'url'=>array('admin')),
);
?>

<h1>Update LawyerLetter <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>