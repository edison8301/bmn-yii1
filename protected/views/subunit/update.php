<?php
$this->breadcrumbs=array(
	'Subunits'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List Subunit','url'=>array('index')),
	array('label'=>'Create Subunit','url'=>array('create')),
	array('label'=>'View Subunit','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Subunit','url'=>array('admin')),
	);
	?>

	<h1>Update Subunit <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>