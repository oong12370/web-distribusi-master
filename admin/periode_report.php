
		<script type="text/javascript">
		$(function() {
		$( "#periode1" ).datepicker({
				changeMonth: true,
				changeYear: true,
				yearRange: "2012:2013",
				dateFormat: "yy-mm-dd"
			});
		$( "#periode2" ).datepicker({
				changeMonth: true,
				changeYear: true,
				yearRange: "2012:2013",
				dateFormat: "yy-mm-dd"
			});
		});
		</script>

		<h3>Data Shipment Material</h3>
		<button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-pencil"></span>  Export ke Excell</button>
		
		<form id='form1' name='form1' method='post' action='' method='get'>
		
</form>
<br  />
</tr>
	<?php	include "periode.php";	?>			
<!-- modal input -->
<div id="myModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4  class="modal-title">Pilih Periode
				</div>
				<div class="modal-body">				
					<form action="proses_xl_periode.php" method="post">
						
						<div class="form-group">
							<label>WareHouse Destination</label>								
							<table align="">
			<tr>

		 <th><input type="date" class="form-control" name="tanggal_awal" size="15" value="<?php echo $min_tanggal['min_tanggal'];?>"/></th>
		 <th><input type="date" class="form-control" name="tanggal_akhir" size="15" value="<?php echo $max_tanggal['max_tanggal'];?>"/></th>
		 <td bgcolor=""><input class="btn" type="submit" value="View" name="cari" /></td>
	</tr>
	</table>

						</div>									
						
				</form>
			</div>
		</div>
	</div>
