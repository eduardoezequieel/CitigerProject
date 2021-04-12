<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/resident_page.php');
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

            <div class="row justify-content-end">
                <div class="col-xl-6 col-md-12 col-sm-12 col-xs-12 justify-content-center search buscarAlquiler">
                    <form>
                        <input type="email" class="form-control buscador" id="buscar" aria-describedby="emailHelp" placeholder="Buscar...                                                               &#xf002;">
                    </form>
                </div>
            </div><br>
            <!-- Desde aqui comienza la tabla -->
            <div class="row">
                <div class="col">
                    <table class="table table-dark table-hover table-responsive-lg tablaVisitas">
                        <thead class="tituloTabla4">
                            <tr>
                                <th class=" pt-4"></th>
                                <th class="pt-4">Visitante</th>
                                <th class="pt-4">DUI</th>
                                <th class=" pt-4">Placa</th>
                                <th class="pt-4"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr >
                                <th scope="row" class="d-flex justify-content-center boto"><img src="../../resources/img/grupo1.png" alt="userIcon" class="imagenTabla"></th>
                                <td class="primer" >BRANDER CRISTOFER PEÑA PERLA</td>
                                <td class="primer" id="align">12345678-9</td>
                                <td class="primer" id="align">P360 048</td>
                                <th scope="row" class="boto1">
                                    <a href="#" data-toggle="modal" data-target="#editarMarcas" class="btn botonesListadoTabla "><i class="fas fa-edit  mr-3 tamañoIconosBotonesTabla"></i>Editar</a>
                                    <a href="#" data-toggle="modal" data-target="#editarMarcas" class="btn botonesListadoTablaIcono "><i class="fas fa-edit tamañoIconosBotonesTabla"></i></a>
                                </th>
                            </tr>
                            <tr>
                                <th scope="row" class="d-flex justify-content-center icon"><img src="../../resources/img/grupo1.png" alt="userIcon" class="imagenTabla"></th>
                                <td>DENIS GABRIEL ROMERO LEIVA</td>
                                <td>12345678-9</td>
                                <td>P360 048</td>
                                <th scope="row">
                                    <a href="#" data-toggle="modal" data-target="#editarMarcas" class="btn botonesListadoTabla "><i class="fas fa-edit  mr-3 tamañoIconosBotonesTabla"></i>Editar</a>
                                    <a href="#" data-toggle="modal" data-target="#editarMarcas" class="btn botonesListadoTablaIcono "><i class="fas fa-edit tamañoIconosBotonesTabla"></i></a>
                                </th>
                            </tr>
                            <tr>
                                <th scope="row" class="d-flex justify-content-center icon"><img src="../../resources/img/grupo1.png" alt="userIcon" class="imagenTabla"></th>
                                <td>JUAN ANGEL HERNANDEZ PEREZ</td>
                                <td>12345678-9</td>
                                <td>P360 048</td>
                                <th scope="row">
                                    <a href="#" data-toggle="modal" data-target="#editarMarcas" class="btn botonesListadoTabla "><i class="fas fa-edit  mr-3 tamañoIconosBotonesTabla"></i>Editar</a>
                                    <a href="#" data-toggle="modal" data-target="#editarMarcas" class="btn botonesListadoTablaIcono "><i class="fas fa-edit tamañoIconosBotonesTabla"></i></a>
                                </th>
                            </tr>
                            <tr>
                                <th scope="row" class="d-flex justify-content-center icon"><img src="../../resources/img/grupo1.png" alt="userIcon" class="imagenTabla"></th>
                                <td>ERNESTO ARMANDO PÉREZ</td>
                                <td>12345678-9</td>
                                <td>P360 048</td>
                                <th scope="row" class="pb-5">
                                    <a href="#" data-toggle="modal" data-target="#editarMarcas" class="btn botonesListadoTabla "><i class="fas fa-edit  mr-3 tamañoIconosBotonesTabla"></i>Editar</a>
                                    <a href="#" data-toggle="modal" data-target="#editarMarcas" class="btn botonesListadoTablaIcono "><i class="fas fa-edit tamañoIconosBotonesTabla"></i></a>
                                </th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div><br>
             <!-- Desde aqui termina la tabla -->
            <!-- Desde aqui finaliza el contenido -->

            <!-- Modal para Editar Visitas -->
            <div class="modal fade" id="editarMarcas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content justify-content-center px-3 py-2">
                        <!-- Cabecera del Modal -->
                        <div class="modal-header">
                            <!-- Titulo -->
                            <h5 class="modal-title tituloModal" id="exampleModalLabel"><span class="fas fa-info-circle mr-4 iconoModal"></span>Editar Visita</h5>
                            <!-- Boton para Cerrar -->
                            <button type="button" class="close text-light lead" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <br>
                        <!-- Contenido del Modal -->
                        <div class="textoModal px-3 pb-4 mt-2">
                            <div class="row">
                                <!-- Primera columna de controles -->
                                <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12  centrarColumnas">
                                    <form id="EmpleadosColumna1">
                                        <label class="tituloCajaTextoFormulario" for="cbResidente">Residente:</label>
                                        <input type="text" class="form-control cajaTextoFormulario" id="cbResidente"
                                            placeholder="Seleccionar...">

                                        <label class="tituloCajaTextoFormulario" for="txtFecha">Fecha:</label>
                                        <input type="text" class="form-control cajaTextoFormulario" id="txtcbResidente" placeholder="AAAA-MM-DD">


                                        <!-- RadioButtonGroup Visita recurrente -->
                                        <h1 class="tituloCajaTextoFormulario mb-3">Visita recurrente:</h1>
                                        <div class="row justify-content-center">
                                            <div class="col d-flex justify-content-center align-items-center text-center">
                                                <div class="generoRadioButtons">
                                                    <label class="container pr-5">Si
                                                        <input type="radio" name="radio">
                                                        <span class="checkmark"></span>
                                                    </label>
                                                    <label class="container pr-5">No
                                                        <input type="radio" name="radio">
                                                        <span class="checkmark"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <label class="tituloCajaTextoFormulario" for="txtObservacion">Observación:</label>
                                        <textarea class="form-control cajaTextoFormulario" placeholder="Escriba la observación..."
                                            id="txtObservacion" rows="5"></textarea>

                                        
                                    </form>
                                
                                </div>
                                <!-- Segunda columna de controles -->
                                <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12  centrarColumnas contenedorDetalle1">
                                    <div>
                                        <br>
                                        <form class="contenedorDetalle6">
                                            <h3 class="subtituloPaginaV text-center">Añadir detalle de visita</h3><br>

                                            <label class="tituloCajaTextoFormulario" for="cbVisitante">Visitante:</label>
                                            <input type="text" class="form-control cajaTextoFormulario" id="cbVisitante"
                                                placeholder="Seleccionar...">

                                            <!-- Botones de Acción del Formulario -->
                                            <div class="row justify-content-center mt-4 botonVisita">
                                                <div class="col-12 d-flex justify-content-center align-items-center text-center">
                                                    <a href="#" class="btn btnEditarFormulario"><span
                                                        class="fas fa-minus mr-3 tamañoIconosBotones"></span>Eliminar</a>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>     
                            </div>
                            <!-- Botones de Acción del Formulario -->
                            <div class="row justify-content-center mt-3">
                                <div class="col-12 d-flex justify-content-center align-items-center text-center">
                                    <a href="#" class="btn btnEditarFormulario"><span
                                            class="fas fa-edit mr-3 tamañoIconosBotones"></span>Editar</a>

                                    <a href="#" class="btn btnEditarFormulario"><span
                                            class="fas fa-minus mr-3 tamañoIconosBotones"></span>Eliminar</a>
                                            
                                </div>
                            </div>
                        <!-- Fin del Contenido del Modal -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Fin del Modal -->
        </div>

    </div>
    <!-- Final del contenido -->

<?php
//Se imprimen los JS necesarios
admin_Page::footerTemplate();
?>  