<?php
include "koneksi.php";
$op=isset($_GET['op'])?$_GET['op']:null;
if($op=='ambilorg'){
    $data=mysql_query("select * from origin_plant");
    echo"<option value=''>Origin Plant</option>";
    while($r=mysql_fetch_array($data)){
        echo "<option value='$r[whn_org]'>$r[nm_org_palnt]</option>";
    }
}
elseif($op=='ambildest'){
   $data=mysql_query("select * from dest_plant");
    echo"<option value=''>Destination Plant</option>";
    while($r=mysql_fetch_array($data)){
    echo "<option value='$r[whn_dest]'>$r[nm_dest_plant]</option>";
    }
}
elseif($op=='ambilcou'){
   $data=mysql_query("select * from courier");
    echo"<option value=''>Pilih Courier</option>";
    while($r=mysql_fetch_array($data)){
    echo "<option value='$r[no_peg]'>$r[nm_courier]</option>";
    }
}elseif($op=='ambildata'){
    $pn=$_GET['pn'];
    $dt=mysql_query("select * from material where pn='$pn'");
    $d=mysql_fetch_array($dt);
    echo $d['nm_part']."|".$d['sn']."|".$d['jenis'];
}
elseif($op=='barang'){
    $brg=mysql_query("select * from tblsementara");
    echo "<thead>
            <tr class='style2'>
                <td>Part Number</td>
                <td>Description</td>
                <td>Serial number</td>
                <td>Jumlah</td>
                
                <td>Tools</td>
            </tr>
        </thead>";
    $total=mysql_fetch_array(mysql_query("select sum(jumlah) as jumlah from tblsementara"));
    while($r=mysql_fetch_array($brg)){
        echo "<tr class='style2'>
                <td>$r[pn]</td>
                <td>$r[nm_part]</td>
                <td>$r[sn]</td>
                <td ><input type='text' name='jum' value='$r[jumlah]' readonly></td>
                
                <td><a href='pk.php?op=hapus&pn=$r[pn]' id='hapus'>Hapus</a></td>
            </tr>";
    }
    echo "<tr>
        <td class='style2' colspan='3'>Total</td>
        <td class='style2'>$total[jumlah]</td>
    </tr>";
}elseif($op=='tambah'){
    $pn=$_GET['pn'];
    $nm_part=$_GET['nm_part'];
	 $sn=$_GET['sn'];
    $jumlah=$_GET['jumlah'];
    $total=$jumlah+$jumlah;
    
    $tambah=mysql_query("INSERT into tblsementara (pn,nm_part,sn,jumlah)
                        values ('$pn','$nm_part','$sn','$jumlah')");
    
    if($tambah){
        echo "sukses";
    }else{
        echo "ERROR";
    }
}elseif($op=='hapus'){
    $pn=$_GET['pn'];
    $del=mysql_query("delete from tblsementara where pn='$pn'");
    if($del){
        echo "<script>window.location='index.php?page=transaksi&act=tambah';</script>";
    }else{
        echo "<script>alert('Hapus Data Berhasil');
            window.location='index.php?page=transaksi&act=tambah';</script>";
    }
}elseif($op=='proses'){

    $no_dn=$_GET['no_dn'];
	$whn_org=substr($_GET[whn_org],0,5);
	$whn_dest=substr($_GET[whn_dest],0,5);
    $datetime_ship=$_GET['datetime_ship'];
	$status=$_GET['status'];
	$id=$_GET['id'];
	$remarks=$_GET['remarks'];
    $no_peg=$_GET['no_peg'];
	$order_prio=$_GET['order_prio'];
    $to=mysql_fetch_array(mysql_query("select sum(jumlah) as total from tblsementara"));
    $tot=$to['total'];
	
    $simpan=mysql_query("insert into distribusi(no_dn,whn_org,whn_dest,datetime_ship,status,id,remarks,order_prio,no_peg,total) values ('$no_dn','$whn_org','$whn_dest','$datetime_ship','$status','$id','$remarks','$order_prio','$no_peg','$tot')");
    
    if($simpan){
        $query=mysql_query("select * from tblsementara");
        while($r=mysql_fetch_row($query)){
            mysql_query("insert into detail_material(no_dn,pn,jumlah)
                        values('$no_dn','$r[0]','$r[3]')");
          
        }
		
        //hapus seluruh isi tabel sementara
        mysql_query("truncate table tblsementara");
        echo "sukses";
    }else{
        echo "eror";
    }
}
elseif($op=='cek'){
    $no_dn=$_GET['no_dn'];
    $sql=mysql_query("select * from distribusi where no_dn='$no_dn'");
    $cek=mysql_num_rows($sql);
    echo $cek;
}
?>