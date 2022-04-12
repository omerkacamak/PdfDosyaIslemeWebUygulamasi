<?php 

	try{
		$db = new PDO("mysql:host=localhost;dbname=edestek;charset=utf8", 'root','1905');

		//echo "Veritabanı bağlantısı başaırlı";
	}

	catch (PDOExpception $e){
		echo $e->getMessage();
	}
if(isset($_SESSION['sesadmin']))

 {

 		$adminbilgis= $db->prepare("SELECT * FROM admin WHERE adminad = ? LIMIT 1");
      				$adminbilgis->execute([$_SESSION['sesadmin']]);
      				$adminkontrolsayisi = $adminbilgis->rowCount();
      				$adminbilgi =$adminbilgis->fetch(PDO::FETCH_ASSOC);		

      				if($adminkontrolsayisi>0){
      					$adminAd = $adminbilgi['adminad'];
      					$adminId=$adminbilgi['adminid'];
      					$adminSifre=$adminbilgi['adminsifre'];
      				}

      				

 }



 if(isset($_SESSION['seskullanici']))

 {

 		$adminbilgis= $db->prepare("SELECT * FROM kullanicilar WHERE kullaniciadi = ? LIMIT 1");
      				$adminbilgis->execute([$_SESSION['seskullanici']]);
      				$adminkontrolsayisi = $adminbilgis->rowCount();
      				$adminbilgix =$adminbilgis->fetch(PDO::FETCH_ASSOC);		

      				if($adminkontrolsayisi>0){
      					$kullaniciad = $adminbilgix['kullaniciadi'];
      					$kullaniciId=$adminbilgix['kullaniciid'];
      					$kullaniciIsim=$adminbilgix['isim'];
      					$unvan = $adminbilgix['unvan'];
      				}

      				

 }


 ?>