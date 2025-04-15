<?php 
include('conexion.php');

$karde = $_GET['kardex'];

$id  = $_GET['id'];


//$tipokardex = $_POST['tipokar'];






	$consulta = mysql_query("SELECT kardex AS KARDEX, mensaje AS MENSAJE FROM sisgen_mensaje where kardex ='".$karde."'", $conn) or die(mysql_error());

	
	/*
while($row = mysql_fetch_array($consulta)){

echo"<table width='834' border='1' cellpadding='0' cellspacing='0' >
  <tr>
    <td width='83' align='center'><span style='font-family:Verdana, Geneva, sans-serif; font-size:10px; color:#036;' >";
	if($row['TIPO_KARDEX']=='1'){ echo "ESCRITURA PUBLICA"; 	}
	if($row['TIPO_KARDEX']=='2'){ echo "NO CONTENSIOSOS"; 	}
	if($row['TIPO_KARDEX']=='3'){ echo "TRANSFERENCIAS VEHICULARES"; 	}
	if($row['TIPO_KARDEX']=='4'){ echo "GARANTIAS MOBILIARIAS"; 	}
	if($row['TIPO_KARDEX']=='5'){ echo "TESTAMENTOS"; 	}
	 echo"</span></td>
	<td width='35'  align='center' ><span style='font-family:Verdana, Geneva, sans-serif; font-size:10px; color:#036;' >".$row['KARDEX']."</span></td>
    <td width='43'  align='center' height='19' ><span style='font-family:Verdana, Geneva, sans-serif; font-size:10px; color:#036;' >". $row['FECHA_CONCLUSION']."</span></td>
	<td width='92'  align='center' ><span style='font-family:Verdana, Geneva, sans-serif; font-size:10px; color:#036;' >".$row['NUMERO_ESCRITURA']."</span></td>
	<td width='167'  align='center' ><span style='font-family:Verdana, Geneva, sans-serif; font-size:10px; color:#036;' >".$row['CONTRATO']."</span></td>
    <?php 
	
	?>
	<td width='56'  align='center' type='checkbox' >  ".$row['IDKARDEX']."</td>
  </tr>
</table>";
*/

		
		

while($row = mysql_fetch_array($consulta)){
	$tipkar=$row['TIPKAR'];
	$kardex=$row['KARDEX'];
	$numescritura=$row['NUM_ESC'];
	$mensaje=$row['MENSAJE'];
	$estado=$row['ESTADO'];
	
	if($estado=='0'){
		$estadodeenvio='ER';
		}
		else{
		$estadodeenvio='OK';
		}
		
		
	

?>
<table width='840' border='1' cellpadding='0' cellspacing='0'  height='auto'>
<tr height='25'>
		<td width='40' align='center'>
			<span style="font-family:Verdana, Geneva, sans-serif; font-size:10px; color:#036;" ><?php echo $kardex;?> </span>
		</td>
        <td width='150' align='center'>
			<span style="font-family:Verdana, Geneva, sans-serif; font-size:10px; color:#036;" ><?php echo $mensaje;?> </span>
		</td>
         
                <?php 
							}?>
            
        </tr>
		</table>
		
			
			