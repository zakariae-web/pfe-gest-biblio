
$(document).ready(function() {
    var slider = $('.slider');
    var thumbnails = $('.thumbnails');
    var thumbnail = $('.thumbnail');
  
    slider.slick({
      infinite: true,
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: false,
      fade: true,
      asNavFor: thumbnails
    });
  
    thumbnails.slick({
      infinite: true,
      slidesToShow: 7,
      slidesToScroll: 1,
      asNavFor: slider,
      dots: false,
      centerMode: true,
      focusOnSelect: true,
      responsive: [
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 3
      }
    }
  ]
    });
  
    thumbnail.on('click', function() {
      thumbnail.removeClass('active-thumbnail');
      $(this).addClass('active-thumbnail');
      var slideIndex = $(this).attr('data-slide');
      slider.slick('slickGoTo', slideIndex);
    });
  });
