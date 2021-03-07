<?php
if(!empty($_POST['act'])){ 
	$data = database()->Query("SELECT * FROM db_jurnalumum WHERE id='".$_POST['id']."' ");
	$show = $data->fetch();
		
		$nomor_akun = database()->Query("SELECT * FROM db_noakun WHERE no_akun='".$show['no_akun']."' ");
		$nomor_akun = $nomor_akun->fetch();
	
		$tanggal = $show['tanggal'];
		$uraian = $show['uraian'];;
		$noakun = $nomor_akun['nama_akun'];
		$debet = $show['debet'];;
		$kredit = $show['kredit'];;
		$stats = "-edit";
}else{
		$tanggal = null;
		$uraian = null;
		$noakun = null;
		$debet = null;
		$kredit = null;
		$stats = null;
}
if(isset($_GET['page'])) $pg = "&page=".$_GET['page'];
else $pg = "&page=1";


?>
<form method="POST" onSubmit="return modal_send(this)" action="data_proccess?pjax<?=url.$pg?>">
	<div id="data-saldo">
		<label>Tanggal</label>
		<input type="text" class="form-control" name="tanggal" id="date-picker" value="<?=$tanggal?>" readonly>
		<label>Uraian</label>
		<input type="text" class="form-control" name="uraian" value="<?=$uraian?>">
		<label>Nomor Akun</label>
		<select class="form-control" name="noakun">
			<?php
				if(!empty($noakun)){
					echo "<option>".$noakun."</option>";
				}
			   
				$akun = database()->bindQuery("SELECT * FROM db_noakun ORDER BY no_akun ASC");
			   	
			   if($akun){
			   	foreach($akun as $key => $val){
					echo "<option>".$val->nama_akun."</option>";
				}
			   }
			   
	
			?>
		</select>
		
		<div class="row">
		<div class="col-md-6">
		<label>Debet</label>
		<input type="text" class="form-control" name="debet" value="<?=$debet?>">
		</div>
			
		<div class="col-md-6">
		<label>Kredit</label>
		<input type="text" class="form-control" name="kredit" value="<?=$kredit?>">
		</div>
		</div>
		
		<input name="proccess_type" value="bukubesar" style="display:none;"/>
		<?php
		if(!empty($stats)){ ?>
		<input name="id" value="<?=$show['id']?>" style="display:none;"/>
		<input name="edit" value="edit" style="display:none;"/>
		<?php }	?>
	</div>
	<input type="submit" style="display:none" id="submit-data">
</form>
<script>date_picker();</script>