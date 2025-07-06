<?php
$con = mysqli_connect("localhost", "root", "91341534", "pets_db");

if (!$con) {
    die("Erro ao conectar: " . mysqli_connect_error());
}
?>