'use strict'

import Cookies from 'js-cookie';

const token = Cookies.get('token');
const BASE_URL = "https://api.clotthy.com/api";
const cartId = localStorage.getItem("cartId");
const btn = document.querySelectorAll('.btn');
const btnAmount = document.querySelectorAll('.quantity-field');
const productId = document.querySelector('#productId');

btn.forEach((item) => {
    item.addEventListener('click', deleteItem);
});

btnAmount.forEach((item) => {
    item.addEventListener('change', addItem);
    item.addEventListener('keypress', disableKeyboard);
    item.addEventListener('keydown', disableKeyboard);
    item.addEventListener('keyup', disableKeyboard);
});

function disableKeyboard(e){
    e.preventDefault();
    return false;
}

async function addItem(e){
    e.preventDefault();
    
    if(!token){
        alert("Vuelve a iniciar sesión");
    } else {
        const data = JSON.stringify({
            'id_prod_cart': parseInt(productId.value),
            'prod_amount': e.currentTarget.value,
        });
        const config = setData('PUT', data, token);

        try {
            disableBtn(btnAmount, true, 'not-allowed');
            await fetch(`${BASE_URL}/cart/${cartId}`, config)
            .then(res => {
                if(res.status == '400'){
                    return new Promise.resolve({ 'error':  'Hubo un error al actualizar el producto, intentalo de nuevo'});
                }

                return res.json();
            })
            .then(res => {
                if(res.error){
                    let message = res.error;
                    alert(message);
                }

                document.location.reload();
            });

        } catch(error){
            alert("Hubo un error, intentalo de nuevo");
        }
    }
}

async function deleteItem(e){
    e.preventDefault();

    if(!token){
        alert("Vuelve a iniciar sesión");
    } else {
        const data = JSON.stringify({ 'id_prod_cart': parseInt(productId.value) });
        const config = setData('PATCH', data, token);

        try {
            disableBtn(btn, true, 'not-allowed');

            await fetch(`${BASE_URL}/cart/${cartId}`, config)
            .then(res => res.json())
            .then(res => {
                if(res.message){
                    let message = res.message;
                    alert(message);
                    document.location.reload();
                } else {
                    alert("Hubo un error, intentalo de nuevo");
                }
            })

        } catch(error){
            alert("Hubo un error, intentalo de nuevo");
        }
    }
}

function setData(method, data, token){
    return {
        method,
        body: data,
        headers: {
            "Content-type": "application/json;charset=UTF-8",
            'Authorization': `Bearer ${token}`
        } 
    };
}

function disableBtn(btn, disable, cursor, text=""){
    btn.forEach((item) => {
        item.disabled = disable;
        item.style.cursor = cursor;
        if(text) item.value = text;
    });
}

disableBtn(btn, false, 'pointer');
disableBtn(btnAmount, false, 'default');