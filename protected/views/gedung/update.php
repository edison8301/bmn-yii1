<?php
$this->breadcrumbs=array(
	'Gedung'=>array('admin'),
	'Sunting',
);

	$this->menu=array(
	array('label'=>'List Gedung','url'=>array('index')),
	array('label'=>'Create Gedung','url'=>array('create')),
	array('label'=>'View Gedung','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Gedung','url'=>array('admin')),
	);
	?>

	<h1>Update Gedung <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>