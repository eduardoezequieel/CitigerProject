<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/admin_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
Admin_Page::sidebarTemplate('Alquileres | Citiger');
?>

<!-- Contenedor de la Pagina -->
<div class="page-content p-3" id="content">
    <div id="cuadroContenido">
        <button id="sidebarCollapse" type="button" class="btn bg-darken"><i class="fa fa-bars categoriasFuente tamañoIconos"></i><small class="text-uppercase font-weight-bold"></small></button>

        <!-- Desde aqui comienza el contenido -->
        <div class="row justify-content-center mb-3 animate__animated animate__bounceIn">
            <div class="col-12 d-flex justify-content-center align-items-center">
                <h1 class="tituloPagina">Alquileres</h1>
            </div>
        </div>

        <div class="row justify-content-center mt-3 px-5 animate__animated animate__bounceIn">
            <div class="col-xl-12 d-flex justify-content-center col-md-12 col-sm-12 col-xs-12 centrarBotones">
                <div class="mt-4 mx-3 mb-3">
                    <a href="#" id="btnInsertDialog" data-toggle="modal" data-target="#verificarDui" class="btn botonesListado"><span class="fas fa-plus mr-3 tamañoIconosBotones"></span>Agregar</a>
                </div>

                <form class="mx-3" method="post" id="search-form">
                    <h1 class="tituloCajaTextoFormulario">Busqueda:</h1>
                    <input type="text" class="form-control buscador" id="search" name="search" aria-describedby="emailHelp" placeholder="{ Residente, Espacio }                                                                          &#xf002;">
                </form>

                <form method="post" id="filtrarEstadoAlquiler-form" class="mx-3">
                    <h1 class="tituloCajaTextoFormulario">Estado:</h1>
                    <!-- Combobox, si se desea usar, copiar todo el div que incluye la clase
                        cbCitiger, para cambiarle el tamaño, crear un id en cbCitiger y usar el width
                        deseado en el combobox  -->
                    <div class="cbCitigerBusqueda">
                        <select class="custom-select" id="cbEstadoAlquiler">
                            <option selected="">Seleccionar...</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <input type="number" name="idEstadoAlquiler" id="idEstadoAlquiler" class="d-none">
                    <button class="d-none" id="btnFiltrarAlquiler" type="submit"></button>
                </form>

                <div class="mt-4 mx-3 mb-3">
                    <a href="#" id="btnReiniciar" data-toggle="#" data-target="#" class="btn botonesListado"><span class="fas fa-undo mr-3 tamañoIconosBotones"></span>Reiniciar</a>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="#">
                        <a type="button" href="#" id="btnReporte" data-toggle="modal" data-target="#alquileresFecha" class="btn botonesListado"><span class="fas fa-file-alt mr-3 tamañoIconosBotones"></span>Reporte</a>
                    </div>
                </div>
            </div>

        </div><br>
        <!-- Desde aqui comienza la tabla -->
        <div class="row mt-4 justify-content-center table-responsive animate__animated animate__bounceInUp tablaResponsive">
            <div class="col-12 justify-content-center align-items-center text-center">
                <table class="table table-borderless citigerTable" id="data-table">
                    <thead>
                        <!-- Columnas-->
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Residente</th>
                            <th scope="col">Espacio</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Estado</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody id="tbody-rows">

                    </tbody>
                </table>
            </div>
        </div><br>
        <!-- Desde aqui termina la tabla -->
        <!-- Desde aqui finaliza el contenido -->

    </div>

</div>
<!-- Final del contenido -->

