<?php

$link = true;
if(User::isPegawai()) {
    $link = false;
}

?>
<div class="row">
	<div class="col-md-4">
        <?php if($link) { ?>
		<a href="<?php print $this->createUrl("barangPerawatan/rekap",array("waktu"=>"hari_ini")); ?>" data-toggle="tooltip" title="Perawatan Hari Ini">
        <?php } ?>
		<div class="info-box" style="background:#348FE2">
			<div class="icon pull-left"><i class="glyphicon glyphicon-wrench"></i></div>
			<div class="title"> Hari Ini</div>
			<div class="content"><?php print BarangPerawatan::countHariIni(); ?></div>
		</div>
        <?php if($link) { ?>
            </a>
        <?php } ?>
	</div>
	<div class="col-md-4">
        <?php if($link) { ?>
		<a href="<?php print $this->createUrl("barangPerawatan/rekap",array("waktu"=>"bulan_ini")); ?>" data-toggle="tooltip" title="Perawatan Bulan Ini">
        <?php } ?>
		<div class="info-box" style="background:#D9534F">
			<div class="icon pull-left"><i class="glyphicon glyphicon-wrench"></i></div>
			<div class="title"> Bulan Ini</div>
			<div class="content"><?php print BarangPerawatan::countBulanIni(); ?></div>
		</div>
        <?php if($link) { ?>
		</a>
        <?php } ?>
	</div>
	<div class="col-md-4">
        <?php if($link) { ?>
		<a href="<?php print $this->createUrl("barangPerawatan/rekap",array("waktu"=>"tahun_ini")); ?>" data-toggle="tooltip" title="Perawatan Tahun Ini">
        <?php } ?>
		<div class="info-box" style="background:#00ACAC">
			<div class="icon pull-left"><i class="glyphicon glyphicon-wrench"></i></div>
			<div class="title"> Tahun Ini</div>
			<div class="content"><?php print BarangPerawatan::countTahunIni(); ?></div>
		</div>
        <?php if($link) { ?>
		    </a>
        <?php } ?>
	</div>
</div>