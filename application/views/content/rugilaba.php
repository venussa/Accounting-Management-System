<div class="col-md-10 col-md-offset-2" style="margin-top:70px;">
	<div class="panel " style="margin-left:0px;border:1px #ddd solid;">
		
		
		<div class="panel-body" style="padding:5px;background:#fff;padding:5px">
			<h1 style="font-size: 20px;padding:10px;padding-bottom: 20px;border-bottom: 2px #ddd dashed;margin-top:0px;"><img src="<?=projectUrl()."/assets/img/0-10.png"?>" width="30" height="30" style="position: absolute;margin-top: -5px;"> <div style="margin-left: 40px">Laporan Rugi Laba</div></h1>
		<div style="padding: 5px;">
			<div style="text-align:left;margin-bottom: 10px;">
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
					<td style="padding:10px;;border:transparent;background: #ccdbaa;font-weight:600">N/A</td>
				<td style="padding:10px;border:transparent;background: #ccdbaa;font-weight:600">Uraian</td>
				<td colspan="2" style="padding:10px;border:transparent;border-left:1px #ddd solid;background: #ccdbaa;font-weight:600;text-align: center;">Nominal</td>
				
			</tr>
				<?php
					$beban = database()->bindQuery("SELECT * FROM db_noakun WHERE no_akun >= 41 ");
					$new_saldo = 0;
					foreach($beban as $key => $val){
						$check = database()->Query("SELECT id FROM db_jurnalumum WHERE no_akun='".$val->no_akun."' and (tanggal like '%".sorting."%') ");
						
						if($check->rowCount() !== 0){
						
							$saldo_laba = neracasaldo($val->no_akun,"all");
							
							if($saldo_laba['ori_kre'] == 0){
									$salt = $saldo_laba['ori_deb'];
								}else{
									$salt = $saldo_laba['ori_kre'];
								}
							
							if($val->no_akun !== '41'){
								$saldo_kiri = currency." ".number_format(str_replace("-","",$salt));
								$saldo_kanan = "";
							}else{
								
								$saldo_kiri = "";
								$saldo_kanan = currency." ".number_format(str_replace("-","",$salt));
							}
							
							if($val->no_akun > 41){
								$old_saldo = $new_saldo + $saldo_laba['ori_deb'];
								$saldo = $old_saldo + $saldo_laba['ori_kre'];
								$new_saldo = $saldo;
							}else{
								$pendapatan = $salt - ($salt * 2);
							}
							
							if($key == 0) $border = "border-top:1px #ddd solid;";
							else if($key == (count($beban) -1) ) $bordir = "border-bottom:1px #ddd solid;";
							else $border = "";
							
							if($key == 0 and (!empty($saldo_kanan)) )
							echo '<tr style="'.$border.'">
								<td style="padding:10px;width:50px;border:transparent;border-left:1px #ddd solid;border-right:1px #ddd solid;">'.$val->no_akun.'</td>	
								<td style="padding:10px;width:200px;border:transparent">'.$val->nama_akun.'</td>	
								<td style="padding:10px;border:transparent;border-left:1px #ddd solid;300px;text-align:center">'.$saldo_kiri.'</td>	
								<td style="padding:10px;border:transparent;border-left:1px #ddd solid;border-right:1px #ddd solid;300px;text-align:center">'.$saldo_kanan.'</td>	
							</tr>';
							
							if($key !== 0 and (!empty($saldo_kiri)) )
							echo '<tr style="'.$border.'">
								<td style="padding:10px;width:50px;border:transparent;border-left:1px #ddd solid;border-right:1px #ddd solid;">'.$val->no_akun.'</td>	
								<td style="padding:10px;width:200px;border:transparent">'.$val->nama_akun.'</td>	
								<td style="padding:10px;border:transparent;border-left:1px #ddd solid;300px;text-align:center">'.$saldo_kiri.'</td>	
								<td style="padding:10px;border:transparent;border-left:1px #ddd solid;border-right:1px #ddd solid;300px;text-align:center">'.$saldo_kanan.'</td>	
							</tr>';
						}
					}
					
					$laba = currency." ".number_format($new_saldo);
					if($new_saldo !== 0)
					echo '<tr style="border:1px #ddd solid;background:#f8f8f8">
								<td style="padding:10px;width:50px;border:transparent"></td>	
								<td style="padding:10px;width:200px;border:transparent"></td>	
								<td style="padding:10px;border:transparent;;font-weight:400;width:300px;text-align:center"></td>	
								<td style="padding:10px;border:transparent;border-left:1px #ddd solid;font-weight:400;width:300px;text-align:center">'.$laba.'</td>	
							</tr>';
					
					if(!isset($pendapatan)) $pendapatan = 0;
					if(($pendapatan - $new_saldo) < 0){
						
						$laba = "( ".str_replace("-","",currency." ".number_format($pendapatan - $new_saldo))." )";
						$msg = "Rugi";
						$msg2 = "Memdapatkan Kerugian Sebesar ".$laba;
							
					}else{
						$laba = "".str_replace("-","",currency." ".number_format($pendapatan - $new_saldo));
						$msg = "Laba";
						$msg2 = "Mendapatkan Keuntungan Sebesar ".$laba;
					}
					
					if($new_saldo !== 0) 
					echo '<tr style="border:1px #ddd solid;background:#f8f8f8">
								<td style="padding:10px;width:50px;border:transparent"></td>	
								<td style="padding:10px;width:350px;border:transparent">'.$msg.'</td>	
								<td style="padding:10px;border:transparent;font-weight:400;width:300px;text-align:center"></td>	
								<td style="padding:10px;border:transparent;border-left:1px #ddd solid;font-weight:400;width:300px;text-align:center">'.$laba.'</td>	
							</tr>
							<tr style="border:transparent">
							<td style="padding:20px;padding-left:0px;font-size:11px;color:#666;border:transparent" colspan="4">* '.$msg2.'</td>
							</tr>';
					
					if($new_saldo == 0){
						echo '<tr style="border-bottom:1px #ddd solid;">
							<td style="text-align : center;padding:30px" colspan="4">Tidak Ada Data</td>
						</tr>
						';
					}
					?>
				</table>
			</div>
			</div>
			
				<span id="result">
		
				</span>
					
		</div>
	</div>		
</div>