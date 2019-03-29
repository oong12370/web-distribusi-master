
</html>
<div >
	<div >
		<div >
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Edit Courier</h4>
			</div>
			<div class="modal-body">
		<?php 
	
	$no_peg = $_GET['no_peg'];
	$query_mysql = mysql_query("SELECT * FROM courier WHERE no_peg='$no_peg'")or die(mysql_error());
	$nomor = 1;
	while($data = mysql_fetch_array($query_mysql)){
	?>
				<form action="proses.php?action=adtcourier" method="post">
				
					<div class="form-group">
						<label>No Pegawai</label>
						<input  name="no_peg" type="text" class="form-control" id="no_peg" value="<?php echo $data['no_peg'] ?>" required="true" readonly>
					</div>
					<div class="form-group">
						<label>Nama Pegawai</label>
						<input name="nm_courier" type="text" class="form-control" id="nm_courier" value="<?php echo $data['nm_courier'] ?>" required="true">
					</div>
					<div class="form-group">
						<label>Telp</label>
						<input name="telp_cour" type="text" class="form-control" id="telp_cour" value="<?php echo $data['telp_cour'] ?>" required="true">
					</div>
				 
					<div class="form-group">
					<label>Alamat</label>
						
						<textarea class="form-control"   name="alamat_cour"><?php echo $data['alamat_cour'] ?></textarea>
					
						<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
					<input type="submit" class="btn btn-primary" value="Simpan">
				</div>
			</form>
			<?php } ?>
	