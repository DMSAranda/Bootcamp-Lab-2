<?php
require_once('./service/conexionDB.php');
require_once('./class/mySqlUsuarioRepository.php');
require_once('./class/usuario.php');

$conexionDB = new ConexionDB();
$usuarioRepository = new MySQLUsuarioRepository($conexionDB);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['agregar'])) {
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];

        // Crear un objeto de usuario
        $usuario = new Usuario($nombre, $email, $conexionDB);

        // Insertar el objeto de usuario en la base de datos
        if ($usuarioRepository->agregarUsuario($usuario->getNombre(), $email->getEmail())) {
            echo "Usuario agregado correctamente.";
        } else {
            echo "Error al agregar el usuario.";
        }
    }
}

$usuarios = $usuarioRepository->obtenerUsuarios();
$conexionDB->cerrarConexion();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Administrador de Usuarios</title>
</head>
<body>
    <h1>Administrador de Usuarios</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <!-- <th>Acciones</th> -->
        </tr>
        <?php foreach ($usuarios as $user) { ?>
            <tr>
                <td><?php echo $user['id']; ?></td>
                <td><?php echo $user['nombre']; ?></td>
                <td><?php echo $user['email']; ?></td>
            </tr>
        <?php } ?>
    </table>

    <h2>Agregar Usuario</h2>
    <form method="post" action="index.php">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br>

        <input type="submit" name="agregar" value="Agregar Usuario">
    </form>
</body>
</html>