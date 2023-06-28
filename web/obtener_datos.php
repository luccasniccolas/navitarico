<?php
// Realiza las operaciones necesarias en tu base de datos para obtener los datos requeridos
// ...
$servername = "34.31.142.80";
$username = "root";
$password = "lucas123";
$database = "plantas-db";


// Crear la conexión
$conn = mysqli_connect($servername, $username, $password, $database);

// ...

ob_start(); // Iniciar el almacenamiento en búfer de salida

$sql = "SELECT * FROM plantas WHERE id = 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Crear un array para almacenar los nombres de los usuarios
    $modo;

    // Iterar sobre los resultados y agregar cada nombre al array
    while ($row = $result->fetch_assoc()) {
        $modo[] = $row;
    }

    // Cerrar el almacenamiento en búfer de salida
    ob_end_clean();

    // Establecer los encabezados después de cerrar el almacenamiento en búfer
    header('Content-Type: application/json');
    echo json_encode($modo);
} else {
    // Cerrar el almacenamiento en búfer de salida
    ob_end_clean();

    echo "No se encontraron usuarios en la base de datos.";
}

// Cerrar la conexión a la base de datos
$conn->close();
?>