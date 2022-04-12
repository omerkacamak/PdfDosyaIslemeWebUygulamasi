<?php 

require_once '../connection/baglan.php';
session_start();
if($_SESSION['seskullanici'])
{
  header("location:kullaniciPanel.php");
}


 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>
  <link rel="stylesheet" type="text/css" href="../style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-success  static-top">
  <div class="container">
    <a class="navbar-brand" href="#">
      <img src="../images/kou.png" alt="..." class="kou">
    </a>
   
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="../index.php"><h4>KOCAELİ ÜNİVERSİTESİ</h4></a>
        </li>
        
      </ul>
    </div>
  </div>
</nav>


  
<div class="container temp">
  <h2 class="mb-4">KULLANICI PANELE GİRİŞ</h2>
  <div class="outer-box">
    <div class="login-box">
      <h4 class="login-text">Giriş</h4>

      <div class="card-body">
        <?php 
session_start();
          if($_POST){
            $kuladi = $_POST['kullaniciadi'];
            $kulsifre=$_POST['kullanicisifre'];
            if($kulsifre!="" and $kuladi!="")
            {
              $adminkontrol= $db->prepare("SELECT * FROM kullanicilar WHERE kullaniciadi = ?   and kullanicisifre = ? ");
              $adminkontrol->execute([$kuladi,$kulsifre]);
              $adminkontrolsayisi = $adminkontrol->rowCount();


              if($adminkontrolsayisi>0)
              {
                $_SESSION['seskullanici'] =$kuladi;
                echo '<div class="alert alert-success"> Giriş Başarılı </div>';
                header("refresh:1 url=kullaniciPanel.php");
              }else{
                echo '<div class="alert alert-danger"> Bu bilgilere ait kullanıcı bulunamadı </div>';
              }
            }else{
              echo '<div class="alert alert-danger"> Lütfen boş değer göndermeyin! </div>';
              
            }
            

          }

           ?>
      </div>

      <center>
      <form method="post">
        <input placeholder="Kullanıcı Adı" name="kullaniciadi">
      <input type="password" placeholder="Şifre" name="kullanicisifre">

      <button  type="submit" name="kullanicigiris" class="btn-lg btn-success mt-2 ">Giriş Yap</button>
      </form>
      
      </center>


    </div>
  </div>
</div>





</body>
</html>