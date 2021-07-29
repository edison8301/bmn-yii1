<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class CetakQrForm extends CFormModel
{
	public $kode;
	public $nup_awal;
	public $nup_akhir;
	public $nup_lainnya;

	public function rules()
	{
		return array(
			array('kode', 'required','message'=>'{attribute} harus diisi'),
			array('nup_awal, nup_akhir', 'numerical', 'integerOnly'=>true,'message'=>'{attribute} harus berbentuk angka'),
			//array('nup_awal, nup_akhir, nup_lainnya', 'required','message'=>'{attribute} harus diisi'),
			array('nup_lainnya', 'safe'),
			array('nup_lainnya', 'tags'),
			array('nup_awal, nup_akhir, nup_lainnya', 'aturanCustom'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'kode'=>'Kode',
			'nup_awal'=>'NUP Awal',
			'nup_akhir'=>'NUP Akhir',
			'nup_lainnya'=>'NUP Lainnya'
		);
	}

	public function tags()
	{
		//$user = User::model()->findByAttributes(array('username'=>$this->username));
        if($this->nup_lainnya != null)
        {
            $array = explode(",", $this->nup_lainnya);
            foreach ($array as $data) {
            	if (!is_numeric($data)) {
            		$this->addError('nup_lainnya','NUP hanya boleh angka');
            	}
            }
        }

        return true;
	}

	public function aturanCustom()
	{
		if (($this->nup_awal == null AND $this->nup_akhir == null)) {
			if ($this->nup_lainnya == null) {
				$this->addError('nup_lainnya','Salah satu dari Nup lainnya atau awal dan akhir harus diisi');
			}
		} elseif (($this->nup_awal == null AND $this->nup_akhir !== null)) {
			$this->addError('nup_awal','NUP Awal harus diisi jika NUP akhir diisi');
		} elseif (($this->nup_awal !== null AND $this->nup_akhir == null)) {
			$this->addError('nup_akhir','NUP Akhir harus diisi jika NUP awal diisi');
		} 

		return true;
	}
}
