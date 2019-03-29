<?php 
//start session
session_start();
error_reporting(0);
require_once('koneksi.php');
include "sendEmail-v156.php";

$action = $_GET['action'];

switch($action) {
	case 'addcourier':
		addNewcourier();
	break;
	case 'adtcourier':
		adtNewcourier();
	break;
	
	case 'deletecourier':
		deleteCourier();
	break;
	
	case 'addorgplant':
		addOrgPlant();
	break;
	
	case 'adtorgplant':
		adtOrgPlant();
	break;
	
	case 'deleteorg':
		deleteOrg();
	break;
	
	case 'adddestplant':
		addDestPlant();
	break;
	
	case 'edtdestplant':
		edtDestplant();
		
	break;
			
	case 'deletedest':
		deleteDest();
	break;	
	
	case 'addrcv':
		addRcv();
	break;	

	case 'adduser':
		addNewuser();
	break;	
	case 'Deleteuser':
		deleteuser();
	break;	
	
}


function addNewcourier() {
	
	$no_peg = $_POST['no_peg'];
	$nm_courier = $_POST['nm_courier'];
	$crew = $_POST['crew'];
	$telp_cour = $_POST['telp_cour'];
	$alamat_cour = $_POST['alamat_cour'];
	$reg_date = $_POST['reg_date'];
	$sqlcek=mysql_query("SELECT * FROM courier where no_peg=$no_peg");
	$rscek=mysql_num_rows($sqlcek);
			if($rscek > 0){
			echo "<script>window.alert('Nomor pegawai sudah ada')
    window.location='index.php?page=courier'</script>";
    }
	else if(!preg_match("/^[a-zA-Z ]*$/",$_POST['nm_courier'])){
	echo "<script>window.alert('Nama tidak boleh berkarakter')
    		window.location='index.php?page=courier'</script>";
	} 
	else if(strlen($_POST['telp_cour']) != 12){
	echo "<script>window.alert('Nomor telpon max 12 digit')
    		window.location='index.php?page=courier'</script>";
	} 
	else{
	$sql = "INSERT INTO courier (no_peg, nm_courier,crew, telp_cour, alamat_cour, reg_date)
			VALUES ('$no_peg', '$nm_courier','$crew', '$telp_cour', '$alamat_cour', '$reg_date')";
	dbQuery($sql);
	header('Location: index.php?page=courier');
	}
}//addcourier
function adtNewcourier() {
	
	$no_peg = $_POST['no_peg'];
	$nm_courier = $_POST['nm_courier'];
	$telp_cour = $_POST['telp_cour'];
	$alamat_cour = $_POST['alamat_cour'];
	if(strlen($_POST['telp_cour']) != 12){
	echo "<script>window.alert('Nomor telpon max 12 digit')
    		window.location='index.php?page=courier'</script>";
	} else
	$sql = "UPDATE courier SET nm_courier='$nm_courier', telp_cour='$telp_cour', alamat_cour='$alamat_cour' WHERE no_peg='$no_peg'";
	dbQuery($sql);
	header('Location: index.php?page=courier');
}//EditCourier

function deleteCourier() {
	$no_peg = $_REQUEST['no_peg'];
	$sql = "DELETE FROM courier WHERE no_peg='$no_peg'";
	dbQuery($sql);
	header('Location: index.php?page=courier');
}//DeleteCourier

function addOrgPlant() {
	$whn_org = $_POST['whn_org'];
	$nm_org_palnt = $_POST['nm_org_palnt'];
	$telp = $_POST['telp'];
	$alamat = $_POST['alamat'];
	$sqlcek=mysql_query("SELECT whn_org from origin_plant where whn_org='$_POST[whn_org]'");
	$rscek=mysql_num_rows($sqlcek);
			if($rscek > 0){
			echo "<script>window.alert('Warehouse Number sudah ada')
    window.location='index.php?page=org_plant'</script>";
    }
			else if(strlen($_POST['telp']) != 10){
	echo "<script>window.alert('Nomor telpon max 10 digit')
    		window.location='index.php?page=org_plant'</script>";
	} else {
	$sql = "INSERT INTO origin_plant VALUES ('$whn_org','$nm_org_palnt', '$telp', '$alamat')";
	dbQuery($sql);
	header('Location: index.php?page=org_plant');
	}
}//addOrgPlant

function adtOrgPlant() {
	$whn_org = $_POST['whn_org'];
	$nm_org_palnt = $_POST['nm_org_palnt'];
	$telp = $_POST['telp'];
	$alamat = $_POST['alamat'];
	if(strlen($_POST['telp']) != 10){
	echo "<script>window.alert('Nomor telpon max 10 digit')
    		window.location='index.php?page=org_plant'</script>";
	} else {
	$sql = "UPDATE origin_plant SET nm_org_palnt='$nm_org_palnt', telp='$telp', alamat='$alamat' WHERE whn_org='$whn_org'";
	dbQuery($sql);
	header('Location: index.php?page=org_plant');
}//adtOrgPlant
}

function deleteOrg() {
	$whn_org = $_REQUEST['whn_org'];
	$sql = "DELETE FROM origin_plant WHERE whn_org='$whn_org'";
	dbQuery($sql);
	header('Location: index.php?page=org_plant');
}//DeleteOriginPlant

