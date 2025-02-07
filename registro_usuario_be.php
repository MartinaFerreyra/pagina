<?php
// Incluir conexión a la base de datos
include 'conexion_be.php';
// Capturar datos del formulario
$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];
// Encriptar la contraseña
$contrasena = hash('sha512', $contrasena);

// Verificar que el correo no se repita en la base de datos
$verificar_correo = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo ='$correo'");

// Realiza una consulta SQL para verificar si el correo ingresado ya existe en la base de datos.
if(mysqli_num_rows($verificar_correo) > 0){//verifica si el correo ya está presente en la base de datos.
    echo '<script>
    alert("Este correo ya está registrado, intenta con otro diferente");
    window.location = "form.php"; // Usar la ruta correcta aquí
    </script>';
    exit();
}

// Si no hay error, insertar el nuevo usuario,Si el correo no está registrado, prepara una consulta SQL para insertar el nuevo usuario en la base de datos,
//  incluyendo el nombre, correo y la contraseña encriptada.
$query = "INSERT INTO usuarios(nombre, correo, contrasena) 
          VALUES ('$nombre', '$correo', '$contrasena')";

$ejecutar = mysqli_query($conexion, $query);

if($ejecutar){
    // Redirigir al usuario de vuelta al formulario de registro
    header("Location: form.php");
    exit();
} else {
    echo '<script>
    alert("Error al registrar el usuario. Intenta nuevamente.");
    window.location = "form.php";
    </script>';
}
?>