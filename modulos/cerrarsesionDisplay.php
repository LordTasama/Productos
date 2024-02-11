<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/login-register.css">
    <script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <title>Cerrar sesión</title>
</head>

<body style="background-color: #1a1a2e;">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Cerrar sesión',
            text: 'Sesión cerrada'

        }).then(() => {
            location.href = "../index.php"
        });
        setTimeout(function() {
            location.href = "../index.php"
        }, 2000);
    </script>
</body>

</html>