function addDestPlant() {
	$whn_dest = $_POST['whn_dest'];
	$nm_dest_plant = $_POST['nm_dest_plant'];
	$telp_dest = $_POST['telp_dest'];
	$alamat_dest = $_POST['alamat_dest'];
	$sqlcek=mysql_query("SELECT whn_dest from dest_plant where whn_dest='$_POST[whn_dest]'");
	$rscek=mysql_num_rows($sqlcek);
			if($rscek > 0){
			echo "<script>window.alert('Warehouse Number sudah ada')
    window.location='index.php?page=dest_plant'</script>";
    }
			else if(strlen($_POST['telp_dest']) != 10){
	echo "<script>window.alert('Nomor telpon max 10 digit')
    		window.location='index.php?page=dest_plant'</script>";
	} else {
	$sql = "INSERT INTO dest_plant VALUES ('$whn_dest','$nm_dest_plant', '$telp_dest', '$alamat_dest')";
	dbQuery($sql);
	header('Location: index.php?page=dest_plant');
	}
}//addOrgPlant

function edtDestplant() {
	$whn_dest = $_POST['whn_dest'];
	$nm_dest_plant = $_POST['nm_dest_plant'];
	$telp_dest = $_POST['telp_dest'];
	$alamat_dest = $_POST['alamat_dest'];
	if(strlen($_POST['telp_dest']) != 10){
	echo "<script>window.alert('Nomor telpon max 10 digit')
    		window.location='index.php?page=dest_plant'</script>";
	} else {
	$sql = "UPDATE dest_plant SET nm_dest_plant='$nm_dest_plant', telp_dest='$telp_dest', alamat_dest='$alamat_dest' WHERE whn_dest='$whn_dest'";
	dbQuery($sql);
	header('Location: index.php?page=dest_plant');
}//adtDestPlant
}

function deleteDest() {
	$whn_dest = $_REQUEST['whn_dest'];
	$sql = "DELETE FROM dest_plant WHERE whn_dest='$whn_dest'";
	dbQuery($sql);
	header('Location: index.php?page=dest_plant');
}//DeleteDestinationPlant

function addRcv() {
	$no_dn = $_POST['no_dn'];
	$no_peg = $_POST['no_peg'];
	$status = $_POST['status'];
	$datetime_receive = $_POST['datetime_receive'];
	$id = $_POST['id'];
	$ket_receive = $_POST['ket_receive'];
	$sqlcek=mysql_query("SELECT * FROM receive_distribusi where no_dn=$no_dn");
	$rscek=mysql_num_rows($sqlcek);
			if($rscek > 0){
			echo "<script>window.alert('No Delivery sudah di confirm')
    window.location='index.php?page=receive'</script>";
    }else {
	$sql = "INSERT INTO receive_distribusi VALUES ('','$no_dn','$datetime_receive', '$id', '$ket_receive')";
	dbQuery($sql);
	$sql_1 = "UPDATE distribusi 
				SET status = '$status' 
				WHERE no_dn = '$no_dn'";
	dbQuery($sql_1);
	header('Location: ../gudang/index.php?page=receive');
	}
}//addOrgPlant
function validasi_telepon($str) {  
    $allowed = array("(", ")", "-", " "); //yang diperbolehkan hanya kurung buka, kurung tutup, minus dan spasi  
    if (ctype_digit(str_replace($allowed, '',$str))){  
        return $str;  
    }  
    else {  
        $str = "salah";  
        return $str;  
    }  
} 
function acakangkahuruf($panjang)
{
    $karakter= 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz123456789';
    $string = '';
    for ($i = 0; $i < $panjang; $i++) {
  $pos = rand(0, strlen($karakter)-1);
  $string .= $karakter{$pos};
    }
    return $string;
}
function addNewuser() {
	$username = $_POST['username'];
	$password=base64_encode(acakangkahuruf(7));  
    $decode = base64_decode($password);  	
	$email = $_POST['email'];
	$crew = $_POST['crew'];
	$telp = $_POST['telp'];
	$nm_lengkap = $_POST['nm_lengkap'];
	$alamat_user = $_POST['alamat_user'];
	$level = $_POST['level'];
	//tujuan
	$to       = $_POST['email'];
	$subject  = 'Pendaftaran user sukses';
	$message  = "'$username' , '$decode'" ;
 
	// user dan password gmail
	$sender   = 'oong12370@gmail.com';
	$passmail = 'OONG2016804234';
	$sqlcek=mysql_query("SELECT username from users where username='$_POST[username]' or email='$_POST[email]'");
	$rscek=mysql_num_rows($sqlcek);
			if($rscek > 0){
			echo "<script>window.alert('Username atau email sudah ada')
    window.location='index.php?page=users'</script>";
    }
			else if(strlen($_POST['telp']) != 12){
	echo "<script>window.alert('Nomor telepon max 12 digit')
    		window.location='index.php?page=users'</script>";
	}  
	    	else if (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $_POST['email'])){
   echo "<script>window.alert('Format email salah')
    window.location='index.php?page=users'</script>";
}

			else{
   
	$sql = "INSERT INTO users VALUES ('','$username','$password','$nm_lengkap', '$email','$telp','$alamat_user', '$crew', '$level')";
	dbQuery($sql);
	if(email_localhost($to, $subject, $message, $sender, $passmail))
    echo "Email sent";
else
    echo "Email sending failed";
	header('Location: index.php?page=users');
	}
}
function deleteuser() {
	$id = $_REQUEST['id'];
	$sql = "DELETE FROM users WHERE id='$id'";
	dbQuery($sql);
	header('Location: index.php?page=users');
}//Deleteuser


?>
