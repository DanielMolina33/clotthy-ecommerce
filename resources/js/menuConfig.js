$(document).ready(function(){
  let sn = window.matchMedia('(min-width: 700px)');
  efects(sn);
  sn.addListener(efects);

  function efects(sn){
    if(sn.matches == false){
      $('.menu_bar span').Menu({
        navbar: $('nav'),
        openMenuColor: '#0286C9',
        menuColorClosed: '#fff',
        submenu: true
      });
    } else {
      $('.menu_bar span').Menu({
        navbar: $('nav'),
        openMenuColor: '#0286C9',
        menuColorClosed: '#fff',
        submenu: false
      });
    }
  }
});
