<?php
if(!empty($_POST['act'])){ 
	$data = database()->Query("SELECT * FROM db_noakun WHERE id='".$_POST['id']."' ");
	$show = $data->fetch();
		
		$noakun = $show['no_akun'];
		$namaakun = $show['nama_akun'];
		$stats = "-edit";
}else{
		$noakun = null;
		$namaakun = null;
		$stats = null;
}
if(isset($_GET['page'])) $pg = "&page=".$_GET['page'];
else $pg = "&page=1";


?>
<form method="POST" onSubmit="return modal_send(this)" action="data_proccess?pjax<?=url.$pg?>">
	<div id="data-saldo">
		<label>Nomor Akun</label>
		<input type="text" class="form-control" name="noakun" value="<?=$noakun?>">
		<label>Nama Akun</label>
		<input type="text" class="form-control" name="namaakun" value="<?=$namaakun?>">
		
		<input name="proccess_type" value="noakun" style="display:none;"/>
		<?php
		if(!empty($stats)){ ?>
		<input name="id" value="<?=$show['id']?>" style="display:none;"/>
		<input name="edit" value="edit" style="display:none;"/>
		<?php }	?>
	</div>
	<input type="submit" style="display:none" id="submit-data">
</form>