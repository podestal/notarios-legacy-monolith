	<link rel="stylesheet" href="../../stylesglobal.css">	  

	<?php

	include("../../extraprotocolares/view/funciones.php");
    
    $conexion = Conectar();
	
	$id_diligencia = $_REQUEST['id_diligencia'];
	
	$sql_diligencia = "SELECT
						diligencia_protesto.id_diligenciap,
						diligencia_protesto.des_diligenciap,
						diligencia_protesto.cont_diligenciap
						FROM
						diligencia_protesto
						where diligencia_protesto.id_diligenciap='$id_diligencia'";
						
	$exe_diligencia = mysql_query($sql_diligencia, $conexion);
						
	 while($diligencia = mysql_fetch_array($exe_diligencia)){
		$arr_diligencia[0] = $diligencia["id_diligenciap"]; 
		$arr_diligencia[1] = strtoupper($diligencia["des_diligenciap"]);         
		$arr_diligencia[2] = $diligencia["cont_diligenciap"]; 
		$i++; 
    }

	?>

    <form id="frm_mdiligencia" name="frm_mdiligencia" style="width:100%"/>
    <table width="584" height="392" cellpadding="0" cellspacing="0">
        <tr style="background-color:#264965">
            <td colspan="4" align="center"><span class='submenutitu' style="font-size:14px">Modificar diligencia</span></td>
        </tr>
        <tr>
        	<td width="73" height="49"><span class='titubuskar0' style="margin-left:8px">Descripción</span></td>
            <td width="327">
            	<input id="m_desc" name="m_desc" type="text" class="Estilo7" style="width:280px; text-transform:uppercase" value="<?php echo $arr_diligencia[1];?>" maxlength="50"/><span style="color:red; margin-left:5px">(*)</span>
            </td>
            <td width="61"><span class='titubuskar0'>Código</span></td>
            <td width="121"><input id="m_cod" name="m_cod" type="text" class="Estilo7" style="width:100px; background-color:#CCC" value="<?php echo $id_diligencia; ?>" readonly /></td>
        </tr>
        <tr>
            <td height="272"><span class='titubuskar0' style="margin-left:8px">Contenido</span></td>
            <td colspan="3">
            	<textarea id="m_cont" name="m_cont" style="width:482px; height:250px; padding:5px; " class="Estilo7"><?php echo $arr_diligencia[2];?></textarea>
            </td>
        <tr align="center">
            <td colspan="4"><input type="button" value="Modificar" class="Estilo7" style="width:70px" onClick="mod_diligencia('<?php echo $id_diligencia; ?>')"/></td>
        </tr>
    </table>
    </form>

	<span class='submenutitu' style="position:relative; top:-386px; left:560px; cursor:pointer; font-size:14px" title="Cerrar" onClick="cerrar_mdiligencia()">x</span></div>
    
    <span style="color:red; font-size:8px; position:relative; left:470px; top:-30px">(*)Campos Obligatorios</span>	
