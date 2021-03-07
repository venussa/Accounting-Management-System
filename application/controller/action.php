<?php

if(!isset($_GET['bulan']) and !isset($_GET['tahun'])){
	
	DEFINE("sorting",date("Y")."/".monthConvert(date("m"))."/");
	DEFINE("bulan",monthConvert(date("m")));
	DEFINE("tahun",date("Y"));
	DEFINE("url","&bulan=".monthConvert(date("m"))."&tahun=".date("Y"));
	
	DEFINE("tanggal",tahun."-".date("m")."-".date("t"));
	if(isset($_GET['page'])) $pg = "&page=".$_GET['page'];
	else $pg = "&page=1";

	DEFINE("act_pages",$pg);

}else {
	
	if(monthConvert($_GET['bulan']) > 0 and monthConvert($_GET['bulan']) < 10){
		$_tgl = "0".monthConvert($_GET['bulan']);
	}else{
		$_tgl = monthConvert($_GET['bulan']);	
	}
	
	DEFINE("sorting",$_GET['tahun']."/".$_tgl."/");
	DEFINE("bulan",($_GET['bulan']));
	DEFINE("tahun",$_GET['tahun']);
	DEFINE("url","&bulan=".$_GET['bulan']."&tahun=".$_GET['tahun']);
	
	DEFINE("tanggal",tahun."-".monthConvert($_GET['bulan'])."-".rand(1,29));
	if(isset($_GET['page'])) $pg = "&page=".$_GET['page'];
	else $pg = "&page=1";

	DEFINE("act_pages",$pg);
}

$cur = database()->Query("SELECT * FROM db_setting WHERE title='symbol' ")->Fetch();
DEFINE("currency",$cur['conf']);

function pjax_load_data(){
	return pjax_load("page-data","web-container","web-content");
}

function active_menu($data){
	if(isset($_GET['module'])){
		if($_GET['module'] == $data) echo "underflow-blue";
	}
}
function perubahan_modal($ori = null){
	$saldo1 = intval(str_replace("-","",neracasaldo('31')['ori_kre']));
	$saldo2 = intval(str_replace("-","",neracasaldo('32')['ori_deb']));
	
	if($ori !== null)
	return ($saldo1 + hitung_laba() - $saldo2);
	else
	return currency." ".number_format(($saldo1 + hitung_laba() - $saldo2));
}

function noakun(){
	
	$query = "SELECT * FROM db_noakun ORDER BY no_akun ASC";
	
	$rowCount = database()->Query($query)->rowCount();
	
	$list = null;
	
	if(!isset($_GET['page']) or empty($_GET['page']))
	$page = 1;
	else $page = $_GET['page'];
	
	$dataPerPage = 10;
	$totalData = $rowCount;
	$url = "";
	$offset = $dataPerPage * ($page-1);
	
	$list .= '<table width="100%">
				<tr>
					<th style="width:100px;text-align : center;"><div>N/A</div></th>
					<th style="text-align : center;"><div>Nama Akun</div></th>
					<th style="width:100px;text-align : center;"><div>#</div></th>
				</tr>';
	
	$data = database()->bindQuery($query." LIMIT $offset,$dataPerPage");
	
	if($data){
	foreach($data as $key => $val){ 

			if(($key+1) % 2 == 0) $bg = "underflow-blue";
			else $bg = "underflow";
			
			if($key == (count($data)-1) ) $border = "border-bottom:1px #ddd solid;";
			else $border = null;
		
				$list .= '<tr class="underflow '.$bg.'" style="'.$border.'">
							<td style="text-align : center;">'.$val->no_akun.'</td>
							<td>'.$val->nama_akun.'</td>
							<td style="border-right:transparent;text-align:center">
							<img src="'.projectUrl().'/assets/img/edit.png" width="20" height="20" data-toggle="modal" data-target="#squarespaceModal" style="cursor:pointer" onClick="olah_modal(\'noakun\','.$val->id.',\'edit\',\''.act_pages.'\')">
							<img src="'.projectUrl().'/assets/img/trash.png" width="20" height="20" style="cursor:pointer" onClick="delete_data(\'noakun\','.$val->id.',\''.act_pages.'\')" >
							
							</td>
						</tr>
						';
	
	}
	}else{
		$list .= '<tr style="border-bottom:1px #ddd solid;">
							<td style="text-align : center;padding:30px" colspan="4">Tidak Ada Data</td>
						</tr>
						';
	}
	$list .= "</table>";
	$list .= "<center>".pagination(
		$page, // active oage
		$dataPerPage, // list data per page
		$totalData, // total data
		HomeUrl()."/?module=noakun".url, // url pagination
		"pagination", // <u class
		'', // <li class
		pjax_load_data()->class, // <a href class
		'web-content', // pjax-attribute
		'aktive' // active page class
	)."</center>";
	return $list;
}



