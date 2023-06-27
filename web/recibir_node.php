<?php
session_start();
require_once('database.php');
//$id = $_SESSION['datosUsuario'][0];

$temperatura = $_POST['temperature'];
$humedad_ambiente = $_POST['humidity'];
$humedad_suelo = $_POST['humedad_suelo'];
$agua_disponible = $_POST['agua'];
$modo_automatico = $_POST['modo'];
$id=1;


$conn = new conexion();
$query = "UPDATE plantas SET temperatura = $temperatura, humedad_ambiente = $humedad_ambiente, humedad_suelo=$humedad_suelo, agua_disponible=$agua_disponible, modo_automatico = $modo_automatico where id < 100";
$result = mysqli_query($conn->conectardb(), $query);



?>