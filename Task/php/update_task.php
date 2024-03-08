<?php
include "connection.php";  //connecting to the database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $taskId = $_POST["id"];
    $title = $_POST["title"];
    $description = $_POST["description"];
    $taskDate = $_POST["taskDate"];
    $taskTime = $_POST["taskTime"];
    $status = $_POST["status"];

    $sql = "UPDATE tasks SET title='$title', description='$description', task_date='$taskDate', task_time='$taskTime', status='$status' WHERE id=$taskId";

    if ($conn->query($sql) === TRUE) {
        echo "success";
    } else {
        echo "Error updating task: " . $conn->error;
    }
}

$conn->close();
?>
