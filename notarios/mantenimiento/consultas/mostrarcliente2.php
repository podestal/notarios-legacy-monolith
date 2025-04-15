<div style="margin:20px;z-index:-1">
<?php 
if($row['razonsocial']!=""){
	$clie=$row['razonsocial'];
	$docuuu="RUC";
}else if($row['razonsocial']==""){
	$clie=$row['apepat']." ".$row['apemat']." ".$row['prinom']." ".$row['segnom'];
	$docuuu="DNI";
}
?>

<fieldset >
<legend >Resultados</legend>
<table width="507" cellpadding="0" cellspacing="0">
<TR>
 <td colspan="2"><span style="color:red; margin-left:5px">Cliente</span>         <input id="cliente_m" name="cliente_m" type="text" value="<?php echo $clie;?>" class="Estilo7" style="width:250px; text-transform:uppercase" onkeypress="sendCli(event);" readonly maxlength="80" />
          </span></td>
          <td width="159"><span style="color:red; margin-left:5px"><?php echo $docuuu;?></span>
          <input id="cliente_m" name="cliente_m" value="<?php echo $row['numdoc']; ?>" type="text" class="Estilo7" style="width:100px; text-transform:uppercase" onkeypress="sendDNI(event);" readonly maxlength="80" />  </td>
          <td width="19" height="50" align="right"><img src="../../iconos/cerrar.png" width="15" onclick="regresa_caja();" height="15" alt="cerrar"/></td>
<TR>
</Table>
<input id="idcliente_m" name="idcliente_m" value="<?php echo $row['idcliente']; ?>" type="hidden" class="Estilo7" style="width:100px; text-transform:uppercase" readonly maxlength="80"/>
</fieldset>
</div>