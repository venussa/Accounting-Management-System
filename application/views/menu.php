<?php



?>

<body style="background:#f5f5f5">
		
		<div class="navbar-fixed-top">
			<div class="panel " style="box-shadow: rgba(0, 0, 0, 0.13) 0px 2px 3px, rgba(0, 0, 0, 0.1) 1px 2px 2px, rgba(0, 0, 0, 0.05) -1px -2px 2px;margin-top:5px;border-radius: 0px;">
				<div class="panel-heading" style="background:#fff;"><a class="<?=$pjax_class?>" style="text-decoration:none;color:#77a809;text-shadow: 0 0 1px rgba(0,0,0,0.5);" data-pjax='<?php echo pjax_load_data()->data_pjax?>' href="<?=HomeUrl()."/?module=home".url?>">
					<h3 style="margin-top: 5px;">
						<img src="<?php echo projectUrl()."/assets/img/gundar.png"?>" width="65" style="float:left;margin-top: -10px;margin-right:20px">
					
					<p style="margin-top: 10px;">
					Aplikasi Akuntansi
					<p style="font-size: 11px;color:#666;">System Informasi Akuntansi Berbasis Web</p>
				</p>
				</h3></a>
					<div style="float:right;margin-top:-45px;">
					<a style="font-size:18px;margin-top:-30px;text-decoration:none;color:#666;text-shadow: 0 0 0.5px rgba(0,0,0,0.3);margin-right:20px;" href="<?=HomeUrl()."/?module=home".url?>" class="<?=$pjax_class?>" data-pjax='<?php echo pjax_load_data()->data_pjax?>'><i class="fas fa-home"></i> Home</a>
					<a style="font-size:18px;margin-top:-30px;text-decoration:none;color:#666;text-shadow: 0 0 0.5px rgba(0,0,0,0.3);margin-right:20px;" href="<?=HomeUrl()."/?module=setting".url?>" class="<?=$pjax_class?>" data-pjax='<?php echo pjax_load_data()->data_pjax?>'>
						<i class="fas fa-cogs"></i> Pengaturan</a>
					
					<a style="font-size:18px;margin-top:-30px;text-decoration:none;color:#666;text-shadow: 0 0 0.5px rgba(0,0,0,0.3);" href="<?php echo HomeUrl()?>/data_proccess?log=true" ><i class="fas fa-sign-out-alt"></i> Logout</a>
				</div>
				</div>
			</div>
		</div>
