<?php
session_start();

// Datos de usuarios
$usuario_encargado = [
    'encargadoD2@encar.com' => 'encarD2',
    'encargadoD1@encar.com' => 'encarD1'
];

$usuario_administrador = ['administrador@admin.com' => 'admin123'];

// Obtener datos del formulario
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

// Validar las credenciales
if (isset($usuario_encargado[$email]) && $usuario_encargado[$email] === $password) {
    // Redirigir a la página de encargado
    header('Location: new np2/paginaform.html');
    exit;
} elseif (isset($usuario_administrador[$email]) && $usuario_administrador[$email] === $password) {
    // Redirigir a la página de administrador
    header('Location: proyectoartur/tablas.html');
    exit;
} else {
    // Credenciales incorrectas
    echo '<script>alert("Usuario o contraseña incorrecto"); window.location.href = "login.html";</script>';
}
?>