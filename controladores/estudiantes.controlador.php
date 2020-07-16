<?php


class ControladorEstudiantes
{

    public static function CtrCrearestudiante()
    {

        if (isset($_POST["nombre"])) {
            if (preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nombre"]) &&
                preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["ApPaterno"]) &&
                preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["ApMaterno"]) &&
                preg_match('/^[a-zA-Z0-9 ]+$/', $_POST["Ci"]) 
               

            ) {

                $tabla = "estudiante";
              
                $datos = array(
                    "nombre" => $_POST["nombre"],
                    "ap_paterno" => $_POST["ApPaterno"],
                    "ap_materno" => $_POST["ApMaterno"],
                    "ci" => $_POST["Ci"],
                    "genero" => $_POST["genero"],
                    "celular" => $_POST["nrocel"],
                    "reg_univ" => $_POST["matricula"],
                    "email" => $_POST["email"],
                    "estado" => $_POST["estado"],
                    "modo_ing" => $_POST["ingreso"],
                    "modo_egre" => $_POST["egreso"],
                    "fecha_nac" => $_POST["nacimiento"],
                );
                $respuesta = ModeloEstudiantes::mdlIngresarEstudiante($tabla, $datos);
                
                if ($respuesta === "ok") {
                    echo '<script>
                                swal({
                                    type: "success",
                                    title: "EL ESTUDIANTE A SIDO REGISTRADO CORRECTAMENTE",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar",
                                    closeOnConfirm: false

                                }).then((result)=>{

                                    if(result.value){
                                        window.location = "estudiantes";
                                    }
                                });
                                </script>';
                } else {
                    echo '<script>

        swal({
            type: "error",
            title: "¡El Estudiante no ha sido Registado!",
            showConfirmButton: true,
            confirmButtonText: "Cerrar",
            closeOnConfirm: false

        }).then((result)=>{
            if(result.value){
                window.location = "estudiantes";
            }
        });
        </script>';
                }
            } else {
                echo '<script>
        swal({
            type: "error",
            title: "¡El ci y cel de son solo numeros puede usar caracteres especiales ni letras , <br> deben estar sin caracteres especiales ni puntos!",
            showConfirmButton: true,
            confirmButtonText: "Cerrar",
            closeOnConfirm: false

        }).then((result)=>{
            if(result.value){
                window.location = "estudiantes";
            }
        });
        </script>';
            }
        }
    }
     /*=============================================
	MOSTRAR ESTUDIANTE
	=============================================*/
    static public function ctrMostrarestudiante($item, $valor)
    {
        $tabla = "estudiante";
        $respuesta = ModeloEstudiantes::MdlMostrarestudiante($tabla, $item, $valor);
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
	EDITAR ESTUDIANTE
	=============================================*/
	
	static public function ctreditarestudiante(){
        
        
		if(isset($_POST["editarnombre"])){
			

            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarnombre"])  && 
               preg_match('/^[a-zA-Z0-9ñÑáéíóú-ÁÉÍÓÚ ]+$/', $_POST["editarApPaterno"]) &&
               preg_match('/^[a-zA-Z0-9ñÑáéíóú-ÁÉÍÓÚ ]+$/', $_POST["editarApMaterno"]) &&
             preg_match('/^[a-zA-Z0-9 ]+$/', $_POST["editarCi"]) &&
        
                preg_match('/^[0-9 ]+$/', $_POST["editarnrocel"]) &&
             preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarmatricula"])
				){
			
				$tabla = "estudiante";
               		  
			  $datos = array("nombre" => $_POST["editarnombre"],
							  "ap_paterno" => $_POST["editarApPaterno"],
							  "ap_materno" => $_POST["editarApMaterno"], 
							  "email" => $_POST["editaremail"],
                              "celular" => $_POST["editarnrocel"],
							  "reg_univ" => $_POST["editarmatricula"],
							  "ci" => $_POST["editarCi"], 
                              "estado" => $_POST["editarestado"], 
                              "modo_ing" => $_POST["editaringreso"], 
							  "modo_egre" => $_POST["editaregreso"], 
                              "fecha_nac" => $_POST["editarnacimiento"], 
							 );
	              							 
                $respuesta = ModeloEstudiantes::mdlEditarEstudiante($tabla, $datos);
                    
				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El Estudiante ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar",
						  closeOnConfirm: false
						  }).then((result) => {
									if (result.value) {

									window.location = "estudiantes";

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

							window.location = "estudiantes";

							}
						})

			  	</script>';

			}

		}
    }
    
    /*=============================================
	BORRAR ESTUDIANTE
	=============================================*/
    
	static public function ctrBorrarestudiante(){

		if(isset($_GET["idestudiante"])){
            
			$tabla ="estudiante";
			$datos = $_GET["idestudiante"];

			$respuesta = Modeloestudiantes::mdlBorrarestudiante($tabla, $datos);
                                            
			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "Estudiante ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then((result) => {
								if (result.value) {
								window.location = "estudiantes";
								}
							})
				</script>';
			}		
		}
	}

  /*=============================================
      INSCRIBIR ESTUDIANTE
	=============================================*/

    public static function CtrInscribir()
    {
       
        if (isset($_POST["idest"])) {
       
            if (preg_match('/^[0-9 ]+$/', $_POST["nota1"]) &&
                preg_match('/^[0-9 ]+$/', $_POST["nota2"]) &&
                preg_match('/^[0-9 ]+$/', $_POST["nota3"]) 
                ){
                $tabla = "toma";
                $datos = array(
                    "codest" => $_POST["idest"],
                    "cod_mat" => $_POST["nuevamateria"],
                    "notaf1" => $_POST["nota1"],
                    "notaf2" => $_POST["nota2"],
                    "notaf3" => $_POST["nota3"],
                    "observacion" => $_POST["observaciones"],
                    "notafinal" => $_POST["notafinal"],
                );
                $respuesta = ModeloEstudiantes::mdlinscrbirEstudiante($tabla, $datos);
                
                if ($respuesta === "ok") {
                    echo '<script>
                                swal({
                                    type: "success",
                                    title: "EL ESTUDIANTE A SIDO AGREGADO CORRECTAMENTE A LA MATERIA",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar",
                                    closeOnConfirm: false

                                }).then((result)=>{

                                    if(result.value){
                                        window.location = "estudiantes";
                                    }
                                });
                                </script>';
                } else {
                    echo '<script>

        swal({
            type: "error",
            title: "¡El Estudiante no ha sido Agregado a la Materia por que ya se encuentra en la base de datos!",
            showConfirmButton: true,
            confirmButtonText: "Cerrar",
            closeOnConfirm: false

        }).then((result)=>{
            if(result.value){
                window.location = "estudiantes";
            }
        });
        </script>';
                }
            } else {
                echo '<script>
        swal({
            type: "error",
            title: "¡INGRESE DATOS NUMERICOS Y LETRAS, <br> deben estar sin caracteres especiales ni puntos!",
            showConfirmButton: true,
            confirmButtonText: "Cerrar",
            closeOnConfirm: false

        }).then((result)=>{
            if(result.value){
                window.location = "estudiantes";
            }
        });
        </script>';
            }
        }
    }



 /*=============================================
	EDITAR REGISTRO DE NOTAS
	=============================================*/
    
    public static function CtreditarInscribir()
    {
        $datos1=$_POST["editaridmateria"];
        if (isset($_POST["editaridest"])) {
       
            if (preg_match('/^[0-9 ]+$/', $_POST["editarnota1"]) &&
                preg_match('/^[0-9 ]+$/', $_POST["editarnota2"]) &&
                preg_match('/^[0-9 ]+$/', $_POST["editarnota3"]) 
                ){
                $tabla = "toma";

                $datos1=$_POST["editaridmateria"];
               
                $datos = array(
                    "codest" => $_POST["editaridest"],
                    "cod_mat" => $_POST["editaridmateria"],
                    "notaf1" => $_POST["editarnota1"],
                    "notaf2" => $_POST["editarnota2"],
                    "notaf3" => $_POST["editarnota3"],
                    "observacion" => $_POST["editarobservaciones"],
                    "notafinal" => $_POST["editarnotafinal"],
                );
                 

                // var materia ='.$datos2.';          
                echo'<script>      
                                      
                var idmaterias ='.$datos1.';
                

                </script>';



                $respuesta = ModeloEstudiantes::mdleditarinscribirEstudiante($tabla, $datos);
                
                if ($respuesta === "ok") {
                    echo '<script>
                                swal({
                                    type: "success",
                                    title: "EL REGISTRO A SIDO EDITADO CORRECTAMENTE",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar",
                                    closeOnConfirm: false

                                }).then((result)=>{

                                    if(result.value){
                                        var idmaterias ='.$datos1.';
                                      
                                        window.location ="index.php?ruta=inscribir&idmaterias="+idmaterias;

                                     }
                                });
                                </script>';
                } else {
                    echo '<script>

        swal({
            type: "error",
            title: "¡EL REGISTRO TIENE FALLAS EN EL FORMULARIO NO SE PUEDE EDITAR!",
            showConfirmButton: true,
            confirmButtonText: "Cerrar",
            closeOnConfirm: false

        }).then((result)=>{
            if(result.value){
                 var idmaterias ='.$datos1.';
                window.location = "index.php?ruta=inscribir&idmaterias="+idmaterias;

            }
        });
        </script>';
                }
            } else {
                echo '<script>
        swal({
            type: "error",
            title: "¡INGRESE DATOS NUMERICOS Y LETRAS A LOS CAMPOS CORRESPONDIENTES, <br> deben estar sin caracteres especiales ni puntos!",
            showConfirmButton: true,
            confirmButtonText: "Cerrar",
            closeOnConfirm: false

        }).then((result)=>{
            if(result.value){
                 var idmaterias ='.$datos1.';
                 
                 window.location = "index.php?ruta=inscribir&idmaterias="+idmaterias;

            }
        });
        </script>';
            }
        }
    }

      /*=============================================
	BORRAR REGISTRO DE ESTUDIANTE EN MATERIA
	=============================================*/
    
	static public function ctrBorrarregistroenmateria(){

		if(isset($_GET["estudianteid"])&&isset($_GET["materiaid"])){
            
			$tabla ="toma";
            $datos = $_GET["estudianteid"];
            $datos1 = $_GET["materiaid"];

            
            echo'<script>      
            var idestudiantito ='.$_GET["estudianteid"].';
              </script>';
			$respuesta = Modeloestudiantes::mdlBorrarregistro($tabla, $datos,$datos1);
                                            
            if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El Registro de notas ha sido Borrado",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then((result) => {
								if (result.value) {
                                    var idestudiantito ='.$datos.';
                                    window.location = "index.php?ruta=boleta&idestudiantito="+idestudiantito;
								}
							})
				</script>';
			}			
		}
    }
  /*=============================================
	CREAR DOCUMENTO DE GALERIA 
	=============================================*/
   
    static public function CtrCreardocumento()
    {
        
        if (isset($_POST["ntitulo"])) {
            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["ntitulo"]) &&
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["ndescripcion"])
            ) {

                $regresa= $_POST["idesgaleria"];
                /*validar imagen */
                $ruta = "";
                if (isset($_FILES["nfotog"]["tmp_name"])) {

                    if ($_FILES["nfotog"]["type"] == "application/pdf") {
                        $directorio = "vistas/img/estudiantes/" . $_POST["rgisgaleria"];

                  if (!file_exists($directorio)) {
                      mkdir($directorio, 0755);
                   }
                        /*=============================================
                        GUARDAMOS EL PDF EN EL DIRECTORIO
                        =============================================*/
                        $aleatorio = mt_rand(100, 999999);
                        $ruta = "vistas/img/estudiantes/" . $_POST["rgisgaleria"] . "/" . $aleatorio . ".pdf";
                            $resultado =@move_uploaded_file($_FILES["nfotog"]["tmp_name"],$ruta);
                        
                    } else {
                        list($ancho, $alto) = getimagesize($_FILES["nfotog"]["tmp_name"]);
                        $nuevoAncho = 500;
                        $nuevoAlto = 500;
                        /* creamos el directorio a guardar la foto del remitente*/
                        $directorio = "vistas/img/estudiantes/" . $_POST["rgisgaleria"];
                        if (!file_exists($directorio)) {
                        mkdir($directorio, 0755);
                        }
                        /* de acuerdo al tipo de imagen aplicamos las funciones por defecto de php*/
                        if ($_FILES["nfotog"]["type"] == "image/jpeg") {

                            /*=============================================
                        GUARDAMOS LA IMAGEN EN EL DIRECTORIO
                        =============================================*/

                            $aleatorio = mt_rand(100, 999999);

                            $ruta = "vistas/img/estudiantes/" . $_POST["rgisgaleria"] . "/" . $aleatorio . ".jpg";

                            $origen = imagecreatefromjpeg($_FILES["nfotog"]["tmp_name"]);

                            $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                            imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                            imagejpeg($destino, $ruta);
                        }

                        if ($_FILES["nfotog"]["type"] == "image/png") {

                            /*=============================================
                        GUARDAMOS LA IMAGEN EN EL DIRECTORIO
                        =============================================*/

                            $aleatorio = mt_rand(100, 999999);

                            $ruta = "vistas/img/estudiantes/" . $_POST["rgisgaleria"] . "/" . $aleatorio . ".png";

                            $origen = imagecreatefrompng($_FILES["nfotog"]["tmp_name"]);

                            $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                            imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                            imagepng($destino, $ruta);
                        }
                    }
                }

                $tabla = "documentos";
                $datos = array(
                    "tipod" => $_POST["ntipo"],
                    "codest" => $_POST["idesgaleria"],
                    "tituloar" => $_POST["ntitulo"],
                    "descripar" => $_POST["ndescripcion"],
                    "docgaleria" => $ruta,
                );
                $regresa=$_POST["idesgaleria"];
                echo'<script>      
                var idestgaleria ='.$_POST["idesgaleria"].';
                  </script>';

                $respuesta = Modeloestudiantes::mdlingresardocumento($tabla,$datos);

                if ($respuesta === "ok") {
                    echo '<script>
                                swal({
                                    type: "success",
                                    title: "EL DOCUMENTO FUE CREADO CORRECTAMENTE",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar",
                                    closeOnConfirm: false

                                }).then((result)=>{

                                    if(result.value){
                                        var idestgaleria ='.$regresa.';
                                        window.location = "index.php?ruta=galeria&idestgaleria="+idestgaleria;
                                    }
                                });
                                </script>';
                } else {
                    echo '<script>

        swal({
            type: "error",
            title: "¡El Documento no ha sido guardado correctamente!",
            showConfirmButton: true,
            confirmButtonText: "Cerrar",
            closeOnConfirm: false

        }).then((result)=>{
            if(result.value){
                var idestgaleria ='.$regresa.';
                window.location = "index.php?ruta=galeria&idestgaleria="+idestgaleria;
            }
        });
        </script>';
                }
            } else {
                echo '<script>

        swal({
            type: "error",
            title: "¡El Formulario no esta completo o tiene caracteres especiales!",
            showConfirmButton: true,
            confirmButtonText: "Cerrar",
            closeOnConfirm: false

        }).then((result)=>{
            if(result.value){
                var idestgaleria ='.$regresa.';
                window.location = "index.php?ruta=galeria&idestgaleria="+idestgaleria;
            }
        });
        </script>';
            }
        }
    }
    
   /*=============================================
	MOSTRAR DOCUMENTOS DE GALERIA
	=============================================*/
    static public function ctrMostrargaleria($codigo)
    {
        $tabla = "documentos";
        $respuesta = ModeloEstudiantes::mdlMostrargaleria($tabla,$codigo);
        return $respuesta;
    }
    
