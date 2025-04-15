<?php

	class GridView
	{
		private $srv        ;
		private $db         ;
		private $usr        ;
		private $pwd        ;
		private $oMySQLi    ;
		public  $DataSource ;
		public  $name       ;
		public  $cssPar     ;
		public  $cssImp     ;
		public  $cssCab     ;
		public  $click      ;
		public  $dblclick   ;
		public  $onmouseover;
		public  $onMouseOut1;
		public  $onMouseOut2;
		public  $paginar    ;
		public  $numPag     ;
		public  $txtpag;
		public  $btnpag;
		private $qRs        ;
		public  $numReg     ;
		public  $width      ;
		public  $NumFields  ;
		public  $posPag     ;
		public  $height     ;
		private $js			;
		public  $botonElim  ;
		public  $botonModi  ;
		public  $elimClick  ;
		public  $modiClick  ;
		public  $despuesElim;
		public  $chkItem;
		public  $chkClick;
		
		function __construct()
			{
				$this->srv     = "localhost" ;
				$this->usr     = "root"      ;
				$this->pwd     = "12345"          ;
				$this->db      = "notarios"    ;
				$this->oMySQLi = new MySQLi();
				$this->numReg  = 10          ;
				$this->width   ="";
				$this->NumFields   = 0;
				$this->height      = "0";

			}
		
		private function fCon()
			{
				$this->oMySQLi->connect($this->srv,$this->usr,$this->pwd);
				if($this->oMySQLi->connect_errno)
					{
						die("Error :".$this->oMySQLi->connect_errno);
						exit();
					}
			}
			
		function Show()
			{
				$table = "<table border='1' cellpadding='0' cellspacing='0' bordercolor='#0070C0'>";
				$this->fCon();
				$this->oMySQLi->select_db($this->db);
				$this->qRs = $this->oMySQLi->query($this->DataSource);
				$Cols = $this->qRs->field_count;
				$th    = "";
				$tr    = "";
				$td    = "";
				$fil   = "";
				$numFil= 1;
				$fields = $this->qRs->fetch_fields();
				$num = 0;

				$this->js = ' <style>
								.'.$this->name.' {
								background-color: WHITE;font-size: 10px;}
								.'.$this->name.' .header td {font-weight: bold;
								background-color: #CCCCCC;}
								.cur {cursor:pointer; }
								.Estilo26 {font-family: Arial, Helvetica, sans-serif; font-size: 10px; }
								.Estilo28 {font-family: Arial, Helvetica, sans-serif; font-size: 10px; color: #FFFFFF; }
								.Estilo31 {font-family: Arial, Helvetica, sans-serif; font-size: 10px; color: #376091; }
								.Estilo33 {font-family: Arial, Helvetica, sans-serif; font-size: 20px; color: #1F497D; font-weight: bold; }
								.Estilo41 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; }
							 </style>';
				$th = '';
				$columns = 0;
				
				/*foreach($fields as $xfield)
					{
						if($this->NumFields==0)
						{
							$th = $th.'<td class="'.$this->cssCab.'" id="C'.$columns.'">'.$xfield->name.'</td>';
							}
						else
						{
						if($num<=$this->NumFields && $this->NumFields>0)
							{
								$th = $th.'<td class="'.$this->cssCab.'" id="C'.$columns.'">'.$xfield->name.'</td>';
								
							}
						$num++;
						}
						$columns++;
					}
					$th = $th.'<td class="'.$this->cssCab.'"></td><td class="buttonA"></td>';
				*/
				$th = '<tr height="17" bordercolor="#0070C0" bgcolor="#254061">    <td width="46" height="119" rowspan="3" align="center" valign="top" bordercolor="#0070C0" bgcolor="#376091"><span class="Estilo28">Número de      registro de la operación</span></td>    <td height="18" colspan="11" align="center" valign="top" bordercolor="#0070C0" bgcolor="#1F497D"><span class="Estilo28">Datos    de identificación del registro de la operación</span></td>    <td colspan="5" align="center" valign="top" bordercolor="#0070C0" bgcolor="#1F497D"><span class="Estilo28">Participación    y representación de las personas involucradas en la operación</span></td>    <td colspan="26" align="center" valign="top" bordercolor="#0070C0" bgcolor="#1F497D"><span class="Estilo28">Datos    de identificación de las personas que intervienen en la operación</span></td>    <td colspan="13" align="center" valign="top" bordercolor="#0070C0" bgcolor="#1F497D"><span class="Estilo28">Datos Relacionados con la Descripción de la    Operación    (Acto/Contrato Extendido en Instrumento Público Notarial Protocolar)</span></td>  </tr>  <tr height="34">    <td width="64" height="102" rowspan="2" align="center" valign="top" bordercolor="#0070C0" bgcolor="#254061"><span class="Estilo28">Código     de fila</span></td>    <td width="68" rowspan="2" align="center" valign="top" bordercolor="#0070C0" bgcolor="#254061"><span class="Estilo28">Tipo de     Transacción</span></td>    <td colspan="7" align="center" valign="top" bordercolor="#0070C0" bgcolor="#376091"><span class="Estilo28">Instrumento Público Notarial Protocolar     (IPNP)</span></td>    <td width="54" rowspan="2" align="center" valign="top" bordercolor="#0070C0" bgcolor="#254061"><span class="Estilo28">Modalidad     de la operación</span></td>    <td width="82" rowspan="2" align="center" valign="top" bordercolor="#0070C0" bgcolor="#254061"><span class="Estilo28">Cantidad de     operaciones que contiene la operación     Múltiple</span></td>    <td colspan="3" align="center" valign="top" bordercolor="#0070C0" bgcolor="#376091"><span class="Estilo28">Roles del Participante</span></td>    <td colspan="2" align="center" valign="top" bordercolor="#0070C0" bgcolor="#376091"><span class="Estilo28">Representación</span></td>    <td width="72" rowspan="2" align="center" valign="top" bordercolor="#0070C0" bgcolor="#254061"><span class="Estilo28">Condición      de residencia    (Declarada en el IPNP)</span></td>    <td width="51" rowspan="2" align="center" valign="top" bordercolor="#0070C0" bgcolor="#254061"><span class="Estilo28">Tipo de    persona</span></td>    <td colspan="2" align="center" valign="top" bordercolor="#0070C0" bgcolor="#376091"><span class="Estilo28">Documento de identidad</span></td>    <td width="116" rowspan="2" align="center" valign="top" bordercolor="#0070C0" bgcolor="#254061"><span class="Estilo28">Número de    Registro Único de Contribuyente (RUC)</span></td>    <td colspan="3" align="center" valign="top" bordercolor="#0070C0" bgcolor="#376091"><span class="Estilo28">Nombre    completo de la persona</span></td>    <td width="69" rowspan="2" align="center" valign="top" bordercolor="#0070C0" bgcolor="#254061"><span class="Estilo28">País de     nacionalidad</span></td>    <td width="68" rowspan="2" align="center" valign="top" bordercolor="#0070C0" bgcolor="#254061"><span class="Estilo28">Fecha    de     nacimiento</span></td>    <td width="50" rowspan="2" align="center" valign="top" bordercolor="#0070C0" bgcolor="#254061"><span class="Estilo28">Estado      civil</span></td>    <td colspan="4" align="center" valign="top" bordercolor="#0070C0" bgcolor="#376091"><span class="Estilo28">Cargo,    ocupación, oficio, profesión, actividad económica  u objeto social</span></td>    <td colspan="2" align="center" valign="top" bordercolor="#0070C0" bgcolor="#376091"><span class="Estilo28">Inscripción    en SUNARP de la Representación </span></td>    <td colspan="5" align="center" valign="top" bordercolor="#0070C0" bgcolor="#376091"><span class="Estilo28">Domicilio    y teléfonos</span></td>    <td width="69" rowspan="2" align="center" valign="top" bordercolor="#0070C0" bgcolor="#254061"><span class="Estilo28">Participación    del cónyuge</span></td>    <td colspan="3" align="center" valign="top" bordercolor="#0070C0" bgcolor="#376091"><span class="Estilo28">Nombre    completo del cónyuge</span></td>    <td width="122" rowspan="2" align="center" valign="top" bordercolor="#0070C0" bgcolor="#254061"><span class="Estilo28">Tipo    de fondos con que se realizó la operación</span></td>    <td width="84" rowspan="2" align="center" valign="top" bordercolor="#0070C0" bgcolor="#254061"><span class="Estilo28">Tipo    de operación</span></td>    <td rowspan="2" align="center" valign="top" bordercolor="#0070C0" bgcolor="#254061"><span class="Estilo28">Forma    de pago mediante la cual se realizó la operación </span></td>    <td width="111" rowspan="2" align="center" valign="top" bordercolor="#0070C0" bgcolor="#254061"><span class="Estilo28">Oportunidad    de pago de la operación</span></td>    <td width="127" rowspan="2" align="center" valign="top" bordercolor="#0070C0" bgcolor="#254061"><span class="Estilo28">Descripción    de la oportunidad de pago    (en caso de otros)</span></td>    <td width="134" rowspan="2" align="center" valign="top" bordercolor="#0070C0" bgcolor="#254061"><span class="Estilo28">Origen    de los fondos involucrados en la operación </span></td>    <td width="152" rowspan="2" align="center" valign="top" bordercolor="#0070C0" bgcolor="#254061"><span class="Estilo28">Moneda    en que se realizó la operación    (Codificación ISO.4217)</span></td>    <td width="91" rowspan="2" align="center" valign="top" bordercolor="#0070C0" bgcolor="#254061"><span class="Estilo28">Monto total de participacion </span></td>    <td width="91" rowspan="2" align="center" valign="top" bordercolor="#0070C0" bgcolor="#254061"><span class="Estilo28">Monto    de la operación</span></td>    <td width="91" rowspan="2" align="center" valign="top" bordercolor="#0070C0" bgcolor="#254061"><span class="Estilo28">Monto del medio de pago</span></td>    <td width="98" rowspan="2" align="center" valign="top" bordercolor="#0070C0" bgcolor="#254061"><span class="Estilo28">Tipo de    cambio    </span></td>    <td colspan="2" align="center" valign="top" bordercolor="#0070C0" bgcolor="#376091"><span class="Estilo28">Inscripción en SUNARP del bien materia de la    operación </span></td>  </tr>  <tr height="68">    <td width="90" height="41" align="center" valign="top" bordercolor="#0070C0" bgcolor="#254061"><span class="Estilo28">Tipo</span></td>    <td width="96" align="center" valign="top" bordercolor="#0070C0" bgcolor="#254061"><span class="Estilo28">Número</span></td>    <td width="88" align="center" valign="top" bordercolor="#0070C0" bgcolor="#254061"><span class="Estilo28">Fecha del     instrumento</span></td>    <td width="64" align="center" valign="top" bordercolor="#0070C0" bgcolor="#254061"><span class="Estilo28">Numero Aclaratoria</span></td>    <td width="64" align="center" valign="top" bordercolor="#0070C0" bgcolor="#254061"><span class="Estilo28">Fecha de Aclaratoria</span></td>    <td width="73" align="center" valign="top" bordercolor="#0070C0" bgcolor="#254061"><span class="Estilo28">Conclusión</span></td>    <td width="67" align="center" valign="top" bordercolor="#0070C0" bgcolor="#254061"><span class="Estilo28">Fecha de     la firma</span></td>    <td width="72" align="center" valign="top" bordercolor="#0070C0" bgcolor="#254061"><span class="Estilo28">Representante</span></td>    <td width="70" align="center" valign="top" bordercolor="#0070C0" bgcolor="#254061"><span class="Estilo28">Ordenante o     Fiador</span></td>    <td width="66" align="center" valign="top" bordercolor="#0070C0" bgcolor="#254061"><span class="Estilo28">Beneficiario</span></td>    <td width="93" align="center" valign="top" bordercolor="#0070C0" bgcolor="#254061"><span class="Estilo28">Participante    al que     se representa</span></td>    <td width="91" align="center" valign="top" bordercolor="#0070C0" bgcolor="#254061"><span class="Estilo28">Tipo    de representación</span></td>    <td width="119" align="center" valign="top" bordercolor="#0070C0" bgcolor="#254061"><span class="Estilo28">Tipo</span></td>    <td width="120" align="center" valign="top" bordercolor="#0070C0" bgcolor="#254061"><span class="Estilo28">Número</span></td>    <td width="97" align="center" valign="top" bordercolor="#0070C0" bgcolor="#254061"><span class="Estilo28">Apellido    paterno /     Razón social</span></td>    <td width="87" align="center" valign="top" bordercolor="#0070C0" bgcolor="#254061"><span class="Estilo28">Apellido    materno</span></td>    <td width="121" align="center" valign="top" bordercolor="#0070C0" bgcolor="#254061"><span class="Estilo28">Nombres</span></td>    <td width="65" align="center" valign="top" bordercolor="#0070C0" bgcolor="#254061"><span class="Estilo28">Código    de Cargo</span></td>    <td width="77" align="center" valign="top" bordercolor="#0070C0" bgcolor="#254061"><span class="Estilo28">Código      de Ocupación    </span></td>    <td width="69" align="center" valign="top" bordercolor="#0070C0" bgcolor="#254061"><span class="Estilo28">Código    CIIU</span></td>    <td width="139" align="center" valign="top" bordercolor="#0070C0" bgcolor="#254061"><span class="Estilo28">Descripción    (personas  jurídicas y otros)</span></td>    <td width="104" align="center" valign="top" bordercolor="#0070C0" bgcolor="#254061"><span class="Estilo28">Código    de la Zona Registral</span></td>    <td width="126" align="center" valign="top" bordercolor="#0070C0" bgcolor="#254061"><span class="Estilo28">Número    de partida electrónica o ficha registral</span></td>    <td width="103" align="center" valign="top" bordercolor="#0070C0" bgcolor="#254061"><span class="Estilo28">Tipo,    nombre y número de la vía</span></td>    <td width="75" align="center" valign="top" bordercolor="#0070C0" bgcolor="#254061"><span class="Estilo28">Código    de Ubicación Geográfica DPTO</span></td>    <td width="75" align="center" valign="top" bordercolor="#0070C0" bgcolor="#254061"><span class="Estilo28">Código    de Ubicación Geográfica PROV</span></td>    <td width="75" align="center" valign="top" bordercolor="#0070C0" bgcolor="#254061"><span class="Estilo28">Código    de Ubicación Geográfica DIST</span></td>    <td width="60" align="center" valign="top" bordercolor="#0070C0" bgcolor="#254061"><span class="Estilo28">Teléfonos</span></td>    <td width="103" align="center" valign="top" bordercolor="#0070C0" bgcolor="#254061"><span class="Estilo28">Apellido    paterno</span></td>    <td width="106" align="center" valign="top" bordercolor="#0070C0" bgcolor="#254061"><span class="Estilo28">Apellido    materno</span></td>    <td width="102" align="center" valign="top" bordercolor="#0070C0" bgcolor="#254061"><span class="Estilo28">Nombres</span></td>    <td width="179" align="center" valign="top" bordercolor="#0070C0" bgcolor="#254061"><span class="Estilo28">Código    de la Zona Registral</span></td>    <td width="160" align="center" valign="top" bordercolor="#0070C0" bgcolor="#254061"><span class="Estilo28">Número    de partida electrónica o ficha registral</span></td>  </tr>  <tr height="17">    <td height="17" align="center" valign="middle" bordercolor="#0070C0" bgcolor="#376091"><span class="Estilo28">Ítem: 1</span></td>    <td align="center" valign="middle" bordercolor="#0070C0" bgcolor="#376091"><span class="Estilo28">2</span></td>    <td align="center" valign="middle" bordercolor="#0070C0" bgcolor="#376091"><span class="Estilo28">3</span></td>    <td align="center" valign="middle" bordercolor="#0070C0" bgcolor="#376091"><span class="Estilo28">4</span></td>    <td align="center" valign="middle" bordercolor="#0070C0" bgcolor="#376091"><span class="Estilo28">5</span></td>    <td align="center" valign="middle" bordercolor="#0070C0" bgcolor="#376091"><span class="Estilo28">6</span></td>    <td align="center" valign="middle" bordercolor="#0070C0" bgcolor="#376091"><span class="Estilo28">7</span></td>    <td align="center" valign="middle" bordercolor="#0070C0" bgcolor="#376091"><span class="Estilo28">8</span></td>    <td align="center" valign="middle" bordercolor="#0070C0" bgcolor="#376091"><span class="Estilo28">9</span></td>    <td align="center" valign="middle" bordercolor="#0070C0" bgcolor="#376091"><span class="Estilo28">10</span></td>    <td align="center" valign="middle" bordercolor="#0070C0" bgcolor="#376091"><span class="Estilo28">11</span></td>    <td align="center" valign="middle" bordercolor="#0070C0" bgcolor="#376091"><span class="Estilo28">12</span></td>    <td width="72" align="center" valign="middle" bordercolor="#0070C0" bgcolor="#376091"><span class="Estilo28">13</span></td>    <td width="70" align="center" valign="middle" bordercolor="#0070C0" bgcolor="#376091"><span class="Estilo28">14</span></td>    <td width="66" align="center" valign="middle" bordercolor="#0070C0" bgcolor="#376091"><span class="Estilo28">15</span></td>    <td width="93" align="center" valign="middle" bordercolor="#0070C0" bgcolor="#376091"><span class="Estilo28">16</span></td>   <td width="91" align="center" valign="middle" bordercolor="#0070C0" bgcolor="#376091"><span class="Estilo28">17</span></td>    <td align="center" valign="middle" bordercolor="#0070C0" bgcolor="#376091"><span class="Estilo28">18</span></td>    <td align="center" valign="middle" bordercolor="#0070C0" bgcolor="#376091"><span class="Estilo28">19</span></td>    <td align="center" valign="middle" bordercolor="#0070C0" bgcolor="#376091"><span class="Estilo28">20</span></td>    <td align="center" valign="middle" bordercolor="#0070C0" bgcolor="#376091"><span class="Estilo28">21</span><span class="Estilo28"></span></td>    <td align="center" valign="middle" bordercolor="#0070C0" bgcolor="#376091"><span class="Estilo28">22</span></td>    <td align="center" valign="middle" bordercolor="#0070C0" bgcolor="#376091"><span class="Estilo28">23</span></td>    <td align="center" valign="middle" bordercolor="#0070C0" bgcolor="#376091"><span class="Estilo28">24</span></td>    <td align="center" valign="middle" bordercolor="#0070C0" bgcolor="#376091"><span class="Estilo28">25</span></td>    <td align="center" valign="middle" bordercolor="#0070C0" bgcolor="#376091"><span class="Estilo28">26</span></td>    <td align="center" valign="middle" bordercolor="#0070C0" bgcolor="#376091"><span class="Estilo28">27</span></td>    <td align="center" valign="middle" bordercolor="#0070C0" bgcolor="#376091"><span class="Estilo28">28</span></td>    <td align="center" valign="middle" bordercolor="#0070C0" bgcolor="#376091"><span class="Estilo28">29</span></td>    <td width="77" align="center" valign="middle" bordercolor="#0070C0" bgcolor="#376091"><span class="Estilo28">30</span></td>    <td align="center" valign="middle" bordercolor="#0070C0" bgcolor="#376091"><span class="Estilo28">31</span></td>    <td width="139" align="center" valign="middle" bordercolor="#0070C0" bgcolor="#376091"><span class="Estilo28">32</span></td>    <td align="center" valign="middle" bordercolor="#0070C0" bgcolor="#376091"><span class="Estilo28">33</span></td>    <td align="center" valign="middle" bordercolor="#0070C0" bgcolor="#376091"><span class="Estilo28">34</span></td>    <td align="center" valign="middle" bordercolor="#0070C0" bgcolor="#376091"><span class="Estilo28">35</span></td>    <td align="center" valign="middle" bordercolor="#0070C0" bgcolor="#376091"><span class="Estilo28">36</span></td>    <td align="center" valign="middle" bordercolor="#0070C0" bgcolor="#376091"><span class="Estilo28">37</span></td>    <td align="center" valign="middle" bordercolor="#0070C0" bgcolor="#376091"><span class="Estilo28">38</span></td>    <td align="center" valign="middle" bordercolor="#0070C0" bgcolor="#376091"><span class="Estilo28">39</span></td>    <td align="center" valign="middle" bordercolor="#0070C0" bgcolor="#376091"><span class="Estilo28">40</span></td>    <td align="center" valign="middle" bordercolor="#0070C0" bgcolor="#376091"><span class="Estilo28">41</span></td>    <td align="center" valign="middle" bordercolor="#0070C0" bgcolor="#376091"><span class="Estilo28">42</span></td>    <td align="center" valign="middle" bordercolor="#0070C0" bgcolor="#376091"><span class="Estilo28">43</span></td>    <td align="center" valign="middle" bordercolor="#0070C0" bgcolor="#376091"><span class="Estilo28">44</span></td>    <td align="center" valign="middle" bordercolor="#0070C0" bgcolor="#376091"><span class="Estilo28">45</span></td>    <td align="center" valign="middle" bordercolor="#0070C0" bgcolor="#376091"><span class="Estilo28">46</span></td>    <td width="111" align="center" valign="middle" bordercolor="#0070C0" bgcolor="#376091"><span class="Estilo28">47</span></td>    <td align="center" valign="middle" bordercolor="#0070C0" bgcolor="#376091"><span class="Estilo28">48</span></td>    <td align="center" valign="middle" bordercolor="#0070C0" bgcolor="#376091"><span class="Estilo28">49</span></td>    <td align="center" valign="middle" bordercolor="#0070C0" bgcolor="#376091"><span class="Estilo28">50</span></td>    <td align="center" valign="middle" bordercolor="#0070C0" bgcolor="#376091"><span class="Estilo28">51</span></td>    <td align="center" valign="middle" bordercolor="#0070C0" bgcolor="#376091"><span class="Estilo28">52</span></td>    <td align="center" valign="middle" bordercolor="#0070C0" bgcolor="#376091"><span class="Estilo28">53</span></td>    <td align="center" valign="middle" bordercolor="#0070C0" bgcolor="#376091"><span class="Estilo28">54</span></td>    <td align="center" valign="middle" bordercolor="#0070C0" bgcolor="#376091"><span class="Estilo28">55</span></td>    <td align="center" valign="middle" bordercolor="#0070C0" bgcolor="#376091"><span class="Estilo28">56</span></td></tr>';	
					
				while ($row = $this->qRs->fetch_array(MYSQLI_BOTH))
					{
						if($numFil % 2 == 0)
							{
							$tr = '<tr class="'.$this->cssPar.'"  id="'."f".$numFil.'" name="'."f".$numFil.'"  >';
							
							}
						else
							{
								$tr = '<tr class="'.$this->cssImp.'"  id="'."f".$numFil.'" name="'."f".$numFil.'">';
							}
						
						$num = 0;	
						$xrow = "";
						 
						$td = $td. '</td>';
						
			
						for($i=0;$i<$Cols;$i++)
							{
								
								$value = $row[$i];
								
								if(empty($value)){$value="";}
								
								if($this->NumFields==0)
									{

										$td = $td. '<td>'.htmlentities(trim($value), ENT_QUOTES).'</td>';
										$xrow = $xrow .htmlentities(trim($value), ENT_QUOTES).'|';
									}
								else
									{
										
									if($num<=$this->NumFields )
										{
											$td   = $td. '<td>'.htmlentities(trim($value), ENT_QUOTES).'</td>';
											
											$xrow = $xrow .htmlentities(trim($value), ENT_QUOTES).'|';
										}
									else
										{
											$xrow = $xrow .htmlentities(trim($value), ENT_QUOTES).'|';
											
										}
									$num++;
									}
							}
						$fil = $fil.$tr.$td."</tr>";
						$tr="";
						$td="";
						$numFil++;
					}
				echo $table.$th.$fil."</table>"; 
			}
			
		function __destruct()
				{
					foreach(get_object_vars($this) as $k=>$v)
						{
	    				unset($this->$k);

						}
				}
		
		function fDesCon()
			{
				$this->qRs->free_result();
				$this->oMySQLi->close();
			}
				
	}
?>