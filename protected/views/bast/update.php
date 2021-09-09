<?php
/* @var $this BastController */
/* @var $model Bast */

$this->breadcrumbs=array(
	'BAST'=>array('admin'),
	'Update',
);

$this->menu=array(
	array('label'=>'List BAST', 'url'=>array('index')),
	array('label'=>'Create BAST', 'url'=>array('create')),
	array('label'=>'View BAST', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage BAST', 'url'=>array('admin')),
);
?>

<h1>Sunting <?php echo $model->nomor; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
