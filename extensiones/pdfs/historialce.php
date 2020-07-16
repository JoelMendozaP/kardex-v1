<?php

require_once('fpdf.php');
include("conexionmysqli.php");

if (isset($_GET['codcartahistorialexterna'])) {
	$codcartahistorialexterna = $_GET['codcartahistorialexterna'];
	
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

$codcartahistorialexterna = $_GET['codcartahistorialexterna'];




$query = "SELECT * FROM carta c,recibe r , usuarios u  WHERE c.cod_carta =$codcartahistorialexterna and r.cod_carta = $codcartahistorialexterna and r.dnia= u.dni";
        $resultado = $conexion->query($query);
        while ($row = $resultado->fetch_assoc()) {
          $remitente = $row['remitente'];
          $entidad = $row['entidad'];
          $ruta = $row["ruta"];
          $recib = $row["fecharecib"];
          $ref = $row["referencia"];
          $ci = $row["dnia"];
          $proce = $row["estadoproceso"];
          $pri = $row["prioridad"];
          $nm = $row['nombre'];
            $app = $row['ap_paterno'];
            $apm = $row["ap_materno"];
        }

        $query1 = "SELECT a.fech_proc,u.nombre, u.ap_paterno, u.ap_materno,a.estado,a.rutahistorial,a.observacion FROM administrado a, usuarios u 
        WHERE a.cod_carta = $codcartahistorialexterna and a.codhistorialusu=u.cod_user ORDER by a.fech_proc";
        $resultado1 = $conexion->query($query1);
$pdf = new PDF('P', 'mm', 'A4');
//Margen decorativo iniciando en 0, 0
$pdf->AddPage();

$pdf->Ln(35);

$pdf->SetFont('Arial','U',12);
$pdf->MultiCell(145,7,utf8_decode('HISTORIAL DE LA CARTA EXTERNA'),'C', 1);
$pdf->SetFont('Arial', 'B', 9);
$pdf->cell(95,8,utf8_decode('ENTIDAD: '.utf8_decode($entidad)), 1, 0, 'J', 0);
$pdf->cell(95,8,utf8_decode('REMITENTE: '.utf8_decode($remitente)), 1, 1, 'J', 0);
$pdf->cell(140,8,utf8_decode('REFERENCIA: '.utf8_decode($ref)), 1, 0, 'J', 0);
$pdf->cell(50,8,utf8_decode('ESTADO: '.utf8_decode($proce)), 1, 1, 'J', 0);
$pdf->cell(120,8,utf8_decode('ULTIMO RECEPTOR: '.utf8_decode($nm.' '.$app.' '.$apm)), 1, 0, 'J', 0);


$pdf->Ln(10);


$pdf->SetFont('Arial','U',12);
$pdf->SetXY(80, 80);
$pdf->MultiCell(145,7,utf8_decode('LISTA DE ACCIONES DE CARTA'),'C', 1);
$pdf->Ln(5);


$pdf->SetFont('Arial', 'B', 8);

$pdf->SetFillColor(100,100,250);//Fondo verde de celda

$pdf->Cell(10, 10, 'NRO', 1, 0, 'C', 1);
$pdf->Cell(55, 10, 'FECHA DE PROCESO', 1, 0, 'C', 1);
$pdf->Cell(50, 10, 'NOMBRE COMPLETO', 1, 0, 'C', 1);
$pdf->Cell(20, 10, 'ESTADO', 1, 0, 'C', 1);
$pdf->Cell(55, 10, 'RUTA HISTORIAL', 1, 1, 'C', 1);
$pdf->SetFont('Arial', '', 10);

 $co=1;
while ($row = $resultado1->fetch_assoc()) {

	$pdf->Cell(10, 10, $co, 1, 0, 'C', 0);$co++;
    $pdf->Cell(55, 10, $row['fech_proc'], 1, 0, 'C', 0);
	$pdf->Cell(50, 10, $row['nombre'] . ' - ' . $row['ap_paterno'] . ' - ' . $row['ap_materno'], 1, 0, 'C', 0);
	$pdf->Cell(20, 10, $row['estado'], 1, 0, 'C', 0);
	$pdf->Cell(55, 10, $row['rutahistorial'], 1, 1, 'C', 0);
}

$pdf->Output();
?>