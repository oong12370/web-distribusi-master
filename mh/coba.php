
<title>Admin</title>
<link href="../js/mystyle.css" rel="stylesheet" type="text/css">
<link href="../js/style.css" rel="stylesheet" type="text/css">
<style type="text/css">


</style> 

<script language="JavaScript" src="../j'query/jquery.js"></script>
<script type="text/javascript" src="../j'query/jquery-ui-1.8.18.custom.min.js"></script>
<script type="text/javascript" src="../j'query/jquery-1.7.2.min.js"></script>
<script src="../j'query/jquery-1.9.1.js"></script>
 <script src="../j'query/jquery-ui.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("#npj").attr("readonly",true);
 $("#pn").change(function(){
    $.ajax({
	 url : 'get_material.php?date='+new Date(),
	 type : 'post',
	 cache : false,
	 data : 'pn='+$("#pn").val(),
	 success : function(msg){
	   var obj = $.parseJSON(msg);
	   $("#pn").val(obj.pn);
	   $("#nm_part").val(obj.nm_part);
	   $("#sn").val(obj.sn);
	   $("#jumlah").val(obj.jumlah);
	
	}
	});
	var kj= $("#pn").val();
	 if (kj == 'PMbl'){
		$("#npj").attr("readonly",false);
	}
	var kj= $("#pn").val();
	 if (kj == 'PMtr'){
		$("#npj").attr("readonly",false);
	}
  });  
});
</script>
<script type="text/javascript">
$(document).ready(function(){
	$("#npj").attr("readonly",true);
 $("#whn_org").change(function(){
    $.ajax({
	 url : 'get_org.php?date='+new Date(),
	 type : 'post',
	 cache : false,
	 data : 'whn_org='+$("#whn_org").val(),
	 success : function(msg){
	   var obj = $.parseJSON(msg);
	   $("#whn_org").val(obj.whn_org);
	   $("#nm_org_palnt").val(obj.nm_org_palnt);
	   $("#telp").val(obj.telp);
	   $("#alamat").val(obj.alamat);
	
	}
	});
	var kj= $("#whn_org").val();
	 if (kj == 'PMbl'){
		$("#npj").attr("readonly",false);
	}
	var kj= $("#whn_org").val();
	 if (kj == 'PMtr'){
		$("#npj").attr("readonly",false);
	}
  });  
});
</script>
<script type="text/javascript">
$(document).ready(function(){
	$("#npj").attr("readonly",true);
 $("#whn_dest").change(function(){
    $.ajax({
	 url : 'get_dest.php?date='+new Date(),
	 type : 'post',
	 cache : false,
	 data : 'whn_dest='+$("#whn_dest").val(),
	 success : function(msg){
	   var obj = $.parseJSON(msg);
	   $("#whn_dest").val(obj.whn_dest);
	   $("#nm_dest_plant").val(obj.nm_dest_plant);
	   $("#telp_dest").val(obj.telp_dest);
	   $("#alamat_dest").val(obj.alamat_dest);
	
	}
	});
	var kj= $("#whn_dest").val();
	 if (kj == 'PMbl'){
		$("#npj").attr("readonly",false);
	}
	var kj= $("#whn_dest").val();
	 if (kj == 'PMtr'){
		$("#npj").attr("readonly",false);
	}
  });  
});
</script>
<script>

		function addTableRow(jQtable){
		jQtable.each(function(){
			var $table = $(this);
			var n = parseInt(document.getElementById('nomor').value) + 1;
			var pn = document.getElementById('pn').value
			var nm_part = document.getElementById('nm_part').value;
			var sn = document.getElementById('sn').value;
			var jumlah = document.getElementById('jumlah').value;
			if (pn<=0) {
				alert('Material Harus Diisi');
			}
			else {
				
				var tds = '<tr>';
				
				tds += '<td>'+pn+'<input type="hidden" name="pn['+n+']" value="'+pn+'" /></td>';
				tds += '<td>'+nm_part+'</td>';
				tds += '<td>'+sn+'</td>';
				tds += '<td>'+jumlah+'</td>';
				tds += '<td align=center class="delete" onClick="$(this).parent().remove(); "><a href="javascript:void(0)">Hapus</a></td>';
				tds += '</tr>';
				if($('tbody', this).length > 0){
					$('tbody', this).append(tds);
				}else {
					$(this).append(tds);
				}
				document.getElementById('nomor').value =  n;
			}
		});
	}

	function deleteAllRows() {
		$('#myTable tbody').remove();
		document.getElementById('pn').innerHTML = 0;
	}
