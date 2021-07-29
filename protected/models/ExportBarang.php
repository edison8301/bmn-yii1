<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class ExportBarang extends CFormModel
{
	public $nama;
	public $kondisi;
	public $tahun;
	public $lokasi;

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
			'tahun'=>'Tahun',
			'nama_barang' => 'Nama Barang',
			'lokasi' => 'Lokasi',
			'kondisi' => 'Kondisi Barang'
		);
	}
}