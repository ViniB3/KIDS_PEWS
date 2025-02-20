<?php
include 'db.php';

$crm = $_GET['crm'];

$sql = "DELETE FROM medico WHERE crm=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $crm);

if ($stmt->execute()) {
    echo "Médico excluído com sucesso!";
} else {
    echo "Erro ao excluir médico: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
