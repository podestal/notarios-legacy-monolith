<link rel="stylesheet" href="../../stylesglobal.css">	  

<?php

	include("../../extraprotocolares/view/funciones.php");
    
    $conexion = Conectar();
	
	$id_sello = $_REQUEST['id'];
	
	$sql_sello  = "SELECT
				   selloscartas.idsello,
				   selloscartas.dessello,
				   selloscartas.contenido
				   FROM
				   selloscartas 
				   where selloscartas.idsello = '$id_sello'";
	
	$exe_sello = mysql_query($sql_sello, $conexion);
	
	while($sello = mysql_fetch_array($exe_sello)){
		$arr_sello[0] = $sello["idsello"]; 
		$arr_sello[1] = strtoupper($sello["dessello"]);         
		$arr_sello[2] = $sello["contenido"]; 
		$i++; 
    }
	
?>

<form id="frm_msello" name="frm_msello" style="width:100%"/>
<table width="584" height="392" cellpadding="0" cellspacing="0">
        <tr style="background-color:#264965">
            <td colspan="4" align="center"><span class='submenutitu' style="font-size:14px">Modificar Sello</span></td>
        </tr>
        <tr>
        	<td width="73" height="49"><span class='titubuskar0' style="margin-left:8px">Descripción</span></td>
            <td width="327">
            	<input id="m_desc" name="m_desc" type="text" class="Estilo7" style="width:280px; text-transform:uppercase" maxlength="50" value="<?php echo $arr_sello[1]; ?>"/><span style="color:red; margin-left:5px">(*)</span>
            </td>
            <td width="61"><span class='titubuskar0'>Código</span></td>
            <td width="121"><input id="m_cod" name="m_cod" type="text" class="Estilo7" style="width:100px; background-color:#CCC"  value="<?php echo $id_sello; ?>" readonly /></td>
        </tr>
        <tr>
            <td height="272"><span class='titubuskar0' style="margin-left:8px">Contenido</span></td>
            <td colspan="3">
            	<textarea id="m_cont" name="m_cont" style="width:482px; height:250px; padding:5px; " class="Estilo7"><?php echo $arr_sello[2]; ?></textarea>
            </td>
        <tr align="center">
            <td colspan="4"><input type="button" value="Modificar" class="Estilo7" style="width:70px" onClick="mod_sello('<?php echo $id_sello; ?>')"/></td>
        </tr>
    </table>
    </form>

	<span class='submenutitu' style="position:relative; top:-386px; left:560px; cursor:pointer; font-size:14px" title="Cerrar" onClick="cerrar_msello('<?php echo $id_sello; ?>')">x</span></div>
    
    <span style="color:red; font-size:8px; position:relative; left:470px; top:-30px">(*)Campos Obligatorios</span>	
