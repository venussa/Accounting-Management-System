<?php

	$data = database()->Query("SELECT * FROM db_noakun WHERE no_akun = '".$_POST['noakun']."' ");
	$find_row = $data->rowCount();
	
	if(!isset($_POST['edit']) and $find_row !== 0){
		echo "<failed/>";
		exit;
	}
	
	if(!empty(trim($_POST['noakun'])) and !empty(trim($_POST['namaakun']))){
		
		if(isset($_POST['edit'])){
			
			if(database()->Query("UPDATE db_noakun SET 
			
				no_akun='".$_POST['noakun']."',
				nama_akun='".$_POST['namaakun']."'

				WHERE id='".$_POST['id']."'")
			  ){
				echo noakun();
				echo "<success/>";

			}else{

				echo "<failed/>";

			}

		}else{
			if(database()->Query("insert into db_noakun 
									(no_akun,nama_akun) 
							   values 
									('".$_POST['noakun']."','".$_POST['namaakun']."')
							 "))
			{
				echo noakun();
				echo "<success/>";

			}else{

				echo "<failed/>";

			}
		}
	}

?>