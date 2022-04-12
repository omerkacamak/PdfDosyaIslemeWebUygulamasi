<?php 
include 'vendor/autoload.php';

session_start();
require_once 'connection/baglan.php';
if(isset($_SESSION['seskullanici']))
{
    echo $kullaniciad;
    echo "<br>";
echo $kullaniciId;
echo "<br>";
echo $kullaniciIsim;
echo "<br>";
}
 $yol = "belgeler"; # Yüklenecek klasör / dizin
  $yuklemeYeri = __DIR__ . DIRECTORY_SEPARATOR . $yol . DIRECTORY_SEPARATOR . $_FILES["dosya"]["name"];	
$dosya = $_FILES["dosya"]["tmp_name"];
$yeniad = $_FILES["dosya"]["name"];


if(move_uploaded_file($dosya, $yeniad))
{
	header("location:kullanici/kullaniciPanel.php");
	echo "Dosya yüklendi. <br> 
	<img src ='$yuklemeYeri' height='100'
	<br>";
	/*echo "olum -->  $yuklemeYeri";
	echo "Olum laaa '{$yeniad}'";*/
	
}else{
	echo "Hata oluştu";
}
if(isset($_POST['dugme']))
{
	// Parse pdf file and build necessary objects.
$parser = new \Smalot\PdfParser\Parser();
$pdf    = $parser->parseFile($yeniad);
 
$tekSayfa = $pdf->getText();
$textx = $pdf->getPages();
$text=$textx[9]->getText();
$dizi = explode ("",$text);

$trm = trim($text);
$trm = explode(" ",$trm);
//echo $textx[3]->getText();

function multiexplode ($delimiters,$string) {

    $ready = str_replace($delimiters, $delimiters[0], $string);
    $launch = explode($delimiters[0], $ready);
    return  $launch;
}

function pedefe($sayfa){
$sayfam=$sayfa->getText();
$trm = trim($sayfam);
$trm = explode(" ",$trm); echo "<br> <br> <br>";
$diziler=array(); // kelime kelime ( bazı boşluklar dahil diziye çevirme)
echo "<br>  diziler ";
foreach ($trm as $key => $value) {
	
		array_push($diziler, trim($value));

}
echo "<br> <hr>";
foreach ($diziler as $key => $value) {
	
	//echo $key . " . "  . $value . "<br>";

}

$yenidizi = array();
foreach ($diziler as $key => $value) {
	if($value != "")
	{
		array_push($yenidizi,$value);
	}
	

}
echo "<br>";
echo " $ yenidizi";
echo "<hr>";
$sondizi=array();
foreach ($yenidizi as $key => $value) {
	array_push($sondizi,str_replace(chr(9),"",$value)); // saçma sapan boşlukları siliyoruz
	//echo $key . " . "  . $value . "<br>";
}

echo " $ sondizi";
echo "<hr>";

foreach ($sondizi as $key => $value) {
	
	echo $key . " . "  . $value . "<br>";
}

return $sondizi;

} // FONKSİYON SONU ******************

//echo $text;

echo "<br> <br> <br>";


echo '<br> <br>';

/*$diziler=array(); // kelime kelime ( bazı boşluklar dahil diziye çevirme)
echo "<br>  diziler ";
foreach ($trm as $key => $value) {
	
		array_push($diziler, trim($value));

}*/

$sayfa9 = pedefe($textx[9]);
$baslik;
$ozet;
$anahtar;
$serc = array_search("ÖZET",$sayfa9); // Özet sayfasından Konu başlığı çıkarma!
$ozsrc= array_search("Anahtar",$sayfa9);
$kelimeler =array_search("kelimeler:",$sayfa9);
for ($i=$kelimeler+1; $i <count($sayfa9) ; $i++) { 
	$anahtar .= $sayfa9[$i] . " ";
}
$anahtarlar = multiexplode(array(",","."),$anahtar);


foreach ($anahtarlar as $key => $value) {                           //ANAHTARLAR $$$$ANAHTARLAR  bu dizideki EN SON eleman boş almasan da olur!!
	echo " ---->>>     " . $value . "<br>";
}

foreach ($anahtarlar as $key => $value) {
	$strAnahtarlar.= $value ." ";
}

echo " <br>  ANAHTARLAR  : " .$anahtar;
for ($i=0; $i <$serc ; $i++) { 
	 $baslik .= $sayfa9[$i] . " ";
}
echo "<br> Başlık : " . $baslik; 
for ($i=$serc+1; $i <$ozsrc ; $i++) { 
	 $ozet .= $sayfa9[$i] . " ";
}
echo "<br> Özet: : " . $ozet; 


//*****************************************
$arr1=pedefe($textx[3]);
$isimler=array();
$soyisimler = array();
for ($i=0; $i < count($arr1) ; $i++) {   // Soyadı: ' dan sonra gelen ad soyadları aldık!!
	if($arr1[$i] == "Soyadı:")
	{
		array_push($isimler,$arr1[$i+1]);		
		array_push($soyisimler,$arr1[$i+2]);
	}

}
echo "İsim --- " . $isimler[1] . " zaaa : : " . $soyisimler[1] ;

//Numaralar:
$numbers = array(); // ÖĞRENCİ NOLARI!
for ($i=0; $i < count($arr1) ; $i++) {   // No: ' dan sonra gelen öğr noları aldık!! $ numbers
	if($arr1[$i] == "No:")
	{
		array_push($numbers,$arr1[$i+1]);
		
	}

}
echo "<br> abi çok saçma<br>";
foreach ($numbers as $key => $value) {
	
	echo $key . " . "  . $value . "<br>";
}

// ********************************************************************
echo "<br> <hr> bekleyin ";
$arr=pedefe($textx[1]);  // araştırma or bitirme tezi $ bolum ve juri ve tarih $

echo "<br> Sonuncusu : " . $arr[count($arr)-1]. "<br>";
$tarih =$arr[count($arr)-1] ;// TARİH
$tarihdizi=explode(".", $tarih);
echo " <br> Tarihimiz : " . $tarihdizi[count($tarihdizi)-1] ." <br>";
$sontarih =$tarihdizi[count($tarihdizi)-1];
$bul = array_search("BÖLÜMÜ",$arr);
for ($i= $bul+1; $i <=$bul+2 ; $i++) { 
	$bolum .= $arr[$i] . " ";
}
settype($sontarih, "integer");
$bolumIndex=-1;
if($arr[$bul+1]== "ARAŞTIRMA")
{
	$donem = ($sontarih-1) . " - " . $sontarih . " GÜZ DÖNEMİ";
	echo " <br> " . $donem . "<br>";
	$bolumIndex =1;

}else if($arr[$bul+1]== "BİTİRME"){
	$donem = ($sontarih-1) . " - " . $sontarih . " BAHAR DÖNEMİ"; // $ DONEM ÖNEMLİ !
	echo " <br> " . $donem . "<br>";
	$bolumIndex =2;
}







echo $bolum . "<br>"; echo "----------- <br>"; 
$sc = array_search($soyisimler[2],$arr);
$sc2 = array_search("Tezin",$arr);
$juri=array();
for ($i=$sc+1; $i <$sc2 ; $i++) { 
array_push($juri,$arr[$i]);
}
echo "<br> oğul <br> <hr>";
foreach ($juri as $key => $value) {
	echo  "Jüri : " . " . "  . $value . "<br>";
}
//**********************
$sayfa0 =pedefe($textx[0]);
$ara = array_search("TEZİ",$sayfa0);
$ara2 = array_search(mb_strtoupper($isimler[0],'utf8'),$sayfa0);
echo "<hr> " .$ara ."    " .$ara2; 
$asilBaslik;                                  // ASIL BAŞLIK!!!!!!!!!!!!!!!1
for ($i=$ara+1; $i <$ara2 ; $i++) { 
	 $asilBaslik .= $sayfa0[$i] . " ";
}

/*$query = $db->prepare("INSERT INTO yazarlar SET yazarAdi=?, yazarSoyad=?, yazarNo=?");
$insert = $query->execute(array($isimler[0],$soyisimler[0],$numbers[0]));

if ( $insert ){
    	header("location:../kullanici/kullaniciPanel.php");
}
else{
    echo "Kayıt eklenemedi";
    header("location:../kullanici/kullaniciPanel.php");
    exit();
}*/

$numarr=str_split($numbers[0]);
foreach ($numarr as $key => $value) {
	echo " ---< " .$value . "<br>";
}

if($numarr[5] == "1")
{
	$ogrTuru= "1.Öğretim";
}else if($numarr[5] == "2"){
	$ogrTuru="2.Öğretim";
}
echo "Ögr Yuru : " .$ogrTuru;

$toplam=0;
$query1 = $db->prepare("INSERT INTO belge SET belgeSrc=?, belgeOzet=?, belgeTeslim=?,belgeBaslik=?,belgeAnahtar=?,dersId=?");
$insert1 = $query1->execute(array($yeniad,$ozet,$donem,$baslik,$strAnahtarlar,$bolumIndex));
echo " kanka mıusın : " . $yeniad.$ozet.$donem.$baslik.$strAnahtarlar.$bolumIndex;
$sonbelge =$db->lastInsertid();
echo "    <br>  nikooo :  ". $insert1 . "<br>";
$toplam +=$insert1;
$i=0;
$sonid=array();
foreach ($isimler as $key => $value) {
$query = $db->prepare("INSERT INTO yazarlar SET yazarAdi=?, yazarSoyad=?, yazarNo=?,yazarOgrTuru=?");
$insert2 = $query->execute(array($isimler[$i],$soyisimler[$i],$numbers[$i],$ogrTuru));
$toplam +=$insert2;
$lastid = $db->lastInsertid();
array_push($sonid,$lastid);
echo "Prekazi id --> " .$lastid; 
$query = $db->prepare("INSERT INTO dokumanlar SET kullaniciid=?, yazarId=?, belgeId=?");
$insert3 = $query->execute(array($kullaniciId,$lastid,$sonbelge));
$toplam +=$insert3;


$i++;

}

header("location:kullanici/kullaniciPanel.php");
} // DUGME SONU
echo "<br> <hr>";




echo "<br> <br> <hr> <hr>";
echo "Ad Soyad : " . $isimler[0]. " ".$soyisimler[0] ." - ".$numbers[0];
echo "<br> Ders Adı : " .$bolum. " <br>";
echo $donem . " <br>";
echo "Proje Başlığı : " . $baslik . "<br>";
echo " <hr> Özet :  " .$ozet . "<br>";
echo " Anahtarlar " .$strAnahtarlar;
echo "          ara: ".$ara . "           ara2  " .$ara2. "<br>";
echo "belgeSrc =  " .$yeniad;
echo "Bolum index      " .$bolumIndex;
echo  "   sayfa0   " .$sayfa0[12]  . "   BU da isimler0    " .mb_strtoupper($isimler[0],'utf8') . "   ";

foreach ($sayfa0 as $key => $value) {
	echo $key . " . "  . $value . "<br>";
}

//$query = $db->prepare("INSERT INTO yazarlar SET yazarAdi=?, yazarSoyad=?, yazarNo=?");
//$insert = $query->execute(array("aaa","ssss","1904"));



 ?>
