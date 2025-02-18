<?php
include 'db.php';

// Capturar dados do formulÃ¡rio
$crm = $_POST['crm'];
$nome_paciente = $_POST['nome_paciente']; // Preenchido automaticamente
$idade = $_POST['idade']; // Preenchido automaticamente
$f_cardiaca = $_POST['f_cardiaca'];
$f_respiratoria = $_POST['f_respiratoria'];
$aval_neurologica = $_POST['aval_neurologica'];
$aval_cardiovascular = $_POST['aval_cardiovascular'];
$aval_respiratoria = $_POST['aval_respiratoria'];
$nebulizacao_resgate = $_POST['nebulizacao_resgate'];
$pos_op = $_POST['pos_op'];
$intervencao = $_POST['intervencao'];

// Inserir dados no banco de dados
$stmt = $conn->prepare("INSERT INTO pews (crm, nome_paciente, idade, f_cardiaca, f_respiratoria, aval_neurologica, aval_cardiovascular, aval_respiratoria, nebulizacao_resgate, pos_op, intervencao) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("isiiissssss", $crm, $nome_paciente, $idade, $f_cardiaca, $f_respiratoria, $aval_neurologica, $aval_cardiovascular, $aval_respiratoria, $nebulizacao_resgate, $pos_op, $intervencao);

if ($stmt->execute()) {
    echo "<script>
            alert('Dados inseridos com sucesso!');
            window.location.href = 'index.html';
          </script>";
} else {
    echo "<script>
            alert('Erro: " . addslashes($stmt->error) . "');
            window.location.href = 'index.html';
          </script>";
}

$stmt->close();
$conn->close();
?>