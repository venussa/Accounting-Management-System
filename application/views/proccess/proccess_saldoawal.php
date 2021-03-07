<?php

	$data = database()->Query("SELECT * FROM db_jurnalumum WHERE no_akun = '".$_POST['noakun']."' ");
	$find_row = $data->rowCount();
	
	if(!isset($_POST['edit']) and $find_row !== 0){
		echo "<failed/>";
		exit;
	}

	if(empty($_POST['debet'])){
		if(empty($_POST['kredit'])) {
			echo "<failed/>";
			exit;
		}
	}

	if(empty($_POST['kredit'])){
		if(empty($_POST['debet'])) {
			echo "<failed/>";
			exit;
		}
	}
	
	if(!empty(trim($_POST['uraian'])) and !empty(trim($_POST['tanggal']))){
		
		$nomor_akun = database()->Query("SELECT * FROM db_noakun WHERE nama_akun='".$_POST['noakun']."' ");
		$nomor_akun = $nomor_akun->fetch();
		if(isset($_POST['edit'])){
			$saldo = $_POST['debet'];
			
			$sel1 = database()->Query("SELECT * FROM db_jurnalumum WHERE id ='".$_POST['id']."' ")->Fetch();
			$sel2 = database()->Query("SELECT * FROM db_jurnalumum WHERE id != '".$_POST['id']."' and rec_group = '".$sel1['rec_group']."' ")->Fetch();
			
			if($sel1['debet'] == "0"){
				
				$kredit1 = $saldo;
				$debet1 = 0;
				
			}else{
				$kredit1 = 0;
				$debet1 = $saldo;
			
			}
			
			if($sel2['debet'] == "0"){
				
				$kredit2 = $saldo;
				$debet2 = 0;
				
			}else{
				$kredit2 = 0;
				$debet2 = $saldo;
			
			}
			
			
			if($nomor_akun['no_akun'] !== "11"){
			
			if(database()->Query("UPDATE db_jurnalumum SET 
			
				tanggal='".$_POST['tanggal']."',
				uraian='".$_POST['uraian']."',
				no_akun='".$nomor_akun['no_akun']."',
				debet='".$debet1."',
				kredit='".$kredit1."'

				WHERE id='".$_POST['id']."'")
			   	
			    and 
			   
			 	database()->Query("UPDATE db_jurnalumum SET 
			
				tanggal='".$_POST['tanggal']."',
				uraian='Kas',
				no_akun='11',
				debet='".$debet2."',
				kredit='".$kredit2."'

				WHERE id != '".$_POST['id']."' and rec_group = '".$sel1['rec_group']."' ")){
				echo saldoawal();
				echo "<success/>";

			}else{

				echo "<failed/>";

			}
			}else{
				$akun_name = database()->Query("SELECT * FROM db_noakun WHERE no_akun='".$sel2['no_akun']."' ")->Fetch();
				if(database()->Query("UPDATE db_jurnalumum SET 
			
				tanggal='".$_POST['tanggal']."',
				uraian='".$_POST['uraian']."',
				no_akun='".$sel2['no_akun']."',
				debet='".$debet2."',
				kredit='".$kredit2."'

				WHERE id != '".$_POST['id']."'  and rec_group = '".$sel1['rec_group']."' ")
			   	
			    and 
			   
			 	database()->Query("UPDATE db_jurnalumum SET 
			
				tanggal='".$_POST['tanggal']."',
				uraian='Kas',
				no_akun='11',
				debet='".$debet2."',
				kredit='".$kredit2."'

				WHERE id = '".$_POST['id']."'")){
				echo saldoawal();
				echo "<success/>";

			}else{

				echo "<failed/>";

			}
			}

		}else{
			$saldo = $_POST['debet'];
			
			
				$command = "(
										'".$_POST['tanggal']."',
										'".$_POST['uraian']."',
										'11',
										'".$saldo."',
										'0',
										'".time()."',
										'31'
							),
							(
										'".$_POST['tanggal']."',
										'".$_POST['uraian']."',
										'".$nomor_akun['no_akun']."',
										'0',
										'".$saldo."',
										'".time()."',
										'31'
										
							)";
			
			
			$query = "insert into db_jurnalumum 
									(tanggal,uraian,no_akun,debet,kredit,rec_group,rec_module) 
							   values ".$command;
				
			if(database()->Query($query))
			{
				echo saldoawal();
				echo "<success/>";

			}else{

				echo "<failed/>";

			}
		}
	}

?>