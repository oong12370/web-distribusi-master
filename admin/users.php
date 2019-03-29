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
//-->
</script>
<body>
<br/>
	<br/>
	<h3>Data Users</h3>
	<button style="margin-bottom:20px" data-toggle="modal" data-target="#mytableusers" class="btn btn-info col-md-2" >
  <a class="tombol">+ Tambah Data</a>
  </button>
	<p>&nbsp;</p>
<?php include 'list_user.php'; ?>
<!-- tble input -->
<div id="mytableusers" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Add User</h4>
			</div>
			<div class="modal-body">
				<form action="proses.php?action=adduser" method="post">
					<div class="form-group">
						<label>User Name</label>
						<input name="username" type="text" class="form-control" placeholder="User name ..">
					</div>
					
					<div class="form-group">
						<label>Nama lengkkap</label>
						<input name="nm_lengkap" type="text" class="form-control" placeholder="nama ..">
					</div>
					<div class="form-group">
						<label>Email</label>
						<input name="email" type="text" class="form-control" placeholder="Email ..">
					</div>
					<div class="form-group">
						<label>Telepon</label>
						<input name="telp" type="text" class="form-control" placeholder="Telepon ..">
					</div>
					<div class="form-group">
					<label>Alamat</label>
						
						<textarea class="form-control" placeholder="Alamat .." name="alamat_user"></textarea>
						</div>
				  <div class="form-group">
						<label>Crew</label>
						<p>
						  <select class="form-control" name="crew">
						    <option value="">PILIH</option>
						    <option value="A">A</option>
						    <option value="B">B</option>
						    <option value="C">C</option>
						    <option value="D">D</option>
					      </select>
						  
					          </p>
				  </div>
					  <div class="form-group">
						<label>User Level</label>
						<p>
						  <select class="form-control" name="level">
						    <option value="">PILIH</option>
						    <option value="1">Staff Admin</option>
						    <option value="2">Material Heandling</option>
						    <option value="3">Staff Gudang</option>
						    
					      </select>
						  
					          </p>
				  </div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
					<input type="submit" class="btn btn-primary" onClick="MM_validateForm('username','','R','nm_lengkap','','R','email','','R','telp','','R','alamat_user','','R','crew','','R','level','','R');return document.MM_returnValue" value="Simpan">
				</div>
			</form>
		</div>
	</div>
</div>


