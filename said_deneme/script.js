document.addEventListener("DOMContentLoaded", function () {
    const taskForm = document.getElementById("task-form");
    const newTaskInput = document.getElementById("new-task");
    const taskList = document.getElementById("task-list");
    const searchInput = document.getElementById("search-input");
    const clearSearchButton = document.getElementById("clear-search-button");

    function getTasks() {
        fetch("tasks.php", {
            method: "GET",
        })
            .then((response) => response.json())
            .then((data) => {
                taskList.innerHTML = "";
                data.forEach((task) => {
                    addTaskToList(task.task_name, task.is_completed, task.id);
                });
            });
    }

    function addTaskToList(taskText, completed = false, taskId) {
        const taskItem = document.createElement("li");
        taskItem.className = "task";
        taskItem.dataset.task = taskId; 
        taskItem.innerHTML = `
            <input type="checkbox" class="task-checkbox" ${completed ? "" : ""}>
            <input type="text" value="${taskText}" ${completed ? "readonly" : ""}>
            <button class="edit">Düzenle</button>
            <button class="delete">Sil</button>
            <button class="save" style="display: none;">Kaydet</button>
        `;

        taskList.appendChild(taskItem);

        const editButton = taskItem.querySelector(".edit");
        const deleteButton = taskItem.querySelector(".delete");
        const saveButton = taskItem.querySelector(".save");
        const taskInput = taskItem.querySelector("input[type='text']");
        const taskCheckbox = taskItem.querySelector(".task-checkbox");

        editButton.addEventListener("click", function () {
            taskInput.removeAttribute("readonly");
            taskInput.focus();
            editButton.style.display = "none";
            saveButton.style.display = "inline-block";
        });

        saveButton.addEventListener("click", function () {
            taskInput.setAttribute("readonly", true);
            editButton.style.display = "inline-block";
            saveButton.style.display = "none";

            const newTaskText = taskInput.value.trim();
            if (newTaskText !== "") {
                const taskId = taskItem.dataset.task;
                editTaskName(taskId, newTaskText);
            }
        });

        deleteButton.addEventListener("click", function () {
            const taskId = taskItem.dataset.task;
            taskItem.remove();
            deleteTask(taskId);
        });
    }

    function editTaskName(taskId, newTaskText) {
        fetch("tasks.php?task_name=" + encodeURIComponent(taskId), {
            method: "PUT",
            body: JSON.stringify({ new_task_name: newTaskText }),
            headers: {
                "Content-Type": "application/json",
            },
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.message) {
                    console.log(data.message);
                    const taskItem = document.querySelector(`li[data-task="${taskId}"]`);
                    if (taskItem) {
                        taskItem.querySelector("input[type='text']").value = newTaskText;
                    }
                } else if (data.error) {
                    console.error(data.error);
                }
            });
    }

    function addTaskToServer(taskText) {
        fetch("tasks.php", {
            method: "POST",
            body: JSON.stringify({ task_name: taskText }),
            headers: {
                "Content-Type": "application/json",
            },
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.message) {
                    console.log(data.message);
                    getTasks();
                } else if (data.error) {
                    console.error(data.error);
                }
            });
    }

    function deleteTask(taskId) {
        fetch("tasks.php?id=" + taskId, {
            method: "DELETE",
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.message) {
                    console.log(data.message);
                    const taskItem = document.querySelector(`li[data-task="${taskId}"]`);
                    if (taskItem) {
                        taskItem.remove();
                    }
                } else if (data.error) {
                    console.error(data.error);
                }
            });
    }

    // Handle checkbox change event
    taskList.addEventListener("change", function (e) {
        if (e.target && e.target.classList.contains("task-checkbox")) {
            const taskId = e.target.closest(".task").dataset.task;
            const completed = e.target.checked;

            updateTaskStatus(taskId, completed);
        }
    });

    function updateTaskStatus(taskId, completed) {
        fetch("tasks.php?id=" + encodeURIComponent(taskId), {
            method: "PUT",
            body: JSON.stringify({ is_completed: completed ? 1 : 0 }),
            headers: {
                "Content-Type": "application/json",
            },
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.message) {
                    console.log(data.message);
                } else if (data.error) {
                    console.error(data.error);
                }
            });
    }

    getTasks();

    taskForm.addEventListener("submit", function (e) {
        e.preventDefault();

        const taskText = newTaskInput.value.trim();

        if (taskText !== "") {
            addTaskToServer(taskText);
            newTaskInput.value = "";
        }
    });

    clearSearchButton.addEventListener("click", function () {
        searchInput.value = "";
        const tasks = document.querySelectorAll(".task");

        tasks.forEach(function (task) {
            task.style.display = "flex";
        });
    });

    searchInput.addEventListener("input", function () {
        const searchValue = searchInput.value.toLowerCase();
        const tasks = document.querySelectorAll(".task");

        tasks.forEach(function (task) {
            const taskText = task.querySelector("input[type='text']").value.toLowerCase();
            if (taskText.includes(searchValue)) {
                task.style.display = "flex";
            } else {
                task.style.display = "none";
            }
        });
    });
});
