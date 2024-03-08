<?php
include "connection.php";  //connecting to the database

// Define colors for each status
$statusColors = array(
    'ToDo' => '#3498db',   // Blue color for ToDo
    'Ongoing' => '#2ecc71', // Green color for Ongoing
    'Done' => '#f39c12'     // Yellow color for Done
);

$result = $conn->query("SELECT * FROM tasks ORDER BY 
    CASE status 
        WHEN 'ToDo' THEN 1
        WHEN 'Ongoing' THEN 2
        WHEN 'Done' THEN 3
        ELSE 4
    END");

$html = "";
while ($row = $result->fetch_assoc()) {
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
