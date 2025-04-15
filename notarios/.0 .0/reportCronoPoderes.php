<?php

$fechade = $_POST['fechade'];
$fecha=explode("/",$fechade);
$desde=$fecha[2]."-".$fecha[1]."-".$fecha[0];

$fechaa  = $_POST['fechaa'];
$fecha2=explode("/",$fechaa);
$hasta=$fecha2[2]."-".$fecha2[1]."-".$fecha2[0];

if($_POST['fechade']!="" or $_POST['fechaa']!="") {
	
include("../conexion.php");
include('../extraprotocolares/view/funciones.php');


//Exportar datos de php a Excel
header("Content-Description: File Transfer");  
header("Content-Type: application/force-download"); 
header("Content-Disposition: attachment; filename=IC_POD.doc");

$consulta = mysql_query("SELECT
						ingreso_poderes.id_poder  as id_poder,
						ingreso_poderes.num_kardex as kardex,
						poderes_asunto.des_asunto as tip_poder,
						ingreso_poderes.fec_crono as fec_crono,
						ingreso_poderes.referencia as referencia,
						ingreso_poderes.fec_ingreso as fec_ingreso,
						ingreso_poderes.swt_est as estado,
						ingreso_poderes.num_formu AS formulario
						FROM ingreso_poderes 
						INNER JOIN poderes_asunto ON poderes_asunto.id_asunto = ingreso_poderes.id_asunto
						WHERE STR_TO_DATE(ingreso_poderes.fec_crono,'%Y-%m-%d') >= STR_TO_DATE('$desde','%Y-%m-%d') 
						AND STR_TO_DATE(ingreso_poderes.fec_crono,'%Y-%m-%d') <= STR_TO_DATE('$hasta','%Y-%m-%d')", $conn) or die(mysql_error());
$paginador=2;

$confinotario=mysql_query("SELECT nombre,apellido FROM confinotario",$conn);
$resnotario=mysql_fetch_assoc($confinotario);
$nombrenotario=$resnotario['nombre']." ".$resnotario['apellido'];	
$desc = 'Descripción';				   
?>
<HTML LANG="es">
<TITLE>::. Exportacion de Datos .::</TITLE>
<style>
br{margin-bottom:-15px;}
.Estilo12{
   font-size: 9px;
}
</style>
</head>
<body>          

<table width='600' border='0' cellpadding='0' cellspacing='0'>
<tr>
	<td colspan="2" align="left"><b><span><font size="-1">Notaria <?php echo $nombrenotario;?></font></span></b></td>
</tr>
<tr>
	<td align="left" width="300"><b><span><font size="-3">INDICE CRONOLOGICO DE PODERES FUERA DE REGISTRO</font></span></b></td>
    <td align="right" width="300"><b><span>Listado <?php echo "del ".fechabd_an($desde)." al ".fechabd_an($hasta); ?></span></b></td>
</tr>
</table>
<hr/>
<table width="650" bordercolor="#333333"  BORDER="0" align="center" CELLPADDING="0" CELLSPACING="0">       
		<tr class="titulos">   
        
                <TH  width='105' style="font-size:11px" align="center" ><span class=''>Fecha</span></TH >
                     <TH width='250' style="font-size:11px" align="center"><span class=''>Participantes</span></div></TH >
                     <Td  width='47' style="font-size:11px" align="center"><b><span class=''><?php echo utf8_decode($desc);?></span></b></Td>
                     <TH  width='47' style="font-size:11px" align="center"><span class=''>Nro. Cro.</span></TH >
					 <TH  width='47' style="font-size:11px" align="center"><span class=''>Nro. For.</span></TH >
                       
            </tr> 
</TABLE>            
<hr />
<table width="650" bordercolor="#333333"  BORDER="0" align="center" CELLPADDING="4" CELLSPACING="4">  

       

<?php
$i=0;
while($poder = mysql_fetch_array($consulta)){

	$arr_poder[$i][0] = $poder["id_poder"]; 
	$arr_poder[$i][1] = $poder["kardex"]; 
	$arr_poder[$i][2] = $poder["tip_poder"]; 
	$arr_poder[$i][3] = $poder["fec_crono"]; 
	$arr_poder[$i][4] = $poder["referencia"]; 
	$arr_poder[$i][5] = $poder["fec_ingreso"]; 
	$arr_poder[$i][6] = $poder["estado"]; 
	$arr_poder[$i][7] = $poder["formulario"]; 
		
	$i++; 
}


	for($j=0; $j<count($arr_poder); $j++) { 

	echo "<tr>
			<td class='cualquierotroestilo' width='105' valign='top' align='center'  align='center' ><div style='height:40px;width:20px'><span class='Estilo12'>".$arr_poder[$j][3]."</span></div></td>
			<td class='cualquierotroestilo' width='250' valign='top' align='center'  align='left' ><div style='height:40px;width:20px'><span class='Estilo12'>&nbsp;";
			
			$sql_contratantes = "SELECT
 poderes_contratantes.id_contrata id,
 poderes_contratantes.c_descontrat as nombres,
poderes_contratantes.c_fircontrat as firma,
 c_condiciones.des_condicion as condicion
FROM poderes_contratantes 
INNER JOIN c_condiciones ON c_condiciones.id_condicion = poderes_contratantes.c_condicontrat
WHERE poderes_contratantes.id_poder =".$arr_poder[$j][0];
                                     
                $exe_contratantes = mysql_query($sql_contratantes, $conn);
				
				 while($contratantes = mysql_fetch_array($exe_contratantes)){
                
                    $arr_contratantes[$k][0] = $contratantes["id"]; 
                    $arr_contratantes[$k][1] = $contratantes["nombres"]; 
                    $arr_contratantes[$k][2] = $contratantes["firma"]; 
                    $arr_contratantes[$k][3] = $contratantes["condicion"]; 


					echo "- ".simbolos(strtoupper($arr_contratantes[$k][3] ." : ".$arr_contratantes[$k][1])); 
					$k++; 
					echo "<br>";
                }
				

			echo "</span></div></td>
			<td class='cualquierotroestilo' width='47' valign='top' align='center' align='center' ><div style='height:40px;width:20px'> <span class='Estilo12'>".($arr_poder[$j][2])."</span></div></td>
		
			<td class='cualquierotroestilo' width='47' valign='top' align='center' align='center' ><div style='height:40px;width:20px'><span class='Estilo12'>".($arr_poder[$j][0])."&nbsp;</span></div></td>
			<td class='cualquierotroestilo' width='47' valign='top' align='center' align='center' ><div style='height:40px;width:20px'><span class='Estilo12'>".($arr_poder[$j][7])."&nbsp;</span></div></td>
			
 	</tr>";
		
	
			
  	
}?>
</table>
</body>
</html>

<?php
}else{
	echo "<script>window.location='../indicecronopoder.php'</script>";	
}
?>