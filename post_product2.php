<?php
session_start();
if(isset($_POST["hid_path"])){
	$_SESSION["hid_path"]=$_POST["hid_path"];	
}
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
	</style>
	
	<script type="text/javascript">
	
		$(function() {
	    	$( "#progressbar" ).progressbar({
		      	value: 67
	    	});
	  	});
	
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

			<h5>請描述該商品截圖之介紹及該商品內容：</h5>
			<form action="post_product3.php" method="POST">
				<div class="grid_4 alpha">
					<?php
						echo '<input type="text" name="p_name" placeholder="商品名稱" value="'.$_SESSION["p_name"].'"><br/>';
					?>
					<select name="category">
						<option value="None">商品類別</option>
						<option value="陽光">陽光</option>
						<option value="空氣">空氣</option>
						<option value="水">水</option>
					</select><br/>
					<?php
						echo '<input name="o_price" type="text" placeholder="商品原價格" value="'.$_SESSION["o_price"].'"><br/>';
						echo '<input name="s_price" type="text" placeholder="商品促銷價格" value="'.$_SESSION["s_price"].'"><br/>';
						echo '<textarea name="product_description" style="height:230px;" placeholder="商品介紹">'.$_SESSION["product_description"].'</textarea><br/>';
						echo '<input name="goal" type="text" placeholder="商品達標團購人數" value="'.$_SESSION["goal"].'"><br/>';
						echo '<input name="shipment" type="text" placeholder="商品出貨天數" value="'.$_SESSION["shipment"].'"><br/>';
					?>
				</div>
				<div class="grid_4">
					<!-- <img src="" style="height:400px;"> -->
					<?php echo "<img src=\"".$_SESSION["hid_path"]."\" style=\"height:400px;\">";?>
					<br><br/>
				</div>
				<div class="grid_4">
					<?php
						echo '<input type="text" name="title" placeholder="圖片名稱" value="'.$_SESSION["title"].'"><br/>';
						echo '<textarea name="img_description" style="height:390px;" placeholder="圖片形容">'.$_SESSION["img_description"].'</textarea>';
					?>
				</div>
				<br>
				<hr>
				<div id="final">
					<a class="btn btn-primary" href="post_product.php">上一步</a>
					<input class="btn btn-default" type="button" name="preview" value="預覽" id="preview" style="margin-left:15px;">
					<input class="btn btn-primary" type="submit" value="確認送出">
				</div>
			</form>
		</div>

		<div class="footer">
			<div class="container_12">
				<br>
				<center><p>Copyright By Leo Lin</p></center>
			</div>
		</div>
	</body>
</html>
