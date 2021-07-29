<?php
/* @var $this BarangController */
/* @var $dataProvider CActiveDataProvider */

if(isset($_GET['kondisi'])) 
{ 
	$id_kondisi = 1;
	$kondisi = '';
	if($_GET['kondisi']=='baik')
	{
		$kondisi = 'Baik';
		$id_kondisi = 1;
	}
	
	if($_GET['kondisi']=='rusak-ringan')
	{
		$kondisi = 'Rusak Ringan';
		$id_kondisi = 2;
	}

	if($_GET['kondisi']=='rusak-berat') 
	{
		$kondisi = 'Rusak Berat';
		$id_kondisi = 3;
	}

}

$this->breadcrumbs=array(
	'Barang',
	'Kondisi '.$kondisi
);

?>


<h1>Kondisi <?php print $kondisi; ?></h1>

<table class="table table-condensed table-striped table-hover">
<thead>
<tr>
	<th>No</th>
	<th>Kode</th>
	<th>Nama Barang</th>
	<th>NUP</th>
	<th>Kondisi</th>
</tr>
</thead>
<?php
	$criteria = new CDbCriteria;
	$criteria->addCondition('id_barang_kondisi = :id_kondisi');
	$criteria->params = array(':id_kondisi'=>$id_kondisi);
?>
<?php $i=1; foreach(Barang::model()->findAll($criteria) as $data) { ?>
<tr>
	<td><?php print $i; ?></td>
	<td><?php print $data->kode; ?></td>
	<td><?php print $data->nama; ?></td>
	<td><?php print $data->nup; ?></td>
	<td><?php print $data->getBarangKondisi(); ?></td>
</tr>
<?php $i++; } ?>
</table>

