<?php
require("../../conexion.php");

$tipdocu = $_REQUEST["tip_docu"];

$consulta = mysql_query("SELECT t_params.grp_item FROM t_params WHERE  t_params.num_item =  '".$tipdocu."'", $conn) or die(mysql_error());
$rowa = mysql_fetch_array($consulta);

$data = $rowa["grp_item"];

?>

    <input id="numdoc1" name="numdoc1" type="text" class="camposss" style="width:100px; display:none" maxlength="6" onKeyPress="return isNumberKey(event)" value="<?php echo $data;?>"/>
    
    <input id="numdoc2" name="numdoc2" type="text" class="camposss" style="width:90px;  color:#777" readonly="readonly" disabled="disabled" value="<?php echo $data;?>" />