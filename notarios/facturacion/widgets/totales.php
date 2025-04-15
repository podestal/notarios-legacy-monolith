 
 <?php 
 $tipdocu = $_REQUEST["tip_docu"];
 

 if($tipdocu==01 || $tipdocu==04){
 ?>   
    <table width="839">
        <tr>
            <td width="390"><input id="numero" name="numero" type="hidden" /></td>
            <td width="62"><span class="camposss">Sub Total:</span></td>
            <td width="80"><input id="subtotal" name="subtotal" type="hidden" class="camposss" style="width:70px; background-color:#CCCCCC; text-align:right" value="0" readonly/></td>
            <td width="62"><span class="camposss">IGV(18%):</span></td>
            <td width="80"><input id="igv" name="igv" type="hidden" class="camposss" style="width:70px; background-color:#CCCCCC; text-align:right" value="0" readonly /></td>
            <td width="63"><span class="camposss">Total:</span></td>
            <td width="80"><input id="total" name="total" type="text" class="camposss" style="width:70px; background-color:#CCCCCC; text-align:right" value="0" readonly /></td>
        </tr>
    </table>
 <?php 
 
 }else if($tipdocu==02){

	 
 ?>
     <table width="839">
        <tr>
            <td width="390"><input id="numero" name="numero" type="hidden" /></td>
            <td width="62"><span class="camposss">Sub Total:</span></td>
            <td width="80"><input id="subtotal" name="subtotal" type="text" class="camposss" style="width:70px; background-color:#CCCCCC; text-align:right" value="0" readonly/></td>
            <td width="62"><span class="camposss">IGV(18%):</span></td>
            <td width="80"><input id="igv" name="igv" type="text" class="camposss" style="width:70px; background-color:#CCCCCC; text-align:right" value="0" readonly /></td>
            <td width="63"><span class="camposss">Total:</span></td>
            <td width="80"><input id="total" name="total" type="text" class="camposss" style="width:70px; background-color:#CCCCCC; text-align:right" value="0" readonly /></td>
        </tr>
    </table>
 <?php 
 
 
 }?>