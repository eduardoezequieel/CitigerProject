<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/admin_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
admin_Page::sidebarTemplate('Aportaciones | Citiger');
?>    
    
    <!-- Contenedor de la Pagina -->
    <div class="page-content p-3" id="content">
        <div id="cuadroContenido">
            <button id="sidebarCollapse" type="button" class="btn bg-darken"><i class="fa fa-bars categoriasFuente tamañoIconos"></i><small class="text-uppercase font-weight-bold"></small></button>
        
            <!-- Desde aqui comienza el contenido -->
            <div class="row justify-content-center mb-3 animate__animated animate__bounceIn">
                <div class="col-12 d-flex justify-content-center align-items-center">
                    <h1 class="tituloPagina text-center">Casas</h1>
                </div>
            </div>

            <div class="row justify-content-center mt-3 px-5 animate__animated animate__bounceIn">
                <div class="col-xl-12 d-flex justify-content-center col-md-12 col-sm-12 col-xs-12 centrarBotones">
                    <div class="mt-4 mx-3 mb-3">
                        <a href="#" data-toggle="modal" data-target="#administrarCasa" class="btn botonesListado"><span class="fas fa-plus mr-3 tamañoIconosBotones"></span>Agregar</a>
                    </div>
                      
                    <form class="mx-3">
                        <h1 class="tituloCajaTextoFormulario">Busqueda:</h1>
                        <input type="email" class="form-control buscador" id="buscar" aria-describedby="emailHelp" placeholder="Buscar...                                                                          &#xf002;">
                    </form>   
                    
                    
                </div>
                
            </div><br>

            
            <!-- Desde aqui comienza la tabla -->
            <div class="row mt-4 justify-content-center table-responsive animate__animated animate__bounceInUp tablaResponsive" id="tablaCasasPendientes">
                <div class="col-12 justify-content-center align-items-center text-center">
                    <table class="table table-borderless citigerTable">
                        <thead>
                            <!-- Columnas-->
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Casa</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Dueño</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="animate__animated animate__fadeIn">
                                <!-- Fotografia-->
                                <th scope="row">
                                    <div class="row paddingTh">
                                        <div class="col-12">
                                            <img src="../../resources/img/bluehouse.png" alt="" class="img-fluid" width="30px">
                                        </div>
                                    </div>
                                </th>
                                <!-- Datos-->
                                <td>#69 ETAPA 3 BLOCK 6</td>
                                <td>Disponible</td>
                                <td>Eduardo Rivera</td>
                                <!-- Boton-->
                                <th scope="row">
                                    <div class="row paddingBotones">
                                        <div class="col-12">
                                            <a href="#" data-toggle="modal" data-target="#administrarCasa" class="btn btnTabla"><i class="fas fa-edit"></i></a>
                                            <a href="#" data-toggle="modal" data-target="#administrarPago" class="btn btnTabla3"><i class="fas fa-comment-dollar"></i></a>
                                            <a href="ventana_pago.php" class="btn btnTabla2"><i class="fas fa-trash"></i></a>
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

<!-- Modal para Administrar Casa -->
<div class="modal fade" id="administrarCasa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content justify-content-center px-3 py-2">
            <!-- Cabecera del Modal -->
            <div class="modal-header">
                <!-- Titulo -->
                <h5 class="modal-title tituloModal" id="exampleModalLabel"><span class="fas fa-info-circle mr-4 iconoModal"></span>Casas</h5>
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
                        <form>
                            <label class="tituloCajaTextoFormulario" for="txtTelefono">Número de Casa:</label>
                            <input type="text" class="form-control cajaTextoModal" id="txtTelefonomovil"
                            placeholder="Escriba el número de casa...">

                            <label class="tituloCajaTextoFormulario" for="txtTelefono">Ubicación:</label>
                            <textarea class="form-control cajaTextoModal" rows="3" placeholder="Escriba los detallles de la ubicación de la casa..."></textarea>
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

<!-- Modal para Administrar Pagos -->
<div class="modal fade" id="administrarPago" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content justify-content-center px-3 py-2">
            <!-- Cabecera del Modal -->
            <div class="modal-header">
                <!-- Titulo -->
                <h5 class="modal-title tituloModal" id="exampleModalLabel"><span class="fas fa-info-circle mr-4 iconoModal"></span>Pagos</h5>
                <!-- Boton para Cerrar -->
                <button type="button" class="close closeModalButton lead" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <br>
            <!-- Contenido del Modal -->
            <div class="textoModal px-3 pb-4 mt-2">
                <!-- Desde aqui comienza el contenido -->
                <div class="row justify-content-center mb-3">
                    <div class="col-12 d-flex justify-content-center align-items-center">
                        <h1 class="tituloPagina text-center">Registro de Aportaciones</h1>
                    </div>
                </div>

                <div class="row justify-content-center mb-3">
                    <div class="col-12 d-flex justify-content-center">
                        <form class="mx-3">
                            <h1 class="tituloCajaTextoFormulario">Año:</h1>
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
                    </div>
                </div>

                <!-- Información de la Casa -->
                <div class="row justify-content-center">
                    <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 d-flex justify-content-center align-items-center text-center">
                        <form>
                            <h1 class="tituloDato text-center">Casa:</h1>
                            <label class="campoDato text-center">#69, Etapa 3, Block 6</label>
                        </form>
                    </div>
                    <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 d-flex justify-content-center align-items-center text-center">
                        <form>
                            <h1 class="tituloDato text-center">Fecha:</h1>
                            <label class="campoDato text-center">16/4/2021</label>
                        </form>
                    </div>
                </div>

                <!-- Desde aqui comienza la tabla -->
                <div class="row mt-4 justify-content-center table-responsive tablaResponsive">
                    <div class="col-12 justify-content-center align-items-center text-center">
                        <table class="table table-borderless citigerTable">
                            <thead>
                                <!-- Columnas-->
                                <tr>
                                    <th scope="col">Concepto</th>
                                    <th scope="col">Monto</th>
                                    <th scope="col">Fecha Limite</th>
                                    <th scope="col">Estado</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <!-- Datos-->
                                    <td>ABRIL 2021</td>
                                    <td>$20.99</td>
                                    <td>3/4/2021</td>
                                    <td>Pendiente</td>
                                    <!-- Boton-->
                                    <th scope="row">
                                        <div class="row paddingBotones">
                                            <div class="col-12">
                                                <a href="#" class="btn btnTabla"><i class="fas fa-check"></i></a>
                                                <a href="#" class="btn btnTabla2"><i class="fas fa-times"></i></a>
                                            </div>
                                        </div>
                                    </th>
                                </tr>
                                

                            </tbody>
                        </table>
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