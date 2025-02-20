<?php
include 'db.php';

$sql = "SELECT id, nome FROM medico";
$result = $conn->query($sql);

$medicos = [];
while ($row = $result->fetch_assoc()) {
    $medicos[] = $row;
}

header('Content-Type: application/json');
echo json_encode($medicos);

$conn->close();
?>
