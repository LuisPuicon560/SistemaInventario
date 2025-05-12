
// los datos recogidos por
$(document).on("click", ".agregar-proveedor", function () {
  var proveedor = $(this).data('proveedor');

  // Llena los campos del formulario con los datos del proveedor
  $('#idproveedor').val(proveedor.id_entidad);
  $("#ruc").val(proveedor.n_documentacion);
  $("#representante").val(proveedor.razon_social);
  $("#nombre_comercial").val(proveedor.razon_social);
  $("#direccion").val(proveedor.direccion);
  $("#departamento").val(proveedor.departamento);

  // Cierra el modal
  $("#Proveedor").modal("hide");
});
