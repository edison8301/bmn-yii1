<?php

/**
 * This is the model class for table "lokasi".
 *
 * The followings are the available columns in table 'lokasi':
 * @property integer $id
 * @property string $nama
 */
class Ruangan extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ruangan';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('kode, nama','required','message'=>'{attribute} harus diisi'),
			array('kode, nama', 'length', 'max'=>255),
			['id_lokasi, id_pegawai', 'numerical','integerOnly'=>true],
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nama, id_pegawai', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
        return array(
            'lokasi' => [self::BELONGS_TO,'Lokasi','id_lokasi'],
            'pegawai' => [self::BELONGS_TO,'Pegawai','id_pegawai'],
        );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nama' => 'Nama Ruangan',
			'kode'=>'Kode Ruangan',
            'id_lokasi' => 'Lokasi',
            'id_pegawai' => 'PJ Ruangan',
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
		$criteria->compare('nama',$this->nama,true);

		$criteria->order = 'kode ASC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Ruangan the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function findAllBarang()
	{
		$model = Barang::model()->findAllByAttributes([
		    'id_ruangan'=>$this->id
        ]);
		
		if($model!==null) {
            return $model;
        } else {
            return false;
        }
	}

	public static function getListData()
	{
		$list = array();
		$criteria = new CDbCriteria;
		$criteria->order = 'kode ASC';
		foreach(Ruangan::model()->findAll($criteria) as $data)
		{
			$list[$data->id] = $data->nama.' - '.@$data->lokasi->nama;
		}

		return $list;
	}

	public function getRuangan()
	{
		$model = Barang::model()->findByPk($this->id_lokasi);
		if($model !==null)
			return $model->nama;
		else
			return null;
	}

	public function getCountData()
	{
		return Barang::model()->countByAttributes(array('id_lokasi'=>$this->id));
	}

	public function getCountRuangan()
	{
		return Barang::model()->countByAttributes(array('id_lokasi'=>$this->id));
	}

	public static function getList()
	{
		$list = array();

		foreach(Ruangan::model()->findAll() as $data) {
			$list[$data->id]=$data->kode.' - '.$data->nama.' - ['.$data->getGedung().']';
		}

		return $list;
	}

	public function getCountBarang()
    {
        return Barang::model()->countByAttributes([
            'id_ruangan' => $this->id
        ]);
    }
}
