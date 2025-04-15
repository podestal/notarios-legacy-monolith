 <link rel="stylesheet" href="stylesglobal.css">
<?php 
//echo "<link rel=\"stylesheet\" href=\"../includes/paginado.css\" type=\"text/css\" >"; 

require_once("../../includes/_ClsCon.php");
 $db=new MySQLi('localhost','root','12345','notarios');
       	$_obj   = new _ClsCon();

	/*$estado 			= $_POST['estado'];
	$numformu 			= $_REQUEST['numformu'];
	$participante 		= $_REQUEST['participante'];
	$rango1  			= $_REQUEST['rango1'];
	$rango2 			= $_REQUEST['rango2'];
	$tippersona  		= $_REQUEST['tippersona'];
	$nrocontrol			= $_REQUEST['nrocontrol'];*/
	
	if (isset($_REQUEST['estado'])){ 
	  $estado=($_REQUEST['estado']);		
	}else{
	   $estado=isset($_REQUEST['estado']);
	}
	if (isset($_REQUEST['numformu'])){  	
	echo $numformu=($_REQUEST['numformu']);
	//$numkar = $rowkar['num_kardex'];  
	//echo "<br>";
	if($numformu!=""){
    echo  $numformu2 = substr($numformu,6,4).'0'.substr($numformu,0,5);
	}
	}else{
	  $numformu=isset($_REQUEST['numformu']);
	}
	if (isset($_REQUEST['participante'])){  
	 $participante=($_REQUEST['participante']);	
	}else{
	 $participante=isset($_REQUEST['participante']);
	}
	if (isset($_REQUEST['rango1'])){
	echo  $rango1=($_REQUEST['rango1']); 	
	}else{
	echo  $rango1=isset($_REQUEST['rango1']);
	}
	if (isset($_REQUEST['rango2'])){
	echo  $rango2=($_REQUEST['rango2']); 	
	}else{
	echo  $rango2=isset($_REQUEST['rango2']);
	}
	if (isset($_REQUEST['tippersona'])){
	 $tippersona=($_REQUEST['tippersona']); 	
	}else{
	 $tippersona=isset($_REQUEST['tippersona']);
	}
	if (isset($_REQUEST['nrocontrol'])){
	 $nrocontrol=($_REQUEST['nrocontrol']); 	
	}else{
 $nrocontrol=isset($_REQUEST['nrocontrol']);
	}
	
	if (isset($_REQUEST['pagina'])){ 
	  $pagina=$_REQUEST['pagina']; 
	}else{
	  $pagina=isset($_REQUEST['pagina']); 	
	}
	
    	if (isset($_REQUEST['resultados'])){ 
	   $resultados=$_REQUEST['resultados']; 
	}else{
	   $resultados=isset($_REQUEST['resultados']); 	
	}
 	
	
	
	
	
	

	
	$db=new MySQLi('localhost','root','12345','notarios');
	
	//$limite=$_POST['limite'];
	/*$limite=isset($_POST['limite']);
	$query2="SELECT id_viaje FROM permi_viaje";
	$res2=$db->query($query2);
	$total=$res2->num_rows;
	
	$paginas=ceil($total/17);
	$paginainicio = 1;*/

$limite=isset($_POST['limite']);	
$query2="SELECT id_viaje FROM permi_viaje";
$res2=$db->query($query2);
$total=$res2->num_rows;
$paginas=ceil($total/17);
$paginainicio = 1;
	
require_once("funciones.php");


