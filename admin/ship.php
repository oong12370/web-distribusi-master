<?php
			error_reporting(0);
			// Load file koneksi.php
			include "../mh/koneksi.php";
			$kode1	= $_GET['kode1'];
$kode2	= $_GET['kode2'];
$hal	= $_GET['hal'] ? $_GET['hal'] : 0;
$lim	= 5;

if (empty($kode1) && empty($kode2)){
	$query2	= "SELECT a.no_dn, b.whn_dest, b.datetime_ship, d.nm_lengkap AS pengirim, g.nm_lengkap AS penerima, d.crew, c.nm_dest_plant, f.datetime_receive, f.ket_receive, a.jumlah, e.pn, e.sn, e.nm_part FROM detail_material a JOIN distribusi b USING(no_dn) JOIN dest_plant c USING(whn_dest) JOIN users d ON b.id = d.id JOIN material e USING(pn) LEFT JOIN receive_distribusi f USING(no_dn) LEFT JOIN users g ON g.id=f.id WHERE f.no_dn && b.whn_dest LIKE '$_POST[cari_data]%' ORDER BY b.whn_dest DESC";
}else{
	$query2	= "SELECT a.no_dn, b.whn_dest, b.datetime_ship, d.nm_lengkap AS pengirim, g.nm_lengkap AS penerima, d.crew, c.nm_dest_plant, f.datetime_receive, f.ket_receive, a.jumlah, e.pn, e.sn, e.nm_part FROM detail_material a JOIN distribusi b USING(no_dn) JOIN dest_plant c USING(whn_dest) JOIN users d ON b.id = d.id JOIN material e USING(pn) LEFT JOIN receive_distribusi f USING(no_dn) LEFT JOIN users g ON g.id=f.id WHERE f.no_dn && b.whn_dest LIKE '$_POST[cari_data]%' ORDER BY b.whn_dest DESC BETWEEN '$kode1' AND '$kode2' ";
}
	$data2	= mysql_query($query2);
	$jml	= mysql_num_rows($data2);
	
	$max	= ceil($jml/$lim);
	echo "<div id='info'>
		<table class='table '>
			<tr>
				<th>No</th>
				<th>Delivery Note</th>
				<th>Tanggal</th>
				<th>Crew</th>
				<th>Part Number</th>
				<th>Description</th>
				<th>Qty</th>
				<th>Unit</th>
				<th>Serial</th>
				<th>Plant</th>
				<th>Penerima</th>
				<th>jam kirim</th>
				<th>jam Terima</th>
				<th>Selisih jam</th>
				<th>Keterangan</th>
			</tr>";
		if (empty($kode1) && empty($kode2)){
		$sql = "SELECT a.no_dn, b.whn_dest, b.datetime_ship, d.nm_lengkap AS pengirim, g.nm_lengkap AS penerima, d.crew, c.nm_dest_plant, f.datetime_receive, f.ket_receive, a.jumlah, e.pn, e.sn, e.nm_part FROM detail_material a JOIN distribusi b USING(no_dn) JOIN dest_plant c USING(whn_dest) JOIN users d ON b.id = d.id JOIN material e USING(pn) LEFT JOIN receive_distribusi f USING(no_dn) LEFT JOIN users g ON g.id=f.id WHERE f.no_dn && b.whn_dest LIKE '$_POST[cari_data]%' ORDER BY b.whn_dest DESC
				LIMIT $hal,$lim";
		}else{
		$sql = "SELECT a.no_dn, b.whn_dest, b.datetime_ship, d.nm_lengkap AS pengirim, g.nm_lengkap AS penerima, d.crew, c.nm_dest_plant, f.datetime_receive, f.ket_receive, a.jumlah, e.pn, e.sn, e.nm_part FROM detail_material a JOIN distribusi b USING(no_dn) JOIN dest_plant c USING(whn_dest) JOIN users d ON b.id = d.id JOIN material e USING(pn) LEFT JOIN receive_distribusi f USING(no_dn) LEFT JOIN users g ON g.id=f.id WHERE f.no_dn && b.whn_dest LIKE '$_POST[cari_data]%' ORDER BY b.whn_dest DESC
				LIMIT $hal,$lim";
		}
		$query = mysql_query($sql);
		
		$no=1+$hal;
		
			while($data=mysql_fetch_array($query)){
			$ttk = date("H:i:s", strtotime($data['datetime_ship']));
			$ttt = date("H:i:s", strtotime($data['datetime_receive']));
			$date= date("Y-m-d", strtotime($data['datetime_ship']));
			

				echo "<tr>";
				echo "<td>".$no."</td>";
				echo "<td>".$data['no_dn']."</td>";
				echo "<td>".$date."</td>";
				echo "<td>".$data['crew']."</td>";
				echo "<td>".$data['pn']."</td>";
				echo "<td>".$data['nm_part']."</td>";
				echo "<td>".$data['jumlah']."</td>";
				echo "<td> Ea </td>";
				echo "<td>".$data['sn']."</td>";
				echo "<td>".$data['whn_dest']."</td>";
				echo "<td>".$data['penerima']."</td>";
				echo "<td>".$ttk ."</td>";
				echo "<td>".$ttt."</td>";
				echo "<td>".selisih($ttk,$ttt)."</td>";
				echo "<td>".$data['ket_receive']."</td>";
				echo "</tr>";
				
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
                    onClick="$.get('ship.php?hal=<?php echo $list[$h]; ?>', 
                    null, function(data) {$('#info').html(data);})" <?php echo">".$h."</a> ";
				}
	echo "</td>";
		}else{
		echo "<td align='right'>Halaman :";
			for ($h = 1; $h <= $max; $h++) {
					$list[$h] = $lim * $h - $lim;
					echo " <a href='javascript:void(0)' ";?> 
                    onClick="$.get('ship.php?kode1=<?php echo $_GET['kode1'];?>
                    &kode2=<?php echo $_GET['kode2'];?>
                    &hal=<?php echo $list[$h]; ?>', 
                    null, function(data) {$('#info').html(data);})" <?php echo">".$h."</a> ";
				}
				echo "</td>";
		}
	
function selisih($ttk,$ttt) {
	list($h,$m,$s) = explode(":",$ttk);
	$dtAwal = mktime($h,$m,"1","1");
	list($h,$m,$s) = explode(":",$ttt);
	$dtAkhir = mktime($h,$m,"1","1");
	$dtSelisih = $dtAkhir-$dtAwal;
	$totalmenit=$dtSelisih/60;
	$jam =explode(".",$totalmenit/60);
	$sisamenit=($totalmenit/60)-$jam[0];
	$sisamenit2=$sisamenit*60;
	$jml_jam=$jam[0];
	return $jml_jam." jam ".$sisamenit2." menit";
}			

			?>

		</table>
			
										
	</body>
</html>