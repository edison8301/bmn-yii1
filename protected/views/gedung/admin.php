<?php
$this->breadcrumbs=array(
	'Gedung'=>array('admin'),
	'Kelola',
);
?>

<h1>Kelola Gedung</h1>

<?php $this->widget('booster.widgets.TbGridView',array(
'id'=>'gedung-grid',
'type' => 'striped bordered condensed',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		'nama',
array(
'class'=>'booster.widgets.TbButtonColumn',
),
),
)); ?>

<div>&nbsp;</div>
<div class="well">
<?php $this->widget('booster.widgets.TbButton',array(
		'buttonType'=>'link',
		'label'=>'Tambah',
		'icon'=>'plus',
		'context'=>'danger',
		'url'=>array('create')
)); ?>&nbsp;

</div>