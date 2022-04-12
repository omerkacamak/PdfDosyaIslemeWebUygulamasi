<?php 
session_start();
require_once '../connection/baglan.php';
if(isset($_SESSION['seskullanici'])){
session_destroy();
header("location:kullanicigiris.php");

}else{
	header("location:admingiris.php");
	exit();
}
 ?>