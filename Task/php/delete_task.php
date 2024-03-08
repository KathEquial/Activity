<?php
include "connection.php";  //connecting to the database

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    $taskId = $_POST["id"];

    $sql = "DELETE FROM tasks WHERE id = $taskId";

    if ($conn->query($sql) === TRUE) {
        echo "success";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$conn->close();
?>
