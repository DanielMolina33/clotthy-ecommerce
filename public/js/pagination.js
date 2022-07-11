/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!************************************!*\
  !*** ./resources/js/pagination.js ***!
  \************************************/
var inputPage = document.querySelector("#inputPage");
var prevPage = document.querySelector("#prevPage");
var nextPage = document.querySelector("#nextPage");
inputPage.addEventListener('change', changePage);
inputPage.addEventListener('keyup', isNumber);
prevPage.addEventListener('click', setPage);
nextPage.addEventListener('click', setPage);

function isNumber(e) {
  var value = e.target.value;

  if (value == "") {
    e.preventDefault();
    return false;
  } else {
    changePage(e, value);
  }
}

function setPage(e) {
  e.preventDefault();
  var id = e.target.id;
  var page = id == "prevPage" ? e.target.dataset.prev : e.target.dataset.next;
  value = page ? page.replace("?page=", "") : 1;
  changePage(e, value);
}

function changePage(e, value) {
  e.preventDefault();
  var url = new URL(window.location.href);
  url.searchParams.set('page', value ? value : e.target.value);
  window.location.href = url;
}
/******/ })()
;