<?php
include '../conexion.php';
include '../contenido/welcome.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../contenido/head.php' ?>
</head>

<body>
    <?php include '../contenido/menu.php' ?>
    <div class="container my-5">
        <h1 class="text-center my-3">Registrar Entidad</h1>

        <!-- Seleccionar la entidad a registrar -->
        <div class="row">
            <div class="col-sx-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6 my-2">
                <label for="tipo">Tipo de entidad</label>
                <select name="tipo" id="selectTipo" class="form-control">
                    <option disabled selected>Seleccionar tipo</option>
                    <option value="vendedor">Vendedor</option>
                    <option value="comprador">Comprador</option>
                </select>
            </div>
            <div class="col-sx-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6 my-2">
                <div id="Subtipo">
                    <label for="subtipo">Tipo de identificación</label>
                    <select name="subtipo" id="selectSubtipo" class="form-control">
                        <option disabled selected>Seleccionar tipo</option>
                        <option value="natural">Natural</option>
                        <option value="juridico">Ruc</option>
                        <option value="proveedor">Proveedor</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Formulario para Proveedor -->

        <div id="formularioProveedor" style="display:none" class="border border-5 border-dark rounded-4">
            <h2 class="text-center bg-dark bg-opacity-85 text-light">Formulario de Proveedor</h2>
            <form action="../crud/agregar_entidad.php" id="formulario_proveedor" method="POST" class="mx-auto px-5 my-3">
                <input type="hidden" value="vendedor" name="tipo_seleccionado" class="tipo_seleccionado">
                <input type="hidden" value="proveedor" name="subtipo_seleccionado" class="subtipo_seleccionado">
                <div class="row d-flex justify-content-center">
                    <div class="col-sx-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6 my-2">
                        <label for="n_ruc">Ruc del proveedor:</label>
                        <input type="text" name="n_ruc" class="form-control Ndocumentacion" placeholder="ruc de la empresa" maxlength="11">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sx-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6 my-2">
                        <label for="rsocial">Razon social:</label>
                        <input type="text" name="rsocial" class="form-control Rsocial" placeholder="Escribe el nombre segun la sunat" readonly>
                    </div>
                    <div class="col-sx-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6 my-2">
                        <label for="rcomercial">Nombre Comercial:</label>
                        <input type="text" name="rcomercial" class="form-control Rcomercial" placeholder="Escribe el nombre comercial">
                    </div>
                </div>

                <label for="direccion">Direccion:</label>
                <input type="text" name="direccion" class="form-control direccion" placeholder="Dirección de la empresa" readonly>
                <label for="referencia">Referencia:</label>
                <input type="text" name="referencia" class="form-control referencia" placeholder="Referencia del lugar">
                <div class="row">
                    <div class="col-sx-12 col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-4 my-2">
                        <label for="distrito">Distrito:</label>
                        <input type="text" name="distrito" class="form-control distrito" placeholder="Distrito de la empresa" readonly>
                    </div>
                    <div class="col-sx-12 col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-4 my-2">
                        <label for="provincia">Provincia:</label>
                        <input type="text" name="provincia" class="form-control provincia" placeholder="Provincia de la empresa" readonly>
                    </div>
                    <div class="col-sx-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 col-xxl-4 my-2">
                        <label for="departamento">Departamento:</label>
                        <input type="text" name="departamento" class="form-control departamento" placeholder="Departamento de la empresa" readonly>
                    </div>
                </div>
                <div class="row d-flex justify-content-between">
                    <div class="col-sx-12 col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-3 my-2">
                        <label for="celular">N° de celular:</label>
                        <input type="text" name="celular" class="form-control celular" placeholder="Numero de celular" maxlength="9">
                    </div>
                    <div class="col-sx-12 col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-3 my-2">
                        <label for="telefono">Telefono:</label>
                        <input type="text" name="telefono" class="form-control telefono" placeholder="Numero de telefono" maxlength="6">
                    </div>
                    <div class="col-sx-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6 my-2">
                        <label for="correo">Correo electronico:</label>
                        <input type="text" name="correo" class="form-control correo" placeholder="Correo de la empresa">
                    </div>
                </div>
                <label for="descripcion">Descripcion de empresa</label>
                <textarea name="descripcion" cols="20" rows="5" class="form-control descripcion" placeholder="Escriba cual es el objetivo de la empresa hacia sus clientes"></textarea>
                <input type="submit" name="proveedor_proveedor" class="form-control btn btn-dark my-3 btn_proveedor" placeholder="">
            </form>
        </div>

        <!-- Formulario de Cliente Juridico -->
        <div id="formularioClienteJuridica" style="display: none;" class="border border-5 border-dark  rounded-4">
            <h2 class="text-center bg-dark bg-opacity-85 text-light">Formulario de Cliente Jurídico</h2>
            <form action="../crud/agregar_entidad.php" id="formulario_juridico" method="POST" class="mx-auto px-5 my-3">
                <input type="hidden" value="comprador" name="tipo_seleccionado" class="tipo_seleccionado">
                <input type="hidden" value="juridico" name="subtipo_seleccionado" class="subtipo_seleccionado">
                <div class="row d-flex justify-content-center">
                    <div class="col-sx-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-xxl-6 my-2">
                        <label for="n_ruc">Ruc del cliente juridico:</label>
                        <input type="text" name="n_ruc" class="form-control Ndocumentacion" placeholder="El numero ruc">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sx-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6 my-2">
                        <label for="rsocial">Razon social:</label>
                        <input type="text" name="rsocial" class="form-control Rsocial" placeholder="Escribe el nombre segun la sunat" readonly>
                    </div>
                    <div class="col-sx-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6 my-2">
                        <label for="rcomercial">Nombre Comercial:</label>
                        <input type="text" name="rcomercial" class="form-control Rcomercial" placeholder="Escribe el nombre comercial">
                    </div>
                </div>

                <label for="direccion">Direccion:</label>
                <input type="text" name="direccion" class="form-control direccion" placeholder="Dirección de la empresa" readonly>
                <label for="referencia">Referencia:</label>
                <input type="text" name="referencia" class="form-control referencia" placeholder="Referencia del lugar">
                <div class="row">
                    <div class="col-sx-12 col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-4">
                        <label for="distrito">Distrito:</label>
                        <input type="text" name="distrito" class="form-control distrito" placeholder="Distrito de la empresa" readonly>
                    </div>
                    <div class="col-sx-12 col-sm-6 col-md-6 col-lg-4 col-xl-4 col-xxl-4">
                        <label for="provincia">Provincia:</label>
                        <input type="text" name="provincia" class="form-control provincia" placeholder="Provincia de la empresa" readonly>
                    </div>
                    <div class="col-sx-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 col-xxl-4">
                        <label for="departamento">Departamento:</label>
                        <input type="text" name="departamento" class="form-control departamento" placeholder="Departamento de la empresa" readonly>
                    </div>
                </div>
                <div class="row d-flex justify-content-between">
                    <div class="col-sx-12 col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-3">
                        <label for="celular">N° de celular:</label>
                        <input type="text" name="celular" class="form-control celular" placeholder="Numero de celular" maxlength="9">
                    </div>
                    <div class="col-sx-12 col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-3">
                        <label for="telefono">Telefono:</label>
                        <input type="text" name="telefono" class="form-control telefono" placeholder="Numero de telefono" maxlength="6">
                    </div>
                    <div class="col-sx-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                        <label for="correo">Correo electronico:</label>
                        <input type="text" name="correo" class="form-control correo" placeholder="Correo de la empresa">
                    </div>
                </div>
                <label for="descripcion">Descripcion de empresa</label>
                <textarea name="descripcion" cols="20" rows="5" class="form-control descripcion" placeholder="Escriba cual es el objetivo de la empresa hacia sus clientes"></textarea>
                <input type="submit" name="cliente_juridico" class="btn_juridico form-control btn btn-dark my-3">
            </form>
        </div>

        <!-- Formulario de Cliente Natural -->
        <div id="formularioClienteNatural" style="display: none;" class="border border-5 border-dark  rounded-4">
            <h2 class="text-center bg-dark bg-opacity-85 text-light">Formulario de Cliente Natural</h2>
            <form action="../crud/agregar_entidad.php" id="formulario_natural" method="POST" class="mx-auto px-5 my-3">
                <input type="hidden" value="comprador" name="tipo_seleccionado" class="tipo_seleccionado">
                <input type="hidden" value="natural" name="subtipo_seleccionado" class="subtipo_seleccionado">
                <div class="row">
                    <div class="col-sx-12 col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-3">
                        <label for="dni">Dni:</label>
                        <input type="natural" name="dni" class="form-control Ndocumentacion" maxlength="8">
                    </div>
                    <div class="col-sx-12 col-sm-6 col-md-6 col-lg-3 col-xl-3 col-xxl-3">
                        <label for="celular">Celular:</label>
                        <input type="text" name="celular" class="form-control celular" maxlength="9">
                    </div>
                    <div class="col-sx-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
                        <label for="correo">Correo electronico:</label>
                        <input type="text" name="correo" class="form-control correo">
                    </div>
                </div>
                <label for="nombres" class="my-1">Nombres de la entidad:</label>
                <input type="text" name="nombres" class="form-control nombres" readonly>
                <label for="represent_tres" class="my-1">Primer apellido de entidad:</label>
                <input type="text" name="represent_tres" class="form-control Represent_tres" readonly>
                <label for="represent_cuatro" class="my-1">Segundo apellido de entidad:</label>
                <input type="text" name="represent_cuatro" class="form-control Represent_cuatro" readonly>
                <label for="departamento" class="my-1">Departamento registrado:</label>
                <input type="text" name="departamento" class="form-control departamento ">
                <input type="submit" name="cliente_natural" class="btn_natural form-control btn btn-dark my-3">
            </form>
        </div>

        <a class="btn btn-info mt-5 px-1 " href="../entrada/lista_entidad.php">Volver a inicio</a>
    </div>
    <?php include '../contenido/footer.php'; ?>

    <script>
        // seleccionar tipo
        $('#selectTipo').change(function() {

            var tipo = $('#selectTipo').val();
            $('#selectSubtipo').val($('#selectSubtipo option:disabled').val());

            if (tipo === 'vendedor') {
                $('#selectSubtipo').val('proveedor');
            }

            if (tipo === 'comprador') {
                $('#selectSubtipo').val('natural');
            }

            mostrarFormulario();
        });


        // Manejar el cambio en el subtipo de entidad
        $('#selectSubtipo').change(function() {
            mostrarFormulario();
        });

        function limpiarDatos() {
            // residuos de la consulta dni
            $(".Ndocumentacion").val('');
            $(".nombres").val('');
            $(".Represent_tres").val('');
            $(".Represent_cuatro").val('');

            // residuos de la consulta ruc
            $(".Rsocial").val('');
            $(".direccion").val('');
            $(".departamento").val('');
            $(".provincia").val('');
            $(".distrito").val('');
        }

        // Función para mostrar el formulario correspondiente según las selecciones
        function mostrarFormulario() {
            var tipo = $('#selectTipo').val();
            var subtipo = $('#selectSubtipo').val();

            // Ocultar todos los formularios
            $('#formularioProveedor, #formularioClienteJuridica, #formularioClienteNatural').hide();

            // Mostrar el formulario correspondiente
            if (tipo === 'vendedor') {

                // ocultaba el formulario del proveedor
                $('#formularioProveedor').show();
                // Ocultar las opciones "natural" y "juridico" en el subtipo
                $('#selectSubtipo option[value="natural"], #selectSubtipo option[value="juridico"]').hide();
                // Mostrar la opción "proveedor" en el subtipo
                $('#selectSubtipo option[value="proveedor"]').show();

                // limpiar los campos
                limpiarDatos();


            } else if (tipo === 'comprador') {

                // Ocultar la opción "proveedor" en el subtipo
                $('#selectSubtipo option[value="proveedor"]').hide();
                // Mostrar las opciones "natural" y "juridico" en el subtipo
                $('#selectSubtipo option[value="natural"], #selectSubtipo option[value="juridico"]').show();

                if (subtipo === 'juridico') {

                    // muestra el cliente juridico
                    $('#formularioClienteJuridica').show();

                    // limpiar los campos
                    limpiarDatos();

                } else if (subtipo === 'natural') {

                    // muestra el cliente natural
                    $('#formularioClienteNatural').show();

                    // limpiar los campos
                    limpiarDatos();

                }
            }
        }

        // api para obtener informacion
        $(".Ndocumentacion").on('change', function() {
            let n_documento = $(this).val();
            let n_info;

            if (n_documento.length >= 11) {
                n_info = 'ruc';
                $.ajax({
                    type: "POST",
                    url: "../crud/api_sunat.php",
                    data: {
                        n_info: n_info,
                        n_documento: n_documento
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response) {
                            $(".Rsocial").val(response.razonSocial);
                            $(".direccion").val(response.direccion);
                            $(".departamento").val(response.departamento);
                            $(".provincia").val(response.provincia);
                            $(".distrito").val(response.distrito);
                        } else {
                            console.error("La respuesta de la API no contiene la información esperada.");
                            $('.Ndocumentacion').val('');
                            $('.Rsocial').val('');
                            $(".direccion").val('');
                            $(".departamento").val('');
                            $(".provincia").val('');
                            $(".distrito").val('');

                        }
                    }
                });
            } else if (n_documento.length >= 8) {
                n_info = 'dni';
                $.ajax({
                    type: "POST",
                    url: "../crud/api_sunat.php",
                    data: {
                        n_info: n_info,
                        n_documento: n_documento
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response) {
                            // Actualiza los campos del formulario con la respuesta de la API
                            $(".nombres").val(response.nombres);
                            $(".Represent_tres").val(response.apellidoPaterno);
                            $(".Represent_cuatro").val(response.apellidoMaterno);
                        } else {
                            console.error("La respuesta de la API no contiene la información esperada.");
                            $(".Ndocumentacion").val('');
                            $(".nombres").val('');
                            $(".Represent_tres").val('');
                            $(".Represent_cuatro").val('');
                        }
                    }
                });
            }
        });

        // obtener los datos del formulario para su insersion
        $(document).ready(function() {

            // Manejar el envío del formulario mediante AJAX
            $('#formulario_proveedor').submit(function(e) {
                e.preventDefault();

                let form = $(this);

                let expDocumento = /^[0-9]{11}$/;
                let ruc = form.find(".Ndocumentacion").val();

                let rsocial = form.find(".Rsocial").val();
                let rcomercial = form.find(".Rcomercial").val();
                let direccion = form.find(".direccion").val();
                let referencia = form.find(".referencia").val();
                let distrito = form.find(".distrito").val();
                let provincia = form.find(".provincia").val();
                let departamento = form.find(".departamento").val();

                let expCelular = /^[0-9]{9}$/;
                let celular = form.find(".celular").val();

                let expTelefono = /^[0-9]{6}$/;
                let telefono = form.find(".telefono").val();

                let expCorreo = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
                let correo = form.find(".correo").val();

                let descripcion = form.find(".descripcion").val();
                let boton = form.find(".btn_proveedor").val();
                let tipo = form.find(".tipo_seleccionado").val();
                let subtipo = form.find(".subtipo_seleccionado").val();

                // deshabilitarlo return  despues

                if (ruc === '') {
                    ErrorAlert("El campo RUC no debe estar vacío");
                    return;
                } else if (!expDocumento.test(ruc)) {
                    ErrorAlert("El ruc debe tener 11 digitos");
                } else if (rsocial === '') {
                    ErrorAlert("El ruc que ha agregado es incorrecto");
                } else if (rcomercial === '') {
                    ErrorAlert("El nombre comercial no debe estar vacío");
                } else if (referencia === '') {
                    ErrorAlert("La direccion de referencia no debe estar vacío");
                } else if (celular === '') {
                    ErrorAlert("Debes agregar un n° de celular");
                } else if (!expCelular.test(celular)) {
                    ErrorAlert("Debes ingresar un n° de celular valido e igual a 9 digitos");
                } else if (telefono === '') {
                    ErrorAlert("El n° de telefono no debe estar vacío");
                } else if (!expTelefono.test(telefono)) {
                    ErrorAlert("Debes ingresar un n° de telefono valido e igual a 6 digitos");
                } else if (correo === '') {
                    ErrorAlert("El correo electronico no debe estar vacío");
                } else if (!correo.includes('@gmail') && !correo.includes('@outlook') && !correo.includes('@otrodominio')) {
                    ErrorAlert("Ingresa un correo con un dominio válido (ej. @gmail, @outlook, @otrodominio)");
                } else if (!expCorreo.test(correo)) {
                    ErrorAlert("Ingresa un correo válido");
                } else if (descripcion === '') {
                    ErrorAlert("La descripcion no puede estar vacia");
                } else {

                    Swal.fire({
                        title: "¿Estas seguro de registrar este proveedor?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Confirmar"
                    }).then((result) => {
                        if (result.isConfirmed) {


                            $.ajax({
                                type: 'POST',
                                url: '../crud/agregar_entidad.php',
                                data: {
                                    ruc: ruc,
                                    rsocial: rsocial,
                                    rcomercial: rcomercial,
                                    direccion: direccion,
                                    referencia: referencia,
                                    distrito: distrito,
                                    provincia: provincia,
                                    departamento: departamento,
                                    celular: celular,
                                    telefono: telefono,
                                    correo: correo,
                                    descripcion: descripcion,
                                    proveedor_proveedor: boton,
                                    tipo: tipo,
                                    subtipo: subtipo
                                },
                                dataType: 'json',
                                success: function(response) {
                                    if (response.status === 'success') {
                                        console.log(response);
                                        Swal.fire({
                                            title: "Registrado",
                                            icon: "success",
                                            text: response.mensaje
                                        });
                                        form.find(".Ndocumentacion").val('');
                                        form.find(".Rsocial").val('');
                                        form.find(".Rcomercial").val('');
                                        form.find(".direccion").val('');
                                        form.find(".referencia").val('');
                                        form.find(".distrito").val('');
                                        form.find(".provincia").val('');
                                        form.find(".departamento").val('');
                                        form.find(".celular").val('');
                                        form.find(".telefono").val('');
                                        form.find(".correo").val('');
                                        form.find(".descripcion").val('');

                                    } else {
                                        console.log(response)
                                        Swal.fire({
                                            title: "Error de insercion",
                                            icon: "error",
                                            text: response.mensaje 
                                        });
                                    }
                                }

                            });
                        }
                    });
                }

            });

            function ErrorAlert(fallo) {
                Swal.fire({
                    icon: "error",
                    title: fallo,
                });
            }

            $('#formulario_juridico').submit(function(e) {
                e.preventDefault();
                let form = $(this);

                let expDocumento = /^[0-9]{11}$/;
                let ruc = form.find(".Ndocumentacion").val();

                let rsocial = form.find(".Rsocial").val();
                let rcomercial = form.find(".Rcomercial").val();
                let direccion = form.find(".direccion").val();
                let referencia = form.find(".referencia").val();
                let distrito = form.find(".distrito").val();
                let provincia = form.find(".provincia").val();
                let departamento = form.find(".departamento").val();

                let expCelular = /^[0-9]{9}$/;
                let celular = form.find(".celular").val();

                let expTelefono = /^[0-9]{6}$/;
                let telefono = form.find(".telefono").val();


                let expCorreo = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
                let correo = form.find(".correo").val();

                let descripcion = form.find(".descripcion").val();
                let boton = form.find(".btn_juridico").val();
                let tipo = form.find(".tipo_seleccionado").val();
                let subtipo = form.find(".subtipo_seleccionado").val();


                if (ruc === '') {
                    ErrorAlert("El campo RUC no debe estar vacío");
                    return;
                } else if (!expDocumento.test(ruc)) {
                    ErrorAlert("El ruc debe tener 11 digitos");
                } else if (rsocial === '') {
                    ErrorAlert("El ruc que ha agregado es incorrecto");
                } else if (rcomercial === '') {
                    ErrorAlert("El nombre comercial no debe estar vacío");
                } else if (referencia === '') {
                    ErrorAlert("La direccion de referencia no debe estar vacío");
                } else if (celular === '') {
                    ErrorAlert("Debes agregar un n° de celular");
                } else if (!expCelular.test(celular)) {
                    ErrorAlert("Debes ingresar un n° de celular valido e igual a 9 digitos");
                } else if (telefono === '') {
                    ErrorAlert("El numero de telefono no debe estar vacío");
                } else if (!expTelefono.test(telefono)) {
                    ErrorAlert("Debes ingresar un n° de telefono valido e igual a 6 digitos");
                } else if (correo === '') {
                    ErrorAlert("El correo electronico no debe estar vacío");
                } else if (!correo.includes('@gmail') && !correo.includes('@outlook') && !correo.includes('@otrodominio')) {
                    ErrorAlert("Ingresa un correo con un dominio válido (ej. @gmail, @outlook, @otrodominio)");
                } else if (!expCorreo.test(correo)) {
                    ErrorAlert("Ingresa un correo válido");
                } else if (descripcion === '') {
                    ErrorAlert("La descripcion no puede estar vacia");
                } else {
                    Swal.fire({
                        title: "¿Estas seguro de registrar este cliente juridico?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Confirmar"
                    }).then((result) => {
                        if (result.isConfirmed) {


                            $.ajax({
                                type: 'POST',
                                url: '../crud/agregar_entidad.php',
                                data: {
                                    ruc: ruc,
                                    rsocial: rsocial,
                                    rcomercial: rcomercial,
                                    direccion: direccion,
                                    referencia: referencia,
                                    distrito: distrito,
                                    provincia: provincia,
                                    departamento: departamento,
                                    celular: celular,
                                    telefono: telefono,
                                    correo: correo,
                                    descripcion: descripcion,
                                    cliente_juridico: boton,
                                    tipo: tipo,
                                    subtipo: subtipo
                                },
                                dataType: 'json',
                                success: function(response) {
                                    if (response.status === 'success') {
                                        console.log(response);
                                        Swal.fire({
                                            title: "Registrado",
                                            icon: "success",
                                            text: response.mensaje
                                        });
                                        form.find(".Ndocumentacion").val('');
                                        form.find(".Rsocial").val('');
                                        form.find(".Rcomercial").val('');
                                        form.find(".direccion").val('');
                                        form.find(".referencia").val('');
                                        form.find(".distrito").val('');
                                        form.find(".provincia").val('');
                                        form.find(".departamento").val('');
                                        form.find(".celular").val('');
                                        form.find(".telefono").val('');
                                        form.find(".correo").val('');
                                        form.find(".descripcion").val('');

                                    } else {
                                        console.log(response)
                                        Swal.fire({
                                            title: "Error de insercion",
                                            icon: "error",
                                            text: response.mensaje 
                                        });
                                    }
                                }

                            });
                        }
                    });
                }
            });

            $('#formulario_natural').submit(function(e) {
                e.preventDefault();
                let form = $(this);

                let expDocumento = /^[0-9]{8}$/;
                let dni = form.find(".Ndocumentacion").val();

                let departamento = form.find(".departamento").val();
                let nombres = form.find(".nombres").val();
                let apellido_paterno = form.find(".Represent_tres").val();
                let apellido_materno = form.find(".Represent_cuatro").val();

                let expCelular = /^[0-9]{9}$/;
                let celular = form.find(".celular").val();

                let expCorreo = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
                let correo = form.find(".correo").val();

                let boton = form.find(".btn_natural").val();
                let tipo = form.find(".tipo_seleccionado").val();
                let subtipo = form.find(".subtipo_seleccionado").val();


                if (dni === '') {
                    ErrorAlert("El campo dni no debe estar vacío");
                } else if (!expDocumento.test(dni)) {
                    ErrorAlert("El dni debe tener al menos 8 digitos");
                } else if (nombres==='') {
                    ErrorAlert("El dni que ha agregado es incorrecto");
                } else if (celular === '') {
                    ErrorAlert("Debes agregar un n° de celular");
                } else if (!expCelular.test(celular)) {
                    ErrorAlert("Debes ingresar un n° de celular valido e igual a 9 digitos");
                } else if (correo === '') {
                    ErrorAlert("El correo electronico no debe estar vacío");
                } else if (!correo.includes('@gmail') && !correo.includes('@outlook') && !correo.includes('@otrodominio')) {
                    ErrorAlert("Ingresa un correo con un dominio válido (ej. @gmail, @outlook, @otrodominio)");
                } else if (!expCorreo.test(correo)) {
                    ErrorAlert("Ingresa un correo válido");
                } else if (departamento === '') {
                    ErrorAlert("El lugar donde va a registrar el cliente natural no debe estar vacío");
                } else {

                    Swal.fire({
                        title: "¿Estas seguro de registrar a este cliente natural?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Confirmar"
                    }).then((result) => {
                        if (result.isConfirmed) {


                            $.ajax({
                                type: 'POST',
                                url: '../crud/agregar_entidad.php',
                                data: {
                                    dni: dni,
                                    nombres: nombres,
                                    apellido_paterno: apellido_paterno,
                                    apellido_materno: apellido_materno,
                                    departamento: departamento,
                                    celular: celular,
                                    correo: correo,
                                    cliente_natural: boton,
                                    tipo: tipo,
                                    subtipo: subtipo
                                },
                                dataType: 'json',
                                success: function(response) {
                                    if (response.status === 'success') {
                                        console.log(response);
                                        Swal.fire({
                                            title: "Registrado",
                                            icon: "success",
                                            text: response.mensaje
                                        });
                                        form.find(".Ndocumentacion").val('');
                                        form.find(".nombres").val('');
                                        form.find(".Represent_tres").val('');
                                        form.find(".Represent_cuatro").val('');
                                        form.find(".departamento").val('');
                                        form.find(".celular").val('');
                                        form.find(".telefono").val('');
                                        form.find(".correo").val('');

                                    } else {
                                        console.log(response)
                                        Swal.fire({
                                            title: "Error de insercion",
                                            icon: "error",
                                            text: response.mensaje 
                                        });
                                    }
                                }

                            });
                        }
                    });
                }
            });


        });
    </script>
</body>

</html>