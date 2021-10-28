<?php
$this->breadcrumbs=array(
	'Pemindahan Barang'=>array('admin'),
	$model->nomor,
);

$this->menu=array(
array('label'=>'List BarangPemindahan','url'=>array('index')),
array('label'=>'Create BarangPemindahan','url'=>array('create')),
array('label'=>'Update BarangPemindahan','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete BarangPemindahan','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage BarangPemindahan','url'=>array('admin')),
);
?>

<h1>Pemindahan Barang Nomor : <b><?php echo $model->nomor; ?></b></h1>

<div>&nbsp;</div>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'type' => 'striped bordered condensed',
'attributes'=>array(
		'nomor',
		'tanggal',
		array(
			'name' => 'id_lokasi_asal',
			'value' => $model->getLokasiAsal()),
		array(
			'name' => 'id_lokasi_tujuan',
			'value' => $model->getLokasiTujuan()),
		array(
			'name' => 'id_barang_pemindahan_status',
			'value' => $model->getPemindahanStatus()),
		'waktu_disetujui',
		'waktu_dibuat',
),
)); ?>

<div>&nbsp;</div>

<?php if($model->id_barang_pemindahan_status == 2)
{ ?>

	<div class="well">
	
	<?php $this->renderPartial('_pemindahan_barang',array('model'=>$formtambah,'id_lokasi_asal'=>$model->id_lokasi_asal,'view'=>$model)); ?>
	
	</div>
<?php } ?>

<div>&nbsp;</div>


<?php if($model->id_barang_pemindahan_status == 2 OR $model->id_barang_pemindahan_status == 3 )
{ ?> 

	<div class="well" style="text-align:right">
	
	<?php if($model->id_barang_pemindahan_status == 2)
	{
		 $this->widget('booster.widgets.TbButton',array(
			'buttonType'=>'link',
			'label'=>'Ajukan Pemindahan',
			'icon'=>'ok',
			'size'=>'small',
			'context'=>'success',
			'url'=>array('barangPemindahan/status','status'=>3,'id'=>$model->id)
		)); } ?>&nbsp;
	
	<?php if($model->id_barang_pemindahan_status == 3) {
		 $this->widget('booster.widgets.TbButton',array(
			'buttonType'=>'link',
			'label'=>'Setujui',
			'icon'=>'ok',
			'size'=>'small',
			'context'=>'success',
			'url'=>array('barangPemindahan/pemindahanBarang','id'=>$model->id,'status'=>1)
		)); ?>&nbsp;	
	
	<?php 
		 $this->widget('booster.widgets.TbButton',array(
			'buttonType'=>'link',
			'label'=>'Batalkan Pemindahan',
			'icon'=>'remove',
			'size'=>'small',
			'context'=>'danger',
			'url'=>array('barangPemindahan/status','status'=>4,'id'=>$model->id)
		)); } ?>&nbsp;	

	<?php 
		 $this->widget('booster.widgets.TbButton',array(
			'buttonType'=>'link',
			'label'=>'Cetak Resi',
			'icon'=>'print',
			'size'=>'small',
			'context'=>'success',
			'htmlOptions' => array(
				'target' => '_blank'),
			'url'=>array('barangPemindahan/CetakResi','id'=>$model->id)
		)); ?>&nbsp;	

		
			
	
	</div>

<?php } ?>

<?php if ($model->id_barang_pemindahan_status == 1 )
{ ?>

	<div class="well" style="text-align:right">

	<?php 
		 $this->widget('booster.widgets.TbButton',array(
			'buttonType'=>'link',
			'label'=>'Cetak Resi',
			'icon'=>'print',
			'size'=>'small',
			'context'=>'success',
			'htmlOptions' => array(
				'target' => '_blank'),
			'url'=>array('barangPemindahan/cetakResi','id'=>$model->id)
		)); ?>&nbsp;	

	</div>	

	<div class="col-xs-12">
		<div class="alert alert-success">Selamat ! Barang anda telah dipindahkan</div>
	</div>
<?php } ?>

<?php if ($model->id_barang_pemindahan_status == 4 )
{ ?>

	<div class="col-xs-12">
		<div class="alert alert-danger">Pengajuan anda tidak diterima</div>
	</div>
<?php } ?>

<table class="table table-striped table-condensed">
	<thead>
	<tr>
		<th>No</th>
		<th>Kode</th>
		<th>NUP</th>
		<th>Nama Barang</th>
		<?php if($model->id_barang_pemindahan_status == 2)
	 	{ ?>
			<th style="text-align: center">Hapus</th>
		<?php } ?>
	</tr>
	</thead>
	
	<?php  $i=1; 
	foreach(BarangPemindahanDetail::model()->findAllByAttributes(array('id_barang_pemindahan'=>$model->id)) as $barang) {
		foreach(Barang::model()->findAllByAttributes(array('id'=>$barang->id_barang)) as $barang_atribut)
		{ ?>
			<tr>
			 	<td><?=$i ?></td>
			 	<td><?= CHtml::link($barang_atribut->kode,array('barang/view','id'=>$barang->id_barang)); ?></td>
			 	<td><?= $barang_atribut->nup ?></td>
			 	<td><?= $barang->getNamaBarang(); ?></td>
			 	<?php if($model->id_barang_pemindahan_status == 2)
			 	{ ?>

			 		<td style="text-align: center"><?php echo CHtml::link('<i class="glyphicon glyphicon-trash"></i>', 
			 				array('barangPemindahanDetail/delete', 'id'=>$barang->id),
			  					array(
			  						'submit'=>array('barangPemindahanDetail/delete', 'id'=>$barang->id,'pemindahan'=>$model->id),
			    					'class' => 'delete','confirm'=>'Apa anda yakin?'
			  						)
								); ?>
					</td>

				<?php } ?>
			
			</tr>
	<?php $i++; } } ?>
 </table>

 <div>&nbsp;</div>



