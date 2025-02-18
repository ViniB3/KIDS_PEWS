<?php
// Start the session
session_start();

// Include the database connection
include 'db.php';

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get input values from form
$crm = $_POST['crm'];
$senha = $_POST['senha'];

// Prepare the SQL query to check credentials
$sql = "SELECT * FROM medico WHERE crm = ? AND senha = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Error preparing the statement: " . $conn->error);
}

$stmt->bind_param("ss", $crm, $senha);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Credentials are correct, login successful
    $_SESSION['crm'] = $crm;
    echo "<script>alert('Login realizado com sucesso!'); window.location.href='index.html';</script>";
} else {
    // Credentials are incorrect
    echo "<script>alert('Erro: CRM ou senha incorretos!'); window.location.href='login_medico.html';</script>";
}

// Close connections
$stmt->close();
$conn->close();
?>