<?php
include 'db.php'; // Conexão com o banco de dados

// Verificar se a pontuação foi calculada e enviada
if (isset($_POST['pontuacao'])) {
    // Capturar os dados do formulário
    $crm = $_POST['crm'];
    $nome_paciente = $_POST['nome_paciente'];
    $idade = $_POST['idade'];
    $f_cardiaca = $_POST['f_cardiaca'];
    $f_respiratoria = $_POST['f_respiratoria'];
    $aval_neurologica = $_POST['aval_neurologica'];
    $aval_cardiovascular = $_POST['aval_cardiovascular'];
    $aval_respiratoria = $_POST['aval_respiratoria'];
    $nebulizacao_resgate = $_POST['nebulizacao_resgate'];
    $intervencao = $_POST['intervencao'];
    $pontuacaoFinal = $_POST['pontuacao']; // Pontuação enviada do conta_pews.php

    // Preparar a consulta para inserir os dados no banco
    $stmt = $conn->prepare("INSERT INTO pews (crm, nome_paciente, idade, f_cardiaca, f_respiratoria, aval_neurologica, aval_cardiovascular, aval_respiratoria, nebulizacao_resgate, intervencao, pontuacao) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isiiisssssi", $crm, $nome_paciente, $idade, $f_cardiaca, $f_respiratoria, $aval_neurologica, $aval_cardiovascular, $aval_respiratoria, $nebulizacao_resgate, $intervencao, $pontuacaoFinal);

    // Verificar se a consulta foi executada com sucesso
    if ($stmt->execute()) {
        echo "<script>
                alert('Dados inseridos com sucesso!');
                window.location.href = 'index.html'; // Redireciona após sucesso
              </script>";
    } else {
        echo "<script>
                alert('Erro: " . addslashes($stmt->error) . "');
                window.location.href = 'index.html'; // Redireciona após erro
              </script>";
    }

    // Fechar a consulta e a conexão com o banco
    $stmt->close();
    $conn->close();
} else {
    echo "<script>alert('Pontuação não calculada.');</script>";
}
?>
