let modalBg = document.getElementsByClassName('modal-bg')[0];
let addModal = document.getElementsByClassName('add')[0];
let editModal = document.getElementsByClassName('edit')[0];//edit-header
let deleteModal = document.getElementsByClassName('delete')[0];
let activeModal;

let addBtn = document.getElementsByClassName('top-add-btn')[0];
let deleteBtn = document.getElementById('delete-btn');
let cancelDelete = document.getElementById('cancel-delete');
let dataWrappers = document.getElementsByClassName('data-wrapper');
dataWrappers = [].slice.call(dataWrappers);
dataWrappers.forEach(ele => {
    ele.addEventListener('click', () => show(editModal) );
    ele.addEventListener('click',  getData);//data is sent to the tab specific js file
});

modalBg.addEventListener('click', hideModal);
cancelDelete.addEventListener('click', hideModal);
addBtn.addEventListener('click', () => show(addModal) );
deleteBtn.addEventListener('click', () => {
    show(deleteModal);
    deleteInput.value = ID.value;
});


function show(modal) {
    if(activeModal && !activeModal.classList.contains('hide')) { activeModal.classList.add('hide') };
    modalBg.classList.remove('hide');
    modal.classList.remove('hide');
    activeModal = modal;
}

function hideModal(e) {

    if(e.target === modalBg || e.target === cancelDelete) {
        modalBg.classList.add('hide');
        activeModal.classList.add('hide');
    }
    
}