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
                    <h1 class="tituloPagina">Listado de denuncias</h1>
                </div>
            </div>

            <div class="row animate__animated animate__bounceIn">
                
                <div class="col-12 d-flex justify-content-center align-items-center search">
                    <form>
                        <input type="email" class="form-control buscador " id="buscar" aria-describedby="emailHelp" placeholder="Buscar...                                                                          &#xf002;">
                    </form>
                </div>
            </div><br>
            <!-- Desde aqui comienza la tabla -->
            <div class="row mt-4 justify-content-center table-responsive animate__animated animate__bounceInUp tablaResponsive" id="tablaListadoDenuncias">
                <div class="col-12 justify-content-center align-items-center text-center">
                    <table class="table table-borderless citigerTable">
                        <thead>
                            <!-- Columnas-->
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Residente</th>
                                <th scope="col">Tipo</th>
                                <th scope="col">Fecha</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <!-- Fotografia-->
                                <th scope="row">
                                    <div class="row paddingTh">
                                        <div class="col-12">
                                            <img src="../../resources/img/iconw.png" alt="" class="img-fluid" width="30px">
                                        </div>
                                    </div>
                                </th>
                                <!-- Datos-->
                                <td>Eduardo López</td>
                                <td>Mantenimiento</td>
                                <td>3/4/2021</td>
                                <!-- Boton-->
                                <th scope="row">
                                    <div class="row paddingBotones">
                                        <div class="col-12">
                                            <a href="ventana_pago.php" class="btn btnTabla"><i class="fas fa-cog"></i></a>
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

<?php
//Se imprimen los JS necesarios
admin_Page::footerTemplate();
?>  