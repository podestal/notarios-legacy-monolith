<?php 
include("../../conexion.php");

$sql =mysql_query("SELECT * FROM m_cteventas",$conn) or die(mysql_error());

$evalbus      = $_REQUEST["evalbus"];
$codigo_cli   = $_REQUEST["codigo_cli"];
$tipo_docu    = $_REQUEST["tipo_docu"];
$serie        = $_REQUEST["serie"];
$documento    = $_REQUEST["documento"];

?>
<script type="text/javascript" src="../includes/Mantenimientos.js"></script> 
<style type="text/css">
<!--
.titubuskar {
	font-family: Calibri;
	font-size: 12px;
	font-weight: bold;
	font-style: italic;
	color: #003366;
}
.titubuskar0 {font-family: Calibri; font-size: 12px; font-style: italic; font-weight: bold; color: #333333; }
.titubuskar1 {color: #333333}
.reskar2 {font-family: Calibri; font-size: 13px; font-weight: bold; font-style: italic; color: #003366; }
.reskar {font-size: 12px; font-style: italic; color: #333333; font-family: Calibri;}
-->
</style>
<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td colspan="2"><div id="gennn" style="width:100%; height:300; overflow:auto;">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#333333" bgcolor="#CCCCCC">
            <tr>
              <td width="150" align="left"><span class="titubuskar0">Id</span></td>
              <td width="150" align="left"><span class="titubuskar0">Tipo</span></td>
              <td width="120" align="left"><span class="titubuskar0">Serie</span></td>
              <td width="120" align="left"><span class="titubuskar0">Documento</span></td>
              <td width="120" align="left"><span class="titubuskar0">Fecha</span></td>
              <td width="120" align="left"><span class="titubuskar0">Saldo</span></td>
              <td width="50" align="right"><span class="titubuskar0"></span></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td><div id="bkardex">
            <?php 
include("../../conexion.php");
if($evalbus=='0')           ## POR DEFECTO
{ 
$consulkar = mysql_query("SELECT m_cteventas.id_ctaventas AS 'id', tip_documen.des_docum AS 'tipo', m_cteventas.serie AS 'serie', m_cteventas.documento AS 'documento', m_cteventas.fecha AS 'fecha', m_cteventas.saldo AS 'saldo'
FROM m_cteventas
INNER JOIN tip_documen ON tip_documen.id_documen = m_cteventas.tipo_docu
WHERE m_cteventas.swt_est <> 'T' AND tipopago='2' ", $conn) or die(mysql_error());
}
else if($evalbus=='2')      ## POR ID DEL CLIENTE
{ 
$consulkar = mysql_query("SELECT m_cteventas.id_ctaventas AS 'id', tip_documen.des_docum AS 'tipo', m_cteventas.serie AS 'serie', m_cteventas.documento AS 'documento', m_cteventas.fecha AS 'fecha', m_cteventas.saldo AS 'saldo'
FROM m_cteventas
INNER JOIN tip_documen ON tip_documen.id_documen = m_cteventas.tipo_docu
WHERE m_cteventas.swt_est <> 'T' AND tipopago='2' AND m_cteventas.num_docu_cli = '$codigo_cli' ", $conn) or die(mysql_error());
}
else if($evalbus=='1')      ## POR NUMERO DE DOCUMENTO
{
$consulkar = mysql_query("SELECT m_cteventas.id_ctaventas AS 'id', tip_documen.des_docum AS 'tipo', m_cteventas.serie AS 'serie', m_cteventas.documento AS 'documento', m_cteventas.fecha AS 'fecha', m_cteventas.saldo AS 'saldo'
FROM m_cteventas
INNER JOIN tip_documen ON tip_documen.id_documen = m_cteventas.tipo_docu
WHERE m_cteventas.swt_est <> 'T' AND m_cteventas.tipo_docu = '$tipo_docu' AND m_cteventas.serie = '$serie' AND tipopago='2' AND m_cteventas.documento = '$documento' ", $conn) or die(mysql_error());		
}

while($rowkar = mysql_fetch_array($consulkar)){

echo "<table width='100%' border='1' cellpadding='0' cellspacing='0' bordercolor='#333333' >
  <tr>
    <td width='150' align='left' ><span class='reskar'>".$rowkar['id']."</span></td>
	<td width='150' align='left' ><span class='reskar'>".$rowkar['tipo']."</span></td>
	<td width='120' align='left' ><span class='reskar'>".$rowkar['serie']."</span></td>
	<td width='120' align='left' ><span class='reskar'>".$rowkar['documento']."</span></td>
	<td width='120' align='left' ><span class='reskar'>".$rowkar['fecha']."</span></td>
	<td width='120' align='right' ><span class='reskar'>".$rowkar['saldo']."</span></td>
	<td width='50' align='center' ><a href='#' id='".$rowkar['id']."' name='".$rowkar['id']."' onclick='PagarDocu(this.id)'><img src='../../images/cobrar.png' width='16' height='18'></a></td>
  </tr>
</table>";
}
?>
          </div></td>
        </tr>
      </table>
    </div></td>
  </tr>
</table>



