<?php
$this->breadcrumbs=array(
	'Perawatan'=>array('admin'),
	'Update',
);

	$this->menu=array(
	array('label'=>'List Perawatan','url'=>array('index')),
	array('label'=>'Create Perawatan','url'=>array('create')),
	array('label'=>'View Perawatan','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Perawatan','url'=>array('admin')),
	);
	?>

	<h1>Update Perawatan <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>