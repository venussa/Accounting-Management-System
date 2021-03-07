<?php
if(isset($_SESSION['user_login'])) {
	header("location:".HomeUrl()."/?module=home");
	exit;	
}
?>
<html>
	<head>
		
		<title>Login Aplikasi Sistem Akuntansi</title>
		<link rel="shortcut icon" href="<?php echo projectUrl()."/assets/img/gundar.png"?>">
		
		<?php CallCss([		
				"assets/css/bootstrap.css",
				"assets/js/jquery-ui/jquery-ui.css",
				"assets/fontawesome/web-fonts-with-css/css/fontawesome-all.css"
		]);
		
		$pjax_class = pjax_load_data()->class;
		
		echo pjax_load_data()->javascript;
		
		?>
		
		
		
		
		
		<style>
			*{
				text-decoration : none;
				outline : none;
				
			}
			
			.pagination > li > .aktive, .pagination > li > span {
				background : #d9edf7;
				color : #666;
			}
			
			.select{
				cursor : pointer;
				list-style-type:none;padding:6px;padding-left:20px;
				border-bottom:1px #ddd dashed;
			}
			.select-box{
				position:absolute;
				border-radius:5px;
				box-shadow: 0px 2px 3px rgba(0, 0, 0, 0.13), 1px 1px 1px rgba(0, 0, 0, 0.1), -1px -2px 1px rgba(0, 0, 0, 0.05);
				background:#fff;
				width:250px;
				height:200px;
				overflow:hidden;
				overflow-y:scroll;
				
				margin-top:5px;
			}
			.card-box{
				border-radius:5px;
				box-shadow: 0px 2px 3px rgba(0, 0, 0, 0.13), 1px 1px 1px rgba(0, 0, 0, 0.1), -1px -2px 1px rgba(0, 0, 0, 0.05);
				background:#fff;
				
				margin-top:5px;
			}
			.select:hover{
				background : #f5f5f5;
				cursor : pointer;
				list-style-type:none;padding:6px;padding-left:20px;
				border-bottom:1px #ddd dashed;
			}
			.list-group-item{
				padding : 7px;
				font-size : 13px;
				border : transparent;
			}
			.list-group-item:hover{
				cursor : pointer;
				background : #f5f5f5;
				padding : 7px;
				font-size : 13px;
				border : transparent;
			}
			.list-group-item i {
				color : #666;
			}
			.underflow-blue{
				background : #f1f1f1;
			}
			.underflow{
				
			}
			label{
				margin-top:5px;
			}
			th{
				padding :2px;
			}
			td{	
				border-right : 1px #f1f1f1 solid;
				padding :5px;
				font-size : 13px;
			}
			
			th div{
				padding : 5px;
				border-radius : 3px;
				color : #666;
				border : 1px #bce8f1 solid;
				width : 100%;
				font-size : 14px;
				background:#d9edf7;
			}
		</style>
		
	</head>
<body style="background:#f5f5f5;background:url(<?php echo projectUrl()."/assets/img/bg-gundar.jpg"?>) repeat scroll 0% 0% / cover;">
	<div style="background: rgba(0, 0, 0, 0.7);width: 100%;height:2000px;position: fixed;"></div>

<!-- Container -->

	<!-- col-md-4 -->
	<div class="col-md-4" style="right:-20px;position: fixed;">
		<form method="POST" action="<?=homeUrl()?>/checklogin" onSubmit="return mugenLogin(this)">
		<div class="panel panel-info"  id="box-login" style="border-radius: 0px;box-shadow: rgba(0, 0, 0, 0.13) 0px 2px 3px, rgba(0, 0, 0, 0.1) 1px 2px 2px, rgba(0, 0, 0, 0.05) -1px -2px 2px;padding: 20px;">

			<div class="panel-body">

				<center>
				<img src="<?php echo projectUrl()."/assets/img/gundar.png"?>" width="100">
			</center>

				<h1 style="text-shadow: 0 0 1px rgba(0,0,0,0.5);color:#77a809;font-size:30px;text-align: center;"> Login Aplikasi</h1>
				<p style="text-align: center;text-shadow: 0 0 1px rgba(0,0,0,0.2);font-size: 16px;margin-top: 20px;">Selamat datang di Aplikasi Akuntansi, Silahkan login terlebih dahulu</p>

				<hr style="border:transparent;border-bottom:2px #ddd dashed;" />
				<div style="margin-top: 10px;">
					<label style="text-shadow: 0 0 1px rgba(0,0,0,0.1);color:#77a809;font-size: 17px;">Username</label>
					<input type="text" name="username" required style="padding: 17px;border:transparent;width: 100%;border: 2px #77a809 solid;border-radius: 3px;" placeholder="Your Username ... ">
				</div>

				<div style="margin-top: 10px;">
					<label style="text-shadow: 0 0 1px rgba(0,0,0,0.1);color:#77a809;font-size: 17px;">Password</label>
					<input type="password" name="password" required style="padding: 17px;border:transparent;width: 100%;border: 2px #77a809 solid;border-radius: 3px;" placeholder="Type your password ... ">
				</div>

				<div style="margin-top: 10px;">

					<div class="alert" style="margin-bottom: 5px;display: none;"></div>
					<hr/>
					<button type="submit" value="Login" class="btn btn-info" style="width: 100%;background: #77a809;border:1px #77a809 solid;padding: 15px;font-weight: 600;font-size: 20px;><span class="img-loads"></span> Masuk</button>
					<hr style="border:transparent;border-bottom:2px #ddd dashed;" />
					<p style="text-shadow: 0 0 1px rgba(0,0,0,0.2);text-align: center;font-size: 13px">2019 &copy; Sistem Informasi Akuntasi & Keuangan</p>
				</div>
				
				
			</div>
		</div>
	</form>
	</div>
	<!-- / col-md-4 -->


<!-- / Container -->

<?php CallJs("assets/js/jquery.js") ?>

<script>
	function mugenLogin(a){
		$.ajax({
			type : "POST",
			url : $(a).attr("action"),
			data : $(a).serialize(),
			beforeSend : function(){
				$(".img-loads").html("<img src='<?=projectUrl()."/assets/img/ovalo.svg"?>' width='15'>");
			},
			success : function (even){
				$(".img-loads").html("");
				$(".alert").show();
				$failuser = even.indexOf("<failuser/>");
				$failpass = even.indexOf("<failpass/>");
				$failcapt = even.indexOf("<failcapt/>");

				var class_box = ["alert-warning","alert-danger","alert-info","alert-default"];
				
				for(var i = 0 ; i < class_box.length; i++){
					$(".alert").removeClass(class_box[i]);
				}

				if($failuser !== -1){
					
					$(".alert").addClass("alert-warning");
					$(".alert").html("Invalid Username");
					$(".reload-captcha").load($(a).attr("action")+"/?captcha_reload=true");

				}else if($failpass !== -1){
					
					$(".alert").addClass("alert-danger");
					$(".alert").html("Invalid Password");
					$(".reload-captcha").load($(a).attr("action")+"/?captcha_reload=true");

				}else if($failcapt !== -1){
					
					$(".alert").addClass("alert-warning");
					$(".alert").html("Invalid Captcha");
					$(".reload-captcha").load($(a).attr("action")+"/?captcha_reload=true");

				}else{

					$(".alert").addClass("alert-success");
					$(".alert").html("Berhasil, Selamat Datang");

					setInterval(function(){

						window.location = "<?=homeUrl()?>";

					},2000);
				}
			}
		});

		return false;
	}

	$(document).ready(function(){
		$("#box-login").css({
			"height" : $(document).height()+"px",
		});
	});
</script>
</body>
</html>