function saldoawal($noakun = null){
	
	$command = "and no_akun='31' ";
	
	$query = "SELECT * FROM db_jurnalumum WHERE id > 0 ".$command." and (tanggal like '%".sorting."%') ORDER BY id DESC ";
	$rowCount = database()->Query($query)->rowCount();
	
	if(!isset($_GET['page']) or empty($_GET['page']))
	$page = 1;
	else $page = $_GET['page'];
	
	$dataPerPage = 10;
	$totalData = $rowCount;
	$url = "";
	$offset = $dataPerPage * ($page-1);
	
	$list = null;
	
	$list .= '<table width="100%">
				<tr>
					<th style="width:200px;text-align : center;"><div>Tanggal</div></th>
					<th style="width:100px;text-align : center;"><div>N/A</div></th>
					<th style="width:400px;text-align : center;"><div>Keterangan</div></th>
					<th style="width:250px;text-align : center;"><div>Saldo</div></th>
					<th style="width:120px;text-align : center;"><div>#</div></th>
				</tr>';
	
	$data = database()->bindQuery($query."LIMIT ".$offset.",".$dataPerPage);
	
	if($data){
	foreach($data as $key => $val){ 

			if(($key+1) % 2 == 0) $bg = "underflow-blue";
			else $bg = "underflow";
			
		$split_date = explode("/",$val->tanggal);
		$tanggal = monthConvert($split_date[1]);
		$tanggal = $split_date[2]." ".ucwords($tanggal)." ".$split_date[0];
		
		if($val->debet > 0){
			
			$debet = currency." ".number_format($val->debet);
			
		}else{
			
			$debet = "-";
		}
		
		if($val->kredit == 0){
			$saldo = $val->debet;
		}else{
			$saldo = $val->kredit;
		}
		
		if($saldo > 0){
			
			$saldo = str_replace("-","",currency." ".number_format($saldo));
			
		}else{
			
			$saldo = "-";
		}
		
		
			
		if($key == (count($data)-1) ) $border = "border-bottom:1px #ddd solid;";
		else $border = null;
		
		$ref_number = database()->Query("SELECT * FROM db_noakun WHERE no_akun = '".$val->no_akun."' ");
		$ref_number = $ref_number->Fetch();
		
				$list .= '<tr class="underflow '.$bg.'" style="'.$border.'">
							<td style="text-align : center;">'.$tanggal.'</td>
							<td style="text-align : center;">'.$val->no_akun.'</td>
							<td>'.$val->uraian.'</td>
							<td style="text-align : center;">'.$saldo.'</td>
							<td style="border-right:transparent;text-align:center">

							<img src="'.projectUrl().'/assets/img/edit.png" width="20" height="20" data-toggle="modal" data-target="#squarespaceModal" style="cursor:pointer" onClick="olah_modal(\'saldoawal\','.$val->id.',\'edit\',\''.act_pages.'\')">

							<img src="'.projectUrl().'/assets/img/trash.png" width="20" height="20" style="cursor:pointer" onClick="delete_data(\'jurnalumum\','.$val->id.',\''.act_pages.'\')">


							
						
							</td>
						</tr>
						';
	
	}
	}else{
		$list .= '<tr style="border-bottom:1px #ddd solid;">
							<td style="text-align : center;padding:30px" colspan="7">Tidak Ada Data</td>
						</tr>
						';
	}
	
	$list .= "</table>";
	
	$list .= "<center>".pagination(
		$page, // active oage
		$dataPerPage, // list data per page
		$totalData, // total data
		HomeUrl()."/?module=saldoawal".url, // url pagination
		"pagination", // <u class
		'', // <li class
		pjax_load_data()->class, // <a href class
		'web-content', // pjax-attribute
		'aktive' // active page class
	)."</center>";
	
	return $list;
}



function jurnalumum($noakun = null,$pg = null){
	
	$query = "SELECT * FROM db_jurnalumum WHERE id > 0 and rec_module != '21' and rec_module != '12' and rec_module != '31'  and rec_module != '53' and (tanggal like '%".sorting."%') ORDER BY id DESC ";
	$rowCount = database()->Query($query)->rowCount();
	
	if(!isset($_GET['page']) or empty($_GET['page']))
	$page = 1;
	else $page = $_GET['page'];

	if(!empty($pg)) $page = $pg;
	
	$dataPerPage = 10;
	$totalData = $rowCount;
	$url = "";
	$offset = $dataPerPage * ($page-1);
	
	$list = null;
	
	$list .= '<table width="100%">
				<tr>
					<th style="width:200px;text-align : center;"><div>Tanggal</div></th>
					<th style="width:100px;text-align : center;"><div>N/A</div></th>
					<th style="width:400px;text-align : center;"><div>Uraian</div></th>
					<th style="width:250px;text-align : center;"><div>Debet</div></th>
					<th style="width:250px;text-align : center;"><div>Kredit</div></th>
					<th style="width:120px;text-align : center;"><div>#</div></th>
				</tr>';
	
	$data = database()->bindQuery($query."LIMIT ".$offset.",".$dataPerPage);
	
	if($data){
	foreach($data as $key => $val){ 

			if(($key+1) % 2 == 0) $bg = "underflow-blue";
			else $bg = "underflow";
			
		$split_date = explode("/",$val->tanggal);
		$tanggal = monthConvert($split_date[1]);
		$tanggal = $split_date[2]." ".ucwords($tanggal)." ".$split_date[0];
		
		if($val->debet > 0){
			
			$debet = currency." ".number_format($val->debet);
			
		}else{
			
			$debet = "-";
		}
		
		if($val->kredit > 0){
			
			$kredit = currency." ".number_format($val->kredit);
			
		}else{
			
			$kredit = "-";
		}
			
		if($key == (count($data)-1) ) $border = "border-bottom:1px #ddd solid;";
		else $border = null;
		
		$ref_number = database()->Query("SELECT * FROM db_noakun WHERE no_akun = '".$val->no_akun."' ");
		$ref_number = $ref_number->Fetch();
		
		if($val->rec_module == "21" and $val->no_akun !== "21"){
		
			$btns = '<button class="btn btn-info"  data-toggle="modal" data-target="#squarespaceModal" style="cursor:pointer" onClick="olah_modal(\'jurnalumum\','.$val->id.',\'edit\',\''.act_pages.'\')">
							<i class="fas fa-edit"></i>
							</button>';
		}elseif($val->rec_module == "21" and $val->no_akun == "21"){
			$btns = '<img src="'.projectUrl().'/assets/img/edit.png" width="20" height="20" style="cursor:pointer" onClick="void(0)">';

		}else{

			$btns = '<img src="'.projectUrl().'/assets/img/edit.png" width="20" height="20" data-toggle="modal" data-target="#squarespaceModal" style="cursor:pointer" onClick="olah_modal(\'jurnalumum\','.$val->id.',\'edit\',\''.act_pages.'\')">';

			
		}
				$list .= '<tr class="underflow '.$bg.'" style="'.$border.'">
							<td style="text-align : center;">'.$tanggal.'</td>
							<td style="text-align : center;">'.$val->no_akun.'</td>
							<td>'.$ref_number['nama_akun'].'</td>
							<td style="text-align : center;">'.$debet.'</td>
							<td style="text-align : center;">'.$kredit.'</td>
							<td style="border-right:transparent;text-align:center">
							
							'.$btns.'
							
							
							
							<img src="'.projectUrl().'/assets/img/trash.png" width="20" height="20" style="cursor:pointer" onClick="delete_data(\'jurnalumum\','.$val->id.',\''.act_pages.'\')">

							
							</td>
						</tr>
						';
	
	}
	}else{
		$list .= '<tr style="border-bottom:1px #ddd solid;">
							<td style="text-align : center;padding:30px" colspan="7">Tidak Ada Data</td>
						</tr>
						';
	}
	
	$list .= "</table>";
	
	$list .= "<center>".pagination(
		$page, // active oage
		$dataPerPage, // list data per page
		$totalData, // total data
		HomeUrl()."/?module=jurnalumum".url, // url pagination
		"pagination", // <u class
		'', // <li class
		pjax_load_data()->class, // <a href class
		'web-content', // pjax-attribute
		'aktive' // active page class
	)."</center>";
	
	return $list;
}