</script>
<script type="text/javascript">
		$(function() {
		$( "#tgl" ).datepicker({
				changeMonth: true,
				changeYear: true,
				yearRange: "2012:2013",
				dateFormat: "yy-mm-dd"
			});
		});
		</script>
<script>
<!--
function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_validateForm() { //v4.0
  var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
  for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=MM_findObj(args[i]);
    if (val) { nm=val.name; if ((val=val.value)!="") {
      if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
        if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
      } else if (test!='R') { num = parseFloat(val);
        if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
        if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
          min=test.substring(8,p); max=test.substring(p+1);
          if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
    } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' is required.\n'; }
  } if (errors) alert('The following error(s) occurred:\n'+errors);
  document.MM_returnValue = (errors == '');
}
//-->
</script>
</head>
  <button style="margin-bottom:20px" data-toggle="modal" data-target="#mytabledist" class="btn btn-info col-md-2" >
  <a class="tombol" >+ Tambah Data</a>
  </button>
<body>
</td>
  </tr>
  
  <tr>
    <td>
	<div id="mytabledist" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

	
<table class="ds_box" id="ds_conclass" style="display: none;" cellpadding="0" cellspacing="0"> 
  <tbody><tr> 
    <td id="ds_calclass"> </td> 
  </tr> 
</tbody></table> 

<table border="0" align="center" width="100%">
   
	<tr>
      <td class="Partext1" bgcolor="F9F5F5" align="center"><span class="headtext13">Add Shipment </span></td>
    </tr>
    	<?php
include "../admin/koneksi.php";

?>

  </table>
<form id="forms" action="distribusi.php" method="POST" onSubmit="return submitForm('<?=$_SERVER['PHP_SELF'];?>')">
<div class="gentxt" align="right">
<table border="0" cellpadding="1" cellspacing="1" align="center" width="83%">
<tbody><tr>
<td width="60%">&nbsp;</td>
<td width="40%"><div align="right"></div></td>
</tr>
</tbody><table width="50%" align="center" class='table table-hover'>
	<tr>
	<td>Delivery Order </td>
		 <?php
	 //variabel tanggal
	 include '../temp/koneksi.php';
	 $tgl_ini=date("Y-m-d");
	  $pisah = explode("-",$tgl_ini);
	  $thn = $pisah[0];
	  $bln = $pisah[1];
	  $tgl = $pisah[2];
	  $tjt= $thn +1;
	  $jt= $tjt."-".$bln."-".$tgl;
	  ?>
       <td><label>
         <input name="no_dn" type="text" id="no_dn"> 
         | 
         <input name='date_ship' readonly id='date_ship' value='<?=$tgl_ini?>' size="10">
		 <input name='time_ship' readonly id='time_ship' value='<?php echo date('H:i:s');?>' size="10">
       </label></td>
	</tr>
	
    <tr>
      <td colspan="2" bgcolor="#B1C3D9"><div align="left"><strong>Shipper info : </strong></div></td>
    </tr>
	
	
     <tr>
       <td>Origin Plant</td>
       <td><label>
       <select name="whn_org" id="whn_org">
         <option value="">[Pilih]</option>
         <?php
		 
					$q = mysql_query("SELECT * FROM origin_plant ");
						
					while($whn_org = mysql_fetch_array($q)) {
						echo "<option value='$whn_org[whn_org]'>$whn_org[whn_org]</option>";
						//echo"<option value='".$d[0]."-".$d[1]."-".$d[2]."-".$d[3]."-".$d[4]."'>".$d[1]."</option>";
					}
				
				?>
       </select>
       </label></td>
     </tr>
     <tr>
       <td>Telp</td>
       <td><input name="telp" type="text" id="telp"></td>
     </tr>
     <tr>
       <td>Alamat</td>
       <td><label>
       <textarea name="alamat" id="alamat"></textarea>
       </label></td>
     </tr>
     <tr>
       <td colspan="2" bgcolor="#B1C3D9"><strong>Receiver  info : </strong></td>
      </tr>
     <tr>
       <td>Destination Plant </td>
       <td><select name="whn_dest" id="whn_dest">
         <option value="">[Pilih]</option>
         <?php
					$q = mysql_query("SELECT * FROM dest_plant ");
						
					while($whn_dest = mysql_fetch_array($q)) {
						echo "<option value='$whn_dest[whn_dest]'>$whn_dest[whn_dest]</option>";
						//echo"<option value='".$d[0]."-".$d[1]."-".$d[2]."-".$d[3]."-".$d[4]."'>".$d[1]."</option>";
					}
				
				?>
       </select></td>
     </tr>
     <tr>
       <td>Telp</td>
       <td><input type="text" name="telp_dest" id="telp_dest"></td>
     </tr>
     <tr>
		<td width="28%">Alamat</td>
	  <td width="72%"><textarea name="alamat_dest" id="alamat_dest"></textarea>
	    <label>
	
	    <input name="status" type="hidden" id="status" value="Transit">
	    <input name="id" type="" id="id" value="1">
	    <input name="no_pag" type="hidden" id="no_pag" value="-">
	    </label></td>
	</tr>

	<tr>
	  <td colspan="2" bgcolor="#B1C3D9"><div align="left">Material</div></td>
    </tr>
	<tr>
		<td> Part Number </td>
		<td>:
		  <select name="pn" id="pn">
          <option value="">[Pilih]</option>
          <?php
					$q = mysql_query("SELECT * FROM material ");
						
					while($pn = mysql_fetch_array($q)) {
						echo "<option value='$pn[pn]'>$pn[pn]</option>";
						//echo"<option value='".$d[0]."-".$d[1]."-".$d[2]."-".$d[3]."-".$d[4]."'>".$d[1]."</option>";
					}
				
				?>
    </select>	</tr>
	<tr>
	  <td>Description</td>
	  <td><label>:
	      <input name="nm_part" type="text" id="nm_part" />
	  </label></td>
    </tr>
	<tr>
	  <td>Serial Number </td>
	  <td><label>:
	      <input name="sn" type="text" id="sn" />
	  </label></td>
    </tr>
	<tr>
	  <td>Jumlah</td>
	  <td>:
	    <label>
	    <input name="jumlah" type="text" id="jumlah" size="10" />
      </label></td>
    </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td><input type="button" name="tambah" value="+" id="tambah" onClick="addTableRow($('#myTable')); hitTotal()" />
        <input type='hidden' name='nomor' id='nomor' value='0' /></td>
	</tr>
	<tr>
		<td colspan="2"><table width="100%" border="1" style="border-collapse:collapse" id="myTable">
		  <thead>
		    <tr align="center">
		      <td>Part Number </td>
              <td>Description</td>
              <td>Serial Number </td>
			  <td>Jumlah</td>
              <td>Act</td>
            </tr>
	      </thead>
		  <tfoot>
	      </tfoot>
	      </table></td>
    </tr>
	<tr>
	  <td>Order Priority </td>
	  <td><label>
	    <select name="order_prio" id="order_prio">
	      <option>Priority</option>
	      <option value="AOG">AOG</option>
	      <option value="IOR">IOR</option>
	      <option value="URGENT">URGENT</option>
        </select>
	  </label></td>
    </tr>
	<tr>
	  <td>Comments</td>
	  <td><textarea name="remarks" id="remarks"></textarea></td>
    </tr>
	<tr>
		<td> </td>
		<td> 
			<input type='Submit' name='simpan' value='Simpan ' id="simpan"/>  
			<input type='Reset' name='reset' value=' Reset ' onClick='deleteAllRows()' />		</td>
	</tr>
