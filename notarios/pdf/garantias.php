<?php

	//include("../extraprotocolares/view/conexion.php");
	include("conexion.php");
	include("../extraprotocolares/view/funciones.php");
	require('../librerias/fpdf/fpdf.php');

	$fechade = $_REQUEST['fechade'];
	$fechaa  = $_REQUEST['fechaa'];
	
	$desde = fechan_abd($fechade);
	$hasta = fechan_abd($fechaa); 

	header('Content-Type: text/html; charset=iso-8859-1');

	$conexion = conection();

	$consulta_garantias = "SELECT 
						   kardex.fechaescritura as fec_escritura, 
						   kardex.kardex as kardex, 
						   concat(cliente2.prinom,' ',cliente2.segnom,' ',cliente2.apepat,' ',cliente2.apemat) as cliente, 
						   cliente2.razonsocial as empresa, 
						   kardex.contrato as contrato, 
						   kardex.numescritura as escritura, 
						   kardex.numminuta as minuta, 
						   kardex.folioini as folio 
						   FROM kardex INNER JOIN contratantes ON contratantes.kardex = kardex.kardex 
						   INNER JOIN cliente2 ON cliente2.idcontratante = contratantes.idcontratante WHERE kardex.idtipkar='4'
						   AND STR_TO_DATE(kardex.fechaescritura,'%Y-%m-%d') >= STR_TO_DATE('$desde','%Y-%m-%d') 
						   AND STR_TO_DATE(kardex.fechaescritura,'%Y-%m-%d') <= STR_TO_DATE('$hasta','%Y-%m-%d')
						   ORDER BY kardex.idkardex DESC";

  
   $datos_garantias = mysql_query($consulta_garantias, $conexion);	
   
   $i=0;

    while($dato_garantias = mysql_fetch_array($datos_garantias)){
	      $array_garantias[$i] =  $dato_garantias;
	      $i++;
	}

	$total_reg = count($array_garantias);

	$num_reg = 55;

	$num_pag = ceil($total_reg/$num_reg);
	
	$contador = 1;

	for($j=0; $j<$total_reg; $j++){

		// la variable $j de array contador tiene el valor incrementado en esta expresion
		${'array'.$contador}[$j] = $array_garantias[$j] ;

		if(($j+1)%$num_reg==0 and $j<>0){
			$contador++;
		}

	}
	
	class PDF extends FPDF
	{
	// Cargar los datos
	function LoadData($file)
	{
		// Leer las líneas del fichero
		$lines = file($file);
		$data = array();
		foreach($lines as $line)
			$data[] = explode(';',trim($line));
		return $data;
	}
	
	// Tabla simple
	function BasicTable($header, $data)
	{
		// Cabecera
		foreach($header as $col)
			$this->Cell(40,7,$col,1);
		$this->Ln();
		// Datos
		foreach($data as $row)
		{
			foreach($row as $col)
			$this->Cell(40,6,$col,1);
			$this->Ln();
		}
	}
	
	// Una tabla más completa
	function ImprovedTable($header, $data)
	{
		// Anchuras de las columnas
		$w = array(40, 35, 45, 40);
		// Cabeceras
		for($i=0;$i<count($header);$i++)
			$this->Cell($w[$i],7,$header[$i],1,0,'C');
		$this->Ln();
		// Datos
		foreach($data as $row)
		{
			$this->Cell($w[0],6,$row[0],'LR');
			$this->Cell($w[1],6,$row[1],'LR');
			$this->Cell($w[2],6,$row[2],'LR');
			$this->Cell($w[3],6,$row[3],'LR');
			$this->Cell($w[4],6,$row[4],'LR');
			$this->Cell($w[5],6,$row[5],'LR');
			$this->Cell($w[6],6,$row[6],'LR');
			$this->Ln();
		}
		// Línea de cierre
		$this->Cell(array_sum($w),0,'','T');
	}
	
	// Tabla coloreada
	
	/*function Header()
	{
		//Logo
	    //$this->Image("leon.jpg" , 10 ,8, 35 , 38 , "JPG" ,"http://www.mipagina.com");
		//Arial bold 15
		$this->SetFont('Times','b',11);
		//Movernos a la derecha
		$this->Ln(11);
		$this->Cell(62);
		
		//Título
		$this->Cell(140,10, 'INDICE CRONOLOGICO DE GARANTIAS MOVILIARIAS' ,0,0,'C');
		//Salto de línea
		$this->Ln(15);
		  
	}*/
	
	function Footer($num_pag)
	{
		//Footer de la pagina
		$this->SetY(-15);
		$this->SetFont('Arial','I',8);
		$this->SetTextColor(128);
		$this->Cell(0,10,'Pagina '.$this->PageNo().' '.$num_pag,0,0,'C');
	}
	
	function cabeceraHorizontal($cabecera)
    {
        $this->SetXY(10, 10);
        $this->SetFont('Arial','B',10);
        $this->SetFillColor(2,157,116);//Fondo verde de celda
        $this->SetTextColor(240, 255, 240); //Letra color blanco
        foreach($cabecera as $fila)
        {
 
            $this->CellFitSpace(30,7, utf8_decode($fila),1, 0 , 'L', true);
 
        }
    }
 
    function datosHorizontal($datos)
    {
        $this->SetXY(10,17);
        $this->SetFont('Arial','',10);
        $this->SetFillColor(229, 229, 229); //Gris tenue de cada fila
        $this->SetTextColor(3, 3, 3); //Color del texto: Negro
        $bandera = false; //Para alternar el relleno
        foreach($datos as $fila)
        {
            //Usaremos CellFitSpace en lugar de Cell
            $this->CellFitSpace(30,7, utf8_decode($fila['nombre']),1, 0 , 'L', $bandera );
            $this->CellFitSpace(30,7, utf8_decode($fila['apellido']),1, 0 , 'L', $bandera );
            $this->CellFitSpace(30,7, utf8_decode($fila['matricula']),1, 0 , 'L', $bandera );
            $this->Ln();//Salto de línea para generar otra fila
            $bandera = !$bandera;//Alterna el valor de la bandera
        }
    }
 
    function tablaHorizontal($cabeceraHorizontal, $datosHorizontal)
    {
        $this->cabeceraHorizontal($cabeceraHorizontal);
        $this->datosHorizontal($datosHorizontal);
    }
 
    //***** Aquí comienza código para ajustar texto *************
    //***********************************************************
    function CellFit($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='', $scale=false, $force=true)
    {
        //Get string width
        $str_width=$this->GetStringWidth($txt);
 
        //Calculate ratio to fit cell
        if($w==0)
            $w = $this->w-$this->rMargin-$this->x;
        $ratio = ($w-$this->cMargin*2)/$str_width;
 
        $fit = ($ratio < 1 || ($ratio > 1 && $force));
        if ($fit)
        {
            if ($scale)
            {
                //Calculate horizontal scaling
                $horiz_scale=$ratio*100.0;
                //Set horizontal scaling
                $this->_out(sprintf('BT %.2F Tz ET',$horiz_scale));
            }
            else
            {
                //Calculate character spacing in points
                $char_space=($w-$this->cMargin*2-$str_width)/max($this->MBGetStringLength($txt)-1,1)*$this->k;
                //Set character spacing
                $this->_out(sprintf('BT %.2F Tc ET',$char_space));
            }
            //Override user alignment (since text will fill up cell)
            $align='';
        }
 
        //Pass on to Cell method
        $this->Cell($w,$h,$txt,$border,$ln,$align,$fill,$link);
 
        //Reset character spacing/horizontal scaling
        if ($fit)
            $this->_out('BT '.($scale ? '100 Tz' : '0 Tc').' ET');
    }
 
    function CellFitSpace($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='')
    {
        $this->CellFit($w,$h,$txt,$border,$ln,$align,$fill,$link,false,false);
    }
 
    //Patch to also work with CJK double-byte text
    function MBGetStringLength($s)
    {
        if($this->CurrentFont['type']=='Type0')
        {
            $len = 0;
            $nbbytes = strlen($s);
            for ($i = 0; $i < $nbbytes; $i++)
            {
                if (ord($s[$i])<128)
                    $len++;
                else
                {
                    $len++;
                    $i++;
                }
            }
            return $len;
        }
        else
            return strlen($s);
    }   
	
	function FancyTable($header, $data, $fechaa, $fechade, $num)
	{
		
		$this->SetFont('Times','b',11);
        $this->Ln(11);
        $this->Cell(62);
        //Título
        $this->Cell(145,10, 'INDICE CRONOLOGICO DE GARANTIAS MOVILIARIAS' ,0,0,'C');
		$this->Ln(15);
		
		$this->SetFont('Arial','',10);
		$this->SetXY(80,30);	
		
		if($num<>1){
			$this->SetFont('Arial','',10);
        	$this->SetXY(85,21); 
		}
		
		$this->Cell(130,8,'Listado entre las fechas entre el '. $fechade .' y el '. $fechaa,0,0,'C');

		$this->SetXY(17, 40);
		$this->SetMargins(17,0,0);

		// Colores, ancho de línea y fuente en negrita
		$this->SetFillColor(0,0,0);
		$this->SetTextColor(255);
		$this->SetDrawColor(102,155,242);
		$this->SetLineWidth(.3);
		$this->SetFont('Arial','B',8);
		
		// Cabecera
		$w = array(20, 20, 90, 85, 20, 20);
		
		for($i=0;$i<count($header);$i++)
			$this->Cell($w[$i],7,$header[$i],1,0,'C',true);
			$this->Ln();
			
			// Restauración de colores y fuentes
	
			$this->SetFillColor(224,235,255);
			$this->SetTextColor(0);
			$this->SetFont('');
		
		$fill = false;
		
		$n=1;

		foreach($data as $row)
		{
			$this->Cell($w[0],6,fechabd_an($row["fec_escritura"]),'LR',0,'C',$fill);
			$this->Cell($w[1],6,$row["kardex"],'LR',0,'C',$fill);
			$this->Cell($w[2],6,substr(utf8_decode($row["cliente"].' '.$row["empresa"]),0,51),'LR',0,'C',$fill);
			$this->Cell($w[3],6,substr(utf8_decode($row["contrato"]),0,55),'LR',0,'C',$fill);
			$this->Cell($w[4],6,$row["escritura"],'LR',0,'C',$fill);
			$this->Cell($w[5],6,$row["folio"],'LR',0,'c',$fill);
			$this->Ln();
			$fill = !$fill;
			$n++;
		}
		
		// Línea de cierre
		$this->Cell(array_sum($w),0,'','T');
	}
	}

	$pdf = new PDF();
	// Títulos de las columnas
	$header = array('Fecha Escr.', 'Kardex', 'Contratantes', 'Acto', utf8_decode('Nº Escritura'), utf8_decode('Nº Folio'));
		
	$j=0;
	
	if($total_reg>0){
		for($j=1; $j<=$num_pag; $j++) {
			$pdf->AddPage(P, A3);
			$pdf->FancyTable($header,${'array'.$j}, $fechaa, $fechade, $j);
		}
	}else{
		$pdf->AddPage(P, A3);
		$pdf->FancyTable($header,${'array'.$j}, $fechaa, $fechade, 1);
	}
	
	$pdf->Output();



?>