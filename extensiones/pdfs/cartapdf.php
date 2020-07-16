<?php

// $miRuta = dirname(__FILE__);
// require($miRuta . '\..\..\extensiones\pdfs\fpdf.php');
require_once('fpdf.php');
include("conexionmysqli.php");
if (isset($_GET['codcartac'])) {
	$codcartac = $_GET['codcartac'];
	
   }
$num = 1;
class PDF extends FPDF
{
	var $widths;
	var $aligns;
// Cabecera de página

	function SetWidths($w)
	{
		//Set the array of column widths
		$this->widths = $w;
	}

	function SetAligns($a)
	{
		//Set the array of column alignments
		$this->aligns = $a;
	}

	function Row($data)
	{
		//Calculate the height of the row
		$nb = 0;
		for ($i = 0; $i < count($data); $i++)
			$nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
		$h = 5 * $nb;
		//Issue a page break first if needed
		$this->CheckPageBreak($h);
		//Draw the cells of the row
		for ($i = 0; $i < count($data); $i++) {
			$w = $this->widths[$i];
			$a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
			//Save the current position
			$x = $this->GetX();
			$y = $this->GetY();
			//Draw the border

			$this->Rect($x, $y, $w, $h);

			$this->MultiCell($w, 5, $data[$i], 0, $a, 'true');
			//Put the position to the right of the cell
			$this->SetXY($x + $w, $y);
		}
		//Go to the next line
		$this->Ln($h);
	}

	function CheckPageBreak($h)
	{
		//If the height h would cause an overflow, add a new page immediately
		if ($this->GetY() + $h > $this->PageBreakTrigger)
			$this->AddPage($this->CurOrientation);
	}

	function NbLines($w, $txt)
	{
		//Computes the number of lines a MultiCell of width w will take
		$cw = &$this->CurrentFont['cw'];
		if ($w == 0)
			$w = $this->w - $this->rMargin - $this->x;
		$wmax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;
		$s = str_replace("\r", '', $txt);
		$nb = strlen($s);
		if ($nb > 0 and $s[$nb - 1] == "\n")
			$nb--;
		$sep = -1;
		$i = 0;
		$j = 0;
		$l = 0;
		$nl = 1;
		while ($i < $nb) {
			$c = $s[$i];
			if ($c == "\n") {
				$i++;
				$sep = -1;
				$j = $i;
				$l = 0;
				$nl++;
				continue;
			}
			if ($c == ' ')
				$sep = $i;
			$l += $cw[$c];
			if ($l > $wmax) {
				if ($sep == -1) {
					if ($i == $j)
						$i++;
				} else
					$i = $sep + 1;
				$sep = -1;
				$j = $i;
				$l = 0;
				$nl++;
			} else
				$i++;
		}
		return $nl;
	}

	function Header()
	{
		$this->Image('Captura.JPG', 20, 50, 170, 200, 'JPG');
		$this->Image('cabeza.JPG', 5, 5, 200, 32, 'JPG');
		$this->Image('pie.JPG', 5, 271, 200, 10, 'JPG');

		
		// Color del texto en gris

		
		
	}

