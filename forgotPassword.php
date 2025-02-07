<?php
session_start();
$sessData = !empty($_SESSION['sessData']) ? $_SESSION['sessData'] : '';//Aquí, se comprueba si la variable $_SESSION['sessData'] está definida y no está vacía. Si es así, se asigna su valor a la variable $sessData. Si no está definida o está vacía, se asigna un string vacío ('') a $sessData.
if (!empty($sessData['status']['msg'])) {//Esta línea verifica si el mensaje de estado (msg) dentro de status en $sessData no está vacío
    $statusMsg = $sessData['status']['msg'];//  Se asigna el valor del mensaje de estado a la variable $statusMsg
    $statusMsgType = $sessData['status']['type'];//También se asigna el tipo de mensaje (como "éxito" o "error") a la variable $statusMsgType
    unset($_SESSION['sessData']['status']);//Aquí se elimina el mensaje de estado de la sesión ($_SESSION['sessData']['status']) para que no se vuelva a mostrar cuando se recargue la página o se navegue por ella.
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
    <link rel="stylesheet" href="./forgotPassword.css">
</head>
<body>
    <div class="container">
        <h2>Recupera tu Contraseña</h2>
        <?php echo !empty($statusMsg) ? '<p class="' . $statusMsgType . '">' . $statusMsg . '</p>' : ''; ?>
        <div class="form-container">
            <form action="ForgotPassword.php" method="POST">
                <label for="correo">Correo Electrónico</label>
                <input type="email" id="correo" name="correo" placeholder="Ingresa tu correo electrónico" required>
                <button type="submit" name="forgotSubmit">Continuar</button>
            </form>
        </div>
    </div>

    <?php
   // Se verifica si el formulario con el nombre forgotSubmit ha sido enviado mediante el método POST
    if (isset($_POST['forgotSubmit'])) {
        if (!empty($_POST['correo'])) {//Se comprueba si el campo correo en el formulario no está vacío
            $correo = $_POST['correo'];

            // Conectar a la base de datos
            $db = new mysqli('localhost', 'root', '', 'login_register_db');
            if ($db->connect_error) {
                die("Conexión fallida: " . $db->connect_error);
            }

            // Verificar si el correo existe
            $query = $db->prepare("SELECT id FROM usuarios WHERE correo = ?");
            $query->bind_param("s", $correo);// El bind_param("s", $correo) asegura que el correo se pase de forma segura (como string)
            $query->execute();
            $query->store_result();

            if ($query->num_rows > 0) {
                // Si el correo existe, redirigir a resetPassword.php
                header("Location: resetPassword.php?correo=" . urlencode($correo));
                exit;
            } else {
                $_SESSION['sessData']['status']['type'] = 'error';
                $_SESSION['sessData']['status']['msg'] = 'El correo electrónico no está registrado.';
                header("Location: ForgotPassword.php");
                exit;
            }
        } else {
            $_SESSION['sessData']['status']['type'] = 'error';
            $_SESSION['sessData']['status']['msg'] = 'Por favor, ingresa tu correo electrónico.';
            header("Location: ForgotPassword.php");
            exit;
        }
    }
    ?>
</body>
</html>