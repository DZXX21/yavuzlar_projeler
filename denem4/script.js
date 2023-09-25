document.addEventListener("DOMContentLoaded", function () {
    const savedTasks = JSON.parse(localStorage.getItem("tasks")) || [];

    savedTasks.forEach(function (task) {
        addTaskToList(task.text, task.completed);
    });
});

const taskForm = document.getElementById("task-form");
const newTaskInput = document.getElementById("new-task");
const taskList = document.getElementById("task-list");
const searchInput = document.getElementById("search-input");
const clearSearchButton = document.getElementById("clear-search-button");

function addTaskToList(taskText, completed = false) {
    const taskItem = document.createElement("li");
    taskItem.className = "task";
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
    });

    deleteButton.addEventListener("click", function () {
        taskItem.remove();
        const savedTasks = JSON.parse(localStorage.getItem("tasks")) || [];
        const taskIndex = savedTasks.findIndex(task => task.text === taskText);
        if (taskIndex !== -1) {
            savedTasks.splice(taskIndex, 1);
            localStorage.setItem("tasks", JSON.stringify(savedTasks));
        }
    });

    taskCheckbox.addEventListener("change", function () {
        if (taskCheckbox.checked) {
            taskInput.setAttribute("readonly", true);
            taskItem.classList.add("completed");
            taskInput.style.textDecoration = "line-through";
            taskInput.removeAttribute("readonly");
            taskItem.classList.remove("completed");
            taskInput.style.textDecoration = "none"; 
        }
        
        const savedTasks = JSON.parse(localStorage.getItem("tasks")) || [];
        const taskIndex = savedTasks.findIndex(task => task.text === taskText);
        if (taskIndex !== -1) {
            savedTasks[taskIndex].completed = taskCheckbox.checked;
            localStorage.setItem("tasks", JSON.stringify(savedTasks));
        }
    });
}

taskForm.addEventListener("submit", function (e) {
    e.preventDefault();

    const taskText = newTaskInput.value.trim();

    if (taskText !== "") {
        addTaskToList(taskText);

        const savedTasks = JSON.parse(localStorage.getItem("tasks")) || [];
        savedTasks.push({ text: taskText, completed: false });
        localStorage.setItem("tasks", JSON.stringify(savedTasks));

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
