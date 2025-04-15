<link rel="stylesheet" href="stylesglobal.css">
  
  <?php 
  	
  require("conexion.php");
  require("funciones.php");
  
  $conexion = Conectar();
  
  $num_crono=$_REQUEST['num_crono'];
  $cliente=$_REQUEST['cliente'];
  $rn=$_REQUEST['rn'];
  $rango1=$_REQUEST['rango1'];
  $rango2=$_REQUEST['rango2'];
  $pag = $_REQUEST['pag'];
  
  $num_crono = formato_crono_abd($num_crono);
  
  if($rango1<>""){$rango1 = fechan_abd($rango1);}
  
  if($rango2<>""){$rango2 = fechan_abd($rango2);}
  	
  //echo "</BR>";
  	
  $query  =    "SELECT
  				libros.numlibro as numlibro,
				libros.ano as anio,
				libros.fecing as fecha,
				libros.empresa as empresa,
				libros.prinom as nombre1,
				libros.apepat as ape1,
				libros.apemat as ape2,
				libros.descritiplib as destiplib,
				nlibro.desnlibro as desnlib,
				libros.folio as folio,
				tipofolio.destipfol as destipfolio,
				libros.ruc as ruc,
				libros.descritiplib as descripcion,
				libros.flag AS flag,
				libros.numdoc_plantilla as ruc_plantilla
				FROM libros
				LEFT OUTER JOIN nlibro ON nlibro.idnlibro = libros.idnlibro
				LEFT OUTER JOIN tipofolio ON tipofolio.idtipfol = libros.idtipfol
				WHERE libros.numlibro <> ''";
  

	if($num_crono <>""){

		$query = $query." and libros.numlibro like '%$num_crono%'";

	}

	if($num_crono == ""){
	
		if($cliente== '' and $rn == ''){
			  if($rango1== "" or $rango2== ""){ 
				$query = $query;  
			  }
			  if($rango1<> "" and $rango2<> ""){  
				$query = 
				$query." and STR_TO_DATE(libros.fecing,'%Y-%m-%d') >= STR_TO_DATE('$rango1','%Y-%m-%d') 
						 and STR_TO_DATE(libros.fecing,'%Y-%m-%d') <= STR_TO_DATE('$rango2','%Y-%m-%d')";
			  } 

		}

		if($cliente<> '' and $rn == ''){
			  if($rango1== "" or $rango2== ""){ 
				$query = $query." and libros.empresa like '%$cliente%' or CONCAT(libros.prinom, ' ',libros.apepat, ' ',libros.apemat) like '%$cliente%'";  
			  }
			  if($rango1<> "" and $rango2<> ""){  
				$query = $query." and (libros.empresa like '%$cliente%' or CONCAT(libros.prinom, ' ',libros.apepat, ' ',libros.apemat) like '%$cliente%') 
								  and STR_TO_DATE(libros.fecing,'%Y-%m-%d') >= STR_TO_DATE('$rango1','%Y-%m-%d') 
								  and STR_TO_DATE(libros.fecing,'%Y-%m-%d') <= STR_TO_DATE('$rango2','%Y-%m-%d')";  
			  } 

		}

		if($cliente== '' and $rn <> ''){
			  if($rango1== "" or $rango2== ""){ 
				$query = $query." and libros.ruc = '$rn' or libros.dni = '$rn'";  
			  }
			  if($rango1<> "" and $rango2<> ""){  
				$query = $query." and (libros.ruc = '$rn' or libros.dni = '$rn') 
								  and STR_TO_DATE(libros.fecing,'%Y-%m-%d') >= STR_TO_DATE('$rango1','%Y-%m-%d') 
								  and STR_TO_DATE(libros.fecing,'%Y-%m-%d') <= STR_TO_DATE('$rango2','%Y-%m-%d')";  
			  } 

		}


		if($cliente<> '' and $rn <> ''){
			  if($rango1== "" or $rango2== ""){ 
				$query = $query." and (libros.empresa like '%$cliente%' or CONCAT(libros.prinom, ' ',libros.apepat, ' ',libros.apemat) like '%$cliente%') 
								  and (libros.ruc = '$rn' or libros.dni = '$rn')";  
			  }
			  if($rango1<> "" and $rango2<> ""){  
				$query = $query." and (libros.empresa like '%$cliente%' or CONCAT(libros.prinom, ' ',libros.apepat, ' ',libros.apemat) like '%$cliente%') 
								  and (libros.ruc = '$rn' or libros.dni = '$rn')
								  and STR_TO_DATE(libros.fecing,'%Y-%m-%d') >= STR_TO_DATE('$rango1','%Y-%m-%d') 
								  and STR_TO_DATE(libros.fecing,'%Y-%m-%d') <= STR_TO_DATE('$rango2','%Y-%m-%d')";  
			  } 

		}

	}


	$query = $query."  ORDER BY anio DESC,numlibro DESC "; 
	  
	$ejecuta = mysql_query($query, $conexion);

	$total_libros = mysql_num_rows($ejecuta);
	
	$num_reg = 10;
	 
	$num_pag = ceil($total_libros/$num_reg);
	  
	$ini = 0;
    
    $ini = ($pag-1)*$num_reg;
	  
	$ini_pag = floor(($pag-1)/7)*7 + 1;
	  
	$query = $query." LIMIT $ini, $num_reg";

    //echo $query;
    
    $ejecuta = mysql_query($query, $conexion);
    


    $i=0;
    
    while($libros = mysql_fetch_array($ejecuta, MYSQL_ASSOC))
    {
    $arr_libros[$i][0] = $libros["numlibro"]; 
    $arr_libros[$i][1] = $libros["anio"];
    $arr_libros[$i][2] = fechabd_an($libros["fecha"]);
    $arr_libros[$i][3] = strtoupper($libros["empresa"]);
    $arr_libros[$i][4] = $libros["nombre1"];
    $arr_libros[$i][5] = $libros["ape1"]; 
    $arr_libros[$i][6] = $libros["ape2"];
    $arr_libros[$i][7] = $libros["destiplib"];
    $arr_libros[$i][8] = $libros["desnlib"];
    $arr_libros[$i][9] = $libros["folio"];
	$arr_libros[$i][10] = $libros["destipfolio"];
	$arr_libros[$i][11] = $libros["ruc"];
	$arr_libros[$i][12] = $libros["descripcion"];
	$arr_libros[$i][13] = $arr_libros[$i][4].' '.$arr_libros[$i][5].' '.$arr_libros[$i][6];
	$arr_libros[$i][14] = $libros["flag"];
	$arr_libros[$i][15] = $libros["ruc_plantilla"];
    $i++; 
    }
	?>
	
    <table width='840' border='1' cellpadding='0' cellspacing='0' bordercolor='#333333' height='auto'>
    
   		<tr height='25' bgcolor='#CCCCCC'>
          <td width='79' align='center'><span class='titubuskar0'>N&ordm; Cronologico</span></td>
          <td width='84' align='center'><span class='titubuskar0'>Fecha </span></td>
          <td width='153' align='center'><span class='titubuskar0'>Empresa / Cliente</span></td>
          <td width='116' align='center'><span class='titubuskar0'>Tipo Libro</span></td>
          <td width='101' align='center'><span class='titubuskar0'>N° de Libro</span></td>
          <td width='68' align='center'><span class='titubuskar0'>N° de Folio</span></td>
          <td width='101' align='center'><span class='titubuskar0'>Tipo de Folio</span></td>
          <td width='73' align='center'><span class='titubuskar0'>RUC</span></td>
          <td></td>
        </tr>
    
	 <?php
     if(count($arr_libros)>0){
         
     for($j=0; $j<count($arr_libros); $j++) { 
     ?>       
     <tr height='20'>
            <td width='79' align='center'>
			<!--  $arr_libros[$j][0] -->
			
				<span class='reskar' title='Ver' style='color:#06C; cursor:pointer' onclick="ver_libros('<?php echo $arr_libros[$j][0]."-".$arr_libros[$j][1];?>')"><?php echo $arr_libros[$j][0]."-".$arr_libros[$j][1];?></span>
				
				
            </td>
            <td width='84' align='center'>
                <span class='reskar'><?php echo $arr_libros[$j][2];?></span>
            </td>
            <td width='153' align='center'>
					
                <span class='reskar'><?php echo holaacentos($arr_libros[$j][3].$arr_libros[$j][13]);?></span>
            
            </td>
			<td width='116' align='center'>
				<span class='reskar'><?php echo strtoupper($arr_libros[$j][12]); ?></span>
			</td>
			<td width='101' align='center'>
				<span class='reskar'><?php echo $arr_libros[$j][8]; ?></span>
			</td>
			<td width='68' align='center'>
				<span class='reskar'><?php echo $arr_libros[$j][9]; ?></span>
			</td>
			<td width='101' align='center'>
				<span class='reskar'><?php echo $arr_libros[$j][10]; ?></span>
			</td>
            <td width='73' align='center'>
			<?php 			
            echo $arr_libros[$j][11].$arr_libros[$j][15];		
            ?>		
			
            </td>
            <td align="center">
            	<input  
                <?php 
				if($arr_libros[$j][15]==1){
					echo "checked='checked' ";
					echo "disabled='disabled' ";
				}
				?>
                type="checkbox" onclick="actualizar_chk('<?php echo $arr_libros[$j][0]; ?>')" />
            </td>
    </tr>
	<?php               
	}
	?>
    
    <tr height='25'>
        <td colspan='9' align='center' valign='bottom'>
            <table style='margin-bottom:4px'>
               <tr class='paginacion'>
                <?php if($pag>7){?>
                    <td><div class='pagina' style='cursor:pointer; width:14px' title='Regresar' onclick="buscar_libros('<?php echo ($ini_pag-1); ?>')"><--</div></td>
                <?php } 
                for($i=$ini_pag; $i<$ini_pag+7; $i++){
                    if($i <= $num_pag){ ?>
                    <td width='15'>
                        <?php	
                        if($i==$pag){ ?>
                        <div class='pagina' style='cursor:pointer; 14px; background-color:#525252; color:'white' ' title='Ir a' onclick="buscar_libros('<?php echo $i; ?>)"><u><?php echo $i; ?></u></div>
                        <?php	}else{ ?>
                        <div class='pagina' style='cursor:pointer' title='Ir a' onclick="buscar_libros('<?php echo $i; ?>')"><?php echo $i; ?></div>
                        <?php } ?>
                    </td>
                    <?php }
                }
                if($num_pag>7 and ($ini_pag+7)<=$num_pag){	?>
                <td><div class='pagina' style='cursor:pointer; width:14px' title='Continuar' onclick="buscar_libros('<?php echo ($ini_pag+7); ?>')">--></div></td>
                <?php
                }
                ?>	  
                </tr>
            </table>
       </td>
     </tr> 
    
	<?php               
	}
	?>
    </table>

    