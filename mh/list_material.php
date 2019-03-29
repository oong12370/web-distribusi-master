	<?php
error_reporting(0);
include '../admin/koneksi.php';

$kode1	= $_GET['kode1'];
$kode2	= $_GET['kode2'];
$hal	= $_GET['hal'] ? $_GET['hal'] : 0;
$lim	= 5;

if (empty($kode1) && empty($kode2)){
	$query2	= "SELECT * FROM material";
}else{
	$query2	= "SELECT * FROM material
			WHERE pn BETWEEN '$kode1' AND '$kode2' ";
}
	$data2	= mysql_query($query2);
	$jml	= mysql_num_rows($data2);
	
	$max	= ceil($jml/$lim);

echo "<div id='info'>
	<table width='100%' border='1' id='theList'  class='table table-hover'>
		<tr>
			<th bgcolor='#5795E6'>No.</th>
			<th bgcolor='#5795E6'>Part Number</th>
			<th bgcolor='#5795E6'>Description</th>
		
			<th bgcolor='#5795E6'>Serial Number</th>
			<th bgcolor='#5795E6'>Jenis</th>
			
			<th bgcolor='#5795E6' >Action</th>
		</tr>";
		if (empty($kode1) && empty($kode2)){
		$sql = "SELECT * FROM material
				ORDER BY pn 
				LIMIT $hal,$lim";
		}else{
		$sql = "SELECT * FROM material
				WHERE pn BETWEEN '$kode1' AND '$kode2'
				ORDER BY pn
				LIMIT $hal,$lim";
		}
				
		//echo $sql;
		$query = mysql_query($sql);
		
		$no=1+$hal;
		while($r_data=mysql_fetch_array($query)){
			echo "<tr>
					<td align='center'>$no</td>
					<td>$r_data[pn]</td>
					<td>$r_data[nm_part]</td>
				
					<td>$r_data[sn]</td>
					<td>$r_data[jenis]</td>
					<td><div ><a class='glyphicon glyphicon-pencil' href='?page=edit_material&pn=$r_data[pn]&id=$Encrypted'></a> | <a class='glyphicon glyphicon-trash hapus' href='proses.php?action=deletemateril&pn=$r_data[pn]&id=$Encrypted'></div></td>
					</tr>";
			$no++;
		}
		
echo "</table>";
	echo "<table  width='100%'>
		<tr>
			<td>Jumlah Data : $jml</td>";
		if (empty($kode1) && empty($kode2)){
		echo "<td align='right'>Halaman :";
			for ($h = 1; $h <= $max; $h++) {
					$list[$h] = $lim * $h - $lim;
					echo " <a href='javascript:void(0)' ";?> 
                    onClick="$.get('list_material.php?hal=<?php echo $list[$h]; ?>', 
                    null, function(data) {$('#info').html(data);})" <?php echo">".$h."</a> ";
				}
	echo "</td>";
		}else{
		echo "<td align='right'>Halaman :";
			for ($h = 1; $h <= $max; $h++) {
					$list[$h] = $lim * $h - $lim;
					echo " <a href='javascript:void(0)' ";?> 
                    onClick="$.get('list_material.php?kode1=<?php echo $_GET['kode1'];?>
                    &kode2=<?php echo $_GET['kode2'];?>
                    &hal=<?php echo $list[$h]; ?>', 
                    null, function(data) {$('#info').html(data);})" <?php echo">".$h."</a> ";
				}
	echo "</td>";
		}
	echo "</tr>
		</table>";
	echo "</div>";
?>
<script>
    $(".hapus").click(function () {
        var jawab = confirm("Yakin Akan Di hapus!");
        if (jawab === true) {
//            kita set hapus false untuk mencegah duplicate request
            var hapus = false;
            if (!hapus) {
                hapus = true;
                $.post( {id: $(this).attr('data-id')},
                function (data) {
                    alert(data);
                });
                hapus = false;
            }
        } else {
            return false;
        }
    });
</script>