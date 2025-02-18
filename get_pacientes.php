<?php
include 'db.php';

$query = "SELECT id, nome FROM paciente";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $pacientes = [];
    while ($row = $result->fetch_assoc()) {
        $pacientes[] = $row;
    }
    echo json_encode(["success" => true, "pacientes" => $pacientes]);
} else {
    echo json_encode(["success" => false, "message" => "Nenhum paciente encontrado"]);
}

$conn->close();

?>