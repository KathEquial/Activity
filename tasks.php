<?php
include('database.php');

// Retrieve current tasks from the database
$sql = "SELECT * FROM tasks WHERE status = 'Current'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='task-card'>";
        echo "<h3>" . $row['title'] . "</h3>";
        echo "<p>" . $row['description'] . "</p>";
        echo "<p>" . $row['date'] . "</p>";
        echo "<button class='action-btn' onclick='showEditForm(" . $row['id'] . ")'>Edit</button>";
        echo "<button class='action-btn' onclick='confirmDelete(" . $row['id'] . ")'>Delete</button>";
        echo "</div>";
    }
} else {
    echo "No tasks found.";
}

$conn->close();
?>
