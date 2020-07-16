<?php


require_once "../controladores/materia.controlador.php";
require_once "../modelos/materia.modelo.php";


/*=============================================
EDITAR MATERIA
=============================================*/

if(isset($_POST["idmateria"])){

	$editar = new Ajaxmateria();
	$editar -> idmateria = $_POST["idmateria"];
	$editar -> ajaxEditarmateria();

}



/*=============================================
AUTOCOMPLETAR FORMULARIO
=============================================*/

if(isset($_POST["siglas"])){

	$siglas = new Ajaxmateria();
	$siglas -> siglas = $_POST["siglas"];
	$siglas -> ajaxautocompletar();

}

class Ajaxmateria{

	/*=============================================
	EDITAR MATERIA
	=============================================*/	

	public $idmateria;
	public $siglas;

	 public function ajaxEditarmateria(){

		$item = "cod_mat";
		$valor = $this->idmateria;

		$respuesta = Controladormaterias::ctrMostrarmaterias($item, $valor);
                        
		echo json_encode($respuesta);

	}

/*=============================================
	AUTOCOMPLETAR FORMULARIO
	=============================================*/	

	public function ajaxautocompletar(){

		$item = "sigla";
		$valor = $this->siglas;

		$respuesta = Controladormaterias::ctrautollenar($item, $valor);
                        
		echo json_encode($respuesta);

	}
}