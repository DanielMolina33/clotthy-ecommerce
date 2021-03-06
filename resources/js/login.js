'use strict'

import Cookies from 'js-cookie';
import { config } from './config';

const BASE_URL = "https://api.clotthy.com/api";
const btn = document.getElementById('btn');
const btnValue = btn.value;
const form = document.getElementById('form');
form.addEventListener('submit', fetchData);

async function fetchData(e){
    e.preventDefault();
    const formData = new FormData(form);
    formData.append("password_confirmation", formData.get("password"));

    const fetchConfig = {
        method: 'POST',
        body: formData
    }

    try{
        disableBtn(true, 'not-allowed', 'Cargando...');

        await fetch(`${BASE_URL}/signin/customers`, fetchConfig)
        .then(res => res.json())
        .then(res => {
            if(res.message) {
                alert(res.message);
                disableBtn(false, 'pointer', btnValue);
            } else {
                localStorage.setItem("userLogged", JSON.stringify(res));
                setCookie(res.token);
                window.location.href = config.PageUrl;
            }
        })
    } catch(e){
        console.log(e);
        alert("Hubo un error, intentalo de nuevo");
    }
}

function setCookie(token){
    const d = new Date();
    const expires = d.getHours() / 24;
    Cookies.set('token', token, { expires });
}

function disableBtn(disable, cursor, text){
    btn.disabled = disable;
    btn.style.cursor = cursor;
    btn.value = text;
}