    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <?php

    // Funciones

    function loadSuccess(){
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
                }
            



    function loadError($message,$titleDocument,$icon){
        
        ?>
        <!DOCTYPE html>
                    <html lang="en">
        
                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <link rel="stylesheet" href="../node_modules/@sweetalert2/theme-bootstrap-4/bootstrap-4.min.css">
                        <link rel="stylesheet" href="../assets/css/login-register.css">
                        <title><?php echo $titleDocument?></title>
                    </head>
        
                    <body>
        
                        <script src="../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
                        <script>
                            Swal.fire({
                                icon: '<?php  echo $icon?>',
                                title: '<?php  echo $message?>',
                                timer: 3500,
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
    // controla el inicio de sesión
    // se verifica que existan datos en el formulario
    try {
        // se instancia la clase, es decir, se llama para poder usar sus métodos
        require_once '../modulos/clases/usuarios.php';
        require_once './clases/MYSQL.php';
        session_start();
        $usuario = new usuarios();
        $mysql = new MYSQL();          
                
        if (isset($_SESSION['acceso']) && $_SESSION['acceso'] == true && isset($_SESSION['usuario']) && $_SESSION['usuario'] != "") {
            if (
                isset($_POST['nameProduct']) && !empty($_POST['nameProduct'] &&
                    isset($_POST['stockProduct'])) && !empty($_POST['stockProduct'])
            ) {
              // se hace el llamado del modelo de conexión y consultas


            // se capturan las variables que vienen desde el formulario
            $root = '../assets/media/productos/';

            $nameProduct = $_POST['nameProduct'];
            $stockProduct = $_POST['stockProduct'];
            $image = $_FILES['urlImage']['name'];

            $idUser = $_SESSION['id'];
          
            $temp = $_FILES['urlImage']['tmp_name'];
            
            $mysql->conectar();
            $consulta = $mysql->efectuarConsulta("SELECT COUNT(*) FROM productos.productos where nombre_producto = '$nameProduct'");
            $mysql->desconectar();
                // Verificar que el nombre del producto no exista

                
                if (mysqli_fetch_array($consulta)[0] == 0){

                if (move_uploaded_file($temp, $root . $image)) {
                    //Cambiamos los permisos del archivo a 777 para poder modificarlo posteriormente
            
                    chmod($root  . $image, 0777);
                    $rutaCompleta = $root . $image;
                    $mysql->conectar();
                    $mysql->efectuarConsulta("INSERT 
                    INTO productos.productos VALUES('','$nameProduct',$stockProduct,' $rutaCompleta',default,$idUser)");
                    $mysql->desconectar();
                    loadSuccess();
                }
                    else{
                        try {
                            $url = $_POST['urlImageOnline']; // URL de la imagen en línea
                            $filename = basename($url); // Obtener el nombre del archivo de la URL
                            $save_path = $root . $filename; // Ruta de destino
                        
                            // Guardar la imagen desde la URL
                            $image_content = file_get_contents($url); // Descargar el contenido de la imagen desde la URL
                            
                            if ($image_content === false) {
                                throw new Exception('Error al obtener el contenido de la imagen desde la URL');
                            }
                        
                            $result = file_put_contents($save_path, $image_content);
                            if ($result === false) {
                                throw new Exception('Error al guardar la imagen en el servidor');
                            }
                            $mysql->conectar();
                            $mysql->efectuarConsulta("INSERT 
                            INTO productos.productos VALUES('','$nameProduct',$stockProduct,'$save_path',default,$idUser)");
                            $mysql->desconectar();
                            loadSuccess();
                        } catch (Exception $ex) {
                            ?>
                            <script>
                                document.body.innerHTML = "";
                            </script>
                        
                            <?php
                         
                            loadError("Formato o URL inválida, debe terminar en (.jpg,.png, etc)","Registro fallido","error");
                        }   
                    }
                } 
                else{
                    loadError("Nombre del producto ya existe, intenta con otro","Registro fallido","error");
                }
            }
            else {
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
        } else {
            header("Location: ../index.php");
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
