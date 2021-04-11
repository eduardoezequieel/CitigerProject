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
            <div class="row justify-content-center mb-3">
                <div class="col-12 d-flex justify-content-center align-items-center">
                    <h1 class="tituloPagina">Listado de denuncias</h1>
                </div>
            </div>

            <div class="row">
                
                <div class="col-12 d-flex justify-content-center align-items-center search">
                    <form>
                        <input type="email" class="form-control buscador " id="buscar" aria-describedby="emailHelp" placeholder="Buscar...                                                               &#xf002;">
                    </form>
                </div>
            </div><br>
            <!-- Desde aqui comienza la tabla -->
            <div class="row">
                <div class="col">
                    <table class="table table-dark table-hover table-responsive-lg">
                        <thead class="tituloTabla">
                            <tr>
                                <th class="pl-5 pt-4"></th>
                                <th class="pl-5 pt-4">Residente</th>
                                <th class="pl-5 pt-4">Tipo</th>
                                <th class="pl-4 pt-4">Fecha</th>
                                <th class="pl-5 pt-4"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr >
                                <th scope="row" class="d-flex justify-content-center boto"><img src="../../resources/img/iconw.png" alt="userIcon" class="imagenTabla"></th>
                                <td class="primer" >KATHERINE GONZÁLEZ </td>
                                <td class="primer" id="align">Queja</td>
                                <td class="primer" id="align">15/03/2021</td>
                                <th scope="row" class="boto1">
                                    <a href="vista_denuncia.php" class="btn botonesListadoTabla "><i class="fas fa-eye  mr-3 tamañoIconosBotonesTabla"></i>Ver</a>
                                    <a href="vista_denuncia.php" class="btn botonesListadoTablaIcono "><i class="fas fa-eye tamañoIconosBotonesTabla"></i></a>
                                </th>
                            </tr>
                            <tr>
                                <th scope="row" class="d-flex justify-content-center icon"><img src="../../resources/img/iconw.png" alt="userIcon" class="imagenTabla"></th>
                                <td>BRANDER PEÑA</td>
                                <td>Sugerencia</td>
                                <td>15/03/2021</td>
                                <th scope="row">
                                    <a href="vista_denuncia.php" class="btn botonesListadoTabla "><i class="fas fa-eye  mr-3 tamañoIconosBotonesTabla"></i>Ver</a>
                                    <a href="vista_denuncia.php" class="btn botonesListadoTablaIcono "><i class="fas fa-eye tamañoIconosBotonesTabla"></i></a>
                                </th>
                            </tr>
                            <tr>
                                <th scope="row" class="d-flex justify-content-center icon"><img src="../../resources/img/iconw.png" alt="userIcon" class="imagenTabla"></th>
                                <td>EDUARDO RIVERA</td>
                                <td>Queja</td>
                                <td>15/03/2021</td>
                                <th scope="row">
                                    <a href="vista_denuncia.php#" class="btn botonesListadoTabla "><i class="fas fa-eye  mr-3 tamañoIconosBotonesTabla"></i>Ver</a>
                                    <a href="vista_denuncia.php" class="btn botonesListadoTablaIcono "><i class="fas fa-eye tamañoIconosBotonesTabla"></i></a>
                                </th>
                            </tr>
                            <tr>
                                <th scope="row" class="d-flex justify-content-center icon"><img src="../../resources/img/iconw.png" alt="userIcon" class="imagenTabla"></th>
                                <td>EDENILSON RAMÍREZ </td>
                                <td>Sugerencia</td>
                                <td>15/03/2021</td>
                                <th scope="row">
                                    <a href="vista_denuncia.php" class="btn botonesListadoTabla "><i class="fas fa-eye  mr-3 tamañoIconosBotonesTabla"></i>Ver</a>
                                    <a href="#" class="btn botonesListadoTablaIcono "><i class="fas fa-eye tamañoIconosBotonesTabla"></i></a>
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

<?php
//Se imprimen los JS necesarios
admin_Page::footerTemplate();
?>  