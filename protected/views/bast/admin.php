<?php
/* @var $this BastController */
/* @var $model Bast */


$this->breadcrumbs=array(
	'BAST'=>array('admin'),
	'Kelola BAST',
);
?>

<h1>Kelola BAST</h1>

<div class="row">
	<div class="col-sm-12">
		<?php print CHtml::beginForm(array('admin'),'GET',['class'=>'form-inline']); ?>

    	<?php print CHtml::dropDownList('paging',$paging,[10=>10,20=>20,30=>30,50=>50,100=>100],['class'=>'form-control','style'=>'margin-bottom:3px','empty'=>'- Pilih Banyak Data -']); ?>

    	<?php $this->widget('booster.widgets.TbButton',array(
		'buttonType'=>'submit',
		'label'=>'Tampilkan',
		'htmlOptions' => ['class' => 'btn-flat','style'=>'margin-bottom:3px'],
		'context'=>'primary',
		'icon'=>'search'
    	)); ?>

    <?php print CHtml::endForm(); ?>
	</div>
</div>

<?php $this->widget('booster.widgets.TbGridView', array(
	'id'=>'bast-grid',
	'pager' => array(
		'class' => 'CLinkPager', 
		'header' => '',
		'htmlOptions'=>[
			'class'=>'pagination',
		]),
	'dataProvider'=>$model->search($paging),
	'type'=>'striped bordered condensed',
	'filter'=>$model,
	'enablePagination' => true,
	'columns'=>array(
		array(
            'header' => 'No',
            'value'=>'$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1',
            'htmlOptions' => array('style'=>'text-align:center; width: 50px'),
        ),
		array(
			'name'=>'nomor',
			'headerHtmlOptions' => array('width' => '120px','style'=>'text-align:center'),
		),
		array(
			'name' => 'tanggal',
			'value' => function($data) {
			    return Helper::getTanggalSingkat($data->tanggal);
			},
			'headerHtmlOptions' => array('width' =>'120px','style'=>'text-align:center'),
			'htmlOptions' => array('style'=>'text-align:center'),
		),
		array(
			'name' => 'id_pegawai_pihak_pertama',
			'value' => function($data) {
			    return @$data->pihakPertama->nama;
			},
			'headerHtmlOptions' => array('style'=>'text-align:center'),
			'htmlOptions' => array('style'=>'text-align:left'),
		),
		array(
			'name' => 'jabatan_pihak_pertama',
			'value' => function($data) {
			    return @$data->jabatan_pihak_pertama;
			},
			'headerHtmlOptions' => array('style'=>'text-align:center'),
			'htmlOptions' => array('style'=>'text-align:left'),
		),
		array(
			'name' => 'id_pegawai_pihak_kedua',
			'value' => function($data) {
			    return @$data->pihakKedua->nama;
			},
			'headerHtmlOptions' => array('style'=>'text-align:center'),
			'htmlOptions' => array('style'=>'text-align:left'),
		),
		array(
			'name' => 'jabatan_pihak_kedua',
			'value' => function($data) {
			    return @$data->jabatan_pihak_kedua;
			},
			'headerHtmlOptions' => array('style'=>'text-align:center'),
			'htmlOptions' => array('style'=>'text-align:left'),
		),
        array(
            'name' => 'kode_barang',
            'value' => function($data) {
                return @$data->kode_barang;
            },
            'headerHtmlOptions' => array('style'=>'text-align:center'),
            'htmlOptions' => array('style'=>'text-align:left'),
        ),
        array(
            'name' => 'nup_barang',
            'value' => function($data) {
                return @$data->nup_barang;
            },
            'headerHtmlOptions' => array('style'=>'text-align:center'),
            'htmlOptions' => array('style'=>'text-align:left'),
        ),
		// array(
		// 	'name' => 'id_barang',
		// 	'value' => function($data) {
		// 	    $barang = $data->getBarang();
		// 	    return @$barang->nama;
		// 	},
		// 	'headerHtmlOptions' => array('style'=>'text-align:center'),
		// 	'htmlOptions' => array('style'=>'text-align:left'),
		// ),
		array(
            'name' => 'id_barang',
            'value' => function($data) {
                return @$data->barang->nama;
            },
            'headerHtmlOptions' => array('style'=>'text-align:center'),
            'htmlOptions' => array('style'=>'text-align:left'),
        ),
		array(
			'name' => 'jumlah_unit',
			'value' => function($data) {
			    return @$data->jumlah_unit;
			},
			'headerHtmlOptions' => array('style'=>'text-align:center'),
			'htmlOptions' => array('style'=>'text-align:left'),
		),
		array(
			'header' => 'Jenis BAST',
            'name' => 'id_bast_jenis',
            'value' => function($data) {
               return @$data->getJenisBast();
            },
            'headerHtmlOptions' => array('style'=>'text-align:center'),
            'htmlOptions' => array('style'=>'text-align:left'),
        ),
		/*
		'jumlah',
		'status_bast',
		'id_jenis_bast',
		'created_at',
		'updated_at',
		'deleted_at',
		*/
		array(
			'type'=>'raw',
			'value' => function($data) {
                if ($data->id_bast_jenis == 1){
                	return CHtml::link("<i class=\"glyphicon glyphicon-export\"></i>",array("bast/exportPdfBast","id"=>"$data->id"),array("target" => "_blank","data-toggle"=>"tooltip","title"=>"Cetak BAST"));
                }else{
                	return CHtml::link("<i class=\"glyphicon glyphicon-export\"></i>",array("bast/exportPdfBastPengembalian","id"=>"$data->id"),array("target" => "_blank","data-toggle"=>"tooltip","title"=>"Cetak BAST"));
                }
            },
			'htmlOptions'=>array('style'=>'text-align:center; width: 50px'),
		),
		array(
			'class'=>'booster.widgets.TbButtonColumn',
			'htmlOptions' => array(
				'style' => 'width: 60px;text-align:center')
		),
	),
)); ?>

<div>&nbsp;</div>

<div class="well" style="text-align:right">
<?php $this->widget('booster.widgets.TbButton',array(
		'buttonType'=>'link',
		'label'=>'Tambah',
		'icon'=>'plus',
		'size'=>'small',
		'context'=>'danger',
		'url'=>array('bast/create')
)); ?>&nbsp;
</div>