</table>
</form>
</td>
</td>
</td>
</body></html>
<?php

include 'koneksi.php';

//if(isset($_POST['simpan'])) {
$no_dn = $_POST['no_dn'];
		$whn_org  = $_POST['whn_org'];
		$whn_dest  = $_POST['whn_dest'];
		$date_ship  = $_POST['date_ship'];
		$time_ship  = $_POST['time_ship'];
		$no_pag  = $_POST['no_pag']; 
		$id  = $_POST['id'];
		$status  = $_POST['status'];
		$remarks  = $_POST['remarks']; 
		$order_prio  = $_POST['order_prio']; 
		if ($no_dn!='' && $whn_org!='' && $whn_dest!='' && $date_ship!='' && $time_ship!=''&& $status!='' && $no_pag!='' && $id!='' && $remarks!=''&& $order_prio!='') {
			$q1 = "INSERT INTO distribusi VALUES (null, '".$no_dn."', '".$whn_org."', '".$whn_dest."','".$date_ship."','".$time_ship."','".$status."','".$no_pag."','".$id."','".$remarks."','".$order_prio."')";
			$r1 = mysql_query($q1) or die ($q1);;
			  if($r1) {
				$trxID = mysql_result(mysql_query("SELECT id_dist FROM distribusi WHERE no_dn = '".$no_dn."'"),0,0);
				if($_POST['pn']!='') {
					$js = $_POST['pn']; 
					foreach($_POST['pn'] as $key => $val) {
						$q2 = "INSERT INTO detail_material VALUES ('".$val."' , '".$trxID."')";
						$r2 = mysql_query($q2);
						echo"<script>alert('Data berhasil disimpan')</script>";
					}
				}
			}

			
		}
?>