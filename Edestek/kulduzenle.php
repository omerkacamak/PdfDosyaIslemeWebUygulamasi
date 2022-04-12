<?php 
session_start();
require_once 'connection/baglan.php';


if(isset($_SESSION['sesadmin']))
{
   
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
    	<div class="display-3 mx-5 ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ADMİN PANELİ </div>
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="yonetimPanel.php">Ana Sayfa</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="yonetimPdf.php?kullaniciid=hepsi">PDF Dökümanları</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link active " href="sorgu.php"  role="button" 	 aria-expanded="false">
            <b>SORGULAR</b>
          </a>
          
        </li>

        <li class="nav-item ">
          <a class="nav-link active " href="cikis.php"  role="button" 	 aria-expanded="false">
            ÇIKIŞ
          </a>
          
        </li>

      </ul>
    </div>
  </div>
</nav>



<?php 
$bilgilerimsorx = $db->prepare("SELECT * from kullanicilar where kullaniciid=:id");
$bilgilerimsorx->execute(array(
	'id' =>$_GET['duzenleid']
));
$bilgilerimcekx= $bilgilerimsorx->fetch(PDO::FETCH_ASSOC); // bilgilerim cek ile artık alırız

 ?>
<div class="container">
  	<div class="my-3 display-5 text-danger "><?php  echo $bilgilerimcekx['kullaniciadi']?>  kullanıcısının bilgilerini düzenle</div>
<form action="islem.php" method="post">
	
		
	
	<div class="form-group">
		    <label for="kullaniciadi">Kullanıcı Adı: </label>
		 <input  class="form-control" type="text" name="kullaniciadi" value="<?php echo $bilgilerimcekx['kullaniciadi'] ?>">
		
		
	</div>
	<div class="form-group">
		        <label for="kullanicisifre">Kullanici Sifre</label>
		         <input class="form-control" type="password" name="kullanicisifre" value="<?php echo $bilgilerimcekx['kullanicisifre'] ?>">
		
	</div>

	<div class="form-group">
		     <label for="unvan">Ünvan</label>
		     <input class="form-control" type="text" name="unvan" value="<?php echo $bilgilerimcekx['unvan'] ?>">
		
	</div>

	<div class="form-group">
		     <label for="isim">İsim</label>
		     <input class="form-control" type="text" name="isim" value="<?php echo $bilgilerimcekx['isim'] ?>">
		
	</div>
	<input type="hidden" name="kulid" value="<?php echo $bilgilerimcekx['kullaniciid'] ?>">
	<button  name="updateislemi" type="submit" class="btn btn-primary text-center">Düzenle</button>

</form>
</div>

</body>
</html>