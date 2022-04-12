<?php
require_once 'connection/baglan.php'; 
session_start();
if(!$_SESSION['sesadmin'])
{
	header("location:admingiris.php");
}


 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<style type="text/css">
		*	{
			margin: 0;
			padding: 0;
		}
		.kou{
	width: 120px;
	height: 120px;
}
	</style>
	<title></title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-success static-top mb-5">
  <div class="container">
    <a class="navbar-brand" href="#">
      <img src="images/kou.png" alt="..." class="kou">
    </a>
   
    <div class="collapse navbar-collapse " id="navbarSupportedContent">
      <div class="display-4 mx-5 ">&nbsp;&nbsp;ADMİN PANELİ </div>
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="yonetimPanel.php">Ana Sayfa</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="yonetimPdf.php?kullaniciid=hepsi">PDF Dökümanları</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link active " href="sorgu.php"  role="button"    aria-expanded="false">
            <b>SORGULAR</b>
          </a>
          
        </li>

        <li class="nav-item ">
          <a class="nav-link active " href="cikis.php"  role="button"    aria-expanded="false">
            ÇIKIŞ
          </a>
          
        </li>

      </ul>
    </div>
  </div>
</nav>
<?php 
if($_GET['dosya']=="no")
{
	$kulid = $_GET['kullaniciid'];
	echo "<div class='alert alert-danger' >DOSYA YOK VEYA AÇILAMIYOR</div>";
	header("refresh:1 url=yonetimPdf.php?kullaniciid=$kulid");
}


 ?>


