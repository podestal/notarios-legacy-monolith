<?php
$usurio = "root";
/* Password para la conexion a Mysql. */
$passwd = "12345";
 /* Host para la conexion a Mysql. */
$host = "localhost";
/* Base de Datos que se seleccionará. */
$bd = "notarios";
/* Nombre del fichero que se descargará. */
$nombre = "dump-2.txt";
/* Determina si la tabla será vaciada (si existe) cuando  restauremos la tabla. */            
$drop = true;
/* 
* Array que contiene las tablas de la base de datos que seran resguardadas.
* Puede especificarse un valor false para resguardar todas las tablas
* de la base de datos especificada en  $bd.
* 
* Ejs.:
* $tablas = false;
*    o
* $tablas = array("tabla1", "tabla2", "tablaetc");
* 
*/
$tablas = false;
/* 
* Tipo de compresion.
* Puede ser "gz", "bz2", o false (sin comprimir)
*/
$compresion = false;

/* Conexion y eso*/
$conexion = mysql_connect($host, $usurio, $passwd)
or die("No se conectar con el servidor MySQL: ".mysql_error());
mysql_select_db($bd, $conexion)
or die("No se pudo seleccionar la Base de Datos: ". mysql_error());


/* Se busca las tablas en la base de datos */
if ( empty($tablas) ) {
    $consulta = "SHOW TABLES FROM $bd;";
    $respuesta = mysql_query($consulta, $conexion)
    or die("No se pudo ejecutar la consulta: ".mysql_error());
    while ($fila = mysql_fetch_array($respuesta, MYSQL_NUM)) {
        $tablas[] = $fila[0];
    }
}

$dump = <<<EOT

EOT;
foreach ($tablas as $tabla) {
    
    $drop_table_query = "";
    $create_table_query = "";
    $insert_into_query = "";
    
    /* Se halla el query que será capaz vaciar la tabla. 
    if ($drop) {
        $drop_table_query = "DROP TABLE IF EXISTS `$tabla`;";
    } else {
        $drop_table_query = "# No especificado.";
    }

    /* Se halla el query que será capaz de recrear la estructura de la tabla. 
    $create_table_query = "";
    $consulta = "SHOW CREATE TABLE $tabla;";
    $respuesta = mysql_query($consulta, $conexion)
    or die("No se pudo ejecutar la consulta: ".mysql_error());
    while ($fila = mysql_fetch_array($respuesta, MYSQL_NUM)) {
            $create_table_query = $fila[1].";";
    }
    
    /* Se halla el query que será capaz de insertar los datos. */
    $insert_into_query = "";
    $consulta = "SELECT * FROM $tabla;";
    $respuesta = mysql_query($consulta, $conexion)
    or die("No se pudo ejecutar la consulta: ".mysql_error());
    while ($fila = mysql_fetch_array($respuesta, MYSQL_ASSOC)) {
            $columnas = array_keys($fila);
            foreach ($columnas as $columna) {
                if ( gettype($fila[$columna]) == "NULL" ) {
                    $values[] = "NULL";
                } else {
                    $values[] = "'".mysql_real_escape_string($fila[$columna])."'";
                }
            }
            $insert_into_query .= "INSERT INTO `$tabla` VALUES (".implode(", ", $values).");      \n";
            unset($values);
    }
    
$dump .= <<<EOT


$insert_into_query

EOT;
}

/* Envio */
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