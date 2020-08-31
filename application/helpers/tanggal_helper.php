<?php 
if (!function_exists('tanggal')) {
	function tanggal($param) {
		$tgl = date('d',strtotime($param));
		$bln = date('m',strtotime($param)); 
		$thn = date('Y',strtotime($param)); 

		switch ($bln) {
			case '1':
			$bulan = "Januari";
			break;

			case '2':
			$bulan = "Februari";
			break;

			case '3':
			$bulan = "Maret";
			break;

			case '4':
			$bulan = "April";
			break;

			case '5':
			$bulan = "Mei";
			break;

			case '6':
			$bulan = "Juni";
			break;

			case '7':
			$bulan = "Juli";
			break;

			case '8':
			$bulan = "Agustus";
			break;

			case '9':
			$bulan = "September";
			break;

			case '10':
			$bulan = "Oktober";
			break;

			case '11':
			$bulan = "Nopember";
			break;

			case '12':
			$bulan = "Desember";
			break;
		}

		$tanggal = $tgl." ".$bulan." ".$thn;

		return $tanggal;
	}
}

if (!function_exists('tanggalwaktu')) {
	function tanggalwaktu($param) {
		$tgl = date('d',strtotime($param));
		$bln = date('m',strtotime($param)); 
		$thn = date('Y',strtotime($param));
		$waktu = date('H:i:s', strtotime($param));

		switch ($bln) {
			case '1':
			$bulan = "Januari";
			break;

			case '2':
			$bulan = "Februari";
			break;

			case '3':
			$bulan = "Maret";
			break;

			case '4':
			$bulan = "April";
			break;

			case '5':
			$bulan = "Mei";
			break;

			case '6':
			$bulan = "Juni";
			break;

			case '7':
			$bulan = "Juli";
			break;

			case '8':
			$bulan = "Agustus";
			break;

			case '9':
			$bulan = "September";
			break;

			case '10':
			$bulan = "Oktober";
			break;

			case '11':
			$bulan = "Nopember";
			break;

			case '12':
			$bulan = "Desember";
			break;
		}

		$tanggalwaktu = $tgl." ".$bulan." ".$thn." ".$waktu;

		return $tanggalwaktu;
	}
}

if (!function_exists('waktu')) {
	function waktu($param) {
		
		$waktu = date('H:i:s', strtotime($param));
		return $waktu;
	}
}