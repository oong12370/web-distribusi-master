<!DOCTYPE html>
<html><head>

		<title>Dinas Tenaga Kerja</title>
		<style type="text/css">
			#fm {
				margin: 0;
				padding: 10px 30px;
			}
			.ftitle {
				font-size: 14px;
				font-weight: bold;
				color: #666;
				padding: 5px 0;
				margin-bottom: 10px;
				border-bottom: 1px solid #ccc;
			}
			.fitem {
				margin-bottom: 5px;
			}
			.fitem label {
				display: inline-block;
				width: 80px;
			}
		</style>
		<script type="text/javascript" src="../js/jquery-1.6.min.js"></script>
		<script type="text/javascript" src="../js/jquery.easyui.min.js"></script>
		<link href="../css/bootstrap.min.css" rel="stylesheet">
<body>
<br/>

	<a href="index.php">Lihat Semua Data</a>

	<br/>
	<h3>Edit data</h3>
	<?php 
	include "koneksi.php";
	$pn = $_GET['pn'];
	$query_mysql = mysql_query("SELECT * FROM material WHERE pn='$pn'")or die(mysql_error());
	$nomor = 1;
	while($data = mysql_fetch_array($query_mysql)){
	?>
	<form  action="edt_mat_act.php" method="post">		
		<table class="accordion-body">
			<tr>
				<td>Part Number </td>
				<td><input  name="pn" type="text" class="form-control" id="pn" value="<?php echo $data['pn'] ?>" required="true"></td>					
			</tr>	
			<tr>
				<td>Description</td>
				<td><input name="desc" type="text" class="form-control" id="desc" value="<?php echo $data['desc'] ?>" required="true"></td>					
			</tr>	
				
			<tr>
			  <td>Serial Number </td>
			  <td><input name="sn" type="text" class="form-control" id="sn" value="<?php echo $data['sn'] ?>" required="true"></td>
		  </tr>
			<tr>
			  <td>Jenis</td>
			  <td><label>
			    <select name="jenis" class="form-control">
			      <option value="Big Part">Big Part</option>
			      <option value="exp">exp</option>
		        </select>
			  </label></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" class="btn btn-primary btn-block" value="Simpan"></td>					
			</tr>				
		</table>
	</form>
	<?php } ?>
</body>
</html>