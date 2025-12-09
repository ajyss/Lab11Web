<?php
$db = new Database();
$id = $_GET['id'];
$sql = "DELETE FROM artikel WHERE id='$id'";
$db->query($sql);
header("Location: /lab11_full/artikel/index");
?>