function jurnalpenyesuaian(){
	
	$query = "SELECT * FROM db_jurnalumum WHERE js='1' and no_akun != '11' and (tanggal like '%".sorting."%') ORDER BY id DESC ";
	$rowCount = database()->Query($query)->rowCount();
	
	if(!isset($_GET['page']) or empty($_GET['page']))
	$page = 1;
	else $page = $_GET['page'];
	
	$dataPerPage = 10;
	$totalData = $rowCount;
	$url = "";
	$offset = $dataPerPage * ($page-1);
	
	$list = null;
	
	$list .= '<table width="100%">
				<tr>
					<th style="width:200px;text-align : center;"><div>Tanggal</div></th>
					<th style="width:100px;text-align : center;"><div>N/A</div></th>
					<th style="width:400px;text-align : center;"><div>Keterangan</div></th>
					<th style="width:250px;text-align : center;"><div>Saldo</div></th>
					<th style="width:120px;text-align : center;"><div>#</div></th>
				</tr>';
	
	$data = database()->bindQuery($query."LIMIT ".$offset.",".$dataPerPage);
	
	if($data){
	foreach($data as $key => $val){ 

			if(($key+1) % 2 == 0) $bg = "underflow-blue";
			else $bg = "underflow";
			
		$split_date = explode("/",$val->tanggal);
		$tanggal = monthConvert($split_date[1]);
		$tanggal = $split_date[2]." ".ucwords($tanggal)." ".$split_date[0];
		
		if($val->debet > 0){
			
			$debet = currency." ".number_format($val->debet);
			
		}else{
			
			$debet = "-";
		}
		
		if($val->kredit > 0){
			
			$kredit = currency." ".number_format($val->kredit);
			
		}else{
			
			$kredit = "-";
		}
		
		
		if($val->debet == 0){
			
			$saldo = currency." ".number_format($val->kredit);
			
		}else{
			
			$saldo = currency." ".number_format($val->debet);
			
		}
		
		if($key == (count($data)-1) ) $border = "border-bottom:1px #ddd solid;";
		else $border = null;
		$ref_number = database()->Query("SELECT * FROM db_noakun WHERE no_akun = '".$val->no_akun."' ");
		$ref_number = $ref_number->Fetch();
		
				$list .= '<tr class="underflow '.$bg.'" style="'.$border.'">
							<td style="text-align : center;">'.$tanggal.'</td>
							<td style="text-align : center;">'.$val->no_akun.'</td>
							<td>'.$val->uraian.'</td>
							<td style="text-align : center;">'.$saldo.'</td>
							<td style="border-right:transparent;text-align:center">

								<img src="'.projectUrl().'/assets/img/edit.png" width="20" height="20" data-toggle="modal" data-target="#squarespaceModal" style="cursor:pointer" onClick="olah_modal(\'jurnalpenyesuaian\','.$val->id.',\'edit\',\''.act_pages.'\')">

							<img src="'.projectUrl().'/assets/img/trash.png" width="20" height="20" style="cursor:pointer" onClick="delete_data(\'jurnalumum\','.$val->id.',\''.act_pages.'\')">

						
							</td>
						</tr>
						';
	
	}
	}else{
		$list .= '<tr style="border-bottom:1px #ddd solid;">
							<td style="text-align : center;padding:30px" colspan="7">Tidak Ada Data</td>
						</tr>
						';
	}
	
	$list .= "</table>";
	
	$list .= "<center>".pagination(
		$page, // active oage
		$dataPerPage, // list data per page
		$totalData, // total data
		HomeUrl()."/?module=jurnalpenyesuaian".url, // url pagination
		"pagination", // <u class
		'', // <li class
		pjax_load_data()->class, // <a href class
		'web-content', // pjax-attribute
		'aktive' // active page class
	)."</center>";
	
	return $list;
}



