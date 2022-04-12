<?php 
session_start();
require_once '../connection/baglan.php';
if(isset($_SESSION['seskullanici']))
{
  
}


if(!$_SESSION['seskullanici'])
{
  header("location:kullanicigiris.php");
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
<nav class="navbar navbar-expand-lg navbar-dark bg-success static-top">
  <div class="container">
    <a class="navbar-brand" href="#">
      <img src="../images/kou.png" alt="..." class="kou">
    </a>
   
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="kullaniciPanel.php">Ana Sayfa</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="kullaniciPdf.php"> Tüm PDF Dökümanları</a>
        </li>


        <li class="nav-item">
          <a class="nav-link active" href="kulSorgu.php?kimlik=<?php echo $kullaniciId ?>&isim=<?php echo $kullaniciIsim ?>">SORGULAR</a>
        </li>

        

        <li class="nav-item ">
          <a class="nav-link active" href="cikiskul.php"  role="button"   aria-expanded="false">
             ÇIKIŞ
          </a>
          
        </li>

        <li class="nav-item ">
          <a class="nav-link active" href="#"  role="button"   aria-expanded="false">
            <h5><?php echo $kullaniciIsim ?></h5>
          </a>
          
        </li>

      </ul>
    </div>
  </div>
</nav>


<?php 

 // $bilgilerimsor = $db -> prepare("select * from belgeleri where kullaniciid= ?");
 $bilgilerimsor1 = $db -> prepare("select  DISTINCT dokumanlar.belgeId,kullanicilar.kullaniciadi,belge.belgeSrc,
kullanicilar.isim, kullanicilar.unvan, dersler.dersAdi,belge.belgeOzet,belge.belgeTeslim,belge.belgeBaslik,belge.belgeAnahtar
from dokumanlar,kullanicilar,yazarlar,belge,dersler where dokumanlar.kullaniciid=? and dokumanlar.kullaniciid=kullanicilar.kullaniciid and 
yazarlar.yazarId=dokumanlar.yazarId and belge.belgeId=dokumanlar.belgeId and dersler.dersId=belge.dersId 
");
$bilgilerimsor2 =$db->prepare("select dokumanlar.belgeId,yazarlar.yazarAdi,yazarlar.yazarNo,yazarlar.yazarOgrTuru,yazarlar.yazarSoyad from dokumanlar,yazarlar,belge,kullanicilar where
 yazarlar.yazarId=dokumanlar.yazarId and belge.belgeId=dokumanlar.belgeId  and dokumanlar.kullaniciid=kullanicilar.kullaniciid and dokumanlar.belgeId = ?");

  $bilgilerimsor1 -> execute([$kullaniciId]);
  
  //$bilgilerimcek2=$bilgilerimsor2 -> fetch(PDO::FETCH_ASSOC);
  $indexx=0;
  $indexx2=0;
  ?>
  <div class="container">
  <div class="row ">
  <?php 
$artis=0;

  while($bilgilerimcekap=$bilgilerimsor1 -> fetch(PDO::FETCH_ASSOC)){
    
        $bilgilerimsor2 ->execute([$bilgilerimcekap['belgeId']]);

        echo ' <div class="col-6">';
        echo '<div class="card my-5 " style="width: 30rem; height: 70rem;" >';
    echo '<div class="card-header">';
    echo '<h4 class="card-title">' . $bilgilerimcekap['belgeBaslik']. " - " .$bilgilerimcekap['dersAdi'] . '  <a  href="../dosyaindir.php?file=' . $bilgilerimcekap['belgeSrc']."&kulid=". $_GET['kullanicisid'] . '"><img style="width: 1.7rem;"  src="../images/pedef.png"> </a> </h4>' . '   </div> ' ;
    echo '<div class="card-body ">';


    while($cek=$bilgilerimsor2 -> fetch(PDO::FETCH_ASSOC)){
      echo '<div><b>Öğrenci Adı Soyadı : </b>'. $cek['yazarAdi'] ."  " .$cek['yazarSoyad'] .'</div><hr>';


    }

    echo '<div><b>Proje Başlığı :</b>' .$bilgilerimcekap['belgeBaslik'] .'</div><hr>';
    echo '<div><b>Dönem : </b> ' .$bilgilerimcekap['belgeTeslim']. ' <hr>';
    echo '<div><b>Özet : </b>' .$bilgilerimcekap['belgeOzet'] . '</div> <hr>';
    echo '<div><b>Anahtar Kelimeler: </b>' .$bilgilerimcekap['belgeAnahtar'] .'</div><hr>';
    echo '<div><b> Danışman : </b>' .$bilgilerimcekap['unvan'] . "  " .$bilgilerimcekap['isim'] . '</div> <hr>';
    echo '<div><b>Dosyalar : </b>  <a  href="../dosyaindir.php?file='.$bilgilerimcekap['belgeSrc'].'&kulid=' .'"><img style="width: 1.7rem;"  src="../images/pedef.png"> </a></div> ';
    echo ' </div></div></div>';
    echo '</div>'; // col sonu
    $artis++;
  }

 
   ?>
   </div>
   </div>



</body>
</html>

