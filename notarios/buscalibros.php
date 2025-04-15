<link rel="stylesheet" href="stylesglobal.css">

<?php 

include('conexion.php');

include('extraprotocolares/view/funciones.php');

$conexion = Conectar();

$pag = $_REQUEST['pag'];
$desde = $_REQUEST['fechade'];
$hasta = $_REQUEST['fechaa'];

$desde = fechan_abd($desde);
$hasta = fechan_abd($hasta); 

$consulta_libros = "SELECT
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
					WHERE STR_TO_DATE(libros.fecing,'%Y-%m-%d') >= STR_TO_DATE('$desde','%Y-%m-%d') 
					AND STR_TO_DATE(libros.fecing,'%Y-%m-%d') <= STR_TO_DATE('$hasta','%Y-%m-%d')";
					
$ejecutar_libros = mysql_query($consulta_libros, $conexion);

$total_libros = mysql_num_rows($ejecutar_libros);

$num_reg = 8;

$num_pag = ceil($total_libros/$num_reg);

$ini = 0;

$ini = ($pag-1)*$num_reg;

$ini_pag = floor(($pag-1)/7)*7 + 1;

$consulta_libros = $consulta_libros." ORDER BY libros.fecing ASC, libros.numlibro ASC LIMIT $ini, $num_reg";

$ejecutar_libros = mysql_query($consulta_libros, $conexion);

$i=0;

while($libros = mysql_fetch_array($ejecutar_libros)){

	$arr_libros[$i][0] = $libros["num_crono"]; 
	$arr_libros[$i][1] = $libros["fecha"]; 
	$arr_libros[$i][2] = $libros["cliente"]; 
	$arr_libros[$i][3] = $libros["empresa"]; 
	$arr_libros[$i][4] = $libros["tip_lib"]; 
	$arr_libros[$i][5] = $libros["n_lib"]; 
	$arr_libros[$i][6] = $libros["folio"]; 
	$arr_libros[$i][7] = $libros["tip_fol"]; 
	$arr_libros[$i][8] = $libros["ruc"]; 
	$arr_libros[$i][9] = $libros["dni"]; 
	$arr_libros[$i][10] = strtoupper($libros["deslibro"]); 
	$i++; 
}

echo "<table width='834' border='1' cellpadding='0' cellspacing='0' bordercolor='#E5E5E5'>";

    echo "<tr height='19' bgcolor='#CCCCCC'>
		  <td width='74' align='center'><span class='titubuskar0'>N° Cronologico</span></td>
		  <td width='81' align='center'><span class='titubuskar0'>Fecha </span></td>
		  <td width='140' align='center'><span class='titubuskar0'>Empresa / Cliente</span></td>
		  <td width='100' align='center'><span class='titubuskar0'>Tipo de Libro</span></td>
		  <td width='91' align='center'><span class='titubuskar0'>N° de Libro</span></td>
		  <td width='68' align='center'><span class='titubuskar0'>N° de Folio</span></td>
		  <td width='91' align='center'><span class='titubuskar0'>Tipo de Folio</span></td>
		  <td width='113' align='center'><span class='titubuskar0'>RUC</span></td>
		 </tr>";

	for($j=0; $j<count($arr_libros); $j++) { 

	echo "<tr height='auto'>
			<td valign='top' align='center'><span class='Estilo12'>".substr($arr_libros[$j][0],0,-5)."</span></td>
			<td valign='top' align='center'><span class='Estilo12'>".fechabd_an($arr_libros[$j][1])."</span></td>";

	if(trim($arr_libros[$j][2])<>"" and trim($arr_libros[$j][3]) <>""){
		echo "<td valign='top' align='center'><span class='Estilo12'>".$arr_libros[$j][2].'/'.$arr_libros[$j][3]."</span></td>";
    }else{
    	echo "<td valign='top' align='center'><span class='Estilo12'>".$arr_libros[$j][2].$arr_libros[$j][3]."</span></td>";	
    }
			
	echo 	"<td valign='top' align='center'><span class='Estilo12'>".$arr_libros[$j][10]."</span></td>
			<td valign='top' align='center'><span class='Estilo12'>".$arr_libros[$j][5]."</span></td>
			<td valign='top' align='center'><span class='Estilo12'>".$arr_libros[$j][6]."</span></td>
			<td valign='top' align='center'><span class='Estilo12'>".$arr_libros[$j][7]."</span></td>"; ?>


			<td width='73' align='center'>
					<span class='Estilo12'><?php echo $arr_libros[$j][8]; ?></span>

            </td>
            
    <?php
	echo "</tr>";
    }
   
   echo "<tr height='25'>
			    <td colspan='11' align='center' valign='bottom'>
				    <table style='margin-bottom:4px'>
					   <tr class='paginacion'>";
						    if($pag>7){	
									echo "<td><div class='pagina' style='cursor:pointer; width:14px' title='Regresar' onclick='buscar_libros(".($ini_pag-1).")'><--</div></td>";
						    }
						   
						    for($i=$ini_pag; $i<$ini_pag+7; $i++){
							   
								if($i <= $num_pag){
									echo "<td width='15'>";
									
									if($i==$pag){ 
								
										echo "<div class='pagina' style='cursor:pointer; 14px; background-color:#525252; color:'white' ' title='Ir a' onclick='buscar_libros(".($i).")'><u>".$i."<u></div>";
									
									}else{
									
										echo "<div class='pagina' style='cursor:pointer' title='Ir a' onclick='buscar_libros(".$i.")'>".$i."</div>";
									}
									echo "</td>";
								}
						    }
						  
						  
						    if($num_pag>7 and ($ini_pag+7)<=$num_pag){	
									echo "<td><div class='pagina' style='cursor:pointer; width:14px' title='Continuar' onclick='buscar_libros(".($ini_pag+7).")'>--></div></td>";
						    }
						  
						echo "</tr>
		  	        </table>
				</td>
		    </tr></table>";


?>

