/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!********************************!*\
  !*** ./resources/js/efecto.js ***!
  \********************************/
$(document).ready(function () {
  $('a[href^="#"]').click(function () {
    var destino = $(this.hash);

    if (destino.length == 0) {
      destino = $('a[name="' + this.hash.substr(1) + '"]');
    }

    if (destino.length == 0) {
      destino = $('html');
    }

    $('html, body').animate({
      scrollTop: destino.offset().top
    }, 1000);
    return false;
  });
});
/******/ })()
;