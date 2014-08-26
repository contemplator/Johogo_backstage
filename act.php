<?php
// 確認使用者已上傳檔案
if ( $_FILES['MyPhoto']['tmp_name'] != "none" &&
     $_FILES['MyPhoto']['tmp_name'] != "" &&
     $_FILES['MyPhoto']['size'] > 0 ) {
  // 其「tmp_name」元素代表該檔在伺服器中的暫存路徑與檔名
  echo "暫存檔名：" . $_FILES['MyPhoto']['tmp_name'] . "<br>";

  // 其「name」元素代表該檔案的原始檔名
  echo "原始檔名：" . $_FILES['MyPhoto']['name'] . "<br>";

  // 其「size」元素代表該檔案之大小
  echo "檔案大小：" . $_FILES['MyPhoto']['size'] . "<br>";

  // 其「type」元素表示該檔案之 MIME type
  echo "檔案型態：" . $_FILES['MyPhoto']['type'] . "<br>";
}
// 上傳檔案之存放路徑
$UploadPath = "";

copy($_FILES['MyPhoto']['tmp_name'], $UploadPath.$_FILES['MyPhoto']['name']);

echo "<img src=".$_FILES['MyPhoto']['name'].">";

?>