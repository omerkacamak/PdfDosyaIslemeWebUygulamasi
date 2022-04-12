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
		body{
			background-color: ;
		}
		.kou{
	width: 120px;
	height: 120px;
}

.cizgi{
	width: 100%;
	height: 100%;
	background-color: ;
	border-style: groove;
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
<div class="container my-5 cizgi p-2">
<div class="container">
  	
<form action="islem.php" method="post">
	<div class="text-center mt-3"><h3><b>Kullanıcı Ekleme</b></h3></div>
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

<table class="table table-bordered mt-5 container">
	<tr class="text-center">
		
		<th>ID</th>
		<th>Unvan</th>
		<th>İsim</th>

	</tr>


<?php 
 $bilgilerimsor = $db -> prepare("select * from kullanicilar");
$bilgilerimsor -> execute();
while($bilgilerimcek=$bilgilerimsor -> fetch(PDO::FETCH_ASSOC)){?>
	<tr class="text-center">
		<td><?php echo $bilgilerimcek['kullaniciid'] ?></td>
		<td><?php echo $bilgilerimcek['unvan'] ?></td>
		<td><?php echo $bilgilerimcek['isim'] ?></td>
		<td><a class='btn btn-success' href="kulduzenle.php?duzenleid=<?php echo $bilgilerimcek['kullaniciid'] ?>">Düzenle</a>
<a class='btn btn-danger' href="islem.php?kullaniciidx=<?php echo $bilgilerimcek['kullaniciid'] ?>&bilgilerimsil=ok">Sil</a>

<a class='btn btn-warning' href="yonetimPdf.php?kullaniciid=<?php echo $bilgilerimcek['kullaniciid'] ?>">Dökümanları</a>
</td>

		
		
		

	</tr>

<?php } 

?>
 	


</table>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" 
    crossorigin="anonymous"></script>
</body>
</html>