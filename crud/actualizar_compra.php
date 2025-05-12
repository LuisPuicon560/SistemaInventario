<?php
include '../conexion.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // para entidad -> persona:
    $id_proveedor = $_POST['id_proveedor'];
    $id_compra = $_POST['id_compra'];
    $sql_proveedor = mysqli_query($con, "SELECT p.id_persona FROM persona p INNER JOIN entidad e ON p.id_persona = e.id_persona WHERE e.id_entidad= $id_proveedor");

    // Obtenemos el id_persona que pertenece a compra
    $resultado_proveedor = mysqli_fetch_assoc($sql_proveedor);
    $id_persona = $resultado_proveedor['id_persona'];

    // datos para compra
    $serie =mysqli_escape_string($con,$_POST['serie']); 
    $numero = $_POST['numero'];
    $fecha = $_POST['fecha'];
    $tipo_moneda = $_POST['tipo_moneda'];
    $valor_moneda = $_POST['valor_moneda'];
    $subtotal = $_POST['subtotal'];
    $igv = $_POST['igv'];
    $total_dolar = $_POST['total_dolar'];
    $total_soles = $_POST['total_soles'];


    // $verifica_serie_numero = "SELECT * FROM compra WHERE id_persona= $id_persona and id_compra<>$id_compra";
    $verifica_serie_numero = "SELECT * FROM compra WHERE id_persona= $id_persona and id_compra!=$id_compra";

    $resultados_serie_numero = mysqli_query($con, $verifica_serie_numero);

    $existe_serie_numero = false;
    while ($row_serie_numero = mysqli_fetch_assoc($resultados_serie_numero)) {
        if ($row_serie_numero['serie'] === $serie && $row_serie_numero['numero'] === $numero) {
            $existe_serie_numero = true;
            break;
        }
    }
    if ($existe_serie_numero) {
        $mensaje = "La serie $serie y el numero $numero ya existe en la base de datos.";
        echo json_encode(['status' => 'error', 'mensaje' => $mensaje]);
        exit();
    }
    // actualiza la compra 
    $actualizar_compra = "UPDATE compra SET id_persona= $id_persona,serie ='$serie',numero='$numero', igv='$igv', tipo_moneda='$tipo_moneda',total_soles='$total_soles',total_dolares='$total_dolar', fecha_registro='$fecha',valor_moneda='$valor_moneda' WHERE id_compra= $id_compra";
    $resultados_compra = mysqli_query($con, $actualizar_compra);

    // consulta todos los valores
    $obtener_producto = mysqli_query($con, "SELECT id_producto FROM detalle_compra WHERE id_compra='$id_compra'");

    // inicializar el array para almacenar los id_producto obtenidos
    $id_productos_obtenidos = array();

    // Obtenemos los id_producto que pertenecen a la compra
    while ($resultado_productos = mysqli_fetch_assoc($obtener_producto)) {
        $id_producto_obtenido = $resultado_productos['id_producto'];
        $id_productos_obtenidos[] = $id_producto_obtenido;
    }

    // datos para el detalle_producto
    $filas = $_POST['filas'];

    foreach ($filas as $fila) {
        $id_producto = $fila['id_producto'];
        $cantidad = $fila['cantidad'];
        $precio = $fila['precio'];
        $subtotal_fila = $fila['subtotal_fila'];

        //obtener datos de id_producto
        $coincide = in_array($id_producto, $id_productos_obtenidos);
        $VARIABLE = !in_array($id_producto, $id_productos_obtenidos);

        // si existe el mismo id_producto
        if (in_array($id_producto, $id_productos_obtenidos)) {

            // obtener la cantidad actual
            $consulta_detallecompra = "SELECT cantidad_detc FROM detalle_compra WHERE id_compra=$id_compra and id_producto=$id_producto ";
            $respuesta_actual_detallecompra = mysqli_query($con, $consulta_detallecompra);

            // bucle para restar fila por fila , para establecer su valor original
            while ($fila_cantidad = mysqli_fetch_assoc($respuesta_actual_detallecompra)) {
                $cantidad_obtenida = $fila_cantidad['cantidad_detc'];
                $eliminar_cantidad_actual = "UPDATE producto SET stock_actual=stock_actual-$cantidad_obtenida WHERE id_producto=$id_producto";
                $resultado_eliminar_producto = mysqli_query($con, $eliminar_cantidad_actual);
            }

            // actualizas insertando las nuevas cantidad, precio del foreach fila
            $actualizar_detallecompra = "UPDATE detalle_compra SET  cantidad_detc=$cantidad, precio_detc=$precio, subtotal_fila=$subtotal_fila where id_compra=$id_compra and id_producto=$id_producto";
            $resultados_detallecompra = mysqli_query($con, $actualizar_detallecompra);

            // actualiza la cantidad a cada producto para su respectiva suma
            $sql_producto = "UPDATE producto SET stock_actual=stock_actual+$cantidad WHERE id_producto=$id_producto";
            $result_producto = mysqli_query($con, $sql_producto);
        } else {
            $nuevo_detalle = "INSERT INTO detalle_compra (id_compra, id_producto, cantidad_detc, precio_detc, subtotal_fila) VALUES ($id_compra, $id_producto, $cantidad, $precio, $subtotal_fila)";
            $result_detalles = mysqli_query($con, $nuevo_detalle);

            $add_producto = "UPDATE producto SET stock_actual=stock_actual+$cantidad WHERE id_producto=$id_producto";
            $result_producto = mysqli_query($con, $add_producto);
        }
    }

    $id_productos_a_eliminar = array_diff($id_productos_obtenidos, array_column($filas, 'id_producto'));

    // Eliminar los detalles correspondientes a los id_productos_a_eliminar
    foreach ($id_productos_a_eliminar as $id_producto_eliminar) {

        $consulta_detallecompra = "SELECT cantidad_detc FROM detalle_compra WHERE id_compra=$id_compra and id_producto=$id_producto_eliminar ";
        $respuesta_actual_detallecompra = mysqli_query($con, $consulta_detallecompra);

        while ($fila_cantidad = mysqli_fetch_assoc($respuesta_actual_detallecompra)) {

            $cantidad_obtenida = $fila_cantidad['cantidad_detc'];
            $eliminar_cantidad_actual = "UPDATE producto SET stock_actual=stock_actual-$cantidad_obtenida WHERE id_producto=$id_producto_eliminar";
            $resultado_eliminar_producto = mysqli_query($con, $eliminar_cantidad_actual);
        }

        // Tu lógica para eliminar detalles aquí...
        $eliminar_detalle = "DELETE FROM detalle_compra WHERE id_compra = $id_compra AND id_producto = $id_producto_eliminar";
        $result_eliminar_detalle = mysqli_query($con, $eliminar_detalle);
    }
    $mensaje = "Datos de la compra actualizados correctamente";
    echo json_encode(['status' => 'success', 'mensaje' => $mensaje]);
    exit();
} else {
    $mensaje = "Los datos no han idos pasados de manera correcta";
    echo json_encode(['status' => 'error', 'mensaje' => $mensaje]);
    exit();
}
