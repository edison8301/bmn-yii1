<?php
$this->breadcrumbs=array(
	'Pengaturans'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);


	?>

	<h1>Sunting Pengaturan</h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>