<div class="col-md-10 col-md-offset-2" style="margin-top:70px;">
	<div class="panel" style="margin-left:0px;border:1px #ddd solid;">
	
		
		<div class="panel-body" style="padding:5px;background:#fff;padding:5px">
				<h1 style="font-size: 20px;padding:10px;padding-bottom: 20px;border-bottom: 2px #ddd dashed;margin-top:0px;"><img src="<?=projectUrl()."/assets/img/0-8.png"?>" width="30" height="30" style="position: absolute;margin-top: -5px;"> <div style="margin-left: 40px">Laporan Neraca</div></h1>
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
				<td style="padding:10px;width:50%;border:transparent;background: #ccdbaa;font-weight:600">Aktiva</td>
				<td style="padding:10px;width:50%;border:transparent;border-left:1px #ddd solid;background: #ccdbaa;font-weight:600">Pasiva</td>
				
			</tr>
						<tr style="border:1px #ddd solid">
							<td valign="top" style="padding:10px;width:50%;border:transparent">
								<div style="float:left;width:33%">
									<label style="margin-bottom:10px">Aktiva Lancar</label>
									<p style="margin-left:15px">Kas</p>
									<p style="margin-left:15px">Piutang</p>
									<p style="margin-left:15px">Perlengkapan</p>
									<p style="margin-left:15px">Sewa Dibayar Dimuka</p>
								</div>
								
								<div style="float:left;width:33%">
									<label style="margin-bottom:10px">&nbsp;</label>
									<p style="margin-left:15px;text-align:center;">-</p>
									<p style="margin-left:15px;text-align:center;">-</p>
									<p style="margin-left:15px;text-align:center;">-</p>
									<p style="margin-left:15px;text-align:center;">-</p>
								</div>
								
								<div style="float:right;width:33%">
									<label style="margin-bottom:10px">&nbsp;</label>
								
									<?php
									$hitung1 = 0;
									$akun = ['11','12','13','14'];
									foreach($akun  as $key => $val){
										$list_data["x-".$val] = neracasaldo($val,"all");
										$list_data1 = $list_data["x-".$val];
										
										if($list_data1['ori_deb'] == 0){
											$data_saldo = $list_data1['kredit'];
											$oredo =  $list_data1['ori_kre'];
										}else{
											$data_saldo = $list_data1['debet'];
											$oredo =  $list_data1['ori_deb'];
										}
										$hitung1 += $oredo;
										echo '<p style="margin-left:15px;text-align:center;">'.$data_saldo.'</p>';
									}
									?>
								</div>
								<div style="width:100%"></div>
								<div style="float:left;width:33%">
									<label style="margin-bottom:10px">Aktiva Tetap</label>
										<p style="margin-left:15px">Peralatan</p>
										<p style="margin-left:15px">Akumulasi Penyusutan</p>
								</div>
								<div style="float:left;width:33%">
									<label style="margin-bottom:10px">&nbsp;</label>
										<?php
									$akun = ['15','19'];
									$hitung2 = 0;
									foreach($akun  as $key => $val){
										$list_data["x-".$val] = neracasaldo($val,"all");
										$list_data1 = $list_data["x-".$val];
										
										if($list_data1['ori_deb'] == 0){
											$data_saldo = $list_data1['kredit'];
											$oredo =  $list_data1['ori_kre'];
										}else{
											$data_saldo = $list_data1['debet'];
											$oredo =  $list_data1['ori_deb'];
										}
										
										$hitung2 += $oredo;
										echo '<p style="margin-left:15px;text-align:center;">'.$data_saldo.'</p>';
									}
									?>
								</div>
								<div style="float:right;width:33%">
									<label style="margin-bottom:10px">&nbsp;</label>
										<p style="margin-left:15px;text-align:center;">-</p>
										<p style="margin-left:15px;text-align:center;">-</p>
										<p style="margin-left:15px;text-align:center;"><?php
											
											if($hitung2 !== 0)
											echo currency." ".number_format($hitung2);
											else echo "-";
											?></p>
								</div>
							</td>
							
				<td style="padding:10px;width:50%;border:transparent;border-left:1px #ddd solid;">
							
					<div style="float:left;width:49%">
									<label style="margin-bottom:10px">Hutang</label>
									<p style="margin-left:15px">Hutang</p>
									<p style="margin-left:15px">&nbsp;</p>
									<p style="margin-left:15px">&nbsp;</p>
									<p style="margin-left:15px">&nbsp;</p>
								</div>
								
								<div style="float:right;width:50%">
									<label style="margin-bottom:10px">&nbsp;</label>
									<?php
									$akun = ['21'];
									$hitung3 = 0;
									foreach($akun  as $key => $val){
										$list_data["x-".$val] = neracasaldo($val,"all");
										$list_data1 = $list_data["x-".$val];
										
										if($list_data1['ori_deb'] == 0){
											$data_saldo = $list_data1['kredit'];
											$oredo =  $list_data1['ori_kre'];
										}else{
											$data_saldo = $list_data1['debet'];
											$oredo =  $list_data1['ori_deb'];
										}
										
										$hitung3 += $oredo;
										echo '<p style="margin-left:15px;text-align:center;">'.$data_saldo.'</p>';
									}
									?>
									<p style="margin-left:15px;text-align:center;">&nbsp;</p>
									<p style="margin-left:15px;text-align:center;">&nbsp;</p>
									<p style="margin-left:15px;text-align:center;">&nbsp;</p>
								</div>
								
								
								<div style="width:100%"></div>
								<div style="float:left;width:49%">
									<label style="margin-bottom:10px">Modal</label>
										<p style="margin-left:15px">Modal Per <?php
					$a_date = tanggal;
					$date = date("Y-m-t", strtotime($a_date));
					$date = explode("-",$date);
					$tanggal = $date[2]." ".str_replace("0","",monthConvert($date[1]))." ".$date[0];
					echo $tanggal;
					?></p>
										<p style="margin-left:15px">&nbsp;</p>
								</div>
								
								<div style="float:right;width:50%">
									<label style="margin-bottom:10px;text-align:right;">&nbsp;</label>
										<?php
									if(perubahan_modal() !== "0")
										echo '<p style="margin-left:15px;text-align:center;">'.perubahan_modal().'</p>';
									else
										echo '<p style="margin-left:15px;text-align:center;">-</p>';
									
									?>
										<p style="margin-left:15px;text-align:center;">&nbsp;</p>
								</div>		
				</td>
				
			</tr>
						
			<tr style="border:1px #ddd solid;background:#f8f8f8">
				<td style="padding:10px;width:50%;border:transparent;text-align:right">
					<div style="float:left;width:33%"></div>
								
					<div style="float:left;width:33%"></div>
								
					<div style="float:right;width:33%;text-align:center">
					<?php
						if(($hitung1+$hitung2) !== 0)
							echo "<p style='margin-left:15px;text-align:center;'>".currency." ".number_format(($hitung1+$hitung2))."</p>";
						else 
							echo "<p style='margin-left:15px;text-align:center;'>-</p>";
					?>
					</div>
				</td>
				<td style="padding:10px;width:50%;border:transparent;border-left:1px #ddd solid;text-align:right">
					<div style="float:left;width:49%"></div>
								
					<div style="float:right;width:50%;text-align:center">
						<p style="margin-left:15px">
							<?php
							if((perubahan_modal(true) + $hitung3 - ($hitung3 * 2)) !== 0)
							echo "".currency." ".number_format((perubahan_modal(true) + $hitung3 - ($hitung3 * 2)));
							else echo "-";
							?>
						</p>
					
					</div>
					</td>
				
			</tr>
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