/*=============================================
	MOSTRAR DOCUMENTOS DE GALERIA AJAX
	=============================================*/
    static public function ctrMostrargaleriaajax($valor,$codigo)
    {
        $tabla = "documentos";
        $respuesta = ModeloEstudiantes::mdlMostrargaleriaajax($tabla,$codigo,$valor);
        return $respuesta;
    }
    /*=============================================
	EDITAR DOCUMENTO DE GALERIA
	=============================================*/
    static public function CtrEditardocumento()
    {

        $regresas=$_POST["editaridesgaleria"];
        if (isset($_POST["editarntitulo"])) {
                   if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarntitulo"]) &&
                    preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarndescripcion"]) 
                    ) {
                   /*=============================================
				   VALIDAR IMAGEN
				  =============================================*/
                   $ruta = $_POST["Documentoactual"];
                   if (isset($_FILES["editarnfotog"]["tmp_name"]) && !empty($_FILES["editarnfotog"]["tmp_name"])) {
                     /*=============================================
						PREGUNTAMOS SI EL ARCHIVO ES UN PDF 
						=============================================*/
                    if ($_FILES["editarnfotog"]["type"] == "application/pdf") {

                        $directorio = "vistas/img/estudiantes/" . $_POST["editarrgisgaleria"];

                            if (!empty($_POST["Documentoactual"])) {
                                     unlink($_POST["Documentoactual"]);
                            } else {
                                if (!file_exists($directorio )) {
                                    mkdir($directorio, 0755);
                                 }
                            }
                            /*=============================================
                            GUARDAMOS EL PDF EN EL DIRECTORIO
                              =============================================*/
                                $aleatorio = mt_rand(100, 999999);
                                $ruta = "vistas/img/estudiantes/" . $_POST["editarrgisgaleria"] . "/" . $aleatorio . ".pdf";
                                $resultado =@move_uploaded_file($_FILES["editarnfotog"]["tmp_name"],$ruta);
                                
                                           
                   } else {
                                    list($ancho, $alto) = getimagesize($_FILES["editarnfotog"]["tmp_name"]);

                                    $nuevoAncho = 500;
                                    $nuevoAlto = 500;
                    /*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/
                    $directorio = "vistas/img/estudiantes/" . $_POST["editarrgisgaleria"];

                    /*=============================================
					PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=============================================*/

                    if (!empty($_POST["Documentoactual"])) {
                        unlink($_POST["Documentoactual"]);
                    } else {
                        if (!file_exists($directorio )) {
                            mkdir($directorio, 0755);
                         }
                    }
                    /*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

                    if ($_FILES["editarnfotog"]["type"] == "image/jpeg") {
                        /*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/
                        $aleatorio = mt_rand(100, 999);

                        $ruta = "vistas/img/estudiantes/" . $_POST["editarrgisgaleria"] . "/" . $aleatorio . ".jpg";

                        $origen = imagecreatefromjpeg($_FILES["editarnfotog"]["tmp_name"]);

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagejpeg($destino, $ruta);
                    }

                    if ($_FILES["editarnfotog"]["type"] == "image/png") {

                        /*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

                        $aleatorio = mt_rand(100, 999);

                        $ruta = "vistas/img/estudiantes/" . $_POST["editarrgisgaleria"] . "/" . $aleatorio . ".png";

                        $origen = imagecreatefrompng($_FILES["editarnfotog"]["tmp_name"]);

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagepng($destino, $ruta);
                    }
                }
            }

            $tabla = "documentos";
            $datos = array(
                "codoc" => $_POST["edidocument"],
                "tipod" => $_POST["editarntipo"],
                "codest" => $_POST["editaridesgaleria"],
                "tituloar" => $_POST["editarntitulo"],
                "descripar" => $_POST["editarndescripcion"],
                "docgaleria" => $ruta,
            );
            $regresa=$_POST["edidocument"];
            $regresas=$_POST["editaridesgaleria"];
            echo'<script>      
            var idestgaleria ='.$_POST["edidocument"].';
              </script>';
           
                $respuesta =  Modeloestudiantes::mdleditargaleria($tabla,$datos,$regresa);

                if ($respuesta === "ok") {
                    echo '<script>
                                swal({
                                    type: "success",
                                    title: "EL DOCUMENTO FUE EDITADO CORRECTAMENTE",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar",
                                    closeOnConfirm: false

                                }).then((result)=>{

                                    if(result.value){
                                        var idestgaleria ='.$regresas.';
                                        window.location = "index.php?ruta=galeria&idestgaleria="+idestgaleria;
                                    }
                                });
                                </script>';
                } else {
                    echo '<script>

        swal({
            type: "error",
            title: "¡El Documento no ha sido editado correctamente!",
            showConfirmButton: true,
            confirmButtonText: "Cerrar",
            closeOnConfirm: false

        }).then((result)=>{
            if(result.value){
                var idestgaleria ='.$regresas.';
                window.location = "index.php?ruta=galeria&idestgaleria="+idestgaleria;
            }
        });
        </script>';
                }
            } else {
                echo '<script>

        swal({
            type: "error",
            title: "¡El Formulario no esta completo o tiene caracteres especiales!",
            showConfirmButton: true,
            confirmButtonText: "Cerrar",
            closeOnConfirm: false

        }).then((result)=>{
            if(result.value){
                var idestgaleria ='.$regresas.';
                window.location = "index.php?ruta=galeria&idestgaleria="+idestgaleria;
            }
        });
        </script>';
            }
        }
    }

    
    /*=============================================
	BORRAR DOCUMENTO DE GALERIA
	=============================================*/
    static public function ctrBorrardocumento()
    {

        if (isset($_GET["elidocumentog"])) {

            $tabla = "documentos";
            $datos = $_GET["elidocumentog"];
            

            $idestudiante=$_GET["eliestudianteg"];

            if ($_GET["elidocg"] != "") {
                unlink($_GET["elidocg"]);
                //rmdir('vistas/img/cartas/Interna/' . $_GET["remitente"]);
            }

            $respuesta =  Modeloestudiantes::mdlBorrardocumento($tabla, $datos);


            if ($respuesta == "ok") {

                echo '<script>

				swal({
					  type: "success",
					  title: "El documento ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then((result) => {
								if (result.value) {
                                    var idestgaleria ='.$idestudiante.';
                                    window.location = "index.php?ruta=galeria&idestgaleria="+idestgaleria;
								}
							})
				</script>';
            }
        }
    }

}
