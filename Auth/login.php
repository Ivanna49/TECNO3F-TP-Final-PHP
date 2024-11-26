<?php
require '../config/database.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header('Location: ../crud/read.php');
        exit;
    } else {
        echo "Nombre de usuario o contraseña incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <div class="container">
        <h1>Iniciar Sesión</h1>
        <form method="POST">
            <label for="username">Usuario</label>
            <input type="text" name="username" id="username" placeholder="Usuario" required>
            <label for="password">Contraseña</label>
            <input type="password" name="password" id="password" placeholder="Contraseña" required>
            <button type="submit" style="background-color: pink; color: white; border: none; padding: 10px 20px;">Iniciar Sesión</button>
        </form>
        <br>
      
        <button class="btn" onclick="window.location.href='../index.php'">Volver al Inicio</button>
    </div>
</body>
</html>

