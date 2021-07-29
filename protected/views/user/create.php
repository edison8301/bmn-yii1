<?php
$this->breadcrumbs=array(
	'User'=>array('admin'),
	'Tambah data',
);

$this->menu=array(
array('label'=>'List User','url'=>array('index')),
array('label'=>'Manage User','url'=>array('admin')),
);
?>

<h1>Buat User</h1>

<div>&nbsp;</div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>