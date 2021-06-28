<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/admin_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
admin_Page::sidebarTemplate('Denuncias | Citiger');
?>    
    
    <!-- Contenedor de la Pagina -->
    <div class="page-content p-3" id="content">
        <div id="cuadroContenido2">
            <button id="sidebarCollapse" type="button" class="btn bg-darken"><i class="fa fa-bars categoriasFuente tamañoIconos"></i><small class="text-uppercase font-weight-bold"></small></button>
        
            <!-- Desde aqui comienza el contenido -->
            <div class="row justify-content-center mb-3 animate__animated animate__bounceIn">
                <div class="col-12 d-flex justify-content-center align-items-center">
                    <h1 class="tituloPagina">Denuncias</h1>
                </div>
            </div>

            <!-- Controles del Inicio -->
            <div class="row justify-content-center mt-3 px-5 animate__animated animate__bounceIn">
                <div class="col-xl-12 d-flex justify-content-center col-md-12 col-sm-12 col-xs-12 centrarBotones">  
                    <form class="mx-3">
                        <h1 class="tituloCajaTextoFormulario">Busqueda:</h1>
                        <input type="email" class="form-control buscador" id="buscar" aria-describedby="emailHelp" placeholder="Buscar...                                                                          &#xf002;">
                    </form>   
                    <form class="mx-3">
                        <h1 class="tituloCajaTextoFormulario">Estado:</h1>
                        <!-- Combobox, si se desea usar, copiar todo el div que incluye la clase
                        cbCitiger, para cambiarle el tamaño, crear un id en cbCitiger y usar el width
                        deseado en el combobox  -->
                        <div class="cbCitigerBusqueda">
                            <select class="custom-select">
                                <option selected="">Seleccionar...</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select> 
                        </div>
                    </form>         
                </div>
                
            </div><br>
            <!-- Desde aqui comienza la tabla -->
            <div class="row mt-4 justify-content-center table-responsive animate__animated animate__bounceInUp tablaResponsive">
                <div class="col-12 justify-content-center align-items-center text-center">
                    <table class="table table-borderless citigerTable">
                        <thead>
                            <!-- Columnas-->
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Residente</th>
                                <th scope="col">Tipo</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Fecha</th>
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

<!-- Modal para Administrar Denuncias -->
<div class="modal fade" id="administrarDenunciaPendiente" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content justify-content-center px-3 py-2">
            <!-- Cabecera del Modal -->
            <div class="modal-header">
                <!-- Titulo -->
                <h5 class="modal-title tituloModal" id="exampleModalLabel"><span class="fas fa-info-circle mr-4 iconoModal"></span>Denuncias</h5>
                <!-- Boton para Cerrar -->
                <button type="button" class="close closeModalButton lead" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <br>
            <!-- Contenido del Modal -->
            <div class="textoModal px-3 pb-4 mt-2">
                <form method="post" id="administrarDenunciaPendiente-form">
                <input type="number" class="d-none" name="idDenuncia1" id="idDenuncia1">
                    <div class="row">
                        <div class="col-xl-6 col-md-12 col-sm-12 col-xs-12">
                            <h1 class="tituloDato text-center">Residente</h1>
                            <h1 class="campoDato text-center mb-3" id="txtResidente">Eduardo Rivera</h1>

                            <h1 class="tituloDato text-center">Tipo de Denuncia</h1>
                            <h1 class="campoDato text-center mb-3" id="txtTipoDenuncia">Mantenimiento</h1>

                            <h1 class="tituloDato text-center">Fecha</h1>
                            <h1 class="campoDato text-center mb-3" id="txtFecha">11/6/2021</h1>

                            <h1 class="tituloDato text-center">Estado</h1>
                            <h1 class="campoDato text-center mb-3" id="txtEstadoDenuncia">Pendiente</h1>
                        </div>
                        <div class="col-xl-6 col-md-12 col-sm-12 col-xs-12">
                            <textarea name="txtDescripcion" id="txtDescripcion" rows="11" class="form-control cajaTextoFormulario" readonly>Texto de ejemplo</textarea>
                        </div>
                    </div>
                    
                    <!-- Botones de Acción del Formulario -->
                    <div class="row justify-content-center mt-4">
                        <div class="col-12 d-flex justify-content-center align-items-center text-center">
                            <button id="btnAceptar" data-toggle="modal" data-dismiss="modal" class="btn btnAgregarFormulario mr-2"><span class="fas fa-check mr-3 tamañoIconosBotones"></span>Aceptar</button>
                            <button id="btnRechazar" data-toggle="modal" data-dismiss="modal" data-target="#administrarDenunciaRechazada" class="btn btnAgregarFormulario mr-2"><span class="fas fa-times mr-3 tamañoIconosBotones"></span>Rechazar</button>
                        </div>
                    </div>
                    <!-- Fin del Contenido del Modal -->
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Fin del Modal -->

