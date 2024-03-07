<?php
include('database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $taskId = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date = $_POST['date'];

    $sql = "UPDATE tasks SET title='$title', description='$description', date='$date' WHERE id=$taskId";

    if ($conn->query($sql) === TRUE) {
        echo "Task updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
