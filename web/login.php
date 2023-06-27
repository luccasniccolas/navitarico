<?php
session_start();
error_reporting(0);
require_once('database.php');
if(isset($_POST['Iniciar'])) {
$mail = $_POST['email'];
$contrasena = $_POST['password'];

$conn = new conexion;
$consulta = "SELECT * FROM usuario WHERE mail = '$mail' and contraseña = '$contrasena'";
$result = mysqli_query($conn->conectardb(), $consulta);

if($result->num_rows > 0) {
    $datosUsuarios = array();

        // Recorrer los resultados de la consulta y guardar los datos en la variable
        while ($row = mysqli_fetch_assoc($result)) {
            $datosUsuarios[] = $row['id'];
            $datosUsuarios[] = $row['nombre'];
            $datosUsuarios[] = $row['apellido'];
            $datosUsuarios[] = $row['mail'];
            $datosUsuarios[] = $row['contrasena'];
        }
    $_SESSION['datosUsuario'] = $datosUsuarios;
    header("location:index.php");
    exit();
    
} else {
$mensaje.="<h5 class='registrado'>Por favor, verifica si los datos son correctos.</h5>";
}
    
} 



?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro de Usuario</title>
  <link rel="stylesheet" href="./css/bootstrap.min.css" />
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 500px;
      margin: 0 auto;
      padding: 20px;
    }

    .form-group {
      margin-bottom: 15px;
    }

    .form-group label {
      display: block;
      margin-bottom: 5px;
    }

    .form-group input[type="text"],
    .form-group input[type="email"],
    .form-group input[type="password"] {
      width: 100%;
      padding: 8px;
      border-radius: 5px;
      border: 1px solid #ccc;
    }

    .form-group input[type="submit"] {
      background-color: #4CAF50;
      color: white;
      border: none;
      padding: 10px 20px;
      cursor: pointer;
      border-radius: 5px;
    }
    .registrado{
        text-align: center;
    }
  </style>
</head>
<body>
<header class="pb-3 mb-4 border-bottom sticky-top">
<nav class="navbar navbar-expand-lg navbar-dark bg-primary justify-content-center">
        <ul class="nav navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="nosotros.php">Nosotros</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="nosotros.php">Contáctanos</a>
            </li>
        </ul>
    </nav>
    </header>
  <div class="container">
    <h2>Iniciar sesión</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
      
      
      <div class="form-group">
        <label for="email">Correo Electrónico:</label>
        <input type="email" id="email" name="email" required>
      </div>
      <div class="form-group">
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>
      </div>
      <div class="form-group">
        <input type="submit" name="Iniciar" value="Iniciar sesión">
      </div>
    </form>
  </div>
  <?php echo $mensaje; ?>
</body>
</html>
