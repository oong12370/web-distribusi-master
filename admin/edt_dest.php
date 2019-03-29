

<div >
	<div >
		<div >
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Edit Destination Plant</h4>
			</div>
			<div class="modal-body">
		  <?php 
	$whn_dest = $_GET['whn_dest'];
	$query_mysql = mysql_query("SELECT * FROM dest_plant WHERE whn_dest='$whn_dest'")or die(mysql_error());
	$nomor = 1;
	while($data = mysql_fetch_array($query_mysql)){
	?>
				<form action="proses.php?action=edtdestplant" method="post">
				
					<div class="form-group">
						<label>Nama Plant Destination</label>
						<input  name="nm_dest_plant" type="text" class="form-control" id="nm_dest_plant" value="<?php echo $data['nm_dest_plant'] ?>" required="true">
					</div> <input name="whn_dest" type="hidden" id="id_dest" value="<?php echo $data['whn_dest'] ?>">
						<div class="form-group">
						<label>Telp</label>
						<input name="telp_dest" type="text" class="form-control" id="telp_dest" value="<?php echo $data['telp_dest'] ?>" required="true">
					</div>
				 
					<div class="form-group">
					<label>Alamat</label>
						
						  <textarea name="alamat_dest" class="form-control" id="alamat_dest"><?php echo $data['alamat_dest'] ?></textarea>
					
						<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
					<input type="submit" class="btn btn-primary" value="Simpan">
				</div>
			</form>
			<?php } ?>
	