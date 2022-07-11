$(document).ready(function(){
  $.fn.extend({
    Menu: function(options){
      let slideSubmenu = 1;
      let slideMenu = 1;

      $(this).click(function(){
        if(slideMenu == 1){
          options.openMenuColor == undefined ? $(this).css('color', '#fff') : $(this).css('color', options.openMenuColor);
          options.navbar.animate({
            left: '0px'
          });
          slideMenu = 0;
        } else {
          options.menuColorClosed == undefined ? $(this).css('color', '#fff') : $(this).css('color', options.menuColorClosed);
          options.navbar.animate({
            left: '-100%'
          });
          slideMenu = 1;
        }
      });

      if(options.submenu){
        $('.submenu').click(function(){
          if(slideSubmenu == 1){
            $(this).find('> span').css('color', '#0286C9');
            slideSubmenu = 0;
          } else {
            slideSubmenu = 1;
            $(this).find('> span').css('color', '#ffffff');
          }

          $(this).children('ul').slideToggle();
        });
      } else {
        $('.submenu').unbind('click');
        options.navbar.removeAttr('style');
        $('.submenu ul').removeAttr('style');
        $('.submenu span').removeAttr('style');
      }
    }
  });
});
