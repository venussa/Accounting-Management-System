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
			$sel2 = database()->Query("SELECT * FROM db_jurnalumum WHERE no_akun='11' and rec_module='12' and rec_group='".$sel1['rec_group']."' ")->Fetch();
			
			if($sel1['debet'] == "0"){
				
				$kredit1 = $saldo;
				$debet1 = 0;
				
			}else{
				$kredit1 = 0;
				$debet1 = $saldo;
			
			}
			
			if($sel2['debet'] == "0"){
				
				$kredit2 = $_POST['dp'];
				$debet2 = 0;
				
			}else{
				$kredit2 = 0;
				$debet2 = $_POST['dp'];
			
			}
			
			
		
			
			if(database()->Query("UPDATE db_jurnalumum SET 
			
				tanggal='".$_POST['tanggal']."',
				uraian = '".$_POST['uraian']."',
				no_akun='11',
				debet='".$debet2."',
				kredit='".$kredit2."'

				WHERE id != '".$_POST['id']."' and rec_group = '".$sel1['rec_group']."' and rec_module='12' and no_akun='11' ")
				
			   and 
			   
				database()->Query("UPDATE db_jurnalumum SET 
			
				tanggal='".$_POST['tanggal']."',
				uraian='".$_POST['uraian']."',
				no_akun='".$sel1['no_akun']."',
				debet='".$debet1."',
				kredit='".$kredit1."'

			WHERE id = '".$_POST['id']."' and rec_group = '".$sel1['rec_group']."' and rec_module='12' and no_akun !='11' and no_akun!='12' ")
			   	
			   
			   and 
			   
			 	database()->Query("UPDATE db_jurnalumum SET 
			
				tanggal='".$_POST['tanggal']."',
				uraian = '".$_POST['uraian']."',
				no_akun='12',
				debet='".($kredit1 - $debet2)."',
				kredit='0'

				WHERE id != '".$_POST['id']."' and rec_group = '".$sel1['rec_group']."' and rec_module='12' and no_akun='12' " )){
				echo piutang();
				echo "<success/>";

			}else{

				echo "<failed/>";

			}
			

		}else{
			$saldo = $_POST['debet'];
			
			
				$command = "
						(
										'".$_POST['tanggal']."',
										'".$_POST['uraian']."',
										'12',
										'".($saldo - $_POST['dp'])."',
										'0',
										'".time()."',
										'12'
							),
						(
										'".$_POST['tanggal']."',
										'".$_POST['uraian']."',
										'11',
										'".$_POST['dp']."',
										'0',
										'".time()."',
										'12'
							),
							
						(
										'".$_POST['tanggal']."',
										'".$_POST['uraian']."',
										'".$nomor_akun['no_akun']."',
										'0',
										'".$saldo."',
										'".time()."',
										'12'
										
							)
							
							
							
							";
			
			
			$query = "insert into db_jurnalumum 
									(tanggal,uraian,no_akun,debet,kredit,rec_group,rec_module) 
							   values ".$command;
				
			if(database()->Query($query))
			{
				echo piutang();
				echo "<success/>";

			}else{

				echo "<failed/>";

			}
		}
	}

?>