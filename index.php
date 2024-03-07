<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="sidebar">
    <a href="#" id="home">Home</a>
    <a href="#" id="currentTask">Current Task</a>
    <a href="#" id="ongoing">Ongoing</a>
    <a href="#" id="done">Done</a>
    <a href="#" id="history">History/Backlog</a>
</div>

<div class="content">
    <button id="addTaskBtn">Add Task</button>
    <div id="currentTaskContent">
        <!-- Display current tasks here -->
    </div>
</div>

<div id="overlay"></div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="script.js"></script>

</body>
</html>
