<?php

class Helper {


	public static function getTanggalSingkat($time=null)
	{
		$strtotime = strtotime($time);

		if($time!=null)
			return date('j',$strtotime).' '.Helper::getBulanSingkat($time).' '.date('Y',$strtotime);
		else
			return null;
	}

	public static function getTanggal($time=null)
	{
		$strtotime = strtotime($time);

		if($time!=null)
			return date('j',$strtotime).' '.Helper::getBulan($time).' '.date('Y',$strtotime);
		else
			return null;
	}


	public static function getBulanSingkat($time=null)
	{
		$strtotime = strtotime($time);
		$i = date('m',$strtotime);

		$bulan = '';

		if(strlen($i)==1) $i = '0'.$i;

		if($i=='01') $bulan = 'Jan';
		if($i=='02') $bulan = 'Feb';
		if($i=='03') $bulan = 'Mar';
		if($i=='04') $bulan = 'Apr';
		if($i=='05') $bulan = 'Mei';
		if($i=='06') $bulan = 'Jun';
		if($i=='07') $bulan = 'Jul';
		if($i=='08') $bulan = 'Agt';
		if($i=='09') $bulan = 'Sep';
		if($i=='10') $bulan = 'Okt';
		if($i=='11') $bulan = 'Nov';
		if($i=='12') $bulan = 'Des';

		return $bulan;

	}

	public static function getBulan($time=null)
	{
		$strtotime = strtotime($time);
		$i = date('m',$strtotime);

		$bulan = '';

		if(strlen($i)==1) $i = '0'.$i;

		if($i=='01') $bulan = 'Januari';
		if($i=='02') $bulan = 'Februari';
		if($i=='03') $bulan = 'Maret';
		if($i=='04') $bulan = 'April';
		if($i=='05') $bulan = 'Mei';
		if($i=='06') $bulan = 'Juni';
		if($i=='07') $bulan = 'Juli';
		if($i=='08') $bulan = 'Agustus';
		if($i=='09') $bulan = 'September';
		if($i=='10') $bulan = 'Oktober';
		if($i=='11') $bulan = 'November';
		if($i=='12') $bulan = 'Desember';

		return $bulan;

	}

	public static function getBulanLengkap($time=null)
	{
		$strtotime = strtotime($time);
		$i = date('m',$strtotime);

		$bulan = '';

		if(strlen($i)==1) $i = '0'.$i;

		if($i=='01') $bulan = 'Januari';
		if($i=='02') $bulan = 'Februari';
		if($i=='03') $bulan = 'Maret';
		if($i=='04') $bulan = 'April';
		if($i=='05') $bulan = 'Mei';
		if($i=='06') $bulan = 'Juni';
		if($i=='07') $bulan = 'Juli';
		if($i=='08') $bulan = 'Agustus';
		if($i=='09') $bulan = 'September';
		if($i=='10') $bulan = 'Oktober';
		if($i=='11') $bulan = 'November';
		if($i=='12') $bulan = 'Desember';

		return $bulan;

	}

	public static function getNextMonth()
	{
		return date('Y-m',strtotime(date('Y-m',strtotime(Bantu::getMonth())). " +1 month"));
	}

	public static function getPrevMonth()
	{
		return date('Y-m',strtotime(date('Y-m',strtotime(Bantu::getMonth())). " -1 month"));
	}

	public static function getHariSingkat($tanggal)
	{
		$hari = date('N',strtotime(date('Y-m-d',strtotime($tanggal))));

		if($hari == 1) return "Sen";
		if($hari == 2) return "Sel";
		if($hari == 3) return "Rab";
		if($hari == 4) return "Kam";
		if($hari == 5) return "Jum";
		if($hari == 6) return "Sab";
		if($hari == 7) return "Min";

	}

	public static function getDate()
	{
		date_default_timezone_set("Asia/Jakarta");
		return date("Y-m-d");
	}

	public static function getDateNextDay()
	{
		date_default_timezone_set("Asia/Jakarta");
		return date("Y-m-d", strtotime(date("Y-m-d") . " +1 day"));
	}

	public static function tgl($tgl=null)
	{
		if(!empty($tgl))
		{
			$tgl=explode('-',$tgl);
			$tgl=$tgl['2']."-".$tgl['1']."-".$tgl['0'];
		}

		return $tgl;
	}

	public static function tanggal($tgl=null)
	{
		if($tgl == '0000-00-00' OR $tgl == null)
			return null;
		else
			return date('j',strtotime($tgl))." ".Helper::getBulan($tgl)." ".date('Y',strtotime($tgl));
	}


	public static function tglExcel($tgl=null)
	{
		if(!empty($tgl))
		{
			$tgl=explode('/',$tgl);
			$tgl=$tgl['2']."-".$tgl['1']."-".$tgl['0'];
		}

		return $tgl;
	}

