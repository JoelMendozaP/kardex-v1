
<div class="content-wrapper">


<section class="content-header">
  
  <h1>
    
    Boleta
    
    <small>Panel de Control</small>
  
  </h1>

  <ol class="breadcrumb">
    
    <li><a href="estudiantes"><i class="fa fa-dashboard"></i> VOLVER </a></li>
    
    <li class="active">Tablero</li>
  
  </ol>

</section>
 <!-- Main content -->
 <section class="content" >

<!-- Default box -->
<div class="box"  style="background: skyblue">
  <div class="box-header with-border">
      <?php
      if(isset($_GET["idestudiantito"])){
        $historialestudiante=$_GET["idestudiantito"];
       echo '<button class="btn bg-red-gradient btn-lg btnboleta" idestudiantito="'.$historialestudiante.'"> <i class="fa fa-print"> GENERAR BOLETA</i>
        </button>';
      }

      echo '<button class="btn space bg-blue-gradient btn-lg btngaleriaest" idestgaleria="'.$historialestudiante.'"> <i class="fa fa-paste"> DOCUMENTOS</i>
        </button>';
        ?>
        <br>
      </div>
    <br>
  </div>

  <div class="icono-nosotros">
      
     <?php
         if(isset($_GET["idestudiantito"])){

        
        include("conexionmysqli.php");
        $id = $_GET["idestudiantito"];
        
        $query = "SELECT * FROM estudiante where codest = $id";

        $resultado = $conexion->query($query);

        while ($row = $resultado->fetch_assoc()) {
      
               $nom=$row['nombre']; 
               $ap=$row["ap_paterno"];
               $am=$row["ap_materno"];
               $ci=$row["ci"];
               $estado=$row["estado"];
               $email=$row["email"];
               $reg= $row["reg_univ"];

               ?>
        <?php
        }   ?>
    <?php } ?>
       
    <?php    

      echo  '<tr> 
      <fieldset id="sle">
      <legend style="background:#0f4c75; color:white; ">Datos del estudiante</legend>
      <p><label>Estudiante :  </label>
      <b>'.$nom." - ".$ap.' - '.$am.'  '.'</b>  </p> 
      <p> <label> Ci :</label> <b>'.$ci.'</b> </p>       
       </fieldset>
       </tr>';

       echo  '<tr> 
      <fieldset id="sle">
      <legend style="background:#0f4c75; color:white; "> Contaduria Publica - UMSA </legend>
      <p><label>Registro Universitario :  </label>
      <b>'.' '.$reg.'</b>  </p> 
      <p class="icono-nosotros"> <label> Estado: '.$estado.' </label>    <label> Email : '.$email.' </label>    </p>     
          
       </fieldset>
       </tr>';



       if ($_SESSION["esta_superu"] == 1 && $_SESSION["perfil"] == "Administrador") {

  echo'
  </div>
         

  <div class="box-body">

    <table class="table table-bordered table-striped dt-responsive tablas" style="width:100%; background:lightcoral; ">
      <thead>
        <tr>
          <th style="width: 1px">#</th>
          <th style="width: 10px">Sigla</th>
          <th style="width: 10px">Materia</th>
          <th style="width: 5px">Nota Final</th>
          <th style="width: 8px">Observacion</th>
          <th style="width: 8px">Periodo</th>
          <th style="width: 5px">Gestion</th>
          <th style="width: 5px">Docente</th>
          <th style="width: 30px">Acciones</th>
        </tr>
      </thead>';
           }else{
echo' 
</div>
       

<div class="box-body">

  <table class="table table-bordered table-striped dt-responsive tablas" style="width:100%; background:lightcoral; ">
    <thead>
      <tr>
        <th style="width: 1px">#</th>
        <th style="width: 10px">Sigla</th>
        <th style="width: 10px">Materia</th>
        <th style="width: 5px">Nota Final</th>
        <th style="width: 8px">Observacion</th>
        <th style="width: 8px">Periodo</th>
        <th style="width: 5px">Gestion</th>
        <th style="width: 5px">Docente</th>
        
      </tr>
    </thead>';

           }
           ?>
      
      <tbody>

      <?php

