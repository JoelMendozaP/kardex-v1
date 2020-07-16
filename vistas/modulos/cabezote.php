<style>
	@font-face {
		font-family: 'code_boldregular';
		src: url('code_bold-webfont.eot');
		src: url('code_bold-webfont.eot?#iefix') format('embedded-opentype'),
			url('code_bold-webfont.svg#code_boldregular') format('svg');
		font-weight: normal;
		font-style: normal;
	}

	* {
		font-family: 'code_boldregular';
	}

	body {
		background-image: url(back.jpg);
	}

	#contReloj {
		background: skyblue;
		text-align: center;
		color: blanchedalmond;
		font-size: 20px;
		width: 300px;
		height: 55px;
		display: inline-block;
		font-family: 'code_boldregular';
		
	}

	#sle {
		border: 1px solid #999;
		border-radius: 0.4em;
		padding: 0 1em;
		margin: 0 1em 1em 1em;
		display: table;
		width: 50%;
		display: block;
		margin-inline-start: 2px;
		margin-inline-end: 2px;
		padding-block-start: 0.35em;
		padding-inline-start: 0.75em;
		padding-inline-end: 0.75em;
		padding-block-end: 0.625em;
		min-inline-size: min-content;
		border-width: 2px;
		border-style: groove;
		border-color: threedface;
		border-image: initial;
		background: #bbe1fa;
		color: #1b262c;
	}

	.icono-nosotros {
		display: flex;
		justify-content: space-between;
	}
</style>




<header class="main-header">
	<!--=====================================
	LOGOTIPO
	======================================-->
	<a href="inicio" class="logo">

		<!-- logo mini -->
		<span class="logo-mini">

			<img src="vistas/img/plantilla/normal.jpg" class="img-responsive" style="padding:5px">

		</span>

		<!-- logo normal -->

		<span class="logo-lg">

			<img src="vistas/img/plantilla/logo.jpg" class="img-responsive" style="padding:3px 0px">

		</span>

	</a>

	<!--=====================================
	BARRA DE NAVEGACIÓN
	======================================-->
	<nav class="navbar navbar-static-top" role="navigation">

		<!-- Botón de navegación -->

		<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">

		</a>
		<section id="contReloj"> <a id="pHoras"> </a> :<a id="pMinutos"> </a> :<a id="pSegundos"> </a> <a id="contSaludo"> </a>
			<br>
			<section> <a id="dia"> </a> / <a id="mes"> </a> /<a id="anio"> </a> </section>
		</section>
		
		<script type="text/javascript">
			function ActualizarHora() {
				var fecha = new Date();
				var segundos = fecha.getSeconds();
				var minutos = fecha.getMinutes();
				var horas = fecha.getHours();

				var hoy = new Date();
				var dd = hoy.getDate();
				var mm = hoy.getMonth() + 1;
				var yyyy = hoy.getFullYear();


				var elementoHoras = document.getElementById("pHoras");
				var elementoMinutos = document.getElementById("pMinutos");
				var elementoSegundos = document.getElementById("pSegundos");
				var pSaludo = document.getElementById("contSaludo");

				elementoHoras.textContent = horas;
				elementoMinutos.textContent = minutos;
				elementoSegundos.textContent = segundos;


				if (horas >= 8 && minutos >= 1 && horas < 12) {
					pSaludo.textContent = "Buenos Días";
				}
				if (horas >= 12 && minutos >= 1 && horas < 19) {
					pSaludo.textContent = "Buenas Tardes";
				}
				if (horas >= 19 && minutos >= 1) {
					pSaludo.textContent = "Buenas Noches";
				}
				

				if (dd < 10) {
					dd = '0' + dd;
				}

				if (mm < 10) {
					mm = '0' + mm;
				}


				var elementoanio = document.getElementById("anio");
				var elementomes = document.getElementById("mes");
				var elementodia = document.getElementById("dia");

				elementoanio.textContent = yyyy;
				elementomes.textContent = mm;
				elementodia.textContent = dd;
			}
			setInterval(ActualizarHora, 1000);
			function addZero(i) {
				if (i < 10) {
					i = '0' + i;
				}
				return i;
			}
		</script>
		<!-- perfil de usuario -->

		<div class="navbar-custom-menu">

			<ul class="nav navbar-nav">

				<li class="dropdown user user-menu">

					<a href="#" class="dropdown-toggle" data-toggle="dropdown">

						<?php

						if ($_SESSION["foto"] != "") {

							echo '<img src="' . $_SESSION["foto"] . '" class="user-image">';
						} else {
							echo '<img src="vistas/img/usuarios/default/usn.png" class="user-image">';
						}
						?>

						<span class="hidden-xs"><?php

												$nombre = $_SESSION["nombre"] . " - " . $_SESSION["ap_paterno"] . ' - ' . $_SESSION["ap_materno"];

												echo   $nombre;

												?>

						</span>

					</a>
							<ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
			    
				  <?php

						if ($_SESSION["foto"] != "") {

							echo '<img src="' . $_SESSION["foto"] . '" class="img-circle" alt="User Image">';
						} else {
							echo '<img src="vistas/img/usuarios/default/usn.png" class="img-circle" alt="User Image">';
						}
						?>
                <p>
				<?php
                    $nombre = $_SESSION["nombre"] . " - " . $_SESSION["ap_paterno"] . ' - ' . $_SESSION["ap_materno"];
					echo   $nombre;

					echo '<small> <p>'.$_SESSION["perfil"].'</p></small>';
					?>
                  
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
					<a href="https://mail.google.com/" target="_blank"> <b> GMAIL</b>
					<p class="btn btn-social-icon btn-google"><i class="fa fa-google-plus"></i></p></a>
                  </div>
                  <div class="col-xs-4 text-center">
					<a href="https://www.youtube.com/" target="_blank"><b> YOU TUBE</b> 
					<p class="btn btn-social-icon bg-red-active"><i class="glyphicon glyphicon-expand"></i></p></a>
                  </div>
                  <div class="col-xs-4 text-center">
					<a href="https://www.facebook.com/" target="_blank"><b>FACEBOOK </b> 
			        <p class="btn btn-social-icon btn-facebook"><i class="fa fa-facebook"></i></p></a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer bg-purple-gradient">
                <div class="pull-left">
                  <a href="https://web.whatsapp.com/" target="_blank" class="btn bg-green-active btn-flat">Whatsaap Web</a>
                </div>
                <div class="pull-right">
				<a href="salir" class="btn btn-dropbox btn-flat ">Cerrar Secion</a>
                </div>
              </li>
            </ul>


			
						<!-- </li>

					</ul> -->

				</li>

			</ul>

		</div>

	</nav>


</header>

