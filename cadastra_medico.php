<?php
// Include the database connection
include 'db.php';

// Capture form data
$crm = $_POST['crm']; // Change $cip to $crm
$nome = $_POST['nome'];
$especialidade = $_POST['especialidade']; // Change $funcao to $especialidade
$senha = $_POST['senha'];

// Prepare and bind the SQL statement
$stmt = $conn->prepare("INSERT INTO medico (crm, nome, especialidade, senha) 
                        VALUES (?, ?, ?, ?)");
$stmt->bind_param("isss", $crm, $nome, $especialidade, $senha);

// Execute the query
if ($stmt->execute()) {
    echo "Record successfully inserted!";
    header("Location: home.html");
} else {
    echo "Error: " . $stmt->error;
}

// Close the connection
$stmt->close();
$conn->close();
?>