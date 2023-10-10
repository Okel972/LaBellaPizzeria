$(document).ready(function(){
  $('.slider').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: false,
    autoplaySpeed: 1000,
    dots: true,
  });
  
    $('.slider').on('swipe', function(event, slick, direction){
      console.log(direction);
      // left
    });
  });