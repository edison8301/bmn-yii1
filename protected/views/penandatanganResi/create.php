<?php
$this->breadcrumbs=array(
	'Penandatangan Resis'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List PenandatanganResi','url'=>array('index')),
array('label'=>'Manage PenandatanganResi','url'=>array('admin')),
);
?>

<h1>Create PenandatanganResi</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>