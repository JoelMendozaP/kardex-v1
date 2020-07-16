<div class="content-wrapper">

  <section class="content-header">

    <h1>
      PAGINA PRINCIPAL
      <small>Panel de Control</small>
    </h1>

    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Administrar</li>
      <!-- Trigger the modal with a button -->
    </ol>

  </section>
  <!-- Main content -->
  <section class="content bg-gray-light">



    <!-- Default box -->
    <div class="box " style="background: skyblue">



      <div class="box-header with-border">

        <button class="btn btn-info btn-lg" data-toggle="modal" data-target="#modalAgregarmateriap">
          Agregar materia
        </button>

        <select class="select2-results " name="buscadorselec" id="buscadorselec">
          <option value="mexico 1">maxico 1</option>
          <option value="canada 2">canada 2</option>
          <option value=" canada 3">canada 3</option>
          <option value="">europa</option>
          <option value="">francia</option>
          <option value="">bolivia</option>
          <option value="">ecuador</option>
          <option value="">argentina</option>
          <option value="">colombia</option>
          <option value="">peru</option>

        </select>

        <button type="button" class="btn btn-secondary" data-container="body" data-toggle="popover" data-placement="top" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus.">
          Popover on top
        </button>










        <button type="button" class="btn btn-lg btn-danger" data-toggle="popover" title="Popover title" data-content="And here's some amazing content. It's very engaging. Right?">Click to toggle popover</button <div class="box-body">

        <table id="eventos" class="table table-bordered table-striped dt-responsive tablas bg-gray" style="width:100%">
          <thead>
            <tr>
              <th style="width: 2px">#</th>
              <th style="width: 15px">DNI</th>
              <th style="width: 15px">Usuario</th>
              <th style="width: 15px">Cargo</th>
              <th style="width: 25px">Nombre</th>
              <th style="width: 15px">Genero</th>
              <th style="width: 20px">Perfil</th>
              <th style="width: 20px">Foto</th>
              <th style="width: 25px">Email</th>
              <th style="width: 15px">Estado</th>
              <th style="width: 20px">Ultimo login</th>
              <th style="width: 15px">Celular</th>
              <th style="width: 15px">Fecha_crea</th>
              <th style="width: 15px">Fecha_Nac</th>
              <th style="width: 20px">Acciones</th>

            </tr>
          </thead>
          <tbody>


          </tbody>
        </table>

      </div>
    </div>

    <!-- /.box -->

  </section>
  <!-- /.content -->

</div>


<!-- CLASE MODAL AGREGAR MATERIA-->
<div class="modal modal-info fade" id="modalAgregarmateriap" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="POST" enctype="multipart/form-data">
        <!-- cabeza del modal-->
        <div class="modal-header">

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">

            <span aria-hidden="true">&times;</span></button>

          <h4 class="modal-title">Agregar Materia</h4>

        </div>
        <!-- cuerpo del modal -->
        <div class="modal-body">

          <div class="box-body">


            <!-- Sigla  -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-university"> </i></span>
                <input type="text" class="form-control input-lg" style="color: black" placeholder="Ingresar Sigla" name="nuevasigla" id="nuevasigla" required>
              </div>
            </div>

            <!-- Nombre de Materia  -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"> </i></span>
                <input type="text" class="form-control input-lg" style="color: black" placeholder="Ingresar Nombre de la Materia" value="" name="nuevonombrem" id="nuevonombrem" required>
              </div>
            </div>


            <!-- Nro de folio  -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-file-o"> </i></span>
                <input type="text" class="form-control input-lg" style="color: black" placeholder="Ingresar Folio" name="nuevofolio" id="nuevofolio" required>
              </div>
            </div>

            <!-- Libro  -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-file"> </i></span>
                <input type="text" class="form-control input-lg" style="color: black" placeholder="Ingresar Libro" name="nuevolibro" id="nuevolibro" required>
              </div>
            </div>

            <!-- gestion del curso -->
            <div class="form-group">
              <h4>Gestion de la materia</h4>
              <div class="input-group">

                <h4 class="modal-title"> </h4>
                <span class="input-group-addon"><i class="fa  fa-calendar-plus-o"> </i></span>
                <input type="year" class=" form-control input-lg" name="nuevagestion" id="nuevagestion" data-datepicker-color="primary" placeholder="Ingrese el año del curso">

              </div>
            </div>

             <!-- TIPO -->
            <div class="form-group">
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-files-o"> </i></span>
                            <select class="form-control input-lg" name="tipo">
                              <option value=" Seleccionar tipo ">Seleccionar tipo</option>
                              <option value=" Original">Original</option>
                              <option value=" Copia de Original">Copia de Original</option>
                              <option value=" Fotocopia">Fotocopia</option>
                              <option value=" Manuscrito">Manuscrito</option>
                              <option value=" Otros">Otros</option>
                            </select>
                          </div>
                        </div>



            <!-- etapa de la materia -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar-check-o"> </i></span>
                <select class="form-control input-lg" name="nuevaestapa">
                  <option value="Seleccionar una Temporada ">Seleccionar una temporada</option>
                  <option value="Primera">Primera</option>
                  <option value="Segunda">Segunda</option>
                  <option value="Tercer">Tercer</option>
                  <option value="Cuarta">Cuarta</option>
                  <option value="Curso de Temporada">Curso de Temporada</option>
                </select>
              </div>
            </div>
            <!-- docente  -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-graduation-cap"> </i></span>
                <input type="text" class="form-control input-lg" style="color: black" placeholder="Ingresar Docente" name="nuevodocente" id="nuevodocente" required>
              </div>
            </div>
          </div>

        </div>
        <!-- /.pie del modal-->

        <div class="modal-footer">

          <button type="button" class="btn 
                            btn-outline pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-outline">Guardar Materia</button>

        </div>
        <?php
        $crearmateria = new Controladormaterias();
        $crearmateria->CtrCrearmateria();
        ?>

      </form>

    </div>

  </div>

  <!-- /.modal-dialog -->
