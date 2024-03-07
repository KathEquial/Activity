<?php
include('database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date = $_POST['date'];

    $sql = "INSERT INTO tasks (title, description, date, status) VALUES ('$title', '$description', '$date', 'Current')";

    if ($conn->query($sql) === TRUE) {
        echo "Task added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
