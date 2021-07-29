<?php

class BarangRestController extends Controller
{
	public function actionIndex()
	{
		$output = array('status'=>1,'tanggal'=>date('Y-m-d'));
		print json_encode($output,JSON_PRETTY_PRINT);
	}

	public function actionView($id)
	{
			$this->layout=false;
			header('Content-type: application/json');

			$output = array();
			$model = Barang::model()->findByPk($id);
			if($model!=null)
			{

				$status = 1;
				$output['status'] = $status;

				$output['id']=$model->id;
				$output['kode']=$model->kode;
				$output['nama']=$model->nama;
				$output['nup']=$model->nup;
				$output['merek']=$model->merek;
				$output['id_barang_kondisi']=$model->id_barang_kondisi;
				$output['tahun_perolehan']=Helper::getTanggal($model->tahun_perolehan);
				$output['masa_manfaat']=$model->masa_manfaat;
				$output['harga']=Helper::rp($model->harga,true);
				$output['pegawai']=$model->getRelation("pegawai","nama");
				$output['lokasi']=$model->getRelation("lokasi","nama");
				$output['perawatan_terakhir'] = Helper::getTanggal($model->perawatan_terakhir);
				$output['pemeriksaan_terakhir'] = Helper::getTanggal($model->pemeriksaan_terakhir);


			} else {
				$status = 0;
				$output['status'] = $status;
			}

			print json_encode($output,JSON_PRETTY_PRINT);

			Yii::app()->end();
	}

	public function actionPemeriksaan($id,$id_kondisi,$id_status_lokasi=1,$keterangan=null)
	{
			$this->layout=false;
			header('Content-type: application/json');

			$model = new BarangPemeriksaan;
			$model->id_barang = $id;
			$model->id_barang_kondisi = $id_kondisi;
			$model->id_status_lokasi = $id_status_lokasi

			date_default_timezone_set('Asia/Jakarta');
			$model->tanggal = date('Y-m-d');
			$model->keterangan = $keterangan;
			$model->waktu_dibuat = date('Y-m-d H:i:s');

			$output = array();

			if($model->save())
			{
					$output['status']=1;
			} else {
					$output['status']=0;
			}

			print json_encode($output,JSON_PRETTY_PRINT);

			Yii::app()->end();

	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}
