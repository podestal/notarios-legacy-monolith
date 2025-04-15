
<?php
$URL_KARDEX = "https://servicios.notarios.org.pe/sisgen-web/DocumentosNotarialesService";
$URL_LIBROS = "https://servicios.notarios.org.pe/sisgen-web/DocumentosLibrosService";
$serverDataBase      = 'localhost';
$userDataBase   = 'root';
$passwordDataBase  = '12345';
$nameDataBase = 'notariospedro';
$conn    = mysqli_connect($serverDataBase,$userDataBase,$passwordDataBase,$nameDataBase);
//$conn->set_charset("utf8");
//mysqli_query($conn_i,"SET CHARACTER SET 'utf8'");
$querySinCondicion = "SELECT * FROM profesiones WHERE idprofesion = 12";
$conSinCondicion = mysqli_query( $conn,$querySinCondicion) or die("error");
$sinCon = mysqli_fetch_array($conSinCondicion);
var_dump($sinCon);
?>
