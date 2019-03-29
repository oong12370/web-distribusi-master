<?php 
//start session
session_start();
error_reporting(0);
require_once('../admin/koneksi.php');

$action = $_GET['action'];

switch($action) {
	case 'addmaterial':
		addMaterial();
	break;
	case 'adtmaterial':
		adtMaterial();
	break;
	case 'deletemateril':
		deleteMaterial();
	break;
	case 'adddistribusi';
		addDistribusi();
	break;
	case 'update-status':
		updateStatus();
	break;
	case 'addtransaksi':
		addTransaksi();
	break;
}


function addMaterial() {
	
	$pn = $_POST['pn'];
	$nm_part = $_POST['nm_part'];
	$sn = $_POST['sn'];
	$batch = $_POST['batch'];
	$jenis = $_POST['jenis'];
	$sqlcek=mysql_query("SELECT pn from material where pn='$_POST[pn]'");
	$rscek=mysql_num_rows($sqlcek);
			if($rscek > 0){
			echo "<script>window.alert('Part number sudah ada')
    window.location='index.php?page=material'</script>";
    }else {
	$sql = "INSERT INTO material VALUES ('$pn','$nm_part', '$sn', '$jenis', '$batch')";
	dbQuery($sql);
	header('Location: index.php?page=material');
}
}//addmaterial
function adtMaterial() {
	
	$pn = $_POST['pn'];
	$nm_part = $_POST['nm_part'];
	$sn = $_POST['sn'];
	$jenis = $_POST['jenis'];
	$sql = "UPDATE material SET nm_part='$nm_part',sn='$sn', jenis='$jenis' WHERE pn='$pn'";
	dbQuery($sql);
	header('Location: index.php?page=material');
}//EditCourier

function deleteMaterial() {
	$pn = $_REQUEST['pn'];
	$sqlcek=mysql_query("SELECT pn from detail_material where pn='$pn'");
	$rscek=mysql_num_rows($sqlcek);
			if($rscek > 0){
			echo "<script>window.alert('Part number available in table distribusi')
    window.location='index.php?page=material'</script>";
    }else {
	$sql = "DELETE FROM material WHERE pn='$pn'";
	dbQuery($sql);
	header('Location: index.php?page=material');
}
}//DeleteMaterial

function updateStatus() {
	
	$no_dn = $_POST['no_dn'];
	$id = $_POST['id'];
	$status = $_POST['status'];
	$ket = $_POST['ket'];
	//$OfficeName = $_POST['OfficeName'];
	
	$sql = "INSERT INTO detail_status (no_dn, id, status, ket, time_stat)
			VALUES ('$no_dn', '$id', '$status', '$ket', NOW())";
	dbQuery($sql);
	
	
	
	header('Location: index.php?page=transaksi');

}//Status pengiriman

?>