	// Pie de página
	function Footer()
	{
		// Posición: a 1,5 cm del final
		$this->SetY(-25);
		// Arial italic 8
		// Número de página
		$dias = array("Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sábado");
        $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");

		$this->SetFont('Arial','',9);
		$this->Cell(0,0, utf8_decode('A petición del interesado, se expide la presente en la H. ciudad de LA PAZ, A los ' . " " . date('d') . " dias del mes de " . $meses[date('n') - 1] . " de " . date('Y') . "."), 0, 'J');
		
		$this->SetY(-15);
		// Arial italic 8
		$this->SetFont('Arial', 'I', 8);
		// Número de página
		$this->Cell(0, 3, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C');
	}
}


$query = "SELECT * FROM crearcarta WHERE cod_crearcarta = $codcartac";
//$query1 = "SELECT DATE_FORMAT(fechaemicion,'%d %M %Y') AS fechacartita FROM crearcarta";
$query2 = "SELECT day(fechaemicion) dia FROM crearcarta WHERE cod_crearcarta = $codcartac";
$query3 = "SELECT month(fechaemicion) mes FROM crearcarta WHERE cod_crearcarta = $codcartac";
$query4 = "SELECT year(fechaemicion) anio FROM crearcarta WHERE cod_crearcarta = $codcartac";

//$resultado = $conexion->query($query1);
$resultado1 = $conexion->query($query);

$resultado2 = $conexion->query($query2);
$resultado3 = $conexion->query($query3);
$resultado4 = $conexion->query($query4);


while ($res = $resultado1->fetch_assoc()) {
	$lugar=$res['lugar']; 
	$fechaemicion=$res["fechaemicion"];
	$dirijida=$res["dirijida"];
	$cargodir=$res["cargodir"];
	$referencia=$res["referencia"];
	$saludo=$res["saludo"];
	$asunto=$res["asunto"];
	$despedida=$res["despedida"];
	$emisor=$res["emisor"];
	$cargoemisor=$res["cargoemisor"];
	$ciemisor=$res["ciemisor"];
	$otro=$res["otro"];
}

while ($res0 = $resultado2->fetch_assoc()) {
	$dias=$res0["dia"];
}
while ($res1 = $resultado3->fetch_assoc()) {
	$mess=$res1["mes"];

		switch ($mess) {
		case '1':  $mesi='Enero'; break;
		case '2':  $mesi='Febrero'; break;
		case '3':  $mesi='Marzo'; break;
		case '4':  $mesi='Abril'; break;
		case '5':  $mesi='Mayo'; break;
		case '6':  $mesi='Junio'; break;
		case '7':  $mesi='Julio'; break;
		case '8':  $mesi='Agosto'; break;
		case '9':  $mesi='Septiembre'; break;
		case '10':  $mesi='Octubre'; break;
		case '11':  $mesi='Noviembre'; break;
		case '12':  $mesi='Diciembre'; break;
		default: $mesi='error de fechas'; break;
	}
}
while ($res2 = $resultado4->fetch_assoc()) {
	$anios=$res2["anio"];
}




$pdf = new PDF('P', 'mm', 'A4');
//Margen decorativo iniciando en 0, 0



$pdf->AddPage();


$pdf=new PDF('P','mm','A4');
	
	$pdf->AddPage();
    $pdf->SetMargins(20,20,20);
     $pdf->Ln(40);
	 $pdf->SetFont('Arial','',11);
	 $pdf->SetXY(140, 35);
	 $pdf->Cell(10,15,utf8_decode($lugar.' , '.$dias.' de '.$mesi.' de '.$anios),'C', 1);
	 
	 $pdf->SetFont('Arial','',11);
	 $pdf->SetXY(15, 45);
    $pdf->Cell(10,15,utf8_decode('Señor(@):'),'C', 1);
	$pdf->SetXY(15, 52);
	$pdf->Cell(10,15,utf8_decode($dirijida),'C', 1);
	
	$pdf->SetFont('Arial','B',10);
	$pdf->SetXY(14, 63);
	$pdf->MultiCell(80,7,utf8_decode($cargodir),'C', 1);

	$pdf->Ln(10);
	//$cargodir
	$pdf->SetFont('Arial','',11);
	$pdf->SetXY(15, 80);
	$pdf->Cell(10,15,utf8_decode('Presente : '),'C', 1);
	//$setxy son coordenadas de las pociones de cada elemento
	$pdf->SetFont('Arial','U',12);
	$pdf->SetXY(60, 90);
    $pdf->MultiCell(145,7,utf8_decode('REF.:'.$referencia),'C', 1);
    $pdf->Ln(20);

	$pdf->SetFont('Arial','',11);
	$pdf->SetXY(15, 110);
	$pdf->MultiCell(177,6, utf8_decode($saludo) ,0,'J');

	$pdf->Ln(10);
	$pdf->SetFont('Arial','',11);
	$pdf->SetXY(15, 133);
	$pdf->MultiCell(177,6, utf8_decode($asunto),0,'J');

	$pdf->Ln(10);
	$pdf->SetFont('Arial','',11);
	$pdf->SetXY(15, 180);
	$pdf->MultiCell(177,6, utf8_decode($despedida) ,0,'J');
	$pdf->Ln(15);
	

	$pdf->SetFont('Arial','',11);
	$pdf->SetXY(15, 185);
    $pdf->Cell(70, 15, 'Atentamente:','C', 'J');
	
	$pdf->SetXY(90, 220);
    $pdf->Cell(70, 5, '____________________','C', 'J');     
    
	$pdf->SetXY(100, 225);
    $pdf->Cell(70, 5, utf8_decode($emisor),'C','J');     
	
	$pdf->SetXY(100, 230);
    $pdf->Cell(70, 5, utf8_decode($cargoemisor),'C', 'J');  
	
	$pdf->SetXY(100, 235);
    $pdf->Cell(70, 5, utf8_decode($ciemisor),'C','J');  

    $y=130;
    
$pdf->Output();
?>