
(function($){

    /* All Images Loaded */

	$(window).on('load', function(){

        var rtl = false;
        if( $('body').hasClass('rtl') ){
            rtl = true;
        }

        // Sticky elements

		var document_width = $(document).width();
        if( document_width > 1200 && $('#header').hasClass('enable-sticky') ){
            var header_height = $('#header div.menu-wrapper').outerHeight();
            $('#header').height( header_height );
        }

        $(window).scroll(function(){
            if( document_width > 1200 && $('#header').hasClass('enable-sticky') ){
                if( $(window).scrollTop() >= 300) {
                    $('#header').addClass('is-sticky');                        
                } else {
                    $('#header').removeClass('is-sticky');
                }
            } else{
                $('#header').removeClass('is-sticky');  
            }
        });           

        $(window).on('resize', function() {
            var document_width = $(document).width();
            $('#header').removeClass('is-sticky');
            var header_height = $('#header div.menu-wrapper').outerHeight();
            $('#header').height( header_height );
            if( document_width < 1200 ){
                $('#header').removeClass('enable-sticky is-sticky');
            }
        });
        
		if($(document).width() > 767){
			$('div.epcl-share-container').stickySidebar({
				topSpacing: 80,
				bottomSpacing: 80
            });
            var $grid = $('.enable-masonry .grid-posts div.articles:not(.classic)').masonry({
                itemSelector: 'article',
                gutter: 0,
                horizontalOrder: true,
                isOriginLeft: !rtl,
            });
            setTimeout(function(){
                $grid.masonry('layout');
            }, 500);
            
        }     
        
        if( $(document).width() > 1200 ){
            if( $('#sidebar').hasClass('sticky-enabled') && ( $('#sidebar').outerHeight() < $('div.left-content').outerHeight() ) ){
                $('#sidebar.sticky-enabled').theiaStickySidebar({
                    additionalMarginTop: 30,
                    additionalMarginBottom: 30
                });
            }
        }

        if($(document).width() > 767){
            AOS.init({
                offset: 220,
                duration: 700,
                disable: window.innerWidth < 1024,
                easing: 'ease',
                once: true
            });
        }

    });
    
    /* Dom Loaded */

	$(document).ready(function($){ 

        var rtl = false;
        if( $('body').hasClass('rtl') ){
            rtl = true;
        }

        // Safari mobile fix
        $('#header nav ul.menu li.menu-item-has-children').attr('onClick', '');

        // Last submenu fix
        $('#header nav ul.menu > li.menu-item-has-children:last').addClass('last-menu-item');

        // Enable HTML5 form validation
        $('#commentform').removeAttr('novalidate');

        // Submenu on Mobile

        if( $(document).width() < 768){
			$('#header li.menu-item-has-children > a').on('click', function(e){
                if( $(this).attr('target') != '_blank' ){
                    $(this).parent().toggleClass('menu-open');
                    e.preventDefault();
                }            
            });
		}

        // Lazy load images and iframes

		$(".lazy, img[data-src], iframe[data-src]").Lazy({
            placeholder: "data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==",
            enableThrottle: true,
            throttle: 500,
			afterLoad: function(element){
				element.addClass('loaded');
			}
        });

        // Lazy load for Adsense
        
        if( $('body').hasClass('enable-lazy-adsense') ){
            $('ins[data-ad-slot]').adsenseLoader();
        }
        

		// Counter animation

		$('.count').each(function () {
			$(this).prop('Counter',0).animate({
				Counter: $(this).data('total')
			}, {
				duration: 1500,
				easing: 'swing',
				step: function (now) {
					$(this).text(Math.ceil(now));
				}
			});
        });

        // Ajax Download

        $('div.epcl-download a').on('click', function(){
			var elem = $(this);
			var post_id = elem.data('post-id');
			$.ajax({
				type: 'post',
				url: ajax_var.url,
				data: { action: 'epcl_download', nonce: ajax_var.nonce, post_id: post_id },
				success: function(count){

				}
			});
        })

        // Ajax Views counter
        if( $('body').hasClass('single-post') && $('#single').data('post-id') ){
            var post_id = parseInt( $('#single').data('post-id') );
            $.ajax({
                type: 'post',
                url: ajax_var.url,
                data: { action: 'epcl_views_counter', nonce: ajax_var.nonce, post_id: post_id },
                success: function(count){
    
                }
            });
        }


        // Custom Select and filters

        $('select.custom-select, aside select, #footer select, .wp-block-archives-dropdown select').niceSelect();

		$('#header div.menu-mobile').on('click', function(){
			$('#header').toggleClass('menu-open');
		});

		$('.filters select').change(function(){
			var url = $(this).val();
			if(url)
				document.location = url;
        });

        // Back to top button

		$('#back-to-top').on('click', function(event) {
			event.preventDefault();
			$('html, body').animate({scrollTop: 0}, 500);
			return false;
        });

        // Single Post copy button

        $(".permalink .copy").on('click', function(){
            $("#copy-link").select();
            document.execCommand('copy');
        });

        // Slick script loaded by ajax
        if( $('.slick-slider').length > 0 && $('body').hasClass('enable-optimization') ){
            $.ajax({
                url: ajax_var.assets_folder+'/js/slick.min.js',
                dataType: 'script',
                async: true,
                cache: true,
            }).done(function(){
                epcl_load_sick_sliders();
            });   
        }   
        if( $('.slick-slider').length > 0 && !$('body').hasClass('enable-optimization') ){
            epcl_load_sick_sliders();
        }    

		// Flickr feed

		if( $('.widget_epcl_flickr').length > 0 ){
			$('.widget_epcl_flickr').each(function(index, el) {
				var elem = $(this);
				var flickr_limit = elem.find('.epcl-flickr-gallery').data('limit');
				var flickr_id = elem.find('.epcl-flickr-gallery').data('flickr-id');
				elem.find('ul').jflickrfeed({
					limit: parseInt(flickr_limit),
					qstrings: {
						id: flickr_id
					},
					useTemplate: false,
					itemCallback: function(item){
						$(this).append('<li class="grid-50 tablet-grid-33 mobile-grid-33"><div class="wrapper"><a href="'+item.image_b+'" title="'+item.title+'" class="hover-effect"><span class="cover" style="background-image: url('+item.image_m+');"></span></a></div></li>');
					}
				}, function(data) {
					elem.addClass('loaded');
					elem.find('ul').magnificPopup({
						type: 'image',
						gallery:{
							enabled: true,
                            arrowMarkup: '<i class="mfp-arrow mfp-arrow-%dir% fa fa-chevron-%dir%"></i>',
                            tCounter: '%curr% / %total%'
						},
						delegate: 'a',
						mainClass: 'my-mfp-zoom-in',
						removalDelay: 300,
						closeMarkup: '<span title="%title%" class="mfp-close">&times;</span>'
					});
				});

			});
		}

		// Global: lightbox

		$('.lightbox').magnificPopup({
			mainClass: 'my-mfp-zoom-in',
			removalDelay: 300,
			closeMarkup: '<i title="%title%" class="mfp-close fa fa-times"></i>',
			fixedContentPos: true
        });

        $('.main-nav .lightbox, .epcl-search-button').magnificPopup({
			mainClass: 'my-mfp-zoom-in',
			removalDelay: 300,
			closeMarkup: '<span title="%title%" class="mfp-close">&times;</span>',
            fixedContentPos: true,
            closeBtnInside: false,
            callbacks: {
                beforeOpen: function(item) {
                    setTimeout(function() { $('#search-lightbox form #s').focus() }, 500);
                },
            }
        });

        // Global: related galleries

        $('.epcl-gallery').each(function() {
            var elem = $(this);
            elem.find('ul').magnificPopup({
                type: 'image',
                gallery:{
                    enabled: true,
                    arrowMarkup: '<i class="mfp-arrow mfp-arrow-%dir% fa fa-chevron-%dir%"></i>',
                    tCounter: '%curr% / %total%'
                },
                delegate: 'a',
                mainClass: 'my-mfp-zoom-in',
                removalDelay: 300,
                closeMarkup: '<span title="%title%" class="mfp-close">&times;</span>'
            });
        });

        // Gutenberg Gallery with lightbox
        $('.wp-block-gallery, .woocommerce-product-gallery').each(function() {
            var elem = $(this);
            elem.magnificPopup({
                type: 'image',
                gallery:{
                    enabled: true,
                    arrowMarkup: '<i class="mfp-arrow mfp-arrow-%dir% fa fa-chevron-%dir%"></i>',
                    tCounter: '%curr% / %total%'
                },
                delegate: "a[href*='.jpg'],a[href*='.png'],a[href*='.gif']",
                mainClass: 'my-mfp-zoom-in',
                removalDelay: 300,
                closeMarkup: '<span title="%title%" class="mfp-close">&times;</span>',
                image: {
                    titleSrc: function(item) {
                        return item.el.parent().find('figcaption').text();
                    }
                }
            });
        });

        // Gutenberg Single Image with lightbox
        $('.wp-block-image').magnificPopup({
            type: 'image',
            gallery:{
                enabled: true,
                arrowMarkup: '<i class="mfp-arrow mfp-arrow-%dir% fa fa-chevron-%dir%"></i>',
                tCounter: '%curr% / %total%'
            },
            delegate: "a[href*='.jpg'],a[href*='.png'],a[href*='.gif']",
            mainClass: 'my-mfp-zoom-in',
            removalDelay: 300,
            closeMarkup: '<span title="%title%" class="mfp-close">&times;</span>',
            image: {
                titleSrc: function(item) {
                    return item.el.parent().find('figcaption').text();
                }
            }
        });

        // Custom Ajax Scripts
        if( $('#epcl-ajax-scripts').length > 0){
            $('#epcl-ajax-scripts > div').each(function( index ) {
                var script_src = $(this).data('src');
                var script_cache = parseInt( $(this).data('cache') );
                if ( script_cache == 0 ) script_cache = false;
                else script_cache = true;
                var script_timeout = parseInt( $(this).data('timeout') );

                if( script_timeout > 0 ){
                    setTimeout( function(){
                        $.ajax({
                            url: script_src,
                            dataType: 'script',
                            async: true,
                            cache: script_cache
                        });
                    }, script_timeout );
                }else{
                    $.ajax({
                        url: script_src,
                        dataType: 'script',
                        async: true,
                        cache: script_cache
                    });
                }

            });
        }

        // Prism Loaded by ajax
        if( ($('pre[class]').length > 0 || $('code[class]').length > 0) && $('body').hasClass('enable-optimization') ){
            $.ajax({
                url: ajax_var.assets_folder+'/js/prism.min.js',
                dataType: 'script',
                async: true,
                cache: true,
            });
        }

        function epcl_load_sick_sliders(){
            // Gallery Post Format

            $('.post-format-gallery .slick-slider').each(function(){
                var rtl = false;
                if( parseInt( $(this).data('rtl') ) > 0 ){
                    rtl = true;
                }
                $(this).slick({
                    cssEase: 'ease',
                    fade: true,
                    arrows: true,
                    infinite: true,
                    dots: false,
                    autoplay: false,
                    speed: 600,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    rtl: rtl,
                });
            });

            // Module: carousel

            $('.epcl-carousel').each(function(index, el) {
                var slides_to_show = parseInt( $(this).data('show') );
                var rtl = false;
                if( parseInt( $(this).data('rtl') ) > 0 ){
                    rtl = true;
                }
                $(this).slick({
                    cssEase: 'ease',
                    fade: false,
                    arrows: true,
                    infinite: true,
                    dots: false,
                    autoplay: false,
                    speed: 600,
                    rtl: rtl,
                    slidesToShow: slides_to_show,
                    slidesToScroll: slides_to_show,
                    responsive: [,
                        {
                            breakpoint: 1700,
                            settings: {
                                slidesToShow: 4,
                                slidesToScroll: 4
                            }
                        },
                        {
                            breakpoint: 1200,
                            settings: {
                                slidesToShow: 3,
                                slidesToScroll: 3
                            }
                        },
                        {
                            breakpoint: 980,
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 2
                            }
                        },
                        {
                            breakpoint: 767,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1
                            }
                        },
                    ]
                });
            });
        }

	});

})(jQuery);

(function() {
    var supportsPassive = eventListenerOptionsSupported();  
  
    if (supportsPassive) {
      var addEvent = EventTarget.prototype.addEventListener;
      overwriteAddEvent(addEvent);
    }
  
    function overwriteAddEvent(superMethod) {
      var defaultOptions = {
        passive: true,
        capture: false
      };
  
      EventTarget.prototype.addEventListener = function(type, listener, options) {
        var usesListenerOptions = typeof options === 'object';
        var useCapture = usesListenerOptions ? options.capture : options;
        options = usesListenerOptions ? options : {};
        if( type == 'touchstart' || type == 'touchmove'){
            options.passive = options.passive !== undefined ? options.passive : defaultOptions.passive;
        }        
        options.capture = useCapture !== undefined ? useCapture : defaultOptions.capture;
  
        superMethod.call(this, type, listener, options);
      };
    }
  
    function eventListenerOptionsSupported() {
      var supported = false;
      try {
        var opts = Object.defineProperty({}, 'passive', {
          get: function() {
            supported = true;
          }
        });
        window.addEventListener("test", null, opts);
      } catch (e) {}
  
      return supported;
    }

  })();