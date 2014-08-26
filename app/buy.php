<?php
	require("../db_config.php");
    require("../db_class.php");
    $db = new DB();
    $db->connect_db($_DB['host'], $_DB['username'], $_DB['password'], $_DB['dbname']);

    $data = array();
    $data_tmp = array();
    // get request
    if(!is_null($_POST['student_id'])){
        // $_POST['student_id'] = "100306020";
        $sql = "SELECT * FROM buy,product WHERE buy.product_id = product.p_id AND buy.student_id = \"".$_POST['student_id']."\"";
        $db->query($sql);
        while($result = $db->fetch_array()){
            array_push($data, $result);
        }
    }
    echo json_encode($data);
?>