<?php 

require_once 'connection/baglan.php';
session_start();
if($_SESSION['sesadmin'])
{
  header("location:yonetimPanel.php");
}


 ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-success  static-top">
  <div class="container">
    <a class="navbar-brand" href="#">
      <img src="images/kou.png" alt="..." class="kou">
    </a>
   
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php"><h4>KOCAELİ ÜNİVERSİTESİ</h4></a>
        </li>
        
      </ul>
    </div>
  </div>
</nav>


    
<div class="container temp">
    <h2 class="mb-4">HOŞ GELDİNİZ</h2>
  <div class="outessr-box">
    <div class="login-box">
      <h4 class="login-text"></h4>
      <center>
        <div class="card-body">
           <a href="kullanici/kullanicigiris.php" class="btn btn-primary btn-lg">KULLANICI PANEL</a>
            <a href="admingiris.php" class="btn btn-success btn-lg">ADMİN PANEL</a>
        </div>
     
      
      </center>
    </div>
  </div>
</div>





</body>
</html>