<!DOCTYPE html>
<html>
<head>
	<?php 
	session_start();
	if($_SESSION['level']!="2"){
		header("location:../cpadministrator/index.php");
	}
	include "../admin/engkrip.php";
	include '../assets/cek.php';
	include 'koneksi.php';
	?>
	<title>PT. GMF Aeroasia</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../js/jquery-ui/jquery-ui.css">
	<script type="text/javascript" src="../js/jquery.js"></script>
	<script type="text/javascript" src="../js/jquery.js"></script>
	<script type="text/javascript" src="../js/bootstrap.js"></script>
	<script type="text/javascript" src="../js/jquery-ui/jquery-ui.js"></script>	
	<script type="text/javascript" src="../assets/js/jquery.js"></script>
	<script type="text/javascript" src="../assets/js/jquery.js"></script>
	<script type="text/javascript" src="../assets/js/bootstrap.js"></script>
	<script type="text/javascript" src="../assets/js/jquery-ui/jquery-ui.js"></script>	
	<script type="text/javascript" src="../js/jquery-1.6.min.js"></script>
	<script type="text/javascript" src="../js/jquery.easyui.min.js"></script>
	<script src="../js/jquery.js"></script>
    <script language="JavaScript" src="../j'query/jquery.js"></script>
    <script type="text/javascript" src="js/jquery-ui-1.8.24.custom.min.js"></script> 
	<script src="../'query/jquery-1.9.1.js"></script>
    <script src="../j'query/jquery-ui.js"></script>
	<link href="../css/gried.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../assets/js/jquery-ui/jquery-ui.css">		
	<link rel="icon" type="images/png" href="../images/icon.png">
</head>
<meta http-equiv="refresh" content="300"/>
<body>
	<div class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<img src="../images/GMF_AeroASIA.jpg" width="200" height="80"/>
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<div class="collapse navbar-collapse">				
				<ul class="nav navbar-nav navbar-right">
					<li><a id="pesan_sedia" href="#" data-toggle="modal" data-target="#modalpesan"><span class='glyphicon glyphicon-comment'></span>  Pesan</a></li>
					<li><a class="dropdown-toggle" data-toggle="dropdown" role="button" href="#">Hy , <?php echo $_SESSION['username']  ?>&nbsp&nbsp<span class="glyphicon glyphicon-user"></span></a></li>
				</ul>
			</div>
		</div>
	</div>

	<!-- modal input -->
	<div id="modalpesan" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Pesan Notification</h4>
				</div>
				<div class="modal-body">
					<?php
					include 'koneksi.php'; 
					$periksa=mysql_query("select * from distribusi where order_prio ='AOG' && status ='Intransit'");
					while($q=mysql_fetch_array($periksa)){	
						if($q['order_prio']='AOG' & $q['status']='Intransit' ){			
							echo "<div style='padding:5px' class='alert alert-warning'><span class='glyphicon glyphicon-info-sign'></span> No Delivery berikut  <a style='color:red'>". $q['no_dn']."</a> Status AOG material belum diterima di plant tujuan . Thanks !!</div>";	
						}
					}
					?>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>						
				</div>
				
			</div>
		</div>
	</div>

	<div class="col-md-2">
		<div class="row">
				
		</div>
<?php
$id = "qwerty";
$Encrypted = encrypt($id);
$Decrypted = decrypt($Encrypted);
?>
		<div class="row"></div>
		<ul class="nav nav-pills nav-stacked">
			<li class="active"><a href="index.php"><span class="glyphicon glyphicon-home"></span>  Dashboard</a></li>			
			<li><a href="?page=material&id=<?php echo $Encrypted?>"><span class="glyphicon glyphicon-briefcase"></span>  Data Material</a></li>    												
			<li><a href="?page=transaksi&id=<?php echo $Encrypted?>"><span class="glyphicon glyphicon-send"></span>  Distribusi</a></li>
			<li><a href="?page=ganti_pass"><span class="glyphicon glyphicon-lock"></span> Ganti Password</a></li>
			<li><a href="../Cpadministrator/logout.php"><span class="glyphicon glyphicon-log-out"></span>  Logout</a></li>			
		</ul>
	</div>
	<div class="col-md-10">