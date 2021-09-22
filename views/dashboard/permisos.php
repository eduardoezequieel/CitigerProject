<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/admin_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
admin_Page::sidebarTemplate('Permisos | Citiger');
?>

<!-- Contenedor de la Pagina -->
<div class="page-content p-3" id="content">
    <div id="cuadroContenido">
        <button id="sidebarCollapse" type="button" class="btn bg-darken"><i class="fa fa-bars categoriasFuente tamañoIconos"></i><small class="text-uppercase font-weight-bold"></small></button>

        <!-- Desde aqui comienza el contenido -->
        <div class="row justify-content-center mb-3">
            <div class="col-12 d-flex justify-content-center align-items-center">
                <h1 class="tituloPagina">Permisos</h1>
            </div>
        </div>

        <div class="row justify-content-center mt-3 px-5 animate__animated animate__bounceIn">
            <div class="col-xl-12 d-flex justify-content-center col-md-12 col-sm-12 col-xs-12 centrarBotones">
                <div class="mt-4 mx-3 mb-3">
                    <a href="#" id="btnInsertDialog" data-toggle="modal" data-target="#administrarTipoUsuario" class="btn botonesListado"><span class="fas fa-plus mr-3 tamañoIconosBotones"></span>Agregar</a>

                </div>

                <form class="mx-3" method="post" id="search-form">
                    <h1 class="tituloCajaTextoFormulario">Busqueda:</h1>
                    <input type="text" class="form-control buscador" id="search" name="search" aria-describedby="emailHelp" placeholder="{ Tipo de Usuario }                                                                          &#xf002;">
                </form>

                <div class="mt-4 mx-3 mb-3">
                    <a href="#" id="btnReiniciar" data-toggle="#" data-target="#" class="btn botonesListado"><span class="fas fa-undo mr-3 tamañoIconosBotones"></span>Reiniciar</a>
                </div>
            </div>

        </div><br>
        <!-- Desde aqui comienza la tabla -->
        <div class="row mt-3 justify-content-center table-responsive animate__animated animate__bounceInUp tablaResponsive">
            <div class="col-12 justify-content-center align-items-center text-center">
                <table class="table table-borderless citigerTable" id="data-table">
                    <thead>
                        <!-- Columnas-->
                        <tr>
                            <th scope="col">Tipo de Usuario</th>
                            <th scope="col">Permisos</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody id="tbody-rows">
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Desde aqui termina la tabla -->
        <!-- Desde aqui finaliza el contenido -->
    </div>
</div>
<!-- Final del contenido -->

