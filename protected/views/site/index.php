<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<h1 style="font-size: 28px !important;">
    Selamat Datang di Aplikasi Sistem Inventarisasi dan Manajemen Penggunaan Aset Tetap Internal Kantor (SIMPATIK)
</h1>

<hr>

<h3>Barang Per Kelompok</h3>

<?php $this->renderPartial('_rekap_alat'); ?>

<h3>Perawatan</h3>

<?php $this->renderPartial('_rekap_perawatan'); ?>

<h3>Pemeriksaan</h3>

<?php $this->renderPartial('_rekap_pemeriksaan'); ?>

<h3>Kondisi</h3>

<?php $this->renderPartial('_rekap_kondisi'); ?>

<div>&nbsp;</div>

<div class="row">
	<div class="col-md-6">
		<?php $this->widget('booster.widgets.TbPanel',array(
        		'title' => 'Perawatan',
        		'context'=>'primary',
        		'headerIcon' => 'wrench',
        		'content' => $this->renderPartial('_grafik_perawatan',array(),true)
    	)); ?>
    </div>
    <div class="col-md-6">
		<?php $this->widget('booster.widgets.TbPanel',array(
        		'title' => 'Pemeriksaan',
        		'context' => 'primary',
        		'headerIcon' => 'ok',
        		'content' => $this->renderPartial('_grafik_pemeriksaan',array(),true)
    	)); ?>
    </div>
</div>

