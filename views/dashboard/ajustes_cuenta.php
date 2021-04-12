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
                    <div class="contenedorMiCuenta">
                        <div class="row mb-3">
                            <div class="col-12">
                                <h1 class="tituloPagina text-center">Mi Cuenta</h1>
                            </div>
                        </div>
                        
                        <div class="row justify-content-center">
                            <div class="col-12 d-flex justify-content-center">
                                <form>
                                    <!-- Cargar Fotografia -->
                                    <div class="row">
                                        <div class="col">
                                            <div class="divFotografiaAjustes">
                                                <div class="cargarFoto d-flex justify-content-center align-items-center">
                                                    <img src="../../resources/img/140025816_1267548823644856_116407320835883935_n.jpg" alt="" class="img-fluid rounded-circle" width="140px">
                                                </div>
                                                <button class="btn btnCargarFoto2"><span class="fas fa-plus"></span></button>
                                                <h1 class="tituloUsuario mt-3">Eduardo Rivera</h1>
                                            </div>
                                        </div>
                                        <!-- Final Cargar Fotografia -->
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col">
                                <h1 class="tituloTarjetaAjustes">Información Personal</h1>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-12 d-flex justify-content-center align-items-center">
                                <div class="informacionPersonal">
                                    <div class="row">
                                        <div class="col-6">
                                            <h1 class="tituloInformacion">Nombres</h1>
                                            <h2 class="informacion">Eduardo Ezequiel</h2>
                                        </div>
                                        <div class="col-6">
                                            <button class="btn botonesAjustes">Editar</button>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-6">
                                            <h1 class="tituloInformacion">Apellidos</h1>
                                            <h2 class="informacion">López Rivera</h2>
                                        </div>
                                        <div class="col-6">
                                            <button class="btn botonesAjustes">Editar</button>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-6">
                                            <h1 class="tituloInformacion">DUI</h1>
                                            <h2 class="informacion">12345678-9</h2>
                                        </div>
                                        <div class="col-6">
                                            <button class="btn botonesAjustes">Editar</button>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-6">
                                            <h1 class="tituloInformacion">Genéro</h1>
                                            <h2 class="informacion">Masculino</h2>
                                        </div>
                                        <div class="col-6">
                                            <button class="btn botonesAjustes">Editar</button>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-6">
                                            <h1 class="tituloInformacion">Teléfono Fijo</h1>
                                            <h2 class="informacion">0000-0000</h2>
                                        </div>
                                        <div class="col-6">
                                            <button class="btn botonesAjustes">Editar</button>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-6">
                                            <h1 class="tituloInformacion">Teléfono Celular</h1>
                                            <h2 class="informacion">0000-0000</h2>
                                        </div>
                                        <div class="col-6">
                                            <button class="btn botonesAjustes">Editar</button>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-6">
                                            <h1 class="tituloInformacion">Fecha de Nacimiento</h1>
                                            <h2 class="informacion">24/04/2003</h2>
                                        </div>
                                        <div class="col-6">
                                            <button class="btn botonesAjustes">Editar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col">
                                <h1 class="tituloTarjetaAjustes">Ajustes de la Cuenta</h1>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-12 d-flex justify-content-center align-items-center">
                                <div class="informacionPersonal">
                                    <div class="row">
                                        <div class="col-6">
                                            <h1 class="tituloInformacion">Usuario</h1>
                                            <h2 class="informacion">edu4rdorivera</h2>
                                        </div>
                                        <div class="col-6">
                                            <button class="btn botonesAjustes">Editar</button>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-6">
                                            <h1 class="tituloInformacion">Correo Electrónico</h1>
                                            <h2 class="informacion">riv.edu10@gmail.com</h2>
                                        </div>
                                        <div class="col-6">
                                            <button class="btn botonesAjustes">Editar</button>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-6">
                                            <h1 class="tituloInformacion">Contraseña</h1>
                                            <h2 class="informacion">*********</h2>
                                        </div>
                                        <div class="col-6">
                                            <button class="btn botonesAjustes">Cambiar</button>
                                        </div>
                                    </div>
                    
                                </div>
                            </div>
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