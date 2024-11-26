<?php
require '../config/database.php';
session_start(); // Si es necesario para la autenticación

// Verificar si se ha enviado el ID a través de GET
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} elseif (isset($_POST['id'])) {
    $id = $_POST['id'];
} else {
    echo "ID no proporcionado.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Eliminar el Pokémon si se ha enviado el formulario POST
    $stmt = $conn->prepare("DELETE FROM pokemons WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        $message = "Pokémon eliminado exitosamente.";
    } else {
        $message = "Error al eliminar el Pokémon con ID $id.";
    }

}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Pokémon</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <div class="container">
        <h1>Eliminar Pokémon</h1>
        <?php if (isset($message)): ?>
            <p><?php echo $message; ?></p>
        <?php else: ?>
            <form method="POST">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <p>¿Estás seguro de que deseas eliminar el Pokémon con ID <?php echo $id; ?>?</p>
                <button type="submit">Eliminar Pokémon</button>
            </form>
        <?php endif; ?>
        <br>
        <button class="btn" onclick="window.location.href='../index.php'">Logout</button>
        <button class="btn" onclick="window.location.href='../crud/read.php'">Volver</button>
    </div>
</body>
</html>

