<link rel="stylesheet" href="stylesglobal.css">
<?php 
require_once("_ClsCon.php");
$db = new MySQLi('localhost','root','12345','notarios');
$_obj   = new _ClsCon();        
  	/*$estado 			= $_POST['estado'];
	$descrio 			= $_REQUEST['descrio'];
	$dnilib 			= $_REQUEST['dnilib'];
	$crono				= $_REQUEST['crono'];
	$rangof1 	 		= $_REQUEST['rangof1'];
	$rangof2  			= $_REQUEST['rangof2'];
	*/
		

	if (isset($_REQUEST['estado'])){ 
	   $estado=($_REQUEST['estado']);		
	}else{
	   $estado=isset($_REQUEST['estado']);
	}
	if (isset($_REQUEST['crono'])){  	
	  $crono=($_REQUEST['crono']);
	//$numkar = $rowkar['num_kardex'];  
	
    $crono2 = substr($crono,0,6);
	}else{
	 $descrio=isset($_REQUEST['descrio']);
	}
	if (isset($_REQUEST['dnilib'])){  
	 $dnilib=($_REQUEST['dnilib']);	
	}else{
	 $dnilib=isset($_REQUEST['dnilib']);
	}
	if (isset($_REQUEST['descrio'])){
	 $descrio=($_REQUEST['descrio']); 	
	}else{
	 $descrio=isset($_REQUEST['descrio']);
	}
	if (isset($_REQUEST['rangof1'])){
	 $rangof11=($_REQUEST['rangof1']); 
	  list($anio1, $mes1, $dia1) = explode("/",$rangof11); 
      $rangof1=$dia1."-".$mes1."-".$anio1;
	//echo "<br>";
	 	
	}else{
	 $rangof1=isset($_REQUEST['rangof1']);
	}
	if (isset($_REQUEST['rangof2'])){
	 $rangof22=($_REQUEST['rangof2']); 	
	 
	 list($anio, $mes, $dia) = explode("/",$rangof22); 
     $rangof2=$dia."-".$mes."-".$anio;
	 
	}else{
	 $rangof2=isset($_REQUEST['rangof2']);
	}
	/*$fecha="25/12/2013";
  
list($anio, $mes, $dia) = explode("/",$fecha); 
echo $dia."-".$mes."-".$anio;*/
	/*if (isset($_REQUEST['tipolibro'])){
	 $tipolibro=($_REQUEST['tipolibro']); 	
	}else{
	 $tipolibro=isset($_REQUEST['tipolibro']);
	}
*/
	
	if (isset($_REQUEST['pagina'])){ 
	  $pagina=$_REQUEST['pagina']; 
	}else{
	  $pagina=isset($_REQUEST['pagina']); 	
	}
	
	//echo "pab";
	
	$db = new MySQLi('localhost','root','12345','notarios');
/*	$limite				= $_POST['limite'];

	$query2 = "SELECT numlibro FROM libros";
	$res2=$db->query($query2);
	$total=$res2->num_rows;
	
	$paginas=ceil($total/17);
	*/
	
	$limite=isset($_POST['limite']);	
$query2="SELECT numlibro FROM libros";
$res2=$db->query($query2);
$total=$res2->num_rows;
$paginas=ceil($total/17);
$paginainicio = 1;
	
require_once("conexion1.php");


$articulosPorPagina = 25;
/*contador de calculo de paginacion*/
     if($estado=='1'){
     $query25="SELECT count(numlibro) as numero FROM libros";
	 }elseif($estado=='2'){
		 
		  if($rangof1==""  and $rangof2==""){
			
			 if($descrio=="" and $dnilib==""){
				 
				 if($crono!= ""){
				    $query25="SELECT  count(numlibro) as numero FROM libros
	WHERE libros.numlibro <> '' AND libros.numlibro  LIKE '%".trim($crono2)."%' GROUP BY libros.numlibro ORDER BY libros.numlibro DESC ";
				 }
			 }
			 
			 
			  if($descrio=="" and $crono==""){
				 
				 if($dnilib!= ""){
				    $query25="SELECT  count(numlibro) as numero FROM libros
	WHERE libros.numlibro <> '' AND  libros.ruc   LIKE '%".trim($dnilib)."%' GROUP BY libros.numlibro ORDER BY libros.numlibro DESC ";
				 }
			 }
			 
			  if($descrio!= ""){
				    $query25="SELECT  count(numlibro) as numero FROM libros
	WHERE libros.numlibro <> '' AND  libros.empresa   LIKE '%".trim($descrio)."%' GROUP BY libros.numlibro ORDER BY libros.numlibro DESC ";
				 }
				 
				 
	 
		  }elseif($rangof1!=""  and $rangof2!=""){
			  
			   $query25="SELECT  count(numlibro) as numero FROM libros
	WHERE libros.numlibro <> '' AND fecing>= '".$rangof1."'
								    AND fecing <= '".$rangof2."' GROUP BY libros.numlibro ORDER BY libros.numlibro DESC ";
			  
			  
			   if($descrio=="" and $dnilib==""){
				 
				 if($crono!= ""){
				    $query25="SELECT  count(numlibro) as numero FROM libros
	WHERE libros.numlibro <> '' AND libros.numlibro  LIKE '%".trim($crono2)."%' GROUP BY libros.numlibro ORDER BY libros.numlibro DESC ";
				 }
			 }
			
			  if($descrio=="" and $crono==""){
				 
				 if($dnilib!= ""){
				    $query25="SELECT  count(numlibro) as numero FROM libros
	WHERE libros.numlibro <> '' AND  libros.ruc   LIKE '%".trim($dnilib)."%' GROUP BY libros.numlibro ORDER BY libros.numlibro DESC ";
				 }
			 }
			
			 if($descrio!= ""){
				    $query25="SELECT  count(numlibro) as numero FROM libros
	WHERE libros.numlibro <> '' AND  libros.empresa   LIKE '%".trim($descrio)."%' GROUP BY libros.numlibro ORDER BY libros.numlibro DESC ";
				 }
			
			
			
			
			  
		  }
	
	 }
	 
	 
	 
	 
	 
	  $result25 = mysql_query($query25);
     $row25=mysql_fetch_row($result25);
     $articulosTotales=$row25[0]; 
	 /*continuamos con la paginacion*/
	 // obtenemos cuántas páginas hay en base a los artículos
	 $paginasTotales = ceil($articulosTotales / $articulosPorPagina);
	// nos fijamos si se envía el número de página por GET
	$paginaActual = 0;
	if(isset($_GET['pagina'])){
	    // en caso que haya datos, los casteamos a int
	    $paginaActual = (int)$_GET['pagina'];
	}
	// el número de la página actual no puede ser menor a 0
	if($paginaActual < 1){
	    $paginaActual = 1;
	}
	else if($paginaActual > $paginasTotales){ // tampoco mayor la cantidad de páginas totales
	    $paginaActual = $paginasTotales;
	}
	// obtenemos cuál es el artículo inicial para la consulta
	$articuloInicial = ($paginaActual - 1) * $articulosPorPagina;

	 if($crono2!=0){
		 $crono2=$crono2;
		 }else{
		 $crono2="";
		 }

   $query = "CALL spLisLibros('".$descrio."' ,'".$dnilib."' ,'".$crono2."' ,'".$rangof1."','".$rangof2."','".$estado."','".$articuloInicial."','".$articulosPorPagina."')";
	
	$res = $db->query($query);
	//var_dump($consulta_libros);
	//exit();
	//echo $res2->num_rows;
