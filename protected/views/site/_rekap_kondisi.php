<?php

$link = true;
if(User::isPegawai()) {
    $link = false;
}

?>
<div class="row">
	<div class="col-md-4">
        <?php if($link) { ?>
		    <a href="<?php print $this->createUrl("/barang/admin",['Barang[id_barang_kondisi]'=>1]); ?>" data-toggle="tooltip" title="Kondisi Barang Baik">
        <?php } ?>
		<div class="info-box" style="background:#28A745">
			<div class="icon pull-left"><i class="glyphicon glyphicon-list"></i></div>
			<div class="title"> Baik</div>
			<div class="content"><?php print Barang::countBaik(); ?></div>
		</div>
        <?php if($link) { ?>
		</a>
        <?php } ?>
	</div>
	<div class="col-md-4">
        <?php if($link) { ?>
		<a href="<?php print $this->createUrl("/barang/admin",['Barang[id_barang_kondisi]'=>2]); ?>" data-toggle="tooltip" title="Kondisi Barang Rusak Ringan">
        <?php } ?>
		<div class="info-box" style="background:#FD7E14">
			<div class="icon pull-left"><i class="glyphicon glyphicon-list"></i></div>
			<div class="title"> Rusak Ringan</div>
			<div class="content"><?php print Barang::countRusakRingan(); ?></div>
		</div>
        <?php if($link) { ?>
		</a>
        <?php } ?>
	</div>
	<div class="col-md-4">
        <?php if($link) { ?>
		<a href="<?php print $this->createUrl("barang/admin",['Barang[id_barang_kondisi]'=>3]); ?>" data-toggle="tooltip" title="Kondisi Barang Rusak Berat">
        <?php } ?>
		<div class="info-box" style="background:#DC3545">
			<div class="icon pull-left"><i class="glyphicon glyphicon-list"></i></div>
			<div class="title"> Rusak Berat</div>
			<div class="content"><?php print Barang::countRusakBerat(); ?></div>
		</div>
		</a>
	</div>
</div>