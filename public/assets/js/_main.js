(function($){
  $(document).ready(function(){

      $('#hm_banner_slider').slick({
          infinite: false,
          dots: true,
          arrows: false,
      });

      if($(window).width() < 760){

      $('.slidePortfolio1').slick({
          infinite: false,
          slidesToShow: 9,
          slidesToScroll: 9,
          prevArrow: '<i class="fa fa-chevron-left" aria-hidden="true"></i>',
          nextArrow: '<i class="fa fa-chevron-right" aria-hidden="true"></i>',
          responsive: [
              
              {
                breakpoint: 700,
                settings: {
                  slidesToShow: 2,
                  slidesToScroll: 2,
                  dots: true,
                  arrows: false,
                }
              },
              {
                breakpoint: 480,
               
                settings: {
                  slidesToShow: 1,
                  slidesToScroll: 1,
                  dots: true,
                  arrows: false,
                }
              }
            ]
      });
    }

      /*--------- home testimonial---------*/

      $('#testimonialCarousel').slick({
          infinite: false,
          slidesToShow: 1,
          slidesToScroll: 1,
         /* prevArrow: '<i class="fa fa-chevron-left" aria-hidden="true"></i>',
          nextArrow: '<i class="fa fa-chevron-right" aria-hidden="true"></i>',*/
          dots: true,
          arrows: false,
          responsive: [
              {
                breakpoint: 1300,
                settings: {
                  slidesToShow: 1,
                  slidesToScroll: 1,
                  dots: true,
                  arrows: false,
                }
              },
              {
                breakpoint: 900,
                settings: {
                  slidesToShow: 1,
                  slidesToScroll: 1,
                  dots: true,
                  arrows: false,
                }
              },
              {
                breakpoint: 480,
               
                settings: {
                  slidesToShow: 1,
                  slidesToScroll: 1,
                  dots: true,
                  arrows: false,
                }
              }
            ]
      });

      /*--------- home hints---------*/

      $('#hintCarousel').slick({
        infinite: false,
        slidesToShow: 3,
        slidesToScroll: 1,
        prevArrow: '<i class="fa fa-chevron-left" aria-hidden="true"></i>',
        nextArrow: '<i class="fa fa-chevron-right" aria-hidden="true"></i>',
        dots: false,
        arrows: true,
        responsive: [
            {
              breakpoint: 1300,
              settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
                dots: true,
                arrows: false,
              }
            },
            {
              breakpoint: 900,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
                dots: true,
                arrows: false,
              }
            },
            {
              breakpoint: 600,
             
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                dots: true,
                arrows: false,
              }
            }
          ]
    });

      
  });
})(jQuery)