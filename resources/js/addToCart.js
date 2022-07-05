'use strict'

import Cookies from 'js-cookie';

const form = document.getElementById('form');
const btn = document.querySelector('#addToCart');
const btnValue = btn.value;
form.addEventListener('submit', addToCart);

function checkInfo(e){
    const size = localStorage.getItem('size');
    const color = localStorage.getItem('color');
    const prodAmount = document.querySelector('#prodAmount input'); 

    if(!size || !color || !prodAmount.value){
        alert("Debes elegir una talla, un color y una cantidad");
        return false;
    }

    return true;
}

async function addToCart(e){
    e.preventDefault();
    const isInfoOk = checkInfo();
    
    if(isInfoOk){
        const token = Cookies.get('token');
    
        if(!token){
            document.location.href = "http://127.0.0.1:8000/login";
            
        } else {
            const BASE_URL = "https://api.clotthy.com/api"
            const config = setData(token);
    
            try {
                disableBtn(true, 'not-allowed', 'Cargando...');
                await fetch(`${BASE_URL}/cart`, config)
                .then(res => res.json())
                .then(res => {
                    if(res.message){
                        let message = res.message;

                        if(res.message == 'El campo id prod cart ya ha sido tomado.'){
                            message = changeMessage(message, 'Este producto ya se añadió al carrito');
                        }

                        alert(message);
                        disableBtn(false, 'pointer', btnValue);
                    } else {
                        alert("Hubo un error, intentalo de nuevo");
                    }
                })
    
            } catch(error){
                alert("Hubo un error, intentalo de nuevo");
            }
        }
    }
}

function setData(token){
    const data = new FormData(form);

    return {
        method: 'POST',
        body: data,
        headers: {
            'Authorization': `Bearer ${token}`
        } 
    };
}

function changeMessage(text, newText){
    return text[0].replace(text[0], newText);
}

function disableBtn(disable, cursor, text){
    btn.disabled = disable;
    btn.style.cursor = cursor;
    btn.value = text;
}