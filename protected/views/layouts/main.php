<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
</head>

<body>

<div id="page">

<div id="header">
    <div style="padding: 10px 20px 20px 20px">
        <?php print CHtml::image(Yii::app()->baseUrl."/images/logo-kiri.png",'Logo',[
            'style' => 'height: 80px'
        ]); ?>
        <?php print CHtml::image(Yii::app()->baseUrl."/images/logo-kanan.png",'Logo',[
            'style' => 'height: 80px',
            'class' => 'pull-right'
        ]); ?>
    </div>
</div>

<div id="mainnav">
<?php $this->widget('booster.widgets.TbNavbar',array(
        'brand' => '',
        'fixed' => false,
    	'fluid' => true,
        'items' => array(
            array(
                'class' => 'booster.widgets.TbMenu',
            	'type' => 'navbar',
                'items' => array(
                    array('label' =>'Beranda', 'url' => array('site/index'), 'icon'=>'home'),
					array('label'=>'Barang','icon'=>'th','url'=>array('/barang/admin')),
					array('label'=>'Cetak QR','icon'=>'qrcode','items'=>array(
						array('label'=>'Cetak QR per NUP','icon'=>'user','url'=>array('/barang/cetakQr')),
						array('label'=>'Cetak QR per DBR','icon'=>'user','url'=>array('/barang/cetakQrcodeDbr')),
                    )),
					array('label'=>'Ruangan','icon'=>'map-marker','url'=>array('/ruangan/admin')),
					array('label'=>'Perawatan','icon'=>'wrench','url'=>array('/barangPerawatan/admin')),
					array('label'=>'Pemeriksaan','icon'=>'ok','url'=>array('/barangPemeriksaan/admin')),
					array('label'=>'Pemindahan','icon'=>'list','url'=>array('/barangPemindahan/admin')),
					array('label'=>'Pegawai','icon'=>'user','url'=>array('/pegawai/admin')),
					array('label'=>'Laporan','icon'=>'file','url'=>array('/barang/exportExcel')),
					array('label'=>'Setting','icon'=>'wrench','items'=>array(
						array('label'=>'User','icon'=>'user','url'=>array('/user/admin')),
                        array('label'=>'Kategori Barang','icon'=>'user','url'=>array('/kategori/admin')),
						array('label'=>'Tahun','icon'=>'th','url'=>array('/tahun/admin')),
						array('label'=>'Kondisi Barang','icon'=>'file','url'=>array('/barangKondisi/admin')),
                        array('label'=>'Lokasi','icon'=>'file','url'=>array('/lokasi/admin')),
						//array('label'=>'Gedung','icon'=>'file','url'=>array('/gedung/admin')),
						array('label'=>'Unit','icon'=>'file','url'=>array('/unit/admin')),
						array('label'=>'Konfigurasi','icon'=>'wrench','url'=>array('/pengaturan/detail','id'=>1)),
						array('label'=>'Subunit','icon'=>'file','url'=>array('/subunit/admin')),
					)),
					array('label' => 'Logout', 'url' => array('site/logout'), 'icon'=>'off','linkOptions'=>array('class'=>'pull-right')),

                )
            )
        )
    )
); ?>
</div>

<div id="breadcrumb" class="container">
	<div class="row">
		<div class="col-sm-12">
        	<?php if(isset($this->breadcrumbs)) {
                    $this->breadcrumbs = array_merge(array('<i class="glyphicon glyphicon-home"></i> Beranda'=>Yii::app()->homeUrl), $this->breadcrumbs);
                    $this->widget('zii.widgets.CBreadcrumbs', array(
                            'links'=>$this->breadcrumbs,
                            'homeLink'=>false,
                            'encodeLabel'=>false,
                            'htmlOptions'=>array ('class'=>'breadcrumb')
                    ));
        	} ?>
		</div>
	</div>
</div>

<div id="content" class="container">
	<div class="row">
		<div class="col-sm-12">
			<?php print $content; ?>
		</div>
	</div>
</div>

	
<div id="footer">	

</div><!-- footer -->
	
</div><!--page-->

</body>
</html>
