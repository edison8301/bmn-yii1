<?php
$this->breadcrumbs=array(
	'Tahun'=>array('admin'),
	'Kelola',
);
?>

<h1>Kelola Tahun</h1>

<?php $this->widget('booster.widgets.TbGridView',array(
'id'=>'tahun-grid',
'type' => 'striped bordered condensed',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		'tahun',
array(
'class'=>'booster.widgets.TbButtonColumn',
),
),
)); ?>

<div>&nbsp;</div>

<div class="well" style="text-align: right">
	<?php $this->widget('booster.widgets.TbButton',array(
		'buttonType'=>'link',
		'label'=>'Tambah',
		'icon'=>'plus',
		'size' => 'small',
		'context'=>'danger',
		'url'=>array('/tahun/create')
)); ?>&nbsp;
</div>
