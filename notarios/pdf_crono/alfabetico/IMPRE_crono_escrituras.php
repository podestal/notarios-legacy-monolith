
<?php 

include('../../conexion.php');

include('../../extraprotocolares/view/funciones.php');


	$fechade = $_REQUEST['fechade'];
	$fechaa  = $_REQUEST['fechaa'];
	
	$desde = fechan_abd($fechade);
	$hasta = fechan_abd($fechaa); 

	$conexion = Conectar();
	
	$ejecutar = mysql_query("SELECT 
					   UPPER((CASE WHEN (cliente2.tipper='N') THEN CONCAT(cliente2.apepat,' ',cliente2.apemat,' ',cliente2.prinom,' ',cliente2.segnom) ELSE cliente2.razonsocial END)) AS 'cliente',
					   kardex.fechaescritura, 
					   kardex.kardex,
  					   kardex.contrato, 
					   kardex.numescritura, 
					   kardex.numminuta, 
					   kardex.folioini
					   FROM kardex
					   INNER JOIN contratantes ON contratantes.kardex = kardex.kardex AND contratantes.indice='1'
					   INNER  JOIN cliente2 ON cliente2.idcontratante = contratantes.idcontratante 
					   WHERE kardex.idtipkar='1'
					   AND STR_TO_DATE(kardex.fechaescritura,'%Y-%m-%d') >= STR_TO_DATE('$desde','%Y-%m-%d') 
					   AND STR_TO_DATE(kardex.fechaescritura,'%Y-%m-%d') <= STR_TO_DATE('$hasta','%Y-%m-%d')
					   ORDER BY cliente ASC", $conexion);


echo "<table width='834' border='1' cellpadding='0' cellspacing='0' bordercolor='#000000' align='center'>";


while($roww = mysql_fetch_array($ejecutar)){

	echo "<tr>
			<td width='273' valign='top'><span class='Estilo12'>".strtoupper($roww['cliente'])."</span></td>
			<td width='68' valign='top'><span class='Estilo12'>".$roww['fechaescritura']."</span></td>
			<td width='75' valign='top'><span class='Estilo12'>".$roww['kardex']."</span></td>
			<td width='262' valign='top'><span class='Estilo12'>".strtoupper($roww['contrato'])."</span></td>
			<td width='70' valign='top'><span class='Estilo12'>".simbolos($roww['numminuta'])."</span></td>
			<td width='72' valign='top'><span class='Estilo12'>".simbolos($roww['folioini'])."</span></td>
			
 	</tr>";
}

   
echo"</table>";




