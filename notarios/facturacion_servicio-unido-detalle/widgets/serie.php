<?php
require("../../conexion.php");

$tipdocu = $_REQUEST["tip_docu"];

$consulta = mysql_query("SELECT t_params.serie_item FROM t_params WHERE  t_params.num_item = '".$tipdocu."'", $conn) or die(mysql_error());
$rowa = mysql_fetch_array($consulta);

$data = $rowa["serie_item"];

?>

    <input id="serie1" name="serie1" type="text" class="camposss" style="width:30px; display:none; " maxlength="2" onKeyPress="return isNumberKey(event)" value="<?php echo $data; ?>" />
    
    <input id="serie2" name="serie2" type="text" class="camposss" style="width:30px;  color:#777" readonly="readonly"  disabled="disabled" value="<?php echo $data; ?>" />