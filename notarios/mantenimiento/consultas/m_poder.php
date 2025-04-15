<link rel="stylesheet" href="../../stylesglobal.css">	  

<?php

	include("../../extraprotocolares/view/funciones.php");
    
    $conexion = Conectar();
	
	$id_poder = $_REQUEST['id_poder'];
	
	$sql_poder = "SELECT
					contenidopoderes.id_asunto,
					contenidopoderes.des_asunto,
					contenidopoderes.conte_asunto,
					contenidopoderes.contenido
					FROM
					contenidopoderes
					where contenidopoderes.id_asunto= '$id_poder'";
					
	$exe_poder = mysql_query($sql_poder, $conexion);
	
	while($poder = mysql_fetch_array($exe_poder)){
		$arr_poder[0] = $poder["id_asunto"]; 
		$arr_poder[1] = strtoupper($poder["des_asunto"]);         
		$arr_poder[2] = $poder["conte_asunto"];
		$arr_poder[3] = $poder["contenido"];
		$i++; 
    }
	
?>

<form id="frm_mpoder" name="frm_mpoder" style="width:100%"/>
<table width="584" height="392" cellpadding="0" cellspacing="0">
        <tr style="background-color:#264965">
            <td colspan="4" align="center"><span class='submenutitu' style="font-size:14px">Modificar poder</span></td>
        </tr>
        <tr>
        	<td width="73" height="49"><span class='titubuskar0' style="margin-left:8px">Descripción</span></td>
            <td width="327">
            	<input id="m_desc" name="m_desc" type="text" class="Estilo7" style="width:280px; text-transform:uppercase" maxlength="50" value="<?php echo $arr_poder[1]; ?>"/><span style="color:red; margin-left:5px">(*)</span>
            </td>
            <td width="61"><span class='titubuskar0'>Código</span></td>
            <td width="121"><input id="m_cod" name="m_cod" type="text" class="Estilo7" style="width:100px; background-color:#CCC" value="<?php echo $id_poder; ?>" readonly /></td>
        </tr>
        <tr>
            <td height="272"><span class='titubuskar0' style="margin-left:8px">Contenido</span></td>
            <td colspan="3">
            	<textarea id="m_cont" name="m_cont" style="width:482px; height:250px; padding:5px; " class="Estilo7"><?php echo $arr_poder[3]; ?></textarea>
            </td>
        <tr align="center">
            <td colspan="4"><input type="button" value="Modificar" class="Estilo7" style="width:70px" onClick="mod_poder('<?php echo $id_poder; ?>')"/></td>
        </tr>
    </table>
    </form>

	<span class='submenutitu' style="position:relative; top:-386px; left:560px; cursor:pointer; font-size:14px" title="Cerrar" onClick="cerrar_mpoder()">x</span></div>
    
    <span style="color:red; font-size:8px; position:relative; left:470px; top:-30px">(*)Campos Obligatorios</span>	
