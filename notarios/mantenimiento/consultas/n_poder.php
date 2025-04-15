<link rel="stylesheet" href="../../stylesglobal.css">	  

<?php

	include("../../extraprotocolares/view/funciones.php");
    
    $conexion = Conectar();
	
	$sql_idpoder = "SELECT contenidopoderes.id_asunto FROM contenidopoderes ORDER BY contenidopoderes.id_asunto DESC LIMIT 0,1";
	
	$exe_idpoder = mysql_query($sql_idpoder, $conexion);
	
	$row_lastpoder = mysql_fetch_array($exe_idpoder);
		
	$id_poder = intval($row_lastpoder['id_asunto'])+1;
	
	
?>

<form id="frm_npoder" name="frm_npoder" style="width:100%"/>
<table width="584" height="392" cellpadding="0" cellspacing="0">
        <tr style="background-color:#264965">
            <td colspan="4" align="center"><span class='submenutitu' style="font-size:14px">Nuevo poder</span></td>
        </tr>
        <tr>
        	<td width="73" height="49"><span class='titubuskar0' style="margin-left:8px">Descripción</span></td>
            <td width="327">
            	<input id="n_desc" name="n_desc" type="text" class="Estilo7" style="width:280px; text-transform:uppercase" maxlength="50"/><span style="color:red; margin-left:5px">(*)</span>
            </td>
            <td width="61"><span class='titubuskar0'>Código</span></td>
            <td width="121"><input id="n_cod" name="n_cod" type="text" class="Estilo7" style="width:100px; background-color:#CCC" value="<?php echo $id_poder; ?>" readonly /></td>
        </tr>
        <tr>
            <td height="272"><span class='titubuskar0' style="margin-left:8px">Contenido</span></td>
            <td colspan="3">
            	<textarea id="n_cont" name="n_cont" style="width:482px; height:250px; padding:5px; " class="Estilo7"></textarea>
            </td>
        <tr align="center">
            <td colspan="4"><input type="button" value="Guardar" class="Estilo7" style="width:70px" onClick="registrar_poder()"/></td>
        </tr>
    </table>
    </form>

	<span class='submenutitu' style="position:relative; top:-386px; left:560px; cursor:pointer; font-size:14px" title="Cerrar" onClick="cerrar_npoder()">x</span></div>
    
    <span style="color:red; font-size:8px; position:relative; left:470px; top:-30px">(*)Campos Obligatorios</span>	
