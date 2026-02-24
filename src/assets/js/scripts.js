(function ($) {
  $(function () {
    'use strict';


    function randomFromArray(array, not) {
      var randomColor = array[Math.floor(Math.random()*array.length)];

      while (not && array.length > 1 && randomColor === not) {
        randomColor = array[Math.floor(Math.random() * array.length)];
      }

      return randomColor;
    }



    //----- Change color
    var $homeBodyEl = $('body.home');
    var $navEl = $('.nav');
    var $mobMenuEl = $(".mob-menu");

    if ($homeBodyEl.length > 0) {
      var $headerEl = $('.header');
      var $subPageMenuEl = $('.sub-page-menu');
      var $postHoverBoxEl = $('.post-hover-box');
      var previousColor = null;
      var colorArray = [
        '#35A270',
        '#7592E6',
        '#B29776',
        '#F47A4E'
      ];

      function changeHomeColor() {
        var randomColor = randomFromArray(colorArray, previousColor);
        previousColor = randomColor;

        if (randomColor == '#35A270') {
          var rgbaRandom = 'rgba(53, 162, 112, 0.95)';
        }

        if (randomColor == '#7592E6') {
          var rgbaRandom = 'rgba(117, 146, 230, 0.95)';
        }

        if (randomColor == '#B29776') {
          var rgbaRandom = 'rgba(178, 151, 118, 0.95)';
        }

        if (randomColor == '#F47A4E') {
          var rgbaRandom = 'rgba(244, 122, 78, 0.95)';
        }

        $homeBodyEl.css("background-color", randomColor);
        $navEl.css("background-color", randomColor);
        $headerEl.css("background-color", randomColor);
        $subPageMenuEl.css("background-color", randomColor);
        $postHoverBoxEl.css("background-color", rgbaRandom);
        $mobMenuEl.css("background-color", rgbaRandom);
      }

      if (window.matchMedia('(pointer:coarse)').matches) {
        setInterval(changeHomeColor, 4000);
      } else {
        $('.post-feed .col-f-1-3').mouseenter(changeHomeColor)
      }
    }



    // ------------------- Menu

    $(".left-menu").click(function(){
      $navEl.toggleClass('active');
    });

    $mobMenuEl.click(function(){
      $navEl.toggleClass('active');
    });

    $(".meny-cross").click(function(){
      $navEl.toggleClass('active');
    });



    // -------------- Form label animation

    var $wpc7Form = $('.wpcf7');

    if ($wpc7Form) {
      var $wpc7Input = $wpc7Form.find('input');
      var $wpc7Textarea = $wpc7Form.find('textarea');

      $wpc7Input.focus(function(){
        $(this).parents('.input-outer div').addClass('focused');
      });

      $wpc7Input.blur(function(){
        var inputValue = $(this).val();
        if ( inputValue == "" ) {
          $(this).removeClass('filled');
          $(this).parents('.input-outer div').removeClass('focused');
        } else {
          $(this).addClass('filled');
        }
      });

      $wpc7Textarea.focus(function(){
        $(this).parents('.input-outer div').addClass('focused');
      });

      $wpc7Textarea.blur(function(){
        var inputValue = $(this).val();
        if ( inputValue == "" ) {
          $(this).removeClass('filled');
          $(this).parents('.input-outer div').removeClass('focused');
        } else {
          $(this).addClass('filled');
        }
      });
    }

    // var sections = $('section')
    // var nav_height = $navEl.outerHeight();

    // $(window).on('scroll', function () {
    //   var cur_pos = $(this).scrollTop();

    //   sections.each(function() {
    //     var top = $(this).offset().top - nav_height,
    //     bottom = top + $(this).outerHeight();

    //     if (cur_pos >= top && cur_pos <= bottom) {
    //       $navEl.find('a').removeClass('menu-active').addClass('menu-inactive');
    //       sections.removeClass('active');

    //       $(this).addClass('active');
    //       $navEl.find('a[href="#'+$(this).attr('id')+'"]').addClass('menu-active').removeClass('menu-inactive');
    //     }
    //   });
    // });

    $navEl.find('a').on('click', function (e) {
      var linkHref = $(this).attr('href');
      var id = linkHref.startsWith('#') ? linkHref : false;

      if (id) {
        e.preventDefault();
        $('html, body').animate({
          scrollTop: $(id).offset().top - nav_height
        }, 500);
      }
    });



    if (window.location.href.indexOf("/sv/") > -1) {
      $( document ).ready(function() {
        $('.cd-upload-btn').text('Ladda upp');
      });
    } else {
      $( document ).ready(function() {
        $('.cd-upload-btn').text('Upload');
      });
    }

    $('.open-dd').on('click', function() {
      $('.main-dd').slideToggle();
    })

    $('.filter-tags').on('click', function() {
      var id = "." + $(this).attr('id');

      if (id === 'all') {
        $('.post-boxes').addClass('active')
      } else {
        $('.post-boxes').removeClass('active');
        $(id).addClass('active');
      }
    })



    // ------- add submit symbol contact form

    $(".wpforms-submit ").append('<img src="/wp-content/uploads/2021/03/Pil.svg" />');
    $(".cmApp_formSubmitButton ").append('<img src="/wp-content/uploads/2021/03/Pil.svg" />')
  });

})(jQuery, this);
