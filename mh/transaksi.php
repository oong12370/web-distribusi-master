
<!DOCTYPE html>
    <html>
        <head>
            <title>Transaksi Distribusi</title>
            <script>
                //mendeksripsikan variabel yang akan digunakan
                var no_dn;
				var whn_org;
                var whn_dest;
                var date_ship;
                var time_ship;
                var status;
                var no_pag;
                var id;
                var remarks;
                var whn_org;
                var order_prio;
                var jumlah;
                var whn_dest;
                var no_peg;
                $(function(){
                    //meload file pk dengan operator ambil barang dimana nantinya
                    //isinya akan masuk di combo box
                    $("#whn_org").load("pk.php","op=ambilorg");
                    $("#whn_dest").load("pk.php","op=ambildest");
                    $("#no_peg").load("pk.php","op=ambilcou");
                    //meload isi tabel
                    $("#barang").load("pk.php","op=barang");
                    
                    //mengkosongkan input text dengan masing2 id berikut
                    $("#nm_part").val("");
                    $("#sn").val("");
                    $("#jenis").val("");
                    $("#jumlah").val("");
                                
                    //jika ada perubahan di kode barang
                    $("#pn").change(function(){
                        pn=$("#pn").val();
                        
                        //tampilkan status loading dan animasinya
                        $("#msgg").html("loading. . .");
                        $("#loading").show();
                        
                        //lakukan pengiriman data
                        $.ajax({
                            url:"proses_dist.php",
                            data:"op=ambildata&pn="+pn,
                            cache:false,
                            success:function(msg){
                                data=msg.split("|");
                                
                                //masukan isi data ke masing - masing field
                                $("#nm_part").val(data[0]);
                                $("#sn").val(data[1]);
                                $("#jenis").val(data[2]);
                                $("#jumlah").focus();
                                //hilangkan status animasi dan loading
                                $("#msgg").html("");
                                $("#loading").hide();
                            }
                        });
                    });
                    
                    //jika tombol tambah di klik
                    $("#tambah").click(function(){
                        pn=$("#pn").val();
      					if(pn==""){
                            alert("Part Number Harus diisi");
                            exit();
                        }
                        jumlah=$("#jumlah").val();
                        if(pn=="Kode Barang"){
                            alert("Kode Barang Harus diisi");
                            exit();
                        
                        }else if(jumlah < 1){
                            alert("Jumlah  tidak boleh 0");
                            $("#jumlah").focus();
                            exit();
                        }
                        nm_part=$("#nm_part").val();
                        sn=$("#sn").val();
                        
                                                
                        $("#msgg").html("sedang diproses. . .");
                        $("#loading").show();
                        
                        $.ajax({
                            url:"pk.php",
                            data:"op=tambah&pn="+pn+"&nm_part="+nm_part+"&sn="+sn+"&jumlah="+jumlah,
                            cache:false,
                            success:function(msg){
                                if(msg=="sukses"){
                                    $("#msgg").html("Berhasil disimpan. . .");
                                }else{
                                    $("#msgg").html("ERROR. . .");
                                }
                                $("#loading").hide();
                                $("#nm_part").val("");
                                $("#sn").val("");
                                $("#jenis").val("");
                                $("#jumlah").val("");
                                $("#pn").load("pk.php","op=ambilbarang");
                                $("#barang").load("pk.php","op=barang");
                            }
                        });
                    });
                    
                     $("#no_dn").change(function(){
                        var no_dn=$("#no_dn").val();
                        
                        $.ajax({
                            url:"pk.php",
                            data:"op=cek&no_dn="+no_dn,
                            success:function(data){
                                if(data==0){
                                    $("#pesan").html('Ok');
                                    $("#no_dn").css('border','3px #090 solid');
                                }else{
                                    $("#pesan").html('No Delivery sudah ada');
                                    $("#no_dn").css('border','3px #c33 solid');
                                }
                            }
                        });
                    });
                    //jika tombol proses diklik
                    $("#proses").click(function(){
					
                        no_dn=$("#no_dn").val();
						if(no_dn==""){
                            alert("Delivery Harus diisi");
                            exit();
                        }

                        whn_org=$("#whn_org").val();
						if(whn_org==""){
                            alert("Origin warehouse Harus diisi");
                            exit();
                        }
						whn_dest=$("#whn_dest").val();
						if(whn_dest==""){
                            alert("Destination warehouse Harus diisi");
                            exit();
                        }
                        datetime_ship=$("#datetime_ship").val();
                        status=$("#status").val();
						no_peg=$("#no_peg").val();
                        id=$("#id").val();
						remarks=$("#remarks").val();
						 if(remarks==""){
                            alert("Remark Harus diisi");
                            exit();
                        }
                        order_prio=$("#order_prio").val();
                         if(order_prio==""){
                            alert("Prioritas Harus diisi");
                            exit();
                        }
                        $.ajax({
                            url:"pk.php",
                            data:"op=proses&no_dn="+no_dn+"&whn_org="+whn_org+"&whn_dest="+whn_dest+"&datetime_ship="+datetime_ship+"&status="+status+"&no_peg="+no_peg+"&id="+id+"&remarks="+remarks+"&order_prio="+order_prio,
                            cache:false,
                            success:function(msg){
                                if(msg=="sukses"){
                                    $("#msgg").html("Berhasil disimpan. . .");
                                }
                                $("#loading").hide();
                                $("#nm_part").val("");
                                $("#sn").val("");
                                $("#jenis").val("");
                                $("#jumlah").val("");
                                $("#pn").load("pk.php","op=ambilbarang");
                                $("#barang").load("pk.php","op=barang");
                               
                            }
                        })
                    })
                });
				
            </script>
			<script type="text/javascript">

		function hanyaAngka(evt) {
		  var charCode = (evt.which) ? evt.which : event.keyCode
		   if (charCode > 31 && (charCode < 48 || charCode > 57))
 
		    return false;
		  return true;
		}

    $(function() {
        $( "#pn" ).autocomplete({
            source: "get_mat.php",
            minLength: 1,
            select: function( event, ui ) {
            $('#nm_part').val(ui.item.nm_part);
            }
        });
    });
