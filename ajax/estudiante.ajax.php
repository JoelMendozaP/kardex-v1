<?php


require_once "../controladores/estudiantes.controlador.php";
require_once "../modelos/estudiantes.modelo.php";


/*=============================================
EDITAR ESTUDIANTE
=============================================*/

if(isset($_POST["idestudiante"])){
	$editar = new Ajaxestudiante();
	$editar -> idestudiante = $_POST["idestudiante"];
	$editar -> ajaxEditarestudiante();
}

if(isset($_POST["idestudiantes"])){
    
	$Agregar = new Ajaxestudiante();
	$Agregar -> idestudiantes = $_POST["idestudiantes"];
	$Agregar -> ajaxAgregarestudiante();
}

if(isset($_POST["iddocumentos"])){
    
	$editardoc = new Ajaxestudiante();
	$editardoc -> iddocumentos = $_POST["iddocumentos"];
	$editardoc -> ajaxEditardocumentogaleria();
}

class Ajaxestudiante{
	
	public $idestudiante;
	public $idestudiantes;
	public $iddocumentos;


	 public function ajaxEditarestudiante(){
        
		$item = "codest";
		$valor = $this->idestudiante;

		$respuesta = ControladorEstudiantes::ctrMostrarestudiante($item, $valor);
                        
		echo json_encode($respuesta);

	}


	public function ajaxAgregarestudiante(){
        
		$item = "codest";
		$valor = $this->idestudiantes;

		$respuesta = ControladorEstudiantes::ctrMostrarestudiante($item, $valor);
                        
		echo json_encode($respuesta);

	}

/*=============================================
	EDITAR DOCUMENTO GALERIA
	=============================================*/	
	public function ajaxEditardocumentogaleria(){
        
		$codigo = "codoc";
		$valor = $this->iddocumentos;

		$respuesta = ControladorEstudiantes::ctrMostrargaleriaajax($valor,$codigo);
		echo json_encode($respuesta);

	}

	/*=============================================
	VALIDAR NO REPETIR ESTUDIANTE POR CI
	=============================================*/	
	public $ValidarCi;
	 public function ajaxValidarEstudiante(){
		$item = "ci";
		$valor = $this->ValidarCi;
		$respuesta = ControladorEstudiantes::ctrMostrarestudiante($item, $valor);
		echo json_encode($respuesta);
	}
}

/*=============================================
	VALIDAR NO REPETIR ESTUDIANTE
	=============================================*/	
if(isset($_POST["ValidarCi"])){
	$Agregar = new Ajaxestudiante();
	$Agregar -> ValidarCi= $_POST["ValidarCi"];
	$Agregar -> ajaxValidarEstudiante();
}




