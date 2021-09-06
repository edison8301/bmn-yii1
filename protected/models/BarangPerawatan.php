<?php

/**
 * This is the model class for table "perawatan".
 *
 * The followings are the available columns in table 'perawatan':
 * @property integer $id
 * @property integer $id_barang
 * @property string $tanggal
 * @property string $keterangan
 * @property string $waktu_dibuat
 */
class BarangPerawatan extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'barang_perawatan';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_barang', 'numerical', 'integerOnly'=>true),
			array('tanggal, keterangan, waktu_dibuat', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_barang, tanggal, keterangan, waktu_dibuat', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'barang'=>array(self::BELONGS_TO,'Barang','id_barang')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_barang' => 'Barang',
			'tanggal' => 'Tanggal',
			'keterangan' => 'Keterangan',
			'waktu_dibuat' => 'Waktu Dibuat',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('id_barang',$this->id_barang);
		$criteria->compare('tanggal',$this->tanggal,true);
		$criteria->compare('keterangan',$this->keterangan,true);
		$criteria->compare('waktu_dibuat',$this->waktu_dibuat,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function filterTanggal($waktu)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;



		if($waktu == 'hari_ini')
		{
	   		$hari_ini = date('Y-m-d'); 
	    
		    $criteria->condition = 'tanggal = :hari_ini';
		    $criteria->params = array(':hari_ini'=>$hari_ini);			
		}

		if($waktu == 'bulan_ini')
		{
			$tanggal = date('Y-m');

   		 	$criteria = new CDbCriteria;

   			$awal = $tanggal.'-01';
    		$akhir = $tanggal.'-31';
    
	    	$criteria->condition = 'tanggal >= :awal AND tanggal <= :akhir';
	    	$criteria->params = array(':awal'=>$awal,':akhir'=>$akhir);	
		}



		if($waktu == 'tahun_ini')
		{
			$tanggal = date('Y');

   			$awal = $tanggal.'-01-01';
    		$akhir = $tanggal.'-12-31';
	    
		    $criteria->condition = 'tanggal >= :awal AND tanggal <= :akhir';
		    $criteria->params = array(':awal'=>$awal,':akhir'=>$akhir);	

		}

		$criteria->compare('id',$this->id);
		$criteria->compare('id_barang',$this->id_barang);
		$criteria->compare('tanggal',$this->tanggal,true);
		$criteria->compare('keterangan',$this->keterangan,true);
		$criteria->compare('waktu_dibuat',$this->waktu_dibuat,true);


		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public static function getCountSuratMingguIni()
	{


   		 	$criteria = new CDbCriteria;


    
	    	$jumlah = Surat::model()->count($criteria);
	    	return $jumlah;
	}	

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Perawatan the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getBarang()
	{
		$model = Barang::model()->findByPk($this->id_barang);
		if($model !==null)
			return $model->nama;
		else
			return false;
	}

	public static function listData()
	{

		$models = Barang::model()->findAll();

		foreach($models as $model)
		{
			$listData[$model->id]=$model->nama.' -- '.$model->kode.' -- '.$model->nup;
		}
		return $listData;
	}

/* n*/

	public static function countHariIni()
	{
		date_default_timezone_set('Asia/Jakarta');
		$awal = date('Y-m-d').' 00:00:00';
		$akhir = date('Y-m-d').' 23:59:59';

		$criteria = new CDbCriteria;
		$criteria->addCondition('tanggal >= :awal AND tanggal <= :akhir');
		$criteria->params=array(':awal'=>$awal,':akhir'=>$akhir);

		return BarangPerawatan::model()->count($criteria);
	}

	public static function countBulanIni()
	{
		date_default_timezone_set('Asia/Jakarta');
		$awal = date('Y-m-01');
		$akhir = date('Y-m-t');

		$criteria = new CDbCriteria;
		$criteria->addCondition('tanggal >= :awal AND tanggal <= :akhir');
		$criteria->params=array(':awal'=>$awal,':akhir'=>$akhir);

		return BarangPerawatan::model()->count($criteria);
	}

	public static function countTahunIni()
	{
		date_default_timezone_set('Asia/Jakarta');

		$awal = date('Y').'-01-01 00:00:00';
		$akhir = date('Y').'-12-31 23:59:59';

		$criteria = new CDbCriteria;
		$criteria->addCondition('tanggal >= :awal AND tanggal <= :akhir');
		$criteria->params=array(':awal'=>$awal,':akhir'=>$akhir);

		return BarangPerawatan::model()->count($criteria);
	}

	public static function getChartPerBulan()
	{
		$dataChartBulan = '';

        $tahun = date('Y');

		for($i=1;$i<=12;$i++)
		{
            $bulan = $i;

    		$datetime = DateTime::createFromFormat('Y-n-d',$tahun.'-'.$bulan.'-01');

	   		$awal = $datetime->format('Y-m-01');
    		$akhir = $datetime->format('Y-m-t');

            $criteria = new CDbCriteria;
            $criteria->condition = 'tanggal >= :awal AND tanggal <= :akhir';
            $criteria->params = [
                ':awal' => $awal,
                ':akhir' => $akhir
            ];

	        $jumlah_perawatan = BarangPerawatan::model()->count($criteria);

            $nama_bulan = '';
            if($i==1) $nama_bulan = 'Jan';
            if($i==2) $nama_bulan = 'Feb';
            if($i==3) $nama_bulan = 'Mar';
            if($i==4) $nama_bulan = 'Apr';
            if($i==5) $nama_bulan = 'Mei';
            if($i==6) $nama_bulan = 'Jun';
            if($i==7) $nama_bulan = 'Jul';
            if($i==8) $nama_bulan = 'Aug';
            if($i==9) $nama_bulan = 'Sep';
            if($i==10) $nama_bulan = 'Oct';
            if($i==11) $nama_bulan = 'Nov';
            if($i==12) $nama_bulan = 'Des';

    		$dataChartBulan .= '{"label":"'.$nama_bulan.'","value":"'.$jumlah_perawatan.'"},';
		}

	return $dataChartBulan;

	}

	public function getRelation($relation,$field)
	{
		if(!empty($this->$relation->$field))
			return $this->$relation->$field;
		else
			return null;
	}

	public function findBarang()
	{
			return Barang::model()->findByPk($this->id_barang);
	}

	protected function afterSave()
	{
			$barang = $this->findBarang();
			
			if($barang!=null)
			{
					$barang->updatePerawatanTerkahir();
			}
	}


}
