<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property integer $role_id
 */
class User extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password, role_id', 'required'),
			array('role_id', 'numerical', 'integerOnly'=>true),
			array('username, password', 'length', 'max'=>255),
			['nip','safe'],
			['id_pegawai','safe'],
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, username, password, role_id', 'safe', 'on'=>'search'),
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
            'pegawai'=>array(self::BELONGS_TO,'Pegawai','id_pegawai'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Username',
			'password' => 'Password',
			'role_id' => 'Role',
            'nip' => 'Pegawai',
            'id_pegawai' => 'Nama Pegawai'
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
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('role_id',$this->role_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getNamaRole()
    {
        if($this->role_id == 1) {
            return "Admin";
        }

        if($this->role_id == 2) {
            return "Pegawai";
        }
    }

    public function getKeterangan()
    {
        if($this->role_id == 1) {
            return '';
        }

        if($this->role_id == 2) {
            if($this->pegawai !== null) {
                return @$this->pegawai->nama;
            }

            return 'Pegawai Belum Ditentukan';
        }
    }

    public function getPegawai()
    {
        return Pegawai::model()->findByAttributes([
            'nip' => $this->nip
        ]);
    }

    public static function isPegawai()
    {
        if(Yii::app()->session['id_user_role'] == 2) {
            return true;
        }

        return false;
    }
}