</script>
<link rel="stylesheet" type="text/css" href="jquery.autocomplete.css" />
<link rel="stylesheet" href="../css/bootstrap.css">
<link href="js/mystyle.css" rel="stylesheet" type="text/css">
<link href="js/style.css" rel="stylesheet" type="text/css">
        <style type="text/css">
<!--
.style2 {font-size: 14px}
-->
        </style>
        </head>
        <body>
		 
                  
              <?php    
			  error_reporting(0);
                include "koneksi.php";
                $p=isset($_GET['act'])?$_GET['act']:null;
                switch($p){
                default:
                echo "<table class='table'>
               <div ><a href='?page=transaksi&act=tambah' class='btn btn-primary'>Add Shipmen</a></div>   
			   <tr class='style2'>
	  
	<div class='input-group col-md-5 col-md-offset-7'>
	<form id='form1' name='form1' method='post' action=''>
		<span class='input-group-addon' id='basic-addon1'><span class='glyphicon glyphicon-search'></span></span>
		<input type='text' id='cari_data' class='form-control' placeholder='Cari Delivery' aria-describedby='basic-addon1' name='cari_data'>	
	</div>
</tr>
                
                                <tr class='style2'>
                                    <th>Delivery Note</th>
                                    <th>Date & Time</th>
                                    <th>Jumlah</th>
                                    <th>Tools</th>
                                </tr>";
                                $query=mysql_query("SELECT * FROM distribusi WHERE status != 'Delivered' && no_dn LIKE '$_POST[cari_data]%'
				ORDER BY no_dn DESC");
                                while($r=mysql_fetch_array($query)){
                                     echo "<tr class='style2'>
                                            <td><a href='?page=status&no_dn=$r[no_dn]'>$r[no_dn]</a></td>
                                            <td>$r[datetime_ship]</td>
                                            <td>$r[total]</td>
                                            <td><a class='btn btn-warning' href='?page=send&no_dn=$r[no_dn]'>Send</a></td>
                                        </tr>";
                                }
                                echo"</table>
								</form>
                        ";
                        
          break;
          case "tambah":         
          include 'koneksi.php';
		  $dt=date('Y-m-d H:i:s');
		  $query="select * from users where username='".$_SESSION['username']."'";
		  $result=mysql_query($query);
		  $row=mysql_fetch_array($result);

        
           echo " 
						<legend><div  class='Partext1' align='center'><span class='headtext13' >Add Shipment</span></div></legend>
                        
                       <div  class='navbar-form pull-center'>
                               <span  class='style2'> No. Delivery :</span> <input class='form-control' align='center' type='text' id='no_dn' value='' onkeypress='return hanyaAngka(event)' placeholder='No Delivery'> <span class='style2' id='pesan'></span>
                                <input type='hidden' class='form-control' id='datetime_ship' value='$dt' readonly>
                        
                                <input name='id' type='hidden' id='id' value='$row[id]'>      
              </div>";
                          echo "";
           
           
                            echo'
							
							<div class="navbar-form pull-center"> 
							
							
                            <span class="style2"> Origin Plant  </span>  : <select class="form-control" id="whn_org"></select> |
                            <span class="style2"> Destination Plant</span>    :  <select class="form-control" id="whn_dest"></select>
                            <input name="status" id="status" value="Intransit" type="hidden" >
							
							 
							<legend></legend>

							<div class="style2">
                            <label>Kode Material</label>
							<p></p>
                             <input name="pn" type="text" class="form-control" id="pn"  placeholder="Kode material"  />						
                            <input type="text" class="form-control" id="nm_part" placeholder="Nama material" readonly>
                            <input type="text" class="form-control" id="sn" placeholder="Serial number" size="10" class="span2" readonly>
                            
                            <input type="text" class="form-control" id="jumlah"  placeholder="Jumlah " size="5" onkeypress="return hanyaAngka(event)">
                            <button id="tambah" class="btn btn-warning">Tambah</button></div>
                            
                            <span class="style2" id="msgg"></span>
                            <table id="barang" class="table table-bordered">
                                    
                            </table>
							
							<td > <span class="style2">Order Priority <select class="form-control" id="order_prio">
	      <option >Priority</option>
	      <option value="AOG">AOG</option>
	      <option value="IOR">IOR</option>
	      <option value="URGENT">URGENT</option>
        </select> 
			<select class="form-control" id="no_peg"></select>		
		<td><span class="style2">Keterangan</span></td>
	  <td><textarea class="form-control" name="remarks"  placeholder="Isi keterangan " id="remarks"></textarea></td></label>
                            
                            <div class="form-actions">
                                <button type="button" class="btn btn-warning" onclick="history.back();" data-dismiss="modal">Batal</button>
                                <button class="btn btn-primary" id="proses">Proses</button>
                            </div>';
                        break;
                    
                }
                ?>
				
		</td>
		</tr>
        </div>
		
        </body>
    </html>