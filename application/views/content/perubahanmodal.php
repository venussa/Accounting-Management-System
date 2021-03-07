<div class="col-md-10 col-md-offset-2" style="margin-top:70px;">
	<div class="panel" style="margin-left:0p;border:1px #ddd solid;">
		
		
		<div class="panel-body" style="padding:5px;background:#fff;padding:5px">
			<h1 style="font-size: 20px;padding:10px;padding-bottom: 20px;border-bottom: 2px #ddd dashed;margin-top:0px;"><img src="<?=projectUrl()."/assets/img/0-11.png"?>" width="30" height="30" style="position: absolute;margin-top: -5px;"> <div style="margin-left: 40px">Laporan Perubahan Modal</div></h1>
		<div style="padding: 5px;">
			<div style="margin-bottom:10px;text-align:left">
				<p style="font-size: 13px;"><i>* Periode : <?php
					$a_date = tanggal;
					$date = date("Y-m-t", strtotime($a_date));
					$date = explode("-",$date);
					$tanggal = $date[2]." ".str_replace("0","",monthConvert($date[1]))." ".$date[0];
					echo $tanggal;
					?></i><br></p>
			</div>
			<div style="text-align:center;padding-top:10px">
				
				<table width="100%" border="0">

					<tr style="border:1px #ddd solid">
				<td style="padding:10px;border:transparent;background: #ccdbaa;font-weight:600">Uraian</td>
				<td colspan="2" style="padding:10px;border:transparent;border-left:1px #ddd solid;background: #ccdbaa;font-weight:600;text-align: center;">Nominal</td>
				
			</tr>
					<?php if(hitung_laba() !== 0){ ?>
			<tr style="border:1px #ddd solid">
								<td style="padding:10px;width:705px;border:transparent">Modal Per 1 <?=str_replace("0","",monthConvert($date[1]))." ".tahun?></td>	
								<td style="padding:10px;border:transparent;border-left:1px #ddd solid;font-weight:400;width:295px;text-align:center"><?php
									$modal = database()->Query("SELECT * FROM db_jurnalumum WHERE no_akun='31' and (tanggal like '%".sorting."%')");
									$f_modal = 0;
									while($show = $modal->Fetch()){
										$f_modal += $show['kredit'];
									}
									if($f_modal !== 0){
										echo currency." ".number_format($f_modal);
									}
									?></td>	
			</tr>
			
			<tr style="border:1px #ddd solid">
								<td style="padding:10px;width:705px;border:transparent">Laba</td>	
								<td style="padding:10px;border:transparent;border-left:1px #ddd solid;font-weight:400;width:295px;text-align:center"><?php
									if(hitung_laba() > 0 ){
										echo currency." ".number_format(hitung_laba());
									}else{
										echo "( ".str_replace("-","",currency." ".number_format(hitung_laba()))." )";
									}
									?></td>	
			</tr>
					
			<tr style="border:1px #ddd solid">
								<td style="padding:10px;width:705px;border:transparent">Prive</td>	
								<td style="padding:10px;border:transparent;border-left:1px #ddd solid;font-weight:400;width:295px;text-align:center"><?php
									$modal = database()->Query("SELECT * FROM db_jurnalumum WHERE no_akun='32' and (tanggal like '%".sorting."%')");
									$prive = 0;
									while($shows = $modal->Fetch()){
										$prive += $shows['debet'];
									}
									if($prive !== 0){
										echo "( ".currency." ".number_format($prive)." )";
									}
									?></td>	
			</tr>
					<tr style="border:1px #ddd solid;background:#f8f8f8">
								<td style="padding:10px;width:705px;border:transparent">Modal Per <?php
					$a_date = tanggal;
					$date = date("Y-m-t", strtotime($a_date));
					$date = explode("-",$date);
					$tanggal = $date[2]." ".str_replace("0","",monthConvert($date[1]))." ".$date[0];
					echo $tanggal;
					?></td>	
								<td style="padding:10px;border:transparent;border-left:1px #ddd solid;font-weight:400;width:295px;text-align:center"><?= perubahan_modal()?> </td>	
							</tr>
					<?php  }else{ ?>
					<tr style="border-bottom:1px #ddd solid;">
							<td style="text-align : center;padding:30px" colspan="4">Tidak Ada Data</td>
						</tr>
						
					<?php } ?>
			</table>
				<br>
				<br>
				<br>
				
			</div>
			
			</div>
			
				<span id="result">
		
				</span>
					
		</div>
	</div>		
</div>