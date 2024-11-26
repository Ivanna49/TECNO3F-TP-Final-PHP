<?php
require '../config/database.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $type = $_POST['type'];

    $stmt = $conn->prepare("INSERT INTO pokemons (name, type) VALUES (:name, :type)");
    $stmt->execute(['name' => $name, 'type' => $type]);

    header('Location: read.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Pokémon</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <div class="container">
        <h1>Crear Pokémon</h1>
        <form method="POST">
            <label for="name">Nombre</label>
            <input type="text" name="name" id="name" placeholder="Nombre del Pokémon" required>
            <label for="type">Tipo</label>
            <input type="text" name="type" id="type" placeholder="Tipo del Pokémon" required>
            <button type="submit">Crear Pokémon</button>
        </form>
        <br>
        <button class="btn" onclick="window.location.href='../index.php'">Logout</button>
        <button class="btn" onclick="window.location.href='../crud/read.php'">Volver al Inicio</button>
    </div>
</body>
</html>

