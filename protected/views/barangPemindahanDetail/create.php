<?php
$this->breadcrumbs=array(
	'Detail Pemindahan Barang'=>array('admin'),
	'Tambah data',
);

$this->menu=array(
array('label'=>'List BarangPemindahanDetail','url'=>array('index')),
array('label'=>'Manage BarangPemindahanDetail','url'=>array('admin')),
);
?>

<h1>Create BarangPemindahanDetail</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>