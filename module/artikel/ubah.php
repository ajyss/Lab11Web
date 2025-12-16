<?php
$db = new Database();
$id = $_GET['id'];
$artikel = $db->getById('artikel', 'id', $id);
$form = new Form("", "Update");

if(isset($_POST['submit'])){
    $sql = "UPDATE artikel SET judul='{$db->escape($_POST['judul'])}', konten='{$db->escape($_POST['konten'])}' WHERE id='$id'";
    if($db->query($sql)){
        header("Location: /lab11_php_oop/artikel/index");
    }
}
?>
<div class='container mt-4'>
<h2>Ubah Artikel</h2>
<?php
if($artikel){
    $form->addField("judul","Judul","text",$artikel['judul']);
    $form->addField("konten","Konten","textarea",$artikel['konten']);
    $form->render();
} else {
    echo "<div class='alert alert-danger'>Data tidak ditemukan</div>";
}
?>
</div>
