(function ($, root, undefined) {
	
	$(function () {
		
		'use strict';
		


//----- Change color

var div = document.getElementsByTagName("body")



// function changeColor() {
//   var colorArray = [
//   '#35A270',
//   '#7592E6',
//   '#B29776',
//   '#F47A4E'
//   ];

//   var randomColor = colorArray[Math.floor(Math.random()*colorArray.length)];
//   console.log(randomColor);

//   document.body.style.background= randomColor;
// }

$('.home .post-feed .col-f-1-3').mouseenter(function() {
  var colorArray = [
  '#35A270',
  '#7592E6',
  '#B29776',
  '#F47A4E'
  ];

  var randomColor = colorArray[Math.floor(Math.random()*colorArray.length)];

  if(randomColor == '#35A270') {
    var rgbaRandom = 'rgba(53, 162, 112, 0.95)';
  }

  if(randomColor == '#7592E6') {
    var rgbaRandom = 'rgba(117, 146, 230, 0.95)';
  }

  if(randomColor == '#B29776') {
    var rgbaRandom = 'rgba(178, 151, 118, 0.95)';
  }

  if(randomColor == '#F47A4E') {
    var rgbaRandom = 'rgba(244, 122, 78, 0.95)';
  }



  //console.log(randomColor);

  document.body.style.background= randomColor;
  $('.nav').css("background-color", randomColor);
  $('.header').css("background-color", randomColor);
  $('.sub-page-menu').css("background-color", randomColor);
  $('.post-hover-box').css("background-color", rgbaRandom);
}); 

// ------------------- Menu

$(".left-menu").click(function(){
  $(".nav").toggleClass('active');
});

$(".mob-menu").click(function(){
  $(".nav").toggleClass('active');
});

$(".meny-cross").click(function(){
  $(".nav").toggleClass('active');
});



// ------------------ Documents 









// -------------- Form label animation 

$('.wpcf7 input').focus(function(){
  $(this).parents('.input-outer div').addClass('focused');
});

$('.wpcf7 input').blur(function(){
  var inputValue = $(this).val();
  if ( inputValue == "" ) {
    $(this).removeClass('filled');
    $(this).parents('.input-outer div').removeClass('focused');  
  } else {
    $(this).addClass('filled');
  }
});

$('.wpcf7 textarea').focus(function(){
  $(this).parents('.input-outer div').addClass('focused');
});

$('.wpcf7 textarea').blur(function(){
  var inputValue = $(this).val();
  if ( inputValue == "" ) {
    $(this).removeClass('filled');
    $(this).parents('.input-outer div').removeClass('focused');  
  } else {
    $(this).addClass('filled');
  }
});


var sections = $('section')
, nav = $('.sub-page-menu')
, nav_height = nav.outerHeight();

$(window).on('scroll', function () {
  var cur_pos = $(this).scrollTop();
  
  sections.each(function() {
    var top = $(this).offset().top - nav_height,
    bottom = top + $(this).outerHeight();
    
    if (cur_pos >= top && cur_pos <= bottom) {

      nav.find('a').removeClass('menu-active').addClass('menu-inactive');
      sections.removeClass('active');
      
      $(this).addClass('active');
      nav.find('a[href="#'+$(this).attr('id')+'"]').addClass('menu-active').removeClass('menu-inactive');
    }
  });
});

nav.find('a').on('click', function () {
  var $el = $(this)
  , id = $el.attr('href');
  
  $('html, body').animate({
    scrollTop: $(id).offset().top - nav_height
  }, 500);
  
  return false;
});


var isMobile = {
  Android: function() {
    return navigator.userAgent.match(/Android/i);
  },
  BlackBerry: function() {
    return navigator.userAgent.match(/BlackBerry/i);
  },
  iOS: function() {
    return navigator.userAgent.match(/iPhone|iPad|iPod/i);
  },
  Opera: function() {
    return navigator.userAgent.match(/Opera Mini/i);
  },
  Windows: function() {
    return navigator.userAgent.match(/IEMobile/i) || navigator.userAgent.match(/WPDesktop/i);
  },
  any: function() {
    return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
  }
};

if( isMobile.any() ) {
  setInterval(changeColor,4000);
}



var div = document.getElementsByTagName("body")



function changeColor() {
  var colorArray = [
  '#35A270',
  '#7592E6',
  '#B29776',
  '#F47A4E'
  ];

  var randomColor = colorArray[Math.floor(Math.random()*colorArray.length)];

  if(randomColor == '#35A270') {
    var rgbaRandom = 'rgba(53, 162, 112, 0.95)';
  }

  if(randomColor == '#7592E6') {
    var rgbaRandom = 'rgba(117, 146, 230, 0.95)';
  }

  if(randomColor == '#B29776') {
    var rgbaRandom = 'rgba(178, 151, 118, 0.95)';
  }

  if(randomColor == '#F47A4E') {
    var rgbaRandom = 'rgba(244, 122, 78, 0.95)';
  }



  //console.log(randomColor);

  $('.home').css("background-color", randomColor);
  $('.home .nav').css("background-color", randomColor);
  $('.home .header').css("background-color", randomColor);
  $('.home .sub-page-menu').css("background-color", randomColor);
  $('.home .post-hover-box').css("background-color", rgbaRandom);
  $('.home .mob-menu').css("background-color", rgbaRandom);
}

if(window.location.href.indexOf("/sv/") > -1) {
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

  if(id === 'all') {
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
