
<?php


// $miRuta = dirname(__FILE__);
// require($miRuta . '\..\..\extensiones\pdfs\fpdf.php');

require_once('fpdf.php');


if (isset($_GET['si'])) {
	$si = $_GET['si'];
	
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

		$this->SetFont('Arial', 'B', 13);
		// Color del texto en gris
		$this->SetTextColor(80);
		$this->Text(10, 40, utf8_decode('LISTA DE MATERIAS                                                                    CONTADURIA PUBLICA'), 0, 'C', 0);
		$this->Text(15, 45, utf8_decode('                                                                                                                 UMSA'), 0, 'C', 0);
        $this->SetFont('Arial', 'B', 14);
        $this->Text(65, 50, utf8_decode('"LISTA DE MATERIAS POR AÑO"'), 0, 'C', 0);
	}

	// Pie de página
	function Footer()
	{
		
		$this->SetY(-25);
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
include("conexionmysqli.php");

$query = "SELECT sigla, nombre_m ,docente,gestion FROM materia";
$resultado = $conexion->query($query);
$resultado1 = $conexion->query($query);

$pdf = new PDF('P', 'mm', 'A4');
//Margen decorativo iniciando en 0, 0
$pdf->AddPage();

$pdf->Ln(5);



// $pdf->Cell(0,0,utf8_decode('MAESTRANTE:                       '.utf8_decode($row['nombre']. utf8_decode('        CON  APELLIDO  :').utf8_decode($row['ap_paterno']))));
$pdf->Ln(37);
$pdf->SetFont('Arial', 'B', 12);

$pdf->Cell(10, 10, 'NRO', 1, 0, 'C', 0);
$pdf->Cell(25, 10, 'SIGLA', 1, 0, 'C', 0);
$pdf->Cell(70, 10, 'MATERIA', 1, 0, 'C', 0);
$pdf->Cell(70, 10, 'DOCENTE', 1, 0, 'C', 0);
$pdf->Cell(20, 10, 'GESTION', 1, 1, 'C', 0);
$pdf->SetFont('Arial', '', 14);

 $co=0;
while ($row = $resultado->fetch_assoc()) {
	$pdf->Cell(10, 10, $co, 1, 0, 'C', 0);
	$co++;
	$pdf->Cell(25, 10, $row['sigla'], 1, 0, 'C', 0);
	$pdf->Cell(70, 10, $row['nombre_m'], 1, 0, 'C', 0);
    $pdf->Cell(70, 10, $row['docente'], 1, 0, 'C', 0);
	$pdf->Cell(20, 10, $row['gestion'], 1, 1, 'C', 0);
}


$pdf->Output();
?>