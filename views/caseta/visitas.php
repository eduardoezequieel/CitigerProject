<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/stand_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
admin_Page::sidebarTemplate('Visitas | Citiger');
?>

<!-- Contenedor de la Pagina -->
<div class="page-content p-3" id="content">
    <div id="cuadroContenido">
    <button id="sidebarCollapse" type="button" class="btn bg-darken"><i class="fa fa-bars categoriasFuente tamañoIconos"></i><small class="text-uppercase font-weight-bold"></small></button>

<!-- Desde aqui comienza el contenido -->
<div class="row justify-content-center mb-3 animate__animated animate__bounceIn">
    <div class="col-12 d-flex justify-content-center align-items-center">
        <h1 class="tituloPagina">Visitas</h1>
    </div>
</div>

<div class="row justify-content-center mt-3 px-5 animate__animated animate__bounceIn">
    <div class="col-xl-12 d-flex justify-content-center col-md-12 col-sm-12 col-xs-12 centrarBotones">
        <form class="mx-3 mb-2" method="post" id="search-form">
            <h1 class="tituloCajaTextoFormulario">Busqueda:</h1>
            <input type="text" class="form-control buscador" id="search" name="search" aria-describedby="emailHelp" placeholder="{ Residente, Visitante }">
        </form>

        <div class="mt-4 mx-3 mb-3">
            <a href="#" id="btnReiniciar" data-toggle="#" data-target="#" class="btn botonesListado"><span class="fas fa-undo mr-3 tamañoIconosBotones"></span>Reiniciar</a>
        </div>
    </div>

</div><br>
<!-- Desde aqui comienza la tabla -->
<div class="row mt-3 justify-content-center table-responsive animate__animated animate__bounceInUp tablaResponsive">
    <div class="col-12 justify-content-center align-items-center text-center">
        <table class="table table-borderless citigerTable" id="data-table">
            <thead>
                <!-- Columnas-->
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Residente</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Visitante</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody id="tbody-rows">

            </tbody>
        </table>
    </div>
</div>
<!-- Desde aqui termina la tabla --><br>
<!-- Modal -->
<div class="modal fade" id="modalVisitas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <input type="number" class="form-control cajaTextoDUI d-none" id="txtVisita" name="txtVisita">
                        <h5 class="subTituloPagina1" id="exampleModalLabel">Detalles de la visita</h5>
                        <button type="button" class="close text-light lead" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <br>
                    <ul class="textoModal">
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
        <!-- Fin de modal -->
<!-- Desde aqui finaliza el contenido -->
    </div>

</div>
<!-- Final del contenido -->

<?php
//Se imprimen los JS necesarios
admin_Page::footerTemplate('visitas.js');
?>