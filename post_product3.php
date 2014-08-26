<?php
session_start();
require_once ('db_class.php');


if(($_SESSION["hid_path"]) && (isset($_POST["p_name"]))) {

	$_SESSION["p_name"] = $_POST["p_name"];
	$_SESSION["category"] = $_POST["category"];
	$_SESSION["o_price"] = $_POST["o_price"];
	$_SESSION["s_price"] = $_POST["s_price"];
	$_SESSION["product_description"] = $_POST["product_description"];
	$_SESSION["goal"] = $_POST["goal"];
	$_SESSION["shipment"] = $_POST["shipment"];
	$_SESSION["title"] = $_POST["title"];
	$_SESSION["img_description"] = $_POST["img_description"];

	$sql = "INSERT INTO `johogo`.`product` (`p_id`, `c_account`, `p_name`, `category`, `o_price`, `s_price`, `description`,
	 `goal`, `u_datetime`, `d_datetime`, `popular`, `isgroup`, `shipment`, `img`) VALUES 
	(NULL, '1203', '{$_SESSION["p_name"]}' , '{$_SESSION["category"]}', '{$_SESSION["o_price"]}', '{$_SESSION["s_price"]}', '{$_SESSION["product_description"]}', '{$_SESSION["goal"]}', CURRENT_TIMESTAMP, '2014-07-24 00:00:00.000000', '0', '0', '{$_SESSION["shipment"]}', '{$_SESSION["hid_path"]}')";
	
	$db = new DB();
	$db->query($sql);
	$result = mysql_query("SHOW TABLE STATUS LIKE 'product'");
	$data = mysql_fetch_assoc($result);
	$current_increment = $data['Auto_increment']-1;

	$sql2 = "SELECT * FROM `image` WHERE `url` = '{$_SESSION["hid_path"]}'";
	$db->query($sql2);
	$num = $db->get_num_rows();
	if($num<=0){
		$img_sql = "INSERT INTO `johogo`.`image` (`i_id`, `p_id`, `url`, `title`, `description`) VALUES (NULL, '{$current_increment}', '{$_SESSION["hid_path"]}', '{$_SESSION["title"]}', '{$_SESSION["img_description"]}');";
		$db->query($img_sql);	
	}
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
		      	value: 100
	    	});
	    	$( "#cancel" ).click(function() {
			  	if(confirm("確定取消?")){
			  		var p_id = $( "#pid_cancel" ).val();
			  		$.ajax({
						url: "product3_cancel.php?p_id="+p_id,
						success: function(){
							alert("取消新增成功!");
							window.location.replace("post_product.php");	
						}
					});
				}
			});
			$( "#pid_modify" ).click(function() {
			  	var p_id = $( "#pid_cancel" ).val();
			  	$.ajax({
					url: "product3_cancel.php?p_id="+p_id,
					success: function(){
						window.location.href = "post_product2.php";	
					}
				});
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
			<h2>新增完成!</h2>
			<!--<div id="progressbar" class="prefix_1 grid_10 suffix_1"></div>-->
			<p class="grid_1 alpha"></p><div id="progressbar" class="grid_10"></div><p class="grid_1 omega"></p>
			<br/>
			<br/>
			<br/>
				
				<br>
				<hr>
				<div id="final">
					<a class="btn btn-primary" type="button" id="pid_modify" style="margin-left:15px;">回上一步</a>
					<a id="cancel" class="btn btn-default" >取消新增</a>
					<?php echo "<input id=\"pid_cancel\" type=\"hidden\" value=\"".$current_increment."\">" ?>
					<a class="btn btn-primary" href="index.php">回管理頁面</a>
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