<!-- Modal para verificar el codigo de verificación en la recuperación de contraseña -->
<div class="modal fade" id="administrarTipoUsuario" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg modal-dialog-centered">
        <div class="modal-content justify-content-center px-3 py-2">
            <!-- Cabecera del Modal -->
            <div class="modal-header">
                <!-- Titulo -->
                <h5 class="modal-title"><span class="fas fa-info-circle mr-4 iconoModal"></span><span id="tituloModal" class="tituloModal"></span></h5>
                <!-- Boton para Cerrar -->
                <button type="button" class="close closeModalButton lead" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <!-- Contenido del Modal -->
            <div class="modal-body textoModal px-3 pb-4 mt-2">
                <form action="/form" autocomplete="off" method="post" id="create-form">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center align-items-center">
                            <div class="form-group">
                                <label class="tituloCajaTextoFormulario" for="txtTipoUsuario">Tipo de Usuario:</label>
                                <input onchange="checkInputLetras('txtTipoUsuario')" maxlength="15" type="text" class="form-control cajaTextoFormulario" id="txtTipoUsuario" name="txtTipoUsuario" placeholder="Bodega" Required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label class="tituloCajaTextoFormulario">Permisos que tendra disponibles:</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="d-flex flex-column justify-content-center align-items-center col-xl-6 col-md-12 col-sm-12 col-xs-12">
                            <div class="btn-group-toggle" data-toggle="buttons">
                                <label id="btnAlquileres" class="btn shadow-none botonesCheckbox">
                                    <input onchange="changeStyle('btnAlquileres', 'alquileresValue', 'lblAlquileresValue')" type="checkbox">
                                    <i class="fas fa-home mr-2"></i>
                                        Alquileres <br>
                                        Administra los alquileres y espacios de la residencial. <br>
                                        <span id="lblAlquileresValue" class="float-right mt-1">Desactivado.</span>
                                    <input id="alquileresValue" type="hidden" value="Desactivado">
                                </label>
                            </div>
                            <div class="btn-group-toggle" data-toggle="buttons">
                                <label id="btnAportaciones" class="btn shadow-none botonesCheckbox">
                                    <input onchange="changeStyle('btnAportaciones', 'aportacionesValue', 'lblAportacionesValue')" type="checkbox">
                                    <i class="fas fa-coins mr-2"></i>
                                        Aportaciones <br>
                                        Mantiene un control de las casas y sus respectivas aportaciones. <br>
                                        <span id="lblAportacionesValue" class="float-right mt-1">Desactivado.</span>
                                    <input id="aportacionesValue" type="hidden" value="Desactivado">
                                </label>
                            </div>
                            <div class="btn-group-toggle" data-toggle="buttons">
                                <label id="btnDenuncia" class="btn shadow-none botonesCheckbox">
                                    <input onchange="changeStyle('btnDenuncia', 'denunciaValue', 'lblDenunciaValue')" type="checkbox">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                        Denuncias <br>
                                        Administra las denuncias para solucionarlas o denegarlas. <br>
                                        <span id="lblDenunciaValue" class="float-right mt-1">Desactivado.</span>
                                    <input id="denunciaValue" type="hidden" value="Desactivado">
                                </label>
                            </div>
                            
                        </div>
                        <div class="d-flex flex-column justify-content-center align-items-center col-xl-6 col-md-12 col-sm-12 col-xs-12">
                            <div class="btn-group-toggle" data-toggle="buttons">
                                <label id="btnMateriales" class="btn shadow-none botonesCheckbox">
                                    <input onchange="changeStyle('btnMateriales', 'materialesValue', 'lblMaterialesValue')" type="checkbox">
                                    <i class="fas fa-boxes mr-2"></i>
                                        Materiales <br>
                                        Agrega materiales al inventario y crea registros de materiales utilizados. <br>
                                        <span id="lblMaterialesValue" class="float-right mt-1">Desactivado.</span>
                                    <input id="materialesValue" type="hidden" value="Desactivado">
                                </label>
                            </div>
                            <div class="btn-group-toggle" data-toggle="buttons">
                                <label id="btnUsuarios" class="btn shadow-none botonesCheckbox">
                                    <input onchange="changeStyle('btnUsuarios', 'usuariosValue', 'lblUsuariosValue')" type="checkbox">
                                    <i class="fas fa-user-cog mr-2"></i>
                                        Usuarios <br>
                                        Crea y administra las entidades que manejan el sistema. <br>
                                        <span id="lblUsuariosValue" class="float-right mt-1">Desactivado.</span>
                                    <input id="usuariosValue" type="hidden" value="Desactivado">
                                </label>
                            </div>
                            <div class="btn-group-toggle" data-toggle="buttons">
                                <label id="btnVisitas" class="btn shadow-none botonesCheckbox">
                                    <input onchange="changeStyle('btnVisitas', 'visitasValue', 'lblVisitasValue')" type="checkbox">
                                    <i class="fas fa-car mr-2"></i>
                                        Visitas <br>
                                        Crea y administra registros de todas las personas que ingresan a la residencial. <br>
                                        <span id="lblVisitasValue" class="float-right mt-1">Desactivado.</span>
                                    <input id="visitasValue" type="hidden" value="Desactivado">
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-12 d-flex justify-content-center align-items-center">
                            <div class="form-group">
                                <label class="tituloCajaTextoFormulario" for="txtContrasenaActual">Contraseña Actual:</label>
                                <input onChange="checkContrasena('txtContrasenaActual')" type="password" class="form-control cajaTextoModal2" id="txtContrasenaActual" name="txtContrasenaActual" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-12 d-flex justify-content-center align-items-center">
                            <div class="custom-control custom-switch">
                                <input onchange="showHidePassword2('cbMostrarContraseña', 'txtContrasenaActual')" type="checkbox" class="p-0 custom-control-input" id="cbMostrarContraseña">
                                <label class="p-0 custom-control-label" for="cbMostrarContraseña">Mostrar Contraseña</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 d-flex justify-content-end align-items-end">
                            <button type="submit" class="btn botonesListado"><span class="fas fa-check tamañoIconosBotones mr-3"></span>Agregar</button>
                        </div>
                    </div>
                </form>
                <!-- Fin del Contenido del Modal -->
            </div>
        </div>
    </div>
</div>
<!-- Fin del Modal -->


<?php
//Se imprimen los JS necesarios
admin_Page::footerTemplate('permisos.js');
?>