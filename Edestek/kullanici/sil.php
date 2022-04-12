<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require_once '../connection/baglan.php';


if(isset($_SESSION['seskullanici']))
{
    echo $kullaniciad;
    echo "<br>";
echo $kullaniciId;
echo "<br>";
echo $kullaniciIsim;
echo "<br>";
}

if(isset($_GET['belId']))
{
    $belgeIdm = $_GET['belId'];

     $bilgilerimsor2 =$db->prepare("select dokumanlar.belgeId,yazarlar.yazarAdi,yazarlar.yazarNo,yazarlar.yazarOgrTuru,yazarlar.yazarSoyad from dokumanlar,yazarlar,belge,kullanicilar where
 yazarlar.yazarId=dokumanlar.yazarId and belge.belgeId=dokumanlar.belgeId  and dokumanlar.kullaniciid=kullanicilar.kullaniciid and dokumanlar.belgeId = ?");
 $bilgilerimsor2 ->execute([$belgeIdm]);
   $noDizi = array();
   while($cek=$bilgilerimsor2 -> fetch(PDO::FETCH_ASSOC)){
    array_push($noDizi,$cek['yazarNo']);
   }
    $sil =$db->prepare("DELETE FROM belge WHERE belgeId =:belgeIdm");
    $kontrol =$sil->execute(array(
        'belgeIdm'=>$belgeIdm
    ));

    if($kontrol)
    {
        foreach ($noDizi as $key => $value) {
             $silx =$db->prepare("DELETE FROM yazarlar WHERE yazarNo =:yazars");
    $kontrolx =$silx->execute(array(
        'yazars'=>$value
    ));
        }

        header("location:kullaniciPanel.php?silme=evet");
    }
}

 ?>


