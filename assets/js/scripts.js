(function($){
  "use strict";

  var $window = $(window);

  $window.on('load', function() {
    // Preloader
    $('.loader').fadeOut();
    $('.loader-mask').delay(350).fadeOut('slow');

    $window.trigger("resize");
  });

  // Init
  initMasonry();
  initSlickSlider();


  $window.resize(function(){
    stickyNavRemove();
    hideSidenav();
  });


  /* Detect Browser Size
  -------------------------------------------------------*/
  var minWidth;
  if (Modernizr.mq('(min-width: 0px)')) {
    // Browsers that support media queries
    minWidth = function (width) {
      return Modernizr.mq('(min-width: ' + width + 'px)');
    };
  }
  else {
    // Fallback for browsers that does not support media queries
    minWidth = function (width) {
      return $window.width() >= width;
    };
  }

  /* Mobile Detect
  -------------------------------------------------------*/
  if (/Android|iPhone|iPad|iPod|BlackBerry|Windows Phone/i.test(navigator.userAgent || navigator.vendor || window.opera)) {
    $("html").addClass("mobile");
  }
  else {
    $("html").removeClass("mobile");
  }

  /* IE Detect
  -------------------------------------------------------*/
  if(Function('/*@cc_on return document.documentMode===10@*/')()){ $("html").addClass("ie"); }



  /* Sticky Navigation
  -------------------------------------------------------*/
  $window.scroll(function () {
    scrollToTop();

    var $navSticky = $('.nav--sticky');

    if ( $window.scrollTop() > 150 & minWidth(992) ) {
      $navSticky.addClass('sticky');
    } else {
      $navSticky.removeClass('sticky');
    }

    if ( $window.scrollTop() > 160 & minWidth(992) ) {
      $navSticky.addClass('offset');
    } else {
      $navSticky.removeClass('offset');
    }

    if ( $window.scrollTop() > 200 & minWidth(992) ) {
      $navSticky.addClass('scrolling');
    } else {
      $navSticky.removeClass('scrolling');
    }
  });


  function stickyNavRemove() {
    if ( ! minWidth( 992 ) ) {
      $('.nav--sticky').removeClass('sticky offset scrolling');
    }

    if ( minWidth( 992 ) ) {
      $('.nav__dropdown-menu').css('display', '');
    }
  }
  

  /* Mobile Navigation
  -------------------------------------------------------*/
  var $navDropdown = $('.nav__dropdown');

  $('.nav__dropdown-trigger').on('click', function() {
    var $this = $(this);
    $this.next($('.nav__dropdown-menu')).slideToggle();
    $this.attr('aria-expanded', function(index, attr){
      return attr == 'true' ? 'false' : 'true';
    });
  });

  if ( $('html').hasClass('mobile') ) {
    $('body').on('click',function() {
      $('.nav__dropdown-menu').addClass('hide-dropdown');
    });

    $navDropdown.on('click', '> a', function(e) {
      e.preventDefault();
    });

    $navDropdown.on('click',function(e) {
      e.stopPropagation();
      $('.nav__dropdown-menu').removeClass('hide-dropdown');
    });
  }


  /* Sidenav Navigation
  -------------------------------------------------------*/
  var $sidenav = $('#sidenav'),
      $navIconToggle = $('.nav-icon-toggle'),
      $contentOverlay = $('.content-overlay'),
      $sidenavCloseButton = $('#sidenav__close-button');

  $navIconToggle.on('click', function(e) {
    e.stopPropagation();
    $(this).toggleClass('nav-icon-toggle--is-open');
    $sidenav.toggleClass('sidenav--is-open');   
    $contentOverlay.toggleClass('content-overlay--is-visible');
  });

  function resetNav() {
    $navIconToggle.removeClass('nav-icon-toggle--is-open');
    $sidenav.removeClass('sidenav--is-open');
    $contentOverlay.removeClass('content-overlay--is-visible');
  }

  function hideSidenav() {
    if( minWidth(992) ) {
      resetNav();
    }
  }

  $contentOverlay.on('click', function() {
    resetNav();
  });

  $sidenavCloseButton.on('click', function() {
    resetNav();
  });


  /* Nav Search
  -------------------------------------------------------*/
  (function() {
    var $navSearchForm = $('.nav__search-form'),
        $navSearchTrigger = $('#nav__search-trigger'),
        $navSearchInput = $('#nav__search-input'),
        $navSearchClose = $('#nav__search-close');

    $navSearchTrigger.on('click',function(e){
      e.preventDefault();
      $navSearchForm.animate({opacity: 'toggle'},500);
      $navSearchInput.focus();
    });

    $navSearchClose.on('click',function(e){
      e.preventDefault();
      $navSearchForm.animate({opacity: 'toggle'},500);
    });

    function closeSearch(){
      $navSearchForm.fadeOut(200);
    }

    $(document.body).on('click',function(e) {
      closeSearch();
    });

    $navSearchInput.add($navSearchTrigger).on('click',function(e) {
      e.stopPropagation();
    });
  })();


  /* Masonry
  -------------------------------------------------------*/
  function initMasonry(){
    var $masonry = $('.masonry-grid');
    $masonry.imagesLoaded( function() {
      $masonry.isotope({
        itemSelector: '.masonry-item',
        layoutMode: 'masonry',
        percentPosition: true,
        resizable: false,
        isResizeBound: false,
        masonry: { columnWidth: '.masonry-item' }
      });
    });

    $masonry.isotope();
  }

  // Isotope filter
  var $portfolioFilter = $('.masonry-grid');
  $('.masonry-filter').on( 'click', 'a', function(e) {
    e.preventDefault();
    var filterValue = $(this).attr('data-filter');
    $portfolioFilter.isotope({ filter: filterValue });
    $('.masonry-filter a').removeClass('active');
    $(this).closest('a').addClass('active');
  });


  /* Material Inputs
  -------------------------------------------------------*/
  (function() {
    var $input = $('.material__input');
    $input.on('blur', function() {
      if ( $(this).val() ) {
        $(this).parent('.material__form-group').addClass('material__form-group--active');
      } else {
        $(this).parent('.material__form-group').removeClass('material__form-group--active');
      }
    });
  })();


  /* Slick Slider
  -------------------------------------------------------*/
  function initSlickSlider(){

    // Testimonials
    $('.slick-testimonials').slick({
      slidesToShow: 1
    });

    // Single Project
    $('.slick-single-image').slick({
      slidesToShow: 1,
      dots: true,
    });

    // Team
    $('.slick-team').slick({
      slidesToShow: 2,
      variableWidth: true,
      dots: true,
      arrows: false,
      centerMode: false,
      responsive: [
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 2
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            variableWidth: false
          }
        }
      ]
    });

  }


  /* Accordion
  -------------------------------------------------------*/
  var $accordion = $('.accordion');
  function toggleChevron(e) {
    $(e.target)
      .prev('.accordion__heading')
      .find("a")
      .toggleClass('accordion--is-open accordion--is-closed');
  }
  $accordion.on('hide.bs.collapse', toggleChevron);
  $accordion.on('show.bs.collapse', toggleChevron);


  /* Tabs
  -------------------------------------------------------*/
  $('.tabs__trigger').on('click', function(e) {
    var currentAttrValue = $(this).attr('href');
    $('.tabs__content-trigger ' + currentAttrValue).stop().fadeIn(1000).siblings().hide();
    $(this).parent('li').addClass('tabs__item--active').siblings().removeClass('tabs__item--active');
    e.preventDefault();
  });


  /* Sticky Socials
  -------------------------------------------------------*/
  (function() {
    var $stickyCol = $('.sticky-col');
    if($stickyCol) {
      $stickyCol.stick_in_parent({
        offset_top: 100
      });
    }
  })();


  /* Scroll to Top
  -------------------------------------------------------*/
  function scrollToTop() {
    var scroll = $window.scrollTop();
    var $backToTop = $("#back-to-top");
    if (scroll >= 50) {
      $backToTop.addClass("show");
    } else {
      $backToTop.removeClass("show");
    }
  }

  $('a[href="#top"]').on('click',function(){
    $('html, body').animate({scrollTop: 0}, 1350, "easeInOutQuint");
    return false;
  });

})(jQuery);