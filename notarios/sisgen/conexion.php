<?php
$URL_KARDEX = "https://servicios.notarios.org.pe/sisgen-web/DocumentosNotarialesService";
$URL_LIBROS = "https://servicios.notarios.org.pe/sisgen-web/DocumentosLibrosService";
$serverDataBase      = 'db';
$userDataBase   = 'root';
$passwordDataBase  = '12345';
$nameDataBase = 'notarios';
$conn    = mysqli_connect($serverDataBase,$userDataBase,$passwordDataBase,$nameDataBase);
$conn->set_charset("utf8");
//mysqli_query($conn_i,"SET CHARACTER SET 'utf8'");
?>