if($res2->num_rows){
	while ($rowkar = $res->fetch_array())
{
	
		
	$nomyape=strtoupper($rowkar['c_descontrat']);
	$textorefe=str_replace("?","'",$nomyape);
	$textoampers=str_replace("*","&",$textorefe);
	$textoamperss=str_replace("ñ","Ñ",$textoampers);
	$refii=strtoupper($textoamperss);
	
	
	if ($rowkar['tipper']=="N"){

	$nomyape=strtoupper($rowkar['apepat']." ".$rowkar['apemat']." ".$rowkar['prinom']." ".$rowkar['segnom']);
	$textorefe=str_replace("?","'",$nomyape);
	$textoampers=str_replace("*","&",$textorefe);
	$textoamperss=str_replace("ñ","Ñ",$textoampers);
	$refii=strtoupper($textoamperss);
		} else{
			$nomyape=strtoupper( $rowkar['empresa']);
			$textorefe=str_replace("?","'",$nomyape);
			$textoampers=str_replace("*","&",$textorefe);
			$textoamperss=str_replace("ñ","Ñ",$textoampers);
			$refii=strtoupper($textoamperss);

		}

$fecing = $rowkar['fecing'];
$fecing1 = explode ("-",$fecing);
$fecing2 = $fecing1[2] . "/" . $fecing1[1] . "/" . $fecing1[0];

$libros[$rowkar['numlibro']]= "<table width='823' border='1' cellpadding='0' cellspacing='0' bordercolor='#333333'>
  <tr>
  
  
    <td width='79' align='center'><a href='verlibro.php?numlibro=".$rowkar['numlibro']."'><span class='titubuskar0'>".$rowkar['numlibro']."-".$rowkar['ano']."</span></a></td>
    <td width='84' align='center'><span class='titubuskar0'>".$fecing2."</span></td>
    <td width='153' align='center'><span class='titubuskar0'>".$refii."</span></td>
    <td width='116' align='center'><span class='titubuskar0'>".$rowkar['destiplib']."</span></td>
    <td width='101' align='center'><span class='titubuskar0'>".$rowkar['desnlibro']."</span></td>
    <td width='68' align='center'><span class='titubuskar0'>".$rowkar['folio']."</span></td>
    <td width='101' align='center'><span class='titubuskar0'>".$rowkar['destipfol']."</span></td>
    <td width='73' align='center'><span class='titubuskar0'>".$rowkar['ruc']."</span></td>
    <td width='25' align='center'></td>
  </tr>
</table>";

}
}

foreach($libros as $lib){
	
	echo "<article >".$lib."</article>";
	}		

echo '<div class="paginacion" align="center" style="width: 1200px;height: 20px;">';
                   // <td width='50' align='center'><a href='verkardex.php?kardex=".$fila['kardex']."'><img src='iconos/verkar.png' width='30' height='31' border='0'></a></td>
				// mostramos la paginación
				for ($i=1; $i <= $paginasTotales; $i++) { 
				    
				    // para identificar la página actual, le agregamos una clase
				    // para darle un estilo diferente 
				    if($i == $paginaActual){
				        echo '<span class="pagina actual">' . $i . '</span>';
				    }
				    // sólo vamos a mostrar los enlaces de la primer página,
				    // las dos siguientes, las dos anteriores
				    // y la última
				    else if($i == 1 || $i == $paginasTotales || ($i >= $paginaActual - 2 && $i <= $paginaActual + 2)){
				        echo '<a href="listadolibro.php?pagina=' . $i . '&estado='.$estado.'&descrio='.$descrio.'&dnilib='.$dnilib.'&crono='.$crono.'&rangof1='.$rangof1.'&rangof2='.$rangof2.'&val=10" class="pagina">' . $i . '</a>';
			    	}
				}
	echo '</div>'
	
	
?>