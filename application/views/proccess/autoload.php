<?php
	
	if(isset($_POST['proccess_type'])){
		
		$path = DirSeparator(projectDir()."/proccess/proccess_".$_POST['proccess_type'].".php");
		
		if(file_exists($path) == true){
			
			require_once($path);
			
		}
		
	}

	if(isset($_POST['type'])){
		$command = null;
		$alt = null;
		$select = database()->Query("SELECT * FROM db_".$_POST['type']." WHERE id='".$_POST['id']."'")->Fetch();
		if(isset($select['rec_group']) and $select['rec_group'] !== 0){
			$command .= "rec_group = '".$select['rec_group']."' ";
			$alt .= $select['no_akun'];
		}else{
			$command .= "id='".$_POST['id']."' ";
		}
		
		
		if(database()->Query("DELETE FROM db_".$_POST['type']." WHERE ".$command)){
			if(isset($select['js']) and $select['js'] == "1")
			echo jurnalpenyesuaian($alt);

			else  if(isset($select['rec_module']) and $select['rec_module'] == "21")
			echo hutang();
			else if($select['no_akun'] == "21")
			echo hutang();
			else if($select['no_akun'] == "12")
			echo piutang();
			else if($select['no_akun'] == "31")
			echo saldoawal();
			else echo $_POST['type']($alt);
			echo "<success/>";
		}else{
			echo "<failed/>";
		}
		
	}

if(isset($_POST['menu'])){
	switch($_POST['menu']){
		case 1:
			$_SESSION['menu'] = 1;
		break;
			
			
		case 2 : 
			$_SESSION['menu'] = 2;		
		break;
	}
}

if(isset($_GET['save'])){
	
	$data = database()->Query("SELECT * FROM db_setting ORDER BY id ASC");
	while($show = $data->Fetch()){
		$cols[] = $show['title'];
	}
	
	foreach($cols as $key => $val){	
		database()->Query("UPDATE db_setting SET conf = '".$_POST[$val]."' WHERE title='".$val."' ");
	}
	
	echo "<script>window.location='".homeUrl()."/".base64_decode($_GET['hist'])."'; </script>";
	
}

if(isset($_GET['log'])){
	session_destroy();
	header("location:".HomeUrl()."/login");
}