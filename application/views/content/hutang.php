<div class="col-md-10  col-md-offset-2" style="margin-top:70px;">
	<div class="panel" style="margin-left:0px;border:1px #ddd solid;">
				
		<div class="panel-body" style="padding:5px;">
			<h1 style="font-size: 20px;padding:10px;padding-bottom: 20px;border-bottom: 2px #ddd dashed;margin-top:0px;"><img src="<?=projectUrl()."/assets/img/0-5.png"?>" width="30" height="30" style="position: absolute;margin-top: -5px;"> <div style="margin-left: 40px">
		Catatan Hutang
			<button onClick="olah_modal('cicilhutang')" class="btn btn-default" data-toggle="modal" data-target="#squarespaceModal"  style="float:right;margin-top:-3px;margin-right:-10px;background: #fff;color:#666;text-shadow: 0 0 1px rgba(0,0,0,0.3);"><i class="fas fa-plus"></i> Hutang Tanpa Dp / Cicil Hutang</button>
			<button onClick="olah_modal('hutang')" class="btn btn-default" data-toggle="modal" data-target="#squarespaceModal"  style="float:right;margin-top:-3px;margin-right:10px;background: #fff;color:#666;text-shadow: 0 0 1px rgba(0,0,0,0.3);"><i class="fas fa-plus"></i> Hutang Dengan DP</button>
		
		</div></h1>
			
				<span id="result">
					<?php echo hutang() ?>
				</span>
				
		</div>
	</div>		
</div>