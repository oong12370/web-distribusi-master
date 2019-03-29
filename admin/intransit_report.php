
		
		<h3>Data Material Intransit</h3>
		<button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-pencil"></span>  Export ke Excell</button>
		
		<form id='form1' name='form1' method='post' action='' method='get'>
		<div class='form-group col-md-3 col-md-offset-11' >
		<select type="submit" aria-describedby='basic-addon1' name="cari_data" class="form-control" onchange="this.form.submit()">
		<option value="">Pilih Destination</option>
			<?php 
			
			include "../mh/koneksi.php";
			$pil=mysql_query("select * from dest_plant ");
			while($p=mysql_fetch_array($pil)){
				?>
		 		
				<option><?php echo $p['whn_dest'] ?></option>
				<?php
			}
			?>			
		</select>
	</div>
</form>
<br  />
</tr>
			<?php
			error_reporting(0);
			// Load file koneksi.php
			include "../mh/koneksi.php";
			$kode1	= $_GET['kode1'];
$kode2	= $_GET['kode2'];
$hal	= $_GET['hal'] ? $_GET['hal'] : 0;
$lim	= 5;

if (empty($kode1) && empty($kode2)){
	$query2	= "SELECT distribusi.no_dn, distribusi.whn_dest,distribusi.datetime_ship,users.id,users.crew,distribusi.remarks, dest_plant.nm_dest_plant,receive_distribusi.no_dn,receive_distribusi.datetime_receive,receive_distribusi.ket_receive, detail_material.no_dn, detail_material.jumlah, material.pn,material.sn, material.nm_part from detail_material inner join distribusi on detail_material.no_dn = distribusi.no_dn inner join dest_plant on distribusi.whn_dest = dest_plant.whn_dest inner join users on distribusi.id = users.id inner join material on detail_material.pn = material.pn LEFT JOIN receive_distribusi ON distribusi.no_dn = receive_distribusi.no_dn where status != 'Delivered' && distribusi.whn_dest LIKE '$_POST[cari_data]%'
				ORDER BY distribusi.whn_dest DESC";
}else{
	$query2	= "SELECT distribusi.no_dn, distribusi.whn_dest,distribusi.datetime_ship,users.id,users.crew,distribusi.remarks, dest_plant.nm_dest_plant,receive_distribusi.no_dn,receive_distribusi.datetime_receive,receive_distribusi.ket_receive, detail_material.no_dn, detail_material.jumlah, material.pn,material.sn, material.nm_part from detail_material inner join distribusi on detail_material.no_dn = distribusi.no_dn inner join dest_plant on distribusi.whn_dest = dest_plant.whn_dest inner join users on distribusi.id = users.id inner join material on detail_material.pn = material.pn LEFT JOIN receive_distribusi ON distribusi.no_dn = receive_distribusi.no_dn where status != 'Delivered' && distribusi.whn_dest LIKE '$_POST[cari_data]%'
				ORDER BY distribusi.whn_dest DESC BETWEEN '$kode1' AND '$kode2' ";
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
				<th>Destination Plant</th>
				<th>Time Receive MH</th>
				<th>Keterangan</th>
			</tr>";
		if (empty($kode1) && empty($kode2)){
		$sql = "SELECT distribusi.no_dn, distribusi.whn_dest,distribusi.datetime_ship,users.id,distribusi.remarks,users.crew, dest_plant.nm_dest_plant,receive_distribusi.no_dn,receive_distribusi.datetime_receive,receive_distribusi.ket_receive, detail_material.no_dn, detail_material.jumlah, material.pn,material.sn, material.nm_part from detail_material inner join distribusi on detail_material.no_dn = distribusi.no_dn inner join dest_plant on distribusi.whn_dest = dest_plant.whn_dest inner join users on distribusi.id = users.id inner join material on detail_material.pn = material.pn LEFT JOIN receive_distribusi ON distribusi.no_dn = receive_distribusi.no_dn where status != 'Delivered' && distribusi.whn_dest LIKE '$_POST[cari_data]%'
				ORDER BY distribusi.whn_dest DESC
				LIMIT $hal,$lim";
		}else{
		$sql = "SELECT distribusi.no_dn, distribusi.whn_dest,distribusi.datetime_ship,distribusi.remarks,users.id,users.crew, dest_plant.nm_dest_plant,receive_distribusi.no_dn,receive_distribusi.datetime_receive,receive_distribusi.ket_receive, detail_material.no_dn, detail_material.jumlah, material.pn,material.sn, material.nm_part from detail_material inner join distribusi on detail_material.no_dn = distribusi.no_dn inner join dest_plant on distribusi.whn_dest = dest_plant.whn_dest inner join users on distribusi.id = users.id inner join material on detail_material.pn = material.pn LEFT JOIN receive_distribusi ON distribusi.no_dn = receive_distribusi.no_dn where status != 'Delivered' && distribusi.whn_dest LIKE '$_POST[cari_data]%'
				ORDER BY distribusi.whn_dest DESC
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
				echo "<td>".$ttk."</td>";
				echo "<td>".$data['remarks']."</td>";
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
                    onClick="$.get('all_report.php?hal=<?php echo $list[$h]; ?>', 
                    null, function(data) {$('#info').html(data);})" <?php echo">".$h."</a> ";
				}
	echo "</td>";
		}else{
		echo "<td align='right'>Halaman :";
			for ($h = 1; $h <= $max; $h++) {
					$list[$h] = $lim * $h - $lim;
					echo " <a href='javascript:void(0)' ";?> 
                    onClick="$.get('all_report.php?kode1=<?php echo $_GET['kode1'];?>
                    &kode2=<?php echo $_GET['kode2'];?>
                    &hal=<?php echo $list[$h]; ?>', 
                    null, function(data) {$('#info').html(data);})" <?php echo">".$h."</a> ";
				}
				echo "</td>";
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
	</body>
</html>
<!-- modal input -->
<div id="myModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4  class="modal-title">Pilih Destination
				</div>
				<div class="modal-body">				
					<form action="proses_xl_intransit.php" method="post">
						
						<div class="form-group">
							<label>WareHouse Destination</label>								
							<select class="form-control" type="submit" aria-describedby='basic-addon1' name="cari_data"  onchange="this.form.submit()">
								<option value=>Export ke Excell</option>
			<?php 
			include "../mh/koneksi.php";
			$pil=mysql_query("select * from dest_plant ");
			while($p=mysql_fetch_array($pil)){
				?>
				
				<option><?php echo $p['whn_dest'] ?></option>
				
				<?php
			}
			?>			
		</select>

						</div>									
						
				</form>
			</div>
		</div>
	</div>
