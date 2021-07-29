<?php
/* @var $this LokasiController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Lokasis',
);

$this->menu=array(
	array('label'=>'Create Lokasi', 'url'=>array('create')),
	array('label'=>'Manage Lokasi', 'url'=>array('admin')),
);
?>

<h1>Lokasis</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
