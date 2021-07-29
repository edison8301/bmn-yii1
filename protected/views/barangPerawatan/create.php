<?php
$this->breadcrumbs=array(
	'Perawatan Barang'=>array('admin'),
	'Tambah data',
);
?>

<h1>Input Data Perawatan</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>