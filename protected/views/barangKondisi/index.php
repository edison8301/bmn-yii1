<?php
/* @var $this BarangKondisiController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Barang Kondisis',
);

$this->menu=array(
	array('label'=>'Create BarangKondisi', 'url'=>array('create')),
	array('label'=>'Manage BarangKondisi', 'url'=>array('admin')),
);
?>

<h1>Barang Kondisis</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
