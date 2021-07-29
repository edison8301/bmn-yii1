<?php
$this->breadcrumbs=array(
	'Barang Pemindahan Details',
);

$this->menu=array(
array('label'=>'Create BarangPemindahanDetail','url'=>array('create')),
array('label'=>'Manage BarangPemindahanDetail','url'=>array('admin')),
);
?>

<h1>Barang Pemindahan Details</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
