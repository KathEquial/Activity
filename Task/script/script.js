$(document).ready(function () {
    // Hide the popup form on load
    $("#popupContainer").hide();

    // Show task form on "Add Task" button click
    $("#addTaskBtn").click(function () {
        $("#popupContainer").fadeIn();
    });

    // Cancel task form
    $("#cancelTask").click(function () {
        $("#popupContainer").fadeOut();
        clearForm();
    });

    // Load tasks on page load
    // Assuming loadTasks() is defined in script.js
    loadTasks();

    // Handle task actions (Edit, Delete, Change Status)
    $("#taskTable").on("click", ".editTask", function () {
        var taskId = $(this).closest("tr").data("id");
        editTask(taskId);
    });

    $("#taskTable").on("click", ".deleteTask", function () {
        var taskId = $(this).closest("tr").data("id");
        deleteTask(taskId);
    });

    $("#taskTable").on("change", ".statusSelect", function () {
        var taskId = $(this).closest("tr").data("id");
        var newStatus = $(this).val();
        changeStatus(taskId, newStatus);
    });

    function showSuccessMessage(message) {
        alert(message);
    }

    // Submit task form
    $("#taskForm").submit(function (event) {
        event.preventDefault();
        saveTask();
        $("#popupContainer").fadeOut();
    });

    function clearForm() {
        $("#title").val("");
        $("#description").val("");
        $("#taskDate").val("");
        $("#taskTime").val("");
        $("#status").val("ToDo");
    }

    // Handle status filter change
    $("#filterStatus").change(function () {
        var statusFilter = $(this).val();
        loadFilteredTasks(statusFilter); // Use a different function name to avoid conflicts
    });

    function loadFilteredTasks(statusFilter) {
        $.ajax({
            type: "GET",
            url: "php/filter_task.php",
            data: { statusFilter: statusFilter },
            success: function (data) {
                $("#taskTable tbody").html(data);
            },
        });
    }

    function saveTask() {
    var title = $("#title").val();
    var description = $("#description").val();
    var taskDate = $("#taskDate").val();
    var taskTime = $("#taskTime").val();
    var status = $("#status").val();
    var taskId = $("#submitTask").attr("data-id"); // Get the task ID

    // Validate taskDate to prevent past dates
    var currentDate = new Date();
    var selectedDate = new Date(taskDate);

    if (selectedDate < currentDate) {
        alert("Please select a future date.");
        return;
    }

    var url = taskId ? "php/update_task.php" : "php/save_task.php"; // Use different URLs for adding and updating

    $.ajax({
        type: "POST",
        url: url,
        data: {
            title: title,
            description: description,
            taskDate: taskDate,
            taskTime: taskTime,
            status: status,
            id: taskId // Send the task ID for updating
        },
        success: function (response) {
            if (response == "success") {
                clearForm();
                loadTasks();
                if (taskId) {
                    showSuccessMessage("Task updated successfully!");
                } else {
                    showSuccessMessage("Task added successfully!");
                }
            } else {
                alert("Error saving task");
            }
        },
    });
}
    
    function loadTasks() {
        $.ajax({
            type: "GET",
            url: "php/load_task.php",
            success: function (data) {
                $("#taskTable tbody").html(data);
            },
        });
    }

    function editTask(taskId) {
        $.ajax({
            type: "GET",
            url: "php/edit_task.php",
            data: { id: taskId },
            success: function (data) {
                data = JSON.parse(data);
                $("#title").val(data.title);    
                $("#description").val(data.description);
                $("#taskDate").val(data.task_date);
                $("#taskTime").val(data.task_time);
                $("#status").val(data.status);
    
                // Hide the status label
                $(".status-label").hide();
                $("#status").hide();
    
                // Update submit button to act as an update button
                $("#submitTask").attr("data-id", taskId);
                $("#submitTask").text("Update");
    
                // Show the popup form
                $("#popupContainer").fadeIn();
            },
        });
    }
    

    function deleteTask(taskId) {
        if (confirm("Are you sure you want to delete this task?")) {
            $.ajax({
                type: "POST",
                url: "php/delete_task.php",
                data: { id: taskId },
                success: function (response) {
                    if (response == "success") {
                        loadTasks();
                        showSuccessMessage("Task deleted successfully!");
                    } else {
                        alert("Error deleting task");
                    }
                },
            });
        }
    }

    function changeStatus(taskId, newStatus) {
        $.ajax({
            type: "POST",
            url: "php/change_status.php",
            data: {
                id: taskId,
                status: newStatus,
            },
            success: function (response) {
                if (response == "success") {
                    loadTasks();
                    showSuccessMessage("Task status changed successfully!");
                    $('#filterStatus').val("All");
                } else {
                    alert("Error changing task status");
                }
            },
        });
    }
});