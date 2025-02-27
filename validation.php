<?php
$servername = "localhost";
$username = "root"; // Usuario de MySQL
$password = ""; // Si tienes contraseña en MySQL, ponla aquí
$dbname = "validar"; // Nombre de la base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si los datos fueron enviados
if(isset($_GET['fname']) && isset($_GET['lname'])) {
    $fname = password_hash($_GET['fname'], PASSWORD_DEFAULT); // Encripta el nombre
    $lname = password_hash($_GET['lname'], PASSWORD_DEFAULT); // Encripta el apellido

    // Insertar en la base de datos
    $sql = "INSERT INTO usuarios (fname, lname) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $fname, $lname);

    if ($stmt->execute()) {
        echo "Registro exitoso. ID asignado: " . $stmt->insert_id;
    } else {
        echo "Error: " . $stmt->error;
    }

    // Cerrar conexión
    $stmt->close();
}

$conn->close();
?>
