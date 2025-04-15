<script type="text/javascript" src="ConstiEmpresa.js"></script> 
<?php
require("conexion.php");

$razonsocial = $_REQUEST["razonsocial"];
//echo $razonsocial;

$consulkar=mysql_query("SELECT cliente.idcliente, cliente.razonsocial FROM cliente WHERE cliente.numdoc = '' AND cliente.razonsocial like '%".$razonsocial."%' ", $conn) or die(mysql_error());

while($rowkar = mysql_fetch_array($consulkar)){

echo "<table width='100%' border='1' cellpadding='0' cellspacing='0' bordercolor='#333333' >
  	  <tr>
    	<td width='250'><span class='reskar'><a class='sel_idcliente' href='#' id='".$rowkar['idcliente']."' onclick='//ShowCoinciDes(this.id)'>".strtoupper($rowkar['razonsocial'])."</a></span></td>
  	  </tr>
	  </table>";
}
?>
