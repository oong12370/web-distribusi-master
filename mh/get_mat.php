
<?php
include "../admin/koneksi.php";
$pn = $_GET['term'];
$sql = "select * from material where pn like '$pn%'";
$hs = mysql_query($sql);
$json = array();
while($rs = mysql_fetch_array($hs)){
	$json[] = array(
		'label' => $rs['pn'],
		'value' => $rs['pn'],
		'nm_part' => $rs['nm_part']
	);
}
header("Content-Type: application/json");
echo json_encode($json);
?>