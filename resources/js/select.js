$(document).ready(function(){
  var trigger = $('main .compra div .controles .select');

  trigger.each(function(){
    let span = $(this).find('span');
    let elementos = $(this).find('ul li');

    $(this).click(function(){
      $(this).children('ul').slideToggle();
    });

    elementos.each(function(i, item){
      $(item).click(function(e){
        let text = e.currentTarget.textContent;
        let parent_id = e.currentTarget.parentNode.parentNode.id;

        if(parent_id === 'talla'){
          span.text('Talla ' + text);

        } else if(parent_id === 'color'){
          span.text('Color ' + text);
        }
      });
    });
  });
});
