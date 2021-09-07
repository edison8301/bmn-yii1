<?php
/* @var $this KategoriController */
/* @var $model Kategori */

$this->breadcrumbs=array(
	'Barang Kategoris'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List BarangKategori', 'url'=>array('index')),
	array('label'=>'Create BarangKategori', 'url'=>array('create')),
	array('label'=>'Update BarangKategori', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete BarangKategori', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage BarangKategori', 'url'=>array('admin')),
);
?>

<h1>Lihat Kategori Barang</h1>

<?php $this->widget('booster.widgets.TbDetailView', array(
	'data'=>$model,
    'type' => 'striped bordered',
	'attributes'=>array(
		'id',
		'nama',
		'kode',
	),
)); ?>

<div>&nbsp;</div>

<div class="well">
    <?php $this->widget('booster.widgets.TbButton',array(
        'buttonType'=>'link',
        'label'=>'Update',
        'icon'=>'pencil',
        'context'=>'danger',
        'size'=>'small',
        'url'=>array('/barangKategori/update','id'=>$model->id)
    )); ?>&nbsp;

    <?php $this->widget('booster.widgets.TbButton',array(
        'buttonType'=>'link',
        'label'=>'Kelola',
        'icon'=>'list',
        'size'=>'small',
        'context'=>'danger',
        'url'=>array('/barangKategori/admin')
    )); ?>&nbsp;
</div>