<!-- Modal para Administrar Alquileres -->
<div class="modal fade" id="administrarAlquiler" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content justify-content-center px-3 py-2">
            <!-- Cabecera del Modal -->
            <div class="modal-header">
                <!-- Titulo -->
                <h5 class="modal-title tituloModal"><span class="fas fa-info-circle mr-4 iconoModal"></span>Alquileres
                </h5>
                <!-- Boton para Cerrar -->
                <button type="button" class="close closeModalButton lead" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Contenido del Modal -->
            <div class="textoModal px-3 pb-4">
                <form method="post" id="alquiler-form">
                    <div class="row">
                        <!-- Primera columna de controles -->
                        <div class="col-xl-7 col-md-12 col-sm-12 col-xs-12 centrarColumnas">
                            <div id="EmpleadosColumna1">
                                <input type="number" name="idAlquiler" id="idAlquiler" class="d-none">
                                <input type="number" name="idEspacio" id="idEspacio" class="d-none">
                                <input type="number" name="idEstado" id="idEstado" class="d-none">
                                <label class="tituloCajaTextoFormulario" for="cbResidente">Residente:</label>
                                <!-- Combobox, si se desea usar, copiar todo el div que incluye la clase
                                cbCitiger, para cambiarle el tamaño, crear un id en cbCitiger y usar el width
                                deseado en el combobox  -->
                                <div class="cbCitiger mb-2">
                                    <select class="custom-select" id="cbResidente" name="cbResidente">
                                        <option selected="">Seleccionar...</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>

                                <label class="tituloCajaTextoFormulario mt-2" for="cbEspacio">Espacio:</label>
                                <!-- Combobox, si se desea usar, copiar todo el div que incluye la clase
                                cbCitiger, para cambiarle el tamaño, crear un id en cbCitiger y usar el width
                                deseado en el combobox  -->
                                <div class="cbCitiger mb-2">
                                    <select class="custom-select" id="cbEspacio" name="cbEspacio">
                                        <option selected="">Seleccionar...</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>

                                <label class="tituloCajaTextoFormulario mt-2" for="txtFechaAlquiler">Fecha de
                                    Alquiler:</label>
                                <input type="date" class="form-control cajaTextoFormulario" id="txtFecha" name="txtFecha" onchange="checkInput('txtFecha')" placeholder="AAAA-MM-DD" Required>

                            </div>

                        </div>

                        <!-- Segunda columna de controles -->
                        <div class="col-xl-5 col-md-12 col-sm-12 col-xs-12 centrarColumnas">
                            <div>
                                <!-- Controles -->
                                <label class="tituloCajaTextoFormulario" for="txtHoraInicio">Hora inicio:</label>
                                <input type="time" class="form-control cajaTextoFormularioHora" id="txtHoraInicio" name="txtHoraInicio" min="00:00" max="23:59" placeholder="HH:MM" onchange="checkInput('txtHoraInicio')" Required>

                                <label class="tituloCajaTextoFormulario" for="txtHoraFin">Hora Fin:</label>
                                <input type="time" class="form-control cajaTextoFormularioHora" id="txtHoraFin" name="txtHoraFin" min="00:00" max="23:59" placeholder="HH:MM" onchange="checkInput('txtHoraFin')" Required>

                                <label class="tituloCajaTextoFormulario" for="txtPrecio">Precio:</label>
                                <input type="number" class="form-control cajaTextoFormularioPrecio" id="txtPrecio" name="txtPrecio" placeholder="$00.00" min="0.01" step="any" onchange="checkInput('txtPrecio')" Required>
                            </div>
                        </div>
                    </div>
                    <!-- Botones de Acción del Formulario -->
                    <div class="row justify-content-center mt-4">
                        <div class="col-12 d-flex justify-content-center align-items-center text-center">
                            <button type="submit" id="btnAgregar" class="btn btnAgregarFormulario mr-2"><span class="fas fa-plus mr-3 tamañoIconosBotones"></span>Agregar</button>
                            <button type="submit" id="btnActualizar" class="btn btnAgregarFormulario mr-2"><span class="fas fa-edit mr-3 tamañoIconosBotones"></span>Actualizar</button>
                            <button id="btnFinalizar" class="btn btnAgregarFormulario mr-2"><span class="fas fa-check-double mr-3 tamañoIconosBotones"></span>Finalizar</button>
                            <button id="btnAutorizar" class="btn btnAgregarFormulario mr-2"><span class="fas fa-check mr-3 tamañoIconosBotones"></span>Autorizar</button>
                            <button id="btnDenegar" class="btn btnAgregarFormulario mr-2"><span class="fas fa-ban mr-3 tamañoIconosBotones"></span>Denegar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Fin del Modal -->
