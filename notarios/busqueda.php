<?php 
include("conexion.php");

$cargo=$_POST['cargo'];
$fechaA=$_POST['fechaA'];
$fechaB=$_POST['fechaB'];

$tiempo = explode ("/", $fechaA);
$desde = $tiempo[2] . "-" . $tiempo[0] . "-" . $tiempo[1];

$tiempo2 = explode ("/", $fechaB);
$hasta = $tiempo2[2] . "-" . $tiempo2[0] . "-" . $tiempo2[1];

if(($cargo<>"") and ($fechaA=="") and ($fechaB=="")){
$consulta = mysql_query("SELECT * FROM cliente INNER JOIN cargos ON cliente.id_cargo = cargos.id_cargo WHERE cliente.id_cargo='$cargo' AND tipo_anuncio='Clasificados' AND (estado='1')", $conn) or die(mysql_error());

while($row = mysql_fetch_array($consulta)){
echo "<table width='898' border='1' align='center' cellpadding='0' cellspacing='0' bordercolor='#999999'>
                        <tr>
                          <td width='148' align='center'><span class='stylejesus'>".$row['cargo']."</span></td>
                          <td width='170' align='center'><span class='stylejesus'>".$row['empresa2']."</span></td>
                          <td width='259' align='center'><span class='stylejesus'>".$row['desc_clasi']."</span></td>
                          <td width='231' align='center'><span class='stylejesus'>".$row['direc_cv']."</span></td>
                          <td width='78' align='center'><span class='stylejesus'>".$row['fec_pub']."</span></td>
                        </tr>
                      </table>";

}
}

if(($cargo<>"") and ($fechaA<>"") and ($fechaB=="")){
$consulta = mysql_query("SELECT * FROM cliente INNER JOIN cargos ON cliente.id_cargo = cargos.id_cargo WHERE cliente.id_cargo='$cargo' AND tipo_anuncio='Clasificados' AND (estado='1' AND fec_pub='$desde')", $conn) or die(mysql_error());

while($row = mysql_fetch_array($consulta)){
echo "<table width='898' border='1' align='center' cellpadding='0' cellspacing='0' bordercolor='#999999'>
                        <tr>
                          <td width='148' align='center'><span class='stylejesus'>".$row['cargo']."</span></td>
                          <td width='170' align='center'><span class='stylejesus'>".$row['empresa2']."</span></td>
                          <td width='259' align='center'><span class='stylejesus'>".$row['desc_clasi']."</span></td>
                          <td width='231' align='center'><span class='stylejesus'>".$row['direc_cv']."</span></td>
                          <td width='78' align='center'><span class='stylejesus'>".$row['fec_pub']."</span></td>
                        </tr>
                      </table>";

}
}
if(($cargo<>"") and ($fechaA<>"") and ($fechaB<>"")){
$consulta = mysql_query("SELECT * FROM cliente INNER JOIN cargos ON cliente.id_cargo = cargos.id_cargo WHERE cliente.id_cargo='$cargo' AND (fec_pub BETWEEN '$desde' AND '$hasta' AND estado='1' AND tipo_anuncio='Clasificados')", $conn) or die(mysql_error());

while($row = mysql_fetch_array($consulta)){
echo "<table width='898' border='1' align='center' cellpadding='0' cellspacing='0' bordercolor='#999999'>
                        <tr>
                          <td width='148' align='center'><span class='stylejesus'>".$row['cargo']."</span></td>
                          <td width='170' align='center'><span class='stylejesus'>".$row['empresa2']."</span></td>
                          <td width='259' align='center'><span class='stylejesus'>".$row['desc_clasi']."</span></td>
                          <td width='231' align='center'><span class='stylejesus'>".$row['direc_cv']."</span></td>
                          <td width='78' align='center'><span class='stylejesus'>".$row['fec_pub']."</span></td>
                        </tr>
                      </table>";

}
}

/*
$consulta = mysql_query("SELECT * FROM cliente INNER JOIN cargos ON cliente.id_cargo = cargos.id_cargo WHERE cliente.id_cargo='$cargo' AND (fec_pub BETWEEN '$desde' AND '$hasta' AND estado='1')", $conn) or die(mysql_error());

while($row = mysql_fetch_array($consulta)){
echo "<table width='900' border='1' align='center' cellpadding='0' cellspacing='0' bordercolor='#999999'>
  <tr>
    <td width='103' align='center'><span class='style8'>".$row['fec_pub']."</span></td>
    <td width='108' align='center'><span class='style8'>".$row['fec_ven']."</span></td>
    <td width='220' align='center'><span class='style8'>".$row['nombre']."</span></td>
    <td width='81' align='center'><span class='style8'>".$row['telefono']."</span></td>
    <td width='221' align='center'><span class='style8'>".$row['empresa2']."</span></td>
   </tr>
</table>";
}
*/
?>