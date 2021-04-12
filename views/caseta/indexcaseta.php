<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/stand_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
admin_Page::sidebarTemplate('Caseta | Citiger');
?>

<!-- Contenedor de la Pagina -->
<div class="page-content p-3" id="content">
    <div id="cuadroContenido">
        <button id="sidebarCollapse" type="button" class="btn bg-darken"><i
                class="fa fa-bars categoriasFuente tamañoIconos"></i><small
                class="text-uppercase font-weight-bold"></small></button>

        <!-- Desde aqui comienza el contenido -->
        <!-- Desde aqui comienza el contenido -->
        <div class="row justify-content-center mb-3">
            <div class="col-12 d-flex justify-content-center align-items-center">
                <h1 class="tituloPagina">Visitas Registradas en el día</h1>
            </div>
        </div>
        

        <!-- Inicio de tabla -->
        <div class="row">
            <div class="col">
                <table class="table table-dark table-hover table-responsive-lg">
                    <thead class="tituloTabla">
                        <tr>
                            <th class="pl-5 pt-4"></th>
                            <th class="pl-5 pt-4">Residente</th>
                            <th class="pl-5 pt-4">Fecha</th>
                            <th class="pl-5 pt-4">Visitante</th>
                            <th class="pl-5 pt-4"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row" class="d-flex justify-content-center boto"><img
                                    src="../../resources/img/userIcon.png" alt="userIcon" class="imagenTabla"></th>
                            <td class="primer">Edenilson Ramirez</td>
                            <td class="primer" id="align">2021-04-29</td>
                            <td class="primer" id="align">Karen Torres</td>
                            <th scope="row" class="boto1">
                                <a href="#" class="btn botonesListadoTabla " data-toggle="modal"
                                    data-target="#exampleModal"><i
                                        class="fas fa-eye  mr-3 tamañoIconosBotonesTabla1"></i>Ver</a>
                            </th>
                        </tr>
                        <tr>
                            <th scope="row" class="d-flex justify-content-center icon"><img
                                    src="../../resources/img/userIcon.png" alt="userIcon" class="imagenTabla"></th>
                            <td>Katherine Andrea</td>
                            <td>2021-04-21</td>
                            <td>Issela Mejia</td>
                            <th scope="row">
                                <a href="#" class="btn botonesListadoTabla " data-toggle="modal"
                                    data-target="#exampleModal"><i
                                        class="fas fa-eye  mr-3 tamañoIconosBotonesTabla1"></i>Ver</a>
                            </th>
                        </tr>
                        <tr>
                            <th scope="row" class="d-flex justify-content-center icon"><img
                                    src="../../resources/img/userIcon.png" alt="userIcon" class="imagenTabla"></th>
                            <td>Samuel Magaña</td>
                            <td>2021-04-22</td>
                            <td>Jhansi Aguilar</td>
                            <th scope="row">
                                <a href="#" class="btn botonesListadoTabla " data-toggle="modal"
                                    data-target="#exampleModal"><i
                                        class="fas fa-eye  mr-3 tamañoIconosBotonesTabla1"></i>Ver</a>
                            </th>
                        </tr>
                        <tr>
                            <th scope="row" class="d-flex justify-content-center icon"><img
                                    src="../../resources/img/userIcon.png" alt="userIcon" class="imagenTabla"></th>
                            <td>José Martínez</td>
                            <td>2021-04-22</td>
                            <td>Gerbert Maldonado</td>
                            <th scope="row">
                                <a href="#" class="btn botonesListadoTabla " data-toggle="modal"
                                    data-target="#exampleModal"><i
                                        class="fas fa-eye  mr-3 tamañoIconosBotonesTabla1"></i>Ver</a>
                            </th>
                        </tr>
                        <tr>
                            <th scope="row" class="d-flex justify-content-center icon"><img
                                    src="../../resources/img/userIcon.png" alt="userIcon" class="imagenTabla"></th>
                            <td>Andrea Ramirez</td>
                            <td>2021-04-22</td>
                            <td>Daniel Carranza</td>
                            <th scope="row">
                                <a href="#" class="btn botonesListadoTabla " data-toggle="modal"
                                    data-target="#exampleModal"><i
                                        class="fas fa-eye  mr-3 tamañoIconosBotonesTabla1"></i>Ver</a>
                            </th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div><br>
        <!-- Fin de tabla -->
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="subTituloPagina1" id="exampleModalLabel">Detalles de la visita</h5>
                        <button type="button" class="close text-light lead" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <br>
                    <div class="textoModal">
                        <ul>
                            <li>Residente: Edenilson Ramirez</li>
                            <br>
                            <li>Fecha: 13/04/2021</li>
                            <br>
                            <li>Visitante: Karen Torres</li>
                            <br>
                            <li>Observación: El visitante viene en un Toyota Corolla 2021</li>
                            <br>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
        <!-- Fin de modal -->

        <!-- Desde aqui finaliza el contenido -->

    </div>

</div>
<!-- Final del contenido -->

<?php
//Se imprimen los JS necesarios
admin_Page::footerTemplate();
?>