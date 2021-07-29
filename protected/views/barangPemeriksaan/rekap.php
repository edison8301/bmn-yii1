
<?php if($waktu == 'hari_ini') $keterangan = 'Hari Ini'; ?>
<?php if($waktu == 'bulan_ini') $keterangan = 'Bulan Ini'; ?>
<?php if($waktu == 'tahun_ini') $keterangan = 'Tahun Ini'; ?>

<h2>Daftar Pemeriksaan Barang <?php print $keterangan; ?> </h2>


<?php $this->widget('booster.widgets.TbGridView',array(
		'id'=>'pemeriksaan-grid',
		'type' => 'striped bordered condensed',
		'dataProvider'=>$model->filterTanggal($waktu),
		'filter'=>$model,
		'columns'=>array(
			array(
				'header'=>'Kode',
				'name' => 'id_barang',
				'value' => '$data->getRelation("barang","kode")',
				'headerHtmlOptions'=>array('style'=>'text-align:center'),
				'htmlOptions'=>array('style'=>'text-align:center'),
			),
			array(
				'name' => 'id_barang',
				'value' => '$data->getRelation("barang","nama")',
				'headerHtmlOptions'=>array('style'=>'text-align:center'),
			),
			array(
				'header'=>'NUP',
				'name' => 'id_barang',
				'value' => '$data->getRelation("barang","nup")',
				'headerHtmlOptions'=>array('style'=>'width:8%;text-align:center'),
				'htmlOptions'=>array('style'=>'text-align:center'),
			),
			array(
				'name' => 'tanggal',
				'value' => 'Helper::getTanggalSingkat($data->tanggal)',
				'headerHtmlOptions'=>array('style'=>'text-align:center'),
				'htmlOptions'=>array('style'=>'text-align:center'),
			),
			array(
				'name' => 'id_barang_kondisi',
				'value' => '$data->getBarangKondisi()',
				'headerHtmlOptions'=>array('style'=>'text-align:center'),
				'htmlOptions'=>array('style'=>'text-align:center'),
				'filter'=>array('1'=>'Baik','2'=>'Rusak Ringan','3'=>'Rusak Berat')
			),
			array(
				'name' => 'id_status_lokasi',
				'value' => '$data->getBarangStatusLokasi()',
				'headerHtmlOptions'=>array('style'=>'text-align:center'),
				'htmlOptions'=>array('style'=>'text-align:center'),
				'filter'=>array('1'=>'Sesuai','2'=>'Tidak Sesuai')
			),

			'keterangan',
			array(
				'header'=>'',
				'name' => 'id_barang',
				'value' => 'CHtml::link("<i class=\"glyphicon glyphicon-search\"></i>",array("barang/view","id"=>$data->id_barang),array("data-toggle"=>"tooltip","title"=>"Detail Barang"))',
				'type'=>'raw',
				'headerHtmlOptions'=>array('style'=>'text-align:center;width:50px'),
				'htmlOptions'=>array('style'=>'text-align:center'),
				'filter'=>''
			),

			array(
				'class'=>'booster.widgets.TbButtonColumn',
			),
		),
)); ?>

<div>&nbsp;</div>

<div class="form-actions well" style="text-align:right">

	<?php $this->widget('booster.widgets.TbButton', array(
			'label'=>'Tambah',
			'context'=>'danger',
			'icon' => 'plus',
			'size'=>'small',

			'htmlOptions'=>array(
				'onClick'=>'$("#dialog").dialog("open"); return false;',
				'value'=>'add',
				'style'=>'margin-bottom:3px',
			),
	)); ?>
</div>


<?php //Simulasi Dialog
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id'=>'dialog',
    'options'=>array(
        'title'=>'Daftar Barang',
        'autoOpen'=>false,
		'minWidth'=>700,
		'modal'=>true,
    ),
));

    $this->widget('booster.widgets.TbGridView',array(
		'id'=>'pegawai-grid',
		'type'=>'striped hover condensed',
		'dataProvider'=>Barang::model()->dialog(),
		'filter'=>Barang::model(),
		'columns'=>array(
			array(
				'header'=>'No',
				'value'=>'$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize+$row+1',
				'htmlOptions'=>array(
					'style'=>'text-align:left',
				),
			),
			array(
		      	'name'=>'nama',
		      	'value'=>'$data->nama',
			),
			array(
				'name'=>'nup',
				'header'=>'NUP',
				'value'=>'$data->nup',
			),
			array(
				'name'=>'kode',
				'header'=>'Kode',
				'value'=>'$data->kode',
			),
			array(
				'header'=>'Pilih',
				'type'=>'raw',
				'value' => 'CHtml::link("(+)",array("barangPemeriksaan/create","id"=>$data->id))',
					'htmlOptions'=>array(
						'style'=>'text-align:center',
						'width'=>'30px',
						'class'=>'btn btn-xs'
					),
        	),
		),
	));
$this->endWidget('zii.widgets.jui.CJuiDialog'); //=== end CJuiDialog for mark insurer

?>
