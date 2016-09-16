var popUpSettings = {
        padding: 10,
        openEffect: 'elastic',
        openSpeed: 250,
        closeEffect: 'elastic',
        closeSpeed: 250,
        closeClick: true,
        wrapCSS: 'my-fancybox',
        titlePosition: 'inside',
        helpers: {
             overlay: {
                    locked: false
             },
             title : {
                type : 'inside'
            }
        }
};
$(document).ready(function() {
	
	// fancybox
	
	$('.fancybox').fancybox({
        popUpSettings
	});
		
	if(typeof $.fancybox.defaults != 'undefined'){
		$.extend($.fancybox.defaults.tpl, {
		    error    : '<p class="fancybox-error">Запрошенный контент не может быть загружен.<br>Пожалйста, попробуйте еще раз позже.</p>',
		    closeBtn : '<a title="Закрыть" class="fancybox-item fancybox-close" href="javascript:;"></a>',
		    next     : '<a title="Следующий" class="fancybox-nav fancybox-next" href="javascript:;"><span></span></a>',
		    prev     : '<a title="Предыдущий" class="fancybox-nav fancybox-prev" href="javascript:;"><span></span></a>'
		});
	}
	
   //validation 
   
    jQuery.extend(jQuery.validator.messages, {
        email: null,
        tel: null,
        required: null
    });
    
    $('.js__form-consultation').validate();
    
    // scroll
    
    $('.header-menu__link').on('click', function(e) {
        e.preventDefault();
        var $block = $($(this).attr('href')),
            offsetTop = 0;
        if($(this).attr('href').length) {
            $('body, html').animate({
                scrollTop: $block.offset().top - offsetTop
            }, 500);
        }
    });
    
    // placeholder
    
    $('input, textarea').placeholder({customClass: 'my-placeholder'});
    
    // reviews slider
    
    $('.reviews').each(function() {
        
        var $gallery = $(this),
            itemPerView = 1,
            itemLength = $gallery.find('.reviews__item').length;
        
        if (itemLength > itemPerView) {
            $gallery
                .addClass('carousel')
                .wrapInner('<div class="swiper-container"></div>')
                .find('.reviews__list')
                .addClass('swiper-wrapper')
                .end()
                .find('.reviews__item')
                .addClass('swiper-slide');

            var $prev = $('<a href="javascript:;" class="gallery-control gallery-control_prev" title="Назад"><span class="gallery-control__icon"></span></a>').appendTo($gallery), 
                $next = $('<a href="javascript:;" class="gallery-control gallery-control_next" title="Вперед"><span class="gallery-control__icon"></span></a>').appendTo($gallery),
                reviewsCarousel = $gallery.find('.swiper-container').swiper({
                    slidesPerView : itemPerView,
                    grabCursor : true,
                    slideElement : 'li',
                    preventLinksPropagation : true,
                    calculateHeight : true,
                    loop: true
                });

            $prev.click(function(e) {
                e.preventDefault();
                if (!$(this).hasClass('gallery-control_state_disabled')) {
                    reviewsCarousel.swipePrev();
                }
            });

            $next.click(function(e) {
                e.preventDefault();
                if (!$(this).hasClass('gallery-control_state_disabled')) {
                    reviewsCarousel.swipeNext();
                }
            });

        }
    });
    
});
