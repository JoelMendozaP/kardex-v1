<div class="content-wrapper">


  <section class="content-header">

    <h1>

      <b> HISTORIAL DE LA CARTA EXTERNA </b> 

      <small>Panel de Control</small>

    </h1>

    <ol class="breadcrumb">

      <li><a href="corespexterna"><i class="fa fa-dashboard"></i> VOLVER </a></li>

      <li class="active">Tablero</li>

    </ol>

  </section>

  <!-- Main content -->
  <section class="content">
  <?php

include("conexionmysqli.php");
      if (isset($_GET["idcartahitorialex"])) {
        
        $idhex = $_GET["idcartahitorialex"];
        $idusu= $_GET["codu"];

        

        $query = "SELECT * FROM carta c,recibe r , usuarios u  WHERE c.cod_carta =$idhex and r.cod_carta = $idhex and u.cod_user = $idusu ";
        $resultado = $conexion->query($query);
        while ($row = $resultado->fetch_assoc()) {
          $remitente = $row['remitente'];
          $entidad = $row['entidad'];
          $ruta = $row["ruta"];
          $recib = $row["fecharecib"];
          $ref = $row["referencia"];
          $ci = $row["dnia"];
          $proce = $row["estadoproceso"];
          $pri = $row["prioridad"];
          $nm = $row['nombre'];
            $app = $row['ap_paterno'];
            $apm = $row["ap_materno"];
        }
        
      } 
      
     
      
      ?>
    <!-- Default box -->
    <div class="box bg-gray disabled" >
      <?php
       echo '<button class="btn btn-danger btn-lg btnhistorialexterna" codcartahistorialexterna="'.$idhex.'"> <i class="fa fa-print"> GENERAR PDF</i>
        </button>'?>
        <br>
      </div>

      <?php
      echo ' <div class="row   icono-nosotros">
        <div class="col-md-3 col-sm-6 col-xs-12 ">
          <div class="info-box">
            <span class="info-box-icon bg-navy-active"><i class="fa fa-institution"></i></span>
            <div class="info-box-content">
            <span class="info-box-text">REMITENTE</span>
             <span class="info-box-number">' . $remitente . '</span>
              <span class="info-box-text">ENTIDAD</span>
              <span class="info-box-number">' . $entidad . '</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12  ">
          <div class="info-box">
            <span class="info-box-icon bg-light-blue-active"><i class="fa fa-paste"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">RUTA</span>
              <span class="info-box-number">' . $ruta . '</span>
              <span class="info-box-text">RECIBIDO</span>
              <span class="info-box-number">' . $recib . '</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12 ">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-balance-scale"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">ESTADO</span></span>
              <span class="info-box-number">' . $proce . '</span>
              <span class="info-box-text"> </span>PRIORIDAD</span>
              <span class="info-box-number">' . $pri . '</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12 ">
          <div class="info-box">
            <span class="info-box-icon bg-teal"><i class="fa fa-check-circle"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">ENCARGADO ACTUAL</span>
              <span class="info-box-number">' .$nm .' '.$app.' '.$apm.'</span>
              <span class="info-box-text">REFERENCIA</span>
              <span class="info-box-number">' . $ref . '</span>
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
              <th style="width: 1px">#NRO</th>
              <th style="width: 10px">FECHA PROCESO</th>
              <th style="width: 20px">ENCARGADO</th>
              <th style="width: 20px">ESTADO</th>
              <th style="width: 20px">RUTA</th>
              <th style="width: 8px">OBSERVACION</th>
              
            </tr>
          </thead>

          <tbody>

            <?php

            if (isset($_GET["idcartahitorialex"])) {

              $id = $_GET["idcartahitorialex"];
              $item = null;
              $valor = null;

              $historialc = Controladorcorespinterna::ctrMostrarhistorial($item, $valor, $id);
              
              foreach ($historialc as $key => $value) {

                echo '<tr>
                <td>' . ($key + 1) . '</td>
                <td>' . $value["fech_proc"] . '</td>
                <td>'  . $value["nombre"] . " - " . $value["ap_paterno"] . ' - ' . $value["ap_materno"] . '</td>';
                if ($value["estado"] ==='Inicial'){
                    echo '<td style="with: 10px"><button class="btn bg-purple-active btn-xs">'.$value["estado"].'</button></td>';
                        }else{
                            if ($value["estado"] ==='Primario'){
                             echo '<td style="with: 10px"><button class="btn bg-red-active btn-xs">'.$value["estado"].'</button></td>';
                            }else{
                                if ($value["estado"] ==='Medio'){
                                 echo '<td style="with: 10px"><button class="btn bg-orange-active btn-xs">'.$value["estado"].'</button></td>';
                                 }else{
                                    if ($value["estado"] ==='Final'){
                                        echo '<td style="with: 10px"><button class="btn btn-success btn-xs">'.$value["estado"].'</button></td>';
                                         }else{
                                            if ($value["estado"] ==='Terminado'){
                                                 echo '<td style="with: 10px"><button class="btn bg-gray btn-xs">'.$value["estado"].'</button></td>';
                                                 }else{
                                                    if ($value["estado"] ==='Desactivado'){
                                                 echo '<td style="with: 10px"><button class="btn bg-black-active btn-xs">'.$value["estado"].'</button></td>';
                                                 }else{
                                                 echo '<td><button class="btn bg-gray btn-xs">'.$value["estado"].'</button></td>';
                                                     }
                                                
                                              }
                                        }
                                 }
                            }
                     
                      }
      echo '   <td>' . $value["rutahistorial"] . '</td>
                <td>' . $value["observacion"] . '</td>
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





