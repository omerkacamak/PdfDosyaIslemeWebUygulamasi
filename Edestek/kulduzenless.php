<?php
require_once 'connection/baglan.php'; 
session_start();
if(!$_SESSION['sesadmin'])
{
	header("location:admingiris.php");
}

if(isset($_SESSION['sesadmin']))
{
    echo $adminAd;
    echo "<br>";
echo $adminId;
echo "<br>";
echo $adminSifre;
echo "<br>";
echo "Allah";
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
<nav class="navbar navbar-light bg-light row">
 <div class="">
 	<a href="#"><img class="kou" src="images/kou.jpg"></a>
 	 <span class="navbar-text display-5 align-self-center">
    YÖNETİM PANELİ </span>

     <span class="navbar-text display-5 align-self-center">
    KULLANICI DÜZENLE </span>


 </div>
 </nav>
 <a href="cikis.php" class="btn btn-outline-danger">ÇIKIŞ</a>

<div class="container">
  	
<form action="islem.php" method="post">
	
		<?php 

		   if($_GET['kayit']=="evet")
           {
            echo '<div class="alert alert-warning"> Kayıt Silindi </div>';
            header("refresh:1.5 url=yonetimPanel.php");
           }
		 ?>
	
	<div class="form-group">
		    <label for="kullaniciadi">Kullanıcı Adı: </label>
		 <input  class="form-control" type="text" name="kullaniciadi">
		
		
	</div>
	<div class="form-group">
		        <label for="kullanicisifre">Kullanici Sifre</label>
		         <input class="form-control" type="password" name="kullanicisifre">
		
	</div>

	<div class="form-group">
		     <label for="unvan">Ünvan</label>
		     <input class="form-control" type="text" name="unvan">
		
	</div>

	<div class="form-group">
		     <label for="isim">İsim</label>
		     <input class="form-control" type="text" name="isim">
		
	</div>
	<button  name="eklebtn" type="submit" class="btn btn-primary text-center">Ekle</button>

</form>
</div>



</body>
</html>