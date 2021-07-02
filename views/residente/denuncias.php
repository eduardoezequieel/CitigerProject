<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/resident_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
admin_Page::sidebarTemplate('Denuncias | Citiger');
?>
<!-- Contenedor de la Pagina -->
<div class="page-content p-3" id="content">
    <div id="cuadroContenido">
        <button id="sidebarCollapse" type="button" class="btn bg-darken"><i
                class="fa fa-bars categoriasFuente tamañoIconos"></i><small
                class="text-uppercase font-weight-bold"></small></button>

        <!-- Desde aqui comienza el contenido -->
        <div class="row justify-content-center mb-3">
            <div class="col-12 d-flex justify-content-center align-items-center">
                <h1 class="tituloPagina text-center">Denuncias</h1>
            </div>
        </div>
        <!-- Controles del Inicio -->
        <div class="row justify-content-center mt-3 px-5 animate__animated animate__bounceIn">
            <div class="col-xl-12 d-flex justify-content-center col-md-12 col-sm-12 col-xs-12 centrarBotones">  
                <div class="mt-4 mx-3 mb-3">
                    <a href="#" id="btnNew" data-toggle="modal" data-target="#modal1" class="btn botonesListado"><span class="fas fa-plus mr-3 tamañoIconosBotones"></span>Nuevo</a>
                </div>
                <form class="mx-3">
                    <h1 class="tituloCajaTextoFormulario">Busqueda:</h1>
                    <input type="email" class="form-control buscador" id="buscar" aria-describedby="emailHelp" placeholder="Buscar...                                                                          &#xf002;">
                </form>           
            </div>
        </div><br>

        <div class="row">
            <div class="col-12">
                <h1 class="tituloDato2 text-center">Historial de Denuncias</h1>
            </div>
        </div>

        <!-- Desde aqui comienza la tabla -->
        <div class="row mt-4 justify-content-center table-responsive animate__animated animate__bounceInUp tablaResponsive">
            <div class="col-12 justify-content-center align-items-center text-center">
                <table class="table table-borderless citigerTable">
                    <thead>
                        <!-- Columnas-->
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Tipo</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Fecha</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody id="tbody-rows">
                        <tr class="animate__animated animate__fadeIn">
                            <!-- Fotografia-->
                            <th scope="row">
                                <div class="row paddingTh">
                                    <div class="col-12">
                                        <img src="../../resources/img/iconw.png" alt="" class="img-fluid" width="30px">
                                    </div>
                                </div>
                            </th>
                            <!-- Datos-->   
                            <td>Disturbio</td>
                            <td>Pendiente</td>
                            <td>1/7/2021</td>
                            <!-- Boton-->
                            <th scope="row">
                                <div class="row paddingBotones">
                                    <div class="col-12">
                                        <a href="#" data-toggle="modal" data-target="#administrarDenunciaPendiente" class="btn btnTabla"><i class="fas fa-info-circle"></i></a>

                                    </div>
                                </div>
                            </th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div><br>
        <!-- Desde aqui termina la tabla -->
        
    </div>

</div>
<!-- Final del contenido -->

<!-- Modal para asignar casa a residente -->
<div class="modal fade" id="modal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content justify-content-center px-3 py-2">
            <!-- Cabecera del Modal -->
            <div class="modal-header">
                <!-- Titulo -->
                <h5 class="modal-title tituloModal" id="exampleModalLabel"><span class="fas fa-info-circle mr-4 iconoModal"></span>Crear Denuncia</h5>
                <!-- Boton para Cerrar -->
                <button type="button" class="close closeModalButton lead" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Contenido del Modal -->
            <div class="textoModal px-3 pb-4 mt-2">
                <div class="row mb-2">
                    <div class="col-12">
                        <h1 class="tituloDato2 text-center">Rellene el siguiente formulario:</h1>
                    </div>
                </div>
                <form method="post">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <h1 class="tituloCajaTextoFormulario">Tipo de denuncia:</h1>
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
                            </div>

                            <div class="form-group">
                                <label class="tituloCajaTextoFormulario" for="txtDireccion">Descripción:</label>
                                <textarea class="form-control cajaTextoFormulario2" placeholder="Escriba su dirección..." id="" name="" rows="4"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center mt-2">
                        <div class="col-12 d-flex justify-content-center">
                            <button id="btnAgregar" type="submit" class="btn btnAgregarFormulario"><span class="fas fa-paper-plane mr-3 tamañoIconosBotones"></span>Enviar Denuncia</button>
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
admin_Page::footerTemplate();
?>