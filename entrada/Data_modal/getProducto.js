/*========================================================================== */

// busca dentro del archivo compra, la referencia del id
n_filas = 0;
$(document).on("click", ".agregar-producto", function () {
  let producto = $(this).data("producto");
  let tabla = $("#tabla_producto");

  let producto_agregado = $("#tabla_producto tbody tr");
  let existingRow = producto_agregado.filter(function () {
    return $(this).find("td:eq(0)").text() == producto.id_producto;
  });

  if (existingRow.length > 0) {
    let cantidadInput = existingRow.find(".cantidad");
    let cantidadActual = parseInt(cantidadInput.val());
    cantidadInput.val(Math.max(0, cantidadActual + 1));
    cantidadInput.trigger("change");
  } else {
    let nuevaFila = $("<tr class='fila-fija text-center'>").append(
      $("<td style='display:none' class='id_producto'>").text(
        producto.id_producto
      ),
      $("<td>").text(++n_filas),
      // $("<td>").text(producto.nombre_subcategoria),
      $("<td>").text(producto.codigo_referencia),
      $("<td>").html(
        '<input type="number" class="form-control cantidad" value="0" name="cantidad">'
      ),
      $("<td>").html(
        '<input type="text" class="form-control precio" value="0" name="precio">'
      ),
      $("<td>").html('<div class="subtotal_fila">0.00</div>'),
      $("<td>").html(
        '<button class="btn btn-danger eliminar_fila">Eliminar</button>'
      )
    );
    tabla.append(nuevaFila);
    actualizarIndices();
  }
  actualizarTotalAcumulado();
});

function actualizarIndices() {
  let filasProductos = $("#tabla_producto tbody tr.fila-fija");
  filasProductos.each(function (index) {
    $(this)
      .find("td:eq(1)")
      .text(index + 1);
  });

  // Actualiza el valor de n_filas al total de filas de productos
  n_filas = filasProductos.length;
}

// actualiza el subtotal por fila
$(document).on("change", ".precio, .cantidad", function () {
  // Obtén la fila actual
  let fila_obtenida = $(this).closest("tr");

  // Obtén la cantidad y el precio de la fila actual
  let cantidad = Math.max(
    0,
    parseFloat(fila_obtenida.find(".cantidad").val()) || 0
  );
  let precio = Math.max(
    0,
    parseFloat(fila_obtenida.find(".precio").val()) || 0
  );

  // Actualiza las celdas de cantidad y precio en la fila actual
  fila_obtenida.find(".cantidad").val(cantidad);
  fila_obtenida.find(".precio").val(precio);

  // Calcula el total
  let total = cantidad * precio;

  // Actualiza la celda de total en la fila actual
  fila_obtenida.find(".subtotal_fila").text(total.toFixed(3)) || 0;
  actualizarTotalAcumulado();
});

// elimina la fila y actualiza el precio actual
$(document).on("click", ".eliminar_fila", function () {
  $(this).closest("tr").remove();
  actualizarIndices();
  actualizarTotalAcumulado();
});

$(document).ready(function () {
  $(".tipoCambio").change(function () {
    // Llama a la función para actualizar el total acumulado
    actualizarTotalAcumulado();
  });

  // verifica al instante cuando se cambia la moneda
  $(".respuesta_moneda").on("input", function () {
    // Llama a la función para actualizar el total acumulado
    actualizarTotalAcumulado();
  });
});

// verifica al instante cuando se cambia el tipo de moneda

