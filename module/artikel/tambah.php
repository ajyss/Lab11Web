<?php
$db = new Database();
$form = new Form("", "Simpan");

if(isset($_POST['submit'])){
    $data = [
        'judul' => $db->escape($_POST['judul']),
        'konten' => $db->escape($_POST['konten'])
    ];
    
    $columns = implode(",", array_keys($data));
    $values = "'" . implode("','", array_values($data)) . "'";
    $sql = "INSERT INTO artikel ($columns) VALUES ($values)";
    
    if($db->query($sql)){
        header("Location: /lab11_php_oop/artikel/index");
    }
}
?>
<div class='container mt-4'>
<h2>Tambah Artikel</h2>
<?php
$form->addField("judul","Judul","text","");
$form->addField("konten","Konten","textarea","");
$form->render();
?>
</div>
