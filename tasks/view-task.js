let taskContainers = document.getElementsByClassName('task-wrapper');
taskContainers = [].slice.call(taskContainers);

let modalBg = document.getElementsByClassName('modal-bg')[0];
let modal = document.getElementsByClassName('modal')[0];

let addBtn = document.getElementsByClassName('top-add-btn')[0];

let taskModalBg = document.getElementsByClassName('task-modal-bg')[0];
let viewTaskModal = document.getElementsByClassName('view-task')[0];
let deleteTaskModal = document.getElementsByClassName('delete-task')[0];
deleteTaskModal.style.display = 'none';

//TASK VIEW MODAL ELEMENTS
let taskId = document.getElementById('task-id');
let deleteInput = document.getElementById('delete');
let taskDesc = document.getElementById('task-description');
let subtaskLegend = document.getElementsByClassName('task-legend')[0];
let noSubtasksMsg = document.getElementsByClassName('no-subtasks-msg')[0];
let subtaskField = document.getElementById('subtask-field');
//note: subtask elements will be created if there are any
let taskStatusInputs = document.querySelectorAll('#task-status input');
let taskStatusObj = {};
let taskData;
//turn taskStatusObj into {'To Do': inputElement, 'Doing': inputElement, 'Done': inputElement, 'Backlog': inputElement} 
taskStatusInputs = taskStatusInputs.forEach(ele => taskStatusObj[ele.defaultValue] = ele);

let deleteTaskBtn = document.getElementById('delete-task-btn');
let deleteFromDB = document.getElementById('delete-from-db');
let cancelDelete = document.getElementById('cancel-delete');

addBtn.addEventListener('click', showAddModal);
modalBg.addEventListener('click', hideAddModal);

taskModalBg.addEventListener('click', hideModal);
taskContainers.forEach(ele => {
    ele.addEventListener('click', showTaskModal);
});

deleteTaskBtn.addEventListener('click', (e) => {
    deleteInput.value = taskData.id;

    deleteTaskModal.style.display = '';
    viewTaskModal.style.display = 'none';
});

function showAddModal() {
    modalBg.classList.add('show');
}

function hideAddModal(e) {
    e.target === modalBg ? 
    modalBg.classList.remove('show') : null ;
    
}

function showTaskModal(e) {
    taskModalBg.classList.add('show');
    let taskClicked = e.target;

    if(!taskClicked.classList.contains('task-wrapper')) {
        taskClicked = taskClicked.parentNode;
    }
    deleteTaskModal.style.display = 'none';

    viewTask(taskClicked);
}

function hideModal(e) {

    if(e.target === taskModalBg || e.target === cancelDelete) {
        taskModalBg.classList.remove('show');
        noSubtasksMsg.style.display = '';
        viewTaskModal.style.display = '';
        subtaskLegend.style.display = 'none';
        removeSubtasks();
        
    }
    
}

function viewTask(task) {
    let subtaskCount = 0;
    taskData = Object.assign({}, task.dataset);
    taskData['status'] = task.parentNode.dataset.status;//no sense in adding status on html element when its available on the parent


    taskId.value = taskData.id;
    taskDesc.innerHTML = taskData.task;
    taskStatusObj[taskData['status']].checked = true;

    if(taskData['subtaskjson'] != 'No Subtasks') {
        
        noSubtasksMsg.style.display = 'none';
        subtaskLegend.style.display = '';

        subtaskCount = makeSubtasks(JSON.parse(taskData.subtaskjson));
        subtaskLegend.innerHTML = getCountText(subtaskCount);

    }

}

function makeSubtasks(subtaskData) {
    let count = 0;

    for(let i in subtaskData) {
        
        let subTaskEle = document.createElement('label');
        subTaskEle.classList.add('subtask-view');
        subTaskEle.innerHTML = subtaskData[i]['subtask_text'];

        let subTask = document.createElement('input');
        subTask.setAttribute("type", "hidden");
        subTask.setAttribute("name", "subtask[]");
        subTask.value = i;

        let subTaskCheckbox = document.createElement('input');
        subTaskCheckbox.setAttribute("type", "checkbox");
        subTaskCheckbox.setAttribute("name", "checked_subtasks[]");
        subTaskCheckbox.setAttribute("value", i);
        if(subtaskData[i]['done'] == 1) { subTaskCheckbox.checked = 'checked'; }

        let checkmark = document.createElement('span');
        checkmark.classList.add('checkmark');

        subTaskEle.  appendChild(subTask);
        subTaskEle.  appendChild(subTaskCheckbox);
        subTaskEle.  appendChild(checkmark);
        subtaskField.appendChild(subTaskEle);
        count++;
    }

    return count;
    
}

function removeSubtasks() {
    while (subtaskField.children.length > 2) {
        subtaskField.removeChild(subtaskField.lastChild);
    }
}

function getCountText(subtaskCount) {

    let subtaskCountText = '1 Subtask';

    if(subtaskCount > 1) {
        subtaskCountText = subtaskCount + ' Subtasks';
    }
    return subtaskCountText;
}