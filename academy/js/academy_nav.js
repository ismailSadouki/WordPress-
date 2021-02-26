jQuery(document).ready(function ($) {
    // navicon show & hide functionality
    $('#navicon').click(function (e) {
        e.preventDefault();
        if ($('#menu-bar').hasClass('active')) {
            $('.menu-bar').css('display', 'none');
            $('#menu-bar').removeClass('active');
            $('#menu-bar').attr('aria-expanded', 'false');
            $('#navicon').removeClass('fa-close').addClass('fa-navicon');
            $("body").css("overflow", "auto");
        } else {
            $('#menu-bar').addClass('active');
            $('.menu-bar').css('display', 'block');
            $('#menu-bar').attr('aria-expanded', 'true');
            $('#navicon').removeClass('fa-navicon').addClass('fa-close');
            $("body").css("overflow", "hidden");
        }
    });
    $('html').click(function(e) {
        var a = e.target;
        if (!$(a).is('#navicon') && !$(a).parents('#primary-menu').length >0 && $('#navicon').hasClass('fa-close') ) {
          $('#menu-bar').removeClass('active'); //hide menu item
          $('.menu-bar').css('display', 'none');
          $('#menu-bar').attr('aria-expanded', 'false');
          $('#navicon').removeClass('fa-close').addClass('fa-navicon');
          $("body").css("overflow", "auto");
       }
      });
    // remove the parent styling when we have a mobile or tablet screen size
    if ($(window).width() > 950 ) {
        $('#site-navigation').addClass('main-navigation');
    } else if ($(window).width() < 950 ) {
        $('#site-navigation').removeClass('main-navigation');
    }
    // hide or show menu bar according to screen size
    $(window).resize(function () {
        if ($(window).width() > 950) {
            $('.menu-bar').css('display', 'block');
            $('#site-navigation').addClass('main-navigation');
        } else if ($(window).width() < 950 && !$('#menu-bar').hasClass('active')) {
            $('.menu-bar').css('display', 'none');
            $('#site-navigation').removeClass('main-navigation');
        } else if ($(window).width() < 950 && $('#menu-bar').hasClass('active')) {
            $('.menu-bar').css('display', 'block');
            $('#site-navigation').removeClass('main-navigation');
    }
    });
  
  
    var parent = $('.menu-item-has-children').children('a');
      $(parent).click(function (e) {
           if ($('#menu-bar').hasClass('active')){
          e.preventDefault(); 
         // get the child of the clicked menu item
          var child_menu = $(this).parent().children('ul');
          // check if it's currently open or closed
          if (child_menu.hasClass('childopen')) {
              // hide child menu
              $(child_menu).removeClass('childopen');
              $(this).removeClass('open');
          } else {
              //show correct child menu
              $(child_menu).addClass('childopen');
              $(this).addClass('open');
              
          }
      }
      });
  
  });