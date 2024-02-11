<link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
<script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="../assets/css/styles.css">
<?php
function loadSuccess(){
    ?>
    <!DOCTYPE html>
                <html lang="en">
    
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <link rel="stylesheet" href="../node_modules/@sweetalert2/theme-bootstrap-4/bootstrap-4.min.css">
                    <link rel="stylesheet" href="../assets/css/login-register.css">
                    <title>Edición exitosa</title>
                </head>
    
                <body>
    
                    <script src="../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: "Producto editado correctamente",
                            timer: 2000,
                            timerProgressBar: true,
                            showConfirmButton: false
                        }).then((result) => {
    
                            if (result.dismiss === Swal.DismissReason.timer) {
                                open("../modulos/dashboard.php?datos=productos", "_self");
                            }
                        });
                        window.addEventListener("click", () => {
                            open("../modulos/dashboard.php?datos=productos", "_self");
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
                                open("../modulos/dashboard.php?datos=productos", "_self");
                            }
                        });
                        window.addEventListener("click", () => {
                            open("../modulos/dashboard.php?datos=productos", "_self");
                        });
                    </script>
                </body>
    
                </html>
            
            <?php 
            }
// controla el inicio de sesión

// se verifica que existan datos en el formulario
try {
    require_once '../modulos/clases/usuarios.php';
    require_once './clases/MYSQL.php';
    session_start();
    $usuario = new usuarios();
    $mysql = new MYSQL();
    $mysql->conectar();
    if (isset($_SESSION['acceso']) && $_SESSION['acceso'] == true && isset($_SESSION['usuario']) && $_SESSION['usuario'] != "") {
        if (
            isset($_POST['nameProduct']) && !empty($_POST['nameProduct'] &&
                isset($_POST['stockProduct'])) && !empty($_POST['stockProduct'])
        ) {
            // se hace el llamado del modelo de conexión y consultas


            // se capturan las variables que vienen desde el formulario



            // se instancia la clase, es decir, se llama para poder usar sus métodos

            $root = '../assets/media/productos/';

            $nameProduct = $_POST['nameProduct'];
            $stockProduct = $_POST['stockProduct'];
            $image = $_FILES['urlImage']['name'];
            $nameUser = $_POST['userRegister'];
            $idUser = mysqli_fetch_array($mysql->efectuarConsulta("SELECT id_usuario FROM productos.usuarios where nombre_usuario = '$nameUser'"))[0][0];
            $idProduct = $_POST['idProduct'];
            $status = $_POST['status'];
            $temp = $_FILES['urlImage']['tmp_name'];
            $rutaCompleta = $root . $image;

            if (mysqli_fetch_array($mysql->efectuarConsulta("SELECT COUNT(*) FROM productos.productos where nombre_producto = '$nameProduct' and id_producto !=$idProduct"))[0][0] == 0){

        
            if (empty($image) && empty($_POST['urlImageOnline'])) {
                $image = $_POST['inputUrlImage'];
           
                $mysql->efectuarConsulta("UPDATE productos.productos set nombre_producto = '$nameProduct',cantidad=$stockProduct,imagen='$image',id_usuario=$idUser, estado = $status where id_producto = $idProduct");
               
                loadSuccess();
            }
           else if (!empty($_POST['urlImageOnline']) && empty($image)){
                echo "aa";
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
                   
                    
                    $mysql->efectuarConsulta("UPDATE productos.productos set nombre_producto = '$nameProduct',cantidad=$stockProduct,imagen='$save_path',id_usuario=$idUser, estado = $status 
                    where id_producto = $idProduct");
                   
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
            else if (!empty($image) && empty($_POST['urlImageOnline'])){
            if (move_uploaded_file($temp, $root . $image)) {
                //Cambiamos los permisos del archivo a 777 para poder modificarlo posteriormente
                chmod($root  . $image, 0777);

                $mysql->efectuarConsulta("UPDATE productos.productos set nombre_producto = '$nameProduct',cantidad=$stockProduct,imagen='$rutaCompleta',id_usuario=$idUser, estado = $status where id_producto = $idProduct");
             
                loadSuccess();
            }
            else{
                loadError("Algo ocurrió al tratar de cargar la imagen localmente...","Error","error"); 
            }
        }
        else{
            if (move_uploaded_file($temp, $root . $image)) {
                //Cambiamos los permisos del archivo a 777 para poder modificarlo posteriormente
             
                chmod($root  . $image, 0777);
  
                $mysql->efectuarConsulta("UPDATE productos.productos set nombre_producto = '$nameProduct',cantidad=$stockProduct,imagen='$rutaCompleta',id_usuario=$idUser, estado = $status where id_producto = $idProduct");
       
                loadSuccess();
            }
            else{
                loadError("Algo ocurrió al tratar de cargar la imagen localmente...","Error","error"); 
            } 
        }
    }
    else{
        loadError("Nombre del producto ya existe, intenta con otro","Editar producto","error");
    }
        } else {
          
            loadError("Verifica si hay campos vacíos","Error","error");
        }
    } else {
        header("Location: ../index.php");
    }
} catch (Exception $ex) {
   loadError("Algo ocurrió(Error interno)...","Error","error");
}
$mysql->desconectar();