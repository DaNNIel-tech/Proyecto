<?php
// Configuración de la conexión a la base de datos
$host = 'localhost';
$usuario = 'root'; // Cambia según tu configuración
$contraseña = '';  // Cambia según tu configuración
$base_datos = 'formulario_contacto';

// Conectar a la base de datos
$conexion = new mysqli($host, $usuario, $contraseña, $base_datos);

// Verificar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Recibir los datos del formulario
$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$telefono = $_POST['telefono'];
$mensaje = $_POST['mensaje'];

// Validar que los datos no estén vacíos
if (empty($nombre) || empty($correo) || empty($telefono) || empty($mensaje)) {
    die("Por favor, completa todos los campos.");
}

// Insertar los datos en la tabla
$sql = "INSERT INTO contactos (nombre, correo, telefono, mensaje) VALUES (?, ?, ?, ?)";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("ssss", $nombre, $correo, $telefono, $mensaje);

if ($stmt->execute()) {
    echo "¡Gracias! Tu mensaje ha sido enviado con éxito.";
} else {
    echo "Error al enviar tu mensaje: " . $conexion->error;
}

// Cerrar la conexión
$stmt->close();
$conexion->close();
?>
