<?php include_once "../base.php";
$db=new DB($_POST['table']);
echo $db->del($_POST['id']);