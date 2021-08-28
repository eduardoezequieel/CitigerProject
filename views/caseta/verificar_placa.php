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
                <h1 class="tituloPagina text-center">Verificar datos por placa</h1>
            </div>
        </div>

        <!-- Inicio de Fila -->
        <div class="row justify-content-center animate__animated animate__backInDown">
            <form id="dui-form" method="post">
                <!-- Primera columna de controles -->
                <div class=" justify-content-center col-xl-12 col-md-12 col-sm-12 col-xs-12  centrarColumnas">
                        <label class="tituloCajaTextoFormulario" for="txtPlaca">Placa del visitante:</label>
                        <input type="text" class="form-control cajaTextoDUI" id="txtPlaca" name="txtPlaca" placeholder="P000 000" Required onchange="checkInput('txtPlaca')">
                        <input type="number" class="form-control cajaTextoDUI d-none" id="txtVisita" name="txtVisita">
                </div>
                <!-- Segunda columna de controles -->
                <div class="d-flex justify-content-center mt-2 col-xl-12 col-md-12 col-sm-12 col-xs-12 centrarColumnas">
                    <div class="mt-1 mx-1 mb-3">
                    <button type="submit" class="btn btnAgregarFormulario"><span
                                class="fas fa-check-circle mr-3 tamañoIconosBotones"></span>Verificar</button>
                    </div>                       
                     <div class="mt-1 mx-1 mb-3">
                        <button id="btnReiniciar" class="btn btnAgregarFormulario"><span
                                class="fas fa-undo mr-3 tamañoIconosBotones"></span>Reiniciar</button>
                </div>
                               
                </div>
            </form>



        </div>
        <!-- Salida de datos -->
        <div class="row justify-content-center mt-4">
            <div class="col-12 d-flex justify-content-center align-items-center text-center">
                <h2 class="tituloMenu">Datos de la visita:</h2>
            </div> 
        </div>

        <div class="row justify-content-center mt-4 animate__animated animate__backInUp">
            <div class="col-12 d-flex justify-content-center align-items-center text-left">
                <div id="tarjeta">
                    <div id="tarjetaCaja" class="p-4">
                        
                        <ul class="textoCard">
                            <li id="residente">Residente:</li>
                            <br>
                            <li id="fecha">Fecha:</li>
                            <br>
                            <li id="visitante">Visitante:</li>
                            <br>
                            <li id="observacion">Observación:</li>
                            <br>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="mt-1 mx-1 mb-3">
                <button onclick="confirmVisit()" class="btn btnAgregarFormulario"><span
                    class="fas fa-check-circle mr-3 tamañoIconosBotones"></span>Confirmar Visita</button>
            </div> 


        </div>
        <!-- Desde aqui finaliza el contenido -->

    </div>

</div>
<!-- Final del contenido -->

<?php
//Se imprimen los JS necesarios
admin_Page::footerTemplate('verificar_placa.js');
?>