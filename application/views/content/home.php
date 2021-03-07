<?php
$setting = database()->Query("SELECT * FROM db_setting");
	while($show_set = $setting->Fetch()){
		$set[$show_set['title']] = $show_set['conf'];
	}

	?>
	<div class="col-md-10  col-md-offset-2" style="margin-top:70px;">
	<div class="panel panel-info" style="margin-left:0px;border:1px #ddd solid;" >
	
		<div class="panel-body" style="padding:10px;">
			
			<h3 style="margin-top: 5px;color:#77a809;text-shadow: 0 0 1px rgba(0,0,0,0.3);border-bottom: 2px #ddd dashed;padding-bottom: 10px;">
						
					<p style="margin-top: 10px;">
					Selamat Datang di Aplikasi Akuntansi
					<p style="font-size: 11px;color:#666;">System Informasi Akuntansi Berbasis Web</p>
				</p>
		</h3>
			 
			<div style="">
				<table width="100%">
					
					<tr>
					
						
						<th style="padding:5px;text-align:center;width:25%">
							<a style="text-decoration:none;color:#666;" class="<?=$pjax_class?>" data-pjax='<?php echo pjax_load_data()->data_pjax?>' href="<?=HomeUrl()."/?module=jurnalumum".url?>">
							<div style="background: transparent;border:transparent;border:2px #ddd solid;border-radius: 5px 5px 0 0;border-bottom: transparent;background: #f8f8f8">
								<img src="<?=projectUrl()."/assets/img/0-2.png"?>" width="100" height="90">
							</div>
								<div style="border-radius: 0 0 5px 5px">
								<p style="font-size:17px;margin-top:8px;">Jurnal Umum</p>
							</div>
							</a>
						</th>
						
						<th style="padding:5px;text-align:center;width:25%">
							<a style="text-decoration:none;color:#666;" class="<?=$pjax_class?>" data-pjax='<?php echo pjax_load_data()->data_pjax?>' href="<?=HomeUrl()."/?module=bukubesar".url?>">
							<div style="background: transparent;border:transparent;border:2px #ddd solid;border-radius: 5px 5px 0 0;border-bottom: transparent;background: #f8f8f8">
								<img src="<?=projectUrl()."/assets/img/0-3.png"?>" width="100" height="90">
							</div>
								<div style="border-radius: 0 0 5px 5px">
								<p style="font-size:17px;margin-top:8px;">Buku Besar</p>
							</div>
							</a>
						</th>
						
						<th style="padding:5px;text-align:center;width:25%">
							<a style="text-decoration:none;color:#666;" class="<?=$pjax_class?>" data-pjax='<?php echo pjax_load_data()->data_pjax?>' href="<?=HomeUrl()."/?module=neraca".url?>">
							<div style="background: transparent;border:transparent;border:2px #ddd solid;border-radius: 5px 5px 0 0;border-bottom: transparent;background: #f8f8f8">
								<img src="<?=projectUrl()."/assets/img/0-9.png"?>" width="100" height="90">
							</div>
								<div style="border-radius: 0 0 5px 5px">
								<p style="font-size:17px;margin-top:8px;">Neraca</p>
							</div>
							</a>
						</th>

						<th style="padding:5px;text-align:center;width:25%">
							<a style="text-decoration:none;color:#666;" class="<?=$pjax_class?>" data-pjax='<?php echo pjax_load_data()->data_pjax?>' href="<?=HomeUrl()."/?module=rugilaba".url?>">
							<div style="background: transparent;border:transparent;border:2px #ddd solid;border-radius: 5px 5px 0 0;border-bottom: transparent;background: #f8f8f8">
								<img src="<?=projectUrl()."/assets/img/0-10.png"?>" width="100" height="90">
							</div>
								<div style="border-radius: 0 0 5px 5px">
								<p style="font-size:17px;margin-top:8px;">Rugi Laba</p>
							</div>
							</a>
						</th>
					</tr>
				
				</table>
			</div>
			<hr/>
			<h1 style="color:#77a809;text-shadow: 0 0 1px rgba(0,0,0,0.3);border-bottom: 1px #ddd dsolid;padding-bottom: 10px;font-size: 19px;">Informasi Usaha</h1>
			<p style="text-shadow: 0 0 1px rgba(0,0,0,0.1);">
				<table width="100%">
					<tr>
						<td style="width: 200px;border:transparent;"><img src="<?php echo projectUrl()."/assets/img/gedung.png"?>" width="150" style="float:left;margin-top: -10px;margin-right:20px"></td>
						<td valign="top" style="border:transparent;">
							<div style="background: #f7f7f7;padding:15px;border-radius: 5px;">
							<table width="100%">
							<tr>
								<td style="border:transparent;font-size: 16px;text-shadow: 0 0 1px rgba(0,0,0,0.2);">Nama Perusahaan</td>
								<td style="border:transparent;font-size: 16px;text-shadow: 0 0 1px rgba(0,0,0,0.2);">: <?php echo $set['nama_usaha']?></td>
							</tr>
							<tr>
								<td style="border:transparent;font-size: 16px;text-shadow: 0 0 1px rgba(0,0,0,0.2);">Alamat</td>
								<td style="border:transparent;font-size: 16px;text-shadow: 0 0 1px rgba(0,0,0,0.2);">: <?php echo $set['alamat']?></td>
							</tr>
							<tr>
								<td style="border:transparent;font-size: 16px;text-shadow: 0 0 1px rgba(0,0,0,0.2);">E-Mail</td>
								<td style="border:transparent;font-size: 16px;text-shadow: 0 0 1px rgba(0,0,0,0.2);">: <?php echo $set['email']?></td>
							</tr>
							<tr>
								<td style="border:transparent;font-size: 16px;text-shadow: 0 0 1px rgba(0,0,0,0.2);">No. Telephone</td>
								<td style="border:transparent;font-size: 16px;text-shadow: 0 0 1px rgba(0,0,0,0.2);">: <?php echo $set['tlp']?></td>
							</tr>
							
							</table>
						</div>
						</td>
					</tr>
				</table>
				<hr/>
				<span style="font-size: 18px;">Aplikasi akuntansi ini dibuat dengan tujuan untuk memenuhi tanggung jawab akan tugas matakuliah <b>Sistem Informasi Akuntansi dan Keuangan</b>. Yang mana module module dan sistem yang ada didalamnya berdasarkan semua yang telah kami pelajari selama mengikuti perkuliahan 1 semester. </span><hr/>
				<span style="text-align: center;font-size: 13px;">2019 &copy; Sistem Informasi Akuntasi & Keuangan</span>
				<br>
				
				
			</p>
		</div>
	</div>		
</div>