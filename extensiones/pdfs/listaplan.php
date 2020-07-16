<?php

require_once('fpdf.php');
include("conexionmysqli.php");

if (isset($_GET['codigoplans'])) {
	$codigoplans = $_GET['codigoplans'];
	
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
	function fill($f)
	{
	//juego de arreglos de relleno
	$this->fill=$f;
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

		$this->SetFont('Arial', 'B', 13);
		// Color del texto en gris
		
		
		$this->Text(10, 40, utf8_decode('                                                                                         CONTADURIA PUBLICA-UMSA'), 0, 'C', 0);
        $this->SetFont('Arial', 'B', 14);
	}

	// Pie de página
	function Footer()
	{
		$this->SetY(-25);
		// Arial italic 8
		// Número de página
		$dias = array("Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sábado");
        $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");

		$this->SetFont('Arial','',9);
		$this->Cell(0,0, utf8_decode('A petición del interesado, se expide la presente en la H. ciudad de LA PAZ, A los ' . " " . date('d') . " dias del mes de " . $meses[date('n') - 1] . " de " . date('Y') . "."), 0, 'J');
		
		// Posición: a 1,5 cm del final
		$this->SetY(-15);
		// Arial italic 8
		$this->SetFont('Arial', 'I', 8);
		// Número de página
		$this->Cell(0, 3, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C');
	}
}
include("conexionmysqli.php");

$codigoplans = $_GET['codigoplans'];

$query = "SELECT * FROM plandeestudio  WHERE codpe = $codigoplans ";
$resultado = $conexion->query($query);
while ($row = $resultado->fetch_assoc()) {
  $fechai = $row['fech_ini'];
  $fechaf = $row['fech_fin'];
  $nombrepl = $row["nombrepl"];
  $men = $row["mencion"];
  $fechaorigen = $row["fechacrea"];
}

        $query1 = "SELECT * FROM pertenece p, materia m 
        WHERE $codigoplans=p.codpe and m.cod_mat = p.cod_mat
        ORDER by p.aagregadoen";
        $resultado1 = $conexion->query($query1);

$pdf = new PDF('P', 'mm', 'A4');
//Margen decorativo iniciando en 0, 0
$pdf->AddPage();

$pdf->Ln(35);

$pdf->SetFont('Arial','U',12);
$pdf->MultiCell(145,7,utf8_decode('PLAN DE ESTUDIO'),'C', 1);
$pdf->SetFont('Arial', 'B', 9);
$pdf->cell(95,8,utf8_decode('NOMBRE : '.utf8_decode($nombrepl)), 1, 0, 'J', 0);
$pdf->cell(95,8,utf8_decode('FECHA DE CREACION: '.utf8_decode($fechaorigen)), 1, 1, 'J', 0);
$pdf->cell(95,8,utf8_decode('FECHA I : '.utf8_decode($fechai)), 1, 0, 'J', 0);
$pdf->cell(95,8,utf8_decode('FECHA F : '.utf8_decode($fechaf)), 1, 1, 'J', 0);
$pdf->cell(190,8,utf8_decode('MENCION: '.utf8_decode($men)), 1, 0, 'J', 0);


$pdf->Ln(10);


$pdf->SetFont('Arial','U',12);
$pdf->SetXY(80, 80);
$pdf->MultiCell(145,7,utf8_decode('LISTA DE MATERIAS DEL PLAN'),'C', 1);
$pdf->Ln(5);


$pdf->SetFont('Arial', 'B', 8);

$pdf->SetFillColor(100,100,250);//Fondo verde de celda

$pdf->Cell(10, 9, 'NRO', 1, 0, 'C', 1);
$pdf->Cell(55, 9, 'SIGLA', 1, 0, 'C', 1);
$pdf->Cell(50, 9, 'NOMBRE ', 1, 0, 'C', 1);
$pdf->Cell(20, 9, 'GESTION', 1, 0, 'C', 1);
$pdf->Cell(55, 9, 'TIPO', 1, 1, 'C', 1);
$pdf->SetFont('Arial', '', 10);

 $co=1;
while ($row = $resultado1->fetch_assoc()) {

	$pdf->Cell(10, 8, $co, 1, 0, 'C', 0);$co++;
    $pdf->Cell(55, 8, $row['sigla'], 1, 0, 'C', 0);
	$pdf->Cell(50, 8, $row['nombre_m'], 1, 0, 'C', 0);
	$pdf->Cell(20, 8, $row['gestion'], 1, 0, 'C', 0);
	$pdf->Cell(55, 8, $row['tipo'], 1, 1, 'C', 0);
}

$pdf->Output();
?>