<!-- Modal para reporte de alquileres en un lapso de fechas -->
<div class="modal fade" id="alquileresFecha" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content justify-content-center px-3 py-2">
            <!-- Cabecera del Modal -->
            <div class="modal-header p-3">
                <!-- Titulo -->
                <h5 class="modal-title tituloModal" id="exampleModalLabel"><span class="fas fa-info-circle mr-4 iconoModal"></span>Alquileres</h5>
                <!-- Boton para Cerrar -->
                <a type="button" class="close closeModalButton lead" data-toggle="modal" data-target="#modalReporte" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </a>

            </div>
            <br>
            <!-- Contenido del Modal -->
            <div class="textoModal px-5 pb-5">
                <form method="post" id="fecha-form">
                    <div class="row justify-content-center">
                        <!-- Primera columna de controles -->
                        <div class="d-flex flex-column justify-content-center align-items-center col-xl-12 col-md-12 col-sm-12 col-xs-12  centrarColumnas">
                            <div class="form-group">
                                <label class="tituloCajaTextoFormulario mt-2" for="txtFecha1">Fecha de inicio:</label>
                                <input type="date" class="form-control cajaTextoFormulario" id="txtFecha1" name="txtFecha1" onchange="checkInput('txtFecha1')" placeholder="AAAA-MM-DD" Required>

                                <label class="tituloCajaTextoFormulario mt-2" for="txtFecha2">Fecha de fin:</label>
                                <input type="date" class="form-control cajaTextoFormulario" id="txtFecha2" name="txtFecha2" onchange="checkInput('txtFecha2')" placeholder="AAAA-MM-DD" Required>
                            </div>
                        </div>
                    </div>
                    <!-- Botones de Acción del Formulario -->
                    <div class="row justify-content-center mt-4">
                        <div class="col-12 d-flex justify-content-center align-items-center text-center">
                            <input type="submit" value="Generar reporte" class="btn btnAgregarFormulario mr-2">

                        </div>
                    </div>
                </form>
                <!-- Fin del Contenido del Modal -->
            </div>
        </div>
    </div>
</div>

<!-- Modal para ver denuncias-->
<div class="modal fade" id="verAlquiler" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content justify-content-center px-3 py-2">
            <!-- Cabecera del Modal -->
            <div class="modal-header">
                <!-- Titulo -->
                <h5 class="modal-title tituloModal" id="exampleModalLabel"><span class="fas fa-info-circle mr-4 iconoModal"></span>Alquileres</h5>
                <!-- Boton para Cerrar -->
                <a type="button" class="close closeModalButton lead" data-toggle="modal" data-target="#modalReporte" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </a>
            </div>
            <br>
            <!-- Contenido del Modal -->
            <div class="textoModal px-3 pb-4 mt-2">
                <form method="post" id="verAlquiler-form">
                    <input type="number" class="d-none" id="idAlquiler2" name="idAlquiler2">
                    <div class="row">
                        <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12">

                            <h1 class="tituloDato text-center">Residente</h1>
                            <h1 class="campoDato text-center mb-3" id="lblResidente">Juan Carti</h1>

                            <h1 class="tituloDato text-center">Fecha</h1>
                            <h1 class="campoDato text-center mb-3" id="lblFecha">11/6/2021</h1>

                            <h1 class="tituloDato text-center">Espacio</h1>
                            <h1 class="campoDato text-center mb-3" id="lblEspacio">Cancha</h1>

                        </div>

                        <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12">
                            <h1 class="tituloDato text-center">Hora de inicio</h1>
                            <h1 class="campoDato text-center mb-3" id="lblInicio">10:00</h1>

                            <h1 class="tituloDato text-center">Hora fin</h1>
                            <h1 class="campoDato text-center mb-3" id="lblFin">11:08</h1>

                            <h1 class="tituloDato text-center">Precio</h1>
                            <p class="campoDato mb-3 text-center">$ <b class="campoDato mb-3" id="lblPrecio">54</b></p>
                            </h1>
                        </div>
                    </div>
                </form>
                <br>
                <!-- Fin del Contenido del Modal -->
            </div>
        </div>
    </div>
