<?php 
	session_start();

	require("funciones.php");
	
	$conexion = Conectar(); 
	
	$sql_iddomiciliario = "SELECT
							cert_domiciliario.id_domiciliario
							FROM 
							cert_domiciliario
							order by cast(cert_domiciliario.id_domiciliario as signed) desc";
	
	$exe_iddomiciliario = mysql_query($sql_iddomiciliario, $conexion);
	
	$row_lastdomi = mysql_fetch_array($exe_iddomiciliario);
		
	$id_domi = $row_lastdomi[0]+1;
	
	$sql_numcertificado = "SELECT
						   cert_domiciliario.num_certificado
						   FROM
						   cert_domiciliario
						   order by cast(cert_domiciliario.num_certificado as signed) desc";
	
	$exe_numcertificado = mysql_query($sql_numcertificado, $conexion);
	
	$row_lastnumcerti = mysql_fetch_array($exe_numcertificado);
	
	$num_certificado = $row_lastnumcerti[0];
	
	if($num_certificado==''){
	$num_certificado = "2014000001";}
	else{$num_certificado = $row_lastnumcerti[0]+1;}
	
	//echo $num_certificado;
	
	$sql_tipdoc = "SELECT
				   tipodocumento.idtipdoc as idtipdoc,
				   tipodocumento.codtipdoc as codtipdoc,
				   tipodocumento.destipdoc as destipdoc
				   FROM
				   tipodocumento";
				
 	$exe_tipdoc = mysql_query($sql_tipdoc, $conexion);
	  
    $i=0;
  
    while($tipdoc = mysql_fetch_array($exe_tipdoc, MYSQL_ASSOC))
    {
		$arr_tipdoc[$i][0] = $tipdoc["idtipdoc"]; 
		$arr_tipdoc[$i][1] = $tipdoc["codtipdoc"]; 
		$arr_tipdoc[$i][2] = $tipdoc["destipdoc"]; 
		$i++; 
    }		
	
	
	$sql_civil = "SELECT
				  tipoestacivil.idestcivil,
				  tipoestacivil.codestcivil,
				  tipoestacivil.desestcivil
				  FROM
				  tipoestacivil";
				
 	$exe_civil = mysql_query($sql_civil, $conexion);
	  
    $i=0;
  
    while($civil = mysql_fetch_array($exe_civil, MYSQL_ASSOC))
    {
		$arr_civil[$i][0] = $civil["idestcivil"]; 
		$arr_civil[$i][1] = $civil["codestcivil"]; 
		$arr_civil[$i][2] = $civil["desestcivil"]; 
		$i++; 
    }		
	
	//var_dump($arr_tipdoc);
	
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Certificado Domiciliario</title>
<link href="../../includes/css/jquery-ui-notarios.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../../tcal.css" />
<link href="../../includes/css/jquery-ui-notarios.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="../../includes/css/uniform.default.min.css" />
<link rel="stylesheet" type="text/css" href="../../tcal.css" />
<link rel="stylesheet" type="text/css" href="../includes/css/CertDomiVie.css" />

<link rel="stylesheet" type="text/css" href="../../librerias/jquery/jquery-ui.theme.css">

<script type="text/javascript" src="../../librerias/jquery/external/jquery/jquery.js"></script>
<script type="text/javascript" src="../../librerias/jquery/jquery-ui.js"></script>

<script type="text/javascript" src="../../tcal.js"></script> 
<script type="text/javascript" src="../includes/Mantenimientos.js"></script> 
<script src="../../includes/jquery-1.8.3.js"></script>
<script src="../../includes/js/jquery-ui-notarios.js"></script>
<script src="../../includes/jquery.uniform.min.js"></script>
<script src="../../includes/maskedinput.js"></script>
<script type="text/javascript" src="../../tcal.js"></script> 
<!--<script type="text/javascript" src="../includes/js/CertDomiVie.js"></script>--> 

<script type="text/javascript" src="../../js/prototype.js"></script>
<script type="text/javascript" src="../ajax/domiciliario.js"></script> 

</head>

<body style="font-size:62.5%;" onLoad="mostrar_solicitante()">

