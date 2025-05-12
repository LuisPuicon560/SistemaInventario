<?php
if (isset($_SESSION['mensaje'])) {
    echo $_SESSION['mensaje'];
    // Borrar el mensaje de la sesión para que no se muestre nuevamente
    unset($_SESSION['mensaje']);
}
?>