<div class="web-container" style="margin-top: 40px">
			<div id="web-content">
			<div class="row navbar-fixed-top" style="left:15px;z-index: 0;">
		<div class="col-md-2 " style="margin-top:110px;">
			<div class="panel" style="border-radius:5px;float:left;border-radius: 0px;border:1px #77a809 solid;">
				<div class="myButton" style="border-radius: 0px;padding-left: 5px" onChange="return filter_date(this)"><i class="fas fa-clock"></i> Filter Waktu</div>
				<div class="panel-body">
			<select name="bulan" class="form-control" style="width:49%;float:left" id="bulan1" onChange="return filter_date(this)">
				<?php
					
					if(isset($_GET['bulan']))
					echo "<option>".$_GET['bulan']."</option>";
					else
					echo "<option>".date("m")."</option>";

					for($i = 1; $i<=12; $i++){
						if(monthConvert($i) !== bulan)
						echo "<option>".monthConvert($i)."</option>";
					}
				?>
			</select>
			<select name="tahun" class="form-control" style="width:49%;float:right" id="tahun1" onChange="return filter_date(this)">
				<?php 
					echo "<option>".tahun."</option>";
					for($i = (date("Y") - 3); $i < 2025 ;$i++){
						if($i !== tahun)
						echo "<option>".$i."</option>";
					}
				?>
			</select>
					<a href="<?php echo documentUrl()?>" data="<?php echo documentUrl()?>" style="width:100%;margin-top:10px;background: #77a809;border:1px #77a809 solid;" class="btn btn-info btn-filter" ><b>Terapkan</b></a>
			</div>
				</div>
			<?php 
						if(!isset($_SESSION['menu']) or $_SESSION['menu'] == 1) {
							$style = "style='margin-top:0px'";
							$icon = "fa-chevron-up";
						
						}else{
							$style = "style='margin-top:-225px'";
							$icon = "fa-chevron-down";
						}
			?>
			<div style="height: 60px"></div>
			<div class="panel" style="margin-top:100px;border-radius: 0px;border:1px #77a809 solid;">
				
				<div class="myButton" style="cursor:pointer;border-radius: 0px;margin-top:-6px;padding-left: 5px" onClick="collapse(1)"><i class="fas fa-bars"></i> Module<i id="btn-1" class="fa <?php echo $icon?>" style="float:right;margin-top:4px;cursor:pointer;"></i></div>
				
				<div style="overflow:hidden;text-shadow: 0 0 0.3px rgba(0,0,0,0.5);">
					<ul class="list-group" id="list-1" <?php echo $style?>>
						
							
								<a style="text-decoration:none;color:#666;" class="<?=$pjax_class?>" data-pjax='<?php echo pjax_load_data()->data_pjax?>' href="<?=HomeUrl()."/?module=noakun".url?>">
								<li class="list-group-item <?php active_menu("noakun")?>" style="border-radius: 0px;">
								<img src="<?=projectUrl()."/assets/img/0-1.png"?>" width="20" height="20">  Nomor Akun
								</li>
								</a>
							
							<a style="text-decoration:none;color:#666;" class="<?=$pjax_class?>" data-pjax='<?php echo pjax_load_data()->data_pjax?>' href="<?=HomeUrl()."/?module=hutang".url?>">
								<li class="list-group-item <?php active_menu("hutang")?>" style="border-radius: 0px;">
								<img src="<?=projectUrl()."/assets/img/0-5.png"?>" width="20" height="20">  Hutang
								</li>
								</a>
						<a style="text-decoration:none;color:#666;" class="<?=$pjax_class?>" data-pjax='<?php echo pjax_load_data()->data_pjax?>' href="<?=HomeUrl()."/?module=piutang".url?>">
								<li class="list-group-item <?php active_menu("piutang")?>" style="border-radius: 0px;">
								<img src="<?=projectUrl()."/assets/img/0-6.png"?>" width="20" height="20">  Piutang
								</li>
								</a>
							
								<a style="text-decoration:none;color:#666;" class="<?=$pjax_class?>" data-pjax='<?php echo pjax_load_data()->data_pjax?>' href="<?=HomeUrl()."/?module=saldoawal".url?>">
								<li class="list-group-item <?php active_menu("saldoawal")?>" style="border-radius: 0px;">
								<img src="<?=projectUrl()."/assets/img/0-7.png"?>" style="margin-top:-5px;" width="20" height="20">  Modal
								</li>
								</a>
							
						
							
								<a style="text-decoration:none;color:#666;" class="<?=$pjax_class?>" data-pjax='<?php echo pjax_load_data()->data_pjax?>' href="<?=HomeUrl()."/?module=jurnalumum".url?>">
								<li class="list-group-item <?php active_menu("jurnalumum")?>" style="border-radius: 0px;">
								<img src="<?=projectUrl()."/assets/img/0-2.png"?>" style="margin-top:-2px;" width="20" height="20">  Jurnal Umum
								</li>
								</a>
							
						
							
								<a style="text-decoration:none;color:#666;" class="<?=$pjax_class?>" data-pjax='<?php echo pjax_load_data()->data_pjax?>' href="<?=HomeUrl()."/?module=jurnalpenyesuaian".url?>">
								<li class="list-group-item <?php active_menu("jurnalpenyesuaian")?>" style="border-radius: 0px;">
								<img src="<?=projectUrl()."/assets/img/0-4.png"?>" style="margin-top:-5px;" width="20" height="20">  Jurnal Penyesuaian
								</li>
								</a>
							
					</ul>
				</div>
			</div>
			
			<?php 
						if(isset($_SESSION['menu']) and $_SESSION['menu'] == 2) {
							$style = "style='margin-top:0px'";
							$icon = "fa-chevron-up";
						}else{
							$style = "style='margin-top:-185px'";
							$icon = "fa-chevron-down";
						}
			?>
			<div class="panel" style="margin-top:-10px;border-radius: 0px;border:1px #77a809 solid;">
				<div class="myButton" onClick="collapse(2)" style="cursor:pointer;border-radius: 0px;padding-left: 5px"><i class="fas fa-print"></i> Laporan <i id="btn-2" class="fa <?php echo $icon?>" style="float:right;margin-top:4px;cursor:pointer;"></i></div>
				<div style="overflow:hidden;text-shadow: 0 0 0.3px rgba(0,0,0,0.5);">
					<ul class="list-group" id="list-2" <?php echo $style?>>
					
						
						<a style="text-decoration:none;color:#666;" class="<?=$pjax_class?>" data-pjax='<?php echo pjax_load_data()->data_pjax?>' href="<?=HomeUrl()."/?module=bukubesar".url?>">
								<li class="list-group-item <?php active_menu("bukubesar")?>" style="border-radius: 0px;">
									<img src="<?=projectUrl()."/assets/img/0-3.png"?>" style="margin-top:-5px;" width="20" height="20"> Buku Besar
								</li>
								</a>
						
						<a style="text-decoration:none;color:#666;" class="<?=$pjax_class?>" data-pjax='<?php echo pjax_load_data()->data_pjax?>' href="<?=HomeUrl()."/?module=neracalajur".url?>">
								<li class="list-group-item <?php active_menu("neracalajur")?>" style="border-radius: 0px;">
									<img src="<?=projectUrl()."/assets/img/0-9.png"?>" style="margin-top:-5px;" width="20" height="20"> Neraca Lajur
								</li>
								</a>
						
						<a style="text-decoration:none;color:#666;" class="<?=$pjax_class?>" data-pjax='<?php echo pjax_load_data()->data_pjax?>' href="<?=HomeUrl()."/?module=rugilaba".url?>">
								<li class="list-group-item <?php active_menu("rugilaba")?>" style="border-radius: 0px;">
									<img src="<?=projectUrl()."/assets/img/0-10.png"?>" style="margin-top:-5px;" width="20" height="20"> Rugi Laba
								</li>
								</a>
						<a style="text-decoration:none;color:#666;" class="<?=$pjax_class?>" data-pjax='<?php echo pjax_load_data()->data_pjax?>' href="<?=HomeUrl()."/?module=perubahanmodal".url?>">
								<li class="list-group-item <?php active_menu("perubahanmodal")?>" style="border-radius: 0px;">
									<img src="<?=projectUrl()."/assets/img/0-11.png"?>" style="margin-top:-5px;" width="20" height="20"> Perubahan Modal
								</li>
								</a>
						<a style="text-decoration:none;color:#666;" class="<?=$pjax_class?>" data-pjax='<?php echo pjax_load_data()->data_pjax?>' href="<?=HomeUrl()."/?module=neraca".url?>">
								<li class="list-group-item <?php active_menu("neraca")?>" style="border-radius: 0px;">
									<img src="<?=projectUrl()."/assets/img/0-8.png"?>" style="margin-top:-5px;" width="20" height="17"> Neraca
								</li>
								</a>
					</ul>
				</div>
			</div>
		</div>
	</div>
		