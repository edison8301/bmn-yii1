<?php $model = new Barang; ?>

<div class="row">

	<div class="col-md-4">
		<a href="<?php print Yii::app()->controller->createUrl("site/detailKelompok",array("id"=>301)); ?>" data-toggle="tooltip" title="Alat Besar">
			<div class='rekap-alat'>Alat Besar (<?= $model->getCountByJenis(301); ?>)</div>				
		</a>
		<a href="<?php print Yii::app()->controller->createUrl("site/detailKelompok",array("id"=>302)); ?>" data-toggle="tooltip" title="Alat Angkutan">
			<div class='rekap-alat'>Alat Angkutan (<?= $model->getCountByJenis(302); ?>)</div>				
		</a>
		<a href="<?php print Yii::app()->controller->createUrl("site/detailKelompok",array("id"=>303)); ?>" data-toggle="tooltip" title="Alat Bengkel">
			<div class='rekap-alat'>Alat Bengkel & Alat Ukur (<?= $model->getCountByJenis(303); ?>)</div>				
		</a>
		<a href="<?php print Yii::app()->controller->createUrl("site/detailKelompok",array("id"=>305)); ?>" data-toggle="tooltip" title="Alat Kantor & Rumah Tangga">
			<div class='rekap-alat'>Alat Kantor & Alat Rumah Tangga (<?= $model->getCountByJenis(305); ?>)</div>				
		</a>
		<a href="<?php print Yii::app()->controller->createUrl("site/detailKelompok",array("id"=>306)); ?>" data-toggle="tooltip" title="Alat Komunikasi">
			<div class='rekap-alat'>Alat Studio, Komunikasi & Pemancar (<?= $model->getCountByJenis(306); ?>)</div>
		</a>
	</div>
	<div class="col-md-4">
		<a href="<?php print Yii::app()->controller->createUrl("site/detailKelompok",array("id"=>307)); ?>" data-toggle="tooltip" title="Alat Kesehatan">
			<div class='rekap-alat'>Alat Kedokteran & Kesehatan (<?= $model->getCountByJenis(307); ?>)</div>
		</a>
		<a href="<?php print Yii::app()->controller->createUrl("site/detailKelompok",array("id"=>310)); ?>" data-toggle="tooltip" title="Komputer">
			<div class='rekap-alat'>Komputer (<?= $model->getCountByJenis(310); ?>)</div>
		</a>
		<a href="<?php print Yii::app()->controller->createUrl("site/detailKelompok",array("id"=>315)); ?>" data-toggle="tooltip" title="Alat Keselamatan Kerja">
			<div class='rekap-alat'>Alat Keselamatan Kerja (<?= $model->getCountByJenis(315); ?>)</div>
		</a>
		<a href="<?php print Yii::app()->controller->createUrl("site/detailKelompok",array("id"=>317)); ?>" data-toggle="tooltip" title="Peralatan Produksi">
			<div class='rekap-alat'>Peralatan Proses / Produksi (<?= $model->getCountByJenis(317); ?>)</div>
		</a>
		<a href="<?php print Yii::app()->controller->createUrl("site/detailKelompok",array("id"=>319)); ?>" data-toggle="tooltip" title="Peralatan Olahraga">
			<div class='rekap-alat'>Peralatan Olahraga (<?= $model->getCountByJenis(319); ?>)</div>
		</a>
	</div>
	<div class="col-md-4">
		<a href="<?php print Yii::app()->controller->createUrl("site/detailKelompok",array("id"=>401)); ?>" data-toggle="tooltip" title="Bangunan Gedung">
			<div class='rekap-alat'>Bangunan Gedung (<?= $model->getCountByJenis(401); ?>)</div>			
		</a>
		<a href="<?php print Yii::app()->controller->createUrl("site/detailKelompok",array("id"=>404)); ?>" data-toggle="tooltip" title="Tugu Titik Kontrol">
			<div class='rekap-alat'>Tugu Titik Kontrol / Pasti (<?= $model->getCountByJenis(404); ?>)</div>			
		</a>
		<a href="<?php print Yii::app()->controller->createUrl("site/detailKelompok",array("id"=>502)); ?>" data-toggle="tooltip" title="Bangunan Air">
			<div class='rekap-alat'>Bangunan Air (<?= $model->getCountByJenis(502); ?>)</div>			
		</a>
		<a href="<?php print Yii::app()->controller->createUrl("site/detailKelompok",array("id"=>503)); ?>" data-toggle="tooltip" title="Instalasi">
			<div class='rekap-alat'>Instalasi (<?= $model->getCountByJenis(503); ?>)</div>			
		</a>
		<a href="<?php print Yii::app()->controller->createUrl("site/detailKelompok",array("id"=>601)); ?>" data-toggle="tooltip" title="Bahan Perpustakaan">
			<div class='rekap-alat'>Bahan Perpustakaan (<?= $model->getCountByJenis(601); ?>)</div>			
		</a>	
	</div>


</div>
