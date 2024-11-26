<?php
require '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
    $stmt->execute(['username' => $username, 'password' => $password]);

    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <div class="container">
        <h1>Registrarse</h1>
        <form method="POST">
            <label for="username">Usuario</label>
            <input type="text" name="username" id="username" placeholder="Usuario" required>
            <label for="password">Contraseña</label>
            <input type="password" name="password" id="password" placeholder="Contraseña" required>
            <button type="submit" style="background-color: pink; color: white; border: none; padding: 10px 20px;">Registrar</button>
        </form>
        <br>
        
        <button class="btn" onclick="window.location.href='../index.php'">Volver al Inicio</button>
    </div>
</body>
</html>

