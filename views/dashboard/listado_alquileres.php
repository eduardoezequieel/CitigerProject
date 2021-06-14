<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/admin_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
admin_Page::sidebarTemplate('Alquileres | Citiger');
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
                        <a href="#" data-toggle="modal" data-target="#administrarAlquiler" class="btn botonesListado"><span class="fas fa-plus mr-3 tamañoIconosBotones"></span>Agregar</a>
                    </div>
                      
                    <form class="mx-3">
                        <h1 class="tituloCajaTextoFormulario">Busqueda:</h1>
                        <input type="email" class="form-control buscador" id="buscar" aria-describedby="emailHelp" placeholder="Buscar...                                                                          &#xf002;">
                    </form>            
                </div>
                
            </div><br>
            <!-- Desde aqui comienza la tabla -->
            <div class="row mt-4 justify-content-center table-responsive animate__animated animate__bounceInUp tablaResponsive" id="tablaAlquileres">
                <div class="col-12 justify-content-center align-items-center text-center">
                    <table class="table table-borderless citigerTable">
                        <thead>
                            <!-- Columnas-->
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Residente</th>
                                <th scope="col">Espacio</th>
                                <th scope="col">Fecha</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="animate__animated animate__fadeIn">
                                <!-- Fotografia-->
                                <th scope="row">
                                    <div class="row paddingTh">
                                        <div class="col-12">
                                            <img src="../../resources/img/ppEdenilson.png" alt="" class="fit-images rounded-circle" width="30px" height="30px">
                                        </div>
                                    </div>
                                </th>
                                <!-- Datos-->
                                <td>Edenilson Ramírez</td>
                                <td>Piscina 2</td>
                                <td>3/4/2021</td>
                                <!-- Boton-->
                                <th scope="row">
                                    <div class="row paddingBotones">
                                        <div class="col-12">
                                            <a href="#" data-target="#administrarAlquiler" data-toggle="modal" class="btn btnTabla"><i class="fas fa-edit"></i></a>

                                            <a href="#" class="btn btnTabla2 mx-2"><i
                                            class="fas fa-trash"></i></a>
                                        </div>
                                    </div>
                                </th>
                            </tr>
                            
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
                <h5 class="modal-title tituloModal" id="exampleModalLabel"><span class="fas fa-info-circle mr-4 iconoModal"></span>Alquileres</h5>
                <!-- Boton para Cerrar -->
                <button type="button" class="close closeModalButton lead" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <br>
            <!-- Contenido del Modal -->
            <div class="textoModal px-3 pb-4">
                
                <div class="row animate__animated animate__bounceIn">
                    <!-- Primera columna de controles -->
                    <div class="col-xl-7 col-md-7 col-sm-12 col-xs-12 marginPrimeraColumna centrarColumnas">
                        <form id="EmpleadosColumna1">
                            <label class="tituloCajaTextoFormulario" for="cbResidente">Residente:</label>
                            <!-- Combobox, si se desea usar, copiar todo el div que incluye la clase
                            cbCitiger, para cambiarle el tamaño, crear un id en cbCitiger y usar el width
                            deseado en el combobox  -->
                            <div class="cbCitiger mb-2">
                                <select class="custom-select">
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
                                <select class="custom-select">
                                    <option selected="">Seleccionar...</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select> 
                            </div>

                            <label class="tituloCajaTextoFormulario mt-2" for="txtFechaAlquiler">Fecha de Alquiler:</label>
                            <input type="date" class="form-control cajaTextoFormulario" id="txtFechaAlquiler"
                                placeholder="AAAA-MM-DD">

                        </form>

                    </div>

                    <!-- Segunda columna de controles -->
                    <div class="col-xl-5 col-md-5 col-sm-12 col-xs-12 marginPrimeraColumna centrarColumnas">
                        <form>

                            <!-- Controles -->
                            <label class="tituloCajaTextoFormulario" for="txtHoraInicio">Hora inicio:</label>
                            <input type="text" class="form-control cajaTextoFormularioHora" id="txtHoraInicio"
                                placeholder="HH:MM">

                            <label class="tituloCajaTextoFormulario" for="txtHorFin">Hora fin:</label>
                            <input type="text" class="form-control cajaTextoFormularioHora" id="txtHorFin"
                                placeholder="HH:MM">

                            <label class="tituloCajaTextoFormulario" for="txtPrecio">Precio:</label>
                            <input type="text" class="form-control cajaTextoFormularioPrecio" id="txtPrecio"
                                placeholder="$00.00">
                        </form>
                    </div>
                </div>

                <!-- Botones de Acción del Formulario -->
                <div class="row justify-content-center mt-4">
                    <div class="col-12 d-flex justify-content-center align-items-center text-center">
                        <button href="#" class="btn btnAgregarFormulario mr-2"><span class="fas fa-plus mr-3 tamañoIconosBotones"></span>Agregar</button>
                        <button href="#" class="btn btnAgregarFormulario mr-2"><span class="fas fa-edit mr-3 tamañoIconosBotones"></span>Actualizar</button>
                        <button href="#" class="btn btnAgregarFormulario mr-2"><span class="fas fa-eye-slash mr-3 tamañoIconosBotones"></span>Suspender</button>
                        <button href="#" class="btn btnAgregarFormulario mr-2"><span class="fas fa-eye mr-3 tamañoIconosBotones"></span>Activar</button>
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
admin_Page::footerTemplate();
?>  