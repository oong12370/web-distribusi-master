<?php
include "koneksi.php";
$data=mysql_query("select * from material");
$op=isset($_GET['op'])?$_GET['op']:null;

if($op=='pn'){
    echo"<option>Kode Barang</option>";
    while($r=mysql_fetch_array($data)){
        echo "<option value='$r[pn]'>$r[pn]</option>";
    }
}elseif($op=='barang'){
    echo'<table id="barang" class="table table-hover">
    <thead>
            <tr>
                <Td colspan="5"><a href="?page=barang&act=tambah" class="btn btn-primary">Tambah Barang</a></td>
            </tr>
            <tr>
                <td>Part Number</td>
                <td>Description</td>
                <td>Serial number</td>
                <td>Jenis</td>
               
            </tr>
        </thead>';
	while ($b=mysql_fetch_array($data)){
        echo"<tr>
                <td>$b[pn]</td>
                <td>$b[nm_part]</td>
                <td>$b[sn]</td>
                <td>$b[jenis]</td>
               
            </tr>";
        }
    echo "</table>";
}elseif($op=='ambildata'){
    $pn=$_GET['pn'];
    $dt=mysql_query("select * from material where pn='$pn'");
    $d=mysql_fetch_array($dt);
    echo $d['nm_part']."|".$d['sn']."|".$d['jenis'];
}elseif($op=='cek'){
    $kd=$_GET['kd'];
    $sql=mysql_query("select * from material where pn='$kd'");
    $cek=mysql_num_rows($sql);
    echo $cek;
}
?>