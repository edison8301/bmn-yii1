<?php
$this->breadcrumbs=array(
	'Pengaturans',
);

$this->menu=array(
	array('label'=>'Tambah Pengaturan','url'=>array('create'),'icon'=>'plus'),
	array('label'=>'Kelola Pengaturan','url'=>array('admin'),'icon'=>'th-list'),
);
?>

<h1>Pengaturans</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