	public static function getHari($tgl)
	{
		$hari=date('N',strtotime($tgl));
		switch($hari)
		{
			case '1' :
			return 'Senin';
			break;

			case '2' :
			return 'Selasa';
			break;

			case '3' :
			return 'Rabu';
			break;

			case '4' :
			return 'Kamis';
			break;

			case '5' :
			return 'Jumat';
			break;

			case '6' :
			return 'Sabtu';
			break;

			case '7' :
			return 'Minggu';
			break;

		}
	}

	public static function hari($hari)
	{
		switch($hari)
		{
			case '1' :
			return 'Senin';
			break;

			case '2' :
			return 'Selasa';
			break;

			case '3' :
			return 'Rabu';
			break;

			case '4' :
			return 'Kamis';
			break;

			case '5' :
			return 'Jumat';
			break;

			case '6' :
			return 'Sabtu';
			break;

			case '7' :
			return 'Minggu';
			break;

		}
	}

	public static function rp($jumlah,$satuan=false)
	{
			$output = '';

			$output = number_format($jumlah,0,',','.');

			if($satuan==true)
				$output = 'Rp '.$output;

			return $output;
	}

	public static function getSetting($setting)
	{
		$model=Setting::model()->findByAttributes(array('nama'=>$setting));

		if(!empty($model->nilai))
		{
			return $model->nilai;
		} else {
			return "";
		}

	}

	public static function getCreatedTime($waktu)
	{
		if($waktu == '')
			return null;
		else {
		$time = strtotime($waktu);

		$h = date('N',$time);

		if($h == '1') $hari = 'Senin';
		if($h == '2') $hari = 'Selasa';
		if($h == '3') $hari = 'Rabu';
		if($h == '4') $hari = 'Kamis';
		if($h == '5') $hari = 'Jumat';
		if($h == '6') $hari = 'Sabtu';
		if($h == '7') $hari = 'Minggu';


		$tgl = date('j',$time);

		$h = date('n',$time);

		if($h == '1') $bulan = 'Januari';
		if($h == '2') $bulan = 'Februari';
		if($h == '3') $bulan = 'Maret';
		if($h == '4') $bulan = 'April';
		if($h == '5') $bulan = 'Mei';
		if($h == '6') $bulan = 'Juni';
		if($h == '7') $bulan = 'Juli';
		if($h == '8') $bulan = 'Agustus';
		if($h == '9') $bulan = 'September';
		if($h == '10') $bulan = 'Oktober';
		if($h == '11') $bulan = 'November';
		if($h == '12') $bulan = 'Desember';

		$tahun  = date('Y',$time);

		$pukul = date('H:i:s',$time);

		$output = $hari.', '.$tgl.' '.$bulan.' '.$tahun.' | '.$pukul.' WIB';

		return $output;
		}

	}

	public static function getCreatedDate($waktu)
	{

		$time = strtotime($waktu);

		$h = date('N',$time);

		if($h == '1') $hari = 'Senin';
		if($h == '2') $hari = 'Selasa';
		if($h == '3') $hari = 'Rabu';
		if($h == '4') $hari = 'Kamis';
		if($h == '5') $hari = 'Jumat';
		if($h == '6') $hari = 'Sabtu';
		if($h == '7') $hari = 'Minggu';


		$tgl = date('j',$time);

		$h = date('n',$time);

		if($h == '1') $bulan = 'Januari';
		if($h == '2') $bulan = 'Februari';
		if($h == '3') $bulan = 'Maret';
		if($h == '4') $bulan = 'April';
		if($h == '5') $bulan = 'Mei';
		if($h == '6') $bulan = 'Juni';
		if($h == '7') $bulan = 'Juli';
		if($h == '8') $bulan = 'Agustus';
		if($h == '9') $bulan = 'September';
		if($h == '10') $bulan = 'Oktober';
		if($h == '11') $bulan = 'November';
		if($h == '12') $bulan = 'Desember';

		$tahun  = date('Y',$time);

		$pukul = date('h:i:s',$time);

		$output = $hari.', '.$tgl.' '.$bulan.' '.$tahun;

		return $output;

	}

	public static function ckEditorToolbar()
	{
		$ckeditor = 'js:[
		{ name: "document", items : ["Source" ] },
        { name: "clipboard", items : [ "Cut","Copy","Paste","PasteText","PasteFromWord","-","Undo","Redo" ] },
        { name: "editing", items : [ "Find","Replace","-","SelectAll","-","Scayt" ] },
        { name: "insert", items : [ "Image","Flash","Table","HorizontalRule","Smiley","SpecialChar","PageBreak","Iframe" ] },
			"/", //Line Break
		{ name: "styles", items : [ "Styles","Format" ] },
        { name: "basicstyles", items : [ "Bold","Italic","Strike","-","RemoveFormat" ] },
        { name: "paragraph", items : [ "NumberedList","BulletedList","-","Outdent","Indent","-","Blockquote", "-", "JustifyLeft", "JustifyCenter", "JustifyRight", "JustifyBlock", "-", "BidiLtr", "BidiRtl"  ] },
		{ name: "links", items : [ "Link","Unlink","Anchor" ] },
		{ name: "tools", items : [ "Maximize","-","About" ] }
		]';

		return $ckeditor;
	}

}


?>
