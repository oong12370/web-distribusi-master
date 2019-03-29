<?php
// Skrip berikut ini adalah skrip yang bertugas untuk meng-export data tadi ke excell
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=shipment_intransit.xls");
?>

<h3>Report Intransit Material Internal Distribusi TGW</h3>
		
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
				<th>Jam terima MH</th>
				<th>Keterangan</th>
			</tr>
			<?php
			error_reporting(0);
			// Load file koneksi.php
			include "koneksi.php";
			
			// Buat query untuk menampilkan semua data siswa
			$query_mysql = mysql_query("SELECT distribusi.no_dn, distribusi.whn_dest,distribusi.datetime_ship,users.id,users.crew, dest_plant.nm_dest_plant,receive_distribusi.no_dn,receive_distribusi.datetime_receive,receive_distribusi.ket_receive, detail_material.no_dn, detail_material.jumlah, material.pn,material.sn, material.nm_part from detail_material inner join distribusi on detail_material.no_dn = distribusi.no_dn inner join dest_plant on distribusi.whn_dest = dest_plant.whn_dest inner join users on distribusi.id = users.id inner join material on detail_material.pn = material.pn LEFT JOIN receive_distribusi ON distribusi.no_dn = receive_distribusi.no_dn where status != 'Delivered' && distribusi.whn_dest LIKE '$_POST[cari_data]%'
				ORDER BY distribusi.whn_dest DESC")or die(mysql_error());
			$no = 1; 
			while($data = mysql_fetch_array($query_mysql)){
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
				echo "<td>".$ttk ."</td>";
				echo "<td>".$data['remarks']."</td>";
				echo "</tr>";
				
				$no++; // Tambah 1 setiap kali looping
			}
function selisih($ttk,$ttt) {
	list($h,$m,$s) = explode(":",$ttk);
	$dtAwal = mktime($h,$m,$s,"1","1","1");
	list($h,$m,$s) = explode(":",$ttt);
	$dtAkhir = mktime($h,$m,$s,"1","1","1");
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
