
        <?php


class Controladorplandeestudio
{
    public static function ctrcrearplandeestudio()
    {

        if (isset($_POST["nombreplan"])) {
            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nombreplan"]) &&
                preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nmencion"])) {
                $tabla = "plandeestudio";
                $datos = array(
                    "nombrepl" => $_POST["nombreplan"],
                    "fech_ini" => $_POST["fechainiciopl"],
                    "fech_fin" => $_POST["fechafinalpl"],
                    "mencion" => $_POST["nmencion"],
                );
                $respuesta = modeloplandeestudios::mdlingresarplandeestudios($tabla, $datos);
                
                if ($respuesta === "ok") {
                    echo '<script>
                                swal({
                                    type: "success",
                                    title: "EL PLAN DE ESTUDIOS A SIDO CREADO CORRECTAMENTE",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar",
                                    closeOnConfirm: false
                                }).then((result)=>{
                                    if(result.value){
                                        window.location = "plandeestudios";
                                    }
                                });
                                </script>';
                } else {
                    echo '<script>

        swal({
            type: "error",
            title: "¡El PLAN DE ESTUDIO NO A SIDO REGISTRADO AUN!",
            showConfirmButton: true,
            confirmButtonText: "Cerrar",
            closeOnConfirm: false

        }).then((result)=>{
            if(result.value){
                window.location = "plandeestudios";
            }
        });
        </script>';
                }
            } else {
                echo '<script>
        swal({
            type: "error",
            title: "¡El Formulario tiene no registra datos <br> con caracteres especiales ni puntos !",
            showConfirmButton: true,
            confirmButtonText: "Cerrar",
            closeOnConfirm: false

        }).then((result)=>{
            if(result.value){
                window.location = "plandeestudios";
            }
        });
        </script>';
            }
        }
    }
     /*=============================================
	MOSTRAR PLAN DE ESTUDIO
	=============================================*/
    static public function ctrmostrarplandeestudios($item, $valor)
    {
        $tabla = "plandeestudio";
        $respuesta = modeloplandeestudios::MdlMostrarplandeestudios($tabla, $item, $valor);
        return $respuesta;
    }



 /*=============================================
	VERIFICAR SI EXISTE ESTUDIANTE
	=============================================*/
    
    static public function ctrMostrarestudiantes($item,$item1,$item2, $valor, $valor1, $valor2)
    {
        $tabla = "estudiante";
        $respuesta = ModeloEstudiantes::MdlMostrarestudiantes($tabla,$item,$item1,$item2, $valor, $valor1, $valor2);
        return $respuesta;
    }

      /*=============================================
	MOSTRAR BOLETA
	=============================================*/
    static public function ctrMostrarboleta($item, $valor,$id)
    {
        $tabla = "estudiante";
        $tabla1 = "materia";
        $respuesta = ModeloEstudiantes::mdlMostrarboleta($tabla,$tabla1, $item, $valor,$id);
        return $respuesta;
    }


    static public function ctrMostrarlista($item, $valor,$id)
    {
        $tabla = "estudiante";
        $tabla1 = "materia";
        $respuesta = ModeloEstudiantes::mdlMostrarlista($tabla,$tabla1, $item, $valor,$id);
        return $respuesta;
    }


    /*=============================================
	EDITAR PLAN DE ESTUDIOS
	=============================================*/
	
	static public function ctreditarplandeestudio(){
        
        
		if(isset($_POST["editarnombreplan"])){
			
            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarnombreplan"]) &&
                preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarnmencion"])
				){
			
				$tabla = "plandeestudio";
               		  
			  $datos = array("nombrepl"=> $_POST["editarnombreplan"],
							  "fech_ini" => $_POST["editarfechainiciopl"],
							  "fech_fin" => $_POST["editarfechafinalpl"], 
                              "mencion" => $_POST["editarnmencion"],
                              "codplane" => $_POST["codplane"],
							 );

                $respuesta = modeloplandeestudios::mdlEditarplandeestudios($tabla, $datos);
                    
				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "Se Guardaron Todos Los Cambios",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar",
						  closeOnConfirm: false
						  }).then((result) => {
									if (result.value) {

									window.location = "plandeestudios";

									}
								})

					</script>';
				}
			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡Los Datos no pueden ir vacíos o llevar caracteres especiales en el formulario!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar",
						  closeOnConfirm: false
						  }).then((result) => {
							if (result.value) {

							window.location = "plandeestudios";

							}
						})
			  	</script>';
			}
		}
    }
    
    /*=============================================
	BORRAR PLAN DE ESTUDIO
	=============================================*/
    
	static public function ctrBorrarplandeestudio(){

		if(isset($_GET["idplane"])){
            
			$tabla ="plandeestudio";
			$datos = $_GET["idplane"];

			$respuesta = modeloplandeestudios::mdlBorrarplandeestudio($tabla, $datos);
                 
			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "Plan De Estudios ha sido Borrado Correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then((result) => {
								if (result.value) {
								window.location = "plandeestudios";
								}
							})
				</script>';
			}		
		}
	}

  /*=============================================
      AGREGAR MATERIA AL PLAN DE ESTUDIO
	=============================================*/

    public static function CtrAgregarmpl()
    {
        if (isset($_POST["idmateriaplan"])) {
       
                $tabla = "pertenece";
                $datos = array(
                    "cod_mat" => $_POST["nuevamateriapl"],
                    "codpe" => $_POST["idmateriaplan"],
                );
                $respuesta = modeloplandeestudios::mdlagregarmateria($tabla, $datos);
                if ($respuesta === "ok") {
                    echo '<script>
                                swal({
                                    type: "success",
                                    title: "MATERIA AGREGADA",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar",
                                    closeOnConfirm: false

                                }).then((result)=>{

                                    if(result.value){
                                        window.location = "plandeestudios";
                                    }
                                });
                                </script>';
                } else {
                    echo '<script>

        swal({
            type: "error",
            title: "¡MATERIA YA EXISTENTE EN EL PLAN O NO SE A PODIDO AGREGAR!",
            showConfirmButton: true,
            confirmButtonText: "Cerrar",
            closeOnConfirm: false

        }).then((result)=>{
            if(result.value){
                window.location = "plandeestudios";
            }
        });
        </script>';
                }
           
        }
    }


     /*=============================================
	BORRAR MATERIA DEL PLAN DE ESTUDIO 
	=============================================*/
    
	static public function ctrBorrarplandeestudioenmateria(){

		if(isset($_GET["idmateria"])&&isset($_GET["codplanest"])){
            
			$tabla ="pertenece";
            $datos = $_GET["codplanest"];
            $datos1 = $_GET["idmateria"];
            
            echo'<script>      
                     var codplanest ='.$_GET["codplanest"].';
            </script>';
            
			$respuesta = modeloplandeestudios::mdlBorrarplandeestudiomateria($tabla, $datos,$datos1);
                 
			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "La Materia ha sido Borrada del Plan Correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then((result) => {
								if (result.value) {
                                    var codplanest ='.$datos.';
                                    window.location = "index.php?ruta=listadeplandeestudio&codplanest="+codplanest;
								}
							})
				</script>';
			}		
		}
	}

    /*=============================================
	MOSTRAR  MATERIA DE PLAN DE ESTUDIO
	=============================================*/
    static public function ctrMostrarlistaplan($item, $valor, $id)
    {
        $tabla = "pertenece";
        $tabla1 = "materia";
        $respuesta = modeloplandeestudios::MdlMostrarlistaplan($item, $valor,$id,$tabla,$tabla1);
        return $respuesta;
    }


}


