<?php
$this->breadcrumbs=array(
	'Units'=>array('index'),
	'Manage',
);
?>

<h1>Kelola Unit</h1>


<?php $this->widget('booster.widgets.TbGridView',array(
		'id'=>'unit-grid',
		'type'=>'striped bordered condensed',
		'dataProvider'=>$model->search(),
		'filter'=>$model,
		'columns'=>array(
			'nama',
			array(
				'class'=>'booster.widgets.TbButtonColumn',
			),
		),
)); ?>
