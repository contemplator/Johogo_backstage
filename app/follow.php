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
        $sql = "SELECT * FROM follow, product WHERE follow.p_id = product.p_id And student_id = \"".$_POST['student_id']."\"";
        $db->query($sql);
        while($result = $db->fetch_array()){
            $data_tmp['student_id'] = $result["student_id"];
            $data_tmp['datetime'] = $result['datetime'];
            $data_tmp['product_name'] = $result["p_name"];
            $data_tmp['category'] = $result['category_1'];
            $data_tmp['goal'] = $result['goal'];
            $data_tmp['s_price'] = $result['s_price'];
            $data_tmp['o_price'] = $result['o_price'];
            $data_tmp['c_account'] = $result['c_account'];

            $sql_count = "SELECT COUNT(`p_id`) FROM `follow` WHERE `p_id` = \"".$result["p_id"]."\" GROUP BY `p_id`";
            $db_count = new DB();
            $db_count->query($sql_count);
            while($result_count = $db_count->fetch_array()){
                $data_tmp['count'] = $result_count["COUNT(`p_id`)"];
            }
            array_push($data, $data_tmp);
        }
    }
    echo json_encode($data);
?>