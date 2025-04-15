<?php 
	session_start();
	
	include("../../extraprotocolares/view/funciones.php");
	$conexion = Conectar();

?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Anulacion de Pagos</title>
<link href="../../includes/css/jquery-ui-notarios.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../../tcal.css" />
<link href="../../includes/css/jquery-ui-notarios.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../../includes/css/uniform.default.min.css" />
<link rel="stylesheet" type="text/css" href="../../tcal.css" />

<script type="text/javascript" src="../../tcal.js"></script> 
<script type="text/javascript" src="../includes/Mantenimientos.js"></script> 
<script src="../../includes/jquery-1.8.3.js"></script>
<script src="../../includes/js/jquery-ui-notarios.js"></script>
<script src="../../includes/jquery.uniform.min.js"></script>
<script src="../../includes/maskedinput.js"></script>
<script type="text/javascript" src="../../tcal.js"></script> 

<script type="text/javascript" src="../../js/prototype.js"></script>
<script type="text/javascript" src="../Ajax/anular.js" ></script>

<style type="text/css">
div.carta_content {
	background:#333333;
	border: 1px solid #333333;
	-moz-border-radius: 10px;
	-webkit-border-radius: 10px;
	border-radius: 10px;
	-moz-box-shadow: 0px 0px 7px #000000;
	-webkit-box-shadow: 0px 0px 7px #000000;
	box-shadow: 0px 0px 7px #000000;
	width:638px;
	height:220px;
	position:absolute;
	left: 549px;
	top: 496px;
	margin-top: 15px;
	margin-left: -450px;
	opacity: 0.95;
	filter: "alpha(opacity=50)"; /* expected to work in IE 8 */
	filter: alpha(opacity=50);   /* IE 4-7 */
	zoom: 1;
}

div.allcontrata {width:600px; height:150px; overflow:auto;}
.titupatrimo {font-size: 12; font-style: italic; font-family: Calibri;}

div.div_bloques
{ 
background-color: #ffffff;
border: 4px solid #264965;  
-moz-border-radius: 13px;
-webkit-border-radius: 13px;
border-radius: 13px;
-moz-box-shadow: 0px 0px 5px #000000;
-webkit-box-shadow: 0px 0px 5px #000000;
box-shadow: 0px 0px 5px #000000;
width:820px; height:750px;
}

.camposss {font-family: Calibri; font-style: italic; font-size: 14px; color: #333333; }


#field_remitente, #field_destinatario, #field_responpago, #field_diligencia, #field_cargo{
	margin:0 auto;
	border: 2px solid #ddd; 
	border-radius: 10px; 
	padding: 2px; 
	box-shadow: #ccc 5px 0 5px;
	margin-bottom:0px;
	}

.fielSetTipoVista{
	width:100%;
	font-family:Arial, Helvetica, sans-serif;
	font-size:12px;
	color:#000;
	font-weight:bold;
	border:#000 solid 1px;
	box-shadow: #ccc 5px 0 10px;
	border-radius: 10px; 
	}
	
</style>

</head>
<body style="font-size:62.5%;" onLoad="listar_anular(1)">
<div id="carta_content">
<table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
    <tr>
     <td>
         <fieldset id="field_remitente" style="padding:5px">
         <legend><span class="camposss">Buscar Documento</span></legend>
         <div id="div_buscaclie">
         <form id="frm_anulados" name="frm_anulados">
         <table  width="100%">
         	<tr>
            	<td width="16%" height="35"><span class="camposss">Tipo Documento:</span></td>	
                <td width="27%">
                
             	<?php   
                
				$consulta_tipdoc = "SELECT tip_documen.id_documen AS 'id', tip_documen.des_docum AS 'des' FROM tip_documen ORDER BY tip_documen.des_docum ASC";
				$ejecuta_tipdoc = mysql_query($consulta_tipdoc, $conexion);
		
				$i=0;
			
				while($tipodoc = mysql_fetch_array($ejecuta_tipdoc, MYSQL_ASSOC))
				{
					$arr_tipodoc[$i][0] = $tipodoc["id"]; 
					$arr_tipodoc[$i][1] = $tipodoc["des"];
					$i++; 
				}
				?>
                
                <select id="a_tipcomp" name="a_tipcomp" style='width:167px;' class='camposss' onChange="listar_anular(1)">
                <option value="">--Tipo de Comprobante--</option>
                <?php    
                for($j=0;$j<count($arr_tipodoc); $j++){ ?>
                <option value='<?php echo $arr_tipodoc[$j][0]; ?>'><?php echo $arr_tipodoc[$j][1]; ?></option> 
            	<?php } ?>
                </select>
                
                </td>
            	<td width="7%"><span class="camposss">Serie:</span></td>
                <td width="25%"><input id="a_serie" name="a_serie" class="camposss" style="width:100px" maxlength="2" onKeyPress="return isNumberKey(event)"/></td>
                <td width="5%"><span class="camposss">DOC:</span></td>
                <td width="20%"><input id="a_doic" name="a_doic" class="camposss" style="width:100px" maxlength="6" onKeyPress="return isNumberKey(event)"/></td>
            </tr>
            <tr>
            	<td><span class="camposss">Cliente:</span></td>
                <td colspan="3"><input id="a_cliente" name="a_cliente" type="text" style="text-transform:uppercase; width:390px" size="60" maxlength="100px" /></td>
                <td colspan="2" align="center">
                <input type="button" value="Buscar" onClick="listar_anular(1)"  class="camposss" />
                </td>
            </tr>
          </table>
          </form>
          </div>
          </fieldset>  
     </td>
    </tr>
    <tr height="35">
        	<td colspan="9"><img src="../../images/line.png" width="100%" height="8px">
            </td>
    </tr>
    <tr>
      <td>
        <div id="div_anular" style="margin-top:0px"></div>
      </td>
    </tr>
</table>
</div>
</body>
</html>