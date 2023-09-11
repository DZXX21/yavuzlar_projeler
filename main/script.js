<script>
    const taskForm = document.getElementById("task-form");
    const newTaskInput = document.getElementById("new-task");
    const taskList = document.getElementById("task-list");

    taskForm.addEventListener("submit", function (e) {
        e.preventDefault();

        const taskText = newTaskInput.value.trim();

        if (taskText !== "") {
            const taskItem = document.createElement("li");
            taskItem.className = "task";
            taskItem.innerHTML = `
                <input type="text" value="${taskText}" readonly>
                <button class="edit">Düzenle</button>
                <button class="delete">Sil</button>
            `;
            
            taskList.appendChild(taskItem);
            newTaskInput.value = "";

            const editButton = taskItem.querySelector(".edit");
            const deleteButton = taskItem.querySelector(".delete");
            const taskInput = taskItem.querySelector("input");

            editButton.addEventListener("click", function () {
                taskInput.removeAttribute("readonly");
                taskInput.focus();
            });

            taskInput.addEventListener("blur", function () {
                taskInput.setAttribute("readonly", true);
            });

            taskInput.addEventListener("keydown", function (e) {
                if (e.key === "Enter") {
                    taskInput.setAttribute("readonly", true);
                }
            });

            deleteButton.addEventListener("click", function () {
                taskItem.remove();
            });
        }
    });
</script>
