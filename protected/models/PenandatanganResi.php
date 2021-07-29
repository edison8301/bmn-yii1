<?php

/**
 * This is the model class for table "penandatangan_resi".
 *
 * The followings are the available columns in table 'penandatangan_resi':
 * @property integer $id
 * @property string $penanggung_jawab_ruangan
 * @property string $petugas_bmn
 * @property string $kasubag_umum_sdm
 */
class PenandatanganResi extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'penandatangan_resi';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('penanggung_jawab_ruangan, petugas_bmn, kasubag_umum_sdm', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, penanggung_jawab_ruangan, petugas_bmn, kasubag_umum_sdm', 'safe', 'on'=>'search'),
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
			'penanggung_jawab_ruangan' => 'Penanggung Jawab Ruangan',
			'petugas_bmn' => 'Petugas Bmn',
			'kasubag_umum_sdm' => 'Kasubag Umum Sdm',
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
		$criteria->compare('penanggung_jawab_ruangan',$this->penanggung_jawab_ruangan,true);
		$criteria->compare('petugas_bmn',$this->petugas_bmn,true);
		$criteria->compare('kasubag_umum_sdm',$this->kasubag_umum_sdm,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PenandatanganResi the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
