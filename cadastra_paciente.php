<?php
// Include the database connection
include 'db.php';

// Check if the form data is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capture and sanitize form data
    $responsavel = htmlspecialchars($_POST['responsavel']);
    $nome = htmlspecialchars($_POST['nome']);
    $anos = intval($_POST['anos']); // Ensure it's an integer
    $meses = intval($_POST['meses']); // Ensure it's an integer
    $telefone = htmlspecialchars($_POST['telefone']);
    $genero = htmlspecialchars($_POST['genero']);
    $data_nascimento = $_POST['data_nascimento']; // Date fields don't need sanitization
    $data_entrada = $_POST['data_entrada']; // Date fields don't need sanitization
    $alergias = htmlspecialchars($_POST['alergias']);
    $remedios = htmlspecialchars($_POST['remedios']);
    $tipo_sanguineo = htmlspecialchars($_POST['tipo_sanguineo']);

    // Validate required fields
    if (empty($responsavel) || empty($nome) || empty($anos) || empty($meses) || empty($genero) || empty($data_nascimento) || empty($data_entrada) || empty($tipo_sanguineo)) {
        die("Error: All required fields must be filled.");
    }

    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("INSERT INTO paciente (responsavel, nome, anos, meses, telefone, genero, data_nascimento, data_entrada, alergias, remedios, tipo_sanguineo) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("ssiisssssss", $responsavel, $nome, $anos, $meses, $telefone, $genero, $data_nascimento, $data_entrada, $alergias, $remedios, $tipo_sanguineo);

    // Execute the query
    if ($stmt->execute()) {
        // Success: Redirect to cadastro_pews.html
        header("Location: cadastro_pews.html");
        exit(); // Ensure no further code is executed after the redirect
    } else {
        // Error: Display an error message and redirect back to the form
        echo "<script>
                alert('Error: " . addslashes($stmt->error) . "');
                window.location.href = 'index.html'; // Redirect to index.html on error
              </script>";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    // If the form is not submitted, redirect to the form page
    header("Location: index.html");
    exit();
}
?>