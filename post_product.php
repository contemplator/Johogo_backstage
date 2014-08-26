<?php
session_start();

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    // last request was more than 30 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp

?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link rel="stylesheet" type="text/css" media="all" href="css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" media="all" href="css/reset.css" />
        <link rel="stylesheet" type="text/css" media="all" href="css/text.css" />
        <link rel="stylesheet" type="text/css" media="all" href="css/960.css" />
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
		<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
  		<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
	</head>
	<style type="text/css">
		.header{
			background-color: #E1E1E1;
			height: 100px;
			vertical-align: center;
		}
		#title{
			margin-top: 40px;
			font-size: 40px;
			font-style: bolder;
			vertical-align: center;
		}
		.description{
			margin-top: -10px;
			margin-bottom: 20px;
			font-size: 12px;
		}
		.cell{
			display:table-cell;
			vertical-align: center;
		}
		.login_info{
			text-align: right;
		}
		.menu{
			background-color: red;
			height:80px;
		}
		.menu_link{
			margin-top: 30px;
		}
		button{
			text-align: right;
		}
		table{
			border-collapse: collapse;
			border: 1px solid black;
			width: 100%;
		}
		th, td {
 		   border: solid black 1px;
		}
		#input{
			margin-left: 50px;
		}
		#final{
			float: right;
		}
		#preview{
			margin-right: 15px;
		}
		.footer{
			margin-top: 50px;
			background-color: #E1E1E1;
			vertical-align: center;
		}
		#f1_upload_process{
		   	z-index:100;
		   	display: none;
		   	text-align:center;
		   	width:400px;
		   	height:400px;
		   	margin:0px;
		   	padding:0px;
		   	background-color:#fff;
		   	border:1px solid #ccc;
		}
		#result{
			float:left;
		}
		a:hover{
			cursor: pointer;
		}
	</style>
	
	<script type="text/javascript">
	
		$(function() {
	    	$( "#progressbar" ).progressbar({
		      	value: 33	
	    	});
			$('#radio1').change(function() {
				$("#myfile").prop('disabled', true);
				$("#myfile").val("");
				$("#url_photo").prop('disabled', false);
			});
			$('#radio2').change(function() {
				$("#myfile").prop('disabled', false);
				$("#url_photo").prop('disabled', true);
				$("#url_photo").val("");
			});
			$( "#url_photo" ).change(function() {
				$( "img" ).attr("src", "loader.gif");
				$( "#upload_form" ).submit();
				$( "#link_remind" ).show();
			});
			$( "#myfile" ).change(function() {
				$( "img" ).attr("src", "loader.gif");
				$( "#upload_form" ).submit();
				$( "#link_remind" ).show();
			});
			$( "#destory_photo" ).click(function(){
				$.ajax({
					type: "POST",
					url: "unset_session.php",
					data: "action=unset_img",
					success: function(msg){
						alert('successfully remove image!');
						window.location.replace("post_product.php");
					},
					error: function(msg){
						alert('Error: cannot load page.');
						window.location.replace("post_product.php");
					}
				});
			});
	  	});
	
	</script>
	<script type="text/javascript">
		function startUpload(){
			document.getElementById('f1_upload_process').style.display= 'inline-block';
			document.getElementById('result').style.display= 'none';
		    
		    return true;
		}
		function stopUpload(success){
		    var result = '';
		    document.getElementById('result').style.display= 'block';
		    if (success != 0){
		       	document.getElementById('result').innerHTML = "<img src="+success+" style=\"width:400px;height:400px;\";float: left>";
		    }
		    else {
		       	document.getElementById('result').innerHTML = 
		        '<span class="emsg">There was an error during file upload!<\/span><br/><br/>';
		    }
		    document.getElementById('f1_upload_process').style.display = 'none';
		    return true;   
		}
	</script>
	<body>
		<div class="header">
			<div class="container_12">
				<div class="cell">
					<span id="title">Johogo</span>
					<span id="description">輕鬆團購 買到所有你想的到的</span>
				</div>
				<div class="login_info">
					<span>您好,</span>
					<span><?php echo "user_name"; ?></span>
					<span>|</span>
					<span><a href="">活動管理</a></span>
					<span>|</span>
					<span><a href="">登出</a></span>
				</div>
			</div>
		</div>

		<div class="menu">
			<div class="container_12">
				<a class="btn btn-primary menu_link" href="index.php">管理商品</a>
				<a class="btn btn-info menu_link" href="">管理討論</a>
				<!-- <a class="btn btn-info menu_link" href="">管理店家</a> -->
			</div>
		</div>

		<div class="content container_12">
			<h2>新增商品</h2>
			<!--<div id="progressbar" class="prefix_1 grid_10 suffix_1"></div>-->
			<p class="grid_1 alpha"></p><div id="progressbar" class="grid_10"></div><p class="grid_1 omega"></p>
			<br/>
			<br/>
			<br/>

			<h5>請選擇一張圖檔作為商品的截圖：</h5>
			<div id="input" class="grid_6 aplpha">
				<form id="upload_form" action="upload.php" method="post" enctype="multipart/form-data" target="upload_target" onsubmit="startUpload();" >
					<input class="radio" id="radio1" type="radio" name="photo" value="url" checked>網路上的圖檔<br><br>
					圖檔網址(暫限jpg)：<input type="text" id="url_photo" name="url_photo" placeholder="http://hdwallpaper.freehdw.com/0008/animals_widewallpaper_cat_74664.jpg"><br>
					<input class="radio" id="radio2" type="radio" name="photo" value="file">電腦中的圖檔<br><br>
				    圖檔位置: <input id="myfile" name="myfile" type="file" disabled/>
				</form>
			</div>
			<div class="grid_5">
				<?php
					if(isset($_SESSION["hid_path"])){
						echo '<div id="link_remind"><span style="font-size:15px;">相片連結將保存五分鐘</span>  <a id="destory_photo">點此立即消除保存</a></div>';
						echo '<div style="display:block" id="f1_upload_process"><br/><img style="weight:390px;height:390px;" src="'.$_SESSION["hid_path"].'" /></div>';
					}else{
						echo '<div id="link_remind" style="display:none"><span style="font-size:15px;">相片連結將保存五分鐘</span>  <a id="destory_photo">點此立即消除保存</a></div>';
						echo '<div id="f1_upload_process">Loading...<br/><img style="weight:390px;height:390px;" src="loader.gif" /></div>';
					}
				?>
				<div id="result"></div>				 
				<iframe id="upload_target" name="upload_target" src="#" style="width:0;height:0;border:0px solid #fff;"></iframe>
			</div>
			<br>
			<hr style="margin-top:40%">
			<div id="final">				
				<form action="post_product2.php" method="POST">
					<input class="btn btn-default" type="button" name="preview" value="預覽" id="preview" style="margin-left:15px;">
					<input type="submit" class="btn btn-primary" value="下一步">
					<?php
						if(isset($_SESSION["hid_path"])){
							echo '<input name="hid_path" id="hid_path" type="hidden" value="'.$_SESSION["hid_path"].'">';
						}else{
							echo '<input name="hid_path" id="hid_path" type="hidden">';
						}
					?>
				</form>
				
			</div>
		</div>

		<div class="footer">
			<div class="container_12">
				<br>
				<center><p>Copyright By Team-14</p></center>
			</div>
		</div>
	</body>
</html>
