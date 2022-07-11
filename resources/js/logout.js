'use strict'

import Cookie from 'js-cookie';

const btn = document.querySelector("#logout");
btn.addEventListener('click', logout);

function logout(e){
    e.preventDefault();
    const BASE_URL = "https://api.clotthy.com/api";

    try {
        const token = Cookie.get('token');
        const config = { 
            method: 'GET',
            headers: { 
                'Authorization':  `Bearer ${token}`
            } 
        };

        btn.style.cursor = 'not-allowed';
        btn.style.pointerEvents = 'none';        

        fetch(`${BASE_URL}/logout-customers`, config)
        .then(res => res.json())
        .then(res => {
            if(res == true){
                localStorage.removeItem('userLogged');
                Cookie.remove('token');
                window.location.reload();        
            } else {
                alert("Hubo un error al cerrar sesión, intentalo de nuevo");
            }
        });
    } catch (error){
        alert("Hubo un error al cerrar sesión, intentalo de nuevo");
    }
}