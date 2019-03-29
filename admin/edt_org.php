
<div >
	<div >
		<div >
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Edit Origin Plant</h4>
			</div>
			<div class="modal-body">
		 <?php 
	$whn_org = $_GET['whn_org'];
	$query_mysql = mysql_query("SELECT * FROM origin_plant WHERE whn_org='$whn_org'")or die(mysql_error());
	$nomor = 1;
	while($data = mysql_fetch_array($query_mysql)){
	?>
				<form action="proses.php?action=adtorgplant" method="post">
				
					<div class="form-group">
						<label>Nama Plant Origin</label>
						<input  name="nm_org_palnt" type="text" class="form-control" id="nm_org_palnt" value="<?php echo $data['nm_org_palnt'] ?>" required="true">
					</div><input name="whn_org" type="hidden" id="whn_org" value="<?php echo $data['whn_org'] ?>">
						<div class="form-group">
						<label>Telp</label>
						<input name="telp" type="text" class="form-control" id="telp" value="<?php echo $data['telp'] ?>" required="true">
					</div>
				 
					<div class="form-group">
					<label>Alamat</label>
						
						 <textarea name="alamat" class="form-control" id="alamat"><?php echo $data['alamat'] ?>
</textarea>
					
						<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
					<input type="submit" class="btn btn-primary" value="Simpan">
				</div>
			</form>
			<?php } ?>
	