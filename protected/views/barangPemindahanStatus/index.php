<?php
$this->breadcrumbs=array(
	'Barang Pemindahan Statuses',
);

$this->menu=array(
array('label'=>'Create BarangPemindahanStatus','url'=>array('create')),
array('label'=>'Manage BarangPemindahanStatus','url'=>array('admin')),
);
?>

<h1>Barang Pemindahan Statuses</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
