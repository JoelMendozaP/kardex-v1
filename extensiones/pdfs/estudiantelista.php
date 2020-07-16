<?php

require_once('fpdf.php');
include("conexionmysqli.php");
if (isset($_GET['codmateria'])) {
	$codmateria = $_GET['codmateria'];
	
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

$query = "SELECT * FROM estudiante e,toma t, materia m WHERE $codmateria= m.cod_mat and e.codest = t.codest and t.cod_mat=$codmateria";
$resultado = $conexion->query($query);
$resultado1 = $conexion->query($query);
while ($row = $resultado1->fetch_assoc()) {
    $sig = $row['sigla'];
    $nom = $row['nombre_m'];
    $fol = $row["folio"];
    $li = $row["libro"];
    $ges = $row["gestion"];
    $tip = $row["tipo"];
    $esta = $row["fecha_curso"];
    $doc = $row["docente"];
}

$pdf = new PDF('P', 'mm', 'A4');
//Margen decorativo iniciando en 0, 0
$pdf->AddPage();

$pdf->Ln(35);


// $pdf->cell(20,60,utf8_decode('SIGLA :'.utf8_decode($sig)).'                                                                  '.utf8_decode('MATERIA :').utf8_decode($nom), 0, 'C', 0);
// $pdf->cell(20,70,utf8_decode('DOCENTE: '.$doc).'              '.utf8_decode('              GESTION :'.$ges).utf8_decode('                           ETAPA : '.$esta), 0, 'C', 0);

$pdf->SetFont('Arial','U',12);
$pdf->MultiCell(145,7,utf8_decode('DATOS DE LA MATERIA'),'C', 1);
$pdf->SetFont('Arial', '', 13);
$pdf->cell(70,10,utf8_decode('SIGLA :'.utf8_decode($sig)), 1, 0, 'J', 0);
$pdf->cell(115,10,utf8_decode('MATERIA :'.utf8_decode($nom)), 1, 1, 'J', 0);
$pdf->cell(85,10,utf8_decode('DOCENTE :'.utf8_decode($doc)), 1, 0, 'J', 0);
$pdf->cell(40,10,utf8_decode('GESTION :'.utf8_decode($ges)), 1, 0, 'J', 0);
$pdf->cell(60,10,utf8_decode('ETAPA :'.utf8_decode($esta)), 1, 1, 'J', 0);

$pdf->Ln(10);


$pdf->SetFont('Arial','U',12);
$pdf->SetXY(80, 80);
$pdf->MultiCell(145,7,utf8_decode('LISTA DE ESTUDIANTES'),'C', 1);
$pdf->Ln(5);

$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(10, 10, 'NRO', 1, 0, 'C', 0);
$pdf->Cell(25, 10, 'CI', 1, 0, 'C', 0);
$pdf->Cell(25, 10, 'NOMBRE', 1, 0, 'C', 0);
$pdf->Cell(22, 10, 'AP_PATERNO', 1, 0, 'C', 0);
$pdf->Cell(22, 10, 'AP_MATERNO', 1, 0, 'C', 0);
$pdf->Cell(20, 10, 'GENERO', 1, 0, 'C', 0);
$pdf->Cell(19, 10, 'MATRICULA', 1, 0, 'C', 0);
$pdf->cell(20, 10, 'NOTA_FINAL', 1, 0, 'C', 0);
$pdf->Cell(22, 10, 'OBSERVACION', 1, 1, 'C', 0);
$pdf->SetFont('Arial', '', 10);
 $co=1;

while ($row = $resultado->fetch_assoc()) {
	$pdf->Cell(10, 10, $co, 1, 0, 'C', 0);$co++;
    $pdf->Cell(25, 10, $row['ci'], 1, 0, 'C', 0);
	$pdf->Cell(25, 10, $row['nombre'], 1, 0, 'C', 0);
	$pdf->Cell(22, 10, $row['ap_paterno'], 1, 0, 'C', 0);
	$pdf->Cell(22, 10, $row['ap_materno'], 1, 0, 'C', 0);
    $pdf->Cell(20, 10, $row['genero'], 1, 0, 'C', 0);
    $pdf->Cell(19, 10, $row['reg_univ'], 1, 0, 'C', 0);
	$pdf->Cell(20, 10, $row['notafinal'], 1, 0, 'C', 0);
	$pdf->Cell(22, 10, $row['observacion'], 1, 1, 'C', 0);
}



$pdf->Output();
?>