<?php
	session_start();
	require_once ('db_class.php');
	$sql = "DELETE FROM `johogo`.`product` WHERE `product`.`p_id` = '".$_GET["p_id"]."'";

	$db = new DB();
	$db->query($sql);
?>