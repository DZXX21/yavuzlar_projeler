const inputBox = document.getElementById("input-box");
const listContainer = document.getElementById("list-container");

function addTask() {
    if (inputBox.value == '') {
        alert("You must write something!");
    } else {
        let li = document.createElement("li");
        li.innerHTML = `
            <input type="checkbox">
            <label>${inputBox.value}</label>
            <input type="text">
            <button class="edit" onclick="editTask(this)">Edit</button>
            <button class="delete" onclick="deleteTask(this)">Delete</button>
        `;
        listContainer.appendChild(li);
        inputBox.value = "";
        saveData();
    }
}

listContainer.addEventListener("click", function (e) {
    if (e.target.tagName === "INPUT") {
        e.target.parentElement.classList.toggle("checked");
        saveData();
    }
}, false);

function saveData() {
    localStorage.setItem("data", listContainer.innerHTML);
}

function showTask() {
    listContainer.innerHTML = localStorage.getItem("data");
}

showTask();

function editTask(button) {
    console.log("Edit Task...");
    console.log("Change 'edit' to 'save'");

    var listItem = button.parentElement;

    var editInput = listItem.querySelector('input[type=text]');
    var label = listItem.querySelector("label");
    var containsClass = listItem.classList.contains("editMode");
    // If class of the parent is .editmode
    if (containsClass) {
        // Switch to .editmode
        // Label becomes the input's value.
        label.innerText = editInput.value;
    } else {
        editInput.value = label.innerText;
    }

    // Toggle .editmode on the parent.
    listItem.classList.toggle("editMode");
}

function deleteTask(button) {
    var listItem = button.parentElement;
    listItem.remove();
    saveData();
}
