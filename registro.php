<?php

    include 'conexion_db.php';

$errores = [];
$nombres = trim($_POST['Nombres']);
$apellidos = trim($_POST['Apellidos']);
$telefono = trim($_POST['Telefono']);
$fecha_na = trim($_POST['Fecha_na']);
$usuario = trim($_POST['Usuario']);
$contraseña = trim($_POST['Contraseña']);

if (empty($nombres)) {
    $errores[] = "El campo Nombres es obligatorio.";
}
if (empty($apellidos)) {
    $errores[] = "El campo Apellidos es obligatorio.";
}
if (empty($telefono)) {
    $errores[] = "El campo Teléfono es obligatorio";
}
if (empty($fecha_na)) {
    $errores[] = "El campo Fecha de Nacimiento es obligatorio.";
}
if (empty($usuario)) {
    $errores[] = "El campo Usuario es obligatorio.";
}
if (empty($contraseña)) {
    $errores[] = "El campo Contraseña es obligatorio.";
}

if (empty($errores)) {

    $sql = "INSERT INTO registro (nombres, apellidos, telefono, fecha_na, usuario, contraseña) 
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conexion->prepare($sql);

    if ($stmt) {
        
        $stmt->bind_param("ssssss", $nombres, $apellidos, $telefono, $fecha_na, $usuario, $contraseña);

        if ($stmt->execute()) {
            echo '
            <script>
            alert("¡¡Registro exitoso!!");
            window.location = "../registro.html";
            </script>
            ';
            exit;
        } else {
            echo '
            <script>
            alert("Registro fallido, por favor verifique sus datos");
            window.location = "../registro.html";
            </script>
            ';
            exit;
            $stmt->error; 
        }

        $stmt->close();
    } else {
        echo "Error al preparar la consulta: " . $conexion->error;
    }
} else {
    foreach ($errores as $error) {
        echo "<p style='color:red;'>$error</p>";
    }
}

$conexion->close();
?>
