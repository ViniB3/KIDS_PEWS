<?php
include 'db.php';

$id = intval($_POST['id']);
$nome = $_POST['nome'];

$sql = "UPDATE medico SET nome = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $nome, $id);
$stmt->execute();

echo "Atualização bem-sucedida";

$conn->close();
?>
