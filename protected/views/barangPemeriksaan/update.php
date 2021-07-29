<?php
$this->breadcrumbs=array(
	'Pemeriksaan'=>array('index'),
	'Update',
);

	$this->menu=array(
	array('label'=>'List Pemeriksaan','url'=>array('index')),
	array('label'=>'Create Pemeriksaan','url'=>array('create')),
	array('label'=>'View Pemeriksaan','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Pemeriksaan','url'=>array('admin')),
	);
	?>

	<h1>Sunting Pemeriksaan</h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>