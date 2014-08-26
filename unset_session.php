<?php
session_start();

if($_POST['action'] == "unset_img"){
	unset($_SESSION['hid_path']);
}

?>