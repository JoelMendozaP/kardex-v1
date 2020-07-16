<?php

require_once "conexion.php";

class ModeloEstudiantes{
    
	/*=============================================
	MOSTRAR ESTUDIANTES
	=============================================*/

	static public function MdlMostrarestudiante($tabla, $item, $valor){
		
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
	INGRESAR ESTUDIANTES
=============================================*/

	static public function mdlIngresarEstudiante($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre,ci,ap_paterno,ap_materno,reg_univ,estado,modo_ing,modo_egre,genero,email,celular,fecha_nac) VALUES ( :nombre,:ci,:ap_paterno,:ap_materno,:reg_univ,:estado,:modo_ing,:modo_egre,:genero,:email,:celular,:fecha_nac)");
                                             
        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":ci", $datos["ci"], PDO::PARAM_STR);
		$stmt->bindParam(":ap_paterno", $datos["ap_paterno"], PDO::PARAM_STR);
		$stmt->bindParam(":ap_materno", $datos["ap_materno"], PDO::PARAM_STR);
		$stmt->bindParam(":reg_univ", $datos["reg_univ"], PDO::PARAM_STR);
		$stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
		$stmt->bindParam(":modo_ing", $datos["modo_ing"], PDO::PARAM_STR);
		$stmt->bindParam(":modo_egre", $datos["modo_egre"], PDO::PARAM_STR);
		$stmt->bindParam(":genero", $datos["genero"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt->bindParam(":celular", $datos["celular"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_nac", $datos["fecha_nac"], PDO::PARAM_STR);
        
        if ($stmt->execute()) {return "ok";} else {return "error";}
        $stmt->close();
        $stmt = null;

	}
	/*=============================================
	EDITAR ESTUDIANTES
=============================================*/
	static public function mdlEditarEstudiante($tabla, $datos){
		
		$stmt= Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre ,ci = :ci , ap_paterno = :ap_paterno, ap_materno = :ap_materno , reg_univ=:reg_univ, email=:email,celular=:celular,estado=:estado,modo_ing=:modo_ing ,modo_egre=:modo_egre,fecha_nac=:fecha_nac WHERE reg_univ =:reg_univ");
		
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":ci", $datos["ci"], PDO::PARAM_STR);
		$stmt->bindParam(":ap_paterno", $datos["ap_paterno"], PDO::PARAM_STR);
		$stmt->bindParam(":ap_materno", $datos["ap_materno"], PDO::PARAM_STR);
		$stmt->bindParam(":reg_univ", $datos["reg_univ"], PDO::PARAM_STR);
		$stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
		$stmt->bindParam(":modo_ing", $datos["modo_ing"], PDO::PARAM_STR);
		$stmt->bindParam(":modo_egre", $datos["modo_egre"], PDO::PARAM_STR);
		$stmt->bindParam(":genero", $datos["genero"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt->bindParam(":celular", $datos["celular"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_nac", $datos["fecha_nac"], PDO::PARAM_STR);

		if($stmt -> execute()){
			return "ok";
		}else{
			return "error";	
		}
		$stmt -> close();

		$stmt = null;

	}

/*=============================================
	BORRAR ESTUDIANTE
=============================================*/
static public function mdlBorrarestudiante($tabla, $datos){

	$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE codest = :codest");

	
	$stmt -> bindParam(":codest", $datos, PDO::PARAM_INT);

	if($stmt -> execute()){

		return "ok";
	
	}else{

		return "error";	

	}

	$stmt -> close();

	$stmt = null;


}
/*=============================================
	AGREGAR ESTUDIANTES
=============================================*/

static public function mdlinscrbirEstudiante($tabla, $datos)
{
	$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(codest,cod_mat,notafinal,observacion,notaf1,notaf2,notaf3) VALUES ( :codest,:cod_mat,:notafinal,:observacion,:notaf1,:notaf2,:notaf3)");
	
	$stmt->bindParam(":codest", $datos["codest"], PDO::PARAM_STR);
	$stmt->bindParam(":cod_mat", $datos["cod_mat"], PDO::PARAM_STR);
	$stmt->bindParam(":notafinal", $datos["notafinal"], PDO::PARAM_STR);
	$stmt->bindParam(":observacion", $datos["observacion"], PDO::PARAM_STR);
	$stmt->bindParam(":notaf1", $datos["notaf1"], PDO::PARAM_STR);
	$stmt->bindParam(":notaf2", $datos["notaf2"], PDO::PARAM_STR);
	$stmt->bindParam(":notaf3", $datos["notaf3"], PDO::PARAM_STR);
	
	if ($stmt->execute()) {return "ok";} else {return "error";}
	$stmt->close();
	$stmt = null;

}



/*=============================================
	EDITAR AGREGAR ESTUDIANTE
=============================================*/
static public function mdleditarinscribirEstudiante($tabla, $datos)
{
	
	$stmt= Conexion::conectar()->prepare("UPDATE $tabla SET notafinal = :notafinal ,observacion = :observacion , notaf1 = :notaf1, notaf2 = :notaf2 , notaf3=:notaf3 WHERE codest =:codest and cod_mat =:cod_mat ");

	$stmt->bindParam(":codest", $datos["codest"], PDO::PARAM_STR);
	$stmt->bindParam(":cod_mat", $datos["cod_mat"], PDO::PARAM_STR);
	$stmt->bindParam(":notafinal", $datos["notafinal"], PDO::PARAM_STR);
	$stmt->bindParam(":observacion", $datos["observacion"], PDO::PARAM_STR);
	$stmt->bindParam(":notaf1", $datos["notaf1"], PDO::PARAM_STR);
	$stmt->bindParam(":notaf2", $datos["notaf2"], PDO::PARAM_STR);
	$stmt->bindParam(":notaf3", $datos["notaf3"], PDO::PARAM_STR);

	if ($stmt->execute()) {return "ok";} else {return "error";}
	$stmt->close();
	$stmt = null;

}
/*=============================================
	MOSTRAR DATOS DE LA BOLETA
=============================================*/
	
public static function mdlMostrarboleta($tabla , $tabla1 ,$item, $valor,$id)
    {
        // $tabla = "estudiante";
        // $tabla1 = "materia";
		// $tabla2 = "toma";
              if($item != null) {
               $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla , $tabla1  WHERE $item = :$item");
               $stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
              $stmt->execute();
              return $stmt -> fetch();
            }else{                                 
                $stmt = Conexion::conectar()->prepare("SELECT * FROM toma t,materia m, estudiante e WHERE $id = t.codest and t.cod_mat = m.cod_mat and e.codest=$id");
                $stmt->execute();
                return $stmt -> fetchAll();
            }
            $stmt->close();
            $stmt = null;
           
	 }
	 
/*=============================================
	MOSTRAR LISTA DE ESTUDIANTES 
=============================================*/
public static function mdlMostrarlista($tabla , $tabla1 ,$item, $valor,$id)
{
	// $tabla = "estudiante";
	// $tabla1 = "materia";
	// $tabla2 = "toma";
		  if($item != null) {
		   $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla , $tabla1  WHERE $item = :$item");
		   $stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
		  $stmt->execute();
		  return $stmt -> fetch();
		}else{                                 
			$stmt = Conexion::conectar()->prepare("SELECT * FROM estudiante e,toma t, materia m WHERE $id= m.cod_mat and e.codest = t.codest and t.cod_mat=$id");
			$stmt->execute();
			return $stmt -> fetchAll();
		}
		$stmt->close();
		$stmt = null;
	   
 }

 /*=============================================
	ELIMINAR REGISTRO DE BOLETA
=============================================*/

  static public function mdlBorrarregistro($tabla, $datos,$datos1){

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
	AGREGAR ESTUDIANTES
=============================================*/

static public function mdlingresardocumento($tabla,$datos)
{
	$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(codest,tituloar,descripar,docgaleria,tipod) VALUES ( :codest,:tituloar,:descripar,:docgaleria,:tipod)");
	
	 
	$stmt->bindParam(":codest", $datos["codest"], PDO::PARAM_STR);
	$stmt->bindParam(":tituloar", $datos["tituloar"], PDO::PARAM_STR);
	$stmt->bindParam(":descripar", $datos["descripar"], PDO::PARAM_STR);
	$stmt->bindParam(":docgaleria", $datos["docgaleria"], PDO::PARAM_STR);
	$stmt->bindParam(":tipod", $datos["tipod"], PDO::PARAM_STR);
	
	if ($stmt->execute()) {return "ok";} else {return "error";}
	    $stmt->close();
		$stmt = null;

}


/*=============================================
	MOSTRAR DATOS DE LA BOLETA
=============================================*/
	
public static function mdlMostrargaleria($tabla,$codigo)
    {
                $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $codigo = codest");
                $stmt->execute();
                return $stmt -> fetchAll();
				$stmt->close();
				$stmt = null;
           
	 }
	 public static function mdlMostrargaleriaajax($tabla,$codigo,$valor)
	 {
		
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $codigo = :$codigo");
			$stmt->bindParam(":".$codigo, $valor, PDO::PARAM_STR);
		   $stmt->execute();
		   return $stmt -> fetch();
		 
				 $stmt->close();
				 $stmt = null;
	 }
	 static public function MdlMostrarestudiantes($tabla,$item,$item1,$item2, $valor, $valor1, $valor2){
		
		if($item != null && $item1 != null && $item2 != null) {
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item and $item1 = :$item1 and $item2 = :$item2");
			$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt->bindParam(":".$item1, $valor1, PDO::PARAM_STR);
			$stmt->bindParam(":".$item2, $valor2, PDO::PARAM_STR);
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
	EDITAR  DOCUMENTO DE GALERIA
=============================================*/
static public function mdleditargaleria($tabla,$datos,$regresa){

	$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET tituloar = :tituloar ,descripar = :descripar , docgaleria = :docgaleria ,tipod = :tipod  WHERE  codoc= $regresa");
	
	$stmt->bindParam(":tituloar", $datos["tituloar"], PDO::PARAM_STR);
	$stmt->bindParam(":descripar", $datos["descripar"], PDO::PARAM_STR);
	$stmt->bindParam(":docgaleria", $datos["docgaleria"], PDO::PARAM_STR);
	$stmt->bindParam(":tipod", $datos["tipod"], PDO::PARAM_STR);
	
	
	if ($stmt->execute()) {return "ok";} else {return "error";}

		  $stmt = null;
		$stmt->close();
		   
   }


   /*=============================================
	BORRAR DOCUMENTO DE GALERIA
=============================================*/
static public function mdlBorrardocumento($tabla, $datos){

	$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE codoc = :codoc");

	$stmt -> bindParam(":codoc", $datos, PDO::PARAM_INT);

	if($stmt -> execute()){
		return "ok";
	}else{
		return "error";	
	   }
       $stmt = null;
       $stmt->close();
   }


}