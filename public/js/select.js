/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!********************************!*\
  !*** ./resources/js/select.js ***!
  \********************************/
$(document).ready(function () {
  var trigger = $('main .compra div .controles .select');
  trigger.each(function () {
    var span = $(this).find('span');
    var elementos = $(this).find('ul li');
    $(this).click(function () {
      $(this).children('ul').slideToggle();
    });
    elementos.each(function (i, item) {
      $(item).click(function (e) {
        var text = e.currentTarget.textContent;
        var parent_id = e.currentTarget.parentNode.parentNode.id;

        if (parent_id === 'talla') {
          span.text('Talla ' + text);
        } else if (parent_id === 'color') {
          span.text('Color ' + text);
        }
      });
    });
  });
});
/******/ })()
;