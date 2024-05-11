<?php

/******************************************
Asisten Pemrogaman 13
 ******************************************/

include("model/Template.class.php");
include("model/DB.class.php");
include("model/Pasien.class.php");
include("model/TabelPasien.class.php");
include("view/TampilPasien.php");


$tp = new TampilPasien();

if (isset($_GET['id_hapus'])) {
    $data = $tp->hapus($_GET['id_hapus']);
    $data = $tp->tampil();
}
else if (isset($_GET['add'])) {
    $data = $tp->tambah();
}
else if (isset($_POST['add'])) {
    $data = $tp->addData($_POST);
}
else if (isset($_GET['id_edit'])) {
    $data = $tp->ubah($_GET['id_edit']);
}
else if (isset($_POST['edit'])) {
    $data = $tp->ubahData($_POST);
    $data = $tp->tampil();
}
else {
    $data = $tp->tampil();
}
