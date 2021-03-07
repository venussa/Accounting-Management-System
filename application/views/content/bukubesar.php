<div class="col-md-10  col-md-offset-2" style="margin-top:70px;">
	<div class="panel " style="margin-left:0px;border:1px #ddd solid;">

		<div class="panel-body" style="padding:5px;">

			<h1 style="font-size: 20px;padding:10px;padding-bottom: 20px;border-bottom: 2px #ddd dashed;margin-top:0px;"><img src="<?=projectUrl()."/assets/img/0-3.png"?>" width="30" height="30" style="position: absolute;margin-top: -5px;"> <div style="margin-left: 40px">
			<?php
			if(isset($_GET['akun'])){
				$akun = database()->Query("SELECT * FROM db_noakun WHERE no_akun = '".$_GET['akun']."' ");
				$show = $akun->Fetch();
				$nokun = $show['nama_akun'];
			}else{
				$nokun = 'Kas';
			}
			?>
			
			<div onClick="show_selectbox()" style="cursor:pointer;">
				<span>Laporan Buku Besar : <?php echo $nokun ?></span>			
			<span class="fas fa-caret-down"></span>
			</div>
			
			<div class="select-box" id="select-box" style="display:none;font-size: 15px;">
				<ul style="list-style-type:none;margin-left:-40px;">
				<?php	
				$akun_list = database()->bindQuery("SELECT * FROM db_noakun ORDER BY no_akun ASC");
				
			   if($akun_list){
			   	foreach($akun_list as $key => $val){
					$check = database()->Query("SELECT id FROM db_jurnalumum WHERE no_akun='".$val->no_akun."' ");
					if($check->rowCount() !== 0){
						$notif = " <i class='fas fa-check-circle' style='float:right;color:#77a809;margin-top:3px;' title='data tidak kosong'></i>";
					}else{
						$notif = null;
					}
					
					echo "<a class='".pjax_load_data()->class."' data-pjax='".pjax_load_data()->data_pjax."' style='color:#666;text-decoration:none;width:100%;background:#09f;' href='".HomeUrl()."/?module=bukubesar".url."&akun=".$val->no_akun."'>
					<div class='select'>".$val->nama_akun.$notif."</div></a>";
				}
			   }
				?>
					</ul>
			</div>
		</div>
	</h1>
			
				<span id="result">
					<?php echo bukubesar() ?>
				</span>
				
		</div>
	</div>		
</div>