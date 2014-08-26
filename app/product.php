<?php
	require("../db_config.php");
    require("../db_class.php");
    $db = new DB();
    $db->connect_db($_DB['host'], $_DB['username'], $_DB['password'], $_DB['dbname']);

    $data = array();
    // get request
    $category_1;
    if($_REQUEST["category"] == "全部"){
        $sql = "SELECT * FROM product WHERE 1";
        $db->query($sql);
        $data = array();
        while($result = $db->fetch_array()){
            array_push($data, $result);
        }
    }else if ($_REQUEST["category"] !== null){
        $category_1 = $_REQUEST["category"];
        $sql = "SELECT * FROM product WHERE `category_1` = '".$category_1."';";
        $db->query($sql);
        $data = array();
        while($result = $db->fetch_array()){
            array_push($data, $result);
        }
    }
    echo json_encode($data);
?>