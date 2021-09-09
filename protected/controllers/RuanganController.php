<?php

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

        spl_autoload_unregister(array('YiiBase','autoload'));
		
        Yii::import('application.vendors.PHPExcel',true);

        spl_autoload_register(array('YiiBase', 'autoload'));

        $PHPExcel = new PHPExcel();

        $PHPExcel->getActiveSheet()->getStyle('A7:H21')->getFont()->setBold(true);


        $PHPExcel->getActiveSheet()->mergeCells('A7:H7');
        $PHPExcel->getActiveSheet()->mergeCells('A8:H8');
        $PHPExcel->getActiveSheet()->mergeCells('A13:H13');
        $PHPExcel->getActiveSheet()->mergeCells('A14:H14');


        $PHPExcel->getActiveSheet()->getStyle('A10:H12')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);//merge and center
        $PHPExcel->getActiveSheet()->getStyle('A15:H17')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);//merge and center
        $PHPExcel->getActiveSheet()->getStyle('A7:H8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);//merge and center
        $PHPExcel->getActiveSheet()->getStyle('A13:H14')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);//merge and center

        $PHPExcel->getActiveSheet()->getStyle('A19:H21')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);//merge and center

        $objDrawing = new PHPExcel_Worksheet_Drawing();
        $objDrawing->setName('Logo');
        $objDrawing->setDescription('Logo');
        $logo = 'images/makarti.png';
        $objDrawing->setPath($logo);
        $objDrawing->setOffsetX(130);    // setOffsetX works properly
        $objDrawing->setOffsetY(300);  //setOffsetY has no effect
        $objDrawing->setCoordinates('D1');
        $objDrawing->setHeight(75); // logo height
        $objDrawing->setWidth(115); // logo height
        $objDrawing->setWorksheet($PHPExcel->getActiveSheet());

        $PHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 7, "PUSAT KAJIAN DAN PENDIDIKAN DAN PELATIHAN APARATUR I");
        $PHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 8, "LEMBAGA ADMINISTRASI NEGARA");
        $PHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 13, "DAFTAR BARANG RUANGAN");
        $PHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 14, "(DBR)");
        $PHPExcel->getActiveSheet()->setCellValue('A10', 'UPPB');
        $PHPExcel->getActiveSheet()->setCellValue('A11', 'UPPB-E1');
        $PHPExcel->getActiveSheet()->setCellValue('A12', 'UUPPB-W');
        $PHPExcel->getActiveSheet()->setCellValue('A15', 'KODE UPKPB');
        $PHPExcel->getActiveSheet()->setCellValue('A16', 'Nama Unit UPKPB');
        $PHPExcel->getActiveSheet()->setCellValue('A17', 'Nomor Ruang');

        $PHPExcel->getActiveSheet()->setCellValue('C10', ': LEMBAGA ADMINISTRASI NEGARA');
        $PHPExcel->getActiveSheet()->setCellValue('C11', ': LEMBAGA ADMINISTRASI NEGARA');
        $PHPExcel->getActiveSheet()->setCellValue('C12', ': PKP2A I LAN');

        $PHPExcel->getActiveSheet()->setCellValue('C15', ': 086.01.02.450423.000');
        $PHPExcel->getActiveSheet()->setCellValue('C16', ': PKP2A I LAN');
        //$PHPExcel->getActiveSheet()->setCellValue('C17', ': '.$_GET['lokasi']);


        $PHPExcel->getActiveSheet()->mergeCells('D19:F19');


        $PHPExcel->getActiveSheet()->mergeCells('A19:A20');
        $PHPExcel->getActiveSheet()->mergeCells('B19:B20');
        $PHPExcel->getActiveSheet()->mergeCells('C19:C20');
        $PHPExcel->getActiveSheet()->mergeCells('H19:H20');

        $PHPExcel->getActiveSheet()->mergeCells('G19:G20');

        $PHPExcel->getActiveSheet()->setCellValue('A19', 'No Urut');
        $PHPExcel->getActiveSheet()->setCellValue('B19', 'No Urut Pendaftaran');
        $PHPExcel->getActiveSheet()->setCellValue('C19', 'Nama Barang');
        $PHPExcel->getActiveSheet()->setCellValue('D19', 'Tanda Pengenal Barang');
        $PHPExcel->getActiveSheet()->setCellValue('D20', 'Merek / Type');
        $PHPExcel->getActiveSheet()->setCellValue('E20', 'Kode Barang');
        $PHPExcel->getActiveSheet()->setCellValue('F20', 'Tahun Perolehan');
        $PHPExcel->getActiveSheet()->setCellValue('G19', 'Jumlah Barang');
        $PHPExcel->getActiveSheet()->setCellValue('H19', 'Ket.');

        $PHPExcel->getActiveSheet()->setCellValue('A21', '1');
        $PHPExcel->getActiveSheet()->setCellValue('B21', '2');
        $PHPExcel->getActiveSheet()->setCellValue('C21', '3');
        $PHPExcel->getActiveSheet()->setCellValue('D21', '4');
        $PHPExcel->getActiveSheet()->setCellValue('E21', '5');
        $PHPExcel->getActiveSheet()->setCellValue('F21', '6');
        $PHPExcel->getActiveSheet()->setCellValue('G21', '7');
        $PHPExcel->getActiveSheet()->setCellValue('H21', '8');

        $PHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(6);
        $PHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(14);
        $PHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(16);
        $PHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
        $PHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
        $PHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
        $PHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(18);
        $PHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(17);






			$i = 1;
			$kolom = 22;
			$bawah = 24;

			foreach(Barang::model()->findAll($criteria) as $data)
			{
				$PHPExcel->getActiveSheet()->setCellValue('A'.$kolom, $i);
				$PHPExcel->getActiveSheet()->setCellValue('B'.$kolom, $data->nup);
				$PHPExcel->getActiveSheet()->setCellValue('C'.$kolom, $data->nama);
				$PHPExcel->getActiveSheet()->setCellValue('D'.$kolom, $data->merek);
				$PHPExcel->getActiveSheet()->setCellValue('E'.$kolom, $data->kode);
				$PHPExcel->getActiveSheet()->setCellValue('F'.$kolom, $data->tahun_perolehan);
				$PHPExcel->getActiveSheet()->setCellValue('G'.$kolom, '1');
				$PHPExcel->getActiveSheet()->setCellValue('H'.$kolom, '');

				$PHPExcel->getActiveSheet()->getStyle('A2:H'.$kolom)->getFont()->setSize(9);
				$PHPExcel->getActiveSheet()->getStyle('A19:H'.$kolom)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);//border header surat	
									
				$i++; $kolom++;


				$bawah = $kolom+2;
			}

			$peringatan = "TIDAK DIBENARKAN MEMINDAHKAN BARANG-BARANG YANG ADA PADA DAFTAR BARANG RUANG INI TANPA SEPENGETAHUAN PENANGGUNG JAWAB RUANGAN DAN PENANGGUNG JAWAB UPKBP.";

			$PHPExcel->getActiveSheet()->setCellValue('A'.$bawah, $peringatan);

			$kolom_peringatan = $bawah + 2;

			$PHPExcel->getActiveSheet()->mergeCells('A'.$bawah.':H'.$kolom_peringatan.'');

			$PHPExcel->getActiveSheet()->getStyle('A19:H'.$kolom)->getAlignment()->setWrapText(true);
			$PHPExcel->getActiveSheet()->getStyle('A'.$bawah.':H'.$bawah)->getAlignment()->setWrapText(true);

			$PHPExcel->getActiveSheet()->getStyle('A22:H'.$kolom)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
			$PHPExcel->getActiveSheet()->getStyle('A22:B'.$kolom)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$PHPExcel->getActiveSheet()->getStyle('E22:H'.$kolom)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);			

			$PHPExcel->getActiveSheet()->getStyle('A'.$bawah.':H'.$bawah)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			$PHPExcel->getActiveSheet()->getStyle('A'.$bawah.':H'.$bawah.'')->getFont()->setBold(true);
			$PHPExcel->getActiveSheet()->getStyle('A'.$bawah.':H'.$bawah.'')->getFont()->setSize(16);

			$PHPExcel->getActiveSheet()->getStyle('A1:H17')->getFont()->setSize(13);
			$PHPExcel->getActiveSheet()->getStyle('A22:H19')->getFont()->setSize(11);

			//=============================== Tandatangan =====================================/

			$kolom_tandatangan = $bawah + 6;
			$kolom_nama_penandatangan = $kolom_tandatangan + 6;
			$kolom_nip = $kolom_tandatangan + 7;
			$pegawai = Pegawai::model()->findByAttributes(array('id'=>$model->id_pegawai));

			$PHPExcel->getActiveSheet()->setCellValue('A'.$kolom_tandatangan, 'PENANGGUNG JAWAB RUANGAN');

			$PHPExcel->getActiveSheet()->setCellValue('A'.$kolom_nama_penandatangan, $model->getPegawai());
			$PHPExcel->getActiveSheet()->setCellValue('A'.$kolom_nip, $pegawai->nip);

			$tanggal = date('Y-m-d');
			$kolom_tandatangan_1 = $kolom_tandatangan-1;
			$kolom_tandatangan_2 = $kolom_tandatangan_1+1;
			$kolom_tandatangan_3 = $kolom_tandatangan_1+2;
			$PHPExcel->getActiveSheet()->setCellValue('F'.$kolom_tandatangan_1, 'SUMEDANG, '.Helper::getBulan($tanggal).' '.date('Y'));	
			$PHPExcel->getActiveSheet()->setCellValue('F'.$kolom_tandatangan_2, 'PENANGGUNG JAWAB UPKPB');	
			$PHPExcel->getActiveSheet()->setCellValue('F'.$kolom_tandatangan_3, 'KEPALA PKP2A I LAN');	

			$penanggungjawab = Pengaturan::getNilaiByKode('penanggung_jawab_upkpb'); 

			$PHPExcel->getActiveSheet()->setCellValue('F'.$kolom_nama_penandatangan, $penanggungjawab);
			$PHPExcel->getActiveSheet()->setCellValue('F'.$kolom_nip, 'NIP. 19540407  197501  1  001');
	
			
	
			$filename = time().'_Barang.xlsx';

			$path = Yii::app()->basePath.'/../uploads/export/';
			$objWriter = PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel2007');
			$objWriter->save($path.$filename);	
			$this->redirect(Yii::app()->request->baseUrl.'/uploads/export/'.$filename);
	}

}
