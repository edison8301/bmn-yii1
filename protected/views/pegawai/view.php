<?php
/* @var $this PegawaiController */
/* @var $model Pegawai */

$this->breadcrumbs=array(
	'Pegawai'=>array('admin'),
	$model->nama,
);
?>

<h1><?php echo $model->nama; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView', array(
	'data'=>$model,
	'type' => 'striped bordered',
	'attributes'=>array(
		'nama',
		'nip',
		'username',
		'email',
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
		'url'=>array('/pegawai/update','id'=>$model->id)
		)); ?>&nbsp;

<?php $this->widget('booster.widgets.TbButton',array(
		'buttonType'=>'link',
		'label'=>'Kelola',
		'icon'=>'list',
		'size'=>'small',
		'context'=>'danger',
		'url'=>array('/pegawai/admin')
		)); ?>&nbsp;

<?php $this->widget('booster.widgets.TbButton',array(
		'buttonType'=>'link',
		'label'=>'Ekspor ke Excel',
		'icon'=>'download',
		'context'=>'success',
		'size'=>'small',
		'url'=>array('barang/exportBarang','id'=>$model->id)
)); ?>&nbsp;
</div>

<h3>Barang Pegawai Terkait</h3>

<div class="well">

<?php $barang = new Barang; ?>

<?php $this->renderPartial('_tambah_barang',array('model'=>$formtambah)); ?>

</div>

<table class="table table-striped table-condensed">
<thead>
<tr>
	<th style="width:5%;text-align:center">No</th>
	<th style="width:15%;">Kode</th>
	<th style="width:35%;">Nama</th>
	<th style="width:30%;">Lokasi</th>
	<th style="width:5%;">&nbsp;</th>
</tr>
</thead>

<?php  $i=1; foreach($model->findAllBarang() as $barang) { ?>
 <tr>
 	<td style="text-align:center"><?= $i ?></td>
 	<td><?= CHtml::link($barang->kode.'-'.$barang->nup,array('barang/view','id'=>$barang->id)); ?></td>
 	<td><?= $barang->nama; ?></td>
 	<td><?= $barang->lokasi; ?></td>
 	<td>
 		<?php echo CHtml::link('<i class="glyphicon glyphicon-trash"></i>', array('barang/hapusKepemilikanPegawai', 'id'=>$barang->id,'pegawai'=>$model->id),array('class' => 'delete','confirm'=>'Apa anda yakin?')); ?>
	</td>

 </tr>
<?php $i++; } ?>
 </table>