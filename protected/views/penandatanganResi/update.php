<?php
$this->breadcrumbs=array(
	'Penandatangan Resis'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List PenandatanganResi','url'=>array('index')),
	array('label'=>'Create PenandatanganResi','url'=>array('create')),
	array('label'=>'View PenandatanganResi','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage PenandatanganResi','url'=>array('admin')),
	);
	?>

	<h1>Seting Penandatangan <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>