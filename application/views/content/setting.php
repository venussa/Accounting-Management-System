<?php 
	$setting = database()->Query("SELECT * FROM db_setting");
	while($show_set = $setting->Fetch()){
		$set[$show_set['title']] = $show_set['conf'];
	}

?>
<div class="col-md-10  col-md-offset-2" style="margin-top:70px;">
	<div class="panel " style="margin-left:-20px">
	
		<div class="panel-body" style="padding:5px;">
				<h1 style="font-size: 20px;padding:10px;padding-bottom: 20px;border-bottom: 2px #ddd dashed;margin-top:0px;"><img src="<?=projectUrl()."/assets/img/setting.png"?>" width="30" height="30" style="position: absolute;margin-top: -5px;"> <div style="margin-left: 40px"> Pengaturan Dasar</div></h1>
		
			<form method="POST" action="<?php echo homeUrl()?>/data_proccess?save=true&hist=<?=base64_encode("?module=setting".url)?>">
			<div style="padding:5px;border-radius:5px;">
			
				<table width="100%" style="">
					<tr>
						<td style="border:transparent;width:200px;font-weight:600">Nama Perusahaan
						<p style="font-size:9px;margin-top:4px;color:#ccc;">* Nama Lengkap Perusahaan<br>Ex : Pt. Nutri Food Indonesia</p>
						</td>
						<td style="border:transparent"><input type="text" name="nama_usaha" class="form-control" value="<?=$set['nama_usaha']?>"/></td>
					</tr>
					<tr>
						<td style="border:transparent;width:200px;font-weight:600">Alamat
						<p style="font-size:9px;margin-top:4px;color:#ccc;">* Alamat Lengkap Perusahaan</p>
						</td>
						<td style="border:transparent"><input type="text" name="alamat" class="form-control" value="<?=$set['alamat']?>"/></td>
					</tr>
					<tr>
						<td style="border:transparent;width:200px;font-weight:600">Bidang Usaha
						<p style="font-size:9px;margin-top:4px;color:#ccc;">* Jenius usaha Perusahaan Anda</p>
						</td>
						<td style="border:transparent"><input type="text" name="bidang_usaha" class="form-control" value="<?=$set['bidang_usaha']?>"/></td>
					</tr>
					<tr>
						<td style="border:transparent;width:200px;font-weight:600">E-Mail
						<p style="font-size:9px;margin-top:4px;color:#ccc;">* Email resmi perusahaan<br>Ex : Info@dikertas.com</p>
						</td>
						<td style="border:transparent"><input type="text" name="email" class="form-control" value="<?=$set['email']?>"/></td>
					</tr>
					<tr>
						<td style="border:transparent;width:200px;font-weight:600">No Telepone
						<p style="font-size:9px;margin-top:4px;color:#ccc;">* Nomor telepon perusahaan</p>
						</td>
						<td style="border:transparent"><input type="text" name="tlp" class="form-control" value="<?=$set['tlp']?>"/></td>
					</tr>
				</table>	
			
				</div>
				
				<div style="margin-top:20px;;padding:5px;">
			
				<table width="100%" style="">
					<tr>
						<td style="border:transparent;width:200px;font-weight:600">Nama Currency
						<p style="font-size:9px;margin-top:4px;color:#ccc;">* Ex : Indonesia Rupiah</p>
						</td>
						<td style="border:transparent"><input type="text" name="cur" class="form-control" value="<?=$set['cur']?>"/></td>
					</tr>
					<tr>
						<td style="border:transparent;width:200px;font-weight:600">Id Currency
						<p style="font-size:9px;margin-top:4px;color:#ccc;">* Ex : IDR</p>
						</td>
						<td style="border:transparent"><input type="text" name="cur_id" class="form-control" value="<?=$set['cur_id']?>"/></td>
					</tr>
					<tr>
						<td style="border:transparent;width:200px;font-weight:600">Simbol
						<p style="font-size:9px;margin-top:4px;color:#ccc;">* Ex : Rp/p>
						</td>
						<td style="border:transparent"><input type="text" name="symbol" class="form-control" value="<?=$set['symbol']?>"/></td>
					</tr>
				</table>	
				
				</div>
				<hr style="border-top:1px #ddd solid" />
				<center style="margin-top:20px;">
				<button type="submit" class="btn btn-info btn-filter" style="background: #77a809;border:1px #666 solid;text-align:center;width:250px;"><b>Simpan</b></button>
					</center>
				</form>
		</div>
	</div>		
</div>