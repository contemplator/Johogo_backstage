<?php
	require("../db_config.php");
    require("../db_class.php");
    $db = new DB();
    $db->connect_db($_DB['host'], $_DB['username'], $_DB['password'], $_DB['dbname']);

    $data = array();
    // get request
    $category;
    if($_REQUEST["category"] == "全部"){
        $sql = "SELECT * FROM `discuz` WHERE 1 ORDER BY `datetime` DESC";
        $db->query($sql);
        $data = array();
        while($result = $db->fetch_array()){
            array_push($data, $result);
        }
    }else if ($_REQUEST["category"] !== null){
        $category = $_REQUEST["category"];
        $sql = "SELECT * FROM `discuz` WHERE `category` = '".$category."' ORDER BY `datetime` DESC;";
        $db->query($sql);
        $data = array();
        while($result = $db->fetch_array()){
            array_push($data, $result);
        }
    }
    echo json_encode($data);
?>