</div>

<!-- /.modal -->


<!-- CLASE MODAL Editar  USUARIO-->
<div class="modal modal-info fade" id="ModalEditarUsuario" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="POST" enctype="multipart/form-data">
        <!-- cabeza del modal-->
        <div class="modal-header">

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">

            <span aria-hidden="true">&times;</span></button>

          <h4 class="modal-title">Editar Usuario</h4>

        </div>
        <!-- cuerpo del modal -->
        <div class="modal-body">

          <div class="box-body">


            <!-- nombre -->
            <div class="form-group">
              <div class="input-group">
                <p>
                  <i class="fa fa-user">
                    <input type="text" class="  input-lg" style="color: black" value="" name="editarnombre" id="editarnombre" size="50" required>
                  </i>
                </p>
              </div>
            </div>
            <!-- apellidos -->
            <div class="form-group">
              <div class="input-group">
                <p>
                  <i class="fa fa-user">
                    <input type="text" class="input-lg" style="color: black" value="" name="editarApPaterno" id="editarApPaterno" size="22" required>
                    <input type="text" class=" input-lg" style="color: black" value="" name="editarApMaterno" id="editarApMaterno" size="22" required>
                  </i>

                </p>
              </div>
            </div>
            <!-- CI  -->
            <div class="form-group">
              <div class="input-group">
                <P> <i class="fa fa-credit-card"> <input type="text" class="input-lg" style="color: black" value="" name="editarCi" id="editarCi" size="40" required> </i> </p>
              </div>

            </div>
            <!-- Nro cel-->
            <div class="form-group">
              <div class="input-group">
                <i class="fa fa-phone-square"> </i>
                <input type="text" class=" input-lg" style="color: black" id="editarnrocel" name="editarnrocel" value="" required>
              </div>
            </div>

            <!-- perfil -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"> </i></span>
                <select class="form-control input-lg" name="editarPerfil">

                  <option value="" id="editarPerfil"></option>
                  <option value="Administrador">Administrador</option>
                  <option value="Kardixta">Kardixta</option>
                  <option value="Auxiliar">Auxiliar</option>
                  <option value="Becario">Becario</option>
                  <option value="Secretaria">Secretaria</option>
                </select>
              </div>
            </div>
            <!-- nombre-cuenta  -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"> </i></span>
                <input type="text" class="form-control input-lg" style="color: black" name="editarUsuario" id="editarUsuario" readonly>
              </div>
            </div>
            <!-- cargo  -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-suitcase"> </i></span>
                <input type="text" class="form-control input-lg" style="color: black" value="" name="editarcargo" id="editarcargo" required>
              </div>
            </div>


            <!-- email  -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-500px"> </i></span>
                <input type="text" class="form-control input-lg" style="color: black" name="editaremail" id="editaremail" value="" required>
              </div>
            </div>

            <!-- password -->
            <div class="form-group">

              <div class="input-group">
                <span class="input-group-addon"> <i class="fa fa-lock"></i></span>
                <input type="password" class="form-control input-lg" style="color: black" placeholder="Ingresar nueva contraseña" name="editarpassword">
                <input type="hidden" id="passwordActual" name="passwordActual">

              </div>
            </div>


            <!-- Subir foto -->
            <h4 class="modal-title">Subir Foto De Perfil</h4>
            <h4></h4>
            <div class="form-group">

              <input type="file" class="nuevafoto" name="editarfoto">
              <p class="help-block">Peso maximo de una Foto es de 2MB</p>
              <img src="vistas/img/usuarios/default/usn.png" class="img-thumbnail previsualizar" width="100px">
              <input type="hidden" name="fotoActual" id="fotoActual">

            </div>

          </div>

        </div>
        <!-- /.pie del modal-->

        <div class="modal-footer">

          <button type="button" class="btn 
                          btn-outline pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-outline">Modificar Cambios</button>

        </div>
        <?php
        $editarUsuario = new ControladorUsuarios();
        $editarUsuario->ctreditarUsuario();
        ?>
      </form>
    </div>
  </div>
  <!-- /.modal-dialog -->
</div>








<?php
$borrarUsuario = new ControladorUsuarios();
$borrarUsuario->ctrBorrarUsuario();
?>