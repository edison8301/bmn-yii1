<?php
$this->breadcrumbs=array(
	'Tahuns',
);

$this->menu=array(
array('label'=>'Create Tahun','url'=>array('create')),
array('label'=>'Manage Tahun','url'=>array('admin')),
);
?>

<h1>Tahuns</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
