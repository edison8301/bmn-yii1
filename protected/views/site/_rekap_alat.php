<?php $model = new Barang; ?>

<div class="row">

	<div class="col-md-4">
		<a href="<?php print Yii::app()->controller->createUrl("site/detailKelompok",array("id"=>'3.01')); ?>" data-toggle="tooltip" title="Alat Besar">
			<div class='rekap-alat'>Alat Besar (<?= $model->getCountByJenis('3.01'); ?>)</div>				
		</a>
		<a href="<?php print Yii::app()->controller->createUrl("site/detailKelompok",array("id"=>'3.02')); ?>" data-toggle="tooltip" title="Alat Angkutan">
			<div class='rekap-alat'>Alat Angkutan (<?= $model->getCountByJenis('3.02'); ?>)</div>				
		</a>
		<a href="<?php print Yii::app()->controller->createUrl("site/detailKelompok",array("id"=>'3.03')); ?>" data-toggle="tooltip" title="Alat Bengkel">
			<div class='rekap-alat'>Alat Bengkel & Alat Ukur (<?= $model->getCountByJenis('3.03'); ?>)</div>				
		</a>
		<a href="<?php print Yii::app()->controller->createUrl("site/detailKelompok",array("id"=>'3.05')); ?>" data-toggle="tooltip" title="Alat Kantor & Rumah Tangga">
			<div class='rekap-alat'>Alat Kantor & Alat Rumah Tangga (<?= $model->getCountByJenis('3.05'); ?>)</div>				
		</a>
		<a href="<?php print Yii::app()->controller->createUrl("site/detailKelompok",array("id"=>'3.06')); ?>" data-toggle="tooltip" title="Alat Komunikasi">
			<div class='rekap-alat'>Alat Studio, Komunikasi & Pemancar (<?= $model->getCountByJenis('3.06'); ?>)</div>
		</a>
	</div>
	<div class="col-md-4">
		<a href="<?php print Yii::app()->controller->createUrl("site/detailKelompok",array("id"=>'3.07')); ?>" data-toggle="tooltip" title="Alat Kesehatan">
			<div class='rekap-alat'>Alat Kedokteran & Kesehatan (<?= $model->getCountByJenis('3.07'); ?>)</div>
		</a>
		<a href="<?php print Yii::app()->controller->createUrl("site/detailKelompok",array("id"=>'3.10')); ?>" data-toggle="tooltip" title="Komputer">
			<div class='rekap-alat'>Komputer (<?= $model->getCountByJenis('3.10'); ?>)</div>
		</a>
		<a href="<?php print Yii::app()->controller->createUrl("site/detailKelompok",array("id"=>'3.15')); ?>" data-toggle="tooltip" title="Alat Keselamatan Kerja">
			<div class='rekap-alat'>Alat Keselamatan Kerja (<?= $model->getCountByJenis('3.15'); ?>)</div>
		</a>
		<a href="<?php print Yii::app()->controller->createUrl("site/detailKelompok",array("id"=>'3.17')); ?>" data-toggle="tooltip" title="Peralatan Produksi">
			<div class='rekap-alat'>Peralatan Proses / Produksi (<?= $model->getCountByJenis('3.17'); ?>)</div>
		</a>
		<a href="<?php print Yii::app()->controller->createUrl("site/detailKelompok",array("id"=>'3.19')); ?>" data-toggle="tooltip" title="Peralatan Olahraga">
			<div class='rekap-alat'>Peralatan Olahraga (<?= $model->getCountByJenis('3.19'); ?>)</div>
		</a>
	</div>
	<div class="col-md-4">
		<a href="<?php print Yii::app()->controller->createUrl("site/detailKelompok",array("id"=>'4.01')); ?>" data-toggle="tooltip" title="Bangunan Gedung">
			<div class='rekap-alat'>Bangunan Gedung (<?= $model->getCountByJenis('4.01'); ?>)</div>			
		</a>
		<a href="<?php print Yii::app()->controller->createUrl("site/detailKelompok",array("id"=>'4.04')); ?>" data-toggle="tooltip" title="Tugu Titik Kontrol">
			<div class='rekap-alat'>Tugu Titik Kontrol / Pasti (<?= $model->getCountByJenis('4.04'); ?>)</div>			
		</a>
		<a href="<?php print Yii::app()->controller->createUrl("site/detailKelompok",array("id"=>'5.02')); ?>" data-toggle="tooltip" title="Bangunan Air">
			<div class='rekap-alat'>Bangunan Air (<?= $model->getCountByJenis('5.02'); ?>)</div>			
		</a>
		<a href="<?php print Yii::app()->controller->createUrl("site/detailKelompok",array("id"=>'5.03')); ?>" data-toggle="tooltip" title="Instalasi">
			<div class='rekap-alat'>Instalasi (<?= $model->getCountByJenis('5.03'); ?>)</div>			
		</a>
		<a href="<?php print Yii::app()->controller->createUrl("site/detailKelompok",array("id"=>'6.01')); ?>" data-toggle="tooltip" title="Bahan Perpustakaan">
			<div class='rekap-alat'>Bahan Perpustakaan (<?= $model->getCountByJenis('6.01'); ?>)</div>			
		</a>	
	</div>


</div>
