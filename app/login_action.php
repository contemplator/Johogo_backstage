<?php
	if(!is_null($_POST['submit'])){
		$account = $_POST['account'];
		$password = $_POST['password'];
		if($account == "100306020" && $password == "nccu6020"){
			echo "welcome".$account;
		}else{
			echo "wrong account or password!";
		}
	}else{
		echo "Type your account and password!";	
	}
	
?>