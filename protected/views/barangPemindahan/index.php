<?php
$this->breadcrumbs=array(
	'Barang Pemindahans',
);

$this->menu=array(
array('label'=>'Create BarangPemindahan','url'=>array('create')),
array('label'=>'Manage BarangPemindahan','url'=>array('admin')),
);
?>

<h1>Barang Pemindahans</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
