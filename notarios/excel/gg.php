<html>

    
    <head>
	  <style type="text/css">
	    @page {
	        mso-page-orientation: landscape;
	        size: landscape;
	    }
	  </style>
	</head>
<body>
<?php

header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=Reporte_camara.xls");

include("../conexion.php");
$consulta = mysql_query("SELECT fechaescritura,kardex,contrato,numescritura,numminuta,folioini, CAST(numescritura AS SIGNED) AS numescritura2 FROM kardex WHERE idtipkar='1' and fechaescritura <> '' 
					   AND STR_TO_DATE(fechaescritura,'%Y-%m-%d') >= STR_TO_DATE('2011-01-01','%Y-%m-%d') 
					   AND STR_TO_DATE(fechaescritura,'%Y-%m-%d') <= STR_TO_DATE('2014-12-23','%Y-%m-%d') order by fechaescritura, numescritura2, numminuta asc", $conn) or die(mysql_error());
$contador=mysql_num_rows($consulta);
$paginador=1;	

include ('TablaEscrituras.php');
?></table>
<?php

$x=0;
while($row = mysql_fetch_array($consulta))
{           
    $nombre = $row['kardex'];
    
    echo "$nombre<br>";
    
    if(45==$x)
    {
		
        include ('TablaEscrituras.php');
        $x = 0;
		$paginador++;
    }
    
    $x++;
} 
?>
</body>
</html>