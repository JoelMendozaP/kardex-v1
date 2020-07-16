<div class="content-wrapper">
    <section class="content-header">

        <h1>
        GALERIA DE DOCUMENTOS
            <small>Panel de Control</small>
        </h1>

        <ol class="breadcrumb">
            <li><a href="estudiantes"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Administrar Documentos</li>
            <!-- Trigger the modal with a button -->
        </ol>
    </section>
    <!-- Main content -->
    <section class="content bg-gray-light">
        <!-- Default box -->
        <div class="box" style="background: skyblue">
            <div class="box-header with-border">



            <?php
                if (isset($_GET["idestgaleria"])) {
                    include("conexionmysqli.php");
                    $idestga = $_GET["idestgaleria"];

                    $query = "SELECT * FROM estudiante where codest = $idestga";

                    $resultado = $conexion->query($query);

                    while ($row = $resultado->fetch_assoc()) {
                        $nom = $row['nombre'];
                        $ap = $row["ap_paterno"];
                        $am = $row["ap_materno"];
                        $ci = $row["ci"];
                        $estado = $row["estado"];
                        $email = $row["email"];
                        $reg = $row["reg_univ"];
                        $cel = $row["celular"];
                        $ing = $row["modo_ing"];
                        $egre = $row["modo_egre"];
                        $nac = $row["fecha_nac"];
                    }

                    $query1 = "SELECT * FROM documentos where codest = $idestga";

                    $resultado1 = $conexion->query($query1);

                    while ($row = $resultado1->fetch_assoc()) {
                        $fotog = $row['docgaleria'];
                    }
                }

                echo '
                <div class="col-md-12">
                    <!-- Widget: user widget style 1 -->
                    <div class="box box-widget widget-user">

                        <div class="widget-user-header  galeria">
                            <h3 class="widget-user-desc negrilla">' . $nom . ' ' . $ap . ' ' . $am . '</h3>
                            <h4 class="widget-user-username  negrilla">Nombre Del Estudiante</h4>
                        </div>
                        <div class="widget-user-image">
                            <img class="img-circle" src="vistas/img/usuarios/default/defa.png">
                        </div>
                        <div class="cuadrog">
                            <div class="row">

                                <div class="col-md-3 col-sm-6 col-xs-12 cuadrol ">
                                    <div class="info-box borde">
                                        <span class="info-box-icon bg-navy-active""><i class=" fa fa-credit-card"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">CI</span>
                                            <span class="info-box-number">' . $ci . '</span>
                                            <span class="info-box-text">NRO MATRICULA</span>
                                            <span class="info-box-number">' . $reg . '</span>

                                        </div> <!-- /.info-box-content -->
                                    </div> <!-- /.info-box -->
                                </div>

                                <div class="col-md-3 col-sm-6 col-xs-12 cuadrol ">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-light-blue-active"><i class="fa fa-fax"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">CELULAR</span>
                                            <span class="info-box-number">' . $cel . '</span>
                                            <span class="info-box-text"> EMAIL</span>
                                            <span class="info-box-number">' . $email . '</span>

                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>

                                <div class="col-md-3 col-sm-6 col-xs-12 cuadrol ">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-aqua"><i class="fa fa-newspaper-o"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">ESTADO</span>
                                            <span class="info-box-number">' . $estado . '</span>
                                            <span class="info-box-text">F. NACIMIENTO</span>
                                            <span class="info-box-number">' . $nac . '</span>

                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>

                                <div class="col-md-3 col-sm-6 col-xs-12 cuadrol ">
                                    <div class="info-box">
                                        <span class="info-box-icon bg-teal"><i class="fa fa-street-view"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">MODO INGRESO</span>
                                            <span class="info-box-number">' . $ing . '</span>
                                            <span class="info-box-text">MODO EGRESO</span>
                                            <span class="info-box-number">' . $egre . '</span>

                                        </div><!-- /.info-box-content -->
                                    </div> <!-- /.info-box -->
                                </div> 
                            </div><!-- /.row -->

                               <button class="btn btn-info btn-lg btngleria" rgistuniv="' . $reg . '" idesgaleria="' . $idestga . '" data-toggle="modal" data-target="#modalagregardoc">
                                   Agregar Documento
                               </button>
                        </div>';
                        ?>

                         <div class="box-body bg-gray-light">
                             <div class="box-footer bg-light-blue-active">
                               <ul class="mailbox-attachments clearfix bg-navy">

                            <?php
                            $item = 'codest';
                            $valor = $idestga;
                            $codigo = $idestga;
                            $objeto = ControladorEstudiantes::ctrMostrargaleria($codigo);
                            foreach ($objeto as $key => $value) {
                            ?><?php
                                    if ($value["tipod"] === 'General') {
                                    ?>
                            <li>
                                <span class="mailbox-attachment-icon has-img bg-red-active ">
                                    <iframe src="<?php echo $value["docgaleria"]; ?>" class="nuevacamara" width="100%">
                                    </iframe></span>

                                <div class="mailbox-attachment-info bg-red-gradient">
                                    <a href="#" class="mailbox-attachment-name">
                                    <?php echo '
 <button class=" btnvgaleria bg-red-gradient" imgaleria="' . $value["docgaleria"] . '" data-toggle="modal" title="!Visor de documento" data-target="#visor"> <i class="fa fa-camera negro"></i></button>'; ?>

                                        
                                    </i> <?php echo $value["tituloar"]; ?></a>
                                    <span class="mailbox-attachment-size">

                                    <?php echo ' <a href="'.$value["docgaleria"].'" download="' . $value["descripar"] . '" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
                                        

<button type="button"  class="btnmin bg-purple-gradient" data-container="body" 
data-original-title="DESCRIPCION" data-toggle="popover" data-placement="top" 
data-content="' . $value["descripar"] . '"><i class="fa fa-paste"></i></button>                                                
<button class="btnmin bg-orange-active btneditargaleria" edidestugaleria="' . $value["codest"] . '" regdocumento="' .$reg. '" ediddocumento="' . $value["codoc"] . '" data-toggle="modal" title="!Editar Documento " data-target="#modaleditargaleria"> <i class="fa fa-pencil"></i></button>


';

                if ($_SESSION["esta_superu"] == 1 && $_SESSION["perfil"] == "Administrador") {
echo '<button class="btnmin bg-red-active  btnEliminardocumento"   eliestugaleria="' . $value["codest"] . '"  elidocumentog="' . $value["codoc"] . '" elifotodoc="' . $value["docgaleria"] . '" title="!Eliminar Documento"> <i class="fa fa-times"></i></button>';
                }
                                        ?>
                                    </span>
                                </div>
                            </li>
                        <?php
                                    } else { ?>
                            <?php if ($value["tipod"] === "Archivo") {
                            ?>
                                <li>
                                    <span class="mailbox-attachment-icon has-img bg-blue-active">
                                        <iframe src="<?php echo $value["docgaleria"]; ?>" class=" nuevacamara" width="100%">
                                        </iframe>
                                    </span>

                                    <div class="mailbox-attachment-info bg-light-blue-gradient ">
                                        <a href="#" class="mailbox-attachment-name">
                                            
                                        <?php echo '
 <button class=" btnvgaleria bg-light-blue-gradient" imgaleria="' . $value["docgaleria"] . '" data-toggle="modal" title="!Visor de documento" data-target="#visor"> <i class="fa fa-camera negro"></i></button>'; ?>

                                        <?php echo $value["tituloar"]; ?></a>
                                        <span class="mailbox-attachment-size">

                                        <?php echo ' <a href="'.$value["docgaleria"].'" download="' . $value["descripar"] . '" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>


<button type="button"  class="btnmin bg-blue-gradient" data-container="body" 
data-original-title="DESCRIPCION" data-toggle="popover" data-placement="top" 
data-content="' . $value["descripar"] . '"><i class="fa fa-paste"></i></button>                                                
<button class="btnmin bg-yellow-gradient btneditargaleria" edidestugaleria="' . $value["codest"] . '" regdocumento="' .$reg. '" ediddocumento="' . $value["codoc"] . '" data-toggle="modal" title="!Editar Documento " data-target="#modaleditargaleria"> <i class="fa fa-pencil"></i></button>


';

                if ($_SESSION["esta_superu"] == 1 && $_SESSION["perfil"] == "Administrador") {
echo '<button class="btnmin bg-red-active  btnEliminardocumento"   eliestugaleria="' . $value["codest"] . '"  elidocumentog="' . $value["codoc"] . '" elifotodoc="' . $value["docgaleria"] . '" title="!Eliminar Documento"> <i class="fa fa-times"></i></button>';
                }
                                            ?>

                                        </span>
                                    </div>
                                </li>
                            <?php
                                        } else {
                            ?>

                                <li>
                                    <span class="mailbox-attachment-icon has-img bg-yellow"><iframe src="<?php echo $value["docgaleria"]; ?>" class=" nuevacamara" width="100%">
                                        </iframe></span>

                                    <div class="mailbox-attachment-info bg-yellow-gradient">
                                        <a href="#" class="mailbox-attachment-name">
                                            <?php echo '
 <button class=" btnvgaleria bg-yellow-gradient" imgaleria="' . $value["docgaleria"] . '" data-toggle="modal" title="!Visor de documento" data-target="#visor"> <i class="fa fa-camera negro"></i></button>'; ?>

                                            <?php echo $value["tituloar"]; ?></a>
                                        <span class="mailbox-attachment-size">
                                        <?php echo ' <a href="'.$value["docgaleria"].'" download="' . $value["descripar"] . '" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>


 <button type="button"   class="btnmin bg-purple-gradient" data-container="body" data-original-title="DESCRIPCION" data-toggle="popover" data-placement="top"  data-content="' . $value["descripar"] . '"><i class="fa fa-paste"></i></button>                                                
 <button class="btnmin bg-orange-active btneditargaleria" edidestugaleria="' . $value["codest"] . '" regdocumento="' .$reg. '" ediddocumento="' . $value["codoc"] . '" data-toggle="modal" title="!Editar Documento " data-target="#modaleditargaleria"> <i class="fa fa-pencil"></i></button>
 
 ';

                if ($_SESSION["esta_superu"] == 1 && $_SESSION["perfil"] == "Administrador") {
echo '<button class="btnmin bg-red-active  btnEliminardocumento"   eliestugaleria="' . $value["codest"] . '"  elidocumentog="' . $value["codoc"] . '" elifotodoc="' . $value["docgaleria"] . '" title="!Eliminar Documento"> <i class="fa fa-times"></i></button>';
                }  
  ?>
                                        </span>
                                    </div>
                                </li>

                            <?php
                                        } ?>
                    <?php }
                                }
                    ?>
                               </ul>
                           </div>
                       </div>
                    </div>
                </div>
            </div>
         </div>
                    <!-- /.box -->
    </section>
    <!-- /.content -->

    
