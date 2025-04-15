
 <?php
$usurio = "root";
$passwd = "12345";
$host = "localhost";
$bd = "notarios";
$nombre = "notarios_copia.txt";
            
$drop = true;
$tablas = false;
$compresion = false;

$conexion = mysql_connect($host, $usurio, $passwd)
or die("No se conectar con el servidor MySQL: ".mysql_error());
mysql_select_db($bd, $conexion)
or die("No se pudo seleccionar la Base de Datos: ". mysql_error());

if ( empty($tablas) ) {
    $consulta = "SHOW TABLES FROM $bd;";
    $respuesta = mysql_query($consulta, $conexion)
    or die("No se pudo ejecutar la consulta: ".mysql_error());
    while ($fila = mysql_fetch_array($respuesta, MYSQL_NUM)) {
        $tablas[] = $fila[0];
    }
}



EOT;
foreach ($tablas as $tabla) {
    
    $drop_table_query = "";
    $create_table_query = "";
    $insert_into_query = "";
    
    if ($drop) {
        $drop_table_query = "DROP TABLE IF EXISTS `$tabla`;     ";
    } else {
        $drop_table_query = "# No especificado.";
    }

    $create_table_query = "";
    $consulta = "SHOW CREATE TABLE $tabla;      ";
    $respuesta = mysql_query($consulta, $conexion)
    or die("No se pudo ejecutar la consulta: ".mysql_error());
    while ($fila = mysql_fetch_array($respuesta, MYSQL_NUM)) {
            $create_table_query = $fila[1].";";
    }
    
  
    
$dump .= <<<EOT

$drop_table_query


$create_table_query



EOT;
}

if ( !headers_sent() ) {
    header("Pragma: no-cache");
    header("Expires: 0");
    header("Content-Transfer-Encoding: binary");
    switch ($compresion) {
    case "gz":
        header("Content-Disposition: attachment; filename=$nombre.gz");
        header("Content-type: application/x-gzip");
        echo gzencode($dump, 9);
        break;
    case "bz2": 
        header("Content-Disposition: attachment; filename=$nombre.bz2");
        header("Content-type: application/x-bzip2");
        echo bzcompress($dump, 9);
        break;
    default:
        header("Content-Disposition: attachment; filename=$nombre");
        header("Content-type: application/force-download");
        echo $dump;
    }
} else {
    echo "<b>ATENCION: Probablemente ha ocurrido un error</b><br />\n<pre>\n$dump\n</pre>";
}
?> 