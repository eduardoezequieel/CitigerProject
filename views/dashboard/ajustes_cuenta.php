<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/admin_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
admin_Page::sidebarTemplate('Ajustes | Citiger');
?>

<!-- Contenedor de la Pagina -->
<div class="page-content p-3" id="content">
    <div id="cuadroContenido">
        <button id="sidebarCollapse" type="button" class="btn bg-darken"><i class="fa fa-bars categoriasFuente tamañoIconos"></i><small class="text-uppercase font-weight-bold"></small></button>
        <!-- Desde aqui comienza el contenido -->

        <div class="row justify-content-center">
            <div class="col-12 d-flex justify-content-center align-items-center">
                <div class="contenedorMiCuenta" id="miCuenta">


                </div>
            </div>
        </div>
        <!-- Desde aqui finaliza el contenido -->
    </div>

</div>
<!-- Final del contenido -->

<!-- Modal para Administrar informacion personal -->
<div class="modal fade" id="administrarCuenta" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content justify-content-center px-3 py-2">
            <!-- Cabecera del Modal -->
            <div class="modal-header">
                <!-- Titulo -->
                <h5 class="modal-title tituloModal" id="exampleModalLabel"><span class="fas fa-info-circle mr-4 iconoModal"></span>Editar información</h5>
                <!-- Boton para Cerrar -->
                <button type="button" class="close closeModalButton lead" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <br>
            <!-- Contenido del Modal -->
            <div class="textoModal px-3 pb-4 mt-2">
                <form method="post" id="admin-form">

                    <div class="row">
                        <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12">
                            <label class="tituloCajaTextoFormulario mt-2" for="txtNombres">Nombres:</label>
                            <input onchange="checkInputLetras('txtNombres')" type="text" class="form-control cajaTextoModal" id="txtNombres" name="txtNombres" placeholder="">

                            <label class="tituloCajaTextoFormulario " for="txtApellidos">Apellidos:</label>
                            <input onchange="checkInputLetras('txtApellidos')" type="text" class="form-control cajaTextoModal" id="txtApellidos" name="txtApellidos" placeholder="">

                            <!-- Combobox, si se desea usar, copiar todo el div que incluye la clase
                        cbCitiger, para cambiarle el tamaño, crear un id en cbCitiger y usar el width
                        deseado en el combobox  -->
                            <h1 class="tituloCajaTextoFormulario mb-2">Género</h1>
                            <!-- Combobox, si se desea usar, copiar todo el div que incluye la clase
                                cbCitiger, para cambiarle el tamaño, crear un id en cbCitiger y usar el width
                                deseado en el combobox  -->
                            <div class="cbCitiger w-20 col-md-12" id="cbCitiger">
                                <select class="custom-select" id="cbGenero" name="cbGenero">
                                    <option selected="">Seleccionar...</option>
                                    <option value="M">Masculino</option>
                                    <option value="F">Femenino</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">

                                <label class="tituloCajaTextoFormulario mt-2" for="txtFechaNacimiento">Fecha de Nacimiento:</label>
                                <input type="date" class="form-control cajaTextoModal" id="txtFechaNacimiento" name="txtFechaNacimiento" placeholder="">

                                <label class="tituloCajaTextoFormulario " for="txtTelefonoFijo">Teléfono Fijo:</label>
                                <input onchange="checkTelefono('txtTelefonoFijo')" type="text" class="form-control cajaTextoModal" id="txtTelefonoFijo" name="txtTelefonoFijo" placeholder="">

                                <label class="tituloCajaTextoFormulario mb-1" for="txtTelefonomovil">Teléfono Movil:</label>
                                <input input onchange="checkTelefono('txtTelefonomovil')" type="text" class="form-control cajaTextoModal" id="txtTelefonomovil" name="txtTelefonomovil" placeholder="">
                            </div>
                        </div>
                    </div>

                    <!-- Botones de Acción del Formulario -->
                    <div class="row justify-content-center mt-4">
                        <div class="col-12 d-flex justify-content-center align-items-center text-center">
                            <button id="btnActualizar" type="submit" name="btnActualizar" href="#" class="btn btnAgregarFormulario mr-2"><span class="fas fa-edit mr-3 tamañoIconosBotones"></span>Actualizar</button>
                        </div>
                    </div>
                </form>
                <!-- Fin del Contenido del Modal -->
            </div>
        </div>
    </div>
</div>
<!-- Fin del Modal -->

<?php
//Se imprimen los JS necesarios
admin_Page::footerTemplate('account.js');
?>