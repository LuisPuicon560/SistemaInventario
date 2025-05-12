<?php
include '../conexion.php';
include '../contenido/welcome.php';
$sql = "SELECT p.*, e.*
            FROM entidad e
            INNER JOIN persona p ON p.id_persona = e.id_persona
            WHERE e.subtipo_entidad='natural'";
$resultado = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '../contenido/head.php' ?>
    <title>Lista de Entidades</title>
</head>

<body>
    <?php include '../contenido/menu.php' ?>

    <div class="container mt-4 my-5">
        <?php include '../contenido/mensaje.php' ?>
        <h1 class="text-center">Lista de personas DNI</h1>
        <div class="table-responsive">
            <table class="table" id="example">
                <thead>
                    <tr class="text-center">
                        <th>Tipo Entidad</th>
                        <th>Subtipo Entidad</th>
                        <th>Numero</th>
                        <th>Primer Nombre</th>
                        <th>Primer Apellido</th>
                        <th>Departamento</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($mostrar = mysqli_fetch_array($resultado)) {
                    ?>
                        <tr class="text-center">
                            <td><?php echo $mostrar['tipo_entidad']; ?></td>
                            <td><?php echo $mostrar['subtipo_entidad']; ?></td>
                            <td><?php echo $mostrar['n_documentacion']; ?></td>
                            <td><?php echo $mostrar['nombres']; ?></td>
                            <td><?php echo $mostrar['priapellido_persona']; ?></td>
                            <td><?php echo $mostrar['departamento']; ?></td>
                            <td>
                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit-entidad" data-bs-id="<?= $mostrar['id_entidad']; ?>">Editar</button>
                                <?php
                                if ($mostrar['estado'] == 1) {
                                    echo "<a href='../crud/estado_natural.php?id=" . $mostrar['id_entidad'] . "&estado=0' class='btn btn-danger'>Desactivar</a>";
                                } else {
                                    echo "<a href='../crud/estado_natural.php?id=" . $mostrar['id_entidad'] . "&estado=1' class='btn btn-success'>Activar</a>";
                                }
                                ?>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php include './modal/editar_entidad.php' ?>
    <?php include '../contenido/footer.php' ?>

    <script>
        // limpiar los datos de la consola
        function limpiarDatos() {
            // residuos de la consulta de api
            $(".Ndocumentacion").val('');

            // residuos de la consulta ruc
            $(".Rsocial").val('');
            $(".direccion").val('');
            $(".provincia").val('');
            $(".distrito").val('');
        }

        // Consultar a la api de reniec
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
                        }
                    }
                });
            }
        });

        //verifica sie s que los datos de todo el php esten cargados por completo
        $(document).ready(function() {

            let editEntidad = $("#edit-entidad");
            if (editEntidad) {
                editEntidad.on("shown.bs.modal", (event) => {
                    let button = event.relatedTarget;
                    let getEntidad = button.getAttribute("data-bs-id");

                    // nuevo
                    let selectTipo = $("#selectTipo");
                    let selectSubtipo = $("#selectSubtipo");

                    let inputPersona = $(".idPersona");
                    let nombres = $(".nombres");
                    let priapellido = $(".Represent_tres");
                    let segapellido = $(".Represent_cuatro");
                    let telefono = $(".telefono");
                    let celular = $(".celular");
                    let correo = $(".correo");

                    let inputIdentidad = $(".idEntidad");
                    let Tipo = $(".tipo_seleccionado");
                    let subTipo = $(".subtipo_seleccionado");

                    let Ndocumentacion = $(".Ndocumentacion");
                    let Rsocial = $(".Rsocial");
                    let Rcomercial = $(".Rcomercial");
                    let direccion = $(".direccion");
                    let referencia = $(".referencia");
                    let distrito = $(".distrito");
                    let provincia = $(".provincia");
                    let departamento = $(".departamento");
                    let inputDescripcion = $(".descripcion");


                    selectTipo.change(function() {
                        var tipoEntidad = $(this).val();
                        var selectSubtipo = $("#selectSubtipo");

                        // Limpiar opciones previas
                        selectSubtipo.find('option').remove();

                        if (tipoEntidad === "vendedor") {
                            // Mostrar solo las opciones relacionadas con proveedor
                            selectSubtipo.append('<option value="proveedor">proveedor</option>').prop('disabled', false);

                            $("#Subtipo").show();
                        } else if (tipoEntidad === "comprador") {
                            selectSubtipo.append('<option value="natural">Natural</option>');
                            selectSubtipo.append('<option value="juridico">Juridico</option>');
                            selectSubtipo.prop('disabled', false);
                            selectSubtipo.val("natural");
                            $("#Subtipo").show();
                        } else {
                            $("#Subtipo").hide();
                        }
                        mostrarFormularioSegunSubtipo(selectSubtipo.val());
                    });

                    selectSubtipo.change(function() {
                        mostrarFormularioSegunSubtipo($(this).val());
                    });

                    function mostrarFormularioSegunSubtipo(subtipo) {
                        $("#formularioProveedor, #formularioClienteJuridica, #formularioClienteNatural").hide();
                        if (subtipo === "proveedor") {
                            $("#formularioProveedor").show();
                            $(".tipo_seleccionado").val("vendedor");
                            $(".subtipo_seleccionado").val("proveedor");
                        } else if (subtipo === "juridico") {
                            $("#formularioClienteJuridica").show();
                            $(".tipo_seleccionado").val("comprador");
                            $(".subtipo_seleccionado").val("juridico");
                        } else if (subtipo === "natural") {
                            $("#formularioClienteNatural").show();
                            $(".tipo_seleccionado").val("comprador");
                            $(".subtipo_seleccionado").val("natural");
                        }
                    }
                    //archivo para la petición
                    let url = "../crud/seleccionarEntidad.php";
                    let formData = new FormData();
                    formData.append("getEntidad", getEntidad);

                    fetch(url, {
                            method: "POST",
                            body: formData,
                        })
                        .then(response => response.json())
                        .then(data => {
                            // tener en cuenta que un error dentro de este "response" puede no ejecutar el resto del codigo dentro de este bloque
                            // Asigna los valores a los campos en el modal
                            inputPersona.val(data.id_persona);
                            nombres.val(data.nombres);
                            priapellido.val(data.priapellido_persona);
                            segapellido.val(data.segapellido_persona);
                            celular.val(data.celular_persona);
                            telefono.val(data.telefono_persona);
                            correo.val(data.correo_entidad);
                            inputIdentidad.val(data.id_entidad);

                            Tipo.val(data.tipo_entidad);
                            subTipo.val(data.subtipo_entidad);

                            Ndocumentacion.val(data.n_documentacion);
                            Rsocial.val(data.razon_social);
                            Rcomercial.val(data.razon_comercial);
                            direccion.val(data.direccion);
                            referencia.val(data.referencia);
                            distrito.val(data.distrito);
                            provincia.val(data.provincia);
                            departamento.val(data.departamento);
                            inputDescripcion.val(data.descripcion);

                            // se coloca como atributo value= val
                            selectTipo.val(data.tipo_entidad).trigger('change');

                            // Establece el valor seleccionado en el selector de tipo de identificación
                            selectSubtipo.val(data.subtipo_entidad).trigger('change');

                            // Muestra el formulario correspondiente
                            if (data.subtipo_entidad === "proveedor") {
                                $("#formularioProveedor").show();
                                $("#formularioClienteNatural").hide();
                                $("#formularioClienteJuridica").hide();
                            } else if (data.subtipo_entidad === "juridico") {
                                $("#formularioProveedor").hide();
                                $("#formularioClienteNatural").hide();
                                $("#formularioClienteJuridica").show();
                            } else if (data.subtipo_entidad === "natural") {
                                $("#formularioProveedor").hide();
                                $("#formularioClienteNatural").show();
                                $("#formularioClienteJuridica").hide();
                            } else {
                                $("#formularioProveedor").hide();
                                $("#formularioClienteNatural").hide();
                                $("#formularioClienteJuridica").hide();
                            }

                        })
                        .catch((err) => console.log(err));

                });

            }

        });

        $(document).ready(function() {

            $("#example").DataTable({
                "language": {
                    "lengthMenu": "Mostrar _MENU_ registros",
                    "zeroRecords": "No se encontraron resultados de la busqueda",
                    "info": "Mostrando registros de _START_ al _END_ de un total de _TOTAL_ registros",
                    "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sSearch": "Buscar:",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Ultimo",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior",
                    },
                    "sProcessing": "Procesando..",
                }
            });
        });

        $(document).ready(function() {

            // Manejar el envío del formulario mediante AJAX
            $('#formulario_proveedor').submit(function(e) {
                e.preventDefault();
                let form = $(this);

                let ruc = form.find(".Ndocumentacion").val();
                let rsocial = form.find(".Rsocial").val();
                let rcomercial = form.find(".Rcomercial").val();
                let direccion = form.find(".direccion").val();
                let referencia = form.find(".referencia").val();
                let distrito = form.find(".distrito").val();
                let provincia = form.find(".provincia").val();
                let departamento = form.find(".departamento").val();
                let celular = form.find(".celular").val();
                let telefono = form.find(".telefono").val();
                let correo = form.find(".correo").val();
                let descripcion = form.find(".descripcion").val();
                let boton = form.find(".btn_proveedor").val();
                let tipo = form.find(".tipo_seleccionado").val();
                let subtipo = form.find(".subtipo_seleccionado").val();
                let idEntidad = form.find(".idEntidad").val();
                let idPersona = form.find(".idPersona").val();


                Swal.fire({
                    title: "¿Quieres actualizar los datos de esta entidad?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Confirmar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'POST',
                            url: '../crud/actualizar_entidad.php',
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
                                subtipo: subtipo,
                                idEntidad: idEntidad,
                                idPersona: idPersona
                            },
                            dataType: 'json',
                            success: function(response) {
                                if (response.status === 'success') {
                                    console.log(response);
                                    Swal.fire({
                                        title: "Actualizado",
                                        icon: "success",
                                        text: response.mensaje
                                    });

                                } else {
                                    console.log(response)
                                    Swal.fire({
                                        title: "Error de actualizacion",
                                        icon: "error",
                                        text: response.mensaje // Utiliza el mensaje de la respuesta JSON
                                    });
                                }
                            }

                        });
                    }
                });

            });

            $('#formulario_juridico').submit(function(e) {
                e.preventDefault();
                let form = $(this);

                let ruc = form.find(".Ndocumentacion").val();
                let rsocial = form.find(".Rsocial").val();
                let rcomercial = form.find(".Rcomercial").val();
                let direccion = form.find(".direccion").val();
                let referencia = form.find(".referencia").val();
                let distrito = form.find(".distrito").val();
                let provincia = form.find(".provincia").val();
                let departamento = form.find(".departamento").val();
                let celular = form.find(".celular").val();
                let telefono = form.find(".telefono").val();
                let correo = form.find(".correo").val();
                let descripcion = form.find(".descripcion").val();
                let boton = form.find(".btn_juridico").val();
                let tipo = form.find(".tipo_seleccionado").val();
                let subtipo = form.find(".subtipo_seleccionado").val();
                let idEntidad = form.find(".idEntidad").val();
                let idPersona = form.find(".idPersona").val();


                Swal.fire({
                    title: "¿Quieres actualizar los datos de esta entidad?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Confirmar"
                }).then((result) => {
                    if (result.isConfirmed) {


                        $.ajax({
                            type: 'POST',
                            url: '../crud/actualizar_entidad.php',
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
                                subtipo: subtipo,
                                idEntidad: idEntidad,
                                idPersona: idPersona
                            },
                            dataType: 'json',
                            success: function(response) {
                                if (response.status === 'success') {
                                    console.log(response);
                                    Swal.fire({
                                        title: "Actualizado",
                                        icon: "success",
                                        text: response.mensaje
                                    });

                                } else {
                                    console.log(response)
                                    Swal.fire({
                                        title: "Error de insercion",
                                        icon: "error",
                                        text: response.mensaje // Utiliza el mensaje de la respuesta JSON
                                    });
                                }
                            }

                        });
                    }
                });

            });

            $('#formulario_natural').submit(function(e) {
                e.preventDefault();
                let form = $(this);

                let dni = form.find(".Ndocumentacion").val();
                let departamento = form.find(".departamento").val();
                let nombres = form.find(".nombres").val();
                let apellido_paterno = form.find(".Represent_tres").val();
                let apellido_materno = form.find(".Represent_cuatro").val();
                let celular = form.find(".celular").val();
                let correo = form.find(".correo").val();
                let boton = form.find(".btn_natural").val();
                let tipo = form.find(".tipo_seleccionado").val();
                let subtipo = form.find(".subtipo_seleccionado").val();
                let idEntidad = form.find(".idEntidad").val();
                let idPersona = form.find(".idPersona").val();

                Swal.fire({
                    title: "¿Quieres actualizar los datos de esta entidad?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Confirmar"
                }).then((result) => {
                    if (result.isConfirmed) {


                        $.ajax({
                            type: 'POST',
                            url: '../crud/actualizar_entidad.php',
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
                                subtipo: subtipo,
                                idEntidad: idEntidad,
                                idPersona: idPersona
                            },
                            dataType: 'json',
                            success: function(response) {
                                if (response.status === 'success') {
                                    console.log(response);
                                    Swal.fire({
                                        title: "Actualizado",
                                        icon: "success",
                                        text: response.mensaje
                                    });
                                } else {
                                    console.log(response)
                                    Swal.fire({
                                        title: "Error de Actualizacion",
                                        icon: "error",
                                        text: response.mensaje // Utiliza el mensaje de la respuesta JSON
                                    });
                                }
                            }

                        });
                    }
                });

            });

            function ErrorAlert(fallo) {
                Swal.fire({
                    icon: "error",
                    title: fallo,
                });
            }
        });
    </script>
</body>

</html>