window.addEventListener('load', () => {
    const form = document.querySelector("#new-task-form");
    const input = document.querySelector("#new-task-input");
    const list_el = document.querySelector("#tasks");

    // Mevcut görevleri yerel depolamadan al
    const savedTasks = JSON.parse(localStorage.getItem("tasks")) || [];

    // Kayıtlı görevleri sayfada göster
    savedTasks.forEach((taskText) => {
        addTaskToList(taskText);
    });

    form.addEventListener('submit', (e) => {
        e.preventDefault();

        const task = input.value;

        // Yeni görevi listeye ekle
        addTaskToList(task);

        // Yeni görevi yerel depolamada sakla
        savedTasks.push(task);
        localStorage.setItem("tasks", JSON.stringify(savedTasks));

        input.value = '';
    });

    const searchBox = document.querySelector("#task-filter");
    const filterInput = document.querySelector("#task-filter");

    function filterTasks() {
        const filterText = filterInput.value.toLowerCase();
        const tasks = document.querySelectorAll(".task");

        tasks.forEach((task) => {
            const taskText = task.querySelector(".text").value.toLowerCase();
            if (taskText.includes(filterText)) {
                task.style.display = "flex";
            } else {
                task.style.display = "none";
            }
        });
    }

    searchBox.addEventListener("input", filterTasks);

    function addTaskToList(taskText) {
        const task_el = document.createElement('div');
        task_el.classList.add('task');

        const task_content_el = document.createElement('div');
        task_content_el.classList.add('content');

        task_el.appendChild(task_content_el);

        const task_input_el = document.createElement('input');
        task_input_el.classList.add('text');
        task_input_el.type = 'text';
        task_input_el.value = taskText;
        task_input_el.setAttribute('readonly', 'readonly');

        task_content_el.appendChild(task_input_el);

        const task_actions_el = document.createElement('div');
        task_actions_el.classList.add('actions');

        const task_edit_el = document.createElement('button');
        task_edit_el.classList.add('edit');
        task_edit_el.innerText = 'Düzenle';

        const task_delete_el = document.createElement('button');
        task_delete_el.classList.add('delete');
        task_delete_el.innerText = 'Sil';

        task_actions_el.appendChild(task_edit_el);
        task_actions_el.appendChild(task_delete_el);

        task_el.appendChild(task_actions_el);

        list_el.appendChild(task_el);

        task_edit_el.addEventListener('click', (e) => {
            const task_text_el = task_input_el;
            if (task_text_el.readOnly) {
                task_text_el.readOnly = false;
                task_edit_el.innerText = 'Kaydet';
                task_text_el.focus();
            } else {
                task_text_el.readOnly = true;
                task_edit_el.innerText = 'Düzenle';
            }
        });

        task_delete_el.addEventListener('click', (e) => {
            list_el.removeChild(task_el);

            // Görevi yerel depolamadan kaldır
            const taskIndex = savedTasks.indexOf(taskText);
            if (taskIndex !== -1) {
                savedTasks.splice(taskIndex, 1);
                localStorage.setItem("tasks", JSON.stringify(savedTasks));
            }
        });
    }
});
