<?php 
session_start();
include("conexion1.php");	
include("extraprotocolares/view/funciones.php");
$id	= $_REQUEST['id'];
$query="SELECT 
		  d.*,
		  t.`abrev` 
		FROM
		  documentogenerados d 
		  LEFT JOIN tipodocumento t 
			ON t.`idtipdoc` = d.`tipo_docu` 
		WHERE d.id='$id'";
$queryLast=mysqli_query($conn_i,$query);
$row=mysqli_fetch_assoc($queryLast);
?>

<table width="100%" cellspacing="0" cellpadding="0">
	<tr>
    	<td align="justify" colspan="3">
        <span class="TITULO" style="margin-left:20px;color:#fff">
        CARGO PARA EL <?=$row["tipogeneracion"]?> DEL KARDEX <?=$row["kardex"]?>
        </span>
        </td>
    	<td align="right" width="5%">
        <a onClick="cerrarObsEscri()">
        <img src="iconos/cerrar.png">
        </a></td>
    </tr>
    <tr>
    	<td align="right" colspan="4">&nbsp;</td>
    </tr>
	<tr>
        <td align="right" width="15%" >
        <span class="TITULO" style="margin-left:12px;color:#fff">
        CLIENTE
        </span>
        </td>  
        <td colspan="3">
         &nbsp;&nbsp;<input type="text" class="TITULO21" readonly="readonly" value="<?=$row["cliente"]?>" style="width:92%" />
        </td>                      
    </tr>
	<tr>
        <td align="right" width="15%" >
        <span class="TITULO" style="margin-left:12px;color:#fff">
        TIPO
        </span>
        </td>  
        <td>
        &nbsp;&nbsp;<input type="text" class="TITULO21" readonly="readonly" value="<?=$row["abrev"]?>" style="width:70%"  />
        </td>  
        <td colspan="2">
        &nbsp;&nbsp;<span class="TITULO" style="margin-left:12px;color:#fff">
        N&deg;
        </span>&nbsp;<input type="text" class="TITULO21" readonly="readonly" value="<?=$row["num_docu"]?>" style="width:65%"  />
        </td>                     
    </tr>
    <tr>
        <td align="right" width="15%" >
        <span class="TITULO" style="margin-left:12px;color:#fff">
        FECHA
        </span>
        </td>  
        <td>
        &nbsp;&nbsp;<input type="text" class="TITULO21" readonly="readonly" value="<?=$row["num_docu"]?>"  style="width:70%" />
        </td>                      
    </tr>
    <tr>
        <td align="right" width="15%" >
        <span class="TITULO" style="margin-left:12px;color:#fff">
        OBSERVACION
        </span>
        </td>  
        <td colspan="4"></td>                      
    </tr>
    <tr>
        <td align="center" width="15%" colspan="4">
        
        <textarea id="obs" name="obs" class="TITULO21" style="width:95%;height:60px;text-transform:uppercase;"><?=$row["observacion"]?></textarea>
        </td>                        
    </tr> 
</table>