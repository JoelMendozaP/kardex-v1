
<?php

class Controladorproducto
{
    
    public static function CtrCrearcomida()
    {

        if (isset($_POST["precio"])) {
            if (
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["precio"]) &&
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nombreprod"]) &&
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["Proveedor"]) &&
                preg_match('/^[Z0-9 ]+$/', $_POST["Cantidad"])
            ) {
                /*validar imagen */
                $ruta = "";
                if (isset($_FILES["nuevafotoP"]["tmp_name"])) {
                    list($ancho, $alto) = getimagesize($_FILES["nuevafotoP"]["tmp_name"]);

                    $nuevoAncho = 500;
                    $nuevoAlto = 500;

                    /* creamos el directorio a guardar la foto del usuario*/

                    $directorio = "Views/img/productos/" . $_POST["nombreprod"];
                    mkdir($directorio, 0755);
                    /* de acuerdo al tipo de imagen aplicamos las funciones por defecto de php*/
                    if ($_FILES["nuevafotoP"]["type"] == "image/jpeg") {

                        /*=============================================
                    GUARDAMOS LA IMAGEN EN EL DIRECTORIO
                    =============================================*/

                        $aleatorio = mt_rand(100, 999);

                        $ruta = "Views/img/productos/" . $_POST["nombreprod"] . "/" . $aleatorio . ".jpg";

                        $origen = imagecreatefromjpeg($_FILES["nuevafotoP"]["tmp_name"]);

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagejpeg($destino, $ruta);
                    }

                    if ($_FILES["nuevafotoP"]["type"] == "image/png") {

                        /*=============================================
                    GUARDAMOS LA IMAGEN EN EL DIRECTORIO
                    =============================================*/

                        $aleatorio = mt_rand(100, 999);

                        $ruta = "Views/img/productos/" . $_POST["nombreprod"] . "/" . $aleatorio . ".png";

                        $origen = imagecreatefrompng($_FILES["nuevafotoP"]["tmp_name"]);

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagepng($destino, $ruta);
                    }
                }


                $tabla2 = "stock";
                $datos2 = array(
                    "Cantidad" => $_POST["Cantidad"],
                    "Proveedor" => $_POST["Proveedor"],
                    "Fecha_Compraul" => $_POST["ultimacom"]
                );

                $tabla = "producto";
                $datos = array(
                    "Nom_Prod" => $_POST["nombreprod"],
                    "Precio_Venta" => $_POST["precio"],
                    "Precio_Compra" => $_POST["precioC"],
                    "Tipo" => $_POST["Nuevotipo"]
                );


                $tabla1 = "comida";
                $datos1 = array(
                    "Ingredientes" => $_POST["ingredientes"],
                    "FotoCo" => $ruta
                );

                $respuesta = Modeloproducto::mdlIngresarcomidatotal($tabla, $datos, $tabla1, $datos1, $tabla2, $datos2);

                echo "<script>";
                echo "alert('";
                echo  $respuesta;
                echo "')</script>";

                if ($respuesta === "ok") {
                    echo '<script>
                                swal({
                                    type: "success",
                                    title: "EL PRODUCTO A SIDO GUARDADO CORRECTAMENTE",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar",
                                    closeOnConfirm: false

                                }).then((result)=>{

                                    if(result.value){
                                        window.location = "productos";
                                    }
                                });
                                </script>';
                } else {
                    echo '<script>

        swal({
            type: "error",
            title: "¡El Producto no ha sido guardado correctamente!",
            showConfirmButton: true,
            confirmButtonText: "Cerrar",
            closeOnConfirm: false

        }).then((result)=>{
            if(result.value){
                window.location = "productos";
            }
        });
        </script>';
                }
            } else {
                echo '<script>

        swal({
            type: "error",
            title: "¡El Formulario tiene datos erroneos verifique e Intente Nuevamente!",
            showConfirmButton: true,
            confirmButtonText: "Cerrar",
            closeOnConfirm: false

        }).then((result)=>{
            if(result.value){
                window.location = "productos";
            }
        });
        </script>';
            }
        }
    }



    public static function CtrCrearobjeto()
    {

        if (isset($_POST["PrecioVenta"])) {
            if (
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nombreo"]) // &&
                // preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["ProveedorO"]) &&
                // preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["color"]) &&
                //    preg_match('/^[Z0-9 ]+$/', $_POST["Cantidad"]) &&
                //  preg_match('/^[Z0-9 ]+$/', $_POST["PrecioVenta"]) &&
                //    preg_match('/^[Z0-9 ]+$/', $_POST["PrecioFlete"]) &&
                //     preg_match('/^[Z0-9 ]+$/', $_POST["Precio_De_Reposicion"])
            ) {

                /*validar imagen */
                $ruta = "";
                if (isset($_FILES["nuevafotoO"]["tmp_name"])) {
                    list($ancho, $alto) = getimagesize($_FILES["nuevafotoO"]["tmp_name"]);

                    $nuevoAncho = 500;
                    $nuevoAlto = 500;

                    /* creamos el directorio a guardar la foto del usuario*/

                    $directorio = "Views/img/objetos_piscina/".$_POST["nombreo"];
                    mkdir($directorio, 0755);
                    /* de acuerdo al tipo de imagen aplicamos las funciones por defecto de php*/
                    if ($_FILES["nuevafotoO"]["type"] == "image/jpeg") {

                        /*=============================================
      GUARDAMOS LA IMAGEN EN EL DIRECTORIO
      =============================================*/

                        $aleatorio = mt_rand(100, 999);

                        $ruta = "Views/img/objetos_piscina/" . $_POST["nombreo"]."/" . $aleatorio . ".jpg";

                        $origen = imagecreatefromjpeg($_FILES["nuevafotoO"]["tmp_name"]);

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagejpeg($destino, $ruta);
                    }

                    if ($_FILES["nuevafotoO"]["type"] == "image/png") {

                        /*=============================================
      GUARDAMOS LA IMAGEN EN EL DIRECTORIO
      =============================================*/

                        $aleatorio = mt_rand(100, 999);

                        $ruta = "Views/img/objetos_piscina/" . $_POST["nombreo"]."/" . $aleatorio . ".png";

                        $origen = imagecreatefrompng($_FILES["nuevafotoO"]["tmp_name"]);

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagepng($destino, $ruta);
                    }
                }





                $tabla2 = "stock";
                $datos2 = array(
                    "Cantidad" => $_POST["CantidadO"],
                    "Proveedor" => $_POST["ProveedorO"],
                    "Fecha_Compraul" => $_POST["ultimacomO"]
                );

                $tabla = "producto";
                $datos = array(
                    "Nom_Prod" => $_POST["nombreo"],
                    "Precio_Venta" => $_POST["PrecioVenta"],
                    "Precio_Compra" => $_POST["PrecioCompra"],
                    "Tipo" => $_POST["NuevotipoO"]
                );


                $tabla1 = "objeto_piscina";

                $datos1 = array(
                    "Talla" => $_POST["talla"],
                    "Color" => $_POST["color"],
                    "Marca" => $_POST["marca"],
                    "Estado" => $_POST["EstadoO"],
                    "Costo_Reposicion" => $_POST["Precio_De_Reposicion"],
                    "Costo_Flete" => $_POST["PrecioFlete"],
                    "FotoO" => $ruta);

                $respuesta = Modeloproducto::mdlIngresarobjetototal($tabla, $datos, $tabla1, $datos1, $tabla2, $datos2);

                echo "<script>";
                echo "alert('";
                echo  $respuesta;
                echo "')</script>";

                if ($respuesta === "ok") {
                    echo '<script>
                                swal({
                                    type: "success",
                                    title: "EL OBJETO A SIDO GUARDADO CORRECTAMENTE",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar",
                                    closeOnConfirm: false

                                }).then((result)=>{

                                    if(result.value){
                                        window.location = "productos";
                                    }
                                });
                                </script>';
                } else {
                    echo '<script>

        swal({
            type: "error",
            title: "¡El Objeto no ha sido guardado correctamente!",
            showConfirmButton: true,
            confirmButtonText: "Cerrar",
            closeOnConfirm: false

        }).then((result)=>{
            if(result.value){
                window.location = "productos";
            }
        });
        </script>';
                }
            } else {
                echo '<script>

        swal({
            type: "error",
            title: "¡El Formulario tiene datos erroneos verifique e Intente Nuevamente!",
            showConfirmButton: true,
            confirmButtonText: "Cerrar",
            closeOnConfirm: false

        }).then((result)=>{
            if(result.value){
                window.location = "productos";
            }
        });
        </script>';
            }
        }
    }

    static public function ctrMostrarcomida($item, $valor)
    {
        $tabla = "stock";
        $tabla1 = "producto";
        $tabla2 = "comida";
        $respuesta = Modeloproducto::MdlMostrarcomida($tabla, $tabla1,$tabla2, $item, $valor);
        return $respuesta;
    }
    static public function ctrMostrarobjeto($item, $valor)
    {
        $tabla = "stock";
        $tabla1 = "producto";
        $tabla2 = "objeto_piscina";
        $respuesta = Modeloproducto::MdlMostrarobjeto($tabla, $tabla1,$tabla2,$item, $valor);
        return $respuesta;
    }
    
}
