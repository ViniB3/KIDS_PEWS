<?php
// Include database connection
include 'db.php';

// Get the patient ID from the query parameter
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    // Fetch the record with the matching ID from the 'pews' table
    $stmt = $conn->prepare("SELECT * FROM pews WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<h1>PEWS Cadastrados</h1>";
        echo "<ul>";
        while ($row = $result->fetch_assoc()) {
            echo "<li>";
            foreach ($row as $key => $value) {
                echo htmlspecialchars($key) . ": " . htmlspecialchars($value) . " ";
            }
            echo "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>Nenhum pews cadastrado.</p>";
    }

    $stmt->close();
} else {
    echo "<p>ID inválido.</p>";
}

// Close database connection
$conn->close();
?>