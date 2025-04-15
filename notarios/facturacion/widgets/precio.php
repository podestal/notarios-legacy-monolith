<?php
require("../../conexion.php");

$id_servicio = $_REQUEST["id_servicio"];

$consulta = mysql_query("SELECT servicios.precio1 FROM servicios WHERE servicios.id_servicio =  '".$id_servicio."'", $conn) or die(mysql_error());
$rowa = mysql_fetch_array($consulta);

$data = $rowa["precio1"];

//$data = substr($data, 0, -3);

//echo $data;

?>

    <input id="precio" name="precio" type="text" class="camposss" style="width:100px"  value="<?php echo $data; ?>" onchange="currency(this.value);"/>
    
