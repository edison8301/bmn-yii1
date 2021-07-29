<?php
$this->breadcrumbs=array(
	'Subunits'=>array('index'),
	'Manage',
);
?>

<h1>Kelola Subunit</h1>

<?php $this->widget('booster.widgets.TbGridView',array(
		'id'=>'subunit-grid',
		'type'=>'striped bordered condensed',
		'dataProvider'=>$model->search(),
		'filter'=>$model,
		'columns'=>array(
			'nama',
			'id_unit',
			array(
				'class'=>'booster.widgets.TbButtonColumn',
			),
		),
)); ?>
