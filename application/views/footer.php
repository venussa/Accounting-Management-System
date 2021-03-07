<div class="modal fade" id="squarespaceModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
			<h3 class="modal-title" id="lineModalLabel">Tambah Data</h3>
		</div>
		<div class="modal-body1 first" style="text-align:center;height:250px;padding-top:50px;display:none;">
			<img src="<?=projectUrl()."/assets/img/ovalo.svg"?>" width="150" />
		</div>
		<div class="modal-body second">
			
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-info savebtn" style="background: #77a809;border:1px #08833e solid;" onClick="add_data()">Simpan</button>
			<button type="button" class="btn btn-default dismis" data-dismiss="modal"  role="button">Tutup</button>
		</div>
	</div>
  </div>
</div>
<div style="z-index:100000;" id="pjax-load-data" class="navbar-fixed-top">
</div>
		<?php CallJs([
				"assets/js/jquery.js",
				"assets/js/jquery-ui/jquery-ui.js",
				"assets/js/bootstrap.js"
			]) ?>

	<script>
		function olah_modal(title,id = "",act = "",pg = "&page=1"){
			$.ajax({
				
				type : "POST",
				url  : "load_modal?pjax<?=url?>"+pg,
				data : {
					modal_type : title,
					act : act,
					id : id
				},
				beforeSend : function(){
					
					$(".second").hide();
					$(".first").show();
				},
				success : function(event){
					if(act !== ""){
						$(".modal-title").html("Ubah Data");
					}else{
						$(".modal-title").html("Tambah Data");
					}
					$(".first").hide();
					$(".second").show();
					$(".modal-body").html(event);
					$(".savebtn").attr("onClick","add_data('"+title+"')");
				}
			});
			
		}
		
		function add_data(title){
			
			$("#submit-data").click();
			
		}
		
		function modal_send(a){
			
			$.ajax({
				
				type : "POST",
				url  : $("form").attr("action"),
				data : $(a).serialize(),
				success : function(event){
					if(event.indexOf("<success/>") !== -1){
						$(".dismis").click();
						$("#result").html(event);
					}else{
						alert("failed");
					}
					
				}
			});
			
			return false;
		}
		
		function delete_data(type,id,pg = "1"){
			if(confirm("Apakan anda ingin menghapus data ini ?") == true){
				
				$.ajax({

					type : "POST",
					url  : "data_proccess?pjax<?=url?>"+pg,
					data : {
						type : type,
						id : id
					},
					success : function(event){
						if(event.indexOf("<success/>") !== -1){
							$(".dismis").click();
							$("#result").html(event);
						}else{
							alert("failed");
						}

					}
				});
			}
		}
		
		function date_picker(){
		$("#date-picker").datepicker({
			dateFormat : 'yy/mm/dd'   
		}); 
		}
		
		function show_selectbox(){
			if($("#select-box").css("display") == "none"){
				$("#select-box").show();
			}else{
				$("#select-box").hide();
			}
		}
		
		$("#select-box").mouseleave(function(){
			$(".select-box").hide();
		});
		
		function collapse(num = null){
			
				$.ajax({

					type : "POST",
					url  : "data_proccess?pjax<?=url?>",
					data : {
						menu : num
					},
					
					success : function(event){
			
						if(num == 1){
							$("#list-1").animate({
								"margin-top" : "0px",
							});
							$("#list-2").animate({
								"margin-top" : "-185px",
							});

							$("#btn-1").addClass("fa-chevron-up");
							$("#btn-1").removeClass("fa-chevron-down");

							$("#btn-2").addClass("fa-chevron-down");
							$("#btn-2").removeClass("fa-chevron-up");
						}else{
							$("#list-1").animate({
								"margin-top" : "-225px",
							});
							$("#list-2").animate({
								"margin-top" : "0px",
							});

							$("#btn-1").removeClass("fa-chevron-up");
							$("#btn-1").addClass("fa-chevron-down");

							$("#btn-2").removeClass("fa-chevron-down");
							$("#btn-2").addClass("fa-chevron-up");
						}
					}
				});
		}
		
		$(".btn-filter").click(function(){
			$("#pjax-load-data").show();
		});
		
		function filter_date(a){
			
			var source = $(".btn-filter").attr("data");
			
			var get_var = source.split("&");
			var ranges  = get_var.length;
				get_var = get_var[0];
			
			
			var tahun = "&tahun="+$("#tahun1").val();

			if(ranges == 1){
				var bulan = "?bulan="+$("#bulan1").val();
			}else{
				var bulan = "&bulan="+$("#bulan1").val();
			}

			
			var value = get_var+""+bulan+""+tahun;
			$(".btn-filter").attr("href",value);
		}
		
		$(document).ready(function(){
			
			$("#pjax-load-data").hide();
			
		});
	</script>

	
		</div>
		</div>
	</body>
</html>
