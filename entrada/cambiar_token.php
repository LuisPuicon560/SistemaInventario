<?php
// config.php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica que se haya enviado un nuevo token
    if (isset($_POST['nuevo_token']) && !empty($_POST['nuevo_token'])) {
        $nuevoToken = $_POST['nuevo_token'];

        // Actualiza el token en el archivo
        file_put_contents('nuevo_token.txt', $nuevoToken);

        // echo 'Token actualizado correctamente';
        header("location:./index.php");
        
    } else {
        echo 'Error: No se proporcionó un nuevo token';
    }
} else {
    echo 'Error: Acceso no válido';
}
