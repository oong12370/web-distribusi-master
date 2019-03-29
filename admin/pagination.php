<?php

	include "../mh/koneksi.php";
	
	$query=mysql_query("SELECT distribusi.no_dn, distribusi.whn_dest,distribusi.datetime_ship,users.id,users.crew, dest_plant.nm_dest_plant,receive_distribusi.no_dn,receive_distribusi.datetime_receive,receive_distribusi.ket_receive, detail_material.no_dn, detail_material.jumlah, material.pn,material.sn, material.nm_part from detail_material inner join distribusi on detail_material.no_dn = distribusi.no_dn inner join dest_plant on distribusi.whn_dest = dest_plant.whn_dest inner join users on distribusi.id = users.id inner join material on detail_material.pn = material.pn LEFT JOIN receive_distribusi ON distribusi.no_dn = receive_distribusi.no_dn where receive_distribusi.no_dn && distribusi.whn_dest LIKE '$_POST[cari_data]%'
				ORDER BY distribusi.whn_dest DESC");
	$row = mysqli_fetch_row($query);

	$rows = $row[0];
	
	$page_rows = 10;

	$last = ceil($rows/$page_rows);

	if($last < 1){
		$last = 1;
	}

	$pagenum = 1;

	if(isset($_GET['pn'])){
		$pagenum = preg_replace('#[^0-9]#', '', $_GET['pn']);
	}

	if ($pagenum < 1) { 
		$pagenum = 1; 
	} 
	else if ($pagenum > $last) { 
		$pagenum = $last; 
	}

	$limit = 'LIMIT ' .($pagenum - 1) * $page_rows .',' .$page_rows;
	
	$nquery=mysqli_query($conn,"SELECT distribusi.no_dn, distribusi.whn_dest,distribusi.datetime_ship,users.id,users.crew, dest_plant.nm_dest_plant,receive_distribusi.no_dn,receive_distribusi.datetime_receive,receive_distribusi.ket_receive, detail_material.no_dn, detail_material.jumlah, material.pn,material.sn, material.nm_part from detail_material inner join distribusi on detail_material.no_dn = distribusi.no_dn inner join dest_plant on distribusi.whn_dest = dest_plant.whn_dest inner join users on distribusi.id = users.id inner join material on detail_material.pn = material.pn LEFT JOIN receive_distribusi ON distribusi.no_dn = receive_distribusi.no_dn where receive_distribusi.no_dn && distribusi.whn_dest LIKE '$_POST[cari_data]%'
				ORDER BY distribusi.whn_dest DESC $limit");

	$paginationCtrls = '';

	if($last != 1){
		
	if ($pagenum > 1) {
        $previous = $pagenum - 1;
		$paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$previous.'" class="btn btn-default">Previous</a> &nbsp; &nbsp; ';
		
		for($i = $pagenum-4; $i < $pagenum; $i++){
			if($i > 0){
		        $paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'" class="btn btn-default">'.$i.'</a> &nbsp; ';
			}
	    }
    }
	
	$paginationCtrls .= ''.$pagenum.' &nbsp; ';
	
	for($i = $pagenum+1; $i <= $last; $i++){
		$paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'" class="btn btn-default">'.$i.'</a> &nbsp; ';
		if($i >= $pagenum+4){
			break;
		}
	}

    if ($pagenum != $last) {
        $next = $pagenum + 1;
        $paginationCtrls .= ' &nbsp; &nbsp; <a href="'.$_SERVER['PHP_SELF'].'?pn='.$next.'" class="btn btn-default">Next</a> ';
    }
	}

?>