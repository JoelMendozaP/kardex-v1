<div class="content-wrapper ">
    <section class="content-header">
        <h1> <b> <i>
                    Correspondencia Interna
                </i>
            </b>

        </h1>
        <ol class="breadcrumb">
            <li><a href="estudiante"><i class="fa fa-dashboard"></i>Inicio</a></li>
            <li class="active"> Correspondencia Interna
            </li>
        </ol>
    </section>
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">

                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">BANDEJA DE ENTRADA</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">BANDEJA DE SALIDA</a>
                    </li>

                </ul>


                <div class="tab-content" id="pills-tabContent">
                    <!-- Default box -->
                    <div class="tab-pane fade " id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" style="background: skyblue ">
                        <br>
                        <div class="box-header with-border">
                            <button class="btn btn-warning btn-lg" data-toggle="modal" data-target="#modalregistrarcarta">
                                Registrar Carta
                            </button>
                            <br>
                        </div>

                        <div class="box-body">

                            <table class="table table-bordered table-striped dt-responsive tablas" style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="width: 1px">#NRO</th>
                                        <th style="width: 8px">Fecha de cada cambio</th>
                                        <th style="width: 8px">Hoja de ruta</th>
                                        <th style="width: 15px">Remitente</th>
                                        <th style="width: 15px">Entidad</th>
                                        <th style="width: 20px">Referencia</th>
                                        <th style="width: 15px">Receptor Actual</th>
                                        <th style="width: 8px">fecha de Carta</th>
                                        <th style="width: 8px">fecha de plazo</th>
                                        <th style="width: 5px">Prioridad</th>
                                        <th style="width: 8px">Estado</th>
                                        <th style="width: 10px">observacion</th>
                                        <th style="width: 20px">Foto</th>
                                        <th style="width: 20px">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $item = null;
                                    $valor = null;
                                    $aux = null;
                                    $carta = Controladorcorespinterna::ctrMostrarcorespinterna($item, $valor);

                                    foreach ($carta as $key => $value) {
                                        echo '<tr>
                                <td>' . ($key + 1) . '</td>
                                <td>' . $value["fechentre"] . '</td>
                                <td>' . $value["ruta"] . '</td>    
                                <td>' . $value["remitente"] . '</td>                
                                <td>' . $value["entidad"] . '</td>
                                <td>' . $value["referencia"] . '</td>
                                <td>'  . $value["nombre"] . " - " . $value["ap_paterno"] . ' - ' . $value["ap_materno"] . '</td>
                                <td>' . $value["fechacarta"] . '</td>
                                <td>' . $value["fechaplazo"] . '</td>
                                <td>' . $value["prioridad"] . '</td>';
                                if ($value["estadoproceso"] ==='Inicial'){
                                    echo '<td style="with: 10px"><button class="btn bg-purple-active btn-xs">'.$value["estadoproceso"].'</button></td>';
                                        }else{
                                            if ($value["estadoproceso"] ==='Primario'){
                                             echo '<td style="with: 10px"><button class="btn bg-red-active btn-xs">'.$value["estadoproceso"].'</button></td>';
                                            }else{
                                                if ($value["estadoproceso"] ==='Medio'){
                                                 echo '<td style="with: 10px"><button class="btn bg-orange-active btn-xs">'.$value["estadoproceso"].'</button></td>';
                                                 }else{
                                                    if ($value["estadoproceso"] ==='Final'){
                                                        echo '<td style="with: 10px"><button class="btn btn-success btn-xs">'.$value["estadoproceso"].'</button></td>';
                                                         }else{
                                                            if ($value["estadoproceso"] ==='Terminado'){
                                                                 echo '<td style="with: 10px"><button class="btn bg-gray btn-xs">'.$value["estadoproceso"].'</button></td>';
                                                                 }else{
                                                                    if ($value["estadoproceso"] ==='Desactivado'){
                                                                 echo '<td style="with: 10px"><button class="btn bg-black-active btn-xs">'.$value["estadoproceso"].'</button></td>';
                                                                 }else{
                                                                 echo '<td><button class="btn bg-gray btn-xs">'.$value["estadoproceso"].'</button></td>';
                                                                     }
                                                                
                                                              }
                                                        }
                                                 }
                                            }
                                     
                                      }
                      echo '<td>' . $value["observacion"] . '</td>
                    <td> <button class="btn bg-aqua-gradient btnvisor" idcarta="' . $value["cod_carta"] . '" fotocarta="' . $value["fotocarta"] . '" title="!VISUALIZAR DOCUMENTO!" data-toggle="modal" data-target="#revisor"> <i class="fa fa-plus-square"></i></button></td>                                
                                

                                 <td>
                                 <div  class="btn-group">
                                 <button class="btn btn-warning btnEditarcartainterna"  idusuario="' . $value["dni"] . '"  idcarta="' . $value["cod_carta"] . '" title="!!EDITAR REGISTRO DE CARTA!!" data-toggle="modal" data-target="#revisores"> <i class="fa fa-pencil"></i></button>
                                 ';

                                 if ($_SESSION["esta_superu"] == 1 && $_SESSION["perfil"] == "Administrador") {
                      
                                echo'<button class="btn btn-danger  btnEliminarcartainterna" idcartas="' . $value["cod_carta"] . '" fotocartas="' . $value["fotocarta"] . '" remitente="' . $value["remitente"] . '" title="!!ELIMINAR DE CARTA!!"> <i class="fa fa-times"></i></button>
                                 <button class="btn bg-light-blue-gradient historialcarta"  idcartahitorial="' . $value["cod_carta"] . '" codu="' . $value["cod_user"] . '"  title="HISTORIAL DE LA CARTA"> <i class="fa fa-download"><span></span></i></button>';
                                 }
                                 echo'<div class="btn bg-green-active btnreasignar" remitente="' . $value["remitente"] . '" codusuarioh="' . $value["cod_user"] . '" receptoract="' . $value["dnia"] . '"  codcartah="' . $value["cod_carta"] . '"  title="Reasignar la Carta !!REASIGNAR RESPONSABILIDAD DE CARTA!!" data-placement="bottom" data-toggle="modal" data-target="#reasignar"> <i class="fa fa-mouse-pointer"></i></div>
                                 </div>
                                 </td>
                                </tr>';
                                    }
                                    ?>

                                </tbody>
                            </table>

                        </div>
                    </div>


                    <!--  BANDEJA DE SALIDA -->
                    <div class="tab-pane fade " id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" style="background: skyblue">
                        <!--  BANDEJA DE SALIDA-->
                        <br>
                        <div class="box-header with-border">
                            <button class="btn btn-microsoft btn-lg" data-toggle="modal" data-target="#modalCrearcarta">
                                Crear Carta
                            </button>
                            <br>
                        </div>

                        <div class="box-body">

                            <table class="table table-bordered table-striped dt-responsive tablas" style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="width: 1px">#</th>
                                        <th style="width: 8px">Fecha de Carta</th>
                                        <th style="width: 8px">Dirijida a</th>
                                        <th style="width: 15px">Cargo del dirijido</th>
                                        <th style="width: 15px">Referencia</th>
                                        <th style="width: 20px">emisor</th>
                                        <th style="width: 15px">cargo del emisor</th>
                                        <th style="width: 20px">creador de la carta</th>
                                        <th style="width: 20px">PDF</th>
                                        <th style="width: 20px">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $item = null;
                                    $valor = null;
                                    $cartacreada = Controladorcorespinterna::ctrMostrarcartacreada($item, $valor);

                                    foreach ($cartacreada as $key => $value) {
                                        echo '<tr>
                                <td>' . ($key + 1) . '</td>
                                <td>' . $value["fechaemicion"] . '</td>
                                <td>' . $value["dirijida"] . '</td>    
                                <td>' . $value["cargodir"] . '</td>                
                                <td>' . $value["referencia"] . '</td>
                                <td>' . $value["emisor"] . '</td>
                                <td>' . $value["cargoemisor"] . '</td>
                                <td>'  . $value["nombre"] . " - " . $value["ap_paterno"] . ' - ' . $value["ap_materno"] . '</td>
                                <td>   
                                
                                <button class="btn btn-success btnimprimirecartac" codcartac="' . $value["cod_crearcarta"] . '"><i class="fa fa-print "></i></button> </td>                                
                                 
                                <td>
                                 <div  class="btn-group">
                                 <button class="btn btn-warning btnEditarccarta"  ciusuario="' . $value["dni"] . '"  idcartas="' . $value["cod_crearcarta"] . '"  data-toggle="modal" data-target="#modalEditarCrearcarta"> <i class="fa fa-pencil"></i></button>
                                 ';

                                 if ($_SESSION["esta_superu"] == 1 && $_SESSION["perfil"] == "Administrador") {
                      
                                echo'
                                 <button class="btn btn-danger  btnEliminarcartac" codcartacreada="' . $value["cod_crearcarta"] . '" ciusu="' . $value["dni"] . '"> <i class="fa fa-times"></i></button>';
                                 }
                                 echo'                            
                                 </div>
                                 </td>
                                </tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>

                        </div>
                    </div>

                </div>
    </section>





    <!-- CARTA INTERNA-->

    <!-- CLASE MODAL REGISTRAR CARTA-->
    <div class="modal fade" id="modalregistrarcarta">
        <div class="modal-dialog">

            <div class="modal-content bg-blue-active">
                <form role="form" method="POST" enctype="multipart/form-data">
                    <!-- cabeza del modal-->
                    <div class="modal-header">

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                            <span aria-hidden="true">&times;</span></button>

                        <h4 class="modal-title">Registrar Carta</h4>

                    </div>
                    <!-- cuerpo del modal -->
                    <div class="modal-body">

                        <div class="box-body">

                            <!-- hoja de ruta-->
                            <div class="form-group">
                                <div class="input-group">
                                    <p>
                                        <i class="fa fa-commenting">

                                            <input type="text" class="input-lg" style="color: black" placeholder="Hoja de ruta" name="nuevoruta" id="nuevoruta" size="50">
                                        </i>
                                    </p>
                                </div>
                            </div>

                            <!-- fechas de plazo y de carta -->
                            <div class="form-group">
                                <div class="icono-nosotros">
                                    <h4>Fecha de Carta</h4>
                                    <h4>Fecha de Plazo</h4>
                                </div>
                                <p>
                                    <div class="icono-nosotros">
                                        <input type="date" class="input-lg" style="color: black" name="nuevofechacarta" id="nuevofechacarta" size="12">
                                        <input type="date" class="input-lg" style="color: black" name="nuevofechaplazo" id="nuevofechaplazo" size="12">
                                    </div>
                                </p>
                            </div>

                            <!-- remitente  -->
                            <div class="input-group">
                                <P> <i class="fa fa-unlock-alt">
                                        <input type="text" class="input-lg" style="color: black" placeholder=" remitente " name="nuevoremitente" id="nuevoremitente" size="40" required> </i> </p>
                            </div>

                            <!-- Entidad  -->
                            <div class="input-group">
                                <P> <i class="fa fa-unlock-alt">
                                        <input type="text" class="input-lg" style="color: black" placeholder="Entidad " name="nuevoentidad" id="nuevoentidad" size="40" required> </i> </p>
                            </div>


                            <!-- Referencia -->
                            <div class="form-group">
                                <label>Referencia</label>
                                <textarea class=" form-control" rows="3" placeholder="Ing. Ref ..." name="nuevoreferencia" id="nuevoreferencia" style="margin-top: 0px; margin-bottom: 0px; height: 99px;" required></textarea>
                            </div>

                            <!-- Receptor Actual-->
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-archive"> </i></span>
                                    <select class="form-control input-lg" id="nuevoreceptor" name="nuevoreceptor" style="color: black">
                                        <?php

                                        include("conexionmysqli.php");
                                        $query = "SELECT * FROM usuarios";

                                        $resultado = $conexion->query($query);
                                        echo '<option value="">Perfil Nombre Ap_paterno Ap_materno  Cargo</option>';

                                        while ($row = $resultado->fetch_assoc()) {
                                        ?>
                                            
                                            <option value="<?php echo $row['dni']; ?>" ><?php echo $row['perfil'] . "   " . $row['nombre'] . "   " . $row['ap_paterno'] . "   " . $row['ap_materno'] . "   " . $row['cargo']; ?> </option>
        
                                        <?php
                                        } ?>
                                    </select>
                                </div>
                            </div>
                           



                            <!-- Prioridad-->
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-users"> </i></span>
                                    <select class="form-control input-lg" name="prioridad">
                                        <option value="Seleccionar Prioridad ">Seleccionar Prioridad</option>
                                        <option value="Alarmante">Alarmante</option>
                                        <option value="Muy Alta">Muy Alta</option>
                                        <option value="Alta">Alta</option>
                                        <option value="media">media</option>
                                        <option value="baja">baja</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Estado-->
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-users"> </i></span>
                                    <select class="form-control input-lg" name="estado">
                                        <option value="Seleccionar Estado ">Seleccionar Estado</option>
                                        <option value="Inicial">Inicial</option>
                                        <option value="Primario">Primario</option>
                                        <option value="Medio">Medio</option>
                                        <option value="Final">Final</option>
                                        <option value="Terminado">Terminado</option>
                                        <option value="Desactivado">Desactivado</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Observacion -->
                            <div class="form-group">
                                <label>Observacion</label>
                                <textarea class=" form-control" rows="3" placeholder="Ing. Ref ..." name="nuevoobservacion" id="nuevoobservacion" style="margin-top: 0px; margin-bottom: 0px; height: 99px;"></textarea>
                            </div>

                            <!-- Subir foto Del Documento -->
                            <h4 class="modal-title">Subir Foto Del Documento</h4>
                            <div class="form-group">

                                <input type="file" class="nuevafotocarta" name="nuevafotocarta">
                                <p class="help-block">Peso maximo de una Foto es de 2MB</p>
                                <img src="vistas/img/usuarios/default/usn.png" class="img-thumbnail previsualizar" width="100px">
                            </div>
                        </div>
                    </div>
                    <!-- /.pie del modal-->
                    <div class="modal-footer">
                        <button type="button" class="btn 
                      btn-outline pull-left" data-dismiss="modal">Salir</button>
                        <button type="submit" class="btn btn-outline">Guardar Registro</button>
                    </div>
                    <?php
                    $crearregistrocarta = new Controladorcorespinterna();
                    $crearregistrocarta->CtrCrearcartaint();
                    ?>
                </form>

            </div>
        </div>

    </div>

    <!-- CLASE MODAL REVISOR DE IMAGEN -->
    <div class="modal fade bd-example-modal-lg  tabindex=" -1" id="revisor" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content bg-navy-active">
                <form role="form" method="POST" enctype="multipart/form-data">
                    <!-- cabeza del modal-->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Imagen de la carta</h4>
                    </div>
                    <!-- cuerpo del modal -->
                    <div class="modal-body">
                        <div class="box-body">

                            <div class="form-group">
                                <iframe src="vistas/img/usuarios/default/usn.png" class="previsualizar" height="1200px" width="100%">
                                </iframe>
                                <input type="hidden" name="fotoApre" id="fotoApre">
                            </div>

                        </div>
                    </div>
                    <!-- /.pie del modal-->
                    <div class="modal-footer">
                        <div type="button" class="btn  btn-outline pull-right" data-dismiss="modal">SALIR</div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    $eliminarregistrocarta = new Controladorcorespinterna();
    $eliminarregistrocarta->ctrBorrarCartainterna();
    ?>
    </section>
</div>

<!-- CLASE EDITAR CARTAINTERNA-->
<div class="modal modal-warning fade" id="revisores">
    <div class="modal-dialog">

        <div class="modal-content">
            <form role="form" method="POST" enctype="multipart/form-data">
                <!-- cabeza del modal-->
                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                        <span aria-hidden="true">&times;</span></button>

                    <h3 class="modal-title">Editar Registro de Carta</h3>

                </div>
                <!-- cuerpo del modal -->
                <div class="modal-body">

                    <div class="box-body">

                        <!-- iddecarta-->
                        <input type="hidden" name="idcarta" id="idcarta">
                        <!-- hoja de ruta-->
                        <div class="form-group">
                            <div class="input-group">
                                <p>
                                    <i class="fa fa-commenting">

                                        <input type="text" class="input-lg" style="color: black" placeholder="Hoja de ruta" name="editarruta" id="editarruta" size="50">
                                    </i>
                                </p>
                            </div>
                        </div>

                        <!-- fechas de plazo y de carta -->
                        <div class="form-group">
                            <div class="icono-nosotros">
                                <h4>Fecha de Carta</h4>
                                <h4>Fecha de Plazo</h4>
                            </div>
                            <p>
                                <div class="icono-nosotros">
                                    <input type="date" class="input-lg" style="color: black" name="editarfechacarta" id="editarfechacarta" size="12">
                                    <input type="date" class="input-lg" style="color: black" name="editarfechaplazo" id="editarfechaplazo" size="12">
                                </div>
                            </p>
                        </div>

                        <!-- remitente  -->
                        <div class="input-group">
                            <P> <i class="fa fa-unlock-alt">
                                    <input type="text" class="input-lg" style="color: black" placeholder=" remitente " name="editarremitente" id="editarremitente" size="40" required> </i> </p>
                        </div>

                        <!-- Entidad  -->
                        <div class="input-group">
                            <P> <i class="fa fa-unlock-alt">
                                    <input type="text" class="input-lg" style="color: black" placeholder="Entidad " name="editarentidad" id="editarentidad" size="40" required> </i> </p>
                        </div>


                        <!-- Referencia -->
                        <div class="form-group">
                            <label>Referencia</label>
                            <textarea class=" form-control" rows="3" placeholder="Ing. Ref ..." name="editarreferencia" id="editarreferencia" style="margin-top: 0px; margin-bottom: 0px; height: 99px;" required></textarea>
                        </div>

                        <!-- Receptor Actual-->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-archive"> </i></span>
                                <select class="form-control input-lg" name="editarreceptor" id="editarreceptor" style="color: black">

                                    <?php

                                    include("conexionmysqli.php");


                                    $query = "SELECT * FROM usuarios";

                                    $resultado = $conexion->query($query);

                                    while ($row = $resultado->fetch_assoc()) {
                                    ?>
                                        <option value="<?php echo $row['dni']; ?>" id="editarreceptor"><?php echo $row['perfil'] . "   " . $row['nombre'] . "   " . $row['ap_paterno'] . "   " . $row['ap_materno'] . "   " . $row['cargo']; ?> </option>
                                    <?php
                                    } ?>
                                </select>
                            </div>
                        </div>

                        <!-- Prioridad-->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-users"> </i></span>
                                <select class="form-control input-lg" name="editarprioridad">
                                    <option value="" id="editarprioridad">Seleccionar Prioridad</option>
                                    <option value="Alarmante">Alarmante</option>
                                    <option value="Muy Alta">Muy Alta</option>
                                    <option value="Alta">Alta</option>
                                    <option value="media">media</option>
                                    <option value="baja">baja</option>
                                </select>
                            </div>
                        </div>

                        <!-- Estado-->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-users"> </i></span>
                                <select class="form-control input-lg" name="editarestado">
                                    <option value="" id="editarestado">Seleccionar Estado</option>
                                    <option value="Inicial">Inicial</option>
                                    <option value="Primario">Primario</option>
                                    <option value="Medio">Medio</option>
                                    <option value="Final">Final</option>
                                    <option value="Terminado">Terminado</option>
                                    <option value="Desactivado">Desactivado</option>
                                </select>
                            </div>
                        </div>

                        <!-- Observacion -->
                        <div class="form-group">
                            <label>Observacion</label>
                            <textarea class=" form-control" rows="3" placeholder="Ing. Ref ..." name="editarobservacion" id="editarobservacion" style="margin-top: 0px; margin-bottom: 0px; height: 99px;"></textarea>
                        </div>

                        <!-- Subir foto Del Documento -->
                        <h4 class="modal-title">Subir Foto Del Documento</h4>
                        <div class="form-group">

                            <input type="file" class="nuevafotocarta" name="editarfotocarta">
                            <p class="help-block">Peso maximo de una Foto es de 2MB</p>
                            <iframe src="vistas/img/usuarios/default/usn.png" class=" previsualizar" width="100%">
                            </iframe>
                            <input type="hidden" name="fotoActualcarta" id="fotoActualcarta">
                        </div>

                    </div>
                </div>
                <!-- /.pie del modal-->
                <div class="modal-footer">
                    <button type="button" class="btn 
                      btn-outline pull-left" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-outline">Guardar Editado</button>
                </div>

                <?php
                $editarcartainterna = new Controladorcorespinterna();
                $editarcartainterna->ctreditarcartaint();
                ?>
            </form>
        </div>
    </div>
</div>

<!--  CARTA INTERNA//-->

<!-- CLASE MODAL CREAR CARTA -->
<div class="modal fade bd-example-modal-lg " tabindex=" -1" id="modalCrearcarta" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content bg-teal-gradient">
            <form role="form" method="POST" enctype="multipart/form-data">
                <!-- cabeza del modal-->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Crear Carta</h4>
                </div>
                <!-- cuerpo del modal -->
                <div class="modal-body">
                    <div class="box-body">

                        <!-- HOJA DE RUTA -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class=" fa fa-envelope-square"> </i></span>
                                <input type="text" class="form-control input-lg" style="color: black" placeholder="Ingresar Ruta :" name="rutacreada" id="rutacreada">
                            </div>
                        </div>

                        <!-- Lugar y fecha-->
                        <div class="form-group ">
                            <div class="input-group icono-nosotros ">

                                <span class="input-group-addon"><i class="fa fa-calendar"> </i></span>
                                <input type="date" class="form-control input-lg" style="color: black" placeholder="Ingrese fecha" name="crearfecha" id="crearfecha">
                                <span class="input-group-addon"><i class="fa fa-map-marker"> </i></span>
                                <input type="text" class="form-control input-lg" style="color: black" placeholder="Ingrese lugar" name="nuevolugar" id="nuevolugar">

                            </div>
                        </div>

                        <!-- dirijida -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class=" fa fa-external-link"> </i></span>
                                <input type="text" class="form-control input-lg" style="color: black" placeholder="Dirijida A:" name="dirijida" id="dirijida">
                            </div>
                        </div>
                        <!-- Cargo -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-bank"> </i></span>
                                <input type="text" class="form-control input-lg" style="color: black" placeholder="Cargo de :" name="cargo" id="cargo">
                            </div>
                        </div>
                        <!-- Referencia solicitud-->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-paper-plane-o"> </i></span>
                                <input type="text" class="form-control input-lg" style="color: black" placeholder="Referencia o Solicitud :" name="crearreferencia" id="crearreferencia">
                            </div>
                        </div>
                        <!-- Saludo Inicial-->
                        <div class="form-group">
                            <label>Saludo inicial</label>
                            <textarea class=" form-control" rows="3" placeholder="Ing. Saludo inicial..." name="saludoinicial" id="saludoinicial" style="margin-top: 0px; margin-bottom: 0px; height: 99px;"></textarea>
                        </div>

                        <!-- Asunto -->
                        <div class="form-group">
                            <label>Asunto</label>
                            <textarea class=" form-control" rows="3" placeholder="Ing. Asunto..." name="asunto" id="asunto" style="margin-top: 0px; margin-bottom: 0px; height: 99px;"></textarea>
                        </div>
                        <!-- Despedida-->
                        <div class="form-group">
                            <label>Despedida</label>
                            <textarea class=" form-control" rows="3" placeholder="Ing. Despedida..." name="despedida" id="despedida" style="margin-top: 0px; margin-bottom: 0px; height: 99px;"></textarea>
                        </div>

                        <!-- Atentamente-->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user-secret"> </i></span>
                                <input type="text" class="form-control input-lg" style="color: black" placeholder=" Atentamente:" name="remitente" id="remitente">
                            </div>
                        </div>
                        <!-- Cargo de quien envia-->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-suitcase"> </i></span>
                                <input type="text" class="form-control input-lg" style="color: black" placeholder="Cargo del que envia :" name="cargoremitente" id="remitente">
                            </div>
                        </div>
                        <!-- Ci-->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-credit-card"> </i></span>
                                <input type="text" class="form-control input-lg" style="color: black" placeholder="Ci :" name="cic" id="cic">
                            </div>
                        </div>
                        <!-- Correo -->
                        <div class="form-group">
                            <label>Correo o direccion</label>
                            <textarea class=" form-control" rows="3" placeholder="Ing. Correo o direccion" name="correodir" id="correodir" style="margin-top: 0px; margin-bottom: 0px; height: 99px;"></textarea>
                        </div>
                        <input type="hidden" value="<?php echo $_SESSION["cod_user"]; ?>" name="user" id="user">
                    </div>
                </div>
                <!-- /.pie del modal-->
                <div class="modal-footer">
                    <button type="button" class="btn 
                      btn-outline pull-left" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-outline">Crear carta</button>
                </div>
                <?php
                $crearcarta = new Controladorcorespinterna();
                $crearcarta->CtrCrearc();
                ?>
            </form>
        </div>
    </div>
</div>


<!-- CLASE MODAL EDITAR CARTA CREADA CARTA -->
<div class="modal fade bd-example-modal-lg modal-warning" tabindex=" -1" id="modalEditarCrearcarta" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form role="form" method="POST" enctype="multipart/form-data">
                <!-- cabeza del modal-->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Editar Carta</h4>
                </div>
                <!-- cuerpo del modal -->
                <div class="modal-body">
                    <div class="box-body">

                        <!-- iddecartacreada-->
                        <input type="hidden" name="codcartac" id="codcartac" value="">
                        <input type="hidden" name="dniuser" id="dniuser" value="">

                        <!-- HOJA DE RUTA -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class=" fa fa-external-link"> </i></span>
                                <input type="text" class="form-control input-lg" style="color: black" value="" name="editarrutacreada" id="editarrutacreada">
                            </div>
                        </div>

                        <!-- Lugar y fecha-->
                        <div class="form-group ">
                            <div class="input-group icono-nosotros ">

                                <span class="input-group-addon"><i class="fa fa-calendar"> </i></span>
                                <input type="date" class="form-control input-lg" style="color: black" value="" name="editarcrearfecha" id="editarcrearfecha">
                                <span class="input-group-addon"><i class="fa fa-map-marker"> </i></span>
                                <input type="text" class="form-control input-lg" style="color: black" value="" name="editarlugar" id="editarlugar">

                            </div>
                        </div>

                        <!-- dirijida -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class=" fa fa-external-link"> </i></span>
                                <input type="text" class="form-control input-lg" style="color: black" value="" name="editardirijida" id="editardirijida">
                            </div>
                        </div>
                        <!-- Cargo -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-bank"> </i></span>
                                <input type="text" class="form-control input-lg" style="color: black" value="" name="editarcargo" id="editarcargo">
                            </div>
                        </div>
                        <!-- Referencia solicitud-->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-paper-plane-o"> </i></span>
                                <input type="text" class="form-control input-lg" style="color: black" value="" name="editarcrearreferencia" id="editarcrearreferencia">
                            </div>
                        </div>
                        <!-- Saludo Inicial-->
                        <div class="form-group">
                            <label>Saludo inicial</label>
                            <textarea class=" form-control" rows="3" value="" name="editarsaludoinicial" id="editarsaludoinicial" style="margin-top: 0px; margin-bottom: 0px; height: 99px;"></textarea>
                        </div>

                        <!-- Asunto -->
                        <div class="form-group">
                            <label>Asunto</label>
                            <textarea class=" form-control" rows="3" value="" name="editarasunto" id="editarasunto" style="margin-top: 0px; margin-bottom: 0px; height: 99px;"></textarea>
                        </div>
                        <!-- Despedida-->
                        <div class="form-group">
                            <label>Despedida</label>
                            <textarea class=" form-control" rows="3" value="" name="editardespedida" id="editardespedida" style="margin-top: 0px; margin-bottom: 0px; height: 99px;"></textarea>
                        </div>

                        <!-- Atentamente-->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user-secret"> </i></span>
                                <input type="text" class="form-control input-lg" style="color: black" value="" name="editarremitentec" id="editarremitentec">
                            </div>
                        </div>
                        <!-- Cargo de quien envia-->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-suitcase"> </i></span>
                                <input type="text" class="form-control input-lg" style="color: black" value="" name="editarcargoremitente" id="editarcargoremitente">
                            </div>
                        </div>
                        <!-- Ci-->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-credit-card"> </i></span>
                                <input type="text" class="form-control input-lg" style="color: black" value="" name="editarcic" id="editarcic">
                            </div>
                        </div>
                        <!-- Correo -->
                        <div class="form-group">
                            <label>Correo o direccion</label>
                            <textarea class=" form-control" rows="3" value="" name="editarcorreodir" id="editarcorreodir" style="margin-top: 0px; margin-bottom: 0px; height: 99px;"></textarea>
                        </div>
                        <input type="hidden" value="<?php echo $_SESSION["cod_user"]; ?>" name="editaruser" id="editaruser">
                    </div>
                </div>
                <!-- /.pie del modal-->
                <div class="modal-footer">
                    <button type="button" class="btn 
                      btn-outline pull-left" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-outline">guardar Cambios</button>
                </div>
                <?php
                $editarccarta = new Controladorcorespinterna();
                $editarccarta->ctreditarcartacreadas();
                ?>
            </form>
        </div>
    </div>
</div>

<?php
$eliminarcartacreada = new Controladorcorespinterna();
$eliminarcartacreada->ctrBorrarCartacreada();
?>



<!-- CLASE MODAL REASIGNAR CARTA-->
<div class="modal  fade" id="reasignar">
    <div class="modal-dialog">

        <div class="modal-content  bg-red">
            <form role="form" method="POST" enctype="multipart/form-data">
                <!-- cabeza del modal-->
                <div class="modal-header">

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                        <span aria-hidden="true">&times;</span></button>

                    <h4 class="modal-title">REASIGNAR CARTA</h4>
                    
                </div>
                <!-- cuerpo del modal -->
                <div class="modal-body">
                    <div class="box-body">
                    <h5 class="centrart"> <b> HORA Y FECHA DE ASIGNACION </b></h5>
                    <div id="clockdate">
                                        <div class="clockdate-wrapper">
                                            <div id="clock"></div>
                                            <div id="date"></div>
                                        </div>
                                    </div>
                     <br>
                        
                        <!-- Remitente Nombre de la carpeta-->
                        <input type="hidden" name="editarremitentes" id="editarremitentes">

                        <!-- iddecartacreada-->
                        <input type="hidden" name="codcartaces" id="codcartaces" value="">
                        <!--dnia del usuario-->
                        <input type="hidden" name="recepactual" id="recepactual" value="">
                        
                        
                            <!-- HOJA DE RUTA -->
                            <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class=" fa fa-envelope-square"> </i></span>
                                <input type="text" class="form-control input-lg" style="color: black" valor="" name="rutahistorial" id="rutahistorial">
                            </div>
                        </div>
                        
                        
                        <!-- Receptor Actual-->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-archive"> </i></span>
                                <select class="form-control input-lg" name="editarreceptorhistorial" id="editarreceptorhistorial" style="color: black">

                                    <?php

                                    include("conexionmysqli.php");
                                    $query = "SELECT * FROM usuarios";
                                    $resultado = $conexion->query($query);
                                    while ($row = $resultado->fetch_assoc()) {
                                    ?>
                                        <option value="<?php echo $row['cod_user']; ?>" "><?php echo $row['perfil'] . "   " . $row['nombre'] . "   " . $row['ap_paterno'] . "   " . $row['ap_materno'] . "   " . $row['cargo']; ?> </option>
                                    <?php
                                    } ?>
                                </select>
                            </div>
                        </div>
                        	
                        <!-- Estado Actual de la carta-->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-users"> </i></span>
                                <select class="form-control input-lg" name="editarestadohistorial">
                                    <option value="" id="editarestadohistorial"></option>
                                    <option value="Inicial">Inicial</option>
                                    <option value="Primario">Primario</option>
                                    <option value="Medio">Medio</option>
                                    <option value="Final">Final</option>
                                    <option value="Terminado">Terminado</option>
                                    <option value="Desactivado">Desactivado</option>
                                </select>
                            </div>
                        </div>
                        <!-- Observacion actual-->
                        <div class="form-group">
                            <label>Observacion</label>
                            <textarea class=" form-control" rows="3" value="" name="editarobservacionhistorial" id="editarobservacionhistorial" style="margin-top: 0px; margin-bottom: 0px; height: 99px;"></textarea>
                        </div>
                        <!-- Subir foto Del Documento -->
                        <h4 class="modal-title">Subir Foto Del Documento</h4>
                        <div class="form-group">
                            <input type="file" class="nuevafotocarta" name="editarfotocartahistorial">
                            <p class="help-block">Peso maximo de una Foto es de 2MB</p>
                            <iframe src="vistas/img/usuarios/default/usn.png" class=" previsualizar" width="100%">
                            </iframe>
                            <input type="hidden" name="fotoActualcartahistorial" id="fotoActualcartahistorial">
                        </div>
                    </div>
                </div>
                <!-- /.pie del modal-->
                <div class="modal-footer">
                    <button type="button" class="btn 
                      btn-outline pull-left" data-dismiss="modal">Canselar</button>
                    <button type="submit" class="btn btn-outline">Reasignar</button>
                </div>
                <?php
                        $asignar = new Controladorcorespinterna();
                        $asignar->ctrassignar();
                        ?>
            </form>

        </div>
    </div>

</div>