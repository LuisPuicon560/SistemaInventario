$(document).ready(function () {
    // agregar fila de datos de categoria a la pagina subcategoria
    $(document).on("click", ".agregar-categoria", function () {
        let categoria = $(this).data("categoria");

        $(".idCategoria").val(categoria.id_categoria);
        $(".categoria").val(categoria.nombre_categoria);
        $("#Categoria").modal("hide");
    });

    // agregarfila de datos de subcategoria a la  pagina marca
    $(document).on("click", ".agregar-subcategoria", function () {
        var subcategoria = $(this).data("subcategoria");
        $(".idSubcategoria").val(subcategoria.id_subcategoria);
        $(".subcategoria").val(subcategoria.nombre_subcategoria);
        $(".categoria").val(subcategoria.nombre_categoria);
        $("#Subcategoria").modal("hide");
    });

    // agregar fila de datos de marca a la pagina familia
    $(document).on("click", ".agregar-marca", function () {
        var marca = $(this).data("marca");

        $(".idMarca").val(marca.id_marca);
        $(".marca").val(marca.nombre_marca);
        $(".subcategoria").val(marca.nombre_subcategoria);
        $(".categoria").val(marca.nombre_categoria);
        $("#Marca").modal("hide");
    });

    // agregar fila de datos de familia a la pagina modelo
    $(document).on("click", ".agregar-familia", function () {
        let familia = $(this).data("familia");

        $(".idFamilia").val(familia.id_familia);
        $(".categoria").val(familia.nombre_categoria);
        $(".subcategoria").val(familia.nombre_subcategoria);
        $(".marca").val(familia.nombre_marca);
        $(".familia").val(familia.nombre_familia);
        $("#Familia").modal("hide");
    });

    // agregar fila de datos de modelo a la pagina producto
    $(document).on("click", ".agregar-modelo", function () {
        var modelo = $(this).data("modelo");

        $(".idModelo").val(modelo.id_modelo);
        $(".categoria").val(modelo.nombre_categoria);
        $(".subcategoria").val(modelo.nombre_subcategoria);
        $(".marca").val(modelo.nombre_marca);
        $(".familia").val(modelo.nombre_familia);
        $(".modelo").val(modelo.nombre_modelo);
        $(".descripcion").val(modelo.descripcion_modelo);

        $("#Modelo").modal("hide");
    });

    // agregar fila de datos de proveedor a la pagina compra
    $(document).on("click", ".agregar-proveedor", function () {
        // obtenemos todos los atributos de la accion con la clase agregar-proveedor
        var proveedor = $(this).data("proveedor");

        $('#idproveedor').val(proveedor.id_entidad);
        $("#ruc").val(proveedor.n_documentacion);
        $("#representante").val(proveedor.prinombre_persona + ' ' + proveedor.priapellido_persona);
        $("#nombre_comercial").val(proveedor.razon_social);
        $("#direccion").val(proveedor.direccion);
        $("#departamento").val(proveedor.departamento);

        // Cierra el modal #modelo
        $("#Proveedor").modal("hide");
    });

    // js puro
    // document.addEventListener('click', function(event) {
    //     if (event.target.classList.contains('agregar-proveedor')) {
    //         // Obtener el elemento con la clase agregar-proveedor
    //         const elemento = event.target;
    
    //         // Obtener los datos del proveedor del atributo data-proveedor
    //         const proveedor = JSON.parse(elemento.dataset.proveedor);
    
    //         // Llenar los campos del formulario
    //         document.getElementById('idproveedor').value = proveedor.id_entidad;
    //         document.getElementById('idproveedor').value = proveedor.id_entidad;
    //         document.getElementById('idproveedor').value = proveedor.id_entidad;
    //         document.getElementById('idproveedor').value = proveedor.id_entidad;
    //         document.getElementById('idproveedor').value = proveedor.id_entidad;
    //         document.getElementById('idproveedor').value = proveedor.id_entidad;
    //         // ... y así sucesivamente para los demás campos
    
    //         // Cerrar el modal
    //         const modal = document.getElementById('Proveedor');
    //         modal.classList.add('hide'); // O utilizar el método específico de cierre del modal
    //     }
    // });

    
    
    // libreria de tablas(excepto en area de compra y venta)
    // ejecucion de la funcion hecha por la libreria DataTable
    $("#datos_table").DataTable({
        language: {
            lengthMenu: "Mostrar _MENU_ registros",
            zeroRecords: "No se encontraron resultados de la busqueda",
            info: "Mostrando registros de _START_ al _END_ de un total de _TOTAL_ registros",
            infoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
            infoFiltered: "(filtrado de un total de _MAX_ registros)",
            sSearch: "Buscar:",
            oPaginate: {
                sFirst: "Primero",
                sLast: "Ultimo",
                sNext: "Siguiente",
                sPrevious: "Anterior",
            },
            sProcessing: "Procesando..",
        },
    });
});