<!-- CLASE MODAL VISOR DEL DOCUMENTO-->
<div class="modal bd-example-modal-lg fade" tabindex="-1" id="visor" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form role="form" method="POST" enctype="multipart/form-data">
                <div class="modal-cabeza">
                    <button type="button" class="cerrar cerrare espacio" data-dismiss="modal" aria-label="close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-titulo ">Galeria De Documentos</h4>
                </div>
                <!-- cuerpo del modal -->
                <div class="modal-cuerpo bg-blue-active">
                    <div class="cuerpo-modal">
                        <div class="form-grupo">
                            <iframe src="vistas/img/usuarios/default/usn.png" class="previsualizar" height="550px" width="100%">
                            </iframe>
                            <input type="hidden" name="fotogaleria" id="fotogaleria">
                        </div>
                    </div>
                    <!-- /.pie del modal-->
                    <div class="modal-footer">
                       
                        <button type="button" class="btn btn-outline pull-right" data-dismiss="modal">Salir</button>
                    </div>
                    </div>   
            </form>
        </div>
    </div>
    <!-- /.modal-dialog -->
</div>




<!-- CLASE MODAL EDITAR DOCUMENTO-->
<div class="modal modal-info fade" id="modaleditargaleria" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Editar Documento</h4>
                </div>
                <!-- cuerpo del modal -->
                <div class="modal-body">
                    <div class="box-body">

                        <input type="hidden" id="editarrgisgaleria" name="editarrgisgaleria" value="">
                        <input type="hidden" id="editaridesgaleria" name="editaridesgaleria" value="">
                        <input type="hidden" id="edidocument" name="edidocument" value="">


                        <!-- Tipo -->
                        <div class="form-group">
                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-file-text"> </i></span>
                                <select class="form-control input-lg" name="editarntipo" >
                                    <option value="" id="editarntipo">selc</option>
                                    <option value="General">General</option>
                                    <option value="Archivo">Archivo</option>
                                    <option value="Proyecto">Proyecto</option>
                                </select>
                            </div>
                        </div>
                        <!-- titulo -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-text-width"> </i></span>
                                <input type="text" class="form-control input-lg" value="" style="color: black" name="editarntitulo" id="editarntitulo">
                            </div>
                        </div>

                        <!-- Descripcion -->
                        <h4>Descripción</h4>
                        <div class="form-group">
                            <textarea class='form-control borde' name="editarndescripcion" id="editarndescripcion" value="" rows=5> </textarea>
                        </div>
                        <!-- Subir foto -->
                        <h4 class="modal-title">Subir Documento Foto o Pdf</h4>

                        <div class="form-group">
                            <input type="file" class="nuevafotocarta" name="editarnfotog" id="editarnfotog" >
                            <p class="help-block">Peso maximo de una Foto es de 2MB</p>
                            <iframe src="vistas/img/usuarios/default/usn.png" class=" img-thumbnail previsualizar" width="100%">
                            </iframe><input type="hidden" id="Documentoactual" name="Documentoactual" value="">
                            
                        </div>
                    </div>
                    <!-- /.pie del modal-->
                    <div class="modal-footer">
                        <button type="button" class="btn 
                          btn-outline pull-left" data-dismiss="modal">Salir</button>
                        <button type="submit" class="btn btn-outline">Guardar Cambios</button>
                    </div>
                    <?php
                    $editardocumentos = new ControladorEstudiantes();
                    $editardocumentos->CtrEditardocumento();
                    ?>
            </form>
        </div>
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->



