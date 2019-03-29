
		
		<h3>Data Shipment Material</h3>
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
<?php	include "ship.php";	?>	
<!-- modal input -->
<div id="myModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4  class="modal-title">Pilih Destination
				</div>
				<div class="modal-body">				
					<form action="proses_xl.php" method="post">
						
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
