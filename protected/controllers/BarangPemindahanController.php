<?php
use Mpdf\Mpdf;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

class BarangPemindahanController extends Controller
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
'actions'=>array('create','update','status','pemindahanBarang','cetakResi'),
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

/**
* Displays a particular model.
* @param integer $id the ID of the model to be displayed
*/
	public function actionView($id)
	{
		$view = $this->loadModel($id);

		$tambah = new TambahBarangForm;
		if(isset($_POST['TambahBarangForm']))
		{
			$barang = $_POST['TambahBarangForm']['barang'];	
			$id_barang_pemindahan = $_POST['TambahBarangForm']['id_barang_pemindahan'];		
		
				$list_penerima = explode(';',$barang); 
	
			foreach($list_penerima as $penerima) { 

				$data = explode('-',$penerima);
				$id = trim($data[0]);

				$model= new BarangPemindahanDetail;
				$model->id_barang = $id;
				$model->id_barang_pemindahan = $id_barang_pemindahan;
				$model->save();
		} 			
		$this->redirect(array('view','id'=>$view->id));
		}	
		$this->render('view',array(
			'model'=>$this->loadModel($id),
			'formtambah' => $tambah,
		));
	}

	public function actionStatus($id)
	{
		$model = $this->loadModel($id);
		$status = $_GET['status'];
		$model->id_barang_pemindahan_status = $status;
		if($model->save())
			$this->redirect(array('view','id'=>$model->id));
	}

	public function actionPemindahanBarang($id)
	{
		$model = $this->loadModel($id);
		$status = $_GET['status'];
		date_default_timezone_set('Asia/Jakarta');
		$model->waktu_disetujui = date('Y-m-d H:i:s');
		$model->id_barang_pemindahan_status = $status;
		$model->save();
		$pemindahan_detail = new BarangPemindahanDetail;
		foreach($pemindahan_detail->findAllByAttributes(array('id_barang_pemindahan'=>$model->id)) as $pemindahan)
		{
			$barang = $this->loadModelBarang($pemindahan->id_barang);
			$barang->id_lokasi = $model->id_lokasi_tujuan;
			$barang->save();
		}
		$this->redirect(array('view','id'=>$model->id));

	}


	public function actionCetakResi($id)
	{
		$model = $this->loadModel($id);

        $this->layout = false;
		$mpdf = new Mpdf([
			''
		]);
		$options = new QROptions([
			'version'    => 5,
			'outputType' => QRCode::OUTPUT_MARKUP_SVG,
			'eccLevel'   => QRCode::ECC_L,
		]);

		$qrcode = new QRCode($options);
        $mpdf->WriteHTML($this->render('cetak_resi', [
            'model' => $model,
            'qrcode' => $qrcode
        ], true));
        $mpdf->Output();
	}

/**
* Creates a new model.
* If creation is successful, the browser will be redirected to the 'view' page.
*/
	public function actionCreate()
	{
		$model=new BarangPemindahan;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['BarangPemindahan']))
		{
			$model->attributes=$_POST['BarangPemindahan'];
			date_default_timezone_set('Asia/Jakarta');
			$model->waktu_dibuat = date('Y-m-d H:i:s');
		if($model->save())
			$model->setNomor();
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

if(isset($_POST['BarangPemindahan']))
{
$model->attributes=$_POST['BarangPemindahan'];
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
if(Yii::app()->request->isPostRequest)
{
// we only allow deletion via POST request
$this->loadModel($id)->delete();

// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
if(!isset($_GET['ajax']))
$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
}
else
throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
}

/**
* Lists all models.
*/
public function actionIndex()
{
$dataProvider=new CActiveDataProvider('BarangPemindahan');
$this->render('index',array(
'dataProvider'=>$dataProvider,
));
}

/**
* Manages all models.
*/
public function actionAdmin()
{
$model=new BarangPemindahan('search');
$model->unsetAttributes();  // clear any default values
if(isset($_GET['BarangPemindahan']))
$model->attributes=$_GET['BarangPemindahan'];

$this->render('admin',array(
'model'=>$model,
));
}

/**
* Returns the data model based on the primary key given in the GET variable.
* If the data model is not found, an HTTP exception will be raised.
* @param integer the ID of the model to be loaded
*/
public function loadModel($id)
{
$model=BarangPemindahan::model()->findByPk($id);
if($model===null)
throw new CHttpException(404,'The requested page does not exist.');
return $model;
}

public function loadModelBarang($id)
{
$model=Barang::model()->findByPk($id);
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
if(isset($_POST['ajax']) && $_POST['ajax']==='barang-pemindahan-form')
{
echo CActiveForm::validate($model);
Yii::app()->end();
}
}
}
