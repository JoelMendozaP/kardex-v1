<?php


require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";


/*=============================================
EDITAR USUARIO
=============================================*/

if(isset($_POST["idusuario"])){

	$editar = new AjaxUsuarios();
	$editar -> idusuario = $_POST["idusuario"];
	$editar -> ajaxEditarUsuario();

}

class AjaxUsuarios{

	/*=============================================
	EDITAR USUARIO
	=============================================*/	

	public $idusuario;

	 public function ajaxEditarUsuario(){

		$item = "cod_user";
		$valor = $this->idusuario;

		$respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
                        
		echo json_encode($respuesta);

	}





	/*=============================================
	ACTIVAR USUARIO
	=============================================*/	

	public $activarUsuario;
	public $activarId;
	
	 public function ajaxActivarUsuario(){

		$tabla = "usuarios";

		$item1 = "estado";
		$valor1 = $this->activarUsuario;
		
		$item2 = "cod_user";
		$valor2 = $this->activarId;

		$respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);
		
	}

	/*=============================================
	VALIDAR NO REPETIR USUARIO
	=============================================*/	
	
	public $validarUsuario;

	 public function ajaxValidarUsuario(){

		$item = "usuario";
		$valor = $this->validarUsuario;

		$respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
		echo json_encode($respuesta);
	}



	

/*=============================================
	ACTIVAR USUARIO MOD1
	=============================================*/	

	public $activarUsuariomod1;
	public $activarIdmod1;
	
	 public function ajaxActivarUsuariomod1(){

		$tabla = "usuarios";

		$item1 = "esta_estudiante";
		$valor1 = $this->activarUsuariomod1;
		
		$item2 = "cod_user";
		$valor2 = $this->activarIdmod1;
		$respuesta = ModeloUsuarios::mdlActualizarUsuariomodgeneral($tabla, $item1, $valor1, $item2, $valor2);
		
	}



	/*=============================================
	ACTIVAR USUARIO MOD2
	=============================================*/	

	public $activarUsuariomod2;
	public $activarIdmod2;
	
	 public function ajaxActivarUsuariomod2(){

		$tabla = "usuarios";

		$item1 = "esta_materias";
		$valor1 = $this->activarUsuariomod2;
		
		$item2 = "cod_user";
		$valor2 = $this->activarIdmod2;
		$respuesta = ModeloUsuarios::mdlActualizarUsuariomodgeneral($tabla, $item1, $valor1, $item2, $valor2);
		
	}


	/*=============================================
	ACTIVAR USUARIO MOD3
	=============================================*/	

	public $activarUsuariomod3;
	public $activarIdmod3;
	
	 public function ajaxActivarUsuariomod3(){

		$tabla = "usuarios";

		$item1 = "esta_plan_estudio";
		$valor1 = $this->activarUsuariomod3;
		
		$item2 = "cod_user";
		$valor2 = $this->activarIdmod3;
		$respuesta = ModeloUsuarios::mdlActualizarUsuariomodgeneral($tabla, $item1, $valor1, $item2, $valor2);
		
	}


	/*=============================================
	ACTIVAR USUARIO MOD4
	=============================================*/	

	public $activarUsuariomod4;
	public $activarIdmod4;
	
	 public function ajaxActivarUsuariomod4(){

		$tabla = "usuarios";

		$item1 = "esta_correspondencia";
		$valor1 = $this->activarUsuariomod4;
		
		$item2 = "cod_user";
		$valor2 = $this->activarIdmod4;
		$respuesta = ModeloUsuarios::mdlActualizarUsuariomodgeneral($tabla, $item1, $valor1, $item2, $valor2);
		
	}




	
}



/*=============================================
ACTIVAR USUARIO
=============================================*/	

if(isset($_POST["activarUsuario"])){

	$activarUsuario = new AjaxUsuarios();
	$activarUsuario -> activarUsuario = $_POST["activarUsuario"];
	$activarUsuario -> activarId = $_POST["activarId"];
	$activarUsuario -> ajaxActivarUsuario();

}

/*=============================================
VALIDAR NO REPETIR USUARIO
=============================================*/

if(isset( $_POST["validarUsuario"])){

	$valUsuario = new AjaxUsuarios();
	$valUsuario -> validarUsuario = $_POST["validarUsuario"];
	$valUsuario -> ajaxValidarUsuario();

}


/*=============================================
ACTIVAR USUARIO MOD1
=============================================*/	

if(isset($_POST["activarUsuariomod1"])){

	$activarUsuariomod1 = new AjaxUsuarios();
	$activarUsuariomod1 -> activarUsuariomod1 = $_POST["activarUsuariomod1"];
	$activarUsuariomod1 -> activarIdmod1 = $_POST["activarIdmod1"];
	$activarUsuariomod1 -> ajaxActivarUsuariomod1();

}



/*=============================================
ACTIVAR USUARIO MOD2
=============================================*/	

if(isset($_POST["activarUsuariomod2"])){

	$activarUsuariomod2 = new AjaxUsuarios();
	$activarUsuariomod2 -> activarUsuariomod2 = $_POST["activarUsuariomod2"];
	$activarUsuariomod2 -> activarIdmod2 = $_POST["activarIdmod2"];
	$activarUsuariomod2 -> ajaxActivarUsuariomod2();

}



/*=============================================
ACTIVAR USUARIO MOD3
=============================================*/	

if(isset($_POST["activarUsuariomod3"])){

	$activarUsuariomod3 = new AjaxUsuarios();
	$activarUsuariomod3 -> activarUsuariomod3 = $_POST["activarUsuariomod3"];
	$activarUsuariomod3 -> activarIdmod3 = $_POST["activarIdmod3"];
	$activarUsuariomod3 -> ajaxActivarUsuariomod3();

}


/*=============================================
ACTIVAR USUARIO MOD4
=============================================*/	

if(isset($_POST["activarUsuariomod4"])){

	$activarUsuariomod4 = new AjaxUsuarios();
	$activarUsuariomod4 -> activarUsuariomod4 = $_POST["activarUsuariomod4"];
	$activarUsuariomod4 -> activarIdmod4 = $_POST["activarIdmod4"];
	$activarUsuariomod4 -> ajaxActivarUsuariomod4();

}
