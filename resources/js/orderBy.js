'use strict'

const details = document.querySelector('#filters');
const checkboxes = document.querySelectorAll(".orderBy");
checkboxes.forEach((item) => {
    const orderBy = localStorage.getItem('order_by');
    item.checked = item.value == orderBy ? true : false;

    item.addEventListener('change', verifyCheckbox);
});

function verifyCheckbox(e){
    const checkbox = e.target;
    
    checkboxes.forEach((item) => {
        if(item != checkbox){
            item.checked = false;
        }
    });
    
    orderBy(checkbox);
}

async function orderBy(checkbox){
    details.open = false;
    details.style.pointerEvents = 'none';

    const url = new URL(window.location.href);
    const value = checkbox.value;
    const checked = checkbox.checked;

    if(checked == false){ 
        url.searchParams.delete('order_by');
        localStorage.removeItem('order_by');
    } else {
        url.searchParams.set('order_by', value);
        localStorage.setItem('order_by', value);
    }

    window.location.href = url;
}