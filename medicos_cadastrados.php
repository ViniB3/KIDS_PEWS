<?php
include 'db.php';

header('Content-Type: application/json; charset=UTF-8'); // Garante que a resposta será JSON

$sql = "SELECT crm, nome, especialidade FROM medico";
$result = $conn->query($sql);

$medicos = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $medicos[] = $row;
    }
    echo json_encode($medicos, JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode(["erro" => "Erro na consulta ao banco de dados"]);
}

$conn->close();
?>
