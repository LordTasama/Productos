<link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
<script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="../assets/css/styles.css">
<?php
require_once '../modulos/clases/usuarios.php';
session_start();
$usuario = new usuarios();
if (isset($_SESSION['acceso']) && $_SESSION['acceso'] == true && isset($_SESSION['usuario']) && $_SESSION['usuario'] != "") {
    require_once '../index.php';
    session_start();


    $_SESSION['usuario'] = "";
    $_SESSION['acceso'] = false;

    header("Location: cerrarsesionDisplay.php");
} else {
    header("Location: ../index.php");
}
