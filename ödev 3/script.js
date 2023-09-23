document.addEventListener("DOMContentLoaded", function () {
    const taskInput = document.getElementById("task");
    const addTaskButton = document.getElementById("add-task");
    const taskList = document.getElementById("task-list");
    let editingTaskId = null;

    loadTasks();

    addTaskButton.addEventListener("click", function () {
        const taskText = taskInput.value.trim();
        if (taskText !== "") {
            if (editingTaskId === null) {
                addTask(taskText);
            } else {
                editTask(editingTaskId, taskText);
            }
            taskInput.value = "";
        }
    });

    taskList.addEventListener("click", function (e) {
        if (e.target && e.target.classList.contains("task")) {
            toggleTaskStatus(e.target.dataset.id);
        }
    });

    taskList.addEventListener("click", function (e) {
        if (e.target && e.target.classList.contains("delete")) {
            deleteTask(e.target.dataset.id);
        }
    });

    taskList.addEventListener("click", function (e) {
        if (e.target && e.target.classList.contains("edit")) {
            const taskElement = e.target.parentElement.querySelector(".task");
            if (taskElement.classList.contains("editing")) {
                if (e.key === "Enter") {
                    taskElement.contentEditable = "false";
                    taskElement.classList.remove("editing");
                    editTask(taskElement.dataset.id, taskElement.textContent.trim());
                }
            } else {
                taskElement.contentEditable = "true";
                taskElement.classList.add("editing");
                taskElement.focus();
            }
        }
    });

    taskList.addEventListener("keyup", function (e) {
        if (e.target && e.target.classList.contains("task") && e.key === "Enter") {
            const taskElement = e.target;
            taskElement.contentEditable = "false";
            taskElement.classList.remove("editing");
            editTask(taskElement.dataset.id, taskElement.textContent.trim());
        }
    });

    function loadTasks() {
        fetch("tasks.php")
            .then((response) => response.json())
            .then((data) => {
                taskList.innerHTML = "";
                data.forEach((task) => {
                    const listItem = document.createElement("li");
                    listItem.innerHTML = `
                        <span class="task ${task.task_status ? 'completed' : ''}" data-id="${task.id}">${task.task_name}</span>
                        <button class="delete" data-id="${task.id}">Sil</button>
                        <button class="edit" data-id="${task.id}">Düzenle</button>
                    `;
                    taskList.appendChild(listItem);
                });
            });
    }

    function addTask(taskText) {
        fetch("tasks.php", {
            method: "POST",
            body: JSON.stringify({ task_name: taskText }),
            headers: {
                "Content-Type": "application/json",
            },
        })
            .then((response) => response.json())
            .then((data) => {
                loadTasks();
            });
    }

    function toggleTaskStatus(taskId) {
        fetch(`tasks.php?id=${taskId}`, {
            method: "PUT",
        })
            .then((response) => response.json())
            .then((data) => {
                loadTasks();
            });
    }

    function deleteTask(taskId) {
        fetch(`tasks.php?id=${taskId}`, {
            method: "DELETE",
        })
            .then((response) => response.json())
            .then((data) => {
                loadTasks();
            });
    }

    function editTask(taskId, taskText) {
        fetch(`tasks.php?id=${taskId}`, {
            method: "PUT",
            body: JSON.stringify({ task_name: taskText }),
            headers: {
                "Content-Type": "application/json",
            },
        })
            .then((response) => response.json())
            .then((data) => {
                loadTasks();
                editingTaskId = null;
            });
    }
});
