<?php
// Include the database connection
include 'db.php';

// Capture form data
$coren = $_POST['coren']; // Change $cip to $coren
$nome = $_POST['nome'];
$especialidade = $_POST['funcao']; // Change $funcao to $especialidade
$senha = $_POST['senha'];

// Prepare and bind the SQL statement
$stmt = $conn->prepare("INSERT INTO enfermeira (coren, nome, funcao, senha) 
                        VALUES (?, ?, ?, ?)");
$stmt->bind_param("isss", $coren, $nome, $especialidade, $senha);

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