if(isset($_GET["idestudiantito"])){


$id = $_GET["idestudiantito"];
$item= null;
$valor = null;

$materia = ControladorEstudiantes::ctrMostrarboleta($item, $valor,$id);
$materia2=$materia;
foreach ($materia as $key => $value) {
  
  echo '<tr>
<td>' . ($key + 1) . '</td>
<td>' . $value["sigla"] . '</td>
<td>' . $value["nombre_m"] . '</td>    
<td>' . $value["notafinal"] . '</td>                
<td>' . $value["observacion"] . '</td>
<td>' . $value["fecha_curso"] . '</td>
<td>' . $value["gestion"] . '</td>
<td>' . $value["docente"] . '</td>';
if ($_SESSION["esta_superu"] == 1 && $_SESSION["perfil"] == "Administrador") {

echo'<td>

     
        
      <div class="btn-group">
      <button class="btn btn-danger  btneliminardeboleta" estudianteid="' . $id . '"  materiaid="' . $value["cod_mat"] . '" > <i class="fa fa-times"></i></button>
      </div>
     
      </td>';
    }
      echo'
      </tr>';
      }
      }
      ?>
</tbody>
    </table>
  </div>
  <!-- /.box-footer-->
</div>
<!-- /.box -->
</section>
<!-- /.content -->
</div>




<!-- /.MODAL EDITAR MATERIA -->

<div class="modal modal-info fade" id="ModalEditarmateria" role="dialog">
<div class="modal-dialog">
<div class="modal-content">
  <form role="form" method="POST" enctype="multipart/form-data">
    <!-- cabeza del modal-->
    <div class="modal-header">

      <button type="button" class="close" data-dismiss="modal" aria-label="Close">

        <span aria-hidden="true">&times;</span></button>

      <h4 class="modal-title">Editar Materia</h4>

    </div>
    <!-- cuerpo del modal -->
    <div class="modal-body">

      <div class="box-body">


        <!-- Sigla  -->
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-university"> </i></span>
            <input type="text" class="form-control input-lg" style="color: black"   value="" name="editarsigla" id="editarsigla" required>
          </div>
        </div>


        <!-- Nombre de Materia  -->
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-users"> </i></span>
            <input type="text" class="form-control input-lg" style="color: black"  value="" name="editarnombrem" id="editarnombrem" required>
          </div>
        </div>


        <!-- Nro de folio  -->
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-file-o"> </i></span>
            <input type="text" class="form-control input-lg" style="color: black"  value="" name="editarfolio" id="editarfolio" required>
          </div>
        </div>

        <!-- Libro  -->
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-file"> </i></span>
            <input type="text" class="form-control input-lg" style="color: black"  value="" name="editarlibro" id="editarlibro" required>
          </div>
        </div>

        <!-- gestion del curso -->
        <div class="form-group">
          <h4>Gestion de la materia</h4>
          <div class="input-group">

            <h4 class="modal-title"> </h4>
            <span class="input-group-addon"><i class="fa  fa-calendar-plus-o"> </i></span>
            <input type="year" class=" form-control input-lg" value="" name="editargestion" id="editargestion" data-datepicker-color="primary">

          </div>
        </div>

        <!-- etapa de la materia -->
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-calendar-plus-o"> </i></span>
            <select class="form-control input-lg" name="editarestapa">
              <option value="" id="editarestapa"></option>
              <option value=" Primera">Primera</option>
              <option value=" Segunda">Segunda</option>
              <option value=" Curso de Temporada">Curso de Temporada</option>
            </select>
          </div>
        </div>
        <!-- docente  -->
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa fa-calendar-check-o"> </i></span>
            <input type="text" class="form-control input-lg" style="color: black"  value="" name="editardocente" id="editardocente" required>
          </div>
        </div>
      </div>

    </div>
    <!-- /.pie del modal-->

    <div class="modal-footer">

      <button type="button" class="btn 
                        btn-outline pull-left" data-dismiss="modal">Salir</button>

      <button type="submit" class="btn btn-outline">Guardar Cambios</button>

    </div>
    <!-- <?php
    // $editarmateria = new Controladormaterias();
    // $editarmateria->Ctreditarmateria();
    ?> -->

  </form>

</div>

</div>

<!-- /.modal-dialog -->
</div>


  
<?php
            $borrarregistronota = new ControladorEstudiantes();
            $borrarregistronota->ctrBorrarregistroenmateria();
            ?> 
    