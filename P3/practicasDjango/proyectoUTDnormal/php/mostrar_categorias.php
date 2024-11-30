<?php
session_start();
if (isset($_SESSION['user'])) {
    // Si el usuario está autenticado, continuamos.
} else {
    header("Location: ../index.php");
    exit();
}

include_once('db.php'); // Conexión a la base de datos

// Procesar el formulario para agregar una nueva categoría
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['descripcion'])) {
    $descripcion = $_POST['descripcion'];

    // Insertar la nueva categoría en la base de datos
    $sql = "INSERT INTO categorias (descripcion) VALUES (?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $descripcion);
    $stmt->execute();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio | PHP Proyecto UTD</title>
    <link rel="stylesheet" href="../css/estilos.css" type="text/css">
    <script>
        // Función para mostrar el formulario de registro
        function mostrarFormulario() {
            document.getElementById("formularioRegistro").style.display = 'block';
        }

        // Función para cerrar el formulario
        function cerrarFormulario() {
            document.getElementById("formularioRegistro").style.display = 'none';
        }
    </script>
</head>
<body>
    <header>
        <div id="logotipo">
            <img src="../img/logophp.png" alt="Imagen PHP" title="PHP Proyecto">
            <h1>PHP Proyecto Web</h1>
        </div>
    </header>
    <nav>
        <ul>
            <li><a href="../index.php">Inicio</a></li>
            <li><a href="mision.php">Misión</a></li>
            <li><a href="vision.php">Visión</a></li>
            <li><a href="acercade.php">Acerca de</a></li>
            <li><a href="mostrar_articulos.php">Artículos</a></li>
            <li><a href="mostrar_categorias.php">Categorías</a></li>
            <li><a href="logout.php">Cerrar sesión</a></li>
        </ul>
    </nav>
    
    <section id="content">
        <div class="box">
            <h1>Mostrar Categorías</h1>

            <!-- Mostrar las categorías registradas -->
            <?php
            // Consulta SQL para obtener las categorías
            $sql = "SELECT id, descripcion FROM categorias";
            $ejecucion_sql = $conexion->query($sql);

            if ($ejecucion_sql->num_rows > 0) {
                echo '<table border="1">';
                echo '<tr>
                        <th>ID</th>
                        <th>Descripción</th>
                    </tr>';
                
                while ($fila = $ejecucion_sql->fetch_assoc()) {
                    echo '<tr>
                            <td>' . htmlspecialchars($fila['id']) . '</td>
                            <td>' . htmlspecialchars($fila['descripcion']) . '</td>
                        </tr>';
                }
                
                echo '</table>';
            } else {
                echo 'No hay categorías disponibles.';
            }
            ?>

            <hr><br><br><br>

            <!-- Botón para mostrar el formulario de registro -->
            <button type="button" onclick="mostrarFormulario()">Añadir Nueva Categoría</button>

            <!-- Formulario para agregar nueva categoría (inicialmente oculto) -->
            <div id="formularioRegistro" style="display: none; margin-top: 20px;">
                <h2>Registrar Nueva Categoría</h2>
                <form action="mostrar_categorias.php" method="POST">
                    <label for="descripcion">Descripción:</label>
                    <input type="text" id="descripcion" name="descripcion" required><br><br>
                    
                    <button type="submit">Registrar Categoría</button>
                    <button type="button" onclick="cerrarFormulario()">Cerrar Formulario</button>
                </form>
            </div>
        </div>
    </section>

    <footer>
        <p>PHP con Nash0 &copy; 2024 | Visitado el: <?php echo date("d/m/y"); ?></p>
    </footer>
</body>
</html>
