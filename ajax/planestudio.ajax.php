<?php


require_once "../controladores/plandeestudio.controlador.php";
require_once "../modelos/plandeestudio.modelo.php";


/*=============================================
EDITAR PLAN DE ESTUDIO
=============================================*/

if(isset($_POST["idplanestudio"])){
	$editar = new Ajaxplandeestudios();
	$editar -> idplanestudio = $_POST["idplanestudio"];
	$editar -> ajaxEditarplandedestudios();
}

class Ajaxplandeestudios{
	/*=============================================
	EDITAR PLAN DE ESTUDIOS
	=============================================*/	
	public $idplanestudio;
	 public function ajaxEditarplandedestudios(){
		$item = "codpe";
		$valor = $this->idplanestudio;
		$respuesta = Controladorplandeestudio::ctrmostrarplandeestudios($item, $valor);
		echo json_encode($respuesta);
	}
}






