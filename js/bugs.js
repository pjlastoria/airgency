//FILL INPUTS ON EDIT MODAL WITH CLICKED DATA ROW

let ID = document.getElementById('bug-id');
let deleteInput = document.getElementById('delete');//deleteInput is set inside modal.js
let bugDetails = document.getElementById('bug-desc');

let categoryInputs = document.querySelectorAll('#bug-category input');
let statusInputs = document.querySelectorAll('#bug-status input');

function getData(event) {
 
    let bugReport = event.target;

    if(!bugReport.classList.contains('data-wrapper')) {
        bugReport = bugReport.parentNode;
    }

    displayIdAndDetails(bugReport);
    fillCategoryAndStatusRadioBtns(bugReport);
}

function displayIdAndDetails(report) {
 
    bugData = Object.assign({}, report.dataset);

    ID.value = bugData.id;
    bugDetails.value = bugData.description;
}

function fillCategoryAndStatusRadioBtns(report) {
    let category = report.getElementsByClassName('bug-category')[0].innerHTML.toLowerCase();
    let status =   report.getElementsByClassName('bug-status'  )[0].innerHTML.toLowerCase();

    for(let i = 0; i < categoryInputs.length; i++) {
        if(categoryInputs[i].value === category) {
            categoryInputs[i].checked = true;
        }
    }

    for(let i = 0; i < statusInputs.length; i++) {
        if(statusInputs[i].value === status) {
            statusInputs[i].checked = true;
        }
    }
}