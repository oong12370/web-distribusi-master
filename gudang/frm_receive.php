<script language="JavaScript" src="../j'query/jquery.js"></script>
<script type="text/javascript" src="../j'query/jquery-ui-1.8.18.custom.min.js"></script>
<script type="text/javascript" src="../j'query/jquery-1.7.2.min.js"></script>
<script src="../j'query/jquery-1.9.1.js"></script>
 <script src="../j'query/jquery-ui.js"></script>
 <script type="text/javascript" src="../j'query/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="../j'query/jquery-ui.js"></script>
<script type="text/javascript" src="../j'query/jquery.ui.timepicker.js"></script>
<script type="text/javascript" src="../js/jquery-ui-1.8.24.custom.min.js"></script>
<script type='text/javascript' src='../mh/jquery.autocomplete.js'></script>
 <link rel="stylesheet" href="../j'query/jquery-ui.css" type="text/css" />
<link rel="stylesheet" href="../j'query/jquery.ui.timepicker.css" type="text/css" />
<link rel="stylesheet" type="text/css" href="../mh/jquery.autocomplete.css" />

<script type="text/javascript">
            $(document).ready(function() {
                $('#jam1').timepicker({
                    showPeriodLabels: false
                });
              });
</script>
<script type="text/javascript">
		$(function() {
		$( "#date_receive" ).datepicker({
				changeMonth: true,
				changeYear: true,
				yearRange: "2017:2030",
				dateFormat: "yy-mm-dd"
			});
		});
		</script>
<script type="text/javascript">

$().ready(function() {
	$("#no_peg").autocomplete("get_cou.php", {
		width: 260,
		matchContains: true,
		selectFirst: false
	});
});
</script>


<div >
	<div >
		<div >
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Confirm Shipment</h4>
			</div>
			<div class="modal-body">
			 <?php 
	include "../admin/koneksi.php";
	$no_dn = $_GET['no_dn'];
	$dt=date('Y-m-d H:i:s');
	$query="select * from users where username='".$_SESSION['username']."'";
    $result=mysql_query($query);
    $row=mysql_fetch_array($result);
	$query_mysql = mysql_query("SELECT * FROM distribusi WHERE no_dn='$no_dn'")or die(mysql_error());
	$nomor = 1;
	while($data = mysql_fetch_array($query_mysql)){
	?>
				<form action="../admin/proses.php?action=addrcv" method="post">
				
         
      
        
					<div class="form-group">
						<label>No Delivery</label>
						<input name="no_dn" type="text"  class="form-control" value="<?php echo $data['no_dn'] ?>" placeholder="Warehouse Number .." readonly>
					</div>
					
					<div class="form-group">
						<label>Date & Time Receive</label>
						<input name="datetime_receive" id="datetime_receive" type="text" class="form-control" value="<?php echo $dt ?>">
					</div>
				  <div class="form-group"> 
						<input name="status" type="hidden" id="status" value="Delivered">
						<input name="id" type="hidden" id="id" value="<?php echo $row['id'] ?>">
					</div>

					<div class="form-group">
					<label>Remarks</label>
						
						<textarea class="form-control" placeholder="Time Receive .." name="ket_receive" required></textarea>
					
						<div class="modal-footer">
					<button type="button" class="btn btn-default" onclick="history.back();" data-dismiss="modal">Batal</button>
					<input type="submit" class="btn btn-primary" value="Simpan">
				</div>
			</form>
			<?php } ?>
	