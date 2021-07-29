<?php
$this->breadcrumbs=array(
	'Detail Pemindahan Barang'=>array('admin'),
	'Tambah data',
);

$this->menu=array(
array('label'=>'List BarangPemindahanStatus','url'=>array('index')),
array('label'=>'Manage BarangPemindahanStatus','url'=>array('admin')),
);
?>

<h1>Create BarangPemindahanStatus</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>