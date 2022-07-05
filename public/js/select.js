/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!********************************!*\
  !*** ./resources/js/select.js ***!
  \********************************/
$(document).ready(function () {
  var size = localStorage.getItem('size');
  var color = localStorage.getItem('color');
  var trigger = $('main .compra div .controles .select');

  function getPrefs(stored, element, text) {
    if (stored) {
      var json = JSON.parse(stored);
      var parent = element.parent()[0].id;

      if (parent == json.type) {
        element.text("".concat(text, " ").concat(json.text));
      }
    }
  }

  trigger.each(function () {
    var span = $(this).find('span');
    var elementos = $(this).find('ul li');
    getPrefs(size, span, 'Talla');
    getPrefs(color, span, 'Color');
    $(this).click(function () {
      $(this).children('ul').slideToggle();
    });
    elementos.each(function (i, item) {
      $(item).click(function (e) {
        var text = e.currentTarget.textContent;
        var parent_id = e.currentTarget.parentNode.parentNode.id;

        if (parent_id === 'talla') {
          span.text('Talla ' + text);
          localStorage.setItem('size', JSON.stringify({
            type: parent_id,
            text: text
          }));
        } else if (parent_id === 'color') {
          span.text('Color ' + text);
          localStorage.setItem('color', JSON.stringify({
            type: parent_id,
            text: text
          }));
        }
      });
    });
  });
});
/******/ })()
;