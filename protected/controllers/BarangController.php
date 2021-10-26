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
	public $layout = '//layouts/main';

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
			array(
				'allow',  // allow all users to perform 'index' and 'view' actions
				'actions' => array('index', 'view', 'REST.GET', 'REST.PUT', 'REST.POST', 'REST.DELETE', 'dbr'),
				'users' => array('@'),
			),
			array(
				'allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions' => array(
					'create', 'update', 'export', 'exportExcel', 'exportBarang', 'laporan', 'import', 'viewQr', 'filterQr', 'reportPerawatan',
					'cetakQr', 'hapusKepemilikanPegawai', 'hapusKepemilikanLokasi', 'selectBarang', 'cetakQrPdf',
					'kondisi', 'perawatan', 'pemeriksaan', 'reportPemeriksaan', 'reportPemindahan', 'importV2'
				),
				'users' => array('@'),
			),
			array(
				'allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions' => array('admin', 'delete', 'cetakQrcode', 'cetakQrcodeDbr', 'cetakBastPdf'),
				'users' => array('@'),
			),
			array(
				'deny',  // deny all users
				'users' => array('*'),
			),
		);
	}

	public function actions()
	{
		return array(
			'REST.' => 'ext.starship.RestfullYii.actions.ERestActionProvider',
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

		$this->render('view', array(
			'model' => $this->loadModel($id),
			'qrcode' => $qrcode
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($id_lokasi=null)
	{
		$model = new Barang;

		$model->id_lokasi = $id_lokasi;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['Barang'])) {
			$model->attributes = $_POST['Barang'];

			date_default_timezone_set('Asia/Jakarta');

			$model->waktu_dibuat = date('Y-m-d H:i:s');

			$gambar = CUploadedFile::getInstance($model, 'gambar');

			if ($gambar !== null) {
				$model->gambar = str_replace(' ', '-', time() . '_' . $gambar->name);
			}

			if ($model->save()) {
				if ($gambar !== null) {
					$path = Yii::app()->basePath . '/../uploads/barang/';
					$gambar->saveAs($path . $model->gambar);
				}

				Yii::app()->user->setFlash('success', 'Data berhasil ditambahkan');
				if (isset($_GET['id_lokasi'])) {
					$this->redirect(array('lokasi/view', 'id' => $model->id_lokasi));
				} elseif (isset($_GET['id_pegawai'])) {
					$this->redirect(array('pegawai/view', 'id' => $model->id_pegawai));
				} else {
					$this->redirect(array('view', 'id' => $model->id));
				}
			}
		}

		$this->render('create', array(
			'model' => $model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model = $this->loadModel($id);

		$oldFile = $model->gambar;

		if (isset($_POST['Barang'])) {
			$model->attributes = $_POST['Barang'];
			date_default_timezone_set('Asia/Jakarta');
			$model->waktu_diubah = date('Y-m-d H:i:s');

			$gambar = CUploadedFile::getInstance($model, 'gambar');

			if ($gambar !== null) {
				$model->gambar = str_replace(' ', '-', time() . '_' . $gambar->name);
			} else {
				$model->gambar = $oldFile;
			}

			$model->setNull();

			if ($model->save()) {
				if ($gambar !== null) {
					$path = Yii::app()->basePath . '/../uploads/barang/';
					$gambar->saveAs($path . $model->gambar);

					if (file_exists($path . $oldFile) and $oldFile != '')
						unlink($path . $oldFile);
				}

				Yii::app()->user->setFlash('success', 'Data berhasil ditambahkan');
				$this->redirect(array('view', 'id' => $model->id));
			}
		}

		$this->render('update', array(
			'model' => $model,
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
		if (!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider = new CActiveDataProvider('Barang');

		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionKondisi()
	{
		$this->render('kondisi', array());
	}

	public function actionPemeriksaan()
	{
		$this->render('pemeriksaan', array());
	}

	public function actionPerawatan()
	{
		$this->render('perawatan', array());
	}

	public function actionHapusKepemilikanPegawai($id)
	{
		$pegawai = $_GET['pegawai'];
		$model = $this->loadModel($id);
		$model->id_pegawai = '';
		if ($model->save()) {
			$this->redirect(array('pegawai/view', 'id' => $pegawai));
		}
	}

	public function actionHapusKepemilikanLokasi($id)
	{
		$lokasi = $_GET['lokasi'];
		$model = $this->loadModel($id);
		$model->id_lokasi = '';

		if ($model->save()) {
			$this->redirect(array('lokasi/view', 'id' => $lokasi));
		}
	}

	public function actionViewQr()
	{
		$criteria = new CDbCriteria;
		$params = array();

		if (!empty($_POST['kode'])) {
			$criteria->addCondition('kode=:kode');
			$params[':kode'] = $_POST['kode'];
		}

		if (!empty($_POST['nup_awal'])) {
			$criteria->addCondition('nup >= :nup_awal');
			$params[':nup_awal'] = $_POST['nup_awal'];
		}

		if (!empty($_POST['nup_akhir'])) {
			$criteria->addCondition('nup <= :nup_akhir');
			$params[':nup_akhir'] = $_POST['nup_akhir'];
		}
		$criteria->params = $params;
		$criteria->order = 'kode ASC';

		$this->renderPartial('view_qrcode', array(
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

		if (isset($_GET['id'])) {
			$barang = Barang::model()->findByPk($_GET['id']);
			$model->kode = $barang->kode;
			$model->nup_awal = $barang->nup;
			$model->nup_akhir = $barang->nup;
		}

		if (isset($_POST['CetakQrForm'])) {
			$model->attributes = $_POST['CetakQrForm'];

			if ($model->validate()) {
				$this->redirect([
					'barang/cetakQrPdf',
					'kode' => $model->kode,
					'nup_awal' => $model->nup_awal,
					'nup_akhir' => $model->nup_akhir,
					'nup_lainnya' => $model->nup_lainnya
				]);
			}
		}

		$this->render('cetakQr', array(
			'model' => $model
		));
	}


	/**
	 * Manages all models.
	 */
	public function actionAdmin($paging = 10)
	{
		$model = new Barang('search');

		$model->unsetAttributes();

		if (isset($_GET['Barang'])) {
			$model->attributes = $_GET['Barang'];
		}


		$this->render('admin', array(
			'model' => $model,
			'paging' => $paging,
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
		$model = Barang::model()->findByPk($id);
		if ($model === null)
			throw new CHttpException(404, 'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Barang $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'barang-form') {
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

            if(empty($_POST['ExportBarang']['nama']) AND  empty($_POST['ExportBarang']['kode'])) {
                $model->addError('nama','Minimal Nama atau Kode harus terisi');
                $model->addError('kode','Minimal Nama atau Kode harus terisi');
                return $this->render('export',array(
                    'laporanform'=>$model
                ));
            }

            if($model->validate())
            {
                spl_autoload_unregister(array('YiiBase','autoload'));

                Yii::import('application.vendors.PHPExcel',true);

                spl_autoload_register(array('YiiBase', 'autoload'));

                $criteria = new CDbCriteria;
                $params = array();

                if(!empty($_POST['ExportBarang']['kode'])) {
                    $criteria->addCondition('kode REGEXP :kode');
                    $params[':kode'] = "^".$_POST['ExportBarang']['kode'];
                }

                if(!empty($_POST['ExportBarang']['nama'])) {
                    $criteria->addCondition('nama LIKE :nama');
                    $params[':nama'] = $_POST['ExportBarang']['nama'];
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
		$model = $this->loadModel($id);

        $criteria = new CDbCriteria;
        $criteria->condition = 'id_ruangan = :id_ruangan';
        $criteria->params = array(':id_ruangan'=>$id);
        $criteria->order = 'id ASC';

        $spreadsheet = new Spreadsheet();
		$spreadsheet->setActiveSheetIndex(0);
		$sheet = $spreadsheet->getActiveSheet();

        $sheet->getStyle('A7:H21')->getFont()->setBold(true);

        $sheet->mergeCells('A7:H7');
        $sheet->mergeCells('A8:H8');
        $sheet->mergeCells('A13:H13');
        $sheet->mergeCells('A14:H14');

        $sheet->getStyle('A10:H12')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);//merge and center
        $sheet->getStyle('A15:H17')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);//merge and center
        $sheet->getStyle('A7:H8')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);//merge and center
        $sheet->getStyle('A13:H14')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);//merge and center

        $sheet->getStyle('A19:H21')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);//merge and center

        $objDrawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
        $objDrawing->setName('Logo');
        $objDrawing->setDescription('Logo');
        $logo = 'images/makarti.png';
        $objDrawing->setPath($logo);
        $objDrawing->setOffsetX(130);    // setOffsetX works properly
        $objDrawing->setOffsetY(300);  //setOffsetY has no effect
        $objDrawing->setCoordinates('D1');
        $objDrawing->setHeight(75); // logo height
        $objDrawing->setWidth(115); // logo height
        $objDrawing->setWorksheet($sheet);

        $sheet->setCellValueByColumnAndRow(0, 7, "PUSAT KAJIAN DAN PENDIDIKAN DAN PELATIHAN APARATUR I");
        $sheet->setCellValueByColumnAndRow(0, 8, "LEMBAGA ADMINISTRASI NEGARA");
        $sheet->setCellValueByColumnAndRow(0, 13, "DAFTAR BARANG RUANGAN");
        $sheet->setCellValueByColumnAndRow(0, 14, "(DBR)");
        $sheet->setCellValue('A10', 'UPPB');
        $sheet->setCellValue('A11', 'UPPB-E1');
        $sheet->setCellValue('A12', 'UUPPB-W');
        $sheet->setCellValue('A15', 'KODE UPKPB');
        $sheet->setCellValue('A16', 'Nama Unit UPKPB');
        $sheet->setCellValue('A17', 'Nomor Ruang');

        $sheet->setCellValue('C10', ': LEMBAGA ADMINISTRASI NEGARA');
        $sheet->setCellValue('C11', ': LEMBAGA ADMINISTRASI NEGARA');
        $sheet->setCellValue('C12', ': PKP2A I LAN');

        $sheet->setCellValue('C15', ': 086.01.02.450423.000');
        $sheet->setCellValue('C16', ': PKP2A I LAN');
        //$sheet->setCellValue('C17', ': '.$_GET['lokasi']);


        $sheet->mergeCells('D19:F19');


        $sheet->mergeCells('A19:A20');
        $sheet->mergeCells('B19:B20');
        $sheet->mergeCells('C19:C20');
        $sheet->mergeCells('H19:H20');

        $sheet->mergeCells('G19:G20');

        $sheet->setCellValue('A19', 'No');
        $sheet->setCellValue('B19', 'Kode');
        $sheet->setCellValue('C19', 'Nama Barang');

        $sheet->setCellValue('A21', '1');
        $sheet->setCellValue('B21', '2');
        $sheet->setCellValue('C21', '3');
    
        $sheet->getColumnDimension('A')->setWidth(6);
        $sheet->getColumnDimension('B')->setWidth(14);
        $sheet->getColumnDimension('C')->setWidth(16);

		$i = 1;
			$kolom = 22;
			$bawah = 24;

			foreach(Barang::model()->findAll($criteria) as $data)
			{
				$sheet->setCellValue('A'.$kolom, $i);
				$sheet->setCellValue('B'.$kolom, $data->kode);
				$sheet->setCellValue('C'.$kolom, $data->nama);


				$i++; $kolom++;


				$bawah = $kolom+2;
			}

			$peringatan = "TIDAK DIBENARKAN MEMINDAHKAN BARANG-BARANG YANG ADA PADA DAFTAR BARANG RUANG INI TANPA SEPENGETAHUAN PENANGGUNG JAWAB RUANGAN DAN PENANGGUNG JAWAB UPKBP.";

			$sheet->setCellValue('A'.$bawah, $peringatan);

			$kolom_peringatan = $bawah + 2;

			$sheet->mergeCells('A'.$bawah.':H'.$kolom_peringatan.'');

			$sheet->getStyle('A19:H'.$kolom)->getAlignment()->setWrapText(true);
			$sheet->getStyle('A'.$bawah.':H'.$bawah)->getAlignment()->setWrapText(true);

			$sheet->getStyle('A22:H'.$kolom)->getAlignment()->setVertical(Alignment::VERTICAL_TOP);
			$sheet->getStyle('A22:B'.$kolom)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
			$sheet->getStyle('E22:H'.$kolom)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);			

			$sheet->getStyle('A'.$bawah.':H'.$bawah)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

			$sheet->getStyle('A'.$bawah.':H'.$bawah.'')->getFont()->setBold(true);
			$sheet->getStyle('A'.$bawah.':H'.$bawah.'')->getFont()->setSize(16);

			$sheet->getStyle('A1:H17')->getFont()->setSize(13);
			$sheet->getStyle('A22:H19')->getFont()->setSize(11);

			//=============================== Tandatangan =====================================/

			$kolom_tandatangan = $bawah + 6;
			$kolom_nama_penandatangan = $kolom_tandatangan + 6;
			$kolom_nip = $kolom_tandatangan + 7;

			// $pegawai = Pegawai::model()->findByAttributes(array('id'=>$model->id_pegawai));

			// $sheet->setCellValue('A'.$kolom_tandatangan, 'PENANGGUNG JAWAB RUANGAN');

			// $sheet->setCellValue('A'.$kolom_nama_penandatangan, $model->getPegawai());
			// $sheet->setCellValue('A'.$kolom_nip, $pegawai->nip);

			$tanggal = date('Y-m-d');
			$kolom_tandatangan_1 = $kolom_tandatangan-1;
			$kolom_tandatangan_2 = $kolom_tandatangan_1+1;
			$kolom_tandatangan_3 = $kolom_tandatangan_1+2;
			$sheet->setCellValue('F'.$kolom_tandatangan_1, 'SUMEDANG, '.Helper::getBulan($tanggal).' '.date('Y'));	
			$sheet->setCellValue('F'.$kolom_tandatangan_2, 'PENANGGUNG JAWAB UPKPB');	
			$sheet->setCellValue('F'.$kolom_tandatangan_3, 'KEPALA PKP2A I LAN');	

			$penanggungjawab = Pengaturan::getNilaiByKode('penanggung_jawab_upkpb'); 

			$sheet->setCellValue('F'.$kolom_nama_penandatangan, $penanggungjawab);
			$sheet->setCellValue('F'.$kolom_nip, 'NIP. 19540407  197501  1  001');
	
			$filename = time().'_Barang.xlsx';

			$objWriter = new Xlsx($spreadsheet);
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename='.$filename);
			header('Cache-Control: max-age=0');
			$objWriter->save('php://output');
	}

	public function actionLaporan()
	{

		$this->render('batch_laporan');
	}

	public function getCssClass($cssClass)
	{
		$cssClass;

		if ('($data->id_barang_kondisi == 1)') {
			$cssClass = 'success';
		} elseif ('$data->id_barang_kondisi == 2') {
			$cssClass = 'warning';
		} elseif ('$data->id_barang_kondisi == 3') {
			$cssClass = 'danger';
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
				if (!$model->save()) {
					print_r($model->getErrors());
					die;
				}
			}
		}

		return $this->render('importV2');
	}

	public function actionReportPerawatan()
	{
		$model = new LaporanPerawatanForm;
		if (isset($_POST['LaporanPerawatanForm'])) {

			$model->attributes = $_POST['LaporanPerawatanForm'];
			if ($model->validate()) {

				// spl_autoload_unregister(array('YiiBase','autoload'));

				// Yii::import('application.vendors.PHPExcel',true);

				// spl_autoload_register(array('YiiBase', 'autoload'));

				$criteria = new CDbCriteria;
				$params = array();

				if (!empty($_POST['LaporanPerawatanForm']['tanggal_awal'])) {
					$criteria->addCondition('tanggal >= :waktu_awal');
					$params[':waktu_awal'] = $_POST['LaporanPerawatanForm']['tanggal_awal'];
				}

				if (!empty($_POST['LaporanPerawatanForm']['tanggal_akhir'])) {
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
				$sheet->getStyle('A1:E1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); //merge and center
				$sheet->mergeCells('A1:E1'); //sama jLga
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

				foreach (BarangPerawatan::model()->findAll($criteria) as $data) {
					$sheet->setCellValue('A' . $kolom, $i);
					$sheet->setCellValue('B' . $kolom, Helper::tanggal($data->tanggal));
					$sheet->setCellValue('C' . $kolom, $data->getBarang());
					$sheet->setCellValue('D' . $kolom, $data->keterangan);
					$sheet->setCellValue('E' . $kolom, $data->waktu_dibuat);

					$sheet->getStyle('A3:E' . $kolom)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); //merge and center
					$sheet->getStyle('A2:E' . $kolom)->getFont()->setSize(9);
					$sheet->getStyle('A3:E' . $kolom)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN); //border header surat	

					$i++;
					$kolom++;
				}

				$sheet->getStyle('A3:E' . $kolom)->getAlignment()->setWrapText(true);
				$sheet->getStyle('A3:E' . $kolom)->getAlignment()->setVertical(Alignment::VERTICAL_TOP);

				$filename = time() . '_LaporanPerawatanBarang.xlsx';

				$objWriter = new Xlsx($spreadsheet);
				header('Content-Type: application/vnd.ms-excel');
				header('Content-Disposition: attachment;filename=' . $filename);
				header('Cache-Control: max-age=0');
				$objWriter->save('php://output');
				die();
			}
		}

		$model->tanggal_awal = date('Y-m') . '-01';
		$model->tanggal_akhir = date('Y-m-t');
		$this->render('laporan_perawatan', array(
			'laporanform' => $model,
			'tanggal_awal' => $model->tanggal_awal,
			'tanggal_akhir' => $model->tanggal_akhir,
		));
	}


	public function actionReportPemeriksaan()
	{
		$model = new LaporanPemeriksaanForm;

		if (isset($_POST['LaporanPemeriksaanForm'])) {

			$model->attributes = $_POST['LaporanPemeriksaanForm'];
			if ($model->validate()) {

				// spl_autoload_unregister(array('YiiBase','autoload'));

				// Yii::import('application.vendors.PHPExcel',true);

				// spl_autoload_register(array('YiiBase', 'autoload'));

				$criteria = new CDbCriteria;
				$params = array();

				if (!empty($_POST['LaporanPemeriksaanForm']['tanggal_awal'])) {
					$criteria->addCondition('tanggal >= :waktu_awal');
					$params[':waktu_awal'] = $_POST['LaporanPemeriksaanForm']['tanggal_awal'];
				}

				if (!empty($_POST['LaporanPemeriksaanForm']['tanggal_akhir'])) {
					$criteria->addCondition('tanggal <= :waktu_akhir');
					$params[':waktu_akhir'] = $_POST['LaporanPemeriksaanForm']['tanggal_akhir'];
				}

				if (!empty($_POST['LaporanPemeriksaanForm']['kondisi'])) {
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
				$sheet->getStyle('A1:F1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); //merge and center
				$sheet->mergeCells('A1:F1'); //sama jLga
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

				foreach (BarangPemeriksaan::model()->findAll($criteria) as $data) {
					$sheet->setCellValue('A' . $kolom, $i);
					$sheet->setCellValue('B' . $kolom, Helper::tanggal($data->tanggal));
					$sheet->setCellValue('C' . $kolom, $data->getBarang());
					$sheet->setCellValue('D' . $kolom, $data->keterangan);
					$sheet->setCellValue('E' . $kolom, $data->getBarangKondisi());
					$sheet->setCellValue('F' . $kolom, $data->waktu_dibuat);

					$sheet->getStyle('A3:F' . $kolom)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); //merge and center
					$sheet->getStyle('A2:F' . $kolom)->getFont()->setSize(9);
					$sheet->getStyle('A3:F' . $kolom)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN); //border header surat	

					$i++;
					$kolom++;
				}

				$sheet->getStyle('A3:E' . $kolom)->getAlignment()->setWrapText(true);
				$sheet->getStyle('A3:E' . $kolom)->getAlignment()->setVertical(Alignment::VERTICAL_TOP);

				$filename = time() . '_LaporanKondisiBarang.xlsx';

				$objWriter = new Xlsx($spreadsheet);
				header('Content-Type: application/vnd.ms-excel');
				header('Content-Disposition: attachment;filename=' . $filename);
				header('Cache-Control: max-age=0');
				$objWriter->save('php://output');
				die();
			}
		}

		$model->tanggal_awal = date('Y-m') . '-01';
		$model->tanggal_akhir = date('Y-m-t');

		$this->render('laporan_pemeriksaan', array(
			'laporanform' => $model,
			'tangal_awal' => $model->tanggal_awal,
			'tanggal_akhir' => $model->tanggal_akhir,
		));
	}


	public function actionReportPemindahan()
	{
		$model = new LaporanPemindahanForm;
		if (isset($_POST['LaporanPemindahanForm'])) {

			$model->attributes = $_POST['LaporanPemindahanForm'];
			if ($model->validate()) {

				// spl_autoload_unregister(array('YiiBase','autoload'));

				// Yii::import('application.vendors.PHPExcel',true);

				// spl_autoload_register(array('YiiBase', 'autoload'));

				$criteria = new CDbCriteria;
				$params = array();

				if (!empty($_POST['LaporanPemindahanForm']['tanggal_awal'])) {
					$criteria->addCondition('tanggal >= :waktu_awal');
					$params[':waktu_awal'] = $_POST['LaporanPemindahanForm']['tanggal_awal'];
				}

				if (!empty($_POST['LaporanPemindahanForm']['tanggal_akhir'])) {
					$criteria->addCondition('tanggal <= :waktu_akhir');
					$params[':waktu_akhir'] = $_POST['LaporanPemindahanForm']['tanggal_akhir'];
				}

				if (!empty($_POST['LaporanPemindahanForm']['status'])) {
					$criteria->addCondition('id_barang_pemindahan_status <= :status');
					$params[':status'] = $_POST['LaporanPemindahanForm']['status'];
				}

				$criteria->params = $params;
				$criteria->order = 'tanggal ASC';



				$spreadsheet = new Spreadsheet();
				$spreadsheet->setActiveSheetIndex(0);
				$sheet = $spreadsheet->getActiveSheet();

				$sheet->getStyle('A3:G3')->getFont()->setBold(true);
				$sheet->getStyle("A1:G1")->getFont()->setSize(14);
				$sheet->getStyle('A1:G1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); //merge and center
				$sheet->mergeCells('A1:G1'); //sama jLga
				$sheet->setCellValueByColumnAndRow(0, 1, "LAPORAN PEMINDAHAN BARANG");

				$sheet->setCellValue('A3', 'No');
				$sheet->setCellValue('A3', 'Nomor');
				$sheet->setCellValue('B3', 'Tanggal Pemindahan');
				$sheet->setCellValue('C3', 'Lokasi Asal');
				$sheet->setCellValue('D3', 'Lokasi Tujuan');
				$sheet->setCellValue('E3', 'Status');
				$sheet->setCellValue('F3', 'Waktu Dibuat');
				$sheet->setCellValue('G3', 'Waktu Disetujui');

				$sheet->getColumnDimension('A')->setWidth(6);
				$sheet->getColumnDimension('B')->setWidth(23);
				$sheet->getColumnDimension('C')->setWidth(30);
				$sheet->getColumnDimension('D')->setWidth(45);
				$sheet->getColumnDimension('E')->setWidth(22);
				$sheet->getColumnDimension('F')->setWidth(22);
				$sheet->getColumnDimension('G')->setWidth(22);


				$i = 1;
				$kolom = 4;

				foreach (BarangPemindahan::model()->findAll($criteria) as $data) {
					$sheet->setCellValue('A' . $kolom, $i);
					$sheet->setCellValue('D' . $kolom, $data->nomor);
					$sheet->setCellValue('B' . $kolom, Helper::tanggal($data->tanggal));
					$sheet->setCellValue('C' . $kolom, $data->getLokasiAsal());
					$sheet->setCellValue('D' . $kolom, $data->getLokasiTujuan());
					$sheet->setCellValue('E' . $kolom, $data->getPemindahanStatus());
					$sheet->setCellValue('F' . $kolom, $data->waktu_dibuat);
					$sheet->setCellValue('G' . $kolom, $data->waktu_disetujui);

					$sheet->getStyle('A3:G' . $kolom)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER); //merge and center
					$sheet->getStyle('A2:G' . $kolom)->getFont()->setSize(9);
					$sheet->getStyle('A3:G' . $kolom)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN); //border header surat	

					$i++;
					$kolom++;
				}

				$sheet->getStyle('A3:G' . $kolom)->getAlignment()->setWrapText(true);
				$sheet->getStyle('A3:G' . $kolom)->getAlignment()->setVertical(Alignment::VERTICAL_TOP);

				$filename = time() . '_LaporanPemindahan.xlsx';

				$objWriter = new Xlsx($spreadsheet);
				header('Content-Type: application/vnd.ms-excel');
				header('Content-Disposition: attachment;filename=' . $filename);
				header('Cache-Control: max-age=0');
				$objWriter->save('php://output');
				die();
			}
		}
		$model->tanggal_awal = date('Y-m') . '-01';
		$model->tanggal_akhir = date('Y-m-t');

		$this->render('laporan_pemindahan', array(
			'laporanform' => $model,
			'tanggal_awal' => $model->tanggal_awal,
			'tanggal_akhir' => $model->tanggal_akhir,
		));
	}


	public function actionSelectBarang()
	{

		if (isset($_GET['q'])) {
			$queryterm  = $_GET['q'];
			$model      = new Barang;
			$barang    = Barang::model()->findAll(array('order' => 'nama', 'condition' => 'nama LIKE :nama', 'params'    => array(':nama' => $queryterm . '%')));

			$data = array();
			// ***** BEGIN change here
			foreach ($barang as $barang) {
				$data[] = array(
					'id' => $barang->kode . '-' . $barang->nup . ' - ' . $barang->nama,
					'text' => $barang->kode . '-' . $barang->nup . ' - ' . $barang->nama,
				);
			}
			// lapor lorem, yg ini ga jalan: $data = CJSON::encode(CHtml::listData($persons, 'uuid', 'lastname')) ;
			echo CJSON::encode($data);
		}
		Yii::app()->end();
	}

	public function actionCetakQrPdf($kode, $nup_awal, $nup_akhir, $nup_lainnya)
	{

		// include(Yii::app()->basePath."/vendors/mpdf/mpdf.php");

		$marginLeft = 5;
		$marginRight = 5;
		$marginTop = 5;
		$marginBottom = 5;
		$marginHeader = 5;
		$marginFooter = 5;

		$pdf = new Mpdf(['UTF-8', 'A4', 9, 'Arial', $marginLeft, $marginRight, $marginTop, $marginBottom, $marginHeader, $marginFooter]);

		$criteria = new CDbCriteria;
		$params = array();

		if (isset($_GET['kode'])) {
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
			$data = join(",", $nup_lainnya);
			$criteria->addCondition("nup IN ($data)");
		} elseif ($nup_lainnya == null && ($nup_awal !== null && $nup_akhir !== null)) {
			$criteria->addCondition('(nup >= :nup_awal AND nup <= :nup_akhir)');
			$params[':nup_awal'] = $nup_awal;
			$params[':nup_akhir'] = $nup_akhir;
		} elseif ($nup_lainnya !== null && ($nup_awal !== null && $nup_akhir !== null)) {
			$nup_lainnya = explode(',', $nup_lainnya);
			$data = join(",", $nup_lainnya);
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

		$html = $this->renderPartial('cetakQrHtml', array(
			'models' => $models,
			'qrcode' => $qrcode
		), true);

		$pdf->WriteHTML($html);

		$pdf->Output();
	}

	public function actionCetakQrcodeDbr()
	{
		$model = new CetakQrDbrForm;

		if (isset($_GET['id'])) {
			$barang = Barang::model()->findByPk($_GET['id']);
			$model->kode = $barang->kode;
			$model->nup_awal = $barang->nup;
			$model->nup_akhir = $barang->nup;
		}

		$this->performAjaxValidation($model);

		if (isset($_POST['CetakQrDbrForm'])) {
			$model->attributes = $_POST['CetakQrDbrForm'];

			if ($model->validate()) {
				$marginLeft = 5;
				$marginRight = 5;
				$marginTop = 5;
				$marginBottom = 5;
				$marginHeader = 5;
				$marginFooter = 5;

				$pdf = new Mpdf(['UTF-8', 'A4', 9, 'Arial', $marginLeft, $marginRight, $marginTop, $marginBottom, $marginHeader, $marginFooter]);

				$criteria = new CDbCriteria;
				$params = array();

				$criteria->addCondition('id_lokasi = :lokasi');
				$params[':lokasi'] = $model->id_lokasi;

				$criteria->params = $params;
				$criteria->order = 'kode,nup ASC';

				$models = Barang::model()->findAll($criteria);

				$html = $this->renderPartial('cetakQrHtml', array('models' => $models), true);

				$pdf->WriteHTML($html);

				$pdf->Output();
			}
		}

		$this->render('cetakQrDbr', array(
			'model' => $model
		));
	}
}
