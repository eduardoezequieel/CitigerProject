<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/admin_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
admin_Page::sidebarTemplate('Inventario | Citiger');
?>

<!-- Contenedor de la Pagina -->
<div class="page-content p-3" id="content">
    <div id="cuadroContenido">
        <button id="sidebarCollapse" type="button" class="btn bg-darken"><i class="fa fa-bars categoriasFuente tamañoIconos"></i><small class="text-uppercase font-weight-bold"></small></button>

        <!-- Desde aqui comienza el contenido -->
        <div class="row justify-content-center mb-3 animate__animated animate__bounceIn">
            <div class="col-12 d-flex justify-content-center align-items-center">
                <h1 class="tituloPagina">Inventario</h1>
            </div>
        </div>

        <!-- Controles del Inicio -->
        <div class="row justify-content-center mt-3 px-5 animate__animated animate__bounceIn">
            <div class="col-xl-12 d-flex justify-content-center col-md-12 col-sm-12 col-xs-12  centrarBotones">
                

                <form class="mx-3" method="post" id="search-form">
                    <h1 class="tituloCajaTextoFormulario">Busqueda:</h1>
                    <input type="text" class="form-control buscador" id="search" name="search" aria-describedby="emailHelp" placeholder="{Nombre}">
                </form>
                <form method="post" id="filtrarCategoria-form" class="mx-3">
                    <h1 class="tituloCajaTextoFormulario">Categoría:</h1>
                    <!-- Combobox, si se desea usar, copiar todo el div que incluye la clase
                    cbCitiger, para cambiarle el tamaño, crear un id en cbCitiger y usar el width
                    deseado en el combobox  -->
                    <div class="cbCitigerBusqueda">
                        <select class="custom-select" id="cbCategoria2">
                            <option selected="">Seleccionar...</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <input type="number" name="idCategoria" id="idCategoria" class="d-none">
                    <button class="d-none" id="btnCategoria" name="btnCategoria" type="submit"></button>
                </form>
            </div>

        </div>
        <div class="row justify-content-center">
            <div class="col-12 d-flex justify-content-center">
                <div class="mt-4 mx-3 mb-3">
                    <a href="#" id="btnInsertDialog" data-toggle="modal" data-target="#administrarInventario" class="btn botonesListado"><span class="fas fa-plus mr-3 tamañoIconosBotones"></span>Agregar</a>
                </div>

                <div class="mt-4 mx-3 mb-3">
                    <a href="marcas.php" class="btn botonesListado"><span class="fas fa-tag mr-3 tamañoIconosBotones"></span>Marcas</a>
                </div>

                <div class="mt-4 mx-3 mb-3">
                    <a href="#" id="btnReiniciar" data-toggle="#" data-target="#" class="btn botonesListado"><span class="fas fa-undo mr-3 tamañoIconosBotones"></span>Reiniciar</a>
                </div>

                <div class="mt-4 mx-3 mb-3">
                    <a href="../../app/reports/dashboard/materiales.php" id="btnReporte" type="button" data-target="#" data-toggle="tooltip" data-target="#" data-placement="bottom" title="Reporte de materiales por categoría"  
                    class="btn botonesListado"><span class="fas fa-file-alt mr-3 tamañoIconosBotones"></span>Reporte</a>
                </div>
            </div>
        </div><br>

        <!-- Fila de Tarjetas -->
        <div class="row justify-content-center animate__animated animate__backInUp" id="materiales">



            <!-- Desde aqui finaliza el contenido -->

        </div>

    </div>
    <!-- Final del contenido -->

    <!-- Modal para Administrar Inventario -->
    <div class="modal fade" id="administrarInventario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content justify-content-center px-3 py-2">
                <!-- Cabecera del Modal -->
                <div class="modal-header">
                    <!-- Titulo -->
                    <h5 class="modal-title tituloModal" id="exampleModalLabel"><span class="fas fa-info-circle mr-4 iconoModal"></span>Materiales</h5>
                    <!-- Boton para Cerrar -->
                    <button type="button" class="close closeModalButton lead" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- Contenido del Modal -->
                <div class="textoModal px-3 pb-4 mt-2">
                    <form method="post" id="administrarMateriales-form">
                    <input class="d-none" type="number" id="txtId" name="txtId" />
                        <div class="row animate__animated animate__bounceIn">
                            <!-- Primera columna de controles -->
                            <div class="col-xl-6 mb-4 col-md-12 col-sm-12 col-xs-12 marginCol2 centrarColumnas">
                                <div class="#" id="EmpleadosColumna1">
                                    <!-- Cargar Fotografia -->
                                    <div class="row pl-2 my-4">
                                        <div class="col">
                                            <div class="divFotografia2">
                                                <div class="cargarFoto2" id="divFoto">

                                                </div>
                                                <div id="btnAgregarFoto">
                                                    <button type="submit" class="btn btnCargarFoto2 mx-2" id="botonFoto"><span class="fas fa-plus"></span></button>
                                                </div>
                                                <input id="archivo_usuario" type="file" class="d-none" name="archivo_usuario" accept=".gif, .jpg, .png">
                                            </div>

                                        </div>
                                        <!-- Final Cargar Fotografia -->
                                    </div>

                                    <label class="tituloCajaTextoFormulario" for="txtNombres">Nombres del material:</label>
                                    <input type="text" class="form-control cajaTextoFormulario" id="txtNombres" name="txtNombres" placeholder="Escriba los nombres del material">

                                    <label class="tituloCajaTextoFormulario" for="cbMarca">Marca:</label>
                                    <!-- Combobox, si se desea usar, copiar todo el div que incluye la clase
                            cbCitiger, para cambiarle el tamaño, crear un id en cbCitiger y usar el width
                            deseado en el combobox  -->
                                    <div class="cbCitiger mb-2">
                                        <select class="custom-select" id="cbMarca" name="cbMarca">
                                            <option selected="">Seleccionar...</option>

                                        </select>
                                    </div>
                                    <label class="tituloCajaTextoFormulario mt-2" for="cbCategoria">Categoria:</label>
                                    <!-- Combobox, si se desea usar, copiar todo el div que incluye la clase
                            cbCitiger, para cambiarle el tamaño, crear un id en cbCitiger y usar el width
                            deseado en el combobox  -->
                                    <div class="cbCitiger ">
                                        <select class="custom-select" id="cbCategoria" name="cbCategoria">
                                            <option selected="">Seleccionar...</option>

                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Segunda columna de controles -->
                            <div class="col-xl-6 col-md-12 col-sm-12 col-xs-12  centrarColumnas ">
                                <div class="form-group ">
                                    <!-- Controles -->
                                    

                                    <h1 class="tituloCajaTextoFormulario">Tipo de unidad de medida:</h1>

                                    <div class="cbCitiger mb-2" id="selectUnidadMedida">
                                        <select class="custom-select" id="cbTipo" name="cbTipo">
                                            <option selected="">Seleccionar...</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                    <input type="number" value="1" name="idTipoUnidad" id="idTipoUnidad" class="d-none">
                                    <button class="d-none" id="btnFiltrarUnidad" name="btnFiltrarUnidad" type="submit"></button>

                                    <label class="tituloCajaTextoFormulario mt-2" for="cbUnidad">Unidad de medida:</label>

                                    <div class="cbCitiger mb-2" id="selectUnidadMedida">
                                        <select class="custom-select" id="cbUnidad" name="cbUnidad">
                                            <option selected="">Seleccionar...</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>

                                    <label class="tituloCajaTextoFormulario" for="txtTamanio">Tamaño:</label>
                                    <input type="text" class="form-control cajaTextoFormulario" id="txtTamanio" name="txtTamanio" placeholder="Escriba el tamaño">

                                    <label class="tituloCajaTextoFormulario mt-1" for="txtCosto">Costo:</label>
                                    <input type="number" max="1000" min="1" class="form-control cajaTextoFormulario" id="txtCosto" name="txtCosto" placeholder="Ingrese el costo del material">

                                    <label class="tituloCajaTextoFormulario" for="txtCantidad">Cantidad:</label>
                                    <input type="number" max="1000" min="1" class="form-control cajaTextoFormulario" id="txtCantidad" name="txtCantidad" placeholder="Ingrese el la cantidad del material">

                                    <label class="tituloCajaTextoFormulario" for="txtDesc">Descripción:</label>
                                    <textarea class="form-control cajaTextoFormulario" placeholder="" id="txtDesc" name="txtDesc" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                        <!-- Botones de Acción del Formulario -->
                        <div class="row justify-content-center mt-4">
                            <div class="col-12 d-flex justify-content-center align-items-center text-center">
                                <button id="btnAgregar" class="btn btnAgregarFormulario mr-2"><span class="fas fa-plus mr-3 tamañoIconosBotones"></span>Agregar</button>
                                <button id="btnActualizar" class="btn btnAgregarFormulario mr-2"><span class="fas fa-edit mr-3 tamañoIconosBotones"></span>Actualizar</button>

                            </div>
                        </div>
                    </form>
                    <!-- Desde aqui finaliza el contenido -->
                    <!-- Fin del Contenido del Modal -->
                </div>
            </div>
        </div>
    </div>
    <!-- Fin del Modal -->

    <?php
    //Se imprimen los JS necesarios
    admin_Page::footerTemplate('inventario.js');
    ?>