function bukubesar($akun = null){
	if(isset($_GET['akun'])) $akun = $_GET['akun'];
	else if(!empty($akun)) $akun = $akun;
	else $akun = 11;
		
	$query = "SELECT * FROM db_jurnalumum WHERE no_akun='".$akun."' and (tanggal like '%".sorting."%') ORDER BY id ASC ";
	$rowCount = database()->Query($query)->rowCount();
	
	if(!isset($_GET['page']) or empty($_GET['page']))
	$page = 1;
	else $page = $_GET['page'];
	
	$dataPerPage = 10;
	$totalData = $rowCount;
	$url = "";
	$offset = $dataPerPage * ($page-1);
	
	$list = null;
	
	$list .= '<table width="100%">
				<tr>
					<th style="width:200px;text-align : center;"><div style="padding:20px">Tanggal</div></th>
					<th style="width:130px;text-align : center;"><div style="padding:20px">N/A</div></th>
					<th style="width:400px;text-align : center;"><div style="padding:20px">Uraian</div></th>
					<th style="width:200px;text-align : center;"><div style="padding:20px">Debet</div></th>
					<th style="width:200px;text-align : center;"><div style="padding:20px">Kredit</div></th>
					<th style="width:400px;text-align : center;"><div>Saldo</div>
					<div style="width:49%;margin-top:2px;float:left">Debet</div>
					<div style="width:49%;margin-top:2px;float:right">Kredit</div></th>
				</tr>';
	
	$data = database()->bindQuery($query."LIMIT ".$offset.",".$dataPerPage);
	
	if($data){
	foreach($data as $key => $val){ 

			if(($key+1) % 2 == 0) $bg = "underflow-blue";
			else $bg = "underflow";
			
		$split_date = explode("/",$val->tanggal);
		$tanggal = monthConvert($split_date[1]);
		$tanggal = $split_date[2]." ".ucwords($tanggal)." ".$split_date[0];
		
		if($val->debet > 0){
			
			$debet = str_replace("-","",currency." ".number_format($val->debet));
			
		}else{
			
			$debet = "-";
		}
		
		if($val->kredit > 0){
			
			$kredit = str_replace("-","",currency." ".number_format($val->kredit));
			
		}else{
			
			$kredit = "-";
		}	
		
		if(!is_numeric($val->debet)) $deb = 0; else $deb = $val->debet;
		if(!is_numeric($val->kredit)) $kre = 0; else $kre = $val->kredit;
		
		
		
			if($key !== 0){
				
				$awal = $akhir + $deb;
				$saldo = $awal - $kre;		
				$akhir = $saldo;
				
			}else{
				
				if($deb == 0){
					$awal = intval("-".$kre);
					$saldo = intval("-".$kre);
					$akhir = intval("-".$kre);
				}else{
					$awal = $deb;
					$saldo = $deb;
					$akhir = $deb;
				}
				
				
				if(isset($_GET['page'])){
					if($_GET['page'] !== '1' and !empty($_GET['page'])){
						if($_SESSION['saldo_bukubesar'] < 0){
							$kre = $_SESSION['saldo_bukubesar'];
						}else{
							$deb = $_SESSION['saldo_bukubesar'];
						}
						
						$awal = $akhir + $deb;
						$saldo = $awal - $kre;		
						$akhir = $saldo;
					}
				}
			
				
				
			}
		
		if($page == '1' or empty($page)){
			
			$_SESSION['saldo_bukubesar'] = $saldo;
			
		}
			
		if($saldo < 0){
				$debet1 = "-";
				$kredit1 = str_replace("-","",currency." ".number_format($saldo));
		}else{
				$debet1 = str_replace("-","",currency." ".number_format($saldo));
				$kredit1 = "-";
		}
		
		if($key == (count($data)-1) ) $border = "border-bottom:1px #ddd solid;";
		else $border = null;
		
		$ref_number = database()->Query("SELECT * FROM db_noakun WHERE no_akun = '".$val->no_akun."' ");
		$ref_number = $ref_number->Fetch();
		
				$list .= '<tr class="underflow '.$bg.'" style="'.$border.';">
							<td style="text-align : center;padding:10px;">'.$tanggal.'</td>
							<td style="text-align : center;padding:10px;">'.$val->no_akun.'</td>
							<td style="padding:10px;">'.$ref_number['nama_akun'].'</td>
							<td style="text-align : center;padding:10px;">'.$debet.'</td>
							<td style="text-align : center;padding:10px;">'.$kredit.'</td>
							<td style="text-align : center;padding:10px;">
								<div style="width:50%;float:left">'.$debet1.'</div>
								<div style="width:50%;float:right">'.$kredit1.'</div></td>
							
						</tr>
						';
	
	}
	}else{
		$list .= '<tr style="border-bottom:1px #ddd solid;">
							<td style="text-align : center;padding:30px" colspan="7">Tidak Ada Data</td>
						</tr>
						';
	}
	
	$list .= "</table>";
	
	$list .= "<center>".pagination(
		$page, // active oage
		$dataPerPage, // list data per page
		$totalData, // total data
		HomeUrl()."/?module=bukubesar".url, // url pagination
		"pagination", // <u class
		'', // <li class
		pjax_load_data()->class, // <a href class
		'web-content', // pjax-attribute
		'aktive' // active page class
	)."</center>";
	
	return $list;
}


function neracasaldo($noakun,$js=0){
	
	$akun = $noakun;
	
	$list = null;
	
	if($js !== "all"){
		$js = "and js='".$js."'";
	}else{
		$js = null;
	}
	
	$query = "SELECT * FROM db_jurnalumum WHERE no_akun='".$akun."' $js and (tanggal like '%".sorting."%') ORDER BY id ASC ";
	

	
	$data = database()->bindQuery($query);
	
	if($data){
	foreach($data as $key => $val){ 
		$nama = $val->uraian;
		if(!is_numeric($val->debet)) $deb = 0; else $deb = $val->debet;
		if(!is_numeric($val->kredit)) $kre = 0; else $kre = $val->kredit;	
		
			if($key !== 0){
				
				$awal = $akhir + $deb;
				$saldo = $awal - $kre;		
				$akhir = $saldo;
				
			}else{
				
				if($deb == 0){
					$awal = intval("-".$kre);
					$saldo = intval("-".$kre);
					$akhir = intval("-".$kre);
				}else{
					$awal = $deb;
					$saldo = $deb;
					$akhir = $deb;
				}					
			}	
	
		}
	}	
		if(isset($saldo)){
			if($saldo < 0){
					$debet1 = "-";
					$kredit1 = str_replace("-","",currency." ".number_format($saldo));
				
				$debs = 0;
				$kres = $saldo;
				
			}else{
					$debet1 = str_replace("-","",currency." ".number_format($saldo));
					$kredit1 = "-";
				
				$debs = $saldo;
				$kres = 0;
			}
		}else{
			$debet1 = "-";
			$kredit1 = "-";
			
			$debs = 0;
			$kres = 0;
		}
	return ["debet" => $debet1,"kredit" => $kredit1,"ori_deb" => $debs,"ori_kre" => $kres];
}

