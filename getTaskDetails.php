<?php
include('database.php');

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $taskId = $_GET['id'];

    $sql = "SELECT * FROM tasks WHERE id = $taskId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode($row);
    } else {
        echo "Task not found";
    }
}

$conn->close();
?>
