<?php

include 'admin/koneksi.php';

if(isset($_GET['search_word']))
{
$search_word=$_GET['search_word'];

$sql=mysql_query("select * from distribusi WHERE no_dn LIKE '%$search_word%' ORDER BY no_dn DESC LIMIT 20");

$count=mysql_num_rows($sql);

if($count > 0)
{
?>
<tr>
        <td align="center" width="50" bgcolor="#DCDCDC"><span class="style7">No Delivery </span></td>
        <td	align="center"  width="70" bgcolor="#DCDCDC"><span class="style7">Tanggal </span></td>
        <td align="center" width="100" bgcolor="#DCDCDC"><span class="style7">Warehouse Destination</span></td>
        <td align="center" width="76" bgcolor="#DCDCDC"><div align="center"><em>Aksi</em></div></td>
</tr>
<?php 
while($row=mysql_fetch_array($sql))
{

		
echo "<tr>";
echo "<td>".$row['no_dn']."</td>";
echo "<td>&nbsp;".$row['date_ship']."</td>";
echo "<td>".$row['whn_dest']."</td>";
echo "<td align=center><a class='btn btn-warning' href='?page=status&no_dn=$row[no_dn]'>Detail</a></td></td>";
echo "</tr>";
 ?>
<?php
}
}
else
{
echo "<li>Nama Tidak Ada</li>";
}
}
?>
