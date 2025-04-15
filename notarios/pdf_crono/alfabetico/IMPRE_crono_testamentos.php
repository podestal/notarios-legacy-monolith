
<?php 

include('../../conexion.php');

include('../../extraprotocolares/view/funciones.php');


	$fechade = $_REQUEST['fechade'];
	$fechaa  = $_REQUEST['fechaa'];
	
	$desde = fechan_abd($fechade);
	$hasta = fechan_abd($fechaa); 

	$conexion = Conectar();
	
	$ejecutar = mysql_query("SELECT 
							kardex.fechaescritura as fec_escritura, 
							kardex.kardex as kardex, 
							concat(cliente2.prinom,' ',cliente2.segnom,' ',cliente2.apepat,' ',cliente2.apemat) as cliente, 
							cliente2.razonsocial as empresa, 
							kardex.contrato as contrato, 
							kardex.numescritura as escritura, 
							kardex.numminuta as minuta, 
							kardex.folioini as folio 
							FROM kardex INNER JOIN contratantes ON contratantes.kardex = kardex.kardex 
							INNER JOIN cliente2 ON cliente2.idcontratante = contratantes.idcontratante WHERE kardex.idtipkar='5'
							AND STR_TO_DATE(kardex.fechaescritura,'%Y-%m-%d') >= STR_TO_DATE('$desde','%Y-%m-%d') 
							AND STR_TO_DATE(kardex.fechaescritura,'%Y-%m-%d') <= STR_TO_DATE('$hasta','%Y-%m-%d')
							ORDER BY kardex.idkardex DESC", $conexion);


echo "<table width='834' border='1' cellpadding='0' cellspacing='0' bordercolor='#000000' align='center'>";


while($roww = mysql_fetch_array($ejecutar)){

	echo "<tr>
			<td width='273' valign='top'><span class='Estilo12'>".strtoupper($roww['cliente'])."</span></td>
			<td width='68' valign='top'><span class='Estilo12'>".$roww['fec_escritura']."</span></td>
			<td width='75' valign='top'><span class='Estilo12'>".$roww['kardex']."</span></td>
			<td width='262' valign='top'><span class='Estilo12'>".strtoupper($roww['contrato'])."</span></td>
			<td width='70' valign='top'><span class='Estilo12'>".simbolos($roww['minuta'])."</span></td>
			<td width='72' valign='top'><span class='Estilo12'>".simbolos($roww['folio'])."</span></td>
			
 	</tr>";
}

   
echo"</table>";




