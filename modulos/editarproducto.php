<link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
<script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="../assets/css/styles.css">
<?php
require_once '../modulos/clases/usuarios.php';
session_start();
$usuario = new usuarios();
if (isset($_SESSION['acceso']) && $_SESSION['acceso'] == true && isset($_SESSION['usuario']) && $_SESSION['usuario'] != "") {
    require_once './clases/MYSQL.php';
    $mysql = new MYSQL();
    $mysql->conectar();
    $consulta = $mysql->efectuarConsulta("SELECT id_usuario,nombre_usuario FROM productos.usuarios where usuarios.estado = 1");
    $mysql->desconectar();
?>
    <link rel="stylesheet" href="../assets/css/login-register.css">
    <script src="../assets/js/login-register.js"></script>

    <section class="container">
        <div class="login-container">
            <div class="circle circle-one"></div>
            <div class="form-container">
                <img src="https://raw.githubusercontent.com/hicodersofficial/glassmorphism-login-form/master/assets/illustration.png" alt="illustration" class="illustration" />
                <h1 class="opacity">Editar Producto</h1>
                <form action="../modulos/editarP.php" method="post">
                    <input type="text" placeholder="Nombre" name="nameProduct" />
                    <input type="number" placeholder="Cantidad" name="stockProduct" />
                    <select name="imageProduct">
                        <option value="0">Selecciona una imagen</option>
                        <option value="../assets/media/productos/KIT-CILINDRO.png">Kit cilindro</option>
                        <option value="../assets/media/productos/TURBO.png">Turbo</option>
                        <option value="../assets/media/productos/VALVULA-MOTO.png">Valvula de moto</option>
                        <option value="../assets/media/productos/KIT-ARRASTRE.png">Kit de arrastre</option>
                        <option value="../assets/media/productos/FILTRO.png">Filtro</option>
                        <option value="../assets/media/productos/CARBURADOR.png">Carburador</option>
                        <option value="../assets/media/productos/BUJIA-IRIDIUM.png">Bujia iridium</option>
                        <option value="../assets/media/productos/BOBINA-ALTA.png">Bobina de alta</option>
                        <option value="../assets/media/productos/BARRAS-MOTO.png">Barras de moto</option>
                        <option value="../assets/media/productos/ACELERADOR.png">Acelerador</option>
                    </select>
                    <select name="userRegister">
                        <option value="0">Selecciona un usuario</option>
                        <?php
                        while ($fila = mysqli_fetch_array($consulta)) {

                        ?>
                            <option value="<?php echo $fila[0]; ?>"><?php echo $fila[1]; ?></option>
                        <?php } ?>
                    </select>
                    <button type="submit" class="opacity">Guardar Cambios</button>
                    <input type="text" style="visibility: hidden; width:0px;height:0px;" value="<?php echo $_GET['id'] ?>" name="idProduct">
                </form>

            </div>
            <div class="circle circle-two"></div>
        </div>
        <div class="theme-btn-container"></div>
    </section>

<?php
}
