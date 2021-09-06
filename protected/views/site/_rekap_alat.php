<?php

$model = new Barang;

$allBarangKategori = BarangKategori::model()->findAll();

?>

<div class="row">

    <?php foreach($allBarangKategori as $barangKategori) { ?>
    <div class="col-md-4">
        <a href="<?php print Yii::app()->controller->createUrl("/barang/admin",["Barang[kode]" => $barangKategori->kode]); ?>" data-toggle="tooltip" title="<?= $barangKategori->nama; ?>">
            <div class='rekap-alat'>
                <?= $barangKategori->nama; ?>
                (<?= $model->getCountByJenis($barangKategori->kode); ?>)
            </div>
        </a>
    </div>
    <?php } ?>

</div>
