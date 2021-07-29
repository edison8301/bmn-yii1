<?php
/* @var $this BarangController */
/* @var $model Barang */

$this->breadcrumbs=array(
	'Barang'=>array('admin'),
	$model->kode.'-'.$model->nup.'-'.$model->nama,
);
?>

<h1><?php echo $model->nama; ?></h1>

<div class="row">
	<div class="col-sm-8">
		<?php $this->widget('booster.widgets.TbDetailView', array(
				'data'=>$model,
				'type' => 'striped bordered condensed',
				'attributes'=>array(
					'kode',
					'nama',
					'nup',
					array(
						'label'=>'Tahun Perolehan',
						'value'=>Helper::getTanggalSingkat($model->tahun_perolehan)
					),
					'asal_perolehan',
					'bukti_perolehan',
					'masa_manfaat',
					'merek',
					array(
						'label'=>'Harga',
						'value'=>'Rp '.number_format($model->harga,0,',','.')
					),
					array(
						'label'=>'Kondisi Barang',
						'value'=>$model->getBarangKondisi()
					),
					'sk_psp',
					'sk_penghapusan',
					array(
						'label'=> 'Lokasi',
						'value' => $model->GetLokasi()
					),
					array(
						'label'=> 'Gambar',
						'type'=>'raw',
						'value'=> $model->getGambar()
					),
					array(
						'label' => 'Pegawai',
						'value' => $model->getPegawai()
					),
					array(
						'label'=>'Perawatan Terkahir',
						'value'=>Helper::getTanggal($model->perawatan_terakhir)
					),
					array(
						'label'=>'Pemeriksaan Terkahir',
						'value'=>Helper::getTanggal($model->pemeriksaan_terakhir)
					),
					'waktu_diubah',
					'waktu_dibuat',
				),
			)); ?>
	</div>
	<div class="col-sm-4">
		<?php $this->widget('application.extensions.qrcode.QRCodeGenerator',array(
    		'data' => $model->id.'-'.$model->kode.'-'.$model->nup,
    		'subfolderVar' => false,
    		'matrixPointSize' => 5,
    		'displayImage'=>true, // default to true, if set to false display a URL path
    		'errorCorrectionLevel'=>'L', // available parameter is L,M,Q,H
    		'matrixPointSize'=>4, // 1 to 10 only
		)) ?>&nbsp;
	</div>
</div>

<div>&nbsp;</div>

<div class="well">

	<?php $this->widget('booster.widgets.TbButton',array(
			'buttonType'=>'link',
			'label'=>'Sunting',
			'icon'=>'pencil',
			'size'=>'small',
			'context'=>'danger',
			'url'=>array('/barang/update','id'=>$model->id)
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
			'label'=>'Perawatan',
			'icon'=>'wrench',
			'size'=>'small',
			'context'=>'danger',
			'url'=>array('/barangPerawatan/create','id'=>$model->id)
	)); ?>&nbsp;
	<?php $this->widget('booster.widgets.TbButton',array(
			'buttonType'=>'link',
			'label'=>'Pemeriksaan',
			'icon'=>'ok',
			'size'=>'small',
			'context'=>'danger',
			'url'=>array('/barangPemeriksaan/create','id'=>$model->id)
	)); ?>&nbsp;

	<?php $this->widget('booster.widgets.TbButton',array(
			'buttonType'=>'link',
			'label'=>'Kelola',
			'icon'=>'list',
			'size'=>'small',
			'context'=>'danger',
			'url'=>array('/barang/admin')
	)); ?>&nbsp;

</div>

<div>&nbsp;</div>

<?php $this->widget('booster.widgets.TbTabs',array(
    	'type' => 'tabs',
		'tabs'=> array(
            array(
                'label' => 'Perawatan',
                'content' => $this->renderPartial('_perawatan',array('model'=>$model),true),
                 'active' => True
            ),
            array(
                'label' => 'Pemeriksaan',
                'content' => $this->renderPartial('_pemeriksaan',array('model'=>$model),true),

            ),
  		)
)); ?>
