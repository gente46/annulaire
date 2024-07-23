<?php
include 'config.php';

$sql = "SELECT * FROM contacts";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['phone'] . "</td>";
        echo '<td><button class="btn btn-warning edit-btn" data-id="' . $row['id'] . '">Modifier</button> ';
        echo '<button class="btn btn-danger delete-btn" data-id="' . $row['id'] . '">Supprimer</button></td>';
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4'>Aucun contact trouvé.</td></tr>";
}

$conn->close();
?>
