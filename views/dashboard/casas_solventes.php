<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/admin_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
admin_Page::sidebarTemplate('Administradores | Citiger');
?>    
    
    <!-- Contenedor de la Pagina -->
    <div class="page-content p-3" id="content">
        <div id="cuadroContenido">
            <button id="sidebarCollapse" type="button" class="btn bg-darken"><i class="fa fa-bars categoriasFuente tamañoIconos"></i><small class="text-uppercase font-weight-bold"></small></button>
        
            <!-- Desde aqui comienza el contenido -->
            <div class="row justify-content-center mb-3">
                <div class="col-12 d-flex justify-content-center align-items-center">
                    <h1 class="tituloPagina">Casas con pagos solventes</h1>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-6 col-md-12 col-sm-12 col-xs-12 centrarBotones">
                    <input type="text" class="form-control cajaTextoFormulario" id="cbTipoEmpleado"
                        placeholder="Seleccionar mes ">                </div>
                <div class="col-xl-6 col-md-12 col-sm-12 col-xs-12  search">
                    <form>
                        <input type="email" class="form-control buscador" id="buscar" aria-describedby="emailHelp" placeholder="Buscar...                                                               &#xf002;">
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
                                <th class="pl-5 pt-4">Casa</th>
                                <th class="pl-5 pt-4">Monto</th>
                                <th class="pl-4 pt-4">Fecha</th>
                             
                            </tr>
                        </thead>
                        <tbody>
                            <tr >
                                <th scope="row" class="d-flex justify-content-center boto"><img src="../../resources/img/bluehouse.png" alt="userIcon" class="imagenTabla"></th>
                                <td class="primer" >#99, ETAPA 6, BLOCK 5</td>
                                <td class="primer" id="align">$66.72</td>
                                <td class="primer" id="align">02/12/2021</td>
                               
                            </tr>
                            <tr>
                                <th scope="row" class="d-flex justify-content-center icon"><img src="../../resources/img/bluehouse.png" alt="userIcon" class="imagenTabla"></th>
                                <td>#99, ETAPA 6, BLOCK 5</td>
                                <td>$66.72</td>
                                <td>02/12/2021</td>
                                
                            </tr>
                            <tr>
                                <th scope="row" class="d-flex justify-content-center icon"><img src="../../resources/img/bluehouse.png" alt="userIcon" class="imagenTabla"></th>
                                <td>#22, ETAPA 1, BLOCK 19</td>
                                <td>$66.72</td>
                                <td>02/12/2021</td>
                                
                            </tr>
                            <tr>
                                <th scope="row" class="d-flex justify-content-center icon"><img src="../../resources/img/bluehouse.png" alt="userIcon" class="imagenTabla"></th>
                                <td>#25, ETAPA 1, BLOCK 8</td>
                                <td>$66.72</td>
                                <td>02/12/2021</td>
                                
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