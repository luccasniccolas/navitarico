<?php
require_once('database.php');

$nombre = $_GET['nombre'];
$apellido = $_GET['apellido'];
$mail = $_GET['email'];
$contrasena = $_GET['password'];

$conn = new conexion;
$mailSql = "SELECT * FROM usuario WHERE mail = '$mail'";
$result = mysqli_query($conn->conectardb(), $mailSql);

if($result->num_rows > 0) {
    echo "ya estas registrado";
} else {
    $query = "INSERT INTO usuario(nombre, apellido, mail, contraseña) VALUES('$nombre', '$apellido','$mail', '$contrasena')";
$insert = mysqli_query($conn->conectardb(), $query);
echo "registrado con exito";
}



?>