<div class="row">
	<div class="col-md-4">
		<a href="<?php print $this->createUrl("barangPemeriksaan/rekap",array("waktu"=>"hari_ini")); ?>" data-toggle="tooltip" title="Pemerisaan Hari Ini">
		<div class="info-box" style="background:#727CB6">
			<div class="icon pull-left"><i class="glyphicon glyphicon-ok"></i></div>
			<div class="title"> Hari Ini</div>
			<div class="content"><?php print BarangPemeriksaan::countHariIni(); ?></div>
		</div>
		</a>
	</div>
	<div class="col-md-4">
		<a href="<?php print $this->createUrl("barangPemeriksaan/rekap",array("waktu"=>"bulan_ini")); ?>" data-toggle="tooltip" title="Pemerisaan Bulan Ini">
		<div class="info-box" style="background:#00ACAC">
			<div class="icon pull-left"><i class="glyphicon glyphicon-ok"></i></div>
			<div class="title"> Bulan Ini</div>
			<div class="content"><?php print BarangPemeriksaan::countBulanIni(); ?></div>
		</div>
		</a>
	</div>
	<div class="col-md-4">
		<a href="<?php print $this->createUrl("barangPemeriksaan/rekap",array("waktu"=>"tahun_ini")); ?>" data-toggle="tooltip" title="Pemerisaan Tahun Ini">
		<div class="info-box" style="background:#348FE2">
			<div class="icon pull-left"><i class="glyphicon glyphicon-ok"></i></div>
			<div class="title"> Tahun Ini</div>
			<div class="content"><?php print BarangPemeriksaan::countTahunIni(); ?></div>
		</div>
		</a>
	</div>
</div>