<?php

$tip_cliente = $_REQUEST["tip_cliente"]; 

?>

<table cellpadding="0" cellspacing="0" border="0">
	<tr>
    	<td height="47" colspan="4" align="center">
        	<span class="camposs">Registrar Nuevo Cliente</span>
        </td>
    </tr>
    
    <?php if($tip_cliente==1){ ?>
    <tr>
    	<td width="138"><span class="camposs">Primer Nombre:</span></td>
        <td width="100"><input type="text" class="camposss" style="width:100px" maxlength="20"/></td>
        <td width="118"><span class="camposs">Segundo Nombre:</span></td>
        <td width="120"><input type="text" class="camposss" style="width:100px" maxlength="20"/></td>
    </tr>
    <tr>
    	<td><span class="camposs">Apellido Paterno:</span></td>
        <td><input type="text" class="camposss" style="width:100px" maxlength="20"/></td>
        <td><span class="camposs">Apellido Materno:</span></td>
        <td><input type="text" class="camposss" style="width:100px" maxlength="20"/></td>
    </tr>
    <tr>
    	<td><span class="camposs">DNI:</span></td>
        <td><input type="text" class="camposss" style="width:100px" maxlength="20"/></td>
        <td><span class="camposs">Telefono:</span></td>
        <td><input type="text" class="camposss" style="width:100px" maxlength="20"/></td>
    </tr>
    <?php } ?>
    
    <?php if($tip_cliente==2) { ?>
    <tr>
    	<td><span class="camposs">Razon Social:</span></td>
        <td><input type="text" class="camposss" style="width:100px" maxlength="20"/></td>
        <td><span class="camposs">Teléfono de oficina:</span></td>
        <td><input type="text" class="camposss" style="width:100px" maxlength="20"/></td>
    </tr>
    <?php } ?>
    
    <tr>
    	<td><span class="camposs">Celular:</span></td>
        <td><input type="text" class="camposss" style="width:100px" maxlength="20"/></td>
        <td><span class="camposs">Dirección:</span></td>
        <td><input type="text" class="camposss" style="width:100px" maxlength="20"/></td>
    </tr>
    <tr>
    	<td><span class="camposs">Email:</span></td>
        <td><input type="text" class="camposss" style="width:100px" maxlength="20"/></td>
        <td>Sexo:</td>
        <td><input type="text" class="camposss" style="width:100px" maxlength="20"/></td>
    </tr>
    <tr>
    	<td><span class="camposs">Estado CIvil:</span></td>
        <td><input type="text" class="camposss" style="width:100px" maxlength="20"/></td>
        <td><span class="camposs">Nacionalidad:</span></td>
        <td><input type="text" class="camposss" style="width:100px" maxlength="20"/></td>
    </tr>
    <tr>
    	<td><span class="camposs">Fecha de Nascimiento:</span></td>
        <td><input type="text" class="camposss" style="width:100px" maxlength="20"/></td>
        <td><span class="camposs">Ubigeo:</span></td>
        <td><input type="text" class="camposss" style="width:100px" maxlength="20"/></td>
    </tr>
    <tr>
    	<td><span class="camposs">Residente de:</span></td>
        <td><input type="text" class="camposss" style="width:100px" maxlength="20"/></td>
        <td><span class="camposs">Natural de:</span></td>
        <td><input type="text" class="camposss" style="width:100px" maxlength="20"/></td>
    </tr>
    <tr>
    	<td height="55" colspan="4" align="center">
        <input type="button" value="Grabar" class="camposss"/> 	
        </td>
    </tr>
</table>

<div style="position:relative; left:100px; top:100px">X</div>