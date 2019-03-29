<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title></head>

<body>
<fieldset class="table table-hover">
<legend>View Data Shipment</legend>
<form id="form1" name="form1" method="post" action="">
<script type="text/javascript">
    $(function() {
        $("#theList tr:even").addClass("stripe1");
        $("#theList tr:odd").addClass("stripe2");

        $("#theList tr").hover(
            function() {
                $(this).toggleClass("highlight");
            },
            function() {
                $(this).toggleClass("highlight");
            }
        );
    });
</script>
<?php
error_reporting(0);
include '../admin/koneksi.php';

$kode1	= $_GET['kode1'];
$kode2	= $_GET['kode2'];
$hal	= $_GET['hal'] ? $_GET['hal'] : 0;
$lim	= 5;

if (empty($kode1) && empty($kode2)){
	$query2	= "SELECT * FROM distribusi WHERE status != 'Delivered' && no_dn LIKE '$_POST[cari_data]%'";
}else{
	$query2	= "SELECT * FROM distribusi WHERE status != 'Delivered' && no_dn LIKE '$_POST[cari_data]%' BETWEEN '$kode1' AND '$kode2' ";
}
	$data2	= mysql_query($query2);
	$jml	= mysql_num_rows($data2);
	
	$max	= ceil($jml/$lim);

echo "<div id='info'>
	<table  border='1' id='theList' class='table table-hover'>
		<tr>
			<th bgcolor='#666666'>No.</th>
			
			<th bgcolor='#666666'>No Delivery</th>
			<th bgcolor='#666666'>Warehouse Destination</th>
			<th bgcolor='#666666'>Tanggal</th>
			<th bgcolor='#666666'>Aksi</th>
		</tr>";
		if (empty($kode1) && empty($kode2)){
		$sql = "SELECT * FROM distribusi WHERE status != 'Delivered' && no_dn LIKE '$_POST[cari_data]%'
				ORDER BY no_dn DESC
				LIMIT $hal,$lim";
		}else{
		$sql = "SELECT * FROM distribusi  && no_dn LIKE '$_POST[cari_data]%'
				WHERE status != 'Delivered' BETWEEN '$kode1' AND '$kode2'
				ORDER BY no_dn DESC
				LIMIT $hal,$lim";
		}
				
		//echo $sql;
		$query = mysql_query($sql);
		
		$no=1+$hal;
		while($r_data=mysql_fetch_array($query)){
			echo "<tr>
					<td align='center'>$no</td>
					<td>$r_data[no_dn]</td>
					<td>$r_data[whn_dest]</td>
					<td>$r_data[datetime_ship]</td>
				
					<td><div align='center'class='btn btn-warning terima'><a href='?page=frm_receive&no_dn=$r_data[no_dn]&id=$Encrypted'>Confirm</a> 
					</tr>";
			$no++;
		}
		
echo "</table>";
	echo "<table width='100%'>
		<tr>
			<td>Jumlah Data : $jml</td>";
		if (empty($kode1) && empty($kode2)){
		echo "<td align='right'>Halaman :";
			for ($h = 1; $h <= $max; $h++) {
					$list[$h] = $lim * $h - $lim;
					echo " <a href='javascript:void(0)' ";?> 
                    onClick="$.get('../gudang/receive.php?hal=<?php echo $list[$h]; ?>', 
                    null, function(data) {$('#info').html(data);})" <?php echo">".$h."</a> ";
				}
	echo "</td>";
		}else{
		echo "<td align='right'>Halaman :";
			for ($h = 1; $h <= $max; $h++) {
					$list[$h] = $lim * $h - $lim;
					echo " <a href='javascript:void(0)' ";?> 
                    onClick="$.get('../gudang/receive.php?kode1=<?php echo $_GET['kode1'];?>
                    &kode2=<?php echo $_GET['kode2'];?>
                    &hal=<?php echo $list[$h]; ?>', 
                    null, function(data) {$('#info').html(data);})" <?php echo">".$h."</a> ";
				}
	echo "</td>";
		}
	echo "</tr>
		</table>";
	echo "</div>";
?>
<script>
    $(".terima").click(function () {
        var jawab = confirm("Yakin ingin konfirmasi data ini!");
        if (jawab === true) {         
            var terima = false;
            if (!terima) {
                terima = true;
                $.post( {id: $(this).attr('data-id')},
                function (data) {
                    alert(data);
                });
                terima = false;
            }
        } else {
            return false;
        }
    });
</script>
<br />
  <table width="599" height="41" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td width="11" bgcolor="#CCCCCC">&nbsp;</td>
      <td width="482" bgcolor="#CCCCCC"><label>Cari Data Berdasarkan No Delivery :
          <input name="cari_data" type="text" id="cari_data" size="30" />
      </label></td>
      <td width="106"><label></label></td>
    </tr>
  </table>
</form>
</form>
</fieldset>
</body>
</html>
