document.addEventListener("DOMContentLoaded", function () {
    const taskForm = document.getElementById("task-form");
    const newTaskInput = document.getElementById("new-task");
    const taskList = document.getElementById("task-list");
    const searchInput = document.getElementById("search-input");
    const clearSearchButton = document.getElementById("clear-search-button");

    // Sunucudan görevleri getiren fonksiyon
    function getTasks() {
        fetch("tasks.php", {
            method: "GET",
        })
            .then((response) => response.json())
            .then((data) => {
                // Görevleri listeye ekle
                taskList.innerHTML = ""; // Önceki görevleri temizle
                data.forEach((task) => {
                    addTaskToList(task.task_name, task.task_status, task.id);
                });
            });
    }

    // Görev listesine yeni görev eklemek için fonksiyon
    function addTaskToList(taskText, completed = false, taskId) {
        const taskItem = document.createElement("li");
        taskItem.className = "task";
        taskItem.dataset.task = taskId; // Görevi veri setine ekle
        taskItem.innerHTML = `
            <input type="checkbox" class="task-checkbox" ${completed ? "checked" : ""}>
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

        // Düzenleme, silme ve kaydetme işlevselliği burada eklenir
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
                const taskId = taskItem.dataset.task; // taskId'i al
                editTask(taskId, newTaskText); // düzenlemeyi çağır
            }
        });

        deleteButton.addEventListener("click", function () {
            const taskId = taskItem.dataset.task; // taskId'i al
            taskItem.remove();
            deleteTask(taskId); // silmeyi çağır
        });
    }

    // Görevi sunucuda düzenlemek için fonksiyon
    function editTask(taskId, newTaskText) {
        fetch("tasks.php?id=" + taskId, {
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
                    // Görevi arayüzde güncelle
                    const taskItem = document.querySelector(`li[data-task="${taskId}"]`);
                    if (taskItem) {
                        taskItem.querySelector("input[type='text']").value = newTaskText;
                    }
                } else if (data.error) {
                    console.error(data.error);
                }
            });
    }

    // Görevi sunucuya eklemek için fonksiyon
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
                    addTaskToList(taskText);
                } else if (data.error) {
                    console.error(data.error);
                }
            });
    }

    // Görevi sunucudan silmek için fonksiyon
    function deleteTask(taskId) {
        fetch("tasks.php?id=" + taskId, {
            method: "DELETE",
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.message) {
                    console.log(data.message);
                    // Görevi arayüzden kaldır
                    const taskItem = document.querySelector(`li[data-task="${taskId}"]`);
                    if (taskItem) {
                        taskItem.remove();
                    }
                } else if (data.error) {
                    console.error(data.error);
                }
            });
    }

    // Sayfa yüklendiğinde mevcut görevleri getir
    getTasks();

    taskForm.addEventListener("submit", function (e) {
        e.preventDefault();

        const taskText = newTaskInput.value.trim();

        if (taskText !== "") {
            addTaskToServer(taskText);
            newTaskInput.value = "";
        }
    });

    // Arama işlevselliği ekleniyor
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
    