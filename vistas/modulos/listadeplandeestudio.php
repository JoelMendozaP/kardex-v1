<div class="content-wrapper">

  <section class="content-header">
    <h1>
      <b> PLAN DE ESTUDIOS CON MATERIAS</b> 
      <small>Panel de Control</small>
    </h1>

    <ol class="breadcrumb">
      <li><a href="plandeestudios"><i class="fa fa-dashboard"></i> Volver Atrar </a></li>
      <li class="active">Tablero</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
  <?php
include("conexionmysqli.php");
      if (isset($_GET["codigoplane"]) ) {
        
        $idpl = $_GET["codigoplane"];
       
        $query = "SELECT * FROM plandeestudio  WHERE codpe = $idpl ";
        $resultado = $conexion->query($query);
        while ($row = $resultado->fetch_assoc()) {
          $fechai = $row['fech_ini'];
          $fechaf = $row['fech_fin'];
          $nombrepl = $row["nombrepl"];
          $men = $row["mencion"];
          $fechaorigen = $row["fechacrea"];
        }
        
      } else{

        if (isset($_GET["codplanest"])){

            $idpl = $_GET["codplanest"];
            $query = "SELECT * FROM plandeestudio  WHERE codpe = $idpl ";
            $resultado = $conexion->query($query);
            while ($row = $resultado->fetch_assoc()) {
              $fechai = $row['fech_ini'];
              $fechaf = $row['fech_fin'];
              $nombrepl = $row["nombrepl"];
              $men = $row["mencion"];
              $fechaorigen = $row["fechacrea"];
            }
        }
      }
      $idpl;
     
      
      ?>
    <!-- Default box -->
    <div class="box bg-gray disabled" >
      <?php
       echo '<button class="btn btn-danger btn-lg btnlistadeplan" codigoplans="'.$idpl.'"> <i class="fa fa-print"> PDF PLAN DE ESTUDIO</i>
        </button>'?>
        <br>
      </div>
<?php
      echo ' 
<div class="col-md-12">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user">
            
            <div class="widget-user-header bg-aqua-active">
              <h3 class="widget-user-username"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">' .$nombrepl .'</font></font></h3>
              <h5 class="widget-user-desc"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Nombre Del Plan De Estudio</font></font></h5>
            </div>
            <div class="widget-user-image">
              <img class="img-circle" src="vistas/img/usuarios/plane.jpg" alt="Avatar de usuario">
            </div>
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-3 border-right">
                  <div class="description-block">
                  
                    <h5 class="description-header text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">' .$men.'</font></font></h5>
                    <span class="description-text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">MENCION</font></font></span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 border-right">
                  <div class="description-block">
                    <h5 class="description-header"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">' .$fechaorigen .'</font></font></h5>
                    <span class="description-text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">FECHA DE CREACION</font></font></span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <div class="col-sm-3 border-right">
                  <div class="description-block">
                  
                    <h5 class="description-header"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">' .$fechai .'</font></font></h5>
                    <span class="description-text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">FECHA INICIAL</font></font></span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3">
                  <div class="description-block">
                    <h5 class="description-header"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">' .$fechaf.'</font></font></h5>
                    <span class="description-text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">FECHA FINAL</font></font></span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
          </div>
          <!-- /.widget-user -->
        </div>
      <div class="box-body">';

      ?>
      <?php
      if ($_SESSION["esta_superu"] == 1 && $_SESSION["perfil"] == "Administrador") {
        
        
       echo'<table class="table table-bordered table-striped dt-responsive tablas" style="width:100%">
        <thead>
          <tr>
          <th style="width: 1px">#NRO</th>
            <th style="width: 10px">SIGLA</th>
            <th style="width: 10px">NOMBRE</th>
            <th style="width: 8px">GESTION</th>
            <th style="width: 5px">TIPO</th>
            <th style="width: 30px">ACCIONES</th>
          </tr>
        </thead>
            
        <tbody>';

            $item = null;
            $valor = null;

            $listaplandeestudio = Controladorplandeestudio::ctrMostrarlistaplan($item, $valor, $idpl);
            
            foreach ($listaplandeestudio as $key => $value) {

              echo '<tr>
              <td>' . ($key + 1) . '</td>
              <td>' . $value["sigla"] . '</td>
              <td>' . $value["nombre_m"] . '</td>  
              <td>' . $value["gestion"] . '</td>
              <td>' . $value["tipo"] . '</td>
              <td>
                  <div class="btn-group">
                <button class="btn btn-danger  btnEliminarmateriaplan"  codplanest="'.$idpl.'"  idmateria="' . $value["cod_mat"] . '" > <i class="fa fa-times"></i></button>
                </div>
        
              </td>
            </tr>';
            }
          
         echo'
        </tbody>

      </table>';
   
      
      }
      else{

        
echo'<table class="table table-bordered table-striped dt-responsive tablas" style="width:100%">
<thead>
  <tr>
  <th style="width: 1px">#NRO</th>
    <th style="width: 10px">SIGLA</th>
    <th style="width: 10px">NOMBRE</th>
    <th style="width: 8px">GESTION</th>
    <th style="width: 5px">TIPO</th>
   
  </tr>
</thead>
    
<tbody>';

    $item = null;
    $valor = null;

    $listaplandeestudio = Controladorplandeestudio::ctrMostrarlistaplan($item, $valor, $idpl);
    
    foreach ($listaplandeestudio as $key => $value) {

      echo '<tr>
      <td>' . ($key + 1) . '</td>
      <td>' . $value["sigla"] . '</td>
      <td>' . $value["nombre_m"] . '</td>  
      <td>' . $value["gestion"] . '</td>
      <td>' . $value["tipo"] . '</td>
      
    </tr>';
    }
  
 echo'
</tbody>

</table>';


      }
      ?>

      </div>
      <!-- /.box-footer-->
    </div>
    <!-- /.box -->
  </section>
  <!-- /.content -->
</div>


<!--   BORRAR MATERIA -->
<?php
$borrarplandeestudiomateria = new Controladorplandeestudio();
$borrarplandeestudiomateria->ctrBorrarplandeestudioenmateria();
?>

