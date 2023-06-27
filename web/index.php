<?php
session_start();
if(!isset($_SESSION['datosUsuario'])) {
  include("template/cabecera.php"); 
?>

<div class="p-5 mb-4 bg-body-tertiary rounded-3">
      <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold">Plantitas UDP</h1>
        <p class="col-md-8 fs-4">¡Bienvenido/a a plantitas UDP! Somos expertos en el cuidado de plantas a través de sensores implementados en NodeMCU. Con nuestra tecnología, podrás monitorear y cuidar tus plantas desde cualquier lugar. Nuestro sitio web te permitira monitorear a tu planta desde cualquier lugar del mundo. Únete a nuestra comunidad y convierte tu hogar en un oasis verde. ¡Cuida tus plantas, cuida de ti mismo/a y cuida del planeta!</p>
      </div>
    </div>
    <div class="row align-items-md-stretch">
      <div class="col-md-6">
        <div class="h-100 p-5 text-bg-dark rounded-3">
          <h2>Iniciar sesión</h2>
          <p>¡Hola! Si ya tienes una cuenta, puedes iniciar sesión fácilmente. Simplemente presiona el botón Aquí Abajo y comienza a disfrutar de nuestros servicios.</p>
          <a class="btn btn-outline-light" href="login.php">Iniciar sesión</a>
        </div>
      </div>
      <div class="col-md-6">
        <div class="h-100 p-5 bg-body-tertiary border rounded-3">
          <h2>Crear cuenta</h2>
          <p>¡Bienvenido! Si deseas crear una cuenta, simplemente presiona el botón que se encuentra debajo y comencemos juntos.</p>
          <a class="btn btn-outline-secondary" href="registro.php">Crear cuenta</a>
        </div>
      </div>
    </div>

<?php 
include("template/pie.php");
} else {
  require_once('database.php');
  $datosUsuario[] = $_SESSION['datosUsuario'];
  $conn = new conexion;
  $id = $_SESSION['datosUsuario'][0];
  $countsql = "SELECT COUNT(*) AS total_plantas FROM plantas INNER JOIN usuario ON plantas.usuario_id = usuario.id WHERE usuario.id = '$id'";
  $result = mysqli_query($conn->conectardb(), $countsql);
  $total;
  if ($result && $result->num_rows > 0) {
    // Obtener el valor del conteo
    $fila = $result->fetch_assoc();
    $total = $fila['total_plantas'];
}

if($total == 0) {
  ?>
  <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="./css/bootstrap.min.css" />
  <style>
    .crearPlanta {
      display: flex;
  justify-content: center;
  align-items: center
    }
  </style>
</head>
<body>
<div class="container-fluid">
    <div class="row min-vh-100 flex-column flex-md-row">
        <aside class="col-12 col-md-2 p-0 bg-primary flex-shrink-1">
            <nav class="navbar navbar-expand-lg navbar-dark bg-primary flex-md-column flex-row align-items-start py-2">
                <div class="collapse navbar-collapse ">
                    <ul class="flex-md-column flex-row navbar-nav w-100 justify-content-between">
                        <li class="nav-item">
                            <a class="nav-link pl-0 text-nowrap" href="#"><i class="fa fa-bullseye fa-fw"></i> <span class="font-weight-bold"><?php echo $_SESSION['datosUsuario'][1]; ?></span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-0" href="#"><i class="fa fa-book fa-fw"></i> <span class="d-none d-md-inline">Link</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-0" href="#"><i class="fa fa-cog fa-fw"></i> <span class="d-none d-md-inline">Link</span></a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link pl-0" href="cerrar_sesion.php"><i class="fa fa-star codeply fa-fw"></i> <span class="d-none d-md-inline">Cerrar sesión</span></a>
                        </li>
                    </ul>
                </div>
            </nav>
        </aside>
        <main class="col bg-faded py-3 flex-grow-1">
            <h2>!!!WOW NO TIENES PLANTAS AGREGADAS!!! </h2>
            <p>
            No tienes plantas en tu colección en este momento. ¡Pero no te preocupes, puedes agregar una planta fácilmente! Agregar plantas a tu colección te cuidar disfrutar de estas desde que cualquier parte del mundo.
¿Te gustaría comenzar tu colección de plantas? Simplemente presiona el botón de abajo para agregar tu primera planta.
            </p> 
            
            <button type="button" class="btn btn-success crearPlanta">Agregar planta</button>


        </main>
    </div>
</div>
</body>
</html>
<?php 
} else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="./css/bootstrap.min.css" />
</head>
<body>
<div class="container-fluid">
    <div class="row min-vh-100 flex-column flex-md-row">
        <aside class="col-12 col-md-2 p-0 bg-primary flex-shrink-1">
            <nav class="navbar navbar-expand-lg navbar-dark bg-primary flex-md-column flex-row align-items-start py-2">
                <div class="collapse navbar-collapse ">
                    <ul class="flex-md-column flex-row navbar-nav w-100 justify-content-between">
                        <li class="nav-item">
                            <a class="nav-link pl-0 text-nowrap" href="#"><i class="fa fa-bullseye fa-fw"></i> <span class="font-weight-bold"><?php echo $_SESSION['datosUsuario'][1]; ?></span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-0" href="#"><i class="fa fa-book fa-fw"></i> <span class="d-none d-md-inline">Link</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-0" href="#"><i class="fa fa-cog fa-fw"></i> <span class="d-none d-md-inline">Link</span></a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link pl-0" href="cerrar_sesion.php"><i class="fa fa-star codeply fa-fw"></i> <span class="d-none d-md-inline">Cerrar sesión</span></a>
                        </li>
                    </ul>
                </div>
            </nav>
        </aside>
        <main class="col bg-faded py-3 flex-grow-1">
            <h2>si tienes plantas</h2>
            <p>
                This is a Bootstrap 4 example layout that includes a Sidebar menu. On larger screen widths, the Sidebar is on the 
                left side and consumes the entire page height. It's vertically positioned down the screen. On smaller screen widths (like mobile phones and tablets), the Sidebar
                moves to the top of the page, and becomes horizontally positioned across the page like a Navbar. Only icons are shown
                on mobile to limit use of screen real estate.
            </p> 
            <p>
                This Sidebar works using only Bootstrap CSS classes and doesn't require JavaScript. It utilizes the responsive Navbar classes
                to auto-magically switch the Sidebar orientation.
            </p> 
        </main>
    </div>
</div>
</body>
</html>
<?php 
}
}
?>

 




       