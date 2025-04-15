<?php
$URL_KARDEX = "https://servicios.notarios.org.pe/sisgen-web/DocumentosNotarialesService";
$URL_LIBROS = "https://servicios.notarios.org.pe/sisgen-web/DocumentosLibrosService";
$serverDataBase      = 'localhost';
$userDataBase   = 'root';
$passwordDataBase  = '12345';
$nameDataBase = 'notarios';
$conn    = mysqli_connect($serverDataBase,$userDataBase,$passwordDataBase,$nameDataBase);
$conn->set_charset("utf8");
?>