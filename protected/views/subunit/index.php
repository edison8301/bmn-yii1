<?php
$this->breadcrumbs=array(
	'Subunits',
);

$this->menu=array(
array('label'=>'Create Subunit','url'=>array('create')),
array('label'=>'Manage Subunit','url'=>array('admin')),
);
?>

<h1>Subunits</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
