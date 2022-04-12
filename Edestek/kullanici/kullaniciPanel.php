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


<div class="container my-5 bg-light">
  <form action="../jaja.php" method="POST" enctype="multipart/form-data">
  <h1 class="text-center">PDF Yükle</h1>
  <p><input class="form-control form-control-lg" type="file" name="dosya"></p>
  <input class="btn btn-primary " type="submit" name="dugme" value="YÜKLE">
</form>
</div>

<div class="alert alert-warning text-center container mt-5">PDF DÖKÜMANLARI </div>
 <div class="container">

 <div class="container">
<table class="table table-striped table-hover table-bordered"> 
  <tr class="text-center ">
  <th class="">Proje Başlık</th>
  <th class="">Dönem</th>
  <th></th>
  <th></th>

  </tr>

  <?php 
$kulid = $_GET['kullaniciid'];


 // $bilgilerimsor = $db -> prepare("select * from belgeleri where kullaniciid= ?");
 $bilgilerimsor = $db -> prepare("select  DISTINCT dokumanlar.belgeId,kullanicilar.kullaniciadi,belgeBaslik,  belge.belgeSrc,belgeTeslim,dersAdi from dokumanlar,dersler,kullanicilar,yazarlar,belge where dokumanlar.kullaniciid=? and dokumanlar.kullaniciid=kullanicilar.kullaniciid and yazarlar.yazarId=dokumanlar.yazarId and belge.belgeId=dokumanlar.belgeId 
 and dersler.dersId = belge.dersId ;
");
 $bilgilerimsor2 =$db->prepare("select dokumanlar.belgeId,yazarlar.yazarAdi,yazarlar.yazarNo,yazarlar.yazarOgrTuru,yazarlar.yazarSoyad from dokumanlar,yazarlar,belge,kullanicilar where
 yazarlar.yazarId=dokumanlar.yazarId and belge.belgeId=dokumanlar.belgeId  and dokumanlar.kullaniciid=kullanicilar.kullaniciid and dokumanlar.belgeId = ?");

  $bilgilerimsor -> execute([$kullaniciId]);
  while($bilgilerimcek=$bilgilerimsor -> fetch(PDO::FETCH_ASSOC)){?>
    <?php $kaynak =$bilgilerimcek['belgeSrc'];  ?>
    <?php $bilgilerimsor2 ->execute([$bilgilerimcek['belgeId']]); ?>
    <tr>
    <td class=""><b><?php echo $bilgilerimcek['belgeBaslik'] ?></b> - <?php echo $bilgilerimcek['dersAdi'] ?> </td>
    <td><?php echo $bilgilerimcek['belgeTeslim'] ?></td>
    <td class=""><?php echo $bilgilerimcek['belgeSrc'] ?></td>
    <td class="w-25 text-center" ><a href="pdfBilgi.php?belgeId=<?php echo $bilgilerimcek['belgeId'] ?>" class="btn btn-success">Bilgi</a> <a  href="../dosyaindir.php?file=<?php echo $bilgilerimcek['belgeSrc'] ?>&kulid="><img style="width: 1.7rem;"  src="../images/pedef.png"> </a>
      

      <a href="sil.php?belId=<?php echo $bilgilerimcek['belgeId'] ?>" class="btn btn-danger">

      Sil</a>
    </td>
  </tr>
  
<?php } 

  

?>
</table>
 </div>
</div>

  <div class="container">


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
  <div class="row ">

   </div>
</div>



    

 <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" 
    crossorigin="anonymous"></script>

<script>
    
        
var  sayi = $(".degerli").length;

/*for(var i=0 ; i<sayi-1; i++)
{
     $("#cak"+i).click(function(){

            $("#togs"+i).toggle("slow");
        });
     $("#cak"+i-1).click(function(){

            $("#togs"+i).toggle("slow");
        });

}*/

      
 $(".a1").click(function(e){
  console.log(e.target.parentElement.parentElement.parentElement.children[1].id);
  var bask =e.target.parentElement.parentElement.parentElement.children[1].id;
            $('.a2').toggle("slow");
        });
 

</script>
</body>
</html>