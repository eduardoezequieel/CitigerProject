<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/admin_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
admin_Page::sidebarTemplate('Aportaciones | Citiger');
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
                <h1 class="tituloPagina text-center">Registro de Aportaciones</h1>
            </div>
        </div>

        <!-- Información de la Casa -->
        <div class="row justify-content-center">
            <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 d-flex justify-content-center align-items-center text-center">
                <form>
                    <h1 class="tituloDato text-center">Casa:</h1>
                    <label class="campoDato text-center">#69, Etapa 3, Block 6</label>
                </form>
            </div>
            <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 d-flex justify-content-center align-items-center text-center">
                <form>
                    <h1 class="tituloDato text-center">Fecha:</h1>
                    <label class="campoDato text-center">16/4/2021</label>
                </form>
            </div>
        </div>

        <!-- Desde aqui comienza la tabla -->
        <div class="row mt-4 justify-content-center table-responsive animate__animated animate__bounceInUp tablaResponsive"
            id="tablaVentanaPago">
            <div class="col-12 justify-content-center align-items-center text-center">
                <table class="table table-borderless citigerTable">
                    <thead>
                        <!-- Columnas-->
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Concepto</th>
                            <th scope="col">Monto</th>
                            <th scope="col">Fecha Limite</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <!--Checkbox-->
                            <th scope="row">
                                <div class="row paddingCheckbox">
                                    <div class="col-12">
                                        <input id="a" type="checkbox" class="checkboxCitiger">
                                        <label class="checkboxLabel checkboxCitiger float-left" for="a"></label>
                                    </div>
                                </div>
                            </th>
                            <!-- Datos-->
                            <td>ABRIL 2021</td>
                            <td>$20.99</td>
                            <td>3/4/2021</td>
                        </tr>
                        <tr>
                            <!--Checkbox-->
                            <th scope="row">
                                <div class="row paddingCheckbox">
                                    <div class="col-12">
                                        <input id="b" type="checkbox" class="checkboxCitiger">
                                        <label class="checkboxLabel checkboxCitiger float-left" for="b"></label>
                                    </div>
                                </div>
                            </th>
                            <!-- Datos-->
                            <td>ABRIL 2021</td>
                            <td>$20.99</td>
                            <td>3/4/2021</td>
                        </tr>
                        <tr>
                            <!--Checkbox-->
                            <th scope="row">
                                <div class="row paddingCheckbox">
                                    <div class="col-12">
                                        <input id="c" type="checkbox" class="checkboxCitiger">
                                        <label class="checkboxLabel checkboxCitiger float-left" for="c"></label>
                                    </div>
                                </div>
                            </th>
                            <!-- Datos-->
                            <td>ABRIL 2021</td>
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