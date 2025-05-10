<?php

/******************************************
 Asisten Pemrogaman 13 & 14
******************************************/

include("view/TampilMahasiswa.php");

$tp = new TampilMahasiswa();

if (isset($_POST['add'])) {
    $data = $_POST;
    $tp->add($data);
}
else if (isset($_POST['update'])) {
    $data = $_POST;
    $tp->edit($data);
}
else if (!empty($_GET['id_hapus'])) {
    // Mengambil nilai ID yang spesifik
    $id = $_GET['id_hapus'];
    $tp->delete($id);
}
else if (!empty($_GET['id_edit'])) {
    // Mengambil nilai ID yang spesifik
    $id = $_GET['id_edit'];
    $tp->Tampilformedit($id);
}
else if (isset($_GET['page']) && $_GET['page'] == 'tambah') {
    // Menampilkan form tambah mahasiswa
    include("templates/tambahjir.html");
}
else {
    $tp->tampil();
}