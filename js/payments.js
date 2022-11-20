//FILL INPUTS ON EDIT MODAL WITH CLICKED DATA ROW

let ID = document.getElementById('payment-id');// DO NOT CHANGE THESE AS THEY MUST 
let deleteInput = document.getElementById('delete');//MATCH THE VARS IN modal.js

let paymentAmountInput = document.getElementById('payment-amount');
let paymentDescInput =   document.getElementById('payment-desc');
let statusInputs =       document.querySelectorAll('#payment-status input');

function getData(event) {
 
    let paymentInfo = event.target;

    if(!paymentInfo.classList.contains('data-wrapper')) {
        paymentInfo = paymentInfo.parentNode;
    }

    display(paymentInfo);
    fillStatusRadioBtn(paymentInfo);
}

function display(info) {
 
    paymentData = Object.assign({}, info.dataset);

    ID.value =                 paymentData.id;
    paymentAmountInput.value = paymentData.amount;
    paymentDescInput.value =   info.getElementsByClassName('payment-desc')[0].innerHTML;
    
    
}

function fillStatusRadioBtn(info) {

    let status = info.getElementsByClassName('payment-status')[0].innerHTML.toLowerCase();

    for(let i = 0; i < statusInputs.length; i++) {
        if(statusInputs[i].value === status) {
            statusInputs[i].checked = true;
        }
    }
}