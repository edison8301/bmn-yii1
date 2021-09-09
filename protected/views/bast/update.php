<?php
/* @var $this BastController */
/* @var $model Bast */

$this->breadcrumbs=array(
	'Basts'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Bast', 'url'=>array('index')),
	array('label'=>'Create Bast', 'url'=>array('create')),
	array('label'=>'View Bast', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Bast', 'url'=>array('admin')),
);
?>

<h1>Update Bast <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>