<?php
    include("../../conexion.php");
    include("../models/getTypeAct.php");
        session_start();
        $idUsuario = $_SESSION["id_usu"];
        $sqlUsuario  = mysql_query("SELECT * FROM usuarios where idusuario = '$idUsuario'",$conn) or die(mysql_error());
        $rowUsuario= mysql_fetch_assoc($sqlUsuario);
?>

<link rel="stylesheet" href="../../stylesglobal.css">
<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Busqueda de Registros Protocolares</title>
    <link rel="stylesheet" href="../assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="../assets/plugins/datatables/extensions/Buttons/css/buttons.dataTables.css">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
</head>
<body style="background:none">