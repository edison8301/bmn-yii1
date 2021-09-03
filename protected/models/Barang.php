<?php

/**
 * This is the model class for table "barang".
 *
 * The followings are the available columns in table 'barang':
 * @property integer $id
 * @property string $kode
 * @property string $nama
 * @property string $tahun
 * @property string $tahun_perolehan
 * @property string $asal_perolehan
 * @property string $masa_manfaat
 * @property integer $id_barang_kondisi
 * @property string $sk_psp
 * @property string $sk_penghapusan
 * @property integer $id_lokasi
 * @property integer $id_pegawai
 * @property string $gambar
 * @property string $waktu_diubah
 * @property string $waktu_dibuat
 */
class Barang extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'barang';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('kode', 'required'),
			array('id_barang_kondisi, nup, id_lokasi, id_lokasi_jenis, id_pegawai, id_perolehan_asal', 'numerical', 'integerOnly'=>true),
			array('kode, nama, asal_perolehan, bukti_perolehan, masa_manfaat, sk_psp, sk_penghapusan, gambar', 'length', 'max'=>255),
			array('waktu_diubah,tahun, tahun_perolehan, merek, harga, nup, waktu_dibuat, administrasi_jumlah,administrasi_harga_satuan,
				  administrasi_harga,inventarisasi_jumlah,inventarisasi_harga_satuan,inventarisasi_harga,pemeriksaan_terakhir,
				  perawatan_terakhir, sakhir, tanggal, spesifikasi_processor, sistem_operasi, tanggal_kondisi_barang', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, kode, memrek, harga, nup, nama,tahun, tahun_perolehan, asal_perolehan, masa_manfaat, id_barang_kondisi, sk_psp,
                sk_penghapusan, id_lokasi, id_pegawai, gambar, waktu_diubah, waktu_dibuat, administrasi_jumlah,
                administrasi_harga_satuan,administrasi_harga,inventarisasi_jumlah,inventarisasi_harga_satuan,
                inventarisasi_harga, id_perolehan_asal, spesifikasi_processor, sistem_operasi, tanggal_kondisi_barang', 'safe', 'on'=>'search'),
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
			'lokasi'=>array(self::BELONGS_TO,'Lokasi','id_lokasi'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'kode' => 'Kode',
			'nup' => 'NUP',
			'nama' => 'Nama',
			'merek' => 'Merek/Tipe',
			'id_pegawai' => 'Pegawai',
			'id_lokasi' => 'Lokasi',
            'id_lokasi_jenis' => 'Ruangan',
			'tahun' => 'Tahun',
			'tahun_perolehan' => 'Tahun Perolehan',
			'asal_perolehan' => 'Asal Perolehan',
            'id_perolehan_asal' => 'Asal Perolehan',
			'masa_manfaat' => 'Masa Manfaat',
			'harga' => 'Harga',
			'id_barang_kondisi' => 'Kondisi Barang',
			'sk_psp' => 'Sk Psp',
			'sk_penghapusan' => 'SK Penghapusan',
			'id_lokasi' => ' Lokasi',
			'id_pegawai' => 'Pegawai',
			'gambar' => 'Gambar',
			'pemeriksaan_terakhir'=>'Pemeriksaan Terakhir',
			'perawatan_terakhir'=>'Perawatan Terakhir',
			'waktu_diubah' => 'Waktu Diubah',
			'waktu_dibuat' => 'Waktu Dibuat',
			'administrasi_jumlah'=>'Jumlah',
			'administrasi_harga_satuan'=>'Harga Satuan',
			'administrasi_harga'=>'Harga',
			'inventarisasi_jumlah'=>'Jumlah',
			'inventarisasi_harga_satuan'=>'Harga Satuan',
			'inventarisasi_harga'=>'Harga',
            'spesifikasi_processor' => 'Spek Processor',
            'sistem_operasi' => 'OS',
            'tanggal_kondisi_barang' => 'Tanggal Kondisi Barang',
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
	public function search($paging=10)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('kode',$this->kode,true);
		$criteria->compare('nup',$this->nup,true);
		$criteria->compare('nama',$this->nama,true);
		$criteria->compare('tahun',$this->tahun,true);
		$criteria->compare('tahun_perolehan',$this->tahun_perolehan,true);
		$criteria->compare('asal_perolehan',$this->asal_perolehan,true);
        $criteria->compare('id_perolahan_asal',$this->id_perolehan_asal,true);
		$criteria->compare('masa_manfaat',$this->masa_manfaat,true);
		$criteria->compare('id_barang_kondisi',$this->id_barang_kondisi);
		$criteria->compare('sk_psp',$this->sk_psp,true);
		$criteria->compare('sk_penghapusan',$this->sk_penghapusan,true);
		$criteria->compare('id_lokasi',$this->id_lokasi);
        $criteria->compare('id_lokasi_jenis',$this->id_lokasi_jenis);
		$criteria->compare('id_pegawai',$this->id_pegawai);
		$criteria->compare('gambar',$this->gambar,true);
		$criteria->compare('waktu_diubah',$this->waktu_diubah,true);
		$criteria->compare('waktu_dibuat',$this->waktu_dibuat,true);
        $criteria->compare('spesifikasi_processor',$this->spesifikasi_processor,true);
        $criteria->compare('sistem_operasi',$this->sistem_operasi,true);
        $criteria->compare('tanggal_kondisi_barang',$this->tanggal_kondisi_barang,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'Pagination' => array (
                  'PageSize' => $paging //edit your number items per page here
              ),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Barang the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

		public function getGambar($htmlOptions=array())
	{
		return CHtml::image(Yii::app()->baseUrl.'/uploads/barang/'.$this->gambar,'',array("style"=>"width: 300px;"));
	}

	public function getBarangKondisi()
		{
			$model = BarangKondisi::model()->findByPk($this->id_barang_kondisi);

			if($model!==null)
				return $model->nama;
			else
				return null;

		}

	public function getLokasi()
	{
		$model = Lokasi::model()->findByPk($this->id_lokasi);

		if ($model!==null)
				return $model->nama;
		else
			return null;
	}

    public function getLokasiJenis()
    {
        $model = LokasiJenis::model()->findByPk($this->id_lokasi_jenis);

        if ($model !== null) 
            return $model->nama;
        else 
            return null;
    }

	public function getPegawai()
	{
		$model = Pegawai::model()->findByPk($this->id_pegawai);

		if ($model!==null)
				return $model->nama;
		else
			return null;
	}

    public function getPerolehanAsal()
    {
        $model = PerolehanAsal::model()->findByPk($this->id_perolehan_asal);

        if ($model !== null)
            return $model->nama;
        else
            return null;
    }

	public function getKode()
	{
		$model = Barang::model()->findByPk($this->id);
		if ($model!==null)
			return $model->nama;
		else
			return null;
	}

	public static function getList()
	{
		$list = array();

		$criteria = new CDbCriteria;

		foreach(Barang::model()->findAll() as $data) {
			$list[$data->kode]=$data->kode.'-'.$data->nup.' - '.$data->nama;
		}

		return $list;
	}

	public function getCountData()
	{
		return $this->count($this->tahun_perolehan);
	}

	public static function getDataChartByTahun()
	{
		$dataChartTahun = '';

 		foreach(Tahun::model()->findAll() as $data)
  		{
  			$criteria = new CDbCriteria;
  			$criteria->condition = 'tahun_perolehan >= :tgl_awal AND tahun_perolehan <= :tgl_akhir';
  			$criteria->params = array(':tgl_awal'=>$data->tahun.'-01-01',':tgl_akhir'=>$data->tahun.'-12-31');

  			$jumlah = Barang::model()->count($criteria);

			$dataChartTahun .= '{"label":"'.$data->tahun.'","value":"'.$jumlah.'"},';

  		}
  		return $dataChartTahun;
	}

	public static function getDataChartByKondisi()
	{
	$dataChartKondisi = '';
 		foreach(BarangKondisi::model()->findAll() as $data)
  		{
			$dataChartKondisi .= '{"label":"'.$data->nama.'","value":"'.$data->getCountData().'"},';
  		}
  		return $dataChartKondisi;
	}

	public static function getDataChartByLokasi()
	{
	$dataChartKondisi = '';
 		foreach(Lokasi::model()->findAll() as $data)
  		{
			$dataChartKondisi .= '{"label":"'.$data->nama.'","value":"'.$data->getCountData().'"},';
  		}
  		return $dataChartKondisi;
	}

	public static function getDataChartByTotalHarga()
	{
		$dataChartKondisi = '';
 		foreach(Tahun::model()->findAll() as $data)
  		{
  			$total = 0;
  			$criteria = new CDbCriteria;
  			$criteria->condition = 'tahun_perolehan >= :awal AND tahun_perolehan <= :akhir';
  			$criteria->params = array(':awal'=>$data->tahun.'-01-01',':akhir'=>$data->tahun.'-12-21');

  			foreach(Barang::model()->findAll($criteria) as $barang)
  			{
  				$total = $total + $barang->harga;
  			}

			$dataChartKondisi .= '{"label":"'.$data->tahun.'","value":"'.$total.'"},';
  		}
  		return $dataChartKondisi;
	}

	public function getTahun()
	{
		$model = Tahun::model()->findByPk($this->tahun_perolehan);
		if($model!==null)
			return $model->tahun;
		else
			return null;
	}

	public static function countBaik()
	{
		return Barang::model()->countByAttributes(array('id_barang_kondisi'=>1));
	}

	public static function countRusakRingan()
	{
		return Barang::model()->countByAttributes(array('id_barang_kondisi'=>2));
	}

	public static function countRusakBerat()
	{
		return Barang::model()->countByAttributes(array('id_barang_kondisi'=>3));
	}

	public static function getListAutoBarang()
	{
		$list = array();

		$list[]='Semua Barang';

		$criteria = new CDbCriteria;
		$criteria->order = 'nup ASC';

		foreach(Barang::model()->findAll($criteria) as $data) {
			$list[]=$data->kode.'-'.$data->nup.' - '.$data->nama;
		}

		return $list;
	}

	public static function getListAutoBarangPemindahan($id_lokasi_asal)
	{
		$list = array();

		$list[]='Semua Barang';

		$criteria = new CDbCriteria;
		$criteria->order = 'nup ASC';

		foreach(Barang::model()->findAllByAttributes(array('id_lokasi'=>$id_lokasi_asal)) as $data) {
			$list[]=$data->id.'-'.$data->kode.'-'.$data->nup.' - '.$data->nama;
		}

		return $list;
	}

	public function dialog()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		if(isset($_GET['Barang']))
			$this->attributes = $_GET['Barang'];

		$criteria=new CDbCriteria;
		$params = array();

/*		if(!empty($this->id_jabatan))
		{
			$criteria->addCondition('id_jabatan IN (SELECT id FROM jabatan WHERE nama LIKE :id_jabatan)');
			$params[':id_jabatan'] = '%'.$this->id_jabatan.'%';
		}*/

		$criteria->params = $params;

		$criteria->compare('nama',$this->nama,true);
		$criteria->compare('id',$this->id);
		$criteria->compare('nup',$this->nup,true);
		$criteria->compare('kode',$this->kode,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
        		'pageSize'=>5,
    		),
		));
	}

	public function detailJenis($id)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		if(isset($_GET['Barang']))
			$this->attributes = $_GET['Barang'];

		$criteria=new CDbCriteria;
		$params = array();

		$criteria->addCondition('kode LIKE :kode');
		$params[':kode'] = $id.'%';

		$criteria->params = $params;

		$criteria->compare('nama',$this->nama,true);
		$criteria->compare('id',$this->id);
		$criteria->compare('nup',$this->nup,true);
		$criteria->compare('kode',$this->kode,true);
        $criteria->compare('tahun_perolehan',$this->tahun_perolehan,true);
        $criteria->compare('merek',$this->merek,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
        		'pageSize'=>8,
    		),
		));
	}

	public function getRelation($relation,$field)
	{
		if(!empty($this->$relation->$field))
			return $this->$relation->$field;
		else
			return null;
	}

	public function getCountByJenis($kode)
	{
		$model = new Barang;
		$criteria = new CDbCriteria;
		$criteria->params = array();
		$params = array();

		$awal = substr($model->kode, 0, 3);

		$criteria->addCondition('kode LIKE :kode');
		$params[':kode']=$kode.'%';

		$criteria->params = $params;

		return $model->count($criteria);
	}

		public function getCssClass($data)
		{
			    $cssClass;

			    if($data == 1)
			    {
			      return  $cssClass='success';
			    }
			    if($data == 2)
			    {
			        return $cssClass='warning';
			    }
			    if($data == 3)
			 		{
			        return $cssClass='danger';
			 		}
		 }

		 public function updatePerawatanTerkahir()
		 {
			$criteria = new CDbCriteria;
			$criteria->addCondition('id_barang = :id_barang');
			$criteria->params = array(':id_barang'=>$this->id);
			$criteria->order = 'tanggal DESC';

			$perawatan = BarangPerawatan::model()->find($criteria);

			if($perawatan!==null)
			{
				$this->perawatan_terakhir = $perawatan->tanggal;
				$this->save();
			}
		 }

		 public function updatePemeriksaanTerkahir()
		 {
			 	$criteria = new CDbCriteria;
				$criteria->addCondition('id_barang = :id_barang');
				$criteria->params = array(':id_barang'=>$this->id);
				$criteria->order = 'tanggal DESC';

				$pemeriksaan = BarangPemeriksaan::model()->find($criteria);

				if($pemeriksaan!==null)
				{
					$this->pemeriksaan_terakhir = $pemeriksaan->tanggal;
					$this->save();
				}
		 }

         public function getTahunPerolehan()
         {
            if ($this->tahun_perolehan === null OR $this->tahun_perolehan === '0000-00-00') {
                return null;
            }
            
            $datetime = \DateTime::createFromFormat('Y-m-d', $this->tahun_perolehan);
            return $datetime->format('Y');
         }




}
