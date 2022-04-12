<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'connection/baglan.php'; 
session_start();
if(!$_SESSION['sesadmin'])
{
	header("location:admingiris.php");
}


$donem1 = htmlspecialchars($_POST['donem']);
$ders1 =htmlspecialchars($_POST['ders']);
$kul1 = htmlspecialchars($_POST['kullaniciq']);


if(!empty($donem1) && !empty($ders1) && !empty($kul1)) 
{
	$sorgu = "select DISTINCT dokumanlar.belgeId,kullanicilar.kullaniciadi,belge.belgeSrc,
	kullanicilar.isim, kullanicilar.unvan, dersler.dersAdi,belge.belgeOzet,belge.belgeTeslim,belge.belgeBaslik,belge.belgeAnahtar 
    from belge,dokumanlar,yazarlar,dersler,kullanicilar where belgeTeslim =? and isim =? and dersAdi = ?
    and belge.belgeId=dokumanlar.belgeId and yazarlar.yazarId=dokumanlar.yazarId
	and dersler.dersId=belge.dersId and kullanicilar.kullaniciid = dokumanlar.kullaniciid; ";
	$sorguYazarlar = "select dokumanlar.belgeId,yazarlar.yazarAdi,yazarlar.yazarNo,yazarlar.yazarOgrTuru,yazarlar.yazarSoyad from dokumanlar,yazarlar,belge,kullanicilar where
 yazarlar.yazarId=dokumanlar.yazarId and belge.belgeId=dokumanlar.belgeId  and dokumanlar.kullaniciid=kullanicilar.kullaniciid and dokumanlar.belgeId = ?
";

	$sonucm =$db->prepare($sorgu);
$sonucm -> execute([$donem1,$kul1,$ders1]);
}

if($sonucm){
	while($bilgilerimcekap=$sonucm -> fetch(PDO::FETCH_ASSOC)){
		$sYazar = $db->prepare($sorguYazarlar);
        $sYazar ->execute([$bilgilerimcekap['belgeId']]);


        echo '<div class="card my-5">';
		echo '<div class="card-header">';
		echo '<h4 class="card-title">' . $bilgilerimcekap['belgeBaslik']. " - " .$bilgilerimcekap['dersAdi'] . "</h4>" . "</div>";
		echo '<div class="card-body">';


		while($cek=$sYazar -> fetch(PDO::FETCH_ASSOC)){
			echo '<div><b>Öğrenci Adı Soyadı : </b>'. $cek['yazarAdi'] ."  " .$cek['yazarSoyad'] .'  -  '.$cek['yazarNo']. '  -  '.$cek['yazarOgrTuru'] .'</div><hr>';


		}

		echo '<div><b>Proje Başlığı :</b>' .$bilgilerimcekap['belgeBaslik'] .'</div><hr>';
		echo '<div><b>Dönem : </b> ' .$bilgilerimcekap['belgeTeslim']. ' <hr>';
		echo '<div><b>Özet : </b>' .$bilgilerimcekap['belgeOzet'] . '</div> <hr>';
		echo '<div><b>Anahtar Kelimeler: </b>' .$bilgilerimcekap['belgeAnahtar'] .'</div><hr>';
		echo '<div><b> Danışman : </b>' .$bilgilerimcekap['unvan'] . "  " .$bilgilerimcekap['isim'] . '</div> <hr>';
		echo '<div><b>Dosyalar : </b>  <a  href="dosyaindir.php?file='.$bilgilerimcekap['belgeSrc'].'&kulid=' .'"><img style="width: 1.7rem;"  src="images/pedef.png"> </a></div> ';
		echo ' </div></div></div>';

	}
}






 ?>
