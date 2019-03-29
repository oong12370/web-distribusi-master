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
<script type="text/JavaScript">
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

function hanyaAngka(evt) {
		  var charCode = (evt.which) ? evt.which : event.keyCode
		   if (charCode > 31 && (charCode < 48 || charCode > 57))
 
		    return false;
		  return true;
		}
</script>

<body>
<br/>
  
  <br/>
  <h3 class="">Data Material</h3>
  <button style="margin-bottom:20px" data-toggle="modal" data-target="#mytablemat" class="btn btn-info col-md-2" >
  <a class="tombol" >+ Tambah Data</a>
  </button>

	<?php include 'list_material.php'; ?>
<!-- modal input -->
<div id="mytablemat" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Add Material</h4>
			</div>
			<div class="modal-body">
				<form action="proses.php?action=addmaterial" method="post">
					
					<div class="form-group">
						<label>Part Number</label>
						<input name="pn" type="text" class="form-control" placeholder="Part Number ..">
					</div>
					<div class="form-group">
						<label>Description Part</label>
						<input name="nm_part" type="text" class="form-control" placeholder="Description part ..">
					</div>
					<div class="form-group">
						<label>Serial Number</label>
						<input name="sn" type="text" class="form-control" placeholder="Serial Number..">
						</div>
						<div class="form-group">
						<label>Batch</label>
						<input name="batch" type="text" onkeypress='return hanyaAngka(event)'class="form-control" placeholder="Batch part ..">
					</div>
						<div class="form-group">
						<label>Jenis Material</label>
						
			    <select  name="jenis" class="form-control">
				<option value="">Pilih</option>
			      <option value="Big Part">Big Part</option>
			      <option value="exp">exp</option>
		        </select>
			 
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
					<input type="submit" class="btn btn-primary" onClick="MM_validateForm('pn','','R','nm_part','','R','batch','','R','jenis','','R');return document.MM_returnValue" value="Simpan">
				</div>
			</form>
		</div>
	</div>
</div>


