<?php 

include '../admin/koneksi.php';
$pn = $_POST['pn'];
$desc = $_POST['desc'];
$sn = $_POST['sn'];
$jenis = $_POST['jenis'];

mysql_query("UPDATE material SET  sn='$sn', jenis='$jenis' WHERE pn='$pn'");
header('Location: index.php?page=material');

?>
