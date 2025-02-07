<?php

session_start();

include 'conexion_be.php';

// Capturar datos del formulario
$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];
$contrasena = hash('sha512', $contrasena);


$validar_login = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo = '$correo' and contrasena = '$contrasena'");//Se realiza una consulta SQL para verificar si el correo y la contraseña coinciden con algún usuario en la base de datos.

if(mysqli_num_rows($validar_login) > 0){//Si la consulta devuelve resultados (es decir, si el correo y la contraseña coinciden con algún registro),
// se guarda el correo en la variable de sesión $_SESSION['usuario']
$_SESSION['usuario'] = $correo;
header("location: index.php");
exit;
}else{
echo '
<script>
alert("Usuario no existe, porfavor verifique los datos introducidos");
window.location = "form.php";
</script>
';
exit;
}



?>