<?php
include 'db.php';

$crm = intval($_GET['crm']);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT crm, nome, especialidade FROM medico WHERE crm = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $crm);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        echo json_encode($row);
    } else {
        echo json_encode(["error" => "Médico não encontrado"]);
    }
    $stmt->close();
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $especialidade = $_POST['especialidade'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $sql = "UPDATE medico SET nome = ?, especialidade = ?, senha = ? WHERE crm = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $nome, $especialidade, $senha, $crm);

    if ($stmt->execute()) {
        echo json_encode(["success" => "Médico atualizado com sucesso"]);
    } else {
        echo json_encode(["error" => "Erro ao atualizar médico"]);
    }

    $stmt->close();
}
$conn->close();
?>
