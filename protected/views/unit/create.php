<?php
$this->breadcrumbs=array(
	'Unit'=>array('admin'),
	'Tambah data',
);

$this->menu=array(
array('label'=>'List Unit','url'=>array('index')),
array('label'=>'Manage Unit','url'=>array('admin')),
);
?>

<h1>Create Unit</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>