function neracalajur1(){
	
	$query = "SELECT * FROM db_noakun ORDER BY no_akun ASC";
	
	$list = null;
	
	$list .= '<table width="100%">
				<tr>
					<th style="width:30px;text-align : center;"><div style="padding:20px;">N/A</div></th>
					<th style="width:400px;text-align : center;"><div style="padding:20px;">Uraian</div></th>
			
					<th style="width:420px;text-align : center;">
					<div>Neraca Saldo</div>
					<div style="width:49%;margin-top:2px;float:left">Debet</div>
					<div style="width:49%;margin-top:2px;float:right">Kredit</div>
					</th>
					
					<th style="width:420px;text-align : center;">
					<div>Neraca Penyesuaian</div>
					<div style="width:49%;margin-top:2px;float:left">Debet</div>
					<div style="width:49%;margin-top:2px;float:right">Kredit</div>
					</th>
					
					<th style="width:420px;text-align : center;">
					<div>Neraca Setelah Penyesuaian</div>
					<div style="width:49%;margin-top:2px;float:left">Debet</div>
					<div style="width:49%;margin-top:2px;float:right">Kredit</div>
					</th>
					
					
					
				</tr>';
	
	$data = database()->bindQuery($query);
	
	if($data){
		
		$tot_deb1 = 0;
		$tot_deb2 = 0;
		$tot_deb3 = 0;
		$tot_deb4 = 0;
		$tot_deb5 = 0;
		$tot_kre1 = 0;
		$tot_kre2 = 0;
		$tot_kre3 = 0;
		$tot_kre4 = 0;
		$tot_kre5 = 0;
		$num = 1;
	foreach($data as $key => $val){ 
		
		$check = database()->Query("SELECT id FROM db_jurnalumum WHERE no_akun='".$val->no_akun."' and (tanggal like '%".sorting."%') ")->rowCount();
		
		if($check > 0){
			$uang = neracasaldo($val->no_akun);
			
			$sesuai = neracasaldo($val->no_akun,1);
			
			$after = neracasaldo($val->no_akun,"all");
			
			if($val->no_akun >= 41){
				
				$rugi_deb = $after['debet'];
					
				$rugi_kre = $after['kredit'];
				
				$rugi_deb1 = $after['ori_deb'];
					
				$rugi_kre1 = $after['ori_kre'];
			
			}else{
				
				$rugi_deb = "-";
					
				$rugi_kre = "-";
				
				$rugi_deb1 = 0;
					
				$rugi_kre1 = 0;
					
			}
			
			if($val->no_akun < 41){
				
				$ner_deb = $after['debet'];
					
				$ner_kre = $after['kredit'];
				
				$ner_deb1 = $after['ori_deb'];
				
				$ner_kre1 = $after['ori_kre'];
			
			}else{
				
				$ner_deb = "-";
					
				$ner_kre = "-";
				
				$ner_deb1 = 0;
				
				$ner_kre1 = 0;
					
			}
			
			
			if($uang !== false){
		
			if(($num++) % 2 == 0) $bg = "underflow-blue";
			else $bg = "underflow";
			
			if($key == (count($data)-1) ) $border = "border-bottom:1px #ddd solid;";
			else $border = null;
				
				$tot_deb1 += $uang['ori_deb'];
				$tot_deb2 += $sesuai['ori_deb'];
				$tot_deb3 += $after['ori_deb'];
				$tot_deb4 += $rugi_deb1;
				$tot_deb5 += $ner_deb1;
				
				$tot_kre1 += $uang['ori_kre'];
				$tot_kre2 += $sesuai['ori_kre'];
				$tot_kre3 += $after['ori_kre'];
				$tot_kre4 += $rugi_kre1;
				$tot_kre5 += $ner_kre1;
				
				$list .= '<tr class="underflow '.$bg.'" style="'.$border.'">
						<td style="text-align:center;padding:10px;">'.$val->no_akun.'</td>
						<td style="padding:10px;">'.$val->nama_akun.'</td>
						
						<td style="text-align : center;padding:10px;">
								<div style="width:50%;float:left">'.$uang['debet'].'</div>
								<div style="width:50%;float:right">'.$uang['kredit'].'</div>
						</td>
						
						<td style="text-align : center;padding:10px;">
								<div style="width:50%;float:left">'.$sesuai['debet'].'</div>
								<div style="width:50%;float:right">'.$sesuai['kredit'].'</div>
						</td>
						
						<td style="text-align : center;padding:10px;">
								<div style="width:50%;float:left">'.$after['debet'].'</div>
								<div style="width:50%;float:right">'.$after['kredit'].'</div>
						</td>
						
						
						</tr>
						';
			}
		}
	}
		
	if($tot_deb1 == ""){
		$tot_debs1 = "-";
	}else{
		$tot_debs1 = currency." ".number_format(str_replace("-","",$tot_deb1));
	}
	
	if($tot_deb2 == ""){
		$tot_debs2 = "-";
	}else{
		$tot_debs2 = currency." ".number_format(str_replace("-","",$tot_deb2));
	}
	
	if($tot_deb3 == ""){
		$tot_debs3 = "-";
	}else{
		$tot_debs3 = currency." ".number_format(str_replace("-","",$tot_deb3));
	}
		
	if($tot_kre1 == ""){
		$tot_kres1 = "-";
	}else{
		$tot_kres1 = currency." ".number_format(str_replace("-","",$tot_kre1));
	}
	
	if($tot_kre2 == ""){
		$tot_kres2 = "-";
	}else{
		$tot_kres2 = currency." ".number_format(str_replace("-","",$tot_kre2));
	}
	
	if($tot_kre3 == ""){
		$tot_kres3 = "-";
	}else{
		$tot_kres3 = currency." ".number_format(str_replace("-","",$tot_kre3));
	}
		
	if(!isset($bg)) $bg = null;
	$list .= '<tr class="underflow ">
						<th style="text-align:center;border:transparent"></th>
						<th style="text-align:center;border:transparent"></th>
						
						<th style="text-align : center;padding-top:10px;border:transparent">
								<div style="width:49%;float:left">'.$tot_debs1.'</div>
								<div style="width:49%;float:right">'.$tot_kres1.'</div>
						</th>
						
						<th style="text-align : center;padding-top:10px;border:transparent">
								<div style="width:49%;float:left">'.$tot_debs2.'</div>
								<div style="width:49%;float:right">'.$tot_kres2.'</div>
						</th>
						
						<th style="text-align : center;padding-top:10px;border:transparent">
								<div style="width:49%;float:left">'.$tot_debs3.'</div>
								<div style="width:49%;float:right">'.$tot_kres3.'</div>
						</th>
						
						
						
						</tr>
						';
		
	}else{
		$list .= '<tr style="border-bottom:1px #ddd solid;">
							<td style="text-align : center;padding:30px" colspan="7">Tidak Ada Data</td>
						</tr>
						';
	}
	
	$list .= "</table>";
	
	return $list;
	
}



