<?php
include "connection.php";  //connecting to the database

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $taskId = $_GET["id"];

    $result = $conn->query("SELECT * FROM tasks WHERE id = $taskId");

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode($row);
    } else {
        echo "Task not found";
    }
}

$conn->close();
?>
