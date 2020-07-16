<?php

class ControladorInstructor
{
    
    public static function CtrCrearInstructor()
    {

        if (isset($_POST["nrocel"])) {

            if ( preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["ApPaterno"]) &&
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["ApMaterno"]) &&
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["Ci"]) &&
                preg_match('/^[a-zA-Z0-9.@]+$/', $_POST["emaild"]) &&
                preg_match('/^[Z0-9 ]+$/', $_POST["nrocel"]) &&
                preg_match('/^[Z0-9 ]+$/', $_POST["meritos"]))  
                 {
                /*validar imagen */
                $ruta ="";
                if (isset($_FILES["nuevafotoI"]["tmp_name"])) {
                    list($ancho, $alto)=getimagesize($_FILES["nuevafotoI"]["tmp_name"]);
                   
                    $nuevoAncho = 500;
                    $nuevoAlto = 500;

                   /* creamos el directorio a guardar la foto del usuario*/
                $directorio3 ="views/img/instructores/".$_POST["nombre"];
                 mkdir($directorio3,0755);

                   /* de acuerdo al tipo de imagen aplicamos las funciones por defecto de php*/
                   if($_FILES["nuevafotoI"]["type"] == "image/jpeg"){

                    /*=============================================
                    GUARDAMOS LA IMAGEN EN EL DIRECTORIO
                    =============================================*/

                    $aleatorio = mt_rand(100,999);

                    $ruta = "views/img/instructores/".$_POST["nombre"]."/".$aleatorio.".jpg";

                    $origen = imagecreatefromjpeg($_FILES["nuevafotoI"]["tmp_name"]);						

                    $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                    imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                    imagejpeg($destino, $ruta);

                }
                

                if($_FILES["nuevafotoI"]["type"] == "image/png"){

                    /*=============================================
                    GUARDAMOS LA IMAGEN EN EL DIRECTORIO instructores
                    =============================================*/

                    $aleatorio = mt_rand(100,999);

                    $ruta = "views/img/instructores/".$_POST["nombre"]."/".$aleatorio.".png";

                    $origen = imagecreatefrompng($_FILES["nuevafotoI"]["tmp_name"]);						

                    $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                    imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                    imagepng($destino, $ruta);

                }
        }

        $tabla="persona";
                $datos = array("Nombre" => $_POST["nombre"], 
                               "Ap_Paterno" => $_POST["ApPaterno"],
                              "Ap_Materno" => $_POST["ApMaterno"],
                              "Ci" => $_POST["Ci"],
                              "Genero" => $_POST["genero"],
                              "Correo_Electronico" => $_POST["emaild"],
                              "Nro_Cel" => $_POST["nrocel"],
                             "Fecha_Nac"=>$_POST["fechanac"]);
         $tabla1="instructor";
         $datos1 = array("Nro_de_Meritos" => $_POST["meritos"],
                 "Especialidades" => $_POST["especialidades"],
                 "fotoI"=>$ruta);                           
        $respuesta = Modeloinstructor::mdlIngresarinstructortotal($tabla,$datos,$tabla1, $datos1);

         echo "<script>";
         echo "alert('";
         echo  $respuesta;
         echo "')</script>";

                if ( $respuesta === "ok" ) {
                    echo '<script>
                                swal({
                                    type: "success",
                                    title: "EL INSTRUCTOR A SIDO GUARDADO CORRECTAMENTE",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar",
                                    closeOnConfirm: false

                                }).then((result)=>{

                                    if(result.value){
                                        window.location = "ingreso";
                                    }
                                });
                                </script>';
                } else {
                    echo '<script>

        swal({
            type: "error",
            title: "¡El Instructor no ha sido guardado correctamente!",
            showConfirmButton: true,
            confirmButtonText: "Cerrar",
            closeOnConfirm: false

        }).then((result)=>{
            if(result.value){
                window.location = "ingreso";
            }
        });
        </script>';

                }
            } else {
                echo '<script>

        swal({
            type: "error",
            title: "¡Los datos tienen errores los datos deben estar sin caracteres especiales ni puntos, <br> (Nombre Completo y Fecha de nacimiento 1996-09-22) !",
            showConfirmButton: true,
            confirmButtonText: "Cerrar",
            closeOnConfirm: false

        }).then((result)=>{
            if(result.value){
                window.location = "ingreso";
            }
        });
        </script>';
            }
        }
    }
    /*MOSTRAR CURSO */
    static public function ctrMostrarinstructor($item, $valor){
        $tabla = "persona";
        $tabla1 ="instructor";   
		$respuesta =Modeloinstructor::MdlMostrarinstructor($tabla,$tabla1, $item, $valor);
		return $respuesta;
    }
    
}