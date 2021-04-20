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

            <div class="row px-5 animate__animated animate__bounceIn">
                <div class="col-xl-6 col-md-12 col-sm-12 col-xs-12 centrarBotones">
                    <form>
                        <h1 class="tituloCajaTextoFormulario">Mes:</h1>
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
                <div class="col-xl-6 col-md-12 col-sm-12 col-xs-12 search" id="buscadorCasasPendientes">
                    <form>
                        <input type="email" class="form-control buscador" id="buscar" aria-describedby="emailHelp" placeholder="Buscar...                                                                          &#xf002;">
                    </form>
                </div>
            </div><br>
            <!-- Desde aqui comienza la tabla -->
            <div class="row mt-4 justify-content-center table-responsive animate__animated animate__bounceInUp tablaResponsive px-5" id="tablaCasasSolventes">
                <div class="col-12 justify-content-center align-items-center text-center">
                    <table class="table table-borderless citigerTable">
                        <thead>
                            <!-- Columnas-->
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Casa</th>
                                <th scope="col">Pago</th>
                                <th scope="col">Fecha</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
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
                                <td>$20.99</td>
                                <td>3/4/2021</td>
                                
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