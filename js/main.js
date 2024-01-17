(function ($) {
    "use strict";

    // Spinner
    var spinner = function () {
        setTimeout(function () {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            }
        }, 1);
    };
    spinner();
    
    
    // Initiate the wowjs
    new WOW().init();


    // Sticky Navbar
    $(window).scroll(function () {
        if ($(this).scrollTop() > 45) {
            $('.navbar').addClass('sticky-top shadow-sm');
        } else {
            $('.navbar').removeClass('sticky-top shadow-sm');
        }
    });
    
    // Dropdown on mouse hover
    const $dropdown = $(".dropdown");
    const $dropdownToggle = $(".dropdown-toggle");
    const $dropdownMenu = $(".dropdown-menu");
    const showClass = "show";
    
    $(window).on("load resize", function() {
        if (this.matchMedia("(min-width: 992px)").matches) {
            $dropdown.hover(
            function() {
                const $this = $(this);
                $this.addClass(showClass);
                $this.find($dropdownToggle).attr("aria-expanded", "true");
                $this.find($dropdownMenu).addClass(showClass);
            },
            function() {
                const $this = $(this);
                $this.removeClass(showClass);
                $this.find($dropdownToggle).attr("aria-expanded", "false");
                $this.find($dropdownMenu).removeClass(showClass);
            }
            );
        } else {
            $dropdown.off("mouseenter mouseleave");
        }
    });


    // Facts counter
    $('[data-toggle="counter-up"]').counterUp({
        delay: 10,
        time: 2000
    });
    
    
    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });


    // Testimonials carousel
    $(".testimonial-carousel").owlCarousel({
        autoplay: false,
        smartSpeed: 1500,
        dots: false,
        loop: true,
        center: true,
        nav:true,
        navText:['<i class="fas fa-chevron-left fa-2x bluecolor"></i>', '<i class="fas fa-chevron-right fa-2x bluecolor"></i>'],
        responsive: {
            0:{
                items:1
            },
            576:{
                items:1
            },
            768:{
                items:1
            },
            992:{
                items:1
            }
        }
    });
    $(".blog-carousel").owlCarousel({
        autoplay: false,
        smartSpeed: 1500,
        dots: false,
        loop: true,
        center: false,
        margin:20,
        nav:true,
        navText: ['<i class="fas fa-chevron-left bluecolor fa-2x"></i>', '<i class="fas fa-chevron-right bluecolor fa-2x"></i>'],
        responsive: {
            0:{
                items:1
            },
            576:{
                items:1
            },
            768:{
                items:2
            },
            992:{
                items:4
            }
        }
    });
    $('.blog-carousel .owl-nav').click(function(event) {
        $(this).removeClass('disabled');
      });
    // $(".screenshot_slider").owlCarousel({
    //     autoplay: false,
    //     smartSpeed: 1500,
    //     dots: true,
    //     loop: true,
    //     center: true,
    //     responsive: {
    //         0:{
    //             items:1
    //         },
    //         576:{
    //             items:3
    //         },
    //         768:{
    //             items:3
    //         },
    //         992:{
    //             items:5
    //         }
    //     }
    // });


    $(".owl-carousel-stacked").on(
        "dragged.owl.carousel translated.owl.carousel initialized.owl.carousel",
        function(e) {
          $(".center")
            .prev()
              .addClass("left-of-center");
            $(".left-of-center")
                .prev()
                .addClass("left1-of-center");
          $(".center")
            .next()
              .addClass("right-of-center");
            $(".right-of-center")
                .next()
                .addClass("right1-of-center");
        }
      );
      
      $(".owl-carousel-stacked").on("drag.owl.carousel", function(e) {
        $(".left-of-center").removeClass("left-of-center");
          $(".right-of-center").removeClass("right-of-center");
          $(".right1-of-center").removeClass("right1-of-center");
          $(".left1-of-center").removeClass("left1-of-center");
      });
      
      $(".owl-carousel-stacked").owlCarousel({
        loop: true,
        margin: 10,
        nav: false,
          items: 5,
          dots: true,
        center: true,
        mouseDrag: true,
          touchDrag: false,
          pullDrag: true,
          autoplay: false,
        navText: [
          '<span class="fa-stack fa-lg"><i class="fa fa-circle-thin fa-stack-2x" ></i><i class="fa fa-caret-left fa-stack-1x"></i></span>',
          '<span class="fa-stack fa-lg"><i class="fa fa-circle-thin fa-stack-2x" ></i><i class="fa fa-caret-right fa-stack-1x"></i></span>'
        ],
        responsive: {
            0:{
                items:1,
                autoplay:true,
                touchDrag: true
            },
            576:{
                items:2,
                autoplay:true,
                touchDrag: true
            },
            768:{
                items:3,
                autoplay:true,
                touchDrag: true
            },
            992:{
                items:5
            }
        }
      });
      
      $(".owl-carousel-stacked").on("translate.owl.carousel", function(e) {
        $(".left-of-center").removeClass("left-of-center");
          $(".right-of-center").removeClass("right-of-center");
          $(".right1-of-center").removeClass("right1-of-center");
          $(".left1-of-center").removeClass("left1-of-center");
      });

    $(".owl-carousel-stacked .owl-nav").removeClass("disabled");
      
    // Vendor carousel
    $('.vendor-carousel').owlCarousel({
        loop: true,
        margin: 45,
        dots: false,
        loop: true,
        autoplay: true,
        smartSpeed: 1000,
        responsive: {
            0:{
                items:2
            },
            576:{
                items:4
            },
            768:{
                items:6
            },
            992:{
                items:8
            }
        }
    });
    
})(jQuery);

