<?php 
if(!isset($_SESSION['user_login'])) {
	header("location:".HomeUrl()."/login");
	exit;	
}
?>
<html>
	<head>
		
		<title>Selamat Datang di Aplikasi Sistem Akuntansi</title>
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
				background : #77a809;
				color : #f5f5f5;
			}
			
			.select{
				cursor : pointer;
				list-style-type:none;padding:6px;padding-left:20px;
				border-bottom:1px #ddd dashed;
			}
			.select-box{
				text-shadow: 0 0 0.1px rgba(0,0,0,0.1);
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
				background : #ccdbaa;
				cursor : pointer;
				list-style-type:none;padding:6px;padding-left:20px;
				border-bottom:transparent;
			}
			.list-group-item{
				border-radius: 0px;
				padding : 7px;
				font-size : 13px;
				border : transparent;
			}
			.list-group-item:hover{
				border-radius: 0px;
				cursor : pointer;
				background : #ccdbaa;
				padding : 7px;
				font-size : 13px;
				border : transparent;
			}
			.list-group-item i {

				color : #666;
			}
			.underflow-blue{
				background : #ccdbaa;
				border-radius: 0px;
			}
			.underflow{
				border-radius: 0px;
				
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
				-moz-box-shadow:inset 0px 1px 0px -47px #a4e271;
				-webkit-box-shadow:inset 0px 1px 0px -47px #a4e271;
				box-shadow:inset 0px 1px 0px -47px #a4e271;
				background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #89c403), color-stop(1, #77a809));
				background:-moz-linear-gradient(top, #89c403 5%, #77a809 100%);
				background:-webkit-linear-gradient(top, #89c403 5%, #77a809 100%);
				background:-o-linear-gradient(top, #89c403 5%, #77a809 100%);
				background:-ms-linear-gradient(top, #89c403 5%, #77a809 100%);
				background:linear-gradient(to bottom, #89c403 5%, #77a809 100%);
				filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#89c403', endColorstr='#77a809',GradientType=0);
				background-color:#89c403;
				-moz-border-radius:7px;
				-webkit-border-radius:7px;
				border-radius:7px;
				border:2px solid #74b807;
				display:inline-block;
				cursor:pointer;
				color:#ffffff;
				font-family:Arial;
				font-size:15px;
				font-weight:bold;
				padding:6px 24px;
				text-decoration:none;
				text-shadow:0px 1px 0px #528009;
				width:100%;
			}

			.btn-danger{
				background: #d47474;
				border:1px #d47474 solid;
			}
			.btn-info{
				background: #79afc1;
				border:1px #79afc1 solid;
			}
			.myButton {
				-moz-box-shadow:inset 0px 1px 0px -47px #a4e271;
				-webkit-box-shadow:inset 0px 1px 0px -47px #a4e271;
				box-shadow:inset 0px 1px 0px -47px #a4e271;
				background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #89c403), color-stop(1, #77a809));
				background:-moz-linear-gradient(top, #89c403 5%, #77a809 100%);
				background:-webkit-linear-gradient(top, #89c403 5%, #77a809 100%);
				background:-o-linear-gradient(top, #89c403 5%, #77a809 100%);
				background:-ms-linear-gradient(top, #89c403 5%, #77a809 100%);
				background:linear-gradient(to bottom, #89c403 5%, #77a809 100%);
				filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#89c403', endColorstr='#77a809',GradientType=0);
				background-color:#89c403;
				-moz-border-radius:7px;
				-webkit-border-radius:7px;
				border-radius:7px;
				border:2px solid #74b807;
				display:inline-block;
				cursor:pointer;
				color:#ffffff;
				font-family:Arial;
				font-size:15px;
				font-weight:bold;
				padding:6px 24px;
				text-decoration:none;
				text-shadow:0px 1px 0px #528009;
				width: 100%;
			}
			

		</style>
		
	</head>