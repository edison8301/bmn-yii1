<?php
$this->breadcrumbs=array(
	'Pemindahan Barang'=>array('admin'),
	'Tambah data',
);

$this->menu=array(
array('label'=>'List BarangPemindahan','url'=>array('index')),
array('label'=>'Manage BarangPemindahan','url'=>array('admin')),
);
?>

<h1>Buat Data Pemindahan</h1>

<div>&nbsp;</div>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>