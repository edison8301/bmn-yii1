<div class="row">
	<div class="col-md-4">
		<a href="<?php print $this->createUrl("barang/kondisi",array("kondisi"=>"baik")); ?>" data-toggle="tooltip" title="Kondisi Barang Baik">
		<div class="info-box" style="background:#00ACAC">
			<div class="icon pull-left"><i class="glyphicon glyphicon-list"></i></div>
			<div class="title"> Baik</div>
			<div class="content"><?php print Barang::countBaik(); ?></div>
		</div>
		</a>
	</div>
	<div class="col-md-4">
		<a href="<?php print $this->createUrl("barang/kondisi",array("kondisi"=>"rusak-ringan")); ?>" data-toggle="tooltip" title="Kondisi Barang Rusak Ringan">
		<div class="info-box" style="background:#E8CB10">
			<div class="icon pull-left"><i class="glyphicon glyphicon-list"></i></div>
			<div class="title"> Rusak Ringan</div>
			<div class="content"><?php print Barang::countRusakRingan(); ?></div>
		</div>
		</a>
	</div>
	<div class="col-md-4">
		<a href="<?php print $this->createUrl("barang/kondisi",array("kondisi"=>"rusak-berat")); ?>" data-toggle="tooltip" title="Kondisi Barang Rusak Berat">
		<div class="info-box" style="background:#D9534F">
			<div class="icon pull-left"><i class="glyphicon glyphicon-list"></i></div>
			<div class="title"> Rusak Berat</div>
			<div class="content"><?php print Barang::countRusakBerat(); ?></div>
		</div>
		</a>
	</div>
</div>