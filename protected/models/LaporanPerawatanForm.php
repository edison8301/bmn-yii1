<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class LaporanPerawatanForm extends CFormModel
{
	public $tanggal_awal;
	public $tanggal_akhir;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array();
	}

	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
		return array(
			'tanggal_awal'=>'Tanggal Awal',
			'tanggal_akhir'=>'Tanggal Akhir',
		);
	}
}