<?php
session_start();
error_reporting(0);
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
  if(isset($_POST['miBoton'])){
    // Acciones que deseas realizar cuando se presiona el botón
    $plantasql = "INSERT INTO plantas(usuario_id, temperatura, humedad_ambiente, humedad_suelo,agua_disponible, modo_automatico) VALUES($id, 20, 20, 20, 1, 1)";
    $resultado = mysqli_query($conn->conectardb(), $plantasql);
    if($result->num_rows > 0) {
      header("location:index.php");
      exit();
  } else {
      
  $mensaje.="<h5 class='registrado'>Error</h5>";
  }

  }
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
            No tienes plantas en tu colección en este momento. ¡Pero no te preocupes, puedes agregar una planta fácilmente! Agregar plantas a tu colección te ayudara a cuidar tus plantas desde que cualquier parte del mundo.
¿Te gustaría comenzar tu colección de plantas? Simplemente presiona el botón de abajo para agregar tu primera planta.
            </p> 
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <input name="miBoton" value="Agregar planta" type="submit" class="btn btn-success crearPlanta">
            </form>
            <?php echo $mensaje; ?>
        
        </main>
    </div>
</div>
</body>
</html>
<?php 
} else {
  $queryDatos = "SELECT temperatura, humedad_ambiente, humedad_suelo, agua_disponible, modo_automatico FROM plantas where usuario_id = '$id'";
  $result = mysqli_query($conn->conectardb(), $queryDatos);

  if($result->num_rows > 0) {
    $datosPlanta = array();

        // Recorrer los resultados de la consulta y guardar los datos en la variable
        while ($row = mysqli_fetch_assoc($result)) {
            $datosPlanta[] = $row['temperatura'];
            $datosPlanta[] = $row['humedad_ambiente'];
            $datosPlanta[] = $row['humedad_suelo'];
            $datosPlanta[] = $row['agua_disponible'];
            $datosPlanta[] = $row['modo_automatico'];
        }
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="./css/bootstrap.min.css" />
  <link rel="stylesheet" href="./css/app.css">
  <link rel="stylesheet" href="./css/bootstrap.css">
  
  
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
        <section class="row">
                    <div class="col-12 col-lg-9">
                        <div class="row">
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon purple">
                                                    <i class="iconly-boldShow"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Humedad tierra</h6>
                                                <h6 class="font-extrabold mb-0" id="humedad"><?php echo $datosPlanta[2]; ?>%</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon blue">
                                                    <i class="iconly-boldProfile"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Humedad de ambiente</h6>
                                                <h6 class="font-extrabold mb-0" id="ambiente"><?php echo $datosPlanta[1] ?>%</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon green">
                                                    <i class="iconly-boldAdd-User"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Temp</h6>
                                                <h6 class="font-extrabold mb-0" id="temperatura"><?php echo $datosPlanta[0] ?>°C</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon red">
                                                    <i class="iconly-boldBookmark"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Agua en tanque:</h6>
                                                <h6 class="font-extrabold mb-0" id="agua"><?php 
                                                if($datosPlanta[3] == 1) {
                                                  echo "Todavia tiene agua";
                                                } else {
                                                  echo "Rellenar estanque";
                                                }
                                                ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon red">
                                                    <i class="iconly-boldBookmark"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                              <h6>Modo automatico</h6>
                                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <input name="miBoton" value="Agregar planta" type="submit" class="btn btn-success crearPlanta">
            </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                        
                                          
        </main>
    </div>
</div>
<script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="assets/vendors/apexcharts/apexcharts.js"></script>
    <script src="assets/js/pages/dashboard.js"></script>

    <script src="assets/js/main.js"></script>
</body>
</html>
<?php 
}
}
?>

 




       