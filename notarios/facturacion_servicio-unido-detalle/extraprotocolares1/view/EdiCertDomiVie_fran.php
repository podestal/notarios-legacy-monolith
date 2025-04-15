<?php 
	session_start();

	include("funciones.php");
	
	$conexion = Conectar(); 
	
	$id_domiciliario = $_REQUEST['id_domiciliario'];
	
	$sql_domiciliario  =   "SELECT
						    cert_domiciliario.id_domiciliario,
						    cert_domiciliario.num_certificado,
						    cert_domiciliario.fec_ingreso,
						    cert_domiciliario.nombre_solic,
						    cert_domiciliario.domic_solic,
						    cert_domiciliario.motivo_solic,
						    cert_domiciliario.num_formu,
							cert_domiciliario.tipdoc_solic,
							cert_domiciliario.numdoc_solic,
							cert_domiciliario.distrito_solic,
							cert_domiciliario.texto_cuerpo,
							cert_domiciliario.nom_testigo,
							cert_domiciliario.tdoc_testigo,
							cert_domiciliario.ndocu_testigo,
							cert_domiciliario.idestcivil,
							cert_domiciliario.sexo,
							cert_domiciliario.profesionc
							FROM 
							cert_domiciliario
							where cert_domiciliario.id_domiciliario=$id_domiciliario";
	
	$exe_domiciliario = mysql_query($sql_domiciliario, $conexion);
	  
    while($domiciliarios = mysql_fetch_array($exe_domiciliario, MYSQL_ASSOC))
    {
		$arr_domiciliarios[0] = $domiciliarios["id_domiciliario"]; 
		$arr_domiciliarios[1] = $domiciliarios["num_certificado"];
		$arr_domiciliarios[2] = $domiciliarios["fec_ingreso"];
		$arr_domiciliarios[3] = $domiciliarios["domic_solic"];
		$arr_domiciliarios[4] = $domiciliarios["nombre_solic"];
		$arr_domiciliarios[5] = $domiciliarios["motivo_solic"];
		$arr_domiciliarios[6] = $domiciliarios["num_formu"]; 
		$arr_domiciliarios[7] = $domiciliarios["tipdoc_solic"];
		$arr_domiciliarios[8] = $domiciliarios["numdoc_solic"];
		$arr_domiciliarios[9] = $domiciliarios["distrito_solic"];
		$arr_domiciliarios[10] = $domiciliarios["texto_cuerpo"];
		$arr_domiciliarios[11] = $domiciliarios["nom_testigo"];
		$arr_domiciliarios[12] = $domiciliarios["tdoc_testigo"]; 
		$arr_domiciliarios[13] = $domiciliarios["ndocu_testigo"];
		$arr_domiciliarios[14] = $domiciliarios["idestcivil"];
		$arr_domiciliarios[15] = $domiciliarios["sexo"];
		$arr_domiciliarios[16] = $domiciliarios["profesionc"];
	}
	
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

<body style="font-size:62.5%;" onLoad="mostrar_solicitantem()">

<div id="carta_content">
<form id="frm_mdomiciliario" name="frm_mdomiciliario">
<table width="855" height="455">
	<tr>
    	<td height="58" valign="top">
        	<table>
            		<tr>
                    	<td width="64"><div style="border: 1px solid #79B7E7; border-radius: 3px ; background-color:#DDECF7; padding:4px; width:40px; cursor:pointer" title="Guardar" onClick="mod_domiciliario()">
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
                        <input type="text" style="width:100px; background-color:#CCC" value="<?php echo formato_crono_agui($arr_domiciliarios[1]); ?>" readonly class="camposss" />
                        <input id="m_numcert" name="m_numcert" type="text" style="width:100px; background-color:#CCC; display:none" value="<?php echo $arr_domiciliarios[1]; ?>" readonly class="camposss" />				
                        <input id="m_iddomi" name="m_iddomi" type="text" style="width:100px; background-color:#CCC; display:none" value="<?php echo $arr_domiciliarios[0]; ?>" readonly class="camposss" /></td>
                        <td width="83"><span class="camposss">Fecha Ingreso:</span></td>
                        <td width="165"><input id="m_fecha" name="m_fecha" value="<?php echo $arr_domiciliarios[2]; ?>" type="text" class="tcal"  style="width:100px" readonly /></td>
                        <td width="88"><span class="camposss">Nº Formulario:</span></td>
                        <td width="160"><input id="m_formu" name="m_formu" type="text" value="<?php echo $arr_domiciliarios[6]; ?>" style="width:100px" class="camposss"/></td>
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
    	<textarea id="m_cuerpo" name="m_cuerpo" style="width:686px; height:100px; padding:2px" class="camposss"><?php echo $arr_domiciliarios[10]; ?></textarea>
    </td>
  </tr>
  <tr>
    <td width="129"><span class="camposss">Identificado con:</span></td>
    <td width="362">
    	<select id="m_tipdocut" name="m_tipdocut" style="width:319px" class="camposss" onChange="cambiar_doc('m_numdocut', this.value)">
            <option value="0">--Tipo Documento--</option>
            <?php for($j=0; $j<count($arr_tipdoc); $j++){?>
            <option 
            <?php 
			if($arr_domiciliarios[12]==$arr_tipdoc[$j][0]){
				echo "selected='selected'";
			}
			?>
            value="<?php echo $arr_tipdoc[$j][0]; ?>"><?php echo $arr_tipdoc[$j][2]; ?></option>
            <?php }?>
            
        </select>
     </td>
    <td width="32"><span class="camposss">Nº:</span></td>
    <td width="222"><input id="m_numdocut" name="m_numdocut" type="text" value="<?php echo $arr_domiciliarios[13]; ?>" style="width:150px" class="camposss" /></td>
  </tr>
  <tr>
    <td><span class="camposss">Testigo a ruego:</span></td>
    <td><input id="m_testigo" name="m_testigo" type="text" value="<?php echo $arr_domiciliarios[11]; ?>" style="width:200px; text-transform:uppercase" class="camposss" /></td>
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