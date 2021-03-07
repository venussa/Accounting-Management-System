<?php 
require_once(projectDir()."/header.php");
require_once(projectDir()."/menu.php");
if(!isset($_GET['module'])) header("location:".HomeUrl()."?module=home".url);

else{
	require_once(projectDir()."/content/".$_GET['module'].".php");
}
require_once(projectDir()."/footer.php");	
?>