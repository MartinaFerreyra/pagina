<?php
session_start(); // Inicia la sesión para manejar mensajes de estado

// Verifica si hay un mensaje de estado almacenado en la sesión
$sessData = !empty($_SESSION['sessData']) ? $_SESSION['sessData'] : '';
if (!empty($sessData['status']['msg'])) {
    $statusMsg = $sessData['status']['msg'];
    $statusMsgType = $sessData['status']['type'];
    unset($_SESSION['sessData']['status']); // Borra el mensaje de la sesión para evitar que se repita

}

// Si no se recibe el correo en la URL, redirigir a ForgotPassword.php
if (isset($_POST['correo']) && !empty($_POST['correo'])) {
// isset() verifica si la variable 'correo' en $_POST está definida y no es NULL.
    // empty() verifica que el campo no esté vacío.
    // Si la condición se cumple, significa que el correo fue enviado mediante el método POST.
    $correo = $_POST['correo'];// Se almacena el correo en la variable.
} elseif (isset($_GET['correo']) && !empty($_GET['correo'])) {
    // Si el correo no está en $_POST, se revisa si fue enviado mediante GET.
    $correo = $_GET['correo'];
} else {
    $_SESSION['sessData']['status']['type'] = 'error';
    $_SESSION['sessData']['status']['msg'] = 'Acceso inválido.';
    header("Location: ForgotPassword.php");//redirige 
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer Contraseña</title>
    <link rel="stylesheet" href="./resetPassword.css">
</head>
<body>
    <div class="container">
        <h2>Restablece tu Contraseña</h2>
        <?php echo !empty($statusMsg) ? '<p class="' . $statusMsgType . '">' . $statusMsg . '</p>' : ''; ?>
        <div class="form-container">
            <form action="resetPassword.php" method="post">
                <input type="hidden" name="correo" value="<?php echo htmlspecialchars($correo); ?>">
                <label for="password">Nueva Contraseña</label>
                <input type="password" id="password" name="password" placeholder="Nueva contraseña" required>
                <label for="confirm_password">Confirma tu Contraseña</label>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirma tu contraseña" required>
                <button type="submit" name="resetSubmit">Restablecer Contraseña</button>
            </form>
        </div>
    </div>

    <?php
    // Procesar el cambio de contraseña
    if (isset($_POST['resetSubmit'])) { //Comprueba si el formulario fue enviado mediante el botón con name="resetSubmit"
        if (!empty($_POST['password']) && !empty($_POST['confirm_password'])) {//Asegura que los campos password y confirm_password no estén vacíos.
            //Guarda los valores
            $correo = $_POST['correo'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];

            // Verificar si las contraseñas coinciden
            if ($password === $confirm_password) {
                // Encriptar la contraseña usando SHA-512
                $hashedPassword = hash('sha512', $password);

                // Conectar a la base de datos
                $db = new mysqli('localhost', 'root', '', 'login_register_db');
                if ($db->connect_error) {
                    die("Conexión fallida: " . $db->connect_error);
                }

                // Actualizar la contraseña en la base de datos
                $query = $db->prepare("UPDATE usuarios SET contrasena = ? WHERE correo = ?");
                $query->bind_param("ss", $hashedPassword, $correo);//indica que se están pasando dos cadenas de texto
                 if ($query->execute()) {
                    // Redirigir a form.php (inicio de sesión) después de cambiar la contraseña
                    $_SESSION['sessData']['status']['type'] = 'success';
                    $_SESSION['sessData']['status']['msg'] = 'Contraseña restablecida con éxito.';
                    header("Location: form.php"); // Aquí redirigimos a form.php
                    exit;
                } else {
                    $_SESSION['sessData']['status']['type'] = 'error';
                    $_SESSION['sessData']['status']['msg'] = 'Hubo un problema al actualizar la contraseña.';
                    header("Location: resetPassword.php?correo=" . urlencode($correo));
                    exit;
                }
            } else {
                $_SESSION['sessData']['status']['type'] = 'error';
                $_SESSION['sessData']['status']['msg'] = 'Las contraseñas no coinciden.';
                header("Location: resetPassword.php?correo=" . urlencode($correo));
                exit;
            }
        } else {
            $_SESSION['sessData']['status']['type'] = 'error';
            $_SESSION['sessData']['status']['msg'] = 'Por favor, completa todos los campos.';
            header("Location: resetPassword.php?correo=" . urlencode($correo));
            exit;
        }
    }
    ?>
</body>
</html>
