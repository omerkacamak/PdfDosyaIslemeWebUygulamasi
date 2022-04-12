<?php
require_once '../connection/baglan.php'; 
session_start();
	
if(isset($_SESSION['seskullanici']))
{
  

}
if (isset($_GET['kimlik'])) {
	$kimlikId = $_GET['kimlik'];
	$kimlikIsim = $_GET['isim'];
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
            <h5><?php echo $kullaniciIsim ?> <?php echo $_GET['isim'] ?></h5>
          </a>
          
        </li>

      </ul>
    </div>
  </div>
</nav>



<div class="container">
	<input  class="form-control form-control-lg my-3" type="text" placeholder="En az 3 karakter" id="aramaCubuk">

	<div class="row">
		<div class="col">
				<div class="custom-control custom-radio custom-control-inline">
  					<input type="radio" id="customRadioInline1" name="customRadioInline1" class="custom-control-input" checked>
  					<label class="custom-control-label" for="customRadioInline1">Yazar</label>
				</div>
		</div>

		<div class="col">
				<div class="custom-control custom-radio custom-control-inline">
  					<input type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input">
  					<label class="custom-control-label" for="customRadioInline2">Ders</label>
				</div>
		</div>

		<div class="col">
				<div class="custom-control custom-radio custom-control-inline">
  					<input type="radio" id="customRadioInline3" name="customRadioInline1" class="custom-control-input">
  					<label class="custom-control-label" for="customRadioInline2">Proje Adı</label>
				</div>
		</div>


		<div class="col">
				<div class="custom-control custom-radio custom-control-inline">
  					<input type="radio" id="customRadioInline4" name="customRadioInline1" class="custom-control-input">
  					<label class="custom-control-label" for="customRadioInline4"> Anahtar Kelimeler </label>
				</div>
		</div>


		<div class="col">
				<div class="custom-control custom-radio custom-control-inline">
  					<input type="radio" id="customRadioInline5" name="customRadioInline1" class="custom-control-input">
  					<label class="custom-control-label" for="customRadioInline5"> Dönem </label>
				</div>
		</div>

		<div class="col">
				<div class="custom-control custom-radio custom-control-inline">
  					<input type="radio" id="customRadioInline6" name="customRadioInline1" class="custom-control-input" value="sor">
  					<label class="custom-control-label"  for="customRadioInline6"> 2.Sorgu </label>
				</div>
		</div>
			<div id="put" class="d-none"><?php echo $kimlikId ?></div>





	</div>


<div id="sonuclar2" class="my-3" ></div>

<?php 

$bilgilerimsor41 = $db -> prepare("select belgeTeslim from belge");
$sorDers= $db->prepare("select  * from dersler");
$sorKul =$db->prepare("select * from kullanicilar");
$bilgilerimsor41 -> execute();
$sorDers ->execute();
$sorKul ->execute();

 ?>
	<div id="secim" class="row g-2 d-none">
		<div class="col-md">
			<div class="form-floating">
      <select class="form-select" id="floatingSelectGrid1" aria-label="Floating label select example">
     
        <?php 
        while($bilgilerimcek41=$bilgilerimsor41 -> fetch(PDO::FETCH_ASSOC)){
         ?>
          <option value="<?php echo $bilgilerimcek41['belgeTeslim'] ?>"><?php echo $bilgilerimcek41['belgeTeslim'] ?></option>
        <?php } ?>
      </select>
      <label for="floatingSelectGrid">Dönem Seçin</label>
    </div>
		</div>

<div class="col-md">
			<div class="form-floating">
      <select class="form-select" id="floatingSelectGrid2" aria-label="Floating label select example">
         <?php 
        while($bilgilerimcek35=$sorKul -> fetch(PDO::FETCH_ASSOC)){
         ?>
          <option value="<?php echo $bilgilerimcek35['isim']  ?>"><?php echo $bilgilerimcek35['unvan'] ." ".$bilgilerimcek35['isim']  ?></option>
        <?php } ?>
      </select>
      <label for="floatingSelectGrid">Kullanıcı Seçin</label>
    </div>
		</div>

<div class="col-md">
			<div class="form-floating">
      <select class="form-select" id="floatingSelectGrid3" aria-label="Floating label select example">
          <?php 
        while($bilgilerimcek77=$sorDers -> fetch(PDO::FETCH_ASSOC)){
         ?>
          <option value="<?php echo $bilgilerimcek77['dersAdi'] ?>"><?php echo $bilgilerimcek77['dersAdi'] ?></option>
        <?php } ?>
      </select>
      <label for="floatingSelectGrid">Ders seçin</label>
    </div>
		</div>

<div class="col-md">
			<div class="form-floasting">
      <button id="bul" class="btn btn-outline-danger">Ara</button>
        
    </div>
		</div>
<blockquote class="blockquote alert alert-success">
  <p id="alinti" class="mb-0"></p>
</blockquote>
	</div>


<div id="sonuclar" class="my-3"></div>







</div>


<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <script type="text/javascript" src="kulbasla.js"></script>
</body>
</html>


 