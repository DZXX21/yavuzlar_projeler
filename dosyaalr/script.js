// JavaScript kodu (script.js)

// HTML içindeki elementleri alma
const inputBox = document.getElementById("input-box");
const listContainer = document.getElementById("list-container");
const searchBox = document.getElementById("search-box");
const clearButton = document.getElementById("clear-button");

// Görev eklemek için fonksiyon
function addTask() {
    const taskText = inputBox.value.trim();

    if (taskText === "") {
        alert("You must write something!");
        return;
    }

    const listItem = document.createElement("li");
    listItem.innerHTML = `
        <label>${taskText}</label>
        <input type="text" class="edit-input">
        <button class="edit">Edit</button>
        <button class="delete">Delete</button>
    `;

    listContainer.appendChild(listItem);
    inputBox.value = "";
    saveData();
}

// Liste öğelerine tıklama işlevi
listContainer.addEventListener("click", function (e) {
    const clickedElement = e.target;

    if (clickedElement.tagName === "INPUT" || clickedElement.tagName === "LABEL") {
        const listItem = clickedElement.parentElement;
        listItem.classList.toggle("checked");
        saveData();
    }
});

// Verileri localStorage'e kaydetme
function saveData() {
    localStorage.setItem("data", listContainer.innerHTML);
}

// Kaydedilmiş verileri gösterme
function showTask() {
    const savedData = localStorage.getItem("data");
    if (savedData) {
        listContainer.innerHTML = savedData;
    }
}

showTask();

// Görev düzenleme işlevi
listContainer.addEventListener("click", function (e) {
    if (e.target.classList.contains("edit")) {
        editTask(e.target);
    }
});

function editTask(button) {
    const listItem = button.parentElement;
    const editInput = listItem.querySelector('input.edit-input');
    const label = listItem.querySelector("label");
    const isEditing = listItem.classList.contains("editMode");

    if (isEditing) {
        // Düzenleme modundan çık
        const editedText = editInput.value.trim();
        if (editedText !== "") {
            label.innerText = editedText;
        }
        button.innerText = "Edit";
    } else {
        // Düzenleme moduna gir
        editInput.value = label.innerText;
        button.innerText = "Save";
    }

    listItem.classList.toggle("editMode");
    saveData();

    // Düzenleme işlemi sonrası input alanını temizle
    editInput.value = "";
}

// Görevi silme işlevi
listContainer.addEventListener("click", function (e) {
    if (e.target.classList.contains("delete")) {
        deleteTask(e.target);
    }
});

function deleteTask(button) {
    const listItem = button.parentElement;
    listItem.remove();
    saveData();
}

// Arama işlevi
function searchTask() {
    const searchText = searchBox.value.trim().toLowerCase();
    const tasks = listContainer.getElementsByTagName("li");

    for (let i = 0; i < tasks.length; i++) {
        const label = tasks[i].getElementsByTagName("label")[0];
        const taskText = label.textContent.toLowerCase();

        if (taskText.includes(searchText)) {
            tasks[i].style.display = "flex"; // Eşleşenleri göster
        } else {
            tasks[i].style.display = "none"; // Eşleşmeyenleri gizle
        }
    }
}

// Arama butonuna tıklamada arama işlevini çağır
const searchButton = document.getElementById("search-button");
searchButton.addEventListener("click", searchTask);

// Arama kutusunu temizlemek ve filtreleri sıfırlamak için
clearButton.addEventListener("click", function () {
    searchBox.value = ""; // Arama kutusunu temizle
    searchTask(); // Arama filtreyi sıfırla
});
