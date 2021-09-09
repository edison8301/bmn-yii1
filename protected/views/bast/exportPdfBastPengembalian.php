<!DOCTYPE html>
<html>
<head>
    <title>Hi</title>
</head>
<body>
<hr>
<p style="text-align: center; line-height: 0.5;"><b>BERITA ACARA SERAH TERIMA PENGEMBALIAN</b></p>
<p style="text-align: center; line-height: 0.5;">Nomor: {{$model->bastno}}</p>
<p>Pada hari ini {{$model->hari}},
    tanggal {{Helper::getTerbilang(date('d', strtotime($model->tanggal))) }}
    bulan {{ Helper::getBulanLengkap(date('m', strtotime($model->tanggal))) }}
    tahun {{ Helper::getTerbilang(date('Y', strtotime($model->tanggal))) }}
    ( {{date('d-m-Y', strtotime($model->tanggal))}} )

    kami yang bertandatangan dibawah ini:</p>
<ul style="list-style-type: none;">
    <li>Nama : {{ $model->nama1 }}</li>
    <li>NIP : {{ $model->nip1 }}</li>
    <li>Jabatan : {{ $model->jabatan1 }}</li>
    <li>Alamat : Jalan Veteran Nomor 10 Jakarta Pusat</li>
</ul>
<p>Selanjutnya disebut sebagai PIHAK PERTAMA.</p>
<ul style="list-style-type: none;">
    <li>Nama : {{ $model->nama2 }}</li>
    <li>NIP : {{ $model->nip2 }}</li>
    <li>Jabatan : {{ $model->jabatan2 }}</li>
    <li>Alamat : Jalan Veteran Nomor 10 Jakarta Pusat</li>
</ul>
<p>Selanjutnya disebut sebagai PIHAK KEDUA.</p>


<p>Dengan ini menyatakan bahwa PIHAK PERTAMA menyerahkan kepada PIHAK KEDUA,
    dan PIHAK KEDUA telah menerima penyerahan dari PIHAK PERTAMA untuk
    pengembalian {{ $model->jumlah }} ({{Helper::getTerbilang($model->jumlah)}}) unit BMN LAN berupa {{ $model->namabarang }}
    dengan spesifikasi :</p>
<ul style="list-style-type: none;">
    <li>Merk / Type	: {{ $model->merek }} </li>
    <li>Tahun Perolehan :  {{ $model->perolehan }} </li>
    <li>Kode Barang dan NUP	: {{ $model->nup }} </li>
</ul>
<p>Dengan ketentuan sebagai berikut :</p>
<ol>
    <li>Dengan adanya Berita Acara Pengembalian ini maka PIHAK PERTAMA telah selesai dalam pemanfaatan BMN tersebut.</li>
    <li>BMN dikembalikan dalam kondisi lengkap.</li>
</ol>
<p>Demikian Berita Acara ini dibuat dan ditandatangani untuk dapat dipergunakan sebagaimana mestinya.</p>
<br>
<br>
<p>PIHAK KEDUA <span style="display:inline-block; width:360px;"></span> PIHAK PERTAMA </p>
<br>
<p>NIP. {{$model->nip2 }} <span style="display:inline-block; width:340px;"></span> NIP. {{$model->nip1}}</p>



<p style="text-align: center; line-height: 0.5;"><b>Kelengkapan Barang</b></p>

<table style="border: 2px solid black;border-collapse:collapse;">
    <thead>
    <tr >
        <th style="border: 2px solid black;">No.</th>
        <th style="border: 2px solid black;">Uraian</th>
        <th style="border: 2px solid black;">NUP: {{$model->nup}}</th>
    </tr>
    </thead>
    <tbody>

    </tbody>

</table>

<p><span style="display:inline-block; width:460px;"></span>Jakarta, ..................</p>
<p>PIHAK KEDUA <span style="display:inline-block; width:360px;"></span> PIHAK PERTAMA </p>
<br>
<p>NIP. {{$model->nip2 }} <span style="display:inline-block; width:340px;"></span> NIP. {{$model->nip1}}</p>
</body>
</html>