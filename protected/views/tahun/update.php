<?php
$this->breadcrumbs=array(
	'Tahuns'=>array('index'),
	'Update',
);

	$this->menu=array(
	array('label'=>'List Tahun','url'=>array('index')),
	array('label'=>'Create Tahun','url'=>array('create')),
	array('label'=>'View Tahun','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Tahun','url'=>array('admin')),
	);
	?>

	<h1>Sunting Tahun <?php echo $model->tahun; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>