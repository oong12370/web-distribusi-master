<?php

include 'koneksi.php';

//if(isset($_POST['simpan'])) {
$no_dn = $_POST['no_dn'];
		$whn_org  = $_POST['whn_org'];
		$whn_dest  = $_POST['whn_dest'];
		$date_ship  = $_POST['date_ship'];
		$time_ship  = $_POST['time_ship'];
		$no_pag  = $_POST['no_pag']; 
		$id  = $_POST['id'];
		$status  = $_POST['status'];
		$remarks  = $_POST['remarks']; 
		$order_prio  = $_POST['order_prio']; 
		if ($no_dn!='' && $whn_org!='' && $whn_dest!='' && $date_ship!='' && $time_ship!=''&& $status!='' && $no_pag!='' && $id!='' && $remarks!=''&& $order_prio!='') {
			$q1 = "INSERT INTO distribusi VALUES (null, '".$no_dn."', '".$whn_org."', '".$whn_dest."','".$date_ship."','".$time_ship."','".$status."','".$no_pag."','".$id."','".$remarks."','".$order_prio."')";
			$r1 = mysql_query($q1) or die ($q1);;
			  if($r1) {
				$trxID = mysql_result(mysql_query("SELECT id_dist FROM distribusi WHERE no_dn = '".$no_dn."'"),0,0);
				if($_POST['pn']!='') {
					$js = $_POST['pn']; 
					foreach($_POST['pn'] as $key => $val) {
						$q2 = "INSERT INTO detail_material VALUES ('".$val."' , '".$trxID."')";
						$r2 = mysql_query($q2);
						echo"<script>alert('Data berhasil disimpan')</script>";
					}
				}
			}

			
		}
?>