<?php

require_once "../controladores/estudiantes.controlador.php";
require_once "../modelos/estudiantes.modelo.php";

class tablaboleta{

/*=============================================
TABLA BOLETA
=============================================*/
public function mostrarboleta(){

    if(isset($_GET["idestudiantito"])){

        
        $id = $_GET["idestudiantito"];
        $item= null;
        $valor = null;

    $materia = ControladorEstudiantes::ctrMostrarboleta($item, $valor,$id);

   echo '{
    "data": [
      [
        "1",
        "INF-213",
        "iNGE 1",
        "51",
        "aprobado",
        "Verano"
        "1996",
        "Amilcar Valdez",
        "1",
      ],

      [
        "2",
        "INF-212",
        "iNGE 2",
        "56",
        "aprobado",
        "Verano"
        "1996",
        "Amilcar Valdez",
        "2",
      ]
    ]
  }';



    }
}

}

/*=============================================
TABLA BOLETA
=============================================*/

$activar = new tablaboleta();
$activar -> mostrarboleta();

