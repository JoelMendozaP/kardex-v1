<?php
require_once('fpdf.php');
include("conexionmysqli.php");
if (isset($_GET['idestudiantito'])) {
	$id = $_GET['idestudiantito'];
	
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

		$this->SetFont('Arial', 'B', 11);
		// Color del texto en gris
		$this->SetTextColor(80);
		$this->Text(10, 40, utf8_decode('BOLETA DE MATERIAS                                                                                           RECORD ACADEMICO'), 0, 'C', 0);
		
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
		$this->SetFont('Arial', 'I', 8);
		$this->Cell(0, 3, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C');
	}
}

$query = "SELECT * FROM toma t,materia m, estudiante e WHERE $id = t.codest and t.cod_mat = m.cod_mat and e.codest=$id";
$resultado = $conexion->query($query);
$resultado1 = $conexion->query($query);

while ($res = $resultado1->fetch_assoc()) {
	$nom=$res['nombre']; 
	$ap=$res["ap_paterno"];
	$am=$res["ap_materno"];
	$ci=$res["ci"];
	$estado=$res["estado"];
	$email=$res["email"];
	$reg=$res["reg_univ"];
}

$pdf = new PDF('P', 'mm', 'A4');
//Margen decorativo iniciando en 0, 0



$pdf->AddPage();



$pdf->SetFont('Arial', '', 11);
$pdf->Text(10, 50, utf8_decode('Estudiante : '.utf8_decode($ap).'  '.utf8_decode($am).'  '.utf8_decode($nom)));
$pdf->Text(10, 55, utf8_decode('CI : '.utf8_decode($ci)));
$pdf->Text(10, 60, utf8_decode('Registro Universitario : '.utf8_decode($reg)));
$pdf->Text(130, 50, utf8_decode('Email : '.utf8_decode($email)));
$pdf->Text(130, 55, utf8_decode('Estado : '.utf8_decode($estado)));

$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Text(80, 65, utf8_decode('"LISTA DE MATERIAS  "'), 0, 'C', 0);

// $pdf->Cell(0,0,utf8_decode('MAESTRANTE:                       '.utf8_decode($row['nombre']. utf8_decode('        CON  APELLIDO  :').utf8_decode($row['ap_paterno']))));
$pdf->Ln(55);
$pdf->SetFont('Arial', '', 11);
$co = 1;
$apr = 0;
$rep = 0;
$aba = 0;
$estado = 'Aprobado';
$estado1 = 'Reprobado';
$total = 0;
$total2= 0;

$nro = 0;
$saldo = '';
$literal = '';

$pdf->Cell(10, 10, 'Nro', 1, 0, 'C', 0);
$pdf->Cell(17, 10, 'Sigla', 1, 0, 'C', 0);
$pdf->Cell(45, 10, 'Materia', 1, 0, 'C', 0);
$pdf->Cell(13, 10, 'Nota', 1, 0, 'C', 0);
$pdf->Cell(25, 10, 'Observacion', 1, 0, 'C', 0);
$pdf->Cell(33, 10, 'Periodo', 1, 0, 'C', 0);
$pdf->Cell(17, 10, 'Gestion', 1, 0, 'C', 0);
$pdf->Cell(30, 10, 'Docente', 1, 1, 'C', 0);
$pdf->SetFont('Arial', '', 9);

while ($row = $resultado->fetch_assoc()) {
	$pdf->Cell(10, 10, $co, 1, 0, 'C', 0);
	$co++;
	$pdf->Cell(17, 10, $row['sigla'], 1, 0, 'C', 0);
	$pdf->Cell(45, 10, $row['nombre_m'], 1, 0, 'C', 0);
	$pdf->Cell(13, 10, $row['notafinal'], 1, 0, 'C', 0);
	$nro = $row['notafinal'];
	if ($row['notafinal'] >= '50') {
		$saldo = $estado;
		$apr++;
		$total2=$total2+$nro;
	} else {
		$saldo = $estado1;
		$rep++;
	}
    $total=$total+$nro;
	$pdf->Cell(25, 10, $saldo, 1, 0, 'C', 0);
	$pdf->Cell(33, 10, $row['fecha_curso'], 1, 0, 'C', 0);
	$pdf->Cell(17, 10, $row['gestion'], 1, 0, 'C', 0);
	$pdf->Cell(30, 10, $row['docente'], 1, 1, 'C', 0);
}
$pdf->SetFont('Arial', 'B', 11);
$pdf->Ln(4);
$pdf->Cell(200, 10, utf8_decode('Aprobados : ') . utf8_decode($apr), 0, 0, 'C');
$pdf->Ln(5);
$pdf->Cell(200, 10, utf8_decode('Reprobados : ') . utf8_decode($rep), 0, 0, 'C');
$pdf->Ln(5);
$pdf->Cell(200, 10, utf8_decode('Abandono: ') . utf8_decode($aba), 0, 0, 'C');
$pdf->Ln(5);
$pdf->Cell(200, 10, utf8_decode('Promedio General: ') . utf8_decode($total/($co-1)), 0, 0, 'C');
$pdf->Ln(5);
$pdf->Cell(200, 10, utf8_decode('Promedio Oficial: ') . utf8_decode($total2/($apr)), 0, 0, 'C');

$pdf->Output();

?>