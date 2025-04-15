
<style>
.Estilo10 {
	color: #333333;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	font-weight: bold;
}

.camposss {font-family: Calibri; font-style: italic; font-size: 14px; color: #333333; }	
</style>

<?php 

	 include("../../extraprotocolares/view/funciones.php");
		
	 $conexion = Conectar();
	 
	 $codigo = $_REQUEST['codigo'];
	 
	$sql_reclib = "SELECT
					recogio_libro.idreco,
					recogio_libro.numlibro,
					recogio_libro.nomape,
					recogio_libro.documen,
					recogio_libro.fecha,
					recogio_libro.comprobante
					FROM
					recogio_libro
					WHERE
					recogio_libro.numlibro =  '$codigo'";
				
	$exe_reclib = mysql_query($sql_reclib, $conexion);
	
    while($recogidos = mysql_fetch_array($exe_reclib, MYSQL_ASSOC))
    {
		$arr_recogidos[0] = $recogidos["nomape"]; 
		$arr_recogidos[1] = $recogidos["documen"];
		$arr_recogidos[2] = $recogidos["numlibro"];
		$arr_recogidos[3] = $recogidos["fecha"];
		$arr_recogidos[4] = $recogidos["comprobante"];
	}


?>
<table width="322" cellpadding="0" cellspacing="0" bgcolor="#999933" border="1">
    <tr height="35">
        <td colspan="2" align="center">
            <span class="Estilo10">Datos del Recojo</span>
        </td>
    </tr>
    <tr>
        <td align="center">
            <table width="312" height="150">
            	<tr height="30">
                	<td>
                   	  <span class="Estilo10" style="margin-left:10px">Libro</span></td>
                    <td>
                    	<input id="l_cliente" name="l_cliente" type="text" maxlength="100" tabindex="2" style="width:120px;  text-transform:uppercase" class="camposss" value="<?php echo substr($arr_recogidos[2],4,6).'-'.substr($arr_recogidos[2],0,4); ?>" readonly/>
                    </td>
                </tr>
                <tr height="30">
                    <td width="86">
                        <span class="Estilo10" style="margin-left:10px">Cliente</span></td>
                    <td width="214">
                        <input id="l_cliente" name="l_cliente" type="text" maxlength="100" tabindex="2" style="width:200px;  text-transform:uppercase" class="camposss" value="<?php echo $arr_recogidos[0] ?>" readonly/>
                    </td>
                </tr>
                <tr height="30">
                    <td>
                        <span class="Estilo10" style="margin-left:10px">DOI</span>
                    </td>
                    <td>
                        <input id="l_doi" name="l_doi" type="text" maxlength="11" tabindex="3" style="width:100px" class="camposss" value="<?php echo $arr_recogidos[1] ?>" readonly />

                    </td>
                </tr>
                <tr height="30">
                    <td>
                        <span class="Estilo10" style="margin-left:10px">Fecha</span>
                    </td>
                    <td>
                        <input id="l_fecha" name="l_fecha" type="text" value="<?php echo $arr_recogidos[3] ?>" readonly tabindex="4" style="width:80px" class="camposss"/>
                    </td>
                </tr>
                <tr height="30">
                    <td>
                        <span class="Estilo10" style="margin-left:10px">Comprobante</span>
                    </td>
                    <td>
                        <input id="l_comprobante" name="l_comprobante" type="text" value="<?php echo $arr_recogidos[4] ?>" maxlength="15" tabindex="5" style="width:100px; text-transform:uppercase" class="camposss" readonly/>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr height="10">
    	<td></td>
    </tr>
</table>


<div style="position:absolute; left:299px; top:8px; font-size:14px; cursor:pointer" onClick="cerrar_datosrecojo()">x</div>