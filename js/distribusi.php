<!DOCTYPE html>
    <html>
        <head>
            <title>Distribusi</title>
            <link rel="stylesheet" href="../css/bootstrap.css">
            <script src="../js/jquery.js"></script>
            <script src="../js/jquery.ui.datepicker.js"></script>
            <script>
                //mendeksripsikan variabel yang akan digunakan
                var no_dn;
                var tanggal;
                var pn;
                var nm_part;
                var sn;
                var jumlah;
                $(function(){
                    //meload file pk dengan operator ambil barang dimana nantinya
                    //isinya akan masuk di combo box
                    $("#pn").load("pk.php","op=ambilmaterial");
                    
                    //meload isi tabel
                    $("#material").load("pk.php","op=ambilmaterial");
                    
                    //mengkosongkan input text dengan masing2 id berikut
                    $("#nm_part").val("");
                    $("#sn").val("");
                    $("#jenis").val("");
                 
                                
                    //jika ada perubahan di kode barang
                    $("#pn").change(function(){
                        kode=$("#pn").val();
                        
                        //tampilkan status loading dan animasinya
                        $("#status").html("loading. . .");
                        $("#loading").show();
                        
                        //lakukan pengiriman data
                        $.ajax({
                            url:"proses.php",
                            data:"op=ambildata&kode="+kode,
                            cache:false,
                            success:function(msg){
                                data=msg.split("|");
                                
                                //masukan isi data ke masing - masing field
                                $("#nm_part").val(data[0]);
                                $("#sn").val(data[1]);
                                $("#jenis").val(data[3]);
                              
                                //hilangkan status animasi dan loading
                                $("#status").html("");
                                $("#loading").hide();
                            }
                        });
                    });
                    
                    //jika tombol tambah di klik
                    $("#tambah").click(function(){
                        pn=$("#pn").val();
                       
                        jumlah=$("#jumlah").val();
                        if(pn=="Part Number"){
                            alert("Part Numbe Harus diisi");
                            exit();
                        
                        }else if(jumlah < 1){
                            alert("Jumlah material tidak boleh 0");
                            $("#jumlah").focus();
                            exit();
                        }
                        nm_part=$("#nm_part").val();
                        sn=$("#sn").val();
                        
                                                
                        $("#status").html("sedang diproses. . .");
                        $("#loading").show();
                        
                        $.ajax({
                            url:"pk.php",
                            data:"op=tambah&kode="+kode+"&nama="+nama+"&harga="+harga+"&jumlah="+jumlah,
                            cache:false,
                            success:function(msg){
                                if(msg=="sukses"){
                                    $("#status").html("Berhasil disimpan. . .");
                                }else{
                                    $("#status").html("ERROR. . .");
                                }
                                $("#loading").hide();
                                $("#nama").val("");
                                $("#harga").val("");
                                $("#jumlah").val("");
                                $("#stok").val("");
                                $("#kode").load("pk.php","op=ambilbarang");
                                $("#barang").load("pk.php","op=barang");
                            }
                        });
                    });
                    
                    //jika tombol proses diklik
                    $("#proses").click(function(){
                        nota=$("#nota").val();
                        tanggal=$("#tanggal").val();
                        
                        $.ajax({
                            url:"pk.php",
                            data:"op=proses&nota="+nota+"&tanggal="+tanggal,
                            cache:false,
                            success:function(msg){
                                if(msg=='sukses'){
                                    $("#status").html('Transaksi Pembelian berhasil');
                                    alert('Transaksi Berhasil');
                                    exit();
                                }else{
                                    $("#status").html('Transaksi Gagal');
                                    alert('Transaksi Gagal');
                                    exit();
                                }
                                $("#kode").load("pk.php","op=ambilbarang");
                                $("#barang").load("pk.php","op=barang");
                                $("#loading").hide();
                                $("#nama").val("");
                                $("#harga").val("");
                                $("#jumlah").val("");
                                $("#stok").val("");
                            }
                        })
                    })
                });
            </script>
        </head>
        <body>
            <div class="container">
                <?php
                include "../admin/koneksi.php";
                $p=isset($_GET['act'])?$_GET['act']:null;
                switch($p){
                    default:
                        echo "<table class='table table-bordered'>
                            <tr>
                                <td colspan='3'><a href='?page=distribusi&act=tambah' class='btn btn-primary'>Input Distribusi</a></td>
                            </tr>
                                <tr>
                                    <td>Delivery Note</td>
                                    <td>Tanggal</td>
                                    <td>Jumlah</td>
                                    <td>Tools</td>
                                </tr>";
                                $query=mysql_query("select * from distribusi");
                                while($r=mysql_fetch_array($query)){
                                    echo "<tr>
                                            <td><a href='?page=penjualan&act=detail&nota=$r[nonota]'>$r[nonota]</a></td>
                                            <td>$r[tanggal]</td>
                                            <td>$r[total]</td>
                                            <td><a href='?page=penjualan&act=detail&nota=$r[nonota]'>Cetak Nota</a></td>
                                        </tr>";
                                }
                                echo"</table>";
                        
                        break;
                    case "tambah":
                        $tgl=date('Y-m-d');
                        
                   
                        echo "<div class='navbar-form pull-right'>
                                No. Nota : <input type='text' id='nota' value='$angka'  >
                                <input type='text' id='tanggal' value='$tgl' readonly>   
                            </div>";
                            
                            echo'<legend>Transaksi Penjualan</legend>
                            <label>Kode Barang</label>
                            <select id="pn"></select>
                            <input type="text" id="nm_part" placeholder="Nama Barang" readonly>
                            <input type="text" id="sn" placeholder="Harga" class="span2" readonly>
                            <input type="text" id="jenis" placeholder="stok" class="span1" readonly>
                            <input type="text" id="jumlah" placeholder="Jumlah Beli" class="span1">
                            <button id="tambah" class="btn">Tambah</button>
                            
                            <span id="status"></span>
                            <table id="barang" class="table table-bordered">
                                    
                            </table>
                            <div class="form-actions">
                                <button id="proses">Proses</button>
                            </div>';
                        break;
                    case "detail":
                        echo "<legend>Nota Penjualan</legend>";
                        $nota=$_GET['nota'];
                        $query=mysql_query("select penjualan.nonota,detailpenjualan.kode,tblbarang.nama,
                                           detailpenjualan.harga,detailpenjualan.jumlah,detailpenjualan.subtotal
                                           from detailpenjualan,penjualan,tblbarang
                                           where penjualan.nonota=detailpenjualan.nonota and tblbarang.kode=detailpenjualan.kode
                                           and detailpenjualan.nonota='$nota'");
                        $nomor=mysql_fetch_array(mysql_query("select * from penjualan where nonota='$nota'"));
                        echo "<div class='navbar-form pull-right'>
                                Nota : <input type='text' value='$nomor[nonota]' disabled>
                                <input type='text' value='$nomor[tanggal]' disabled>
                            </div>";
                        echo "<table class='table table-hover'>
                                <thead>
                                    <tr>
                                        <td>Kode Barang</td>
                                        <td>Nama</td>
                                        <td>Harga</td>
                                        <td>Jumlah</td>
                                        <td>Subtotal</td>
                                    </tr>
                                </thead>";
                                while($r=mysql_fetch_row($query)){
                                    echo "<tr>
                                            <td>$r[1]</td>
                                            <td>$r[2]</td>
                                            <td>$r[3]</td>
                                            <td>$r[4]</td>
                                            <td>$r[5]</td>
                                        </tr>";
                                }
                                echo "<tr>
                                        <td colspan='4'><h4 align='right'>Total</h4></td>
                                        <td colspan='5'><h4>$nomor[total]</h4></td>
                                    </tr>
                                    </table>";
                        break;
                }
                ?>
            </div>
        </body>
    </html>