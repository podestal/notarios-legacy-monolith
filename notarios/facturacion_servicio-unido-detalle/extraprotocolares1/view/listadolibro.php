<?php 
include("conexion.php");

require("funciones.php");
  
$conexion = Conectar();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link href="../../includes/css/jquery-ui-notarios.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../../tcal.css" />
<link href="../../includes/css/jquery-ui-notarios.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../../includes/css/uniform.default.min.css" />
<link rel="stylesheet" type="text/css" href="../../tcal.css" />

<link rel="stylesheet" type="text/css" href="../../librerias/jquery/jquery-ui.theme.css">

<script type="text/javascript" src="../../librerias/jquery/external/jquery/jquery.js"></script>
<script type="text/javascript" src="../../librerias/jquery/jquery-ui.js"></script>

<script language="JavaScript" type="text/javascript" src="../../ajax.js"></script>
<script type="text/javascript" src="../../tcal.js"></script> 
<script type="text/javascript" src="../includes/Mantenimientos.js"></script> 
<script src="../../includes/jquery-1.8.3.js"></script>
<script src="../../includes/js/jquery-ui-notarios.js"></script>
<script src="../../includes/jquery.uniform.min.js"></script>
<script type="text/javascript" src="../../tcal.js"></script> 
<script type="text/javascript" src="../../js/prototype.js"></script>
<script type="text/javascript" src="../ajax/libros.js"></script> 
<script type="text/javascript" src="../../librerias/scriptaculous/src/scriptaculous.js" ></script>
   
    
<title>Listado Libros</title>
<style type="text/css">
<!--
.titubuskar {
	font-family: Calibri;
	font-size: 12px;
	font-weight: bold;
	font-style: italic;
	color: #003366;
}
.titubuskar0 {font-family: Calibri; font-size: 12px; font-style: italic; font-weight: bold; color: #333333; }
.titubuskar1 {color: #333333}
.reskar2 {font-family: Calibri; font-size: 13px; font-weight: bold; font-style: italic; color: #003366; }
.reskar {font-size: 12px; font-style: italic; color: #333333; font-family: Calibri;}
.buttonlibro{font-family:Calibri; font-size:13px; font-style: italic; height:28px; background-color:#FFF; border-style: solid; border-color: #A1BBC8; border-width: 1px; border-radius:5px; color:#333333;}

body {
	background-color: #FFF;
}
-->
</style>

</head>

<body style="font-size:62.5%;" onload="buscar_libros(1)">

<table width="773" border="0" cellspacing="0" cellpadding="0">
	   <tr>	
        <td>
        <form id="frm_buscarlibros" name="frm_buscarlibros" >
        <table>		
            <tr>
              <td><span class="reskar2">Busqueda Por:</span></td>
            </tr>
            <tr>
                <td>
                    <table width="839">
                            <tr>
                                <td width="101" height="35"><span class="titubuskar0">Empresa/Cliente </span></td>
                                <td width="219"><input id="cliente" name="cliente" type="text" size="20" maxlength="100" style="text-transform:uppercase"/></td>
                                <td width="48"><span class="titubuskar0">Dni/Ruc</span></td>
                                <td width="213"><input id="rn" name="rn" type="text"  size="20" maxlength="20" onkeypress="return isNumberKey(event)" /></td>
                                <td width="87"><span class="titubuskar0">N° Cronologico</span></td>
                                <td width="143"><input id="num_crono" name="num_crono" type="text" size="20" maxlength="11" /></td>
                            </tr>
                    </table>
              </td>
            </tr>
            <tr>
                <td height="25"><span class="reskar2">Busqueda por fecha:</span></td>
            </tr>
            <tr>
                <td>
                    <table width="841">
                            <tr>
                                <td width="56"><span class="titubuskar0">Desde</span></td>
                                <td width="103"><input id="rango1" name="rango1" type="text" class="tcal" style="text-transform:uppercase"  size="10" readonly="readonly" /></td>
                                <td width="48"><span class="titubuskar0">Hasta</span></td>
                                <td width="419"><input id="rango2" name="rango2" type="text" class="tcal" style="text-transform:uppercase"  size="10" readonly="readonly" /></td>
                                <td width="85"><a onclick="buscar_libros(1)"><img src="../../iconos/buscarclie.png" width="72" height="29" border="0" /></a></td>
                                <td width="102">&nbsp;</td>
                            </tr>
                    </table>
                </td>
             </tr>
       	</table>
        </form>
        </td>
       </tr>
       <tr>
           <td>----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</td>
       </tr>
       <tr> 
       	   <td>
            	<div id="lista_libros" style="width:848px"></div>
           </td>
       </tr>
       
       <tr>
       <?php 
	   
	   $sql_libr  =    "SELECT
						libros.numlibro as numlibro,
						libros.ano as anio,
						libros.fecing as fecha,
						libros.empresa as empresa,
						libros.prinom as nombre1,
						libros.apepat as ape1,
						libros.apemat as ape2,
						tipolibro.destiplib as destiplib,
						nlibro.desnlibro as desnlib,
						libros.folio as folio,
						tipofolio.destipfol as destipfolio,
						libros.dni as dni,
						libros.ruc as ruc,
						libros.descritiplib as descripcion,
						libros.flag AS flag
						FROM libros
						LEFT OUTER JOIN tipolibro ON tipolibro.idtiplib = libros.idtiplib
						LEFT OUTER JOIN nlibro ON nlibro.idnlibro = libros.idnlibro
						LEFT OUTER JOIN tipofolio ON tipofolio.idtipfol = libros.idtipfol
						WHERE libros.numlibro <> ''
						order by libros.numlibro desc";
	   
	    $exe_libr = mysql_query($sql_libr, $conexion);
		
		//$total_libr = mysql_num_rows($exe_libr);
		
		$rs = mysql_query("SELECT MAX(numlibro) AS lastlibro FROM libros");
		
		if ($row = mysql_fetch_row($rs)){$lastlibro = trim($row[0]);}
		
		$i=0;
		
	    while($libr = mysql_fetch_array($exe_libr)){
			$arr_libr[$i][0] = $libr["numlibro"]; 
			$i++; 
		}
		
	    ?>
        <td>
        	<form id="frm_lstlibros" name="frm_lstlibros">
        	<table style="display:none">
            	<tr>
                	<td>
                    <input id="numlibros" name="numlibros" value="<?php echo (int)$lastlibro;?>"/>
					<?php for($i=0; $i<$lastlibro; $i++){?>
                    <input id="idlibro<?php echo $arr_libr[$i][0]; ?>" name="idlibro<?php echo $arr_libr[$i][0]; ?>" value="<?php echo $arr_libr[$i][0]; ?>" type="checkbox"/>
            		<?php }?>
                    </td>
                </tr>
            </table>
			</form>
        </td>
      </tr>
       
</table>

        <div id="div_recojo" style="width:auto; height:auto; position:absolute; left:290px; top:200px; background-color:#CCCCCC; border-radius:5px; display:none"></div>

</body>
</html>



