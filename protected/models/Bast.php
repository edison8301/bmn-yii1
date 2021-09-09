<?php

/**
 * This is the model class for table "bast".
 *
 * The followings are the available columns in table 'bast':
 * @property integer $id
 * @property string $nomor
 * @property string $tanggal
 * @property integer $id_pegawai_pihak_pertama
 * @property integer $id_pegawai_pihak_kedua
 * @property integer $id_barang
 * @property integer $jumlah
 * @property integer $status_bast
 * @property integer $id_jenis_bast
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 */
class Bast extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bast';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_pegawai_pihak_pertama, id_pegawai_pihak_kedua, id_barang, jumlah, status_bast, id_jenis_bast', 'numerical', 'integerOnly'=>true),
			array('nomor, berkas_bast', 'length', 'max'=>255),
			array('tanggal, created_at, updated_at, deleted_at', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nomor, tanggal, id_pegawai_pihak_pertama, id_pegawai_pihak_kedua, id_barang, jumlah, status_bast, id_jenis_bast, created_at, updated_at, deleted_at', 'safe', 'on'=>'search'),
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
			'pihakPertama' => array(self::BELONGS_TO,'Pegawai','id_pegawai_pihak_pertama'),
			'pihakKedua' => array(self::BELONGS_TO,'Pegawai','id_pegawai_pihak_kedua'),
			'barang' => array(self::BELONGS_TO,'Barang','id_barang')
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
			'tanggal' => 'Tanggal',
			'id_pegawai_pihak_pertama' => 'Pihak Pertama',
			'id_pegawai_pihak_kedua' => 'Pihak Kedua',
			'id_barang' => 'Barang',
			'jumlah' => 'Jumlah',
			'status_bast' => 'Status Bast',
			'id_jenis_bast' => 'Jenis Bast',
			'created_at' => 'Created At',
			'updated_at' => 'Updated At',
			'deleted_at' => 'Deleted At',
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
		$criteria->compare('id_pegawai_pihak_pertama',$this->id_pegawai_pihak_pertama);
		$criteria->compare('id_pegawai_pihak_kedua',$this->id_pegawai_pihak_kedua);
		$criteria->compare('id_barang',$this->id_barang);
		$criteria->compare('jumlah',$this->jumlah);
		$criteria->compare('status_bast',$this->status_bast);
		$criteria->compare('id_jenis_bast',$this->id_jenis_bast);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('updated_at',$this->updated_at,true);
		$criteria->compare('deleted_at',$this->deleted_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Bast the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
