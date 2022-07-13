'use strict'

import { config } from './config';

const BASE_URL = "https://api.clotthy.com/api";
const btn = document.getElementById('btn');
const btnValue = btn.value;
const form = document.getElementById('form');
form.addEventListener('submit', fetchData);

async function fetchData(e){
    e.preventDefault();
    const formData = new FormData(form);
    const fetchConfig = {
        method: 'POST',
        body: formData
    }

    try{
        disableBtn(true, 'not-allowed', 'Cargando...');

        await fetch(`${BASE_URL}/password/forgot/customers`, fetchConfig)
        .then(res => res.json())
        .then(res => {
            if(res.message) {
                alert(res.message);
                disableBtn(false, 'pointer', btnValue);
                if(res.message == 'Correo electronico enviado correctamente'){
                    window.location.href = `${config.PageUrl}/login`;
                }
            } else {
                alert("Hubo un error, intentalo de nuevo");
            }
        })
    } catch(e){
        console.log(e);
        alert("Hubo un error, intentalo de nuevo");
    }
}

function disableBtn(disable, cursor, text){
    btn.disabled = disable;
    btn.style.cursor = cursor;
    btn.value = text;
}