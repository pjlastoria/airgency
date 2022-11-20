let modalBg = document.getElementsByClassName('modal-bg')[0];
let modalForm = document.getElementById('project-modal-form');
let modalTitle = document.getElementsByClassName('project-modal-title')[0];
let modalActions = document.getElementsByClassName('actions')[0];
let viewProjectModal = document.getElementsByClassName('view-project')[0];
let deleteProjectModal = document.getElementsByClassName('delete-task')[0];
deleteProjectModal.style.display = 'none';

let deleteProjectBtn = document.getElementById('delete-project-btn');
let cancelDelete = document.getElementById('cancel-delete');

let idInput = document.getElementById('project-id');
let deleteInput = document.getElementById('delete');
let tmp;

let projectCards = document.getElementsByClassName('project-card');
projectCards = Array.prototype.slice.call(projectCards);

modalBg.addEventListener('click', hideModal);

deleteProjectBtn.addEventListener('click', (e) => {
    deleteInput.value = tmp.id;

    deleteProjectModal.style.display = '';
    viewProjectModal.style.display = 'none';
});

projectCards.forEach(card => {
    card.addEventListener('click', (e) => {

        let cardEle = e.target;
        let modalDescription; //for now im attaching the full description to the data attr
        if(!cardEle.classList.contains('project-card')) {
            cardEle = e.target.parentNode;
        }

        modalBg.classList.add('show');
        deleteProjectModal.style.display = 'none';
        viewProjectModal.style.display = '';

        tmp = cardEle.cloneNode(true);
        modalDescription = tmp.dataset.description;
        tmp.classList.remove('project-card');
        tmp.classList.add('active-card');

        tmp.getElementsByClassName('project-description')[0].innerHTML = modalDescription;
        modalTitle.innerHTML = tmp.getElementsByClassName('project-title')[0].innerHTML;
        idInput.value = tmp.id;
        tmp.getElementsByClassName('project-title')[0].innerHTML = '';

        modalForm.insertBefore(tmp, modalActions);
    });
});

function hideModal(e) {
    if(e.target === modalBg || e.target === cancelDelete) {
        modalBg.classList.remove('show')
        tmp.remove();
    }
}