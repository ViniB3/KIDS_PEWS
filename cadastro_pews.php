<?php
// Include the database connection
include 'db.php';

// Capture form data (excluding 'id' since it will be auto-generated)
$crm = $_POST['crm']; // Assuming you have a form field for CRM
$nome_paciente = $_POST['nome_paciente'];
$idade = $_POST['idade'];
$f_cardiaca = $_POST['f_cardiaca'];
$f_respiratoria = $_POST['f_respiratoria'];
$aval_neurologica = $_POST['aval_neurologica'];
$aval_cardiovascular = $_POST['aval_cardiovascular'];
$aval_respiratoria = $_POST['aval_respiratoria'];
$nebulizacao_resgate = $_POST['nebulizacao_resgate'];
$pos_op = $_POST['pos_op'];
$intervencao = $_POST['intervencao'];

// Prepare and bind the SQL statement (no need to bind 'id' since it's auto-generated)
$stmt = $conn->prepare("INSERT INTO pews (crm, nome_paciente, idade, f_cardiaca, f_respiratoria, aval_neurologica, aval_cardiovascular, aval_respiratoria, nebulizacao_resgate, pos_op, intervencao) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("isiiissssss", $crm, $nome_paciente, $idade, $f_cardiaca, $f_respiratoria, $aval_neurologica, $aval_cardiovascular, $aval_respiratoria, $nebulizacao_resgate, $pos_op, $intervencao);

// Execute the query
if ($stmt->execute()) {
    // Success message
    echo "<script>
            alert('Record successfully inserted!');
            window.location.href = 'index.html'; // Redirect to index.html
          </script>";
} else {
    // Error message
    echo "<script>
            alert('Error: " . addslashes($stmt->error) . "');
            window.location.href = 'index.html'; // Redirect to index.html even on error
          </script>";
}

// Close the connection
$stmt->close();
$conn->close();
?>