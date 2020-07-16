<?php

require_once "conexion.php";

class Modelomaterias{
	
	/*=============================================
	MOSTRAR USUARIOS
	=============================================*/
	static public function MdlMostrarMaterias($tabla, $item, $valor){
		
		if($item != null) {
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt -> fetch();
			}else{
	
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ");
				$stmt->execute();
				return $stmt -> fetchAll();
	
			}
			$stmt->close();
			$stmt = null;
	}
/*=============================================
	INGRESAR MATERIAS
=============================================*/

static public function mdlIngresarmateria($tabla, $datos)
{
    $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(sigla,nombre_m,folio,libro,gestion,tipo,fecha_curso,docente) VALUES ( :sigla,:nombre_m,:folio,:libro,:gestion,:tipo,:fecha_curso,:docente)");
    
    $stmt->bindParam(":sigla", $datos["sigla"], PDO::PARAM_STR);
    $stmt->bindParam(":nombre_m", $datos["nombre_m"], PDO::PARAM_STR);
    $stmt->bindParam(":folio", $datos["folio"], PDO::PARAM_STR);
    $stmt->bindParam(":libro", $datos["libro"], PDO::PARAM_STR);
    $stmt->bindParam(":gestion", $datos["gestion"], PDO::PARAM_STR);
    $stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);
	$stmt->bindParam(":fecha_curso", $datos["fecha_curso"], PDO::PARAM_STR);
	$stmt->bindParam(":docente", $datos["docente"], PDO::PARAM_STR);
    
    if ($stmt->execute()) {return "ok";} else {return "error";}
    $stmt->close();
    $stmt = null;
}


  /*=============================================
	EDITAR MATERIA
=============================================*/
	static public function mdlEditarmateria($tabla, $datos){
		
		$stmt= Conexion::conectar()->prepare("UPDATE $tabla SET sigla = :sigla , nombre_m = :nombre_m, folio = :folio ,libro = :libro , gestion=:gestion,fecha_curso=:fecha_curso,docente=:docente WHERE folio =:folio");
		
    $stmt->bindParam(":sigla", $datos["sigla"], PDO::PARAM_STR);
    $stmt->bindParam(":nombre_m", $datos["nombre_m"], PDO::PARAM_STR);
    $stmt->bindParam(":folio", $datos["folio"], PDO::PARAM_STR);
    $stmt->bindParam(":libro", $datos["libro"], PDO::PARAM_STR);
    $stmt->bindParam(":gestion", $datos["gestion"], PDO::PARAM_STR);
	$stmt->bindParam(":fecha_curso", $datos["fecha_curso"], PDO::PARAM_STR);
	$stmt->bindParam(":docente", $datos["docente"], PDO::PARAM_STR);
    
    if ($stmt->execute()) {return "ok";} else {return "error";}
    $stmt->close();
    $stmt = null;
	}

	
  /*=============================================
	BORRAR MATERIA
=============================================*/

	static public function mdlBorrarmateria($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE cod_mat = :cod_mat");
	
		$stmt -> bindParam(":cod_mat", $datos, PDO::PARAM_INT);
	
		if($stmt -> execute()){
	
			return "ok";
		
		}else{
	
			return "error";	
	
		}
	
		$stmt -> close();
	
		$stmt = null;
	
	
	}

/*=============================================
	BORRAR A ESTUDIANTE DE MATERIA
=============================================*/
	
	static public function mdlBorrarestudiantedemateria($tabla, $datos,$datos1){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE codest = $datos and cod_mat = $datos1");
	
		if($stmt -> execute()){
			return "ok";
		}else{
			return "error";	
		}
		$stmt->close();
		$stmt = null;
	}


	/*=============================================
	AUTOCOMPLETAR MATERIA
	=============================================*/
	static public function Mdlautollenar($tabla, $item, $valor){
		
		if($item != null) {

			$stmt = Conexion::conectar()->prepare("SELECT DISTINCT * FROM $tabla WHERE $item = :$item");
			$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt -> fetch();

			}else{

				$stmt = Conexion::conectar()->prepare("SELECT DISTINCT * FROM $tabla");
				$stmt->execute();
				return $stmt -> fetchAll();
			}
			$stmt->close();
			$stmt = null;
	}


}