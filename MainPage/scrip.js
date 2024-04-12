$(document).ready(function() {
  if ($(window).width() > 600) {
    $('.nav__item_special').hide();
    $('.nav__list').show();
   
  }

  if ($(window).width() < 600) {
    $('.nav__item_special').show();
    $('.nav__list').hide();
  }

  
    $(window).resize(function() {
      if ($(window).width() > 600) {
        $('.nav__item_special').hide();
        $('.nav__list').show();
       

      }
    });

    $(window).resize(function() {
        if ($(window).width() < 600) {
          $('.nav__item_special').show();
          $('.nav__list').hide();
        }
      });
  });