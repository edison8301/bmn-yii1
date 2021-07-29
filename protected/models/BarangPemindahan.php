<?php

/**
 * This is the model class for table "barang_pemindahan".
 *
 * The followings are the available columns in table 'barang_pemindahan':
 * @property integer $id
 * @property string $nomor
 * @property string $tanggal
 * @property integer $id_lokasi_asal
 * @property integer $id_lokasi_tujuan
 * @property integer $id_barang_pemindahan_status
 * @property string $waktu_disetujui
 * @property string $waktu_dibuat
 */
class BarangPemindahan extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'barang_pemindahan';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_lokasi_asal, id_lokasi_tujuan, id_barang_pemindahan_status', 'numerical', 'integerOnly'=>true),
			array('tanggal, id_lokasi_asal, id_lokasi_tujuan', 'required'),
			array('nomor', 'length', 'max'=>255),
			array('tanggal, waktu_disetujui, waktu_dibuat', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nomor, tanggal, id_lokasi_asal, id_lokasi_tujuan, id_barang_pemindahan_status, waktu_disetujui, waktu_dibuat', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nomor' => 'Nomor',
			'tanggal' => 'Tanggal Pemindahan',
			'id_lokasi_asal' => 'Lokasi Asal',
			'id_lokasi_tujuan' => 'Lokasi Tujuan',
			'id_barang_pemindahan_status' => 'Status',
			'waktu_disetujui' => 'Waktu Disetujui',
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
		$criteria->compare('nomor',$this->nomor,true);
		$criteria->compare('tanggal',$this->tanggal,true);
		$criteria->compare('id_lokasi_asal',$this->id_lokasi_asal);
		$criteria->compare('id_lokasi_tujuan',$this->id_lokasi_tujuan);
		$criteria->compare('id_barang_pemindahan_status',$this->id_barang_pemindahan_status);
		$criteria->compare('waktu_disetujui',$this->waktu_disetujui,true);
		$criteria->compare('waktu_dibuat',$this->waktu_dibuat,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BarangPemindahan the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getLokasiAsal()
	{
		$model = Lokasi::model()->findByPk($this->id_lokasi_asal);
		if($model !==null)
			return $model->nama;
		else
			return null;
	}

	public function getLokasiTujuan()
	{
		$model = Lokasi::model()->findByPk($this->id_lokasi_tujuan);
		if($model !==null)
			return $model->nama;
		else
			return null;
	}	

	public function getPemindahanStatus()
	{
		$model = BarangPemindahanStatus::model()->findByPk($this->id_barang_pemindahan_status);
		if($model !==null)
			return $model->nama;
		else
			return null;
	}		

	public function setNomor()
	{
		if (strlen($this->id)==1) {
			$this->nomor = '00'.$this->id;
		} elseif (strlen($this->id)==2) {
			$this->nomor = '0'.$this->id;
		} else {
			$this->nomor = $this->id;
		}
		$this->save();
		return true;
	}
}
