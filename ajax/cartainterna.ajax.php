<?php
require_once "../controladores/corespinterna.controlador.php";
require_once "../modelos/corespinterna.modelo.php";

class Ajaxcarta{
	/*=============================================
	EDITAR  CARTA INTERNA
	=============================================*/	
	public $idcartas;
	public $idcarta;
	public $codcartah;
	
	 public function ajaxEditarcarta(){
        
		$item = "cod_carta";
		$valor = $this->idcarta;

		$respuesta = Controladorcorespinterna::ctrMostrarcorespinterna($item, $valor);
        
        echo json_encode($respuesta);
    }
    
	public function ajaxeditacartacreada(){
        
		$item = "cod_crearcarta";
		$valor = $this->idcartas;
		$respuesta = Controladorcorespinterna::ctrMostrarcartacreada($item,$valor);            
		echo json_encode($respuesta);
	}

	public function ajaxasignarc(){
        
		$item = "cod_carta";
		$valor = $this->codcartah;
		$respuesta = Controladorcorespinterna::ctrMostrarcorespinterna($item,$valor);            
		echo json_encode($respuesta);
	}
	
	
}

/*=============================================
EDITAR  CARTA INTERNA
=============================================*/
if(isset($_POST["idcarta"])){
	$editar = new Ajaxcarta();
	$editar -> idcarta = $_POST["idcarta"];
	$editar -> ajaxEditarcarta();
}
/*=============================================
EDITAR  CARTA CREADA
=============================================*/
if(isset($_POST["idcartas"])){
    
	$Agregar = new Ajaxcarta();
	$Agregar -> idcartas = $_POST["idcartas"];
	$Agregar -> ajaxeditacartacreada();
}

/*=============================================
ASIGNAR REGISTRO DE CARTA
=============================================*/
if(isset($_POST["codcartah"])){
	$Agregar = new Ajaxcarta();
	$Agregar -> codcartah = $_POST["codcartah"];
	$Agregar -> ajaxasignarc();
}