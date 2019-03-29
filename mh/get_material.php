<?php
$pn = $_POST['pn'];
include '../admin/koneksi.php';
//ambil data di tabel daftar nis tersebut
$query = "SELECT * FROM material WHERE pn='$pn' ";
$rs = mysql_query($query) or die (mysql_error());
$data = mysql_fetch_array($rs);
//ubah array data menjadi JSON
echo json_encode($data);
?>
