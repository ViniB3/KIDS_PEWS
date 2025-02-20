<?php
include 'db.php';

// Verificar se o parâmetro crm foi passado pela URL
if (isset($_GET['crm'])) {
    $crm = $_GET['crm'];

    // Preparar a query para buscar o médico com o crm fornecido
    $sql = "SELECT crm, nome, especialidade FROM medico WHERE crm = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $crm); // "i" para integer
    $stmt->execute();

    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        // Retornar os dados do médico como JSON
        $medico = $result->fetch_assoc();
        echo json_encode($medico);
    } else {
        echo json_encode(['error' => 'Médico não encontrado']);
    }

    // Fechar a conexão
    $stmt->close();
} else {
    echo json_encode(['error' => 'CRM não fornecido']);
}

$conn->close();
?>
