<?php
include 'db.php';

$id = $_GET['id'];

$query = "SELECT nome, anos FROM paciente WHERE id = ?"; // Usar 'anos' conforme a tabela
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode(["success" => true, "nome" => $row['nome'], "anos" => $row['anos']]); // Retornar 'anos'
} else {
    echo json_encode(["success" => false, "message" => "Paciente não encontrado"]);
}

$stmt->close();
$conn->close();

?>