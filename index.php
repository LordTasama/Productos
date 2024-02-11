

<!DOCTYPE html>


<link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css">

<link rel="stylesheet" href="./assets/css/login-register.css">
<script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>


<section class="container">
    <div class="login-container">
        <div class="circle circle-one"></div>
        <div class="form-container">
            <img src="https://raw.githubusercontent.com/hicodersofficial/glassmorphism-login-form/master/assets/illustration.png" alt="illustration" class="illustration" />
            <h1 class="opacity">Iniciar sesión</h1>
            <form action="./modulos/login.php" method="post">
                <input type="text" placeholder="Usuario" name="nameUser" />
                <input type="password" placeholder="Contraseña" name="passwordUser" />
                <button type="submit" class="opacity">Iniciar Sesión</button>
            </form>
            <div class="login-forget opacity">
                <a href="./modulos/registrarse.php">Registrarse</a>
                <a href="">¿Olvidaste la contraseña?
                    
                </a>
            </div>
        </div>
        <div class="circle circle-two"></div>
    </div>
    <div class="theme-btn-container"></div>
</section>