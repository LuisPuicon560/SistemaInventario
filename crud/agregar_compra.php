<?php

include '../conexion.php';
// session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // para entidad -> persona:
    $id_proveedor = $_POST['id_proveedor'];
    $sql_proveedor = mysqli_query($con, "SELECT p.id_persona FROM persona p INNER JOIN entidad e ON p.id_persona = e.id_persona WHERE id_entidad= $id_proveedor");

    // Obtenemos el id_persona que pertenece a compra
    $resultado_proveedor = mysqli_fetch_assoc($sql_proveedor);
    $id_persona = $resultado_proveedor['id_persona'];

    // datos de compra
    $filas = $_POST['filas'];
    $serie =mysqli_escape_string($con,$_POST['serie']); 
    $serie = preg_replace('/\s+/', ' ', $serie);

    $numero = $_POST['numero'];
    $numero = preg_replace('/\s+/', ' ', $numero);

    $fecha = $_POST['fecha'];
    $tipo_moneda = $_POST['tipo_moneda'];
    $valor_moneda = $_POST['valor_moneda'];
    $subtotal = $_POST['subtotal'];
    $igv = $_POST['igv'];
    $total_dolar = $_POST['total_dolar'];
    $total_soles = $_POST['total_soles'];

    $verificar = mysqli_query($con, "SELECT serie, numero FROM compra where id_persona=$id_persona");

    $existe = false;
    while ($row = mysqli_fetch_assoc($verificar)) {
        if (strcasecmp($row['serie'], $serie) === 0 && $row['numero'] == $numero) {
            $existe = true;
            break;
        }
    }

    if ($existe) {
        $mensaje = "La serie $serie y numero $numero ya existe en la base de datos.";
        echo json_encode(['status' => 'error', 'mensaje' => $mensaje]);
        exit();
    } else {
        $compra = "INSERT INTO compra (id_persona, serie, numero, igv, tipo_moneda,total_soles,total_dolares,fecha_registro,valor_moneda) VALUES ($id_persona,'$serie',$numero,$igv,'$tipo_moneda',$total_soles,$total_dolar,'$fecha',$valor_moneda)";
        $resultados_compra = mysqli_query($con, $compra);

        if ($resultados_compra) {

            // obtener el id_actual de lo insertado de compra
            $id_compra = mysqli_insert_id($con);

            // obtener todas las filas del array $filas
            foreach ($filas as $fila) {
                $id_producto = $fila['id_producto'];
                $cantidad = $fila['cantidad'];
                $precio = $fila['precio'];
                $subtotal_fila = $fila['subtotal_fila'];

                // agregar los datos a detalle_compra
                $detalles = "INSERT INTO detalle_compra (id_compra, id_producto, cantidad_detc, precio_detc, subtotal_fila) VALUES ('$id_compra', '$id_producto', '$cantidad', '$precio', '$subtotal_fila')";


                if (!mysqli_query($con, $detalles)) {
                    echo 'Error al ejecutar la consulta en detalle_compra: ' . mysqli_error($con);
                    exit;
                } else {

                    // si lo anterior es cierto , entonces actualizas lo de foreach(cantidad y id_producto)
                    $sql_producto = "UPDATE producto SET stock_actual=stock_actual+$cantidad WHERE id_producto=$id_producto";
                    $result_producto = mysqli_query($con, $sql_producto);

                    if ($result_producto) {
                        $mensaje = "Registro pasados correctamente";
                        echo json_encode(['status' => 'success', 'mensaje' => $mensaje]);
                        exit();
                    } else {
                        $mensaje = "Error al registrar producto";
                        echo json_encode(['status' => 'error', 'mensaje' => $mensaje]);
                        exit();
                    }
                }
            }
        } else {
            $mensaje = "Error al insertar compra";
            echo json_encode(['status' => 'error', 'mensaje' => $mensaje]);
            exit();
        }
    }
} else {
    $mensaje = "Error al obtener los datos";
    echo json_encode(['status' => 'error', 'mensaje' => $mensaje]);
    exit();
}
