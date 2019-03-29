
</html>
<div >
	<div >
		<div >
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Edit Material</h4>
			</div>
			<div class="modal-body">
		<?php 
	include "../admin/koneksi.php";
	$pn = $_GET['pn'];
	$query_mysql = mysql_query("SELECT * FROM material WHERE pn='$pn'")or die(mysql_error());
	$nomor = 1;
	while($data = mysql_fetch_array($query_mysql)){
	?>
				<form action="proses.php?action=adtmaterial" method="post">
				
					<div class="form-group">
						<label>Part Number</label>
						<input  name="pn" type="text" class="form-control" id="pn" value="<?php echo $data['pn'] ?>" required="true" readonly>
					</div>
					<div class="form-group">
						<label>Description</label>
						<input name="nm_part" type="text" class="form-control" id="nm_part" value="<?php echo $data['nm_part'] ?>" required="true">
					</div>
					<div class="form-group">
						<label>Serial Number</label>
						<input name="sn" type="text" class="form-control" id="sn" value="<?php echo $data['sn'] ?>" required="true">
					</div>
				 
					<div class="form-group">
					<label>Jenis</label>
						
					<label>
			    <select name="jenis" class="form-control">
			      <option value="Big Part">Big Part</option>
			      <option value="exp">exp</option>
		        </select>
			  </label>
					
						<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
					<input type="submit" class="btn btn-primary" value="Simpan">
				</div>
			</form>
			<?php } ?>
	