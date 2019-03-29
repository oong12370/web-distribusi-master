
	<?php
error_reporting(0);
include '../mh/koneksi.php';
$kode1	= $_GET['kode1'];
$kode2	= $_GET['kode2'];
$hal	= $_GET['hal'] ? $_GET['hal'] : 0;
$lim	= 5;

if (empty($kode1) && empty($kode2)){
	$query2	= "SELECT * FROM users";
}else{
	$query2	= "SELECT * FROM users
			WHERE id BETWEEN '$kode1' AND '$kode2' ";
}
	$data2	= mysql_query($query2);
	$jml	= mysql_num_rows($data2);
	
	$max	= ceil($jml/$lim);

echo "<div id='info'>
	<table width='100%' border='1' id='theList' class='table table-hover'>
		<tr>
			<th bgcolor='#5795E6'>No.</th>
			<th bgcolor='#5795E6'>User Name</th>
			<th bgcolor='#5795E6'>Nama Lengkap</th>
			<th bgcolor='#5795E6'>email</th>
			<th bgcolor='#5795E6'>Telepon</th>
			<th bgcolor='#5795E6'>Alamat</th>
			<th bgcolor='#5795E6'>Crew</th>
			<th bgcolor='#5795E6'>Action</th>
		</tr>";
		if (empty($kode1) && empty($kode2)){
		$sql = "SELECT * FROM users
				ORDER BY id 
				LIMIT $hal,$lim";
		}else{
		$sql = "SELECT * FROM users
				WHERE id BETWEEN '$kode1' AND '$kode2'
				ORDER BY id
				LIMIT $hal,$lim";
		}
	
		//echo $sql;
		$query = mysql_query($sql);
	
		$no=1+$hal;
		while($r_data=mysql_fetch_array($query)){
		$nomor=$r_data[telp];
		$nomor1=substr($nomor,0,4);
		$nomor2=substr($nomor,4,4);
		$nomor3=substr($nomor,8,4);
		$output=$nomor1.'-'.$nomor2.'-'.$nomor3; 
			echo "<tr>
					<td align='center'>$no</td>
					<td>$r_data[username]</td>
					<td>$r_data[nm_lengkap]</td>
					<td>$r_data[email]</td>
					<td>$output</td>
					<td>$r_data[alamat_user]</td>
					<td>$r_data[crew]</td>
					<td><div align='center'><a class='glyphicon glyphicon-trash hapus' href='proses.php?action=Deleteuser&id=$r_data[id]'></div></td>
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
                    onClick="$.get('list_user.php?hal=<?php echo $list[$h]; ?>', 
                    null, function(data) {$('#info').html(data);})" <?php echo">".$h."</a> ";
				}
	echo "</td>";
		}else{
		echo "<td align='right'>Halaman :";
			for ($h = 1; $h <= $max; $h++) {
					$list[$h] = $lim * $h - $lim;
					echo " <a href='javascript:void(0)' ";?> 
                    onClick="$.get('list_user.php?kode1=<?php echo $_GET['kode1'];?>
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