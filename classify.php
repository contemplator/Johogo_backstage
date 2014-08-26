<?php
require("db_config.php");
require("db_class.php");
$form_control1 = $_POST["form_control1"];
$form_control2 = $_POST["form_control2"];
$form_control3 = $_POST["form_control3"];
$account = $_POST["c_account"];
if(isset($_POST["discuss_manage"])=='true') {
	if($form_control1==0){
		$sql1 = 'SELECT * FROM `product` WHERE `popular`<`goal`';
	}elseif($form_control1==1){
		$sql1 = 'SELECT * FROM `product` WHERE `popular`>=`goal`';
	}elseif($form_control1==2){
		$sql1 = 'SELECT * FROM `product` WHERE `goal`=`goal`';
	}
	if($form_control2=='全部'){
		$sql2=''; 
	}else{
		$sql2 = 'AND `category_1`="'.$form_control2.'"';
	}
	if($form_control3=='全部'){
		$sql3=''; 
	}else{
		$sql3 = 'AND `status`="'.$form_control3.'"';
	}
	$sql = $sql1.$sql2.$sql3.'AND `c_account`="'.$account.'"';
	$db = new DB();
	$db->query($sql);
	echo '<tr><th>商品</th><th>留言者</th><th>態度</th><th>內容</th><th>時間</th><th>回應內容</th><th>回應時間</th><th width="50px">功能</th></tr>';
	while($result = $db->fetch_array()){
		$db_cmt = new DB();
		$cmt_sql = "SELECT * FROM `comment` WHERE `p_id`='".$result['p_id']."'";
		$db_cmt->query($cmt_sql);
		while($cmt_result = $db_cmt->fetch_array()){
			$attitude = '好';
			if($cmt_result['isgood']=='0'){
				$attitude = '差';
			}
			echo '<tr>
				<td style="width:30px">'.$result['p_id'].'</td>
				<td style="width:51px">'.$cmt_result['m_account'].'</td>
				<td style="width:30px">'.$attitude.'</td>
				<td style="width:230px">'.$cmt_result['content'].'</td>
				<td style="width:100px">'.$cmt_result['datetime'].'</td>
				<td style="width:230px">'.$cmt_result['response'].'</td>
				<td style="width:100px">'.$cmt_result['r_datetime'].'</td>
				<td style="width:100px"><button>回應</button>
				</tr>';
		}
	}
}else{
	if($form_control1==0){
		$sql1 = 'SELECT * FROM `product` WHERE `popular`<`goal`';
	}elseif($form_control1==1){
		$sql1 = 'SELECT * FROM `product` WHERE `popular`>=`goal`';
	}elseif($form_control1==2){
		$sql1 = 'SELECT * FROM `product` WHERE `goal`=`goal`';
	}
	if($form_control2=='全部'){
		$sql2=''; 
	}else{
		$sql2 = 'AND `category_1`="'.$form_control2.'"';
	}
	if($form_control3=='全部'){
		$sql3=''; 
	}else{
		$sql3 = 'AND `status`="'.$form_control3.'"';
	}
	$sql = $sql1.$sql2.$sql3.'AND `c_account`="'.$account.'"';
	$db = new DB();
	$db->query($sql);
	echo '<tr><th>狀態</th><th>名稱</th><th>圖片</th><th>原價</th><th>特價</th><th>狀況</th><th>時間</th><th width="50px">功能</th></tr>';
	while($result = $db->fetch_array()){
		$db_img = new DB();
		$img_sql = "SELECT `url` FROM `image` WHERE `p_id`='".$result['p_id']."'";
		$img_result = $db_img->getOnly($img_sql);
		echo '
		<tr>
		<td style="width:30px">'.$result['status'].'</td>
		<td style="width:51px">'.$result['p_name'].'</td>
		<td style="width:133px"><img src="'.$img_result["url"].'"></td>
		<td style="width:51px">'.$result['o_price'].'</td>
		<td style="width:51px">'.$result['s_price'].'</td>';
		if($result['popular']<$result['goal']){
			echo '<td style="width:86px">未達('.$result['popular'].'/'.$result['goal'].')</td>';
		}else{
			echo '<td style="width:86px">已達('.$result['popular'].'/'.$result['goal'].')</td>';
		}
		if($result['status']=='上架'){
			echo '<td style="width:306px">'.$result['u_datetime'].' ~ '.$result['d_datetime'].'</td>
		<td style="width:141px"><button>編輯</button><button>報告</button><button value="'.$result['p_id'].'" onclick="remove_shelf(this.value)">下架</button></td>
		</tr>';
		}else if($result['status']=='下架'){
			echo '<td style="width:306px">'.$result['u_datetime'].' ~ '.$result['d_datetime'].'</td>
		<td style="width:141px"><button>編輯</button><button>報告</button><button value="'.$result['p_id'].'" onclick="on_shelf(this.value)">上架</button></td>
		</tr>';
		}
	}
}

?>