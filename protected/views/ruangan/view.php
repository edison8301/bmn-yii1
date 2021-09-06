<?php
/* @var $this LokasiController */
/* @var $model Lokasi */

$this->breadcrumbs=array(
	'Ruangan' => array('admin'),
	$model->nama,
);

$this->menu=array(
	array('label'=>'List Lokasi', 'url'=>array('index')),
	array('label'=>'Create Lokasi', 'url'=>array('create')),
	array('label'=>'Update Lokasi', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Lokasi', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Lokasi', 'url'=>array('admin')),
);
?>

<h1><?php echo $model->nama; ?></h1>


<div>&nbsp;</div>


<?php $this->widget('booster.widgets.TbDetailView', array(
	'data'=>$model,
	'type' => 'striped bordered condensed',
	'attributes'=>array(
		'kode',
		'nama',
	),
)); ?>

<div>&nbsp;</div> 

<div class="well">
<?php $this->widget('booster.widgets.TbButton',array(
		'buttonType'=>'link',
		'label'=>'Update',
		'icon'=>'pencil',
		'size'=>'small',
		'context'=>'danger',
		'url'=>array('/lokasi/update','id'=>$model->id)
)); ?>&nbsp;

<?php $this->widget('booster.widgets.TbButton',array(
		'buttonType'=>'link',
		'label'=>'Tambah',
		'icon'=>'plus',
		'size'=>'small',
		'context'=>'danger',
		'url'=>array('/lokasi/create')
)); ?>&nbsp;


<?php $this->widget('booster.widgets.TbButton',array(
		'buttonType'=>'link',
		'label'=>'Kelola',
		'icon'=>'list',
		'size'=>'small',
		'context'=>'danger',
		'url'=>array('/lokasi/admin')
)); ?>&nbsp;

<?php $this->widget('booster.widgets.TbButton',array(
		'buttonType'=>'link',
		'label'=>'DBR',
		'icon'=>'list',
		'size'=>'small',
		'context'=>'success',
		'url'=>array('/lokasi/dbr','id'=>$model->id,'lokasi'=>$model->nama)
)); ?>&nbsp;
</div>

<h3>Barang</h3>

<div class="well">
	<?php $barang = new Barang; ?>
	<?php $this->renderPartial('_tambah_barang',array('model'=>$formtambah)); ?>
</div>

<table class="table table-striped table-condensed">
<thead>
<tr>
	<th>No</th>
	<th>Kode</th>
	<th>Nama</th>
	<th>Pegawai</th>
	<th>&nbsp;</th>
</tr>
</thead>

<?php  $i=1; foreach($model->findAllBarang() as $barang) { ?>
 <tr>
 	<td><?=$i ?></td>
 	<td><?= CHtml::link($barang->kode.'-'.$barang->nup,array('barang/view','id'=>$barang->id)); ?></td>
 	<td><?= $barang->nama; ?></td>
 	<td><?= $barang->getPegawai(); ?></td>
 	<td><?php echo CHtml::link('<i class="glyphicon glyphicon-trash"></i>', 
 			array('barang/hapusKepemilikanLokasi', 'id'=>$barang->id,'lokasi'=>$model->id),
  				array(
    				'class' => 'delete','confirm'=>'Apa anda yakin?'
  					)
				); ?>
	</td>

 </tr>
<?php $i++; } ?>
 </table>

<div>&nbsp;</div>

 <div class="well">

<?php $this->widget('booster.widgets.TbButton',array(
		'buttonType'=>'link',
		'label'=>'Tambah Barang',
		'icon'=>'plus',
		'size'=>'small',
		'context'=>'danger',
		'url'=>array('barang/create','id_lokasi'=>$model->id)
)); ?>

<?php $this->widget('booster.widgets.TbButton',array(
		'buttonType'=>'link',
		'label'=>'Ekspor ke Excel',
		'icon'=>'download',
		'size'=>'small',
		'context'=>'success',
		'url'=>array('barang/ExportBarang','id'=>$model->id)
)); ?>&nbsp;

 </div>