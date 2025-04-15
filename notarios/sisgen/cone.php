<?php
require_once 'conexion.php';

?>
<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <title></title>
</head>
<body>
<form action="" method="post">
 <p>Dni: <input type="text" name="nombre" /></p>
 <p>Fecha: <input type="text" name="fecha" /></p>
 <p>
<input type="submit" /></p>
</form>
</body>
</html>


<?php 
echo $_POST['nombre']; 
$dni = $_POST['nombre'];
$fecha = $_POST['fecha'];
$sql = "UPDATE cliente2 
        INNER JOIN cliente ON cliente.`idcliente` = cliente2.`idcliente`
        SET cliente2.cumpclie = cliente.cumpclie
        WHERE cliente2.tipper = 'N' AND cliente2.numdoc = '$dni'";

if(trim($fecha)!=''){
        $sql = "UPDATE cliente2 
        INNER JOIN cliente ON cliente.`idcliente` = cliente2.`idcliente`
        SET cliente2.cumpclie = '$fecha'
        WHERE cliente2.tipper = 'N' AND cliente2.numdoc = '$dni'";
}

$result = mysqli_query($conn,$sql) or die("ERROR EN CONSULTA");
var_dump('resultado');
var_dump($sql);
var_dump($result);
?>

