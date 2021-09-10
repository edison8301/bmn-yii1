<?php

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use Mpdf\Mpdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class BarangController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/main';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			array(
                'ext.starship.RestfullYii.filters.ERestFilter + 
				REST.GET, REST.PUT, REST.POST, REST.DELETE'
            ),
		);
	}


	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','REST.GET','REST.PUT','REST.POST','REST.DELETE','dbr'),
				'users'=>array('@'),
			),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('create','update','export','exportExcel','exportBarang','laporan','import','viewQr','filterQr','reportPerawatan',
                    'cetakQr','hapusKepemilikanPegawai','hapusKepemilikanLokasi','selectBarang','cetakQrPdf',
                    'kondisi','perawatan','pemeriksaan','reportPemeriksaan','reportPemindahan', 'importV2'
                ),
                'users'=>array('@'),
            ),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','cetakQrcode','cetakQrcodeDbr', 'cetakBastPdf'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actions()
	{
        return array(
            'REST.'=>'ext.starship.RestfullYii.actions.ERestActionProvider',
        );
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$options = new QROptions([
			'version'    => 5,
			'outputType' => QRCode::OUTPUT_MARKUP_SVG,
			'eccLevel'   => QRCode::ECC_L,
		]);
		
		// invoke a fresh QRCode instance
		$qrcode = new QRCode($options);

		$this->render('view',array(
			'model'=> $this->loadModel($id),
			'qrcode'=>$qrcode
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Barang;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Barang']))
		{
			$model->attributes=$_POST['Barang'];

			date_default_timezone_set('Asia/Jakarta');
			
			$model->waktu_dibuat = date('Y-m-d H:i:s'); 

			$gambar = CUploadedFile::getInstance($model,'gambar');

			if($gambar!==null) {
                $model->gambar = str_replace(' ', '-', time() . '_' . $gambar->name);
            }

			$model->setNull();

			if($model->save())
			{
				if($gambar!==null)
				{
					$path = Yii::app()->basePath.'/../uploads/barang/';
					$gambar->saveAs($path.$model->gambar);
				}
				
				Yii::app()->user->setFlash('success','Data berhasil ditambahkan');
				if(isset($_GET['id_lokasi']))
				{
					$this->redirect(array('lokasi/view','id'=>$model->id_lokasi));
				}
				elseif(isset($_GET['id_pegawai']))
				{
					$this->redirect(array('pegawai/view','id'=>$model->id_pegawai));
				}
				else
				{
					$this->redirect(array('view','id'=>$model->id));
				}
			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		
		$oldFile = $model->gambar;

		if(isset($_POST['Barang']))
		{
			$model->attributes=$_POST['Barang'];
			date_default_timezone_set('Asia/Jakarta');
			$model->waktu_diubah = date('Y-m-d H:i:s'); 

			$gambar = CUploadedFile::getInstance($model,'gambar');

			if($gambar!==null) {
                $model->gambar = str_replace(' ', '-', time() . '_' . $gambar->name);
            } else {
                $model->gambar = $oldFile;
            }

			$model->setNull();

			if($model->save())
			{
				if($gambar!==null)
				{
					$path = Yii::app()->basePath.'/../uploads/barang/';
					$gambar->saveAs($path.$model->gambar);
				
					if(file_exists($path.$oldFile) AND $oldFile!='')
						unlink($path.$oldFile);
				}
				
				Yii::app()->user->setFlash('success','Data berhasil ditambahkan');
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Barang');

		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	public function actionKondisi()
	{
		$this->render('kondisi',array(
			
		));
	}

	public function actionPemeriksaan()
	{
		$this->render('pemeriksaan',array(
			
		));
	}

	public function actionPerawatan()
	{
		$this->render('perawatan',array(
			
		));
	}

	public function actionHapusKepemilikanPegawai($id)
	{
		$pegawai = $_GET['pegawai'];
		$model = $this->loadModel($id);
		$model->id_pegawai = '';
		if($model->save())
		{
			$this->redirect(array('pegawai/view','id'=>$pegawai));
		}

	}

	public function actionHapusKepemilikanLokasi($id)
	{
		$lokasi = $_GET['lokasi'];
		$model = $this->loadModel($id);
		$model->id_lokasi = '';

		if($model->save())
		{
			$this->redirect(array('lokasi/view','id'=>$lokasi));
		}

	}	

	public function actionViewQr()
	{
			$criteria = new CDbCriteria;
			$params = array();

			if(!empty($_POST['kode'])) {
				$criteria->addCondition('kode=:kode');
				$params[':kode'] = $_POST['kode'];
			}

			if(!empty($_POST['nup_awal'])) {
				$criteria->addCondition('nup >= :nup_awal');
				$params[':nup_awal'] = $_POST['nup_awal'];
			}

			if(!empty($_POST['nup_akhir'])) {
				$criteria->addCondition('nup <= :nup_akhir');
				$params[':nup_akhir'] = $_POST['nup_akhir'];
			}	
			$criteria->params = $params;
			$criteria->order = 'kode ASC';	

		$this->renderPartial('view_qrcode',array(
			'criteria' => $criteria,
		));
	}

	public function actionFilterQr()
	{
		$this->render('filterQr');
	}

	public function actionCetakQr()
	{
		$model = new CetakQrForm;

		if(isset($_GET['id']))
		{
			$barang = Barang::model()->findByPk($_GET['id']);
			$model->kode = $barang->kode;
			$model->nup_awal = $barang->nup;
			$model->nup_akhir = $barang->nup;
		}

		if(isset($_POST['CetakQrForm']))
		{
			$model->attributes = $_POST['CetakQrForm'];

			if($model->validate())
			{
				$this->redirect(['barang/cetakQrPdf',
                    'kode'=>$model->kode,
                    'nup_awal'=>$model->nup_awal,
                    'nup_akhir'=>$model->nup_akhir,
                    'nup_lainnya'=>$model->nup_lainnya
                ]);
			}

		}

		$this->render('cetakQr',array(
			'model'=>$model
		));
	}


	/**
	 * Manages all models.
	 */
	public function actionAdmin($paging=10)
	{
		$model=new Barang('search');

		$model->unsetAttributes();

		if(isset($_GET['Barang'])) {
            $model->attributes=$_GET['Barang'];
        }


		$this->render('admin',array(
			'model'=>$model,
			'paging'=>$paging,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Barang the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Barang::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Barang $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='barang-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionExportExcel()
	{

	$model = new ExportBarang;

	if(isset($_POST['ExportBarang']))
	{
		$model->attributes=$_POST['ExportBarang'];

		if($model->validate())
		{

			spl_autoload_unregister(array('YiiBase','autoload'));
		
			Yii::import('application.vendors.PHPExcel',true);
		
			spl_autoload_register(array('YiiBase', 'autoload'));

			$criteria = new CDbCriteria;
			$params = array();

			if(!empty($_POST['ExportBarang']['nama'])) {
			    $nama = $_POST['ExportBarang']['nama'];
                $criteria->addCondition("kode REGEXP '^$nama'");
			}

			if(!empty($_POST['ExportBarang']['kondisi_barang'])) {
				$criteria->addCondition('id_barang_kondisi=:kondisi_barang');
				$params[':kondisi_barang'] = $_POST['ExportBarang']['kondisi_barang'];
			}

			if(!empty($_POST['tahun'])) {
				$criteria->addCondition('tahun_perolehan>=:awal AND tahun_perolehan<=:akhir');
				//$criteria->addCondition('');
				$params[':awal'] = $_POST['ExportBarang']['tahun'].'-01-01';
				$params[':akhir'] = $_POST['ExportBarang']['tahun'].'-12-31';
			}

			if(!empty($_POST['ExportBarang']['lokasi'])) {
				$criteria->addCondition('id_lokasi=:lokasi');
				$params[':lokasi'] = $_POST['ExportBarang']['lokasi'];
			}

			$criteria->params = $params;
			$criteria->order = 'kode ASC';

			$spreadsheet = new Spreadsheet();
			$spreadsheet->setActiveSheetIndex(0);
			$sheet = $spreadsheet->getActiveSheet();

			$sheet->getStyle('A3:M3')->getFont()->setBold(true);
			$sheet->getStyle("A1:L1")->getFont()->setSize(14);
			$sheet->getStyle('A1:M1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);//merge and center
			$sheet->mergeCells('A1:M1');//sama jLga
			$sheet->setCellValueByColumnAndRow(0, 1, "DATA BARANG");
		
			$sheet->setCellValue('A3', 'NO');
			$sheet->setCellValue('B3', 'KODE');
			$sheet->setCellValue('C3', 'NAMA');
			$sheet->setCellValue('D3', 'TAHUN PEROLEHAN');
			$sheet->setCellValue('E3', 'ASAL PEROLEHAN');
			$sheet->setCellValue('F3', 'MASA MANFAAT');
			$sheet->setCellValue('G3', 'KONDISI BARANG');
			$sheet->setCellValue('H3', 'SK PSP');
			$sheet->setCellValue('I3', 'SK PENGHAPUSAN');
			$sheet->setCellValue('J3', 'LOKASI');
			$sheet->setCellValue('K3', 'PEGAWAI');
			$sheet->setCellValue('L3', 'Waktu Diubah');
			$sheet->setCellValue('M3', 'Waktu Dibuat');

				$sheet->getColumnDimension('A')->setWidth(6);
				$sheet->getColumnDimension('B')->setWidth(12);
				$sheet->getColumnDimension('C')->setWidth(14);
				$sheet->getColumnDimension('D')->setWidth(18);
				$sheet->getColumnDimension('E')->setWidth(18);
				$sheet->getColumnDimension('F')->setWidth(18);
				$sheet->getColumnDimension('G')->setWidth(16);
				$sheet->getColumnDimension('H')->setWidth(15);
				$sheet->getColumnDimension('I')->setWidth(18);
				$sheet->getColumnDimension('J')->setWidth(12);
				$sheet->getColumnDimension('K')->setWidth(22);
				$sheet->getColumnDimension('L')->setWidth(15);
				$sheet->getColumnDimension('M')->setWidth(15);


			$i = 1;
			$kolom = 4;

			foreach(Barang::model()->findAll($criteria) as $data)
			{
				$sheet->setCellValue('A'.$kolom, $i);
				$sheet->setCellValue('B'.$kolom, $data->kode);
				$sheet->setCellValue('C'.$kolom, $data->nama);
				$sheet->setCellValue('D'.$kolom, $data->getTahunPerolehan());
				$sheet->setCellValue('E'.$kolom, $data->getPerolehanAsal());
				$sheet->setCellValue('F'.$kolom, $data->masa_manfaat);
				$sheet->setCellValue('G'.$kolom, $data->getBarangKondisi());
				$sheet->setCellValue('H'.$kolom, $data->sk_psp);
				$sheet->setCellValue('I'.$kolom, $data->sk_penghapusan);
				$sheet->setCellValue('J'.$kolom, $data->getLokasi());
				$sheet->setCellValue('K'.$kolom, $data->getPegawai());
				$sheet->setCellValue('L'.$kolom, $data->waktu_diubah);
				$sheet->setCellValue('M'.$kolom, $data->waktu_dibuat);

				$sheet->getStyle('A3:M'.$kolom)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);//merge and center
				$sheet->getStyle('A2:M'.$kolom)->getFont()->setSize(9);
				$sheet->getStyle('A3:M'.$kolom)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//border header surat	
									
				$i++; $kolom++;
			}

			$sheet->getStyle('A3:M'.$kolom)->getAlignment()->setWrapText(true);
			$sheet->getStyle('A3:M'.$kolom)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
	
			$filename = time().'_Barang.xlsx';

			// $path = 'uploads/export/';
			// $objWriter->save($path.$filename);	
			// $this->redirect($path.$filename);

			$objWriter = new Xlsx($spreadsheet);
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename='.$filename);
			header('Cache-Control: max-age=0');
			$objWriter->save('php://output');
			die();
			}	
		}

		$this->render('export',array(
			'laporanform'=>$model
		));		
	}

	public function actionExportBarang($id)
	{

			$criteria = new CDbCriteria;
			$criteria->condition = 'id_lokasi = :id_lokasi OR id_pegawai = :id_pegawai';
			$criteria->params = array(':id_lokasi'=>$id, ':id_pegawai'=>$id);
			$criteria->order = 'id ASC';

			spl_autoload_unregister(array('YiiBase','autoload'));
		
			Yii::import('application.vendors.PHPExcel',true);
		
			spl_autoload_register(array('YiiBase', 'autoload'));

			$PHPExcel = new PHPExcel();

			$PHPExcel->getActiveSheet()->getStyle('A3:M3')->getFont()->setBold(true);
			$PHPExcel->getActiveSheet()->getStyle("A1:L1")->getFont()->setSize(14);
			$PHPExcel->getActiveSheet()->getStyle('A1:M1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);//merge and center
			$PHPExcel->getActiveSheet()->mergeCells('A1:M1');//sama jLga
			$PHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 1, "DATA BARANG");
		
			$PHPExcel->getActiveSheet()->setCellValue('A3', 'NO');
			$PHPExcel->getActiveSheet()->setCellValue('B3', 'KODE');
			$PHPExcel->getActiveSheet()->setCellValue('C3', 'NAMA');
			$PHPExcel->getActiveSheet()->setCellValue('D3', 'TAHUN PEROLEHAN');
			$PHPExcel->getActiveSheet()->setCellValue('E3', 'ASAL PEROLEHAN');
			$PHPExcel->getActiveSheet()->setCellValue('F3', 'MASA MANFAAT');
			$PHPExcel->getActiveSheet()->setCellValue('G3', 'KONDISI BARANG');
			$PHPExcel->getActiveSheet()->setCellValue('H3', 'SK PSP');
			$PHPExcel->getActiveSheet()->setCellValue('I3', 'SK PENGHAPUSAN');
			$PHPExcel->getActiveSheet()->setCellValue('J3', 'LOKASI');
			$PHPExcel->getActiveSheet()->setCellValue('K3', 'PEGAWAI');
			$PHPExcel->getActiveSheet()->setCellValue('L3', 'Waktu Diubah');
			$PHPExcel->getActiveSheet()->setCellValue('M3', 'Waktu Dibuat');

				$PHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(6);
				$PHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(12);
				$PHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(14);
				$PHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(18);
				$PHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(18);
				$PHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(18);
				$PHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(16);
				$PHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
				$PHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(18);
				$PHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(12);
				$PHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(22);
				$PHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(15);
				$PHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(15);


			$i = 1;
			$kolom = 4;

			foreach(Barang::model()->findAll($criteria) as $data)
			{
				$PHPExcel->getActiveSheet()->setCellValue('A'.$kolom, $i);
				$PHPExcel->getActiveSheet()->setCellValue('B'.$kolom, $data->kode);
				$PHPExcel->getActiveSheet()->setCellValue('C'.$kolom, $data->nama);
				$PHPExcel->getActiveSheet()->setCellValue('D'.$kolom, $data->getTahun());
				$PHPExcel->getActiveSheet()->setCellValue('E'.$kolom, $data->asal_perolehan);
				$PHPExcel->getActiveSheet()->setCellValue('F'.$kolom, $data->masa_manfaat);
				$PHPExcel->getActiveSheet()->setCellValue('G'.$kolom, $data->getBarangKondisi());
				$PHPExcel->getActiveSheet()->setCellValue('H'.$kolom, $data->sk_psp);
				$PHPExcel->getActiveSheet()->setCellValue('I'.$kolom, $data->sk_penghapusan);
				$PHPExcel->getActiveSheet()->setCellValue('J'.$kolom, $data->getLokasi());
				$PHPExcel->getActiveSheet()->setCellValue('K'.$kolom, $data->getPegawai());
				$PHPExcel->getActiveSheet()->setCellValue('L'.$kolom, $data->waktu_diubah);
				$PHPExcel->getActiveSheet()->setCellValue('M'.$kolom, $data->waktu_dibuat);

				$PHPExcel->getActiveSheet()->getStyle('A3:M'.$kolom)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);//merge and center
				$PHPExcel->getActiveSheet()->getStyle('A2:M'.$kolom)->getFont()->setSize(9);
				$PHPExcel->getActiveSheet()->getStyle('A3:M'.$kolom)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//border header surat	
									
				$i++; $kolom++;
			}

			$PHPExcel->getActiveSheet()->getStyle('A3:M'.$kolom)->getAlignment()->setWrapText(true);
			$PHPExcel->getActiveSheet()->getStyle('A3:M'.$kolom)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
	
			$filename = time().'_Barang.xlsx';

			$path = Yii::app()->basePath.'/../uploads/export/';
			$objWriter = PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel2007');
			$objWriter->save($path.$filename);	
			$this->redirect(Yii::app()->request->baseUrl.'/uploads/export/'.$filename);
	}

	public function actionLaporan()
	{

		$this->render('batch_laporan');

	}

public function getCssClass($data)
{
    $cssClass;

    if('($data->id_barang_kondisi == 1)')
    {
        $cssClass='success';
    }
    elseif('$data->id_barang_kondisi == 2')
    {
        $cssClass='warning';
    }
    elseif('$data->id_barang_kondisi == 3')
    {
        $cssClass='danger';
    }

    return $cssClass;
}	

	public function actionImport()
	{
		
/*		spl_autoload_unregister(array('YiiBase','autoload'));
		
		Yii::import('application.extensions.PHPExcel',true);
		
		spl_autoload_register(array('YiiBase', 'autoload'));
		
		$filename = Yii::app()->basePath.'/../imports/bmn_baru.xls';
		
		$objReader = PHPExcel_IOFactory::createReader("Excel5");
		$objPHPExcel = $objReader->load($filename);
		
		$highestRow = $objPHPExcel->getActiveSheet()->getHighestRow();
		
		for($i=2;$i<=$highestRow;$i++)
		{
		
			$kode = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getValue();
			$nup = $objPHPExcel->getActiveSheet()->getCell('C'.$i)->getValue();
			$merek = $objPHPExcel->getActiveSheet()->getCell('D'.$i)->getValue();
			$tanggal = $objPHPExcel->getActiveSheet()->getCell('E'.$i)->getValue();
			$kondisi = $objPHPExcel->getActiveSheet()->getCell('F'.$i)->getValue();
			$nama = $objPHPExcel->getActiveSheet()->getCell('G'.$i)->getValue();
			$bukti_perolehan = $objPHPExcel->getActiveSheet()->getCell('I'.$i)->getValue();
			$asal_perolehan = $objPHPExcel->getActiveSheet()->getCell('J'.$i)->getValue();
			$sakhir = $objPHPExcel->getActiveSheet()->getCell('L'.$i)->getValue();

			$tanggal = $objPHPExcel->getActiveSheet()->getCell('E'.$i)->getValue();
                       if(PHPExcel_Shared_Date::isDateTime($objPHPExcel->getActiveSheet()->getCell('E'.$i))){

							$tanggal = $objPHPExcel->getActiveSheet()->getCell('E'.$i)->getValue();
							$dateValue = PHPExcel_Shared_Date::ExcelToPHP($tanggal);                       
							$tanggal_jadi  =  date('Y-m-d',$dateValue); 
						}			


			

			$barang = new Barang;
			$barang->kode = $kode;
			$barang->nup = $nup;
			$barang->merek = $merek;
			$barang->tahun_perolehan = $tanggal_jadi;
			$barang->id_barang_kondisi = $kondisi;
			$barang->nama = $nama;
			$barang->bukti_perolehan = $bukti_perolehan;
			$barang->asal_perolehan = $asal_perolehan;
			$barang->sakhir = $sakhir;
	
			$barang->save();
		}*/
			
	}

    public function actionImportV2()
    {
        if (Yii::app()->request->isPostRequest) {
            $konten = $_POST['konten'];

            $dataExplode = explode("\n", $konten);

            foreach ($dataExplode as $data) {
                $konten = explode("\t", $data);

                $kode = str_replace(' ', '', $konten[0]);
                $nup = $konten[1];
                $nama = $konten[2];

                $model = new Barang();
                $model->kode = $kode;
                $model->nup = $nup;
                $model->nama = $nama;
                if(!$model->save()) {
                    print_r($model->getErrors());die;
                }
            }
        }
        
        return $this->render('importV2');
    }

	public function actionReportPerawatan()
	{
		$model = new LaporanPerawatanForm;
		if(isset($_POST['LaporanPerawatanForm']))
		{

			$model->attributes=$_POST['LaporanPerawatanForm'];
			if($model->validate())
			{

			// spl_autoload_unregister(array('YiiBase','autoload'));
		
			// Yii::import('application.vendors.PHPExcel',true);
		
			// spl_autoload_register(array('YiiBase', 'autoload'));

			$criteria = new CDbCriteria;
			$params = array();

			if(!empty($_POST['LaporanPerawatanForm']['tanggal_awal'])) {
				$criteria->addCondition('tanggal >= :waktu_awal');
				$params[':waktu_awal'] =$_POST['LaporanPerawatanForm']['tanggal_awal'];
			}

			if(!empty($_POST['LaporanPerawatanForm']['tanggal_akhir'])) {
				$criteria->addCondition('tanggal <= :waktu_akhir');
				$params[':waktu_akhir'] = $_POST['LaporanPerawatanForm']['tanggal_akhir'];
			}			

			$criteria->params = $params;
			$criteria->order = 'tanggal ASC';



			$spreadsheet = new Spreadsheet();
			$spreadsheet->setActiveSheetIndex(0);
			$sheet = $spreadsheet->getActiveSheet();		
	
			$sheet->getStyle('A3:E3')->getFont()->setBold(true);
			$sheet->getStyle("A1:E1")->getFont()->setSize(14);
			$sheet->getStyle('A1:E1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);//merge and center
			$sheet->mergeCells('A1:E1');//sama jLga
			$sheet->setCellValueByColumnAndRow(0, 1, "LAPORAN PERAWATAN BARANG");
		
			$sheet->setCellValue('A3', 'No');
			$sheet->setCellValue('B3', 'Tanggal');
			$sheet->setCellValue('C3', 'Nama Barang');
			$sheet->setCellValue('D3', 'Keterangan');
			$sheet->setCellValue('E3', 'Waktu Dibuat');

				$sheet->getColumnDimension('A')->setWidth(6);
				$sheet->getColumnDimension('B')->setWidth(23);
				$sheet->getColumnDimension('C')->setWidth(30);
				$sheet->getColumnDimension('D')->setWidth(45);
				$sheet->getColumnDimension('E')->setWidth(22);


		$i = 1;
		$kolom = 4;
		
			foreach(BarangPerawatan::model()->findAll($criteria) as $data)
			{
				$sheet->setCellValue('A'.$kolom, $i);
				$sheet->setCellValue('B'.$kolom, Helper::tanggal($data->tanggal));
				$sheet->setCellValue('C'.$kolom, $data->getBarang());
				$sheet->setCellValue('D'.$kolom, $data->keterangan);
				$sheet->setCellValue('E'.$kolom, $data->waktu_dibuat);

				$sheet->getStyle('A3:E'.$kolom)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);//merge and center
				$sheet->getStyle('A2:E'.$kolom)->getFont()->setSize(9);
				$sheet->getStyle('A3:E'.$kolom)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//border header surat	
									
				$i++; $kolom++;
			}

			$sheet->getStyle('A3:E'.$kolom)->getAlignment()->setWrapText(true);
			$sheet->getStyle('A3:E'.$kolom)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
		
			$filename = time().'_LaporanPerawatanBarang.xlsx';
			
			$objWriter = new Xlsx($spreadsheet);
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename='.$filename);
			header('Cache-Control: max-age=0');
			$objWriter->save('php://output');
			die();  
		}
	}

		$model->tanggal_awal = date('Y-m').'-01';
		$model->tanggal_akhir = date('Y-m-t');		
		$this->render('laporan_perawatan',array(
		'laporanform'=>$model,
		'tanggal_awal' => $model->tanggal_awal,
		'tanggal_akhir' => $model->tanggal_akhir,
	));

}	


	public function actionReportPemeriksaan()
	{
		$model = new LaporanPemeriksaanForm;

		if(isset($_POST['LaporanPemeriksaanForm']))
		{

			$model->attributes=$_POST['LaporanPemeriksaanForm'];
			if($model->validate())
			{

			// spl_autoload_unregister(array('YiiBase','autoload'));
		
			// Yii::import('application.vendors.PHPExcel',true);
		
			// spl_autoload_register(array('YiiBase', 'autoload'));

			$criteria = new CDbCriteria;
			$params = array();

			if(!empty($_POST['LaporanPemeriksaanForm']['tanggal_awal'])) {
				$criteria->addCondition('tanggal >= :waktu_awal');
				$params[':waktu_awal'] =$_POST['LaporanPemeriksaanForm']['tanggal_awal'];
			}

			if(!empty($_POST['LaporanPemeriksaanForm']['tanggal_akhir'])) {
				$criteria->addCondition('tanggal <= :waktu_akhir');
				$params[':waktu_akhir'] = $_POST['LaporanPemeriksaanForm']['tanggal_akhir'];
			}			

			if(!empty($_POST['LaporanPemeriksaanForm']['kondisi'])) {
				$criteria->addCondition('id_barang_kondisi <= :kondisi');
				$params[':kondisi'] = $_POST['LaporanPemeriksaanForm']['kondisi'];
			}					

			$criteria->params = $params;
			$criteria->order = 'tanggal ASC';

			$spreadsheet = new Spreadsheet();
			$spreadsheet->setActiveSheetIndex(0);
			$sheet = $spreadsheet->getActiveSheet();
		
			$sheet->getStyle('A3:F3')->getFont()->setBold(true);
			$sheet->getStyle("A1:F1")->getFont()->setSize(14);
			$sheet->getStyle('A1:F1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);//merge and center
			$sheet->mergeCells('A1:F1');//sama jLga
			$sheet->setCellValueByColumnAndRow(0, 1, "LAPORAN PEMERIKSAAN BARANG");
		
			$sheet->setCellValue('A3', 'No');
			$sheet->setCellValue('B3', 'Tanggal');
			$sheet->setCellValue('C3', 'Nama Barang');
			$sheet->setCellValue('D3', 'Keterangan');
			$sheet->setCellValue('E3', 'Kondisi');
			$sheet->setCellValue('F3', 'Waktu Dibuat');

			$sheet->getColumnDimension('A')->setWidth(6);
			$sheet->getColumnDimension('B')->setWidth(23);
			$sheet->getColumnDimension('C')->setWidth(30);
			$sheet->getColumnDimension('D')->setWidth(45);
			$sheet->getColumnDimension('E')->setWidth(22);
			$sheet->getColumnDimension('F')->setWidth(22);


			$i = 1;
			$kolom = 4;
		
			foreach(BarangPemeriksaan::model()->findAll($criteria) as $data)
			{
				$sheet->setCellValue('A'.$kolom, $i);
				$sheet->setCellValue('B'.$kolom, Helper::tanggal($data->tanggal));
				$sheet->setCellValue('C'.$kolom, $data->getBarang());
				$sheet->setCellValue('D'.$kolom, $data->keterangan);
				$sheet->setCellValue('E'.$kolom, $data->getBarangKondisi());
				$sheet->setCellValue('F'.$kolom, $data->waktu_dibuat);

				$sheet->getStyle('A3:F'.$kolom)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);//merge and center
				$sheet->getStyle('A2:F'.$kolom)->getFont()->setSize(9);
				$sheet->getStyle('A3:F'.$kolom)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);//border header surat	
									
				$i++; $kolom++;
			}

			$sheet->getStyle('A3:E'.$kolom)->getAlignment()->setWrapText(true);
			$sheet->getStyle('A3:E'.$kolom)->getAlignment()->setVertical(Alignment::VERTICAL_TOP);
		
			$filename = time().'_LaporanKondisiBarang.xlsx';

			$objWriter = new Xlsx($spreadsheet);
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename='.$filename);
			header('Cache-Control: max-age=0');
			$objWriter->save('php://output');
			die();  
		}
	}

		$model->tanggal_awal = date('Y-m').'-01';
		$model->tanggal_akhir = date('Y-m-t');	

		$this->render('laporan_pemeriksaan',array(
		'laporanform'=>$model,
		'tangal_awal' => $model->tanggal_awal,
		'tanggal_akhir' => $model->tanggal_akhir,
	));

}	


	public function actionReportPemindahan()
	{
		$model = new LaporanPemindahanForm;
		if(isset($_POST['LaporanPemindahanForm']))
		{

			$model->attributes=$_POST['LaporanPemindahanForm'];
			if($model->validate())
			{

			spl_autoload_unregister(array('YiiBase','autoload'));
		
			Yii::import('application.vendors.PHPExcel',true);
		
			spl_autoload_register(array('YiiBase', 'autoload'));

			$criteria = new CDbCriteria;
			$params = array();

			if(!empty($_POST['LaporanPemindahanForm']['tanggal_awal'])) {
				$criteria->addCondition('tanggal >= :waktu_awal');
				$params[':waktu_awal'] =$_POST['LaporanPemindahanForm']['tanggal_awal'];
			}

			if(!empty($_POST['LaporanPemindahanForm']['tanggal_akhir'])) {
				$criteria->addCondition('tanggal <= :waktu_akhir');
				$params[':waktu_akhir'] = $_POST['LaporanPemindahanForm']['tanggal_akhir'];
			}			
			
			if(!empty($_POST['LaporanPemindahanForm']['status'])) {
				$criteria->addCondition('id_barang_pemindahan_status <= :status');
				$params[':status'] = $_POST['LaporanPemindahanForm']['status'];
			}								

			$criteria->params = $params;
			$criteria->order = 'tanggal ASC';



		$PHPExcel = new PHPExcel();
			
		
			$PHPExcel->getActiveSheet()->getStyle('A3:G3')->getFont()->setBold(true);
			$PHPExcel->getActiveSheet()->getStyle("A1:G1")->getFont()->setSize(14);
			$PHPExcel->getActiveSheet()->getStyle('A1:G1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);//merge and center
			$PHPExcel->getActiveSheet()->mergeCells('A1:G1');//sama jLga
			$PHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 1, "LAPORAN PEMINDAHAN BARANG");
		
			$PHPExcel->getActiveSheet()->setCellValue('A3', 'No');
			$PHPExcel->getActiveSheet()->setCellValue('A3', 'Nomor');
			$PHPExcel->getActiveSheet()->setCellValue('B3', 'Tanggal Pemindahan');
			$PHPExcel->getActiveSheet()->setCellValue('C3', 'Lokasi Asal');
			$PHPExcel->getActiveSheet()->setCellValue('D3', 'Lokasi Tujuan');
			$PHPExcel->getActiveSheet()->setCellValue('E3', 'Status');
			$PHPExcel->getActiveSheet()->setCellValue('F3', 'Waktu Dibuat');
			$PHPExcel->getActiveSheet()->setCellValue('G3', 'Waktu Disetujui');

				$PHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(6);
				$PHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(23);
				$PHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
				$PHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(45);
				$PHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(22);
				$PHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(22);
				$PHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(22);


		$i = 1;
		$kolom = 4;
		
			foreach(BarangPemindahan::model()->findAll($criteria) as $data)
			{
				$PHPExcel->getActiveSheet()->setCellValue('A'.$kolom, $i);
				$PHPExcel->getActiveSheet()->setCellValue('D'.$kolom, $data->nomor);
				$PHPExcel->getActiveSheet()->setCellValue('B'.$kolom, Helper::tanggal($data->tanggal));
				$PHPExcel->getActiveSheet()->setCellValue('C'.$kolom, $data->getLokasiAsal());
				$PHPExcel->getActiveSheet()->setCellValue('D'.$kolom, $data->getLokasiTujuan());
				$PHPExcel->getActiveSheet()->setCellValue('E'.$kolom, $data->getPemindahanStatus());
				$PHPExcel->getActiveSheet()->setCellValue('F'.$kolom, $data->waktu_dibuat);
				$PHPExcel->getActiveSheet()->setCellValue('G'.$kolom, $data->waktu_disetujui);

				$PHPExcel->getActiveSheet()->getStyle('A3:G'.$kolom)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);//merge and center
				$PHPExcel->getActiveSheet()->getStyle('A2:G'.$kolom)->getFont()->setSize(9);
				$PHPExcel->getActiveSheet()->getStyle('A3:G'.$kolom)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//border header surat	
									
				$i++; $kolom++;
			}

			$PHPExcel->getActiveSheet()->getStyle('A3:G'.$kolom)->getAlignment()->setWrapText(true);
			$PHPExcel->getActiveSheet()->getStyle('A3:G'.$kolom)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
		
			$filename = time().'_LaporanPemindahan.xlsx';

			$path = Yii::app()->basePath.'/../uploads/';
			$objWriter = PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel2007');
			ob_end_clean();

			header('Content-type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename="'.$filename.'.xlsx"');
			$objWriter->save('php://output');
			$this->redirect(Yii::app()->request->baseUrl.'/uploads/exports/'.$filename);
		}
	}
		$model->tanggal_awal = date('Y-m').'-01';
		$model->tanggal_akhir = date('Y-m-t');

		$this->render('laporan_pemindahan',array(
		'laporanform'=>$model,
		'tanggal_awal' => $model->tanggal_awal,
		'tanggal_akhir' => $model->tanggal_akhir,
	));

}	


public function actionSelectBarang(){

    if(isset($_GET['q']))
    {
        $queryterm  = $_GET['q'];
        $model      = new Barang;
        $barang    = Barang::model()->findAll(array('order'=>'nama', 'condition' => 'nama LIKE :nama', 'params'    => array(':nama'=>$queryterm . '%')));

		$data = array();
		// ***** BEGIN change here
		foreach ($barang as $barang) {
		       $data[] = array(
		                       'id' => $barang->kode.'-'.$barang->nup.' - '.$barang->nama,
		                       'text' => $barang->kode.'-'.$barang->nup.' - '.$barang->nama,
		                       );
		            }
		// lapor lorem, yg ini ga jalan: $data = CJSON::encode(CHtml::listData($persons, 'uuid', 'lastname')) ;
		echo CJSON::encode($data) ;        
     
    }
        Yii::app()->end();
}

	public function actionCetakQrPdf($kode,$nup_awal,$nup_akhir,$nup_lainnya)
	{
		
		// include(Yii::app()->basePath."/vendors/mpdf/mpdf.php");

		$marginLeft = 5;
		$marginRight = 5;
		$marginTop = 5;
		$marginBottom = 5;
		$marginHeader = 5;
		$marginFooter = 5;

		$pdf = new Mpdf(['UTF-8','A4',9,'Arial',$marginLeft,$marginRight,$marginTop,$marginBottom,$marginHeader,$marginFooter]);
		
		$criteria = new CDbCriteria;
		$params = array();

		if(isset($_GET['kode'])) 
		{
			$criteria->addCondition('kode=:kode');
			$params[':kode'] = $kode;
		}

		/*if(isset($_GET['nup_awal'])) 
		{
			$criteria->addCondition('nup >= :nup_awal');
			$params[':nup_awal'] = $_GET['nup_awal'];
			
		}

		
		if(isset($_GET['nup_akhir'])) 
		{
			$criteria->addCondition('nup <= :nup_akhir');
			$params[':nup_akhir'] = $_GET['nup_akhir'];
		}

		if(isset($_GET['nup_lainnya'])) 
		{
			$criteria->addCondition('nup IN (:nup_lainnya)');
			$params[':nup_lainnya'] = $_GET['nup_lainnya'];
		}*/
		
		
		// $params[':nup_awal'] = $_GET['nup_awal'];
		// $params[':nup_akhir'] = $_GET['nup_akhir'];

		if ($nup_lainnya !== null && ($nup_awal == null && $nup_akhir == null)) {
			$nup_lainnya = explode(',', $nup_lainnya);
			$data = join(",",$nup_lainnya);
			$criteria->addCondition("nup IN ($data)");
		} elseif ($nup_lainnya == null && ($nup_awal !== null && $nup_akhir !== null)) {
			$criteria->addCondition('(nup >= :nup_awal AND nup <= :nup_akhir)');
			$params[':nup_awal'] = $nup_awal;
			$params[':nup_akhir'] = $nup_akhir;
		} elseif ($nup_lainnya !== null && ($nup_awal !== null && $nup_akhir !== null)) {
			$nup_lainnya = explode(',', $nup_lainnya);
			$data = join(",",$nup_lainnya);
			$criteria->addCondition("(nup >= :nup_awal AND nup <= :nup_akhir) OR nup IN ($data)");
			$params[':nup_awal'] = $nup_awal;
			$params[':nup_akhir'] = $nup_akhir;
		}
		
		$criteria->params = $params;
		$criteria->order = 'kode,nup ASC';	

		$models = Barang::model()->findAll($criteria);

		$options = new QROptions([
			'version'    => 5,
			'outputType' => QRCode::OUTPUT_MARKUP_SVG,
			'eccLevel'   => QRCode::ECC_L,
		]);
		
		// invoke a fresh QRCode instance
		$qrcode = new QRCode($options);

		$html = $this->renderPartial('cetakQrHtml',array(
			'models'=>$models,
			'qrcode'=>$qrcode
		),true);

		$pdf->WriteHTML($html);

		$pdf->Output();		
		
	}

	public function actionCetakQrcodeDbr()
	{
		$model = new CetakQrDbrForm;

		if(isset($_GET['id']))
		{
			$barang = Barang::model()->findByPk($_GET['id']);
			$model->kode = $barang->kode;
			$model->nup_awal = $barang->nup;
			$model->nup_akhir = $barang->nup;
		}

		$this->performAjaxValidation($model);

		if(isset($_POST['CetakQrDbrForm']))
		{
			$model->attributes = $_POST['CetakQrDbrForm'];

			if($model->validate())
			{
				$marginLeft = 5;
				$marginRight = 5;
				$marginTop = 5;
				$marginBottom = 5;
				$marginHeader = 5;
				$marginFooter = 5;

				$pdf = new Mpdf(['UTF-8','A4',9,'Arial',$marginLeft,$marginRight,$marginTop,$marginBottom,$marginHeader,$marginFooter]);

				$criteria = new CDbCriteria;
				$params = array();

				$criteria->addCondition('id_lokasi = :lokasi');
				$params[':lokasi'] = $model->id_lokasi;
				
				$criteria->params = $params;
				$criteria->order = 'kode,nup ASC';	

				$models = Barang::model()->findAll($criteria);
				
				$html = $this->renderPartial('cetakQrHtml',array('models'=>$models),true);

				$pdf->WriteHTML($html);

				$pdf->Output();	
			}

		}

		$this->render('cetakQrDbr',array(
			'model'=>$model
		));
	}
}