<?php 

 // $bilgilerimsor = $db -> prepare("select * from belgeleri where kullaniciid= ?");
 $bilgilerimsor1 = $db -> prepare("select  DISTINCT dokumanlar.belgeId,kullanicilar.kullaniciadi,belge.belgeSrc,
kullanicilar.isim, kullanicilar.unvan, dersler.dersAdi,belge.belgeOzet,belge.belgeTeslim,belge.belgeBaslik,belge.belgeAnahtar
from dokumanlar,kullanicilar,yazarlar,belge,dersler where dokumanlar.kullaniciid=? and dokumanlar.kullaniciid=kullanicilar.kullaniciid and 
yazarlar.yazarId=dokumanlar.yazarId and belge.belgeId=dokumanlar.belgeId and dersler.dersId=belge.dersId 
");

  $bilgilerimsorHepsi = $db -> prepare("select  DISTINCT dokumanlar.belgeId,kullanicilar.kullaniciadi,belge.belgeSrc,
kullanicilar.isim, kullanicilar.unvan, dersler.dersAdi,belge.belgeOzet,belge.belgeTeslim,belge.belgeBaslik,belge.belgeAnahtar
from dokumanlar,kullanicilar,yazarlar,belge,dersler where  dokumanlar.kullaniciid=kullanicilar.kullaniciid and 
yazarlar.yazarId=dokumanlar.yazarId and belge.belgeId=dokumanlar.belgeId and dersler.dersId=belge.dersId 
");
$bilgilerimsor2 =$db->prepare("select dokumanlar.belgeId,yazarlar.yazarAdi,yazarlar.yazarNo,yazarlar.yazarOgrTuru,yazarlar.yazarSoyad from dokumanlar,yazarlar,belge,kullanicilar where
 yazarlar.yazarId=dokumanlar.yazarId and belge.belgeId=dokumanlar.belgeId  and dokumanlar.kullaniciid=kullanicilar.kullaniciid and dokumanlar.belgeId = ?");


  
  //$bilgilerimcek2=$bilgilerimsor2 -> fetch(PDO::FETCH_ASSOC);
  $indexx=0;
  $indexx2=0;
  ?>
  <div class="container"><?php  ?>
  <div class="row ">
    
  <?php 
$artis=0;
	if($_GET['kullaniciid']!="hepsi")
	{

  $bilgilerimsor1 -> execute([$_GET['kullaniciid']]);
  while($bilgilerimcekap=$bilgilerimsor1 -> fetch(PDO::FETCH_ASSOC)){
    
        $bilgilerimsor2 ->execute([$bilgilerimcekap['belgeId']]);
          ?>     <?php  
        echo ' <div class="col-6">';
        echo '<div class="card my-5 " style="width: 32rem; height: 70rem;" >';
    echo '<div class="card-header">';
    echo '<h4 class="card-title">' . $bilgilerimcekap['belgeBaslik']. " - " .$bilgilerimcekap['dersAdi'] . '  <a  href="dosyaindir.php?file=' . $bilgilerimcekap['belgeSrc']."&kulid=". $_GET['kullaniciid'] . '"><img style="width: 1.7rem;"  src="images/pedef.png"> </a> </h4>' . '   </div> ' ;
    ?> 
      <h4 class="card-title"></h4>
    <?php  
    echo '<div class="card-body ">';


    while($cek=$bilgilerimsor2 -> fetch(PDO::FETCH_ASSOC)){
     echo '<div><b>Öğrenci Adı Soyadı : </b>'. $cek['yazarAdi'] ."  " .$cek['yazarSoyad'] .'  -  '.$cek['yazarNo']. '  -  '.$cek['yazarOgrTuru'] .'</div><hr>';


    }

    echo '<div><b>Proje Başlığı :</b>' .$bilgilerimcekap['belgeBaslik'] .'</div><hr>';
    echo '<div><b>Dönem : </b> ' .$bilgilerimcekap['belgeTeslim']. ' <hr>';
    echo '<div><b>Özet : </b>' .$bilgilerimcekap['belgeOzet'] . '</div> <hr>';
    echo '<div><b>Anahtar Kelimeler: </b>' .$bilgilerimcekap['belgeAnahtar'] .'</div><hr>';
    echo '<div><b> Danışman : </b>' .$bilgilerimcekap['unvan'] . "  " .$bilgilerimcekap['isim'] . '</div> <hr>';
   echo '<div><b>Dosyalar : </b>  <a  href="dosyaindir.php?file='.$bilgilerimcekap['belgeSrc'].'&kulid=' .'"><img style="width: 1.7rem;"  src="images/pedef.png"> </a></div> ';
    echo ' </div></div></div>';
    echo '</div>'; // col sonu
    $artis++;
  }
} else if($_GET['kullaniciid'])

	{
		  $bilgilerimsorHepsi -> execute();
		while($bilgilerimcekap=$bilgilerimsorHepsi -> fetch(PDO::FETCH_ASSOC)){
    
        $bilgilerimsor2 ->execute([$bilgilerimcekap['belgeId']]);

        echo ' <div class="col-6">';
        echo '<div class="card my-5 " style="width: 32rem; height: 70rem;" >';
    echo '<div class="card-header">';
    echo '<h4 class="card-title">' . $bilgilerimcekap['belgeBaslik']. " - " .$bilgilerimcekap['dersAdi'] . '  <a  href="dosyaindir.php?file=' . $bilgilerimcekap['belgeSrc']."&kulid=". $_GET['kullaniciid'] . '"><img style="width: 1.7rem;"  src="images/pedef.png"> </a> </h4>' . '   </div> ' ;
    echo '<div class="card-body ">';


    while($cek=$bilgilerimsor2 -> fetch(PDO::FETCH_ASSOC)){
     echo '<div><b>Öğrenci Adı Soyadı : </b>'. $cek['yazarAdi'] ."  " .$cek['yazarSoyad'] .'  -  '.$cek['yazarNo']. '  -  '.$cek['yazarOgrTuru'] .'</div><hr>';


    }

    echo '<div><b>Proje Başlığı :</b>' .$bilgilerimcekap['belgeBaslik'] .'</div><hr>';
    echo '<div><b>Dönem : </b> ' .$bilgilerimcekap['belgeTeslim']. ' <hr>';
    echo '<div><b>Özet : </b>' .$bilgilerimcekap['belgeOzet'] . '</div> <hr>';
    echo '<div><b>Anahtar Kelimeler: </b>' .$bilgilerimcekap['belgeAnahtar'] .'</div><hr>';
    echo '<div><b> Danışman : </b>' .$bilgilerimcekap['unvan'] . "  " .$bilgilerimcekap['isim'] . '</div> <hr>';
    echo '<div><b>Dosyalar : </b>  <a  href="dosyaindir.php?file='.$bilgilerimcekap['belgeSrc'].'&kulid=' .'"><img style="width: 1.7rem;"  src="images/pedef.png"> </a></div> ';
    echo ' </div></div></div>';
    echo '</div>'; // col sonu
    $artis++;
  }
	}

 
   ?>
   </div>
   </div>


	
</body>
</html>