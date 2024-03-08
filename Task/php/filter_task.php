<?php
include "connection.php";  //connecting to the database

// Check if a status filter is provided
$statusFilter = isset($_GET['statusFilter']) ? $_GET['statusFilter'] : '';

// Modify the SQL query to include the status filter conditionally
$query = "SELECT * FROM tasks";
if ($statusFilter && $statusFilter !== 'All') {
    $query .= " WHERE status = '$statusFilter'";
}

// Order by status only when the user selects "All"
if ($statusFilter === 'All') {
    $query .= " ORDER BY FIELD(status, 'ToDo', 'Ongoing', 'Done')";
}

$result = $conn->query($query);

$html = "";
while ($row = $result->fetch_assoc()) {
    $statusColors = array(
        'ToDo' => '#3498db',   // Blue color for ToDo
        'Ongoing' => '#2ecc71', // Green color for Ongoing
        'Done' => '#f39c12'     // Yellow color for Done
    );

    $taskDateTime = new DateTime($row['task_date'] . ' ' . $row['task_time']);

    $html .= "<tr data-id='{$row['id']}'>";
    $html .= "<td>{$row['title']}</td>";
    $html .= "<td>{$row['description']}</td>";
    $html .= "<td>{$taskDateTime->format('Y-m-d')}</td>";  // Display date
    $html .= "<td>{$taskDateTime->format('H:i:s')}</td>";  // Display time
    $html .= "<td>";
    $html .= "<select class='statusSelect' style='background-color: {$statusColors[$row['status']]}'>";
    $html .= "<option value='ToDo' " . ($row['status'] == 'ToDo' ? 'selected' : '') . ">ToDo</option>";
    $html .= "<option value='Ongoing' " . ($row['status'] == 'Ongoing' ? 'selected' : '') . ">Ongoing</option>";
    $html .= "<option value='Done' " . ($row['status'] == 'Done' ? 'selected' : '') . ">Done</option>";
    $html .= "</select>";
    $html .= "</td>";
    $html .= "<td>";
    $html .= "<button class='editTask'>Edit</button>";
    $html .= "<button class='deleteTask'>Delete</button>";
    $html .= "</td>";
    $html .= "</tr>";
}

echo $html;

$conn->close();
?>