</div>
<!-- Fin del Modal -->

<!-- Modal para verificar DUI para poder crear un alquiler -->
<div class="modal fade" id="verificarDui" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content justify-content-center px-3 py-2">
            <!-- Cabecera del Modal -->
            <div class="modal-header">
                <!-- Titulo -->
                <h5 class="modal-title tituloModal" id="exampleModalLabel"><span class="fas fa-info-circle mr-4 iconoModal"></span>Verificar DUI</h5>
                <!-- Boton para Cerrar -->
                <button type="button" class="close closeModalButton lead" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Contenido del Modal -->
            <div class="textoModal modal-body px-3 pb-4 mt-2">
                <div class="row">
                    <div class="col-12">
                        <h1 class="tituloDato2  ">Ingrese el DUI del residente.</h1>
                    </div>
                </div>
                <form method="post" id="verificarDui-form"  autocomplete="off">
                    <div class="row mt-2">
                        <div class="col-12 d-flex justify-content-center">
                            <div class="form-group">
                                <label class="tituloCajaTextoFormulario" for="txtDuiVerificar">DUI:</label>
                                <input type="text" onchange="checkDui('txtDuiVerificar')" class="form-control cajaTextoFormulario" id="txtDuiVerificar" name="txtDuiVerificar" placeholder="12345678-9" Required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center">
                            <button data-toggle="modal" data-target="#seleccionarEspacio" data-dismiss="modal" class="btn btnAgregarFormulario mr-2"><span class="fas fa-chevron-right mr-3 tamañoIconosBotones"></span>Continuar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Fin del Modal -->

<!-- Modal para seleccionar un lugar de alquiler -->
<div class="modal fade" id="seleccionarEspacio" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content justify-content-center px-3 py-2">
            <!-- Cabecera del Modal -->
            <div class="modal-header">
                <!-- Titulo -->
                <h5 class="modal-title tituloModal" id="exampleModalLabel"><span class="fas fa-info-circle mr-4 iconoModal"></span>Seleccionar espacio</h5>
                <!-- Boton para Cerrar -->
                <button type="button" class="close closeModalButton lead" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Contenido del Modal -->
            <div class="textoModal modal-body px-3 pb-4 mt-2">
                <div class="row">
                    <div class="col-12">
                        <h1 class="tituloDato2">Selecciona espacio para el alquiler</h1>
                    </div>
                </div>
                <form method="post" id="seleccionarEspacio-form" autocomplete="off">
                    <div
                        class="animate__animated animate__bounceIn col-xl-4 col-md-4 col-sm-12 col-xs-12 mt-4 d-flex margenTarjetas justify-content-center align-items-center text-center">
                        <!-- Inicio de Tarjeta -->
                        <div class="tarjeta">
                            <!-- Fila para Imagen -->
                            <div class="row">
                                <div class="col-12">
                                    <img src="../../resources/img/dashboard_img/espacios_fotos/${row.imagenprincipal}"
                                        alt="#" class="img-fluid fit-images fotoEspacio imagenTarjeta">
                                </div>
                            </div>
                            <!-- Fila para Información -->
                            <div class="row mt-2">
                                <div class="col-12 text-left">
                                    <h1 class="letraTarjetaTitulo">${row.nombre}</h1>
                                    <h1 class="letraTarjeta">Capacidad: <span
                                            class="letraDestacadaTarjeta">${row.capacidad}</span></h1>
                                </div>
                            </div>
                            <!-- Fila para Boton -->
                            <div class="row">
                                <div class="col-12">
                                    <button class="btn botonesTarjeta"><span class="fas fa-plus mr-2"></span>Agregar</button>
                                </div>
                            </div>
                            <!-- Fin de Tarjeta -->
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Fin del Modal -->
<?php
//Se imprimen los JS necesarios
Admin_Page::footerTemplate('alquileresss.js');
?>