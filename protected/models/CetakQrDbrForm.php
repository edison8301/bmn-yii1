<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class CetakQrDbrForm extends CFormModel
{
	public $id_lokasi;

	public function rules()
	{
		return array(
			array('id_lokasi', 'required','message'=>'{attribute} harus diisi'),
			array('id_lokasi', 'numerical', 'integerOnly'=>true,'message'=>'{attribute} harus berbentuk angka'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id_lokasi'=>'Lokasi',
		);
	}
}
