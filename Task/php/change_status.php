<?php
include "connection.php";  //connecting to the database

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"]) && isset($_POST["status"])) {
    $taskId = $_POST["id"];
    $newStatus = $_POST["status"];

    $sql = "UPDATE tasks SET status = '$newStatus' WHERE id = $taskId";

    if ($conn->query($sql) === TRUE) {
        echo "success";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>
