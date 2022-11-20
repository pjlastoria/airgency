//FILL INPUTS ON EDIT MODAL WITH CLICKED DATA ROW

let ID = document.getElementById('client-id');
let deleteInput = document.getElementById('delete');

let clientNameInput =     document.getElementById('client-name');
let clientEmailInput =    document.getElementById('client-email');
let clientReferralInput = document.getElementById('client-referral');
let clientTypeInputs =    document.querySelectorAll('#client-type input');
let statusInputs =        document.querySelectorAll('#client-status input');

function getData(event) {
 
    let clientInfo = event.target;

    if(!clientInfo.classList.contains('data-wrapper')) {
        clientInfo = clientInfo.parentNode;
    }

    display(clientInfo);
    fillRadioBtns(clientInfo);
}

function display(info) {
 
    clientData = Object.assign({}, info.dataset);

    ID.value =            clientData.id;
    clientNameInput.value =     info.getElementsByClassName('client-name')[0].innerHTML;
    clientEmailInput.value =    info.getElementsByClassName('client-email')[0].innerHTML;
    clientReferralInput.value = info.getElementsByClassName('client-referral')[0].innerHTML;
}

function fillRadioBtns(info) {

    let clientType = info.getElementsByClassName('client-type'  )[0].innerHTML.toLowerCase();
    let status =     info.getElementsByClassName('client-status')[0].innerHTML.toLowerCase();

    for(let i = 0; i < clientTypeInputs.length; i++) {
        if(clientTypeInputs[i].value === clientType) {
            clientTypeInputs[i].checked = true;
        }
    }

    for(let i = 0; i < statusInputs.length; i++) {
        if(statusInputs[i].value === status) {
            statusInputs[i].checked = true;
        }
    }
}