<?php
// Include database connection
include 'db.php';

// Fetch all patients from the table
$sql = "SELECT id, nome FROM paciente";
$result = $conn->query($sql);

// Debugging: Check if the query runs successfully
if (!$result) {
    die("Query failed: " . $conn->error);
}

if ($result->num_rows > 0) {
    echo "<h1>Pacientes Cadastrados</h1>";
    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
        echo "<button onclick='window.location.href=\"pews_cadastrados.html?id=" . $row['id'] . "\"'>" . htmlspecialchars($row['nome']) . "</button>";
    }
    echo "</ul>";
} else {
    echo "<p>Nenhum paciente cadastrado.</p>";
}

// Close database connection
$conn->close();
?>