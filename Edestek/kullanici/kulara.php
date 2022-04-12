<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once '../connection/baglan.php'; 
session_start();

/*if(isset($_SESSION['seskullanici']))
{
    echo $kullaniciad;
    echo "<br>";
echo $kullaniciId;
echo "<br>";
echo $kullaniciIsim;
echo "<br>";
}*/

if(!$_SESSION['seskullanici'])
{
  header("location:kullanicigiris.php");
}

$aranan = htmlspecialchars($_POST['aranan']);
$secenek = htmlspecialchars($_POST['sec']);
$idbilgi = htmlspecialchars($_POST['kimlikId']);
	



if(!empty($aranan) && $secenek ==1){ // keyup fonksiyonu gider!
	$sorgu = " select DISTINCT dokumanlar.belgeId, yazarAdi,kullanicilar.kullaniciadi,belge.belgeSrc,
kullanicilar.isim, kullanicilar.unvan, dersler.dersAdi,belge.belgeOzet,belge.belgeTeslim,belge.belgeBaslik,belge.belgeAnahtar from belge,dokumanlar,yazarlar,dersler,kullanicilar
 where yazarAdi LIKE :aranan and belge.belgeId=dokumanlar.belgeId and yazarlar.yazarId=dokumanlar.yazarId
and dersler.dersId=belge.dersId and kullanicilar.kullaniciid = dokumanlar.kullaniciid  and dokumanlar.kullaniciid= :kulId
 ";
$sonuc = $db->prepare($sorgu);
$sonuc ->bindValue(":aranan",'%'.$aranan.'%');
$sonuc ->bindValue(":kulId",$idbilgi);
$sonuc->execute();

}else if(!empty($aranan) && $secenek ==2){
	$sorgu = "select DISTINCT dokumanlar.belgeId,kullanicilar.kullaniciadi,belge.belgeSrc,
kullanicilar.isim, kullanicilar.unvan, dersler.dersAdi,belge.belgeOzet,belge.belgeTeslim,belge.belgeBaslik,belge.belgeAnahtar from belge,dokumanlar,yazarlar,dersler,kullanicilar where dersAdi LIKE :aranan and belge.belgeId=dokumanlar.belgeId and yazarlar.yazarId=dokumanlar.yazarId
and dersler.dersId=belge.dersId and kullanicilar.kullaniciid = dokumanlar.kullaniciid and dokumanlar.kullaniciid= :kulId";
$sonuc = $db->prepare($sorgu);
$sonuc ->bindValue(":aranan",'%'.$aranan.'%');
$sonuc ->bindValue(":kulId",$idbilgi);
$sonuc->execute();
}else if(!empty($aranan) && $secenek ==3){
	$sorgu = "select DISTINCT dokumanlar.belgeId,kullanicilar.kullaniciadi,belge.belgeSrc,
kullanicilar.isim, kullanicilar.unvan, dersler.dersAdi,belge.belgeOzet,belge.belgeTeslim,belge.belgeBaslik,belge.belgeAnahtar from belge,dokumanlar,yazarlar,dersler,kullanicilar where belgeBaslik LIKE :aranan and belge.belgeId=dokumanlar.belgeId and yazarlar.yazarId=dokumanlar.yazarId
and dersler.dersId=belge.dersId and kullanicilar.kullaniciid = dokumanlar.kullaniciid and dokumanlar.kullaniciid= :kulId";
$sonuc = $db->prepare($sorgu);
$sonuc ->bindValue(":aranan",'%'.$aranan.'%');
$sonuc ->bindValue(":kulId",$idbilgi);
$sonuc->execute();
}else if(!empty($aranan) && $secenek ==4){
	$sorgu = "select DISTINCT dokumanlar.belgeId,kullanicilar.kullaniciadi,belge.belgeSrc,
kullanicilar.isim, kullanicilar.unvan, dersler.dersAdi,belge.belgeOzet,belge.belgeTeslim,belge.belgeBaslik,belge.belgeAnahtar from belge,dokumanlar,yazarlar,dersler,kullanicilar where belgeAnahtar LIKE :aranan and belge.belgeId=dokumanlar.belgeId and yazarlar.yazarId=dokumanlar.yazarId
and dersler.dersId=belge.dersId and kullanicilar.kullaniciid = dokumanlar.kullaniciid and dokumanlar.kullaniciid= :kulId";
$sonuc = $db->prepare($sorgu);
$sonuc ->bindValue(":aranan",'%'.$aranan.'%');
$sonuc ->bindValue(":kulId",$idbilgi);
$sonuc->execute();
}else if(!empty($aranan) && $secenek ==5){
	$sorgu = "select DISTINCT dokumanlar.belgeId,kullanicilar.kullaniciadi,belge.belgeSrc,
kullanicilar.isim, kullanicilar.unvan, dersler.dersAdi,belge.belgeOzet,belge.belgeTeslim,belge.belgeBaslik,belge.belgeAnahtar from belge,dokumanlar,yazarlar,dersler,kullanicilar where belgeTeslim LIKE :aranan and belge.belgeId=dokumanlar.belgeId and yazarlar.yazarId=dokumanlar.yazarId
and dersler.dersId=belge.dersId and kullanicilar.kullaniciid = dokumanlar.kullaniciid and dokumanlar.kullaniciid= :kulId";
$sonuc = $db->prepare($sorgu);
$sonuc ->bindValue(":aranan",'%'.$aranan.'%');
$sonuc ->bindValue(":kulId",$idbilgi);
$sonuc->execute();
}

$sorgum="select dokumanlar.belgeId,yazarlar.yazarAdi,yazarlar.yazarNo,yazarlar.yazarOgrTuru,yazarlar.yazarSoyad from dokumanlar,yazarlar,belge,kullanicilar where
 yazarlar.yazarId=dokumanlar.yazarId and belge.belgeId=dokumanlar.belgeId  and dokumanlar.kullaniciid=kullanicilar.kullaniciid and dokumanlar.belgeId = ?";



if($sonuc ->rowCount()!=0){
	foreach ($sonuc as $key => $value) {
		$sonucm =$db->prepare($sorgum);
$sonucm -> execute([$value['belgeId']]);

		echo '<div class="card my-5">';
		echo '<div class="card-header">';
		echo '<h4 class="card-title">' . $value['belgeBaslik']. " - " .$value['dersAdi'] . "</h4>" . "</div>";
		echo '<div class="card-body">';
		
		while($bilgilerimceka=$sonucm -> fetch(PDO::FETCH_ASSOC)){
			echo '<div><b>Öğrenci Adı Soyadı : </b>'. $bilgilerimceka['yazarAdi'] ."  " .$bilgilerimceka['yazarSoyad'] .'</div><hr>';

		}

		echo '<div><b>Proje Başlığı :</b>' .$value['belgeBaslik'] .'</div><hr>';
		echo '<div><b>Dönem : </b> ' .$value['belgeTeslim']. ' <hr>';
		echo '<div><b>Özet : </b>' .$value['belgeOzet'] . '</div> <hr>';
		echo '<div><b>Anahtar Kelimeler: </b>' .$value['belgeAnahtar'] .'</div><hr>';
		echo '<div><b> Danışman : </b>' .$value['unvan'] . "  " .$value['isim'] . '</div> <hr>';
		echo '<div><b>Dosyalar : </b>  <a  href="../dosyaindir.php?file='.$value['belgeSrc'].'&kulid=' .'"><img style="width: 1.7rem;"  src="../images/pedef.png"> </a></div> ';
		echo ' </div></div></div>';
	}
}else{
	echo '<div class="alert alert-warning">SONUC YOK</div>';
}


 ?>
 