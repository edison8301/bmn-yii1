<?php

$model = new Barang;

$allBarangKategori = Kategori::model()->findAll();

$link = true;
if(User::isPegawai()) {
    $link = false;
}

?>

<div class="row">
    <?php foreach($allBarangKategori as $barangKategori) { ?>
    <div class="col-md-4">

        <?php if($link == true) { ?>
        <a href="<?php print Yii::app()->controller->createUrl("/barang/admin",["Barang[kode]" => $barangKategori->kode]); ?>" data-toggle="tooltip" title="<?= $barangKategori->nama; ?>">
        <?php } ?>

            <div class='rekap-alat'>
                <?= $barangKategori->nama; ?>
                (<?= $model->getCountByJenis($barangKategori->kode); ?>)
            </div>

        <?php if($link) { ?>
        </a>
        <?php } ?>

    </div>
    <?php } ?>

</div>
