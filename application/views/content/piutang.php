<div class="col-md-10  col-md-offset-2" style="margin-top:70px;">
	<div class="panel panel" style="margin-left:0px;border:1px #ddd solid;">
		
		<div class="panel-body" style="padding:5px;">

			<h1 style="font-size: 20px;padding:10px;padding-bottom: 20px;border-bottom: 2px #ddd dashed;margin-top:0px;"><img src="<?=projectUrl()."/assets/img/0-6.png"?>" width="30" height="30" style="position: absolute;margin-top: -5px;"> <div style="margin-left: 40px"> Catatan Piutang
		<button onClick="olah_modal('cicilpiutang')" class="btn btn-default" data-toggle="modal" data-target="#squarespaceModal"  style="float:right;margin-top:-7px;margin-right:-10px;background: #fff;color:#666;text-shadow: 0 0 1px rgba(0,0,0,0.3);"><i class="fas fa-plus"></i> Piutang Tanpa DP / Cicil Piutang</button>		
		<button onClick="olah_modal('piutang')" class="btn btn-default" data-toggle="modal" data-target="#squarespaceModal"  style="float:right;margin-top:-7px;margin-right:10px;background: #fff;color:#666;text-shadow: 0 0 1px rgba(0,0,0,0.3);"><i class="fas fa-plus"></i> Piutang Dengan DP</button>
		</div></h1>
			
				<span id="result">
					<?php echo piutang() ?>
				</span>
				
		</div>
	</div>		
</div>