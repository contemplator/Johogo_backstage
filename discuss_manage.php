<?php
	require("db_config.php");
	require("db_class.php");
	// $_SESSION['account'] = '1201';
	if(!isset($_SESSION['account'])) {
		header("location:login.php");
	}else{
		$account = $_SESSION['account'];
	}
	$db = new DB();
	$db->connect_db($_DB['host'], $_DB['username'], $_DB['password'], $_DB['dbname']);
	$sql = "SELECT * FROM product WHERE c_account = '".$account."'";
	$db->query($sql);

	$sql2 = "SELECT * FROM company WHERE c_account = '".$account."'";
	$company = $db->getOnly($sql2);
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link rel="stylesheet" type="text/css" media="all" href="css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" media="all" href="css/reset.css" />
		<link rel="stylesheet" type="text/css" media="all" href="css/text.css" />
		<link rel="stylesheet" type="text/css" media="all" href="css/960.css" />
		<script src="http://code.jquery.com/jquery-latest.js"></script>
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
		.option{
			margin-top: 30px;
			margin-bottom: 30px;
			border:2px #ccc solid;
			border-radius:10px;
		}
		select{
			margin-top: 10px;
		}
		.new{
			text-align: right;
			float: right;
			margin-top: 10px;
			margin-right: 10px;
		}
		img{
			width: 100px;
			height: 100px;
		}
		th{
			text-align: middle;
		}
	</style>
	<body>
		<div class="header">
			<div class="container_12">
				<div class="cell">
					<span id="title">Johogo</span>
					<span id="description">輕鬆團購 買到所有你想的到的</span>
				</div>
				<div class="login_info">
					<span>[<?php echo $company["c_name"]; ?>]</span>
					<span>您好,歡迎使用!</span>
					<span>|</span>
					<span><a href="logout.php">登出</a></span>
				</div>
			</div>
		</div>
		<div class="menu">
			<div class="container_12">
				<a class="btn btn-primary menu_link" href="index.php">管理商品</a>
				<a class="btn btn-info menu_link" href="discuss_manage.php">管理討論</a>
				<!-- <a class="btn btn-info menu_link" href="">管理店家</a> -->
			</div>
		</div>
		<div class="option container_12">
			<select id="form-control1" class="form-control grid_2" >
				<option disabled>請選擇團購狀態</option>
				<option>全部</option>
				<option>未成為團購商品</option>
				<option>已成為團購商品</option>
			</select>
			<select id="form-control2" class="form-control grid_2">
				<?php 
					$sql_x = "SELECT DISTINCT `category_1` FROM `product` WHERE 1";
					$db->query($sql_x);

					echo '<option disabled>請選擇商品父類別</option><option>全部</option>';
					while($result = $db->fetch_array()){ 
						echo '<option>'.$result["category_1"].'</option>';
					}
				?>
			</select>
			<select id="form-control3" class="form-control grid_2">
				<option disabled>請選擇商品狀態</option>
				<option>全部</option>
				<option>上架</option>
				<option>下架</option>
			</select>
			<img id="ajax_signal" class="new" src="images/ok.png" style="text-align: ight;width:35px;height:30px;">
			<a class="btn new" style="text-align: right;" href="post_product.php">新增商品</a>
		</div>

		<div class="content container_12">
			<table id="display_table" class="table table-bordered">
				<tr>
					<th>商品</th>
					<th>留言者</th>
					<th>態度</th>
					<th>內容</th>
					<th>時間</th>
					<th>回應內容</th>
					<th>回應時間</th>
					<th width="50px">功能</th>
				</tr>
				<?php 
					$db = new DB();
					$sql4 = "SELECT * FROM `product`  WHERE `c_account`='".$account."'";
					$db->query($sql4);
					while($result = $db->fetch_array()){ 
						$db_cmt = new DB();
						$cmt_sql = "SELECT * FROM `comment` WHERE `p_id`='".$result['p_id']."'";
						$db_cmt->query($cmt_sql);
						while($cmt_result = $db_cmt->fetch_array()){
							$attitude = '好';
							if($cmt_result['isgood']=='0'){
								$attitude = '差';
							}
						?>

					<tr>
						<td style="width:30px"><?php echo $result['p_id']?></td>
						<td style="width:51px"><?php echo $cmt_result['m_account']?></td>
						<td style="width:30px"><?php echo $attitude?></td>
						<td style="width:230px"><?php echo $cmt_result['content']?></td>
						<td style="width:100px"><?php echo $cmt_result['datetime']?></td>
						<td style="width:230px"><?php echo $cmt_result['response']?></td>
						<td style="width:100px"><?php echo $cmt_result['r_datetime']?></td>
						<td style="width:100px"><button>回應</button>
					</tr>
				<?php }} ?>
			</table>
		</div>
		<div class="footer">
			<div class="container_12">
				<center><p>Copyright By Leo Lin</p></center>
			</div>
		</div>
		<script type="text/javascript">
			function search_update(){
					var form_control1 = $('#form-control1').val();
					// console.log(form_control1);
					if(form_control1=='未成為團購商品') {
						form_control1 = 0;
					}else if(form_control1=='已成為團購商品'){
						form_control1 = 1;
					}else{
						form_control1 = 2;
					}
					var form_control2 = $('#form-control2').val();
					var form_control3 = $('#form-control3').val();
					var xhr = $.ajax({
					    type: "POST",
					    url: "classify.php",
					    data: "c_account="+<?php echo $account?>+"&form_control1="+form_control1+"&form_control2="+form_control2+"&form_control3="+form_control3+"&discuss_manage='true'",
					    
					    success: function(msg){
					    	if(msg == "<tr><th>商品</th><th>留言者</th><th>態度</th><th>內容</th><th>時間</th><th>回應內容</th><th>回應時間</th><th width=\"50px\">功能</th></tr>"){
					    		msg = msg+"<tr><td>N/A</td><td>查無資料</td><td>N/A</td><td>N/A</td><td>N/A</td><td>N/A</td><td>N/A</td><td>N/A</td></tr>";
					    	}
					    	$('#display_table').html(msg);
					    },
					    beforeSend:function(){
             				$('#ajax_signal').attr('src', 'images/wait.gif');
               			},
		               	complete:function(){
		               		setTimeout(function() {
		               			$('#ajax_signal').attr('src','images/ok.png');
							}, 300);
		               	},
					});
				}
			$(document).ready(function(){
				$('#form-control1,#form-control2,#form-control3').change(search_update);
			});
		</script>
	</body>
</html>
<?php
	unset($_SESSION["p_name"]);
	unset($_SESSION["category"]);
	unset($_SESSION["o_price"]);
	unset($_SESSION["s_price"]);
	unset($_SESSION["product_description"]);
	unset($_SESSION["goal"]);
	unset($_SESSION["shipment"]);
	unset($_SESSION["title"]);
	unset($_SESSION["img_description"]);
	unset($_SESSION['hid_path']);
?>