</div>




<!-- CLASE MODAL AGREGAR DOCUMENTO-->
<div class="modal modal-info fade" id="modalagregardoc" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Agregar Documento</h4>
                </div>
                <!-- cuerpo del modal -->
                <div class="modal-body">
                    <div class="box-body">

                        <input type="hidden" id="rgisgaleria" name="rgisgaleria" value="">
                        <input type="hidden" id="idesgaleria" name="idesgaleria" value="">

                        <!-- Tipo -->
                        <div class="form-group">
                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-file-text"> </i></span>
                                <select class="form-control input-lg" name="ntipo">
                                    <option value=" Seleccionar un Perfil ">Seleccionar un Tipo</option>
                                    <option value="General">General</option>
                                    <option value="Archivo">Archivo</option>
                                    <option value="Proyecto">Proyecto</option>
                                </select>
                            </div>
                        </div>
                        <!-- titulo -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-text-width"> </i></span>
                                <input type="text" class="form-control input-lg" placeholder="Ingresar titulo" style="color: black" name="ntitulo" id="ntitulo" required>
                            </div>
                        </div>

                        <!-- Descripcion -->
                        <h4>Descripción</h4>
                        <div class="form-group">
                            <textarea class='form-control borde' name="ndescripcion" id="ndescripcion" placeholder="Ingrese Descripcion.." rows=5> </textarea>
                        </div>
                        <!-- Subir foto -->
                        <h4 class="modal-title">Subir Documento Foto o Pdf</h4>

                        <div class="form-group">
                            <input type="file" class="nuevafotocarta" name="nfotog" required>
                            <p class="help-block">Peso maximo de una Foto es de 2MB</p>
                            <img src="vistas/img/usuarios/default/defa.png" class="img-thumbnail previsualizar" width="100%" height="100px">
                        </div>
                        <!--  -->
                        <div class="form-group">
                        </div>
                    </div>
                    <!-- /.pie del modal-->
                    <div class="modal-footer">
                        <button type="button" class="btn 
                          btn-outline pull-left" data-dismiss="modal">Salir</button>
                        <button type="submit" class="btn btn-outline">Guardar Documento</button>
                    </div>
                    <?php
                    $creardoc = new ControladorEstudiantes();
                    $creardoc->CtrCreardocumento();
                    ?>
            </form>
        </div>
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<?php
$eliminardocumento = new ControladorEstudiantes();
$eliminardocumento->ctrBorrardocumento();
?>