function neracalajur2(){
	
	$query = "SELECT * FROM db_noakun ORDER BY no_akun ASC";
	
	$list = null;
	
	$list .= '<table width="100%">
				<tr>
					
					<th style="width:30px;text-align : center;"><div style="padding:20px;">N/A</div></th>
					<th style="width:250px;text-align : center;"><div style="padding:20px;">Uraian</div></th>
					<th style="width:420px;text-align : center;">
					<div>Rugi Laba</div>
					<div style="width:49%;margin-top:2px;float:left">Debet</div>
					<div style="width:49%;margin-top:2px;float:right">Kredit</div>
					</th>
					
					<th style="width:420px;text-align : center;">
					<div>Neraca</div>
					<div style="width:49%;margin-top:2px;float:left">Debet</div>
					<div style="width:49%;margin-top:2px;float:right">Kredit</div>
					</th>
					
				</tr>';
	
	$data = database()->bindQuery($query);
	
	if($data){
		
		$tot_deb1 = 0;
		$tot_deb2 = 0;
		$tot_deb3 = 0;
		$tot_deb4 = 0;
		$tot_deb5 = 0;
		$tot_kre1 = 0;
		$tot_kre2 = 0;
		$tot_kre3 = 0;
		$tot_kre4 = 0;
		$tot_kre5 = 0;
		
		$num = 1;
		
	foreach($data as $key => $val){ 
		
		$check = database()->Query("SELECT id FROM db_jurnalumum WHERE no_akun='".$val->no_akun."' and (tanggal like '%".sorting."%') ")->rowCount();
		
		if($check > 0){
			$uang = neracasaldo($val->no_akun);
			
			$sesuai = neracasaldo($val->no_akun,1);
			
			$after = neracasaldo($val->no_akun,"all");
			
			if($val->no_akun >= 41){
				
				$rugi_deb = $after['debet'];
					
				$rugi_kre = $after['kredit'];
				
				$rugi_deb1 = $after['ori_deb'];
					
				$rugi_kre1 = $after['ori_kre'];
			
			}else{
				
				$rugi_deb = "-";
					
				$rugi_kre = "-";
				
				$rugi_deb1 = 0;
					
				$rugi_kre1 = 0;
					
			}
			
			if($val->no_akun < 41){
				
				$ner_deb = $after['debet'];
					
				$ner_kre = $after['kredit'];
				
				$ner_deb1 = $after['ori_deb'];
				
				$ner_kre1 = $after['ori_kre'];
			
			}else{
				
				$ner_deb = "-";
					
				$ner_kre = "-";
				
				$ner_deb1 = 0;
				
				$ner_kre1 = 0;
					
			}
			
			
			if($uang !== false){
		
			if(($num++) % 2 == 0) $bg = "underflow-blue";
			else $bg = "underflow";
			
			if($key == (count($data)-1) ) $border = "border-bottom:1px #ddd solid;";
			else $border = null;
				
				$tot_deb1 += $uang['ori_deb'];
				$tot_deb2 += $sesuai['ori_deb'];
				$tot_deb3 += $after['ori_deb'];
				$tot_deb4 += $rugi_deb1;
				$tot_deb5 += $ner_deb1;
				
				$tot_kre1 += $uang['ori_kre'];
				$tot_kre2 += $sesuai['ori_kre'];
				$tot_kre3 += $after['ori_kre'];
				$tot_kre4 += $rugi_kre1;
				$tot_kre5 += $ner_kre1;
				
				$list .= '<tr class="underflow '.$bg.'" style="'.$border.'">
						<td style="text-align:center;padding:10px;">'.$val->no_akun.'</td>
						<td style="padding:10px;">'.$val->nama_akun.'</td>
						
						<td style="text-align : center;padding:10px;">
								<div style="width:50%;float:left">'.$rugi_deb.'</div>
								<div style="width:50%;float:right">'.$rugi_kre.'</div>
						</td>
						
						<td style="text-align : center;padding:10px;">
								<div style="width:50%;float:left">'.$ner_deb.'</div>
								<div style="width:50%;float:right">'.$ner_kre.'</div>
						</td>
						
						</tr>
						';
			}
		}
	}
	
		$laba = (int) ($tot_deb4 + ($tot_kre4 - ($tot_kre4*2) - $tot_deb4)) - $tot_deb4;
		
		if($laba < 0){
			$lab_deb = 0;
			$lab_kre = $laba;
			
			$lab_deb1 = "-";
			$lab_kre1 = currency." ".number_format(str_replace("-","",$laba));
			
			$rug_deb = ($lab_deb + $tot_deb4);
			$rug_kre = ($lab_kre + $tot_kre4);
			
		}else{
			$lab_deb = $laba;
			$lab_kre = 0;
			
			$lab_deb1 = currency." ".number_format(str_replace("-","",$laba));
			$lab_kre1 = "-";
			
			$rug_deb = ($lab_deb + $tot_deb4);
			$rug_kre = ($lab_kre + $tot_kre4);
		}
		
		if($laba == ""){
			$lab_deb1 = "-";
			$lab_kre1 = "-";
		}
		
		$rugs_deb1 = currency." ".number_format(str_replace("-","",$rug_deb));
		$rugs_kre1 = currency." ".number_format(str_replace("-","",$rug_kre));
		
		if($rug_deb == "") $rugs_deb1 = "-";
		if($rug_kre == "") $rugs_kre1 = "-";
		
		$laba = ($tot_deb5 + ($tot_kre5 - ($tot_kre5*2) - $tot_deb5)) - $tot_deb5;
		
		if($laba < 0){
			$lab_deb = 0;
			$lab_kre = $laba;
			
			$lab_deb2 = "-";
			$lab_kre2 = currency." ".number_format(str_replace("-","",$laba));
			
			$rug_deb = ($lab_deb + $tot_deb5);
			$rug_kre = ($lab_kre + $tot_kre5);
			
		}else{
			$lab_deb = $laba;
			$lab_kre = 0;
			
			$lab_deb2 = currency." ".number_format(str_replace("-","",$laba));
			$lab_kre2 = "-";
			
			$rug_deb = ($lab_deb + $tot_deb5);
			$rug_kre = ($lab_kre + $tot_kre5);
		}
		
		if($laba == ""){
			$lab_deb2 = "-";
			$lab_kre2 = "-";
		}
		
		$rugs_deb2 = currency." ".number_format(str_replace("-","",$rug_deb));
		$rugs_kre2 = currency." ".number_format(str_replace("-","",$rug_kre));
		
		
		
		if($rug_deb == "") {
			$rugs_deb2 = "-";
		}
		
		if($rug_kre == "") {
			$rugs_kre2 = "-";
		}
		
		if($tot_deb4 == ""){
			$tot_debs4 = "-";
		}else{
			$tot_debs4 = currency." ".number_format(str_replace("-","",$tot_deb4));
		}
		if($tot_deb5 == ""){
			$tot_debs5 = "-";
		}else{
			$tot_debs5 = currency." ".number_format(str_replace("-","",$tot_deb5));
		}
		
		if($tot_kre4 == ""){
			$tot_kres4 = "-";
		}else{
			$tot_kres4 = currency." ".number_format(str_replace("-","",$tot_kre4));
		}
		
		if($tot_kre5 == ""){
			$tot_kres5 = "-";
		}else{
			$tot_kres5 = currency." ".number_format(str_replace("-","",$tot_kre5));
		}
		
	if(!isset($bg)) $bg = null;
		
	$list .= '<tr class="underflow">
					
						<td style="border:transparent"></td>
						<td style="border:transparent"></td>
						<th style="text-align : center;padding-top:10px;border:transparent">
								<div style="width:49%;float:left">'.$tot_debs4.'</div>
								<div style="width:49%;float:right">'.$tot_kres4.'</div>
								<div style="width:49%;float:left;margin-top:3px;">'.$lab_deb1.'</div>
								<div style="width:49%;float:right;margin-top:3px;">'.$lab_kre1.'</div>
								<div style="width:49%;float:left;margin-top:3px;">'.$rugs_deb1.'</div>
								<div style="width:49%;float:right;margin-top:3px;">'.$rugs_kre1.'</div>
						</th>
						
						<th style="text-align : center;padding-top:10px;border:transparent">
								<div style="width:49%;float:left">'.$tot_debs5.'</div>
								<div style="width:49%;float:right">'.$tot_kres5.'</div>
								
								<div style="width:49%;float:left;margin-top:3px;">'.$lab_deb2.'</div>
								<div style="width:49%;float:right;margin-top:3px;">'.$lab_kre2.'</div>
								<div style="width:49%;float:left;margin-top:3px;">'.$rugs_deb2.'</div>
								<div style="width:49%;float:right;margin-top:3px;">'.$rugs_kre2.'</div>
						</th>
						
						</tr>
						';
		
	}else{
		$list .= '<tr style="border-bottom:1px #ddd solid;">
							<td style="text-align : center;padding:30px" colspan="7">Tidak Ada Data</td>
						</tr>
						';
	}
	
	$list .= "</table>";
	
	return $list;
	
}

