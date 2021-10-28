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
			array('id_pegawai_pihak_pertama, id_pegawai_pihak_kedua, id_barang, jumlah, status_bast', 'numerical', 'integerOnly'=>true),
			array('nomor, berkas_bast', 'length', 'max'=>255),
			['kode_barang, nup_barang, jabatan_pihak_pertama,jabatan_pihak_kedua,jumlah_unit,nama_barang,id_barang','safe'],
			array('tanggal, created_at, updated_at, deleted_at,id_jenis_bast','safe'),
			['id_bast_jenis','numerical','integerOnly'=>true],
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
			'jabatan_pihak_pertama',
			'jabatan_pihak_kedua',
			'status_bast' => 'Status Bast',
			'id_jenis_bast' => 'Jenis Bast',
			'id_bast_jenis' => 'Jenis BAST',
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

	public function getTanggalByFormat($format)
    {
        $datetime = DateTime::createFromFormat('Y-m-d',$this->tanggal);
        return $datetime->format($format);
    }

    public function getNamaHariFromTanggal()
    {
        $i = $this->getTanggalByFormat('N');

        if($i == 1) {
            return "Senin";
        }

        if($i == 2) {
            return "Selasa";
        }

        if($i == 3) {
            return "Rabu";
        }

        if($i == 4) {
            return "Kamis";
        }

        if($i == 5) {
            return "Jumat";
        }

        if($i == 6) {
            return "Sabtu";
        }

        if($i == 7) {
            return "Minggu";
        }
    }

    public function getNamaBulanByTanggal()
    {
        $i = $this->getTanggalByFormat('n');

        if($i == 1) {
            $bulan = 'Januari';
        }
        if($i == 2) {
            $bulan = 'Februari';
        }
        if($i == 3) {
            $bulan = 'Maret';
        }
        if($i == 4) {
            $bulan = 'April';
        }
        if($i == 5) {
            $bulan = 'Mei';
        }
        if($i == 6) {
            $bulan = 'Juni';
        }
        if($i == 7) {
            $bulan = 'Juli';
        }
        if($i == 8) {
            $bulan = 'Agustus';
        }
        if($i == 9) {
            $bulan = 'September';
        }
        if($i == 10) {
            $bulan = 'Oktober';
        }

        if($i == '11') {
            $bulan = 'November';
        }

        if($i == '12') {
            $bulan = 'Desember';
        }

        return $bulan;

    }

    public function getBarang()
    {
        return Barang::model()->findByAttributes([
            'kode' => $this->kode_barang,
            'nup' => $this->nup_barang
        ]);
    }

     public function getJenisBast()
    {
    	$data = $this->id_bast_jenis;

    	if($data == 1){
    		return "Penggunaan";
    	}

    	if($data == 2) {
    		return "Pengembalian";
    	}

    	if($data == 3) {
    		return "Hibah";
    	}

    	if($data == 4) {
    		return "Transfer Asset";
    	}
        
    }
}
