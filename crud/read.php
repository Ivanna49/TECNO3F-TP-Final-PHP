<?php
require '../config/database.php';
session_start(); 

$stmt = $conn->prepare("SELECT * FROM pokemons");
$stmt->execute();
$pokemons = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Pokémon</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <div class="container">
        <h1>Lista de Pokemones</h1>
        <ul>
            <?php foreach ($pokemons as $pokemon): ?>
                <li>
                    ID: <?php echo $pokemon['id']; ?> - 
                    Nombre: <?php echo $pokemon['name']; ?> - 
                    Tipo: <?php echo $pokemon['type']; ?>
                    <button class="btn" onclick="window.location.href='update.php?id=<?php echo $pokemon['id']; ?>'">Actualizar</button>
                    <button class="btn" onclick="window.location.href='delete.php?id=<?php echo $pokemon['id']; ?>'">Eliminar</button>
                </li>
            <?php endforeach; ?>
        </ul>
        <br>
        <button class="btn" onclick="window.location.href='../crud/create.php'">Crear Nuevo Pokémon</button>
        <button class="btn" onclick="window.location.href='../index.php'">Logout</button>
 
    </div>
</body>
</html>
