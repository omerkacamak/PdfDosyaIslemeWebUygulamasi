<?php 
session_start();
if(isset($_SESSION['sesadmin'])){
session_destroy();
header("location:admingiris.php?durum=cikti");

}else{
	header("location:admingiris.php");
	exit();
}





 ?>