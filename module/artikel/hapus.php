<?php
$db = new Database();
$id = $db->escape($_GET['id']);
$sql = "DELETE FROM artikel WHERE id='$id'";
$db->query($sql);
header("Location: /lab11_full/artikel/index");
?>