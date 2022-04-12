<?php 

require_once 'connection/baglan.php';


if(isset($_POST['eklebtn']))
{
	$kadi=$_POST['kullaniciadi'];
	$ksifre =$_POST['kullanicisifre'];
	$unvan = $_POST['unvan'];
	$isim =$_POST['isim'];	

	$query = $db->prepare("INSERT INTO kullanicilar SET kullaniciadi=?, kullanicisifre=?, isim=?, unvan=?");
	$insert = $query->execute(array($kadi,$ksifre,$isim,$unvan));


	if ( $insert ){
    	header("location:yonetimPanel.php");
}
else{
    echo "Kayıt eklenemedi";
    header("location:yonetimPanel.php");
    exit();
}
}

if($_GET['bilgilerimsil']=="ok") // SİLME İŞLEMİ
{
$kid=$_GET['kullaniciidx'];
	$sil =$db->prepare("DELETE from kullanicilar where kullaniciid=:id");
	$kontrol = $sil->execute(array(

		'id' => $_GET['kullaniciidx']
	));	

	if($kontrol){
		header("location:yonetimPanel.php?kayit=evet");
	}
	else{
		header("location:yonetimPanel.php?kayit=hayir");
	}
}



  


if(isset($_POST['updateislemi']))
{
	$bilgilerim_id=$_POST['kulid'];
	$kadi=$_POST['kullaniciadi'];
	$ksifre =$_POST['kullanicisifre'];
	$unvan = $_POST['unvan'];
	$isim =$_POST['isim'];	

	$query = $db->prepare("UPDATE kullanicilar SET kullaniciadi=?, kullanicisifre=?, isim=?, unvan=? where kullaniciid={$_POST['kulid']}");
	$insert = $query->execute(array($kadi,$ksifre,$isim,$unvan));


	if ( $insert ){
    	//header("location:kulduzenle.php?duzenleid=$bilgilerim_id");
    	header("location:yonetimPanel.php");
}
else{
    echo "Kayıt eklenemedi";
    header("location:kulduzenle.php");
    exit();
}
}
	


 ?>