<div id="carta_content">
<form id="frm_ndomiciliario" name="frm_ndomiciliario">
<table width="855" height="455">
	<tr>
    	<td height="58" valign="top">
        	<table>
            		<tr>
                    	<td width="64"><div style="border: 1px solid #79B7E7; border-radius: 3px ; background-color:#DDECF7; padding:4px; width:40px; cursor:pointer" title="Guardar" onClick="grabar_domiciliario()">
                        <img style="margin-left:10px" src="../../images/save.png" width="15" height="15">
                        <span style="color:#3A7099"><B>Guardar</B></span>
                        </div></td>
                        <td width="79"><div style="border: 1px solid #79B7E7; border-radius: 3px ; background-color:#DDECF7; padding:4px; width:60px; cursor:pointer">
                        <img style="margin-left:20px" src="../../images/print.png" width="15" height="15">
                        <span style="color:#3A7099"><B>Generar Doc.</B></span>
                        </div></td>
                        <td width="80"><div style="border: 1px solid #79B7E7; border-radius: 3px ; background-color:#DDECF7; padding:4px; width:70px; cursor:pointer">
                        <img style="margin-left:10px" src="../../images/block.png" width="15" height="15">
                        <span style="color:#3A7099"><B>Ver Doc.</B></span>
                        </div></td>
                    </tr>
            </table>
        </td>
    </tr>
    <tr>
    	<td height="43">
        	<table width="766" height="31">
            		<tr>
                    	<td width="96"><span class="camposss">Nº Certificado:</span></td>
                        <td width="146">
                        <input type="text" style="width:100px; background-color:#CCC" value="<?php echo formato_crono_agui($num_certificado); ?>" readonly class="camposss" />
                        <input id="n_numcert" name="n_numcert" type="text" style="width:100px; background-color:#CCC; display:none" value="<?php echo $num_certificado; ?>" readonly class="camposss" />
                        <input id="n_iddomi" name="n_iddomi" type="text" style="width:100px; background-color:#CCC; display:none" value="<?php  echo $id_domi; ?>" readonly class="camposss" /></td>
                        <td width="83"><span class="camposss">Fecha Ingreso:</span></td>
                        <td width="165"><input id="n_fecha" name="n_fecha" value="<?php echo date("d/m/Y");?>" type="text" class="tcal"  style="width:100px" readonly /></td>
                        <td width="88"><span class="camposss">Nº Formulario:</span></td>
                        <td width="160"><input id="n_formu" name="n_formu" type="text" style="width:100px" class="camposss"/></td>
                    </tr>
             </table>
        </td>
    </tr>
    <tr>
    	<td>
        	<fieldset>
            <legend><span class="camposss"><strong>SOLICITANTE</strong></span></legend>
            <div id="div_solicitante"></div>
            </fieldset>
        </td>
    </tr>
    <tr>
    	<td>
       	  <fieldset>
            <legend><span class="camposss"><strong>CUERPO</strong></span></legend>
        	
<table width="765" height="80">
  <tr>
    <td colspan="4">
    	<textarea id="n_cuerpo" name="n_cuerpo" style="width:686px; height:100px; padding:2px" class="camposss"></textarea>
    </td>
  </tr>
  <tr>
    <td width="129"><span class="camposss">Identificado con:</span></td>
    <td width="362">
    	<select id="n_tipdocut" name="n_tipdocut" style="width:319px" class="camposss" onChange="cambiar_doc('n_numdocut', this.value)">
            <option value="0">--Tipo Documento--</option>
            <?php for($j=0; $j<count($arr_tipdoc); $j++){?>
            <option value="<?php echo $arr_tipdoc[$j][0]; ?>"><?php echo $arr_tipdoc[$j][2]; ?></option>
            <?php }?>
            
        </select>
     </td>
    <td width="32"><span class="camposss">Nº:</span></td>
    <td width="222"><input id="n_numdocut" name="n_numdocut" type="text" style="width:150px" class="camposss" /></td>
  </tr>
  <tr>
    <td><span class="camposss">Testigo a ruego:</span></td>
    <td><input id="n_testigo" name="n_testigo" type="text" style="width:200px; text-transform:uppercase" class="camposss" /></td>
    <td></td>
    <td></td>
  </tr>
</table>
</fieldset>
        </td>
    </tr>
</table>

</form>
</div>
<span style="color:red; font-size:8px; position:relative; left:625px; top:10px">(*)Campos Obligatorios</span>	
</body>
</html>