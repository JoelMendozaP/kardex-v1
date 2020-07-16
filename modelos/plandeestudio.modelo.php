<?php

require_once "conexion.php";

class modeloplandeestudios{
    
	/*=============================================
	MOSTRAR PLAN DE ESTUDIOS
	=============================================*/
	static public function MdlMostrarplandeestudios($tabla, $item, $valor){
		
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
	REGISTRAR PLAN DE ESTUDIOS
=============================================*/

	static public function mdlingresarplandeestudios($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombrepl,fech_ini,fech_fin,mencion) VALUES ( :nombrepl,:fech_ini,:fech_fin,:mencion)");
                                             
        $stmt->bindParam(":nombrepl", $datos["nombrepl"], PDO::PARAM_STR);
		$stmt->bindParam(":fech_ini", $datos["fech_ini"], PDO::PARAM_STR);
		$stmt->bindParam(":fech_fin", $datos["fech_fin"], PDO::PARAM_STR);
		$stmt->bindParam(":mencion", $datos["mencion"], PDO::PARAM_STR);
        if ($stmt->execute()) {return "ok";} else {return "error";}
        $stmt->close();
        $stmt = null;

    }
    
	/*=============================================
	EDITAR PLAN DE ESTUDIOS 
=============================================*/
	static public function mdlEditarplandeestudios($tabla, $datos){
		
		$stmt= Conexion::conectar()->prepare("UPDATE $tabla SET nombrepl = :nombrepl ,fech_ini = :fech_ini , fech_fin = :fech_fin, mencion = :mencion WHERE codpe =:codpe");
        
		$stmt->bindParam(":nombrepl", $datos["nombrepl"], PDO::PARAM_STR);
		$stmt->bindParam(":fech_ini", $datos["fech_ini"], PDO::PARAM_STR);
		$stmt->bindParam(":fech_fin", $datos["fech_fin"], PDO::PARAM_STR);
        $stmt->bindParam(":mencion", $datos["mencion"], PDO::PARAM_STR);
        $stmt->bindParam(":codpe", $datos["codplane"], PDO::PARAM_STR);

		if($stmt -> execute()){
            return "ok";
           
		}else{
            return "error";	
           
		}
        $stmt->close();
		$stmt = null;

	}

/*=============================================
	BORRAR PLAN DE ESTUDIOS
=============================================*/
static public function mdlBorrarplandeestudio($tabla, $datos){

	$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE codpe = :codpe");
	
	$stmt -> bindParam(":codpe", $datos, PDO::PARAM_INT);
	if($stmt -> execute()){
		return "ok";
	}else{
		return "error";	
	}
	$stmt->close();
	$stmt = null;
}

/*=============================================
	AGREGAR MATERIA A PLAN DE ESTUDIO
=============================================*/

static public function mdlagregarmateria($tabla, $datos)
{
	$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(cod_mat,codpe) VALUES (:cod_mat, :codpe)");
    
    $stmt->bindParam(":cod_mat", $datos["cod_mat"], PDO::PARAM_STR);
	$stmt->bindParam(":codpe", $datos["codpe"], PDO::PARAM_STR);
    
	if ($stmt->execute()) {return "ok";} else {return "error";}
	$stmt->close();
	$stmt = null;

}
	
/*=============================================
	MOSTRAR LISTA DE MATERIAS EN PLAN DE ESTUDIOS
    =============================================*/
	static public function MdlMostrarlistaplan($item, $valor,$id,$tabla,$tabla1){
	
		if($item != null) {
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt -> fetch();
			}else{
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla p, $tabla1 m 
                WHERE $id=p.codpe and m.cod_mat = p.cod_mat
                ORDER by p.aagregadoen ");
				$stmt->execute();
				return $stmt -> fetchAll();
			}
			$stmt->close();
			$stmt = null;
    }
    

    /*=============================================
	BORRAR MATERIA DE PLAN DE ESTUDIOS
=============================================*/
static public function mdlBorrarplandeestudiomateria($tabla, $datos,$datos1){

	$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE codpe = $datos and cod_mat = $datos1");
	
    
    $ok=' sie sta';

	if($stmt -> execute()){
		return "ok";
	}else{
		return "error";	
	}
	$stmt->close();
	$stmt = null;
}

}