<?php
require '../config/database.php';

session_start();

// Obtener el id del Pokémon desde la URL y almacenarlo en la sesión
if (isset($_GET['id'])) {
    $_SESSION['pokemon_id'] = $_GET['id'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_SESSION['pokemon_id'];
    $name = $_POST['name'];
    $type = $_POST['type'];

    $stmt = $conn->prepare("UPDATE pokemons SET name = :name, type = :type WHERE id = :id");
    $stmt->execute(['id' => $id, 'name' => $name, 'type' => $type]);

    header('Location: read.php');
    exit;
}

// Verificar que 'id' esté presente en la sesión
if (isset($_SESSION['pokemon_id'])) {
    $id = $_SESSION['pokemon_id'];
    $stmt = $conn->prepare("SELECT * FROM pokemons WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $pokemon = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    echo "ID no proporcionado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Pokémon</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <div class="container">
        <h1>Actualizar Pokémon</h1>
        <form method="POST">
            <label for="name">Nombre</label>
            <input type="text" name="name" id="name" value="<?php echo $pokemon['name']; ?>" required>
            <label for="type">Tipo</label>
            <input type="text" name="type" id="type" value="<?php echo $pokemon['type']; ?>" required>
            <button type="submit">Actualizar Pokémon</button>
        </form>
        <br>
        <button class="btn" onclick="window.location.href='../index.php'">Logout</button>
        <button class="btn" onclick="window.location.href='../crud/read.php'">Volver</button>
    </div>
</body>
</html>
