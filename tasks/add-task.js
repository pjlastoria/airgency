let subTaskList = document.getElementById('subtask-list');
let addSubtaskBtn = document.getElementById('add-subtask-btn');

let state = {
    counter: 0
};

addSubtaskBtn.addEventListener('click', (e) => {
    e.preventDefault();
    createSubTaskField();
});

function createSubTaskField() {

    let subTaskContainer = document.createElement('div');
    subTaskContainer.classList.add('subtask');

    let subTaskInput = document.createElement('input');
    subTaskInput.setAttribute("type", "text");
    subTaskInput.setAttribute("name", "subtask[]");//turns multiple inputs with same name into an array on post

    let subTaskDelete = document.createElement('img');
    subTaskDelete.src = "../images/minus-sign.svg";
    subTaskDelete.addEventListener('click', removeSubTaskField);

    subTaskContainer.appendChild(subTaskInput);
    subTaskContainer.appendChild(subTaskDelete);
    subTaskList     .appendChild(subTaskContainer);
}

function removeSubTaskField(e) {
    let clickedEle = e.target.parentNode;
    clickedEle.remove();
}