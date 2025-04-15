<?php
$db=new MySQLi('localhost','root','12345','notarios');
$limite=$_POST['limite'];
$query2="select idkardex from kardex";
$res2=$db->query($query2);
$total=$res2->num_rows;

$paginas=ceil($total/4);

$query="CALL spLisKardex('".$nnkardex."' ,'".$tipoper."' ,'".$nomcontratante."','1',".$limite.")";
$res=$db->query($query);


if($res2->num_rows>0)
{
  while($fila=$res->fetch_array())
    {
	 $kardexs[$fila['idkardex']]="<table width='1267' border='1' cellpadding='0' cellspacing='0' bordercolor='#333333' >
  <tr>
    <td width='63' align='center' ><span class='reskar'><a href='verkardex.php?kardex=".$fila['kardex']."'>".$fila['kardex']."</a></span></td>
	<td width='200' align='center' ><span class='reskar'>".$fila['nomtipkar']."</span></td>
    <td width='86' align='center' ><span class='reskar'>".$fila['fechaingreso']."</span></td>
    <td width='238' align='center'><span class='reskar'>".$fila['contrato']."</span></td>
    <td width='257' align='center'><span class='reskar'>".$fila['referencia']."</span></td>
    <td width='90' align='center'><span class='reskar'>".$fila['fechaescritura']."</span></td>
    <td width='96' align='center'><span class='reskar'>".$fila['numescritura']."</span></td>
    <td width='70' align='center'><span class='reskar'>".$fila['folioini']."</span></td>
    <td width='97' align='center'><span class='reskar'> / / </span></td>
    <td width='50' align='center'><a href='verkardex.php?kardex=".$fila['kardex']."'><img src='iconos/verkar.png' width='30' height='31' border='0'></a></td>
  </tr>
</table>";
	 
	 
    }
}


		
foreach($kardexs as $kardex){
	
	echo "<article >".$kardex."</article>";
	}		

echo "<table width='100' border='0' cellspacing='0'cellpadding='0'>
  <tr>
    <td width='45'>"; if ($limite>0){
	
	$limit=$limite-4;
	echo "<aside onClick=\"cargakardex(".$limit.")\"><img src='ante.png' width='37' height='36' border='0' title='Anterior'></aside>";
	
	}else{
		echo "<aside></aside>";
		} echo"</td>
    <td width='10'> 
	 |
</td>
    <td width='45'>"; 
	
	if ($limite<$total-4){
	
	$limit=$limite+4;
	echo "<aside onClick=\"cargakardex(".$limit.")\"><img src='sigte.png' width='37' height='36' border='0' title='Siguiente'></aside>";
	
	}else{
		echo "<aside></aside>";
		}
	
	echo"</td>
  </tr>
</table>";

?>