<!-- Modal para Administrar Denuncias Rechazadas -->
<div class="modal fade" id="administrarDenunciaRechazada" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content justify-content-center px-3 py-2">
            <!-- Cabecera del Modal -->
            <div class="modal-header">
                <!-- Titulo -->
                <h5 class="modal-title tituloModal" id="exampleModalLabel"><span class="fas fa-info-circle mr-4 iconoModal"></span>Denuncias</h5>
                <!-- Boton para Cerrar -->
                <button type="button" class="close closeModalButton lead" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <br>
            <!-- Contenido del Modal -->
            <div class="textoModal px-3 pb-4 mt-2">
                <div class="row justify-content-center">
                    <div class="col-12 d-flex flex-column justify-content-center align-items-center">
                        <h1 class="campoDato text-center mb-2">¿Por qué ha sido rechazada está denuncia?</h1>
                        <textarea name="#" id="#" rows="8" class="form-control cajaTextoFormulario"></textarea>
                    </div>
                </div>
                <!-- Botones de Acción del Formulario -->
                <div class="row justify-content-center mt-4">
                    <div class="col-12 d-flex justify-content-center align-items-center text-center">
                        <button href="#" class="btn btnAgregarFormulario mr-2"><span class="fas fa-check mr-3 tamañoIconosBotones"></span>Aceptar</button>
                        <button href="#" data-toggle="modal" data-dismiss="modal" data-target="#administrarDenunciaPendiente" class="btn btnAgregarFormulario mr-2"><span class="fas fa-undo mr-3 tamañoIconosBotones"></span>Revertir</button>
                    </div>
                </div>
                <!-- Fin del Contenido del Modal -->
            </div>
        </div>
    </div>
</div>
<!-- Fin del Modal -->

