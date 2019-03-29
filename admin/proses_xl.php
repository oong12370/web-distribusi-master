<?php
// Skrip berikut ini adalah skrip yang bertugas untuk meng-export data tadi ke excell
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=shipment_filenya.xls");
?>
<h3 align="center" >Report Shipment Material Internal Distribusi TGW</h3>
		
<table class='table table-hover'>
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
				<th>Tanggal kirim</th>
				<th>Tanggal Terima</th>
				<th>Selisih jam</th>
				<th>Keterangan</th>
			</tr>
			<?php
			error_reporting(0);
			// Load file koneksi.php
			include "koneksi.php";
			
			
			$query_mysql = mysql_query("SELECT a.no_dn, b.whn_dest, b.datetime_ship, d.nm_lengkap AS pengirim, g.nm_lengkap AS penerima, d.crew, c.nm_dest_plant, f.datetime_receive, f.ket_receive, a.jumlah, e.pn, e.sn, e.nm_part FROM detail_material a JOIN distribusi b USING(no_dn) JOIN dest_plant c USING(whn_dest) JOIN users d ON b.id = d.id JOIN material e USING(pn) LEFT JOIN receive_distribusi f USING(no_dn) LEFT JOIN users g ON g.id=f.id WHERE f.no_dn && b.whn_dest LIKE '$_POST[cari_data]%'
				ORDER BY b.whn_dest DESC")or die(mysql_error());
			$no = 1; 
			while($data = mysql_fetch_array($query_mysql)){
			$ttk = date("H:i:s", strtotime($data['datetime_ship']));
			$ttt = date("H:i:s", strtotime($data['datetime_receive']));
			$date= date("Y-m-d", strtotime($data['datetime_ship']));
			$sql2=mysql_query("select receive_distribusi.id_receive,nm_lengkap from receive_distribusi inner join users on receive_distribusi.id=users.id");
			$rs2=mysql_fetch_array($sql2);
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
				
				$no++; // Tambah 1 setiap kali looping
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
