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
			display: table-cell;
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
		   	visibility:hidden;
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
	</style>
	
	<script type="text/javascript">
	
		$(function() {
	    	$( "#progressbar" ).progressbar({
		      	value: 33	
	    	});
	  	});
	
	</script>
	<script type="text/javascript">
		function startUpload(){
		    document.getElementById('f1_upload_process').style.visibility = 'visible';
		    return true;
		}
		function stopUpload(success){
		    var result = '';
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
				<a class="btn btn-primary menu_link" href="">管理商品</a>
				<a class="btn btn-info menu_link" href="">管理討論</a>
				<a class="btn btn-info menu_link" href="">管理店家</a>
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
				<form action="upload.php" method="post" enctype="multipart/form-data" target="upload_target" onsubmit="startUpload();" >
					<input class="radio" type="radio" name="photo" value="url">網路上的圖檔<br><br>
					圖檔網址：<input type="text" name="url" placeholder="https://lh3.googleusercontent.com/legbcoV0zE4f-xEIdrjjU6Tgnc_2SvfF1DiV2HS7rSE=w410-h547-no"><br>
					<input class="radio" type="radio" name="photo" value="file">電腦中的圖檔<br><br>
				    圖檔位置: <input name="myfile" type="file" />
				          <input class="btn btn-default" type="submit" name="submitBtn" value="預覽" />
				</form>
			</div>
			<div class="grid_5">
				<div id="f1_upload_process">Loading...<br/><img src="loader.gif" /></div>
				<div id="result"></div>				 
				<iframe id="upload_target" name="upload_target" src="#" style="width:0;height:0;border:0px solid #fff;"></iframe>
			</div>
			<br>
			<hr style="margin-top:40%">
			<div id="final">
				<input type="hidden" name="step" value="2" id="">
				<input class="btn btn-primary" type="submit" value="下一步" >
			</div>
		</div>

		<div class="footer">
			<div class="container_12">
				<br>
				<center><p>Copyright By Leo Lin</p></center>
			</div>
		</div>
	</body>
</html>
