<?php

class PengaturanController extends Controller
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
				'actions'=>array('index','view'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','editableUpdate',
					'detail'),
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
	
	public $menu = array(
			array('label'=>'Pengaturan','url'=>array('admin'),'icon'=>'list'),
			array('label'=>'Tambah','url'=>array('create'),'icon'=>'plus'),
			array('label'=>'Export Word','url'=>array('exportWord'),'icon'=>'download-alt'),
			array('label'=>'Export Excel','url'=>array('exportExcel'),'icon'=>'download-alt'),
	);

	/**
	* Displays a particular model.
	* @param integer $id the ID of the model to be displayed
	*/

	public function actionEditableUpdate()
	{	
		
		Yii::import('booster.components.TbEditableSaver');
	
		$es = new TbEditableSaver('Pengaturan'); 
		$es->update();
		
	}	
	
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	public function actionDetail()
	{
		$model=new User('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['User']))
			$model->attributes=$_GET['User'];	

		$this->render('detail',array('model'=>$model));	
	}
	
	public function actionExport($id)
	{
		$this->render('export',array(
			'model'=>$this->loadModel($id),
		));
	}
	
	public function actionExportAll()
	{
		$this->render('export_all',array(
			'model'=>$this->loadModel($id),
		));
	}
	

	/**
	* Creates a new model.
	* If creation is successful, the browser will be redirected to the 'view' page.
	*/
	
	public function actionCreate()
	{
		$model=new Pengaturan;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
			
		if(isset($_POST['Pengaturan']))
		{
			$model->attributes=$_POST['Pengaturan'];
			if($model->save())
			{
				Yii::app()->user->setFlash('success','Data berhasil disimpan');
				$this->redirect(array('admin'));
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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		$old_image = $model->nilai;

		if(isset($_POST['Pengaturan']))
		{
			$model->attributes=$_POST['Pengaturan'];

			$image = CUploadedFile::getInstance($model,'nilai');

			if($image!==null)
				$model->nilai = str_replace(' ','-',time().'_'.$image->name);
			else
				$model->nilai = $old_image;

			if($model->save())
			{
				
				if($image!==null)
				{
					$path = Yii::app()->basePath.'/../uploads/images/images';
					$image->saveAs($path.$model->nilai);
					
					if(file_exists($path.$old_image) AND $old_image!='')
						unlink($path.$old_image);
				}	
						
				Yii::app()->user->setFlash('success','Data berhasil disimpan');
				$this->redirect(array('detail'));
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
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		} else	
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

/**
* Lists all models.
*/
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Pengaturan');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

/**
* Manages all models.
*/
	public function actionAdmin()
	{
		$model=new Pengaturan('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Pengaturan']))
			$model->attributes=$_GET['Pengaturan'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	
	public function actionExportWord()
	{
			spl_autoload_unregister(array('YiiBase','autoload'));
		
			Yii::import('application.vendors.PHPWord',true);
		
			spl_autoload_register(array('YiiBase', 'autoload'));
		
			$PHPWord = new PHPWord();
		
			$PHPWord->addFontStyle('bold', array('bold'=>true));
			$PHPWord->addFontStyle('subjudul', array('name'=>'Arial','bold'=>true, 'size'=>11));
			$PHPWord->addFontStyle('judul', array('bold'=>true, 'size'=>16,'align'=>'center','name'=>'Times New Roman'));
		
			$tableStyle = array(
						'borderSize'=>1, 
						'borderColor'=>'000000', 
						'cellMargin'=>80,
						'border'=>true
			);
			
			$PHPWord->addTableStyle('tableStyle', $tableStyle);
		
			$center = array('align'=>'center');
		
			$paraStyle = array('spaceAfter'=>'2');
			$headStyle = array('spaceAfter'=>'2','align'=>'center');
		
			$section = $PHPWord->createSection(array('orientation'=>'landscape','marginLeft'=>500, 'marginRight'=>500, 'marginTop'=>500, 'marginBottom'=>500));
		
			$section->addText('DATA Pengaturan',array('bold'=>true,'name'=>'Times New Roman','size'=>'14'),$center);		
		
			$section->addTextBreak(1);		
		
			$table = $section->addTable('tableStyle');
		
			$table->addRow();
			
			$table->addCell(1000)->addText("No",array('bold'=>'true'),$headStyle);
			
						$table->addCell(1000)->addText('id',array('bold'=>'true'),$headStyle);
						$table->addCell(1000)->addText('nama',array('bold'=>'true'),$headStyle);
						$table->addCell(1000)->addText('nilai',array('bold'=>'true'),$headStyle);
						
			$i=1;
		
			foreach(Pengaturan::model()->findAll() as $data)
			{
				$table->addRow();
				$table->addCell(100)->addText($i,array(),$paraStyle);
								$table->addCell(100)->addText($data->id,array(),$paraStyle);
								$table->addCell(100)->addText($data->nama,array(),$paraStyle);
								$table->addCell(100)->addText($data->nilai,array(),$paraStyle);
								
				$i++;
			}		
	
			$section->addTextBreak(1);		
		
			$objWriter = PHPWord_IOFactory::createWriter($PHPWord, 'Word2007');
		
			$pathFile = Yii::app()->basePath.'/../uploads/export/';
		
			$filename = time().'_Pengaturan.docx';
		
			$objWriter->save($pathFile.$filename);
		
			$this->redirect(Yii::app()->request->baseUrl.'/uploads/export/'.$filename);
		
	
	}
	
	public function actionExportExcel()
	{
			spl_autoload_unregister(array('YiiBase','autoload'));
		
			Yii::import('application.vendors.PHPExcel',true);
		
			spl_autoload_register(array('YiiBase', 'autoload'));

			$PHPExcel = new PHPExcel();
			
			$PHPExcel->getActiveSheet()->setCellValue('A1', 'DATA Pengaturan');
		
			$PHPExcel->getActiveSheet()->setCellValue('A3', 'No');
			
						$PHPExcel->getActiveSheet()->setCellValue('B3', 'id');
						$PHPExcel->getActiveSheet()->setCellValue('B3', 'nama');
						$PHPExcel->getActiveSheet()->setCellValue('B3', 'nilai');
						
			$i = 1;
			$kolom = 4;

			foreach(Pengaturan::model()->findAll() as $data)
			{
				$PHPExcel->getActiveSheet()->setCellValue('A'.$kolom, $i);
								$PHPExcel->getActiveSheet()->setCellValue('B'.$kolom, $data->id);
								$PHPExcel->getActiveSheet()->setCellValue('B'.$kolom, $data->nama);
								$PHPExcel->getActiveSheet()->setCellValue('B'.$kolom, $data->nilai);
									
				$i++; $kolom++;
			}
	
			$filename = time().'_Pengaturan.xlsx';

			$path = Yii::app()->basePath.'/../exports/';
			$objWriter = PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel2007');
			$objWriter->save($path.$filename);	
			$this->redirect(Yii::app()->request->baseUrl.'/exports/'.$filename);
	}

/**
* Returns the data model based on the primary key given in the GET variable.
* If the data model is not found, an HTTP exception will be raised.
* @param integer the ID of the model to be loaded
*/
	public function loadModel($id)
	{
		$model=Pengaturan::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

/**
* Performs the AJAX validation.
* @param CModel the model to be validated
*/
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='pengaturan-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
