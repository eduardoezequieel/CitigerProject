<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/stand_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
admin_Page::sidebarTemplate('Verificar | Citiger');
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
                <h1 class="tituloPagina text-center">Verificar datos por DUI</h1>
            </div>
        </div>

        <!-- Inicio de Fila -->
        <div class="row">
            <!-- Primera columna de controles -->
            <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12  centrarColumnas">
                <form id="EmpleadosColumna1">
                    <label class="tituloCajaTextoFormulario" for="txtNombres">DUI del visitante:</label>
                    <input type="text" class="form-control cajaTextoDUI" id="txtNombres" placeholder="0089532-9">

                </form>
            </div>
            <!-- Segunda columna de controles -->
            <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 marginBoton centrarColumnas">
                <form>
                    <a href="#" class="btn btnAgregarFormulario"><span
                            class="fas fa-check-circle mr-3 tamañoIconosBotones"></span>Verificar información</a>

                </form>
            </div>



        </div>
        <!-- Salida de datos -->
        <div class="row justify-content-center mt-4">
            <div class="col-12 d-flex justify-content-center align-items-center text-center">
                <h2 class="tituloMenu">Datos de la visita:</h2>
            </div> 
        </div>

        <div class="row justify-content-center mt-4">
            <div class="col-12 d-flex justify-content-center align-items-center text-left">
                <div id="tarjeta">
                    <div id="tarjetaCaja" class="p-4">
                        
                        <ul class="textoCard">
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
        <!-- Desde aqui finaliza el contenido -->

    </div>

</div>
<!-- Final del contenido -->

<?php
//Se imprimen los JS necesarios
admin_Page::footerTemplate();
?>