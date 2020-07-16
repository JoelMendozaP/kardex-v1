<?php

class Controladormaterias
{
   

    static public function CtrCrearmateria()
    {
        if (isset($_POST["nuevonombrem"])) {

            if (
                preg_match('/^[a-zA-Z0-9ñÑáéíóú-ÁÉÍÓÚ ]+$/', $_POST["nuevonombrem"]) &&
                preg_match('/^[a-zA-Z0-9ñÑáéíóú-ÁÉÍÓÚ ]+$/', $_POST["nuevofolio"]) &&
                preg_match('/^[a-zA-Z0-9ñÑáéíóú-ÁÉÍÓÚ ]+$/', $_POST["nuevodocente"]) &&
                preg_match('/^[a-zA-Z0-9ñÑáéíóú-ÁÉÍÓÚ ]+$/', $_POST["nuevolibro"])
            ) {
                $tabla = "materia";

              
                $datos = array(
                    "sigla" => $_POST["nuevasigla"],
                    "nombre_m" => $_POST["nuevonombrem"],
                    "folio" => $_POST["nuevofolio"],
                    "libro" => $_POST["nuevolibro"],
                    "gestion" => $_POST["nuevagestion"],
                    "tipo" => $_POST["tipo"],
                    "fecha_curso" => $_POST["nuevaestapa"],
                    "docente" => $_POST["nuevodocente"],
                    
                    
                );

                $respuesta = Modelomaterias::mdlIngresarmateria($tabla, $datos);
                

                if ($respuesta === "ok") {
                    echo '<script>
                            swal({
                                type: "success",
                                title: "EL MATERIA A SIDO GUARDADO CORRECTAMENTE",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar",
                                closeOnConfirm: false

                            }).then((result)=>{

                                if(result.value){
                                    window.location = "materia";
                                }
                            });
                            </script>';
                } else {
                    echo '<script>

    swal({
        type: "error",
        title: "¡La materia no ha sido guardada correctamente!",
        showConfirmButton: true,
        confirmButtonText: "Cerrar",
        closeOnConfirm: false

    }).then((result)=>{
        if(result.value){
            window.location = "materia";
        }
    });
    </script>';
                }
            } else {
                echo '<script>

    swal({
        type: "error",
        title: "¡En el FormularioLa materia no puede usar caracteres especiales!",
        showConfirmButton: true,
        confirmButtonText: "Cerrar",
        closeOnConfirm: false

    }).then((result)=>{
        if(result.value){
            window.location = "materia";
        }
    });
    </script>';
            }
        }
    }
     /*=============================================
	MOSTRAR MATERIA
	=============================================*/
    
    static public function ctrMostrarmaterias($item, $valor)
    {

        $tabla = "materia";
       
        $respuesta =  Modelomaterias::MdlMostrarMaterias($tabla, $item, $valor);

        return $respuesta;
    }

     /*=============================================
	AUTOCOMPLETAR MATERIA
	=============================================*/

    static public function ctrautollenar($item, $valor){

        $tabla = "materia";
        $respuesta =  Modelomaterias::Mdlautollenar($tabla, $item, $valor);
        return $respuesta;

    }

   
    /*=============================================
	EDITAR MATERIA
	=============================================*/
    
	static public function Ctreditarmateria(){
		
		if(isset($_POST["editarnombrem"])){
			

            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarnombrem"])&&  
                preg_match('/^[a-zA-Z0-9ñÑáéíóú-ÁÉÍÓÚ  ]+$/', $_POST["editarfolio"]) &&
                preg_match('/^[a-zA-Z0-9ñÑáéíóú-ÁÉÍÓÚ  ]+$/', $_POST["editardocente"]) &&
                preg_match('/^[a-zA-Z0-9ñÑáéíóú-ÁÉÍÓÚ  ]+$/', $_POST["editarlibro"])
				){
				
                    $tabla = "materia";

              
                    $datos = array(
                        "sigla" => $_POST["editarsigla"],
                        "nombre_m" => $_POST["editarnombrem"],
                        "folio" => $_POST["editarfolio"],
                        "libro" => $_POST["editarlibro"],
                        "gestion" => $_POST["editargestion"],
                        "fecha_curso" => $_POST["editarestapa"],
                        "docente" => $_POST["editardocente"],
                        
                        
                    );
							 
                $respuesta = Modelomaterias::mdlEditarmateria($tabla, $datos);
                    
				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La materia ha sido editada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar",
						  closeOnConfirm: false
						  }).then((result) => {
									if (result.value) {

									window.location = "materia";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡Los Datos no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar",
						  closeOnConfirm: false
						  }).then((result) => {
							if (result.value) {

							window.location = "materia";

							}
						})

			  	</script>';

			}

		}
    }
    

    /*=============================================
	BORRAR MATERIA
	=============================================*/
    
	static public function ctrBorrarmateria(){

		if(isset($_GET["idmateria"])){
            
			$tabla ="materia";
			$datos = $_GET["idmateria"];

			$respuesta = Modelomaterias::mdlBorrarmateria($tabla, $datos);
                                         
			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "La materia ha sido borrada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then((result) => {
								if (result.value) {

								window.location = "materia";

								}
							})

				</script>';

			}		

		}

    }
    
    /*=============================================
	BORRAR A ESTUDIANTE DE MATERIA
	=============================================*/
	static public function ctrBorrarestudianteenmateria(){

		if(isset($_GET["estudiantelisid"])&&isset($_GET["materiaidlista"])){
            
			$tabla ="toma";
            $datos = $_GET["estudiantelisid"];
            $datos1 = $_GET["materiaidlista"];

            
            echo'<script>      
            var idmaterias ='.$_GET["materiaidlista"].';
              </script>';
			$respuesta = Modelomaterias::mdlBorrarestudiantedemateria($tabla, $datos,$datos1);
                                            
            if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El Estudiante a sido eliminado",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then((result) => {
								if (result.value) {
                                    var idmaterias ='.$datos1.';
                                    window.location="index.php?ruta=inscribir&idmaterias="+idmaterias;
								}
							})
				</script>';
			}			
		}
    }

}
