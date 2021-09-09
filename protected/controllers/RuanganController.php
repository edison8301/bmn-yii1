<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class RuanganController extends Controller
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
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
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

		$tambah = new TambahBarangForm;

		if(isset($_POST['TambahBarangForm']))
		{
			$barang = $_POST['TambahBarangForm']['barang'];			
			$list_barang = explode(';',$barang); 
	
			foreach($list_barang as $barang) 
			{ 
				$data = explode('-',$barang);
				$kode = trim($data[0]);
				$nup = trim($data[1]);

				$model=Barang::model()->findByAttributes(array('kode'=>$kode,'nup'=>$nup));
				$model->id_lokasi = $id;
				$model->save();
			} 			

			$this->redirect(array('lokasi/view','id'=>$id));
		}

		$this->render('view',array(
			'model'=>$this->loadModel($id),
			'formtambah' => $tambah,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Ruangan;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Ruangan']))
		{
			$model->attributes=$_POST['Ruangan'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Ruangan']))
		{
			$model->attributes=$_POST['Ruangan'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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
		$dataProvider=new CActiveDataProvider('Ruangan');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model = new Ruangan('search');
		$model->unsetAttributes();  // clear any default values

		if(isset($_GET['Ruangan'])) {
            $model->attributes=$_GET['Ruangan'];
        }

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Ruangan the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Ruangan::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Ruangan $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='lokasi-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionDbr($id)
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

        $sheet->setCellValue('A19', 'No Urut');
        $sheet->setCellValue('B19', 'No Urut Pendaftaran');
        $sheet->setCellValue('C19', 'Nama Barang');
        $sheet->setCellValue('D19', 'Tanda Pengenal Barang');
        $sheet->setCellValue('D20', 'Merek / Type');
        $sheet->setCellValue('E20', 'Kode Barang');
        $sheet->setCellValue('F20', 'Tahun Perolehan');
        $sheet->setCellValue('G19', 'Jumlah Barang');
        $sheet->setCellValue('H19', 'Ket.');

        $sheet->setCellValue('A21', '1');
        $sheet->setCellValue('B21', '2');
        $sheet->setCellValue('C21', '3');
        $sheet->setCellValue('D21', '4');
        $sheet->setCellValue('E21', '5');
        $sheet->setCellValue('F21', '6');
        $sheet->setCellValue('G21', '7');
        $sheet->setCellValue('H21', '8');

        $sheet->getColumnDimension('A')->setWidth(6);
        $sheet->getColumnDimension('B')->setWidth(14);
        $sheet->getColumnDimension('C')->setWidth(16);
        $sheet->getColumnDimension('D')->setWidth(20);
        $sheet->getColumnDimension('E')->setWidth(20);
        $sheet->getColumnDimension('F')->setWidth(20);
        $sheet->getColumnDimension('G')->setWidth(18);
        $sheet->getColumnDimension('H')->setWidth(17);

		$i = 1;
			$kolom = 22;
			$bawah = 24;

			foreach(Barang::model()->findAll($criteria) as $data)
			{
				$sheet->setCellValue('A'.$kolom, $i);
				$sheet->setCellValue('B'.$kolom, $data->nup);
				$sheet->setCellValue('C'.$kolom, $data->nama);
				$sheet->setCellValue('D'.$kolom, $data->merek);
				$sheet->setCellValue('E'.$kolom, $data->kode);
				$sheet->setCellValue('F'.$kolom, $data->tahun_perolehan);
				$sheet->setCellValue('G'.$kolom, '1');
				$sheet->setCellValue('H'.$kolom, '');

				$sheet->getStyle('A2:H'.$kolom)->getFont()->setSize(9);
				$sheet->getStyle('A19:H'.$kolom)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//border header surat	
									
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

}
