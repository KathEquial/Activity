$(document).ready(function () {
    // Load current tasks on page load
    loadCurrentTasks();

    // Add Task button click event
    $('#addTaskBtn').click(function () {
        // Show overlay and add task form
        $('#overlay').show();
        showAddTaskForm();
    });

    // Home link click event (you can implement other links similarly)
    $('#home').click(function () {
        // Load home content or implement other specific actions
    });

    // Resize event for responsive design
    $(window).resize(function () {
        adjustLayout();
    });

    // Initial adjustment for responsive design
    adjustLayout();
});

function loadCurrentTasks() {
    // AJAX request to load current tasks
    $.ajax({
        url: 'tasks.php',
        type: 'GET',
        success: function (data) {
            $('#currentTaskContent').html(data);
        },
        error: function () {
            alert('Error loading current tasks.');
        }
    });
}

function showAddTaskForm() {
    // Implement add task form here
    var form = '<div class="form-container">';
    form += '<h2>Add Task</h2>';
    form += '<label for="title">Title:</label>';
    form += '<input type="text" id="title" name="title" required>';
    form += '<label for="description">Description:</label>';
    form += '<textarea id="description" name="description" required></textarea>';
    form += '<label for="date">Date:</label>';
    form += '<input type="date" id="date" name="date" required>';
    form += '<button onclick="addTask()">Add Task</button>';
    form += '</div>';

    $('.content').append(form);
}

function addTask() {
    // AJAX request to add task
    var title = $('#title').val();
    var description = $('#description').val();
    var date = $('#date').val();

    $.ajax({
        url: 'addTask.php',
        type: 'POST',
        data: { title: title, description: description, date: date },
        success: function () {
            // Close the form and refresh current tasks
            $('#overlay').hide();
            $('.form-container').remove();
            loadCurrentTasks();
        },
        error: function () {
            alert('Error adding task.');
        }
    });
}

function showEditForm(taskId) {
    // AJAX request to get task details for editing
    $.ajax({
        url: 'getTaskDetails.php',
        type: 'GET',
        data: { id: taskId },
        success: function (data) {
            // Show edit form with pre-filled details
            var form = '<div class="form-container">';
            form += '<h2>Edit Task</h2>';
            form += '<label for="title">Title:</label>';
            form += '<input type="text" id="title" name="title" value="' + data.title + '" required>';
            form += '<label for="description">Description:</label>';
            form += '<textarea id="description" name="description" required>' + data.description + '</textarea>';
            form += '<label for="date">Date:</label>';
            form += '<input type="date" id="date" name="date" value="' + data.date + '" required>';
            form += '<button onclick="updateTask(' + taskId + ')">Update Task</button>';
            form += '</div>';

            $('.content').append(form);
        },
        error: function () {
            alert('Error loading task details for editing.');
        }
    });
}

function updateTask(taskId) {
    // AJAX request to update task
    var title = $('#title').val();
    var description = $('#description').val();
    var date = $('#date').val();

    $.ajax({
        url: 'updateTask.php',
        type: 'POST',
        data: { id: taskId, title: title, description: description, date: date },
        success: function () {
            // Close the form and refresh current tasks
            $('#overlay').hide();
            $('.form-container').remove();
            loadCurrentTasks();
        },
        error: function () {
            alert('Error updating task.');
        }
    });
}

function confirmDelete(taskId) {
    // Show confirm delete prompt
    var confirmation = confirm('Are you sure you want to delete this task?');

    if (confirmation) {
        // AJAX request to delete task
        $.ajax({
            url: 'deleteTask.php',
            type: 'POST',
            data: { id: taskId },
            success: function () {
                // Refresh current tasks after deletion
                loadCurrentTasks();
            },
            error: function () {
                alert('Error deleting task.');
            }
        });
    }
}

function adjustLayout() {
    // Adjust layout for responsive design
    var screenWidth = $(window).width();

    if (screenWidth <= 600) {
        $('.sidebar').css('width', '100%');
        $('.sidebar').css('text-align', 'left');
        $('.content').css('margin-left', '0');
    } else {
        $('.sidebar').css('width', '200px');
        $('.sidebar').css('text-align', 'center');
        $('.content').css('margin-left', '200px');
    }
}