$articulosPorPagina = 20;
/*contador de calculo de paginacion*/
     if($estado=='1'){
     $query25="SELECT count(id_viaje) as numero FROM permi_viaje";
	 }elseif($estado=='2'){
		
		 if($rango1==""  and $rango2==""){
			
	         //echo $nnkardex;
			if($numformu == "" and $tippersona == "" and $nrocontrol == "") {
				 if($participante!= "") {
	         $query25="SELECT DISTINCT count(permi_viaje.id_viaje) as numero FROM permi_viaje LEFT OUTER JOIN viaje_contratantes ON viaje_contratantes.id_viaje = permi_viaje.id_viaje
		    LEFT OUTER JOIN c_condiciones ON c_condiciones.id_condicion = viaje_contratantes.c_condicontrat WHERE permi_viaje.id_viaje <> '' AND viaje_contratantes.c_descontrat  LIKE  '%".trim($participante)."%' GROUP BY permi_viaje.id_viaje ";
	       }
		   }
		   
		   if($numformu == "" and $participante == "" and $nrocontrol == "") {
			     if($nrocontrol!= "") {
	         $query25="SELECT DISTINCT count(permi_viaje.id_viaje) as numero FROM permi_viaje LEFT OUTER JOIN viaje_contratantes ON viaje_contratantes.id_viaje = permi_viaje.id_viaje
		    LEFT OUTER JOIN c_condiciones ON c_condiciones.id_condicion = viaje_contratantes.c_condicontrat WHERE permi_viaje.id_viaje <> '' AND  permi_viaje.asunto LIKE  '%".trim($tippersona)."%' GROUP BY permi_viaje.id_viaje ";
			     }
	       }
		    
		    if($numformu == "" and $participante == "" and $tippersona == "") {
				//echo  $nrocontrol;
				    if($nrocontrol!= "") {
	      $query25="SELECT DISTINCT count(permi_viaje.id_viaje) as numero FROM permi_viaje LEFT OUTER JOIN viaje_contratantes ON viaje_contratantes.id_viaje = permi_viaje.id_viaje
		    LEFT OUTER JOIN c_condiciones ON c_condiciones.id_condicion = viaje_contratantes.c_condicontrat WHERE permi_viaje.id_viaje <> '' AND  permi_viaje.id_viaje='".trim($nrocontrol)."' GROUP BY permi_viaje.id_viaje ";
			         }
	       }
		   
		   if($numformu!= "") {
	         $query25="SELECT DISTINCT count(permi_viaje.id_viaje) as numero FROM permi_viaje LEFT OUTER JOIN viaje_contratantes ON viaje_contratantes.id_viaje = permi_viaje.id_viaje
		    LEFT OUTER JOIN c_condiciones ON c_condiciones.id_condicion = viaje_contratantes.c_condicontrat WHERE permi_viaje.id_viaje <> '' AND permi_viaje.num_kardex LIKE  '%".trim($numformu2)."%' GROUP BY permi_viaje.id_viaje ";
 
                   if($participante!= "") {
	         $query25="SELECT DISTINCT count(permi_viaje.id_viaje) as numero FROM permi_viaje LEFT OUTER JOIN viaje_contratantes ON viaje_contratantes.id_viaje = permi_viaje.id_viaje
		    LEFT OUTER JOIN c_condiciones ON c_condiciones.id_condicion = viaje_contratantes.c_condicontrat WHERE permi_viaje.id_viaje <> '' AND viaje_contratantes.c_descontrat LIKE  '%".trim($participante)."%' GROUP BY permi_viaje.id_viaje ";
 
	       }
	       }
		   
		 
		  }elseif($rango1!=""  and $rango2!=""){
			  
			//  if($resultados==1){
			echo   $query25="SELECT DISTINCT count(permi_viaje.id_viaje) as numero FROM permi_viaje LEFT OUTER JOIN viaje_contratantes ON viaje_contratantes.id_viaje = permi_viaje.id_viaje
		    LEFT OUTER JOIN c_condiciones ON c_condiciones.id_condicion = viaje_contratantes.c_condicontrat WHERE permi_viaje.id_viaje <> '' AND fec_ingreso >= DATE_FORMAT(STR_TO_DATE('".$rango1."','%d/%m/%Y'),'%Y-%m-%d')
								    AND fec_ingreso <= DATE_FORMAT(STR_TO_DATE('".$rango2."','%d/%m/%Y'),'%Y-%m-%d')  GROUP BY permi_viaje.id_viaje ORDER BY permi_viaje.id_viaje  "; 
									
			//  }elseif($resultados==2){
	/*	echo	   $query25="SELECT DISTINCT count(permi_viaje.id_viaje) as numero FROM permi_viaje LEFT OUTER JOIN viaje_contratantes ON viaje_contratantes.id_viaje = permi_viaje.id_viaje
		    LEFT OUTER JOIN c_condiciones ON c_condiciones.id_condicion = viaje_contratantes.c_condicontrat WHERE permi_viaje.id_viaje <> '' AND fecha_crono >= DATE_FORMAT(STR_TO_DATE('".$rango1."','%d/%m/%Y'),'%Y-%m-%d')
								    AND fecha_crono <= DATE_FORMAT(STR_TO_DATE('".$rango2."','%d/%m/%Y'),'%Y-%m-%d')  "; */
									
   /*  echo  $query25="SELECT DISTINCT COUNT(*) AS numero
		    FROM permi_viaje
		    LEFT OUTER JOIN viaje_contratantes ON viaje_contratantes.id_viaje = permi_viaje.id_viaje
		    LEFT OUTER JOIN c_condiciones ON c_condiciones.id_condicion = viaje_contratantes.c_condicontrat
		    WHERE permi_viaje.id_viaje <> ''
		    AND fecha_crono >= DATE_FORMAT(STR_TO_DATE('".$rango1."','%d/%m/%Y'),'%Y-%m-%d')
		   AND fecha_crono <= DATE_FORMAT(STR_TO_DATE('".$rango2."','%d/%m/%Y'),'%Y-%m-%d')";*/
						
			/*  }*/
			  
			if($numformu=="" and $tippersona=="" and $nrocontrol==""){
				if($participante!= "") {
	         $query25="SELECT DISTINCT count(permi_viaje.id_viaje) as numero FROM permi_viaje LEFT OUTER JOIN viaje_contratantes ON viaje_contratantes.id_viaje = permi_viaje.id_viaje
		    LEFT OUTER JOIN c_condiciones ON c_condiciones.id_condicion = viaje_contratantes.c_condicontrat WHERE permi_viaje.id_viaje <> '' AND viaje_contratantes.c_descontrat LIKE  '%".trim($participante)."%' GROUP BY permi_viaje.id_viaje ";
 
	       }  
			} 	
			
			if($numformu=="" and $participante=="" and $nrocontrol==""){
				if($tippersona!= "") {
	         $query25="SELECT DISTINCT count(permi_viaje.id_viaje) as numero FROM permi_viaje LEFT OUTER JOIN viaje_contratantes ON viaje_contratantes.id_viaje = permi_viaje.id_viaje
		    LEFT OUTER JOIN c_condiciones ON c_condiciones.id_condicion = viaje_contratantes.c_condicontrat WHERE permi_viaje.id_viaje <> '' AND permi_viaje.asunto LIKE  '%".trim($tippersona)."%' GROUP BY permi_viaje.id_viaje ";
 
	       }  
			} 
			
			
			if($numformu!=""){
				
				 $query25="SELECT DISTINCT count(permi_viaje.id_viaje) as numero FROM permi_viaje LEFT OUTER JOIN viaje_contratantes ON viaje_contratantes.id_viaje = permi_viaje.id_viaje
		    LEFT OUTER JOIN c_condiciones ON c_condiciones.id_condicion = viaje_contratantes.c_condicontrat WHERE permi_viaje.id_viaje <> ''AND permi_viaje.num_kardex LIKE  '%".trim($numformu2)."%' GROUP BY permi_viaje.id_viaje ";
				
				if($participante!= "") {
	         $query25="SELECT DISTINCT count(permi_viaje.id_viaje) as numero FROM permi_viaje LEFT OUTER JOIN viaje_contratantes ON viaje_contratantes.id_viaje = permi_viaje.id_viaje
		    LEFT OUTER JOIN c_condiciones ON c_condiciones.id_condicion = viaje_contratantes.c_condicontrat WHERE permi_viaje.id_viaje <> '' AND viaje_contratantes.c_descontrat LIKE  '%".trim($participante)."%' GROUP BY permi_viaje.id_viaje ";
 
	       }  
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

	
	
   // $query = "CALL spLisViajes('".$rango1."' ,'".$rango2."' ,'".$tippersona."' ,'".$participante."','".$nrocontrol."','".$numformu."','".$estado."',".$limite.")";
    $query = "CALL spLisViajes('".$rango1."' ,'".$rango2."' ,'".$tippersona."' ,'".$participante."','".$nrocontrol."','".$numformu2."','".$estado."','".$articuloInicial."','".$articulosPorPagina."')";

$pre=mysql_query($query25); 
$resultado=mysql_fetch_array($pre);
$valorgeneraldepaginacion=$resultado["numero"];

if($valorgeneraldepaginacion>0){
	
	
	$ressss=$db->query($query);


		
if($res2->num_rows>0)
{

	while($rowkar=$ressss->fetch_array())
	{	


$nomyape1=strtoupper($rowkar['referencia']);
	$textorefe1=str_replace("?","'",$nomyape1);
	$textoampers1=str_replace("*","&",$textorefe1);
	$textoamperss1=str_replace("ñ","Ñ",$textoampers1);
	$refii1=strtoupper($textoamperss1);
	
	$nomyape=strtoupper($rowkar['c_descontrat']);
	$textorefe=str_replace("?","'",$nomyape);
	$textoampers=str_replace("*","&",$textorefe);
	$textoamperss=str_replace("ñ","Ñ",$textoampers);
	$refii=strtoupper($textoamperss);

$numkar = $rowkar['num_kardex'];
$numkar2 = substr($numkar,5,6).'-'.substr($numkar,0,4);

$fecha = $rowkar['fec_ingreso'];
$fecha2 = explode ("-",$fecha);
$fecha3 = $fecha2[2] . "/" . $fecha2[1] . "/" . $fecha2[0];

$fechac = $rowkar['fecha_crono'];
$fechac2 = explode ("-",$fechac);
$fechac3 = $fechac2[2] . "/" . $fechac2[1] . "/" . $fechac2[0];

 $permi_viaje[$rowkar['id_viaje']]="<table width='880' border='1' cellpadding='0' cellspacing='0' bordercolor='#333333' >
  <tr>
    <td width='38' align='center' ><span class='reskar'><a href='EditPermiViajeVie.php?id_viaje=".$rowkar['id_viaje']."'>".$rowkar['id_viaje']."</a></span></td>
	<td width='60' align='center' ><span class='reskar'>".$numkar2."</span></td>
	<td width='230' style=max-width:150px;' align='center' ><span class='reskar'>".$refii."</span></td>
	<td width='86' align='center' ><span class='reskar'>".$fechac3."</span></td>
    <td width='150' align='center'><span class='reskar'>".$rowkar['tipo_permiso']."</span></td>
	<td width='86' align='center'><span class='reskar'>".$fecha3."</span></td>
	<td width='86' align='center'><span class='reskar'>".$rowkar['des_condicion']."</span></td>
  </tr>
</table>";
      }
}
}else{
   echo "<center>No se encontraron Datos</center>";
}
foreach($permi_viaje as $permi){
	
	echo "<article >".$permi."</article>";
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
				        echo '<a href="listpermiviaje.php?pagina=' . $i . '&estado='.$estado.'&numformu='.$numformu.'&participante='.$participante.'&rango1='.$rango1.'&rango2='.$rango2.'&tippersona='.$tippersona.'&nrocontrol='.$nrocontrol.'&resultados='.$resultados.'&val=10" class="pagina">' . $i . '</a>';
			    	}
				}
	echo '</div>'


/*
echo "<table width='300' border='0' cellspacing='0'cellpadding='0'>
  <tr>
    <td width='50'>"; if ($limite>0){
	
	$limit=$limite-17;
	
	//$paginainicio = $paginainicio + 1;
	echo "<input type='hidden' value='".$limit."' id='_imagen' /><aside onClick=\"cargakardex(".$limit.")\"><img class='imgx' src='../../ante.png' width='37' height='36' border='0' title='Anterior'></aside>";
	
		//echo $paginainicio."/".$paginas;
	}else{//$paginainicio = $paginainicio - 1;
		echo "<input type='hidden' value='".$limit."' id='_imagen' /><aside></aside>";
		} echo"</td>
    		<td width='100'>";
			echo "total de pag :"." ".$paginas;
			echo"</td>
    <td width='50'>"; 
	
	if ($limite<$total-17){
	
	$limit=$limite+17;
		
			//echo $paginainicio."/".$paginas;
		
		
	echo "<aside onClick=\"cargakardex(".$limit.")\"><img class='imgx' src='../../sigte.png' width='37' height='36' border='0' title='Siguiente'></aside>";
	
	}else{
		
		echo "<aside></aside>";
		}
	
	echo"</td>
  </tr>
</table>";*/

?>