function hitung_laba(){
	$beban = database()->bindQuery("SELECT * FROM db_noakun WHERE no_akun >= 41 ");
					$new_saldo = 0;
					foreach($beban as $key => $val){
						$check = database()->Query("SELECT id FROM db_jurnalumum WHERE no_akun='".$val->no_akun."' and (tanggal like '%".sorting."%') ");
						
						if($check->rowCount() !== 0){
						
							$saldo_laba = neracasaldo($val->no_akun,"all");
							
							if($saldo_laba['ori_kre'] == 0){
									$salt = $saldo_laba['ori_deb'];
								}else{
									$salt = $saldo_laba['ori_kre'];
								}
							
							if($val->no_akun > 41){
								$old_saldo = $new_saldo + $saldo_laba['ori_deb'];
								$saldo = $old_saldo + $saldo_laba['ori_kre'];
								$new_saldo = $saldo;
							}else{
								$pendapatan = $salt - ($salt * 2);
							}
							
				
						}
					}
					
					if(!isset($pendapatan)){
					return 0;
					}
					return ($pendapatan - $new_saldo);
}

function hutang($noakun = null){
	
	$command = "and no_akun='21' ";
	
	$query = "SELECT * FROM db_jurnalumum WHERE id > 0 ".$command." and (tanggal like '%".sorting."%') ORDER BY id DESC ";
	$rowCount = database()->Query($query)->rowCount();
	
	if(!isset($_GET['page']) or empty($_GET['page']))
	$page = 1;
	else $page = $_GET['page'];
	
	$dataPerPage = 10;
	$totalData = $rowCount;
	$url = "";
	$offset = $dataPerPage * ($page-1);
	
	$list = null;
	
	$list .= '<table width="100%">
				<tr>
					<th style="width:200px;text-align : center;"><div>Tanggal</div></th>
					<th style="width:100px;text-align : center;"><div>N/A</div></th>
					<th style="width:400px;text-align : center;"><div>Keterangan</div></th>
					<th style="width:250px;text-align : center;"><div>Saldo</div></th>
					<th style="width:120px;text-align : center;"><div>#</div></th>
				</tr>';
	
	$data = database()->bindQuery($query."LIMIT ".$offset.",".$dataPerPage);
	
	if($data){
	foreach($data as $key => $val){ 

			if(($key+1) % 2 == 0) $bg = "underflow-blue";
			else $bg = "underflow";
			
		$split_date = explode("/",$val->tanggal);
		$tanggal = monthConvert($split_date[1]);
		$tanggal = $split_date[2]." ".ucwords($tanggal)." ".$split_date[0];
		
		if($val->debet > 0){
			
			$debet = currency." ".number_format($val->debet);
			
		}else{
			
			$debet = "-";
		}
		
		if($val->kredit == 0){
			$saldo = $val->debet;
		}else{
			$saldo = $val->kredit;
		}
		
		if($saldo > 0){
			
			$saldo = str_replace("-","",currency." ".number_format($saldo));
			
		}else{
			
			$saldo = "-";
		}
		
		
			
		if($key == (count($data)-1) ) $border = "border-bottom:1px #ddd solid;";
		else $border = null;
		
		$ref_number = database()->Query("SELECT * FROM db_noakun WHERE no_akun = '".$val->no_akun."' ");
		$ref_number = $ref_number->Fetch();
		
		$try = database()->Query("SELECT * FROM db_jurnalumum WHERE rec_group='".$val->rec_group."'")->rowCount();
		
		if($try == 3){

			$btns = '<img src="'.projectUrl().'/assets/img/edit.png" width="20" height="20" data-toggle="modal" data-target="#squarespaceModal" style="cursor:pointer" onClick="olah_modal(\'hutang\','.$val->id.',\'edit\',\''.act_pages.'\')">';

		}else{

			$btns = '<img src="'.projectUrl().'/assets/img/edit.png" width="20" height="20" data-toggle="modal" data-target="#squarespaceModal" style="cursor:pointer" onClick="olah_modal(\'cicilhutang\','.$val->id.',\'edit\',\''.act_pages.'\')">';
		}
		
				$list .= '<tr class="underflow '.$bg.'" style="'.$border.'">
							<td style="text-align : center;">'.$tanggal.'</td>
							<td style="text-align : center;">'.$val->no_akun.'</td>
							<td>'.$val->uraian.'</td>
							<td style="text-align : center;">'.$saldo.'</td>
							<td style="border-right:transparent;text-align:center">
							
							'.$btns.'

							
							<img src="'.projectUrl().'/assets/img/trash.png" width="20" height="20" style="cursor:pointer" onClick="delete_data(\'jurnalumum\','.$val->id.',\''.act_pages.'\')" >
							
							
						
							</td>
						</tr>
						';
	
	}
	}else{
		$list .= '<tr style="border-bottom:1px #ddd solid;">
							<td style="text-align : center;padding:30px" colspan="7">Tidak Ada Data</td>
						</tr>
						';
	}
	
	$list .= "</table>";
	
	$list .= "<center>".pagination(
		$page, // active oage
		$dataPerPage, // list data per page
		$totalData, // total data
		HomeUrl()."/?module=saldoawal".url, // url pagination
		"pagination", // <u class
		'', // <li class
		pjax_load_data()->class, // <a href class
		'web-content', // pjax-attribute
		'aktive' // active page class
	)."</center>";
	
	return $list;
}
function piutang($noakun = null){
	
	$command = "and no_akun='12' ";
	
	$query = "SELECT * FROM db_jurnalumum WHERE id > 0 ".$command." and (tanggal like '%".sorting."%') ORDER BY id DESC ";
	$rowCount = database()->Query($query)->rowCount();
	
	if(!isset($_GET['page']) or empty($_GET['page']))
	$page = 1;
	else $page = $_GET['page'];
	
	$dataPerPage = 10;
	$totalData = $rowCount;
	$url = "";
	$offset = $dataPerPage * ($page-1);
	
	$list = null;
	
	$list .= '<table width="100%">
				<tr>
					<th style="width:200px;text-align : center;"><div>Tanggal</div></th>
					<th style="width:100px;text-align : center;"><div>N/A</div></th>
					<th style="width:400px;text-align : center;"><div>Keterangan</div></th>
					<th style="width:250px;text-align : center;"><div>Saldo</div></th>
					<th style="width:120px;text-align : center;"><div>#</div></th>
				</tr>';
	
	$data = database()->bindQuery($query."LIMIT ".$offset.",".$dataPerPage);
	
	if($data){
	foreach($data as $key => $val){ 

			if(($key+1) % 2 == 0) $bg = "underflow-blue";
			else $bg = "underflow";
			
		$split_date = explode("/",$val->tanggal);
		$tanggal = monthConvert($split_date[1]);
		$tanggal = $split_date[2]." ".ucwords($tanggal)." ".$split_date[0];
		
		if($val->debet > 0){
			
			$debet = currency." ".number_format($val->debet);
			
		}else{
			
			$debet = "-";
		}
		
		if($val->kredit == 0){
			$saldo = $val->debet;
		}else{
			$saldo = $val->kredit;
		}
		
		if($saldo > 0){
			
			$saldo = str_replace("-","",currency." ".number_format($saldo));
			
		}else{
			
			$saldo = "-";
		}
		
		
			
		if($key == (count($data)-1) ) $border = "border-bottom:1px #ddd solid;";
		else $border = null;
		
		$ref_number = database()->Query("SELECT * FROM db_noakun WHERE no_akun = '".$val->no_akun."' ");
		$ref_number = $ref_number->Fetch();
		
		$try = database()->Query("SELECT * FROM db_jurnalumum WHERE rec_group='".$val->rec_group."'")->rowCount();
		
		if($try == 3){

			$btns = '<img src="'.projectUrl().'/assets/img/edit.png" width="20" height="20" data-toggle="modal" data-target="#squarespaceModal" style="cursor:pointer" onClick="olah_modal(\'piutang\','.$val->id.',\'edit\',\''.act_pages.'\')">';


		}else{

			$btns = '<img src="'.projectUrl().'/assets/img/edit.png" width="20" height="20" data-toggle="modal" data-target="#squarespaceModal" style="cursor:pointer" onClick="olah_modal(\'cicilpiutang\','.$val->id.',\'edit\',\''.act_pages.'\')">';


		}
		
				$list .= '<tr class="underflow '.$bg.'" style="'.$border.'">
							<td style="text-align : center;">'.$tanggal.'</td>
							<td style="text-align : center;">'.$val->no_akun.'</td>
							<td>'.$val->uraian.'</td>
							<td style="text-align : center;">'.$saldo.'</td>
							<td style="border-right:transparent;text-align:center">
							
							'.$btns.'
							
						

							<img src="'.projectUrl().'/assets/img/trash.png" width="20" height="20" style="cursor:pointer" onClick="delete_data(\'jurnalumum\','.$val->id.',\''.act_pages.'\')">

						
							</td>
						</tr>
						';
	
	}
	}else{
		$list .= '<tr style="border-bottom:1px #ddd solid;">
							<td style="text-align : center;padding:30px" colspan="7">Tidak Ada Data</td>
						</tr>
						';
	}
	
	$list .= "</table>";
	
	$list .= "<center>".pagination(
		$page, // active oage
		$dataPerPage, // list data per page
		$totalData, // total data
		HomeUrl()."/?module=saldoawal".url, // url pagination
		"pagination", // <u class
		'', // <li class
		pjax_load_data()->class, // <a href class
		'web-content', // pjax-attribute
		'aktive' // active page class
	)."</center>";
	
	return $list;
}

// $data_value = [
	
// 	"load js" 	=> $load_js,
// 	"load css"	=> $load_css,

// ];