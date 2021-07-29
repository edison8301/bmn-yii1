<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class TambahBarangForm extends CFormModel
{
	public $barang;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			array('barang','required','message'=>'{attribute} harus diisi')
		);
	}

	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
		return array(
			'barang'=>'Kode Barang',
		);
	}
}