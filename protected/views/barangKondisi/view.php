<?php
/* @var $this BarangKondisiController */
/* @var $model BarangKondisi */

$this->breadcrumbs=array(
	'Kondisi Barang'=>array('admin'),
	$model->nama,
);

$this->menu=array(
	array('label'=>'List BarangKondisi', 'url'=>array('index')),
	array('label'=>'Create BarangKondisi', 'url'=>array('create')),
	array('label'=>'Update BarangKondisi', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete BarangKondisi', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage BarangKondisi', 'url'=>array('admin')),
);
?>

<h1>-<b><?php echo $model->nama; ?></b></h1>
<div> &nbsp </div>


<?php $this->widget('booster.widgets.TbDetailView', array(
	'data'=>$model,
	'type' => 'striped bordered',
	'attributes'=>array(
		'nama',
	),
)); ?>

<div>&nbsp;</div>

<div class="well">

<?php $this->widget('booster.widgets.TbButton',array(
		'buttonType'=>'link',
		'label'=>'Update',
		'icon'=>'pencil',
		'context'=>'danger',
		'url'=>array('/barangKondisi/update','id'=>$model->id)
)); ?>&nbsp;

<?php $this->widget('booster.widgets.TbButton',array(
		'buttonType'=>'link',
		'label'=>'Tambah',
		'icon'=>'plus',
		'context'=>'danger',
		'url'=>array('/lokasi/create')
)); ?>&nbsp;

<?php $this->widget('booster.widgets.TbButton',array(
		'buttonType'=>'link',
		'label'=>'Kelola',
		'icon'=>'list',
		'context'=>'danger',
		'url'=>array('/barangKondisi/admin')
)); ?>&nbsp;

</div>

