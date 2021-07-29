<?php
/* @var $this PegawaiController */
/* @var $model Pegawai */

$this->breadcrumbs=array(
	'Pegawai'=>array('admin'),
	'Kelola',
);

?>

<h1>Kelola Pegawai</h1>

<?php $this->widget('booster.widgets.TbGridView', array(
	'id'=>'pegawai-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered condensed',
	'filter'=>$model,
	'columns'=>array(
		'nama',
		'nip',
		'username',
		'email',
		array(
			'class'=>'booster.widgets.TbButtonColumn',
			'htmlOptions' => array(
				'style' => 'width: 80px;')
		),
	),
)); ?>


<div>&nbsp;</div>

<div class="well" style="text-align: right">
<?php $this->widget('booster.widgets.TbButton',array(
		'buttonType'=>'link',
		'label'=>'Tambah',
		'icon'=>'plus',
		'size'=>'small',
		'context'=>'danger',
		'url'=>array('pegawai/create')
)); ?>&nbsp;
</div>
