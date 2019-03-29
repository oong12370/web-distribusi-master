<?php 
session_start();
error_reporting(0);
include("koneksi.php");
$user=$_POST['username'];
$lama=base64_encode($_POST['lama']);
$baru=$_POST['baru'];
$ulang=$_POST['ulang'];

$cek=mysql_query("select * from users where password='$lama' and username='$user'");
if(mysql_num_rows($cek)==1){
	if($baru==$ulang){
		$b = base64_encode($baru);
		mysql_query("update users set password='$b' where username='$user'");
		header("location:index.php?page=ganti_pass&pesan=oke");
	}else{
		header("location:index.php?page=ganti_pass&pesan=tdksama");
	}
}else{
	header("location:index.php?page=ganti_pass&pesan=gagal");
}

 ?>