<!-- Modal para Administrar el empleado que se asignara a la denuncia -->
<div class="modal fade" id="administrarDenunciaAsignar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content justify-content-center px-3 py-2">
            <!-- Cabecera del Modal -->
            <div class="modal-header">
                <!-- Titulo -->
                <h5 class="modal-title tituloModal" id="exampleModalLabel"><span class="fas fa-info-circle mr-4 iconoModal"></span>Denuncias</h5>
                <!-- Boton para Cerrar -->
                <button type="button" class="close closeModalButton lead" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <br>
            <!-- Contenido del Modal -->
            <div class="textoModal px-3 pb-4 mt-2">
                
                <div class="row">
                    <div class="col-12">
                        <h1 class="campoDato text-center mb-3">¿Qué empleado se encargará de solucionar está denuncia?</h1>

                        <h1 class="tituloDato text-center">Tipo de Denuncia</h1>
                        <h1 class="campoDato text-center mb-3">Mantenimiento</h1>

                        <div class="form-group d-flex justify-content-center mt-3 flex-column-media">
                            <form class="mx-2">
                                <h1 class="tituloCajaTextoFormulario">Tipo de Empleado:</h1>
                                <!-- Combobox, si se desea usar, copiar todo el div que incluye la clase
                                cbCitiger, para cambiarle el tamaño, crear un id en cbCitiger y usar el width
                                deseado en el combobox  -->
                                <div class="cbCitiger">
                                    <select class="custom-select">
                                        <option selected="">Seleccionar...</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select> 
                                </div>
                            </form>
                            <div id="marginSelectEmpleado" class="mx-2">
                                <h1 class="tituloCajaTextoFormulario">Empleado:</h1>
                                <!-- Combobox, si se desea usar, copiar todo el div que incluye la clase
                                cbCitiger, para cambiarle el tamaño, crear un id en cbCitiger y usar el width
                                deseado en el combobox  -->
                                <div class="cbCitiger">
                                    <select class="custom-select">
                                        <option selected="">Seleccionar...</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Botones de Acción del Formulario -->
                <div class="row justify-content-center mt-2">
                    <div class="col-12 d-flex justify-content-center align-items-center text-center">
                        <button href="#" data-toggle="modal" data-dismiss="modal" data-target="#administrarDenunciaEnSolucion" class="btn btnAgregarFormulario mr-2"><span class="fas fa-check mr-3 tamañoIconosBotones"></span>Aceptar</button>
                        <button href="#" data-toggle="modal" data-dismiss="modal" data-target="#administrarDenunciaPendiente" class="btn btnAgregarFormulario mr-2"><span class="fas fa-undo mr-3 tamañoIconosBotones"></span>Revertir</button>
                    </div>
                </div>
                <!-- Fin del Contenido del Modal -->
            </div>
        </div>
    </div>
</div>
<!-- Fin del Modal -->

<!-- Modal para Administrar Denuncias en proceso de solución/finalizadas -->
<div class="modal fade" id="administrarDenunciaEnSolucion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content justify-content-center px-3 py-2">
            <!-- Cabecera del Modal -->
            <div class="modal-header">
                <!-- Titulo -->
                <h5 class="modal-title tituloModal" id="exampleModalLabel"><span class="fas fa-info-circle mr-4 iconoModal"></span>Denuncias</h5>
                <!-- Boton para Cerrar -->
                <button type="button" class="close closeModalButton lead" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <br>
            <!-- Contenido del Modal -->
            <div class="textoModal px-3 pb-4 mt-2">
                <div class="row">
                    <div class="col-xl-6 col-md-12 col-sm-12 col-xs-12">
                        <h1 class="tituloDato text-center">Residente</h1>
                        <h1 class="campoDato text-center mb-3">Eduardo Rivera</h1>

                        <h1 class="tituloDato text-center">Tipo de Denuncia</h1>
                        <h1 class="campoDato text-center mb-3">Mantenimiento</h1>

                        <h1 class="tituloDato text-center">Fecha</h1>
                        <h1 class="campoDato text-center mb-3">11/6/2021</h1>

                        <h1 class="tituloDato text-center">Estado</h1>
                        <h1 class="campoDato text-center mb-3">Pendiente</h1>

                        <h1 class="tituloDato text-center">Empleado Asignado</h1>
                        <h1 class="campoDato text-center mb-3">Edenilson Ramírez</h1>
                    </div>
                    <div class="col-xl-6 col-md-12 col-sm-12 col-xs-12">
                        <textarea name="#" id="#" rows="14" class="form-control cajaTextoFormulario" readonly>Texto de ejemplo</textarea>
                    </div>
                </div>
                
                <!-- Botones de Acción del Formulario -->
                <div class="row justify-content-center mt-4">
                    <div class="col-12 d-flex justify-content-center align-items-center text-center">
                        <button href="#" data-dismiss="modal" class="btn btnAgregarFormulario mr-2"><span class="fas fa-check mr-3 tamañoIconosBotones"></span>Finalizar</button>
                    </div>
                </div>
                <!-- Fin del Contenido del Modal -->
            </div>
        </div>
    </div>
</div>
<!-- Fin del Modal -->

<?php
//Se imprimen los JS necesarios
admin_Page::footerTemplate('denuncias.js');
?>  