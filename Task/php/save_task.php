<?php
include "connection.php";  //connecting to the database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $description = $_POST["description"];
    $taskDate = $_POST["taskDate"];
    $taskTime = $_POST["taskTime"];  // Add the taskTime variable
    $status = $_POST["status"];

    $sql = "INSERT INTO tasks (title, description, task_date, task_time, status) 
            VALUES ('$title', '$description', '$taskDate', '$taskTime', '$status')";

    if ($conn->query($sql) === TRUE) {
        echo "success";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
