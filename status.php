<style type="text/css">
<!--
.style2 {font-weight: bold}
.style5 {font-size: 12}
.style6 {font-weight: bold; font-size: 12px; }
.style7 {font-size: 14px; }
-->
</style>

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
include "mh/koneksi.php";
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
                         </tr>
                               
									
					 <?php


}
?>								
</table>

	  <table class='table table-hover'>
        <thead>
          <tr class='style2'>
         <td class="Partext1" bgcolor="#FFFFFF"> Status</td>
      <td class="Partext1" bgcolor="#FFFFFF">Time Status</td>
	  <td class="Partext1" bgcolor="#FFFFFF">Keterangan</td>
          </tr>
        </thead>
       
  	  <?php
	  	error_reporting(0);
	include "mh/koneksi.php";
	$no_dn = $_GET['no_dn'];
	$nomor = 1;
	$query_mysql = mysql_query("SELECT * FROM detail_status where no_dn='$no_dn'")or die(mysql_error());
	
	while($r = mysql_fetch_array($query_mysql)){
			?>
     
      <td class="Partext1" bgcolor="#FFFFFF"> <?=$r['status']?></td>
      <td class="Partext1" bgcolor="#FFFFFF"><?=$r['time_stat']?></td>
	  <td class="Partext1" bgcolor="#FFFFFF"><?=$r['ket']?></td>
	
    </tr>
	  
	 <?php
}
?>
      </table>    
      <a href='index.php' class='btn btn-primary'>
		<i class='icon-arrow-left'>Back</i></a>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                