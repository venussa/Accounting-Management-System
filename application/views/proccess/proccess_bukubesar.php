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
			
			if(database()->Query("UPDATE db_jurnalumum SET 
			
				tanggal='".$_POST['tanggal']."',
				uraian='".$_POST['uraian']."',
				no_akun='".$nomor_akun['no_akun']."',
				debet='".$_POST['debet']."',
				kredit='".$_POST['kredit']."'

				WHERE id='".$_POST['id']."'")
			  ){
				echo bukubesar($nomor_akun['no_akun']);
				echo "<success/>";

			}else{

				echo "<failed/>";

			}

		}else{
			
			$query = "insert into db_jurnalumum 
									(tanggal,uraian,no_akun,debet,kredit) 
							   values 
									(
										'".$_POST['tanggal']."',
										'".$_POST['uraian']."',
										'".$nomor_akun['no_akun']."',
										'".$_POST['debet']."',
										'".$_POST['kredit']."'
									)
							 ";
				
			if(database()->Query($query))
			{
				echo bukubesar($nomor_akun['no_akun']);
				echo "<success/>";

			}else{

				echo "<failed/>";

			}
		}
	}

?>