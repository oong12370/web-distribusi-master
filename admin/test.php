<?php
include "koneksi.php";
$sql = "SELECT whn_dest, COUNT( * ) AS total FROM distribusi GROUP BY whn_dest";
$query = mysql_query($sql);
$count = mysql_num_rows($query);

echo "Jumlah data dengan mysql_num_rows: $count  <br/>";
echo "Jumlah data dengan mysql_num_rows: $count['whn_dest ']  <br/>";
?>
