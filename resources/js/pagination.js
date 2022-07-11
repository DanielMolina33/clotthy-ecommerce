const inputPage = document.querySelector("#inputPage");
const prevPage = document.querySelector("#prevPage");
const nextPage = document.querySelector("#nextPage");

inputPage.addEventListener('change', changePage);
inputPage.addEventListener('keyup', isNumber);
prevPage.addEventListener('click', setPage);
nextPage.addEventListener('click', setPage);

function isNumber(e){
    const value = e.target.value;
    if(value == ""){
        e.preventDefault();
        return false;
    } else {
        changePage(e, value);
    }
}

function setPage(e){
    e.preventDefault();
    const id = e.target.id;
    let page = id == "prevPage" ? e.target.dataset.prev : e.target.dataset.next;
    value = page ? page.replace("?page=", "") : 1;

    changePage(e, value);
}

function changePage(e, value){
    e.preventDefault();
    const url = new URL(window.location.href);
    url.searchParams.set('page', value ? value : e.target.value);
    window.location.href = url;
}