<?php
error_reporting(0);
include '../mh/koneksi.php';

$kode1	= $_GET['kode1'];
$kode2	= $_GET['kode2'];
$hal	= $_GET['hal'] ? $_GET['hal'] : 0;
$lim	= 5;

if (empty($kode1) && empty($kode2)){
	$query2	= "SELECT * FROM origin_plant";
}else{
	$query2	= "SELECT * FROM origin_plant
			WHERE whn_org BETWEEN '$kode1' AND '$kode2' ";
}
	$data2	= mysql_query($query2);
	$jml	= mysql_num_rows($data2);
	
	$max	= ceil($jml/$lim);

echo "<div id='info'>
	<table width='100%' border='1' id='theList' class='table table-hover'>
		<tr>
			<th bgcolor='#5795E6'>No.</th>
			<th bgcolor='#5795E6'>Warehouse Number</th>
			<th bgcolor='#5795E6'>Nama Plant</th>
			<th bgcolor='#5795E6'>Telp</th>
			<th bgcolor='#5795E6'>Alamat</th>
			<th bgcolor='#5795E6'>Action</th>
		</tr>";
		if (empty($kode1) && empty($kode2)){
		$sql = "SELECT * FROM origin_plant
				ORDER BY whn_org 
				LIMIT $hal,$lim";
		}else{
		$sql = "SELECT * FROM origin_palnt
				WHERE id BETWEEN '$kode1' AND '$kode2'
				ORDER BY whn_org
				LIMIT $hal,$lim";
		}
				
		//echo $sql;
		$query = mysql_query($sql);
		
		$no=1+$hal;
		while($r_data=mysql_fetch_array($query)){
		$nomor=$r_data[telp];
		$nomor1=substr($nomor,0,3);
		$nomor2=substr($nomor,3,3);
		$nomor3=substr($nomor,6,4);
		$output=$nomor1.'-'.$nomor2.'-'.$nomor3; 	
			echo "<tr>
					<td align='center'>$no</td>
					<td>$r_data[whn_org]</td>
					<td>$r_data[nm_org_palnt]</td>
					<td>$output</td>
					<td>$r_data[alamat]</td>
					<td><div align='center'><a class='glyphicon glyphicon-pencil' href='?page=edt_org&whn_org=$r_data[whn_org]&id=$Encrypted'></a> | <a class='glyphicon glyphicon-trash hapus' href='proses.php?action=deleteorg&whn_org=$r_data[whn_org]&id=$Encrypted'></div></td>
					</tr>";
			$no++;
		}
		
echo "</table>";
	echo "<table width='100%'>
		<tr>
			<td>Jumlah Data : $jml</td>";
		if (empty($kode1) && empty($kode2)){
		echo "<td align='right'>Halaman :";
			for ($h = 1; $h <= $max; $h++) {
					$list[$h] = $lim * $h - $lim;
					echo " <a href='javascript:void(0)' ";?> 
                    onClick="$.get('list_org.php?hal=<?php echo $list[$h]; ?>', 
                    null, function(data) {$('#info').html(data);})" <?php echo">".$h."</a> ";
				}
	echo "</td>";
		}else{
		echo "<td align='right'>Halaman :";
			for ($h = 1; $h <= $max; $h++) {
					$list[$h] = $lim * $h - $lim;
					echo " <a href='javascript:void(0)' ";?> 
                    onClick="$.get('list_org.php?kode1=<?php echo $_GET['kode1'];?>
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
                $.post({id: $(this).attr('data-id')},
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