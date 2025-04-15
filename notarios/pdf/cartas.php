<?php

	//include("../extraprotocolares/view/conexion.php");
	include("conexion.php");
	include("../extraprotocolares/view/funciones.php");
	require('../librerias/fpdf/fpdf.php');

	$fechade = $_REQUEST['fechade'];
	$fechaa  = $_REQUEST['fechaa'];

	header('Content-Type: text/html; charset=iso-8859-1');

	$conexion = conection();

	$consulta_cartas = "SELECT
						ingreso_cartas.num_carta AS num_carta,
						DATE_FORMAT(STR_TO_DATE(fec_ingreso,'%d/%m/%Y'),'%d/%m/%Y') AS fec_ingreso,
						ingreso_cartas.fec_entrega AS fec_entrega,
						ingreso_cartas.nom_remitente AS remitente,
						ingreso_cartas.nom_destinatario AS destinatario,
						ingreso_cartas.zona_destinatario AS cod_zona,
						ubigeo.nomdis as zona
						FROM
						ingreso_cartas
						INNER JOIN ubigeo ON ubigeo.coddis = ingreso_cartas.zona_destinatario
						WHERE STR_TO_DATE(fec_ingreso,'%d/%m/%Y') BETWEEN STR_TO_DATE('$fechade','%d/%m/%Y') AND STR_TO_DATE('$fechaa','%d/%m/%Y')
						ORDER BY ingreso_cartas.fec_ingreso asc, ingreso_cartas.num_carta asc";

  
   $datos_cartas = mysql_query($consulta_cartas, $conexion);	
   
   $i=0;

    while($dato_cartas = mysql_fetch_array($datos_cartas)){
	      $array_cartas[$i] =  $dato_cartas;
	      $i++;
	}

	$total_reg = count($array_cartas);

	$num_reg = 57;

	$num_pag = ceil($total_reg/$num_reg);
	
	$contador = 1;

	for($j=0; $j<$total_reg; $j++){

		// la variable $j de array contador tiene el valor incrementado en esta expresion
		${'array'.$contador}[$j] = $array_cartas[$j] ;

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
	
	/*
	function Header()
	{
		//Logo
	    //$this->Image("leon.jpg" , 10 ,8, 35 , 38 , "JPG" ,"http://www.mipagina.com");
		//Arial bold 15
		$this->SetFont('Times','b',11);
		//Movernos a la derecha
		$this->Ln(11);
		$this->Cell(62);
		
		//Título
		$this->Cell(140,10, 'INDICE CRONOLOGICO DE CARTAS' ,0,0,'C');
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
        $this->Cell(145,10, 'INDICE CRONOLOGICO DE CARTAS' ,0,0,'C');
		$this->Ln(15);
		
		$this->SetFont('Arial','',10);
		$this->SetXY(80,30);	
		
		if($num<>1){
			$this->SetFont('Arial','',10);
        	$this->SetXY(85,21); 
		}
		
		$this->Cell(130,8,'Listado entre las fechas entre el '. $fechade .' y el '. $fechaa,0,0,'C');

		//Posicion de la tabla
		//SetMargins(float left, float top [, float right])

		$this->SetXY(5, 40);
		$this->SetMargins(5,0,0);
		
		if($num<>1){
			$this->SetXY(5, 33);
        	$this->SetMargins(5,0,0);
		}
		
		// Colores, ancho de línea y fuente en negrita
		$this->SetFillColor(0,0,0);
		$this->SetTextColor(255);
		$this->SetDrawColor(102,155,242);
		$this->SetLineWidth(.3);
		$this->SetFont('Times','B',7);
		
		// Cabecera
		$w = array(25, 20, 20, 40, 80, 104);
		
		for($i=0;$i<count($header);$i++)
			$this->Cell($w[$i],7,$header[$i],1,0,'C',true);
			$this->Ln();
			
			// Restauración de colores y fuentes
	
			$this->SetFillColor(224,235,255);
			$this->SetTextColor(0);
			$this->SetFont('');
		
		// Datos
		
		$fill = false;
		
		$n=1;

		foreach($data as $row)
		{
			$this->Cell($w[0],6,formato_crono_agui($row["num_carta"]),'LR',0,'C',$fill);
			$this->Cell($w[1],6,$row["fec_ingreso"],'LR',0,'C',$fill);
			$this->Cell($w[2],6,$row["fec_entrega"],'LR',0,'C',$fill);
			$this->CellFitSpace($w[3],6,utf8_decode($row["zona"]),'LR',0,'C',$fill);
			$this->CellFitSpace($w[4],6,utf8_decode(substr(simbolos(strtoupper($row["remitente"])),0,60)),'LR',0,'C',$fill);
			$this->CellFitSpace($w[5],6,utf8_decode(substr(simbolos(strtoupper($row["destinatario"])),0,77)),'LR',0,'C',$fill);
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
	$header = array('NUMERO', 'FEC INGR', 'FEC DILIG', 'ZONA', 'REMITENTE', 'DESTINATARIO');
	
	/*$pdf->Cell(500,10,'Title',1,0,'C');
	
	$pdf->Ln(20);
	
	$pdf->SetFont('Arial','',14);*/
		
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