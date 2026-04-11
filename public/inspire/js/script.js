

/* Client carousel */
$(document).ready(function(){

    AOS.init();

    $('.owl-carousel').owlCarousel({
      loop:true,
      margin:10,
      autoplay:true,
      autoplayTimeout:1000,
      autoplayHoverPause:true,
      dots: false,
      responsive:{
          0:{
              items:1
          },
          600:{
              items:3
          },
          1000:{
              items:10
          }
      }
  })

  $(window).on("scroll", function() {
    if ($(window).scrollTop() > 100) {
      $("#nav").addClass("fixed-top");
    } else {
      $("#nav").removeClass("fixed-top");
    }
    if($(window).scrollTop() > 120){
      $('.bottomToTop').addClass('d-block');
    }else{
      $('.bottomToTop').removeClass('d-block');
    }
  });

  $("a[href='#top']").click(function() {
    $("html, body").animate({ scrollTop: 0 }, 'slow');
    return false;
  });

  $('.jello').hover(function(){
    $( this ).addClass( "animate__animated animate__jello" );
  }, function(){
    $( this ).removeClass( "animate__animated animate__jello" );
  });
  
  $('.pulse').hover(function(){
    $( this ).addClass( "animate__animated animate__pulse" );
  }, function(){
    $( this ).removeClass( "animate__animated animate__pulse" );
  });

    });
    