<?php
// Include database connection
include 'db.php';

// Fetch all nurses from the table
$sql = "SELECT coren, nome, funcao FROM enfermeira";
$result = $conn->query($sql);

// Debugging: Check if the query runs successfully
if (!$result) {
    die("Query failed: " . $conn->error);
}

if ($result->num_rows > 0) {
    // Start building the HTML table
    echo "<h1>Enfermeiros Cadastrados</h1>";
    echo "<table border='1'>";
    echo "<tr><th>COREN</th><th>Nome</th><th>Função</th></tr>";

    // Loop through each row of the result set
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['coren']) . "</td>";
        echo "<td>" . htmlspecialchars($row['nome']) . "</td>";
        echo "<td>" . htmlspecialchars($row['funcao']) . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "<p>Nenhum enfermeiro cadastrado.</p>";
}

// Close database connection
$conn->close();
?>