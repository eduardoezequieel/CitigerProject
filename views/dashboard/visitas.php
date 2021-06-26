<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/admin_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
admin_Page::sidebarTemplate('Visitas | Citiger');
?>     
<link rel="stylesheet" href="../../resources/css/estilos3.css">
    <!-- Contenedor de la Pagina -->
    <div class="page-content p-3" id="content">
        <div id="cuadroContenido">
            <button id="sidebarCollapse" type="button" class="btn bg-darken"><i class="fa fa-bars categoriasFuente tamañoIconos"></i><small class="text-uppercase font-weight-bold"></small></button>
        
            <!-- Desde aqui comienza el contenido -->
            <div class="row justify-content-center mb-3">
                <div class="col-12 d-flex justify-content-center align-items-center">
                    <h1 class="tituloPagina">Visitas</h1>
                </div>
            </div>

            <div class="row justify-content-center mt-3 px-5 animate__animated animate__bounceIn">
                <div class="col-xl-12 d-flex justify-content-center col-md-12 col-sm-12 col-xs-12 centrarBotones">
                    <div class="mt-4 mx-3 mb-3">
                        <a href="#" data-toggle="modal" data-target="#administrarVisita" class="btn botonesListado"><span class="fas fa-plus mr-3 tamañoIconosBotones"></span>Agregar</a>
                    </div>
                      
                    <form class="mx-3">
                        <h1 class="tituloCajaTextoFormulario">Busqueda:</h1>
                        <input type="email" class="form-control buscador" id="buscar" aria-describedby="emailHelp" placeholder="Buscar...                                                                          &#xf002;">
                    </form>            
                </div>
                
            </div><br>
            <!-- Desde aqui comienza la tabla -->
            <div class="row mt-1 justify-content-center table-responsive animate__animated animate__bounceInUp tablaResponsive">
                <div class="col-12 justify-content-center align-items-center text-center">
                    <table class="table table-borderless citigerTable">
                        <thead>
                            <!-- Columnas-->
                            <tr>
                                <th scope="col">Visitante</th>
                                <th scope="col">DUI</th>
                                <th scope="col">Placa</th>
                                <th scope="col">Fecha</th>
                                <th scope="col">Estado de la Visita</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <!-- Datos-->
                                <td>Edenilson Ramírez</td>
                                <td>12345678-9</td>
                                <td>P246-182</td>
                                <td>13/6/2021</td>
                                <td>Por llegar</td>
                                
                                <!-- Boton-->
                                <th scope="row">
                                    <div class="row paddingBotones">
                                        <div class="col-12">
                                            <a href="#" data-toggle="modal" data-target="#administrarVisita" class="btn btnTabla"><i class="fas fa-edit"></i></a>
                                            <a href="#" class="btn btnTabla2"><i class="fas fa-trash"></i></a>
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

<!-- Modal para administrar visitas -->
<div class="modal fade" id="administrarVisita" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content justify-content-center px-3 py-2">
            <!-- Cabecera del Modal -->
            <div class="modal-header">
                <!-- Titulo -->
                <h5 class="modal-title tituloModal" id="exampleModalLabel"><span class="fas fa-info-circle mr-4 iconoModal"></span>Visitas</h5>
                <!-- Boton para Cerrar -->
                <button type="button" class="close text-light lead" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <br>
            <!-- Contenido del Modal -->
            <div class="textoModal px-3 pb-4 mt-2">
                <div class="row">
                    <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12"> 
                        <label class="tituloCajaTextoFormulario" for="txtTelefono">Residente:</label>
                        <!-- Combobox, si se desea usar, copiar todo el div que incluye la clase
                        cbCitiger, para cambiarle el tamaño, crear un id en cbCitiger y usar el width
                        deseado en el combobox  -->
                        <div class="cbCitiger" id="selectGeneroVisitante">
                            <select class="custom-select">
                                <option selected="">Seleccionar...</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select> 
                        </div>

                        <label class="tituloCajaTextoFormulario mt-2" for="txtTelefono">Fecha:</label>
                        <input type="date" class="form-control cajaTextoModal" id="txtTelefonomovil"
                        placeholder="">

                        <label class="tituloCajaTextoFormulario" for="txtTelefono">Estado de la visita:</label>
                        <!-- Combobox, si se desea usar, copiar todo el div que incluye la clase
                        cbCitiger, para cambiarle el tamaño, crear un id en cbCitiger y usar el width
                        deseado en el combobox  -->
                        <div class="cbCitiger" id="selectGeneroVisitante">
                            <select class="custom-select">
                                <option selected="">Seleccionar...</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select> 
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12">
                        <label class="tituloCajaTextoFormulario" for="txtTelefono">¿Visita recurrente?:</label>
                        <!-- Combobox, si se desea usar, copiar todo el div que incluye la clase
                        cbCitiger, para cambiarle el tamaño, crear un id en cbCitiger y usar el width
                        deseado en el combobox  -->
                        <div class="cbCitiger" id="selectGeneroVisitante">
                            <select class="custom-select">
                                <option selected="">Seleccionar...</option>
                                <option value="1">Si</option>
                                <option value="2">No</option>
                            </select> 
                        </div>
                        
                        <label class="tituloCajaTextoFormulario mt-2" for="txtTelefono">Observación:</label>
                        <textarea name="#" id="#" rows="3" class="form-control cajaTextoModal"></textarea>

            
                    </div>
                </div>
                <div class="row justify-content-center mt-3">
                    <div class="col-12 d-flex justify-content-center align-items-center text-center">
                        <a href="#" class="btn btnAgregarFormulario mx-2"><span class="fas fa-plus mr-3 tamañoIconosBotones"></span>Agregar</a>
                        <a href="#" class="btn btnAgregarFormulario mx-2"><span class="fas fa-edit mr-3 tamañoIconosBotones"></span>Actualizar</a>
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