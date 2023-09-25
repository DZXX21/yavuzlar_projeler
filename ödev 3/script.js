document.addEventListener("DOMContentLoaded", function () {
    const taskInput = document.getElementById("task");
    const addTaskButton = document.getElementById("add-task");
    const taskList = document.getElementById("task-list");
    const searchInput = document.getElementById("search"); // Arama kutusu
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
            const taskId = e.target.dataset.id;
            if (e.target.dataset.editing !== "true") {
                toggleTaskStatus(taskId);

                // Checkbox işaretlendiğinde "Görev Yapıldı" görünümünü değiştirin
                const checkbox = e.target.querySelector(".completed-checkbox");
                checkbox.checked = !checkbox.checked;
                e.target.classList.toggle("completed");
            }
        }
        if (e.target && e.target.classList.contains("delete")) {
            const taskId = e.target.dataset.id;
            deleteTask(taskId);
        }
        if (e.target && e.target.classList.contains("edit")) {
            const taskId = e.target.dataset.id;
            editTask(taskId);
        }
    });

    taskList.addEventListener("blur", function (e) {
        if (e.target && e.target.classList.contains("task") && e.target.dataset.editing === "true") {
            const taskId = e.target.dataset.id;
            const newTaskName = e.target.textContent.trim();
            editTask(taskId, newTaskName);
        }
    });

    // Arama kutusuna yazıldığında görevleri filtrele
    searchInput.addEventListener("input", function () {
        const searchTerm = searchInput.value.trim().toLowerCase();
        filterTasks(searchTerm);
    });

    function loadTasks() {
        fetch("tasks.php")
            .then((response) => response.json())
            .then((data) => {
                taskList.innerHTML = "";
                data.forEach((task) => {
                    const listItem = document.createElement("li");
                    listItem.innerHTML = `
                        <div class="task">
                            <input type="checkbox" class="custom-control-input completed-checkbox" id="task-${task.id}" ${task.task_status ? 'checked' : ''}>
                            <label class="custom-control-label task-label ${task.task_status ? 'completed' : ''}" for="task-${task.id}" data-id="${task.id}" data-editing="false">${task.task_name}</label>
                        </div>
                        <div class="buttons">
                            <button class="btn btn-danger delete" data-id="${task.id}">Sil</button>
                            <button class="btn btn-warning edit" data-id="${task.id}">Düzenle</button>
                        </div>
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

    function editTask(taskId, taskText = null) {
        if (taskText === null) {
            // Düzenlemeyi başlat
            const taskElement = document.querySelector(`[data-id="${taskId}"]`);
            taskElement.contentEditable = "true";
            taskElement.focus();
            taskElement.dataset.editing = "true";
        } else {
            // Düzenlemeyi kaydet
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
    }

    function filterTasks(searchTerm) {
        const tasks = document.querySelectorAll(".task-label");
        tasks.forEach((task) => {
            const taskText = task.textContent.trim().toLowerCase();
            if (taskText.includes(searchTerm)) {
                task.closest("li").style.display = "block";
            } else {
                task.closest("li").style.display = "none";
            }
        });
    }

   // Arama kutusuna yazıldığında görevleri filtrele
searchInput.addEventListener("input", function () {
    const searchTerm = searchInput.value.trim().toLowerCase();
    filterTasks(searchTerm);
});

function filterTasks(searchTerm) {
    const tasks = document.querySelectorAll(".task-label");
    tasks.forEach((task) => {
        const taskText = task.textContent.trim().toLowerCase();
        if (taskText.includes(searchTerm)) {
            task.closest("li").style.display = "block";
        } else {
            task.closest("li").style.display = "none";
        }
    });
}

});
