
<?php 

include ("../../conexion.php");
include ("../../extraprotocolares/view/funciones.php");



$n_cod=$_REQUEST['n_cod'];	


 echo '<table width="500" border="1" bordercolor="#003366" cellspacing="0" cellpadding="0">';
	
$sql=mysql_query("select * from deta_impe where idimpedido='".$n_cod."'",$conn);
$contador=1;
 while($row=mysql_fetch_array($sql)){
  
  echo '
  <tr>
    <td width="15" align="center">'.$contador.'</td>
    <td width="446">';
	 
	 $sql2=mysql_query("select * from cliente where idcliente='".$row['idcliente']."'",$conn);
	 $row2=mysql_fetch_array($sql2);
	 
	 echo holaacentos(strtoupper($row2['prinom']." ".$row2['segnom']." ".$row2['apepat']." ".$row2['apemat']." ".$row2['razonsocial']));
	

	echo"</td>
    <td width='39' align='center'><img id='".$row["idcliente"]."' name='$n_cod' src='../../iconos/cerrar.png' width='21' height='20' onclick='eliminar_tachado_m(this.id,this.name)'/></td>
  </tr>";
   $contador++;
  }
  
 
	
echo '</table>';	


?>

