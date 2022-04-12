<?php 
require_once 'connection/baglan.php';

if(!empty($_GET['file']) && !empty($_GET['kulid']))
{
	
$kulidx=$_GET['kulid'];
$filename= basename($_GET['file']);
$filepath = $filename;

if(!empty($filename) && file_exists($filepath)){

	header("Cache-Control: public");
	header("Content-Description: File Transfer");
	header("Content-Disposition: attachment; filename=$filename");
	header("Content-Type: application/zip");
	header("Content-Transfer-Encoding: binary");

	readfile($filepath);
	exit;
}else{
	echo " Dosya yok";
	header("location:yonetimPdf.php?kullaniciid=$kulidx&dosya=no");
}

} else if(empty($_GET['kulid'])){

$filename= basename($_GET['file']);
$filepath = $filename;

if(!empty($filename) && file_exists($filepath)){

	header("Cache-Control: public");
	header("Content-Description: File Transfer");
	header("Content-Disposition: attachment; filename=$filename");
	header("Content-Type: application/zip");
	header("Content-Transfer-Encoding: binary");

	readfile($filepath);
	exit;
}else{
	echo " Dosya yok";
	header("location:yonetimPdf.php	");
}


}