// suma de todas las filas y sus resultados
function actualizarTotalAcumulado() {
  // Verifica si hay productos en la tabla
  var productosAgregados = $("#tabla_producto tbody tr.fila-fija");

  // Inicializa la suma total
  var totalAcumulado = 0;

  var tipoCambio = $(".tipoCambio").val();
  // Recorre todas las filas y suma los valores de total_producto
  productosAgregados.each(function () {
    var totalListado = parseFloat($(this).find(".subtotal_fila").text()) || 0;
    totalAcumulado += totalListado;
  });
  var igv = totalAcumulado * 0.18;
  var total = totalAcumulado + igv;

  // Elimina las filas creadas que están adelante
  $("#subtotal_acumulado_row").remove();
  $("#igv_acumulado_row").remove();
  $("#total_acumulado_row").remove();
  $("#dolar_acumulado_row").remove();
  $("#soles_acumulado_row").remove();

  if (productosAgregados.length > 0) {
    if (tipoCambio === "dolar") {
      var total_moneda = parseFloat($(".respuesta_moneda").val()) || 1; // Valor predeterminado a 1 si no se ingresa nada
      var total_soles = parseFloat(total * total_moneda);

      var subtotalRow = $(
        "<tr id='subtotal_acumulado_row' class='text-center total-row'>"
      );
      subtotalRow.append("<td colspan='3'></td>"); // Espacios en blanco
      subtotalRow.append("<td>Subtotal($/.):</td>");
      subtotalRow.append(
        "<td  class='subtotal'>" + totalAcumulado.toFixed(3) + "</td>"
      );

      var igvRow = $(
        "<tr id='igv_acumulado_row' class='text-center total-row'>"
      );
      igvRow.append("<td colspan='3'></td>"); // Espacios en blanco
      igvRow.append("<td>IGV(18%)($/.):</td>");
      igvRow.append("<td  class='igv'>" + igv.toFixed(3) + "</td>");

      var totalRow = $(
        "<tr id='total_acumulado_row' class='text-center total-row'>"
      );
      totalRow.append("<td colspan='3'></td>"); // Espacios en blanco
      totalRow.append("<td>Total($/.):</td>");
      totalRow.append("<td class='dolar_total'>" + total.toFixed(3) + "</td>");

      var solesRow = $(
        "<tr id='soles_acumulado_row' class='text-center total-row'>"
      );
      solesRow.append("<td colspan='3'></td>"); // Espacios en blanco
      solesRow.append("<td>Total(S/.):</td>");
      solesRow.append(
        "<td  class='soles_total'>" + total_soles.toFixed(3) + "</td>"
      );

      // Agregando la fila
      $("#tabla_producto tbody").append(subtotalRow);
      $("#tabla_producto tbody").append(igvRow);
      $("#tabla_producto tbody").append(totalRow);
      $("#tabla_producto tbody").append(solesRow);

      //
      $(".subtotal").text(totalAcumulado.toFixed(3));
      $(".igv").text(igv.toFixed(3));
      $(".dolar_total").text(total.toFixed(3));
      $(".soles_total").text(total_soles.toFixed(3));
    } else if (tipoCambio === "soles") {
      var total_moneda = parseFloat($(".respuesta_moneda").val()) || 1; // Valor predeterminado a 1 si no se ingresa nada
      var total_dolares = parseFloat(total / total_moneda);


      var subtotalRow = $(
        "<tr id='subtotal_acumulado_row' class='text-center total-row'>"
      );
      subtotalRow.append("<td colspan='3'></td>"); // Espacios en blanco
      subtotalRow.append("<td>Subtotal(S/.):</td>");
      subtotalRow.append(
        "<td  class='subtotal'>" + totalAcumulado.toFixed(3) + "</td>"
      );

      var igvRow = $(
        "<tr id='igv_acumulado_row' class='text-center total-row'>"
      );
      igvRow.append("<td colspan='3'></td>"); // Espacios en blanco
      igvRow.append("<td>IGV(18%)(S/.):</td>");
      igvRow.append("<td  class='igv'>" + igv.toFixed(3) + "</td>");

      var totalRow = $(
        "<tr id='total_acumulado_row' class='text-center total-row'>"
      );
      totalRow.append("<td colspan='3'></td>"); // Espacios en blanco
      totalRow.append("<td>Total(S/.):</td>");
      totalRow.append("<td  class='soles_total'>" + total.toFixed(3) + "</td>");

      var dolarRow = $(
        "<tr id='dolar_acumulado_row' class='text-center total-row'>"
      );
      dolarRow.append("<td colspan='3'></td>"); // Espacios en blanco
      dolarRow.append("<td>Total($/.):</td>");
      dolarRow.append(
        "<td  class='dolar_total'>" + total_dolares.toFixed(3) + "</td>"
      );

      // Agregando la fila
      $("#tabla_producto tbody").append(subtotalRow);
      $("#tabla_producto tbody").append(igvRow);
      $("#tabla_producto tbody").append(totalRow);
      $("#tabla_producto tbody").append(dolarRow);

      //
      $(".subtotal").text(totalAcumulado.toFixed(3));
      $(".igv").text(igv.toFixed(3));
      $(".soles_total").text(total.toFixed(3));
      $(".dolar_total").text(total_dolares.toFixed(3));
    }
  } else {
    // para el id de row
    $("#subtotal_acumulado_row").hide();
    $("#igv_acumulado_row").hide();
    $("#total_acumulado_row").hide();
    $("#dolar_acumulado_row").hide();
    $("#soles_acumulado_row").hide();
  }
}
