<?php
    //session_start();
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        //Desactivar las noticias y mostrar los errores
         error_reporting(E_ALL ^ E_NOTICE);
   
         //1.- Conectarse a la BD
         include_once("db.php");
         
         //2.- Traer los datos del formulario
         $usuario=$_POST['usuario'];
         $pass=$_POST['pass'];
      
        $sql="INSERT INTO usuarios (username, password, privilegio) VALUES ('$usuario', '$pass', 'cliente');";
      
         //4.- Ejecutar la consulta
      
         $ejecutar_sql=$conexion->query($sql);
    
         if ($ejecutar_sql)
         {
           echo " <script>   
                      alert('... Usuario Agregado Correctamente ... ');
                   </script>";
         }
         else
         {
           echo " <script>   
                    alert('... ERROR No fue posible agregar... ');
                    </script>";
           $entrar="noinsertar";
         }
    }
   

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Inicio|PHP Proyecto UTD
    </title>
    <link rel="stylesheet" href="../css/estilos.css" type="text/css">
</head>
<body>
    <header>
        <div id="logotipo">
            <img src="../img/logophp.png" alt="Imagen Django" title="Django">
            <h1>PHP Proyecto Web</h1>
        </div>
    </header>
    <nav>
        <ul>
            <li><a href="../index.php" >Inicio</a></li>
            <li><a href="session.php">Iniciar sesión</a></li>
            <li><a href="register.php">Registrarse</a></li>
        </ul>
    </nav>
    <section id="content">
       <div class="box">
            <h1>Registrarse</h1>
            <hr>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label for="usuario">Usuario:</label>
                <input type="text" id="usuario" name="usuario" required><br><br>

                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required><br><br>

                <button type="submit">Registrarse</button>
            </form>
       </div>
    </section>
    <footer>
    <p>PHP con Nash &copy; 2024 | Visitado el: <?php echo date("d/m/y"); ?></p>
    </footer>
</body>
</html>