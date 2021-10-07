<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Dokumen Penggunaan</title>
	<style>
		table {
			width: 100%;
			/* border-collapse: collapse; */
			margin-bottom: 10px;
		}

		table tr td{
			padding: 0px;
		}
		p {
			margin-bottom: 0px;
		}
	</style>
</head>
<body>

<table style="border-bottom: 1px solid;">
    <tr>
        <td style="vertical-align: middle;">
            <img src="images/logo-lan.png" alt="logo-lan" style="height:70px;">
        </td>
        <td style="text-align: center;">
            <h4 style="font-weight: bold"> LEMBAGA ADMINISTRASI NEGARA<br>REPUBLIK INDONESIA</h4>
			<p class="text-center">Jalan Veteran No.10 Jakarta Pusat 10110<br> Telp. (021) 3868201-5, Fax. (021) 3868210, Website: www.lan.go.id</p>
        </td>
    </tr>
	<br>
</table>

<br>

<h4 style="font-weight: bold" class="text-center"> BERITA ACARA SERAH TERIMA PENGGUNAAN</h4>

<p class="text-center">Nomor: <?= $model->nomor; ?></p>

<p class="text-left" style="text-indent: 3em;">
    Pada hari ini <?= $model->getNamaHariFromTanggal(); ?>
    tanggal <?= $model->getTanggalByFormat('j'); ?>
    bulan <?= $model->getNamaBulanByTanggal(); ?>
    tahun <?= $model->getTanggalByFormat('Y'); ?> (<?= $model->getTanggalByFormat('d-m-Y'); ?>)
    kami yang bertandatangan dibawah ini :
</p>

<table>
	<tr>
		<td width="20px">1.</td>
		<td width="100px">Nama</td>
		<td width="10px">:</td>
		<td>
            <?= @$model->pihakPertama->nama; ?>
        </td>
	</tr>
	<tr>
		<td></td>
		<td width="100px">NIP</td>
		<td width="10px">:</td>
		<td><?= @$model->pihakPertama->nip; ?></td>
	</tr>
	<tr>
		<td></td>
		<td width="100px">Jabatan</td>
		<td width="10px">:</td>
		<td><?= $model->jabatan_pihak_pertama; ?></td>
	</tr>
	<tr>
		<td></td>
		<td colspan="3">Selanjutnya disebut sebagai PIHAK PERTAMA</td>
	</tr>
</table>

<table>
	<tr>
		<td width="20px">2.</td>
		<td width="100px">Nama</td>
		<td width="10px">:</td>
		<td>
            <?= @$model->pihakKedua->nama; ?>
        </td>
	</tr>
	<tr>
		<td></td>
		<td width="100px">NIP</td>
		<td width="10px">:</td>
		<td>
            <?= @$model->pihakKedua->nip; ?>
        </td>
	</tr>
	<tr>
		<td></td>
		<td width="100px">Jabatan</td>
		<td width="10px">:</td>
		<td><?= $model->jabatan_pihak_kedua; ?></td>
	</tr>
	<tr>
		<td></td>
		<td colspan="3">Selanjutnya disebut sebagai PIHAK KEDUA</td>
	</tr>
</table>

<p class="lh-sm" style="text-align:justify; text-indent: 3em;">
Dengan ini menyatakan bahwa PIHAK PERTAMA menyerahkan kepada PIHAK KEDUA, dan PIHAK KEDUA telah menerima penyerahan dari PIHAK PERTAMA untuk penggunaan <?= @$barang->merek; ?> (<?= @$model->jumlah_unit; ?>) unit BMN LAN berupa <?= @$barang->merek; ?> dengan spesifikasi :
</p>

<br>

<table>
	<tr>
		<td width="40px"></td>
		<td width="100px">Merk / Type</td>
		<td width="10px">:</td>
		<td><?= @$barang->merek; ?></td>
	</tr>
	<tr>
		<td width="40px"></td>
		<td width="100px">Perolehan</td>
		<td width="10px">:</td>
		<td><?=  @$barang->tanggal_perolehan; ?></td>
	</tr>
	<tr>
		<td width="40px"></td>
		<td width="100px">Nilai Perolehan</td>
		<td width="10px">:</td>
		<td>Rp. <?= Helper::rp(@$barang->nilai_perolehan,0); ?></td>
	</tr>
	<tr>
		<td width="40px"></td>
		<td width="100px">Kode Barang dan NUP</td>
		<td width="10px">:</td>
		<td><?= @$barang->kode; ?>-<?= @$barang->nup; ?></td>
	</tr>
