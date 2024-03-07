<?php
include('database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $taskId = $_POST['id'];

    $sql = "DELETE FROM tasks WHERE id=$taskId";

    if ($conn->query($sql) === TRUE) {
        echo "Task deleted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
