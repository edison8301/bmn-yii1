<?php
$this->breadcrumbs=array(
	'Gedung'=>array('admin'),
	'Tambah data',
);

$this->menu=array(
array('label'=>'List Gedung','url'=>array('index')),
array('label'=>'Manage Gedung','url'=>array('admin')),
);
?>

<h1>Input Data Gedung</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>