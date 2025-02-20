<?php
include 'db.php';

// Verificar se os dados foram enviados via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Receber dados do formulário
    $crm = isset($_POST['crm']) ? $_POST['crm'] : null; // Definir o CRM
    $nome = isset($_POST['nome']) ? $_POST['nome'] : null; // Definir o nome
    $especialidade = isset($_POST['especialidade']) ? $_POST['especialidade'] : null; // Definir especialidade

    // Depuração: Verificar os dados recebidos
    echo "CRM: $crm, Nome: $nome, Especialidade: $especialidade<br>"; // Para depuração

    // Verificar se os dados obrigatórios estão sendo recebidos corretamente
    if (empty($crm) || empty($nome) || empty($especialidade)) {
        echo "Erro: Todos os campos são obrigatórios!"; // Exibir erro caso algum campo esteja vazio
        exit;
    }

    // Preparar a query para atualizar o médico no banco de dados
    $sql = "UPDATE medico SET nome = ?, especialidade = ? WHERE crm = ?";
    $stmt = $conn->prepare($sql);
    
    // Garantir que os parâmetros estejam sendo passados corretamente
    $stmt->bind_param("ssi", $nome, $especialidade, $crm); // "ssi" -> string, string, integer

    // Executar a query e verificar o resultado
    if ($stmt->execute()) {
        echo "Médico atualizado com sucesso!";
    } else {
        echo "Erro ao atualizar médico: " . $conn->error;
    }

    // Fechar a conexão com o banco
    $stmt->close();
} else {
    echo "Método inválido!";
}

$conn->close();
?>
