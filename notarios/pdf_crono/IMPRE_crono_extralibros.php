<?php 

include('../conexion.php');
include('../extraprotocolares/view/funciones.php');

$conexion = Conectar();

$fechade = fechan_abd($_REQUEST['fechade']);
$fechaa  = fechan_abd($_REQUEST['fechaa']);


$ejecutar = mysql_query("SELECT
					concat(libros.numlibro,'-',libros.ano) as num_crono,
					libros.fecing as fecha,
					concat(libros.prinom,' ',libros.segnom,' ',libros.apepat,' ',libros.apemat) as cliente,
					libros.empresa as empresa,
					tipolibro.destiplib as tip_lib,
					nlibro.desnlibro as n_lib,
					libros.folio as folio,
					tipofolio.destipfol as tip_fol,
					libros.ruc as ruc,
					libros.dni as dni,
					libros.descritiplib as deslibro
					FROM
					libros
					LEFT JOIN nlibro ON libros.idnlibro = nlibro.idnlibro
					LEFT JOIN tipofolio ON libros.idtipfol = tipofolio.idtipfol
					LEFT JOIN tipolibro ON libros.idtiplib = tipolibro.idtiplib
					WHERE STR_TO_DATE(libros.fecing,'%Y-%m-%d') >= STR_TO_DATE('$fechade','%Y-%m-%d') 
					AND STR_TO_DATE(libros.fecing,'%Y-%m-%d') <= STR_TO_DATE('$fechaa','%Y-%m-%d')", $conexion);


echo "<table width='834' border='1' cellpadding='0' cellspacing='0' bordercolor='#000000' align='center'>";


while($roww = mysql_fetch_array($ejecutar)){

	echo "<tr>
	      <td width='74' align='center'>".substr($roww['num_crono'],0,-5)."</td>
		  <td width='81' align='center'>".fechabd_an($roww['fecha'])."</td>
		  <td width='140' align='center'>".simbolos($roww['cliente'].$roww['empresa'])."</td>
		  <td width='100' align='center'>".$roww['tip_lib']."</td>
		  <td width='91' align='center'>".$roww['n_lib']."</td>
		  <td width='68' align='center'>".$roww['folio']."</td>
		  <td width='91' align='center'>".$roww['tip_fol']."</td>
		  <td width='113' align='center'>".$roww['ruc']."</td>
			
 	</tr>";
}

   
echo"</table>";




?>