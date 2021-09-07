<?php
/* @var $this KategoriController */
/* @var $model Kategori */

$this->breadcrumbs=array(
	'Barang Kategoris'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List BarangKategori', 'url'=>array('index')),
	array('label'=>'Manage BarangKategori', 'url'=>array('admin')),
);
?>

<h1>Tambah Kategori Barang</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>