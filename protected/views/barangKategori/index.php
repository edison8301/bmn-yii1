<?php
/* @var $this BarangKategoriController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Barang Kategoris',
);

$this->menu=array(
	array('label'=>'Create BarangKategori', 'url'=>array('create')),
	array('label'=>'Manage BarangKategori', 'url'=>array('admin')),
);
?>

<h1>Barang Kategoris</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
