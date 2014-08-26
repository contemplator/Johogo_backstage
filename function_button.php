<?php
require("db_config.php");
require("db_class.php");

$account = $_GET["c_account"];
$p_id = $_GET["p_id"];

if($_GET["funcq"]=='rmc'){
	$sql = 'UPDATE `product` SET `status`="下架" WHERE `p_id`= "'.$p_id.'" AND `c_account`="'.$account.'"';
	$db = new DB();
	$db->query($sql);
	echo '商品下架成功!';
}else if($_GET["funcq"]=='onc'){
	$sql = 'UPDATE `product` SET `status`="上架" WHERE `p_id`= "'.$p_id.'" AND `c_account`="'.$account.'"';
	$db = new DB();
	$db->query($sql);
	echo '商品上架成功!';
}
else{
	echo 'error';
}
?>