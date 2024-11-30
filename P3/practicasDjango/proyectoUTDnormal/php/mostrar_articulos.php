<?php
session_start();
if (isset($_SESSION['user'])) {
    // Si el usuario está autenticado, continuamos.
} else {
    header("Location: ../index.php");
    exit();
}

include_once('db.php'); // Conexión a la base de datos

// Procesar el formulario para agregar un nuevo artículo
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['descripcion'], $_POST['pu'], $_POST['cantidad'], $_POST['categoria'])) {
    $descripcion = $_POST['descripcion'];
    $pu = $_POST['pu'];
    $cantidad = $_POST['cantidad'];
    $categoria = $_POST['categoria'];

    // Procesar imagen (si se sube)
    $imagen = null;
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        $imagen = file_get_contents($_FILES['imagen']['tmp_name']);
    }

    // Insertar el artículo en la base de datos
    $sql = "INSERT INTO articulos (descripcion, pu, cantidad, id_categoria, img) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sdiss", $descripcion, $pu, $cantidad, $categoria, $imagen);
    $stmt->execute();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio|PHP Proyecto UTD</title>
    <link rel="stylesheet" href="../css/estilos.css" type="text/css">
    <script>
        // Función para mostrar el formulario
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
            <li><a href="mision.php">Mision</a></li>
            <li><a href="vision.php">Vision</a></li>
            <li><a href="acercade.php">Acerca de</a></li>
            <li><a href="mostrar_articulos.php">Articulos</a></li>
            <li><a href="mostrar_categorias.php">Categorias</a></li>
            <li><a href="logout.php">Cerrar sesión</a></li>
        </ul>
    </nav>
    
    <section id="content">
        <div class="box">
            <h1>Mostrar artículos</h1>

            <!-- Mostrar los artículos registrados -->
            <?php
            // Consulta SQL para obtener los artículos junto con las imágenes
            $sql = "SELECT 
                        articulos.id, 
                        articulos.descripcion AS articulo, 
                        articulos.pu, 
                        articulos.cantidad, 
                        categorias.descripcion AS categoria,
                        articulos.img AS imagen
                    FROM articulos
                    INNER JOIN categorias 
                    ON articulos.id_categoria = categorias.id";
            $ejecucion_sql = $conexion->query($sql);

            if ($ejecucion_sql->num_rows > 0) {
                echo '<table border="1">';
                echo '<tr>
                        <th>ID</th>
                        <th>Descripción</th>
                        <th>Precio Unitario</th>
                        <th>Cantidad</th>
                        <th>Categoría</th>
                        <th>Imagen</th>
                    </tr>';
                
                while ($fila = $ejecucion_sql->fetch_assoc()) {
                    echo '<tr>
                            <td>' . htmlspecialchars($fila['id']) . '</td>
                            <td>' . htmlspecialchars($fila['articulo']) . '</td>
                            <td>' . htmlspecialchars($fila['pu']) . '</td>
                            <td>' . htmlspecialchars($fila['cantidad']) . '</td>
                            <td>' . htmlspecialchars($fila['categoria']) . '</td>';
                    
                    if (!empty($fila['imagen'])) {
                        $imagen_base64 = base64_encode($fila['imagen']);
                        echo '<td><img src="data:image/jpeg;base64,' . $imagen_base64 . '" width="100" height="100" alt="Imagen del Artículo"></td>';
                    } else {
                        echo '<td>No hay imagen disponible</td>';
                    }
                    
                    echo '</tr>';
                }
                
                echo '</table>';
            } else {
                echo 'No hay datos disponibles.';
            }
            ?>

            <hr><br><br><br>

            <!-- Botón para mostrar el formulario de registro -->
            <button type="button" onclick="mostrarFormulario()">Añadir Nuevo Artículo</button>

            <!-- Formulario para agregar artículos (inicialmente oculto) -->
            <div id="formularioRegistro" style="display: none; margin-top: 20px;">
                <h2>Registrar Nuevo Artículo</h2>
                <form action="mostrar_articulos.php" method="POST" enctype="multipart/form-data">
                    <label for="descripcion">Descripción:</label>
                    <input type="text" id="descripcion" name="descripcion" required><br><br>

                    <label for="pu">Precio Unitario:</label>
                    <input type="number" id="pu" name="pu" step="0.01" required><br><br>

                    <label for="cantidad">Cantidad:</label>
                    <input type="number" id="cantidad" name="cantidad" required><br><br>

                    <label for="categoria">Categoría:</label>
                    <select id="categoria" name="categoria" required>
                        <option value="">Seleccionar categoría</option>
                        <?php
                            // Consulta para obtener las categorías
                            $sql_categoria = "SELECT id, descripcion FROM categorias";
                            $result_categoria = $conexion->query($sql_categoria);
                            while ($categoria = $result_categoria->fetch_assoc()) {
                                echo '<option value="' . $categoria['id'] . '">' . $categoria['descripcion'] . '</option>';
                            }
                        ?>
                    </select><br><br>

                    <label for="imagen">Imagen:</label>
                    <input type="file" id="imagen" name="imagen" accept="image/*"><br><br>

                    <button type="submit">Registrar Artículo</button>
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
