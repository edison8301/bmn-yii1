<?php
$this->breadcrumbs=array(
	'Tahun'=>array('admin'),
	'Tambah data',
);

$this->menu=array(
array('label'=>'List Tahun','url'=>array('index')),
array('label'=>'Manage Tahun','url'=>array('admin')),
);
?>

<h1>Tahun</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>