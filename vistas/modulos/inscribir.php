<div class="content-wrapper">


  <section class="content-header">

    <h1>

      INSCRITOS DE LA MATERIA 

      <small>Panel de Control</small>

    </h1>

    <ol class="breadcrumb">

      <li><a href="materia"><i class="fa fa-dashboard"></i> VOLVER </a></li>

      <li class="active">Tablero</li>

    </ol>

  </section>

  <!-- Main content -->
  <section class="content">
  <?php
      if (isset($_GET["idmaterias"])) {
        include("conexionmysqli.php");
        $id = $_GET["idmaterias"];
       
        $query = "SELECT * FROM materia where cod_mat = $id";
        $resultado = $conexion->query($query);

        while ($row = $resultado->fetch_assoc()) {
          $sig = $row['sigla'];
          $nom = $row['nombre_m'];
          $fol = $row["folio"];
          $li = $row["libro"];
          $ges = $row["gestion"];
          $tip = $row["tipo"];
          $esta = $row["fecha_curso"];
          $doc = $row["docente"];
      ?>
      <?php
        }
      } ?>
    <!-- Default box -->
    <div class="box" style="background: whitesmoke">
      <?php
       echo '<button class="btn btn-danger btn-lg estudiant" codmateria="'.$id.'"> <i class="fa fa-print"> GENERAR PDF</i>
        </button>'?>
        <br>
      </div>
      
                                    

      <?php

      echo ' <div class="row   icono-nosotros">
        <div class="col-md-3 col-sm-6 col-xs-12 ">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-folder-open-o"></i></span>
            <div class="info-box-content">
            <span class="info-box-text">NOMBRE MATERIA</span>
             <span class="info-box-number">' . $nom . '</span>
              <span class="info-box-text">SIGLA</span>
              <span class="info-box-number">' . $sig . '</span>
            
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12  ">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-files-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Folio</span>
              <span class="info-box-number">' . $fol . '</span>
              <span class="info-box-text">Libro</span>
              <span class="info-box-number">' . $li . '</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12 ">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-calendar-plus-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Gestion</span></span>
              <span class="info-box-number">' . $ges . '</span>
              <span class="info-box-text"> </span>Etapa</span>
              <span class="info-box-number">' . $esta . '</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12 ">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Tipo de Documento</span>
              <span class="info-box-number">' . $tip . '</span>
              <span class="info-box-text">Docente</span>
              <span class="info-box-number">' . $doc . '</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>';
      ?>

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tablas" style="width:100%">
          <thead>
            <tr>
              <th style="width: 1px">#</th>
              <th style="width: 10px">Ci</th>
              <th style="width: 20px">Nombre</th>
              <th style="width: 20px">Ap_Paterno</th>
              <th style="width: 20px">Ap_Materno</th>
              <th style="width: 8px">Genero</th>
              <th style="width: 5px">Matricula</th>
              <th style="width: 5px">Nota Final</th>
              <th style="width: 20px">Observacion</th>
              <th style="width: 30px">Acciones</th>
              
            </tr>
          </thead>

          <tbody>

            <?php

            if (isset($_GET["idmaterias"])) {

              $id = $_GET["idmaterias"];
              $item = null;
              $valor = null;

              $materia = ControladorEstudiantes::ctrMostrarlista($item, $valor, $id);
              
              foreach ($materia as $key => $value) {

                echo '<tr>
                <td>' . ($key + 1) . '</td>
                <td>' . $value["ci"] . '</td>
                <td>' . $value["nombre"] . '</td>    
                <td>' . $value["ap_paterno"] . '</td>                
                <td>' . $value["ap_materno"] . '</td>
                <td>' . $value["genero"] . '</td>
                <td>' . $value["reg_univ"] . '</td>
                <td>' . $value["notafinal"] . '</td>                
                <td>' . $value["observacion"] . '</td>
                <td>
                        <div class="btn-group">
                        
                      <button class="btn btn-warning  btneditarnotas" estudianteidedi="' . $value["codest"] . '" materiaidedi="' .$id. '"  nota1edi="' .$value["notaf1"]. '" nota2edi="' .$value["notaf2"]. '" nota3edi="' .$value["notaf3"]. '" nomedi="' .$nom. '" data-toggle="modal" data-target="#Modaleditarnotas"> <i class="fa fa-pencil"></i></button>
                      
                      
                      ';

                      if ($_SESSION["esta_superu"] == 1 && $_SESSION["perfil"] == "Administrador") {
              
              echo'
                      <button class="btn btn-danger  btneliminardemateria" materiaidlista="' . $id . '"  estudiantelisid="' . $value["codest"] . '"> <i class="fa fa-times"></i></button>';
                      }

                      echo'</div>
                </td>
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



<!-- CLASE MODAL EDITAR INSCRIBIR-->
<div class="modal modal-info fade" id="Modaleditarnotas">
  <div class="modal-dialog">

    <div class="modal-content">
      <form role="form" method="POST" enctype="multipart/form-data">
        <!-- cabeza del modal-->
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Editar registro de estudiante</h4>
        </div>
        <!-- cuerpo del modal -->
        <div class="modal-body">
          <div class="box-body">
          <input type="hidden" id="editaridest" name ="editaridest" value="">
          <input type="hidden" id="editaridmateria" name ="editaridmateria" value="">

              <!-- materia  -->
              <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"> </i></span>         
                <input type="text" class="form-control input-lg" style="color: black" name="namemateria" id="namemateria" readonly>
              </div>
            </div>
            <!-- Notas -->
            <div class="form-group">
              <div class="input-group">
                <p>
                  <i class="fa fa-commenting-o">
                    <input type="text" class="input-lg" style="color: black"  name="editarnota1" id="editarnota1" value="" size="14">
                    <input type="text" class="input-lg" style="color: black"  name="editarnota2" id="editarnota2" value="" size="14">
                    <input type="text" class="input-lg" style="color: black"  name="editarnota3" id="editarnota3" value="" size="14">

                  </i>
                </p>
              </div>
            </div>
                      <!-- Nota final  -->
            <div class="form-group">
              <p>
                <i class="fa fa-commenting">
                  <!-- <input type="text" class="input-lg" style="color: black" placeholder="Nota Final" name="notaf" id="notaf" size="20"> -->
                  <span class="input-lg" style="color: black" name="editarnotaf" id="editarnotaf" size="20">0</span>
                  <input type="hidden" id="editarnotafinal" name ="editarnotafinal" value="">
                </i>  
              </p>

            </div>
            <!-- OBSERVACION-->
            <div class="form-group">
              <p>
                <i class="fa fa-commenting">        
                  <!-- <input type="text" class="input-lg" style="color: black" placeholder="Nota Final" name="notaf" id="notaf" size="20"> -->
                  <span class="input-lg" style="color: black" name="editarobservacion" id="editarobservacion" size="20"></span>
                  <input type="hidden" id="editarobservaciones" name = "editarobservaciones" value="">
                </i>
              </p>

            </div>

          </div>
        </div>
        <!-- /.pie del modal-->
        <div class="modal-footer">
          <button type="button" class="btn 
                        btn-outline pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-outline ">Editar registro</button>
        </div>
        <?php
        $editarinscribir = new ControladorEstudiantes();
        $editarinscribir->CtreditarInscribir();
        ?>
      </form>

    </div>
  </div>

</div>

<!--   BORRAR MATERIA -->
<?php
$borrarestudiantedemateria = new Controladormaterias();
$borrarestudiantedemateria->ctrBorrarestudianteenmateria();
?>

