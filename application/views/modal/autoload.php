<?php
	
	if(isset($_POST['modal_type'])){
		
		$path = DirSeparator(projectDir()."/modal/modal_".$_POST['modal_type'].".php");
		
		if(file_exists($path) == true){
			
			require_once($path);
			
		}
		
	}