</table>

<p class="lh-sm">Dengan ketentuan sebagai berikut :</p>

<ol>
	<li class="lh-sm" style="text-align:justify;">
		Dengan adanya Berita Acara ini maka pemanfaatan dan pengamanan atas barang-barang tersebut menjadi tanggungjawab PIHAK KEDUA. 
	</li>
	<li class="lh-sm" style="text-align:justify;">
		BMN ini digunakan untuk operasional kegiatan dinas.
	</li>
	<li class="lh-sm" style="text-align:justify;">
		Pihak Kedua bersedia mengganti barang tersebut apabila terjadi kerusakan dan kehilangan akibat kelalaian Pihak Kedua dalam waktu paling lambat 1 bulan setelah terjadinya kerusakan/kehilangan tersebut.
	</li>
	<li class="lh-sm" style="text-align:justify;">
		Apabila tidak menjabat lagi sebagai <?= @$model->jabatan_pihak_kedua; ?>  , wajib mengembalikan kepada PIHAK PERTAMA cq. Bagian Umum dan Layanan Pengadaan paling lambat 1.
	</li>
	<li class="lh-sm" style="text-align:justify;">
		Label kode NUP barang (nomor registrasi) tidak boleh dilepas dari notebook.
	</li>
</ol>

<p class="lh-sm" style="text-align: justify; text-indent: 3em;">
Demikian Berita Acara ini dibuat dan ditandatangani untuk dapat dipergunakan sebagaimana mestinya.
</p>

<div>&nbsp;</div>

<table cellspacing="0" cellpadding="0" width="80%">
    <tr>
        <td style="text-align: center; width: 30%">PIHAK KEDUA</td>
        <td></td>
        <td style="text-align: center; ; width: 30%">PIHAK PERTAMA</td>
    </tr>
    <?php for($i=1; $i<=5; $i++) { ?>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <?php } ?>
    <tr>
        <td style="text-align: center">
            <?= $model->pihakKedua->nama; ?><br>
            NIP <?=$model->pihakKedua->nip; ?>
        </td>
        <td></td>
        <td style="text-align: center;width: 100px;">
            <?= $model->pihakPertama->nama; ?><br>
            NIP <?=$model->pihakPertama->nip; ?>
        </td>
    </tr>
</table>

<div style="page-break-after: always;"></div>

<div style="text-align: center;">
	<h4 style="font-weight: bold">Kelengkapan Barang</h4>
	<br>

	<table border="1">
		<tr class="text-center">
			<th align="center" rowspan="2" width="10px">No</th>
			<th align="center" rowspan="2">Uraian</th>
			<th align="center" colspan="2">Nup : .....</th>
		</tr>
		<tr class="text-center">
			<th align="center">Ada</th>
			<th align="center">Ada</th>
		</tr>
		<tr>
			<td align="center">1</td>
			<td align="center">NoteBook</td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td align="center">2</td>
			<td align="center">Charger + Kabel dsb </td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td align="center">3</td>
			<td align="center">Tas Barang</td>
			<td></td>
			<td></td>
		</tr>
	</table>

	<p style="text-align: right">Jakarta, <?= $model->getTanggalByFormat('d-m-Y'); ?></p>

</div>

    <table cellspacing="0" cellpadding="0" width="80%" align="center">
        <tr>
            <td style="text-align: center">PIHAK KEDUA</td>
            <td width="40%"></td>
            <td style="text-align: center">PIHAK PERTAMA</td>
        </tr>
        <?php for($i=1; $i<=5; $i++) { ?>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
        <?php } ?>
        <tr>
            <td style="text-align: center">
                <?= $model->pihakKedua->nama; ?><br>
                NIP <?=$model->pihakKedua->nip; ?>
            </td>
            <td></td>
            <td style="text-align: center">
                <?= $model->pihakPertama->nama; ?><br>
                NIP <?=$model->pihakPertama->nip; ?>
            </td>
        </tr>
    </table>
</body>
</html>