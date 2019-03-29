<style type="text/css">
<!--
.style2 {font-weight: bold}
.style5 {font-size: 12}
.style6 {font-weight: bold; font-size: 12px; }
.style7 {font-size: 14px; }
-->
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


                        <legend>Shipment Info</legend>
		
                        <div class='navbar-form pull-right style5'>
				
                               
</div>	
                       <table class='table table-hover'>
                                <thead>
                                    <tr class='style2'>
                                        <td class="style7">Part Number</td>
                                        <td class="style7">Description</td>
                                        <td class="style7">Warehouse Destination</td>
                                        <td class="style7">Jumlah</td>
                                    </tr>
                                </thead>
							<?php
include "../admin/koneksi.php";
	$no_dn = $_GET['no_dn'];
	$query_mysql = mysql_query("select distribusi.no_dn, distribusi.whn_dest,detail_material.pn,material.nm_part,detail_material.jumlah,detail_material.pn from detail_material,distribusi,material where distribusi.no_dn=detail_material.no_dn and material.pn=detail_material.pn and detail_material.no_dn='$no_dn'")or die(mysql_error());
	$nomor = 1;
	while($data = mysql_fetch_array($query_mysql)){
						?>						
								<tr class='style2'>
                                            <td class="style6"><?php echo $data['pn'] ?></td>
                                            <td class="style6"><?php echo $data['nm_part'] ?></td>
                                            <td class="style6"><?php echo $data['whn_dest'] ?></td>
                                            <td class="style6"><?php echo $data['jumlah'] ?></td>
                         </tr><?php } ?>	
                               <tr>                         </tr>
									
												
</table>

									<form action="proses.php?action=update-status" method="post" name="frmShipment" id="frmShipment"> 

  <table class='table table-hover'>

    <tbody>

    <tr>

      <td colspan="3" bgcolor="#FFFFFF" align="right"></td>
    </tr>

	
    <tr>
      <td colspan="3" align="right" bgcolor="#FFFFFF" class="style7"><div align="left"></div>
        <div align="left"><span class="navbar-form pull-right style5">
          <?php
include "koneksi.php";
	$no_dn = $_GET['no_dn'];
	$query_mysql = mysql_query("select distribusi.no_dn,detail_material.pn,material.nm_part,detail_material.jumlah,detail_material.pn from detail_material,distribusi,material where distribusi.no_dn=detail_material.no_dn and material.pn=detail_material.pn and detail_material.no_dn='$no_dn'")or die(mysql_error());
	$nomor = 1;
	while($r = mysql_fetch_array($query_mysql)){
			?>
          <input name="no_dn" type="hidden" id="no_dn" value="<?php echo $r['no_dn'] ?>" />
            </span>
            <?php }?>
        UPDATE STATUS PENGIRIMAN </div>
        <?php
         include 'koneksi.php';
      $query="select * from users where username='".$_SESSION['username']."'";
      $result=mysql_query($query);
      $row=mysql_fetch_array($result);
        ?>
        <label>
      <input name="id" type="hidden" id="id" value="<?php echo $row['id'] ?>" />
        </label>        <label></label></td>
      </tr>
    <tr>

     

      <td class="Partext1" align="right" width="26%">

	   <select  class="form-control"  name="status">
<option value="">Status</option>
<option value="In Transit">In Transit</option>

<option value="Shipment">Shipment</option>

<option value="Cancel Shipment">Cancel</option>

<option value="Completed">Completed</option>
<option value="Delivered">Delivered</option>
</select></td>

      <td class="Partext1" bgcolor="#FFFFFF" width="58%">&nbsp;</td>
    </tr>

    <tr>


      <td colspan="2" class="Partext1" bgcolor="#FFFFFF"> 
	    <textarea class="form-control" name="ket" cols="40" rows="3" id="ket" placeholder="Keterangan"></textarea></td>
    </tr>

    

    <tr>

      <td colspan="2" class="Partext1" bgcolor="#FFFFFF">
        <button type="button" class="btn btn-primary" onclick="history.back();" data-dismiss="modal">Batal</button>
       <input  class="btn btn-primary" name="submit" onClick="MM_validateForm('status','','R','ket','','R');return document.MM_returnValue" value="Submit" type="submit"></td>
    </tr>

    <tr>

      <td colspan="3" bgcolor="#FFFFFF" align="right"><div align="center">


      </div></td>
      </tr>
  </tbody></table>

  <br>

  </form>
