$(document).ready(function(){
  const size = localStorage.getItem('size');
  const color = localStorage.getItem('color');
  var trigger = $('main .compra div .controles .select');

  function getPrefs(stored, element, text){
    if(stored){
      const json = JSON.parse(stored);
      const parent = element.parent()[0].id;

      if(parent == json.type){
        element.text(`${text} ${json.text}`);
      }
    }
  }

  trigger.each(function(){
    let span = $(this).find('span');
    let elementos = $(this).find('ul li');

    getPrefs(size, span, 'Talla');
    getPrefs(color, span, 'Color');

    $(this).click(function(){
      $(this).children('ul').slideToggle();
    });

    elementos.each(function(i, item){
      $(item).click(function(e){
        let text = e.currentTarget.textContent;
        let parent_id = e.currentTarget.parentNode.parentNode.id;

        if(parent_id === 'talla'){
          span.text('Talla ' + text);
          localStorage.setItem('size', JSON.stringify({ type: parent_id, text }));

        } else if(parent_id === 'color'){
          span.text('Color ' + text);
          localStorage.setItem('color', JSON.stringify({ type: parent_id, text }));
        }
      });
    });
  });
});
