<link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
<script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="../assets/css/styles.css">
<?php

// controla el inicio de sesión

// se verifica que existan datos en el formulario
try {
    require_once '../modulos/clases/usuarios.php';
    session_start();
    $usuario = new usuarios();
    if (isset($_SESSION['acceso']) && $_SESSION['acceso'] == true && isset($_SESSION['usuario']) && $_SESSION['usuario'] != "") {
        if (
            isset($_POST['nameProduct']) && !empty($_POST['nameProduct'] &&
                isset($_POST['stockProduct'])) && !empty($_POST['stockProduct'])
            && isset($_POST['imageProduct']) && $_POST['imageProduct'] != "0"
            && isset($_POST['userRegister']) && $_POST['userRegister'] != "0"
        ) {
            // se hace el llamado del modelo de conexión y consultas


            // se capturan las variables que vienen desde el formulario

            $nameProduct = $_POST['nameProduct'];
            $stockProduct = $_POST['stockProduct'];
            $imageProduct = ($_POST['imageProduct']);
            $idUser = $_POST['userRegister'];

            // se instancia la clase, es decir, se llama para poder usar sus métodos
            require_once './clases/MYSQL.php';

            $mysql = new MYSQL();


            $mysql->conectar();

            $mysql->efectuarConsulta("INSERT INTO productos.productos VALUES('','$nameProduct',$stockProduct,'$imageProduct',default,$idUser)");


            $mysql->desconectar();

?>
            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="../node_modules/@sweetalert2/theme-bootstrap-4/bootstrap-4.min.css">
                <link rel="stylesheet" href="../assets/css/login-register.css">
                <title>Registro exitoso</title>
            </head>

            <body>

                <script src="../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: "Producto registrado correctamente",
                        timer: 2000,
                        timerProgressBar: true,
                        showConfirmButton: false
                    }).then((result) => {

                        if (result.dismiss === Swal.DismissReason.timer) {
                            open("../modulos/registrarProducto.php", "_self");
                        }
                    });
                    window.addEventListener("click", () => {
                        open("../modulos/registrarProducto.php", "_self");
                    });
                </script>
            </body>

            </html>
        <?php
        } else {
        ?>
            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="../node_modules/@sweetalert2/theme-bootstrap-4/bootstrap-4.min.css">
                <link rel="stylesheet" href="../assets/css/login-register.css">
                <title>Error</title>
            </head>

            <body>

                <script src="../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: "Verifica si hay campos vacíos",
                        timer: 2000,
                        timerProgressBar: true,
                        showConfirmButton: false
                    }).then((result) => {

                        if (result.dismiss === Swal.DismissReason.timer) {
                            open("../modulos/registrarProducto.php", "_self");
                        }
                    });
                    window.addEventListener("click", () => {
                        open("../modulos/registrarProducto.php", "_self");
                    });
                </script>
            </body>

            </html>
    <?php
        }
    }
} catch (Exception $ex) {
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../node_modules/@sweetalert2/theme-bootstrap-4/bootstrap-4.min.css">
        <link rel="stylesheet" href="../assets/css/login-register.css">
        <title>Error</title>
    </head>

    <body>

        <script src="../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
        <script>
            Swal.fire({
                icon: 'Upps',
                title: "Algo ocurrió(Error interno)...",
                timer: 2000,
                timerProgressBar: true,
                showConfirmButton: false
            }).then((result) => {

                if (result.dismiss === Swal.DismissReason.timer) {
                    open("../modulos/registrarProducto.php", "_self");
                }
            });
            window.addEventListener("click", () => {
                open("../modulos/registrarProducto.php", "_self");
            });
        </script>
    </body>

    </html>
<?php
}
