<?php

// controla el inicio de sesión

// se verifica que existan datos en el formulario
try {

    if (isset($_POST['nameUser']) && !empty($_POST['nameUser'] &&
        isset($_POST['passwordUser'])) && !empty($_POST['passwordUser']) && isset($_POST['emailUser']) && !empty($_POST['emailUser'])) {
        // se hace el llamado del modelo de conexión y consultas



        // se capturan las variables que vienen desde el formulario

        $correo = $_POST['emailUser'];
        $user = $_POST['nameUser'];
        $pass = $_POST['passwordUser'];
        $pass = str_replace(" ","",$pass);
        $pass = md5($pass);
        

        // se instancia la clase, es decir, se llama para poder usar sus métodos
        require_once './clases/MYSQL.php';

        $mysql = new MYSQL();


        $mysql->conectar();

        $usuariosMaximos = $mysql->efectuarConsulta("SELECT count(*) FROM productos.usuarios where UPPER(usuarios.correo) = UPPER('$correo')");
        $usuariosMaximos = mysqli_fetch_assoc($usuariosMaximos);
        $usuarioRepetido = $mysql->efectuarConsulta("SELECT count(*) FROM productos.usuarios where UPPER(usuarios.nombre_usuario) = UPPER('$user')");
        $usuarioRepetido = mysqli_fetch_assoc($usuarioRepetido);


        if (implode($usuarioRepetido) > 0) {
?>
            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="../node_modules/@sweetalert2/theme-bootstrap-4/bootstrap-4.min.css">
                <link rel="stylesheet" href="../assets/css/login-register.css">
                <title>Usuario ya existe</title>
            </head>

            <body>

                <script src="../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: "Usuario ya existe, intenta con otro",
                        timer: 2000,
                        timerProgressBar: true,
                        showConfirmButton: false
                    }).then((result) => {

                        if (result.dismiss === Swal.DismissReason.timer) {
                            open("../modulos/registrarse.php", "_self");
                        }
                    });
                    window.addEventListener("click", () => {
                        open("../modulos/registrarse.php", "_self");
                    });
                </script>
            </body>

            </html>
            <?php
        } else {

            if (implode($usuariosMaximos) >= 2) {
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
                            title: "El correo <?php echo $correo ?> ya tiene 2 usuarios asociados",
                            timer: 2000,
                            timerProgressBar: true,
                            showConfirmButton: false
                        }).then((result) => {

                            if (result.dismiss === Swal.DismissReason.timer) {
                                open("../modulos/registrarse.php", "_self");
                            }
                        });
                        window.addEventListener("click", () => {
                            open("../modulos/registrarse.php", "_self");
                        });
                    </script>
                </body>

                </html>
            <?php
            } else if (implode($usuariosMaximos) < 2) {
                $mysql->efectuarConsulta("INSERT INTO productos.usuarios VALUES('','$user','$correo','$pass',default)");
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
                            title: "Datos registrados correctamente",
                            timer: 2000,
                            timerProgressBar: true,
                            showConfirmButton: false
                        }).then((result) => {

                            if (result.dismiss === Swal.DismissReason.timer) {
                                open("../modulos/registrarse.php", "_self");
                            }
                        });
                        window.addEventListener("click", () => {
                            open("../modulos/registrarse.php", "_self");
                        });
                    </script>
                </body>

                </html>
        <?php
            }
        }
        $mysql->desconectar();
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
                        open("../modulos/registrarse.php", "_self");
                    }
                });
                window.addEventListener("click", () => {
                    open("../modulos/registrarse.php", "_self");
                });
            </script>
        </body>

        </html>
    <?php
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
                    open("../modulos/registrarse.php", "_self");
                }
            });
            window.addEventListener("click", () => {
                open("../modulos/registrarse.php", "_self");
            });
        </script>
    </body>

    </html>
<?php
}
